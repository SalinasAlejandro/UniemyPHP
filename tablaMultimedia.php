<?php
$direccion = dirname(__FILE__);
$idNivel = $_GET["idNivel"];
$creador = $_GET["creador"];
require_once $direccion . "/php/nivel/llenarTabla.php";
if ($multi) {
?>
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="tablaGestorDataTable">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Extensión de archivo</th>
                            <th>Descargar</th>
                            <?php
                            if ($creador) {
                            ?>
                                <th>Eliminar</th>
                            <?php
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($multi as $mostrar) {
                            $idMulti = $mostrar["idMulti"];
                        ?>
                            <tr>
                                <td><?php echo $mostrar["descripcion"]; ?></td>
                                <td><?php echo $mostrar["tipo"]; ?></td>
                                <td>
                                    <a href="<?php echo $mostrar["ruta"]; ?>" download="" class="btn btn-success btn-sm">
                                        <span class="fas fa-download"></span>
                                    </a>
                                </td>
                                <?php
                                if ($creador) {
                                ?>
                                    <td>
                                        <span class="btn btn-danger btn-sm" onclick="eiminarArchivo('<?php echo $idMulti; ?>')">
                                            <span class="fas fa-trash-alt"></span>
                                        </span>
                                    </td>
                                <?php
                                }
                                ?>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
<?php
} else {
?>
    <h2>No hay archivos por descargar</h2>
<?php
}
?>