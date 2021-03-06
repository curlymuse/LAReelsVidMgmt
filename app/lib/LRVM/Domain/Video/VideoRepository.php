<?php

namespace LRVM\Domain\Video;

interface VideoRepository {

    /**
     * Find by Vimeo ID
     *
     * @param int $vimeoId
     * @return Video
     */
    public function findByVimeoId($vimeoId);

    /**
     * Update categories on a video
     *
     * @param int $iVideo
     * @param array<int> $categories
     */
    public function saveCategories($iVideo, $categories);

    /**
     * Update thumbnail
     *
     * @param int $id
     * @param string $thumbnail
     * @param string $main
     * @return boolean
     */
    public function updateImages($id, $thumbnail, $main);

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
     * Mark an array of videos as synced, and associate
     * WP ID
     *
     * @param array<int,int> $toSync
     * @return mixed
     */
    public function batchMarkSynced($toSync);

    /**
     * Link a Wordpress post to the video
     *
     * @param int $id Video ID
     * @param int $postId Post ID
     * @return bool
     */
    public function linkPost($id, $postId);

    /**
     * Update basic meta info (meant to be done automatically
     * from Vimeo Fetch)
     *
     * @param int $id Video ID
     * @param array $data
     * @return boolean
     */
    public function update($id, $data);

    /**
     * Reset the sync status and WordPress ID
     * for a single video
     *
     * @param int $id Video ID
     * @return bool
     */
    public function reset($id);

    /**
     * Reset the sync status and WordPress ID
     * for all videos
     *
     * @return bool
     */
    public function resetAll();

}

?>