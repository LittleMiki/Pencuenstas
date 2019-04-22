<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

                    $datos = ['alumno' => $req->get('usuario'),
                        'curso' => $curso,
                        'grupo' => $grupo,
                        'tipo' => 'alumno',
                    ];
                    $vista = 'Eleccion';
                   return view($vista, $datos);
                } 
                if($tabla == '`profesor`'){
                    
                    $query ="SELECT * FROM `profesor` WHERE `usuario` = '" . $req->get('usuario') . "'";
                    $resultado = \DB::select($query);
                    
                    $datos = ['usuario' => $req->get('usuario'),
                        'nombre' => $resultado[0]->nombre,
                        'tipo' => 'profesor',
                    ];
                    $vista = 'Eleccion';
                    return view($vista, $datos);
                }
                
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
        if ($req->get('boton') === 'Realizar Encuesta') {
            $query = "SELECT curso.grupo,curso.curso FROM modulo,modulocurso,curso,alumnomodulo WHERE modulo.id=modulocurso.IdModulo and curso.id = modulocurso.IdCurso and alumnomodulo.IdModulo=modulocurso.IdModulo and alumnomodulo.alumno= '" . \Session::get('usuario') . "'";
            $resultado = \DB::select($query);
            $curso = $resultado[0]->curso;
            $grupo = $resultado[0]->grupo;

            $datos = [
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

    function Gusuarios(Request $req){
       
        if(!empty($req->get('mat')) ){
            
            $query="SELECT `id` FROM `modulo` WHERE `descripcion` = '".$req->get('mat')."'";
            $resultado = \DB::select($query);
            $modulo = $resultado[0]->id;
            $query = "SELECT COUNT(*) as cantidad FROM alumnomodulo WHERE `IdModulo` = '".$modulo."'";
            $resultado = \DB::select($query);
            //dd($resultado);
            $cantidad =(int) $resultado[0]->cantidad;
            $usus="";
            for ($i=0;$i<$cantidad;$i++){
                $up="20".$i.$modulo;
                $usus = $usus."<tr><td>".$up."</td><td>".$up."</td></tr>";
            }
            
            $devolver = [
                'usus' => $usus,
            ];
            return view("Gusuarios",$devolver);
        }
    }
}
