<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/cursos.php";
$_cursos = new cursos;

$todos = $_cursos->todosCursos();
