<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Perfil</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/perfil.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link href="utils/fontawesome/css/all.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>


</head>

<body>

    <?php
    $direccion = dirname(__FILE__);
    include $direccion . "/navbar.php";

    if (!isset($_SESSION['idUsuario'])) {
        header("location:index.php");
    }
    $idUsuario = $_SESSION['idUsuario'];
    $nombreUsuario = $_SESSION['nombreUsuario'];
    $apellidoP = $_SESSION['apellidoP'];
    $apellidoM = $_SESSION['apellidoM'];
    $correo = $_SESSION['correo'];
    $avatar = $_SESSION['avatar'];
    $tipo = $_SESSION['tipo'];
    $fechaAlta = $_SESSION['fechaAlta'];

    $direccion = dirname(__FILE__);
    require_once $direccion . "/php/perfil/datos.php";
    ?>

    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-2">
                    <div>
                        <img class="img-profile" src="<?php echo $avatar ?>">
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <h2 class="username"><?php echo $nombreUsuario . " " . $apellidoP . " " . $apellidoM; ?></h2>
                    <p class="profile-datas">Correo: <?php echo $correo ?></p>
                    <label class="btn btn-outline-secondary btnAvatar" for="avatar">Cambiar Foto</label>
                    <input type="file" name="avatar" id="avatar" hidden="true" />
                    <div class="col-lg-6 btnEdit" data-toggle="modal" data-target="#editarPerfil">
                        <button type="button" class="btn btn-outline-secondary button-edit">Editar perfil</button>
                    </div>
                    <button type="button" id="btnBorrar" class="btn btn-outline-secondary button-borrar">Eliminar perfil</button>
                </div>
                <div class="col-sm-12 col-md-3">
                    <p></p>
                    <p>
                        Cuenta
                        <?php if ($tipo) { ?>
                            Académica
                        <?php } else { ?>
                            Estudiantil
                        <?php } ?>
                    </p>
                    <small class="profile-datas">Te uniste el <?php echo $fechaAlta ?>.</small>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1>Mis cursos</h1>
        <?php
        if ($tipo) {
        ?>

            <div class="row">
                <?php
                if (!$misCursos) {
                ?>
                    <h2 style="margin-top:60px; margin-left:18%" align=center>No ha creado ningún curso</h2>
                    <?php
                } else {
                    foreach ($misCursos as $mostrar) {
                    ?>

                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <a href="verCurso.php?curso=<?php echo $mostrar["idCurso"]; ?>">
                                    <img class="card-img-top" src="<?php echo $mostrar["imagen"]; ?>" alt="Card image cap">
                                </a>
                                <div class="card-body">
                                    <a href="verCurso.php?curso=<?php echo $mostrar["idCurso"]; ?>">
                                        <h5 class="card-title titulo"><?php echo $mostrar["titulo"]; ?></h5>
                                    </a>
                                    <?php
                                    if ($mostrar["costo"] > 0) {
                                    ?>
                                        <btn class="btn btn-primary detallesIngresos" data-toggle="modal" data-target="#verIngresos" value="<?php echo $mostrar["idCurso"]; ?>">Detalles de ingresos</btn>
                                        <input type="text" hidden value="<?php echo $mostrar["idCurso"]; ?>">
                                    <?php
                                    } else {
                                    ?>
                                        <small>Curso Gratuito</small>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>

        <?php
        } else {
        ?>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">En curso</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Completados</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <div class="row">
                        <?php
                        if (!$cursos) {
                        ?>
                            <h2 style="margin-top:60px; margin-left:18%" align=center>No tiene ningún curso pendiente</h2>
                            <?php
                        } else {
                            $noHay = 1;
                            foreach ($cursos as $mostrar) {
                                $enseñar = 1;
                                if ($certificados) {
                                    foreach ($certificados as $aVer) {
                                        if ($aVer["idCurso"] == $mostrar["idCurso"]) {
                                            $enseñar = 0;
                                        }
                                    }
                                }
                                if ($enseñar) {
                            ?>

                                    <div class="col-md-12 col-lg-6">
                                        <a href="verCurso.php?curso=<?php echo $mostrar["idCurso"]; ?>">
                                            <div class="card">
                                                <div class="row no-gutters">
                                                    <div class="col-md-7">
                                                        <img src="<?php echo $mostrar["imagen"]; ?>" alt="Imagen del curso <?php echo $mostrar["titulo"]; ?>">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?php echo $mostrar["titulo"]; ?></h5>
                                                            <p class="card-text"><?php echo $mostrar["descripcion"]; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                                    $noHay = 0;
                                }
                            }
                            if ($noHay) {
                                ?>
                                <h2 style="margin-top:60px; margin-left:18%" align=center>No tiene ningún curso pendiente</h2>
                        <?php
                            }
                        }
                        ?>
                    </div>

                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    <div class="row">
                        <?php
                        if (!$certificados) {
                        ?>
                            <h2 style="margin-top:60px; margin-left:18%" align=center>No ha terminado ningún Curso</h2>
                            <?php
                        } else {
                            foreach ($certificados as $mostrar) {
                            ?>

                                <div class="col-md-6 col-lg-4">
                                    <div class="card">
                                        <a href="verCurso.php?curso=<?php echo $mostrar["idCurso"]; ?>">
                                            <img class="card-img-top" src="<?php echo $mostrar["imagen"]; ?>" alt="Card image cap">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $mostrar["titulo"]; ?></h5>
                                            <a href="certificado.php?Curso=<?php echo $mostrar["idCurso"]; ?>" class="btn btn-primary">Obtener certificado</a>
                                        </div>
                                    </div>
                                </div>

                        <?php
                            }
                        }
                        ?>
                    </div>

                </div>
            </div>

        <?php
        }
        ?>
    </div>

    <?php
    $direccion = dirname(__FILE__);
    require_once $direccion . "/librerias.php";
    ?>
    <script src="utils/croppie/croppie.js"></script>
    <link rel="stylesheet" type="text/css" href="utils/croppie/croppie.css" />
    <script src="js/perfil.js"></script>

</body>

</html>

<div class="modal fade" id="uploadimageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Foto de Perfil</h5>
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
                <button type="button" class="btn btn-primary crop_image" id="btnActualizarAvatar">Modificar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editarPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="frmActualizarPerfil" autocomplete="off">
                    <input type="text" id="idUsuario" name="idUsuario" hidden="" value="<?php echo $idUsuario ?>">
                    <label>Nombre</label>
                    <input type="text" id="nombreUsuario" name="nombreUsuario" class="form-control" value="<?php echo $nombreUsuario ?>">
                    <label>Apellido Paterno</label>
                    <input type="text" id="apellidoP" name="apellidoP" class="form-control" value="<?php echo $apellidoP ?>">
                    <label>Apellido Materno</label>
                    <input type="text" id="apellidoM" name="apellidoM" class="form-control" value="<?php echo $apellidoM ?>">
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnCerrarAct" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnActualizarPerfil">Modificar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="verIngresos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloIngresos">Ingresos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <label>Ventas del curso: </label>
                <label id="ventasCurso">A</label>
                <br>
                <label>Total de Ingresos: </label>
                <label id="tIngresos">C</label>
                <br>
                <label>Ventas por efectivo: </label>
                <label id="vEfectivo">D</label>
                <br>
                <label>Ventas por tarjeta de Crédito: </label>
                <label id="vCredito">E</label>
                <br>
                <label>Ventas por tarjeta de Débito: </label>
                <label id="vDebito">F</label>
                <br>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnCerrarAct" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>