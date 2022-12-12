<?php
session_start();
$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/usuarios.php";
$avatar = new usuarios();
$idUsuario = $_SESSION['idUsuario'];

if (isset($_POST["image"])) {

    $rutaGuardado = "img/profiles/" . $idArchivo . "." . $extencion;
    $datosRegistroArchivo = array(
        "idUsuario" => $idUsuario,
        "avatar" => $_POST["image"]
    );
    $respuesta = $avatar->cambiarAvatar($datosRegistroArchivo);

    echo $respuesta;
} else {
    echo "no entró";
}
