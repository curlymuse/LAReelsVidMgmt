<?php

/*
|--------------------------------------------------------------------------
| Register The Artisan Commands
|--------------------------------------------------------------------------
|
| Each available Artisan command must be registered with the console so
| that it is available to be called. We'll register every command so
| the console gets access to each of the command object instances.
|
*/

Artisan::add(new FetchVimeoAll(App::make('LRVM\Domain\Video\VideoRepository')));
Artisan::add(new VimeoRefreshThumbnails(App::make('LRVM\Domain\Video\VideoRepository')));
Artisan::add(new VimeoUpdate(App::make('LRVM\Domain\Video\VideoRepository')));

