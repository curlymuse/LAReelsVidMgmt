<?php

use LRVM\Domain\Video\VideoRepository;
use LRVM\Domain\Category\CategoryRepository;

class CategoryController extends \BaseController {

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
	 * Display a listing of the resource.
	 * GET /category
	 *
	 * @return Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /category/create
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /category
	 *
	 * @return Response
	 */
	public function store() {
		//
	}

	/**
	 * Display the specified resource.
	 * GET /category/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /category/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /category/{id}
	 *
	 * @return Response
	 */
	public function update() {

        $data = Input::only('categories', 'videoId');

        $this->rVideo->saveCategories($data['videoId'], $data['categories']);

        $response = [
            'id'    => $data['videoId']
        ];

        return Response::json($response);

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /category/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

}
