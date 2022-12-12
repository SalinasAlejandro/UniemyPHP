<?php
$idEstudiante = $_GET["idEstudiante"];
$idEscuela = $_GET["idEscuela"];
$emisor = $_GET["emisor"];
$direccion = dirname(__FILE__);
require_once $direccion . "/php/mensajes/llenarMensajes.php";
if ($mensaje) {
?>
    <div class="container2">

        <?php
        foreach ($mensaje as $mostrar) {
            if ($emisor == $mostrar["emisor"]) {
        ?>
                <div class="outgoing_msg">
                    <div class="sent_msg">
                        <p><?php echo $mostrar["mensaje"] ?></p>
                        <span class="time_date"><?php echo $mostrar["fecha"] ?></span>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="incoming_msg">
                    <div class="received_msg">
                        <div class="received_withd_msg">
                            <p><?php echo $mostrar["mensaje"] ?></p>
                            <span class="time_date"><?php echo $mostrar["fecha"] ?></span>
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
<h2 class="text-center">No tienes mensajes con esta persona</h2>
<?php
}
?>