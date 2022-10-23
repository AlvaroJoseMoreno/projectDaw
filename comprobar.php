<?php
/*
    En este fichero se realizan las comprobaciones necesarias para que el formulario de registro no tenga fallos
    @authors: Alvaro Jose Moreno Carreras y Alejandro Alcaraz Sanchez.
    Fecha de creacion: 7-12-20.
*/
 $mensaje='';
 $error=0;
 $nom= $_POST["nombre"];//usuario
 $pass1= $_POST["contraseña"];//contraseña
 $pass2=$_POST["contraseña2"];//repetir contra
 $mail= $_POST["mail"];
 $sexo= $_POST["sexo"];
 $fecha= $_POST["fecha"];
 $splitFechaCom = explode('-', $fecha);
 $date = $splitFechaCom[2]. '-'.$splitFechaCom[1] .'-'. $splitFechaCom[0];

 //email
    //comprobar campos no vacios
        //**********Validar usuario****************
        $nomArray=str_split($nom);
        if(count($nomArray)<3 || count($nomArray)>15){
            if(count($nomArray)<3){
                $error++;
                $mensaje.='<p>El nombre de Usuario es demasiado corto<p>';   
            }
            else{
                $error++;
                $mensaje.='<p>El nombre de Usuario es demasiado largo<p>'; 
            }
        }else{
            if(preg_match("/^[A-Z 0-9]+$/i", $nom)){
                if(preg_match("/^[0-9]+$/", $nomArray[0])){
                    $error++;
                   $mensaje.='<p>El nombre de Usuario no puede empezar por un numero<p>';       
                }
                else{
               //console.log('Se ha registrado correctamente nombre usuario');
                }
            }else{
                $error++;
              $mensaje.='<p>Solo mayusculas, minisculas y numeros en el Usuario<p>';
              
            }
        }
        //***********Validar contraseña*************
        
        $arrayContra= str_split($pass1);
        $errorCon=false;
        
        if(count($arrayContra)<6 || count($arrayContra)>15){
          
                $error++;
             $mensaje.='<p>La contraseña debe tener entre 6 y 15 carcateres<p>';

        }else{
            if(preg_match("/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{6,15}$/", $pass1)){
                for( $i=0;$i<count($arrayContra);$i++){
                    if(preg_match('/^[A-Z 0-9]+$/i', $arrayContra[$i])==false&& $arrayContra[$i]!='-'&&$arrayContra[$i]!='_'){
                        $errorCon=true;     
                  }
                }
                if($errorCon==true){
                $mensaje.='<p>Caracter invalido en contraseña<p>';
                    $error++;
                }
            }
            else{
                $error++;
                $mensaje.='<p>La contraseña debe tener mayusculas, minisculas y al menos un numero (y no debe tener carcateres especiales)<p>';
                        //$mensaje+='La contraseña debe tener mayusculas, minisculas y al menos un numero (y no debe tener carcateres especiales)\n';
            }   
        }
        //Comprobar si pass1 y pass2 son iguales
        if($pass1!=$pass2){
            $mensaje.='<p>Las claves no coinciden<p>';
            $error++;
        }
        if(strripos($mail, '@')==false){
            $error++;
            $mensaje.='<p>Dirección de correo invalida (falta el @)<p>';
        }
        else{        
            if(count(str_split($mail))>254){
                $error++;
                  $mensaje.='<p>Dirección de correo muy larga<p>';
                //$mensaje+='Dirección de correo invalida<br>';
            }
            else{
                $partes= explode("@",$mail);
                $local=$partes[0];
                $dominio=$partes[1];
                if(preg_match("/^[A-Z 0-9 !#$%&'*+-\/?=^_`{|}~.]+$/i", $local)==true){
                    $array= str_split($local);
                    $prev=false;
                    for ( $i = 0; $i<count($array);$i++) {
                         $c=$array[$i];
                    if($c=='.'&&$prev==false){
                                $prev=true;
                        if($i==0){
                                  $mensaje.='<p>El correo no debe empezar por un punto<p>';
                                 $error++;
                             }              
                        if($i==count($array)){
                             $mensaje.='<p>El correo no puede terminar en un punto<p>';
                                $error++;
                            }

                       }else if($c=='.'&&$prev==true){
                             $mensaje.='<p>No puede haber dos puntos seguidos en el correo<p>';
                                $error++;
                    } else{
                
                             $prev=false;
                            }   
                        }
                }
                else{
                    $error++;
                      $mensaje.='<p>Parte local del correo invalida<p>';
                }
               if(count(str_split($dominio))<255&&count(str_split($dominio))>1){
                $subdominio= explode('.', $dominio);
                if(count($subdominio)>1){
                    for ( $i = 0; $i < count($subdominio); $i++) {
                        if(preg_match("/^[A-Za-z0-9 -]+$/", $subdominio[$i])==true){
                            //console.log(subdominio[i].charAt(0)+" "+subdominio[i].charAt(subdominio[i].length-1));
                            if($subdominio[$i][0]=='-'||$subdominio[$i][count(str_split($subdominio[$i]))-1]=='-'){
                                $error++;
                                  $mensaje.='<p>Guión al inicio/final del correo<p>';
                            }
                            //console.log("nicee");
                        }
                        else{
                            $error++;
                              $mensaje.='<p>Formato del correo invalido<p>';
                        }
                    }

                }
                else{
                    $error++;  $mensaje.='<p>Faltan Puntos en el dominio<p>';
                }
               }
               else{ 
                    $error++;   $mensaje.='<p>Tamaño dominio invalido<p>';
                }
        }
    }

    //****************Sexo**************************

    if($sexo!='H'&&$sexo!='h'&&$sexo!='M'&&$sexo!='m'){
        $error++;
          $mensaje.='<p>En el sexo debes seleccionar H o M<p>';
    }

    //****************Fecha**************************
    if(preg_match('/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/', $date)==true){

        $fArray= explode("-", $date);
        $anyo= $fArray[0];
        $mes= $fArray[1];
        $dia= $fArray[2];

        if($mes=='2'||$mes=='02'){
            if((($anyo%4 ==0)&&($anyo%100!=0))||($anyo%400==0)){
                                if($dia >0 && $dia <=29){

                                }else{
                                    $error++;
                                    $mensaje.='<p>Fecha incorrecta, febrero tiene menos de 30 dias, ponla en el formato dd-mm-yyyy.<p>';
                                }
                            }
                            else{
                                if($dia >0 && $dia <=28){}
                                    else{
                                        $error++;
                                        $mensaje.='<p>Fecha incorrecta, febrero solo tiene 29 dias los años bisiestos, ponla en el formato dd-mm-yyyy.<p>';
                                    }
                            }

        }
       

    }else{

        
         $mensaje.='<p>Fecha incorrecta<p>';
        $error++; 
    }


if($error>0){
    setcookie("error", $mensaje, time() + 5*60);
}


//comprobar fecha: ^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$

        /*  anyo bisiesto en javascript
            if(((anyo%4 ==0)&&(anyo%100!=0))||(anyo%400==0)){
                                if(dia >0 && dia <=29){comprobar = true;}
                            }
                            else{
                                if(dia >0 && dia <=28){comprobar = true;}
                            }

    */
    ?>