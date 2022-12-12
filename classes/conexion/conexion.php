<?php

class conexion
{
    private $server;
    private $user;
    private $password;
    private $database;
    private $port;
    private $conexion;

    function __construct()
    {

        $listaDatos = $this->datosConexion();
        foreach ($listaDatos as $key => $value) {
            $this->server = $value['server'];
            $this->user = $value['user'];
            $this->password = $value['password'];
            $this->database = $value['database'];
            $this->port = $value['port'];
            $this->conexion = $value['port'];
        }
        $this->conexion = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);
        if ($this->conexion->connect_errno) {
            echo "Algo salió mal";
            die;
        }
    }

    private function datosConexion()
    {
        $direccion = dirname(__FILE__);
        $jsonData = file_get_contents($direccion . "/" . "config");
        return json_decode($jsonData, true);
    }

    public function obtenerDatos($sqlstr)
    {
        $results = $this->conexion->query($sqlstr);
        $resultArray = array();
        if ($results) {
            foreach ($results as $key) {
                $resultArray[] = $key;
            }
        }
        return $resultArray;
    }

    public function nonQuery($sqlstr)
    {
        $this->conexion->query($sqlstr);
        return $this->conexion->affected_rows;
    }

    protected function encriptar($string)
    {
        return md5($string);
    }
}
