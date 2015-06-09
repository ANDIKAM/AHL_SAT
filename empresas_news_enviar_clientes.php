<? include("logadmin.php"); 
	
if ($logadmin) { 

$busco=mysql_query("select * from news where id_news='$id'");
$saco=mysql_fetch_array($busco);
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<script>

function enviarmensaje() 
{
var  enviando;
	enviando = document.getElementById('enviando');
	nocache = document.getElementById('nocache').value;
	
	ajax10=nuevoAjax();
	ajax10.open("GET", "enviar_ajax_empresas_clientes.php?id=<? echo $id; ?>&nocache="+nocache,true);
	ajax10.onreadystatechange=function() {
		
		if (ajax10.readyState==4) {
		enviando.innerHTML = ajax10.responseText
	 	}
	}
	ajax10.send(null)
}

function enviar()
   {
           setInterval('enviarmensaje()',8000);
		   
   }
</script><? include("funciones.php"); ?>
</head>

<body onload="enviar();">
<table width="979" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="337"><img src="images/LOGO-AHL.png" /></td>
    <td width="642" align="right"><? include("encabezado.php"); ?>
      <div align="left"><img src="images/sat.png" width="257" height="41" vspace="10" /></div>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><? include("menu.php"); ?></td>
  </tr>
  
  <tr>
    <td height="17" colspan="2" background="images/top.png"></td>
  </tr>
  <tr>
    <td height="500" colspan="2" valign="top" background="images/medio.png">
    <div style="margin-left:20px; margin-right:20px">
      <h1>Newsletter</h1>
      <br />Enviando Newsletter: <? echo $saco[asunto]; ?><br />
      <br />
      <div id="enviando">Enviando...<input type="hidden" id="nocache" name="nocache" value="<? echo rand(111111,999999);?>" /></div>
      
    </div></td>
  </tr>
  <tr>
    <td height="17" colspan="2" background="images/abajo.png"></td>
  </tr>
   <tr>
    <td height="17" colspan="2"><? include("pie.php"); ?></td>
  </tr>
</table>
</body>
</html>
<? } else { ?><script>location.href='login.php'</script><? } ?>
