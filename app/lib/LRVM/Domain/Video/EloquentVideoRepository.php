<?php

namespace LRVM\Domain\Video;

use LRVM\Core\EloquentRepository;
use Video;

class EloquentVideoRepository extends EloquentRepository implements VideoRepository {

    /**
     * Inject Video class
     * @param Video $video
     */
    public function __constructor(Video $video) {

        $this->model = $video;

    }

}