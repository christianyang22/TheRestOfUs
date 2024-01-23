<?php
session_start();

include("admin.php"); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheRestOfU - Admin</title>
    <link rel="shortcut icon" href="./imagenes/Logo-TheRestOfUs.png">
    <link rel="stylesheet" href="style/style-admin.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Verifica si la variable de sesión 'usuario_logueado' está establecida y es verdadera
            var usuarioLogueado = <?php echo isset($_SESSION['username']) && $_SESSION['username'] ? 'true' : 'false'; ?>;
            
            // Obtiene el enlace "Iniciar sesión" por su id
            var loginLink = document.getElementById('loginLink');

            // Función para cambiar el texto y la URL del enlace cuando se hace clic
            function toggleLogin(event) {
                event.preventDefault();
                if (usuarioLogueado) {
                    // Redirige a un script PHP que maneja el cierre de sesión
                    window.location.href = './logout.php'; // logout.php destruirá la sesión y redirigirá a index.php
                } else {
                    window.location.href = './font-login.php';
                }
            }
            // Asigna la función al evento click del enlace
            loginLink.addEventListener('click', toggleLogin);
        });
    </script>
</head>
<body> 
    <header>
        <a href="index.html"><img src="imagenes/Logo-TheRestOfUs.png" alt="logo" id="logo"></a>
        <nav class="menu">
            <li>
                <!-- Agregamos el id "loginLink" al enlace "Iniciar sesión" -->
                <a id="loginLink" href="./font-login.php">Cerrar sesión</a>
            </li>
        </nav>
    </header>
    <div class="usuarios">
        <h2>Usuarios</h2>
        <ul>
            <?php foreach($usuarios as $usuario): ?>
                <li><?php echo htmlspecialchars($usuario['Username']); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class= "historial">
    <!-- Mostrar Donaciones -->
        <h2>Donaciones</h2>
        <table>
            <tr>
                <th>Usuario</th>
                <th>Timestamp</th>
                <th>Monto</th>
            </tr>
            <?php foreach($donaciones as $donacion): ?>
                <tr>
                    <td><?php echo htmlspecialchars($donacion['Username']); ?></td>
                    <td><?php echo htmlspecialchars($donacion['Timestamp']); ?></td>
                    <td>€ <?php echo htmlspecialchars($donacion['Monto']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    
</div>

</body>
</html>