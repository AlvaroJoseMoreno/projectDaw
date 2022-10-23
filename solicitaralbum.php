<?php
    /*
        En esta pagina mostramos el formulario de solicitar un album, asi como dos tablas con las tarifas.
        @authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
        Fecha de creacion: 6-10-20. Fecha de ultima modificacion: 29-11-20, motivo: mostrar el datalist con los albumes de usuario.
    */
    $title = "PI - Solicitar álbum";
    $idbody = "id=solalb";
	include "head.php";
    setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
    if(isset($_COOKIE['usuario']) || isset($_SESSION['usuario'])){
echo <<<hereDOC
    <section class="solicitar">
    	<h2>Solicitar impresión de un álbum</h2>
    	<p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Delectus incidunt impedit quod ut, magnam! Nemo totam perspiciatis natus, quas nulla sunt eveniet commodi consequuntur perferendis vitae dolorem dolorum est atque.Nulla aut ipsum vero unde, natus dolor enim perspiciatis ratione veritatis, doloremque. Reiciendis porro exercitationem totam fuga iure nisi quae suscipit ad eos ipsam similique nam nobis delectus tempore, illo?</p>
    	<article id="table">
    		<h3 id="tar">Tarifas</h3>
    		<table>
    			<tr>
    				<td>Concepto</td>
    				<td> Tarifa</td>
    			</tr>
    			<tr>
    				<td>&lt; 5 páginas</td>
    				<td> 0.10 € por página</td>
    			</tr>
    			<tr>
    				<td>entre 5 y 10 páginas </td>
    				<td> 0.08 € por página</td>
    			</tr>
    			<tr>
    				<td>> 11 páginas</td>
    				<td> 0.07 € por página</td>
    			</tr>
    			<tr>
    				<td>blanco y negro</td>
    				<td> 0 €</td>
    			</tr>
    			<tr>
    				<td>Color</td>
    				<td> 0.05 € por página</td>
    			</tr>
    			<tr>
    				<td>Resolución > 300 dpi </td>
    				<td> 0.02 € por foto</td>
    			</tr>
    		</table>
    	</article>
	</section>
    <article id="tabcost">
        <h2>Tabla de Tarifas 2</h2>
hereDOC;
      include "tabla.php";
      echo "</article>";
        
echo <<<hereDOC
    <section id="formsol" class ="solicitar">
            <h2>Formulario de solicitud: </h2>
            <p>Rellena el siguiente formulario aportando todos los detalles para confeccionar tu álbum, los apartados con (*) son obligatorios: </p>
            <form action="solicitaralbumrequest.php" method="POST">
                    <p class="text">
                    <label for="nombre">Título*: </label>
                    <input type="text" id="nombre" name="titulo" placeholder="Título del álbum" required autofocus>
                    </p>
                    <p class="text">
                    <label for="area">Tex. adicion.: </label>
                    <textarea name="descripcion" placeholder="Descripción del álbum" id="area" maxlength="4000"></textarea>
                    </p>
                    <p class="text">
                    <label for="correo">Email*: </label>
                    <input type="email" id="correo" name="correo" placeholder="correo electrónico" maxlength="200" required>
                    </p>
                    <p  id="direccion">
                    <label id="dir" class="notext">Dirección*: </label>
                    <br><br>
                    <br>
                    <label for="direc">Calle: </label><input type="text" id="direc" name="calle" placeholder="calle" required>
                    <label for="numcalle">N.Calle: </label><input type="number" id="numcalle" name="numcalle" placeholder="número de calle" required>
                    <label for="edificio">Edificio: </label><input type="text" id="edificio" name="Edificio" placeholder="Edificio" required>
                    <label for="piso">Piso: </label><input type="text" id="piso" name="piso" placeholder="piso" required>
                    <label for="cp">C.Postal: </label><input type="text" id="cp" name="cp" placeholder="Código postal" pattern="[0-9]{5}" required title="solo números y 5 dígitos">
                    <label for="ciudad">Ciudad: </label><input type="text" id="ciudad" name="ciudad" placeholder="Localidad" required>
                    <label for="prov">Provincia: </label><input type="text" id="prov" name="provincia" placeholder="provincia" required list="provincia">
                    </p>
                    <p class="text">
                    <label id="telmar" for="telefono">Teléfono: </label>
                    <input type="tel" id="telefono" name="telefono" placeholder="Telefono" maxlength="9" minlength="9">
                    </p>
                    <p>
                    <label class="notext" for="color">Color portada: </label>
                    <input type="color" id="color" name="color">
                    </p>
                    <p>             
                    <label class="notext" for="copias">Núm. copias*: </label>
                    <input type="number" id="copias" name="copias" value="1" required>
                    </p>
                    <p>  
                    <label class="notext" for="rango">Reso. impresión: </label>
                    <label>150 </label>
                    <input type="range" value="150" onchange= "document.getElementById('out').value=value"
                    id="rango" step="150" name="rango" min="150" max="900">
                    <output id="out" name="out" for="vol">150</output>
                    </p>
                    <br>
                    <p class="text">
                    <label for="album">Álbum de usuario*: </label>
                    <input type="text" id="album" name="album" list="albuns" required placeholder="álbum">
                    </p>
                    <p class="text">
                    <label for="fecha">Fecha de entrega: </label>
                    <input type="date" id="fecha" name="fecha">
                    </p>
                    <p>
                    <label class="notext">Impresión a color: </label>
                    <label for="Si">Si: </label>
                    <input type="radio" id="Si" name="drone" value="Si" checked>
                    <label for="No">No: </label>
                    <input type="radio" id="No" name="drone" value="No">
                    </p>
                <input class="formu" type="submit" name="enviar" value="Enviar">
            </form>
            <datalist id="albuns">
hereDOC;
     
    //se realiza una consulta para obtener los albumes del usuario que esta conectado         
    if(isset($_COOKIE['usuario'])){
        $sentencia = "SELECT * FROM albumes a where a.Usuario = {$_COOKIE['idUsu']}";
    }
    else{
        $sentencia = "SELECT * FROM albumes a where a.Usuario = {$_SESSION['idUsu']}";
    }
    $resultado = @mysqli_query($link, $sentencia);

    while($fila = mysqli_fetch_assoc($resultado)){
        echo "<option>" .$fila['Titulo']. "</option>";
    }
            

echo <<<hereDOC
            </datalist>
            <datalist id="provincia">
                <option>Alicante</option>
                <option>Valencia</option>
                <option>Murcia</option>
                <option>Madrid</option>
                <option>Barcelona</option>
                <option>Sevilla</option>
            </datalist>
        </section>
	</main>
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