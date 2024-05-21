<?php
    require_once "main.php";

    /* Almacenando id */
    $id = limpiar_cadena($_POST['envase_id']);

    /* Verificando envase */
    $check_envase = conexion()->prepare("SELECT * FROM envase WHERE envase_id=:id");
    $check_envase->bindParam(':id', $id, PDO::PARAM_INT);
    $check_envase->execute();

    if ($check_envase->rowCount() <= 0) {
        echo '
            <div class="alert red light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El envase no existe en el sistema
            </div>
        ';
        exit();
    } else {
        $datos = $check_envase->fetch();
    }

    /* Almacenando datos */
    $mililitros = limpiar_cadena($_POST['envase_ml']);
    $tipo = limpiar_cadena($_POST['envase_tipo']);
    $gramaje = limpiar_cadena($_POST['envase_gramaje']);
    $color = limpiar_cadena($_POST['envase_color']);
    $cantidad = limpiar_cadena($_POST['envase_cantidad']);

    /* Verificando campos obligatorios */
    if ($mililitros == "" || $tipo == "" || $gramaje == "" || $color == "" || $cantidad == "") {
        echo '
            <div class="alert red light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    /* Verificando integridad de los datos */
    if (!preg_match("/^[0-9]+$/", $mililitros)) {
        echo '
            <div class="alert red light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                Los mililitros no coinciden con el formato solicitado
            </div>
        ';
        exit();
    }

    if (!preg_match("/^[0-9]+(?:\.[0-9]+)?$/", $gramaje)) {
        echo '
            <div class="alert red light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El gramaje no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /* Actualizando datos */
    $actualizar_envase = conexion()->prepare("UPDATE envase SET envase_ml=:mililitros, envase_tipo=:tipo, envase_gramaje=:gramaje, envase_color=:color, envase_cantidad=:cantidad WHERE envase_id=:id");

    $marcadores = [
        ":mililitros" => $mililitros,
        ":tipo" => $tipo,
        ":gramaje" => $gramaje,
        ":color" => $color,
        ":cantidad" => $cantidad,
        ":id" => $id
    ];

    if ($actualizar_envase->execute($marcadores)) {
        echo '
            <div class="alert green light">
                <strong>¡ENVASE ACTUALIZADO!</strong><br>
                El envase se actualizó con éxito
            </div>
        ';
    } else {
        echo '
            <div class="alert red light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No se pudo actualizar el envase, por favor inténtalo nuevamente
            </div>
        ';
    }
?>
