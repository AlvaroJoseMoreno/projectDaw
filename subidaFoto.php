<?php
// Estructura de la carpeta deseada

 if(isset($_COOKIE['idUsu'])){
            $userId = $_COOKIE['idUsu'];
        }
        else{
            $userId = $_SESSION['idUsu'];
        }



$senId= " SELECT * from fotos where Titulo='{$titulo}' and Descripcion='{$descripcion}' and Fichero= '{$_FILES['foto']['name']}'";
$resp= mysqli_query($link,$senId);
$IdAlbum= @mysqli_fetch_array($resp);

$estructura = "./imagenes/fotos/{$userId}/".$IdAlbum['Album']."/".$IdAlbum['IdFoto']."_";

// Para crear una estructura anidada se debe especificar
// el parámetro $recursive en mkdir().




if(file_exists($estructura . $_FILES["foto"]["name"]))
{
echo $_FILES["foto"]["name"] . " ya existe";
}
else{
	move_uploaded_file($_FILES["foto"]["tmp_name"],
$estructura . $_FILES["foto"]["name"]);
}
 

?>