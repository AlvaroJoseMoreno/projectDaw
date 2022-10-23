<?php
/*
En este fichero se muestra la pagina para que cada usuario vea su album privado (uno de los que tenga), todas sus fotos del album, el intervalo de la fecha mas reciente y mas antigua y los paises de donde se han tomado las fotos.
@authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
Fecha de creacion: 1-12-2020. Fecha de ultima modificacion: 1-12-20
Ultima modificacion: 6-12-20. Anyadir boton para la pagina de anyadir foto a album
*/
$title = "PI - Pagina de álbum privado";
session_start();
setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
   // session_start();
    if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
    	//hacemos split de la url para conseguir el numero de id del album
    	$url= $_SERVER["REQUEST_URI"];
		$split = explode('=', $url);
		$i = $split[1];
		include "conexionbd.php";
		//vamos a hacer una select para comprobar que ese album es del usuario que esta buscando
		$consultauser = '';
		if(isset($_COOKIE['usuario'])){
			$consultauser = "SELECT * FROM albumes a where a.Usuario = {$_COOKIE['idUsu']}";
		}
		else{
			$consultauser = "SELECT * FROM albumes a where a.Usuario = {$_SESSION['idUsu']}";
		}
		$resultadoConsultaUser = @mysqli_query($link, $consultauser);
		$encontrado = false;
		//aqui comprobamos que el usuario de la sesion o la cookie, sea duenyo del album al que vamos a intentar acceder a la parte privada, si no lo es, el programa nos devolvera a la pagina del menu de usuario
		while($filaConsultaUser = mysqli_fetch_array($resultadoConsultaUser)){
			if((isset($_SESSION['usuario']) && $filaConsultaUser['Usuario'] == $_SESSION['idUsu'] && $filaConsultaUser['IdAlbum'] == $i) || (isset($_COOKIE['usuario']) && $filaConsultaUser['Usuario'] == $_COOKIE['idUsu'] && $filaConsultaUser['IdAlbum'] == $i)){
				$encontrado = true;
				break;
			}
		}
		if($encontrado == false){
			$host = $_SERVER['HTTP_HOST'];
	        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	        $extra = 'user.php';
	        header("Location: http://$host$uri/$extra");
	        exit;
		}

		include "head.php";
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
		//si es mas de uno realizamos un bucle con
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
		echo "<p>Añade una foto al álbum pinchando en el siguiente botón:</p>";
		if(isset($_COOKIE['idUsu'])){
	       echo "<form action=\"anyadirFoto.php?usuario={$_COOKIE['idUsu']}\" method=\"post\">";
	    }
	    else if(isset($_SESSION['idUsu'])){
	       echo "<form action=\"anyadirFoto.php?usuario={$_SESSION['idUsu']}\" method=\"post\">";
	    }
        echo <<<hereDOC
        	<p><input type="submit" class="button" name="titleAlbum" value="{$filaAlbum['Titulo']}"></p>
        </form>
hereDOC;
		echo "</section>";
		echo "<main id=\"mainart\">";
		include "article.php";
		echo "</main>";
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
include "footer.php";
?>