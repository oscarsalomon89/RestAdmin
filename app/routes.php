<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::get('/', 'HomeController@showWelcome');
Route::get('/', 'HomeController@index');
Route::controller('auth', 'AuthController');

Route::resource('users', 'UsersController');
Route::resource('reservas', 'ReservaController');
//Route::resource('orders', 'OrderController');

Route::get('orders', array('uses'=>'OrderController@index'));
Route::get('orders/create', array('uses'=>'OrderController@create'));
Route::post('orders', array('uses'=>'OrderController@store'));
Route::get('orders/agregar/{id}', array('uses'=>'OrderController@insertarItems'));
Route::post('orders/agregar/{id}', array('uses'=>'OrderController@agregarItems'));
Route::post('orders/eliminar/{id}', array('uses'=>'OrderController@eliminarItems'));
Route::get('orders/cobrar/{id}', array('uses'=>'OrderController@cobrar'));
Route::post('orders/save/{id}', array('uses'=>'OrderController@save'));
Route::post('orders/agregar', array('uses'=>'OrderController@guardarItems'));
Route::get('orders/{id}', array('uses'=>'OrderController@show'));
Route::DELETE('orders/{id}', array('uses'=>'OrderController@destroy'));

Route::post('items/{id}', array('uses'=>'ItemController@update'));
Route::get('items/{id}/edit', array('uses'=>'ItemController@edit'));
Route::get('items', array('uses'=>'ItemController@index'));
Route::get('items/create', array('uses'=>'ItemController@create'));
Route::get('items/create/{id}', array('uses'=>'ItemController@crear'));
Route::post('items', array('uses'=>'ItemController@store'));
Route::get('items/{id}/delete', array('uses'=>'ItemController@show'));
Route::DELETE('items/{id}', array('uses'=>'ItemController@destroy'));
//Route::resource('items', 'ItemController');

Route::post('categorias/{id}', array('uses'=>'CategoryController@update'));
Route::get('categorias/{id}/edit', array('uses'=>'CategoryController@edit'));
Route::get('categorias', array('uses'=>'CategoryController@index'));
Route::get('categorias/create', array('uses'=>'CategoryController@create'));
Route::post('categorias', array('uses'=>'CategoryController@store'));
Route::get('categorias/{id}/delete', array('uses'=>'CategoryController@show'));
Route::DELETE('categorias/{id}', array('uses'=>'CategoryController@destroy'));
//Route::resource('categorias', 'CategoryController');

Route::post('tables/{id}', array('uses'=>'TableController@update'));
Route::get('tables/{id}/edit', array('uses'=>'TableController@edit'));
Route::get('tables', array('uses'=>'TableController@index'));
Route::get('tables/create', array('uses'=>'TableController@create'));
Route::post('tables', array('uses'=>'TableController@store'));
Route::get('tables/{id}/delete', array('uses'=>'TableController@show'));
Route::DELETE('tables/{id}', array('uses'=>'TableController@destroy'));