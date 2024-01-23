<?php
session_start();
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "therestofus");

// 1. Crear conexión con la BBDD
$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

// Si hay un error, imprime la descripción del error y el número de error generado.
if (mysqli_connect_errno()) {     
    die("La conexión con la BBDD ha fallado: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
}

function find_user($username, $password, $connection) {
    $query = "SELECT Username, password FROM usuarios WHERE Username = ? LIMIT 1";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && $row = mysqli_fetch_assoc($result)) {
        // Compara la contraseña proporcionada con la contraseña almacenada en la base de datos
        if (password_verify($password, $row["password"])) {
            return true; // Nombre de usuario y contraseña válidos
        }
    }
    
    return false; // Nombre de usuario o contraseña incorrectos
}

echo "Esto es login.php";
if (isset($_POST['Username']) && isset($_POST['Password'])) { 
    $username = $_POST["Username"];
    $password = $_POST["Password"];

    if (find_user($username, $password, $connection)) {
        // Nombre de usuario y contraseña válidos, realizar la inserción en la tabla "donaciones"
        if (isset($_POST['Monto'])) {
            $monto = $_POST['Monto'];

            // Realiza la inserción en la tabla "donaciones"
            $insert_query = "INSERT INTO donaciones (Username,monto) VALUES (?,?)";
            $stmt = mysqli_prepare($connection, $insert_query);
            mysqli_stmt_bind_param($stmt, 'sd',$username, $monto); // 'd' representa un número decimal (ajústalo según el tipo de dato en tu base de datos)

            if (mysqli_stmt_execute($stmt)) {
                // Inserción exitosa, puedes redirigir a una página de confirmación
                header("Location: index.php");
                $update_query = "UPDATE donaciones SET MontoTotal = (@acumulado := @acumulado + Monto) ORDER BY id";
                mysqli_query($connection, "SET @acumulado := 0"); // Inicializa la variable acumulado a 0
                mysqli_query($connection, $update_query); // Ejecuta la consulta de actualización
                
                // Almacena MontoTotal en una variable de sesión
                $_SESSION['monto_total'] = $MontoTotal;

                // Redirige a archivo2.php
                header("Location: index.php");
                                
                exit;
            } else {
                // Error al insertar la donación, manejar el error adecuadamente
                header("Location: donaciones.php?error=insert_failure"); 
                exit;
            }
        }
    } else {
        // Nombre de usuario o contraseña incorrectos, manejar el error adecuadamente
        header("Location: donaciones.php?error=invalid"); 
        exit;
    }
}

// 5. Cierra la conexión con la base de datos
mysqli_close($connection);
?>
