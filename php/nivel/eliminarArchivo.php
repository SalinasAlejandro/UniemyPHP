<?php

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/multimedias.php";
$idMulti = $_POST['idMulti'];

$_multimedias = new multimedias;
$nombreArchivo = $_multimedias->obtenerRutaArchivo($idMulti);
unset($_multimedias);

$rutaEliminar = $direccion . "/../" . $nombreArchivo[0]["ruta"];
if (unlink($rutaEliminar)) {

    $_multimedias = new multimedias;
    echo $_multimedias->eliminarRegistroArchivo($idMulti);
    unset($_multimedias);
    
} else {
    echo 0;
}
