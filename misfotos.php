<?php
/*
En esta pagina mostramos las fotos pertenecientes al usuario en una tabla, con su id, el album al que pertenecen y su descripcion.
@authors: Alejandro Alcaraz Sanchez y Alvaro Jose Moreno Carreras.
Fecha de creacion: 30-11-20. Fecha de ultima modificacion: 1-11-20, motivo: hacer consulta select de forma correcta
*/
$title = "PI - Pagina de ver mis fotos";
$idbody = "id=misfotos";
include "head.php";
 setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
   // session_start();
    if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
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