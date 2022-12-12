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
                    $nuevaImagen = 0;
                } else {
                    $nuevaImagen = 1;
                }
                session_start();
                $direccion = dirname(__FILE__);
                require_once $direccion . '/../../classes/cursos.php';

                $_cursos = new cursos;

                if ($nuevaImagen) {
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

                    if (file_put_contents($file, $imagen_base64)) {
                        $rutaGuardado = "img/cursos/" . $idArchivo . "." . $extencion;

                        $datos = array(
                            "idCurso" => $_POST['idCurso'],
                            "titulo" => $_POST['titulo'],
                            "imagen" => $rutaGuardado,
                            "descripcion" =>  $_POST['descripcion'],
                            "costo" => $_POST['costo'],
                            "pOpcion" => 0
                        );
                        $categorias = array();
                        $i = 0;
                        foreach ($_POST["cate"] as $cate) {
                            $categorias[$i] = $cate;
                            $i++;
                        }

                        $curso = $_cursos->editarCurso($datos, $categorias);
                        echo json_encode($curso);
                    } else {
                        echo "Puto el que lo lea xd";
                    }
                } else {

                    $datos = array(
                        "idCurso" => $_POST['idCurso'],
                        "titulo" => $_POST['titulo'],
                        "imagen" => null,
                        "descripcion" =>  $_POST['descripcion'],
                        "costo" => $_POST['costo'],
                        "pOpcion" => 1
                    );
                    $categorias = array();
                    $i = 0;
                    foreach ($_POST["cate"] as $cate) {
                        $categorias[$i] = $cate;
                        $i++;
                    }

                    $curso = $_cursos->editarCurso($datos, $categorias);
                    echo json_encode($curso);

                }
            }
        }
    }
}