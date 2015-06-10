<?php

namespace LRVM\Domain\Category;

class EloquentCategoryPresenter extends EloquentCategoryRepository {

    /**
     * Return JSON formatted array of all categories
     *
     * @return Mixed
     */
    public function presentAll() {

        return $this->all();

    }

}