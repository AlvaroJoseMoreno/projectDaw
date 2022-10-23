'use strict'
function mensajeModal(html){
	let div = document.createElement('div');

	div.setAttribute('id', 'capafondo');
	div.innerHTML = html;

	document.querySelector('body').appendChild(div);
}

function cerrarMensajeModal(){
	document.querySelector('#capafondo').remove();
}

function loginCorrecto(){
    document.querySelector('#capafondo').remove();
    window.location.href="user.php";
}
/*
function comprobarLogin(){
	var nombre = document.getElementById("nombre").value;
	var password = document.getElementById("password").value;
	let contnombre = 0; //comprueba que el numero de espacios o tabs sea igual que la longitud del nombre;
	let contpassw = 0;
	var splnombre = nombre.split("");
	var splpassw = password.split("");
	var boolnom = new Boolean();
	var boolpass = new Boolean();
	boolnom = false;boolpass = false;
	let html = '';
	//comprobamos tabs y espacios del nombre
	for(let i = 0; i< splnombre.length;i++){
		if(splnombre[i] == "\t" || splnombre[i] == " "){
			contnombre++;
		}
	}
	//comprobamos tabs y espacios del password
	for(let i = 0; i< splpassw.length;i++){
		if(splpassw[i] == "\t" || splpassw[i] == " "){
			contpassw++;
		}
	}

	//let cadena = '';
	//Si una de estas dos condiciones coincide se habra producido algun error en el formulario,
	//por eso se inicializa a error.
	if(contnombre == nombre.length || contpassw == password.length){
		html +='<article><h2>Hacer login</h2><p>Tienes los siguientes errores</p>';
	//	cadena += 'Tienes los siguientes errores: \n';
	}
	//Si se cumple esta condicion significa que todos los caracteres de la cadena son o bien tabs o espacios en blanco.
	if(contnombre == nombre.length){
		//cadena += 'El campo nombre es erróneo o está vacío\n';
		html +='<p>El campo nombre es erróneo o está vacío</p>';
		document.getElementById("nombre").style.border = "solid 2px";
		document.getElementById("nombre").style.borderColor="#F00";
		document.getElementById("nombre").focus();
	}
	//Igual que lo de arriba
	if(contpassw == password.length){
		//cadena += 'El campo password es erróneo o está vacío\n';
		html +='<p>El campo password es erróneo o está vacío</p>';
		document.getElementById("password").style.border = "solid 2px";
		document.getElementById("password").style.borderColor="#F00";		
	}
	//El campo del nombre tiene algun caracter diferente de tab y espacio
	if(contnombre < nombre.length){
		document.getElementById("nombre").style.border = "solid 2px";
		document.getElementById("nombre").style.borderColor="#0F0";
		boolnom = true;
	}
	//Igual que arriba pero con password
	if(contpassw < password.length){
		document.getElementById("password").style.border = "solid 2px";
		document.getElementById("password").style.borderColor="#0F0";		
		boolpass = true;
	}
	//Si uno de los dos booleanos es falso nos mostrara el alert con el campo que este mal
	if(boolnom == false || boolpass == false){
		console.log('hola');
		html+='<footer><button class="formu" onclick="cerrarMensajeModal();">Aceptar</button></footer>';
		html +='</article>';
		mensajeModal(html);
	//	alert(cadena);
	}
	//Si ambos campos son verdaderos se habra realizado el inicio de sesion con exito
	if(boolnom == true && boolpass == true){
		//cadena += 'Has iniciado sesión con éxito';
		html +='<article><h2>Hacer login</h2>';
		html += '<p>Has iniciado sesión con éxito</p>'
		html +='<footer><button class="formu" onclick="cerrarMensajeModal();">Aceptar</button></footer>';
		html +='</article>';
		mensajeModal(html);
	//	alert(cadena);
	//	window.location = 'indexLogin.html';
	}
	return false;
}*/
function locationRef(){
	window.location.href = './';
}
/*
function recargarBor(){
    document.getElementById("nombre").style.border = "solid 1px";
    document.getElementById("nombre").style.borderColor="#000";
    document.getElementById("password").style.border = "solid 1px";
    document.getElementById("password").style.borderColor="#000";
    document.getElementById("password1").style.border = "solid 1px";
    document.getElementById("password1").style.borderColor="#000";
    document.getElementById("correo").style.border = "solid 1px";
    document.getElementById("correo").style.borderColor="#000";
}
function comprobarRegistro(){

	var mensaje='';
    var error=0; //contador errores
    //funcion para dejar bordes por defecto
    recargarBor();
    //valores de entrada
    let html = '';
    var nom= document.getElementById("nombre").value;//usuario
    var pass1= document.getElementById("password").value;//contraseña
    var pass2= document.getElementById("password1").value;//repetir contra
    var mail= document.getElementById("correo").value;//email
    var sexo = document.getElementById('sexo').value;//sexo
	var fecha = document.getElementById('fecha').value;//fecha
    
    if(!document.getElementById('ar')){
       	html +='<article id= "ar"><h2>Hacer registro</h2>';
    }

	if(nom =='' || pass1 =='' || pass2== '' || mail=='' || sexo =='' || fecha == ''){
		if(nom == ""){
			mensaje+='El campo nombre está vacío<br>';
			document.getElementById("nombre").style.border = "solid 2px";
			document.getElementById("nombre").style.borderColor="#F00";
			error++;
		}
		if(pass1 == ""){
			mensaje+='El campo password está vacío<br>';
			document.getElementById("password").style.border = "solid 2px";
	    	document.getElementById("password").style.borderColor="#F00";
	    	error++;
		}
		if(pass2 ==""){
			mensaje+='El campo repite password está vacío<br>';
			document.getElementById("password1").style.border = "solid 2px";
	    	document.getElementById("password1").style.borderColor="#F00";
	    	error++;
		}
		if(mail == ""){
			mensaje+='El campo correo está vacío<br>';
			document.getElementById("correo").style.border = "solid 2px";
	    	document.getElementById("correo").style.borderColor="#F00";
	    	error++;
		}
		if(sexo == ""){
			mensaje+='El campo sexo está vacío<br>';
			document.getElementById("sexo").style.border = "solid 2px";
	    	document.getElementById("sexo").style.borderColor="#F00";
	    	error++;
		}
		if(fecha == ""){
			mensaje+='El campo fecha de nacimiento está vacío<br>';
			document.getElementById("fecha").style.border = "solid 2px";
	    	document.getElementById("fecha").style.borderColor="#F00";
	    	error++;
		}
	}
    //comprobar campos no vacios
    if(nom!='' || pass1!='' || pass2!=''|| mail!='' || sexo != '' || fecha != ''){
    
        //**********Validar usuario****************
        if(nom != ""){
        var nomArray= nom.split("");
        if(nomArray.length<3 || nomArray.length>15){
            if(nomArray.length<3){
                error++;
                mensaje+='El nombre de Usuario es demasiado corto<br>';
                document.getElementById("nombre").style.border = "solid 2px";
		        document.getElementById("nombre").style.borderColor="#F00";
		        document.getElementById("nombre").focus();
                
            }else{
                error++;
                mensaje+='El nombre de Usuario es demasiado largo<br>';
                  document.getElementById("nombre").style.border = "solid 2px";
		          document.getElementById("nombre").style.borderColor="#F00";
		          document.getElementById("nombre").focus();
            }
        }else{
            if(comprobar1(nom)==true){
                if(comprobar2(nomArray[0])==true){
                    error++;
                    mensaje+='El nombre no puede empezar por un número<br>';
                    document.getElementById("nombre").style.border = "solid 2px";
		          document.getElementById("nombre").style.borderColor="#F00";
		          document.getElementById("nombre").focus();
                    
                }else{
            
               console.log('Se ha registrado correctamente nombre usuario');
                }
            }else{
                error++;
                mensaje+='Solo letras y números en el nombre<br>';
                document.getElementById("nombre").style.border = "solid 2px";
		          document.getElementById("nombre").style.borderColor="#F00";
		          document.getElementById("nombre").focus();
            }
        }
    }
        
        //***********Validar contraseña*************
        
        var arrayContra= pass1.split("");
        var errorCon=false;
        
        if(pass1 != "" && pass2 != ""){
        if(pass1.length<6 || pass1.length>15){
          
                error++;
                mensaje+='La contraseña debe tener entre 6 y 15 caracteres<br>';
                document.getElementById("password").style.border = "solid 2px";
		        document.getElementById("password").style.borderColor="#F00";
		        document.getElementById("password").focus();
                
           
        }else{
            if(comprobar3(pass1)==true){
                for(let i=0;i<arrayContra.length;i++){
                    if(comprobar1(arrayContra[i])==false&& arrayContra[i]!='-'&&arrayContra[i]!='_'){
                        errorCon=true;

                        
                        document.getElementById("password").style.border = "solid 2px";
                      document.getElementById("password").style.borderColor="#F00";
                      document.getElementById("password").focus();

                    }
                }
                if(errorCon==true){
                    mensaje+='Caracter incorrecto en password<br>';
                    error++;

                }
            }else{
                error++;
                mensaje+='La contraseña debe tener mayusculas, minisculas y al menos un numero (y no debe tener carcateres especiales)<br>';
                        document.getElementById("password").style.border = "solid 2px";
                      document.getElementById("password").style.borderColor="#F00";
                      document.getElementById("password").focus();
            }
            
            
        }
        
        //Comprobar si pass1 y pass2 son iguales
        
        if(pass1!=pass2){
            mensaje+='Las contraseñas no coinciden<br>';
            error++;
            document.getElementById("password").style.border = "solid 2px";
            document.getElementById("password").style.borderColor="#F00";
            document.getElementById("password").focus();
            document.getElementById("password1").style.border = "solid 2px";
            document.getElementById("password1").style.borderColor="#F00";
                     
        }
    }
        //**********Validar Mail*************
        console.log("MAIL: "+mail.indexOf('@'))
        if(mail != ""){
        if(mail.indexOf('@')==-1){
            error++;
            mensaje+='Dirección de correo invalida<br>';
            document.getElementById("correo").style.border = "solid 2px";
            document.getElementById("correo").style.borderColor="#F00";
            document.getElementById("correo").focus();
        }else{
            if(mail.length>254){
                error++;
                mensaje+='Dirección de correo invalida (Demasiado larga)<br>'
                 mensaje+='Dirección de correo invalida<br>';
            document.getElementById("correo").style.border = "solid 2px";
            document.getElementById("correo").style.borderColor="#F00";
            document.getElementById("correo").focus();
                
            }else{
                
                var partes= mail.split("@");
                var local=partes[0];
                var dominio=partes[1];
                if(local.length<1 || dominio.length<1 || local.length>64 || dominio.length>255){
                    error++;
                     mensaje+='Dirección de correo invalida (parte local y/o dominio tamaño incorrecto)<br>'
                     mensaje+='Dirección de correo invalida<br>';
                        document.getElementById("correo").style.border = "solid 2px";
                        document.getElementById("correo").style.borderColor="#F00";
                        document.getElementById("correo").focus();
                    
                   }else{
                       if(validarLocal(local)!=''){
                            error++;
                            mensaje+=validarLocal(local);
                            mensaje+='Dirección de correo invalida<br>';
                            document.getElementById("correo").style.border = "solid 2px";
                            document.getElementById("correo").style.borderColor="#F00";
                            document.getElementById("correo").focus();
                       }
                       if(validarDominio(dominio)!=''){
                       error++;
                       mensaje+=validarDominio(dominio);
                       mensaje+='Dirección de correo invalida<br>';
                       document.getElementById("correo").style.border = "solid 2px";
                       document.getElementById("correo").style.borderColor="#F00";
                       document.getElementById("correo").focus();
                       }
                       
                   }
            }
        }
        
      }  
        
    }

    if(sexo != "" && genero() == false){
    	mensaje += 'Error en el sexo, marca H o h si eres hombre o M o m si eres mujer<br>';
    	document.getElementById("sexo").style.border = "solid 2px";
	    document.getElementById("sexo").style.borderColor="#F00";
    	error++;
    }
    else if(genero() == true){
    	document.getElementById("sexo").style.border = "solid 2px";
	    document.getElementById("sexo").style.borderColor="#0F0";
    }
    if(fecha != "" && fechaNacimiento() == false){
    	mensaje += 'Error en la fecha, tiene que seguir la estructura dd/mm/yyyy y poner una fecha valida<br>';
    	document.getElementById("fecha").style.border = "solid 2px";
	    document.getElementById("fecha").style.borderColor="#F00";
    	error++;
    }
    else{
    	document.getElementById("fecha").style.border = "solid 2px";
	    document.getElementById("fecha").style.borderColor="#0F0";
    }

if(error==0){
    mensaje+='Se ha registrado con exito al usuario';
    html = '<article id= "ar"><h2>Hacer registro</h2>';
    html += '<p>'+mensaje+'</p>'
	html +='<footer><button class="formu" onclick="locationRef();cerrarMensajeModal();">Aceptar</button></footer>';
	html +='</article>';
	mensajeModal(html);

}else{
    mensaje= 'Hay '+error+' fallo/s: <br>'+mensaje;
    html += '<p>'+mensaje+'</p>'
	html +='<footer><button class="formu" onclick="cerrarMensajeModal();">Aceptar</button></footer>';
	html +='</article>';
	mensajeModal(html);
}
// alert(mensaje);

 	return false;  
}
*/
function loadRe(){
    
    document.getElementById("enviar").addEventListener("click",function(){comprobarRegistro()});
    return false;
}
/*
function recargarBor(){
    document.getElementById("nombre").style.border = "solid 1px";
    document.getElementById("nombre").style.borderColor="#000";
    document.getElementById("password").style.border = "solid 1px";
    document.getElementById("password").style.borderColor="#000";
    document.getElementById("password1").style.border = "solid 1px";
    document.getElementById("password1").style.borderColor="#000";
    document.getElementById("correo").style.border = "solid 1px";
    document.getElementById("correo").style.borderColor="#000";
}

function comprobarPass(){
	var pass1= document.getElementById("password").value;//contraseña
    var pass2= document.getElementById("password1").value;//repetir contra
    let html = '';
    if(pass1 == pass2 && pass1 != "" && pass2 !=""){
    	html +='<label style="color: #0F0">Las contraseñas coinciden</label>'; 
    }
    else if(pass1 != pass2 && pass1 != "" && pass2 !=""){
    	html += '<label style="color: #F00">Las contraseñas no coinciden</label>';
    }
    document.querySelector('#crearp').innerHTML = html;
}
*/


