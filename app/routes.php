<?php
Route::get('/', 'HomeController@index');
Route::get('admin', 'HomeController@indexAdmin');
Route::controller('auth', 'AuthController');

Route::resource('users', 'UsersController');

Route::get('orders','OrderController@index');
Route::get('orders/create', 'OrderController@create');
Route::post('orders/create', 'OrderController@store');
Route::get('orders/edit/{id}', 'OrderController@editarItems');
Route::post('orders/edit/{id}', 'OrderController@agregarItems');
//Route::DELETE('orders/edit/{id}', 'OrderController@eliminarItems');
Route::get('orders/editar/{id}', 'OrderController@editar');
Route::get('orders/edit/list/{id}', 'OrderController@items');
Route::get('list/{id}', 'OrderController@items');
Route::get('orders/list/{id}', 'OrderController@items');
//Route::post('orders/eliminar/{id}', 'OrderController@eliminarItems');
Route::get('orders/cobrar/{id}', 'OrderController@cobrar');
Route::post('orders/cobrar/{id}', 'OrderController@save');
Route::get('orders/{id}', 'OrderController@show');
Route::DELETE('orders/{id}', 'OrderController@destroy');

Route::get('items', 'ItemController@index');
Route::get('items/create', 'ItemController@create');
Route::post('items/create', 'ItemController@store');
Route::get('item/create/{id}', 'ItemController@crear');
Route::post('item/create', 'ItemController@store');
Route::get('items/{id}/edit', 'ItemController@edit');
Route::post('items/create/{id}', 'ItemController@update');
Route::get('items/{id}/delete', 'ItemController@show');
Route::DELETE('items/{id}', 'ItemController@destroy');

Route::get('categorias', 'CategoryController@index');
Route::get('categorias/create', 'CategoryController@create');
Route::post('categorias/create', 'CategoryController@store');
Route::get('categorias/{id}/edit', 'CategoryController@edit');
Route::post('categorias/create/{id}', 'CategoryController@update');
Route::get('categorias/{id}/delete', 'CategoryController@show');
Route::DELETE('categorias/{id}', 'CategoryController@destroy');

Route::get('tables', 'TableController@index');
Route::get('tables/create', 'TableController@create');
Route::post('tables/create', 'TableController@store');
Route::get('tables/{id}/edit', 'TableController@edit');
Route::post('tables/create/{id}', 'TableController@update');
Route::get('tables/{id}/delete', 'TableController@show');
Route::DELETE('tables/{id}', 'TableController@destroy');

Route::get('reservas', 'ReservaController@index');
Route::post('reservas', 'ReservaController@destroy');
Route::get('reservas/create', 'ReservaController@create');
Route::post('reservas/create', 'ReservaController@store');
Route::get('reservas/{id}/edit', 'ReservaController@edit');
Route::post('reservas/create/{id}', 'ReservaController@update');
//Route::DELETE('reservas/{id}', 'ReservaController@destroy');
Route::get('listres', 'ReservaController@lista');
