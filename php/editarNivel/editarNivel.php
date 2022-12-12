<?php

if ($_POST["titulo"] == NULL || $_POST["descripcion"] == NULL) {
    echo 3;
} else {
    if ($_POST["costoNivel"] < 0.0 && $_POST["ventaIndividual"] == 1) {
        echo 6;
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
            $nuevoVideo = 0;
        } else {
            $nuevoVideo = 1;
        }

        if ($nuevoVideo) {


            $files_post = $_FILES['videoCurso'];

            $files = array();
            $file_count = count($files_post['name']);
            $file_key = array_keys($files_post);

            for ($i = 0; $i < $file_count; $i++) {
                foreach ($file_key as $key) {
                    $files[$i][$key] = $files_post[$key][$i];
                }
            }
            $nombreArchivo = $_FILES['videoCurso']['name'][0];
            $explode = explode('.', $nombreArchivo);
            $tipoArchivo = array_pop($explode);
            if (strcmp($tipoArchivo, "mp4") != 0) {
                echo 5;
            } else {

                $direccion = dirname(__DIR__);
                $rutaAlmacenamiento = $_FILES['videoCurso']['tmp_name'][0];
                $idArchivo = uniqid();
                $rutaFinal = $direccion . "\\..\\img\\niveles\\" . $idArchivo . "." . $tipoArchivo;
                $rutaGuardado = "img/niveles/" . $idArchivo . "." . $tipoArchivo;
                $costoNivel = number_format($_POST["costoNivel"], 2);

                $datos = array(
                    "idNivel" => $_POST['idNivel'],
                    "titulo" => $_POST['titulo'],
                    "descripcion" => $_POST['descripcion'],
                    "ventaIndividual" => $_POST['ventaIndividual'],
                    "costoNivel" => $costoNivel,
                    "videoCurso" => $rutaGuardado,
                    "pOpcion" => $nuevoVideo
                );

                $respuesta = 0;
                $direccion = dirname(__FILE__);
                require_once $direccion . "/../../classes/niveles.php";
                $_nivel = new niveles();
                if (move_uploaded_file($rutaAlmacenamiento, $rutaFinal)) {
                    $respuesta = $_nivel->editarNivel($datos);
                }
                echo json_encode($respuesta);
                
            }
        } else {

            $costoNivel = number_format($_POST["costoNivel"], 2);

            $datos = array(
                "idNivel" => $_POST['idNivel'],
                "titulo" => $_POST['titulo'],
                "descripcion" => $_POST['descripcion'],
                "ventaIndividual" => $_POST['ventaIndividual'],
                "costoNivel" => $costoNivel,
                "videoCurso" => null,
                "pOpcion" => $nuevoVideo
            );

            $respuesta = 0;
            $direccion = dirname(__FILE__);
            require_once $direccion . "/../../classes/niveles.php";
            $_nivel = new niveles();
            $respuesta = $_nivel->editarNivel($datos);
            echo json_encode($respuesta);

        }
    }
}
