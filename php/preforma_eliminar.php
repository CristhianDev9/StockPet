<?php
	/*== Almacenando datos ==*/
    $preforma_id_del=limpiar_cadena($_GET['preforma_id_del']);

    /*== Verificando producto ==*/
    $check_preforma=conexion();
    $check_preforma=$check_preforma->query("SELECT * FROM preforma WHERE preforma_id='$preforma_id_del'");

    if($check_preforma->rowCount()==1){

    	$datos=$check_preforma->fetch();

    	$eliminar_preforma=conexion();
    	$eliminar_preforma=$eliminar_preforma->prepare("DELETE FROM preforma WHERE preforma_id=:id");

    	$eliminar_preforma->execute([":id"=>$preforma_id_del]);

    	if($eliminar_preforma->rowCount()==1){

    		// Si se eliminó correctamente el producto
	        echo '
	            <div class="alert green ligth">
	                <strong>¡PRODUCTO ELIMINADO!</strong><br>
	                Los datos del producto se eliminaron con exito
	            </div>
	        ';
	    }else{
	        echo '
	            <div class="alert red ligth">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No se pudo eliminar el producto, por favor intente nuevamente
	            </div>
	        ';
	    }
	    $eliminar_preforma=null;
    }else{
        echo '
            <div class="alert red ligth">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El PRODUCTO que intenta eliminar no existe
            </div>
        ';
    }
    $check_producto=null;