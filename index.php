<?php
    require "./inc/session_start.php";
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <?php
        if (!isset($_GET['vista']) || $_GET['vista'] == "") {
            $_GET['vista'] = "login";
        }

        if (is_file("./vistas/".$_GET['vista'].".php") && $_GET['vista'] != "login" && $_GET['vista'] != "404") {
            // Verificar el acceso basado en roles
            if ($_GET['vista'] == "home" && $_SESSION['usuario_rol'] != "admin") {
                // Redireccionar a otra página si el usuario no es administrador
                header('Location: index.php?vista=register');
                exit();
            }

            // Cerrar sesión si no está iniciada o si faltan datos de sesión
            if (!isset($_SESSION['id']) || empty($_SESSION['id']) || !isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
                include "./vistas/logout.php";
                exit();
            }

            include "./vistas/".$_GET['vista'].".php";
        } else {
            if ($_GET['vista'] == "login") {
                include "./vistas/login.php";
            } else {
                include "./vistas/404.php";
            }
        }
    ?>
</body>
</html>