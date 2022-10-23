<?php
    /*
    Esta es la pagina con la declaracion de accesibilidad de la web, contiene como acceder a los estilos alternativos, el uso de colores, etc.
    @authors: Alejandro Alcaraz Sanchez y Alvaro Jose Moreno Carreras
    Fecha de creacion: 29-10-20. Fecha de ultima modificacion: 29-10-20
    */


	$title = "PI - Página de accesibilidad";
    $idbody = "id = accesibile";
	include "head.php";
    setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
?>
    <section>
    	<h2>Etiquetado semántico</h2>
        <img src="imagenes/CapturaEti.png" height="200" width="200" alt="Etiquetas semanticas">
        <p> Utilizar diferntes etiquetas para organizar la estructura de nuestra web, nos garantiza un correcto funcionamiento a largo plazo, además de una correcta organización de la misma. Nuestra web consta de un head y de un body como todas las web en html,
        pero además hemos usado etiquetas como main, article o footer para estructurarla</p>
    </section>
    <section>
    	<h2>Texto alternativo</h2>
        <img src="imagenes/Captura.png" height="200" width="200" alt="Etiquetas semanticas">
        <p>El texto alternativo de las imágenes ayuda a mejorar la calidad de la web, este texto que funciona con el atributo alt, nos permite mostrar información de la imagen cuando esta no se carga correctamente </p>

    </section>
    <section>
    	<h2>Uso de colores</h2>
    	<p>El uso de colores establecido en la web tanto para el estilo "accesible", como para el de alto contraste, cumple una relación de contraste mayor de 7.5:1 sobre los textos de párrafos y labels lo que quedaría con una calificación de AAA de la WCAG, y una realación mayor de 4.5:1 para encabezados, que sería calificado con un nivel AA en la WCAG, lo que convierte a este sitio web en accesible para personas con problemas de visión.</p>
    </section>
    <section>
    	<h2>Activación de hoja accesible</h2>
    	<img src="imagenes/acti.png" height="200" width="200" alt="Activación de hojas de estilo alternativo">
    	<p>Para activar una hoja de estilo alternativo en la web, primero tendremos que descarganos la extensión de google "Alt css", después de eso nos aparecerá en la esquina superior derecha de la barra de búsqueda del navegador, acto seguido, pincharemos en el icono verde que aparece, que hace referencia a la extensión "alt css", al pinchar saldrá un desplegable con todos los estilos alternativos que hay, seleccionamos uno y ya tendremos el estilo alternativo activo en la web</p>
    </section>
    <section>
    	<h2>Otras carácteristicas</h2>
    	<p>Entre las características de accesibilidad implementadas destacan: La hoja de estilo de alto contraste, para que el fondo y el texto tengan un color lo suficientemente diferenciado y contrasten para que todo tipo de usuario con cualquier discapacidad pueda usarla. Que al pasar el ratón por encima de un link, este cambie de color, se subraye y el cursor del ratón cambie a la forma de una mano. En el css hay una propiedad textual llamada letter-spacing que separa las letras por un tamaño mayor que el predeterminado, es una manera de ayudar a los usuarios con problemas de visión. También hay un modo por el cuál el tamaño del texto de la web aumenta, para ayudar a los usuarios que necesiten un tamaño de fuente más amplio para ver correctamente el contenido de la web. </p>
    </section>
<?php
	include "footer.php";
?>