<?php
// Nos mostrará el formulario de login.
/*Route::get('login', 'AuthController@showLogin');
// Validamos los datos de inicio de sesión.
Route::post('login', 'AuthController@postLogin');
Route::group(array('before' => 'auth'), function()
{
Route::get('logout', 'AuthController@Logout');
});*/
Route::resource('sessions', 'SessionsController', array('only'=> array('create','destroy','store')));
Route::get('logout', 'SessionsController@destroy');
Route::get('login', 'SessionsController@create')->before('guest');

Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@store');

Route::get('admin', 'HomeController@indexAdmin');
Route::get('admin/cargagraficos', 'StatisticsController@index');
Route::get('admin/colum', 'StatisticsController@barrasChart');

Route::get('users','UsersController@index');
Route::get('users/create', 'UsersController@create');
Route::post('users/create', 'UsersController@store');
Route::get('users/{id}/edit', 'UsersController@edit');
Route::post('users/create/{id}', 'UsersController@update');
//Route::resource('users', 'UsersController');

Route::get('cocina','CocinaController@index');

Route::get('orders','OrdersController@index');
Route::get('orders/create', 'OrdersController@create');
Route::post('orders/create', 'OrdersController@store');
Route::get('orders/editar/{id}', 'OrdersController@edit');
Route::post('orders/create/{id}', 'OrdersController@update');
Route::get('orders/edit/list/{id}', 'OrderItemsController@index');
Route::get('orders/cobrar/{id}', 'OrdersController@cobrar');
Route::post('orders/cobrar/{id}', 'OrdersController@save');
Route::get('orders/{id}', 'OrdersController@show');
Route::DELETE('orders/{id}', 'OrdersController@destroy');

Route::get('list/{id}', 'OrderItemsController@index');
Route::get('orders/list/{id}', 'OrderItemsController@index');
Route::get('orders/edit/{id}', 'OrderItemsController@edit');
Route::post('orders/edit', 'OrderItemsController@store');
Route::post('orders/edit/{iditem}/{idorder}/{price}', 'OrderItemsController@destroy');

Route::get('items', 'ItemController@index');
Route::get('items/create', 'ItemController@create');
Route::post('items/create', 'ItemController@store');
Route::get('item/create/{id}', 'ItemController@crear');
Route::post('item/create', 'ItemController@store');
Route::get('items/{id}/edit', 'ItemController@edit');
Route::post('items/create/{id}', 'ItemController@update');
Route::get('items/{id}/delete', 'ItemController@show');
Route::DELETE('items/{id}', 'ItemController@destroy');

Route::get('categorias', 'CategoriesController@index');
Route::get('categorias/create', 'CategoriesController@create');
Route::post('categorias/create', 'CategoriesController@store');
Route::get('categorias/{id}/edit', 'CategoriesController@edit');
Route::post('categorias/create/{id}', 'CategoriesController@update');
Route::post('categorias/{id}', 'CategoriesController@destroy');

Route::get('tables', 'TablesController@index');
Route::get('tables/create', 'TablesController@create');
Route::post('tables/create', 'TablesController@store');
Route::get('tables/{id}/edit', 'TablesController@edit');
Route::post('tables/create/{id}', 'TablesController@update');
Route::get('tables/{id}/delete', 'TablesController@show');
Route::DELETE('tables/{id}', 'TablesController@destroy');
Route::post('tables/{id}', 'TablesController@destroy');

Route::get('reservas','ReservaController@index');
Route::post('reservas', 'ReservaController@destroy');
Route::get('reservas/create', 'ReservaController@create');
Route::post('reservas/create', 'ReservaController@store');
Route::get('reservas/{id}/edit', 'ReservaController@edit');
Route::post('reservas/create/{id}', 'ReservaController@update');
//Route::DELETE('reservas/{id}', 'ReservaController@destroy');
Route::get('listres', 'ReservaController@lista');
