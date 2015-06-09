<script>


OCULTO="none";
VISIBLE="block";

function mostrar(blo) {
document.getElementById(blo).style.display=VISIBLE;
}

function ocultar(blo) {
document.getElementById(blo).style.display=OCULTO;
}

function versinuevo () {
						if (document.getElementById('buscar').checked==false) { mostrar ('nuevocliente'); ocultar('buscarcliente');  }
						else { mostrar ('buscarcliente'); ocultar('nuevocliente'); }
}


function nuevoAjax(){
	var xmlhttp=false;
 	try {
 		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
 	} catch (e) {
 		try {
 			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
 		} catch (E) {
 			xmlhttp = false;
 		}
  	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
 		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}


function cargar_componente_rp(cant,desc,precio,id,nocache)
{
	var  loscomponentes;
	loscomponentes = document.getElementById('loscomponentes');
	
	ajax1=nuevoAjax();
	ajax1.open("GET", "cargarcomponentes.php?clase=rp&cant="+cant+"&desc="+desc+"&precio="+precio+"&id="+id+"&nocache="+nocache,true);
	ajax1.onreadystatechange=function() {
		
		if (ajax1.readyState==4) {
		loscomponentes.innerHTML = ajax1.responseText
	 	}
	}
	ajax1.send(null)
}

function cargar_componente_rm(cant,desc,precio,id,nocache)
{
	var  loscomponentes;
	loscomponentes = document.getElementById('loscomponentes');
	
	ajax1=nuevoAjax();
	ajax1.open("GET", "cargarcomponentes_rm.php?clase=rm&cant="+cant+"&desc="+desc+"&precio="+precio+"&id="+id+"&nocache="+nocache,true);
	ajax1.onreadystatechange=function() {
		
		if (ajax1.readyState==4) {
		loscomponentes.innerHTML = ajax1.responseText
	 	}
	}
	ajax1.send(null)
}

function cargar_componente_rc(cant,desc,precio,id,nocache)
{
	var  loscomponentes;
	loscomponentes = document.getElementById('loscomponentes');
	
	ajax1=nuevoAjax();
	ajax1.open("GET", "cargarcomponentes_rc.php?clase=rc&cant="+cant+"&desc="+desc+"&precio="+precio+"&id="+id+"&nocache="+nocache,true);
	ajax1.onreadystatechange=function() {
		
		if (ajax1.readyState==4) {
		loscomponentes.innerHTML = ajax1.responseText
	 	}
	}
	ajax1.send(null)
}

function cargar_componente_lm(cant,desc,precio,id,nocache)
{
	var  loscomponentes;
	loscomponentes = document.getElementById('loscomponentes');
	
	ajax1=nuevoAjax();
	ajax1.open("GET", "cargarcomponentes_lm.php?clase=lm&cant="+cant+"&desc="+desc+"&precio="+precio+"&id="+id+"&nocache="+nocache,true);
	ajax1.onreadystatechange=function() {
		
		if (ajax1.readyState==4) {
		loscomponentes.innerHTML = ajax1.responseText
	 	}
	}
	ajax1.send(null)
}

function cargarclientes(cliente, nocache) 
{
var  listadeclientes;
	listadeclientes = document.getElementById('listadeclientes');
	nocache = document.getElementById('nocache').value;
	
	ajax10=nuevoAjax();
	ajax10.open("GET", "cargarlistadeclientes.php?cliente="+cliente+"&nocache="+nocache,true);
	ajax10.onreadystatechange=function() {
		
		if (ajax10.readyState==4) {
		listadeclientes.innerHTML = ajax10.responseText
	 	}
	}
	ajax10.send(null)
}

function cargarempresas(cliente, nocache) 
{
var  listadeclientes;
	listadeclientes = document.getElementById('listadeclientes');
	nocache = document.getElementById('nocache').value;
	
	ajax10=nuevoAjax();
	ajax10.open("GET", "cargarlistadeempresas.php?cliente="+cliente+"&nocache="+nocache,true);
	ajax10.onreadystatechange=function() {
		
		if (ajax10.readyState==4) {
		listadeclientes.innerHTML = ajax10.responseText
	 	}
	}
	ajax10.send(null)
}



function  habilitar_enviar()
{
	if (document.getElementById('nombre').value!='' & document.getElementById('apellido').value!='' & document.getElementById('dni').value!='') 
		{
			document.getElementById('agregar').disabled=false;
		}  else { document.getElementById('agregar').disabled=true; } 
}

function habilitado_enviar()
{
document.getElementById('agregar').disabled=false;
}


window.history.forward(1);

</script>