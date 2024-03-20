<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Estilos opcionales */
        #liga-container {
    width: 300px; /* Anchura del contenedor */
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
        
    </style>
</head>
<body>
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
            <div class="images-container gen-v">
                <p class="gen-v">GenV</p>
            </div>
        </div>

        <div class="gen-images-container">
            <div class="gen-images gen-i-images">
                <img src="imagen_gen1.jpg" alt="Gen I">
                <img src="imagen_gen2.jpg" alt="Gen I">
            </div>
            <div class="gen-images gen-ii-images">
                <img src="imagen_gen3.jpg" alt="Gen II">
                <img src="imagen_gen4.jpg" alt="Gen II">
            </div>
            <div class="gen-images gen-iii-images">
                <img src="imagen_gen5.jpg" alt="Gen III">
                <img src="imagen_gen6.jpg" alt="Gen III">
            </div>
            <div class="gen-images gen-iv-images">
                <img src="imagen_gen7.jpg" alt="Gen IV">
                <img src="imagen_gen8.jpg" alt="Gen IV">
            </div>
            <div class="gen-images gen-v-images">
                <img src="imagen_gen9.jpg" alt="Gen V">
                <img src="imagen_gen10.jpg" alt="Gen V">
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
        });
    </script>
</body>
</html>