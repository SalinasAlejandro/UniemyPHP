<?php

$direccion = dirname(__FILE__);
require_once $direccion . '/conexion/conexion.php';

class compras extends conexion
{

    public function comprobarCompraNivel($idEstudiante, $idNivel)
    {
        $query = "SELECT functionEstaComprado('$idEstudiante', '$idNivel', '2') as comprado;";
        $datos = parent::obtenerDatos($query);
        return $datos[0]["comprado"];
    }

    public function comprobarCurso($idEstudiante, $idCurso)
    {
        $query = "SELECT functionEstaComprado('$idEstudiante', '$idCurso', '0') as comprado;";
        $datos = parent::obtenerDatos($query);
        return $datos[0]["comprado"];
    }

    public function comprobarCompraCurso($idEstudiante, $idCurso)
    {
        $query = "SELECT functionEstaComprado('$idEstudiante', '$idCurso', '1') as comprado;";
        $datos = parent::obtenerDatos($query);
        return $datos[0]["comprado"];
    }

    public function comprobarComprasNivel($idEstudiante, $idCurso)
    {
        $query = "call getCompraNivel('$idEstudiante', '$idCurso');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["idNivel"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function getFecha($idEstudiante, $idCurso)
    {
        $query = "call others('$idEstudiante', '$idCurso', '0');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["fechaCompra"])) {
            return $datos[0]["fechaCompra"];
        } else {
            return 0;
        }
    }

    public function estaTerminado($idEstudiante, $idCurso)
    {
        $query = "call others('$idEstudiante', '$idCurso', '1');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["idCertificacion"])) {
            return 1;
        } else {
            return 0;
        }
    }

    public function insertarPagoCurso($datos)
    {
        $formaPago = $datos["formaPago"];
        $idEstudiante = $datos["idEstudiante"];
        $idCurso = $datos["idCurso"];
        $idEscuela = $datos["idEscuela"];
        $query = "call setCompraCurso('$formaPago', '$idEstudiante', '$idCurso', '$idEscuela'); ";
        $resp = parent::nonQuery($query);
        if ($resp >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function insertarPagoNivel($datos)
    {
        $formaPago = $datos['formaPago'];
        $idEstudiante = $datos['idEstudiante'];
        $idNivel = $datos['idNivel'];
        $idEscuela = $datos['idEscuela'];
        $idCurso = $datos['idCurso'];
        $query = "call setCompraNivel('$formaPago', '$idEstudiante', '$idNivel', '$idEscuela', '$idCurso');";
        $resp = parent::nonQuery($query);
        if ($resp >= 1) {
            return $resp;
        } else {
            return 0;
        }
    }

    public function cursosComprados($idEstudiante)
    {
        $query = "call getMisCursos('$idEstudiante', '1');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["idCurso"])) {
            return $datos;
        } else {
            return 0;
        }
    }
}
