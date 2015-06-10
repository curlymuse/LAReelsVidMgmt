<?php

namespace LRVM\Domain\Video;

use Event;
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

        Event::fire('video.touched', $oVideo);

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

        Event::fire('video.touched', $video);

        return $video->is_public;

    }

    /**
     * Mark a video as synced
     *
     * @param $id
     * @return mixed
     */
    public function markSynced($id) {

        $video = $this->find($id);
        $video->synced_at = date('Y-m-d H:i:s');
        return $video->save();

    }

    /**
     * Link a Wordpress post to the video
     *
     * @param int $id Video ID
     * @param int $postId Post ID
     * @return bool
     */
    public function linkPost($id, $postId) {

        $video = $this->find($id);
        $video->wordpress_post_id = $postId;
        return $video->save();

    }

    /**
     * Reset the sync status and WordPress ID
     * for a single video
     *
     * @param int $id Video ID
     * @return bool
     */
    public function reset($id) {

        $video = $this->find($id);
        $video->synced_at = NULL;
        $video->wordpress_post_id = NULL;
        return $video->save();

    }
}