<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <!-- Marca principal -->
    <a class="navbar-brand" href="index.php">
      <img id="logo" src="assets/img/logo.png" alt="Pueblo Lavanda Store" style="height:100px;">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <!-- Menú principal -->
      <ul class="navbar-nav me-auto">
        
        <!-- Juegos de Cartas (dropdown con subcategorías) -->
<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
     data-bs-toggle="dropdown" aria-expanded="false">
    Juegos de Cartas
  </a>

  <ul class="dropdown-menu p-3 text-center" aria-labelledby="navbarDropdown">
    <li>
      <div class="d-flex justify-content-around">
        <a class="dropdown-item card-item text-center" href="subcategoria.php?sub=Pokémon">
          <img src="assets/img/logo-pokemon.png" alt="Pokémon TCG" class="menu-logo mb-2">
          <div>Pokémon TCG</div>
        </a>
        <a class="dropdown-item card-item text-center" href="subcategoria.php?sub=MyL">
          <img src="assets/img/logo-myl.png" alt="Mitos y Leyendas" class="menu-logo mb-2">
          <div>Mitos y Leyendas</div>
        </a>
        <a class="dropdown-item card-item text-center" href="subcategoria.php?sub=Magic">
          <img src="assets/img/logo-magic.png" alt="Magic: The Gathering" class="menu-logo mb-2">
          <div>Magic: The Gathering</div>
        </a>
      </div>
    </li>
  </ul>
</li>
        <!-- Juegos de Mesa (redirección a categorías por subcategoría general) -->
        <li class="nav-item"><a class="nav-link" href="subcategoria.php?sub=Infantiles">Juegos Infantiles</a></li>
        <li class="nav-item"><a class="nav-link" href="subcategoria.php?sub=Familiar">Juegos Familiares</a></li>
        
        <!-- Accesorios -->
        <li class="nav-item"><a class="nav-link" href="subcategoria.php?sub=Porta%20mazos">Porta Mazos</a></li>
        <li class="nav-item"><a class="nav-link" href="subcategoria.php?sub=Fundas">Fundas</a></li>

        <!-- Pre-Ventas -->
        <li class="nav-item"><a class="nav-link" href="pre_ventas.php">Pre-Ventas</a></li>
      </ul>

      <!-- Iconos a la derecha -->
      <ul class="navbar-nav ms-auto">
        <!-- Música -->
        <li class="nav-item">
          <a class="nav-link" href="#" id="toggleMusic" title="Activar/Desactivar música">
            <i id="musicIcon" class="bi bi-volume-off fs-3"></i>
          </a>
        </li>
        <!-- Carrito -->
        <li class="nav-item">
          <a class="btn-menu fs-2" data-bs-toggle="offcanvas" href="#offcanvasCarrito" role="button" aria-controls="offcanvasCarrito">
              <i class="bi bi-bag fs-3"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>