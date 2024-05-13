<?php
    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
    $tabla = '<table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gramaje</th>
                        <th>Color</th>
                        <th>Pico</th>
                        <th>Cantidad</th>
                        <th>Cantidad Reservada</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

    $campos = "preforma_id, preforma_gramaje, preforma_color, preforma_pico, preforma_cantidad, preforma_cantidad_res";

    if (isset($busqueda) && $busqueda != "") {
        $consulta_datos = "SELECT $campos FROM preforma WHERE preforma_gramaje LIKE '%$busqueda%' OR preforma_color LIKE '%$busqueda%' ORDER BY preforma_gramaje ASC LIMIT $inicio, $registros";

        $consulta_total = "SELECT COUNT(preforma_id) FROM preforma WHERE preforma_gramaje LIKE '%$busqueda%' OR preforma_color LIKE '%$busqueda%'";
    } else {
        $consulta_datos = "SELECT $campos FROM preforma ORDER BY preforma_gramaje ASC LIMIT $inicio, $registros";

        $consulta_total = "SELECT COUNT(preforma_id) FROM preforma";
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
                    <td>' . $rows['preforma_gramaje'] . '</td>
                    <td>' . $rows['preforma_color'] . '</td>
                    <td>' . $rows['preforma_pico'] . '</td>
                    <td>' . $rows['preforma_cantidad'] . '</td>
                    <td>' . $rows['preforma_cantidad_res'] . '</td>
                    <td>
                        <a href="index.php?vista=preforma_update&preforma_id_up='.$rows['preforma_id'].'" class="waves-effect waves-light btn-small green">Actualizar</a>
                        <a href="'.$url.$pagina.'&preforma_id_del='.$rows['preforma_id'].'" onclick="return confirmarEliminacion ('.$rows['preforma_id'].')" class="waves-effect waves-light btn-small red">Eliminar</a>
                   
                    </td>
                </tr>
            ';
        }
    } else {
        $tabla .= '
            <tr>
                <td colspan="6" class="center-align">No hay registros en el sistema</td>
            </tr>
        ';
    }

    $tabla .= '</tbody></table>';

    if ($total > 0 && $pagina <= $Npaginas) {
        $tabla .= '<p class="has-text-right">Mostrando preformas <strong>' . ($inicio + 1) . '</strong> al <strong>' . min(($inicio + $registros), $total) . '</strong> de un <strong>total de ' . $total . '</strong></p>';
    }

    $conexion = null;
    echo $tabla;

    if ($total >= 1 && $pagina <= $Npaginas) {
        echo paginador_tablas($pagina, $Npaginas, $url, 7);
    }
?>
<script>
    function confirmarEliminacion(preformaId) {
        if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
            // Si el usuario confirma la eliminación, redirige a la página con el parámetro preforma_id_del
            window.location.href = "index.php?vista=product_list&preforma_id_del=" + preformaId;
            return true; // Devuelve true para permitir la redirección
        } else {
            return false; // Devuelve false para evitar la redirección
        }
    }
</script>