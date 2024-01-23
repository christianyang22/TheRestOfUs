<?php
session_start();

// Conexión a la base de datos (debes tener esto configurado previamente)
$conexion = mysqli_connect("localhost", "root", "", "therestofus");

// Verificar la conexión
if (mysqli_connect_errno()) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}

// Consulta SQL para obtener el valor máximo de "MontoTotal"
$query = "SELECT MAX(MontoTotal) AS MaxMontoTotal FROM donaciones";
$resultado = mysqli_query($conexion, $query);

// Verificar si la consulta se ejecutó correctamente
if ($resultado) {
    // Obtener el valor máximo de "MontoTotal" de la fila resultante
    $fila = mysqli_fetch_assoc($resultado);
    $MontoTotal = $fila['MaxMontoTotal'];
} else {
    echo "Error en la consulta: " . mysqli_error($conexion);
}

if (isset($_SESSION['username'])) {
    if ($_SESSION['rol'] == 2) {
        // Si es administrador (rol 2)
        header("Location: font-admin.php");
    }
}
// Cerrar la conexión a la base de datos
mysqli_close($conexion);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheRestOfUS</title>
    <link rel="shortcut icon" href="./imagenes/Logo-TheRestOfUs.png">
    <link rel="stylesheet" href="style/styles.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Verifica si la variable de sesión 'usuario_logueado' está establecida y es verdadera
            var usuarioLogueado = <?php echo isset($_SESSION['username']) && $_SESSION['username'] ? 'true' : 'false'; ?>;
            
            // Obtiene el enlace "Iniciar sesión" por su id
            var loginLink = document.getElementById('loginLink');

            // Función para cambiar el texto y la URL del enlace cuando se hace clic
            function toggleLogin(event) {
                event.preventDefault(); // Previene el comportamiento predeterminado del enlace
                if (usuarioLogueado) {
                    // Realiza las acciones de cierre de sesión aquí (eliminar variables de sesión, etc.)
                    // Luego, redirige al usuario a la página de inicio de sesión
                    // También cambia el texto y la URL del enlace
                    loginLink.textContent = 'Iniciar sesión';
                    window.location.href = './logout.php'; // logout.php destruirá la sesión y redirigirá a index.php
                } else {
                    // Redirige al usuario a la página de inicio de sesión
                    window.location.href = './font-login.php';
                }
            }

            // Asigna la función al evento click del enlace
            loginLink.addEventListener('click', toggleLogin);

            // Si el usuario ha iniciado sesión, cambia el texto del enlace a "Cerrar sesión"
            if (usuarioLogueado) {
                loginLink.textContent = 'Cerrar sesión';
            }
        });

    </script>

</head>
<body> 
    <header>
        <a href="index.php"><img src="imagenes/Logo-TheRestOfUs.png" alt="logo" id="logo"></a>
        <nav class="menu">
            <li><a href="#historia">Historia</a></li>
            <li><a href="#enemigos">Personajes</a></li>
            <li><a href="#donacion">Ayudanos</a></li>
            <li><a href="#contactanos">Contáctanos</a></li>
            <li>
                <!-- Agregamos el id "loginLink" al enlace "Iniciar sesión" -->
                <a id="loginLink" href="./font-login.php">Iniciar sesión</a>
            </li>
        </nav>
    </header>
    <div class= "cajas">
        <div class="image-container" id="historia">
            <img src="imagenes/img2.jpg" alt="img_principal" class="img_principal">
        </div>
        <div class="historia" id="historia">
            <h1>"The Rest of Us"</h1>
            <p>En este mundo abierto post-apocalíptico, los jugadores se enfrentarán a monstruos gigantes en lugares específicos llamados dominios. A medida que exploran y luchan, descubrirán oscuros secretos sobre el origen de los monstruos y la verdad detrás del apocalipsis.</p>
            
            <p>Un grupo de sobrevivientes de diferentes divisiones se unirá para enfrentar juntos los desafíos mortales, superar sus diferencias y descubrir qué significa realmente la supervivencia en un mundo donde la línea entre el bien y el mal se ha desdibujado.</p>
            
            <p>"The Rest of Us" es un emocionante juego indie que combina jugabilidad fascinante con una exploración profunda de la supervivencia, la moralidad y la unidad en un mundo al borde de la extinción. ¡Prepárate para una experiencia épica en un mundo post-apocalíptico como ningún otro!</p>
            
            <p>Es un juego indie que te sumerge en un mundo post-apocalíptico, donde los monstruos han conquistado la Tierra y la humanidad lucha por sobrevivir. En este sombrío escenario, las personas restantes se han agrupado en cinco divisiones distintas, cada una con su propio enfoque y creencias:</p>    
        </div>
        <div class="enemigos" id="enemigos">
            <h2>Personajes</h2>
            <h3>Los Acechadores Sombríos:</h3>
            <p>Ladrones y asesinos implacables que buscan sobrevivir a cualquier costo, robando y asaltando a otros para obtener recursos y secuestrando a quienes consideran valiosos.</p>
        
            <h3>Los Pacificadores de la Luz:</h3>
            <p>Abogan por la paz y buscan establecer relaciones pacíficas con los monstruos, creyendo que la coexistencia es la clave para la supervivencia.</p>
        
            <h3>Los Maestros de la Agilidad:</h3>
            <p>Aventureros y escaladores profesionales que se destacan en la agilidad y exploran lugares peligrosos en busca de recursos vitales.</p>
        
            <h3>Los Extremistas de la Fe:</h3>
            <p>Consideran la catástrofe como un castigo divino y creen que los monstruos son enviados por Dios para purificar el mundo de los pecadores, llevando a cabo acciones extremas en nombre de su fe.</p>
        
            <h3>Los Errantes Desesperados:</h3>
            <p>Supervivientes solitarios sin rumbo fijo, luchando por sobrevivir en un mundo sin esperanza.</p>
        </div>
        <div class="image-container1" id="enemigos">
            <img src="imagenes/enemigo.jpg" alt="img_enemigo" class="img_enemigo">
        </div>
    </div>
    <div class="donaciones" id="donacion">
        <div id="countdown-wrap">
            <div id="goals-wrap">
                <div id="goal">10,000,000</div>
                <div id="goal-words">GOAL</div>
            </div>
            <div id="glass">
            <div id="progress" class="progress" style="width: 
                <?php echo ($MontoTotal/10000000)*100 > 100 ? 100 : ($MontoTotal/10000000)*100; ?>%;">
            </div>

            </div>
            
            <div class="goal-stat">
                <span class="goal-number">
                    <span class='euro'>€<?php echo $MontoTotal; ?></span>
                    <span class="goal-label">RAISED</span>
                </span>
            </div>

            <form action="donaciones.php" method="post">
                <button class='glowing-btn'><span class='glowing-txt'>D<span class='faulty-letter'>O</span>NAR</span></button>
            </form>
        </div>
    </div>
    <div class="contacto" id="contactanos">
        <p>Email: <a href="mailto:contacto@tudominio.com">granadoadrian930@gmail.com</a></p>
        <p>Teléfono: <a href="tel:+1234567890">+34 609243351</a></p>
    </div>

    <footer>

    </footer>
</body>
</html>
