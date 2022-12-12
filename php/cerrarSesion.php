<?php

session_start();
session_destroy();

$direccion = dirname(__FILE__);
header("location:../iniSesion.php");
