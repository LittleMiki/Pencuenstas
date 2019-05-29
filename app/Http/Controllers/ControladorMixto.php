<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorMixto extends Controller {

    function Gusuarios(Request $req) {
//Autor: Miguel Angel//
        if ($req->get('boton') == 'volver') {
            return view('index');
        }

        if ($req->get('boton') == 'Generar Usuarios') {


            if (!empty($req->get('mat'))) {

                $query = "SELECT `id` FROM `modulo` WHERE `descripcion` = '" . $req->get('mat') . "'";
                $resultado = \DB::select($query);
                $modulo = $resultado[0]->id;
                $query = "SELECT COUNT(*) as cantidad FROM alumnomodulo WHERE `IdModulo` = '" . $modulo . "'";
                $resultado = \DB::select($query);
                //dd($resultado);
                $cantidad = (int) $resultado[0]->cantidad;
                $usus = "Usuario------Contrasenia </br>";
                for ($i = 0; $i < 20; $i++) {
                    $up = $req->get('curso') . "0" . $i . $modulo;
                    $query = "INSERT INTO `alumno`(`usuario`, `pass`) VALUES ('" . $up . "','" . $up . "')";
                    \DB::select($query);
                    $query = "INSERT INTO `alumnomodulo`(`id`, `alumno`, `IdModulo`) VALUES (null,'" . $up . "','" . $modulo . "')";
                    \DB::select($query);
                    $usus = $usus . " " . $up . "----" . $up . " </br> ";
                }

                $devolver = [
                    'usus' => $usus,
                ];
                \Session::put('usus', $usus);
                return view("Gusuarios", $devolver);
            }
        }
        ////////////////////////////////////////////////////////////////////////
        //
        //Autor: Beatriz//
        if ($req->get('boton') == 'Resumen profesor') {
            $materia = $req->get('mat');
            $id_mo = \DB::select('SELECT id FROM modulo WHERE descripcion="' . $materia . '"');
            $curso_grupo = \DB::select('SELECT curso.curso,curso.grupo,curso.descripcion FROM curso,modulo,modulocurso WHERE modulo.descripcion="' . $materia . '" AND modulo.id=modulocurso.IdModulo AND modulocurso.IdCurso=curso.id');
            $total_encuestas = \DB::select('SELECT COUNT(DISTINCT(alumnomodulorespuesta.IdAlumno)) as total FROM alumnomodulorespuesta WHERE alumnomodulorespuesta.IdModulo="' . $id_mo[0]->id . '"');
            $tabla = \DB::select('SELECT DISTINCT alumnomodulorespuesta.IdAlumno, pregunta.orden, respuesta.valor FROM pregunta,respuesta, alumnomodulorespuesta WHERE alumnomodulorespuesta.IdModulo="' . $id_mo[0]->id . '" AND alumnomodulorespuesta.IdRespuesta=respuesta.id AND respuesta.IdPregunta=pregunta.id ORDER BY alumnomodulorespuesta.IdAlumno, pregunta.orden ASC');
            $tabla2 = \DB::select('SELECT pregunta.orden, respuesta.valor FROM pregunta,respuesta,alumnomodulorespuesta WHERE pregunta.id=respuesta.IdPregunta AND alumnomodulorespuesta.IdModulo="' . $id_mo[0]->id . '" AND alumnomodulorespuesta.IdRespuesta=respuesta.id ORDER BY pregunta.orden');
            $preguntas = \DB::select('SELECT orden FROM pregunta ORDER BY orden');

            $mediaEncuesta = [];
            $mediaPreguntas = [];

            $p;
            $media;
            $suma;
            $sumaMedia = 0;
            $mediaTotal;
            $x = 0;
            $i = 0;
            foreach ($tabla2 as $t) {
                if (empty($p)) {
                    $suma = (int) $t->valor;
                    $i++;
                    $p = $t->orden;
                } else if ($t->orden !== $p || $t === \end($tabla2)) {
                    if ($t->orden !== $p && $t === end($tabla2)) {
                        $media = $suma / $i;
                        $sumaMedia = $sumaMedia + $media;
                        $x++;
                        array_push($mediaPreguntas, $media);
                        $i = 0;
                        $suma = $t->valor;
                        $i++;
                        $media = $suma / $i;
                        $sumaMedia = $sumaMedia + $media;
                        $x++;
                        array_push($mediaPreguntas, $media);
                    } else {
                        if ($t === end($tabla2)) {
                            $suma = $suma + (int) $t->valor;
                            $i++;
                            $media = $suma / $i;
                            $sumaMedia = $sumaMedia + $media;
                            $x++;
                            array_push($mediaPreguntas, $media);
                        } else {
                            $media = $suma / $i;
                            $sumaMedia = $sumaMedia + $media;
                            $x++;
                            array_push($mediaPreguntas, $media);
                            $i = 0;
                            $media = 0;
                            $suma = 0;
                            $p = $t->orden;
                            $suma = $t->valor;
                            $i++;
                        }
                    }
                } else {
                    $suma = $suma + (int) $t->valor;
                    $i++;
                }
            }
            $e;
            $media = 0;
            $suma = 0;
            $i = 0;
            foreach ($tabla as $t) {
                if (empty($e)) {
                    $suma = (int) $t->valor;
                    $i++;
                    $e = $t->IdAlumno;
                } else if ($t->IdAlumno !== $e || $t === end($tabla)) {
                    if ($t === end($tabla)) {
                        $suma = $suma + (int) $t->valor;
                        $i++;
                        $media = $suma / $i;
                        $sumaMedia = $sumaMedia + $media;
                        $x++;
                        array_push($mediaEncuesta, $media);
                        $mediaTotal = $sumaMedia / $x;
                        array_push($mediaEncuesta, $mediaTotal);
                    } else {
                        $media = $suma / $i;
                        $sumaMedia = $sumaMedia + $media;
                        $x++;
                        array_push($mediaEncuesta, $media);
                        $i = 0;
                        $media = 0;
                        $suma = 0;
                        $e = $t->IdAlumno;
                        $suma = $t->valor;
                        $i++;
                    }
                } else {
                    $suma = $suma + (int) $t->valor;
                    $i++;
                }
            }

            $datos = [
                'materia' => $materia,
                'grupo' => $curso_grupo,
                'total_encuestas' => $total_encuestas[0]->total,
                'preguntas' => $preguntas,
                'tabla' => $tabla,
                'mediaEncuesta' => $mediaEncuesta,
                'mediaPreguntas' => $mediaPreguntas
            ];
            return view("resumenprofe", $datos);
        }
        if ($req->get('boton') == 'Ver encuestas') {
            $materia = $req->get('mat');
            $id_mo = \DB::select('SELECT id FROM modulo WHERE descripcion="' . $materia . '"');
            $curso_grupo = \DB::select('SELECT curso.curso,curso.grupo,profesor.nombre FROM curso,profesor,modulo,modulocurso,profesormodulo WHERE modulo.id="' . $id_mo[0]->id . '" AND modulo.id=modulocurso.IdModulo AND modulocurso.IdCurso=curso.id AND profesor.usuario=profesormodulo.IdProfesor AND profesormodulo.IdModulo=modulo.id');
            $datos = [
                'materia' => $materia,
                'grupo' => $curso_grupo,
            ];
            return view("verEncuestas", $datos);
        }
    }

    ////////////////////////////////////////////////////////////////////////
}
