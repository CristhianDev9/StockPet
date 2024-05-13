<?php include "./inc/head.php"; ?>

<div class="container">
    <div class="logo">
            <img src="img/StockPet.png" alt="Logo StockPro">
	
        </div>
            <br>  
     
        <div class="container is-fluid mb-6">
            <h5 class="title">Preformas</h5>
            <h5 class="subtitle">Lista de preformas</h5>
        </div>

    <div class="botones-container">
                <a href="index.php?vista=home" class="waves-effect waves-light btn-small"><i class="material-icons left">home</i>Menú pricipal</a>
                <br>
                <br>
                <a href="index.php?vista=preforma_new" class="waves-effect waves-light blue btn-small "><i class="material-icons left">add</i>Añadir registro de preforma</a> 
    </div>
  
    
</div>

<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php";

        # Eliminar producto #
        if(isset($_GET['preforma_id_del'])){
            require_once "./php/preforma_eliminar.php";
        }

        if(!isset($_GET['page'])){
            $pagina=1;
        }else{
            $pagina=(int) $_GET['page'];
            if($pagina<=1){
                $pagina=1;
            }
        }

        $categoria_id = (isset($_GET['category_id'])) ? $_GET['category_id'] : 0;

        $pagina=limpiar_cadena($pagina);
        $url="index.php?vista=product_list&page="; /* <== */
        $registros=15;
        $busqueda="";

        # Paginador producto #
        require_once "./php/preforma_lista.php";
    ?>
</div>