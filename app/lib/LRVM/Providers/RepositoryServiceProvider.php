<?php

namespace LRVM\Providers;

use Illuminate\Support\ServiceProvider;
use LRVM\Domain\Video\EloquentVideoRepository;
use LRVM\Domain\Video\Video;

class RepositoryServiceProvider extends ServiceProvider {

  public function register() {

    $this->app->bind('LRVM\Domain\Video\VideoRepository', function($app){
      return new EloquentVideoRepository(new Video);
    });
      /**
    $this->app->bind(
      'UThrive\Storage\Support\Statistics',
      'UThrive\Storage\Support\EloquentStatisticsPresenter'
    );
       */

  }

}

?>
