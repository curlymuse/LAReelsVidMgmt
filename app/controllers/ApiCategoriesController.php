<?php

use LRVM\Core\ApiController;
use LRVM\Domain\Category\CategoryRepository;

class ApiCategoriesController extends ApiController {


    /**
     * Category Repository
     *
     * @var CategoryRepository
     */
    protected $rCat;

    /**
     * @param CategoryRepository $rCat
     */
    public function __construct(CategoryRepository $rCat) {

       $this->rCat = $rCat;

    }

	/**
	 * Display a listing of the resource.
	 * GET /apicategories
	 *
	 * @return Response
	 */
	public function index() {

        $categories = $this->rCat->presentAll();

        $response = ['categories' => $categories];

        return $this->_succeed($response);

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /apicategories/create
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /apicategories
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /apicategories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {

        $cat = $this->rCat->find($id);

        $response = ['category' => $cat];
        return $this->_succeed($response);

	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /apicategories/{id}/edit
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
	 * PUT /apicategories/{id}
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
	 * DELETE /apicategories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}