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
     * Find by Vimeo ID
     *
     * @param int $vimeoId
     * @return Video
     */
    public function findByVimeoId($vimeoId) {

        return $this->model->where('vimeo_id', $vimeoId)->first();

    }

    /**
     * Update thumbnail
     *
     * @param int $id
     * @param string $thumbnail
     * @param string $main
     * @return boolean
     */
    public function updateImages($id, $thumbnail, $main) {

        $video = $this->find($id);
        $video->thumbnail_url = $thumbnail;
        $video->main_image_url = $main;
        $video->save();

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

    /**
     * Reset the sync status and WordPress ID
     * for all videos
     *
     * @return bool
     */
    public function resetAll() {

        $this->model->whereNotNull('wordpress_post_id')->update([
            'synced_at'     => NULL,
            'wordpress_post_id' => NULL
        ]);

    }

    /**
     * Mark an array of videos as synced, and associate
     * WP ID
     *
     * @param array <int,int> $toSync
     * @return mixed
     */
    public function batchMarkSynced($toSync) {

        foreach ($toSync as $id => $postId) {
            $this->markSynced($id);
            $this->linkPost($id, $postId);
        }

    }
}