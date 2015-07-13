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

    /**
     * Podcast has many hits
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hits() {

        return $this->hasMany(\LRVM\Domain\PodcastHit\PodcastHit::class);

    }

    /**
     * Get link to file that goes through LRVM.
     * Includes passing the source of the click
     *
     * @param string $source
     * @return string
     */
    public function getLinkToFile($source = 'website') {

        return URL::route('podcasts.show', [$source, $this->id]);

    }

    /**
     * Get the direct link to Amazon
     * This should not be used generally, as it skips the
     * gateway which logs the IP and download
     *
     * @return string
     */
    public function getS3Link() {

        return sprintf('%s/%s/%s', Config::get('lrvm.s3_gateway'), Config::get('lrvm.s3_podcast_bucket'), $this->filename);

    }

    /**
     * Is this published or not?
     *
     * @return string
     */
    public function getPublishedStatus() {

        return ($this->is_published) ? 'Published' : 'Unpublished';

    }

    /**
     * Get total number of downloads, including
     * duplicate IPs
     *
     * @return int
     */
    public function getTotalHits() {

        return $this->hits()->count();

    }

    /**
     * Get the number of unique IPs on this podcast
     *
     * @return int
     */
    public function getUniqueHits() {

        return $this->hits()->distinct('ip')->count('ip');

    }

    /**
     * Get length of file, or whatever
     *
     * @return int
     */
    public function getLength() {

        return 1;

    }

}