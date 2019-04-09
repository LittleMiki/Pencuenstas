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

//
Route::get('/', function () {
   return view('index');
});
//Route::get('/','ControaldorMiguel@indice');
//rutas miguel angel
Route::post('validar','ControladorMiguel@validarUsuario');
Route::post('Hencuesta','ControladorMiguel@accionUsuario');
Route::post('volver','ControladorMiguel@accionUsuario');
Route::post('miJqueryAjax','ControladorMiguel@Ajax');
//rutas bea
Route::post('mostrarEncuesta','ControladorBea@Ajax');