<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/cursos.php";
$_cursos = new cursos;
$nuevos = $_cursos->obtenerCursoNuevos();
unset($_cursos);

$_cursos = new cursos;
$mejorCalif = $_cursos->obtenerCursoCalif();
unset($_cursos);

$_cursos = new cursos;
$masVendido = $_cursos->obtenerCursoVendido();
unset($_cursos);

$_cursos = new cursos;
$rand = $_cursos->obtenerCursoRandom();
unset($_cursos);
