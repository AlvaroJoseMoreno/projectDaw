<?php
/*
En este fichero construimos la tabla de tarifas que se incluye en la pagina para solicitar album.
@authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez
Fecha de creacion: 12-11-20. Fecha de ultima modificacion: 12-11-20.
*/

 echo "<table id=\"tablaprec\" style=\"text-align:center;\">";
  echo "<tbody>";
  echo "<tr>";
  for ($k = 0; $k < 4; $k++) {
      // Crea un elemento <td> y un nodo de texto, haz que el nodo de
      // texto sea el contenido de <td>, ubica el elemento <td> al final
      // de la hilera de la tabla
      echo "<td ";
      if($k==2){
         echo "COLSPAN=\"2\">Blanco y negro";
       }
    if($k==3){
      echo "COLSPAN=\"2\">Color";
        
      }
      elseif($k!=2 && $k!=3){ echo ">";}
      echo "</td>";
    }
     echo "</tr>";
  // Crea las celdas
  $numfotos = 0;
  $bn =0;
  $bndpi450 = 0;
  $col = 0;
  $coldpi450 = 0;
  for ($i = 0; $i < 16; $i++) {
    // Crea las hileras de la tabla
   echo "<tr>";

    for ($j = 0; $j < 6; $j++) {
      // Crea un elemento <td> y un nodo de texto, haz que el nodo de
      // texto sea el contenido de <td>, ubica el elemento <td> al final
      // de la hilera de la tabla
    echo "<td>";

      if($i==0&&$j==0){
        echo "Número de páginas";
        }
      else if($i==0&&$j==1){
        echo "Número de fotos" ;
        }
       else if($i==0&&$j==2){
        echo "150-300 dpi" ;
        }
       else if($i==0&&$j==3){
        echo "450-900 dpi";
        }
       else if($i==0&&$j==4){
        echo "150-300 dpi";
        }
        else if($i==0&&$j==5){
        echo "450-900 dpi";
        }
    
        else if($i>0){
          if($j == 0){
            echo $i;
          }
          else if($j == 1){
            $numfotos+=3;
            echo $numfotos;
          }
          else if($j== 2){
            if($i>0 && $i<5){
              $bn += 0.10;
            }
            else if($i>=5 && $i<=11){
              $bn += 0.08;
            }
            else{
              $bn += 0.07;
            }
          echo round($bn, 2);
          }
          else if($j== 3){
            if($i>0 && $i<5){
              $bndpi450 += 0.16;
            }
            else if($i>=5 && $i<=11){
              $bndpi450 += 0.14;
            }
            else{
              $bndpi450 += 0.13;
            }
            echo round($bndpi450, 2);
          }
          else if($j== 4){
            if($i>0 && $i<5){
              $col += (0.10 + 0.15);
            }
            else if($i>=5 && $i<=11){
              $col += (0.08 + 0.15);
            }
            else{
              $col += (0.07 + 0.15);
            }
            echo round($col, 2);
          }
          else if($j== 5){
            if($i>0 && $i<5){
              $coldpi450 += (0.10 + 0.15 + 0.06);
            }
            else if($i>=5 && $i<=11){
              $coldpi450 += (0.08 + 0.15 + 0.06);
            }
            else{
              $coldpi450 += (0.07 + 0.15 + 0.06);
            }
              echo round($coldpi450, 2);
          }
        }
    echo "</td>";
    }
    // agrega la hilera al final de la tabla (al final del elemento tblbody)
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
 ?>