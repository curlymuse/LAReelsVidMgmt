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

    /**
     * Link category to WP equivalent
     *
     * @param $id
     * @param $wpId
     * @return mixed
     */
    function linkWPCategory($id, $wpId) {

        $cat = $this->find($id);
        $cat->wordpress_category_id = $wpId;
        $cat->save();

    }
}