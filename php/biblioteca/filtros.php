<?php

$where = "WHERE";

if (isset($_GET["genero"])) {
    foreach ($_GET["genero"] as $genero) {
        if (strcmp($where, "WHERE") != 0) {
            $where = $where . " OR ";
        }
        $where = $where . " idCategoria = '$genero'";
    }
}

if (isset($_GET["maestro"])) {
    foreach ($_GET["maestro"] as $maestro) {
        if (strcmp($where, "WHERE") != 0) {
            $where = $where . " OR ";
        }
        $where = $where . " idEscuela  = '$maestro'";
    }
}

if ($_GET["inicio"]) {
    if (strcmp($where, "WHERE") != 0) {
        $where = $where . " AND ";
    }
    $fecha = $_GET["inicio"];
    $where = $where . " fechaCreacion >= '$fecha'";
}

if ($_GET["final"]) {
    if (strcmp($where, "WHERE") != 0) {
        $where = $where . " AND ";
    }
    $fecha = $_GET["final"];
    $where = $where . " fechaCreacion <= '$fecha'";
}
if (strcmp($where, "WHERE") != 0) {

    $direccion = dirname(__FILE__);
    require_once $direccion . "/../../classes/cursos.php";
    $_cursos = new cursos;
    
    $todos = $_cursos->filtros($where);
    
}