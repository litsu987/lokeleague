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
    </style>
</head>
<body>
<section>
        <div class="centeredContainer"> 
            <div class="horizontalContainer">
                <div class="elemento1">
                    <h1 class="titulo">Unirse a Liga</h1>
                    <div id="formulario" style="display: none;">
                        <div id="liga-container">
                            <h1>Selecciona una Liga</h1>
                            <input type="text" placeholder="Buscar...">
                            <br>
                            <button class="participar">Participar</button>
                            <button class="info">Info</button>

                            <div class="text-container">
                                <p class="gen-i">GenI</p>
                                <div class="images-container gen-i">
                                    <img src="https://img.nuzlocke.app/logos/fire-red-logo@2.webp" alt="Rojo Fuego">
                                    <img src="https://img.nuzlocke.app/logos/leaf-green-logo@2.webp" alt="Verde Hoja">
                                </div>
                                
                                <p class="gen-ii">GenII</p>
                                <div class="images-container gen-ii">
                                    <img src="https://img.nuzlocke.app/logos/heart-gold-logo@2.webp" alt="Imagen 1 Gen II">
                                    <img src="https://img.nuzlocke.app/logos/soul-silver-logo@2.webp" alt="Imagen 2 Gen II">
                                </div>
                                
                                <p class="gen-iii">GenIII</p>
                                <div class="images-container gen-iii">
                                    <img src="imagen1-gen-iii.jpg" alt="Imagen 1 Gen III">
                                    <img src="imagen2-gen-iii.jpg" alt="Imagen 2 Gen III">
                                    <img src="imagen3-gen-iii.jpg" alt="Imagen 3 Gen III">
                                </div>
                                
                                <p class="gen-iv">GenIV</p>
                                <div class="images-container gen-iv">
                                    <img src="imagen1-gen-iv.jpg" alt="Imagen 1 Gen IV">
                                    <img src="imagen2-gen-iv.jpg" alt="Imagen 2 Gen IV">
                                    <img src="imagen3-gen-iv.jpg" alt="Imagen 3 Gen IV">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elemento2" >
                    <h1 class="titulo">Crear Liga</h1>
                </div>  
                <div class="elemento3" >
                    <h1 class="titulo">Mis Ligas</h1>
                </div>
                <div class="elemento4" >
                    <h1 class="titulo">Panel de Usuario</h1>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      
      $(document).ready(function() {
        var originalHeight = $(".elemento1").outerHeight(); // Guarda la altura original del elemento

            $(".elemento1").click(function() {
                if (!$(this).hasClass("active")) {
                    $(this).addClass("active");
                    $(this).find("#formulario").show();
                }
            });


        });

        const textContainers = document.querySelectorAll('.text-container p');

        textContainers.forEach(textContainer => {
            textContainer.addEventListener('click', function() {
                const selectedClass = this.classList[0];
                const allImagesContainers = document.querySelectorAll('.images-container');
                
                allImagesContainers.forEach(imagesContainer => {
                    imagesContainer.classList.remove('active');
                });

                const selectedImagesContainer = document.querySelector(`.images-container.${selectedClass}`);
                selectedImagesContainer.classList.add('active');
            });
        });


    </script>
</body>
</html>
