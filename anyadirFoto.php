<?php
/*
En esta pagina tenemos un formulario con el que insertaremos una foto en la base de datos.
@authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
Fecha de creacion: 24-11-20. Fecha de ultima modificacion: 29-11-20, Motivo: incluir el datalist de albumes y paises
Ultima modificacion: 6-12-20. si la pagina llega desde la del album privado, se muestra ese album en el select de albumes.
*/

session_start();
setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
    $title = "PI - Página de formulario de añadir foto";
    $idbody = "id = anyadir";
		include "conexionbd.php";
		//hacemos un split de url, para conseguir el numero de id del usuario
		$url= $_SERVER["REQUEST_URI"];
		$split = explode('=', $url);
		$i = $split[1];
		if(strpos($i, '&')){
			$split2 = explode('&', $i);
			$i = intval($split2[0]);
			if($split2[1] == "falseafsasfsaaltasadsanotafdssfslength"){
				echo "<div id=\"capafondo\"><article id=ar><h2>Añadir foto</h2><p>El campo texto alternativo debe incluir un minimo de 15 caracteres</p><footer><button class=\"button\"onclick=cerrarMensajeModal();>cerrar</button></footer></article></div>";
			}
			if($split2[1] == "sufdssafsaeadadwadwwaeadsdadsa"){
				echo "
				<div id=\"capafondo\"><article id=ar><h2>Añadir foto</h2><p>El campo texto alternativo no puede empezar por un texto redundante tal como \"foto\" o \"imagen\"</p><footer><button class=\"button\"onclick=cerrarMensajeModal();>cerrar</button></footer></article></div>";
			}	
		}
	//vamos a hacer una select para comprobar que el usuario que hay en la url es el que esta conectado
		$consultauser = '';
		if(isset($_COOKIE['usuario'])){
			$consultauser = "SELECT * FROM usuarios u where u.idUsuario = {$_COOKIE['idUsu']}";
		}
		else{
			$consultauser = "SELECT * FROM usuarios u where u.idUsuario = {$_SESSION['idUsu']}";
		}
		$resultadoConsultaUser = @mysqli_query($link, $consultauser);
		$encontrado = false;
		//aqui comprobamos que el usuario de la sesion o la cookie, sea el que esta entrando a la pagina, en caso contrario la pagina mandara al menu de usuario al usuario que esta intentando acceder erroneamente
		while($filaConsultaUser = mysqli_fetch_array($resultadoConsultaUser)){
			if((isset($_SESSION['usuario']) && $filaConsultaUser['idUsuario'] == $_SESSION['idUsu'] && $filaConsultaUser['idUsuario'] == $i) || (isset($_COOKIE['usuario']) && $filaConsultaUser['idUsuario'] == $_COOKIE['idUsu'] && $filaConsultaUser['idUsuario'] == $i)){
				$encontrado = true;
				break;
			}
		}
		if($encontrado == false){
			$host = $_SERVER['HTTP_HOST'];
	        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	        $extra = 'user.php';
	        header("Location: http://$host$uri/$extra");
	        exit;
		}

	include "head.php";
	echo <<<hereDOC
	<section>
		<h2>Añadir foto a Álbum</h2>
		<p>Rellena el formulario de de añadir foto a álbum, los campos con * son obligatorios.</p>
		<form action="respuestaAnyadirFoto.php" method="POST" enctype="multipart/form-data">
			

			<p class="text">
				<label for="titulo">Titulo*: </label>
				<input placeholder="Título de la foto" type="text" id="titulo" name="titulo" autofocus>
			</p>
			<p class="text">
                    <label for="area">Desc. Foto*: </label>
                    <textarea placeholder="Descripción de la foto" id="area" name="descripcion" maxlength="4000"></textarea>
            </p>
            <p class="text">
			   <label for="fecha">Fecha de foto*: </label>
			   <input  type="date" id="fecha" name="fecha">
			</p>
			<p class="text">
				<label for="alt">Texto alt.*: </label>
				<input placeholder="texto alternativo" type="text" id="alt" name="alt">
			</p>
			<p class="text"><label for="pais">Pais de la foto: </label>
			   <select  id="pais" name="pais">
hereDOC;
//mostramos todos los paises de la base de datos
$sentencia = 'SELECT * FROM paises';
$resultado = @mysqli_query($link, $sentencia);

while($fila = mysqli_fetch_assoc($resultado)){
    echo "<option>" .$fila['NomPais']. "</option>";
}
echo <<<hereDOC
			   </select>
			</p>
			<p class="text"><label for="album">Álbum*: </label>
			   <select  id="album" name="album">
hereDOC;
//mostramos los albumes del usuario que esta logueado.
$url= $_SERVER["REQUEST_URI"];
$split = explode('=', $url);
$i = $split[count($split)-1];
if(strpos($i, '&')){
	$split2 = explode('&', $i);
	$i = intval($split2[0]);	
}
$sentencia = 'SELECT * FROM albumes a, usuarios u where a.Usuario = u.idUsuario  AND u.idUsuario = '.$i;
$resultado = @mysqli_query($link, $sentencia);
	//comprobamos que venimos de la pagina de album privado
	if(isset($_POST['titleAlbum'])){
		echo "<option>" .$_POST['titleAlbum']. "</option>";
	}

while($fila = mysqli_fetch_assoc($resultado)){
	//si venimos de album privado no debemos de mostrar la opcion del album del que venimos ya que lo hemos mostrado antes.
	if(isset($_POST['titleAlbum'])){
		if($_POST['titleAlbum'] != $fila['Titulo']){
    		echo "<option>" .$fila['Titulo']. "</option>";
		}
	}
	//si no venimos de la pagina de album privado, se muestran todas las opciones
	else{
		echo "<option>" .$fila['Titulo']. "</option>";
	}
}
echo <<<hereDOC
				</select>
			</p>
			<p>	<label>Foto: </label><br>
				<label id="fotperf" for="foto"><img style= "height:300px; width:300px;" src="imagenes/fotos/levante.jpg" alt="perfil" ></label>
                <input onchange="cargarFoto(this);"  style="display: none;"  id="foto" type="file" name="foto">
                <label id="busfot" for="foto">Buscar Foto</label>
			</p>
			<p id="values">
				<input class= "formu" id="enviar" type="submit" name="Enviar" value="Enviar">
				<input class= "formu"  type="reset" name="restablecer">
			</p>
		</form>	
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