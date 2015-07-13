<?php

namespace LRVM\Domain\Podcast;

use Log;
use Request;

class PodcastEventHandler {
    /**
     * @var PodcastRepository
     */
    private $rPodcast;

    /**
     * @param PodcastRepository $rPodcast
     */
    public function __construct(PodcastRepository $rPodcast) {

        $this->rPodcast = $rPodcast;

    }

    /**
     * Fired when podcast is requested from the server
     *
     * @param Podcast $podcast
     */
    public function onRequested($podcast, $source) {

        $this->rPodcast->logHit($podcast->id, $source, Request::ip());

    }

    /**
     * Subscribe methods
     *
     * @param $events
     */
    public function subscribe($events) {

        $events->listen('podcast.requested', 'LRVM\Domain\Podcast\PodcastEventHandler@onRequested');

    }


}