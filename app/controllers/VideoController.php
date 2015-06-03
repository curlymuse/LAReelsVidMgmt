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
        $categories = $this->rCat->all();
        return View::make('pages.listvideos')
            ->with(compact(['videos', 'categories']));

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /videos/create
	 *
	 * @return Response
	 */
	public function create() {

        return View::make('pages.createvideo');
		//
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
	 * Update the specified resource in storage.
	 * PUT /videos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		//
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
