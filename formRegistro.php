<?php
/*
	En este fichero aislamos el formulario de registro y el de editar datos ya que la mayoria de elementos entre ellos dos son comunes
	@authors: Alejandro Alcaraz Sanchez y Alvaro Jose Moreno Carreras
	Fecha de creacion: 7-12-20.
*/
		echo "<section>";
		if(strpos($url, 'registro')){
			echo "<h2>Registro de usuario</h2>";
			echo "<p>Rellena el formulario registro de usuario, los campos con * son obligatorios.</p>";
		}
		else{
			echo "<h2>Editar datos de usuario</h2>";
			echo "<p>Rellena el formulario de edición de datos de usuario, los campos con * son obligatorios.</p>";
		}
		echo "<form id=\"datosusu\" action=\"editarRes.php\" method=\"POST\" enctype=\"multipart/form-data\"> ";	
		echo <<<hereDOC
			<p class="text">
				<label for="nombre">Nombre*: </label>
				<input placeholder="Nombre" type="text" id="nombre" name="nombre" autofocus>
			</p>
hereDOC;
		if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
			echo "<label for=\"nombre\">Nombre actual: {$fila['NomUsuario']} </label>";
		}
echo <<<hereDOC
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
				<input placeholder="email" type="text" id="correo" name="mail">
			</p>
hereDOC;
		//se comprueba que hay un usuario logueado y mostramos el valor actual
		if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
		echo "<label for=\"nombre\">Email actual: {$fila['Email']} </label>";
		}
echo <<<hereDOC
			<p class="text">
				<label for="sexo">Sexo*: (H o M)</label>
				<input placeholder="sexo" type="text" id="sexo" name="sexo" title="H - Hombre, M - mujer">
			</p>
hereDOC;
		if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){		
			if($fila['Sexo'] == 0)
				echo "<label for=\"nombre\">Sexo: Hombre </label>";
			else
				echo "<label for=\"nombre\">Sexo: Mujer </label>";
		}
echo <<<hereDOC
			<p class="text">
			   <label for="fecha">Fecha de nacimento*: </label>
			   <input placeholder="Formato: dd-mm-yyyy" type="text" id="fecha" name="fecha">
			</p>
hereDOC;
		if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
			$split = explode('-', $fila['FNacimiento']);
			$fechaCorregida = $split[2] . "-". $split[1] . "-" . $split[0];
			echo "<label for=\"fecha\">Fecha de nacimiento actual: {$fechaCorregida}</label>";
		}
		echo <<<hereDOC
			<p class="text">
			   <label for="ciudad">Ciudad: </label>
			   <input placeholder="Ciudad" type="text" id="ciudad" name="ciudad">
			</p>
hereDOC;
		if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
			echo "<label for=\"nombre\">Ciudad actual: {$fila['Ciudad']} </label>";
		}
	echo <<<hereDOC
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
				<label  id="fotperf" for="foto"><img src="imagenes/usuarios/usuario.jpg" alt="perfil"></label>
                <input onchange="cargarFoto(this);"  style="display: none;"  id="foto" type="file" name="foto">
                <label id="busfot" for="foto">Buscar Foto</label>
			</p>
hereDOC;
	if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
		echo "<p>Foto actual:</p>";
		echo "<img id=\"foto\" style=\"margin-top: -15px;\" src=\"imagenes/fotos/{$fila['idUsuario']}/{$fila['Foto']}\" alt=\"perfil\">";
	echo "<h2 for=\"passcon\">Marca la contraseña actual para poder modificar los datos*: </h2>";
	echo "<p class=\"text\"><input style=\"margin-right: auto;margin-left: auto;\" placeholder=\"contraseña actual\" type=\"password\" id=\"passcon\" name=\"passConf\"></p>";

	}

echo <<<hereDOC
			<p id="values">
				<input class= "formu" id="enviar" type="submit" name="Enviar" value="Enviar">
				<input class= "formu"  type="reset" name="restablecer">
			</p>
		</form>	
	</section>
hereDOC;

?>


