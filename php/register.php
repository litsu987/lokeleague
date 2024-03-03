<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // El usuario ya ha iniciado sesión, redirigirlo a otra página o mostrar un mensaje de error
    header("Location: dashboard.php"); // Puedes cambiar esto según tus necesidades
    exit;
}

include("config.php");

try {
    $hostname = "localhost";
    $dbname = "lokeleague";
    $username = $dbUser;
    $pw = $dbPass;
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
} catch (PDOException $e) {
    $error_message = "Failed to get DB handle: " . $e->getMessage();
    echo '<script>console.error('.json_encode($error_message).');</script>';
    escribirEnLog("[LOGIN] " . $e);
    exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el formulario de registro fue enviado
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        // Expresión regular para validar la contraseña
        $regex = "/^(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/";

        // Verificar si la contraseña cumple con los requisitos
        if (!preg_match($regex, $password)) {
            // La contraseña no cumple con los requisitos
            setcookie('error', "La contraseña debe tener al menos 8 caracteres, incluyendo al menos un número, una letra mayúscula y un carácter especial.", time() + 60, '/');
            header("Location: ../index.php");
            exit;
        }

        // Generar token de validación
        $token = bin2hex(random_bytes(32)); // Genera un token aleatorio de 32 bytes

        // Verificar si el correo electrónico ya está registrado
        $stmt = $pdo->prepare("SELECT * FROM users WHERE Email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el nombre de usuario ya está en uso
        $stmt = $pdo->prepare("SELECT * FROM users WHERE Username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $existingUsername = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            // Correo electrónico ya registrado
            setcookie('error', "Este correo electrónico ya está registrado. Por favor, utiliza otro.", time() + 60, '/');
            header("Location: ../index.php");
            exit;
        } elseif ($existingUsername) {
            // Nombre de usuario ya en uso
            setcookie('error', "Este nombre de usuario ya está en uso. Por favor, elige otro.", time() + 60, '/');
            header("Location: ../index.php");
            exit;
        } elseif ($password !== $confirmPassword) {
            // Contraseñas no coinciden
            setcookie('error', "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.", time() + 60, '/');
            header("Location: ../index.php");
            exit;
        } else {
            // Hash de la contraseña antes de almacenarla en la base de datos
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
            // Insertar el nuevo usuario en la base de datos con el token de validación
            $stmt = $pdo->prepare("INSERT INTO users (Username, Email, Password, ValidationToken) VALUES (:username, :email, :password, :token)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
        
            // Enviar correo electrónico de validación
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Mailer = "smtp";
        
            // Configuración del servidor SMTP y credenciales
            $mail->SMTPDebug  = 0;
            $mail->SMTPAuth   = TRUE;
            $mail->SMTPSecure = "tls";
            $mail->Port       = 587;
            $mail->Host       = "smtp.gmail.com";
            $mail->Username   = "anaviogarcia.cf@iesesteveterradas.cat"; // Cambiar por tu dirección de correo electrónico
            $mail->Password   = "Caqjuueeemke64"; // Cambiar por la contraseña de tu correo electrónico
        
            $mail->IsHTML(true);
            $mail->AddAddress($email);
            $mail->SetFrom("anaviogarcia.cf@iesesteveterradas.cat", "LOKE LEAGUE");
        
            $mail->Subject = "Bienvenido a LOKE LEAGUE";
            $mail->Body = "Bienvenido, $username. Valida tu cuenta accediendo a este enlace: <a href='localhost/LokeLeague/Verification.php?validToken=$token'>Validar cuenta</a>. Atentamente, el equipo de LOKE LEAGUE.";
        
            if ($mail->Send()) {
                // Correo electrónico enviado correctamente
                header("Location: ../index.php");
                exit;
            } else {
                // Error al enviar el correo electrónico
                $error = "Error al enviar el correo electrónico de validación. Por favor, inténtalo de nuevo más tarde.";
                header("Location: ../index.php?error=".urlencode($error));
                exit;
            }
        }

    }
}
?>
