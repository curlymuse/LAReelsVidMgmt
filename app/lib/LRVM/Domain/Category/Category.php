<?php

namespace LRVM\Domain\Category;

use Eloquent;

class Category extends Eloquent {

    /**
     * @var string
     */
    protected $table = 'lrvm_categories';

    /**
     * @var boolean
     */
    public $timestamps = false;

	protected $fillable = [];

    /**
     * Category has many videos
     */
    public function videos() {

        return $this->belongsToMany('lrvm_videos_categories', 'category_id');

    }

}