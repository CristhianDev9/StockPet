<?php include "./inc/head.php"; ?>

<div class="container">
    <div class="logo">
            <img src="img/StockPet.png" alt="Logo StockPro">
	
        </div>
            <br>  
     
        <div class="container is-fluid mb-6">
            <h5 class="title">Preformas</h5>
            <h5 class="subtitle">Actualizar preforma</h5>
        </div>


<div class="container">
    <?php
        include "./inc/btn_back.php";

        require_once "./php/main.php";

        $id = (isset($_GET['preforma_id_up'])) ? $_GET['preforma_id_up'] : 0;
        $id = limpiar_cadena($id);

        /* Verificando preforma */
        $check_preforma = conexion();
        $check_preforma = $check_preforma->query("SELECT * FROM preforma WHERE preforma_id='$id'");

        if ($check_preforma->rowCount() > 0) {
            $datos = $check_preforma->fetch();
    ?>

    <div class="form-rest mb-6 mt-6"></div>

    <h5 class="title has-text-centered"><?php echo $datos['preforma_gramaje'] . " - " . $datos['preforma_color']; ?></h5>

    <form action="./php/preforma_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">

        <input type="hidden" name="preforma_id" value="<?php echo $datos['preforma_id']; ?>" required>

        <div class="input-field">
            <label for="preforma_gramaje">Gramaje</label>
            <input type="text" name="preforma_gramaje" pattern="[a-zA-Z0-9- ]{1,70}" maxlength="70" required value="<?php echo $datos['preforma_gramaje']; ?>">
        </div>

        <div class="input-field">
            <label for="preforma_color">Color</label>
            <input type="text" name="preforma_color" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="70" required value="<?php echo $datos['preforma_color']; ?>">
        </div>

        <div class="input-field">
            <label for="preforma_pico">Pico</label>
            <select name="preforma_pico" class="browser-default">
                <option value="28 mm largo" <?php echo ($datos['preforma_pico'] == '28 mm largo') ? 'selected' : ''; ?>>28 mm largo</option>
                <option value="28 mm corto" <?php echo ($datos['preforma_pico'] == '28 mm corto') ? 'selected' : ''; ?>>28 mm corto</option>
                <option value="63 mm" <?php echo ($datos['preforma_pico'] == '63 mm') ? 'selected' : ''; ?>>63 mm</option>
            </select>
        </div>

        <div class="input-field">
            <label for="preforma_cantidad">Cantidad</label>
            <input type="text" name="preforma_cantidad" pattern="[0-9]{1,25}" maxlength="25" required value="<?php echo $datos['preforma_cantidad']; ?>">
        </div>

        <div class="input-field">
            <label for="preforma_cantidad_res">Cantidad Reservada</label>
            <input type="text" name="preforma_cantidad_res" pattern="[0-9]{1,25}" maxlength="25" required value="<?php echo $datos['preforma_cantidad_res']; ?>">
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
        $check_preforma = null;
    ?>
</div>