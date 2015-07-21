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

        $podcasts = $this->rPodcast->presentAllPublished();
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

        $data = Input::only('title', 'description', 'episode_number', 'duration');

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
	public function show($source = 'website', $id) {

        $podcast = $this->rPodcast->find($id);

        Event::fire('podcast.requested', [$podcast, $source]);

        return Redirect::to($podcast->getS3Link());

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

        if (Input::file('episode_image')) {
            $path = Input::file('episode_image')->getRealPath();
            $bucket = Config::get('lrvm.s3_podcast_bucket');
            $title = Input::file('episode_image')->getClientOriginalName();
            $uploader = new \LRVM\Modules\Uploader(
                $bucket, $title, $path, 'public-read'
            );
            $result = $uploader->doUpload();
            $data['episode_image'] = $result['ObjectURL'];
        }


        $this->rPodcast->update($id, $data);

        return Redirect::route('podcasts.index');

	}

    public function link($id) {

        $podcast = $this->rPodcast->find($id);
        return View::make('pages.podcasts.link')->with(compact(['podcast']));

    }

    public function upload($id) {

        $podcast = $this->rPodcast->find($id);
        $path = Input::file('filename')->getRealPath();
        $bucket = Config::get('lrvm.s3_podcast_bucket');
        $title = Input::file('filename')->getClientOriginalName();

        $uploader = new \LRVM\Modules\Uploader(
            $bucket, $title, $path, 'public-read'
        );
        $result = $uploader->doUpload();

        $this->rPodcast->update($podcast->id, ['filename' => $title]);

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