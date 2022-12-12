<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/categorias.php";
$_cate = new categorias;

$categorias = $_cate->obtenerCategorias();


$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/usuarios.php";
$_usua = new usuarios;

$maestros = $_usua->getMaestros();
