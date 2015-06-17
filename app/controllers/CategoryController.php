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

}
