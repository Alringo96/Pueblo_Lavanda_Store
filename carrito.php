<?php
require_once('conexion.php');
session_start();

if (!isset($_SESSION['carrito']))  $_SESSION['carrito'] = [];
if (!isset($_SESSION['descuento'])) $_SESSION['descuento'] = 0;

// Agregar producto (por defecto)
if (isset($_POST['codigo']) && (!isset($_POST['accion']) || $_POST['accion'] === 'agregar')) {
    $id       = $_POST['id']; 
    $codigo   = $_POST['codigo'];
    $nombre   = $_POST['nombre'];
    $precio   = floatval($_POST['precio']);
    $cantidad = intval($_POST['cantidad'] ?? 1);
    $cantidad = max(1, min($cantidad, 99));

    if (isset($_SESSION['carrito'][$codigo])) {
        $_SESSION['carrito'][$codigo]['cantidad'] += $cantidad;
    } else {
        $_SESSION['carrito'][$codigo] = [
            'id'       => $id, 
            'nombre'   => $nombre,
            'precio'   => $precio,
            'cantidad' => $cantidad
        ];
    }
}

// Quitar producto
if (isset($_POST['codigo'], $_POST['accion']) && $_POST['accion'] === 'borrar') {
    $codigo = $_POST['codigo'];
    unset($_SESSION['carrito'][$codigo]);
}
// Quitar 1 unidad
if (isset($_POST['codigo'], $_POST['accion']) && $_POST['accion'] === 'quitar') {
    $codigo = $_POST['codigo'];
    if (isset($_SESSION['carrito'][$codigo]) && $_SESSION['carrito'][$codigo]['cantidad'] > 1) {
        $_SESSION['carrito'][$codigo]['cantidad'] -= 1;
    } else {
        unset($_SESSION['carrito'][$codigo]);
    }
}

// Sumar 1 unidad
if (isset($_POST['codigo'], $_POST['accion']) && $_POST['accion'] === 'sumar') {
    $codigo = $_POST['codigo'];
    if (isset($_SESSION['carrito'][$codigo])) {
        $_SESSION['carrito'][$codigo]['cantidad'] += 1;
    }
}

// Aplicar descuento (¡sin resetearlo en otras acciones!)
if (isset($_POST['accion']) && $_POST['accion'] === 'descuento') {
    $val = intval($_POST['descuento'] ?? 0);
    $val = max(0, min($val, 90)); // por seguridad
    $_SESSION['descuento'] = $val;
}

// Armar respuesta
$items = [];
$total = 0;

foreach ($_SESSION['carrito'] as $codigo => $p) {
    $subtotal = (int)($p['precio'] * $p['cantidad']);
    $total += $subtotal;

    $items[] = [
        'id'       => $p['id'],  
        'codigo'   => $codigo,
        'nombre'   => $p['nombre'],
        'precio'   => $p['precio'],
        'cantidad' => $p['cantidad'],
        'subtotal' => $subtotal
    ];
}

$descuento   = $_SESSION['descuento'] ?? 0;
$total_final = $total - ($total * $descuento / 100);

header('Content-Type: application/json');
echo json_encode([
    'productos'   => $items,
    'total'       => $total,
    'descuento'   => $descuento,
    'total_final' => $total_final
]);
