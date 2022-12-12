<?php

$direccion = dirname(__FILE__);
require_once $direccion . '/conexion/conexion.php';

class categorias extends conexion
{
    
    public function obtenerCategorias()
    {
        $query = "call getCategorias();";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["id"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function añadirCategoria($datos)
    {
        $categoria = $datos["categoria"];
        $descripcion = $datos["descripcion"];
        $query = "call setCategoria('$categoria', '$descripcion')";
        $resp = parent::nonQuery($query);
        if ($resp >= 1) {
            return $resp;
        } else {
            return 0;
        }
    }
}
