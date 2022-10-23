<?php

	/*
		En esta pagina mostramos un formulario con el que crearemos un nuevo album.
		@authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
		Fecha de creacion: 16-11-20. Ultima modificacion: 17-11-20, motivo: crear la redireccion hacia la pagina principal en caso de un usuario no logueado intente acceder.
	*/
	$title = "PI-Crear Nuevo Albúm";
	$idbody = "id = nuevoalbum";
	include "head.php";
	setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
echo <<<hereDOC
<h2>Página Nuevo Album</h2>
<section>
<h2>Introducir información:</h2>
	<form action="respuestaAlbum.php" method="POST" >
				<p class="text">
					<label for="nombre">Titulo: </label>
					<input placeholder="Nombre" type="text" id="nombre" name="titulo" autofocus>
				</p>
				<p class="text">
                    <label for="area">Descripción: </label>
                    <textarea placeholder="Descripción del álbum" name="descripcion" id="area" maxlength="4000"></textarea>
                    </p>		
                <p id="values">
				<input class= "formu" id="enviar" type="submit" name="Enviar" value="Enviar">
				</p>
</section>	
hereDOC;
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