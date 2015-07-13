<?php

namespace LRVM\Domain\PodcastHit;

use Eloquent;

class PodcastHit extends Eloquent {

    /**
     * Table used
     *
     * @var string
     */
    protected $table = 'lrvm_podcast_hits';

    /**
     * Which fields can be filled
     *
     * @var array
     */
    protected $fillable = [
        'podcast_id', 'ip', 'source'
    ];

    /**
     * Hit has a podcast
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function podcast() {

        return $this->belongsTo(\LRVM\Domain\Podcast\Podcast::class);

    }

}