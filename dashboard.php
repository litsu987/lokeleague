<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script> <!-- Agregamos el atributo defer para que el script se ejecute después de cargar el HTML -->
    <title>LOKE LEAGUE - Dashboard</title>
    <style>
        /* Estilos CSS adicionales */
        .text-container p {
            display: inline-block; /* Mostrar los textos en línea */
            margin-right: 10px; /* Espaciado entre los textos */
        }
        .modal {
            display: none; /* Ocultar el modal por defecto */
            position: fixed; /* Fijar la posición */
            top: 50%; /* Colocar en el centro verticalmente */
            left: 50%; /* Colocar en el centro horizontalmente */
            transform: translate(-50%, -50%); /* Centrar el modal */
            background-color: white; /* Fondo blanco */
            padding: 20px; /* Espaciado interno */
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra */
            z-index: 9999; /* Z-index alto para estar por encima de otros elementos */
            opacity: 0; /* Inicialmente transparente */
            transition: opacity 0.3s ease; /* Transición suave de la opacidad */
            width: 80%; /* Ancho del modal */
            max-width: 2000px; /* Ancho máximo del modal */
            height: 80%; /* Altura del modal */
            max-height: 600px; /* Altura máxima del modal */
            overflow-y: auto; /* Habilitar el desplazamiento vertical si el contenido es demasiado grande */
        }
        .modal.show {
            display: block; /* Mostrar el modal */
            opacity: 1; /* Hacerlo completamente visible */
        }
        #cerrarModalBtn {
            font-size: 24px; /* Tamaño de la fuente */
            width: 40px; /* Ancho del botón */
            height: 40px; /* Altura del botón */
            border: none; /* Quitar borde */
        
            cursor: pointer; /* Cambiar cursor al pasar sobre el botón */
            color: #333; /* Color del icono */
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Color semitransparente */
            z-index: 999; /* Z-index alto para que esté por encima de todo */
        }

        .modal.show {
            display: block;
            opacity: 1;
            z-index: 1000; /* Asegúrate de que el modal esté por encima del overlay */
        }

        .show-overlay {
            display: block;
        }

        .crearLigaDivDisabled {
            /* Estilos para deshabilitar la interacción */
            pointer-events: none; /* Deshabilitar eventos de puntero */
            opacity: 0.5; /* Reducir la opacidad para indicar que está deshabilitado */
            /* Estilos para el fondo gris transparente */
            background-color: rgba(128, 128, 128, 0.5); /* Fondo gris transparente */
        }
                    
    </style>
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

if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];

    $stmt_check_user = $pdo->prepare("SELECT * FROM liga_usuarios WHERE UserID = ?");
    $stmt_check_user->execute([$userID]);
    $user_registered = $stmt_check_user->fetch(PDO::FETCH_ASSOC);

    if ($user_registered) {
        echo '<script>
                 document.addEventListener("DOMContentLoaded", function() {
                     var crearLigaDiv = document.getElementById("crearLiga");
                     crearLigaDiv.classList.add("crearLigaDivDisabled");
                 });
             </script>';
    }
}
?>


<section>
    <div class="centeredContainer"> 
        <div class="horizontalContainer">
            <div class="elemento1" id="crearLiga">
                <h1 class="titulo">Crear Liga</h1> 
            </div>
            <div class="elemento2">
                <h1 class="titulo">Unirse a Liga</h1>
            </div>  
            <div class="elemento3">
                <h1 class="titulo">Mis Ligas</h1>
            </div>
            <div class="elemento4">
                <h1 class="titulo">Panel de Usuario</h1>
            </div>
        </div>
    </div>
</section>

<!-- El div del modal -->
<div class="modal" id="modalCrearLiga">
    <!-- Contenido del modal se llenará con AJAX -->
    
</div>

