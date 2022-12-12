<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crear Curso</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/crearCurso.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/biblioteca.css">
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
    require_once $direccion . "/php/crearCurso/llenarCategorias.php";
    ?>

    <div class="container">

        <h1 class="text-center">Registrar Curso </h1>
        <hr>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">

                <form id="frmCurso" method="POST" autocomplete="off" onsubmit="return agregarCurso()">

                    <div class="filter dropdown">
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown">Categorías</button>
                        <ul class="dropdown-menu c4 genrez" style="min-width: max-content;">
                            <?php
                            if($categorias){
                            foreach ($categorias as $mostrar) {
                            ?>
                                <li><input type="checkbox" id="genre-action" name="cate[]" value="<?php echo $mostrar["id"]; ?>"><label><?php echo $mostrar["categoria"]; ?></label></li>
                            <?php
                            }
                            } else {
                            ?>
                                <p>No hay categorías</p>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div data-toggle="modal" data-target="#crearCate" id="divBtn">
                        <button type="button" class="btn btn-outline-secondary btnCate">Crear categoría</button>
                    </div>

                    <br>
                    <label>Título </label>
                    <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Título del curso">
                    <label>Descripción </label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="5" placeholder="Descripción del curso"></textarea>
                    <label>Costo del curso </label>
                    <input type="number" id="costo" name="costo" value="0.00" step=".01">
                    <small>Para indicar que tu curso es gratis, ingrese 0</small>

                    <div class="row btns">
                        <div class="col-sm-6 text-left">
                            <label class="btn btn-outline-secondary btnAvatar" for="imagen">Imagen del curso</label>
                            <input type="file" name="imagen" id="imagen" hidden="true" />
                            <input type="text" id="cover" name="cover" hidden="" value="">
                            <small id="smlCheck" class="invisible"><i class="far fa-check-circle"></i> Imagen cargada</small>
                        </div>
                        <div class="col-sm-6 text-right">
                            <input type="submit" value="Crear curso" class="btnSubmit">
                        </div>
                    </div>


                </form>

            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="crearCate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear nueva categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <p>Favor de verificar que la categoría que va a crear ya existe en la lista</p>
                    <form id="frmAñadirCate" autocomplete="off">
                        <label>Categoría</label>
                        <input type="text" id="categoria" name="categoria" class="form-control" value="">
                        <label>Descripción de la categoría</label>
                        <input type="text" id="descripcion" name="descripcion" class="form-control" value="">
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCerrarAct" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnAñadirCate">Añadir</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    $direccion = dirname(__FILE__);
    require_once $direccion . "/librerias.php";
    ?>
    <script src="utils/croppie/croppie.js"></script>
    <link rel="stylesheet" type="text/css" href="utils/croppie/croppie.css" />
    <script src="js/crearCurso.js"></script>

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