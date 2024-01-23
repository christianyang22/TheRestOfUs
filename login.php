<?php
    session_start();
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "therestofus");

    // 1. Crear conexión con la BBDD
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    // Si hay un error, imprimimos la descripción del error y el número de error generado.
    if(mysqli_connect_errno()) {     
        die("La conexión con la BBDD ha fallado: " . 
             mysqli_connect_error() . 
             " (" . mysqli_connect_errno() . ")"
        );
    }

    function find_user_by_username($username, $connection) {
        $query  = "SELECT Username, password, rol FROM usuarios WHERE Username = ? LIMIT 1";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($user = mysqli_fetch_assoc($result)) {
            return $user;
        } else {
            return null;
        }
    }
    

    function attempt_login($username, $password, $connection) {
        $user = find_user_by_username($username, $connection);
        if ($user) {
            // User encontrado, verificar contraseña
            if(password_verify($password, $user["password"])) {
                return $user; // Login exitoso
            }
        }
        return false; // Login fallido
    }

    echo "Esto es login.php";
    if(isset($_POST['Username']) && isset($_POST['Password'])) { 
        $username = $_POST["Username"];
        $password = $_POST["Password"];

        $found_user = attempt_login($username, $password, $connection);

        if ($found_user) {
            // Success
            $_SESSION["username"] = $username;
            $_SESSION["rol"] = $found_user["rol"]; // Almacenar el rol en la sesión
            header("Location: index.php");
        } else {
            // Failure
            header("Location: font-login.php?error=invalid"); 
        }
    }

    // 5. Close database connection
    mysqli_close($connection);
    
   
?>
