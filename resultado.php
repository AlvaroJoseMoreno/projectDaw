<?php
	/*
        En esta pagina mostramos los datos por los que hemos buscado en el formulario de busqueda, asi como las fotos que cumplan con los requisitos de esos parametros.
        @authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
        Fecha de creacion: 29-9-20. Fecha de ultima modificacion: 29-11-20, motivo: mostrar las fotos que coincidan
    */
	$title = "PI-Página con el resultado de la búsqueda";
	$idbody = "id=resultadosearch";
	include "head.php";
	setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
	echo "<article id=\"resultado\">";
	echo "<h2>--Valores de la búsqueda--</h2>";
	//comprobamos que los parametros de la pagina "busqueda" exista y que sea distinto de tab, cadena vacia y espacio para mostrarlo 
		if(isset($_POST["titulo"])){
			if($_POST["titulo"] != "" && $_POST["titulo"] != "\t" && $_POST["titulo"]!= " "){
				echo "<p><strong>Titulo buscado:</strong> {$_POST["titulo"]}</p>";
			}
	 	}
	 	if(isset($_POST["fa"]) && isset($_POST["fd"])){
			if($_POST["fa"] != "" && $_POST["fa"] != "\t" && $_POST["fa"]!= " " && $_POST["fd"] != "" && $_POST["fd"] != "\t" && $_POST["fd"]!= " "){
				//mostramos las fechas en el formato dd-mm-yy
				$splitfa = explode('-', $_POST['fa']);
				$splitfd = explode('-', $_POST['fd']);
	 			echo "<p>Entre el <strong>".$splitfa[2]."-".$splitfa[1]."-".$splitfa[0]."</strong> y el <strong>".$splitfd[2]."-".$splitfd[1]."-".$splitfd[0]."</strong><p>";
	 		}
	 	}
	 	if(isset($_POST["pais"])){
			if($_POST["pais"] != "" && $_POST["pais"] != "\t" && $_POST["pais"]!= " "){
	 			echo "<p><strong>Pais:</strong> {$_POST["pais"]}</p>";
	 		}
	 	}
		echo "</article>";
	 	echo "<h2>--Resultados de búsqueda--</h2>";
		echo "<main>";		
		
		include "article.php";

		echo "</main>";	
	include "footer.php";
?>