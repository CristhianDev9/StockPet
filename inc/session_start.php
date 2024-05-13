<?php
    session_name("INV");
    session_start();

    if (isset($usuario_autenticado) && $usuario_autenticado) {
        $_SESSION['id'] = $id_usuario; 
        $_SESSION['usuario'] = $nombre_usuario; 

        // Redirigir al usuario según su rol
        if ($rol == 'admin') {
            header('Location: index.php?vista=home');
            exit();
        } elseif ($rol == 'user') {
            header('Location: index.php?vista=register');
            exit();
        } else {
            // Manejar otros roles o redirigir a una página de error
        }
    }
?>