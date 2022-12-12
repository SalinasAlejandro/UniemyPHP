<?php

$direccion = dirname(__FILE__);
require_once $direccion . '/conexion/conexion.php';


class niveles extends conexion
{

    public function verNumNivel($idCurso)
    {
        $query = "call selectsConIdCurso('$idCurso', '0');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["nNivel"])) {
            $nNivel = $datos[0]["nNivel"] + 1;
            return $nNivel;
        } else {
            return 0;
        }
    }

    public function insertarNivel($datos)
    {
        $numNivel = $datos["numNivel"];
        $titulo = $datos["titulo"];
        $ventaIndividual = $datos["ventaIndividual"];
        $costoNivel = $datos["costoNivel"];
        $videoCurso = $datos["videoCurso"];
        $descripcion = $datos["descripcion"];
        $idCurso = $datos["idCurso"];
        $query = "call setNivel('$numNivel', '$titulo', '$ventaIndividual', '$costoNivel', '$videoCurso', 
                                '$descripcion', '$idCurso');";
        $resp = parent::nonQuery($query);
        if ($resp >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function obtenerNivel($idCurso, $numNivel)
    {
        $query = "call getNivelInfo('$idCurso', '$numNivel');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["idNivel"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function comprobarCreador($idCurso, $idEscuela)
    {
        $query = "call getCreador('$idCurso', '$idEscuela');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["titulo"])) {
            return 1;
        } else {
            return 0;
        }
    }

    public function nivelAnt($idCurso, $Nivel)
    {
        $query = "call nivelSigAnt('$idCurso', '$Nivel', '0');";
        $datos = parent::obtenerDatos($query);
        if ($datos[0]["existeNivel"] > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function nivelSig($idCurso, $Nivel)
    {
        $query = "call nivelSigAnt('$idCurso', '$Nivel', '1');";
        $datos = parent::obtenerDatos($query);
        if ($datos[0]["existeNivel"] > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function verProgreso($idEstudiante, $idNivel)
    {
        $query = "SELECT idAvance FROM t_avances WHERE idEstudiante = '$idEstudiante' AND idNivel = '$idNivel';";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["idAvance"])) {
            return 1;
        } else {
            return 0;
        }
    }

    public function editarNivel($datos)
    {
        $idNivel = $datos["idNivel"];
        $titulo = $datos["titulo"];
        $descripcion = $datos["descripcion"];
        $ventaIndividual = $datos["ventaIndividual"];
        $costoNivel = $datos["costoNivel"];
        $videoCurso = $datos["videoCurso"];
        $pOpcion = $datos["pOpcion"];

        $query = "call editarNivel('$idNivel', '$titulo', '$descripcion', '$ventaIndividual', '$costoNivel', 
                                '$videoCurso', '$pOpcion');";
        return parent::nonQuery($query);
    }

}
