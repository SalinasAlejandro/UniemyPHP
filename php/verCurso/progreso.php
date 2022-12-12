<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/avances.php";

$_avances = new avances;
$numAvance = $_avances->getNumAvance($idEstudiante, $idCurso);
unset($_avances);

$_avances = new avances;
$numNiveles = $_avances->getNumNiveles($idCurso);
unset($_avances);

$_avances = new avances;
$fecha = $_avances->getUltimaFecha($idEstudiante, $idCurso);
unset($_avances);

if ($fecha) {
    $fechaM = strtotime($fecha);
    $fecha = date('d-M-Y', $fechaM);
}
$verAvance = array(
    "numAvance" => $numAvance,
    "totalNiveles" => $numNiveles,
    "fechaAvance" => $fecha
);

$_avances = new avances;
$esCertificado = $_avances->esCertificado($idEstudiante, $idCurso);
unset($_avances);
