<?php
    session_start();
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "therestofus");

    // 1. Crear conexión con la base de datos
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    // Verificar la conexión
    if(mysqli_connect_errno()) {     
        die("La conexión con la BBDD ha fallado: " . mysqli_connect_error() . 
             " (" . mysqli_connect_errno() . ")");
    }

    // 2. Obtener los usuarios
    $queryUsuarios = "SELECT Username FROM usuarios";
    $resultUsuarios = mysqli_query($connection, $queryUsuarios);
    if(!$resultUsuarios) {
        die("Consulta fallida: " . mysqli_error($connection));
    }

    // 3. Obtener las donaciones
    $queryDonaciones = "SELECT Timestamp, Monto, Username FROM donaciones";
    $resultDonaciones = mysqli_query($connection, $queryDonaciones);
    if(!$resultDonaciones) {
        die("Consulta fallida: " . mysqli_error($connection));
    }

    // 4. Procesar los resultados
    // Aquí puedes procesar los resultados como necesites.
    // Por ejemplo, puedes almacenarlos en un array para usarlos más tarde.

    $usuarios = [];
    while($usuario = mysqli_fetch_assoc($resultUsuarios)) {
        $usuarios[] = $usuario;
    }

    $donaciones = [];
    while($donacion = mysqli_fetch_assoc($resultDonaciones)) {
        $donaciones[] = $donacion;
    }

    // 5. Cerrar la conexión a la base de datos
    mysqli_close($connection);

    // Aquí puedes hacer lo que necesites con los arrays $usuarios y $donaciones
?>
