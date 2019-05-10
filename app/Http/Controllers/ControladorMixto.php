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
        //Autor: Beatriz//
        if ($req->get('boton') == 'Resumen profesor') {
            $materia = $req->get('mat');
            $id_mo = \DB::select('SELECT id FROM modulo WHERE descripcion="' . $materia . '"');
            $curso_grupo = \DB::select('SELECT curso.curso,curso.grupo,curso.descripcion FROM curso,modulo,modulocurso WHERE modulo.descripcion="' . $materia . '" AND modulo.id=modulocurso.IdModulo AND modulocurso.IdCurso=curso.id');
            $total_encuestas = \DB::select('SELECT COUNT(DISTINCT(alumnomodulorespuesta.IdAlumno)) FROM alumnomodulorespuesta WHERE alumnomodulorespuesta.IdModulo="' . $id_mo[0]->id . '"');
            $datos = [
                'materia' => $materia,
                'grupo' => $curso_grupo,
                'total_encuestas' => $total_encuestas[0]
            ];

            return view("resumenprofe", $datos);
        }

        ////////////////////////////////////////////////////////////////////////
    }

}
