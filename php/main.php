<?php
	
	# Conexion a la base de datos #
	function conexion(){
		$pdo = new PDO('mysql:host=localhost;port=3306;dbname=pruebainv', 'root', '');
		return $pdo;
	}


	# Verificar datos #
	function verificar_datos($filtro,$cadena){
		if(preg_match("/^".$filtro."$/", $cadena)){
			return false;
        }else{
            return true;
        }
	}


	# Limpiar cadenas de texto #
	function limpiar_cadena($cadena){
		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		$cadena=str_ireplace("<script>", "", $cadena);
		$cadena=str_ireplace("</script>", "", $cadena);
		$cadena=str_ireplace("<script src", "", $cadena);
		$cadena=str_ireplace("<script type=", "", $cadena);
		$cadena=str_ireplace("SELECT * FROM", "", $cadena);
		$cadena=str_ireplace("DELETE FROM", "", $cadena);
		$cadena=str_ireplace("INSERT INTO", "", $cadena);
		$cadena=str_ireplace("DROP TABLE", "", $cadena);
		$cadena=str_ireplace("DROP DATABASE", "", $cadena);
		$cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
		$cadena=str_ireplace("SHOW TABLES;", "", $cadena);
		$cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
		$cadena=str_ireplace("<?php", "", $cadena);
		$cadena=str_ireplace("?>", "", $cadena);
		$cadena=str_ireplace("--", "", $cadena);
		$cadena=str_ireplace("^", "", $cadena);
		$cadena=str_ireplace("<", "", $cadena);
		$cadena=str_ireplace("[", "", $cadena);
		$cadena=str_ireplace("]", "", $cadena);
		$cadena=str_ireplace("==", "", $cadena);
		$cadena=str_ireplace(";", "", $cadena);
		$cadena=str_ireplace("::", "", $cadena);
		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		return $cadena;
	}


	# Funcion paginador de tablas #
	function paginador_tablas($pagina, $Npaginas, $url, $botones) {
		$tabla = '<ul class="pagination">';
	  
		if ($pagina <= 1) {
		  $tabla .= '<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';
		} else {
		  $tabla .= '<li class="waves-effect"><a href="' . $url . ($pagina - 1) . '"><i class="material-icons">chevron_left</i></a></li>';
		}
	  
		$ci = 0;
		for ($i = $pagina; $i <= $Npaginas; $i++) {
		  if ($ci >= $botones) {
			break;
		  }
		  if ($pagina == $i) {
			$tabla .= '<li class="active"><a href="' . $url . $i . '">' . $i . '</a></li>';
		  } else {
			$tabla .= '<li class="waves-effect"><a href="' . $url . $i . '">' . $i . '</a></li>';
		  }
		  $ci++;
		}
	  
		if ($pagina == $Npaginas) {
		  $tabla .= '<li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>';
		} else {
		  $tabla .= '<li class="waves-effect"><a href="' . $url . ($pagina + 1) . '"><i class="material-icons">chevron_right</i></a></li>';
		}
	  
		$tabla .= '</ul>';
		return $tabla;
	  }
	  