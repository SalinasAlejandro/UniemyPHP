<?php

if ($_POST['usuario'] == null || $_POST['correo'] == null || $_POST['password'] == null || $_POST['apellidoP'] == null) {
    echo 1;
} else {
    if (!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
        echo 2;
    } else {
        if (strlen($_POST['password']) < 8 || !preg_match('`[a-z]`', $_POST['password']) || !preg_match('`[A-Z]`', $_POST['password']) || !preg_match('`[0-9]`', $_POST['password']) || $_POST['especial'] == "false") {
            echo 3;
        } else {
            if ($_POST['cover'] == null) {
                echo 5;
            } else {

                $direccion = dirname(__FILE__);
                require_once $direccion . '/../classes/usuarios.php';

                $_usuario = new usuarios;

                $apellidoM = null;
                if($_POST['apellidoM'] != null){
                    $apellidoM = $_POST['apellidoM'];
                }

                $datos = array(
                    "nombreUsuario" => htmlentities($_POST['usuario']),
                    "apellidoP" => htmlentities($_POST['apellidoP']),
                    "apellidoM" => htmlentities($apellidoM),
                    "correo" =>  htmlentities($_POST['correo']),
                    "contraseña" => htmlentities($_POST['password']),
                    "tipo" => $_POST['tipo'],
                    "avatar" => $_POST["cover"]
                );

                $datosArray = $_usuario->registrar($datos);

                echo $datosArray;
            }
        }
    }
}