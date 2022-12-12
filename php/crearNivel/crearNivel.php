<?php

if ($_POST["idCurso"] == -1) {
    echo 2;
} else {
    if ($_POST["titulo"] == NULL || $_POST["descripcion"] == NULL) {
        echo 3;
    } else {
        $files_post = $_FILES['videoCurso'];

        $files = array();
        $file_count = count($files_post['name']);
        $file_key = array_keys($files_post);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_key as $key) {
                $files[$i][$key] = $files_post[$key][$i];
            }
        }
        if ($files[0]['name'] == "") {
            echo 4;
        } else {
            $nombreArchivo = $_FILES['videoCurso']['name'][0];
            $explode = explode('.', $nombreArchivo);
            $tipoArchivo = array_pop($explode);
            if (strcmp($tipoArchivo, "mp4") != 0) {
                echo 5;
            } else {
                if ($_POST["costoNivel"] < 0.0 && $_POST["ventaIndividual"] == 1) {
                    echo 6;
                } else {

                    $direccion = dirname(__DIR__);
                    $rutaAlmacenamiento = $_FILES['videoCurso']['tmp_name'][0];
                    $idArchivo = uniqid();
                    $rutaFinal = $direccion . "\\..\\img\\niveles\\" . $idArchivo . "." . $tipoArchivo;
                    $rutaGuardado = "img/niveles/" . $idArchivo . "." . $tipoArchivo;
                    $costoNivel = number_format($_POST["costoNivel"], 2);
                    $datos = array(
                        "numNivel" => $_POST['nNivel'],
                        "titulo" => $_POST['titulo'],
                        "ventaIndividual" => $_POST['ventaIndividual'],
                        "costoNivel" => $costoNivel,
                        "videoCurso" => $rutaGuardado,
                        "descripcion" => $_POST['descripcion'],
                        "idCurso" => $_POST['idCurso']
                    );

                    $respuesta = 0;
                    $direccion = dirname(__FILE__);
                    require_once $direccion . "/../../classes/niveles.php";
                    $_nivel = new niveles();
                    if (move_uploaded_file($rutaAlmacenamiento, $rutaFinal)) {
                        $respuesta = $_nivel->insertarNivel($datos);
                    }
                    echo $respuesta;
                }
            }
        }
    }
}
