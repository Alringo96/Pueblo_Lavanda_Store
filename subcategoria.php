<?php
include('conexion.php');


if (isset($_GET['sub'])) {
    $subcategoria = $_GET['sub'];

    // Traer los productos de esa subcategoría
    $stmt = $conexion->prepare("SELECT * FROM productos WHERE `Sub-categoria` = ?");
    $stmt->bind_param("s", $subcategoria);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    die("No se especificó subcategoría");
}
require_once('cabecera.php');
include('menu.php');
?>


<div class="container my-4">
    <h1 class="mb-4" style="color:#FFD700; font-family:'Cinzel Decorative', serif;">
        <?php echo htmlspecialchars($subcategoria); ?>
    </h1>
    <div id="productos_sub" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 mb-4 productos">
        <?php while ($p = $resultado->fetch_assoc()): ?>
            <?php
                $imagen = "assets/img/" . $p['codigo'] . ".png";
                if (!file_exists($imagen)) $imagen = "assets/img/no-image.png";
            ?>
            <article class="col">
                <div class="card">
                    <div class="box-img">
                        <img src="<?php echo $imagen; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($p['nombre']); ?>">
                        <?php if ($p['promocion'] == 1): ?>
                            <span class="position-absolute top-0 end-0 m-2 badge bg-danger">Promoción</span>
                        <?php endif; ?>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-between flex-column">
                        <h5 class="card-title mt-3"><?php echo htmlspecialchars($p['nombre']); ?></h5>
                        <p class="fw-bold fs-3">$<?php echo number_format($p['precio'],0,',','.'); ?></p>
                        <div class="d-flex justify-content-center btn-ver-mas">
                            <a id="<?php echo $p['id']; ?>" href="producto.php?id=<?php echo $p['id']; ?>" class="btn btn-dark w-40">Ver más</a>
                        </div>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</div>


    <?php require_once('pie.php'); ?>
