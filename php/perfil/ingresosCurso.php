<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/cursos.php";
$_cursos = new cursos;

$ingresos = $_cursos->ingresosCurso($_POST["idCurso"]);

if($ingresos){
    echo json_encode($ingresos);
} else {
    echo "error";
}