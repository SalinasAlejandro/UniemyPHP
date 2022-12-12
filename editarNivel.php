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

    <title>Editar Nivel</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/crearNivel.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link href="utils/fontawesome/css/all.css" rel="stylesheet">

</head>

<body>

    <?php
    $direccion = dirname(__FILE__);
    require_once $direccion . "/navbar.php";
    if (!isset($_SESSION['tipo']) || !$_SESSION['tipo']) {
        header("location:index.php");
    }

    $direccion = dirname(__FILE__);
    require_once $direccion . "/php/nivel/datos.php";
    if (!$datos) {
        header("location:verCurso.php?curso=$idCurso");
    }
    ?>

    <div class="container">

        <h1 class="text-center"> Editar Nivel </h1>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">

                <form id="frmNivel" method="POST" autocomplete="off" enctype="multipart/form-data">

                    <input type="text" id="idNivel" name="idNivel" hidden="" value="<?php echo $datos[0]["idNivel"]; ?>">
                    <input type="text" id="idCurso" name="idCurso" hidden="" value="<?php echo $idCurso; ?>">
                    <input type="text" id="numNivel" name="numNivel" hidden="" value="<?php echo $numNivel; ?>">

                    <label>Título del Nivel </label>
                    <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Titulo del nivel" value="<?php echo $datos[0]["titulo"]; ?>">

                    <label>Descripción del Nivel </label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="5" placeholder="Descripción"><?php echo $datos[0]["descripcion"]; ?></textarea>
                    <br>
                    <div id="seccionPrecio1">
                        <label>¿El nivel pueda ser comprado individualmente o está gratis?</label>
                        <select name="ventaIndividual" id="ventaIndividual">
                            <option value="0" selected>No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>
                    <div id="seccionPrecio2">
                        <label>Costo del Nivel: (Marcar 0 si quiere que sea gratis)</label>
                        <input type="number" id="costoNivel" name="costoNivel" placeholder="Costo del curso" min="0" value="0.00" step=".01"><br>
                    </div>
                    <br>

                    <div class="row btns">
                        <div class="col-sm-6 text-left">
                            <label class="btn btn-outline-secondary btnAvatar" for="videoCurso">Editar vídeo</label>
                            <input type="file" name="videoCurso[]" id="videoCurso" hidden="true" />
                            <small id="smlCheck"><i class="far fa-check-circle"></i> Vídeo cargado</small>
                            <input type="hidden" id="nNivel" name="nNivel" value="0">
                            <input type="hidden" id="esCursoGratis" name="esCursoGratis" value="1">
                        </div>
                        <div class="col-sm-6 text-right">
                            <button type="button" onclick="editarNivel()" id="btnAñadir" class="btn btn-primary btnAñadir">Editar nivel</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
    <?php
    $direccion = dirname(__FILE__);
    require_once $direccion . "/librerias.php";
    ?>
    <script src="js/editarNivel.js"></script>

</body>

</html>