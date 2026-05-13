<?php
include('conexion.php');


$sql = "SELECT DISTINCT `Sub-categoria` FROM productos ORDER BY `Sub-categoria` ASC";
$result = $conexion->query($sql);

$subcategorias = [];
while($row = $result->fetch_assoc()){
    $subcategorias[] = $row['Sub-categoria'];
}

header('Content-Type: application/json');
echo json_encode($subcategorias);