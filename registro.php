<?php
	/*
	En esta pagina se encuentra el formulario de registro de la web. Fecha de creacion: 22-9-20
	@authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
	Fecha de ultima modificacion: 26-11-20, Motivo: modificar el select con los paises de la base de datos.
	*/
	$title = "PI-Página para registrarse en la web";
	$idbody = "id=registro";
	include "head.php";
	if(!isset($_COOKIE['usuario']) && !isset($_SESSION['usuario'])){
			//aqui tenemos la url de respuesta a una solicitud de registro en la que el registro no ha sido satisfactorio
			$url= $_SERVER["REQUEST_URI"];
            $split = explode('?', $url);
            $i = $split[count($split)-1];
            if($i=="adfsgdfdPSOSKFEjERIWOq)102924"){
                 echo "<div id=\"capafondo\"><article id=ar><h2>Registrarse</h2><p>Campos sin rellenar</p><footer><button class=\"button\"onclick=cerrarMensajeModal();>cerrar</button></footer></article></div>";
            }
            if($i=="adfsgdfdPSOSKFEjcomproerror"){
				

            	 echo "<div id=\"capafondo\"><article id=ar><h2>Registro</h2>".$_COOKIE['error']."<footer>
                <form action=\"registro.php\">
                    <input type=\"submit\" class=\"button\" value=\"cerrar\">
                </form>
                </footer></article></div>";
            
            }
	include "formRegistro.php";
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
	<!--
onblur="fechaNacimiento();"onchange="cargarFoto(this);"
onsubmit="return comprobarRegistro();"onblur="return comprobarPass();" onblur="return comprobarPass();"


 /*   echo <<<hereDOC
	<section>
		<h2>Registro</h2>
		<p>Rellena el formulario de registro, los campos con * son obligatorios.</p>
		<form action="registroRes.php" method="POST" >
			<p class="text">
				<label for="nombre">Nombre*: </label>
				<input placeholder="Nombre" type="text" id="nombre" name="nombre" autofocus>
			</p>
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
			<p class="text">
				<label for="sexo">Sexo*: </label>
				<input placeholder="sexo" type="text" id="sexo" name="sexo" title="H - Hombre, M - mujer">
			</p>
			<p class="text">
			   <label for="fecha">Fecha de nacimento*: </label>
			   <input  type="date" id="fecha" name="fecha">
			</p>
			<p class="text">
			   <label for="ciudad">Ciudad: </label>
			   <input placeholder="Ciudad" type="text" id="ciudad" name="ciudad" >
			</p>
			<p class="text"><label for="pais">Pais residencia: </label>
			   <select  id="pais" name="pais">
hereDOC;
//aqui devolvemos los paises de la base de datos y los mostramos como opciones en un select y con un option
$sentencia = 'SELECT * FROM paises';
$resultado = @mysqli_query($link, $sentencia);

while($fila = mysqli_fetch_assoc($resultado)){
    echo "<option>" .$fila['NomPais']. "</option>";
}
echo <<<hereDOC
			   </select>
			</p>
			<p>	<label>Foto: </label><br>
				<label id="fotperf" for="foto"><img src="imagenes/usuarios/unnamed.jpg" alt="perfil"></label>
                <input  style="display: none;" id="foto" type="file" name="foto" accept="image/*" >
                <label id="busfot" for="foto">Buscar Foto</label>
			</p>
			<p id="values">
				<input class= "formu" id="enviar" type="submit" name="Enviar" value="Enviar">
				<input class= "formu"  type="reset" name="restablecer">
			</p>
		</form>	
	</section>
hereDOC;*/


-->