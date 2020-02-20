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