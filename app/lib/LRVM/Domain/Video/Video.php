<?php

namespace LRVM\Domain\Video;

use Eloquent;

class Video extends Eloquent {

    /**
     * @var string Table
     */
    protected $table = 'lrvm_videos';

	protected $fillable = ['title', 'vimeo_id', 'description'];

    /**
     * Format Vimeo Link from ID
     *
     * @return string
     */
    public function getLink() {

        return sprintf('https://vimeo.com/%d', $this->vimeo_id);

    }

}
