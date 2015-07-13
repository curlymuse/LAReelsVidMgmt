<?php

namespace LRVM\Domain\PodcastHit;

use Eloquent;

class PodcastHit extends Eloquent {

    protected $table = 'lrvm_podcast_hits';

    protected $fillable = [
        'podcast_id', 'ip', 'source'
    ];

    public function podcast() {

        return $this->belongsTo(\LRVM\Domain\Podcast\Podcast::class);

    }

}