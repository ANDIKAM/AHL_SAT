<? include("logadmin.php"); 
	
if ($logadmin) { ?>
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
      <h1>Servicio de Asistencia Técnica</h1>
      <p><br />
        Ingrese los datos de su orden de reparación.<br />
        Puede encontrar el número de parte en el margen superior derecho de su hoja de reparación.<br />
        <br />
      </p>
      <table width="507" border="0" align="center" cellpadding="0" cellspacing="5" style="border: 1px dotted #666">
        <tr>
          <td width="44">Parte: </td>
          <td width="448"><input name="parte" type="text" id="parte" size="50" /> 
            <span class="texto_chico">Ejemplo: <strong>PCT00001</strong></span></td>
        </tr>
        <tr>
          <td>DNI:</td>
          <td><input name="dni" type="text" id="dni" size="50" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" name="button" id="button" value="Consultar" /></td>
        </tr>
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
