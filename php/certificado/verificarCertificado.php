<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/certificaciones.php";
$_certificaciones = new certificaciones;

$certificado = $_certificaciones->obtenerCertificado($idEstudiante, $idCurso);
