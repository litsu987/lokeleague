<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Estilos CSS para la disposición de los elementos */
        .formulario {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            
        }
        .columna {
            width: 25%; /* Ancho de cada columna */
        }
        .input {
            margin-bottom: 10px;
        }
        label {
            margin-right: 10px;
        }

        #liga-container {
            width: 400px; /* Anchura del contenedor */
            margin: 0 auto; /* Margen superior e inferior 0, margen izquierdo y derecho automático (centra horizontalmente) */
            text-align: center; /* Centra el texto dentro del contenedor */
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }

        h1 {
            color: #333;
        }
        input[type="text"] {
            width: 70%;
            padding: 8px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .images-container {
            display: inline-block; 
            margin-top: 0px; /* Ajusta el margen superior para más separación */
            margin-bottom: 20px; /* Ajusta el margen inferior para más separación */
            overflow-x: auto; 
            text-align: center; 
            
        }
        .images-container:last-child {
            border-right: none; 
        }

        .text-container p {
            color: gray; 
            font-weight: bold; 
            margin: 5px;
        }

        /* Aumentar el tamaño de las letras Gen */
        .images-container p {
            color: gray;
            font-size: 18px; /* Puedes ajustar el tamaño según tu preferencia */
            transition: color 0.3s; /* Transición de color */
        }

        .gen-selected {
            color: black !important; /* !important para priorizar este color sobre el color establecido en el estilo */
            text-decoration: underline; /* Agregar subrayado */
        }

        /* Cambiar el color al pasar el ratón */
        .images-container p:hover {
           
            cursor: pointer; /* Cambiar el cursor */
        }

        /* Estilos omitidos por brevedad */
        #liga-container {
            /* Estilos omitidos por brevedad */
        }
        .images-container {
            /* Estilos omitidos por brevedad */
        }
        .gen-images {
            display: none; /* Ocultar todas las imágenes al principio */
        }
        .gen-images.active {
            display: block; /* Mostrar las imágenes de la generación activa */
        }

        /* Estilos para las imágenes */
        .gen-images img {
            width: 100px; /* Ancho de las imágenes */
            height: auto; /* Altura automática para mantener la proporción */
            margin: 5px; /* Margen entre las imágenes */
        
        }
        
        .image-with-text {
            display: inline-block;
            text-align: center;
            cursor: pointer; /* Cambiar el cursor al pasar sobre la imagen */
        }

        .image-with-text img {
            display: block; /* Asegura que las imágenes se muestren correctamente una debajo de la otra */
            margin-bottom: 5px; /* Agrega un pequeño espacio entre la imagen y el texto */
        }

        .image-with-text p {
            margin: 0; /* Asegura que no haya espacios entre el texto y los bordes del contenedor */
        }


        .image-with-text.selected img {
            filter: grayscale(0%); /* Eliminar la escala de grises cuando la imagen está seleccionada */
        }
      
    </style>
