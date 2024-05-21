<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="./css/PanelDeControl.css" />
  <title>Panel de Control - StockPro</title>
  <link rel="icon" type="image/x-icon" href="./img/Cubo.ico">
</head>

<body>

  <div class="logo">
    <img src="./img/StockPet.png" alt="Logo StockPro">
    <h6>Panel de Control</h6>
  </div>
  
  <br><br><br>
  <div class="container">
    <div class="row">
      <div class="col s8 m3 l3">
        <div class="card">
          <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="https://www.bing.com/th?id=OIG.7aG0ZoUnUHcU1LLceeLl&w=236&c=11&rs=1&qlt=90&bgcl=ececec&o=6&pid=PersonalBing&p=0" alt="Imagen de la tarjeta">
          </div>
          <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">Usuarios<i class="material-icons right"></i></span>
            <!-- Dropdown Structure -->
          </div>
          <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Usuarios<i class="material-icons right">close</i></span>
            <ul>
              <li class="divider"></li>
              <li><a href="index.php?vista=user_new">Añadir Usuarios</a></li>
              <li class="divider"></li>
              <li><a href="index.php?vista=user_list">Gestionar Usuarios</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- tarjeta para inventarios -->

      <div class="col s8 m3 l3">
        <div class="card">
          <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="https://www.bing.com/th?id=OIG.cbYXHIBA.qyAjveJshLA&w=236&c=11&rs=1&qlt=90&bgcl=ececec&o=6&pid=PersonalBing&p=0" alt="Imagen de la tarjeta">
          </div>
          <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">Inventarios<i class="material-icons right"></i></span>
            <!-- Dropdown Structure -->
          </div>
          <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Inventarios<i class="material-icons right">close</i></span>
            <ul>
              <li class="divider"></li>
              <li><a href="index.php?vista=preforma_list">Inventario de Preformas</a></li>
              <li class="divider"></li>
              <li><a href="index.php?vista=envase_list">Inventario de Envases</a></li>
              <li class="divider"></li>
              <li><a href="index.php?vista=maquinaria_list">Inventario de Maquinaria</a></li> 
            </ul>
          </div>
        </div>


      </div>

      <div class="col s8 m3 l3">
        <div class="card">
          <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="https://www.bing.com/th?id=OIG.nv84vArsy52ASM5LsFdX&w=236&c=11&rs=1&qlt=90&bgcl=ececec&o=6&pid=PersonalBing&p=0" alt="Imagen de la tarjeta">
          </div>
          <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">Ordenes de producción<i class="material-icons right"></i></span>
            <!-- Dropdown Structure -->
          </div>
          <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Ordenes de producción<i class="material-icons right">close</i></span>
            <ul>
              <li class="divider"></li>
              <li><a href="index.php?vista=orden_new">Crear Orden de Producción</a></li>
              <li class="divider"></li>
              <li><a href="index.php?vista=orden_list">Gestionar Órdenes de Producción</a></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col s8 m3 l3">
        <div class="card">
          <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="https://th.bing.com/th/id/OIG.zuNIGNOtdQ3zWtRTGRZc?w=1024&h=1024&rs=1&pid=ImgDetMain" alt="Imagen de la tarjeta">
          </div>
          <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">Informes de producción<i class="material-icons right"></i></span>
            <!-- Dropdown Structure -->
          </div>
          <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Informes de producción<i class="material-icons right">close</i></span>
            <ul>
              <li class="divider"></li>
              <li><a href="InformesEnvase.html">Informes de producción de envase</a></li>
              <li class="divider"></li>
              <li><a href="InformesPellet.html">Informes de producción Pellet</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    // Inicializar el dropdown
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.dropdown-trigger');
      var instances = M.Dropdown.init(elems);
    });
  </script>
  <footer>
    <a href="index.php?vista=logout" class="btn waves-effect waves-light red">Cerrar Sesión</a>
  </footer>
</body>