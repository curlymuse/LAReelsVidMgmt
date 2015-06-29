<?php

namespace LRVM\Domain\Podcast;

use Config;
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
        'filename', 'duration', 'episode_image',
    ];

    public function getLinkToFile() {

        return sprintf('%s/%s/%s', Config::get('lrvm.s3_gateway'), Config::get('lrvm.s3_podcast_bucket'), $this->filename);
        return URL::route('podcasts.show', $this->id);

    }

    public function getPublishedStatus() {

        return ($this->is_published) ? 'Published' : 'Unpublished';

    }

    public function getLength() {

        return 1333334;
        $file = Config::get('lrvm.podcast_dir') . '/' .$this->filename;
        return filesize($file);

    }

}