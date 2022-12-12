<?php

$direccion = dirname(__FILE__);
require_once $direccion . '/../../classes/mensajes.php';

$_mensaje = new mensajes;

$datos = array(
    "mensaje" => $_POST['mensaje'],
    "idEstudiante" => $_POST['idEstudiante'],
    "idEscuela" =>  $_POST['idEscuela'],
    "emisor" =>  $_POST['emisor']
);

if ($_mensaje->enviarMensaje($datos)) {
    unset($_mensaje);
    $_mensaje = new mensajes;
    
    session_start();
    if ($_SESSION["tipo"]) {
        $datosNuevos = array(
            "idYo" => $_POST['idEscuela'],
            "idEnvie" => $_POST['idEstudiante'],
        );
    } else {
        $datosNuevos = array(
            "idYo" => $_POST['idEstudiante'],
            "idEnvie" => $_POST['idEscuela'],
        );
    }
    $datosArray = $_mensaje->añadirBandeja($datosNuevos);
}

echo $datosArray;
