<?php
	/*
		En este fichero se procede a la eliminacion de una cuenta de la base de datos, asi como los albumes y fotos que tenga asociado el usuario.
		@authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
    	Fecha de creacion: 9-12-2020
	*/

    	if(isset($_COOKIE['usuario'])==false){
    		session_start();
		}

		setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
	   // $title = "PI - Página de usuario";
	  //  $idbody = "id = user";
	//	include "head.php";
	    include "conexionbd.php";
	    $idUser = -1;
	    if(isset($_COOKIE['usuario'])){
	        $idUser = $_COOKIE['isUsu'];
	    }
	    else if(isset($_SESSION['usuario'])){
	        $idUser = $_SESSION['idUsu'];
    	}
       // $keyHash= password_hash($_POST["passConf"]), PASSWORD_DEFAULT); 
    	$selectUsuario = "SELECT * FROM usuarios u where u.idUsuario = $idUser";
    	$resultadoUsuario = @mysqli_query($link, $selectUsuario);
    	$filaUsuario = mysqli_fetch_assoc($resultadoUsuario);

    	if(password_verify($_POST["passConf"],$filaUsuario['Clave'])){
			$sentenciaAlbums = "SELECT * from albumes a where a.Usuario = $idUser";
            $resultadoAlbums = @mysqli_query($link, $sentenciaAlbums);
            while($filaAlbums = mysqli_fetch_assoc($resultadoAlbums)){
                $sentenciaFotos = "SELECT * from fotos f where f.Album = {$filaAlbums['IdAlbum']}";
                $resultadoFotos = @mysqli_query($link, $sentenciaFotos);
                    while($filaFotos = mysqli_fetch_assoc($resultadoFotos)){
                    	$idalbum = $filaAlbums['IdAlbum'];
                    	$DELETEfotos = "DELETE FROM fotos where fotos.IdFoto = {$filaFotos['IdFoto']}";
                    	if(!mysqli_query($link, $DELETEfotos)){
           		  		     die("Error: no se pudo realizar el borrado de foto");
            	  	 	}	
                    
                    }

                 $DELETEalbum = "DELETE FROM albumes where albumes.IdAlbum = {$filaAlbums['IdAlbum']}";       
            	 if(!mysqli_query($link, $DELETEalbum)){
           		     die("Error: no se pudo realizar el borrado de album");
            	 }
            }   
    		$DELETEuser = "DELETE FROM usuarios where usuarios.idUsuario = $idUser";
    		if(!mysqli_query($link, $DELETEuser)){
           		 die("Error: no se pudo realizar el borrado de album");
            }
            $dir = "./imagenes/fotos/{$idUser}/";

          //$dir = 'samples' . DIRECTORY_SEPARATOR . 'sampledirtree';
          $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
          $files = new RecursiveIteratorIterator($it,
                RecursiveIteratorIterator::CHILD_FIRST);
            foreach($files as $file) {
                if ($file->isDir()){
                    rmdir($file->getRealPath());
                 } else {
                unlink($file->getRealPath());
                 }
            }
    rmdir($dir);

    		include "exit.php";
    	}
    	else{
    		$host = $_SERVER['HTTP_HOST'];
	        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	        $extra = 'user.php?afssffasfsaContrasedsaaAntigudsaIncodsarrecta';
	        header("Location: http://$host$uri/$extra");
	        exit;
    	}
?>