<?php

$direccion = dirname(__FILE__);
require_once $direccion . '/../../classes/categorias.php';

$_categoria = new categorias;

$categorias = $_categoria->obtenerCategorias();