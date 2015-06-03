<?php

namespace LRVM\Domain\Video;

use LRVM\Core\EloquentRepository;
use LRVM\Domain\Category\Category;
use LRVM\Domain\Video\Video;

class EloquentVideoRepository extends EloquentRepository implements VideoRepository {

    /**
     * Inject Video class
     * @param Video $video
     */
    public function __constructor(Video $video) {

        $this->model = $video;

    }

    /**
     * Update categories on a video
     *
     * @param int $video
     * @param array <int> $categories
     */
    public function saveCategories($iVideo, $categories) {

        $oVideo = $this->find($iVideo);
        $oVideo->categories()->detach();
        foreach ($categories as $iCat)
            $oVideo->categories()->attach($iCat);

        $oVideo->save();

    }
}