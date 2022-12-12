<?php

$direccion = dirname(__FILE__);
require_once $direccion . '/conexion/conexion.php';


class mensajes extends conexion
{

    public function obtenerMisMensajes($idUsuario)
    {
        $query = "call getMisMensajes('$idUsuario', '$idUsuario');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["idYo"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function obtenerMensajes($idEstudiante, $idEscuela)
    {
        $query = "call mensajes('$idEstudiante', '$idEscuela');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["mensaje"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function enviarMensaje($datos)
    {
        $mensaje = $datos["mensaje"];
        $idEstudiante = $datos["idEstudiante"];
        $idEscuela = $datos["idEscuela"];
        $emisor = $datos["emisor"];
        $query = "call setNuevoMensaje('$mensaje', '$idEstudiante', '$idEscuela', '$emisor'); ";
        $resp = parent::nonQuery($query);
        if ($resp >= 1) {
            return $resp;
        } else {
            return 0;
        }
    }

    public function añadirBandeja($datos)
    {
        $idYo = $datos["idYo"];
        $idEnvie = $datos["idEnvie"];

        $query = "SELECT functionSetBandeja('$idYo', '$idEnvie') as bandeja;";
        $datos = parent::obtenerDatos($query);
        return $datos[0]["bandeja"];
    }
    
}
