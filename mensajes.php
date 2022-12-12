<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mensajes</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/mensajes.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link href="utils/fontawesome/css/all.css" rel="stylesheet">

</head>

<body>

    <?php
    $direccion = dirname(__FILE__);
    include $direccion . "/navbar.php";
    if (!isset($_GET["escuela"]) || !isset($_GET["usuario"])) {
        header("location:index.php");
    } else {
        if ($_GET["escuela"] == NULL || $_GET["usuario"] == NULL) {
            header("location:index.php");
        } else {
            $idEstudiante = $_GET["usuario"];
            $idEscuela = $_GET["escuela"];
            $emisor = $_SESSION["tipo"];
        }
    }
    ?>

    </br>
    <div id="mensajesMostrar"></div>
    </br>

    <div class="container2">
        <div class="type_msg">

            <form id="frmMensaje" method="POST" autocomplete="off">

                <div class="row">
                    <div class="col-sm-11">
                        <input type="text" id="idEstudiante" name="idEstudiante" hidden="" value="<?php echo $idEstudiante ?>">
                        <input type="text" id="idEscuela" name="idEscuela" hidden="" value="<?php echo $idEscuela ?>">
                        <input type="text" id="emisor" name="emisor" hidden="" value="<?php echo $emisor ?>">
                        <textarea class="form-control" placeholder="Escribe una respuesta..." rows="3" name="mensaje" id="mensaje"></textarea>
                    </div>
                    <div class="col-sm-1">
                        <label class="btn btn-outline-secondary btnAvatar" id="submit">Enviar</label>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <?php
    $direccion = dirname(__FILE__);
    require_once $direccion . "/librerias.php";
    ?>
    <script src="js/mensajes.js"></script>

</body>

</html>