function cargarFoto(inp){
	let filereader = new FileReader();
	filereader.onload = function(){

	inp.parentNode.querySelector('img').src = filereader.result;
	};

	filereader.readAsDataURL(inp.files[0]);
}

/*


function comprobar1(cadena){
    //metodo para comprobar que los caracteres sean todos letras y numeros
    var correcto=true;
    var array= cadena.split("");
    var asci=0;
    
    for(let i=0; i<array.length;i++){
        asci=array[i].charCodeAt();
        if((asci>=0&&asci<48)||(asci>57&&asci<65)||(asci>90&&asci<97)||(asci>122)){
            correcto=false;
            console.log('FFF');
        }
    }
    
    return correcto;
}
function comprobar2(cadena){
    //metodo para comprobar que los caracteres sean numeros
    var correcto=true;
    var array= cadena.split("");
    var asci=0;
    
    for(let i=0; i<array.length;i++){
        asci=array[i].charCodeAt();
        if((asci>=0&&asci<48)||(asci>57)){
            correcto=false;
            console.log('FFF2');
        }
    }
    
    return correcto;
}
function comprobar3(cadena){
    //metodo para comprobar que los caracteres sean numeros,texto y caracteres especiales y que haya al menos uno de cada
    var correcto=false;
    var mayus=false;
    var minus= false;
    var num=false;
    var array= cadena.split("");
    var asci=0;
    
    for(let i=0; i<array.length;i++){
        asci=array[i].charCodeAt();
        if(asci>=48&&asci<58){
            num=true;
            }
        if(asci>=65&&asci<91){
            mayus=true;
        }
        if(asci>=97&&asci<123){
            minus=true;
        }
    }
    if(mayus==true&&minus==true&&num==true){
        correcto=true;
    }
    
    return correcto;
}

function validarLocal(local){
    //metodo para comprobar que los caracteres sean todos letras y numeros
    var correcto='';
    var array= local.split("");
    var prev=false;
    
    for(let i=0; i<array.length;i++){
        var c= array[i];
        if(comprobar1(c)==true||c=='!'||c=='#'||c=='$'||c=='%'||c=='&'||c=='\''
          ||c=='*'||c=='+'||c=='-'||c=='/'||c=='='||c=='?'||c=='^'||c=='_'||c=='`'
          ||c=='{'||c=='|'||c=='}'||c=='~'||c=='.'){
            
            console.log('Niceee');
            
            if(c=='.'&&prev==false){
                prev=true;
                if(i==0){
                    correcto='El correo no puede empezar con un punto<br>';
                }
                if(i==array.length){
                     correcto='El correo no puede terminar con un punto<br>';
                }
            }else if(c=='.'&&prev==true){
                correcto='El correo no puede tener dos puntos seguidos<br>';
            } else{
                
                prev=false;
            }
            
        }else{
            correcto='Caracteres invalidos en correo<br>';
        }
    }
    
    return correcto;
}

function validarDominio(cadena){
    //metodo para comprobar que los caracteres sean todos letras y numeros
    var correcto='';
    if(cadena != '.'){
    if(cadena.indexOf('.')!=-1){
     var subdominio= cadena.split(".");
    
    
   
    
    for(let i=0; i<subdominio.length;i++){
        console.log(subdominio[i]);
       if(subdominio[i].length<64&&subdominio[i].length>0){
        if(comprobar1(subdominio[i])==true || subdominio[i].indexOf('-')!=-1){
            if(subdominio[i].charAt(0)=='-'||subdominio[i].charAt(subdominio[i].length-1)=='-' ){
                correcto='El dominio usa caracteres incorrectos(- al principio o final)<br>';
            }
            console.log('NiceeeSub');
        }else{
            correcto='El dominio usa caracteres incorrectos<br>';
        }
       }else{correcto='El subdominio es muy largo o muy corto<br>';}
    }
        }
        else{correcto='El subdominio debe tener un punto<br>';}
   }
   else if(cadena == '.' && cadena.length == 1){
   		correcto = 'El subdominio es inadecuado<br>';
   } 
    return correcto;
}




function genero(){

	var comprobar = new Boolean();
	comprobar = false;
	var sexo = document.getElementById('sexo').value;
	if(sexo == "H" || sexo == "h" || sexo == "M" || sexo == "m"){
		comprobar = true
	}
	return comprobar;
}

function fechaNacimiento(){
	var fecha = document.getElementById('fecha').value;
	var comprobar = new Boolean();
	comprobar = false;
	var split = '';

	if(fecha.includes('/')){
		split = fecha.split('/');
		if(split.length == 3){	
			if(split[0].length == 2  &&  split[1].length ==2 && split[2].length== 4){
				if(parseInt(split[0],10) && parseInt(split[1],10) &&parseInt(split[2],10)){
					var dia = split[0];
					var mes = split[1];
					var anyo = split[2];
					//falta comprobar el anyo
					if(anyo > 1900 && anyo< 2021){
						if(mes == 1){
							if(dia >0 && dia <=31){comprobar = true;}
						}
					    else if(mes == 2){
							if(((anyo%4 ==0)&&(anyo%100!=0))||(anyo%400==0)){
								if(dia >0 && dia <=29){comprobar = true;}
							}
							else{
								if(dia >0 && dia <=28){comprobar = true;}
							}
						}
						else if(mes == 3){
							if(dia >0 && dia <=31){comprobar = true;}
						}
						else if(mes == 4){
							if(dia >0 && dia<=30){comprobar = true;}
						}
						else if(mes == 5){
							if(dia>0 && dia<=31){comprobar = true;}	
						}
						else if(mes == 6){
							if(dia>0 && dia <=30){comprobar = true;}
						}
						else if(mes == 7){
							if(dia>0 && dia<=31){comprobar = true;}	
						}
						else if(mes == 8){
							if(dia>0 && dia<=31){comprobar = true;}	
						}
						else if(mes == 9){
							if(dia>0 && dia <=30){comprobar = true;}
						}
						else if(mes == 10){
							if(dia>0 && dia<=31){comprobar = true;}	
						}
						else if(mes == 11){
							if(dia>0 && dia <=30){comprobar = true;}
						}
						else if(mes == 12){
							if(dia>0 && dia<=31){comprobar = true;}	
						}
					}
				}
			}
		}
	}
	return comprobar;
}
*/

