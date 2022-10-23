<?php
	/*
	Aqui establecemos la conexion con la base de datos, para extraer sus valores
	@authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
	Fecha de creacion: 28-11-20, Fecha de modificacion: 28-11-20
	*/
	$link = @mysqli_connect('localhost', 'root', '', 'pibd'); 
			if(!$link) {
			echo "<p>Error al conectar con la base de datos: ";  mysqli_connect_error();
			echo '</p>';
			exit;
			}
?>