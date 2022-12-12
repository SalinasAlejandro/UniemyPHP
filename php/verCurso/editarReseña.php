<?php

$direccion = dirname(__FILE__);
require_once $direccion . '/../../classes/reseñas.php';

$_reseñas = new resenias;

$datos = array(
    "valoracion" => $_POST['valoracionE'],
    "comentario" =>  $_POST['comentarioE'],
    "idEstudiante" =>  $_POST['idEstudiante'],
    "idCurso" =>  $_POST['idCurso']
);

$datosArray = $_reseñas->editarReseña($datos);

echo $datosArray;
