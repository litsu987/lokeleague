<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>

</head>
<body>
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



?>

    <div id="contenidoAdicional" class="popupContainer">
        <div class="popupContent">

        <form class="formulario" id="miFormulario" method="post">

                <input type="hidden" name="tipo_formulario" value="crear_liga">
                <div class="columna">
                    
                    <div class="input">
                        <label for="nombre"></label>
                        <h3>Nombre de la Liga </h3>
                        <input type="text" placeholder="Ingresa el nombre de la liga" id="nombre" name="nombre" >
                    </div>

                    <div class="input">
                        <label for="numero_personas"></label><br>
                        <h3>Participantes: </h3>
                        <input type="number" placeholder="Número de participantes"  id="numero_personas" name="numero_personas" >
                    </div>

                   <div class="input">
                        <div class="input">
                            <label for="fecha_inicio">Fecha inicial:</label><br>
                            <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" >
                        </div>
                    
                        <div class="input">
                            <label for="fecha_fin">Fecha final:</label><br>
                            <input type="datetime-local" id="fecha_fin" name="fecha_fin" >
                        </div>
                    </div>
                    <button type="submit" name="enviar" id="enviar">Enviar</button>
                </div>
                
                <div class="columna" style="border-right: 3px solid #ccc;">
                    <div class="input">
                        <h2>Modalidad</h2>
                        <label class="switch" for="modo-aleatorio-toggle">
                            <input type="checkbox" id="modo-aleatorio-toggle" name="modo-aleatorio-toggle">
                            <span class="slider round"></span>
                        </label>
                        <span id="modalidad-feedback">Modo Normal</span>
                    </div>


                                    
                    <div class="input">
                        <h2>Normas Modo Aleatorio </h2>
                                                    
                        <div class="random-mode-option">
                            <input type="checkbox" id="entrenadores-aleatorios" name="entrenadores-aleatorios">
                            <span class="toggleFeedback">Entrenadores Aleatorios</span>
                        </div>

                       <div class="random-mode-option">  
                            <input type="checkbox" id="salvajes-aleatorios" name="salvajes-aleatorios">
                            <span class="toggleFeedback">Salvajes Aleatorios</span>
                        </div>

                        <div class="random-mode-option">
                            <input type="checkbox"id="ataques-aleatorios" name="ataques-aleatorios">
                            <span class="toggleFeedback">Ataques Aleatorios</span>
                        </div>

                        <div class="random-mode-option">
                            <input type="checkbox"id="hab-aleatorios" name="hab-aleatorios">
                            <span class="toggleFeedback">Habilidades Aleatorias</span>
                        </div>
                    </div>

                   
                

                </div>
               


                <div id="liga-container">
                    <h1>Selecciona una Juego</h1>
                
                    <br>

                    <div class="text-container">
                        <div class="images-container gen-all">
                            <p class="gen-all">Todos</p>
                        </div>
                        <div class="images-container gen-i">
                            <p class="gen-i">Gen I</p>
                        </div>
                        <div class="images-container gen-ii">
                            <p class="gen-ii">Gen II</p>
                        </div>
                        <div class="images-container gen-iii">
                            <p class="gen-iii">Gen III</p>
                        </div>
                        <div class="images-container gen-iv">
                            <p class="gen-iv">Gen IV</p>
                        </div>
                        <div class="images-container gen-v">
                            <p class="gen-v">Gen V</p>
                        </div>
                    </div>
                    <hr class="separator">
                    <div class="gen-images-container">
                        <div class="gen-images gen-all-images">
                                
                            <div class="image-with-text">
                                <img src="img/rojofuego.webp" alt="Gen I">
                                <p>Rojo fuego</p>
                            </div>

                            <div class="image-with-text">
                                <img src="img/verdehoja.webp" alt="Gen I">
                                <p>Verde Hoja</p>
                            </div>

                            <div class="image-with-text">
                            <img src="img/hearthgold.webp" alt="Gen II">
                                <p>Hearth Gold</p>
                            </div>

                            <div class="image-with-text">
                            <img src="img/soulsilver.webp" alt="Gen II">
                                <p>Soul Silver</p>
                            </div>

                            <div class="image-with-text">
                            <img src="img/emerald-logo@2.webp" alt="Gen III">
                                <p>Esmeralda</p>
                            </div>

                            <div class="image-with-text">
                            <img src="img/platinum-logo.webp" alt="Gen IV">
                                <p>Platino</p>
                            </div>

                            <div class="image-with-text">
                            <img src="img/black-2-logo@2.webp" alt="Gen V">
                                <p>Negro2</p>
                            </div>

                            <div class="image-with-text">
                            <img src="img/white-2-logo@2.webp" alt="Gen V">
                                <p>Blanco2</p>
                            </div>
                        
                        </div>
                        <div class="gen-images gen-i-images">
                            <div class="image-with-text">
                                <img src="img/rojofuego.webp" alt="Gen I">
                                <p>Rojo fuego</p>
                            </div>

                            <div class="image-with-text">
                                <img src="img/verdehoja.webp" alt="Gen I">
                                <p>Verde Hoja</p>
                            </div>
                        </div>
                        <div class="gen-images gen-ii-images">
                            <div class="image-with-text">
                                <img src="img/hearthgold.webp" alt="Gen II">
                                <p>Hearth Gold</p>
                            </div>

                            <div class="image-with-text">
                                <img src="img/soulsilver.webp" alt="Gen II">
                                <p>Soul Silver</p>
                            </div>
                        </div>
                        <div class="gen-images gen-iii-images">
                            <div class="image-with-text">
                                <img src="img/emerald-logo@2.webp" alt="Gen III">
                                <p>Esmeralda</p>
                            </div>
                        </div>
                        <div class="gen-images gen-iv-images">
                            <div class="image-with-text">
                                <img src="img/platinum-logo.webp" alt="Gen IV">
                                <p>Platino</p>
                            </div>
                        
                        </div>
                        <div class="gen-images gen-v-images">
                            <div class="image-with-text">
                                <img src="img/black-2-logo@2.webp" alt="Gen V">
                                <p>Negro2</p>
                            </div>
                            <div class="image-with-text">
                                <img src="img/white-2-logo@2.webp" alt="Gen V">
                                <p>Blanco2</p>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="nombre_imagen_seleccionada" name="imagen_seleccionada" value="">
            </form>
        </div>
    </div>
</body>


</html>
