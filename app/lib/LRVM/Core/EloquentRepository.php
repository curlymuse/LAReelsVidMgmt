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

    /**
     * Store a new resource
     *
     * @param array $input
     * @return Object
     */
    public function store(array $input) {

        return $this->model->create($input);

    }

    /**
     * Get a single object
     *
     * @param int $id
     * @return Object
     */
    public function find($id) {

        return $this->model->findOrFail($id);

    }

    /**
     * See if a record exists, given the primary key
     *
     * @param int $id
     * @return boolean
     */
    public function hasPK($id) {

        return (boolean)($this->model->where('id', $id)->count());

    }

    /**
     * See if a record exists, given a specific column value
     *
     * @param string $col
     * @param string @value
     * @return boolean
     */
    public function has($col, $value) {

        return (boolean)($this->model->where($col, $value)->count());

    }

}

?>