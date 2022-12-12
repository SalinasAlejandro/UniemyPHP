<?php

$direccion = dirname(__FILE__);
require_once $direccion . '/conexion/conexion.php';

class multimedias extends conexion
{

    public function insertarMultimedia($datos)
    {
        $ruta = $datos["ruta"];
        $tipo = $datos["tipo"];
        $descripcion = $datos["descripcion"];
        $idNivel = $datos["idNivel"];

        $query = "call multimedia('0', '$ruta', '$tipo','$descripcion', '$idNivel', '0');";
        $resp = parent::nonQuery($query);
        if ($resp >= 1) {
            return $resp;
        } else {
            return 0;
        }
    }

    public function obtenerMultimedia($idNivel)
    {
        $query = "call multimedia('0', '0', '0','0', '$idNivel', '1');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["idMulti"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function obtenerRutaArchivo($idMulti)
    {
        $query = "call multimedia('$idMulti', '0', '0','0', '0', '2');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["ruta"])) {
            return $datos;
        } else {
            return 0;
        }
    }


    public function eliminarRegistroArchivo($idMulti)
    {
        $query = "call multimedia('$idMulti', '0', '0','0', '0', '3');";
        $resp = parent::nonQuery($query);
        if ($resp >= 1) {
            return $resp;
        } else {
            return 0;
        }
    }
}
