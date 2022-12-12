<?php

$direccion = dirname(__FILE__);
require_once $direccion . '/conexion/conexion.php';

class certificaciones extends conexion
{

    public function añadirCertificado($idEstudiante, $idCurso)
    {
        $query = "SELECT certificados('$idEstudiante', '$idCurso', '1') as certificado;";
        $datos = parent::obtenerDatos($query);
        return $datos[0]["certificado"];
    }

    public function obtenerCertificado($idEstudiante, $idCurso)
    {
        $query = "SELECT certificados('$idEstudiante', '$idCurso', '0') as certificado;";
        $datos = parent::obtenerDatos($query);
        return $datos[0]["certificado"];
    }

    public function obtenerInfo($idEstudiante, $idCurso)
    {
        $query = "call getInfoCertificado('$idEstudiante', '$idCurso');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["fecha"])) {
            return $datos[0];
        } else {
            return 0;
        }
    }

    public function obtenerCertificaciones($idEstudiante)
    {
        $query = "call getInfoCertificado('$idEstudiante', '0')";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["idCertificacion"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function fechaFinal($idEstudiante, $idCurso)
    {
        $query = "call getFechaFinal('$idEstudiante', '$idCurso');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["fecha"])) {
            return $datos[0]["fecha"];
        } else {
            return 0;
        }
    }
}
