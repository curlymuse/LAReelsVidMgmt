<?php

namespace LRVM\Domain\Podcast;

interface PodcastRepository {

    /**
     * Toggle published status of a podcast
     *
     * @param $id
     * @return boolean
     */
    public function togglePublished($id);

}