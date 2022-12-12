<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/certificaciones.php";
$_certificaciones = new certificaciones;

$info = $_certificaciones->obtenerInfo($_SESSION["idUsuario"], $idCurso);

$fecha = strtotime($info['fecha']);
$info['fecha'] = date('d-M-Y',$fecha);