<?php

Route::group(['prefix' => 'api'], function() {
    if (App::environment() == 'local') {
        Route::get('/all', [
            'as' => 'api.videos.all',
            'uses' => 'ApiVideosController@index',
        ]);
        Route::get('/unsynced', [
            'as' => 'api.videos.allUnsynced',
            'uses' => 'ApiVideosController@unsyncedIndex',
        ]);
        Route::get('/{id}/get', [
            'as' => 'api.videos.get',
            'uses' => 'ApiVideosController@show',
        ]);
        Route::get('{id}/marksynced', [
            'as' => 'api.videos.marksynced',
            'uses' => 'ApiVideosController@update',
        ]);
        Route::get('batchmarksynced', [
            'as' => 'api.videos.batchmarksynced',
            'uses' => 'ApiVideosController@updateAll',
        ]);
        Route::get('{id}/linkpost/{postId}', [
            'as' => 'api.videos.linkpost',
            'uses' => 'ApiVideosController@store',
        ]);
        Route::get('{id}/reset', [
            'as' => 'api.videos.resetOne',
            'uses' => 'ApiVideosController@destroy',
        ]);
        Route::get('all/reset', [
            'as' => 'api.videos.resetAll',
            'uses' => 'ApiVideosController@destroyAll',
        ]);
        Route::get('categories/pull', [
            'as' => 'api.categories.index',
            'uses' => 'ApiCategoriesController@index',
        ]);
        Route::get('categories/{id}/get', [
            'as' => 'api.categories.show',
            'uses' => 'ApiCategoriesController@show',
        ]);
        Route::get('categories/{id}/sync/{wpId}', [
            'as' => 'api.categories.update',
            'uses' => 'ApiCategoriesController@update',
        ]);






        Route::get('/podcasts/all', [
            'as' => 'api.podcasts.all',
            'uses' => 'ApiPodcastsController@index',
        ]);
        Route::get('/podcasts/{id}/get', [
            'as' => 'api.podcasts.get',
            'uses' => 'ApiPodcastsController@show',
        ]);
        Route::get('/podcasts/{id}/marksynced', [
            'as' => 'api.podcasts.marksynced',
            'uses' => 'ApiPodcastsController@store',
        ]);
        Route::get('/podcasts/{id}/linkpost/{postId}', [
            'as' => 'api.podcasts.linkPost',
            'uses' => 'ApiPodcastsController@update',
        ]);














    }
});

