<?php
if (!isset($_SESSION)) session_start();

// Comprueba si el usuario no está logueado o si no es Admin
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') {
    // Redirigir al usuario a la página de login si no cumple los requisitos
    header("Location: login.php");
    exit;
}
?>