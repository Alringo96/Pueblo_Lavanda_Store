<?php
// conexion.php
$servidor = "localhost";
$usuario = "lavanda";
$password = "123";
$base_datos = "lavanda";

// Crear conexión
$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Configurar charset
$conexion->set_charset("utf8mb4");
?>