<?php
    session_start();
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "therestofus");

    // 1. Crear conexión con la BBDD
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    // Test if connection succeeded
    if(mysqli_connect_errno()) {
        die("La conexión con la BBDD ha fallado: " . 
            mysqli_connect_error() . 
            " (" . mysqli_connect_errno() . ")"
        );
    }

    function find_user_by_username($username, $connection) {
        $query  = "SELECT * FROM usuarios WHERE Username = ?";
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

    function attempt_login($username, $connection) {
        $user = find_user_by_username($username, $connection);
        if ($user) {
            // User encontrado
            return $user;
        } else {
            // User not found
            return false;
        }
    }

    if(isset($_POST['Username'])) { 
        $usuario = $_POST["Username"];
    }
    if(isset($_POST['Password'])) { 
        $password = $_POST["Password"];
    }
    if(isset($_POST['Nombre'])) { 
        $nombre = $_POST["Nombre"];
    }
    if(isset($_POST['Apellido'])) { 
        $apellido = $_POST["Apellido"];
    }
    if(isset($_POST['Edad'])) { 
        $edad = $_POST["Edad"];
    }
    if(isset($_POST['Direccion'])) { 
        $direccion = $_POST["Direccion"];
    }

    $found_user = attempt_login($usuario, $connection);
    $tablename ="usuarios";
    if ($found_user) {
        header("Location: usuario_existe.php");	
    } else {
        // Encriptar password
        $pass_s = password_hash($password, PASSWORD_DEFAULT);
        $query  = "INSERT INTO `$tablename` (`Username`, `Password`, `Nombre`, `Apellido`, `Edad`, `Direccion`) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 'ssssis', $usuario, $pass_s, $nombre, $apellido, $edad, $direccion);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $_SESSION["Username"] = $usuario;
            header("Location: index.php");
        } else {
            die("Database query failed. " . mysqli_error($connection));
        }
    }

    // 5. Close database connection
    mysqli_close($connection);
?>
