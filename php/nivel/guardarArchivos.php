<?php

if ($_POST['descripcion'] == null) {
    echo 2;
} else {
    $files_post = $_FILES['archivos'];

    $files = array();
    $file_count = count($files_post['name']);
    $file_key = array_keys($files_post);

    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_key as $key) {
            $files[$i][$key] = $files_post[$key][$i];
        }
    }
    if ($files[0]['name'] == "") {
        echo 3;
    } else {
        $direccion = dirname(__FILE__);
        require_once $direccion . "/../../classes/multimedias.php";
        $_multimedia = new multimedias();

        $nombreArchivo = $_FILES['archivos']['name'][0];
        $explode = explode('.', $nombreArchivo);
        $tipoArchivo = array_pop($explode);

        $direccion = dirname(__DIR__);
        $rutaAlmacenamiento = $_FILES['archivos']['tmp_name'][0];
        $idArchivo = uniqid();
        $rutaFinal = $direccion . "\\..\\img\\multimedia\\" . $idArchivo . "." . $tipoArchivo;
        $rutaGuardado = "img/multimedia/" . $idArchivo . "." . $tipoArchivo;

        $datos = array(
            "ruta" => $rutaGuardado,
            "tipo" => $tipoArchivo,
            "descripcion" => $_POST['descripcion'],
            "idNivel" => $_POST['idNivel']
        );

        $respuesta = 0;
        if (move_uploaded_file($rutaAlmacenamiento, $rutaFinal)) {
            $respuesta = $_multimedia->insertarMultimedia($datos);
        }
        echo $respuesta;
    }
}
