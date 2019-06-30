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

Route::get('products/create', function () {
    return view('home.create');
});
Route::get('products/destroy/{id?}','HomeController@destroy');
Route::get('products/edit/{id?}','HomeController@edit');
Route::post('products', 'HomeController@store');
Route::put('products/update/{id?}', 'HomeController@update');
Route::get('products/{id?}', 'HomeController@show');


Route::resource('api/products', 'RestappController');
