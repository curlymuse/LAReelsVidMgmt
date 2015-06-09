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
     * Paginated results
     *
     * @param int $paginate
     * @return mixed
     */
    public function allPaginate($paginate) {

        return $this->model->paginate($paginate);

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

    /**
     * Check if a video exists based on vimeo ID
     *
     * @param $id
     * @return boolean
     */
    public function vimeoIdExists($id) {

        return $this->has('vimeo_id', $id);

    }

    /**
     * Toggle the public/private status of a video
     *
     * @param int $id
     * @return boolean New status
     */
    public function togglePublic($id) {

        $video = $this->find($id);
        $video->is_public = !$video->is_public;
        $video->save();

        return $video->is_public;

    }
}