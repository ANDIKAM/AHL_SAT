<? include("logadmin.php"); 
	
if ($logadmin) {


if ($eliminar) { if ($sucursal=="Arrecife") { $tabla_art="ventas_art_arrecife"; }
					if ($sucursal=="Tias") { $tabla_art="ventas_art_tias"; } 
					
					$b=mysql_query("select * from $tabla_art where id_ventas_art='$id'");
					$s=mysql_fetch_array($b);
					
					$valoritem=$s[total];
													
					if ($sucursal=="Arrecife") { $tabla_facturas="facturas_arrecife"; }
					if ($sucursal=="Tias") { $tabla_facturas="facturas_tias"; } 
					
					$b=mysql_query("select * from $tabla_facturas where id_facturas='$factura'");
					$s=mysql_fetch_array($b);
					
					$nuevototal=$s[total]-$valoritem;

					$actualizo_factura=mysql_query("update $tabla_facturas set total='$nuevototal' where id_facturas='$factura'");
					
					$elimino=mysql_query("delete from $tabla_art where id_ventas_art='$id'");  
					
					
				 ?><script>location.href='facturas_editar.php?id=<?  echo $factura;  ?>'</script><? } 


 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
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
      <h1>Eliminar item<br />
        <br />
      </h1>
      <form id="form1" name="form1" method="post" action="">
        <div align="center">¿ Está seguro que desea eliminar el item ?
          <br />
            <br />
            <input type="submit" name="eliminar" id="eliminar" value="Si, eliminar" />
            &nbsp;&nbsp;&nbsp;<a href="#" onClick="location.href='facturas_editar.php?id=<? echo $factura;  ?>'">No, cancelar</a>          </div>
      </form>
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
