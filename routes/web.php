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
    $isHomePage = true;
    return view('web/home',['isHomePage' => $isHomePage]);
});

Route::get('/products', 'ProductsController@index');
Route::get('/products/create', 'ProductsController@create')->middleware("auth");
Route::post('/products', 'ProductsController@store')->middleware("auth");
Route::post('/products/{id}/destroy', 'ProductsController@destroy')->middleware("auth");
Route::get('/products/{id}', 'ProductsController@show');
Route::get('/products/{id}/edit', 'ProductsController@edit')->middleware("auth");
Route::post('/products/{id}', 'ProductsController@update')->middleware("auth");
Route::get('/products/{id}/details', 'ProductsController@details')->middleware("auth");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/apidemo','Apidemo@index');
