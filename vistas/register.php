<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="./css/estilos.css" />
  <title>Panel de Control - StockPro</title>
  <link rel="icon" type="image/x-icon" href="./img/Cubo.ico">
</head>

<body>
  <div class="container center-align">
    <div class="logo">
      <img src="./img/StockPet.png" alt="Logo StockPro">
      <h6>Panel de Registro de Producción</h6>
      <h5>Seleccione una opción:</h5>
    </div>

    <div class="row center-cards">
      <div class="col s12 m6 l3">
        <div class="card">
          <div class="card-image">
            <img src="./img/envase_image.jpg">
            <span class="card-title"><strong>Envase</strong></span>
          </div>
          <div class="card-action">
            <a href="RegistroProducciónEnvase.php">Registra Producción de Envase</a>
          </div>
        </div>
      </div>
      <div class="col s12 m6 l3">
        <div class="card">
          <div class="card-image">
            <img src="./img/pellet_image.jpg">
            <span class="card-title">Pellet</span>
          </div>
          <div class="card-action">
            <a href="registro_pellet.php">Registra Producción de Pellet</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>
