<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>['auth']], function(){

    Route::get('/upload', 'VideoUploadController@index');
    Route::post('/upload', 'VideoUploadController@store');

    Route::post('/videos', 'VideoController@store');
    Route::put('/videos/{video}', 'VideoController@update')->name('video_update');

    Route::get('/channel/{channel}/edit','ChannelSettingsController@edit')->name('channel.edit');
    Route::put('/channel/{channel}/edit','ChannelSettingsController@update')->name('channel.update');
});
