<?php

Route::resource('sessions', 'SessionsController', array('only'=> array('create','destroy','store')));
Route::get('logout', 'SessionsController@destroy');
Route::get('login', 'SessionsController@create')->before('guest');
Route::post('login', 'SessionsController@store');


Route::group(array('before' => 'auth'), function()
{
Route::get('users', 'UsersController@index');
Route::get('users/create', 'UsersController@create');
Route::post('users/create', 'UsersController@store');
Route::get('users/{id}/edit', 'UsersController@edit');
Route::post('users/create/{id}', 'UsersController@update');
//Route::resource('users', 'UsersController');

Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@store');

Route::get('admin', 'HomeController@indexAdmin');
Route::get('admin/cargagraficos', 'StatisticsController@index');
Route::get('admin/colum', 'StatisticsController@barrasChart');

Route::get('cocina','CocinaController@index');
Route::get('listOrders', 'CocinaController@items');
Route::post('listOrders/{cant}/{items}', 'CocinaController@itemsOrders');
Route::post('orders/view/{id}', 'CocinaController@orderview');

Route::get('orders/mesas', 'OrdersController@mesas');
Route::get('orders/edit', 'OrdersController@editar');
Route::post('orders/savepos/{left}/{top}/{id}', 'OrdersController@savepos');
Route::get('orders','OrdersController@index');
Route::get('orders/create', 'OrdersController@create');
Route::post('orders/create', 'OrdersController@store');
Route::get('orders/editar/{id}', 'OrdersController@edit');
Route::post('orders/create/{id}', 'OrdersController@update');
Route::get('orders/cobrar/{id}', 'OrdersController@cobrar');
Route::post('orders/cobrar/{id}', 'OrdersController@save');
Route::get('orders/{id}', 'OrdersController@show');
Route::get('orders/{id}/delete', 'OrdersController@delete');
Route::DELETE('orders/{id}', 'OrdersController@destroy');

Route::get('orders/edit/list/{id}', 'OrderItemsController@items');
Route::get('list/{id}', 'OrderItemsController@items');
Route::get('orders/list/{id}', 'OrderItemsController@items');
Route::get('orders/edit/{id}', 'OrderItemsController@edit');
Route::post('orders/edit', 'OrderItemsController@store');
Route::post('orders/edit/{iditem}', 'OrderItemsController@destroy');

Route::get('items', 'ItemsController@index');
Route::get('items/create', 'ItemsController@create');
Route::post('items/create', 'ItemsController@store');
Route::get('item/create/{id}', 'ItemsController@crear');
Route::post('item/create', 'ItemsController@store');
Route::get('items/{id}/edit', 'ItemsController@edit');
Route::post('items/create/{id}', 'ItemsController@update');
Route::get('items/{id}/delete', 'ItemsController@show');
Route::DELETE('items/{id}', 'ItemsController@destroy');

Route::get('categorias', 'CategoriesController@index');
Route::get('categorias/create', 'CategoriesController@create');
Route::post('categorias/create', 'CategoriesController@store');
Route::get('categorias/{id}/edit', 'CategoriesController@edit');
Route::post('categorias/create/{id}', 'CategoriesController@update');
Route::get('categorias/{id}/delete', 'CategoriesController@delete');
Route::DELETE('categorias/{id}', 'CategoriesController@destroy');

Route::get('tables', 'TablesController@index');
Route::get('tables/create', 'TablesController@create');
Route::post('tables/create', 'TablesController@store');
Route::get('tables/{id}/edit', 'TablesController@edit');
Route::post('tables/create/{id}', 'TablesController@update');
Route::get('tables/{id}/delete', 'TablesController@delete');
Route::DELETE('tables/{id}', 'TablesController@destroy');
Route::post('tables/{id}', 'TablesController@destroy');

Route::get('reservas','ReservaController@index');
Route::post('reservas', 'ReservaController@destroy');
Route::get('reservas/create', 'ReservaController@create');
Route::post('reservas/create', 'ReservaController@store');
Route::get('reservas/{id}/edit', 'ReservaController@edit');
Route::post('reservas/create/{id}', 'ReservaController@update');
Route::get('reservas/{id}/delete', 'ReservaController@delete');
Route::DELETE('reservas/{id}', 'ReservaController@destroy');
});

