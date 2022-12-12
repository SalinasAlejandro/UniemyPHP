<?php

$datos = array(
    "formaPago" => $_POST['formaPago'],
    "idEstudiante" => $_POST['idEstudiante'],
    "idNivel" => $_POST['idNivel'],
    "idEscuela" => $_POST['idEscuela'],
    "idCurso" => $_POST['idCurso']
);

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/compras.php";
$_compras = new compras;

if ($_compras->insertarPagoNivel($datos)) {
    echo "1";
} else {
    echo "error";
}