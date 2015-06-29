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

    /**
     * Return JSON of a single podcast
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($id) {

        $obj = $this->rPodcast->find($id);
        $podcast =  $this->rPodcast->present($obj);

        return $this->_succeed(['podcast' => $podcast]);

    }

    /**
     * Mark this podcast synced
     *
     * @param $id
     */
    public function store($id) {

        $this->rPodcast->markSynced($id);
        return $this->_succeed();

    }

    /**
     * Link Podcast to WP post
     *
     * @param $id
     * @param $postId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update($id, $postId) {

        $this->rPodcast->linkPost($id, $postId);
        return $this->_succeed();

    }

}