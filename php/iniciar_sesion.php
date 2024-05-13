<?php
    /*== Almacenando datos ==*/
    $usuario = limpiar_cadena($_POST['login_usuario']);
    $clave = limpiar_cadena($_POST['login_clave']);

    /*== Verificando campos obligatorios ==*/
    if ($usuario == "" || $clave == "") {
        echo '
            <div class="alert red light">
                <span class="alert-title">¡Ocurrió un error inesperado!</span><br>
                <p>No has llenado todos los campos que son obligatorios.</p>
            </div>';
        exit();
    }

    /*== Verificando integridad de los datos ==*/
    if (verificar_datos("[a-zA-Z0-9]{4,20}", $usuario)) {
        echo '
            <div class="alert red light">
                <span class="alert-title">¡Ocurrió un error inesperado!</span><br>
                <p>El USUARIO no coincide con el formato solicitado.</p>
            </div>';
        exit();
    }

    if (verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave)) {
        echo '
            <div class="alert red light">
                <span class="alert-title">¡Ocurrió un error inesperado!</span><br>
                <p>Las CLAVE no coinciden con el formato solicitado.</p>
            </div>';
        exit();
    }

    // Consulta el usuario en la base de datos
    $consulta_usuario = conexion()->prepare("SELECT * FROM usuario WHERE usuario_usuario = :usuario");
    $consulta_usuario->execute(array(":usuario" => $usuario));

    if ($consulta_usuario->rowCount() == 1) {
        $usuario_bd = $consulta_usuario->fetch();

        // Verifica la contraseña
        if ($usuario_bd['usuario_usuario'] == $usuario && password_verify($clave, $usuario_bd['usuario_clave'])) {
            // Obtener el rol del usuario
            $rol = $usuario_bd['usuario_rol'];

            // Establecer el rol del usuario en la sesión
            $_SESSION['usuario_rol'] = $rol;
            $_SESSION['id'] = $usuario_bd['usuario_id']; // Configurar el ID del usuario si es necesario
            $_SESSION['usuario'] = $usuario_bd['usuario_usuario']; // Configurar el nombre de usuario si es necesario

            // Redirigir al usuario según su rol
            if ($rol == 'admin') {
                header('Location: index.php?vista=home');
                exit();
            } elseif ($rol == 'user') {
                header('Location: index.php?vista=register');
                exit();
            } else {
                // Redirigir a una página de error o mostrar un mensaje de error
            }
        } else {
            echo '
                <div class="alert red light">
                    <span class="alert-title">¡Ocurrió un error inesperado!</span><br>
                    <p>Usuario o clave incorrectos.</p>
                </div>';
        }
    } else {
        echo '
            <div class="alert red light">
                <span class="alert-title">¡Ocurrió un error inesperado!</span><br>
                <p>Usuario o clave incorrectos.</p>
            </div>';
    }
?>