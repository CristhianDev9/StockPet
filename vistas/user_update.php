<?php include "./inc/head.php"; ?>
<body>
<script src="js/form.js"></script>
  <div class="container">
    <a href="index.php?vista=home" class="waves-effect waves-light btn-small"><i class="material-icons left">home</i>Menú pricipal</a>
    <div class="logo">
      <img src="img/StockPet.png" alt="Logo StockPro">
    </div>
    <br><br><br><br> 
    <?php
      include "./inc/btn_back.php";
      require_once "./php/main.php";
      $id = (isset($_GET['user_id_up'])) ? $_GET['user_id_up'] : 0;
      $id = limpiar_cadena($id);
    ?>
    <?php if ($id == $_SESSION['id']) { ?>
      <h5 class="title">Mi cuenta</h5>
      <h5 class="subtitle">Actualizar datos de cuenta</h5>
    <?php } else { ?>
      <h5 class="title">Usuarios</h5>
      <h5 class="subtitle">Actualizar usuario</h5>
    <?php } ?>
    <?php
      /*== Verificando usuario ==*/
      $check_usuario = conexion();
      $check_usuario = $check_usuario->query("SELECT * FROM usuario WHERE usuario_id='$id'");
      if ($check_usuario->rowCount() > 0) {
        $datos = $check_usuario->fetch();
    ?>
    <div class="form"></div>
    <form action="./php/usuario_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">
      <input type="hidden" name="usuario_id" value="<?php echo $datos['usuario_id']; ?>" required>
      <div class="row">
        <div class="col m6 input-field">
          <label for="usuario_nombre">Nombres</label>
          <input class="validate" type="text" name="usuario_nombre" id="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php echo $datos['usuario_nombre']; ?>">
        </div>
        <div class="col m6 input-field">
          <label for="usuario_apellido">Apellidos</label>
          <input class="validate" type="text" name="usuario_apellido" id="usuario_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php echo $datos['usuario_apellido']; ?>">
        </div>
        <div class="col m6 input-field">
          <label for="usuario_cargo">Cargo</label>
          <input class="validate" type="text" name="usuario_cargo" id="usuario_cargo" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php echo $datos['usuario_cargo']; ?>">
        </div>
      
          
            <div class="control">
                  <label>Rol</label>
                    <br>
                    <label class="radio-container">
                      <input type="radio" name="usuario_rol" value="admin"<?php if ($datos['usuario_rol'] == 'admin') echo 'checked'; ?>>
                      <span class="radio-checkmark"></span>
                        Administrador
                  </label>
                  <label class="radio-container">
                      <input type="radio" name="usuario_rol" value="user"<?php if ($datos['usuario_rol'] == 'user') echo 'checked'; ?>>
                      <span class="radio-checkmark"></span>
                        Usuario
                  </label>
                  </div>
                  
          </div>
        
          <div id="nivelTotalFields" >
              <div class="row">
                <div class="col m6 input-field">
                  <label for="usuario_usuario">Usuario</label>
                  <input class="validate" type="text" name="usuario_usuario" id="usuario_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required value="<?php echo $datos['usuario_usuario']; ?>">
                </div>
                <div class="col m6 input-field">
                  <label for="usuario_email">Email</label>
                  <input class="validate" type="email" name="usuario_email" id="usuario_email" maxlength="70" value="<?php echo $datos['usuario_email']; ?>">
                </div>
              </div>
              
                <p class="center-align">
                  SI desea actualizar la clave de este usuario por favor llene los 2 campos. Si NO desea actualizar la clave deje los campos vacíos.
                </p>
                <div class="row">
                  <div class="col m6 input-field">
                    <label for="usuario_clave_1">Clave</label>
                    <input class="validate" type="password" name="usuario_clave_1" id="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                  </div>
                  <div class="col m6 input-field">
                    <label for="usuario_clave_2">Repetir clave</label>
                    <input class="validate" type="password" name="usuario_clave_2" id="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                  </div>
                </div>
              
              <p class="center-align">
                Para poder actualizar los datos de este usuario por favor ingrese su USUARIO y CLAVE con la que ha iniciado sesión
              </p>
              <div class="row">
                <div class="col m6 input-field">
                  <label for="administrador_usuario">Usuario</label>
                  <input class="validate" type="text" name="administrador_usuario" id="administrador_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
                </div>
                <div class="col m6 input-field">
                  <label for="administrador_clave">Clave</label>
                  <input class="validate" type="password" name="administrador_clave" id="administrador_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" required>
                </div>
              </div>
              </div>
              <p class="center-align">
                <button type="submit" class="btn waves-effect waves-light btn-success">Actualizar</button>
              </p>
            </form>
          <?php
            } else {
              include "./inc/error_alert.php";
            }
            $check_usuario = null;
          ?>
  </div>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>