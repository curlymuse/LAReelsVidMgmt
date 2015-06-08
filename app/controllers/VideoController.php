<?php

use LRVM\Domain\Video\VideoRepository;
use LRVM\Domain\Category\CategoryRepository;

class VideoController extends \BaseController {

    /**
     * Video Repository
     *
     * @var VideoRepository
     */
    protected $rVideo;

    /**
     * Category Repository
     *
     * @var CategoryRepository
     */
    protected $rCat;

    /**
     * Inject VideoRepository
     * @param VideoRepository $rVideo
     * @param CategoryRepository $rCat
     */
    public function __construct(VideoRepository $rVideo, CategoryRepository $rCat) {

        $this->rVideo = $rVideo;
        $this->rCat = $rCat;

    }

	/**
	 * Show list of videos
	 * GET /videos
	 *
	 * @return Response
	 */
	public function index() {

        $videos = $this->rVideo->all();
        $genres = $this->rCat->allGenres();
        $primary = $this->rCat->allPrimary();
        return View::make('pages.videos.listvideos')
            ->with(compact(['videos', 'genres', 'primary']));

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /videos/create
	 *
	 * @return Response
	 */
	public function create() {

        return View::make('pages.videos.createvideo');

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /videos
	 *
	 * @return Response
	 */
	public function store() {

        $data = Input::only(['title', 'description']);
        $data['vimeo_id'] = preg_replace("/[^0-9]/","",Input::get('link'));
        $this->rVideo->store($data);

        return Redirect::route('videos.index');

	}

	/**
	 * Display the specified resource.
	 * GET /videos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /videos/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Toggle the public/private status of the video
	 * PUT /videos/{id}
	 *
	 * @return Response
	 */
	public function update() {

        $videoId = Input::get('videoId');
        $status = $this->rVideo->togglePublic($videoId);

        $response = ['videoId' => $videoId, 'is_public' => $status];
        return Response::json($response);


	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /videos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

}
