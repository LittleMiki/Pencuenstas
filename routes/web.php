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
Route::post('ACprofesor','ControladorMiguel@Gusuarios');
Route::post('Descargar','ControladorMiguel@descargarUsuarios');
Route::post('Rol',function (){
    $datos= \Session::get('datos');
    $vista = 'Eleccion';
    //dd($_REQUEST);
    if ($_REQUEST['boton'] == 'Director'){
        $datos['tipo'] = 'Director';
    }
    return view($vista,$datos);
});
//rutas bea
Route::post('mostrarEncuesta','ControladorBea@Ajax');
Route::post('respuestas','ControladorBea@guardarEncuesta');
