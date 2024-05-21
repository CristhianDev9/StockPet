<?php
require_once "main.php";

// Definir y inicializar las variables
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$registros = isset($_GET['registros']) ? (int)$_GET['registros'] : 10;
$busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';

$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

// Construir la URL base para la paginación
$url = "index.php?vista=orden_list&pagina=";

$tabla = '<table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Envase</th>
                    <th>Preforma</th>
                    <th>Máquina</th>
                    <th>Cantidad</th>
                    <th>Progreso</th>
                    <th>Fecha de Creación</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';

$campos = "op_id, cliente_id, envase_id, preforma_id, maquina_id, cantidad, cantidad_parcial, fecha_creacion, estado";

if ($busqueda != "") {
    $consulta_datos = "SELECT $campos FROM ordenes_produccion WHERE cliente_id LIKE '%$busqueda%' OR envase_id LIKE '%$busqueda%' ORDER BY fecha_creacion DESC LIMIT $inicio, $registros";
    $consulta_total = "SELECT COUNT(op_id) FROM ordenes_produccion WHERE cliente_id LIKE '%$busqueda%' OR envase_id LIKE '%$busqueda%'";
} else {
    $consulta_datos = "SELECT $campos FROM ordenes_produccion ORDER BY fecha_creacion DESC LIMIT $inicio, $registros";
    $consulta_total = "SELECT COUNT(op_id) FROM ordenes_produccion";
}

$conexion = conexion();

try {
    $datos = $conexion->query($consulta_datos);
    $datos = $datos->fetchAll(PDO::FETCH_ASSOC);

    $total = $conexion->query($consulta_total);
    $total = (int)$total->fetchColumn();

    $Npaginas = ceil($total / $registros);

    if ($total >= 1 && $pagina <= $Npaginas) {
        $contador = $inicio + 1;
        $pag_inicio = $inicio + 1;
        foreach ($datos as $rows) {
            // Consultar nombres de cliente, envase, preforma y máquina
            $cliente_nombre = obtener_nombre($conexion, 'clientes', 'cliente_id', $rows['cliente_id'], 'cliente_nombre');
            $envase_detalle = obtener_envase_detalle($conexion, $rows['envase_id']);
            $preforma_gramaje = obtener_nombre($conexion, 'preforma', 'preforma_id', $rows['preforma_id'], 'preforma_gramaje');
            $maquina_nombre = obtener_nombre($conexion, 'maquinaria', 'maquina_id', $rows['maquina_id'], 'maquina_nombre');

            $progreso = ($rows['cantidad'] > 0) ? ($rows['cantidad_parcial'] / $rows['cantidad']) * 100 : 0;
            $progreso = round($progreso, 2);

            $tabla .= '
                <tr>
                    <td>' . $contador . '</td>
                    <td>' . $cliente_nombre . '</td>
                    <td>' . $envase_detalle . '</td>
                    <td>' . $preforma_gramaje . '</td>
                    <td>' . $maquina_nombre . '</td>
                    <td>' . $rows['cantidad'] . '</td>
                    <td>
                        <div class="progress">
                            <div class="determinate" style="width: ' . $progreso . '%"></div>
                        </div>
                        ' . $progreso . '%
                    </td>
                    <td>' . $rows['fecha_creacion'] . '</td>
                    <td>' . $rows['estado'] . '</td>
                    <td>
                        <a href="index.php?vista=orden_update&op_id_up=' . $rows['op_id'] . '" class="waves-effect waves-light btn-small green">Actualizar</a>
                        <a href="' . $url . $pagina . '&op_id_del=' . $rows['op_id'] . '" onclick="return confirmarEliminacion(' . $rows['op_id'] . ')" class="waves-effect waves-light btn-small red">Eliminar</a>
                    </td>
                </tr>
            ';
            $contador++;
        }
    } else {
        $tabla .= '
            <tr>
                <td colspan="10" class="center-align">No hay registros en el sistema</td>
            </tr>
        ';
    }

    $tabla .= '</tbody></table>';

    if ($total > 0 && $pagina <= $Npaginas) {
        $tabla .= '<p class="has-text-right">Mostrando órdenes de producción <strong>' . ($inicio + 1) . '</strong> al <strong>' . min(($inicio + $registros), $total) . '</strong> de un <strong>total de ' . $total . '</strong></p>';
    }

    echo $tabla;

    if ($total >= 1 && $pagina <= $Npaginas) {
        echo paginador_tablas($pagina, $Npaginas, $url, 7);
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conexion = null;

function obtener_nombre($conexion, $tabla, $campo_id, $id, $campo_nombre) {
    $query = $conexion->prepare("SELECT $campo_nombre FROM $tabla WHERE $campo_id = :id");
    $query->bindParam(":id", $id);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result ? $result[$campo_nombre] : 'Desconocido';
}

function obtener_envase_detalle($conexion, $envase_id) {
    $query = $conexion->prepare("SELECT envase_ml, envase_tipo, envase_color FROM envase WHERE envase_id = :id");
    $query->bindParam(":id", $envase_id);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['envase_ml'] . ' ml ' . $result['envase_tipo'] . ' ' . $result['envase_color'] : 'Desconocido';
}
?>
