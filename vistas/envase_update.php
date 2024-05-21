<?php include "./inc/head.php"; ?>

<div class="container">
    <div class="logo">
        <img src="img/StockPet.png" alt="Logo StockPro">
    </div>
    <br>
    <div class="container is-fluid mb-6">
        <h5 class="title">Envases</h5>
        <h5 class="subtitle">Actualizar envase</h5>
    </div>

    <div class="container">
        <?php
        include "./inc/btn_back.php";
        require_once "./php/main.php";

        $id = (isset($_GET['envase_id_up'])) ? $_GET['envase_id_up'] : 0;
        $id = limpiar_cadena($id);

        /* Verificando envase */
        $check_envase = conexion();
        $check_envase = $check_envase->query("SELECT * FROM envase WHERE envase_id='$id'");

        if ($check_envase->rowCount() > 0) {
            $datos = $check_envase->fetch();
            ?>

            <div class="form-rest mb-6 mt-6"></div>

            <h5 class="title has-text-centered"><?php echo $datos['envase_ml'] . " - " . $datos['envase_tipo']; ?></h5>

            <form action="./php/envase_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">

                <input type="hidden" name="envase_id" value="<?php echo $datos['envase_id']; ?>" required>

                <div class="input-field">
                    <label for="envase_ml">Mililitros</label>
                    <input type="text" name="envase_ml" pattern="[0-9]+" required value="<?php echo $datos['envase_ml']; ?>">
                </div>

                <div class="input-field">
                    <label for="envase_tipo">Tipo</label>
                    <input type="text" name="envase_tipo" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,250}" maxlength="250" required value="<?php echo $datos['envase_tipo']; ?>">
                </div>

                <div class="input-field">
                    <label for="envase_gramaje">Gramaje</label>
                    <input type="text" name="envase_gramaje" pattern="[0-9]+(?:\.[0-9]+)?" required value="<?php echo $datos['envase_gramaje']; ?>">
                </div>

                <div class="input-field">
                    <label for="envase_color">Color</label>
                    <input type="text" name="envase_color" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,250}" maxlength="250" required value="<?php echo $datos['envase_color']; ?>">
                </div>

                <div class="input-field">
                    <label for="envase_cantidad">Cantidad</label>
                    <input type="text" name="envase_cantidad" pattern="[0-9]+" required value="<?php echo $datos['envase_cantidad']; ?>">
                </div>

                <div class="input-field">
                    <button type="submit" class="waves-effect waves-light btn">Actualizar</button>
                </div>
            </form>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <?php
        } else {
            include "./inc/error_alert.php";
        }
        $check_envase = null;
        ?>
    </div>
</div>
