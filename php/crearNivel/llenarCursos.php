<?php

$direccion = dirname(__FILE__);
require_once $direccion . '/../../classes/cursos.php';

$_cursos = new cursos;

$idEscuela = $_SESSION["idUsuario"];
$cursos = $_cursos->obtenerCursosDeEscuela($idEscuela);
