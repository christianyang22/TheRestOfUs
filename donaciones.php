<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TheRestOfUS</title>
        <link rel="shortcut icon" href="./imagenes/Logo-TheRestOfUs.png">
        <link rel="stylesheet" href="style/style-donaciones.css">

        <script>
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const error = urlParams.get('error');
            if (error) {
                document.getElementById('error-message').innerText = "Usuario o contraseña incorrectos.";
                window.history.replaceState({}, document.title, window.location.pathname); 
            }
        }
    </script>
    </head>
<body>
    <div class="content_box">
                
        <img src="./imagenes/enemigo1.jpg" alt="imagen_del_juego" id="imagen_del_juego">
        
        <h1>Donaciones</h1>
        <form action="enviar_donacion.php" method="post">

            <label class="donar" for="dna"><b>Donacion:</b></label>
            <input class="donar_input" type="text" placeholder="Monto a donar" name="Monto" required>

            <label class="usuario" for="uname"><b>Username:</b></label>
            <input class="username" type="text" placeholder="Enter Username" name="Username" required>
            
            <label class="pss" for="psw"><b>Password:</b></label> 
            <input class="pw" type="password" placeholder="Enter Password" name="Password" required>


            <p id="error-message" class="error" style="color: red;"></p> 
            <button class='glowing-btn'><span class='glowing-txt'>D<span class='faulty-letter'>O</span>NAR</span></button>

        </form>
        
        <a id="botonAtras" href="index.php">
            <button class='glowing-btn1'><span class='glowing-txt1'>A<span class='faulty-letter1'>t</span>ras</span></button>
        </a>

    </div>
</body>
</html>