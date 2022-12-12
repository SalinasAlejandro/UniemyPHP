<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/avances.php";

$_avances = new avances;
$avances = $_avances->obtenerAvance($_SESSION["idUsuario"], $idNivel);
unset($_avances);

if (!$avances) {
    $_avances = new avances;
    $_avances->añadirAvance($_SESSION["idUsuario"], $idCurso, $idNivel);
    unset($_avances);
}

$_avances = new avances;
$esCertificado = $_avances->esCertificado($_SESSION["idUsuario"], $idCurso);
unset($_avances);
