<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/avances.php";
$_avances = new avances;
$detallesAlum = $_avances->detallesAlum($idCurso);
