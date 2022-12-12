<?php

session_start();
$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/usuarios.php";

$_usuario = new usuarios;

$datosArray = $_usuario->borrarPerfil($_SESSION['idUsuario']);

echo $datosArray;
