<?php

use LRVM\Domain\Video\VideoRepository;

class VideoController extends \BaseController {

    /**
     * Video Repository
     *
     * @var VideoRepository
     */
    protected $rVideo;

    /**
     * Inject VideoRepository
     */
    public function __construct(VideoRepository $rVideo) {

        $this->rVideo = $rVideo;

    }


	/**
	 * Show list of videos
	 * GET /videos
	 *
	 * @return Response
	 */
	public function index() {

        $videos = $this->rVideo->all();
        return View::make('pages.listvideos')
            ->with(compact(['videos']));

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /videos/create
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /videos
	 *
	 * @return Response
	 */
	public function store() {
		//
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
