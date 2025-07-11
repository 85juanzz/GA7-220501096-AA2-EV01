<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "panaderia_db";

$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");

?>