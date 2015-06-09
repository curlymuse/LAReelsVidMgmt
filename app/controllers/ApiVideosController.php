<?php

use LRVM\Domain\Video\VideoRepository;

class ApiVideosController extends \BaseController {

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
	 * Store a newly created resource in storage.
	 * POST /apivideos
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
	 * Remove the specified resource from storage.
	 * DELETE /apivideos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    /**
     * Return JSON with error message
     *
     * @param $msg
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function _fail($msg) {

        $response = ['success' => false, 'error'];
        return Response::json($response);

    }

    /**
     * Add success as a param and return as JSON
     *
     * @param $params (optional)
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function _succeed($params = []) {

        $params['success'] = true;
        return Response::json($params);

    }

}