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
Route::post('GUsuarios','ControladorMixto@Gusuarios');
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
Route::post('AjaxProfes','ControladorMiguel@AjaxProfes');
Route::post('AjaxCursos','ControladorMiguel@AjaxCursos');
Route::post('AjaxModulos','ControladorMiguel@AjaxModulos');
Route::post('ACDirector',function(){
    
    if ($_REQUEST['boton'] == 'Nuevo Profesor'){
        $info['accion'] = 'Profesor';
        return view('NuevoRegistro',$info);
    }
    if ($_REQUEST['boton'] == 'Nuevo Modulo'){
        $info['accion'] = 'Modulo';
        return view('NuevoRegistro',$info);
    }
    if ($_REQUEST['boton'] == 'Nuevo Curso'){
        $info['accion'] = 'Curso';
        return view('NuevoRegistro',$info);
    }
    if ($_REQUEST['boton'] == 'Borrar Curso'){
        $info['accion'] = 'Curso';
        return view('PantallaBorrar',$info);
    }
    if ($_REQUEST['boton'] == 'Borrar Modulo'){
        $info['accion'] = 'Modulo';
        return view('PantallaBorrar',$info);
    }
    if ($_REQUEST['boton'] == 'Borrar Profesor'){
        $info['accion'] = 'Profesor';
        return view('PantallaBorrar',$info);
    }
    if ($_REQUEST['boton'] == 'Modificar Modulo'){
        $info['accion'] = 'Modulo';
        return view('PantallaModificar',$info);
    }
    if ($_REQUEST['boton'] == 'Modificar Profesor'){
        $info['accion'] = 'Profesor';
        return view('PantallaModificar',$info);
    }
    if ($_REQUEST['boton'] == 'Modificar Curso'){
        $info['accion'] = 'Curso';
        return view('PantallaModificar',$info);
    }
    
    if ($_REQUEST['boton'] == 'Generar Usuarios'){
        
        //return 'ControladorMiguel@Gusuarios';
    }
    //return view('NuevoRegistro',$info);
});
Route::post('RegistroProfesor','ControladorMiguel@NuevoProfesor');
Route::post('RegistroCurso','ControladorMiguel@NuevoCurso');
Route::post('RegistroModulo','ControladorMiguel@NuevoModulo');
Route::post('BorrarCurso','ControladorMiguel@BorrarCurso');
Route::post('BorrarProfesor','ControladorMiguel@BorrarProfesor');
Route::post('BorrarModulo','ControladorMiguel@BorrarModulo');
Route::post('PeticionModulos','ControladorMiguel@PeticionModulo');
Route::post('PeticionProfes','ControladorMiguel@PeticionProfe');
Route::post('PeticionCursos','ControladorMiguel@PeticionCurso');
Route::post('OtrosProfes','ControladorMiguel@OP');
Route::post('ModificarModulo','ControladorMiguel@ModificarModulo');
Route::post('ModificarCurso','ControladorMiguel@ModificarCurso');
Route::post('ModificarProfesor','ControladorMiguel@ModificarProfesor');
//rutas bea
Route::post('mostrarEncuesta','ControladorBea@Ajax');
Route::post('respuestas','ControladorBea@guardarEncuesta');
Route::post('encuestaPrim','ControladorBea@encuestaPrim');
Route::post('encuestaSig','ControladorBea@encuestaSig');
Route::post('encuestaAnt','ControladorBea@encuestaAnt');
