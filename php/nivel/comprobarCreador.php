<?php

if (!$_SESSION["tipo"]) {
    $creador = 0;
} else {

    $direccion = dirname(__FILE__);
    require_once $direccion . "/../../classes/niveles.php";
    $_niveles = new niveles;

    $creador = $_niveles->comprobarCreador($idCurso, $_SESSION["idUsuario"]);
    if (!$creador) {
        header("location:index.php");
    }
}
