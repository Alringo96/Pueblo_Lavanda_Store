<footer class="text-center py-4">
    <hr class="mb-5">
    <div class="container">
    <a class="navbar-brand" href="index.html">
      <img src="assets/img/logo.png" alt="Pueblo Lavanda Store" class="m-3" style="max-width:150px; border-radius:100px;">
    </a>
        <p>&copy; <?php echo date('Y'); ?> Pueblo Lavanda Store. - Todos los derechos reservados</p>
        <p>Design by Ratitas Corporation Limited</p>
    </div>
</footer>

<!-- Música de fondo -->
<audio id="bgMusic" loop>
  <source src="assets/audio/lavender-town.mp3" type="audio/mpeg">
</audio>

<!-- Sonido fantasma -->
<audio id="ghostSound">
  <source src="assets/audio/ghost-sound.ogg" type="audio/mpeg">
</audio>

<!-- Popup Fantasma -->
<div id="ghostPopup" class="ghost-popup">
  <div class="ghost-popup-content">
    <p id="ghostMessage">👻 ¡Un espíritu te ha seguido!... En lugar de asustarte, te concede un 5% de descuento en tu carrito.</p>
    <form method="post" id="to-descuento">
      <input type="hidden" name="descuento" id="aplicar-descuento" value="5">
      <input type="hidden" name="accion" value="descuento">
      <input type="submit" id="closePopup" value="OK">
    </form>
    <!-- <button id="closePopup">OK</button> -->
  </div>
</div>

<!-- Off Canva -->
<div class="offcanvas offcanvas-end" id="offcanvasCarrito" tabindex="-1">
  <div class="offcanvas-header align-items-start">
    <h4 class="offcanvas-title">Resumen de Compra</h4>
    <button type="button" class="to-close" data-bs-dismiss="offcanvas"><i class="bi bi-x"></i></button>
  </div>
  <div class="offcanvas-body d-flex flex-column gap-3" id="contenido-carrito">
    
  </div>
  <p id="total" class="w-100 text-center">Total: </p>
  <button id="vaciar">Vaciar carrito</button>
  <a id="to-pagar" href="carrito-page.php" class="btn">Ir a pagar</a>
</div>


<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="assets/js/ajax.js"></script>
<script src="assets/js/carrusel.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/ghost.js"></script>
<script src="assets/js/audio.js"></script>
<script src="assets/js/ajax-carrito.js"></script>
<script src="assets/js/ajax-categorias.js"></script>

<!-- Bootstrap JS Bundle -->

</body>
</html>
