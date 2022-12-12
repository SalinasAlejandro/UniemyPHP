<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bandeja de Mensajes</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/bandeja.css">
    <link href="utils/fontawesome/css/all.css" rel="stylesheet">

</head>

<body>

    <?php
    
    $direccion = dirname(__FILE__);
    include $direccion . "/navbar.php";
    if (!$_SESSION["idUsuario"]) {
        header("location:index.php");
    } else {
        $idUsuario = $_SESSION["idUsuario"];
    }
    require_once $direccion . "/php/bandeja/mostrarMisMensajes.php";
    ?>

    <div class="container">

        <h1>Mis mensajes</h1>
        <br>
        <?php
        if ($mensaje) {
        ?>
            <ul class="list-group list-group-flush">
                <?php
                if ($_SESSION["tipo"]) {
                    foreach ($mensaje as $mostrar) {
                        if ($idUsuario == $mostrar["idYo"]) {
                            $href = "mensajes.php?escuela=" . $idUsuario . "&usuario=" . $mostrar["idEnvie"];
                            $nombre = $mostrar["nomDos"] . " " . $mostrar["apePDos"] . " " . $mostrar["apreMDos"];
                        } else {
                            $href = "mensajes.php?escuela=" . $idUsuario . "&usuario=" . $mostrar["idYo"];
                            $nombre = $mostrar["nomUno"]. " " . $mostrar["apePUno"] . " " . $mostrar["apreMUno"];
                        }
                ?>
                        <li class="list-group-item">
                            <a href="<?php echo $href; ?>">
                                <h5><?php echo $nombre; ?></h5>
                            </a>
                        </li>
                    <?php
                    }
                } else {
                    foreach ($mensaje as $mostrar) {
                        if ($idUsuario == $mostrar["idYo"]) {
                            $href = "mensajes.php?escuela=" . $mostrar["idEnvie"] . "&usuario=" . $idUsuario;
                            $nombre = $mostrar["nomDos"] . " " . $mostrar["apePDos"] . " " . $mostrar["apreMDos"];
                        } else {
                            $href = "mensajes.php?escuela=" . $mostrar["idYo"] . "&usuario=" . $idUsuario;
                            $nombre = $mostrar["nomUno"]. " " . $mostrar["apePUno"] . " " . $mostrar["apreMUno"];
                        }
                    ?>
                        <li class="list-group-item">
                            <a href="<?php echo $href; ?>">
                                <h5><?php echo $nombre; ?></h5>
                            </a>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
        <?php
        } else {
        ?>
            <h2 align=center>No cuentas con mensajes</h2>
        <?php
        }
        ?>
    </div>


    <?php
    $direccion = dirname(__FILE__);
    require_once $direccion . "/librerias.php";
    ?>

</body>

</html>