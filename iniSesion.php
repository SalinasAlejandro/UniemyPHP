<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Iniciar Sesión</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/iniSesion.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link href="utils/fontawesome/css/all.css" rel="stylesheet">

</head>

<body>

    <?php
    $direccion = dirname(__FILE__);
    require_once $direccion . "/navbar.php";
    ?>

    <div class="wrapper">
        <div id="formContent">
            <div>
                <img src="img/logo.png" id="icon" />
                <h1>Iniciar Sesión</h1>
            </div>
            <form method="POST" id="frmLogin" onsubmit="return logear()" autocomplete="off">
                <input type="text" id="login" name="login" placeholder="Correo">
                <input type="password" id="password" name="password" placeholder="Contraseña">
                <input type="submit" value="Entrar">
            </form>
            <div>
                <a class="registro" href="registro.php">¿No tiene cuenta? Registrese</a>
            </div>
        </div>
    </div>

    <?php
    $direccion = dirname(__FILE__);
    require_once $direccion . "/librerias.php";
    ?>
    <script src="js/iniSesion.js"></script>

</body>

</html>