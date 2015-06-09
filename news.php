<? include("logadmin.php"); 
	
if ($logadmin) { 


if ($subir) {		
					$fecha = time ();
					$fecha=$fecha-8100; // Con esto lo pongo en cero
					$hora=date ( "H" , $fecha ); 
					$minuto=date ( "i" , $fecha );
					$ano=date ( "Y" , $fecha );
					$mes=date ( "m" , $fecha );
					$dia=date ( "d" , $fecha );
					$hora=date ( "H" , $fecha ); 
					$minuto=date ( "i" , $fecha );
					$lafechadehoy="$ano-$mes-$dia $hora:$minuto:$segundo";

					$nombre=$_FILES['archivo']['name'];
					$tipodearchivo=$_FILES['archivo']['type']; 
					
					$nombre= ereg_replace( " ", "_", $nombre );
					
					$busco=mysql_query("select * from news order by id_news desc");
					$saco=mysql_fetch_array($busco);
					$numero=$saco[0]+1;
					if (strlen($numero)==1) { $numero="000".$numero; }
					if (strlen($numero)==2) { $numero="00".$numero; }
					if (strlen($numero)==3) { $numero="0".$numero; }
					
					$numero.="-";
							
					$dir="news/";
					move_uploaded_file($_FILES['archivo']['tmp_name'], $dir.$numero.$nombre);
					
					$elarchivo=$numero.$nombre;
					
					$ingreso=mysql_query("insert into news (archivo, enviado, asunto, creado ) values ('$elarchivo','no', '$asunto', '$lafechadehoy')"); 
					
					?><script>location.href='news.php?sbo=true'</script><?
			} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<? include("funciones.php"); ?>
</head>

<body>
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
      <br />
      <span style="cursor:pointer;" onclick="mostrar('subirnews');">[+] Nuevo Newsletter</span><br />
        <br />
      
      <div id="subirnews" style="display:<? echo "none"; ?>; border:1px dotted #666; background-color:#FAF8A0; padding:10px; width:400px">
      <form  id="formulario" name="form1" method="post" action="#SELF" enctype="multipart/form-data">
        Selecciona el archivo a enviar en el Newsletter<br /><br />
        <table width="95%" border="0" cellspacing="5" cellpadding="0">
          <tr>
            <td>Newsletter:</td>
            <td><input type="file" name="archivo" id="archivo"  /></td>
          </tr>
          <tr>
            <td>Asunto</td>
            <td><label for="asunto"></label>
              <input style="width:97%" type="text" name="asunto" id="asunto" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="subir" id="subir" value="Subir" /> 
              &nbsp;&nbsp;&nbsp;<a href="#" onclick="ocultar('subirnews');">Cancelar</a></td>
          </tr>
        </table>
        &nbsp;
      </form>
      </div>
      <br />
      <table width="900" border="0" cellpadding="5" cellspacing="0" class="texto" style="border:1px solid #666">
        <tr>
          <td bgcolor="#E2E2E2"><strong>Asunto</strong></td>
          <td width="140" align="center" bgcolor="#E2E2E2"><strong>Creado</strong></td>
          <td width="60" align="center" bgcolor="#E2E2E2"><strong>Enviado</strong></td>
          <td width="140" align="center" bgcolor="#E2E2E2"><strong>Fecha envío</strong></td>
          <td width="89" align="center" bgcolor="#E2E2E2"><strong>Destinatarios</strong></td>
          </tr>
          <? $busco=mysql_query("select * from news order by creado desc");
		  	while ($saco=mysql_fetch_array($busco))  { ?>
        <tr>
          <td><a href='http://sat.ahlinformatica.com/news/<? echo $saco[archivo]; ?>' target="_blank"><? echo $saco[asunto]; ?></a>&nbsp;</td>
          <td align="center"><? echo substr ($saco[creado],0,16)." hs."; ?>&nbsp;</td>
          <td align="center"><? if ($saco[enviado]=="si") { ?><img src="images/tilde.png" /><? }  else { ?><a href='news_enviar.php?id=<? echo $saco[0]; ?>'>Enviar</a><? } ?></td>
          <td align="center"><? if ($saco[fecha]!="0000-00-00 00:00:00") { echo $saco[fecha]; } ?>&nbsp;</td>
          <td align="center"><? if ($saco[destinatarios]!="0") { echo $saco[destinatarios]; }  ?>&nbsp;</td>
          </tr>
          <? } ?>
    </table>
<br />
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
