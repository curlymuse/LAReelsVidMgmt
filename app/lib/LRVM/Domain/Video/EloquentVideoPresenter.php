<?php

namespace LRVM\Domain\Video;

class EloquentVideoPresenter extends EloquentVideoRepository {

    /**
     * Return all active videos, including categories,
     * formatted for use in exterior application (JSON)
     *
     * @return array
     */
    public function allActiveWithCategories() {

        $raw = $this->model->with('categories')->get();
        $return = [];

        foreach ($raw as $obj)
            $return[] = $this->present($obj);

        return $return;

    }

    /**
     * Return a JSON representation of the video, including
     * categories
     *
     * @param $video
     * @return array
     */
    public function present($video) {

        $return = [
            'id'    => $video->id,
            'is_public' => $video->is_public,
            'is_synced' => $video->is_synced,
            'status'    => $video->getStatus(),
            'vimeo_id' => $video->vimeo_id,
            'title' => $video->title,
            'link'  => sprintf('https://vimeo.com/%s', $video->vimeo_id),
            'categories' => []
        ];
        foreach ($video->categories as $cat)
            $return['categories'][] = $cat->title;

        return $return;

    }



}

?>