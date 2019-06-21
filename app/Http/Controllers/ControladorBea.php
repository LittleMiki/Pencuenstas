<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorBea extends Controller {

    function Ajax() {
        $modulo = $_POST['modulo'];//recogemos el valor del modulo
        
        //hacemos una consulta que nos devolvera el nombre del profesor y las preguntas de la encuesta
        $query = 'SELECT profesor.nombre FROM profesor,modulo,profesormodulo '
                . 'WHERE modulo.descripcion="' . $modulo . '" '
                . 'and modulo.id=profesormodulo.IdModulo '
                . 'and profesormodulo.IdProfesor=profesor.usuario';
        $query2 = 'SELECT  orden,pregunta FROM pregunta order by orden';

        $nombre = \DB::select($query);
        $preguntas = \DB::select($query2);
        $datos = array(  //metemos en un array lo datos de la consulta
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
        $id_mo = $_POST['id_mo'];//recogemos el modulo
        
        //hacemos una consulta con todos los alumnos que han hecho encuesta de este modulo
        $alumnos = \DB::select('SELECT DISTINCT alumnomodulorespuesta.IdAlumno FROM alumnomodulorespuesta WHERE alumnomodulorespuesta.IdModulo="' . $id_mo . '" ORDER BY alumnomodulorespuesta.IdAlumno');
        
        //hacemos una consulta la encuesta del primer alumno de la lista de alumnos anterior
        $encuesta1 = \DB::select('SELECT alumnomodulorespuesta.IdAlumno, pregunta.orden, pregunta.pregunta, respuesta.valor FROM alumnomodulorespuesta,pregunta,respuesta WHERE alumnomodulorespuesta.IdAlumno="' . $alumnos[0]->IdAlumno . '" AND alumnomodulorespuesta.IdRespuesta=respuesta.id AND pregunta.id=respuesta.IdPregunta AND alumnomodulorespuesta.IdModulo="' . $id_mo . '" ORDER BY pregunta.orden');
        
        //recogemos la pregunta opcional
        $opcional = \DB::select('SELECT respuesta.preg_opcional FROM alumnomodulorespuesta,pregunta,respuesta WHERE alumnomodulorespuesta.IdAlumno="' . $alumnos[0]->IdAlumno . '" AND alumnomodulorespuesta.IdRespuesta=respuesta.id AND pregunta.id=respuesta.IdPregunta AND alumnomodulorespuesta.IdModulo="' . $id_mo . '" AND respuesta.preg_opcional is not null');
        
        $datos = [
            'encuesta1' => $encuesta1,
            'listado' => $alumnos,
            'opcional' => $opcional[0]->preg_opcional
        ];
        echo json_encode($datos);
    }

    function encuestaSig() {
        
        //recogemos los datos de la encuesta que hay en ese momento
        $alumno = $_POST['alumno'];
        $id_mo = $_POST['id_mo'];
        $listado = $_POST['listado'];

        $sig;//creamos una variable para guardar el alumno de la encuesta que pintaremos

        //recorremos el listado de alumnos con encuestas en el modulo
        for ($i = 0; $i < count($listado); $i++) {
            if ($listado[$i] === $alumno) {
                //cuando encontremos el alumno de la encuesta que hay pintada
                //guardaremos en sig el valor siguiente sumando 1
                $sig = $listado[$i + 1];
            }
        }
        //consulta de los datos de la encuesta del alumno siguiente
        $encuesta = \DB::select('SELECT alumnomodulorespuesta.IdAlumno, pregunta.orden, pregunta.pregunta, respuesta.valor FROM alumnomodulorespuesta,pregunta,respuesta WHERE alumnomodulorespuesta.IdAlumno="' . $sig . '" AND alumnomodulorespuesta.IdRespuesta=respuesta.id AND pregunta.id=respuesta.IdPregunta AND alumnomodulorespuesta.IdModulo="' . $id_mo . '" ORDER BY pregunta.orden');
        //pregunta opcional del alumno siguiente
        $opcional = \DB::select('SELECT respuesta.preg_opcional FROM alumnomodulorespuesta,pregunta,respuesta WHERE alumnomodulorespuesta.IdAlumno="' . $sig . '" AND alumnomodulorespuesta.IdRespuesta=respuesta.id AND pregunta.id=respuesta.IdPregunta AND alumnomodulorespuesta.IdModulo="' . $id_mo . '" AND respuesta.preg_opcional is not null');
        $datos = [
            'encuesta1' => $encuesta,
            'opcional' => $opcional[0]->preg_opcional
        ];
        echo json_encode($datos);
    }

    function encuestaAnt() {
        //igual que en el metodo de siguiente:
        $alumno = $_POST['alumno'];
        $id_mo = $_POST['id_mo'];
        $listado = $_POST['listado'];
        $sig;

        for ($i = 0; $i < count($listado); $i++) {
            if ($listado[$i] === $alumno) {
                //buscamos el alumno de la encuesta pintada en el momento
                //guardamos el alumno anterior restandole 1
                $sig = $listado[$i - 1];
            }
        }
        //valores de la encuesta del alumno anterior
        $encuesta = \DB::select('SELECT alumnomodulorespuesta.IdAlumno, pregunta.orden, pregunta.pregunta, respuesta.valor FROM alumnomodulorespuesta,pregunta,respuesta WHERE alumnomodulorespuesta.IdAlumno="' . $sig . '" AND alumnomodulorespuesta.IdRespuesta=respuesta.id AND pregunta.id=respuesta.IdPregunta AND alumnomodulorespuesta.IdModulo="' . $id_mo . '" ORDER BY pregunta.orden');
        //pregunta opcional del alumno anterior
        $opcional = \DB::select('SELECT respuesta.preg_opcional FROM alumnomodulorespuesta,pregunta,respuesta WHERE alumnomodulorespuesta.IdAlumno="' . $sig . '" AND alumnomodulorespuesta.IdRespuesta=respuesta.id AND pregunta.id=respuesta.IdPregunta AND alumnomodulorespuesta.IdModulo="' . $id_mo . '" AND respuesta.preg_opcional is not null');
        $datos = [
            'encuesta1' => $encuesta,
            'opcional' => $opcional[0]->preg_opcional
        ];
        echo json_encode($datos);
    }

    function atras() {
        $tutor = false;
        $nombre = \DB::select('SELECT profesor.nombre FROM profesor WHERE usuario="' . \Session::get('usuario') . '"');
        $tutor = \DB::select('SELECT curso.id FROM curso,profesor WHERE profesor.usuario="' . \Session::get('usuario') . '" AND profesor.usuario= curso.tutor');
        if (!empty($tutor)) {
            $tutor = true;
        }
        $datos = [
            'usuario' => \Session::get('usuario'),
            'nombre' => $nombre[0]->nombre,
            'tipo' => 'profesor',
            'tutor' => $tutor
        ];
        return view('Eleccion', $datos);
    }

}
