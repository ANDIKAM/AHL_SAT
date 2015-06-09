<? include("logadmin.php"); 
	
if ($logadmin) { 


if ($actualizar_tinta) { $detalle="";
						$bi=mysql_query("select * from impresora order by marca, modelo");
			  			while ($si=mysql_fetch_array($bi)) { $num=$si[0]; if ($impresora[$num])
																								{ $detalle.=$si[modelo]." | "; } 
														}
						$corte=strlen($detalle)-3; $detalle=substr($detalle,0,$corte);
						$actualizo=mysql_query("update tinta set nombre='$nombre_tinta', comentarios='$comentarios_tinta', precio='$precio_tinta', impresoras='$detalle' where id_tinta='$id_tinta'");
						?><script>location.href='tintas.php?ssid=<? echo rand(111111,999999); ?>'</script><?
						} 
 
$busco=mysql_query("select * from tinta where id_tinta='$id_tinta'");
$saco=mysql_fetch_array($busco); 
$las_impresoras=$saco[impresoras];


 ?>
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
    <div style="margin-left:20px; margin-right:20px"><h1>Tintas</h1>
        <br />
        <div id="agregartinta" style="margin:20px; padding:10px; border:1px solid #BBBBBB; width:620px; background-color:#E5E5E5">
          <form id="form3" name="form1" method="post" action="#SELF">
          <table width="600" border="0" cellspacing="3" cellpadding="0">
            <tr>
              <td height="30" colspan="2" valign="top" class="titulo">Actualizar tinta</td>
            </tr>
            <tr>
              <td width="84">Nombre</td>
              <td width="507"><label for="marca_impresora2">
                <input style="width:98%" type="text" name="nombre_tinta" id="nombre_tinta" value="<? echo $saco[nombre]; ?>"   />
              </label></td>
            </tr>
            <tr>
              <td>Comentarios</td>
              <td><textarea name="comentarios_tinta" rows="3" id="comentarios_tinta" style="width:98%"><? echo $saco[comentarios]; ?></textarea></td>
            </tr>
            <tr>
              <td>Precio</td>
              <td><input name="precio_tinta" type="text" id="precio_tinta" style="width:98%" value="<? echo $saco[precio]; ?>"   /></td>
            </tr>
            <tr>
              <td>Impresoras</td>
              <td><? $bi=mysql_query("select * from impresora order by marca, modelo");
			  			while ($si=mysql_fetch_array($bi)) {  $pos=strpos($las_impresoras, $si[modelo]);   ?>
                <input type="checkbox" name="impresora[<? echo $si[0]; ?>]" id="impresora[<? echo $si[0]; ?>]" 
			    <? if ($pos===false) {} else {  ?> checked="checked" <? } ?> /> <? echo "$si[marca] - $si[modelo]"; ?><br />
                <? } ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td valign="middle"><input type="submit" name="actualizar_tinta" id="actualizar_tinta" value="  Actualizar  "  />
                <a href="tintas.php" >Cancelar</a></td>
            </tr>
          </table>
        </form>
    </div>
<br />
    </div>    </td>
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
