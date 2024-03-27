<?php
include("php/config.php");

session_start(); // Iniciar sesión si aún no se ha hecho

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
    // Obtener todos los datos del formulario
    $nombre = $_POST['nombre'];
    $numero_personas = $_POST['numero_personas'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $modalidad = isset($_POST['modo-aleatorio-toggle']) ? 1 : 0;
    $imagen_seleccionada = $_POST['imagen_seleccionada'];
    $regla1 = isset($_POST['entrenadores-aleatorios']) ? 1 : 0;
    $regla2 = isset($_POST['salvajes-aleatorios']) ? 1 : 0;
    $regla3 = isset($_POST['ataques-aleatorios']) ? 1 : 0;
    $regla4 = isset($_POST['hab-aleatorios']) ? 1 : 0;

    // Obtener el CreatorID del usuario actual desde la sesión
    
    if (isset($_SESSION['user_id'])) {
        $creatorID = $_SESSION['user_id'];
    } else {
        // Si el usuario no está autenticado, redirigirlo o mostrar un mensaje de error
        // Por ejemplo:
        echo "Error: Usuario no autenticado.";
        exit;
    }

    // Insertar los datos en la tabla ligas
    $stmt = $pdo->prepare("INSERT INTO ligas (NombreLiga, NombreJuego, FechaCreacion, FechaFinalizacion, RandomLocke, NumeroParticipantes, Regla1, Regla2, Regla3, Regla4, CreatorID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nombre, $imagen_seleccionada, $fecha_inicio, $fecha_fin, $modalidad, $numero_personas, $regla1, $regla2, $regla3, $regla4, $creatorID]);

    // Después de la inserción exitosa de la liga en la tabla ligas

    // Obtener el ID de la liga recién insertada
    $ligaID = $pdo->lastInsertId();

    // Insertar el registro en la tabla liga_usuarios
    $stmt2 = $pdo->prepare("INSERT INTO liga_usuarios (LigaID, UserID) VALUES (?, ?)");
    $stmt2->execute([$ligaID, $creatorID]); // $creatorID es el ID del usuario que creó la liga

    // Verificar si la inserción en liga_usuarios fue exitosa
    if ($stmt2->rowCount() > 0) {
        echo "El usuario ha sido registrado en la liga correctamente.";
    } else {
        echo "Hubo un error al registrar al usuario en la liga.";
    }

    // Verificar si la inserción fue exitosa
    if ($stmt->rowCount() > 0) {
        echo "Los datos se insertaron correctamente en la base de datos.";
    } else {
        echo "Hubo un error al insertar los datos en la base de datos.";
    }

    exit; // Asegura que el script se detenga después de la inserción
}
?>