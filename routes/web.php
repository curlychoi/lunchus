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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/restaurants', 'RestaurantController@index')->name('restaurants');
    Route::get('/restaurants/write', 'RestaurantController@create')->name('restaurant_register');
    Route::post('/restaurants', 'RestaurantController@store');
    Route::get('/restaurants/{restaurant}', 'RestaurantController@show')->name('restaurant_show');
    Route::get('/restaurants/{restaurant}/edit', 'RestaurantController@edit')->name('restaurant_edit');
    Route::post('/restaurants/{restaurant}', 'RestaurantController@update')->name('restaurant_update');
    Route::delete('/restaurants/{restaurant}', 'RestaurantController@destroy')->name('restaurant_destroy');
    Route::get('/restaurants/{restaurant}/lunch', 'RestaurantController@toLunch')->name('to_lunch');

    Route::get('/lunch', 'LunchController@index')->name('lunch_home');
});

