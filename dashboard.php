<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script> <!-- Agregamos el atributo defer para que el script se ejecute después de cargar el HTML -->
    <title>LOKE LEAGUE - Dashboard</title>
</head>
<body>
<section>
        <div class="centeredContainer"> 
            <div class="horizontalContainer">
                <div class="elemento1">
                    <h1 class="titulo">Unirse a Liga</h1>
                    <button id="formulario" style="display: none;">Minimizar</button>
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

        $("#formulario").click(function(event) {
            event.stopPropagation();
            $(".elemento1").removeClass("active");
            $(".elemento1").addClass("closingAnimation").css('height', 60 + 'vH'); // Agrega la clase y establece la altura original
            $(this).hide();
           
        });
    });

    </script>
</body>
</html>