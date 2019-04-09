<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorMiguel extends Controller {

    //
    function validarUsuario(Request $req) {

        $vista = 'index';

        $query = "SELECT * FROM `alumno` WHERE `usuario` = '" . $req->get('usuario') . "'";
        $resultado = \DB::select($query);
        //dd($resultado[0]->usuario);
        if ($resultado[0]->usuario == $req->get('usuario')) {
            if ($resultado[0]->pass == $req->get('pass')) {
                \Session::put('usuario', $req->get('usuario'));
                $query = "SELECT curso.descripcion,curso.grupo,curso.curso FROM modulo,modulocurso,curso,alumnomodulo WHERE modulo.id=modulocurso.IdModulo and curso.id = modulocurso.IdCurso and alumnomodulo.IdModulo=modulocurso.IdModulo and alumnomodulo.alumno= '" . $req->get('usuario') . "'";
                $resultado = \DB::select($query);
                $curso = $resultado[0]->curso . ' - ' . $resultado[0]->descripcion;
                $grupo = $resultado[0]->grupo;
                
                $datos = ['alumno' => $req->get('usuario'),
                    'curso' => $curso,
                    'grupo' => $grupo,
                ];
                $vista = 'Eleccion';
                return view($vista,$datos);
            }
        }
        return view($vista);
    }

    function Ajax() {

        $query = "SELECT `Descripcion` FROM `modulo` ";
        $fechas = \DB::select($query);

        echo json_encode($fechas);
    }

    function accionUsuario(Request $req) {
        $vista;
        if ($req->get('boton') == 'aceptar') {
             $query = "SELECT curso.grupo,curso.curso FROM modulo,modulocurso,curso,alumnomodulo WHERE modulo.id=modulocurso.IdModulo and curso.id = modulocurso.IdCurso and alumnomodulo.IdModulo=modulocurso.IdModulo and alumnomodulo.alumno= '" .  \Session::get('usuario') . "'";
                $resultado = \DB::select($query);
                $curso = $resultado[0]->curso;
                $grupo = $resultado[0]->grupo;
                
                $datos = [
                    'curso' => $curso,
                    'grupo' => $grupo,
                ];
            $vista = 'validado';
            return view($vista,$datos);
        } else {
            $vista = 'index';
        }

        //dd($datos);
        return view($vista);
    }

}
