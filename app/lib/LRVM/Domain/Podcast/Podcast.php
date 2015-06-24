<?php

namespace LRVM\Domain\Podcast;

use Eloquent;
use LRVM\Domain\Video\Video;
use URL;

class Podcast extends Eloquent {

    /**
     * @var string
     */
    protected $table = 'lrvm_podcasts';

	protected $fillable = [
        'title', 'description', 'episode_number',
        'filename',
    ];

    public function getLinkToFile() {

        return URL::route('podcasts.show', $this->id);

    }

}