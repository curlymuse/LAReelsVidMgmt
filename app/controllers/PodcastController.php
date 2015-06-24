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

        $podcasts = $this->rPodcast->all();
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

        $data = Input::only('title', 'description', 'episode_number', 'filename');

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

        return Response::download($path, 'episode-'.$podcast->episode_number);

        $response = Response::make($path, 200);
        $response->header('Content-Type', 'audio/mpeg');

        return $response;

	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /podcast/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /podcast/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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