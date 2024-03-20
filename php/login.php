<?php
include("config.php");

try {
    $hostname = "localhost";
    $dbname = "lokeleague";
    $username = $dbUser;
    $pw = $dbPass;
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");

   
} catch (PDOException $e) {
    $error_message = "Failed to get DB handle: " . $e->getMessage();
    error_log($error_message); // Envía el mensaje de error a la salida estándar
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el formulario de inicio de sesión fue enviado
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Verificar si el usuario existe en la base de datos
        $stmt = $pdo->prepare("SELECT * FROM users WHERE Email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Password'])) {
            // Iniciar sesión exitosa
            $_SESSION['user_id'] = $user['ID'];
            header("Location: ../dashboard.php"); // Redirigir al usuario a la página de inicio
            exit;
        } else {
            // Credenciales incorrectas
            setcookie('error', "Credenciales incorrectas. Por favor, inténtalo de nuevo.", time() + 60, '/');
            header("Location: ../index.php");
            exit;
        }
    }
}
?>
