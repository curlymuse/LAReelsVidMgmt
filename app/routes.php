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


Route::group(['prefix' => 'lrvm'], function() {
    Route::get('/', [
        'as' => 'videos.index',
        'uses' => 'VideoController@index',
    ]);
    Route::get('/new', [
        'as' => 'videos.create',
        'uses' => 'VideoController@create',
    ]);
    Route::post('/new', [
        'as' => 'videos.store',
        'uses' => 'VideoController@store',
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
