<?php
session_start();
if (!isset($_GET["buscar"])) {
    header("location:index.php");
} else {
    $buscar = $_GET["buscar"];
    if ($buscar == null) {
        header("location:index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Buscador</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/biblioteca.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link href="utils/fontawesome/css/all.css" rel="stylesheet">

</head>

<body>

    <?php
    $direccion = dirname(__FILE__);
    include $direccion . "/navbar.php";
    ?>

    <article id="noticias">
        <div class="container">
            <div class="bixbox">
                <div class="releases">
                    <h1>Busqueda de Cursos</h1>
                </div>
                <div class="mrgn">

                    <div class="listupd">
                        <div class="seccion">
                            <div class="gridContainer">
                                <?php
                                include $direccion . "/php/buscar/buscar.php";
                                if ($datos) {
                                    foreach ($datos as $mostrar) {
                                ?>

                                        <div class="tarjeta">
                                            <a href="verCurso.php?curso=<?php echo $mostrar["idCurso"]; ?>">
                                                <div class="tarjetaCuerpo">
                                                    <img alt="Imagen de <?php echo $mostrar["titulo"]; ?>" class="tarjetaImagen" src="<?php echo $mostrar['imagen']; ?>">
                                                    <p class="tituloTarjeta"><?php echo $mostrar["titulo"]; ?></p>
                                                    <p class="autorTarjeta"><?php echo $mostrar["nombre"]; ?></p>
                                                    <?php if ($mostrar["costo"] != 0) {
                                                    ?>
                                                        <p class="precioTarjeta"><i class="fas fa-dollar-sign"><?php echo number_format($mostrar["costo"], 2); ?></i></p>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <p class="precioTarjeta">Gratis</p>
                                                    <?php
                                                    }
                                                    if ($mostrar["calificacion"] != NULL) {
                                                    ?>
                                                        <p class="valTarjeta"><i class="far fa-thumbs-up"><?php echo $mostrar["calificacion"]; ?>%</i></p>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <p class="valTarjeta">Sin reseñas</p>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </a>
                                        </div>

                                    <?php
                                    }
                                } else {
                                    ?>
                                    <h2>No hay concidencias</h2>
                                <?php
                                }
                                ?>
                            </div>

                            <div class="hpage">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </article>

    <?php
    $direccion = dirname(__FILE__);
    require_once $direccion . "/librerias.php";
    ?>
    <script src="utils/croppie/croppie.js"></script>
    <link rel="stylesheet" type="text/css" href="utils/croppie/croppie.css" />
    <script src="js/perfil.js"></script>

</body>

</html>