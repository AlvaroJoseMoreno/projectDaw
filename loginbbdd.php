<?php 
/*
En esta pagina se realiza la comprobacion del login de usuario. Tanto si es correcto, como si es incorrecto.
@authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez.
Fecha de creacion: 10-11-20. Fecha de ultima modificacion: 26-11-20, Motivo: comprobar desde la base de datos que los datos introducidos en el formulario son validos o erroneos.
*/
session_start();
    include 'conexionbd.php';
            $comprobar = false;
            $sentencia = 'SELECT * FROM usuarios';
            $resultado = @mysqli_query($link, $sentencia);

 if(isset($_POST["nombre"])&&isset($_POST["contraseña"])){
   while(($fila = mysqli_fetch_assoc($resultado))&&$comprobar==false){

        //$keyHash= password_hash($_POST["contraseña"]), PASSWORD_DEFAULT); 
        $usu= $fila['NomUsuario'];
        $pass= $fila['Clave'];
       //comprabamos que los datos que inserta el usuario son correctos
        if($_POST["nombre"]==$usu && password_verify($_POST["contraseña"], $pass)){
           //si marcamos la opcion de recordar se crea una cookie
            if(isset($_POST["recordar"])){
                setcookie("usuario", $_POST["nombre"], time() + 90*24*60*60);
                setcookie("password", password_hash($_POST["contraseña"]), time() + 90*24*60*60);
                setcookie("idUsu", $fila['idUsuario'], time() + 90*24*60*60);
                setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
            }
            //si no se crea una sesion
            else{
                session_start();
             //   session_id();
                 $nombreUsu= $_POST["nombre"];
                $_SESSION['usuario'] = $nombreUsu;
                $_SESSION['idUsu'] = $fila['idUsuario'];

            }
            //si las credenciales de iniciar sesion son validas nos muestra un mensaje modal indicandolo
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = '?trueadasffs342353WEREWFFDSSF';
            header("Location: http://$host$uri/$extra");
            exit;
            $comprobar = true;
            }
        }

 }
    if(!$comprobar){
       //si la informacion de iniciar sesion no es correcta se muestra un mensaje modal, diciendo que las credenciales son invalidas
      $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = '?falseferworjio2344rsf';
        header("Location: http://$host$uri/$extra");
    	exit;
    }
?>

