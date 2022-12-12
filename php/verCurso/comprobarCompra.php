<?php
$maestro = 0;
$comprado = 0;
$terminado = 0;
$compradoNivel = 0;
if (!$_SESSION["tipo"]) {
    $direccion = dirname(__FILE__);
    require_once $direccion . "/../../classes/compras.php";

    $_compras = new compras;
    $comprado = $_compras->comprobarCompraCurso($idEstudiante, $idCurso);
    unset($_compras);

    if (!$comprado) {
        $_compras = new compras;
        $compradoNivel = $_compras->comprobarComprasNivel($idEstudiante, $idCurso);
        unset($_compras);
    } else {
        $_compras = new compras;
        $fechaCompra = $_compras->getFecha($idEstudiante, $idCurso);
        unset($_compras);

        $fecha = strtotime($fechaCompra);
        $fechaCompra = date('d-M-Y', $fecha);
        
        $_compras = new compras;
        $terminado = $_compras->estaTerminado($idEstudiante, $idCurso);
        unset($_compras);
    }
} else {
    $maestro = 1;
}
