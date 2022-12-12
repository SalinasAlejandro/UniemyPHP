<?php

$direccion = dirname(__FILE__);
require_once $direccion . '/conexion/conexion.php';

//idCategoriaa
class cursos extends conexion
{

    public function insertarCurso($datos, $categorias)
    {
        $titulo = $datos['titulo'];
        $imagen = $datos['imagen'];
        $descripcion = $datos['descripcion'];
        $costo = $datos['costo'];
        $idEscuela = $datos['idEscuela'];
        $cateTexto = join(',', $categorias);
        $query = "call setCurso('$titulo', '$imagen', '$descripcion', '$costo', '$idEscuela', '$cateTexto');";
        parent::obtenerDatos($query);
        return 1;
    }

    public function obtenerCursosDeEscuela($idEscuela)
    {
        $query = "call getCursosDeEscuela('$idEscuela');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["idCurso"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function verPrecioCurso($idCurso)
    {
        $query = "call selectsConIdCurso('$idCurso', '1');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["costo"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function esGratis($idCurso, $idNivel)
    {
        $query = "SELECT functionEsGratis('$idCurso', '$idNivel') as gratis;";
        $datos = parent::obtenerDatos($query);
        return $datos[0]["gratis"];
    }

    public function obtenerCursoById($idCurso)
    {
        $query = "call selectsConIdCurso('$idCurso', '2');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["titulo"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function obtenerNiveles($idCurso)
    {
        $query = "call selectsConIdCurso('$idCurso', '5')";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["idNivel"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function obtenerCursoNuevos()
    {
        $query = "call getCursosIndex(0, null);";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["titulo"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function obtenerCursoCalif()
    {
        $query = "call getCursosIndex(1, null);";
        $datos2 = parent::obtenerDatos($query);
        if (isset($datos2[0]["titulo"])) {
            return $datos2;
        } else {
            return 0;
        }
    }

    public function obtenerCursoVendido()
    {
        $query = "call getCursosIndex(2, null);";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["titulo"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function obtenerCursoRandom()
    {
        $query = "call getCursosIndex(3, null);";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["titulo"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function misCursos($idEscuela)
    {
        $query = "call getMisCursos('$idEscuela', '0');";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["idCurso"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function darBaja($idCurso)
    {
        $query = "call selectsConIdCurso('$idCurso', '4');";
        $resp = parent::nonQuery($query);
        if ($resp >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function ingresosCurso($idCurso)
    {
        $query = "SELECT titulo, costo, ventas from t_cursos where idCurso = '$idCurso';";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["costo"])) {

            $query = "SELECT formaPago from t_comprascursos where idCurso = '$idCurso';";
            $formasPago = parent::obtenerDatos($query);
            if (isset($formasPago[0]["formaPago"])) {

                $efectivo = 0;
                $credito = 0;
                $debito = 0;
                foreach ($formasPago as $cuentas) {
                    switch ($cuentas["formaPago"]) {
                        case "0":
                            $efectivo = $efectivo + 1;
                            break;
                        case "1":
                            $credito = $credito + 1;
                            break;
                        case "2":
                            $debito = $debito + 1;
                            break;
                    }
                }
                $total = $datos[0]["costo"] * $datos[0]["ventas"];
                $ingresos = array(
                    "titulo" => $datos[0]["titulo"],
                    "ventas" => $datos[0]["ventas"],
                    "total" => $total,
                    "efectivo" => $efectivo,
                    "credito" => $credito,
                    "debito" => $debito
                );
                return $ingresos;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function buscar($buscar)
    {
        $query = "call getCursosIndex(4, '$buscar'); ";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["idCurso"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function todosCursos()
    {
        $query = "call getCursosIndex(null, null)";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["titulo"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function filtros($where)
    {
        $query = "SELECT t_cursos.idCurso, t_cursos.titulo, t_cursos.imagen, t_cursos.costo, t_cursos.calificacion, 
                  t_cursos.idEscuela, t_cursos.baja, t_usuario.nombre, t_usuario.estado 
                FROM t_cursos 
                join t_usuario ON t_cursos.idEscuela = t_usuario.idUsuario 
                JOIN t_cate_curs ON t_cate_curs.idCurso = t_cursos.idCurso 
                $where AND baja = 0 AND t_cursos.numNiveles > 0 
                order by titulo;";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["titulo"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function editarCurso($datos, $categorias){

        $idCurso = $datos['idCurso'];
        $titulo = $datos['titulo'];
        $imagen = $datos['imagen'];
        $descripcion = $datos['descripcion'];
        $costo = $datos['costo'];
        $pOpcion = $datos['pOpcion'];
        $cateTexto = join(',', $categorias);
        $query = "call editarCurso('$idCurso', '$titulo', '$imagen', '$descripcion', '$costo', '$pOpcion', '$cateTexto');";
        parent::obtenerDatos($query);
        return "1";

    }

}
