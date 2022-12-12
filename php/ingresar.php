<?php

if ($_POST['login'] == null || $_POST['password'] == null) {
    echo 2;
} else {

    session_start();
    $direccion = dirname(__FILE__);
    require_once $direccion . '/../classes/usuarios.php';

    $_usua = new usuarios;

    $datos = array(
        "nombreUsuario" => htmlentities($_POST['login']),
        "contraseña" => htmlentities($_POST['password'])
    );

    $datosArray = $_usua->login($datos);

    echo $datosArray;
}
