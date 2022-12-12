<?php

$direccion = dirname(__FILE__);
require_once $direccion . '/../../classes/cursos.php';

$_cursos = new cursos;

$idCurso = $_POST["idCurso"];
$costo = $_cursos->verPrecioCurso($idCurso);
echo $costo[0]["costo"];
