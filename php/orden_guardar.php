<?php
require_once "../inc/session_start.php";
require_once "main.php";

/*== Almacenando datos ==*/
$cliente_id = limpiar_cadena($_POST['cliente_id']);
$envase_id = limpiar_cadena($_POST['envase_id']);
$cantidad = limpiar_cadena($_POST['cantidad']);
$preforma_id = limpiar_cadena($_POST['preforma_id']);
$maquina_id = limpiar_cadena($_POST['maquina_id']);
$fecha_creacion = date("Y-m-d H:i:s");

/*== Verificando campos obligatorios ==*/
if ($cliente_id == "" || $envase_id == "" || $cantidad == "" || $preforma_id == "" || $maquina_id == "") {
    echo '
        <script>
            alert("¡Ocurrió un error inesperado! No has llenado todos los campos que son obligatorios");
            window.location.href = "./orden_new.php"; // Redirigir de nuevo al formulario
        </script>
    ';
    exit();
}

/*== Verificar si se seleccionó 'otro' para el cliente y crear el nuevo cliente si es necesario ==*/
$conexion = conexion(); // Obtén la conexión PDO
if ($cliente_id == "otro") {
    $cliente_otro_nombre = limpiar_cadena($_POST['cliente_otro_nombre']);
    if ($cliente_otro_nombre == "") {
        echo '
            <script>
                alert("¡Ocurrió un error inesperado! No has llenado el nombre del nuevo cliente");
                window.location.href = "../orden_new.php"; // Redirigir de nuevo al formulario
            </script>
        ';
        exit();
    }

    $guardar_cliente = $conexion->prepare("INSERT INTO clientes (cliente_nombre) VALUES (:nombre)");
    $guardar_cliente->bindParam(":nombre", $cliente_otro_nombre);
    $guardar_cliente->execute();

    $cliente_id = $conexion->lastInsertId(); // Usar el objeto de conexión PDO
}

/*== Verificar cantidad disponible de preforma ==*/
$preforma_query = $conexion->prepare("SELECT preforma_cant_disp, preforma_cantidad_res FROM preforma WHERE preforma_id = :preforma_id");
$preforma_query->bindParam(":preforma_id", $preforma_id);
$preforma_query->execute();

$preforma_data = $preforma_query->fetch(PDO::FETCH_ASSOC);
if ($preforma_data['preforma_cant_disp'] < $cantidad) {
    echo '
        <script>
            alert("Preforma insuficiente para cumplir con esta orden de producción");
            window.location.href = "../orden_new.php"; // Redirigir de nuevo al formulario
        </script>
    ';
    exit();
}

/*== Verificar si ya existe una orden de producción con el mismo maquina_id ==*/
$consulta_existente = $conexion->prepare("SELECT estado FROM ordenes_produccion WHERE maquina_id = :maquina_id LIMIT 1");
$consulta_existente->bindParam(":maquina_id", $maquina_id);
$consulta_existente->execute();
$orden_existente = $consulta_existente->fetch(PDO::FETCH_ASSOC);

if ($orden_existente) {
    // Ya existe una orden de producción para esta máquina
    if ($orden_existente['estado'] === 'Activo' || $orden_existente['estado'] === 'En proceso') {
        // Establecer el estado como 'Pendiente'
        $estado = 'Pendiente';
    } else {
        // Establecer el estado como 'En proceso'
        $estado = 'En proceso';
    }
} else {
    // No existe una orden de producción para esta máquina, establecer el estado como 'En proceso'
    $estado = 'En proceso';
}

/*== Guardar nueva orden de producción ==*/
$guardar_orden = $conexion->prepare("INSERT INTO ordenes_produccion (cliente_id, envase_id, cantidad, preforma_id, maquina_id, fecha_creacion, estado) VALUES (:cliente_id, :envase_id, :cantidad, :preforma_id, :maquina_id, :fecha_creacion, :estado)");
$guardar_orden->bindParam(":cliente_id", $cliente_id);
$guardar_orden->bindParam(":envase_id", $envase_id);
$guardar_orden->bindParam(":cantidad", $cantidad);
$guardar_orden->bindParam(":preforma_id", $preforma_id);
$guardar_orden->bindParam(":maquina_id", $maquina_id);
$guardar_orden->bindParam(":fecha_creacion", $fecha_creacion);
$guardar_orden->bindParam(":estado", $estado);
$guardar_orden->execute();

if ($guardar_orden->rowCount() == 1) {
    /*== Actualizar cantidad disponible y reservada de preforma ==*/
    $nueva_cant_disp = $preforma_data['preforma_cant_disp'] - $cantidad;
    $nueva_cant_res = $preforma_data['preforma_cantidad_res'] + $cantidad;

    $actualizar_preforma = $conexion->prepare("UPDATE preforma SET preforma_cant_disp = :nueva_cant_disp, preforma_cantidad_res = :nueva_cant_res WHERE preforma_id = :preforma_id");
    $actualizar_preforma->bindParam(":nueva_cant_disp", $nueva_cant_disp);
    $actualizar_preforma->bindParam(":nueva_cant_res", $nueva_cant_res);
    $actualizar_preforma->bindParam(":preforma_id", $preforma_id);
    $actualizar_preforma->execute();

    echo '
        <script>
            alert("¡ORDEN REGISTRADA! La orden de producción se registró con éxito");
            href = "/orden_new.php"; // Redirigir de nuevo al formulario
        </script>
    ';
} else {
    echo '
        <script>
            alert("¡Ocurrió un error inesperado! No se pudo registrar la orden de producción, por favor inténtalo nuevamente");
            href = "/orden_new.php"; // Redirigir de nuevo al formulario
        </script>
    ';
}

$preforma_query = null;
$guardar_cliente = null;
$guardar_orden = null;
?>
