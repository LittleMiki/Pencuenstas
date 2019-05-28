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
        if ($tipo == 'alumno') {
            $query = "SELECT modulo.descripcion FROM `modulo`,alumnomodulo,alumno WHERE modulo.id = alumnomodulo.IdModulo and alumnomodulo.alumno = alumno.usuario and alumno.usuario = '" . $req->get('nombre') . "' ";
            $resultado = \DB::select($query);
            echo json_encode($resultado);
        }
    }

    function AjaxProfes() {
        $query = "SELECT `nombre` FROM `profesor` ";
        $resultado = \DB::select($query);
        echo json_encode($resultado);
    }

    function AjaxCursos() {
        $query = "SELECT `descripcion` FROM `curso`";
        $resultado = \DB::select($query);
        echo json_encode($resultado);
    }

    function AjaxModulos() {
        $query = "SELECT descripcion FROM modulo";
        $resultado = \DB::select($query);
        echo json_encode($resultado);
    }

    function PeticionModulo(Request $req) {
        //$modulo = $req->get('modulo');
        $query = "SELECT modulo.id,modulo.descripcion,modulocurso.IdCurso as curso FROM `modulocurso`,modulo WHERE modulocurso.IdModulo = modulo.id and `descripcion` ='" . $req->get('modulo') . "'";
        $resultado = \DB::select($query);
        echo json_encode($resultado);
    }

    function PeticionProfe(Request $req) {
        // $modulo = $req->get('modulo');
        $query = "SELECT * FROM `profesor` WHERE `nombre` = '" . $req->get('nombre') . "'";
        $resultado = \DB::select($query);
        echo json_encode($resultado);
    }

    function PeticionCurso(Request $req) {
        $query = "SELECT * FROM `curso` WHERE `descripcion` = '" . $req->get('nombre') . "'";
        $resultado = \DB::select($query);
        echo json_encode($resultado);
    }

    function OP(Request $req) {
        $query = "SELECT `usuario` FROM `profesor` WHERE `usuario` != '" . $req->get('nombre') . "'";
        $resultado = \DB::select($query);
        echo json_encode($resultado);
    }

    function accionUsuario(Request $req) {
        $vista;
        if ($req->get('boton') === 'Realizar Encuesta') {
            $query = "SELECT curso.grupo,curso.curso FROM modulo,modulocurso,curso,alumnomodulo WHERE modulo.id=modulocurso.IdModulo and curso.id = modulocurso.IdCurso and alumnomodulo.IdModulo=modulocurso.IdModulo and alumnomodulo.alumno= '" . \Session::get('usuario') . "'";
            $resultado = \DB::select($query);
            $curso = $resultado[0]->curso;
            $grupo = $resultado[0]->grupo;

            $datos = [
                'nombre' => \Session::get('usuario'),
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

    function NuevoProfesor(Request $req) {
        $query = "INSERT INTO `profesor` (`usuario`, `pass`, `nombre`, `rol`) VALUES ('" . $req->get('usuario') . "', '" . $req->get('pass') . "', '" . $req->get('nombre') . "', '2')";
        \DB::select($query);
        $datos = \Session::get('datos');
        $vista = 'Eleccion';
        $datos['tipo'] = 'Director';
        return view($vista, $datos);
    }

    function NuevoCurso(Request $req) {
        $query = "INSERT INTO `curso` (`id`, `descripcion`, `curso`, `grupo`, `tutor`) VALUES ('" . $req->get('id') . "', '" . $req->get('descripcion') . "', '" . $req->get('curso') . "', '" . $req->get('grupo') . "', '" . $req->get('profesores') . "')";
        $datos = \Session::get('datos');
        $vista = 'Eleccion';
        $datos['tipo'] = 'Director';
        return view($vista, $datos);
    }

    function NuevoModulo(Request $req) {
        $query = "INSERT INTO `modulo` (`id`, `descripcion`) VALUES ('" . $req->get('id') . "', '" . $req->get('descripcion') . "')";
        \DB::select($query);
        $query = "SELECT `id` FROM `curso` WHERE `descripcion` ='" . $req->get('curso') . "'";
        $resultado = \DB::select($query);
        $query = "INSERT INTO `modulocurso` (`id`, `IdModulo`, `IdCurso`) VALUES (NULL, '" . $req->get('id') . "', '" . $resultado[0]->id . "')";
        \DB::select($query);
        $datos = \Session::get('datos');
        $vista = 'Eleccion';
        $datos['tipo'] = 'Director';
        return view($vista, $datos);
    }

    function BorrarCurso(Request $req) {
        $query = "DELETE FROM `curso` WHERE `descripcion` = '" . $req->get('nombre') . "'";
        \DB::select($query);
        $datos = \Session::get('datos');
        $vista = 'Eleccion';
        $datos['tipo'] = 'Director';
        return view($vista, $datos);
    }

    function BorrarProfesor(Request $req) {
        $query = "DELETE FROM `profesor` WHERE `nombre` = '" . $req->get('nombre') . "'";
        \DB::select($query);
        $datos = \Session::get('datos');
        $vista = 'Eleccion';
        $datos['tipo'] = 'Director';
        return view($vista, $datos);
    }

    function BorrarModulo(Request $req) {
        $query = "DELETE FROM `modulo` WHERE `descripcion` = '" . $req->get('nombre') . "'";
        \DB::select($query);
        $datos = \Session::get('datos');
        $vista = 'Eleccion';
        $datos['tipo'] = 'Director';
        return view($vista, $datos);
    }

    function ModificarProfesor(Request $req) {
        if ($req->get('aceptar') == 'Guardar') {
            if ($req->get('nombre') == 'Director') {
                $cargo = 1;
            } else {
                $cargo = 2;
            }

            $query = "UPDATE `profesor` SET `usuario`='" . $req->get('usuario') . "',`pass`='" . $req->get('pass') . "',`nombre`='" . $req->get('nombre') . "',`rol`=" . $cargo . " WHERE `nombre` ='" . $req->get('nombre') . "'";
            //dd($query);
            \DB::select($query);
        }
        $datos = \Session::get('datos');
        $vista = 'Eleccion';
        $datos['tipo'] = 'Director';
        return view($vista, $datos);
    }

    function ModificarModulo(Request $req) {
        if ($req->get('aceptar') == 'Guardar') {
            $query = "UPDATE `modulo` SET `id`='" . $req->get('id') . "',`descripcion`='" . $req->get('descripcion') . "' WHERE `id` = '" . $req->get('id') . "'";
            \DB::select($query);
        }
        $datos = \Session::get('datos');
        $vista = 'Eleccion';
        $datos['tipo'] = 'Director';
        return view($vista, $datos);
    }

    function ModificarCurso(Request $req) {
        if ($req->get('aceptar') == 'Guardar') {
            $query = "UPDATE `curso` SET `id`='" . $req->get('id') . "',`descripcion`='" . $req->get('descripcion') . "',`curso`='" . $req->get('curs') . "',`grupo`='" . $req->get('grupo') . "',`tutor`='" . $req->get('tutor') . "' WHERE `id` ='" . $req->get('id') . "'";
            \DB::select($query);
        }
        $datos = \Session::get('datos');
        $vista = 'Eleccion';
        $datos['tipo'] = 'Director';
        return view($vista, $datos);
    }

}
