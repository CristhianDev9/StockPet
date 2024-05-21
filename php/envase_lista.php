<?php
    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
    $tabla = '<table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Capacidad en ML</th>
                        <th>Tipo</th>
                        <th>Gramaje</th>
                        <th>Color</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

    $campos = "envase_id, envase_ml, envase_tipo, envase_gramaje, envase_color, envase_cantidad";

    if (isset($busqueda) && $busqueda != "") {
        $consulta_datos = "SELECT $campos FROM envase WHERE envase_ml LIKE '%$busqueda%' OR envase_tipo LIKE '%$busqueda%' ORDER BY envase_ml ASC LIMIT $inicio, $registros";

        $consulta_total = "SELECT COUNT(envase_id) FROM envase WHERE envase_ml LIKE '%$busqueda%' OR envase_tipo LIKE '%$busqueda%'";
    } else {
        $consulta_datos = "SELECT $campos FROM envase ORDER BY envase_ml ASC LIMIT $inicio, $registros";

        $consulta_total = "SELECT COUNT(envase_id) FROM envase";
    }

    $conexion = conexion();

    $datos = $conexion->query($consulta_datos);
    $datos = $datos->fetchAll();

    $total = $conexion->query($consulta_total);
    $total = (int)$total->fetchColumn();

    $Npaginas = ceil($total / $registros);

    if ($total >= 1 && $pagina <= $Npaginas) {
        $contador=$inicio+1;
        $pag_inicio=$inicio+1;
        foreach ($datos as $rows) {
            $tabla .= '
                <tr>
                    <td>' .$contador.' </td>
                    <td>' . $rows['envase_ml'] . '</td>
                    <td>' . $rows['envase_tipo'] . '</td>
                    <td>' . $rows['envase_gramaje'] . '</td>
                    <td>' . $rows['envase_color'] . '</td>
                    <td>' . $rows['envase_cantidad'] . '</td>
                    <td>
                        <a href="index.php?vista=envase_update&envase_id_up='.$rows['envase_id'].'" class="waves-effect waves-light btn-small green">Actualizar</a>
                        <a href="'.$url.$pagina.'&envase_id_del='.$rows['envase_id'].'" onclick="return confirmarEliminacion ('.$rows['envase_id'].')" class="waves-effect waves-light btn-small red">Eliminar</a>
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
        $tabla .= '<p class="has-text-right">Mostrando envases <strong>' . ($inicio + 1) . '</strong> al <strong>' . min(($inicio + $registros), $total) . '</strong> de un <strong>total de ' . $total . '</strong></p>';
    }

    $conexion = null;
    echo $tabla;

    if ($total >= 1 && $pagina <= $Npaginas) {
        echo paginador_tablas($pagina, $Npaginas, $url, 7);
    }
?>
<script>
    function confirmarEliminacion(envaseId) {
        if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
            // Si el usuario confirma la eliminación, redirige a la página con el parámetro envase_id_del
            window.location.href = "index.php?vista=envase_list&envase_id_del=" + envaseId;
            return true; // Devuelve true para permitir la redirección
        } else {
            return false; // Devuelve false para evitar la redirección
        }
    }
</script>