//*******Generar Tabla*********
/*
function generarTabla(){

   var section = document.getElementById('tabcost');
  //  console.log(body);
  // Crea un elemento <table> y un elemento <tbody>
  var tabla   = document.createElement("table");
  var tblBody = document.createElement("tbody");
  tabla.setAttribute('id', 'tablaprec');
  var hilera = document.createElement("tr");
  for (var k = 0; k < 4; k++) {
      // Crea un elemento <td> y un nodo de texto, haz que el nodo de
      // texto sea el contenido de <td>, ubica el elemento <td> al final
      // de la hilera de la tabla
      var celda = document.createElement("td");

      celda.setAttribute('id',"valor"+k)
      if(k==2){
      	  celda.setAttribute('COLSPAN',2);
	      var textoCelda = document.createTextNode("Blanco y negro");
	      celda.appendChild(textoCelda);
	      
  		}
  	if(k==3){
  		  celda.setAttribute('COLSPAN',2);
	      var textoCelda = document.createTextNode("Color");
	      celda.appendChild(textoCelda);
	      
  		}
  		hilera.appendChild(celda);
    }
      tblBody.appendChild(hilera);
 
  // Crea las celdas
  var numfotos = 0;
  var bn =0;
  var bndpi450 = 0;
  var col = 0
  var coldpi450 = 0;
  for (var i = 0; i < 16; i++) {
    // Crea las hileras de la tabla
    var hilera = document.createElement("tr");

    for (var j = 0; j < 6; j++) {
      // Crea un elemento <td> y un nodo de texto, haz que el nodo de
      // texto sea el contenido de <td>, ubica el elemento <td> al final
      // de la hilera de la tabla
      var celda = document.createElement("td");

      if(i==0&&j==0){
      	var textoCelda = document.createTextNode("Número de páginas");
      	}
      else if(i==0&&j==1){
      	var textoCelda = document.createTextNode("Número de fotos");
      	}
       else if(i==0&&j==2){
      	var textoCelda = document.createTextNode("150-300 dpi");
      	}
       else if(i==0&&j==3){
      	var textoCelda = document.createTextNode("450-900 dpi");
      	}
       else if(i==0&&j==4){
      	var textoCelda = document.createTextNode("150-300 dpi");
      	}
      	else if(i==0&&j==5){
      		var textoCelda = document.createTextNode("450-900 dpi");
      	}
      	else{
     		 var textoCelda = document.createTextNode(i+" "+j);
  			}
        else if(i>0){
          if(j == 0){
            var textoCelda = document.createTextNode(i);
          }
          else if(j == 1){
            numfotos+=3;
            var textoCelda = document.createTextNode(numfotos);
          }
          else if(j== 2){
            if(i>0 && i<5){
              bn += 0.10;
            }
            else if(i>=5 && i<=11){
              bn += 0.08;
            }
            else{
              bn += 0.07;
            }
            var textoCelda = document.createTextNode(Number((bn).toFixed(2)));
          }
          else if(j== 3){
            if(i>0 && i<5){
              bndpi450 += 0.16;
            }
            else if(i>=5 && i<=11){
              bndpi450 += 0.14;
            }
            else{
              bndpi450 += 0.13;
            }
            var textoCelda = document.createTextNode(Number((bndpi450).toFixed(2)));
          }
          else if(j== 4){
            if(i>0 && i<5){
              col += (0.10 + 0.15);
            }
            else if(i>=5 && i<=11){
              col += (0.08 + 0.15);
            }
            else{
              col += (0.07 + 0.15);
            }
            var textoCelda = document.createTextNode(Number((col).toFixed(2)));
          }
          else if(j== 5){
            if(i>0 && i<5){
              coldpi450 += (0.10 + 0.15 + 0.06);
            }
            else if(i>=5 && i<=11){
              coldpi450 += (0.08 + 0.15 + 0.06);
            }
            else{
              coldpi450 += (0.07 + 0.15 + 0.06);
            }
            var textoCelda = document.createTextNode(Number((coldpi450).toFixed(2)));
          }
        }

      celda.appendChild(textoCelda);
      hilera.appendChild(celda);
    }
 
    // agrega la hilera al final de la tabla (al final del elemento tblbody)
    tblBody.appendChild(hilera);
  }
 
  // posiciona el <tbody> debajo del elemento <table>
  tabla.appendChild(tblBody);
  // appends <table> into <body>
  section.appendChild(tabla);
  // modifica el atributo "border" de la tabla y lo fija a "2";
//  tabla.setAttribute("border", "1");
 // document.getElementById('tablaprec').style.border = '1px';
  document.getElementById('tablaprec').style.textAlign = 'center';
//  document.getElementById('tablaprec').style.backgroundColor = '#0688fa';

}
*/
function localReg(){
    window.location.href = 'registro.php';
}