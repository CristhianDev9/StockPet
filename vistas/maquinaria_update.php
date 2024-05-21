<?php include "./inc/head.php"; ?>

<div class="container">
    <div class="logo">
        <img src="img/StockPet.png" alt="Logo StockPro">
    </div>
    <br>
    <div class="container is-fluid mb-6">
        <h5 class="title">Maquinaria</h5>
        <h5 class="subtitle">Actualizar máquina</h5>
    </div>

    <div class="container">
        <?php
        include "./inc/btn_back.php";
        require_once "./php/main.php";

        $id = (isset($_GET['maquina_id_up'])) ? $_GET['maquina_id_up'] : 0;
        $id = limpiar_cadena($id);

        /* Verificando máquina */
        $check_maquinaria = conexion();
        $check_maquinaria = $check_maquinaria->query("SELECT * FROM maquinaria WHERE maquina_id='$id'");

        if ($check_maquinaria->rowCount() > 0) {
            $datos = $check_maquinaria->fetch();
            ?>

            <div class="form-rest mb-6 mt-6"></div>

            <h5 class="title has-text-centered"><?php echo $datos['maquina_nombre'] . " - " . $datos['maquina_tipo']; ?></h5>

            <form action="./php/maquinaria_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">

                <input type="hidden" name="maquina_id" value="<?php echo $datos['maquina_id']; ?>" required>

                <div class="input-field">
                    <label for="maquina_nombre">Nombre</label>
                    <input type="text" name="maquina_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,250}" maxlength="250" required value="<?php echo $datos['maquina_nombre']; ?>">
                </div>

                <div class="input-field">
                    <label for="maquina_tipo">Tipo</label>
                    <input type="text" name="maquina_tipo" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,250}" maxlength="250" required value="<?php echo $datos['maquina_tipo']; ?>">
                </div>

                <div class="input-field">
                    <label for="maquina_marca">Marca</label>
                    <input type="text" name="maquina_marca" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,250}" maxlength="250" value="<?php echo $datos['maquina_marca']; ?>">
                </div>

                <div class="input-field">
                    <label for="maquina_estado">Estado</label>
                    <select name="maquina_estado" required>
                        <option value="activo" <?php if($datos['maquina_estado'] == 'activo') echo 'selected'; ?>>Activo</option>
                        <option value="inactivo" <?php if($datos['maquina_estado'] == 'inactivo') echo 'selected'; ?>>Inactivo</option>
                        <option value="mantenimiento" <?php if($datos['maquina_estado'] == 'mantenimiento') echo 'selected'; ?>>Mantenimiento</option>
                    </select>
                </div>

                <div class="input-field">
                    <label for="maquina_ultima_revision">Última Revisión</label>
                    <input type="date" name="maquina_ultima_revision" value="<?php echo $datos['maquina_ultima_revision']; ?>">
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
        $check_maquinaria = null;
        ?>
    </div>
</div>
