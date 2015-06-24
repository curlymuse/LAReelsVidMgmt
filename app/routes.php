<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

require_once(app_path() . '/test-routes.php');

//  All routes with ID require integer value
Route::pattern('id', '[0-9]+');


Route::get('/logout', ['as' => 'logout', function(){
    Auth::logout();
    return Redirect::route('login.show');
}]);
Route::get('/', function(){
    $rte = (Auth::check()) ? 'videos.index' : 'login.show';
    return Redirect::route($rte);
});

Route::group(['prefix' => 'auth'], function() {
    Route::get('/', [
        'as' => 'login.show',
        'uses' => 'AuthController@create'
    ]);
    Route::post('/', [
        'as' => 'login.submit',
        'uses' => 'AuthController@store'
    ]);
});

Route::group(['prefix' => 'api'], function(){

    Route::group(['before' => 'api.auth'], function() {
        Route::post('/all', [
            'as' => 'api.videos.all',
            'uses' => 'ApiVideosController@index',
        ]);
        Route::post('/unsynced', [
            'as' => 'api.videos.allUnsynced',
            'uses' => 'ApiVideosController@unsyncedIndex',
        ]);
        Route::post('/{id}/get', [
            'as' => 'api.videos.get',
            'uses' => 'ApiVideosController@show',
        ]);
        Route::post('{id}/marksynced', [
            'as' => 'api.videos.marksynced',
            'uses' => 'ApiVideosController@update',
        ]);
        Route::post('batchmarksynced', [
            'as' => 'api.videos.batchmarksynced',
            'uses' => 'ApiVideosController@updateAll',
        ]);
        Route::post('{id}/linkpost/{postId}', [
            'as' => 'api.videos.linkpost',
            'uses' => 'ApiVideosController@store',
        ]);
        Route::post('{id}/reset', [
            'as' => 'api.videos.resetOne',
            'uses' => 'ApiVideosController@destroy',
        ]);
        Route::post('all/reset', [
            'as' => 'api.videos.resetAll',
            'uses' => 'ApiVideosController@destroyAll',
        ]);
        Route::post('categories/pull', [
            'as' => 'api.categories.index',
            'uses' => 'ApiCategoriesController@index',
        ]);
        Route::post('categories/{id}/get', [
            'as' => 'api.categories.show',
            'uses' => 'ApiCategoriesController@show',
        ]);
        Route::post('categories/{id}/sync/{wpId}', [
            'as' => 'api.categories.update',
            'uses' => 'ApiCategoriesController@update',
        ]);
    });

});

Route::group(['prefix' => 'podcasts', 'before' => 'auth'], function(){
    Route::get('/', [
        'as' => 'podcasts.index',
        'uses' => 'PodcastController@index',
    ]);
    Route::get('/{id}/get', [
        'as' => 'podcasts.show',
        'uses' => 'PodcastController@show',
    ]);
    Route::get('/new', [
        'as' => 'podcasts.create',
        'uses' => 'PodcastController@create',
    ]);
    Route::post('/new', [
        'as' => 'podcasts.store',
        'uses' => 'PodcastController@store',
    ]);
    Route::get('/feed', [
        'as' => 'podcasts.feed',
        'uses' => 'PodcastController@feed',
    ]);
});

Route::group(['prefix' => 'lrvm', 'before' => 'auth'], function() {
    Route::get('/', [
        'as' => 'videos.index',
        'uses' => 'VideoController@index',
    ]);
    Route::post('/updatepublic', [
        'as'    => 'videos.updatePublic',
        'uses' => 'VideoController@update',
    ]);
    Route::post('/categories', [
        'as' => 'categories.update',
        'uses' => 'CategoryController@update'
    ]);
});
