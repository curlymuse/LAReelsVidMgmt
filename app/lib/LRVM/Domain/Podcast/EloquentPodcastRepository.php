<?php

namespace LRVM\Domain\Podcast;

use LRVM\Core\EloquentRepository;
use LRVM\Domain\PodcastHit\PodcastHit;

class EloquentPodcastRepository extends EloquentRepository implements PodcastRepository {

    /**
     * Inject model class
     *
     * @param Podcast $podcast
     */
    public function __construct(Podcast $podcast) {

        $this->model = $podcast;

    }

    /**
     * Toggle published status of a podcast
     *
     * @param $id
     * @return boolean
     */
    public function togglePublished($id) {

        $podcast = $this->find($id);
        $podcast->is_published = !$podcast->is_published;
        $podcast->save();

        return $podcast->is_published;

    }


    /**
     * Get all published podcasts
     *
     * @return mixed
     */
    public function allPublished() {

        return $this->model
            ->where('is_published', true)
            ->orderBy('episode_number', 'desc')
            ->get();

    }

    /**
     * Link a WP post to podcast
     *
     * @param $id
     * @param $postId
     * @return mixed
     */
    public function linkPost($id, $postId) {

        $podcast = $this->find($id);
        $podcast->wordpress_post_id = $postId;
        return $podcast->save();

    }

    /**
     * Mark this podcast synced
     *
     * @param $id
     * @return boolean
     */
    public function markSynced($id) {

        $podcast = $this->find($id);
        $podcast->synced_at = date('Y-m-d H:i:s');
        return $podcast->save();

    }

    /**
     * Log the IP of the downloader
     *
     * @param $podcastId
     * @param $ip
     * @return mixed
     */
    public function logHit($podcastId, $ip) {

        $hit = new PodcastHit([
            'ip'    => $ip
        ]);
        $this->find($podcastId)->hits()->save($hit);

    }
}

