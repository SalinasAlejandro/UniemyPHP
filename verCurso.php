<?php
if (!isset($_GET["curso"])) {
    header("location:index.php");
} else {
    if ($_GET["curso"] == NULL) {
        header("location:cursos.php");
    }
}
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Curso</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/verCurso.css">
    <link href="utils/fontawesome/css/all.css" rel="stylesheet">

</head>

<body>

    <?php
    $direccion = dirname(__FILE__);
    include $direccion . "/navbar.php";
    if (!isset($_SESSION["idUsuario"])) {
        header("location:iniSesion.php");
    }
    $idEstudiante = $_SESSION["idUsuario"];
    $idCurso = $_GET["curso"];
    include $direccion . "/php/verCurso/datos.php";
    $idEscuela = $datos[0]["idEscuela"];
    $direccion = dirname(__FILE__);
    include $direccion . "/php/verCurso/comprobarCompra.php";
    ?>

    <div class="container">
        <div class="row arriba">
            <div class="col-lg-3 mb--30 center">
                <img class="img-fluid " src="<?php echo $datos[0]["imagen"]; ?>" alt="imagen de <?php echo $datos[0]["titulo"]; ?>">
                <?php //Si no es maestro, puede enviar mensajes al maestro del curso
                if (!$maestro) {
                    if (!$comprado) {
                ?>
                        <button class="btnComprar" data-toggle="modal" data-target="#comprarCurso">
                            <i class="fas fa-dollar-sign"></i><?php echo number_format($datos[0]["costo"], 2) . " MXN"; ?>
                        </button>
                    <?php
                    }
                    ?>
                    <div class="mensajeria" align=center>
                        <a class="btn btn-primary" href="mensajes.php?escuela=<?php echo $datos[0]["idEscuela"]; ?>&usuario=<?php echo $_SESSION['idUsuario']; ?>" role="button">Contactar al creador</a>
                    </div>
                    <?php
                } else {
                    if ($idEscuela == $_SESSION["idUsuario"]) {
                        $direccion = dirname(__FILE__);
                        include $direccion . "/php/verCurso/detallesAlumnos.php";
                    ?>
                        <div class="mensajeria" align=center>
                            <a class="btn btn-primary" role="button" id="detallitos" data-toggle="modal" data-target="#detallesAlum">Detalles de alumnos</a>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="col-lg-9">
                <div class="pl-lg ">
                    <h1 class="titulo"><?php echo $datos[0]["titulo"]; ?></h1>
                    <p class="autor">Creado por <?php echo $datos[0]["apellidoP"] . " " . $datos[0]["apellidoM"] . " " . $datos[0]["nombre"]; ?> el <?php echo $datos[0]["fechaCreacion"]; ?></p>
                    <div class="info">
                        <p>Categoría(s): <?php
                                            foreach ($datos as $categorias) {
                                                echo " . " . $categorias["categoria"] . " . ";
                                            } ?>
                        </p>
                        <div class="row val">
                            <div class="col-sm-6 text-left">
                                <?php
                                if ($datos[0]["calificacion"] != NULL) {
                                ?>
                                    <label><i class="far fa-thumbs-up"></i><?php echo $datos[0]["calificacion"]; ?>%</label>
                                <?php
                                } else {
                                ?>
                                    <label>Este curso aún no cuenta con reseñas</label>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-4 text-right">
                                <label>Con un total de <?php echo $datos[0]["Ventas"]; ?> ventas</label>
                            </div>
                        </div>
                    </div>
                    <p class="desc"><?php echo $datos[0]["descripcion"]; ?></p>
                </div>
            </div>
        </div>
        <hr>

        <?php
        if ($comprado == 1) {
        ?>
            <label>Inscrito desde el <?php echo $fechaCompra; ?></label>
            <?php
            if (!$terminado) {
                $direccion = dirname(__FILE__);
                include $direccion . "/php/verCurso/progreso.php";
            ?>
                <div class="course-progress__box">

                    <div class="course-progress__status">
                        <div class="course-status-new course-status-new--md js-course-status">
                            <div class="course-progress__title">
                                Progreso del curso
                            </div>
                            <div class="course-status-new__progress progress progress--md">
                                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="87.5" class="progress-bar progress-bar" role="progressbar" style="width: <?php echo $verAvance["numAvance"] / $verAvance["totalNiveles"] * 100; ?>%"></div>
                            </div>
                            <div class="course-status-new__label">
                                <span class="course-status-new__label__count">
                                    <?php echo $verAvance["numAvance"]; ?> niveles completados de <?php echo $verAvance["totalNiveles"]; ?> disponibles <?php if ($verAvance["fechaAvance"]) echo ", último avance fue el " . $verAvance["fechaAvance"]; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($esCertificado) {
                    ?>
                        <div class="course-progress__actions">
                            <input type="text" id="idEstudianteCer" name="idEstudianteCer" hidden="" value="<?php echo $_SESSION["idUsuario"]; ?>">
                            <input type="text" id="idCursoCer" name="idCursoCer" hidden="" value="<?php echo $idCurso; ?>">
                            <button id="btnFinalizarCurso" class="finalizarCurso">
                                <i class="fas fa-check-circle"></i> Finalizar Curso
                            </button>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="course-progress__actions">
                            <a class="btn btn-quaternary btn-xl btn-block-sm-down course-progress__btn js-course-progress__next-unit" href="nivel.php?curso=<?php echo $idCurso; ?>&numNivel=<?php echo $verAvance["numAvance"] + 1; ?>">Ir al nivel <?php echo $verAvance["numAvance"] + 1; ?></a>
                        </div>
                    <?php
                    }
                    ?>

                </div>
                <hr>
            <?php
            } else {
                $direccion = dirname(__FILE__);
                include $direccion . "/php/verCurso/fechaFinal.php";
            ?>
                <label>y finalizado el <?php echo $fechaFinal; ?></label>
                <a href="certificado.php?Curso=<?php echo $idCurso; ?>">
                    <button class="btnComprar"><i class="fas fa-check-circle"></i> Ver Certificado</button>
                </a>
                <hr>
                <?php
            }
        } else {
            if ($_SESSION["idUsuario"] == $idEscuela) {
                if (!$datos[0]["baja"]) {
                ?>
                    <a href="editarCurso.php?curso=<?php echo $idCurso; ?>"><button class="btnComprar" id="btnEditarCurso"><i class="fas fa-edit"></i> Editar curso</button></a>
                    <hr>
                    <button class="btnComprar" id="btnBaja"><i class="fas fa-skull"></i> Dar de baja el curso</button>
                    <hr>
        <?php
                }
            }
        }
        ?>

        <h3>Lista de Niveles</h3>
        <p>Un total de <?php echo $datos[0]["numNiveles"]; ?> nivel(es)</p>
        <ul class="list-group list-group-flush">
            <?php
            $direccion = dirname(__FILE__);
            require_once $direccion . "/classes/niveles.php";
            $_Progreso = new niveles;

            if ($niveles) {
                foreach ($niveles as $mostrar) { //foreach para mostrar los niveles del curso
                    $compraDeNivel = 0;
                    $href = ""; //variable para guardar el href del <a>
                    //primero comprueba si está comprado || si se vende individualmente y el costo es gratis
                    if ($comprado || $mostrar["ventaIndividual"] && !$mostrar["costoNivel"] || $idEscuela == $_SESSION["idUsuario"]) {
                        //si cumple con eso, entonces se permitirá redireccionar al nivel
                        $numNivel = $mostrar['numNivel'];
                        $href = 'href="nivel.php?curso=' . $idCurso . "&numNivel=" . $numNivel . '"';
                    } else {
                        if (!$comprado || $mostrar["ventaIndividual"] && $mostrar["costoNivel"]) {
                            if (isset($compradoNivel[0]["idNivel"])) {
                                foreach ($compradoNivel as $nivelesId) {
                                    if ($nivelesId["idNivel"] == $mostrar['idNivel']) {
                                        $compraDeNivel = 1;
                                        break;
                                    }
                                }
                                if ($compraDeNivel) {
                                    $numNivel = $mostrar['numNivel'];
                                    $href = 'href="nivel.php?curso=' . $idCurso . "&numNivel=" . $numNivel . '"';
                                }
                            }
                        }
                    }

                    if ($_Progreso->verProgreso($idEstudiante, $mostrar['idNivel'])) {
                        $clase = 'class="visto"';
                    } else {
                        $clase = '';
                    }
                    if ($_SESSION["tipo"] && $idEscuela != $_SESSION["idUsuario"]) {
                        $href = "";
                    }
            ?>
                    <li class="list-group-item">
                        <a <?php echo $href; ?> <?php echo $clase; ?>>
                            <h5>Nivel <?php echo $mostrar["numNivel"]; ?>: <?php echo $mostrar["titulo"]; ?></h5>
                        </a>
                        <?php
                        if (!$href && $mostrar["ventaIndividual"] && $mostrar["costoNivel"] && !$_SESSION["tipo"]) {
                        ?>
                            <button class="btnComprarN" data-toggle="modal" data-target="#comprarNivel" value="<?php echo $mostrar['idNivel']; ?>"><?php echo '$' . $mostrar['costoNivel'] . ' MXN' ?></button>
                        <?php
                        }
                        ?>
                    </li>

                <?php
                }
            } else {
                ?>
                <h3>Este curso aún no cuenta con niveles</h3>
            <?php
            }
            $direccion = dirname(__FILE__);
            include $direccion . "/php/verCurso/miReseña.php";
            ?>
        </ul>
        </br>

        <!-- ------------------------------------------ Poner una reseña ------------------------------------------ -->
        <hr>
        <div id="reseñas">
            <input type="text" id="terminado" name="terminado" hidden="" value="<?php echo $terminado ?>">
        </div> <!-- Con este id, cargamos reseñas.php en el js (ver_cursos.js) -->

    </div>

    <?php
    include "librerias.php";
    ?>
    <script src="js/verCurso.js"></script>

</body>

</html>

<!-- Modal Comprar Curso -->
<div class="modal fade" id="comprarCurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comprar Curso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="frmComprarCurso" autocomplete="off">
                    <input type="text" id="idEstudiante" name="idEstudiante" hidden="" value="<?php echo $idEstudiante ?>">
                    <input type="text" id="idCurso" name="idCurso" hidden="" value="<?php echo $idCurso ?>">
                    <input type="text" id="idEscuela" name="idEscuela" hidden="" value="<?php echo $idEscuela ?>">
                    <p><?php echo " " . $datos[0]["titulo"]; ?></p>
                    <p>Un total de <?php echo " $" . number_format($datos[0]["costo"], 2) . " MXN"; ?></p>
                    <label>Seleccionar Forma de Pago</label>
                    <select name="formaPago" id="formaPago">
                        <option value="0">Efectivo</option>
                        <option value="1">Tarjeta de Crédito</option>
                        <option value="2">Tarjeta de Débito</option>
                    </select>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnCerrarAct" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnComprarCurso">Comprar Curso</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Comprar Nivel -->
<div class="modal fade" id="comprarNivel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comprar Nivel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="frmComprarNivel" autocomplete="off">
                    <input type="text" id="idEstudiante" name="idEstudiante" hidden="" value="<?php echo $idEstudiante ?>">
                    <input type="text" id="idNivel" name="idNivel" hidden value="">
                    <input type="text" id="idEscuela" name="idEscuela" hidden="" value="<?php echo $idEscuela ?>">
                    <input type="text" id="idCurso" name="idCurso" hidden="" value="<?php echo $idCurso ?>">
                    <label>Seleccionar Forma de Pago</label>
                    <select name="formaPago" id="formaPago">
                        <option value="0">Efectivo</option>
                        <option value="1">Tarjeta de Crédito</option>
                        <option value="2">Tarjeta de Débito</option>
                    </select>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnCerrarAct" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnComprarNivel">Comprar Nivel</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal crear Reseña -->
<div class="modal fade" id="crearReseña" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Añadir Reseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="frmAñadirReseña" autocomplete="off">
                    <input type="text" id="idEstudiante" name="idEstudiante" hidden="" value="<?php echo $idEstudiante ?>">
                    <input type="text" id="idCurso" name="idCurso" hidden="" value="<?php echo $idCurso ?>">
                    <label>¿Te gustó el curso?</label>
                    <select name="valoracion" id="valoracion">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                    <label>Escribe un comentario</label>
                    <textarea name="comentario" id="comentario" cols="30" rows="10"></textarea>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnCerrarAReseña" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnAñadirReseña">Publicar Reseña</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal editar Reseña -->
<div class="modal fade" id="editarReseña" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Reseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="frmEditarReseña" autocomplete="off">
                    <input type="text" id="idEstudiante" name="idEstudiante" hidden="" value="<?php echo $idEstudiante ?>">
                    <input type="text" id="idCurso" name="idCurso" hidden="" value="<?php echo $idCurso ?>">
                    <label>¿Te gustó el curso?</label>
                    <select name="valoracionE" id="valoracionE">
                        <option value="1" selected>Sí</option>
                        <option value="0" <?php if (!$miReseña[0]["valoracion"]) echo " selected " ?>>No</option>
                    </select>
                    <label>Escribe un comentario</label>
                    <textarea name="comentarioE" id="comentarioE" cols="30" rows="10"><?php echo $miReseña[0]["comentario"]; ?></textarea>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnCerrarActE" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnEditarReseña">Editar Reseña</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal detalles de Alumnos -->
<div class="modal fade" id="detallesAlum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles de Alumnos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="tablaGestorDataTable">
                                <thead>
                                    <tr>
                                        <th>Alumno</th>
                                        <th>Fecha Inscripción</th>
                                        <th>Avance</th>
                                        <th>Pago</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($detallesAlum) {
                                        foreach ($detallesAlum as $mostrar) {
                                            if ($mostrar["idCertificacion"]) {
                                                $texto = "Finalizado";
                                            } else {
                                                $texto = "En curso";
                                            }
                                            $fecha = strtotime($mostrar["fechaCompra"]);
                                            $mostrar["fechaCompra"] = date('d-M-Y', $fecha);
                                    ?>
                                            <tr>
                                                <td><?php echo $mostrar["nombre"]; ?></td>
                                                <td><?php echo $mostrar["fechaCompra"]; ?></td>
                                                <td><?php echo $texto; ?></td>
                                                <td><?php
                                                    switch($mostrar["formaPago"]){
                                                        case "0":
                                                            echo "EFECTIVO";
                                                            break;
                                                        case "1":
                                                            echo "CRÉDITO";
                                                            break;
                                                        case "2":
                                                            echo "DÉBITO";
                                                            break;
                                                    }
                                                    ?></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnCerrarActE" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>