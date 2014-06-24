<?php

Route::get('/', 'HomeController@index');
Route::controller('auth', 'AuthController');

Route::resource('users', 'UsersController');
Route::resource('reservas', 'ReservaController');

Route::get('orders','OrderController@index');
Route::get('orders/create', 'OrderController@create');
Route::post('orders', 'OrderController@store');
Route::get('orders/edit/{id}', 'OrderController@editarItems');
Route::post('orders/edit/{id}', 'OrderController@agregarItems');
Route::get('orders/edit/list/{id}', 'OrderController@items');
Route::get('list/{id}', 'OrderController@items');
Route::get('orders/list/{id}', 'OrderController@items');
Route::post('orders/eliminar/{id}', 'OrderController@eliminarItems');
Route::get('orders/cobrar/{id}', 'OrderController@cobrar');
Route::post('orders/cobrar/{id}', 'OrderController@save');
Route::get('orders/{id}', 'OrderController@show');
Route::DELETE('orders/{id}', 'OrderController@destroy');

Route::get('items', 'ItemController@index');
Route::get('items/create', 'ItemController@create');
Route::get('items/create/{id}', 'ItemController@crear');
Route::get('items/{id}/edit', 'ItemController@edit');
Route::post('items/{id}', 'ItemController@update');
Route::post('items', 'ItemController@store');
Route::get('items/{id}/delete', 'ItemController@show');
Route::DELETE('items/{id}', 'ItemController@destroy');

Route::post('categorias/{id}', 'CategoryController@update');
Route::get('categorias/{id}/edit', 'CategoryController@edit');
Route::get('categorias', 'CategoryController@index');
Route::get('categorias/create', 'CategoryController@create');
Route::post('categorias', 'CategoryController@store');
Route::get('categorias/{id}/delete', 'CategoryController@show');
Route::DELETE('categorias/{id}', 'CategoryController@destroy');

Route::post('tables/{id}', 'TableController@update');
Route::get('tables/{id}/edit', 'TableController@edit');
Route::get('tables', 'TableController@index');
Route::get('tables/create', 'TableController@create');
Route::post('tables', 'TableController@store');
Route::get('tables/{id}/delete', 'TableController@show');
Route::DELETE('tables/{id}', 'TableController@destroy');