<?php

namespace LRVM\Providers;

use Illuminate\Support\ServiceProvider;
use LRVM\Domain\Video\EloquentVideoPresenter;
use LRVM\Domain\Category\EloquentCategoryRepository;
use LRVM\Domain\Video\Video;
use LRVM\Domain\Category\Category;

class RepositoryServiceProvider extends ServiceProvider {

  public function register() {

      $this->app->bind('LRVM\Domain\Video\VideoRepository', function($app){
        return new EloquentVideoPresenter(new Video);
      });
      $this->app->bind('LRVM\Domain\Category\CategoryRepository', function($app){
          return new EloquentCategoryRepository(new Category);
      });

  }

}

?>
