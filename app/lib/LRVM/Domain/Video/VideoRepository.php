<?php

namespace LRVM\Domain\Video;

interface VideoRepository {

    /**
     * Update categories on a video
     *
     * @param int $iVideo
     * @param array<int> $categories
     */
    public function saveCategories($iVideo, $categories);

}

?>