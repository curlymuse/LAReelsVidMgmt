<?php

use LRVM\Core\ApiController;
use LRVM\Domain\Video\VideoRepository;

class ApiVideosController extends ApiController {

    /**
     * @var VideoRepository
     */
    protected $rVideo;

    /**
     * @param VideoRepository $rVideo
     */
    public function __construct(VideoRepository $rVideo) {

        $this->rVideo = $rVideo;

    }

	/**
	 * Display a listing of the resource.
	 * GET /apivideos
	 *
	 * @return Response
	 */
	public function index() {

        $videos = $this->rVideo->allActiveWithCategories();

        $response = ['videos' => $videos];
        return $this->_succeed($response);

	}

    /**
     * Display a listing of the resource.
     * GET /apivideos
     *
     * @return Response
     */
    public function unsyncedIndex() {

        $videos = $this->rVideo->allUnsyncedWithCategories();

        $response = ['videos' => $videos];
        return $this->_succeed($response);

    }

	/**
	 * Show the form for creating a new resource.
	 * GET /apivideos/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

    /**
     * Store the post ID for a video
     *
     * @param $id
     * @param $postId
     * @return Response
     */
	public function store($id, $postId) {

        $this->rVideo->linkPost($id, $postId);
        return $this->_succeed();

	}

	/**
	 * Display the specified resource.
	 * GET /apivideos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {

        $video = $this->rVideo->find($id);
        $response = [
            'video' => $this->rVideo->present($video)
        ];

        return $this->_succeed($response);

	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /apivideos/{id}/edit
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
	 * PUT /apivideos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {

        $this->rVideo->markSynced($id);

        return $this->_succeed();

	}

    /**
     * Update the specified resource in storage.
     * PUT /apivideos/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function updateAll() {

        $toSync = Input::get('toSync');

        $this->rVideo->batchMarkSynced($toSync);
        return $this->_succeed();

    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /apivideos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {

        $this->rVideo->reset($id);
        return $this->_succeed();

	}

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroyAll() {

        $this->rVideo->resetAll();
        return $this->_succeed();

    }

}