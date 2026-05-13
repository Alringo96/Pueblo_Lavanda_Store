<?php
include('cabecera-admin.php');
require_once('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id           = $_POST['id'];
    $codigo       = $_POST['codigo'];
    $nombre       = $_POST['nombre'];
    $descripcion  = $_POST['descripcion'];
    $categoria    = $_POST['categoria'];
    $subcategoria = $_POST['Sub-categoria'];
    $precio       = $_POST['precio'];
    $stock        = $_POST['stock'];
    $promocion    = $_POST['promocion'];
    $preventa     = $_POST['pre-venta'];
    $fecha        = $_POST['fecha'];

    $update = "UPDATE productos SET 
        codigo = '$codigo',
        nombre = '$nombre',
        descripcion = '$descripcion',
        categoria = '$categoria',
        `Sub-categoria` = '$subcategoria',
        precio = $precio,
        stock = $stock,
        promocion = '$promocion',
        `pre-venta` = '$preventa',
        fecha = '$fecha'
        WHERE id = $id";

    if (mysqli_query($conexion, $update)) {
        header("Location: index.php");
        exit;
    } else {
        echo "<div class='alert alert-danger text-center'>Error al modificar: " . mysqli_error($conexion) . "</div>";
    }
}

// Obtener producto
$id = $_GET['id'] ?? $_POST['id'] ?? null;
if (!$id) {
    echo "<p class='alert alert-danger'>ID de producto no especificado.</p>";
    exit;
}

$query = "SELECT * FROM productos WHERE id = $id";
$result = mysqli_query($conexion, $query);
$producto = mysqli_fetch_assoc($result);

if (!$producto) {
    echo "<p class='alert alert-danger'>Producto no encontrado.</p>";
    exit;
}
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Modificar Producto</h2>
    <form action="modificar.php?id=<?= $id ?>" method="POST" class="shadow-lg p-4 rounded-3 bg-light">
        <input type="hidden" name="id" value="<?= $producto['id'] ?>">

        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" class="form-control" id="codigo" name="codigo" value="<?= $producto['codigo'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $producto['nombre'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?= $producto['descripcion'] ?></textarea>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <input type="text" class="form-control" id="categoria" name="categoria" value="<?= $producto['categoria'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="subcategoria" class="form-label">Sub-categoría</label>
            <input type="text" class="form-control" id="subcategoria" name="Sub-categoria" value="<?= $producto['Sub-categoria'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" value="<?= $producto['precio'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?= $producto['stock'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Promoción</label>
            <select class="form-select" name="promocion" required>
                <option value="1" <?= $producto['promocion'] == '1' ? 'selected' : '' ?>>Sí</option>
                <option value="0" <?= $producto['promocion'] == '0' ? 'selected' : '' ?>>No</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Pre-Venta</label>
            <select class="form-select" name="pre-venta" required>
                <option value="1" <?= $producto['pre-venta'] == '1' ? 'selected' : '' ?>>Sí</option>
                <option value="0" <?= $producto['pre-venta'] == '0' ? 'selected' : '' ?>>No</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" value="<?= date('Y-m-d', strtotime($producto['fecha'])) ?>" required>
        </div>

        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-dark w-100">Guardar Cambios</button>
        </div>
    </form>
</div>

<?php include('pie.php'); ?>
