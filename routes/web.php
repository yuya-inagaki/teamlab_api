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

//Product
Route::get('product/create', function () {
    return view('product.create');
});
Route::get('product/{id}/destroy','ProductController@destroy');
Route::get('product/{id}/edit','ProductController@edit');
Route::post('product', 'ProductController@store');
Route::post('product/{id}/update', 'ProductController@update');
Route::get('product/{product_id}/stock/{shop_id}', 'ProductController@stock_operation');
Route::get('product/{id}', 'ProductController@show');
Route::get('product', 'ProductController@index');
Route::post('product/search', 'ProductController@search');

// Shop
Route::get('shop', 'ShopController@index');
Route::post('shop', 'ShopController@store');
Route::get('shop/create', function () {
    return view('shop.create');
});
Route::get('shop/{id}', 'ShopController@show');
Route::get('shop/{id}/edit', 'ShopController@edit');
Route::post('shop/{id}/update/', 'ShopController@update');
Route::get('shop/{id}/destroy/', 'ShopController@destroy');

// APIのルーティング
Route::resource('api/products', 'ApiProductController', [
    'only' => ['index', 'store', 'show', 'update', 'destroy']
]);
Route::resource('api/shops', 'ApiShopController', [
    'only' => ['index', 'store', 'show', 'update', 'destroy']
]);
Route::resource('api/stocks', 'ApiStockController', [
    'only' => ['index', 'store', 'show']
]);
