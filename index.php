<?php 
require_once('conexion.php');
require_once('cabecera.php');
include('menu.php');
$query = "SELECT * FROM productos WHERE promocion = 1";
$resource = $conexion->query($query);
?>

<!-- Carrousel -->
<section class="mockups my-0 my-md-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col fondo-mixto mb-5">
                <div class="color-div"></div>
                <h2 class="titulo-mockups text-orange d-flex justify-content-center">
                    Promociones
                </h2>
            </div>
        </div>
    </div>
</section>

<section id="slider" class="pt-5">
    <div class="container">
        <div class="slider">
            <div class="owl-carousel">
                <?php while ($row = $resource->fetch_assoc()) { ?>
                    <div class="slider-card">
                        <div class="d-flex justify-content-center align-items-center mb-4 box-img">
                            <a href="producto.php?id=<?php echo $row['id']; ?>">
                                <img class="img-fluid card-img-top" src="assets/img/<?php echo $row['codigo']; ?>.png" alt="">
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="custom-controls d-flex justify-content-center align-items-center flex-wrap mt-4 gap-3">
                <button id="custom-prev" class="btn-nav"><i class="bi bi-arrow-left-circle-fill"></i></button>
                <div class="owl-dots-wrapper"></div>
                <button id="custom-next" class="btn-nav"><i class="bi bi-arrow-right-circle-fill"></i></button>
            </div>
        </div>
    </div>
</section>


    <div class="container py-5">
        <!-- ordenamiento -->
        <div class="row mb-4">
        <div class="col-md-4">
            <div class="input-group">
                <select id="ordenar" class="form-select">
                    <option value="">Ordenar por...</option>
                    <option value="promocion">En promoción</option>
                    <option value="precio_asc">Menor precio</option>
                    <option value="precio_desc">Mayor precio</option>
                </select>
            </div>
        </div>
    </div>
        <!-- Listado de productos -->
        <section id="productos" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 mb-4 productos">
           
        </section>

        <!-- Paginación -->
        <nav id="paginacion" class="row justify-content-center mt-5" aria-label="Page navigation">
        </nav>
    </div>
    <?php require_once('pie.php'); ?>