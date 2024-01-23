<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheRestOfUs - registro</title>
    <link rel="shortcut icon" href="./imagenes/Logo-TheRestOfUs.png">
    <link rel="stylesheet" href="style/style-registro.css">
</head>
</head>
<body>
    <div class= "cajas">
        <div class="sesion">
            <img src="imagenes/Logo-TheRestOfUs.png" alt="logo" id="logo">
            <h1>Registro</h1>
            <form action="registro.php" method="post">
                <label class="usuario" for="uname"><b>Username:</b></label>
                <input class="username" type="text" placeholder="Enter Username" name="Username" required>

                <label class="nom" for="name"><b>Nombre:</b></label>
                <input class="nombre" type="text" placeholder="Enter Name" name="Nombre" required>
                
                <label class="sur" for="surname"><b>Apellido:</b></label>
                <input class="apellido" type="text" placeholder="Enter Surname" name="Apellido" required>

                <label class="age" for="edd"><b>Edad:</b></label>
                <input class="edad" type="number" placeholder="Enter Age" name="Edad" min="0" required>

                <label class="dir" for="direc"><b>Direccion:</b></label>
                <input class="direccion" type="text" placeholder="Enter Address" name="Direccion" required>

                <label class="pss" for="psw"><b>Password:</b></label>
                <input class="pw" type="password" placeholder="Enter Password" name="Password" required>

                <button class='glowing-btn'><span class='glowing-txt'>A<span class='faulty-letter'>C</span>EPTAR</span></button>

            </form>
            <a id="botonAtras" href="font-login.php">
                <button class='glowing-btn1'><span class='glowing-txt1'>A<span class='faulty-letter1'>t</span>ras</span></button>
            </a>
        </div>

        <div class="image-container">
            <img src="imagenes/img-principal.jpg" alt="img_principal" class="img_principal">
        </div>
    </div>

    <section>
        <div class="mapas">
            
        </div>
    </section>
</body>
</html>