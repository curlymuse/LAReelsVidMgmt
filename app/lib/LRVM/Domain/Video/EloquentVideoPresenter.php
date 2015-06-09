<?php

namespace LRVM\Domain\Video;

class EloquentVideoPresenter extends EloquentVideoRepository {

    public function allActiveWithCategories() {

        $raw = $this->model->whereIsPublic(true)->with('categories')->get();
        $return = [];

        foreach ($raw as $obj) {
            $row = [
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