<!DOCTYPE html>
<?php
session_start();

?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheRestOfUs - Login</title>
    <link rel="shortcut icon" href="./imagenes/Logo-TheRestOfUs.png">
    <link rel="stylesheet" href="style/style-login.css">

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
    <div class= "cajas">
        <div class="image-container">
            <img src="imagenes/img-principal.jpg" alt="img_principal" class="img_principal">
        </div>

        <div class="sesion">
            <img src="imagenes/Logo-TheRestOfUs.png" alt="logo" id="logo">
            <h1>Iniciar Sesion</h1>
            <form action="login.php" method="post">
                
                <label class="usuario" for="uname"><b>Username:</b> <input class="username" type="text" placeholder="Enter Username" name="Username" required></label>
                
                <label class="pss" for="psw"><b>Password:</b> <input class="pw" type="password" placeholder="Enter Password" name="Password" required></label> 

                <button id="login-button" class='glowing-btn'><span class='glowing-txt'>L<span class='faulty-letter'>O</span>GIN</span></button>
            </form>
            <a href="font-Registro.php">Registrarse</a>
            <p id="error-message" class="error" style="color: red;"></p> 
        </div>
       

    </div>

    <section>
        <div class="mapas">
            
        </div>
    </section>
    <script src="./js/login.js"></script>
</body>
</html>