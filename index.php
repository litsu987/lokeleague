<?php
include("php/config.php");

session_start();

// Verificar si el usuario no ha iniciado sesión
if (isset($_SESSION['user_id'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: dashboard.php");
    exit;
}


// Obtener el error de la cookie, si existe
$error = isset($_COOKIE['error']) ? $_COOKIE['error'] : '';
setcookie('error', '', time() - 3600, '/'); // Eliminar la cookie

$success = isset($_COOKIE['success']) ? $_COOKIE['success'] : '';
setcookie('success', '', time() - 3600, '/'); // Eliminar la cookie
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link href="https://fonts.cdnfonts.com/css/europa-title" rel="stylesheet">
    <link rel="stylesheet" href="login_register.css">
    <title>Document</title>
</head>
	<body>
        <?php include("components/header.php"); ?>
		<div class="container">
			<div class="left">
                <div class="image-container">
                    <img src="https://cdn.discordapp.com/attachments/1060288098916905041/1213919603860967505/logolokeleague.png?ex=65f739bb&is=65e4c4bb&hm=f59a6a6904f33ba8a66011a24261cd616870292860caec52c01cd53d68abdee3&" alt="Descripción de la imagen">
                </div>
                <div class="form-container">
                   
                    <form class="form active" id="loginForm" action="php/login.php" method="POST">
                        <h1 class="login-title">Iniciar Sesión</h1>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-with-icon">
                                <input type="email" id="email" name="email" required />
                                <i class='bx bxs-envelope' ></i>
                            </div>
                          
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <div class="input-with-icon">
                                <input type="password" id="password" name="password" required />
                                <i class="bx bxs-lock-alt"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit">Iniciar sesión</button>
                        </div>
                        <div class="form-options">
                            <a href="#" id="showRegisterForm">¿No tienes una cuenta? Regístrate</a>
                        </div>
                        <div class="form-options">
                            <a href="#" id="showForgotPasswordForm">¿Olvidaste tu contraseña?</a>
                        </div>
                    </form>

                    <form class="form" id="registerForm" action="php/register.php" method="POST">
                        <h1 class="login-title">Registrarse</h1>
                        <div class="form-group">
                            <label for="username">Nombre de Usuario</label>
                            <div class="input-with-icon">
                                <input type="text" id="username" name="username" required />
                                <i class="bx bxs-user"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-with-icon">
                                <input type="email" id="email" name="email" required />
                                <i class='bx bxs-envelope' ></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <div class="input-with-icon">
                                <input type="password" id="password" name="password" required />
                                <i class="bx bxs-lock-alt"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirmar Contraseña</label>
                            <div class="input-with-icon">
                                <input type="password" id="confirmPassword" name="confirmPassword" required />
                                <i class="bx bxs-lock-alt"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit">Registrarse</button>
                        </div>
                        <div class="form-options">
                            <a href="#" id="showLoginForm">¿Ya tienes una cuenta? Inicia sesión</a>
                        </div>
                    </form>

                    <form class="form" id="forgotPasswordForm" action="php/forgot_password.php" method="POST">
                        <h1 class="login-title">Recuperar Contraseña</h1>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-with-icon">
                                <input type="email" id="forgotPasswordEmail" name="forgotPasswordEmail" required />
                                <i class='bx bxs-envelope'></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit">Enviar correo de recuperación</button>
                        </div>
                        <div class="form-options">
                             <a href="#" id="returnToLoginForm">Volver al inicio de sesión</a>
                        </div>
                    </form>

                    <?php if (!empty($error)) { ?>
                        <div class="error-message"><?php echo $error; ?></div>
                        <div class="success-message"><?php echo $success; ?></div>
                    <?php } ?>
                                    
        </div>
			</div>
			<div class="right">
			</div>
		</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
	</body>