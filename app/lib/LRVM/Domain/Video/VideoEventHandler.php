<?php

namespace LRVM\Domain\Video;

use Log;

class VideoEventHandler {

    /**
     * Fired when Video is edited in a way that requires a WP sync
     *
     * @param Video $video
     */
    public function onTouched($video) {

        $video->synced_at = NULL;
        $video->save();

    }

    /**
     * Subscribe methods
     *
     * @param $events
     */
    public function subscribe($events) {

        $events->listen('video.touched', 'LRVM\Domain\Video\VideoEventHandler@onTouched');

    }


}