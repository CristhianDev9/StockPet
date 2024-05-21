<?php
	/* Almacenando datos */
    $envase_id_del = limpiar_cadena($_GET['envase_id_del']);

    /* Verificando envase */
    $check_envase = conexion();
    $check_envase = $check_envase->query("SELECT * FROM envase WHERE envase_id='$envase_id_del'");

    if ($check_envase->rowCount() == 1) {
    	$datos = $check_envase->fetch();

    	$eliminar_envase = conexion();
    	$eliminar_envase = $eliminar_envase->prepare("DELETE FROM envase WHERE envase_id=:id");

    	$eliminar_envase->execute([":id" => $envase_id_del]);

    	if ($eliminar_envase->rowCount() == 1) {
    		// Si se eliminó correctamente el envase
	        echo '
	            <div class="alert green light">
	                <strong>¡ENVASE ELIMINADO!</strong><br>
	                Los datos del envase se eliminaron con éxito
	            </div>
	        ';
	    } else {
	        echo '
	            <div class="alert red light">
	                <strong>¡Ocurrió un error inesperado!</strong><br>
	                No se pudo eliminar el envase, por favor inténtelo nuevamente
	            </div>
	        ';
	    }
	    $eliminar_envase = null;
    } else {
        echo '
            <div class="alert red light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El envase que intenta eliminar no existe
            </div>
        ';
    }
    $check_envase = null;
?>