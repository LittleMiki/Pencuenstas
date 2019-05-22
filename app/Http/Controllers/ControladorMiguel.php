<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelo\Clase;

class ControladorMiguel extends Controller {

    //
    function validarUsuario(Request $req) {

        $vista = 'index';
        $tabla = '`alumno`';
        $query = "SELECT * FROM `profesor` WHERE `usuario` = '" . $req->get('usuario') . "'";
        $resultado = \DB::select($query);

        if (!empty($resultado)) {
            $tabla = '`profesor`';
        }
        //dd($tabla);
        $query = "SELECT * FROM " . $tabla . " WHERE `usuario` = '" . $req->get('usuario') . "'";
        $resultado = \DB::select($query);



        if ($resultado[0]->usuario == $req->get('usuario')) {
            if ($resultado[0]->pass == $req->get('pass')) {
                \Session::put('usuario', $req->get('usuario'));

                if ($tabla == '`alumno`') {
                    //dd("alumno");
                    $query = "SELECT curso.descripcion,curso.grupo,curso.curso FROM modulo,modulocurso,curso,alumnomodulo WHERE modulo.id=modulocurso.IdModulo and curso.id = modulocurso.IdCurso and alumnomodulo.IdModulo=modulocurso.IdModulo and alumnomodulo.alumno= '" . $req->get('usuario') . "'";
                    $resultado = \DB::select($query);

                    $curso = $resultado[0]->curso . ' - ' . $resultado[0]->descripcion;
                    $grupo = $resultado[0]->grupo;

                    $datos = ['nombre' => $req->get('usuario'),
                        'curso' => $curso,
                        'grupo' => $grupo,
                        'tipo' => 'alumno',
                    ];
                    $vista = 'Eleccion';
                    return view($vista, $datos);
                }
                if ($tabla == '`profesor`') {

                    $query = "SELECT * FROM `profesor` WHERE `usuario` = '" . $req->get('usuario') . "'";
                    $resultado = \DB::select($query);

                    $nombre = $resultado[0]->nombre;
                    $query = "SELECT * FROM `curso` where `tutor` ='" . $req->get('usuario') . "'";
                    $resultado = \DB::select($query);

                    $datos;

                    if (!empty($resultado)) {
                        $datos = ['usuario' => $req->get('usuario'),
                            'nombre' => $nombre,
                            'tipo' => 'profesor',
                            'tutor' => true,
                        ];
                    } else {
                        $datos = ['usuario' => $req->get('usuario'),
                            'nombre' => $nombre,
                            'tipo' => 'profesor',
                            'tutor' => false,
                        ];
                    }
                    $query = "SELECT rol.descripcion FROM `profesor`,rol WHERE profesor.rol = rol.id and `usuario` = '" . $req->get('usuario') . "'";
                    $resultado = \DB::select($query);

                    if ($resultado[0]->descripcion == 'Director') {
                        \Session::put('datos', $datos);
                        $vista = 'rol';
                    } else {
                        $vista = 'Eleccion';
                    }


                    return view($vista, $datos);
                }
            }
        }
    }

    function Ajax(Request $req) {
        $tipo = $req->get('tipo');
        if ($tipo == 'profesor') {
            $query = "SELECT  modulo.descripcion FROM `profesormodulo`,profesor,modulo where profesormodulo.IdProfesor = profesor.usuario and profesormodulo.IdModulo = modulo.id and profesor.nombre ='" . $req->get('nombre') . "' ";
            $resultado = \DB::select($query);
            echo json_encode($resultado);
        }
        if ($tipo == 'Director') {
            $query = "SELECT descripcion FROM `modulo` ";
            $resultado = \DB::select($query);

            echo json_encode($resultado);
        }
        if($tipo == 'alumno'){
            $query = "SELECT modulo.descripcion FROM `modulo`,alumnomodulo,alumno WHERE modulo.id = alumnomodulo.IdModulo and alumnomodulo.alumno = alumno.usuario and alumno.usuario = '" . $req->get('nombre') . "' ";
            $resultado = \DB::select($query);
            echo json_encode($resultado);
        }
    }

    function accionUsuario(Request $req) {
        $vista;
        if ($req->get('boton') === 'Realizar Encuesta') {
            $query = "SELECT curso.grupo,curso.curso FROM modulo,modulocurso,curso,alumnomodulo WHERE modulo.id=modulocurso.IdModulo and curso.id = modulocurso.IdCurso and alumnomodulo.IdModulo=modulocurso.IdModulo and alumnomodulo.alumno= '" . \Session::get('usuario') . "'";
            $resultado = \DB::select($query);
            $curso = $resultado[0]->curso;
            $grupo = $resultado[0]->grupo;

            $datos = [
                'nombre' =>\Session::get('usuario'),
                'tipo' => 'alumno',
                'curso' => $curso,
                'grupo' => $grupo,
            ];
            $vista = 'validado';
            return view($vista, $datos);
        } else {
            $vista = 'index';
        }

        //dd($datos);
        return view($vista);
    }

    function descargarUsuarios() {
        $usus = \Session::get('usus');
        $usus = str_replace(" </br> ", " \r\n ", $usus);

        \App\Modelo\Bitacora::guardarArchivo($usus);
        return response()->download('Usuarios.txt');
    }

}