<div class="overlay" id="overlay"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // Función para cargar el contenido del modal y activar los scripts después de que se haya cargado el contenido AJAX
// Función para cargar el contenido del modal y activar los scripts después de que se haya cargado el contenido AJAX
    function cargarModalYScripts() {
        // Agregar el botón para cerrar el modal
        document.getElementById("overlay").classList.add("show-overlay");
        document.getElementById("modalCrearLiga").innerHTML = '<button id="cerrarModalBtn"><i class="fas fa-times"></i></button>';

        // Realizar una solicitud AJAX al archivo PHP
        $.ajax({
            url: 'crearliga.php', // Ruta al archivo PHP
            type: 'GET', // Método de solicitud
            success: function(response) {
                // Insertar el resultado dentro del modal
                document.getElementById("modalCrearLiga").innerHTML += response;
                // Mostrar el modal
                document.getElementById("modalCrearLiga").classList.add("show");

                // Activar los scripts después de cargar el contenido del modal
                activarScripts();

                // Agregar evento click al botón de cerrar modal después de cargar el contenido dinámico
                document.getElementById("cerrarModalBtn").addEventListener("click", function() {
                    cerrarModal();
                });
            },
            error: function(xhr, status, error) {
                // Manejar errores si es necesario
                console.error(xhr);
            }
        });
    }


    // Función para activar los scripts dentro del contenido del modal
    function activarScripts() {
        var form = document.getElementById('miFormulario');
        form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevenir el envío del formulario normal
                
                // Obtener los datos del formulario
                var formData = new FormData(form);

                // Realizar la solicitud AJAX
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'insertarliga.php', true);
                xhr.onload = function () {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        // Éxito en la solicitud
                        console.log('Datos enviados correctamente:', xhr.responseText);
                        // Aquí puedes actualizar la interfaz de usuario según sea necesario
                        window.location.href = "dashboard.php"; // Redirigir a dashboard.php
                    } else {
                        // Error en la solicitud
                        console.error('Error al enviar datos:', xhr.statusText);
                    }
                };
                xhr.onerror = function () {
                    // Error de red
                    console.error('Error de red al enviar datos.');
                };
                xhr.send(formData);
            });

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
        allImagesContainer.style.display = 'block';

        //
        // Mostrar todas las imágenes al cargar la página
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

        });

        // Establecer "Todos" como seleccionado por defecto
        genAllOption.click();

        // Agregar funcionalidad para seleccionar una imagen y mostrar el texto asociado en la consola
        var images = document.querySelectorAll('.image-with-text');
        images.forEach(function(image) {
            image.addEventListener('click', function() {
                var selectedText = this.querySelector('p').innerText;

                // Deseleccionar todas las imágenes
                images.forEach(function(img) {
                    img.querySelector('p').classList.remove('gen-selected');
                });

                // Seleccionar imágenes con el mismo texto
                images.forEach(function(img) {
                    if (img.querySelector('p').innerText === selectedText) {
                        img.querySelector('p').classList.add('gen-selected');
                        img.querySelector('img').style.filter = 'none'; // Quitar el filtro de escala de grises
                    } else {
                        img.querySelector('img').style.filter = 'grayscale(100%)'; // Aplicar escala de grises a las imágenes no seleccionadas
                    }
                });

                // Obtener el texto asociado a la imagen seleccionada
                var imageName = this.querySelector('p').innerText;
                console.log("Texto asociado: " + imageName);

                // Agregar el nombre de la imagen seleccionada al campo del formulario
                document.getElementById('nombre_imagen_seleccionada').value = imageName;
            });
        });

        var optionDivs = document.querySelectorAll('.random-mode-option');

        optionDivs.forEach(function(optionDiv) {
            optionDiv.addEventListener('click', function() {
                var checkbox = optionDiv.querySelector('input[type="checkbox"]');
                checkbox.checked = !checkbox.checked; // Cambia el estado del checkbox al contrario del estado actual
            });
        });

        var modoAleatorioToggle = document.getElementById('modo-aleatorio-toggle');
        var modalidadFeedback = document.getElementById('modalidad-feedback');

        modoAleatorioToggle.addEventListener('change', function() {
            if (this.checked) {
                modalidadFeedback.textContent = 'Modo Aleatorio';
            } else {
                modalidadFeedback.textContent = 'Modo Normal';
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Cambiar el evento click al div "crearLiga"
        document.getElementById('crearLiga').addEventListener('click', function() {
            cargarModalYScripts(); // Llamar a la función para cargar el modal y activar los scripts
        });
        document.querySelector('.formulario').addEventListener('submit', function(event) {
        // Prevenir el comportamiento predeterminado del formulario (enviar los datos al servidor y actualizar la página)
        event.preventDefault();

        // Realizar el envío de datos mediante AJAX
        $.ajax({
                url: 'ruta_al_script_que_procesa_el_formulario.php', // Reemplaza 'ruta_al_script_que_procesa_el_formulario.php' con la ruta correcta
                type: 'POST',
                data: $(this).serialize(), // Serializar los datos del formulario
                success: function(response) {
                    // Cerrar el modal una vez que se hayan procesado los datos correctamente
                    cerrarModal();
                },
                error: function(xhr, status, error) {
                    // Manejar errores si es necesario
                    console.error(xhr);
                }
            });
        });
    });
    function cerrarModal() {
        document.getElementById("modalCrearLiga").classList.remove("show");

        // Ocultar el overlay
        document.getElementById("overlay").classList.remove("show-overlay");
    }

    // Agregar evento click al botón de cerrar modal
    document.getElementById("cerrarModalBtn").addEventListener("click", function() {
        cerrarModal();
    });
</script>
</body>
</html>
