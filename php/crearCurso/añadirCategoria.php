<?php

if ($_POST['categoria'] == null || $_POST['descripcion'] == null) {
    echo 3;
} else {
    $direccion = dirname(__FILE__);
    require_once $direccion . '/../../classes/categorias.php';

    $_categoria = new categorias;

    $datos = array(
        "categoria" => mb_strtoupper($_POST['categoria'], 'UTF-8'),
        "descripcion" =>  htmlentities($_POST['descripcion'])
    );

    $datosArray = $_categoria->añadirCategoria($datos);

    echo $datosArray;
    //echo $datos["categoria"];
}
