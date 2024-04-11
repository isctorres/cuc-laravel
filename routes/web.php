<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.productos.crear');
});

Route::get('admin/productos/crear', 'App\Http\Controllers\ProductosController@crear')->name('admin/productos/crear');

Route::put('admin/productos/store', 'App\Http\Controllers\ProductosController@store')->name('admin/productos/store');
 
/* Leer */ 
Route::get('admin/productos/show/{id}', 'App\Http\Controllers\ProductosController@show')->name('admin/productos/detalles'); 
 
/* Actualizar */
Route::get('admin/productos/actualizar/{id}', 'App\Http\Controllers\ProductosController@actualizar')->name('admin/productos/actualizar');
Route::put('admin/productos/update/{id}', 'App\Http\Controllers\ProductosController@update')->name('admin/productos/update');
 
/* Eliminar */
Route::put('admin/productos/eliminar/{id}', 'App\Http\Controllers\ProductosController@eliminar')->name('admin/productos/eliminar'); 
 
/* Vista Principal */
Route::get('admin/productos', 'App\Http\Controllers\ProductosController@index')->name('admin/productos');
 