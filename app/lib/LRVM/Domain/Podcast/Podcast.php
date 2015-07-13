<?php

namespace LRVM\Domain\Podcast;

use App;
use Config;
use Eloquent;
use LRVM\Domain\Video\Video;
use URL;
use Event;

class Podcast extends Eloquent {

    /**
     * @var string
     */
    protected $table = 'lrvm_podcasts';

	protected $fillable = [
        'title', 'description', 'episode_number',
        'filename', 'duration', 'episode_image',
    ];

    /**
     * Register event observers
     */
    public static function boot() {

        parent::boot();

        Event::subscribe(App::make(\LRVM\Domain\Podcast\PodcastEventHandler::class));

    }

    public function hits() {

        return $this->hasMany(\LRVM\Domain\PodcastHit\PodcastHit::class);

    }

    public function getLinkToFile($source = 'website') {

        return URL::route('podcasts.show', [$source, $this->id]);

    }

    public function getS3Link() {

        return sprintf('%s/%s/%s', Config::get('lrvm.s3_gateway'), Config::get('lrvm.s3_podcast_bucket'), $this->filename);

    }

    public function getPublishedStatus() {

        return ($this->is_published) ? 'Published' : 'Unpublished';

    }

    public function getTotalHits() {

        return $this->hits()->count();

    }

    public function getUniqueHits() {

        return $this->hits()->distinct('ip')->count('ip');

    }

    public function getLength() {

        $file = $this->getS3Link();
        return filesize($file);

    }

}