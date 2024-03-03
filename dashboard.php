
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: index.php");
    exit;
}
?>
