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
Route::resource('ads','AdController');
Route::resource('products','ProductController');
Route::get('/registerseller', 'UserController@registerseller')->name('registerseller');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/category/{category}', 'HomeController@category')->name('home.category');
Route::get('/profile/{user_id}', 'UserController@profile')->name('user_profile');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/addtowishlist/{product}', 'ProductController@addtowishlist')->name('addtowishlist');

Route::post('/addtocart', 'OrderController@addtocart')->name('addtocart');
Route::get('/mycart', 'OrderController@mycart')->name('mycart');

Route::post('/place_order', 'OrderController@place_order')->name('place_order');
Route::get('/my_orders', 'OrderController@my_orders')->name('my_orders');
Route::get('/customer_orders', 'OrderController@customer_orders')->name('customer_orders');

Route::get('/delivstat/{o_p_id}/{stat}', 'OrderController@delivstat')->name('delivstat');
Route::post('/dstat/{ordered_product_id}', 'OrderController@dstat')->name('dstat');