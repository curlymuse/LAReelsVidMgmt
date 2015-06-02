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

Route::get('/', [
  'as'      => 'videos.index',
  'uses'    =>'VideoController@index',
]);
Route::get('/new', [
    'as'      => 'videos.create',
    'uses'    =>'VideoController@create',
]);
Route::post('/new', [
    'as'      => 'videos.store',
    'uses'    =>'VideoController@store',
]);
