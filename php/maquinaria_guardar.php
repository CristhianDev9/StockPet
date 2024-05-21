<?php
    require_once "../inc/session_start.php";
    require_once "main.php";

    /*== Almacenando datos ==*/
    $nombre = limpiar_cadena($_POST['maquina_nombre']);
    $tipo = limpiar_cadena($_POST['maquina_tipo']);
    $marca = limpiar_cadena($_POST['maquina_marca']);
    $estado = limpiar_cadena($_POST['maquina_estado']);
    $ultima_revision = limpiar_cadena($_POST['maquina_ultima_revision']);

    /*== Verificando campos obligatorios ==*/
    if($nombre == "" || $tipo == "" || $estado == ""){
        echo '
            <div class="notification">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    /*== Preparando la conexión ==*/
    $guardar_maquinaria = conexion();
    $guardar_maquinaria = $guardar_maquinaria->prepare("INSERT INTO maquinaria(maquina_nombre, maquina_tipo, maquina_marca, maquina_estado, maquina_ultima_revision) VALUES(:nombre, :tipo, :marca, :estado, :ultima_revision)");

    $marcadores = [
        ":nombre" => $nombre,
        ":tipo" => $tipo,
        ":marca" => $marca,
        ":estado" => $estado,
        ":ultima_revision" => $ultima_revision,
    ];

    $guardar_maquinaria->execute($marcadores);

    if($guardar_maquinaria->rowCount() == 1){
        echo '
            <div class="notification">
                <strong>¡MAQUINA REGISTRADA!</strong><br>
                La máquina se registró con éxito
            </div>
        ';
    } else {
        echo '
            <div class="notification">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No se pudo registrar la máquina, por favor inténtalo nuevamente
            </div>
        ';
    }

    $guardar_maquinaria = null;
?>
