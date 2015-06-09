<? include("logadmin.php"); 
	
if ($logadmin) {  


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
      <h1>Facturas</h1>
      <a href='facturas_exportar.php'>[+] Exportar</a><br />
      
        <? 
	  	 
		 if ($sucursal=="Arrecife") { $tabla_facturas="facturas_arrecife"; }
		 if ($sucursal=="Tias") { $tabla_facturas="facturas_tias"; }
		 if ($sucursal=="Centro") { $tabla_facturas="facturas_centro"; } 
		
											
	     $busco=mysql_query("select * from $tabla_facturas where forma IN ('Efectivo','Tarjeta','Talon','Transferencia Bancaria BBVA','Transferencia Bancaria BANKIA','Transferencia Bancaria CAIXA','') order by id_facturas desc");
             //IN ('Efectivo','Tarjeta','Talon','Transferencia Bancaria BBVA','Transferencia Bancaria BANKIA','Transferencia Bancaria CAIXA','')
	     $cnt=mysql_num_rows($busco); 
		 if ($cnt>0) { ?>
      <br />
      <table id="facturas" style="border:1px solid #E5E5E5" width="930" border="0" cellspacing="3" cellpadding="0">
        <thead>
            <tr >
              <th width="170" bgcolor="#DBDBDB">Fecha</th>
              <th width="100" bgcolor="#DBDBDB">Número</th>
              <th width="100" bgcolor="#DBDBDB">Parte</th>
              <th bgcolor="#DBDBDB">Cliente</th>
              <th width="98" height="30" bgcolor="#DBDBDB">Total</th>
              <th width="60" bgcolor="#DBDBDB">Pago</th>
              <th width="60" bgcolor="#DBDBDB">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <? 
		
		
		
		
		while ($saco=mysql_fetch_array($busco)) { 
		$link=" style='cursor:pointer; border-bottom:1px dotted #666;' onclick=\"location.href='facturas_detalle.php?id=$saco[0]'\""; ?>
        <tr>
          <td <? echo $link; ?>><? echo substr($saco[fecha],0,16)." hs."; ?></td>
          <td align="center" <? echo $link; ?>><strong>F<?  if ($saco[venta]=="si") { echo "VF"; }    echo strtoupper($saco[tipo]); ?><? if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[0]);  ?>
            &nbsp; </strong></td>
          <td align="center" style='border-bottom:1px dotted #666;'><a href='<? if ($saco[tipo]=="rp") { echo "computadoras"; }  if ($saco[tipo]=="rm") { echo "repmoviles"; } if ($saco[tipo]=="rc") { echo "consolas"; } if ($saco[tipo]=="lm") { echo "libmoviles"; }   ?>_editar.php?id=<? echo $saco[caso]; ?>'><? if ($saco[venta]!="si") {   echo strtoupper($saco[tipo]); if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[caso]);    } ?></a>&nbsp;</td>
          <td <? echo $link; ?>><? if ($saco[clase]!='empresa') { 
		  														$b=mysql_query("select * from clientes where id_clientes='$saco[cliente]'"); 
																$s=mysql_fetch_array($b);
																echo "$s[apellido] $s[nombre]"; 
																} else { 
																			if ($sucursal=="Arrecife") { $tabla_empresas=" empresas_integradas "; }
																			if ($sucursal=="Tias") { $tabla_empresas=" empresas_integradas "; }
																			if ($sucursal=="Centro") { $tabla_empresas=" empresas_integradas "; } 
																			$b=mysql_query("select * from $tabla_empresas where id_empresa='$saco[cliente]'"); 
																			$s=mysql_fetch_array($b);
																			echo "<span class='nombre_empresa'>$s[nombre]</span>";
																			}   ?></td>
          <td <? echo $link; ?>><? echo $saco[total]; ?> &#8364;</td>
          <td style='border-bottom:1px dotted #666;' align="center"><? echo $saco[forma]; ?></td>
          <td style='border-bottom:1px dotted #666;' align="center"><?  if ($saco[venta]=="si") { ?>
            <a href="facturas_editar.php?id=<? echo $saco[0]; ?>">Editar</a>            <? } else { echo "&nbsp;"; } ?></td>
        </tr>
        <? } ?>
      </tbody>
      </table>
      <? } else { ?>No hay facturas<? } ?>
      
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
