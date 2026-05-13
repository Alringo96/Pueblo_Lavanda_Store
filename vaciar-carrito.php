<?php
session_start();

// Borrar la variable de sesión del carrito
unset($_SESSION['carrito']);
?>