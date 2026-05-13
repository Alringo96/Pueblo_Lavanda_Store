function actualizarCarrito() {
  $.getJSON("carrito.php", function (respuesta) {
    let total = respuesta.total;
    let totalFinal = respuesta.total_final;
    let descuento = respuesta.descuento;
    let productos = respuesta.productos;

    let productosHTML = "";
    productos.forEach(function (p) {
      productosHTML += `
        <article class="article-carrito d-flex gap-3">
          <a id="${p.id}" href="producto.php?id=${p.id}">
            <img src="assets/img/${p.codigo}.png" alt="#" class="to-article-img">
          </a>
          <div class="to-article-body d-flex flex-column justify-content-between">
            <div class="d-flex justify-content-between align-items-start">
              <h2 class="to-article-title">${p.nombre}</h2>
              <button class="to-article-btn-borrar to-article-btn" data-codigo="${
                p.codigo
              }"><i class="bi bi-x"></i></button>
            </div>
            <p class="to-article-text">Cantidad: ${p.cantidad}</p>
            <div class="d-flex justify-content-between align-items-center">
              <p class="to-article-precio m-0">$${p.subtotal.toLocaleString(
                "es-CL"
              )}</p>
              <div class="d-flex">
                <button class="to-article-btn-quitar to-article-btn" data-codigo="${
                  p.codigo
                }"><i class="bi bi-dash"></i></button>
                <button class="to-article-btn-sumar to-article-btn" data-codigo="${
                  p.codigo
                }"><i class="bi bi-plus"></i></button>
              </div>
            </div>
          </div>
        </article>`;
        
    });

    $("#contenido-carrito").html(productosHTML);
    $(".to-carrito-articulos").html(productosHTML);

    // Totales
    $("#to-subtotal-final").html(
      "$" +
        total.toLocaleString("es-CL", {
          minimumFractionDigits: 0,
          maximumFractionDigits: 0,
        })
    );
    if (descuento > 0) {
      $("#to-comprar-descuento").html(`${descuento}%`);
      $("#total").html(
        `(-${descuento}%): $${totalFinal.toLocaleString("es-CL", {
          minimumFractionDigits: 0,
          maximumFractionDigits: 0,
        })}`
      );
      $("#to-precio-final").html(
        "$" +
          totalFinal.toLocaleString("es-CL", {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
          })
      );
    } else {
      $("#to-comprar-descuento").html("");
      $("#total").html(
        `Total: $${total.toLocaleString("es-CL", {
          minimumFractionDigits: 0,
          maximumFractionDigits: 0,
        })}`
      );
      $("#to-precio-final").html(
        "$" +
          total.toLocaleString("es-CL", {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
          })
      );
    }

    // Habilitar/Deshabilitar botón pagar
    if (productos.length === 0) {
      $("#to-pagar").addClass("disabled").attr("aria-disabled", "true");
    } else {
      $("#to-pagar").removeClass("disabled").attr("aria-disabled", "false");
    }

    // Mostrar vaciar producto en carrito-page
    if (productos.length === 0) {
      $(".to-carrito-vaciar").addClass("d-none");
    } else {
      $(".to-carrito-vaciar").removeClass("d-none");
    }
  });
}

// Agregar producto
$("#form-comprar").on("submit", function (e) {
  e.preventDefault();
  $.post("carrito.php", $(this).serialize(), function () {
    actualizarCarrito();
    const carrito = new bootstrap.Offcanvas(
      document.getElementById("offcanvasCarrito")
    );
    carrito.show();
  });
});

// Vaciar carrito
$("#vaciar, #vaciar-carrito").on("click", function () {
  $.post("vaciar-carrito.php", function () {
    actualizarCarrito();
  });
});

// Quitar/Sumar/Borrar
$(document).on("click", ".to-article-btn-quitar", function () {
  const codigo = $(this).data("codigo");
  $.post("carrito.php", { codigo, accion: "quitar" }, actualizarCarrito);
});
$(document).on("click", ".to-article-btn-sumar", function () {
  const codigo = $(this).data("codigo");
  $.post("carrito.php", { codigo, accion: "sumar" }, actualizarCarrito);
});
$(document).on("click", ".to-article-btn-borrar", function () {
  const codigo = $(this).data("codigo");
  $.post("carrito.php", { codigo, accion: "borrar" }, actualizarCarrito);
});

// Descuento (usa el form del popup tal cual)
$("#to-descuento").on("submit", function (e) {
  e.preventDefault();
  $.post("carrito.php", $(this).serialize(), function () {
    $("#ghostPopup").hide();
    actualizarCarrito();
  });
});

// Cargar al inicio
$(document).ready(actualizarCarrito);
