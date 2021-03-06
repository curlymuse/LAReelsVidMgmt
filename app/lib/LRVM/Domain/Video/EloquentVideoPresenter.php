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
     * Return all unsynced videos, including categories,
     * formatted for use in exterior application (JSON)
     *
     * @return array
     */
    public function allUnsyncedWithCategories() {

        $raw = $this->model->whereNull('synced_at')->with('categories')->get();
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
            'synced_at' => $video->synced_at,
            'wordpress_post_id' => $video->wordpress_post_id,
            'status'    => $video->getStatus(),
            'vimeo_id' => $video->vimeo_id,
            'title' => $video->title,
            'thumbnail_url' => $video->thumbnail_url,
            'main_image_url' => $video->main_image_url,
            'link'  => sprintf('https://vimeo.com/%s', $video->vimeo_id),
            'unsynced_category' => false,
            'uploaded_at'   => $video->uploaded_at,
            'catIDs' => [],
            'categories' => [],
        ];
        foreach ($video->categories as $cat) {
            $return['categories'][] = $cat->title;
            if ($cat->wordpress_category_id)
                $return['catIDs'][] = $cat->wordpress_category_id;
            else
                $return['unsynced_category'] = true;
        }


        return $return;

    }



}

?>