<?php

$direccion = dirname(__FILE__);
require_once $direccion . '/conexion/conexion.php';

class avances extends conexion
{

    public function obtenerAvance($idEstudiante, $idNivel)
    {
        $query = "call avances('$idEstudiante', '$idNivel', '0', '0');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["idAvance"])) {
            return 1;
        } else {
            return 0;
        }
    }

    public function añadirAvance($idEstudiante, $idCurso, $idNivel)
    {
        $query = "call avances('$idEstudiante', '$idNivel', '$idCurso', '1');";
        $resp = parent::nonQuery($query);
        if ($resp >= 1) {
            return $resp;
        } else {
            return 0;
        }
    }

    public function getNumAvance($idEstudiante, $idCurso)
    {
        $query = "SELECT functionNumAvance('$idEstudiante', '$idCurso') as numAvance;";
        $datos = parent::obtenerDatos($query);
        return $datos[0]["numAvance"];
    }

    public function getNumNiveles($idCurso)
    {
        $query = "call selectsConIdCurso('$idCurso', '3');";
        $datos = parent::obtenerDatos($query);
        return $datos[0]["numNiveles"];
    }

    public function getUltimaFecha($idEstudiante, $idCurso)
    {
        $query = "SELECT functionUltimoAvance('$idEstudiante', '$idCurso') as fecha;";
        $datos = parent::obtenerDatos($query);
        return $datos[0]["fecha"];
    }

    public function esCertificado($idEstudiante, $idCurso)
    {
        $query = "SELECT functionEsCertificado('$idEstudiante', '$idCurso') as certificado;";
        $datos = parent::obtenerDatos($query);
        return $datos[0]["certificado"];
    }

    public function detallesAlum($idCurso)
    {
        $query = "call getDetallesAlumnos('$idCurso');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["nombre"])) {
            return $datos;
        } else {
            return 0;
        }
    }
}
