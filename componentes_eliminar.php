<? include("logadmin.php"); 
	
if ($logadmin) {


if ($eliminar) { if ($sucursal=="Arrecife") { $tabla="componentes_arrecife"; }
			    if ($sucursal=="Tias") { $tabla="componentes_tias"; } 
				
					$elimino=mysql_query("delete from $tabla where id_componentes='$idcom'");  
				 ?><script>location.href='<? if ($clase=="rp") { echo "computadoras_editar.php?"; } if ($clase=="rm") { echo "repmoviles_editar.php?"; }  if ($clase=="rm") { echo "libmoviles_editar.php?"; } if ($clase=="rc") { echo "consolas_editar.php?"; }  echo "id=$id";  ?>'</script><? } 


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
      <h1>Eliminar componente<br />
        <br />
      </h1>
      <form id="form1" name="form1" method="post" action="">
        <div align="center">¿ Está seguro que desea eliminar el componente ?
          <br />
            <br />
            <input type="submit" name="eliminar" id="eliminar" value="Si, eliminar" />
            &nbsp;&nbsp;&nbsp;<a href="#" onClick="location.href='<? if ($clase=="rp") { echo "computadoras_editar.php?"; } 
																	 if ($clase=="rm") { echo "repmoviles_editar.php?"; }  
																	 if ($clase=="lm") { echo "libmoviles_editar.php?";  }
																	 if ($clase=="rc") { echo "consolas_editar.php?"; }  echo "id=$id";  ?>'">No, cancelar</a>          </div>
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
