<?php
namespace App\Modelo;
/**
 * Description of Bitacora
 *
 * @author faranzabe
 */
class Bitacora {
    public static $nombre_archivo = "Usuarios.txt"; 
 
    public static function guardarArchivo($mensa){
        $file = fopen(self::$nombre_archivo, "w");
        fwrite($file, $mensa . PHP_EOL);
        fclose($file);
    }
    
    public static function leerArchivo(){
        $file = fopen(self::$nombre_archivo, "r");
        while(!feof($file)) {
            echo fgets($file). "<br />";
        }
        fclose($file);
    }  
    
}

