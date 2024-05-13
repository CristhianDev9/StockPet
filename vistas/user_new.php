
<?php include "./inc/head.php"; ?>
<body>
 
  <div class="container">
  
    	<div class="logo">
   			 <img src="img/StockPet.png" alt="Logo StockPro">
		</div>
		<?php
  	  		include "./inc/btn_home.php" ; 
      		include "./inc/btn_back.php";
	  
	 	 ?>
		<br>
<br><br><br>
<div class="container pb-6 pt-6">
<h6>Añadir Usuario</h6>

<div class="form-rest mb-6 mt-6"></div>
	<form action="./php/usuario_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" >
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombres</label>
				  	<input class="input" type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Apellidos</label>
				  	<input class="input" type="text" name="usuario_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
				</div>
		  	</div>
			<div class="column">
		    	<div class="control">
					<label>Cargo</label>
				  	<input class="input" type="text" name="usuario_cargo" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
			</div>
		  	</div>
		</div>
		<div class="columns">
		<div class="column">
			<div class="control">
			<label>Rol</label>
				 <br>
				<label class="radio-container">
					<input type="radio" name="usuario_rol" value="admin">
					<span class="radio-checkmark"></span>
						Administrador
			</label>
			<label class="radio-container">
					<input type="radio" name="usuario_rol" value="user">
					<span class="radio-checkmark"></span>
						Usuario
			</label>
			</div>
		</div>
		</div>
		<div id="nivelTotalFields" style="display: none;">
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Usuario</label>
				  	<input class="input" type="text" name="usuario_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20"  >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Email</label>
				  	<input class="input" type="email" name="usuario_email" maxlength="70" >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Clave</label>
				  	<input class="input" type="password" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Repetir clave</label>
				  	<input class="input" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
				</div>
		  	</div>
		</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="btn waves-effect waves-light">Guardar
    <i class="material-icons right">send</button>
		</p>
	</form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="js/form.js"></script>