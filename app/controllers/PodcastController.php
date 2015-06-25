<?php

use LRVM\Domain\Podcast\PodcastRepository;

class PodcastController extends \BaseController {

    /**
     * Podcast Repository
     *
     * @var PodcastRepository
     */
    protected $rPodcast;

    /**
     * Inject dependencies
     *
     * @param PodcastRepository $rPodcast
     */
    public function __construct(PodcastRepository $rPodcast) {

       $this->rPodcast = $rPodcast;

    }

	/**
	 * Display a listing of the resource.
	 * GET /podcast
	 *
	 * @return Response
	 */
	public function index() {

        $podcasts = $this->rPodcast->all();
        return View::make('pages.podcasts.index')->with(compact(['podcasts']));

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /podcast/create
	 *
	 * @return Response
	 */
	public function create() {

        return View::make('pages.podcasts.create');

	}

    public function feed() {

        $podcasts = $this->rPodcast->allPublished();
        $content = View::make('feeds.podcasts')->with(compact(['podcasts']));

        return Response::make($content, 200)->header('Content-Type', 'text/xml');

    }

	/**
	 * Store a newly created resource in storage.
	 * POST /podcast
	 *
	 * @return Response
	 */
	public function store() {

        $data = Input::only('title', 'description', 'episode_number', 'filename', 'duration');

        $this->rPodcast->store($data);

        return Redirect::route('podcasts.index');

	}

	/**
	 * Display the specified resource.
	 * GET /podcast/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {

        $podcast = $this->rPodcast->find($id);

        $path = Config::get('lrvm.podcast_dir') . '/' . $podcast->filename;
        $contents = file_get_contents($path);

        return Response::make($contents, 200)->header('Content-Type', 'audio/mpeg');


        return Response::download($path, 'episode-'.$podcast->episode_number.'.mp3');

	}

    public function togglePublish() {

        $podcastId = Input::get('podcastId');
        $isPublished = $this->rPodcast->togglePublished($podcastId);

        $data = [
            'podcastId' => $podcastId,
            'isPublished' => $isPublished
        ];
        return Response::json($data);

    }

	/**
	 * Show the form for editing the specified resource.
	 * GET /podcast/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {

        $podcast = $this->rPodcast->find($id);
        return View::make('pages.podcasts.edit')->with(compact(['podcast']));

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /podcast/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {

        $data = Input::only('title', 'description', 'duration');
        $this->rPodcast->update($id, $data);

        return Redirect::route('podcasts.index');

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /podcast/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}