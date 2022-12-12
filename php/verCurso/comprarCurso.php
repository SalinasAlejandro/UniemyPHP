<?php

$datos = array(
    "formaPago" => $_POST['formaPago'],
    "idEstudiante" => $_POST['idEstudiante'],
    "idCurso" => $_POST['idCurso'],
    "idEscuela" => $_POST['idEscuela']
);

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/compras.php";
$_compras = new compras;

if ($_compras->insertarPagoCurso($datos)) {
    echo "1";
} else {
    echo "error";
}
