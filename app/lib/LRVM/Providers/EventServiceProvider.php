<?php

namespace LRVM\Providers;

use Illuminate\Support\ServiceProvider;
use LRVM\Domain\Category\EloquentCategoryPresenter;
use LRVM\Domain\Podcast\EloquentPodcastPresenter;
use LRVM\Domain\Podcast\EloquentPodcastRepository;
use LRVM\Domain\Podcast\Podcast;
use LRVM\Domain\Podcast\PodcastEventHandler;
use LRVM\Domain\Video\EloquentVideoPresenter;
use LRVM\Domain\Video\Video;
use LRVM\Domain\Category\Category;

class EventServiceProvider extends ServiceProvider {

  public function register() {

      $this->app->bind(\LRVM\Domain\Podcast\PodcastEventHandler::class, function($app){
        return new PodcastEventHandler($app->make(\LRVM\Domain\Podcast\PodcastRepository::class));
      });

  }

}

?>
