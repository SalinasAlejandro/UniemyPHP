<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/cursos.php";

$_cursos = new cursos;
$datos = $_cursos->obtenerCursoById($idCurso);
unset($_cursos);

$_cursos = new cursos;
$niveles = $_cursos->obtenerNiveles($idCurso);
unset($_cursos);

$fecha = strtotime($datos[0]["fechaCreacion"]);
$datos[0]["fechaCreacion"] = date('d-M-Y', $fecha);
