<?php
/*
En esta pagina se muestran los datos (titulo y descripcion) que el usuario ha metido al crear un nuevo album.
@authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
Fecha de creacion: 4-12-2020. Fecha de ultima modificacion: 4-12-2020
*/
	setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
    $title = "PI - Página de respuesta de album";
    $idbody = "id=respsol";
	include "head.php";
	//comprobamos que exista sesion de usuario o cookie
if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
	echo "<h2>Página de respuesta de álbum</h2>";
	//comprobamos que haya un parametro valido y que se escriban cosas validos en el
	if(isset($_POST["titulo"]) && $_POST["titulo"] !="\t" && $_POST["titulo"] !="" && $_POST["titulo"] !=" "){
		$title = $_POST["titulo"];
	}
	else{
		//si no nos lleva a la pagina de crear album
		$host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'newalbum.php';
        header("Location: http://$host$uri/$extra");
        exit;
	}
	//comprobamos que el parametro de descripcion sea valido, si no nos lleva a la pagina de crear album
	if(isset($_POST["descripcion"]) && $_POST["descripcion"] !="\t" && $_POST["descripcion"] !="" && $_POST["descripcion"] !=" "){
		$descripcion = $_POST["descripcion"];
	}
	else{
		//si no nos lleva a la pagina de crear album
		$host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'newalbum.php';
        header("Location: http://$host$uri/$extra");
        exit;
	}
	//comprobamos si hay cookie o sesion y realizamos la sentencia de insercion en la base de datos
	if(isset($_COOKIE['idUsu'])){
        $sentencia = "INSERT INTO albumes Values (NULL,'$title', '$descripcion',{$_COOKIE['idUsu']})";

         $idUsuario= $_COOKIE['idUsu'];
          $estructura = "./imagenes/fotos/{$_COOKIE['idUsu']}/";

    }
    else if(isset($_SESSION['idUsu'])){
        $sentencia = "INSERT INTO albumes Values (NULL,'$title', '$descripcion',{$_SESSION['idUsu']})";
          $estructura = "./imagenes/fotos/{$_SESSION['idUsu']}/";
          $idUsuario= $_SESSION['idUsu'];
    }
    if(!mysqli_query($link, $sentencia)){
		die("Error: no se pudo realizar la inserción");
    }

    $senId= " SELECT  idAlbum from albumes where Titulo='{$_POST["titulo"]}' and Descripcion='{$_POST["descripcion"]}' and usuario= {$idUsuario} ";
    $resp= mysqli_query($link,$senId);
    $IdAlbum= @mysqli_fetch_array($resp);

    $estructura = $estructura.$IdAlbum[0];

// Para crear una estructura anidada se debe especificar
// el parámetro $recursive en mkdir().


if(!mkdir($estructura, 0777, true)) {
die("Carpeta ya existe");
}
//sleep(20);
	echo <<<hereDOC
    <section>
        <h2>{$title}</h2>
        <p><b>Descripcion: </b>{$descripcion}</p>
        <p>Gracias por confiar en nosotros, un saludo. Atentamente, PI: Pictures & Images</p>
hereDOC;
		//ponemos un input para anyadir una foto en la pagina tras haber realizado la creacion de un album de forma correcta.
		if(isset($_COOKIE['idUsu'])){
	       echo "<form action=\"anyadirFoto.php?usuario={$_COOKIE['idUsu']}\" method=\"post\">";
	    }
	    else if(isset($_SESSION['idUsu'])){
	       echo "<form action=\"anyadirFoto.php?usuario={$_SESSION['idUsu']}\" method=\"post\">";
	    }
        echo <<<hereDOC
        	<p>Sube una foto al album que acabas de crear si quieres:</p>
        	<p><input type="submit" class="button" name="titleAlbum" value="{$title}"></p>
        </fom>
    </section>
hereDOC;
	include "footer.php";
}
else{
		//si no hay sesion ni cookie nos lleva a la pagina principal
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = './';
        header("Location: http://$host$uri/$extra");
        exit;
}
/*
   if(isset($_COOKIE['idUsu'])){
            $sentencia = 'SELECT * FROM usuarios where idUsuario='.$_COOKIE['idUsu'];
        }
        else if(isset($_SESSION['idUsu'])){   
            $sentencia = 'SELECT * FROM usuarios where idUsuario='.$_SESSION['idUsu'];
        }
*/


?>