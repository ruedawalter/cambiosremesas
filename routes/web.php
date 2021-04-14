<?php

use Illuminate\Support\Facades\Route;

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
    return view('inicio');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Bancos
Route::resource('bancos','BancoController');
Route::get('bancos/{id}/edit/','BancoController@edit');
 // Documentos
Route::resource('documentos','DocumentoController');
Route::get('documentos/{id}/edit/','DocumentoController@edit');
//Estados
Route::resource('estados','EstadoController');
Route::get('estados/{id}/edit/','EstadoController@edit');
//paises
Route::resource('paises','PaisController');
Route::get('paises/{id}/edit/','PaisController@edit');
//Titulares
Route::resource('titulares','TitularController');
Route::get('titulares/{id}/edit/','TitularController@edit');

//Cuentas
Route::resource('cuentas','CuentaController');
Route::get('cuentas/{id}/edit/','CuentaController@edit');







