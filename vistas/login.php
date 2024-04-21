<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link rel="stylesheet" href="./css/login.css">
  <title>Iniciar Sesión - StockPro</title>
  <link rel="icon" type="image/x-icon" href="./img/Cubo.ico">
  
</head>
<body>  
  <div class="container">
    <div class="logo">
      <img src="img/StockPro.png" alt="Logo de la Empresa" class="responsive-img">
    </div>
    <h5>Iniciar Sesión</h5>
    
    <form action="" method="POST"> <!-- Actualizado el atributo action -->
      <div class="input-field">
        <input type="text" id="usuario" name="login_usuario" required > <!-- Agregado el atributo name -->
        <label for="usuario">Usuario</label>
      </div>
      <div class="input-field">
        <input type="password" id="contrasena" name="login_clave" > <!-- Agregado el atributo name -->
        <label for="contrasena">Contraseña</label>
      </div>
        
      <input type="submit" value="Iniciar sesión" class="btn waves-effect waves-light btn-login btn-block"> <!-- Eliminado el evento onclick -->

      <div class="recover-password">
        <a href="RecuperarContrasena.html">¿Olvidó su contraseña?</a>
      </div>
	  <?php
			if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
				require_once "./php/main.php";
				require_once "./php/iniciar_sesion.php";
			}
		?>
    </form> 
  </div>
  </body>
  