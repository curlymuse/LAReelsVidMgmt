<?php

namespace LRVM\Domain\Video;

use Eloquent;
use LRVM\Domain\Category\Category;

class Video extends Eloquent {

    /**
     * @var string Table
     */
    protected $table = 'lrvm_videos';

	protected $fillable = ['title', 'vimeo_id', 'description', 'thumbnail_url'];

    /**
     * Format Vimeo Link from ID
     *
     * @return string
     */
    public function getLink() {

        return sprintf('https://vimeo.com/%d', $this->vimeo_id);

    }

    /**
     * Video has Many Categories
     */
    public function categories() {

        return $this->belongsToMany('LRVM\Domain\Category\Category', 'lrvm_videos_categories', 'video_id', 'category_id')
            ->withTimestamps();

    }

}
