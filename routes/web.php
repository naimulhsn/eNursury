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
    //return view('welcome');
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/category/{category}', 'HomeController@category')->name('home.category');
Route::get('/profile/{user_id}', 'UserController@profile')->name('user_profile');
Route::get('/about', 'HomeController@about')->name('about');

Route::resource('ads','AdController');
