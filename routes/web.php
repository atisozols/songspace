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

Route::get('/', 'HomeController@index');

Route::get('/top', 'TopController@index');

Route::get('/song/create', 'SongController@create');

Route::post('/song', 'SongController@store');

Route::post('/library', 'LibraryController@store');

Route::get('/library/create', 'LibraryController@create');

Route::get('/song/{song}', 'SongController@show');

Route::get('/library/{library}', 'LibraryController@show');



Auth::routes();

