<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrarse</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/registro.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link href="utils/fontawesome/css/all.css" rel="stylesheet">

</head>

<body>

    <?php
    $direccion = dirname(__FILE__);
    require_once $direccion . "/navbar.php";
    ?>

    <div class="container registro">
        <h1 class="text-center">Registro de Usuario</h1>
        <hr>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form id="frmRegistro" method="POST" onsubmit=" return agregarUsuarioNuevo()" autocomplete="off" enctype="multipart/form-data">
                    <label>Nombre*</label>
                    <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Nombre de Usuario">
                    <label>Apellido paterno*</label>
                    <input type="text" name="apellidoP" id="apellidoP" class="form-control" placeholder="Apellido Paterno">
                    <label>Apellido Materno</label>
                    <input type="text" name="apellidoM" id="apellidoM" class="form-control" placeholder="Apellido Materno">
                    <label>Correo electrónico*</label>
                    <input type="text" name="correo" id="correo" class="form-control" placeholder="Correo electrónico">
                    <label>Contraseña*</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
                    <small>*La contraseña debe contener mínimo 8 caracteres, 1 mayúscula, 1 minúscula, 1 caracter especial y 1 número</small><br>
                    <input type="hidden" name="especial" id="especial" value="">
                    <label>Tipo de usuario</label>
                    <p style="margin-left:50px;">
                        <input type="radio" name="tipo" value="0" checked> Estudiante
                        <input type="radio" name="tipo" value="1"> Académica
                    </p>
                    <div class="row">
                        <div class="col-sm-12 text-left">
                            <label class="btn btn-outline-secondary btnAvatar" for="imagen">Subir imagen de perfil*</label>
                            <input type="file" name="imagen" id="imagen" hidden="true" />
                            <input type="text" id="cover" name="cover" hidden="" value="">
                            <small id="smlCheck" class="invisible"><i class="far fa-check-circle"></i> Imagen cargada</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <a href="iniSesion.php" class="btn btn-success iniSesion">Cancelar</a>
                        </div>
                        <div class="col-sm-6 text-right">
                            <button class="btn btn-primary registrar">Registrarse</button>
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
    <script src="utils/croppie/croppie.js"></script>
    <link rel="stylesheet" type="text/css" href="utils/croppie/croppie.css" />
    <script src="js/registro.js"></script>


</body>

</html>

<div class="modal fade" id="uploadimageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Imagen del curso</h5>
                <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 text-center">
                        <div id="image_demo" style="width:350px; margin-top:30px"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrar" id="btnCerrarAct" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary crop_image" id="btnActualizarPerfil">Aceptar</button>
            </div>
        </div>
    </div>
</div>