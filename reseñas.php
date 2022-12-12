<?php
session_start();
$idCurso = $_GET["idCurso"];
?>
<?php //primero comprueba que se haya Finalizado
if ($_GET["terminado"]) { //si es así, entonces busca si ya se ha escrito una reseña
    $direccion = dirname(__FILE__);
    include $direccion . "/php/verCurso/miReseña.php";
    if (!$miReseña) { //Si no hay reseña, muestra el botón de añadir reseña
        $idEstudiante = $_GET['idEstudiante'];
?>
        <h3 style="display: inline; margin: 0px 20px;">Aún no has escrito una reseña</h3>
        <button data-toggle="modal" data-target="#crearReseña" type="button" class="btn btn-outline-secondary button-edit">
            Añadir reseña
        </button>
    <?php
    } else { //si ya existe una reseña del usuario, entonces la muestra junto con el botón de editar reseña
    ?>
        <div class="row">

            <div class="col-1"></div>
            <div class="col-2">
                <img src="<?php echo $_SESSION["avatar"]; ?>" width="100" height="100">
                <div> <strong><?php echo $_SESSION["nombreUsuario"]; ?></strong></div>
            </div>
            <div class="rightcol col-6">
                <div class="row">
                    <?php
                    if ($miReseña[0]["valoracion"]) { //comprueba el tipo de valoración que se dió para mostrar ya sea like o dislike
                    ?>
                        <div class="col-2">
                            <img src="img/like.png" width="60px" height="60px">
                        </div>
                        <div class="col-10">
                            <p>Recomendado</p>
                            <p><?php echo $miReseña[0]["fecha"]; ?></p>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-2">
                            <img src="img/dislike.png" width="60px" height="60px">
                        </div>
                        <div class="col-10">
                            <p>No Recomendado</p>
                            <p><?php echo $miReseña[0]["fecha"]; ?></p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <p><?php echo $miReseña[0]["comentario"]; ?></p>
            </div>
            <div class="col-3">
                <button data-toggle="modal" data-target="#editarReseña" type="button" class="btn btn-outline-secondary button-edit">
                    Editar reseña
                </button>
            </div>

        </div>

    <?php
    }
    ?>
    <hr>
<?php
} //Si no se ha terminado, no muestra nada de lo de arriba
?>
<!------------------------------------------------- Otras Reseñas --------------------------------------------------->
<div class="container">
    <?php
    $direccion = dirname(__FILE__);
    include $direccion . "/php/verCurso/reseñas.php";
    if ($reseñas) {
        echo '<h3 style="margin: 30px;">Comentarios</h3>';
        foreach ($reseñas as $mostrar) { //Si el curso tiene alguna reseña (incluyendo la del usuario), se muestran
            $fecha = strtotime($mostrar["fecha"]);
            $mostrar["fecha"] = date('d-M-Y', $fecha);
    ?>

            <div class="row">
                <div class="col-1"></div>
                <div class="col-2">
                    <img src="<?php echo $mostrar["avatar"]; ?>" width="100" height="100">
                    <div> <strong><?php echo $mostrar["nombre"] . " " . $mostrar["apellidoP"]; ?></strong></div>
                </div>
                <div class="rightcol col-6">
                    <div class="row">
                        <?php
                        if ($mostrar["valoracion"]) { //comprueba el tipo de valoración que se dió para mostrar ya sea like o dislike
                        ?>
                            <div class="col-2">
                                <img src="img/like.png" width="60px" height="60px">
                            </div>
                            <div class="col-10">
                                <p>Recomendado</p>
                                <p><?php echo $mostrar["fecha"]; ?></p>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-2">
                                <img src="img/dislike.png" width="60px" height="60px">
                            </div>
                            <div class="col-10">
                                <p>No Recomendado</p>
                                <p><?php echo $mostrar["fecha"]; ?></p>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <p><?php echo $mostrar["comentario"]; ?></p>
                </div>
            </div>
            <hr style="width: 90%;">
        <?php
        }
    } else {
        ?>
        <h3 align=center class="sincoment">Este curso aún no cuenta con reseñas</h3>
    <?php
    }
    ?>
</div>