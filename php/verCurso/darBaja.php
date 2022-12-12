<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/cursos.php";
$_cursos = new cursos;

echo $_cursos->darBaja($_POST["idCurso"]);