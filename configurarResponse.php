<?php

/*
	En esta pagina se gestiona el estilo del usuario que selecciona en la pagina "configurar estilo".
	@authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
	Fecha de creacion: 5-12-20. Fecha de ultima modificacion: 5-12-20.
*/

	session_start();
    include 'conexionbd.php';

    if(isset($_POST['drone'])){
    	$sentencia = 'SELECT * FROM usuarios';
        $resultado = @mysqli_query($link, $sentencia);
        $sentenciaEstilo = "SELECT * FROM estilos";
        $resultadoEstilo = @mysqli_query($link, $sentenciaEstilo);

        $booleanEncon = false;
        //comprobamos que haya cookie o sesion.
        if(isset($_COOKIE['idUsu'])){
        	//recorremos los usuarios hasta dar con el usuario que esta loguedo
        	while($fila = mysqli_fetch_assoc($resultado)) {
        		if($fila['idUsuario']==$_COOKIE['idUsu']){
        			//despues se recorren los estilos
        			while($filaEstilos = mysqli_fetch_assoc($resultadoEstilo)){
        				//aqui tenemos el estilo que el usuario ha seleccionado
			        	if($filaEstilos['Fichero'] == $_POST['drone']){
			        		//se realiza la sentencia de modificacion
			        		$sentenciaModAlbum = "UPDATE usuarios u set u.Estilo = {$filaEstilos['idEstilo']} where u.idUsuario = {$_COOKIE['idUsu']}";
			        			//cortamos el bucle
			        			$booleanEncon = true;
			        			break;
			        	}
			    	}
        		}
        	}
        }
        else if(isset($_SESSION['idUsu'])){
        	while($fila = mysqli_fetch_assoc($resultado)) {
        		if($fila['idUsuario']==$_SESSION['idUsu']){
        			while($filaEstilos = mysqli_fetch_assoc($resultadoEstilo)){
			        	if($filaEstilos['Fichero'] == $_POST['drone']){
			        		$sentenciaModAlbum = "UPDATE usuarios u set u.Estilo = {$filaEstilos['idEstilo']} where u.idUsuario = {$_SESSION['idUsu']}";
			        			$booleanEncon = true;
			        			break;
			        	}
			    	}
        		}
        	}
        }
        //comprobamos que la sentencia no de error
        if(!mysqli_query($link, $sentenciaModAlbum))
			die("Error: no se pudo realizar la modificacion");
		//si se ha realizado la modificacion, se redirige la web a configurar y muestra un mensaje modal
		if($booleanEncon){
			$host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'configurar.php?trueadasffs3cambio042353WEestiloREWFFDexitoSSF';
            header("Location: http://$host$uri/$extra");
            exit;
		}
    }   
    else{
    	$host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = './';
        header("Location: http://$host$uri/$extra");
    	exit;
    }     


?>