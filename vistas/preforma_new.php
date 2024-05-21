<?php include "./inc/head.php"; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<div class="container">
<div class="logo">
   			 <img src="img/StockPet.png" alt="Logo StockPro">
		</div>
		<?php
  	  		include "./inc/btn_home.php" ; 
      		include "./inc/btn_back.php";
	  
	 	 ?>
    <h5 class="title">Preformas</h5>
    <h5 class="subtitle">Nueva preforma</h5>
</div>

<div class="container pb-6 pt-6">
    <?php require_once "./php/main.php"; ?>

    <div class="form-rest mb-6 mt-6"></div>

    <form action="./php/preforma_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s6">
                <input id="preforma_gramaje" type="text" class="validate" name="preforma_gramaje" pattern="[0-9]+([,\.][0-9]+)?" required>
                <label for="preforma_gramaje">Gramaje</label>
            </div>
            <div class="input-field col s6">
                <select id="preforma_color" type="text" class="validate" name="preforma_color" required>
                    <option value="" disabled selected>Seleccione un color</option>
                    <option value="Cristal">Cristal</option>
                    <option value="Ambar">Ambar</option>
                    <option value="Azul">Azul</option>
                    <option value="verde">Verde</option>
                    <option value="Amarillo">Amarillo</option>
                    <option value="Blanco">Blanco</option>
                    <option value="Rojo">Rojo</option>
                </select>
                <label for="preforma_color">Color</label> 
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <select id="preforma_pico" name="preforma_pico">
                    <option value="" disabled selected>Seleccione un pico</option>
                    <option value="28 mm largo">28 mm largo</option>
                    <option value="28 mm corto">28 mm corto</option>
                    <option value="63 mm">63 mm</option>
                </select>
                <label for="preforma_pico">Pico</label>
            </div>
            <div class="input-field col s6">
                <input id="preforma_cantidad" type="text" class="validate" name="preforma_cantidad" pattern="[0-9]+" required>
                <label for="preforma_cantidad">Cantidad</label>
            </div>
        </div>
        
        <div class="row">
            <div class="input-field col s12">
                <button type="submit" class="btn waves-effect waves-light">Guardar</button>
            </div>
        </div>
    </form>
</div>
<script>document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, {});
  });</script>