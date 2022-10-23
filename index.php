<?php
    /*
    Esta pagina es la pagina principal de la web, contiene una barra de busqueda, las 5 ultimas fotos de la base de datos y el formulario de iniciar sesion.
    @authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
    Fecha de creacion: 22-9-20. Ultima modificacion: 19-11-20, motivo: incluir la politica de cookies de la web
    */
    $title = "PI - Página Principal de la web";
    $idbody = "id=index";
    include "head.php";
    setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
if(isset($_COOKIE['usuario'])==true && $_COOKIE['usuario']!=''){
    //si existe cookie, la web nos lo recordara al ir a la pagina principal
     echo <<<hereDOC
            <form class="form" action="user.php" method="POST" >
                <h2>Acceder sesión</h2>
                <p>Hola <strong> <label style="margin-left: 5px;">{$_COOKIE['usuario']}</label>,</strong>¿Desea acceder a tu menu de usuario?</p>
                <p>Ultima conexión: <strong>{$_COOKIE['fechahora']}</strong></p>
                <p><input class= "formu" id="enviar" type="submit" name="Enviar" value="Acceder">
            </form>
            <form class="form" action="exit.php">
                <input class="formu" id="sal" type="submit" name="ads" value="Salir">
            </form>
hereDOC;

//si no hay cookies ni sesion, la web nos muestra un formulario para que nos logueemos o un enlace para registrarnos en caso de no estarlo
}else if(!isset($_COOKIE['usuario']) && !isset($_SESSION['usuario']) ){
    echo <<<hereDOC
            <form class="form" action="loginbbdd.php" method="post" >
                <h2>Iniciar sesión</h2>
                <label for="nombre">Nombre: </label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" autofocus><br> <!--required-->
                <label for="password">Password: </label>
                    <input type="password" id="password" name="contraseña" placeholder="Contraseña"><br><!--required-->
                <p><input class= "formu" id="enviar" type="submit" name="Enviar" value="Enviar">
                <input class= "formu" type="reset" name="restablecer"></p>
                <p><input type="checkbox" name="recordar"> ¿Quieres recordar tu usuario?</p>
            </form>
            <form class=form action="registro.php" method="POST">
                <input class="formu" id="reg" type="submit" name="ads" value="Registrarse">
            </form>
hereDOC;
    }
            //aqui se muestran las mensajes modales de iniciar sesion
            $url= $_SERVER["REQUEST_URI"];
            $split = explode('?', $url);
            $i = $split[count($split)-1];
            if($i=="falseferworjio2344rsf"){
                 echo "<div id=\"capafondo\"><article id=ar><h2>Iniciar sesion</h2><p>Las credenciales son invalidas</p><footer><button class=button onclick=cerrarMensajeModal();>cerrar</button></footer></article></div>";
            }
            elseif($i=="trueadasffs342353WEREWFFDSSF"){
                 echo "<div id=\"capafondo\"><article id=ar><h2>Iniciar sesion</h2><p>Usuario Correcto</p><footer><button class=button onclick=loginCorrecto();>cerrar</button></footer></article></div>";
            }
            elseif($i =="afsafasadsafsDebajafsfsasdfsaf"){
                echo "<div id=\"capafondo\"><article id=ar><h2>Dar de baja cuenta</h2><p>Enhorabuena, te has dado de baja con éxito</p><footer>
                <form action=\"index.php\">
                    <input type=\"submit\" class=\"button\" value=\"cerrar\">
                </form>
                </footer></article></div>";
            }
            
            include "lectura.php";
            echo "<h2>Últimas imágenes: </h2>";
            echo "<main id=\"mainart\">";
                include "article.php";
                
//mostramos mensaje al final de la pagina con la politica de cookies de la web           
if(!isset($_COOKIE['usuario']) && !isset($_SESSION["usuario"])){
echo <<<hereDOC
<script type="text/javascript">
function controlcookies() {
         // si variable no existe se crea (al clicar en Aceptar)
    localStorage.controlcookie = (localStorage.controlcookie || 0);
    localStorage.controlcookie++; // incrementamos cuenta de la cookie
    cookie1.style.display='none'; // Esconde la política de cookies
}
</script>
<div class="cookiesms" id="cookie1">
Este sitio web usa cookies, pincha en el siguiente botón para aceptarlas</a> 
<button onclick="controlcookies()">Aceptar</button>
<div  class="cookies2">Política de cookies</div>
</div>
<script type="text/javascript">
if (!localStorage.controlcookie>0){ 
cookie1.setAttribute("style","animation: desaparecer 5s;-webkit-animation: desaparecer 5s;");
}
</script>
hereDOC;
}
    include "footer.php";
?>

<!-- onsubmit="return comprobarLogin();"onclick="return localReg();"  -->