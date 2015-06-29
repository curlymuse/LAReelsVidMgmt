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

    /**
     * Return index of all podcasts
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index() {

        $podcasts = $this->rPodcast->presentAll();

        $data = [
            'podcasts' => $podcasts
        ];

        return $this->_succeed($data);

    }

    public function update($id, $postId) {

        $this->rPodcast->linkPost($id, $postId);
        return $this->_succeed();

    }

}