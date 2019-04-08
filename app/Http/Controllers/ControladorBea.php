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

}
