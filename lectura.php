<?php



//abrimos fichero para mostrar
$arrayDetalle = array();
$fp = fopen("imagenSel.txt", "r");
while (!feof($fp)){
    $linea = fgets($fp);
    $split = explode("-", $linea);
    $animales = array(intval($split[0])=> $split[1]);
    $arrayDetalle += $animales;
}

//obtenemos el numero aleatorio
$value = array_rand($arrayDetalle);

$senFot= "SELECT * from fotos f, paises p where f.IdFoto = $value";
$resultadoFot = @mysqli_query($link, $senFot);
$filaFot = mysqli_fetch_array($resultadoFot);
$numFilas = mysqli_num_rows($resultadoFot);
$fp = fopen("imagenSel.txt", "r");
$seleccionarLinea = "";
while (!feof($fp)){
    $linea = fgets($fp);
    if($value == intval(substr($linea, 0, 1))){
    	$seleccionarLinea = $linea;
    }
}
	echo <<<hereDOC
		<h2>Foto del día</h2>
		<div id=detalle>
		<article class=articulos>
hereDOC;
if($numFilas>0){
    $senAl= "SELECT * from albumes a, usuarios where a.idAlbum = {$filaFot['Album']} AND a.Usuario=idUsuario";
	$resultadoAl = @mysqli_query($link, $senAl);
	$filaAl = mysqli_fetch_array($resultadoAl);
	echo "<h2>{$filaFot['Titulo']}</h2>";
	echo "<img src=\"imagenes/fotos/".$filaAl['idUsuario']."/".$filaAl['IdAlbum']."/".$filaFot['IdFoto']."_". $filaFot['Fichero']. "\" height=200 width=200 alt=\"" . $filaFot['Alternativo']. "\">";
	$fregister= explode(' ', $filaFot['FRegistro']);
	$fechaSplit = explode("-", $filaFot['Fecha']);
	$fecha = $fechaSplit[2] . "-" .$fechaSplit[1] ."-".$fechaSplit[0];
	echo  "<p><b>Fecha: </b> " . $fecha. " || <b>Pais: </b>".$filaFot['NomPais']."</p>";
	echo  "<p><label><b>Autor: </b><a href=\"perfilpublico.php?profileusuario={$filaAl['idUsuario']}\">".$filaAl['NomUsuario'] ."</a></label></p>";
	echo  "<p style=\"white-space:inherit;\"><b>Descripción: </b>".$filaFot['Descripcion']."</p>";
	echo "</p><p style=\"padding-bottom: 9px;border-bottom: 1px solid;\"><b>Album: </b>  <a href=\"veralbumpublico.php?idalbum={$filaAl['IdAlbum']}\">".$filaAl['Titulo']."</a></p>";
	$split2 = explode("-", $seleccionarLinea);
	echo "<h2>Opinión del crítico</h2>";
	echo "<p><label><b>Crítico: </b>".$split2[1]."</label></p>";
	echo "<p style=\"white-space:inherit;\"><b>Opinión</b>: {$split2[2]}</p>";
}
else{
	echo "<h2>No existe ninguna foto en la base de datos para este id proporcionado</h2>";
}
echo	"</article>";
//aqui tratamos el fichero JSON.
$data = file_get_contents("consejos.json");
$products = json_decode($data, true);
 
 $arrayConsejos = array();
foreach ($products as $product) {
	$consejos = array(intval($product["id"])=>$product["Categoría"]);
	$arrayConsejos += $consejos;
}

$valorId = array_rand($arrayConsejos);
foreach ($products as $product) {
	if($product["id"] == $valorId){
		echo "<article class=articulos>";
		echo "<h2>Consejo del Día</h2>";
		echo "<p><b>Categoría: </b> ".$product["Categoría"]."</p>";
		echo "<p><b>Dificultad: </b> ".$product["Dificultad"]."</p>";
		echo  "<p style=\"white-space:inherit;\"><b>Consejo: </b>".$product["consejo"]."</p>";
		echo "</article>";
	}
}
echo	"</div>";

fclose($fp);

?>
