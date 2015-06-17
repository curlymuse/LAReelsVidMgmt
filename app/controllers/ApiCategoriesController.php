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
     * Link the WP category in the database
     *
     * @param int $id
     * @param int $wpId
     * @return Response
     */
	public function update($id, $wpId) {

        $this->rCat->linkWPCategory($id, $wpId);
        return $this->_succeed();

	}

}