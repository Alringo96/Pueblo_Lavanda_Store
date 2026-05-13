<nav class="navbar navbar-expand-lg navbar-admin mb-4">
    <div class="container">
        <!-- Marca principal -->

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <!-- Inicio -->
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'false' : '' ?> text-light" href="../index.php">
                        <i class="bi bi-house-door me-1"></i> Volver a Tienda
                    </a>
                </li>

                <!-- Consultar -->
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?> text-light" href="index.php">
                        <i class="bi bi-clipboard2-check"></i> Listado de Productos
                    </a>
                </li>
            </ul>

            <!-- Botón de inicio de sesión -->
            <div class="d-flex">
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <a href="logout.php" class="btn btn-outline-light">
                    <i class="bi bi-box-arrow-in-left me-1"></i> Salir</a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>