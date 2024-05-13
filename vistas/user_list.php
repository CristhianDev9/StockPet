<?php include "./inc/head.php"; ?>
<body>
<div class="container"> 
    
        <div class="logo">
            <img src="img/StockPet.png" alt="Logo StockPro">
	
        </div>
            <br>  
     
        <div class="container is-fluid mb-6">
            <h5 class="title">Usuarios</h5>
            <h5 class="subtitle">Lista de usuarios</h5>
        </div>

    <div class="botones-container">
                <a href="index.php?vista=home" class="waves-effect waves-light btn-small"><i class="material-icons left">home</i>Menú pricipal</a>
                <br>
                <br>
                <a href="index.php?vista=user_update&user_id_up=<?php echo $_SESSION['id']; ?>" class="waves-effect waves-light green btn-small "><i class="material-icons left">account_circle</i>Mi cuenta</a> 
                <br>
                <br>
                <a href="index.php?vista=user_new" class="waves-effect waves-light blue btn-small "><i class="material-icons left">add</i>Añadir Usuario</a> 
    </div>
    <div >  
        <?php
            require_once "./php/main.php";

            # Eliminar usuario #
            if(isset($_GET['user_id_del'])){
                require_once "./php/usuario_eliminar.php";
            }

            if(!isset($_GET['page'])){
                $pagina=1;
            }else{
                $pagina=(int) $_GET['page'];
                if($pagina<=1){
                    $pagina=1;
                }
            }

            $pagina=limpiar_cadena($pagina);
            $url="index.php?vista=user_list&page=";
            $registros=15;
            $busqueda="";

            # Paginador usuario #
            require_once "./php/usuario_lista.php";
        ?>
    </div>
    </body>