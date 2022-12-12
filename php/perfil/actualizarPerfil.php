<?php
session_start();
if ($_POST['nombreUsuario'] == null || $_POST['apellidoP'] == null || $_POST['apellidoM'] == null) {
    echo 3;
} else {

    $direccion = dirname(__FILE__);
    require_once $direccion . '/../../classes/usuarios.php';

    $_usuario = new usuarios;

    $datos = array(
        "idUsuario" => $_POST['idUsuario'],
        "nombreUsuario" => htmlentities($_POST['nombreUsuario']),
        "apellidoP" =>  htmlentities($_POST['apellidoP']),
        "apellidoM" => htmlentities($_POST['apellidoM'])
    );

    $datosArray = $_usuario->actualizarPerfil($datos);

    echo $datosArray;

}
