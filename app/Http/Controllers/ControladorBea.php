<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorBea extends Controller {

    function Ajax() {
        $modulo = $_POST['modulo'];
        $query = 'SELECT profesor.nombre FROM profesor,modulo,profesormodulo '
                . 'WHERE modulo.descripcion="' . $modulo . '" '
                . 'and modulo.id=profesormodulo.IdModulo '
                . 'and profesormodulo.IdProfesor=profesor.usuario';
        $query2 = 'SELECT  orden,pregunta FROM pregunta order by orden';

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
        $opcional = $req->get('opcional');
        $profesor = $req->get('nombre');
        $f = new \DateTime();
        $fecha = $f->format('Y-m-d');
        $modulo = \DB::select('select profesormodulo.IdModulo '
                        . 'FROM profesormodulo,profesor '
                        . 'WHERE profesormodulo.IdProfesor=profesor.usuario '
                        . 'and profesor.nombre="' . $profesor . '"');
        $existe = \DB::select('SELECT alumnomodulorespuesta.id FROM alumnomodulorespuesta '
                        . 'WHERE alumnomodulorespuesta.IdAlumno="' . $usuario . '" '
                        . 'AND alumnomodulorespuesta.IdModulo="' . $modulo[0]->IdModulo . '" LIMIT 1');
        if ($existe != null) {
            for ($i = 0; $i < count($respuestas); $i++) {
                if ($i === 3) {
                    \DB::update('UPDATE respuesta INNER JOIN alumnomodulorespuesta '
                            . 'on respuesta.id=alumnomodulorespuesta.IdRespuesta '
                            . 'INNER join pregunta on pregunta.id=respuesta.IdPregunta '
                            . 'SET respuesta.valor = "' . $respuestas[$i] . '", respuesta.fecha = "' . $fecha . '",'
                            . 'respuesta.preg_opcional="' . $opcional . '" where alumnomodulorespuesta.IdAlumno="' . $usuario . '" '
                            . 'and alumnomodulorespuesta.IdModulo="' . $modulo[0]->IdModulo . '" AND '
                            . 'respuesta.IdPregunta=(Select pregunta.id from pregunta where pregunta.orden=' . ($i + 1) . ')');
                } else {

                    \DB::update('UPDATE respuesta INNER JOIN alumnomodulorespuesta '
                            . 'on respuesta.id=alumnomodulorespuesta.IdRespuesta '
                            . 'INNER join pregunta on pregunta.id=respuesta.IdPregunta '
                            . 'SET respuesta.valor = "' . $respuestas[$i] . '", respuesta.fecha = "' . $fecha . '",'
                            . 'respuesta.preg_opcional=null where alumnomodulorespuesta.IdAlumno="' . $usuario . '" '
                            . 'and alumnomodulorespuesta.IdModulo="' . $modulo[0]->IdModulo . '" AND '
                            . 'respuesta.IdPregunta=(Select pregunta.id from pregunta where pregunta.orden=' . ($i + 1) . ')');
                }
            }
        } else {
            for ($i = 0; $i < count($respuestas); $i++) {
                if ($i === 3) {
                    \DB::Insert('INSERT INTO respuesta '
                            . 'VALUES(DEFAULT, (Select id from pregunta where orden=' . ($i + 1) . '), "' . $opcional . '", "' . $respuestas[$i] . '", "' . $fecha . '")');
                    $id = \DB::select('SELECT MAX(id) as id FROM respuesta');
                    \DB::Insert('INSERT INTO alumnomodulorespuesta '
                            . 'VALUES(DEFAULT,"' . $usuario . '", "' . $modulo[0]->IdModulo . '" ,' . $id[0]->id . ')');
                } else {
                    \DB::Insert('INSERT INTO respuesta '
                            . 'VALUES(DEFAULT, (Select id from pregunta where orden=' . ($i + 1) . '), null , "' . $respuestas[$i] . '", "' . $fecha . '")');
                    $id = \DB::select('SELECT MAX(id) as id FROM respuesta');
                    \DB::Insert('INSERT INTO alumnomodulorespuesta '
                            . 'VALUES(DEFAULT,"' . $usuario . '", "' . $modulo[0]->IdModulo . '" ,' . $id[0]->id . ')');
                }
            }
        }

        return view('encuestaAlmacenada');
    }

    function encuestaPrim() {
        $id_mo = $_POST['id_mo'];
        $alumnos = \DB::select('SELECT DISTINCT alumnomodulorespuesta.IdAlumno FROM alumnomodulorespuesta WHERE alumnomodulorespuesta.IdModulo="' . $id_mo . '" ORDER BY alumnomodulorespuesta.IdAlumno');
        $encuesta1 = \DB::select('SELECT alumnomodulorespuesta.IdAlumno, pregunta.orden, pregunta.pregunta, respuesta.valor FROM alumnomodulorespuesta,pregunta,respuesta WHERE alumnomodulorespuesta.IdAlumno="' . $alumnos[0]->IdAlumno . '" AND alumnomodulorespuesta.IdRespuesta=respuesta.id AND pregunta.id=respuesta.IdPregunta AND alumnomodulorespuesta.IdModulo="' . $id_mo . '" ORDER BY pregunta.orden');
        $opcional = \DB::select('SELECT respuesta.preg_opcional FROM alumnomodulorespuesta,pregunta,respuesta WHERE alumnomodulorespuesta.IdAlumno="' . $alumnos[0]->IdAlumno . '" AND alumnomodulorespuesta.IdRespuesta=respuesta.id AND pregunta.id=respuesta.IdPregunta AND alumnomodulorespuesta.IdModulo="' . $id_mo . '" AND respuesta.preg_opcional is not null');
        $datos = [
            'encuesta1' => $encuesta1,
            'listado' => $alumnos,
            'opcional' => $opcional[0]->preg_opcional
        ];
        echo json_encode($datos);
    }

    function encuestaSig() {
        $alumno = $_POST['alumno'];
        $id_mo = $_POST['id_mo'];
        $listado = $_POST['listado'];

        $sig;

        for ($i = 0; $i < count($listado); $i++) {
            if ($listado[$i] === $alumno) {
                $sig = $listado[$i + 1];
            }
        }
        $encuesta = \DB::select('SELECT alumnomodulorespuesta.IdAlumno, pregunta.orden, pregunta.pregunta, respuesta.valor FROM alumnomodulorespuesta,pregunta,respuesta WHERE alumnomodulorespuesta.IdAlumno="' . $sig . '" AND alumnomodulorespuesta.IdRespuesta=respuesta.id AND pregunta.id=respuesta.IdPregunta AND alumnomodulorespuesta.IdModulo="' . $id_mo . '" ORDER BY pregunta.orden');
        $opcional = \DB::select('SELECT respuesta.preg_opcional FROM alumnomodulorespuesta,pregunta,respuesta WHERE alumnomodulorespuesta.IdAlumno="' . $sig . '" AND alumnomodulorespuesta.IdRespuesta=respuesta.id AND pregunta.id=respuesta.IdPregunta AND alumnomodulorespuesta.IdModulo="' . $id_mo . '" AND respuesta.preg_opcional is not null');
        $datos = [
            'encuesta1' => $encuesta,
            'opcional' => $opcional[0]->preg_opcional
        ];
        echo json_encode($datos);
    }

    function encuestaAnt() {
        $alumno = $_POST['alumno'];
        $id_mo = $_POST['id_mo'];
        $listado = $_POST['listado'];
        $sig;

        for ($i = 0; $i < count($listado); $i++) {
            if ($listado[$i] === $alumno) {
                $sig = $listado[$i - 1];
            }
        }
        $encuesta = \DB::select('SELECT alumnomodulorespuesta.IdAlumno, pregunta.orden, pregunta.pregunta, respuesta.valor FROM alumnomodulorespuesta,pregunta,respuesta WHERE alumnomodulorespuesta.IdAlumno="' . $sig . '" AND alumnomodulorespuesta.IdRespuesta=respuesta.id AND pregunta.id=respuesta.IdPregunta AND alumnomodulorespuesta.IdModulo="' . $id_mo . '" ORDER BY pregunta.orden');
        $opcional = \DB::select('SELECT respuesta.preg_opcional FROM alumnomodulorespuesta,pregunta,respuesta WHERE alumnomodulorespuesta.IdAlumno="' . $sig . '" AND alumnomodulorespuesta.IdRespuesta=respuesta.id AND pregunta.id=respuesta.IdPregunta AND alumnomodulorespuesta.IdModulo="' . $id_mo . '" AND respuesta.preg_opcional is not null');
        $datos = [
            'encuesta1' => $encuesta,
            'opcional' => $opcional[0]->preg_opcional
        ];
        echo json_encode($datos);
    }

}
