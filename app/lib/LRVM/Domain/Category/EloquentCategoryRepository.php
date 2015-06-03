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

}