			<?php
			/*	
			En este fichero realizamos el tratamiento de los articles de las fotos, en todas las paginas de la web que sean necesarios ponerlas.
			@authors: Alejandro Alcaraz Sanchez y Alvaro Jose Moreno Carreras.
			Fecha de creacion: 2-11-20, Fecha de ultima modificacion: 1-12-20, motivo: crear paginado de index.
			*/
			setcookie("fechahora", date("d-m-Y H:i:s"),time() + 90*24*60*60);
			include "conexionbd.php";
			//realizamos la sentencia de los articulos ordenados descendentemente por la fecha de registro (las ultimas seran las primeras)
			$sentencia = 'SELECT * FROM fotos ORDER BY FRegistro desc';
			//mostramos error si falla la sentencia
			if(!($resultado = @mysqli_query($link, $sentencia))) {
					echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " .mysqli_error($link);
					echo '</p>';
					exit;
				}
		/******************************************************************************/		
			if(!strpos($url, 'more') && !strpos($url, 'resultado') && !strpos($url,'veralbum') && !strpos($url, 'verAlbum') && !strpos($url, 'misfotos') && !strpos($url, 'albumes')){
			//Aqui mostramos los cinco ultimos articulos de la base de datos
			$nelementos=5;
				$num_total_rows= mysqli_num_rows($resultado);
		//examino pagina a mostrar
			if ($num_total_rows > 0) {
	    			$page = false;
	    			if (isset($_GET["page"])) {
	        			$page = $_GET["page"];
    				}
	  			  	if (!$page) {
	        			$start = 0;
	        			$page = 1;
    				} 
    				else {
        				$start = ($page - 1) * $nelementos;
    				}
    //calculo el total de paginas
    			$total_pages = ceil($num_total_rows / $nelementos);
    			$result = $link->query(
        		'SELECT * FROM fotos  ORDER BY FRegistro DESC LIMIT '.$start.', '.$nelementos);
	    if ($result->num_rows > 0) {
	       // echo '<ul class="row items">';
	        while ($row = $result->fetch_assoc()) {
	           //obtenemos nombre de usuario y titulo de album 
					$sen2= "SELECT * from albumes a,usuarios where a.idAlbum =".$row['Album']."&& a.Usuario=idUsuario";
					$resultado2 = @mysqli_query($link, $sen2);
					$filaUsu = mysqli_fetch_array($resultado2);
					//obtenemos nombre del pais
					$sen3= "SELECT NomPais from paises p,fotos f where p.idPais = ".$row['Pais'] ."";
					$resultado3 = @mysqli_query($link, $sen3);
					$filaPais = mysqli_fetch_array($resultado3);

					echo "<article class=\"articulos\">";
					echo "<h2>".$row['Titulo']."</h2>";
					echo "<p><label class=icon-user>".$filaUsu['NomUsuario'] ."</label></p>";
					echo "<img src=\"imagenes/fotos/".$filaUsu['idUsuario']."/".$filaUsu['IdAlbum']."/".$row['IdFoto']."_".$row['Fichero'] ."\" height=200 width=200 alt=\"".$row['Alternativo'] ."\">";
					$fechaSplit = explode("-", $row['Fecha']);
					$fecha = $fechaSplit[2] . "-" .$fechaSplit[1] ."-".$fechaSplit[0];
					echo  "<p><b>Fecha: </b> ".$fecha." || <b>Pais: </b>".$filaPais[0]."</p>";
					echo "<p><b>".$filaUsu['NomUsuario'] .": </b>" .$row['Descripcion'] ."</p>";

					if((isset($_COOKIE['usuario'])==true && $_COOKIE['usuario']!='')|| (isset($_SESSION['usuario'])==true && $_SESSION['usuario']!='')){	
							echo "<form method=\"POST\" action=more.php?id=".$row['IdFoto'] .">";
							echo	"<input class=\"button\" type=\"submit\" name=\"image\" value=\"Mostrar más\">";
							echo "</form>";
						}
						echo "</article>";
				        }
				       // echo '</ul>';
				    }
				    echo "</main>";
					echo '<h3>Mostrando la pagina '.$page.' de ' .$total_pages.' paginas.</h3>';
				    echo '<nav>';
				    echo '<ul class="pagination">';
				 
				    if ($total_pages > 1) {
				        if ($page != 1) {
				            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
				        }
				 
				        for ($i=1;$i<=$total_pages;$i++) {
				            if ($page == $i) {
				                echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
				            } else {
				                echo '<li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
				            }
				        }
				        if ($page != $total_pages) {
				            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
				        }
				    }
				    echo '</ul>';
				    echo '</nav>';
				}
			}
			//*************************************************************************
			//Aqui mostramos el articulo de la pagina "mostrar mas"
			else if(strpos($url, 'more')){
				//traemos valores del article
				$senFot= "SELECT * from fotos f, paises p where f.IdFoto = ".$i." AND p.idPais = f.pais";
				$resultadoFot = @mysqli_query($link, $senFot);
				$filaFot = mysqli_fetch_array($resultadoFot);
				//traemos valores del usuario
				$senAl= "SELECT * from albumes a, usuarios where a.idAlbum =".$filaFot['Album']. "&& a.Usuario=idUsuario";
				$resultadoAl = @mysqli_query($link, $senAl);
				$filaAl = mysqli_fetch_array($resultadoAl);

				echo "<article class=\"articulos\">";
				echo "<h2>".$filaFot['Titulo']."</h2>";
				echo "<img src=\"imagenes/fotos/".$filaAl['idUsuario']."/".$filaAl['IdAlbum']."/".$filaFot['IdFoto']."_". $filaFot['Fichero']. "\" height=200 width=200 alt=\"" . $filaFot['Alternativo']. "\">";
				
				$fregister= explode(' ', $filaFot['FRegistro']);
				$fechaSplit = explode("-", $filaFot['Fecha']);
				$fecha = $fechaSplit[2] . "-" .$fechaSplit[1] ."-".$fechaSplit[0];
				echo  "<p><b>Fecha: </b> " . $fecha. " || <b>Pais: </b>".$filaFot['NomPais']."</p>";
				echo  "<p><label><b>Autor: </b><a href=\"perfilpublico.php?profileusuario={$filaAl['idUsuario']}\">".$filaAl['NomUsuario'] ."</a></label></p>";
				echo  "<p style=\"white-space:inherit\";><b>Descripción: </b>".$filaFot['Descripcion']."</p>";
				if(strpos($url, 'more') == true){
					echo "</p><p><b>Album: </b>  <a href=\"veralbumpublico.php?idalbum={$filaAl['IdAlbum']}\">".$filaAl['Titulo']."</a></p>";
				}
				echo "</article>";	
			}
			//aqui mostramos el resultado del formulario de busqueda
			else if(strpos($url, 'resultado')){
				//aqui comparamos el titulo sin distinguir entre mayuscula y minuscula
				$titumin= strtolower($_POST["titulo"]);				
				$sen4= "SELECT * from fotos where Titulo like '%".$titumin ."%'";
				$resultado4 = @mysqli_query($link, $sen4);

			while($fila = mysqli_fetch_assoc($resultado4)) {
				//obtenemos nombre del pais
				$sen3= "SELECT NomPais from paises p,fotos f where p.idPais = ".$fila['Pais'] ."";
				$resultado3 = @mysqli_query($link, $sen3);
				$filaPais = mysqli_fetch_array($resultado3);
				//la fecha de la foto la transformamos a formato ingles para que pueda realizar las comparaciones correctamente
			//	$splitfa = explode('-', $fila['Fecha']);
			//	$sting = strtotime($splitfa[2].'/'.$splitfa[1].'/'.$splitfa[0]);
			//	$newDate = date('Y-m-d',$sting);

				if(((!isset($_POST["fa"])) || ($fila['Fecha'] > $_POST["fa"])) && (($_POST["fd"] =="") || ($fila['Fecha'] < $_POST["fd"]))  && ($_POST["pais"] == "" || $_POST["pais"] == $filaPais[0])){
				//obtenemos nombre de usuario y titulo de album
				$sen2= "SELECT * from albumes a,usuarios where a.idAlbum =".$fila['Album']. "&& a.Usuario=idUsuario";
				$resultado2 = @mysqli_query($link, $sen2);
				$filaUsu = mysqli_fetch_array($resultado2);
				
			//	echo "Hola: ". $fila['Titulo'];
				echo "<article class=\"articulos\">";
				echo "<h2>".$fila['Titulo']."</h2>";
				echo "<p><label class=icon-user>".$filaUsu['NomUsuario'] ."</label></p>";
				echo "<img src=\"imagenes/fotos/".$filaUsu['idUsuario']."/".$filaUsu['IdAlbum']."/".$fila['IdFoto']."_".$fila['Fichero'] ."\" height=200 width=200 alt=\"".$fila['Alternativo'] ."\">";
				$fregis= explode(' ', $fila['FRegistro']);
				
				$fechaSplit = explode("-", $fila['Fecha']);
				$fecha = $fechaSplit[2] . "-" .$fechaSplit[1] ."-".$fechaSplit[0];

				echo  "<p><b>Fecha: </b> ".$fecha." || <b>Pais: </b>".$filaPais[0]."</p>";
				echo "<p><b>".$filaUsu['NomUsuario'] .": </b>" .$fila['Descripcion'] ."</p>";
				if((isset($_COOKIE['usuario'])==true && $_COOKIE['usuario']!='')|| (isset($_SESSION['usuario'])==true && $_SESSION['usuario']!='')){	
				echo "<form method=\"POST\" action=more.php?id=".$fila['IdFoto'] .">";
				echo	"<input class=\"button\" type=\"submit\" name=\"image\" value=\"Mostrar más\">";
				echo "</form>";
					}
				echo "</article>";
					}
				}
			}
			//aqui metemos los articulos de las fotos para las paginas de ver album, tanto privada como publica
			else if(strpos($url, 'veralbum') || strpos($url, 'verAlbum')){
				$url= $_SERVER["REQUEST_URI"];
				$split = explode('=', $url);
				$i = $split[1];
				//obtenemos fotos del album por orden descendenteS
				$sentenciaverAlbum = "SELECT * FROM fotos f where f.Album = {$i} ORDER BY FRegistro desc";
				$resultadoAlbum = @mysqli_query($link, $sentenciaverAlbum);
			while($fila = mysqli_fetch_assoc($resultadoAlbum)) {
				//obtenemos nombre de usuario y titulo de album 
				$sen2= "SELECT * from albumes a,usuarios where a.idAlbum =".$fila['Album']. "&& a.Usuario=idUsuario ";
				$resultado2 = @mysqli_query($link, $sen2);
				$filaUsu = mysqli_fetch_array($resultado2);
				//obtenemos nombre del pais
				$sen3= "SELECT NomPais from paises p,fotos f where p.idPais = ".$fila['Pais'] ."";
				$resultado3 = @mysqli_query($link, $sen3);
				$filaPais = mysqli_fetch_array($resultado3);

				echo "<article class=\"articulos\">";
				echo "<h2>".$fila['Titulo']."</h2>";
				echo "<p><label class=icon-user>".$filaUsu['NomUsuario'] ."</label></p>";
				echo "<img src=\"imagenes/fotos/".$filaUsu['idUsuario']."/".$filaUsu['IdAlbum']."/".$fila['IdFoto']."_".$fila['Fichero'] ."\" height=200 width=200 alt=\"".$fila['Alternativo'] ."\">";

				$fechaSplit = explode("-", $fila['Fecha']);
				$fecha = $fechaSplit[2] . "-" .$fechaSplit[1] ."-".$fechaSplit[0];
				echo  "<p><b>Fecha: </b> ".$fecha." || <b>Pais: </b>".$filaPais[0]."</p>";
				echo "<p><b>".$filaUsu['NomUsuario'] .": </b>" .$fila['Descripcion'] ."</p>";

				if((isset($_COOKIE['usuario'])==true && $_COOKIE['usuario']!='')|| (isset($_SESSION['usuario'])==true && $_SESSION['usuario']!='')){	
				echo "<form method=\"POST\" action=more.php?id=".$fila['IdFoto'] .">";
				echo	"<input class=\"button\" type=\"submit\" name=\"image\" value=\"Mostrar más\">";
				echo "</form>";
					}
					echo "</article>";
				}
			}
			//aqui mostramos las fotos de la pagina "mis fotos"
			else if(strpos($url, 'misfotos')){
				//obtenemos fotos del album por orden descendenteS
				if(isset($_COOKIE['idUsu'])){
				$sentenciaverAlbum = "SELECT * FROM albumes a, fotos f where a.IdAlbum = f.Album AND a.Usuario = {$_COOKIE['idUsu']} ORDER BY FRegistro desc";
				}
				if(isset($_SESSION['idUsu'])){
					$sentenciaverAlbum = "SELECT * FROM albumes a, fotos f where a.IdAlbum = f.Album AND a.Usuario = {$_SESSION['idUsu']} ORDER BY FRegistro desc";
				}
				$resultadoAlbum = @mysqli_query($link, $sentenciaverAlbum);
				$numFilas = mysqli_num_rows($resultadoAlbum);

				if($numFilas == 0){
					echo "<h2>El usuario aun no ha subido ninguna foto a la web</h2>";
					echo "<h2 style=\"text-align:center;\"><a href=\"user.php\">Volver a perfil de usuario</a></h2>";
				}
				else{
				echo "<h3 id=\"tar\">Fotos de usuario</h3>";
				echo "<main id=\"misfo\">";
				while($fila = mysqli_fetch_assoc($resultadoAlbum)) {
				//obtenemos nombre de usuario y titulo de album 
				$sen2= "SELECT * from albumes a,usuarios where a.idAlbum =".$fila['Album']. "&& a.Usuario=idUsuario ";
				$resultado2 = @mysqli_query($link, $sen2);
				$filaUsu = mysqli_fetch_array($resultado2);
				//obtenemos nombre del pais
				$sen3= "SELECT NomPais from paises p,fotos f where p.idPais = ".$fila['Pais'] ."";
				$resultado3 = @mysqli_query($link, $sen3);
				$filaPais = mysqli_fetch_array($resultado3);

				echo "<article class=\"articulos\">";
				echo "<h2>".$fila['Titulo']."</h2>";
				echo "<img src=\"imagenes/fotos/".$filaUsu['idUsuario'] ."/".$filaUsu['IdAlbum']."/".$fila['IdFoto']."_".$fila['Fichero'] ."\" height=200 width=200 alt=\"".$fila['Alternativo'] ."\">";
				$fechaSplit = explode("-", $fila['Fecha']);
				$fecha = $fechaSplit[2] . "-" .$fechaSplit[1] ."-".$fechaSplit[0];
				echo  "<p><b>Fecha: </b> ".$fecha." || <b>Pais: </b>".$filaPais[0]."</p>";
				echo "<p><b>Descripción: </b>" .$fila['Descripcion'] ."</p>";
				echo "</p><p><b>Album: </b>  <a href=\"verAlbumPrivate.php?idalbum={$fila['IdAlbum']}\">".$filaUsu['Titulo']."</a></p>";
				echo "</article>";
				}
				echo "</main>";
			  }
			}
			//aqui mostramos la pagina de albumes
			else if(strpos($url, 'albumes')){
				if(isset($_COOKIE['idUsu'])){
		    		$sentencia = "SELECT * FROM albumes a where a.Usuario = {$_COOKIE['idUsu']}";
		    	}
		    	elseif ($_SESSION['idUsu']) {
		    		$sentencia = "SELECT * FROM albumes a where a.Usuario = {$_SESSION['idUsu']}";
		    	}
			//mostramos error si falla la sentencia
				if(!($resultado = @mysqli_query($link, $sentencia))) {
				echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " .mysqli_error($link);
				echo '</p>';
				exit;
				}
				//se crea article con una tabla
				$numFilas = mysqli_num_rows($resultado);
				if($numFilas == 0){
					echo "<h2>El usuario aun no ha creado ningun album</h2>";
					echo "<h2 style=\"text-align:center;\"><a href=\"misfotos.php\">Ir a mis fotos</a></h2>";
				}
				else{
		    	echo "<h2>Albumes de usuario</h2>";
		    	echo "<main id=\"misfo\">";
		    	while($fila6 = mysqli_fetch_assoc($resultado)){
		    		echo "<article class=\"articulos\">";
		    		echo "<h2>".$fila6['Titulo']."</h2>";
		    		if(isset($_COOKIE['idUsu'])){
		    			$sentenciaFotos = "SELECT * FROM fotos f, usuarios u where  f.Album = {$fila6['IdAlbum']} AND".$_COOKIE['idUsu'] ."= u.idUsuario";
		    		}
			    	elseif ($_SESSION['idUsu']) {
			    		$sentenciaFotos = "SELECT * FROM fotos f, usuarios u where f.Album = {$fila6['IdAlbum']} AND ".$_SESSION['idUsu']." = u.idUsuario";
			    	}
			    	$resultado2 = @mysqli_query($link, $sentenciaFotos);
			    	$numFilasFotos = mysqli_num_rows($resultado2);
			    	if($numFilasFotos == 0){
			    		echo "<p>Este album aún no contiene fotos</p>";
			    	}
			    	else{
			    		echo "<p>Primera foto del album:</p>";
			    		$X = 0;
			    		while ($filaFotos = mysqli_fetch_assoc($resultado2)) {
			    			if($X == 0){
			    			echo "<img src=\"imagenes/fotos/".$filaFotos['idUsuario']."/".$fila6['IdAlbum']."/".$filaFotos['IdFoto']."_".$filaFotos['Fichero'] ."\" height=200 width=200 alt=\"".$filaFotos['Alternativo'] ."\">";
			    				$X = $X+1;
			    			}
			    		}
		    		}
		    		echo "<p><b>Descripción: </b>" .$fila['Descripcion'] ."</p>";
		    		echo "<p style=\"text-align:center;\"><a href=\"misfotos.php\">Ir a mis fotos</a></p>";
		    		echo "</article>";
		    	}
		    	echo "</main>";
				}	
			}
		
		

		?>
