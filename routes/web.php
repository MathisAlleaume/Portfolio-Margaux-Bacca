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
Route::post('/videoCreate', 'VideoController@create')->name('videoCreate');
Route::get('/videoList', 'VideoController@getALl')->name('videoList');
Route::post('/videoSingle', 'VideoController@getSingle')->name('videoSingle');
