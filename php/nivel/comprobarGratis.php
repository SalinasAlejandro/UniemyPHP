<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/cursos.php";

$_cursos = new cursos;
if (!$_SESSION["tipo"]) {
    $esGratis = $_cursos->esGratis($idCurso, $idNivel);
    $compraCurso = 0;
}
