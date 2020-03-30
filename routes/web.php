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
    return redirect(route('restaurants'));
});

Auth::routes(['verify' => true]);

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/restaurants', 'RestaurantController@index')->name('restaurants');
Route::get('/lunch', 'LunchController@index')->name('lunch_home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/restaurants/write', 'RestaurantController@create')->name('restaurant_register');
    Route::post('/restaurants', 'RestaurantController@store');
    Route::get('/restaurants/{restaurant}', 'RestaurantController@show')->name('restaurant_show');
    Route::get('/restaurants/{restaurant}/edit', 'RestaurantController@edit')->name('restaurant_edit');
    Route::post('/restaurants/{restaurant}', 'RestaurantController@update')->name('restaurant_update');
    Route::delete('/restaurants/{restaurant}', 'RestaurantController@destroy')->name('restaurant_destroy');
    Route::get('/restaurants/{restaurant}/lunch', 'RestaurantController@toLunch')->name('to_lunch');

    Route::post('/restaurants/{restaurant}/comments', 'CommentController@store')->name('comments');
    Route::patch('/restaurants/{restaurant}/comments/{comment}', 'CommentController@update')->name('comments_update');
    Route::delete('/restaurants/{restaurant}/comments/{comment}', 'CommentController@delete')
        ->name('comments_delete')->middleware('can:delete,comment');
    Route::get('/restaurants/{restaurant}/comments/{comment}', 'CommentController@edit')
        ->name('comments_edit')->middleware('can:update,comment');

    Route::get('/lunch/{lunch}', 'LunchController@join')->name('lunch_join');
    Route::get('/lunch/user/delete', 'LunchController@userDelete')->name('lunch_user_delete');
    Route::delete('/lunch/{lunch}', 'LunchController@destroy')->name('lunch_delete')
        ->middleware('can:delete,lunch');
});

