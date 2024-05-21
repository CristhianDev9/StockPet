<?php
    require_once "../inc/session_start.php";
    require_once "main.php";

    /*== Almacenando datos ==*/
    $ml = limpiar_cadena($_POST['envase_ml']);
    $tipo = limpiar_cadena($_POST['envase_tipo']);
    $gramaje = limpiar_cadena($_POST['envase_gramaje']);
    $color = limpiar_cadena($_POST['envase_color']);
    $cantidad = limpiar_cadena($_POST['envase_cantidad']);
   

    /*== Verificando campos obligatorios ==*/
    if($ml=="" || $tipo=="" || $gramaje=="" || $color=="" || $cantidad==""){
        echo '
            <div class="notification">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    /*== Buscar si ya existe un registro con las mismas características ==*/
    $buscar_envase = conexion();
    $buscar_envase = $buscar_envase->prepare("SELECT * FROM envase WHERE envase_ml = :ml AND envase_tipo = :tipo AND envase_gramaje = :gramaje AND envase_color = :color");
    $buscar_envase->bindParam(":ml", $ml);
    $buscar_envase->bindParam(":tipo", $tipo);
    $buscar_envase->bindParam(":gramaje", $gramaje);
    $buscar_envase->bindParam(":color", $color);
    $buscar_envase->execute();

    if($buscar_envase->rowCount() > 0){
        // Si existe un registro con las mismas características, actualizamos la cantidad
        $row = $buscar_envase->fetch(PDO::FETCH_ASSOC);
        $nueva_cantidad = $row['envase_cantidad'] + $cantidad;

        $actualizar_envase = conexion();
        $actualizar_envase = $actualizar_envase->prepare("UPDATE envase SET envase_cantidad = :nueva_cantidad WHERE envase_ml = :ml AND envase_tipo = :tipo AND envase_gramaje = :gramaje AND envase_color = :color");
        $actualizar_envase->bindParam(":nueva_cantidad", $nueva_cantidad);
        $actualizar_envase->bindParam(":ml", $ml);
        $actualizar_envase->bindParam(":tipo", $tipo);
        $actualizar_envase->bindParam(":gramaje", $gramaje);
        $actualizar_envase->bindParam(":color", $color);
        $actualizar_envase->execute();

        if($actualizar_envase->rowCount() == 1){
            echo '
                <div class="notification">
                    <strong>¡ENVASE ACTUALIZADO!</strong><br>
                    La cantidad del envase se ha actualizado con éxito
                </div>
            ';
        }else{
            echo '
                <div class="notification">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    No se pudo actualizar el envase, por favor inténtalo nuevamente
                </div>
            ';
        }
    }else{
        // Si no existe un registro con las mismas características, insertamos un nuevo registro
        $guardar_envase = conexion();
        $guardar_envase = $guardar_envase->prepare("INSERT INTO envase(envase_ml, envase_tipo, envase_gramaje, envase_color, envase_cantidad) VALUES(:ml, :tipo, :gramaje, :color, :cantidad)");

        $marcadores = [
            ":ml" => $ml,
            ":tipo" => $tipo,
            ":gramaje" => $gramaje,
            ":color" => $color,
            ":cantidad" => $cantidad,
        ];

        $guardar_envase->execute($marcadores);

        if($guardar_envase->rowCount() == 1){
            echo '
                <div class="notification">
                    <strong>¡ENVASE REGISTRADO!</strong><br>
                    El envase se registró con éxito
                </div>
            ';
        }else{
            echo '
                <div class="notification">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    No se pudo registrar el envase, por favor inténtalo nuevamente
                </div>
            ';
        }
    }

    $buscar_envase = null;
    $guardar_envase = null;
?>
