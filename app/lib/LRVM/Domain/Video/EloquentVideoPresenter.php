<?php

namespace LRVM\Domain\Video;

class EloquentVideoPresenter extends EloquentVideoRepository {

    public function allActiveWithCategories() {

        $raw = $this->model->whereIsPublic(true)->with('categories')->get();
        $return = [];

        foreach ($raw as $obj) {
            $row = [
                'id'    => $obj->id,
                'is_public' => $obj->is_public,
                'is_ingested' => $obj->is_ingested,
                'vimeo_id' => $obj->vimeo_id,
                'title' => $obj->title,
                'link'  => sprintf('https://vimeo.com/%s', $obj->vimeo_id),
                'categories' => []
            ];
            foreach ($obj->categories as $cat)
                $row['categories'][] = $cat->title;
            $return[] = $row;
        }

        return $return;

    }

}

?>