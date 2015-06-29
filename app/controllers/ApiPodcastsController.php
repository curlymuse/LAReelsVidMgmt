<?php

use LRVM\Core\ApiController;
use LRVM\Domain\Podcast\PodcastRepository;

class ApiPodcastsController extends ApiController {

    /**
     * @var PodcastRepository
     */
    protected $rPodcast;

    /**
     * @param PodcastRepository $rPodcast
     */
    public function __construct(PodcastRepository $rPodcast) {

        $this->rPodcast = $rPodcast;

    }

    public function index() {

        $podcasts = $this->rPodcast->presentAll();

        return $this->_succeed($podcasts);

    }

}