<?php
session_start();
if (!isset($_GET["curso"]) || !isset($_GET["numNivel"])) {
    header("location:index.php");
} else {
    if ($_GET["curso"] == NULL || $_GET["numNivel"] == NULL) {
        header("location:index.php");
    }
}
$idCurso = $_GET["curso"];
$numNivel = $_GET["numNivel"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nivel</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/nivel.css">
    <link href="utils/fontawesome/css/all.css" rel="stylesheet">

</head>

<body>

    <?php
    $direccion = dirname(__FILE__);
    include $direccion . "/navbar.php";

    if (!isset($_SESSION['idUsuario'])) {
        header("location:index.php");
    }

    $direccion = dirname(__FILE__);
    require_once $direccion . "/php/nivel/datos.php";
    if (!$datos) {
        header("location:verCurso.php?curso=$idCurso");
    }

    $idNivel = $datos[0]["idNivel"];
    $direccion = dirname(__FILE__);
    require_once $direccion . "/php/nivel/comprobarCreador.php";
    $esCertificado = 0;
    if (!$creador) {
        $direccion = dirname(__FILE__);
        include $direccion . "/php/nivel/comprobarCompra.php";
        if (!$compraCurso && !$compraNivel) {
            $direccion = dirname(__FILE__);
            include $direccion . "/php/nivel/comprobarGratis.php";
            if (!$esGratis) {
                header("location:index.php");
            }
        } else {
            echo "holaaa";
            $direccion = dirname(__FILE__);
            include $direccion . "/php/nivel/avance.php";
        }
    }
    $direccion = dirname(__FILE__);
    require_once $direccion . "/php/nivel/antSig.php";
    ?>


    <div class="container">

        <h1>Nivel <?php echo $numNivel ?> - <?php echo $datos[0]["titulo"] ?></h1>
        <a href="verCurso.php?curso=<?php echo $idCurso; ?>">
            <h4><?php echo $datos[0]["tituloCurso"] ?></h4>
        </a>
        <h5>Realizado por: <?php echo $datos[0]["nombre"] . " " . $datos[0]["apellidoP"] . " " . $datos[0]["apellidoM"]; ?></h5>
        <div class="embed-responsive embed-responsive-21by9">
            <video align=center width="320" height="240" controls>
                <source src="<?php echo $datos[0]["videoCurso"] ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <br>
        <p><?php echo $datos[0]["descripcion"]; ?></p>
        <br>

        <hr>

        <?php
        if ($creador) {
        ?>
            <a href="editarNivel.php?curso=<?php echo $idCurso ?>&numNivel=<?php echo $numNivel ?>">
                <button class="finalizarCurso"> <i class="fas fa-edit"></i> Editar Nivel </button>
            </a>
            <hr>
        <?php
        }
        ?>


        <div class="recursos">
            <h3>Recursos Adicionales</h3>

            <?php
            if ($creador) {
            ?>
                <span class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarArchivos">
                    <span class="fas fa-plus-circle"></span>Agregar archivos
                </span>
            <?php
            }
            ?>
            <div id="tablaMultimedia"></div>
        </div>

        <hr>

        <br>
        <span class="r">
            <div class="nextprev">
                <?php
                if ($creador) {
                    $compraCurso = 1;
                }
                echo capAnt($ant, $idCurso, $numNivel, $compraCurso);
                echo capSig($sig, $idCurso, $numNivel, $compraCurso);
                ?>
            </div>
        </span>
        <br>
    </div>

    <?php
    if ($esCertificado == 1) {
    ?>
        <div class="container">
            <br>
            <input type="text" id="idEstudianteCer" name="idEstudianteCer" hidden="" value="<?php echo $_SESSION["idUsuario"]; ?>">
            <input type="text" id="idCursoCer" name="idCursoCer" hidden="" value="<?php echo $idCurso; ?>">
            <button id="btnFinalizarCurso" class="finalizarCurso">
                <i class="fas fa-check-circle"></i> Finalizar Curso
            </button>
        </div>
        <?php
    } else {
        if ($esCertificado == 2) {
        ?>
            <div class="container">
                <br>
                <input type="text" id="idEstudianteCer" name="idEstudianteCer" hidden="" value="<?php echo $_SESSION["idUsuario"]; ?>">
                <input type="text" id="idCursoCer" name="idCursoCer" hidden="" value="<?php echo $idCurso; ?>">
                <button id="btnFinalizarCurso" class="finalizarCurso">
                    <i class="fas fa-check-circle"></i> VER CERTIFICADO
                </button>
            </div>
    <?php
        }
    }
    ?>

    <?php
    $direccion = dirname(__FILE__);
    require_once $direccion . "/librerias.php";
    ?>
    <script src="js/nivel.js"></script>

</body>

</html>


<!-- MODAL PARA AGREGAR ARCHIVOS -->
<div class="modal fade" id="modalAgregarArchivos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Recurso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="frmArchivos" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <input type="text" id="idNivel" name="idNivel" hidden="" value="<?php echo $idNivel; ?>">
                    <input type="text" id="creador" name="creador" hidden="" value="<?php echo $creador; ?>">
                    <label>Descripción</label>
                    <input type="text" id="descripcion" name="descripcion" class="form-control" value="">
                    <label>Selecciona Archivos</label>
                    <input type="file" name="archivos[]" id="archivos" class="form-control" multiple="">
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarArchivos">Guardar</button>
            </div>
        </div>
    </div>
</div>