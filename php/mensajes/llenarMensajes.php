<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/mensajes.php";
$_mensajes = new mensajes;

$mensaje = $_mensajes->obtenerMensajes($idEstudiante, $idEscuela);
