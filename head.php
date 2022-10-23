<?php

/*En esta pagina se encuentra la cabecera de la web, que se incluye al principio de cada pagina ya que es comun para todos los usuarios
@authors: Alejandro Alcaraz Sanchez y Alvaro Jose Moreno Carreras
Fecha de creacion: 6-11-20, Fecha de ultima modificacion: 30-11-20, para cambiar los estilos que usara el usuario*/

if(isset($_SESSION['usuario'])==false && !isset($_COOKIE['usuario'])){
    @ob_start();
    session_start();
}
//incluimos el fichero con la conexion a base de datos
include "conexionbd.php";
?> 
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
<?php 
//session_start();

//segun haya cookies o sesiones, y segun el usuario tenga asignado un estilo u otro se mostraran sus ficheros.
if(isset($_COOKIE['usuario'])==false && (isset($_SESSION['usuario'])==false)){
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/index.css\">";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/formulario.css\">";
	}
	if(isset($_COOKIE['usuario'])){
	$senEst= "SELECT * from estilos e, usuarios u where e.idEstilo= u.Estilo and u.idUsuario=".$_COOKIE['idUsu'] ;
		$resultadoFot = @mysqli_query($link, $senEst);
		$fila = mysqli_fetch_array($resultadoFot);
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/index.css\">";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/formulario.css\">";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/".$fila['Fichero']."\">";
	}
	else if(isset($_SESSION['usuario'])){	
		$senEst= "SELECT * from estilos e, usuarios u where e.idEstilo= u.Estilo and u.idUsuario=".$_SESSION['idUsu'];
		$resultadoFot = @mysqli_query($link, $senEst);
		$fila = mysqli_fetch_array($resultadoFot);
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/index.css\">";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/formulario.css\">";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/".$fila['Fichero']."\">";				
	}
?>
	<!--<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/formulario.css">
	<link rel="alternate stylesheet" type="text/css" href="css/nocheindex.css" title="noche">
	<link rel="alternate stylesheet" type="text/css" href="css/impresion.css" title="impresio">
	
	<link rel="alternate stylesheet" type="text/css" href="css/altocontraste.css" title="altocontraste">
	<link rel="alternate stylesheet" type="text/css" href="css/bigfontindex.css" title="texto grande">
	<link rel="alternate stylesheet" type="text/css" href="css/accesible.css" title="accesible">-->
	<link rel="stylesheet" type="text/css" href="css/impresion.css" media="print"/>
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/fontello.css">
    <script src="js/codigo.js"></script>
	<title><?php echo $title; ?></title>
</head>
<?php
if(isset($_COOKIE['fechahora'])){
	setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
}
if(isset($idbody))
  echo "<body {$idbody}>";
else
	echo "<body>";
	$raiz = $_SERVER['DOCUMENT_ROOT'];  
	$url= $_SERVER["REQUEST_URI"];
	echo "<header id=main-header>";
	//	if(!(strpos($url, '.php')) || (strpos($url, 'index.php')!= false) || (strpos($url, 'registro')!= false)){
        	echo "<p><a href=./><img src=imagenes/logotipo.png alt=\"Logo Web\"></a> </p>";
	//	}
      //  else{
 		//	echo "<p><a href=indexlogin.php><img src=imagenes/logotipo.png alt=\"Logo Web\"></a> </p>";
     //   }

 		if(!(strpos($url, '.php')) || strpos($url, 'index')!= false){
	        echo "<form action=\"busqueda.php\" method=\"POST\">"; 
	        echo       "<a class=icon-search href=\"busqueda.php\"></a>";
	        echo       "<input type=\"search\" name=\"busearch\"  placeholder=\"búsqueda rápida\">";
	        echo "</form>";
    	}
    //	strpos($url, 'solicitaralbum');
    	
    //	if(strpos($url, 'indexlogin') || strpos($url, 'more') || strpos($url, 'solicitaralbum')|| 
    //		strpos($url, 'newalbum') || strpos($url, 'configurar')){
    	if(strpos($url, 'user') == false && (isset($_COOKIE['usuario']) || (isset($_SESSION['usuario'])))){
    		echo "<a href=user.php class=\"icon-user\"></a>";
    	}
    	//}
    	if(strpos($url, 'user')!= false){
    		echo "<h1>Perfil</h1>";
    	}
    		echo "</header>";
        ?>