<?php
// Estructura de la carpeta deseada

 if(isset($_COOKIE['idUsu'])){
            $userId = $_COOKIE['idUsu'];
        }
        else{
            $userId = $_SESSION['idUsu'];
        }
if(isset($_COOKIE['idUsu'])||isset($_SESSION['idUsu'])){

   
	$fotoantigua = "SELECT Foto FROM usuarios u where u.idUsuario = {$_SESSION['idUsu']}";
            $resultado = @mysqli_query($link, $fotoantigua);
            $fila= mysqli_fetch_array($resultado);
            $ficheroName = $fila[0];

	$estructura = "./imagenes/fotos/{$userId}/";

// Para crear una estructura anidada se debe especificar
// el parámetro $recursive en mkdir().
	$filename = $estructura.$ficheroName;
	

if (file_exists($filename)) {
    $success = unlink($filename);
    
    if (!$success) {
         throw new Exception("Cannot delete $filename");
    }
}




if(file_exists($estructura . $_FILES["foto"]["name"]))
{
echo $_FILES["foto"]["name"] . " ya existe";
}
else{
	move_uploaded_file($_FILES["foto"]["tmp_name"],
$estructura . $_FILES["foto"]["name"]);
}
 /*$sentenciaUploadFile = "UPDATE usuarios u set u.Foto= '". $estructura.$_FILES["foto"]["name"] ."' where u.idUsuario = ".$userId;
           //si la sentencia falla, se mostrara en la base de datos.
                if(!mysqli_query($link, $sentenciaUploadFile)){
                    die("Error: no se pudo realizar la inserción");
                }*/



}else{



$senId= " SELECT  idUsuario from usuarios where NomUsuario='{$_POST["nombre"]}' and Email='{$_POST["mail"]}' ";
$resp= mysqli_query($link,$senId);
$IdUsu= @mysqli_fetch_array($resp);
$estructura = "./imagenes/fotos/{$IdUsu[0]}/";

// Para crear una estructura anidada se debe especificar
// el parámetro $recursive en mkdir().


if(!mkdir($estructura, 0777, true)) {
echo "al pelo";
}

if(file_exists($estructura . $_FILES["foto"]["name"]))
{
echo $_FILES["foto"]["name"] . " ya existe";
}
else{
	move_uploaded_file($_FILES["foto"]["tmp_name"],
$estructura . $_FILES["foto"]["name"]);
}
 //$sentenciaUploadFile = "UPDATE usuarios u set u.Foto= '". $estructura.$_FILES["foto"]["name"] ."' where u.idUsuario = ".$IdUsu[0];
           //si la sentencia falla, se mostrara en la base de datos.
               // if(!mysqli_query($link, $sentenciaUploadFile)){
                  //  die("Error: no se pudo realizar la inserción");
               // }
}

// ...
?>