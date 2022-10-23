<?php
/*
En esta pagina se muestran los datos de la imagen que se va a subir a un album.
@authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez.
Fecha de creacion: 7-12-20.
*/
session_start();
setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
    $title = "PI - Página de respuesta de añadir foto";
    $idbody = "id = respsol";
	include "conexionbd.php";

		$usuarioDeSesion = -1;
		if(isset($_COOKIE['usuario'])){
			$usuarioDeSesion = $_COOKIE['idUsu'];
		}
		else{
			$usuarioDeSesion = $_SESSION['idUsu'];
		}
	
		
		if(isset($_POST['titulo'])){
			if($_POST['titulo'] != "" && $_POST['titulo'] != "\t" && $_POST['titulo'] != " "){
				$titulo = $_POST['titulo'];
			}
		}
		if(isset($_POST['descripcion'])){
			if($_POST['descripcion'] != "" && $_POST['descripcion'] != "\t" && $_POST['descripcion'] != " "){
				$descripcion = $_POST['descripcion'];
			}
		}
		if(isset($_POST['fecha'])){
			if($_POST['fecha'] != "" && $_POST['fecha'] != "\t" && $_POST['fecha'] != " "){
				$fecha = $_POST['fecha'];
			}
		}	
		if(isset($_POST['alt'])){
			if($_POST['alt'] != "" && $_POST['alt'] != "\t" && $_POST['alt'] != " "){
				$alt = $_POST['alt'];
			}
		}
		if(isset($_POST['pais'])){
			if($_POST['pais'] != "" && $_POST['pais'] != "\t" && $_POST['pais'] != " "){
				$pais = $_POST['pais'];
			}
		}
		if(isset($_POST['album'])){
			if($_POST['album'] != "" && $_POST['album'] != "\t" && $_POST['album'] != " "){
				$album = $_POST['album'];
			}
		}
		if(isset($_FILES['foto']['name'])){
			
				$foto = $_FILES['foto']['name'];
			
		}

		if(strlen($alt) <11){
			$host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = "anyadirFoto.php?usuario={$usuarioDeSesion}&falseafsasfsaaltasadsanotafdssfslength";
            header("Location: http://$host$uri/$extra");
            exit;
		}
		if(isset($alt)){
			if(substr($alt, 0, 4) == "foto" || substr($alt, 0, 4) == "Foto" || substr($alt, 0, 6) == "imagen"
			|| substr($alt, 0, 6) == "Imagen" || substr($alt, 0, 11) == "Esta imagen" || substr($alt, 0, 11) == "esta imagen" || substr($alt, 0, 9) == "Esta foto"){
				$host = $_SERVER['HTTP_HOST'];
	            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	            $extra = "anyadirFoto.php?usuario={$usuarioDeSesion}&sufdssafsaeadadwadwwaeadsdadsa";
	            header("Location: http://$host$uri/$extra");
	            exit;
			}
		}
	include "head.php";
	echo "<section><h2>Pagina de respuesta de añadir foto al album: {$album}</h2>";

	$idalbum = '';
	$idpais = '';
	if(isset($descripcion)){
		echo "<p>Descripción del álbum: {$descripcion}</p>";
	}
	if(isset($fecha)){
		$consFecha = explode('-', $fecha);
		$fecha2 = $consFecha[2] .'-'. $consFecha[1] . '-' . $consFecha[0];
		echo "<p>La foto se hizo: {$fecha2}</p>";
	}
	if(isset($alt)){
		echo "<p>El texto alternativo es: {$alt}</p>";
	}
	if(isset($pais)){
		$selectPais = "SELECT * FROM paises p where p.NomPais = '{$pais}'";
		$resultadoPais = @mysqli_query($link, $selectPais);
		$filaPais = mysqli_fetch_assoc($resultadoPais);
		$idpais = $filaPais['idPais'];
		echo "<p>La foto se tomo en: {$pais}</p>";
	}
	if(isset($album)){
		$selectAlbums = "SELECT * FROM albumes a where a.Titulo = '{$album}'";
		$resultadoAlbum = @mysqli_query($link, $selectAlbums);
		$filaAlbum = mysqli_fetch_assoc($resultadoAlbum);
    	$idalbum = $filaAlbum['IdAlbum'];
		echo "<p>La foto se ha subido al album: {$album}</p>";
	}
	if(isset($foto)){
		echo "<p>La foto que se ha subido es: {$foto}</p>";
	}
	echo "</section>";
	$fichero= $_FILES["foto"]["name"];


	$insertarFoto = "INSERT INTO fotos VALUES (NULL,'$titulo', '$descripcion','$fecha',$idpais,$idalbum,'".$fichero."','$alt',NULL)";

	if(!mysqli_query($link, $insertarFoto)){
		die("Error: no se pudo realizar la inserción");
    }

    include "subidaFoto.php";
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