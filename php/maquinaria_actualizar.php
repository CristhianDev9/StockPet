<?php
    require_once "main.php";

    /* Almacenando id */
    $id = limpiar_cadena($_POST['maquina_id']);

    /* Verificando maquinaria */
    $check_maquinaria = conexion()->prepare("SELECT * FROM maquinaria WHERE maquina_id=:id");
    $check_maquinaria->bindParam(':id', $id, PDO::PARAM_INT);
    $check_maquinaria->execute();

    if ($check_maquinaria->rowCount() <= 0) {
        echo '
            <div class="alert red light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                La máquina no existe en el sistema
            </div>
        ';
        exit();
    } else {
        $datos = $check_maquinaria->fetch();
    }

    /* Almacenando datos */
    $nombre = limpiar_cadena($_POST['maquina_nombre']);
    $tipo = limpiar_cadena($_POST['maquina_tipo']);
    $marca = limpiar_cadena($_POST['maquina_marca']);
    $estado = limpiar_cadena($_POST['maquina_estado']);
    $ultima_revision = limpiar_cadena($_POST['maquina_ultima_revision']);

    /* Verificando campos obligatorios */
    if ($nombre == "" || $tipo == "" || $estado == "") {
        echo '
            <div class="alert red light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    /* Verificando integridad de los datos */
    if (!preg_match("/^[a-zA-Z0-9 ]+$/", $nombre)) {
        echo '
            <div class="alert red light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El nombre de la máquina no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if (!in_array($estado, ['activo', 'inactivo', 'mantenimiento'])) {
        echo '
            <div class="alert red light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El estado de la máquina no es válido
            </div>
        ';
        exit();
    }

    /* Actualizando datos */
    $actualizar_maquinaria = conexion()->prepare("UPDATE maquinaria SET maquina_nombre=:nombre, maquina_tipo=:tipo, maquina_marca=:marca, maquina_estado=:estado, maquina_ultima_revision=:ultima_revision WHERE maquina_id=:id");

    $marcadores = [
        ":nombre" => $nombre,
        ":tipo" => $tipo,
        ":marca" => $marca,
        ":estado" => $estado,
        ":ultima_revision" => $ultima_revision,
        ":id" => $id
    ];

    if ($actualizar_maquinaria->execute($marcadores)) {
        echo '
            <div class="alert green light">
                <strong>¡MÁQUINA ACTUALIZADA!</strong><br>
                La máquina se actualizó con éxito
            </div>
        ';
    } else {
        echo '
            <div class="alert red light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No se pudo actualizar la máquina, por favor inténtalo nuevamente
            </div>
        ';
    }
?>