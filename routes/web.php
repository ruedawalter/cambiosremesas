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



