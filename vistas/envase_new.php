<?php include "./inc/head.php"; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<div class="container">
    <div class="logo">
        <img src="img/StockPet.png" alt="Logo StockPro">
    </div>
    <?php
        include "./inc/btn_home.php";
        include "./inc/btn_back.php";
    ?>
    <h5 class="title">Envases</h5>
    <h5 class="subtitle">Nuevo envase</h5>
</div>

<div class="container pb-6 pt-6">
    <?php require_once "./php/main.php"; ?>

    <div class="form-rest mb-6 mt-6"></div>

    <form action="./php/envase_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s6">
                <input id="envase_ml" type="text" class="validate" name="envase_ml" pattern="[0-9]+" required>
                <label for="envase_ml">Mililitros</label>
            </div>
            <div class="input-field col s6">
                <input id="envase_tipo" type="text" class="validate" name="envase_tipo" required>
                <label for="envase_tipo">Tipo</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input id="envase_gramaje" type="text" class="validate" name="envase_gramaje" pattern="[0-9]+(?:\.[0-9]+)?" required>
                <label for="envase_gramaje">Gramaje</label>
            </div>
            <div class="input-field col s6">
                <input id="envase_color" type="text" class="validate" name="envase_color" required>
                <label for="envase_color">Color</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="envase_cantidad" type="text" class="validate" name="envase_cantidad" pattern="[0-9]+" required>
                <label for="envase_cantidad">Cantidad</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <button type="submit" class="btn waves-effect waves-light">Guardar</button>
            </div>
        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems, {});
    });
</script>
