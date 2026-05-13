<?php
require_once('conexion.php');
require_once('cabecera.php');
include('menu.php');

if (isset($_GET['id']) && $_GET['id'] != "") {
    $query = "SELECT * FROM productos WHERE id=$_GET[id]";
    $resource = $conexion->query($query);
    $row = $resource->fetch_assoc();
}
?>
<div class="container py-5">
    <div class="row">
        <!-- Columna izquierda - solo imagen -->
        <div class="col-lg-6 mb-4">
            <div class="product-gallery bg-white rounded-3">
                <img src="assets/img/<?php echo $row['codigo']; ?>.png" class="img-fluid rounded-3"
                    alt="<?php echo $row['nombre']; ?>">
            </div>
        </div>

        <!-- Columna derecha - toda la info y compra -->
        <div class="col-lg-6">
                 <!-- Precio y compra -->
            <div class="card price-card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Precio:</span>
                        <h2 class="card-title mb-0">$<?php echo number_format($row['precio'],0,",","."); ?></h2>
                    </div>

                    <form id="form-comprar" method="POST" class="mb-3">
                        <!-- Campos ocultos -->
                        <!-- <input name="cliente" type="hidden" id="cliente" value="123"> -->
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($row['nombre']) ?>">
                        <input type="hidden" name="precio" value="<?php echo $row['precio'] ?>">
                        <input type="hidden" name="codigo" value="<?php echo $row['codigo'];?>">
                        <!-- Campo visible: cantidad -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Cantidad:</label>
                            <div class="input-group">
                                <button class="btn btn-outline-dark" type="button" id="decrement">-</button>
                                <input type="number" name="cantidad" class="form-control text-center" value="1"
                                    min="1" max="10" id="quantity">
                                <button class="btn btn-outline-dark" type="button" id="increment">+</button>
                            </div>
                        </div>
                        <input type="submit" name="comprar" id="comprar" value="Comprar"
                            class="btn btn-dark btn-lg w-100 py-3 mb-3">
                    </form>

                </div>
            </div>
            <!-- Información del producto -->
            <div class="bg-white p-4 rounded-3 mb-4">
                <h1 id="nombre-producto" class="h2"><?php echo $row["nombre"]; ?></h1>

                <div class="d-flex flex-wrap gap-3 mb-4">
                    <span class="badge bg-light text-dark">
                        <i class="bi bi-upc me-1 codigo-producto"></i> <?php echo $row['codigo']; ?>
                    </span>
                    <span class="badge bg-light text-dark">
                        <i class="bi bi-calendar me-1"></i> <?php echo $row['fecha']; ?>
                    </span>
                </div>

                <h3 class="h5">Descripción</h3>
                <p id="descripcion-producto"><?php echo $row['descripcion']; ?></p>
            </div>

            <!-- Especificaciones -->
            <div class="bg-white p-4 rounded-3 mb-4">
                <h3 class="h5 mb-3">Especificaciones</h3>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2 codigo-producto"><strong>Código:</strong> <?php echo $row['codigo']; ?></li>
                            <li class="mb-2"><strong>Categoría:</strong> <?php echo $row['categoria']; ?></li>
                            <li class="mb-2"><strong>Subcategoría:</strong> <?php echo $row['Sub-categoria']; ?></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2"><strong>Disponibilidad:</strong>
                                <span class="badge bg-info text-dark">En stock</span>
                                <?php if($row['promocion']=='1'){ ?>
                                <span class="badge bg-warning text-dark ms-2">¡En Promoción!</span>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

       

        </div>
    </div>
</div>



<!-- JavaScript para incrementar/decrementar cantidad -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const decrement = document.getElementById('decrement');
        const increment = document.getElementById('increment');
        const quantity = document.getElementById('quantity');

        // Eliminar flechas nativas del input
        quantity.style.appearance = 'none';
        quantity.style.MozAppearance = 'textfield';

        decrement.addEventListener('click', () => {
            let value = parseInt(quantity.value);
            if (value > 1) quantity.value = value - 1;
        });

        increment.addEventListener('click', () => {
            let value = parseInt(quantity.value);
            if (value < 10) quantity.value = value + 1;
        });
    });
</script>

<?php require_once('pie.php'); ?>