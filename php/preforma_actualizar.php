<?php
    require_once "main.php";

    /* Almacenando id */
    $id = limpiar_cadena($_POST['preforma_id']);

    /* Verificando preforma */
    $check_preforma = conexion()->prepare("SELECT * FROM preforma WHERE preforma_id=:id");
    $check_preforma->bindParam(':id', $id, PDO::PARAM_INT);
    $check_preforma->execute();

    if ($check_preforma->rowCount() <= 0) {
        echo '
            <div class="alert red light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                La preforma no existe en el sistema
            </div>
        ';
        exit();
    } else {
        $datos = $check_preforma->fetch();
    }

    /* Almacenando datos */
    $gramaje = limpiar_cadena($_POST['preforma_gramaje']);
    $color = limpiar_cadena($_POST['preforma_color']);
    $pico = limpiar_cadena($_POST['preforma_pico']);
    $cantidad = limpiar_cadena($_POST['preforma_cantidad']);
    $cantidad_res = limpiar_cadena($_POST['preforma_cantidad_res']);

    /* Verificando campos obligatorios */
    if ($gramaje == "" || $color == "" || $pico == "" || $cantidad == "" || $cantidad_res == "") {
        echo '
            <div class="alert red light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    /* Verificando integridad de los datos */
    if (!preg_match("/^[0-9]+(?:\.[0-9]+)?$/", $gramaje)) {
        echo '
            <div class="alert red light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El GRAMAJE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}", $color)) {
        echo '
            <div class="alert red light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El COLOR no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if (verificar_datos("[0-9]{1,25}", $cantidad) || verificar_datos("[0-9]{1,25}", $cantidad_res)) {
        echo '
            <div class="alert red light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                La CANTIDAD o CANTIDAD RESERVADA no coinciden con el formato solicitado
            </div>
        ';
        exit();
    }

    /* Actualizando datos */
    $actualizar_preforma = conexion()->prepare("UPDATE preforma SET preforma_gramaje=:gramaje, preforma_color=:color, preforma_pico=:pico, preforma_cantidad=:cantidad, preforma_cantidad_res=:cantidad_res WHERE preforma_id=:id");

    $marcadores = [
        ":gramaje" => $gramaje,
        ":color" => $color,
        ":pico" => $pico,
        ":cantidad" => $cantidad,
        ":cantidad_res" => $cantidad_res,
        ":id" => $id
    ];

    if ($actualizar_preforma->execute($marcadores)) {
        echo '
            <div class="alert green light">
                <strong>¡PREFORMA ACTUALIZADA!</strong><br>
                La preforma se actualizó con éxito
            </div>
        ';
    } else {
        echo '
            <div class="alert red light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No se pudo actualizar la preforma, por favor inténtalo nuevamente
            </div>
        ';
    }
?>