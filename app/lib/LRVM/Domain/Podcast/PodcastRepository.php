<?php

namespace LRVM\Domain\Podcast;

interface PodcastRepository {

    /**
     * Get all published podcasts
     *
     * @return mixed
     */
    public function allPublished();

    /**
     * Toggle published status of a podcast
     *
     * @param $id
     * @return boolean
     */
    public function togglePublished($id);

    /**
     * Mark this podcast synced
     *
     * @param $id
     * @return boolean
     */
    public function markSynced($id);

    /**
     * Link a WP post to podcast
     *
     * @param $id
     * @param $postId
     * @return mixed
     */
    public function linkPost($id, $postId);

    /**
     * Log the IP of the downloader
     *
     * @param $podcastId
     * @param $source
     * @param $ip
     * @return mixed
     */
    public function logHit($podcastId, $source, $ip);

}