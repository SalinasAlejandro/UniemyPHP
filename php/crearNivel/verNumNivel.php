<?php

$direccion = dirname(__FILE__);
require_once $direccion . '/../../classes/niveles.php';

$_niveles = new niveles;

$idCurso = $_POST["idCurso"];
echo $_niveles->verNumNivel($idCurso);