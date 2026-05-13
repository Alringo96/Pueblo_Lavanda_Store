<?php 
// Arrancamos la sesión si es que no existía
if (!isset($_SESSION)) session_start();
// Reasignamos un valor "nulo" a cada variable de sesión usando la función foreach()
foreach ($_SESSION as $k => $v) {  
    $_SESSION[$k] = NULL;
}
// Destruir la sesión registrada y redireccionamos
session_destroy();
header("Location: ../index.php");
?>
