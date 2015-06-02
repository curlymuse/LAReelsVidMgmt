<?php

namespace LRVM\Core;

abstract class EloquentRepository {

    /**
     * Model object
     *
     * @var Eloquent
     */
    protected $model;

    /**
     * Constructor: Inject Eloquent Model
     *
     * @param Eloquent $model
     */
    public function __construct($model) {

        $this->model = $model;

    }

    /**
     * Get all of a resource
     *
     * @return array<Object>
     */
    public function all() {

        return $this->model->all();

    }

}

?>