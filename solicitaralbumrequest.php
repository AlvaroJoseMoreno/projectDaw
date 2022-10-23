<?php
/*
En esta pagina mostramos el coste del album que hemos solicitado en la pagina de solicitar album, asi como mostrar los campos en un parrafo cada uno esos datos que hemos puesto.
@authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
Fecha de creacion: 6-10-20. Fecha de ultima modificacion: 1-12-20, motivo: Modificar cookies
Ultima modificacion: 7-12-20, motivo: insertar a la base de datos las solicitudes de comprar album
*/
	$title = "PI: Solicitar Álbum respuesta";
    $idbody = "id=respsol";
	include "head.php";
    if(isset($_COOKIE['usuario']) || isset($_SESSION["usuario"])){
    setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);

      $ncopias=$_POST["copias"];
    $color= true;

    if($_POST["drone"]=="Si"){
        $color= true;
        }
    elseif($_POST["drone"]=="No"){
        $color= false;
        }

    $resu= $_POST["rango"];

    $sentenciaverAlbum = "SELECT * FROM fotos f, albumes a where f.Album = a.idAlbum AND a.Titulo = '{$_POST['album']}'";
    $resultadoAlbum = @mysqli_query($link, $sentenciaverAlbum);

    $numFilas = mysqli_num_rows($resultadoAlbum);

    $costetot=0;
    $paginas = ceil($numFilas/3);
    $fotos = $numFilas;
//menos de 5 copias
    if($paginas<5 ){

        if($color==true){
            if($resu>300){
                //primero numero de paginas, despues resolucion y por ultimo el color
                $costetot = (((0.10) * $paginas) + ((0.02) * $fotos) + ((0.05)* $fotos)) * $ncopias; 
            }
            else if($resu<=300){
                //primero numero de paginas y despues ultimo el color
                $costetot = (((0.10) * $paginas) + ((0.05)* $fotos)) * $ncopias; 
            }

        }
        else if($color==false){
            if($resu>300){
                $costetot = (((0.10) * $paginas) + ((0.02) * $fotos)) * $ncopias;
            }
            else if($resu<=300){
                $costetot=(((0.10) * $paginas)) * $ncopias;
            }
        } 
    }
//mas de 5 copias
    else if($paginas>=5 && $paginas<=10){
        if($color==true){
            if($resu>300){
               $costetot=(((0.10) * 4) + ((0.08) * ($paginas - 4)) + ((0.02) * $fotos) + ((0.05)* $fotos)) * $ncopias;
            }
            else if($resu<=300){
                $costetot=(((0.10) * 4) + ((0.08) * ($paginas - 4)) + ((0.05)* $fotos)) * $ncopias;
            }
        }
        else if($color==false){
            if($resu>300){
              $costetot=(((0.10) * 4) + ((0.08) * ($paginas - 4)) + ((0.02) * $fotos)) * $ncopias;
            }
            else if($resu<=300){
               $costetot=(((0.10) * 4) + ((0.08) * ($paginas - 4)))* $ncopias;   
            }
        } 
    }
//mas de 10 copias
    else if($paginas>10){
        if($color==true){
            if($resu>300){
                $costetot=(((0.10) * 4) + ((0.08) * 6) + ((0.07) * ($paginas-10)) + ((0.02) * $fotos) + ((0.05)* $fotos)) * $ncopias;
            }
            else if($resu<=300){
                $costetot=(((0.10) * 4) + ((0.08) * 6) + ((0.07) * ($paginas-10)) + ((0.05)* $fots)) * $ncopias;
            }
        }
        else if($color==false){
            if($resu>300){
    $costetot=(((0.10) * 4) + ((0.08) * 6) + ((0.07) * ($paginas-10)) + ((0.02) * $fotos)) * $ncopias;
            }
            else if($resu<=300){
                  $costetot=(((0.10) * 4) + ((0.08) * 6) + ((0.07) * ($paginas-10))) * $ncopias;
            }
        }        
    }
    $texto="";
    if($color==true){
        $texto="A color";
    }elseif($color==false){$texto="Blanco y Negro";}
//echo $_POST["descripcion"];
echo <<<hereDoc
    <section>
        <h2>{$_POST["titulo"]}</h2>
        <img src="imagenes/levante.jpg" alt="playa" height="450" width="600">
        <p><b>Nombre:</b>{$_POST["album"]}</p>
        <p><b>Email:</b> {$_POST["correo"]}</p>
        <p><b>Dirección:</b> {$_POST["calle"]}, {$_POST["numcalle"]}, {$_POST["Edificio"]}, {$_POST["piso"]}, {$_POST["ciudad"]}, {$_POST["provincia"]}.</p>
        <p><b>Dirección Postal:</b> {$_POST["cp"]}</p>
        <p><b>Tel:</b> {$_POST["telefono"]}</p>
        <p><b>Número de copias:</b> {$ncopias}|| <b>Impresión:</b> {$texto} </p>
        <p><b>Fecha estimada de entrega:</b> {$_POST["fecha"]}</p>
        <h3><b>Precio:</b> {$costetot} € </h3>
        <p>Gracias por confiar en nosotros, un saludo. Atentamente, PI: Pictures & Images</p>
    </section>
hereDoc;
$senAl = "SELECT idAlbum FROM albumes  where Titulo = '{$_POST['album']}'";
    $resultado = @mysqli_query($link, $senAl);
    $idAlb=  @mysqli_fetch_array($resultado);

$sentencia = "INSERT  INTO solicitudes values (NULL,{$idAlb['idAlbum']},'{$_POST["album"]}','{$_POST["titulo"]}','{$_POST["descripcion"]}','{$_POST["correo"]}','{$_POST["calle"]}, {$_POST["numcalle"]}, {$_POST["Edificio"]}, {$_POST["piso"]}, {$_POST["ciudad"]}, {$_POST["provincia"]}','{$_POST["color"]}',{$ncopias},{$resu},'{$_POST["fecha"]}',{$color},NULL,{$costetot})";
 if(!mysqli_query($link, $sentencia)){
        die("Error: no se pudo realizar la inserción");
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