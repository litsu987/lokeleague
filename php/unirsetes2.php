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
            width: 20%; /* Ancho de cada columna */
        }
        .input {
            margin-bottom: 10px;
        }
        label {
            margin-right: 10px;
        }
         /* Estilos opcionales */
         #liga-container {
            width: 300px;
            margin: 0 auto;
            text-align: center;
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
            margin-top: 10px;
            overflow-x: auto; 
            text-align: center; 
            border-right: 1px solid #ccc; 
        }
        .images-container:last-child {
            border-right: none; 
        }
        .gen-selected {
            background-color: #ccc; /* Color de fondo gris */
        }
        .text-container p {
            color: black; 
            font-weight: bold; 
            margin: 0;
        }

        /* Aumentar el tamaño de las letras Gen */
        .images-container p {
            font-size: 18px; /* Puedes ajustar el tamaño según tu preferencia */
            transition: color 0.3s; /* Transición de color */
        }

        /* Cambiar el color al pasar el ratón */
        .images-container p:hover {
            color: blue; /* Puedes cambiar el color según tu preferencia */
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
                </div>


                <div id="liga-container">
                    <h1>Selecciona una Liga</h1>
                
                    <br>
                    

                    <div class="text-container">
                        <div class="images-container gen-i">
                            <p class="gen-i">GenI</p>
                        </div>
                        <div class="images-container gen-ii">
                            <p class="gen-ii">GenII</p>
                        </div>
                        <div class="images-container gen-iii">
                            <p class="gen-iii">GenIII</p>
                        </div>
                        <div class="images-container gen-iv">
                            <p class="gen-iv">GenIV</p>
                        </div>
                    </div>
                    
                </div>

               

               
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
        });
    </script>
</html>
