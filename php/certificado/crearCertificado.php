<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/certificaciones.php";
$_certificaciones = new certificaciones;

echo $_certificaciones->añadirCertificado($_POST["idEstudianteCer"], $_POST["idCursoCer"]);
