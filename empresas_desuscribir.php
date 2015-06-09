<? include("logadmin.php"); 
	



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
      <h1>Newsletter</h1>
      <p>
      
      <? $busco=mysql_query("select * from empresas_arrecife where email='$mail'");
	  	 $saco=mysql_fetch_array($busco);
	  	  if ($saco[codigo]==$cls) {
			  						$actualizo=mysql_query("update empresas_arrecife set activo='no', desuscripto='si', fecha_desuscripto='$lafechadehoy' where id_empresa='$saco[0]'");
									?>Te has desuscripto de la lista de newsletters de AHL.<?
			  						} ?>
      </p>
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

