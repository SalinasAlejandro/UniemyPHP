<?php
//Comprobar ANTerior y SIGuiente

$direccion = dirname(__FILE__);
require_once $direccion . "/../../classes/niveles.php";

$_niveles = new niveles;

$ant = false;
$sig = false;
if ($_niveles->nivelAnt($idCurso, $numNivel)) {
    $ant = true;
}
unset($_niveles);
$_niveles = new niveles;
if ($_niveles->nivelSig($idCurso, $numNivel)) {
    $sig = true;
}

function capAnt($ant, $idCurso, $numNivel, $compraCurso)
{
    if ($compraCurso) {
        if ($ant == true) {
            $pagina = $numNivel - 1;
            echo '<a href="nivel.php?curso=' . $idCurso . '&numNivel=' . $pagina . '" rel="prev">
            <i class="fas fa-angle-left"></i> Nivel previo
        </a>';
        } else {
            echo '<a class="disabled" rel="prev">
        <i class="fas fa-angle-left"></i> Nivel previo
        </a>';
        }
    } else {
        echo '<a href="verCurso.php?curso=' . $idCurso . '" rel="prev">
        <i class="fas fa-angle-up"></i> Ir al curso
        </a>';
    }
}
function capSig($sig, $idCurso, $numNivel, $compraCurso)
{
    if ($compraCurso) {
        if ($sig == true) {
            $pagina = $numNivel + 1;
            echo '<a href="nivel.php?curso=' . $idCurso . '&numNivel=' . $pagina . '" rel="next">
            Siguiente Nivel <i class="fas fa-angle-right"></i>
        </a>';
        } else {
            echo '<a class="disabled" rel="next">
            Siguiente Nivel <i class="fas fa-angle-right"></i>
        </a>';
        }
    }
}
