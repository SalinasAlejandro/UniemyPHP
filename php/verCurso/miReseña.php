<?php
if (!$_SESSION['tipo']) {
    $direccion = dirname(__FILE__);
    require_once $direccion . "/../../classes/reseñas.php";
    $_reseñas = new resenias;

    $miReseña = $_reseñas->miReseña($_SESSION["idUsuario"], $idCurso);
}