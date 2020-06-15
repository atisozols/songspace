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

Route::get('/', function(){
    if(Auth::check()){
        return redirect('/home');
    }
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->middleware('auth');

Route::get('/top', 'TopController@index');

Route::get('/song/create', 'SongController@create')->middleware('auth');

Route::post('/song', 'SongController@store')->middleware('auth');

Route::post('/library', 'LibraryController@store')->middleware('auth');

Route::get('/library/create', 'LibraryController@create')->middleware('auth');

Route::get('/song/{song}', 'SongController@show');

Route::get('/library/{library}', 'LibraryController@show');



Auth::routes();

