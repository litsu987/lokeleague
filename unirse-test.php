<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Estilos opcionales */
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

        /* Estilos para las imágenes */
        .gen-images img {
            width: 100px; /* Ancho de las imágenes */
            height: auto; /* Altura automática para mantener la proporción */
            margin: 5px; /* Margen entre las imágenes */
        }
        
    </style>
</head>
<body>
    <div id="liga-container">
        <h1>Selecciona una Liga</h1>
       
        <br>
        

        <div class="text-container">
            <div class="images-container gen-all">
                <p class="gen-all">Todos</p>
            </div>
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
            <div class="images-container gen-v">
                <p class="gen-v">GenV</p>
            </div>
        </div>

        <div class="gen-images-container">
            <div class="gen-images gen-all-images">
                <img src="/img/rojofuego.webp" alt="Gen I">
                <img src="/img/verdehoja.webp" alt="Gen I">
                <img src="/img/hearthgold.webp" alt="Gen II">
                <img src="/img/soulsilver.webp" alt="Gen II">
                <img src="/img/emerald-logo@2.webp" alt="Gen III">
                <img src="/img/platinum-logo.webp" alt="Gen IV">
                <img src="/img/black-2-logo@2.webp" alt="Gen V">
                <img src="/img/white-2-logo@2.webp" alt="Gen V">
            </div>
            <div class="gen-images gen-i-images">
                <img src="/img/rojofuego.webp" alt="Gen I">
                <img src="/img/verdehoja.webp" alt="Gen I">
            </div>
            <div class="gen-images gen-ii-images">
                <img src="/img/hearthgold.webp" alt="Gen II">
                <img src="/img/soulsilver.webp" alt="Gen II">
            </div>
            <div class="gen-images gen-iii-images">
                <img src="/img/emerald-logo@2.webp" alt="Gen III">
            </div>
            <div class="gen-images gen-iv-images">
                <img src="/img/platinum-logo.webp" alt="Gen IV">
              

            </div>
            <div class="gen-images gen-v-images">
                <img src="/img/black-2-logo@2.webp" alt="Gen V">
                <img src="/img/white-2-logo@2.webp" alt="Gen V">
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var genSections = document.querySelectorAll('.images-container');
            var genImagesContainers = document.querySelectorAll('.gen-images');

            genSections.forEach(function(section) {
                section.addEventListener('click', function() {
                    var genClass = section.classList[1]; // Obtiene la clase de la generación seleccionada
                    genImagesContainers.forEach(function(container) {
                        container.style.display = 'none'; // Oculta todos los contenedores de imágenes
                    });
                    var selectedGenImagesContainer = document.querySelector('.' + genClass + '-images');
                    selectedGenImagesContainer.style.display = 'block'; // Muestra el contenedor de imágenes correspondiente
                });
            });

            // Agregar funcionalidad para la opción "Todos"
            var allImagesContainer = document.querySelector('.gen-all-images');
            var genAllOption = document.querySelector('.gen-all');
            genAllOption.addEventListener('click', function() {
                genImagesContainers.forEach(function(container) {
                    container.style.display = 'none'; //
                });
                allImagesContainer.style.display = 'block'; // Muestra el contenedor de imágenes de todas las generaciones
            });
        });
    </script>
</body>
</html>