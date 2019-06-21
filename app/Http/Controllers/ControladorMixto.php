<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorMixto extends Controller {

    function Gusuarios(Request $req) {
//Autor: Miguel Angel//
        if ($req->get('boton') == 'Cerrar Sesion') {
            \Session::flush();
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
            $tabla = \DB::select('SELECT DISTINCT alumnomodulorespuesta.IdAlumno, pregunta.orden, respuesta.valor FROM pregunta,respuesta, alumnomodulorespuesta WHERE alumnomodulorespuesta.IdModulo="' . $id_mo[0]->id . '" AND alumnomodulorespuesta.IdRespuesta=respuesta.id AND respuesta.IdPregunta=pregunta.id AND pregunta.id NOT BETWEEN 4 AND 6 ORDER BY alumnomodulorespuesta.IdAlumno, pregunta.orden ASC');
            $tabla2 = \DB::select('SELECT pregunta.orden, respuesta.valor FROM pregunta,respuesta,alumnomodulorespuesta WHERE pregunta.id=respuesta.IdPregunta AND alumnomodulorespuesta.IdModulo="' . $id_mo[0]->id . '" AND alumnomodulorespuesta.IdRespuesta=respuesta.id AND pregunta.id NOT BETWEEN 4 AND 6 ORDER BY pregunta.orden');
            $preguntas = \DB::select('SELECT orden FROM pregunta WHERE pregunta.id NOT BETWEEN 4 AND 6 ORDER BY orden');

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
                        $media = round(($suma / $i),1);
                        array_push($mediaPreguntas, $media);
                        $i = 0;
                        $suma = (int) $t->valor;
                        $i++;
                        $media = round(($suma / $i),1);
                        array_push($mediaPreguntas, $media);
                    } else {
                        if ($t === end($tabla2)) {
                            $suma = $suma + (int) $t->valor;
                            $i++;
                           $media = round(($suma / $i),1);
                            array_push($mediaPreguntas, $media);
                        } else {
                            $media = round(($suma / $i),1);
                            array_push($mediaPreguntas, $media);
                            $i = 0;
                            $media = 0;
                            $suma = 0;
                            $p = $t->orden;
                            $suma = (int) $t->valor;
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
                        $media = round(($suma / $i),1);
                        $sumaMedia = $sumaMedia + $media;
                        $x++;
                        array_push($mediaEncuesta, $media);
                        $mediaTotal = round(($sumaMedia / $x),1);
                        array_push($mediaEncuesta, $mediaTotal);
                    } else {
                        $media = round(($suma / $i),1);
                        $sumaMedia = round(($sumaMedia + $media),1);
                        $x++;
                        array_push($mediaEncuesta, $media);
                        $i = 0;
                        $media = 0;
                        $suma = 0;
                        $e = $t->IdAlumno;
                        $suma = (int) $t->valor;
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
                'id_mo' => $id_mo
            ];
            return view("verEncuestas", $datos);
        }
        if ($req->get('boton') == 'Resumen Tutor') {
            $tutor = \Session::get('usuario');
            $curso = \DB::select('SELECT curso.curso,curso.grupo, curso.descripcion FROM curso WHERE curso.tutor="' . $tutor . '"');
            $modulos = \DB::select('SELECT modulo.id, modulo.descripcion FROM modulo,modulocurso,curso WHERE curso.tutor="' . $tutor . '" AND curso.id=modulocurso.IdCurso AND modulocurso.IdModulo=modulo.id');


            $tabla = []; //tabla de los datos del cada modulo
            $cumplen_criterio = 0; //guarda todos los "si"
            $total_realizadas = 0; //guarda el total de las encuestas de todos los modulos
            $valor_mayor_igual = 0; //guarda todas las encuestas con valor mayor o igual a 3

            foreach ($modulos as $m) {//recorremos el vector de todos los modulos del curso
                $fila = [
                    'modulo' => $m->descripcion,
                ]; //fila del modulo con sus tres valores de la tabla
                //seleccionamos todos los valores de las encuestas del modulo donde nos encontremos
                $encuestas = \DB::select('SELECT DISTINCT alumnomodulorespuesta.IdAlumno, pregunta.orden, respuesta.valor FROM pregunta,respuesta, alumnomodulorespuesta WHERE alumnomodulorespuesta.IdModulo="' . $m->id . '" AND alumnomodulorespuesta.IdRespuesta=respuesta.id AND respuesta.IdPregunta=pregunta.id AND pregunta.id NOT BETWEEN 5 AND 6 ORDER BY alumnomodulorespuesta.IdAlumno, pregunta.orden ASC');
                if ($encuestas != null) {
                    $cumplen_criterio++;
                }
                $alumno_id; //guardamos el alumno para diferenciar cada encuesta independientemente
                $media; //media de la encuesta
                $suma; //suma de los valores de cada encuesta del modulo

                $i = 0; //indice para guardar cada valor para hacer la media
                $x = 0; //indice para guardar cada encuesta para saber el total de encuestas del modulo
                $y = 0; //indice para guardar cada encuesta que tiene un valor mayor o igual a 3

                foreach ($encuestas as $en) {//recorremos el vector de las encuestas del modulo
                    if (empty($alumno_id)) {//comprobamos si esta vacia la variable auxiliar del alumno,asi sabemos que es el primer valor del vector
                        //sumamos los primeros valores
                        $suma = (int) $en->valor;
                        $i++;
                        $alumno_id = $en->IdAlumno;
                    } else if ($en->IdAlumno !== $alumno_id || $en === end($encuestas)) {//si no es el primer valor, comprobamos si es otra encuesta o si es el final de la tabla
                        if ($en === end($encuestas)) {//si es el final de la tabla, hacemos la ultima suma y media
                            $suma = $suma + (int) $en->valor;
                            $i++;
                            $media = $suma / $i;
                            if ($media >= 3) {//comprobamos si la encuesta pasa, y avanzamos los indices de encuestas aprobadas
                                $y++;
                                $valor_mayor_igual++;
                            }

                            $x++;
                        } else {//si es otra encuesta, hacemos la media de la encuesta anterior
                            $media = $suma / $i;
                            if ($media >= 3) {//comprobamos si la encuesta pasa y avanzamos los indices de encuestas aprobadas
                                $y++;
                                $valor_mayor_igual++;
                            }
                            $x++;
                            $i = 0;
                            $media = 0;
                            $suma = 0;
                            $alumno_id = $en->IdAlumno; //guardamos el alumno de la nueva encuesta
                            $suma = $en->valor; //sumamos el primer valor de la encuesta
                            $i++;
                        }
                    } else {//si continuamos con los valores de la encuesta anterior, sumamos el valor a lo que ya teniamos y avanzamos el indice
                        $suma = $suma + (int) $en->valor;
                        $i++;
                    }
                }
                $hay = "Si";
                if ($x == 0) {
                    $hay = "No";
                }
                $fila['hay'] = $hay;
                $total_realizadas = $total_realizadas + $x; //sumamos una mas al total de las encuestas de todos los modulos
                $fila['total'] = $x; //guardamos en la fila el total de encuestas del modulo
                $fila['aprobadas'] = $y; //guardamos el total de encuestas aprobadas del modulo
                array_push($tabla, $fila); //metemos el vector fila en la tabla final
                unset($alumno_id); //borramos la variable alumno_id para poder comprobar el empty a la siquiente vuelta
            }

            //guardamos el total de modulos del curso actual
            $total_modulo = \DB::select('SELECT COUNT(modulo.id) as total_modulos FROM modulo,modulocurso,curso WHERE curso.tutor="' . $tutor . '" AND curso.id=modulocurso.IdCurso AND modulocurso.IdModulo=modulo.id');
            $total['total_modulos'] = $total_modulo[0]->total_modulos; // guardamos el la fila del total, el numero total de modulos
            $total['total_realizadas'] = $total_realizadas; //guardamos en la fila del total todas las encuestas realizadas en el curso
            $total['total_valor>=3'] = $valor_mayor_igual; //guardamos en la fila del total todas las encuestas que estan aprobadas en el curso

            $criterio = $cumplen_criterio; //cuantos si hay en la tabla

            $cumplimiento['%si'] = (int) (round(($cumplen_criterio * 100) / $total_modulo[0]->total_modulos)); //porcentaje de modulos que tienen encuestas         
            $porc_aprob = (int) (round(($valor_mayor_igual * 100) / $total_realizadas)); //calculamos el porcentaje de encuestas aprobadas, redondeamos y truncamos
            $cumplimiento['total'] = $porc_aprob; //agregamos el porcentaje a la fila cumplimiento

            $datos = [
                'tutor' => $tutor,
                'grupo' => $curso,
                'tabla' => $tabla,
                'total' => $total,
                'criterio' => $criterio,
                'cumplimiento' => $cumplimiento
            ];
            return view("resumentutor", $datos);
        }
    }

    ////////////////////////////////////////////////////////////////////////
}
