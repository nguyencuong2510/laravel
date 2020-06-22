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

// Route::get('menu', "Menu@index")->name('menu');
// Route::get('history', 'Menu@history')->name('history');

Route::get('food/getRandom', 'FoodController@getRandom')->name('food.getRadom');

Route::resource('food', 'FoodController');
Route::resource('food_order', 'FoodOrderController');


