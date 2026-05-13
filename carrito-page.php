<?php 
require_once('conexion.php');
require_once('cabecera.php');
include('menu.php');
?>
<main class="container to-contain-carrito mb-5">
    <div class="row to-row-title">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1>Tu carrito</h1>
            <a href="index.php" class="btn-seguir">Seguir comprando</a>
        </div>
    </div>   
    <div class="row mt-5 row-carrito">
        <section class="col-12 col-lg-8 d-flex flex-column gap-5 to-carrito-art">
           <div class="to-carrito-articulos d-flex flex-column gap-4">

           </div>
           <button id="vaciar-carrito" class="to-carrito-vaciar">Vaciar carrito</button>
           <div class="accordion" id="accordionExample">
               <div class="accordion-item">
                   <h2 class="accordion-header">
                       <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                           Política de devolución
                       </button>
                   </h2>
                   <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                       <div class="accordion-body">
                          <p>En lavanda Store queremos que estés satisfecho con tu compra. Si no lo estás, puedes solicitar una devolución dentro de 30 días desde la fecha de compra, siempre que el producto esté sin usar y en su empaque original.</p>
                          <p>Para devolver un producto, contacta a nuestro equipo en lavandaStore@gmail.com y te indicaremos cómo hacerlo. Los reembolsos se realizarán mediante el mismo método de pago y pueden tardar de 5 a 10 días hábiles.</p>
                          <p>Los costos de envío de devoluciones son cubiertos por nosotros si el producto tiene algún defecto o error de envío; de lo contrario, corren por cuenta del cliente.</p>
                       </div>
                   </div>
               </div>
               <div class="accordion-item">
                   <h2 class="accordion-header">
                       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                           Opciones de envío
                       </button>
                   </h2>
                   <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                       <div class="accordion-body">
                            <p>Ofrecemos las siguientes opciones de envío:</p>
                            <ul>
                                <li><strong>Envío estándar:</strong> 3-7 días hábiles.</li>
                                <li><strong>Envío exprés:</strong> 1-3 días hábiles.</li>
                                <li><strong>Retiro en tienda:</strong> Calle La vanada #442, Santiago, RM.</li>
                            </ul>
                            <p>Todos los envíos incluyen número de seguimiento para que puedas verificar tu pedido en tiempo real.</p>
                       </div>
                   </div>
               </div>
           </div>
        </section>
        <section class="col-12 col-lg-4 to-contain-comprar">
            <div class="row">
                <h3 class="to-compra-title mb-">Resumen de la compra</h3>
            </div>
            <div class="row box-comprar justify-content-between">
                <p class="to-comprar-text">Subtotal</p>
                <p id="to-subtotal-final" class="to-comprar-precio"></p>
            </div>
            <div class="row box-comprar justify-content-between">
                <p class="to-comprar-text">Descuento</p>
                <p id ="to-comprar-descuento" class="to-comprar-precio"></p>
            </div>
            <div class="row box-comprar comprar-after justify-content-between">
                
            </div>
            <div class="row box-comprar justify-content-between mt-3">
                <p class="to-comprar-text">Total</p>
                <p id="to-precio-final" class="to-comprar-precio"></p>
            </div>
            <div class="row mt-3">
                <a href="#" class="to-pago">Continuar</a>
            </div>
        </section>
    </div>
</main>
<?php require_once('pie.php'); ?>