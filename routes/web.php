<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/indexAdmin', 'AdminController@index')->name('indexAdmin');

// Vidéo
Route::post('/²Create', 'VideoController@create')->name('videoCreate');
Route::post('/videoEdit', 'VideoController@edit')->name('videoEdit');
Route::get('/videoList', 'VideoController@getAll')->name('videoList');
Route::post('/videoSingle', 'VideoController@getSingle')->name('videoSingle');
Route::post('/videoDelete', 'VideoController@delete')->name('videoDelete');

// Collections
Route::post('/collectionCreate', 'CollectionController@create')->name('collectionCreate');
Route::post('/collectionEdit', 'CollectionController@edit')->name('collectionEdit');
Route::get('/collectionList', 'CollectionController@getAll')->name('collectionList');
Route::post('/collectionSingle', 'CollectionController@getSingle')->name('collectionSingle');
Route::post('/collectionDelete', 'CollectionController@delete')->name('collectionDelete');
Route::post('/collectiongetPhotos', 'CollectionController@getPhotos')->name('collectiongetPhotos');

// Photos
Route::post('/photoCreate', 'PhotoController@create')->name('photoCreate');
Route::post('/photoEdit', 'PhotoController@edit')->name('photoEdit');
Route::get('/photoList', 'PhotoController@getAll')->name('photoList');
Route::post('/photoSingle', 'PhotoController@getSingle')->name('photoSingle');
Route::post('/photoDelete', 'PhotoController@delete')->name('photoDelete');

// Dessins
Route::post('/dessinCreate', 'DessinController@create')->name('dessinCreate');
Route::post('/dessinEdit', 'DessinController@edit')->name('dessinEdit');
Route::get('/dessinList', 'DessinController@getAll')->name('dessinList');
Route::post('/dessinSingle', 'DessinController@getSingle')->name('dessinSingle');
Route::post('/dessinDelete', 'DessinController@delete')->name('dessinDelete');
