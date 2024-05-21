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
  <h5 class="title">Orden de Producción</h5>
  <h5 class="subtitle">Nueva Orden</h5>
</div>

<div class="container pb-6 pt-6">
  <?php require_once "./php/main.php"; ?>

  <div class="form-rest mb-6 mt-6"></div>

  <form action="./php/orden_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
    <div class="row">
      <div class="input-field col s6">
        <select id="cliente_id" name="cliente_id" required>
          <option value="" disabled selected>Seleccione un cliente</option>
          <?php
            $clientes = conexion();
            $clientes = $clientes->query("SELECT cliente_id, cliente_nombre FROM clientes");
            if($clientes->rowCount() > 0){
              while($row = $clientes->fetch(PDO::FETCH_ASSOC)){
                echo '<option value="'.$row['cliente_id'].'">'.$row['cliente_nombre'].'</option>';
              }
            }
          ?>
          <option value="otro">Otro</option>
        </select>
        <label for="cliente_id">Cliente</label>
      </div>
      <div class="input-field col s6" id="cliente_otro" style="display:none;">
        <input id="cliente_otro_nombre" type="text" class="validate" name="cliente_otro_nombre"/>
        <label for="cliente_otro_nombre">Nombre del Nuevo Cliente</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <input id="envase_ml" type="number" class="validate" name="envase_ml" required/>
        <label for="envase_ml">Tamaño de Envase (ml)</label>
      </div>
      <div class="input-field col s6">
        <input id="envase_tipo" type="text" class="validate" name="envase_tipo" required/>
        <label for="envase_tipo">Tipo de Envase</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <select id="envase_color" name="envase_color" required>
          <option value="" disabled selected>Seleccione un color</option>
          <?php
            $colores = conexion();
            $colores = $colores->query("SELECT DISTINCT preforma_color FROM preforma");
            if($colores->rowCount() > 0){
              while($row = $colores->fetch(PDO::FETCH_ASSOC)){
                echo '<option value="'.$row['preforma_color'].'">'.$row['preforma_color'].'</option>';
              }
            }
          ?>
        </select>
        <label for="envase_color">Color del Envase</label>
      </div>
      <!-- Campo oculto para envase_id -->
      <input type="hidden" id="envase_id" name="envase_id"/>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <select id="preforma_id" name="preforma_id" required>
          <option value="" disabled selected>Seleccione un gramaje de preforma</option>
          <?php
            $preformas = conexion();
            $preformas = $preformas->query("SELECT preforma_id, preforma_gramaje FROM preforma");
            if($preformas->rowCount() > 0){
              while($row = $preformas->fetch(PDO::FETCH_ASSOC)){
                echo '<option value="'.$row['preforma_id'].'">'.$row['preforma_gramaje'].'</option>';
              }
            }
          ?>
        </select>
        <label for="preforma_id">Preforma (gramaje)</label>
      </div>
      <div class="input-field col s6">
        <input id="cantidad" type="number" class="validate" name="cantidad" required/>
        <label for="cantidad">Cantidad</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <select id="maquina_id" name="maquina_id" required>
          <option value="" disabled selected>Seleccione una máquina</option>
          <?php
            $maquinas = conexion();
            $maquinas = $maquinas->query("SELECT maquina_id, maquina_nombre FROM maquinaria WHERE maquina_nombre LIKE '%SOP%'");
            if($maquinas->rowCount() > 0){
              while($row = $maquinas->fetch(PDO::FETCH_ASSOC)){
                echo '<option value="'.$row['maquina_id'].'">'.$row['maquina_nombre'].'</option>';
              }
            }
          ?>
        </select>
        <label for="maquina_id">Máquina</label>
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

    document.getElementById("cliente_id").addEventListener("change", function() {
      var clienteOtro = document.getElementById("cliente_otro");
      if(this.value === "otro") {
        clienteOtro.style.display = "block";
        document.getElementById("cliente_otro_nombre").setAttribute("required", "required");
      } else {
        clienteOtro.style.display = "none";
        document.getElementById("cliente_otro_nombre").removeAttribute("required");
      }
    });

    // Lógica para obtener envase_id
    document.getElementById("envase_ml").addEventListener("change", obtenerEnvaseID);
    document.getElementById("envase_tipo").addEventListener("change", obtenerEnvaseID);
    document.getElementById("envase_color").addEventListener("change", obtenerEnvaseID);

    function obtenerEnvaseID() {
      var ml = document.getElementById("envase_ml").value;
      var tipo = document.getElementById("envase_tipo").value;
      var color = document.getElementById("envase_color").value;

      if(ml && tipo && color) {
        fetch("./php/obtener_envase_id.php", {
          method: "POST",
          body: JSON.stringify({ ml: ml, tipo: tipo, color: color }),
          headers: { "Content-Type": "application/json" }
        })
        .then(response => response.json())
        .then(data => {
          if(data.envase_id) {
            document.getElementById("envase_id").value = data.envase_id;
          } else {
            // Logica para crear nuevo envase si no existe
            fetch("./php/crear_envase.php", {
              method: "POST",
              body: JSON.stringify({ ml: ml, tipo: tipo, color: color }),
              headers: { "Content-Type": "application/json" }
            })
            .then(response => response.json())
            .then(data => {
              document.getElementById("envase_id").value = data.envase_id;
            });
          }
        });
      }
    }
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    M.AutoInit();
  });
</script>