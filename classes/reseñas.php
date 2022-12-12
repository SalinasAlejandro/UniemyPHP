<?php

$direccion = dirname(__FILE__);
require_once $direccion . '/conexion/conexion.php';

class resenias extends conexion
{

    public function miReseña($idEstudiante, $idCurso)
    {
        $query = "call resenias('0', '0', '$idEstudiante', '$idCurso', '2');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["idReseña"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function editarReseña($datos)
    {
        $valoracion = $datos["valoracion"];
        $comentario = $datos["comentario"];
        $idEstudiante = $datos["idEstudiante"];
        $idCurso = $datos["idCurso"];
        $query = "call resenias('$valoracion', '$comentario', '$idEstudiante', '$idCurso', '1');";
        $resp = parent::nonQuery($query);
        if ($resp >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function reseñas($idCurso)
    {
        $query = "call getReseñasInfo('$idCurso');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["idReseña"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function añadirReseña($datos)
    {
        $valoracion = $datos["valoracion"];
        $comentario = $datos["comentario"];
        $idEstudiante = $datos["idEstudiante"];
        $idCurso = $datos["idCurso"];
        $query = "call resenias('$valoracion', '$comentario', '$idEstudiante', '$idCurso', '0'); ";
        $resp = parent::nonQuery($query);
        if ($resp >= 1) {
            return 1;
        } else {
            return 0;
        }
    }
}
