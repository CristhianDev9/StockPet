<?php
    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
    $tabla = '<table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Estado</th>
                        <th>Última Revisión</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

    $campos = "maquina_id, maquina_nombre, maquina_tipo, maquina_marca, maquina_estado, maquina_ultima_revision";

    if (isset($busqueda) && $busqueda != "") {
        $consulta_datos = "SELECT $campos FROM maquinaria WHERE maquina_nombre LIKE '%$busqueda%' OR maquina_tipo LIKE '%$busqueda%' ORDER BY maquina_nombre ASC LIMIT $inicio, $registros";

        $consulta_total = "SELECT COUNT(maquina_id) FROM maquinaria WHERE maquina_nombre LIKE '%$busqueda%' OR maquina_tipo LIKE '%$busqueda%'";
    } else {
        $consulta_datos = "SELECT $campos FROM maquinaria ORDER BY maquina_nombre ASC LIMIT $inicio, $registros";

        $consulta_total = "SELECT COUNT(maquina_id) FROM maquinaria";
    }

    $conexion = conexion();

    $datos = $conexion->query($consulta_datos);
    $datos = $datos->fetchAll();

    $total = $conexion->query($consulta_total);
    $total = (int)$total->fetchColumn();

    $Npaginas = ceil($total / $registros);

    if ($total >= 1 && $pagina <= $Npaginas) {
        $contador = $inicio + 1;
        $pag_inicio = $inicio + 1;
        foreach ($datos as $rows) {
            $tabla .= '
                <tr>
                    <td>' . $contador . ' </td>
                    <td>' . $rows['maquina_nombre'] . '</td>
                    <td>' . $rows['maquina_tipo'] . '</td>
                    <td>' . $rows['maquina_marca'] . '</td>
                    <td>' . $rows['maquina_estado'] . '</td>
                    <td>' . $rows['maquina_ultima_revision'] . '</td>
                    <td>
                        <a href="index.php?vista=maquinaria_update&maquina_id_up=' . $rows['maquina_id'] . '" class="waves-effect waves-light btn-small green">Actualizar</a>
                        <a href="' . $url . $pagina . '&maquina_id_del=' . $rows['maquina_id'] . '" onclick="return confirmarEliminacion(' . $rows['maquina_id'] . ')" class="waves-effect waves-light btn-small red">Eliminar</a>
                    </td>
                </tr>
            ';
            $contador++;
        }
    } else {
        $tabla .= '
            <tr>
                <td colspan="7" class="center-align">No hay registros en el sistema</td>
            </tr>
        ';
    }

    $tabla .= '</tbody></table>';

    if ($total > 0 && $pagina <= $Npaginas) {
        $tabla .= '<p class="has-text-right">Mostrando máquinas <strong>' . ($inicio + 1) . '</strong> al <strong>' . min(($inicio + $registros), $total) . '</strong> de un <strong>total de ' . $total . '</strong></p>';
    }

    $conexion = null;
    echo $tabla;

    if ($total >= 1 && $pagina <= $Npaginas) {
        echo paginador_tablas($pagina, $Npaginas, $url, 7);
    }
?>
<script>
    function confirmarEliminacion(maquinaId) {
        if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
            // Si el usuario confirma la eliminación, redirige a la página con el parámetro maquina_id_del
            window.location.href = "index.php?vista=maquinaria_list&maquina_id_del=" + maquinaId;
            return true; // Devuelve true para permitir la redirección
        } else {
            return false; // Devuelve false para evitar la redirección
        }
    }
</script>