<?php
if (isset($_GET["buscador"])) {
    if ($_GET["buscador"]) {
        header("location:buscar.php?buscar=" . $_GET["buscador"]);
    }
}
?>

<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">
        <img src="img/logo.png" class="logo"> Inicio
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="biblioteca.php?inicio=&final=">Biblioteca<span class="sr-only">(current)</span></a>
                </li>
            <?php
            if (isset($_SESSION['idUsuario'])) {
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="bandeja.php">Chat de mensajes</a>
                </li>
                <?php
                if ($_SESSION['tipo']) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="crearCurso.php">Crear Curso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="crearNivel.php">Crear Nivel</a>
                    </li>
                <?php
                }
                ?>
                <li class="nav-item">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown avatar">
                            <a class="nav-link dropdown-toggle caja" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-chevron-right"></i><?php echo ' ' . $_SESSION['nombreUsuario'] ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-info caja" aria-labelledby="navbarDropdownMenuLink-4">
                                <a class="dropdown-item" href="perfil.php"><span class="fas fa-user"> Perfil</a>
                                <a class="dropdown-item" href="php/cerrarSesion.php"><span class="fas fa-power-off"> Cerrar Sesión</a>
                            </div>
                        </li>
                    </ul>
                </li>
            <?php
            } else {
            ?>
                <li class="nav-item active">
                    <a class="nav-link" href="iniSesion.php">Iniciar Sesión<span class="sr-only">(current)</span></a>
                </li>
            <?php
            }
            ?>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input type="search" class="form-control" placeholder="Buscar en BDM" aria-label="Search" name="buscador" id="buscador" required>
        </form>
    </div>
</nav>