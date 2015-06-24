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

}