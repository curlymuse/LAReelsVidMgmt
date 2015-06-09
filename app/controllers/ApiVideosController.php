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

        $videos = $this->rVideo->all();

        $response = ['videos' => $videos];
        return Response::json($response);

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
	public function show($id)
	{
		//
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
	public function update($id)
	{
		//
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

}