<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/certificaciones.php";
$_certificaciones = new certificaciones;

$fechaFinal = $_certificaciones->fechaFinal($idEstudiante, $idCurso);
$fecha = strtotime($fechaFinal);
$fechaFinal = date('d-M-Y', $fecha);