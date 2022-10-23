<?php
	/*
	En esta pagina mostramos el formulario de modificicacion de los datos de usuario, con los datos actuales del usuario, excepto el password.
	@authors: Alejandro Alcaraz Sanchez y Alvaro Jose Moreno Carreras
	Fecha de creacion: 23-11-20: Fecha de ultima modificacion: 31-11-20
	*/
    $title = "PI - Datos del usuario";
    $idbody = "id=registro";
    include "head.php";
    setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
   // session_start();
    if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
    		//Iniciamos llamada

    		$url= $_SERVER["REQUEST_URI"];
            $split = explode('?', $url);
            $i = $split[count($split)-1];
            //este mensaje salta cuando hay un campo obligatorio vacio
            if($i=="adfsgdfdPSOSKFEjERIWOq)102924"){
                 echo "<div id=\"capafondo\"><article id=ar><h2>Editar datos</h2><p>Campos del formulario obligatorios sin rellenar</p><footer><button class=\"button\"onclick=cerrarMensajeModal();>cerrar</button></footer></article></div>";
            }
            //mensaje que salta cuando alguno de los campos obligatorios son erroneos.
            if($i == "adfsgdfdPSOSKFEjcomproerror"){
            	echo "<div id=\"capafondo\"><article id=ar><h2>Editar datos</h2>".$_COOKIE['error']."<footer><button class=\"button\"onclick=cerrarMensajeModal();>cerrar</button></footer></article></div>";
            }
            //mensaje que salta cuando el campo contraseña antigua esta vacia
            if($i == "adfsgdsadssDdddsfSDSasqSAAsSFEPSKGPJTH"){
            	echo "<div id=\"capafondo\"><article id=ar><h2>Editar datos</h2><p>El campo de contraseña antigua no ha sido rellenado</p><footer><button class=\"button\"onclick=cerrarMensajeModal();>cerrar</button></footer></article></div>";
            }
            //mensaje que salta cuando el campo de contraseña antigua es erroneo.
            if($i == "adfsgdsadSAAsSFEPSKGPJTHafssafafsassDdddsfSDSasq"){
            	echo "<div id=\"capafondo\"><article id=ar><h2>Editar datos</h2><p>La contraseña antigua no es correcta</p><footer><button class=\"button\"onclick=cerrarMensajeModal();>cerrar</button></footer></article></div>";
            }

		    	if(isset($_COOKIE['idUsu'])){
					$sentencia = 'SELECT * FROM usuarios where idUsuario='.$_COOKIE['idUsu'];
				}
				else if(isset($_SESSION['idUsu'])){	
					$sentencia = 'SELECT * FROM usuarios where idUsuario='.$_SESSION['idUsu'];
				}    	
			//mostramos error si falla la sentencia
			if(!($resultado = @mysqli_query($link, $sentencia))) {
				echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " .mysqli_error($link);
				echo '</p>';
				exit;
				}
				
		while($fila = mysqli_fetch_assoc($resultado)) {
			include "formRegistro.php";
		}	
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




<!--			echo <<<hereDOC
	<section>
		<h2>Editar datos de usuario</h2>
		<p>Rellena el formulario de edición de datos de usuario, los campos con * son obligatorios.</p>
		<form id="datosusu" action="registroRes.php" method="POST" >
			<p class="text">
				<label for="nombre">Nombre*: </label>
				<input placeholder="Nombre" type="text" id="nombre" name="nombre" autofocus>
			</p>
			<label for="nombre">Nombre actual: {$fila['NomUsuario']} </label>
			<p class="text">
				<label for="password">Password*: </label>
				<input  placeholder="contraseña" type="password" id="password" name="contraseña">
			</p>
			<p class="text">
				<label for="password1">Rep. Password*: </label>
				<input placeholder="repite contraseña" type="password" id="password1" name="contraseña2">
			</p>
			<p id="crearp"></p>
			<p class="text">
				<label for="correo">Email*: </label>
				<input placeholder="email" type="email" id="correo" name="mail">
			</p>
			<label for="nombre">Email actual: {$fila['Email']} </label>
			<p class="text">
				<label for="sexo">Sexo*: </label>
				<input placeholder="sexo" type="text" id="sexo" name="sexo" title="H - Hombre, M - mujer">
			</p>
hereDOC;
			if($fila['Sexo'] == 0)
				echo "<label for=\"nombre\">Sexo: Hombre </label>";
			else
				echo "<label for=\"nombre\">Sexo: Mujer </label>";
echo <<<hereDOC
			<p class="text">
			   <label for="fecha">Fecha de nacimento*: </label>
			   <input  type="date" id="fecha" name="fecha">
			</p>
			<label for="fecha">Fecha de nacimiento actual: {$fila['FNacimiento']}</label>
			<p class="text">
			   <label for="ciudad">Ciudad: </label>
			   <input placeholder="Ciudad" type="text" id="ciudad" name="ciudad">
			</p>
			<label for="nombre">Ciudad actual: {$fila['Ciudad']} </label>
			<p class="text"><label for="pais">Pais residencia: </label>
			   <select  id="pais" name="pais">
hereDOC;
//mostramos el select de paises
$sentencia = 'SELECT * FROM paises';
$resultado = @mysqli_query($link, $sentencia);

while($fila2 = mysqli_fetch_assoc($resultado)){
    echo "<option>" .$fila2['NomPais']. "</option>";
}
			echo   "</select>";
			echo "</p>";
		echo <<<hereDOC
			<p>	<label>Foto: </label><br>
				<label id="fotperf" for="foto"><img src="imagenes/usuarios/usuario.jpg" alt="perfil"></label>
                <input  style="display: none;" id="foto" type="file" name="foto" accept="image/*" >
                <label id="busfot" for="foto">Buscar Foto</label>
			</p>
			<p>Foto actual:</p>
				<img id="foto" style="margin-top: -15px;" src="imagenes/usuarios/{$fila['Foto']}" alt="perfil">
			<p id="values">
				<input class= "formu" id="enviar" type="submit" name="Enviar" value="Enviar">
				<input class= "formu"  type="reset" name="restablecer">
			</p>
		</form>	
	</section>
hereDOC;
-->

