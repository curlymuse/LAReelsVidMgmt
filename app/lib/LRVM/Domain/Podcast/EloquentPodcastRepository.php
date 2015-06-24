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

}

