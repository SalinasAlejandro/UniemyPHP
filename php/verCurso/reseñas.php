<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/reseñas.php";
$_reseñas = new resenias;

$reseñas = $_reseñas->reseñas($idCurso);
