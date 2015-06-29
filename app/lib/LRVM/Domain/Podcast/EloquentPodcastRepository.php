<?php

namespace LRVM\Domain\Podcast;

use LRVM\Core\EloquentRepository;

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
}

