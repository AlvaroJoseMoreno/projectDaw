<?php
        /*
        Esta pagina se utiliza para cerrar sesion de usuario y para eliminar las cookies en caso de que las hubiera, despues de eliminar las cookies, se redirecciona a la pagina principal.
        @authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
        Fecha de creacion: 19-11-20. Fecha de ultima modificacion 19-11-20. 
        */
        setcookie("idUsu",'',time()-42000);
	setcookie("usuario", '', time() - 42000);
        setcookie("password", '', time() - 42000);
        setcookie("fechahora", '',time() -42000);

        session_start();
 	$_SESSION = array();
        setcookie("PHPSESSID",'', time() -42000,'/folder/');
	session_destroy();

        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra ="";
        if(!isset($_COOKIE['BorrarUsu'])){
            $extra = "index.php";
        }
        else{
             $extra = "?afsafasadsafsDebajafsfsasdfsaf";
             setcookie("BorrarUsu",'',time()-42000);
        }
        header("Location: http://$host$uri/$extra");
        exit;
 
?>
        
