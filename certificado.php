<?php
session_start();
if (!isset($_SESSION["idUsuario"]) || !isset($_GET["Curso"])) {
    header("location:index.php");
} else {
    if ($_SESSION["tipo"] || $_GET["Curso"] == NULL) {
        header("location:index.php");
    } else {
        $idCurso = $_GET["Curso"];
        $idEstudiante = $_SESSION["idUsuario"];
        $direccion = dirname(__FILE__);
        include_once  $direccion . "/php/certificado/verificarCertificado.php";
        if (!$certificado) {
            header("location:index.php");
        }
        $direccion = dirname(__FILE__);
        include_once  $direccion . "/php/certificado/info.php";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Certificado</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/certificado.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link href="utils/fontawesome/css/all.css" rel="stylesheet">

</head>

<body>

    <header>
        <br>
        <a href="perfil.php"><img src="img/logo.png"></a>
        <br>
        <h1><strong>Felicitaciones </strong> </h1>
        <br>
        <h4>UNIDEMY</h4>
        <h4>ortorga su certificado por haber concluido el curso </h4>

    </header>
    <main>

        <input type="text" id="nombreEstudiante" name="nombreEstudiante" hidden="" value="<?php echo $_SESSION['nombreUsuario']; ?>">
        <input type="text" id="apellidos" name="apellidos" hidden="" value="<?php echo $_SESSION['apellidoP'] . " " . $_SESSION['apellidoM']; ?>">
        <input type="text" id="nombreCurso" name="nombreCurso" hidden="" value="<?php echo $info['titulo']; ?>">
        <input type="text" id="nombreMaestro" name="nombreMaestro" hidden="" value="<?php echo $info['nombre'] . " " . $info['apP']; ?>">
        <input type="text" id="fecha" name="fecha" hidden="" value="<?php echo $info['fecha']; ?>">
        <input type="text" id="idCurso" name="idCurso" hidden="" value="<?php echo $idCurso; ?>">
        <br><br><br>
        <Button id="submitBtn">Descargar Certificado</Button>
        <br>
        <a href="perfil.php"><button>Ir a mi Perfil</button></a>


    </main>
    <?php
    include "librerias.php";
    ?>
    <script src="https://unpkg.com/pdf-lib@1.4.0"></script>
    <script src="js/guardadocertificado.js"></script>
    <script src="https://unpkg.com/@pdf-lib/fontkit@0.0.4"></script>
    <script src="js/certificado.js"></script>

</body>

</html>