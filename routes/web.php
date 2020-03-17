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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/role', 'RoleController@index')->name('roles.role');
Route::post('/role','RoleController@crear')->name('roles.insertar');
Route::get('/role/editar/{id}','RoleController@editar')->name('roles.editar');
Route::put('/role/editar/{id}','RoleController@update')->name('roles.update');
Route::delete('/role/eliminar/{id}','RoleController@eliminar')->name('roles.eliminar');


Route::get('/cliente', 'ClienteController@index')->name('clientes.cliente');
Route::post('/cliente','ClienteController@crear')->name('clientes.insertar');
Route::get('/cliente/editar/{id}','ClienteController@editar')->name('clientes.editar');
Route::put('/cliente/editar/{id}','ClienteController@update')->name('clientes.update');
Route::delete('/cliente/eliminar/{id}','ClienteController@eliminar')->name('clientes.eliminar');

Route::get('/empleado', 'EmpleadoController@index')->name('empleados.empleado');
Route::post('/empleado','EmpleadoController@crear')->name('empleados.insertar');
Route::get('/empleado/editar/{id}','EmpleadoController@editar')->name('empleados.editar');
Route::put('/empleado/editar/{id}','EmpleadoController@update')->name('empleados.update');
Route::delete('/empleado/eliminar/{id}','EmpleadoController@eliminar')->name('empleados.eliminar');

Route::get('/categoria', 'CategoriaController@index')->name('categorias.categoria');
Route::post('/categoria','CategoriaController@crear')->name('categorias.insertar');
Route::get('/categoria/editar/{id}','CategoriaController@editar')->name('categorias.editar');
Route::put('/categoria/editar/{id}','CategoriaController@update')->name('categorias.update');
Route::delete('/categoria/eliminar/{id}','CategoriaController@eliminar')->name('categorias.eliminar');

Route::get('/producto', 'ProductoController@index')->name('productos.producto');
Route::post('/producto','ProductoController@crear')->name('productos.insertar');
Route::get('/producto/editar/{id}','ProductoController@editar')->name('productos.editar');
Route::put('/producto/editar/{id}','ProductoController@update')->name('productos.update');
Route::delete('/producto/eliminar/{id}','ProductoController@eliminar')->name('productos.eliminar');
Route::get('/producto/cola', 'ProductoController@Cola')->name('productos.cola');
Route::post('/producto/generarcola', 'ProductoController@generarCola')->name('productos.generarCola');

Route::get('/lote', 'LoteProductoController@index')->name('lotes.lote');
Route::post('/lote','LoteProductoController@crear')->name('lotes.insertar');
Route::get('/lote/editar/{id}','LoteProductoController@editar')->name('lotes.editar');
Route::put('/lote/editar/{id}','LoteProductoController@update')->name('lotes.update');
Route::delete('/lote/eliminar/{id}','LoteProductoController@eliminar')->name('lotes.eliminar');