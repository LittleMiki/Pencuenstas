<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorMiguel extends Controller
{
    //
    function validarUsuario(Request $req){
        
        $vista='index';
        
        $query = "SELECT * FROM `alumno` WHERE `usuario` = '".$req->get('usuario')."'";
        $resultado = \DB::select($query);
        //dd($resultado[0]->usuario);
        if($resultado[0]->usuario == $req->get('usuario') ){
            if($resultado[0]->pass == $req->get('pass')){
                $vista='validado';
            }
        }
        return view($vista);
    }
     function Ajax() {
        
       $query="SELECT `Descripcion` FROM `modulo` ";
       $fechas=\DB::select($query);
       
        echo json_encode($fechas);
    }
}
