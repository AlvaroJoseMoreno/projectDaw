<?php
/*
	En esta pagina mostramos el detalle de una foto individual que tenemos guardada en la base de datos (fecha, titulo, autor, pais, etc)
	@authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
	Fecha de creacion: 9-11-20. Fecha de ultima modificacion: 18-11-20, Motivo: comprobar si existe alguna cookie o sesion.
*/
setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
	$title = "PI-Página con detalle de foto";
		$idbody = "id = detalle";
		include "head.php";
	if(isset($_COOKIE['usuario']) || (isset($_SESSION['usuario']))){
		//se hace un split a la url para comprobar la id de la foto
		$url= $_SERVER["REQUEST_URI"];
		$split = explode('=', $url);
		$i = $split[count($split)-1];
		include "article.php";
		include "footer.php";
	}
	else{
		//si no existe cookie o sesion de usuario redirecciona a la pagina principal
		$host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = './';
        header("Location: http://$host$uri/$extra");
        exit;
	}
?>