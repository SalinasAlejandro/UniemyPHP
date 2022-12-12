<?php

$direccion = dirname(__FILE__);
require_once $direccion . '/../../classes/reseñas.php';

$_reseñas = new resenias;

$datos = array(
    "valoracion" => $_POST['valoracion'],
    "comentario" =>  $_POST['comentario'],
    "idEstudiante" =>  $_POST['idEstudiante'],
    "idCurso" =>  $_POST['idCurso']
);

$datosArray = $_reseñas->añadirReseña($datos);

echo $datosArray;
