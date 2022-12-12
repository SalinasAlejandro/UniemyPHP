<?php

if ($tipo) {

    $direccion = dirname(__FILE__);
    require_once $direccion . "/../../classes/cursos.php";
    $_cursos = new cursos;

    $misCursos = $_cursos->misCursos($idUsuario);
    
} else {

    $direccion = dirname(__FILE__);
    require_once $direccion . "/../../classes/compras.php";
    $_compras = new compras;
    $cursos = $_compras->cursosComprados($idUsuario);

    $direccion = dirname(__FILE__);
    require_once $direccion . "/../../classes/certificaciones.php";
    $_certificaciones = new certificaciones;
    $certificados = $_certificaciones->obtenerCertificaciones($idUsuario);
}