</head>
<body>
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
    // Obtenemos todos los datos del formulario
    $nombre = $_POST['nombre'];
    $numero_personas = $_POST['numero_personas'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $modalidad = isset($_POST['modalidad']) ? "Modalidad: Activada" : "Modalidad: Desactivada";
    $imagen_seleccionada = $_POST['imagen_seleccionada']; // Nuevo campo para capturar el nombre de la imagen seleccionada
    
    // Obtener las normas del modo aleatorio
    $normas_aleatorias = [];
    if (isset($_POST['entrenadores_aleatorias'])) {
        $normas_aleatorias[] = "Entrenadores Aleatorias";
    }
    if (isset($_POST['salvajes_aleatorias'])) {
        $normas_aleatorias[] = "Salvajes Aleatorias";
    }
    if (isset($_POST['ataques_aleatorias'])) {
        $normas_aleatorias[] = "Ataques Aleatorias";
    }
    if (isset($_POST['habilidades_aleatorias'])) {
        $normas_aleatorias[] = "Habilidades Aleatorias";
    }
    
    // Mostramos todos los datos en la página
    echo "<h2>Datos del formulario:</h2>";
    echo "<p>Nombre de la liga: $nombre</p>";
    echo "<p>Número de participantes: $numero_personas</p>";
    echo "<p>Fecha de inicio: $fecha_inicio</p>";
    echo "<p>Fecha de fin: $fecha_fin</p>";
    echo "<p>Imagen seleccionada: $imagen_seleccionada</p>"; // Mostrar el nombre de la imagen seleccionada
    echo "<p>$modalidad</p>";
    if (!empty($normas_aleatorias)) {
        echo "<p>Normas del modo aleatorio:</p>";
        echo "<ul>";
        foreach ($normas_aleatorias as $norma) {
            echo "<li>$norma</li>";
        }
        echo "</ul>";
    }
}
?>

    <div class="texto-formulario">
                        <h2>Crear Liga</h2>
                        <!-- Puedes agregar un mensaje de error si lo necesitas -->
                    </div>
    <div id="contenidoAdicional" class="popupContainer">
        <div class="popupContent">

            <form class="formulario" method="POST" >
                <input type="hidden" name="tipo_formulario" value="crear_liga">
                <div class="columna">
                    
                    <div class="input">
                        <label for="nombre">Nombre de la liga:</label><br>
                        <input type="text" placeholder="Ingresa el nombre de la liga" id="nombre" name="nombre" required>
                    </div>

                    <div class="input">
                        <label for="numero_personas">Participantes:</label><br>
                        <input type="number" placeholder="Número de participantes"  id="numero_personas" name="numero_personas" required>
                    </div>

                   <div class="input">
                        <div class="input">
                            <label for="fecha_inicio">Fecha inicial:</label><br>
                            <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                    
                        <div class="input">
                            <label for="fecha_fin">Fecha final:</label><br>
                            <input type="datetime-local" id="fecha_fin" name="fecha_fin" required>
                        </div>
                    </div>
                </div>

                <div class="columna" style="border-right: 3px solid #ccc;">
                    <div class="input">
                        <div class="statusToggle">
                            <label for="fecha_fin">Modalidad</label><br>
                            <input type="checkbox">
                            <span class="toggleFeedback">Normal</span>
                        </div>
                    </div>
                                    
                    <div class="input">
                        <h2>Normas Modo Aleatorio </h2>
                                            
                        <input type="checkbox">
                        <span class="toggleFeedback">Entrenadores Aleatorias</span>
                        <br>
                                            
                        <input type="checkbox">
                        <span class="toggleFeedback">Salvajes Aleatorias</span>
                        <br>
                                            
                        <input type="checkbox">
                        <span class="toggleFeedback">Ataques Aleatorias</span>
                        <br>

                        <input type="checkbox">
                        <span class="toggleFeedback">Habilidades Aleatorias</span>
                        <br>
                    </div>
                   
                    <button type="submit" name="enviar" id="enviar">Enviar</button>

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
                                <img src="/img/rojofuego.webp" alt="Gen I">
                                <p>Rojo fuego</p>
                            </div>

                            <div class="image-with-text">
                                <img src="/img/verdehoja.webp" alt="Gen I">
                                <p>Verde Hoja</p>
                            </div>

                            <div class="image-with-text">
                            <img src="/img/hearthgold.webp" alt="Gen II">
                                <p>Hearth Gold</p>
                            </div>

                            <div class="image-with-text">
                            <img src="/img/soulsilver.webp" alt="Gen II">
                                <p>Soul Silver</p>
                            </div>

                            <div class="image-with-text">
                            <img src="/img/emerald-logo@2.webp" alt="Gen III">
                                <p>Esmeralda</p>
                            </div>

                            <div class="image-with-text">
                            <img src="/img/platinum-logo.webp" alt="Gen IV">
                                <p>Platino</p>
                            </div>

                            <div class="image-with-text">
                            <img src="/img/black-2-logo@2.webp" alt="Gen V">
                                <p>Negro2</p>
                            </div>

                            <div class="image-with-text">
                            <img src="/img/white-2-logo@2.webp" alt="Gen V">
                                <p>Blanco2</p>
                            </div>
                        
                        </div>
                        <div class="gen-images gen-i-images">
                            <div class="image-with-text">
                                <img src="/img/rojofuego.webp" alt="Gen I">
                                <p>Rojo fuego</p>
                            </div>

                            <div class="image-with-text">
                                <img src="/img/verdehoja.webp" alt="Gen I">
                                <p>Verde Hoja</p>
                            </div>
                        </div>
                        <div class="gen-images gen-ii-images">
                            <div class="image-with-text">
                                <img src="/img/hearthgold.webp" alt="Gen II">
                                <p>Hearth Gold</p>
                            </div>

                            <div class="image-with-text">
                                <img src="/img/soulsilver.webp" alt="Gen II">
                                <p>Soul Silver</p>
                            </div>
                        </div>
                        <div class="gen-images gen-iii-images">
                            <div class="image-with-text">
                                <img src="/img/emerald-logo@2.webp" alt="Gen III">
                                <p>Esmeralda</p>
                            </div>
                        </div>
                        <div class="gen-images gen-iv-images">
                            <div class="image-with-text">
                                <img src="/img/platinum-logo.webp" alt="Gen IV">
                                <p>Platino</p>
                            </div>
                        
                        </div>
                        <div class="gen-images gen-v-images">
                            <div class="image-with-text">
                                <img src="/img/black-2-logo@2.webp" alt="Gen V">
                                <p>Negro2</p>
                            </div>
                            <div class="image-with-text">
                                <img src="/img/white-2-logo@2.webp" alt="Gen V">
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

