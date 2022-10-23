<?php
/*
En esta pagina mostramos el perfil publico de cualquier usuario registrado en la web y sus datos.
@authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
Fecha de creacion: 29-11-20. Fecha de ultima modificacion: 29-11-20
*/
$title = "PI - Página pública de perfil de usuario";
$idbody = "id=profileuser";
include "head.php";

$url= $_SERVER["REQUEST_URI"];
$split = explode('=', $url);
$i = $split[1];

//en esta pagina mostramos el perfil publico de usuario
//se obtienen los datos de usuario
if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
$sentencia= "SELECT * from usuarios u, albumes a, paises p where u.idUsuario={$i} AND p.idPais = u.Pais";
$resultado = @mysqli_query($link, $sentencia);
$filaUsu = mysqli_fetch_array($resultado);


echo "<h2>Página de perfil de {$filaUsu['NomUsuario']}</h2>";
echo <<<hereDOC
	 <section>
	 	<p><label>El nombre de usuario es: {$filaUsu['NomUsuario']}</label><p>
	 	<p>	
		<img id="foto" src="imagenes/fotos/{$filaUsu['idUsuario']}/{$filaUsu['Foto']}" alt="perfil">
		</p>
		<p>Pais de Nacimiento: {$filaUsu['NomPais']}</p>
hereDOC;
		//se comprueba si el usuario es hombre o mujer
		if($filaUsu['Sexo'] == 0)
			echo "<p>El usuario es un hombre</p>";
		else
			echo "<p>El usuario es una mujer</p>";
		//se trocea la fecha de registro para mostrarlo en el formato dd-mm-yy
		$split2 = explode(' ', $filaUsu['FRegistro']);
		$split3 = explode('-', $split2[0]);
		echo "<p>Alta de usuario: ".$split3[2]."-".$split3[1]."-".$split3[0]."</p>";
echo <<<hereDOC
<p><label for="album">Álbumes: </label>
			   <ul>
hereDOC;
//extraemos de la base de datos el nombre de los albumes y los mostramos
$sentencia2= "SELECT * from usuarios u, albumes a where u.idUsuario = a.Usuario AND u.idUsuario={$i}";
$resultado2 = @mysqli_query($link, $sentencia2);
while($filaUs = mysqli_fetch_assoc($resultado2)){
    echo "<a href=\"veralbumpublico.php?idalbum={$filaUs['IdAlbum']}\"><li>" .$filaUs['Titulo']. "</li></a>";
}
echo <<<hereDOC
				</ul>
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