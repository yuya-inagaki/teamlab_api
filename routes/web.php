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
    return view('welcome');
});

Route::get('products/store', function () {
    return view('home.store');
});
Route::get('products/destroy/{id?}','HomeController@destroy');
Route::get('products/{id?}', 'HomeController@show');


Route::resource('api/products', 'RestappController');
