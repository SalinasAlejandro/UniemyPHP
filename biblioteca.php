<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Biblioteca</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/biblioteca.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link href="utils/fontawesome/css/all.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>


</head>

<body>

    <?php
    if (!isset($_GET['inicio'])) {
        header("location:biblioteca.php?inicio=&final=");
    }
    if (!isset($_GET['final'])) {
        header("location:biblioteca.php?inicio=&final=");
    }
    $direccion = dirname(__FILE__);
    include $direccion . "/navbar.php";
    $direccion = dirname(__FILE__);
    include $direccion . "/php/biblioteca/datos.php";
    ?>

    <div class="container">
        <div class="bixbox">
            <div class="releases">
                <h1>Lista de Cursos</h1>
            </div>
            <div class="mrgn">
                <div class="advancedsearch">
                    <div class="quickfilter">
                        <form action="" class="filters " method="GET">
                            <div class="filter dropdown">
                                <button type="button" class="dropdown-toggle" data-toggle="dropdown">Categoría</button>
                                <ul class="dropdown-menu c4 genrez" style="max-width: max-content;">
                                    <?php
                                    if($categorias){
                                    foreach ($categorias as $mostrar) {
                                    ?>
                                        <li><input type="checkbox" id="genre-action" name="genero[]" value="<?php echo $mostrar["id"]; ?>"><label><?php echo $mostrar["categoria"]; ?></label></li>
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
                            <div class="filter dropdown">
                                <button type="button" class="dropdown-toggle" data-toggle="dropdown">Maestro</button>
                                <ul class="dropdown-menu c4 genrez" style="max-width: max-content;">
                                    <?php
                                    if($maestros){
                                    foreach ($maestros as $mostrar) {
                                    ?>
                                        <li><input type="checkbox" id="maestro-action" name="maestro[]" value="<?php echo $mostrar["id"]; ?>"><label><?php echo $mostrar["nombre"]; ?></label></label></li>
                                    <?php
                                    }
                                    } else {
                                        ?>
                                        <p>No hay maestros</p>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="filter dropdown">
                                <button type="button" class="dropdown-toggle" data-toggle="dropdown">A partir del día</button>
                                <ul class="dropdown-menu c1">
                                    <input type="date" id="start" name="inicio" min="2021-01-01" max="2022-12-31">
                                </ul>
                            </div>
                            <div class="filter dropdown">
                                <button type="button" class="dropdown-toggle" data-toggle="dropdown"> hasta el día</button>
                                <ul class="dropdown-menu c1">
                                    <input type="date" id="final" name="final" min="2021-01-01" max="2022-12-31">
                                </ul>
                            </div>
                            <div class="filter submit"> <button type="submit" class="btn btn-custom-search"><i class="fa fa-search" aria-hidden="true"></i> Busscar</button></div>
                        </form>
                    </div>
                </div>

                <div class="listupd">
                    <div class="seccion">
                        <div class="gridContainer">
                            <?php
                            if (!isset($_GET["genero"]) && !isset($_GET["maestro"]) && ($_GET["inicio"] == NULL) && ($_GET["final"] == NULL)) {
                                $direccion = dirname(__FILE__);
                                include $direccion . "/php/biblioteca/todos.php";
                            } else {
                                $direccion = dirname(__FILE__);
                                include $direccion . "/php/biblioteca/filtros.php";
                            }
                            if ($todos) {
                                foreach ($todos as $mostrar) {
                            ?>

                                    <div class="tarjeta">
                                        <a href="verCurso.php?curso=<?php echo $mostrar["idCurso"]; ?>">
                                            <div class="tarjetaCuerpo">
                                                <img alt="Imagen de <?php echo $mostrar["titulo"]; ?>" class="tarjetaImagen" src="<?php echo $mostrar['imagen']; ?>">
                                                <p class="tituloTarjeta"><?php echo $mostrar["titulo"]; ?></p>
                                                <p class="autorTarjeta"><?php echo $mostrar["nombre"]; ?></p>
                                                <?php if ($mostrar["costo"] != 0) {
                                                ?>
                                                    <p class="precioTarjeta"><i class="fas fa-dollar-sign"><?php echo number_format($mostrar["costo"], 2); ?></i></p>
                                                <?php
                                                } else {
                                                ?>
                                                    <p class="precioTarjeta">Gratis</p>
                                                <?php
                                                }
                                                if ($mostrar["calificacion"] != NULL) {
                                                ?>
                                                    <p class="valTarjeta"><i class="far fa-thumbs-up"><?php echo $mostrar["calificacion"]; ?>%</i></p>
                                                <?php
                                                } else {
                                                ?>
                                                    <p class="valTarjeta">Sin reseñas</p>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </a>
                                    </div>

                                <?php
                                }
                            } else {
                                ?>
                                <h2>No hay concidencias</h2>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="hpage">
                        </div>

                    </div>
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
    <script src="js/perfil.js"></script>

</body>

</html>