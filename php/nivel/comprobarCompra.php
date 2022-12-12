<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/compras.php";

$_compras = new compras;
$compraCurso = $_compras->comprobarCurso($_SESSION["idUsuario"], $idCurso);
unset($_compras);

$compraNivel = 0;
if (!$compraCurso) {
    $_compras = new compras;
    $compraNivel = $_compras->comprobarCompraNivel($_SESSION["idUsuario"], $idNivel);
    unset($_compras);
}
