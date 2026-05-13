<?php
include('cabecera-admin.php');
require_once('conexion.php');

// Obtener el ID del producto desde la URL
$id = $_GET['id'] ?? null;

// Validar que se haya recibido un ID numérico
if (!isset($id) || !is_numeric($id)) {
    echo "<p class='alert alert-danger'>ID de producto no válido.</p>";
    exit;
}

// Consultar el producto a eliminar
$query = "SELECT * FROM productos WHERE id = $id";
$result = mysqli_query($conexion, $query);
$producto = mysqli_fetch_assoc($result);

// Validar si el producto existe
if (!$producto) {
    echo "<p class='alert alert-danger'>Producto no encontrado.</p>";
    exit;
}

// Procesar la eliminación cuando el formulario sea enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Eliminar el producto de la base de datos
    $deleteQuery = "DELETE FROM productos WHERE id = $id";
    if (mysqli_query($conexion, $deleteQuery)) {
        // Redirigir al listado de productos después de eliminar
        header('Location: index.php');
        exit;
    } else {
        echo "<p class='alert alert-danger'>Error al eliminar el producto: " . mysqli_error($conexion) . "</p>";
    }
}
?>

<!-- Contenedor principal -->
<div class="container my-5">
    <div class="d-flex justify-content-center align-items-center mb-4">
        <h2 class="text-center">Eliminar Producto</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="bg-white shadow-lg rounded-4 p-4">

                <!-- Alerta con los datos del producto a eliminar -->
                <div class="alert alert-warning text-center">
                    <h4>¿Estás seguro de eliminar el siguiente producto?</h4>
                    <p><strong>Nombre:</strong> <?= htmlspecialchars($producto['nombre']) ?></p>
                    <p><strong>Código:</strong> <?= htmlspecialchars($producto['codigo']) ?></p>
                    <p><strong>Categoría:</strong> <?= htmlspecialchars($producto['categoria']) ?></p>
                    <p><strong>Sub-categoría:</strong> <?= htmlspecialchars($producto['Sub-categoria']) ?></p>
                    <p><strong>Descripción:</strong> <?= htmlspecialchars($producto['descripcion']) ?></p>
                    <p><strong>Precio:</strong> $<?= number_format($producto['precio'], 2, ',', '.') ?></p>
                    <p><strong>Stock:</strong> <?= number_format($producto['stock'], 2) ?></p>
                    <p><strong>Pre-venta:</strong> <?= $producto['pre-venta'] ? 'Sí' : 'No' ?></p>
                    <p><strong>Promoción:</strong> <?= $producto['promocion'] ? 'Sí' : 'No' ?></p>
                </div>

                <!-- Formulario de confirmación -->
                <form action="" method="POST" class="text-center">
                    <button type="submit" class="btn btn-danger w-100 mb-2">Eliminar Producto</button>
                    <a href="consultar.php" class="btn btn-secondary w-100">Cancelar</a>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include('pie.php'); ?>