<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener todas las secciones Gen
            var genSections = document.querySelectorAll('.images-container');

            // Agregar un evento de clic a cada sección Gen
            genSections.forEach(function(section) {
                section.addEventListener('click', function() {
                    // Remover la clase 'gen-selected' de todas las secciones Gen
                    genSections.forEach(function(s) {
                        s.classList.remove('gen-selected');
                    });
                    // Agregar la clase 'gen-selected' a la sección clicada
                    section.classList.add('gen-selected');
                });
            });

            var allImagesContainer = document.querySelector('.gen-all-images');
            var genImagesContainers = document.querySelectorAll('.gen-images');

            // Mostrar todas las imágenes al cargar la página
            genImagesContainers.forEach(function(container) {
                container.style.display = 'none';
            });
            allImagesContainer.style.display = 'block';

            var genSections = document.querySelectorAll('.images-container');

            genSections.forEach(function(section) {
                section.addEventListener('click', function() {
                    // Restablecer el color de todos los elementos
                    genSections.forEach(function(sec) {
                        sec.querySelector('p').classList.remove('gen-selected');
                    });

                    var genClass = section.classList[1]; // Obtiene la clase de la generación seleccionada
                    genImagesContainers.forEach(function(container) {
                        container.style.display = 'none'; // Oculta todos los contenedores de imágenes
                    });
                    var selectedGenImagesContainer = document.querySelector('.' + genClass + '-images');
                    selectedGenImagesContainer.style.display = 'block'; // Muestra el contenedor de imágenes correspondiente

                    // Cambiar el color del texto de la opción seleccionada a negro
                    section.querySelector('p').classList.add('gen-selected');

                    // Restablecer el filtro de todas las imágenes al cambiar de generación
                    var images = document.querySelectorAll('.image-with-text img');
                    images.forEach(function(img) {
                        img.style.filter = 'none';
                    });
                });
            });

            // Agregar funcionalidad para la opción "Todos"
            var genAllOption = document.querySelector('.gen-all');
            genAllOption.addEventListener('click', function() {
                // Restablecer el color de todos los elementos
                genSections.forEach(function(sec) {
                    sec.querySelector('p').classList.remove('gen-selected');
                });

                genImagesContainers.forEach(function(container) {
                    container.style.display = 'none'; //
                });
                allImagesContainer.style.display = 'block'; // Muestra el contenedor de imágenes de todas las generaciones

                // Cambiar el color del texto de la opción "Todos" a negro
                genAllOption.querySelector('p').classList.add('gen-selected');

                // Restablecer el filtro de todas las imágenes al seleccionar "Todos"
                var images = document.querySelectorAll('.image-with-text img');
                images.forEach(function(img) {
                    img.style.filter = 'none';
                });
            });

            // Establecer "Todos" como seleccionado por defecto
            genAllOption.click();

            // Agregar funcionalidad para seleccionar una imagen y mostrar el texto asociado en la consola
            var images = document.querySelectorAll('.image-with-text');
            images.forEach(function(image) {
                image.addEventListener('click', function() {
                    // Restablecer el color de todos los elementos
                    images.forEach(function(img) {
                        img.querySelector('p').classList.remove('gen-selected');
                    });

                    // Cambiar el color del texto de la imagen seleccionada a negro y subrayado
                    this.querySelector('p').classList.add('gen-selected');

                    // Cambiar el color de las imágenes no seleccionadas a gris
                    images.forEach(function(img) {
                        if (img !== image) {
                            img.querySelector('img').style.filter = 'grayscale(100%)';
                        } else {
                            img.querySelector('img').style.filter = 'none';
                        }
                    });

                    // Obtener el texto asociado a la imagen seleccionada
                    var imageName = this.querySelector('p').innerText;
                    console.log("Texto asociado: " + imageName);

                    // Agregar el nombre de la imagen seleccionada al campo del formulario
                    document.getElementById('nombre_imagen_seleccionada').value = imageName;
                });
            });
        });
    </script>
</html>
