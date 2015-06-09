<? include("logadmin.php"); 
	
if ($logadmin) { 

if ($empresa_destino!="") {  $bp=mysql_query("select * from clientes_presupuesto where id_clientes_presupuesto='$id_presupuesto'"); $sp=mysql_fetch_array($bp); $comentarios=$sp[comentario];
							$busco=mysql_query("select * from clientes_presupuesto where enviado!='si' and empresa='$empresa_destino'");
							if ($saco=mysql_fetch_array($busco)) { $encontrado=$saco[0];
																  $elimino=mysql_query("delete from clientes_presupuesto_detalle where presupuesto='$encontrado'");
																 }
																 $creo=mysql_query("insert into clientes_presupuesto (empresa, sucursal, comentario) values ('$empresa_destino','$sucursal', '$comentarios')");
																 $b=mysql_query("select * from clientes_presupuesto order by id_clientes_presupuesto desc"); $s=mysql_fetch_array($b); 
																 
																 $bcom=mysql_query("select * from clientes_presupuesto_detalle where presupuesto='$id_presupuesto' order by id_clientes_presupuesto_detalle desc");
																 while ($scom=mysql_fetch_array($bcom)) {	$unidades=$scom[unidades]; $concepto=$scom[concepto]; $precio=$scom[precio]; $total=$scom[total]; $descuento=$scom[descuento]; $elpresupuesto=$s[0];
																	 										$ingreso=mysql_query("insert into clientes_presupuesto_detalle (unidades, concepto, precio, total, descuento, presupuesto) values ('$unidades','$concepto','$precio','$total', '$descuento', '$elpresupuesto')");
																										} 
																 
								?><script>location.href='clientes_nuevo_presupuesto.php?id=<? echo $empresa_destino; ?>&id_presupuesto=<? echo $elpresupuesto; ?>'</script><?
							 } 


$busco=mysql_query("select * from clientes_presupuesto where id_clientes_presupuesto='$id_presupuesto'");
$saco=mysql_fetch_array($busco);

$b=mysql_query("select * from clientes where id_clientes='$saco[empresa]'");
$s=mysql_fetch_array($b);
 
 
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
    <div style="margin-left:20px; margin-right:20px">
      <div style="float:right; margin-right:10px" align="right">
        <form id="form2" name="form2" method="post" action="#SELF">
         <div style="height:7px"></div>
        </form>
        </div>
      <h1>Clientes &raquo; Reutilizar presupuesto</h1>
      Seleccione el cliente al que desea enviarle el presupuesto<br />
      <br />
      Cliente original: <strong><a href='empresas_reutilizar.php?id_presupuesto=<? echo $id_presupuesto; ?>&empresa_destino=<? echo $s[0]; ?>'><? echo $s[nombre]; ?></a></strong>
<br />
      <br />
      <table style="border:1px solid #E5E5E5" width="930" border="0" cellspacing="3" cellpadding="0">
        <tr >
          <th width="200" height="30" bgcolor="#DBDBDB">Nombre</th>
          <th height="30" align="center" bgcolor="#DBDBDB">E-mail</th>
          <th width="250" height="30" align="center" bgcolor="#DBDBDB">Tel 1</th>
          </tr>
        <? 
		$filtro; $orden;
		 $orden=" order by nombre";  
		 
		
		 $busco=mysql_query("select * from clientes order by apellido, nombre"); 
		while ($saco=mysql_fetch_array($busco)) { 
		
		$link=" style='cursor:pointer; border-bottom:1px dotted #666;' onclick=\"location.href='clientes_reutilizar.php?id_presupuesto=$id_presupuesto&empresa_destino=$saco[0]'\""; 
        if ($saco[desuscripto]=="si") { $fondo=" bgcolor='#FFFF99' "; } else { $fondo=""; } 
		?>
        <tr >
          <td <? echo $link; echo $fondo; ?>><? echo $saco[nombre]; ?></td>
          <td <? echo $link; echo $fondo; ?>><? echo $saco[email1]; ?>&nbsp;</td>
          <td <? echo $link; echo $fondo; ?>><? echo $saco[telefono]; ?>&nbsp;</td>
          </tr>
        <? } ?>
      </table>
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
