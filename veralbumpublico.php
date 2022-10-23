<?php
/*
En este fichero se muestra la pagina para que cada usuario vea cualquier album que no sea suyo (uno de los que tenga), todas sus fotos del album, el intervalo de la fecha mas reciente y mas antigua y los paises de donde se han tomado las fotos.
@authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
Fecha de creacion: 1-12-2020. Fecha de ultima modificacion: 1-12-20
*/
$title = "PI - Página del album";
$idbody = "id=veralbumpublico";
include "head.php";
if(isset($_COOKIE['usuario']) || (isset($_SESSION['usuario']))){
$url= $_SERVER["REQUEST_URI"];
$split = explode('=', $url);
$i = $split[1];
//en esta sentencia vamos a mostrar el titulo del album
$sentenciaA= "SELECT * from albumes a where a.idAlbum={$i}";
$resultadoA = @mysqli_query($link, $sentenciaA);
$filaAlbum = mysqli_fetch_array($resultadoA);

//vamos a conseguir la foto tomada en la fecha mas temprana del album
$sentenciaB = "SELECT * from fotos f where  f.Album = {$i} AND f.Fecha =(select MIN(f.Fecha) from fotos f where f.Album = {$i})";
$resultadoB = @mysqli_query($link, $sentenciaB);
$filaFotoAnterior = mysqli_fetch_assoc($resultadoB);
//echo "resultado ".$filaFotoAnterior['Fecha'];

/*while($fila = mysqli_fetch_assoc($resultado2)){
	echo "resultado ".$fila['Fecha'];
}*/

//vamos ha realizar una consulta para conseguir la foto tomada en la fecha mas posterior perteneciente al album
$sentenciaC = "SELECT * from fotos f where  f.Album = {$i} AND f.Fecha =(select MAX(f.Fecha) from fotos f where f.Album = {$i})";
$resultadoC = @mysqli_query($link, $sentenciaC);
$filaFotoPosterior = mysqli_fetch_assoc($resultadoC);
//echo "resultado ".$filaFotoPosterior['Fecha'];
$numFilas2 = mysqli_num_rows($resultadoB);

//si el album esta vacio, muestra un titulo diciendo que esta vacio
if($numFilas2 == 0){
	echo "<h2>Este album esta vacio</h2>";
	include "footer.php";
}
//si no muestra todos sus datos
else{

	$fechaSplit = explode("-", $filaFotoAnterior['Fecha']);
	$fecha = $fechaSplit[2] . "-" .$fechaSplit[1] ."-".$fechaSplit[0];
	$fechaSplit2 = explode("-", $filaFotoPosterior['Fecha']);
	$fecha2 = $fechaSplit2[2] . "-" .$fechaSplit2[1] ."-".$fechaSplit2[0];
echo <<<hereDOC
	<section class="solicitar">
	<h2> Página del álbum {$filaAlbum['Titulo']} </h2>
	<p>{$filaAlbum['Descripcion']}</p>
	<p>La fecha mas temprana de una foto de este álbum es: {$fecha} y la fecha de la foto que más tarde se tomó es: {$fecha2}</p>
hereDOC;
//vamos a realizar una consulta para extraer los paises de donde han sido tomadas las fotos del album eliminando los duplicados.
$sentenciaPais = "SELECT Distinct p.NomPais from paises p join fotos f on f.Pais = p.idPais AND f.Album = {$i}";
$resultadoPais = @mysqli_query($link, $sentenciaPais);
//numfilas devuelve el numero de filas en la consulta de sentenciapais
$numFilas = mysqli_num_rows($resultadoPais);
echo "<p> Los paises del álbum donde se han tomado fotos son: ";
//si el numero de paises es solo uno lo imprimimos sin mas
if($numFilas <=1){
	$filaPais = mysqli_fetch_assoc($resultadoPais);
	echo $filaPais['NomPais'];
}
//si es mas de uno realizamos un bucle con los paises y en caso de que el pais no sea el ultimo, se imprime con una coma al lado, si no es el ultimo se imprime solo
else{
	$x = 0;
	while($filaPais = mysqli_fetch_assoc($resultadoPais)){
		if($x < $numFilas-1){
	 		echo $filaPais['NomPais']. ", ";
		}
		else if($x == $numFilas-1){
			echo $filaPais['NomPais'];
		}
	 	$x = $x + 1;
	}
}
echo ".</p>";
echo "</section>";
echo "<main id=\"mainart\">";
include "article.php";
echo "</main>";
include "footer.php";
}
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