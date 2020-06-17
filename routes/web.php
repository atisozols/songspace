<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/discover', 'DiscoverController@index');

Route::get('/song/create', 'SongController@create')->middleware('auth');

Route::post('/song', 'SongController@store')->middleware('auth');

Route::put('/song/{song}', 'SongController@update');

Route::delete('/song/{song}', 'SongController@destroy');

Route::delete('/library/{library}', 'LibraryController@destroy');

Route::post('/library', 'LibraryController@store')->middleware('auth');

Route::get('/library/create', 'LibraryController@create')->middleware('auth');

Route::get('/song/{song}', 'SongController@show');

Route::get('/user/{user}', 'UserController@show');

Route::get('/song/{song}/edit', 'SongController@edit')->middleware('auth');

Route::get('/library/{library}', 'LibraryController@show');

Route::resource('/admin/users', 'Admin\UsersController', ['except'=>['show','create','store']]);
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::resource('/users', 'UsersController', ['except'=>['show','create','store']]);
});


Auth::routes();

