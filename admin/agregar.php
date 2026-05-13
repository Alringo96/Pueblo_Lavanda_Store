<?php
include('cabecera-admin.php');
require_once('conexion.php');

// Mostrar errores en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Procesar formulario al hacer submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar datos del formulario
    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $categoria = $_POST['categoria'];
    $sub_categoria = $_POST['sub_categoria'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock']; // ahora es número decimal
    $pre_venta = isset($_POST['pre_venta']) ? 1 : 0;
    $promocion = isset($_POST['promocion']) ? 1 : 0;

    // Insertar en la BD
    $query = "INSERT INTO productos (nombre, codigo, categoria, `Sub-categoria`, descripcion, precio, stock, `pre-venta`, promocion) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";


    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, 'ssssddiii', $nombre, $codigo, $categoria, $sub_categoria, $descripcion, $precio, $stock, $pre_venta, $promocion);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        echo "<div class='alert alert-danger text-center'>Error al guardar el producto: " . mysqli_error($conexion) . "</div>";
    }

    mysqli_stmt_close($stmt);
}
?>

<!-- Contenedor principal -->
<div class="container my-5">
    <div class="d-flex justify-content-center align-items-center mb-4">
        <h2 class="text-center">Agregar Producto</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <form method="POST" class="shadow-lg p-4 rounded-3 bg-light">

                <!-- Nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Producto</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <!-- Código -->
                <div class="mb-3">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" required>
                </div>

                <!-- Categoría -->
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoría</label>
                    <input type="text" class="form-control" id="categoria" name="categoria" required>
                </div>

                <!-- Sub-categoría -->
                <div class="mb-3">
                    <label for="sub_categoria" class="form-label">Sub-categoría</label>
                    <input type="text" class="form-control" id="sub_categoria" name="sub_categoria" required>
                </div>

                <!-- Descripción -->
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" style="resize: none; height: 120px;" required></textarea>
                </div>

                <!-- Precio -->
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                </div>

                <!-- Stock -->
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" step="0.01" class="form-control" id="stock" name="stock" required>
                </div>

                <!-- Pre-venta -->
                <div class="mb-3">
                    <label class="form-label">¿Está en pre-venta?</label>
                    <div>
                        <div>
                            <input type="radio" id="pre_venta" name="pre_venta" value="1">
                            <label for="pre_venta">Sí</label>
                        </div>
                    </div>
                    <div>
                        <input type="radio" id="pre_venta" name="pre_venta" value="0" checked>
                        <label for="pre_venta">No</label>
                    </div>
                </div>

                <!-- Promoción -->
                <div class="mb-3">
                    <label class="form-label">¿Está en promoción?</label>
                    <div>
                        <input type="radio" id="promocion_si" name="promocion" value="1">
                        <label for="promocion_si">Sí</label>
                    </div>
                    <div>
                        <input type="radio" id="promocion_no" name="promocion" value="0" checked>
                        <label for="promocion_no">No</label>
                    </div>
                </div>

                <!-- Botón de Guardar -->
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-dark w-100">Guardar Producto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('pie.php'); ?>