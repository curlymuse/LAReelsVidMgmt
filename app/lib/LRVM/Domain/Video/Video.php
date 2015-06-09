<?php

namespace LRVM\Domain\Video;

use Eloquent;

use Event;
use LRVM\Domain\Category\Category;

class Video extends Eloquent {

    /**
     * @var string Table
     */
    protected $table = 'lrvm_videos';

	protected $fillable = ['title', 'vimeo_id', 'description', 'thumbnail_url'];

    /**
     * Register event observers
     */
    public static function boot() {

        parent::boot();

        Event::subscribe(new VideoEventHandler);

    }

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

    /**
     * Get string saying whether is published or not
     *
     * @return string
     */
    public function getPublicStatus() {

        return ($this->is_public) ? 'Public' : 'Private';

    }

    /**
     * Get status, based on combination of public and ingested
     *
     * @return string
     */
    public function getStatus() {

        if (!$this->wordpress_id)
            return 'Not Integrated';

        if (!$this->synced_at)
            return 'Pending Sync';

        return ($this->is_pubilc) ? 'Public' :'Unlisted';

    }

}
