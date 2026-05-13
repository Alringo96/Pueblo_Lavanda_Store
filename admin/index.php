<?php 
session_start(); // 🔑 Esto debe ir siempre al inicio

include('cabecera-admin.php');
include('menu-admin.php');
require_once('conexion.php');

if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') {
    // Redirigir al usuario a la página de login si no cumple los requisitos
    header("Location: login.php");
    exit;
}
?>
<!-- Contenedor principal -->
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de productos</h2>
        <a href="agregar.php" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Agregar producto
        </a>
    </div>

    <?php
    // Consulta para obtener todos los productos de la BD
    $query = "SELECT * FROM productos";
    $result = mysqli_query($conexion, $query);

    // Verificar si hay productos registrados
    if (mysqli_num_rows($result) > 0): ?>
    
        <div class="table-responsive"> <!-- Responsivo -->
            <table class="table table-bordered table-striped align-middle">
                <!-- Encabezado de tabla productos -->
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Sub-categoria</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Promoción</th>
                        <th>Pre-Venta</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <!-- Cuerpo de la tabla productos -->
                <tbody class="text-center">
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <!-- Mostrar campos del producto -->
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['codigo'] ?></td>
                            <td><?= $row['nombre'] ?></td>
                            <td><?= $row['descripcion'] ?></td>
                            <td><?= $row['categoria'] ?></td>
                            <td><?= $row['Sub-categoria'] ?></td>
                            <td>$<?= number_format($row['precio'], 0, ',', '.') ?></td>
                            <td><?= $row['stock'] ?></td>
                            <td><?= $row['promocion'] ?></td>
                            <td><?= $row['pre-venta'] ?></td>
                            <td><?= $row['fecha'] ?></td>
                            <td>
                                <!-- Botón modificar producto -->
                                <a href="modificar.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning m-3">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <!-- Botón eliminar producto -->
                                <a href="eliminar.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    <?php else: ?>
        <!-- Mensaje si no hay productos registrados -->
        <div class="alert alert-info text-center">No hay productos registrados.</div>
    <?php endif; ?>
</div>

<?php include('pie.php'); ?>
