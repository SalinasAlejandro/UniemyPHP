<?php
if (!isset($_POST["cate"])) {
    echo 2;
} else {
    if ($_POST['titulo'] == null || $_POST['descripcion'] == null) {
        echo 3;
    } else {
        if (!is_numeric($_POST['costo'])) {
            echo 5;
        } else {
            if ($_POST['costo'] < 0) {
                echo 4;
            } else {
                if ($_POST['cover'] == null) {
                    echo 6;
                } else {

                    session_start();
                    $direccion = dirname(__FILE__);
                    require_once $direccion . '/../../classes/cursos.php';

                    $_cursos = new cursos;

                    $img = $_POST["cover"];
                    //ruta para guardar
                    $direccion = dirname(__DIR__);
                    $partes = explode(";base64", $img);
                    //extención de la imagen
                    $extencion = explode('/', mime_content_type($img))[1];
                    //sacar el modo de codificar de la extención
                    $imagen_base64 = base64_decode($partes[1]);
                    //ruta final (con el archivo)
                    $idArchivo = uniqid();
                    $file = $direccion . "\\..\\img\\cursos\\" . $idArchivo . "." . $extencion;

                    $respuesta = 0;
                    if (file_put_contents($file, $imagen_base64)) {
                        $rutaGuardado = "img/cursos/" . $idArchivo . "." . $extencion;

                        $datos = array(
                            "titulo" => $_POST['titulo'],
                            "imagen" => $rutaGuardado,
                            "descripcion" =>  $_POST['descripcion'],
                            "costo" => $_POST['costo'],
                            "idEscuela" => $_SESSION['idUsuario'],
                        );
                        $categorias = array();
                        $i = 0;
                        foreach($_POST["cate"] as $cate){
                            $categorias[$i] = $cate;
                            $i++;
                        }

                        $curso = $_cursos->insertarCurso($datos, $categorias);
                        echo "1";
                    } else {
                        echo "Puto el que lo lea xd";
                    }
                }
            }
        }
    }
}
