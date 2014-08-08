<?php
// Nos mostrará el formulario de login.
Route::get('login', 'AuthController@showLogin');
// Validamos los datos de inicio de sesión.
Route::post('login', 'AuthController@postLogin');
Route::group(array('before' => 'auth'), function()
{
Route::get('logout', 'AuthController@Logout');
});

Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@store');

Route::get('admin', 'HomeController@indexAdmin');
Route::get('admin/cargagraficos', 'StatisticsController@index');

Route::get('users','UsersController@index');
Route::get('users/create', 'UsersController@create');
Route::post('users/create', 'UsersController@saveUser');
Route::get('users/{id}/edit', 'UsersController@edit');
Route::post('users/create/{id}', 'UsersController@saveUser');
Route::resource('users', 'UsersController');

Route::get('orders','OrderController@index');
Route::get('orders/create', 'OrderController@create');
Route::post('orders/create', 'OrderController@store');
Route::get('orders/editar/{id}', 'OrderController@edit');
Route::post('orders/create/{id}', 'OrderController@update');
Route::get('orders/edit/list/{id}', 'OrderItemsController@index');
Route::get('list/{id}', 'OrderItemsController@index');
Route::get('orders/list/{id}', 'OrderItemsController@index');
Route::get('orders/cobrar/{id}', 'OrderController@cobrar');
Route::post('orders/cobrar/{id}', 'OrderController@save');
Route::get('orders/{id}', 'OrderController@show');
Route::DELETE('orders/{id}', 'OrderController@destroy');

Route::get('orders/edit/{id}', 'OrderItemsController@edit');
Route::post('orders/edit/{id}', 'OrderItemsController@store');
Route::get('orders/edit/{iditem}/{idorder}/{price}', 'OrderItemsController@destroy');

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
Route::get('categorias/{id}', 'CategoryController@destroy');

Route::get('tables', 'TableController@index');
Route::get('tables/create', 'TableController@create');
Route::post('tables/create', 'TableController@store');
Route::get('tables/{id}/edit', 'TableController@edit');
Route::post('tables/create/{id}', 'TableController@update');
Route::get('tables/{id}/delete', 'TableController@show');
Route::DELETE('tables/{id}', 'TableController@destroy');
Route::get('tables/{id}', 'TableController@destroy');

Route::get('reservas','ReservaController@index');
Route::post('reservas', 'ReservaController@destroy');
Route::get('reservas/create', 'ReservaController@create');
Route::post('reservas/create', 'ReservaController@store');
Route::get('reservas/{id}/edit', 'ReservaController@edit');
Route::post('reservas/create/{id}', 'ReservaController@update');
//Route::DELETE('reservas/{id}', 'ReservaController@destroy');
Route::get('listres', 'ReservaController@lista');
