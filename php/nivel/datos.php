<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/niveles.php";
$_niveles = new niveles;

$datos = $_niveles->obtenerNivel($idCurso, $numNivel);
