<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/multimedias.php";
$_multimedias = new multimedias;

$multi = $_multimedias->obtenerMultimedia($idNivel);
