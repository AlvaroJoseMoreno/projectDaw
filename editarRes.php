<?php

/*
    Registro
*/

if(isset($_SESSION['usuario'])==false && !isset($_COOKIE['usuario'])){
    @ob_start();
    session_start();
}
$comprobar= false;

$title = "PI-Respuesta Registro";
$idbody = "id = detalle";
include "conexionbd.php";

 if(isset($_POST["nombre"])&&isset($_POST["mail"])&&isset($_POST["contraseña"])&&isset($_POST["contraseña2"])&& $_POST["nombre"]!=""&&$_POST["contraseña"]!=""&&$_POST["mail"]!=""){
//Comprobar si datos son correctos
$comprobar = true;

include "comprobar.php";

if($error==0){
    include "head.php";
    $keyHash= password_hash($_POST["contraseña"], PASSWORD_DEFAULT);

    if(!isset($_COOKIE['usuario']) && !isset($_SESSION['usuario'])){
        echo "<article id = resultado>";
        echo "<h1>Datos Registro</h1>";
        echo "<p>Hola {$_POST["nombre"]}, te has registrado con éxito</p>";
        }
    else{
      echo "<article id = resultado>";
      echo "<h1>Datos Edicion de usuario</h1>";
      echo "<p>Hola {$_POST["nombre"]}, Has modificado tus datos con exito</p>";  
    }
    
    echo "<p>Sus datos introducidos son: </p>";
    echo "<p>Nombre: {$_POST["nombre"]}</p>";
    //si los campos son distintos de cadena vacia, tabulado y espacio, se muestra su valor en un parrafo en su respectivo campo
    $sexo = 0;
    if(isset($_POST["mail"])){
        if($_POST["mail"] != "" && $_POST["mail"] != "\t" && $_POST["mail"]!= " "){
            echo "<p>Mail: {$_POST["mail"]}</p>";
        }
    }
    if(isset($_POST["sexo"])){
        if($_POST["sexo"] == "H" || $_POST["sexo"] == "h" || $_POST["sexo"] == "M" || $_POST["sexo"] == "m"){
            echo "<p>Sexo: {$_POST["sexo"]}</p>";
            if($_POST["sexo"]=="H"||$_POST["sexo"]=="h"){$sexo=0;}
            else{ $sexo=1;}
        }
    }
    if(isset($_POST["fecha"])){
        if($_POST["fecha"] != "" && $_POST["fecha"] != "\t" && $_POST["fecha"]!= " "){
            $split = explode('-', $_POST['fecha']);
            $fechaCorrecta = $split[2] . '-'. $split[1] . '-'. $split[0];
            echo "<p>Fecha de nacimiento: {$_POST['fecha']}</p>";
        }
    }
    if(isset($_POST["ciudad"])){
        if($_POST["ciudad"] != "" && $_POST["ciudad"] != "\t" && $_POST["ciudad"]!= " "){
            echo "<p>Ciudad: {$_POST["ciudad"]}</p>";
        }
    }
    if(isset($_POST["pais"])){
        if($_POST["pais"] != "" && $_POST["pais"] != "\t" && $_POST["pais"]!= " "){
            echo "<p>País: {$_POST["pais"]}</p>";
        }
    }
     if(isset($_FILES['foto']['name'])){
        if($_FILES['foto']['name'] != "" && $_FILES['foto']['name'] != "\t" && $_FILES['foto']['name']!= " "){
            echo "<p>Foto Subida: {$_FILES['foto']['name']}</p>";
        }
    }
    echo "</article>"; 
    $senPais= " SELECT  idPais from paises where NomPais='{$_POST["pais"]}' ";
    $resp= mysqli_query($link,$senPais);
    $paisesId= @mysqli_fetch_array($resp);
    include "footer.php"; 
    $nombreAr= $_FILES['foto']['name'];
    //esto viene como respuesta al formulario de registro
    if(!isset($_COOKIE['usuario']) && !isset($_SESSION['usuario'])){
            $sentencia = "INSERT INTO usuarios VALUES (NULL,'{$_POST["nombre"]}', '{$keyHash}','{$_POST["mail"]}',$sexo,'{$fechaCorrecta}','{$_POST["ciudad"]}',{$paisesId[0]},'{$nombreAr}',NULL,0)";

            if(!mysqli_query($link, $sentencia)){
                die("Error: no se pudo realizar la inserción");
            }

             include "subidaUsu.php";

    }
    //esto viene como respuesta al formulario de editar datos.
    else{
        $userId = -1;
        if(isset($_COOKIE['idUsu'])){
            $userId = $_COOKIE['idUsu'];
        }
        else{
            $userId = $_SESSION['idUsu'];
        }
        
        $passAntigua ="";
        //si existe la variable de contraseña antigua se asocia a una nueva variable recien creada. 
        if(isset($_POST['passConf']) && $_POST['passConf'] != "" && $_POST['passConf'] != "\t" && $_POST['passConf'] != " "){
            $passAntigua = $_POST['passConf']; 
            //realizamos select de usuario, para comprobar la contrasnya antigua en la base de datos y ver si es correcta.
            $comprobarPassAntigua = "SELECT * FROM usuarios u where u.idUsuario = $userId";
            $resultadoPass = @mysqli_query($link, $comprobarPassAntigua);
            $filaPass = mysqli_fetch_array($resultadoPass);

            if(password_verify($passAntigua,$filaPass['Clave'])){
                $ciudad ="";
                //Aqui comprobamos los datos que vamos a insertar
                if(isset($_POST["ciudad"])){
                    if($_POST["ciudad"] != "" && $_POST["ciudad"] != "\t" && $_POST["ciudad"]!= " "){
                        $ciudad = $_POST['ciudad'];
                    }
                    else{
                        $ciudad = $filaPass['Ciudad'];
                    }
                }
                $fechafinal ="";
                if(isset($_POST["fecha"])){
                    if($_POST["fecha"] != "" && $_POST["fecha"] != "\t" && $_POST["fecha"]!= " "){
                        $fechafinal = $fechaCorrecta;
                    }
                    else{
                        $fechafinal = $filaPass['FNacimiento'];
                    }
                }
                
                //ahora que sabemos que la comprobacion de campos se ha realizado de forma correcta, se actualizan los siguientes campos: 
            $sentenciaModUsser = "UPDATE usuarios u set u.NomUsuario = '{$_POST["nombre"]}', u.Clave = '{$keyHash}', u.Email = '{$_POST["mail"]}', u.Sexo = $sexo, u.FNacimiento = '$fechafinal', u.Ciudad = '$ciudad', u.Pais = {$paisesId[0]}, u.Foto= '{$_FILES["foto"]["name"]}' where u.idUsuario = $userId";
           //si la sentencia falla, se mostrara en la base de datos.
                include "subidaUsu.php";
                    
                if(!mysqli_query($link, $sentenciaModUsser)){
                    die("Error: no se pudo realizar la inserción");
                }


            }
            else{
                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = 'datosUsu.php?adfsgdsadSAAsSFEPSKGPJTHafssafafsassDdddsfSDSasq';
                header("Location: http://$host$uri/$extra");
                exit;
            }

        }
        //Si no te redirige al formulario de nuevo
        else{
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'datosUsu.php?adfsgdsadssDdddsfSDSasqSAAsSFEPSKGPJTH';
            header("Location: http://$host$uri/$extra");
            exit;
        } 
      }
    }
    else{
        //si los datos del formulario son erroneos, nos devuelve a cualquiera de los dos formularios (registro o editar), para que lo volvamos a rellenar.
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
            $extra = 'datosUsu.php?adfsgdfdPSOSKFEjcomproerror';
            header("Location: http://$host$uri/$extra");
        }
        else{
            $extra = 'registro.php?adfsgdfdPSOSKFEjcomproerror';
            header("Location: http://$host$uri/$extra");
        }
        exit;
    }
 }
    if(!$comprobar){
        //si los requisitos a la hora de registrarse no se cumplen, (nombre corto, email incorrecto, ...) se muestra un mensaje modal diciendo que volvamos a realizar la operacion de registro
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        //si esta logueddo es el formulario de editar datos.
        if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
            $extra = 'datosUsu.php?adfsgdfdPSOSKFEjERIWOq)102924';
            header("Location: http://$host$uri/$extra");
        }
        //si no esta logueado es el formulario de registro
        else{
            $extra = 'registro.php?adfsgdfdPSOSKFEjERIWOq)102924';
            header("Location: http://$host$uri/$extra");
        }
    	exit;
    }

?>