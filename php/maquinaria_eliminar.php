<?php
    /* Almacenando datos */
    $maquina_id_del = limpiar_cadena($_GET['maquina_id_del']);

    /* Verificando maquinaria */
    $check_maquinaria = conexion();
    $check_maquinaria = $check_maquinaria->query("SELECT * FROM maquinaria WHERE maquina_id='$maquina_id_del'");

    if ($check_maquinaria->rowCount() == 1) {
        $datos = $check_maquinaria->fetch();

        $eliminar_maquinaria = conexion();
        $eliminar_maquinaria = $eliminar_maquinaria->prepare("DELETE FROM maquinaria WHERE maquina_id=:id");

        $eliminar_maquinaria->execute([":id" => $maquina_id_del]);

        if ($eliminar_maquinaria->rowCount() == 1) {
            // Si se eliminó correctamente la máquina
            echo '
                <div class="notification green ">
                    <strong>¡MÁQUINA ELIMINADA!</strong><br>
                    Los datos de la máquina se eliminaron con éxito
                </div>
            ';
        } else {
            echo '
                <div class="notification red ">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    No se pudo eliminar la máquina, por favor inténtelo nuevamente
                </div>
            ';
        }
        $eliminar_maquinaria = null;
    } else {
        echo '
            <div class="notification red">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                La máquina que intenta eliminar no existe
            </div>
        ';
    }
    $check_maquinaria = null;
?>
