<?php
 /*
	En este fichero se realiza la redireccion para mostrar el mensaje modal que le pide al usuario la confirmación de borrado de cuenta.
	@authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
	Fecha de creacion de fichero: 9-12-2020.
 */		if(!isset($_COOKIE['BorrarUsu'])){
			setcookie("BorrarUsu", "borrar", time() + 1*60);
		}
		$host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'user.php?afsafaasfsaafsDeleteadasfsaUserafsaff';
        header("Location: http://$host$uri/$extra");
        exit;
?>