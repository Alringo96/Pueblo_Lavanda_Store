<?php
header('Content-Type: application/json');
include('conexion.php');

$orden = isset($_GET['orden']) ? $_GET['orden'] : "";

// Base de la consulta
$sql = "SELECT * FROM productos";

// Filtrado y ordenamiento
if ($orden == "promocion") {
    $sql .= " WHERE promocion = 1 ORDER BY id ASC";
} elseif ($orden == "precio_asc") {
    $sql .= " ORDER BY precio ASC";
} elseif ($orden == "precio_desc") {
    $sql .= " ORDER BY precio DESC";
} else {
    $sql .= " ORDER BY id DESC";
}

$resultado = $conexion->query($sql);

$productos = [];
while ($row = $resultado->fetch_assoc()) {
    $productos[] = $row;
}

echo json_encode($productos);
