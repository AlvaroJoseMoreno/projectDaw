
<?php

/*
  En esta pagina se crea el menu para configurar el estilo de la pagina, (sea noche, normal, accesible, etc)
  Fecha de creacion: 25-11-20, @authors: Alejandro Alcaraz Sanchez y Alvaro Jose Moreno Carreras
  Fecha de ultima modificacion: 1-12-20. Motivo: impedir a alguien que este registrado que entre a esta pagina
  Modificacion: 5-12-20: mostrar mensaje modal de confirmacion de cambio de estilo.
*/
session_start();
$title = "PI-Página de configurar estilo.";
$idbody = "id = configurar";

setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
include "head.php";
	//vamos a mostrar el mensaje modal.
	$url= $_SERVER["REQUEST_URI"];
    $split = explode('?', $url);
    $i = $split[count($split)-1];
    if($i=="trueadasffs3cambio042353WEestiloREWFFDexitoSSF"){
    	echo "<div id=\"capafondo\"><article id=ar><h2>Cambiar estilo</h2><p>Has cambiado el estilo con exito</p><footer>
		    	<form action=\"user.php\">
		    		<input type=\"submit\" class=\"button\" value=\"cerrar\">
		    	</form>
		    	</footer></article></div>";
    }

echo "<form action=\"configurarResponse.php\" class=\"form\" method=\"POST\" >";
echo "<h2>Seleccione el estilo de la pagina</h2>";
		$sentencia = 'SELECT * FROM estilos';
		$resultado = @mysqli_query($link, $sentencia);
while($estilo = mysqli_fetch_assoc($resultado)) {
	if($estilo['idEstilo'] == 0)
		echo "<p><label for=".$estilo['idEstilo'].">Estilo ".$estilo['Nombre']."</label>
			<input type=\"radio\" id=\"".$estilo['idEstilo']."\" value=\"".$estilo['Fichero']."\" name=\"drone\" checked></p>"; 
	else if($estilo['idEstilo'] != 5){
		echo "<p><label for=".$estilo['idEstilo'].">Estilo ".$estilo['Nombre']."</label>
			<input type=\"radio\"  id=\"".$estilo['idEstilo']."\" value=\"".$estilo['Fichero']."\" name=\"drone\"></p>";
	}
}
	echo <<<hereDOC
        	<p><input type="submit" class="button" name="titleAlbum" value="Cambiar Estilo"></p>
	</form>
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

