<?php include "./inc/head.php"; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<div class="container">
  <div class="logo">
    <img src="img/StockPet.png" alt="Logo StockPro" />
  </div>
  <?php
        include "./inc/btn_home.php";
        include "./inc/btn_back.php";
    ?>
  <h5 class="title">Maquinaria</h5>
  <h5 class="subtitle">Nueva Máquina</h5>
</div>

<div class="container pb-6 pt-6">
  <?php require_once "./php/main.php"; ?>

  <div class="form-rest mb-6 mt-6"></div>

  <form
    action="./php/maquinaria_guardar.php"
    method="POST"
    class="FormularioAjax"
    autocomplete="off"
    enctype="multipart/form-data"
  >
    <div class="row">
      <div class="input-field col s6">
        <input
          id="maquina_nombre"
          type="text"
          class="validate"
          name="maquina_nombre"
          required
        />
        <label for="maquina_nombre">Nombre de la Máquina</label>
      </div>
      <div class="input-field col s6">
        <input
          id="maquina_tipo"
          type="text"
          class="validate"
          name="maquina_tipo"
          required
        />
        <label for="maquina_tipo">Tipo de Máquina</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <input
          id="maquina_marca"
          type="text"
          class="validate"
          name="maquina_marca"
        />
        <label for="maquina_marca">Marca de la Máquina</label>
      </div>
      <div class="input-field col s6">
        <select id="maquina_estado" name="maquina_estado" required>
          <option value="" disabled selected>Seleccione un estado</option>
          <option value="activo">Activo</option>
          <option value="inactivo">Inactivo</option>
          <option value="mantenimiento">Mantenimiento</option>
        </select>
        <label for="maquina_estado">Estado de la Máquina</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <input
          id="maquina_ultima_revision"
          type="date"
          class="validate"
          name="maquina_ultima_revision"
        />
        <label for="maquina_ultima_revision">Última Revisión</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <button type="submit" class="btn waves-effect waves-light">
          Guardar
        </button>
      </div>
    </div>
  </form>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    var elems = document.querySelectorAll("select");
    var instances = M.FormSelect.init(elems, {});
  });
</script>
