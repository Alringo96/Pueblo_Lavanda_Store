<?php
// Incluye el archivo de conexión a la base de datos
require_once('conexion.php');

// Inicia la sesión si aún no se ha iniciado
if (!isset($_SESSION)) session_start();

// Variable para almacenar mensajes de error
$error = "";

// Verifica si el formulario fue enviado con ambos campos llenos
if (
    isset($_POST['usuario']) && $_POST['usuario'] != "" &&
    isset($_POST['clave']) && $_POST['clave'] != ""
) {
    // Limpia las entradas para prevenir inyección SQL
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $clave = mysqli_real_escape_string($conexion, $_POST['clave']);

    // Consulta SQL para buscar un usuario con el usuario proporcionado
    $query = "SELECT * FROM clientes WHERE usuario= '$usuario'";
    $resultado = $conexion->query($query);

    // Si se encontró al menos un usuario válido
    if ($resultado && $resultado->num_rows > 0) {
        // Obtiene los datos del usuario como un arreglo asociativo
        $row = $resultado->fetch_assoc();

        // Verifica que la clave ingresada sea igual a la de la base
        if ($clave === $row['clave']) {
            // Guarda los datos del usuario en la sesión
            $_SESSION['user_id']   = $row['id'];
            $_SESSION['nombre']    = $row['nombre'];
            $_SESSION['rol']       = $row['rol'];
            $_SESSION['correo']    = $row['correo'];
            $_SESSION['telefono']  = $row['telefono'];
            $_SESSION['pais']      = $row['pais'];
            $_SESSION['direccion'] = $row['direccion'];

            // Redirige al inicio del sitio una vez autenticado
            header("Location: index.php");
            exit;
        } else {
            // Mensaje de error si la clave no coincide
            $error = "Clave incorrecta.";
        }
    } else {
        // Mensaje si no se encontró al usuario
        $error = "Usuario no encontrado.";
    }
}
?>
<!-- BODY -->
<?php include('cabecera-admin.php'); ?>
<main class="main-login d-flex align-items-center">
    <div class="container my-5">
        <h2 class="text-center mb-4">Iniciar sesión</h2>
        <!-- Alerta error -->
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <!-- Formulario -->
        <form method="post" action="" class="mx-auto" style="max-width: 400px;">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" name="usuario" id="usuario" required>
            </div>

            <div class="mb-3">
                <label for="clave" class="form-label">Clave</label>
                <input type="password" class="form-control" name="clave" id="clave" required>
            </div>

            <button type="submit" class="btn btn-dark w-100 mb-2">Ingresar</button>
        </form>
    </div>
</main>
<?php include('pie.php'); ?>