<?php

$direccion = dirname(__FILE__);
require_once $direccion . '/conexion/conexion.php';

class usuarios extends conexion
{

    public function registrar($datos)
    {
        $contraseña = parent::encriptar($datos['contraseña']);
        $query = "call setNuevoUsuario('" . $datos['nombreUsuario'] . "','" . $datos['apellidoP'] . "','" . $datos['apellidoM'] . "','" .
            $datos['correo'] . "','" . $contraseña .
            "','" . $datos['tipo'] . "','" . $datos['avatar'] . "');";
        $resp = parent::nonQuery($query);
        if ($resp > 0) {
            return 4;
        } else {
            return 0;
        }
    }

    public function login($datos)
    {
        $nombreUsuario = $datos['nombreUsuario'];
        $contraseña = $datos['contraseña'];
        $query = "call getUsuario('$nombreUsuario')";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["nombre"])) {
            $contraseña = parent::encriptar($contraseña);
            if ($contraseña == $datos[0]['contra']) {
                $_SESSION['idUsuario'] = $datos[0]['id'];
                $_SESSION['nombreUsuario'] = $datos[0]['nombre'];
                $_SESSION['apellidoP'] = $datos[0]['apellidoPaterno'];
                $_SESSION['apellidoM'] = $datos[0]['apellidoMaterno'];
                $_SESSION['correo'] = $datos[0]['correo'];
                $_SESSION['avatar'] = $datos[0]['avatar'];
                $_SESSION['tipo'] = $datos[0]['tipo'];
                $_SESSION['fechaAlta'] = $datos[0]['fechaAlta'];
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function cambiarAvatar($datos)
    {
        $idUsuario = $datos['idUsuario'];
        $avatar = $datos['avatar'];
        $query = "call setAvatar('$idUsuario', '$avatar');";
        $resp = parent::nonQuery($query);
        if ($resp >= 1) {
            $_SESSION['avatar'] = $avatar;
            return $resp;
        } else {
            return 0;
        }
    }

    public function actualizarPerfil($datos)
    {
        $idUsuario = $datos['idUsuario'];
        $nombreUsuario = $datos['nombreUsuario'];
        $apellidoP = $datos['apellidoP'];
        $apellidoM = $datos['apellidoM'];

        if ($this->modificarUsuario($nombreUsuario, $apellidoP, $apellidoM, $idUsuario)) {
            $_SESSION['nombreUsuario'] = $nombreUsuario;
            $_SESSION['apellidoP'] = $apellidoP;
            $_SESSION['apellidoM'] = $apellidoM;
            return 1;
        } else {
            return 2;
        }
    }

    public function validarContra($contraseña)
    {
        $query = "SELECT contra FROM t_usuario WHERE contra = '$contraseña'";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["contra"])) {
            return $datos;
        } else {
            return 0;
        }
    }

    public function modificarUsuario($nombreUsuario, $apellidoP, $apellidoM, $idUsuario)
    {
        $query = "call setActualizarPerfil('$idUsuario', '$nombreUsuario', '$apellidoP', '$apellidoM');";
        $resp = parent::nonQuery($query);
        if ($resp >= 1) {
            return $resp;
        } else {
            return 0;
        }
    }

    public function borrarPerfil($idUsuario)
    {
        $query = "call setInactivo('$idUsuario')";
        $resp = parent::nonQuery($query);
        if ($resp >= 1) {
            session_destroy();
            return $resp;
        } else {
            return 0;
        }
    }

    public function getMaestros()
    {
        $query = "call getMaestros()";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]["nombre"])) {
            return $datos;
        } else {
            return 0;
        }
    }
}
