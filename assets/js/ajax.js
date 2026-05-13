$(document).ready(function () {
    let productosData = [];
    const itemsPerPage = 8;
    let currentPage = 1;
    let currentOrden = ""; // guarda el orden actual

    // Función para cargar productos vía AJAX según el orden
    function cargarProductos(orden = "") {
        currentOrden = orden; // guardar orden actual
        $.getJSON("get-productos.php", { orden: orden }, function (data) {
            productosData = data;
            currentPage = 1;
            renderPage(currentPage);
            renderPagination();
        });
    }

    // Renderiza las tarjetas de la página actual
    function renderPage(page) {
        let start = (page - 1) * itemsPerPage;
        let end = start + itemsPerPage;
        let pageItems = productosData.slice(start, end);

        let tarjetas = "";
        $.each(pageItems, function (i, p) {
            tarjetas += `
                <article class="col">
                    <div class="card">
                        <div class="box-img position-relative">
                            <img src="assets/img/${p.codigo}.png" class="card-img-top" alt="${p.nombre}">
                            ${p.promocion == 1 ? '<span class="position-absolute top-0 end-0 m-2 badge bg-danger">Promoción</span>' : ""}
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-between flex-column">
                            <h5 class="card-title mt-3">${p.nombre}</h5>
                            <p class="fw-bold fs-3">$${Number(p.precio).toLocaleString("es-CL")}</p>
                            <div class="d-flex justify-content-center btn-ver-mas">
                                <a id="${p.id}" href="producto.php?id=${p.id}" class="btn btn-dark w-40">Ver más</a>
                            </div>
                        </div>
                    </div>
                </article>
            `;
        });

        $("#productos").html(tarjetas);
    }

    // Renderiza la paginación
    function renderPagination() {
        let totalPages = Math.ceil(productosData.length / itemsPerPage);
        let paginationHtml = "";

        for (let i = 1; i <= totalPages; i++) {
            paginationHtml += `
                <button class="btn btn-sm ${i === currentPage ? "btn-dark" : "btn-outline-dark"} m-1 page-btn" data-page="${i}">
                    ${i}
                </button>
            `;
        }

        $("#paginacion").html(paginationHtml);
    }

    // Maneja click en botones de paginación
    $(document).on("click", ".page-btn", function () {
        currentPage = parseInt($(this).data("page"));
        renderPage(currentPage);
        renderPagination();
        $(window).scrollTop($(".input-group").offset().top);
    });

    // Maneja cambio de orden
    $("#ordenar").on("change", function () {
        let orden = $(this).val();
        cargarProductos(orden);
    });

    // Carga inicial
    cargarProductos(currentOrden);
});
