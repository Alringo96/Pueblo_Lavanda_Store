<?php
session_start();
require_once('cabecera.php');
include('menu.php');

// Verificamos si hay productos en la boleta
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo '<div class="container mt-5 text-center">';
    echo '<h2 class="mb-4">Tu boleta está vacía 😢</h2>';
    echo '<a href="index.php" class="btn btn-warning">Volver a la tienda</a>';
    echo '</div>';
    require_once('pie.php');
    exit;
}

// Calculamos totales
$subtotal = 0;
$envio = 0;
foreach($_SESSION['carrito'] as $item){
    $subtotal += $item['precio'] * $item['cantidad'];
}
$iva = $subtotal * 0.19;
$total = $subtotal + $envio + $iva;
?>

<div class="container my-5 p-4 comprobante">
    <div class="text-center mb-4">
        <h1 style="color:#FFD700;">Pueblo Lavanda Store</h1>
        <p style="color:#fff;">Comprobante de Compra</p>
    </div>

    <table class="table table-dark table-bordered text-white">
        <thead class="text-center">
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($_SESSION['carrito'] as $item): ?>
            <tr>
                <td><?php echo $item['nombre']; ?></td>
                <td class="text-center">$<?php echo number_format($item['precio'],0,",","."); ?></td>
                <td class="text-center"><?php echo $item['cantidad']; ?></td>
                <td class="text-end">$<?php echo number_format($item['precio']*$item['cantidad'],0,",","."); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="totales mt-3 text-end text-white">
        <p>Subtotal: $<?php echo number_format($subtotal,0,",","."); ?></p>
        <p>Envío: $<?php echo number_format($envio,0,",","."); ?></p>
        <p>IVA (19%): $<?php echo number_format($iva,0,",","."); ?></p>
        <h3>Total: $<?php echo number_format($total,0,",","."); ?></h3>
    </div>

    <div class="text-center mt-4">
        <button class="btn btn-success" onclick="window.print()">
            <i class="bi bi-printer-fill"></i> Imprimir comprobante
        </button>
        <a href="index.php" class="btn btn-warning">
            <i class="bi bi-arrow-left-circle-fill"></i> Volver a la tienda
        </a>
    </div>
</div>

<?php
// Limpiamos la sesión de carrito al finalizar la compra
unset($_SESSION['carrito']);
require_once('pie.php');
?>
