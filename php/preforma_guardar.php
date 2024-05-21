<?php
    require_once "../inc/session_start.php";
    require_once "main.php";

    /*== Almacenando datos ==*/
    $gramaje = limpiar_cadena($_POST['preforma_gramaje']);
    $color = limpiar_cadena($_POST['preforma_color']);
    $pico = limpiar_cadena($_POST['preforma_pico']);
    $cantidad = limpiar_cadena($_POST['preforma_cantidad']);
   
    /*== Verificando campos obligatorios ==*/
    if($gramaje=="" || $color=="" || $pico=="" || $cantidad==""){
        echo '
            <div class="notification red lighten-3">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    /*== Buscar si ya existe un registro con las mismas características ==*/
    $buscar_preforma = conexion();
    $buscar_preforma = $buscar_preforma->prepare("SELECT * FROM preforma WHERE preforma_gramaje = :gramaje AND preforma_color = :color AND preforma_pico = :pico");
    $buscar_preforma->bindParam(":gramaje", $gramaje);
    $buscar_preforma->bindParam(":color", $color);
    $buscar_preforma->bindParam(":pico", $pico);
    $buscar_preforma->execute();

    if($buscar_preforma->rowCount() > 0){
        // Si existe un registro con las mismas características, actualizamos la cantidad
        $row = $buscar_preforma->fetch(PDO::FETCH_ASSOC);
        $nueva_cantidad = $row['preforma_cantidad'] + $cantidad;
        $nueva_cant_disp = $row['preforma_cant_disp'] + $cantidad;

        $actualizar_preforma = conexion();
        $actualizar_preforma = $actualizar_preforma->prepare("UPDATE preforma SET preforma_cantidad = :nueva_cantidad, preforma_cant_disp = :nueva_cant_disp WHERE preforma_gramaje = :gramaje AND preforma_color = :color AND preforma_pico = :pico");
        $actualizar_preforma->bindParam(":nueva_cantidad", $nueva_cantidad);
        $actualizar_preforma->bindParam(":nueva_cant_disp", $nueva_cant_disp);
        $actualizar_preforma->bindParam(":gramaje", $gramaje);
        $actualizar_preforma->bindParam(":color", $color);
        $actualizar_preforma->bindParam(":pico", $pico);
        $actualizar_preforma->execute();

        if($actualizar_preforma->rowCount() == 1){
            echo '
                <div class="alert green light">
                    <strong>¡PREFORMA ACTUALIZADA!</strong><br>
                    La cantidad de la preforma se ha actualizado con éxito
                </div>
            ';
        }else{
            echo '
                <div class="alert red light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    No se pudo actualizar la preforma, por favor inténtalo nuevamente
                </div>
            ';
        }
    }else{
        // Si no existe un registro con las mismas características, insertamos un nuevo registro
        $guardar_preforma = conexion();
        $guardar_preforma = $guardar_preforma->prepare("INSERT INTO preforma(preforma_gramaje, preforma_color, preforma_pico, preforma_cantidad, preforma_cant_disp) VALUES(:gramaje, :color, :pico, :cantidad, :cantidad)");

        $marcadores = [
            ":gramaje" => $gramaje,
            ":color" => $color,
            ":pico" => $pico,
            ":cantidad" => $cantidad,
        ];

        $guardar_preforma->execute($marcadores);

        if($guardar_preforma->rowCount() == 1){
            echo '
                <div class="alert green light">
                    <strong>¡PREFORMA REGISTRADA!</strong><br>
                    La preforma se registró con éxito
                </div>
            ';
        }else{
            echo '
                <div class="alert red light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    No se pudo registrar la preforma, por favor inténtalo nuevamente
                </div>
            ';
        }
    }

    $buscar_preforma = null;
    $guardar_preforma = null;
?>
