<? include("logadmin.php"); 
	
if ($logadmin) { 

if ($sucursal=="Arrecife") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Tias") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Centro") { $tabla_empresas=" empresas_integradas "; } 


if ($eliminar) {
				$ingreso=mysql_query("delete from $tabla_empresas where id_empresa='$id'"); 
				?><script>location.href='empresas_lista.php?ssid=<? echo rand(111111,999999); ?>'</script><? }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<? include("funciones.php"); ?>
<style type="text/css">
<!--
.style1 {color: #EEEEEE}
-->
</style>
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
      <h1>Clientes &raquo; Eliminar</h1>
      <br />
      <form id="form1" name="form1" method="post" action="">
        <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center">¿ Está seguro que desea eliminar la empresa ?<br />
              <br />
              <input type="submit" name="eliminar" id="button" value="Si, eliminar" />
              &nbsp;&nbsp; <a href="#" onClick="Javascript:history.back();">No, cancelar</a><br /></td>
          </tr>
        </table>
        </form>
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
