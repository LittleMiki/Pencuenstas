<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorBea extends Controller {

    function Ajax() {
        $modulo = $_POST['modulo'];
        $query = 'SELECT profesor.nombre FROM profesor,modulo,profesormodulo WHERE modulo.descripcion="' . $modulo . '" and modulo.id=profesormodulo.IdModulo and profesormodulo.IdProfesor=profesor.usuario';
        $query2 = 'SELECT pregunta FROM pregunta order by orden';

        $nombre = \DB::select($query);
        $preguntas = \DB::select($query2);
        $datos = array(
            "nombre" => $nombre,
            "preguntas" => $preguntas
        );

        echo json_encode($datos);
    }

    function guardarEncuesta(Request $req) {
        $usuario = \Session::get('usuario');
        $respuestas = $req->get('respuestas');
        $profesor = $req->get('nombre');
        $modulo=\DB::select('SELECT IdModulo FROM profesormodulo WHERE IdProfesor="'.$profesor.'"');
        for ($i = 0; $i < count($respuestas); $i++) {
            \DB::Insert('INSERT INTO encuesta VALUES(DEFAULT, '.($i+1).', '.$respuestas[$i].')');
            $id_encuesta = \DB::table('encuesta')->insertGetId();
             \DB::Insert('INSERT INTO alumnomoduloencuesta VALUES(DEFAULT,"'.$usuario.'", "'.$modulo.'", '.$id_encuesta.')');
             \DB::Insert('INSERT INTO encuestapregunta VALUES(DEFAULT,'.$id_encuesta.', '.($i+1).' )');
        } 
         return view('validado');
    }

}
