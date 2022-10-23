<?php
	/*
	Pagina privada de usuario que contiene los albumes que pertenecen a dicho usuario, estos se muestran en una tabla con su id, el titulo de los albumes, que a su vez seran un enlace hacia la pagina con todas las fotos de usuario, y la descripcion de ese album.
	@authors: Alejandro Alcaraz Sanchez y Alvaro Jose Moreno Carreras.
	Fecha de creacion: 26-11-20. Fecha de ultima modificacion: 26-11-20.
	*/
    $title = "PI - Página de Albumes";
    $idbody = "id=misfotos";
    include "head.php";
    setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
   // session_start();
    if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
    		//Iniciamos llamada a la base de datos
    		include "article.php";
			include "footer.php";
    }else{
    	//si no existe cookie o sesion de usuario redirecciona a la pagina principal
    	$host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = './';
        header("Location: http://$host$uri/$extra");
        exit;
    }

    ?>