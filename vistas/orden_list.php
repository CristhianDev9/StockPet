<?php
include "./inc/head.php"; // Asegúrate de que esta línea incluya los estilos de Materialize y cualquier otro recurso necesario
?>

<div class="container">
    <div class="logo">
        <img src="img/StockPet.png" alt="Logo StockPro" />
    </div>
    <?php
    include "./inc/btn_home.php";
    include "./inc/btn_back.php";
    ?>
    <h5 class="title">Órdenes de Producción</h5>
    <h5 class="subtitle">Listado de Órdenes</h5>
</div>

<div class="container pb-6 pt-6">
    <div class="form-rest mb-6 mt-6"></div>

    <?php
    if (isset($_GET['op_id_del'])) {
        require_once "./php/orden_eliminar.php";
    }
    ?>

    <?php
    require_once "./php/orden_lista.php";
    ?>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        M.AutoInit();
    });
</script>
