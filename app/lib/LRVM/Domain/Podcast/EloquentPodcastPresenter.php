<?php

namespace LRVM\Domain\Podcast;

use LRVM\Core\EloquentRepository;

class EloquentPodcastPresenter extends EloquentPodcastRepository {

    /**
     * Return all podcasts in JSON form
     *
     * @return array
     */
    public function presentAll() {

        $return = [];
        foreach ($this->allPublished() as $podcast)
            $return[] = $this->present($podcast);

        return $return;

    }

    /**
     * Present a single podcast for JSON usage
     *
     * @param Podcast $podcast
     * @return string
     */
    public function present(Podcast $podcast) {

        $podcast->url = $podcast->getLinkToFile();
        return $podcast;

    }

}