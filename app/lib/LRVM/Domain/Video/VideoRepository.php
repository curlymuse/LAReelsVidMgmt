<?php

namespace LRVM\Domain\Video;

interface VideoRepository {

    /**
     * Update categories on a video
     *
     * @param int $iVideo
     * @param array<int> $categories
     */
    public function saveCategories($iVideo, $categories);

    /**
     * Check if a video exists based on vimeo ID
     *
     * @param $id
     * @return boolean
     */
    public function vimeoIdExists($id);

    /**
     * Toggle the public/private status of a video
     *
     * @param int $id
     * @return boolean Current status
     */
    public function togglePublic($id);

    /**
     * Mark a video as synced
     *
     * @param $id
     * @return mixed
     */
    public function markSynced($id);

    /**
     * Link a Wordpress post to the video
     *
     * @param int $id Video ID
     * @param int $postId Post ID
     * @return bool
     */
    public function linkPost($id, $postId);

    /**
     * Reset the sync status and WordPress ID
     * for a single video
     *
     * @param int $id Video ID
     * @return bool
     */
    public function reset($id);

}

?>