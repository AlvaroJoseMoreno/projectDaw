<?php
/*
    En esta pagina mostramos el menu de usuario registrado, en el que saldran todas las acciones que puede realizar.
    @authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
    Fecha de creacion: 5-10-20, ultima modificacion: 1-12-20, Motivo: anyadir los enlaces al menu de configuracion de estilo, de anyadir foto a album y de ver los albumes
    Ultima modificacion: 9-12-2020, motivo: Anyadir mensaje modal para 
*/
if(isset($_COOKIE['usuario'])==false){
    session_start();
}

setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
    $title = "PI - Página de usuario";
    $idbody = "id = user";
	include "head.php";
    $idUser = -1;
    if(isset($_COOKIE['usuario'])){
        $idUser = $_COOKIE['isUsu'];
    }
    else if(isset($_SESSION['usuario'])){
        $idUser = $_SESSION['idUsu'];
    }


    $url= $_SERVER["REQUEST_URI"];
    $split = explode('?', $url);
    $i = $split[count($split)-1];
    //mostramos mensaje modal para borrar usuario
    if($i == "afsafaasfsaafsDeleteadasfsaUserafsaff"){
            $numFotos = 0;
            $sentenciaAlbums = "SELECT * from albumes a where a.Usuario = $idUser";
            $resultadoAlbums = @mysqli_query($link, $sentenciaAlbums);
            echo "<div id=\"capafondo\"><article id=ar><h2>Confirmación de eliminacion de cuenta</h2>
            <p>Si eliminas tu cuenta perderás lo siguiente:</p>";
            while($filaAlbums = mysqli_fetch_assoc($resultadoAlbums)){
                $fotosAlbum = 0;
                $sentenciaFotos = "SELECT * from fotos f where f.Album = {$filaAlbums['IdAlbum']}";
                $resultadoFotos = @mysqli_query($link, $sentenciaFotos);
                    while($filaFotos = mysqli_fetch_assoc($resultadoFotos)){
                        $numFotos +=1;
                        $fotosAlbum +=1;
                    }
                echo "<p>El álbum {$filaAlbums['Titulo']} y tiene {$fotosAlbum} fotos en él.</p>";    
            }   
                echo "<p>Un total de {$numFotos} fotos.</p><p>Pon la contraseña para eliminar el usuario</p>";
            echo "<footer><form action=\"eliminarCuenta.php\" method=\"POST\">
                    <p class=\"text\"><input style=\"margin-right: auto;margin-left: auto;\" placeholder=\"contraseña actual\" type=\"password\" id=\"passcon\" name=\"passConf\"></p>
                    <input type=\"submit\" class=\"button\" value=\"enviar\">
                </form>
                </footer></article></div>";
    }
    //cuando la contraseña antigua es incorrecta. 
    if($i == "afssffasfsaContrasedsaaAntigudsaIncodsarrecta"){
        setcookie("BorrarUsu",'',time()-42000);
        echo "<div id=\"capafondo\"><article id=ar><h2>Dar de baja cuenta</h2><p>La contraseña antigua no es correcta</p><footer><button class=\"button\"onclick=\"cerrarMensajeModal();\">cerrar</button></footer></article></div>";
    }
echo "<section>";
  if(isset($_COOKIE['idUsu'])){
            $sentencia = 'SELECT * FROM usuarios where idUsuario='.$_COOKIE['idUsu'];
        }
        else if(isset($_SESSION['idUsu'])){   
            $sentencia = 'SELECT * FROM usuarios where idUsuario='.$_SESSION['idUsu'];
        }
        $resultado = @mysqli_query($link, $sentencia);

   while($fila = mysqli_fetch_assoc($resultado)){  
    echo "<img id=\"foto\" style=\"height:200px; width:200px; border-radius:20px;\" src=\"imagenes/fotos/{$fila['idUsuario']}/{$fila['Foto']}\" alt=\"perfil\">"; 
        }

    //imprimimos el nombre del usuario logueado
    if(isset($_COOKIE['usuario'])){
        echo "<h2>{$_COOKIE['usuario']}</h2>";
    }
    else if(isset($_SESSION['usuario'])){
        echo "<h2>{$_SESSION['usuario']}</h2>";
    }
echo <<<hereDOC
    	<form action="datosUsu.php" method="POST">
			<input  class="user" type="submit" name="editperf" value="Editar Datos">
		</form>
    		<h3><a href="albumes.php">Mis Álbumes</a></h3>
hereDOC;
        //comprobamos que haya cookie o sesion, para al navegar a la pagina de anyadir foto a album, nos muestre en la url la id de usuario
       $resultado2 = @mysqli_query($link, $sentencia);
        while($fila2 = mysqli_fetch_assoc($resultado2)){
            echo "<h3><a href=\"anyadirFoto.php?usuario={$fila2['idUsuario']}\">Añadir foto a álbum</a></h3>";
        }
echo <<<hereDOC
    		<h3><a href="newalbum.php">Crear Álbum</a> </h3>
    		<h3><a href="solicitaralbum.php">Solicitar Álbum</a></h3>
            <h3><a href="configurar.php">Configurar estilo</a></h3>
    		<h3><a href="darDeBajaForm.php"> Darse de baja </a></h3>    		
    		<h3><a href="exit.php">Salir</a></h3>
    		<br> 
    		<br>
	</section>
hereDOC;
	include "footer.php";
}
else{
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = './';
        header("Location: http://$host$uri/$extra");
        exit;
}
?>