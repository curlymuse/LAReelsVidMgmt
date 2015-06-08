<?php

namespace LRVM\Domain\Category;

use LRVM\Core\EloquentRepository;
use LRVM\Domain\Category\Category;

class EloquentCategoryRepository extends EloquentRepository implements CategoryRepository {

    /**
     * Inject Video class
     * @param Category $category
     */
    public function __constructor(Category $category) {

        $this->model = $category;

    }

    /**
     * Get all primary categories
     *
     * @return mixed
     */
    function allPrimary() {

       return $this->model->whereIsPrimary(true)->get();

    }

    /**
     * Get all genre categories
     *
     * @return mixed
     */
    function allGenres() {

        return $this->model->whereIsPrimary(false)->get();

    }
}