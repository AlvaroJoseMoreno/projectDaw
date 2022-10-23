<?php
    /*
    En esta pagina tenemos un formulario de busqueda para poder buscar las fotos mediante unos requisitos que son el titulo, que sea mayor o menor que una fecha y el pais al que pertenece la foto.
    @authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
    Fecha de creacion: 29-9-20. Fecha de ultima modificacion: 30-11-20, motivo: implementar el datalist con los paises.
    */
    $title = "PI - Página de búsqueda";
    $idbody = "id = busqueda";
    include "head.php";
    setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
echo  <<<hereDOC
    <section>
    	<h2>Búsqueda</h2>
    	<form action="resultado.php" method="POST">
    		<p class="text">
    			<label for="titulo">Título: </label>
hereDOC;
        if(isset($_POST['busearch'])){
        	echo "<input type=\"text\" id=\"titulo\" value=\"{$_POST['busearch']}\" required name=\"titulo\">";
        }
        else{
            echo "<input type=\"text\" id=\"titulo\" required name=\"titulo\">";
        }
echo <<<hereDOC
    		</p>
    		<p class="text">
    			<label for="fa">Entre: </label>
    			<input type="date" id="fa" name="fa">
    			<label id="fdl" for="fd"> Y: </label>
    			<input type="date" id="fd" name="fd">
    		</p>
    		<p class="text">
    			<label for="pais">Pais: </label>
    			<input type="text" id="pais" list="paises" name="pais">
    		</p>
    		<input class="formu" id="busenv" type="submit" name="buscar" value="buscar">
    	</form>
    	<datalist id="paises">
hereDOC;
//recuperamos los paises de la base de datos y los mostramos mediante un datalist
    $sentencia = 'SELECT * FROM paises';
    $resultado = @mysqli_query($link, $sentencia);
    while($fila = mysqli_fetch_assoc($resultado)){
        echo "<option>" .$fila['NomPais']. "</option>";
    }
echo <<<hereDOC
    	</datalist>
    </section>
hereDOC;
    include "footer.php";
?>