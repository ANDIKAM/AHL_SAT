<? include("logadmin.php"); 
if (isset($_REQUEST["UpdatePago"]) && $_REQUEST["UpdatePago"]=="S"){
    if($_REQUEST["Uforma"]=='Otro'){
        $_REQUEST["Uforma"]=$_REQUEST["Uforma2"];
    }
    $NewSELECT="UPDATE ".$_REQUEST["TablaFactura"]." SET forma='".$_REQUEST["Uforma"]."' WHERE id_facturas=".$_REQUEST["IDFactura"];
    $busco=mysql_query($NewSELECT);
    $saco=mysql_fetch_array($busco);
}	
if ($logadmin) { 

if ($sucursal=="Arrecife") { $tabla_facturas="facturas_arrecife"; }
if ($sucursal=="Tias") { $tabla_facturas="facturas_tias"; } 
if ($sucursal=="Centro") { $tabla_facturas="facturas_centro"; } 
														
$busco=mysql_query("select * from $tabla_facturas where id_facturas='$id'");
$saco=mysql_fetch_array($busco);

if ($sucursal=="Arrecife") { $tabla_computadoras="computadoras_arrecife";  $tabla_repmovil="repmovil_arrecife"; $tabla_libmovil="libmovil_arrecife"; $tabla_consolas="consolas_arrecife";  }
if ($sucursal=="Tias") { $tabla_computadoras="computadoras_tias";  $tabla_repmovil="repmovil_tias"; $tabla_libmovil="libmovil_tias";   $tabla_consolas="consolas_tias"; } 
if ($sucursal=="Centro") { $tabla_computadoras="computadoras_centro";  $tabla_repmovil="repmovil_centro"; $tabla_libmovil="libmovil_centro";   $tabla_consolas="consolas_centro"; } 

				  
if ($saco[tipo]=="rp") { $bo=mysql_query("select * from $tabla_computadoras where id_computadoras='$saco[caso]'"); }
if ($saco[tipo]=="rm") { $bo=mysql_query("select * from $tabla_repmovil where id_repmovil='$saco[caso]'"); }
if ($saco[tipo]=="lm") { $bo=mysql_query("select * from $tabla_libmovil where id_libmovil='$saco[caso]'"); }
if ($saco[tipo]=="rc") { $bo=mysql_query("select * from $tabla_consolas where id_consolas='$saco[caso]'"); }

if ($sucursal=="Arrecife") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Tias") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Centro") { $tabla_empresas=" empresas_integradas "; } 

$so=mysql_fetch_array($bo);

if ($saco[clase]!='empresa') {
$bc=mysql_query("select * from clientes where id_clientes='$saco[cliente]'");
$sc=mysql_fetch_array($bc); 
} else {
		$bc=mysql_query("select * from $tabla_empresas where id_empresa='$saco[cliente]'");
	    $sc=mysql_fetch_array($bc); 
		}
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AHL Informatica</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></head>

<body>
<table width="680" border="0" align="center" cellpadding="0" cellspacing="3">
  <tr>
    <td colspan="2"><img src="images/LOGO-AHL-2.png" width="278" height="102" /></td>
  </tr>
  <tr>
    <td width="50%" rowspan="4" valign="top">
    <? if ($sucursal=="Tias") { ?>
        C.\ Libertad, 55<br />
        35572 - T&iacute;as<br />
        TF/FAX: 928.52.40.75<br />
        ahltias@hotmail.com<br />
        <? } 
		if ($sucursal=="Arrecife")  { ?>
      C/ Puerto Rico, 50<br />
      35500 - Arrecife de Lanzarote<br />
      TF/FAX: 928.80.50.93<br />
      info@ahlinformatica.com<br />
      <? } 
	   if ($sucursal=="Centro") {
		   						?>
                                C.\ ALFEREZ CABRERA TAVIO, 3<br />
                                35500 - ARRECIFE DE LANZAROTE <br />
                                TFNO: 928.597119<br />
                                arrecifecentro@ahlinformatica.com<br />
								<?
								} ?>
      CIF: B35859412
      </td>
    <td align="right">Fecha: <strong><?echo substr($saco[fecha],0,16)." hs."; ?>&nbsp;</strong></td>
  </tr>
  <tr>
   <td align="right">N&uacute;mero de factura: <strong>F<?  if ($saco[venta]=="si") { echo "VF"; } echo strtoupper($saco[tipo]); ?><? if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[0]);  ?>&nbsp; </strong></td>
  </tr>
  <tr>
    <td align="right" class="texto_chico"><? if ($saco[venta]!="si") { ?><em>Parte de reparaci&oacute;n: <? echo strtoupper($saco[tipo]); if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[caso]);  ?></em><? } else { echo "&nbsp;"; } ?>
    &nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="40" colspan="2" class="titulo">Datos del Cliente</td>
  </tr>
  <tr>
    <td><? echo "<strong>$sc[apellido] $sc[nombre]</strong>"; ?></td>
    <td ><? if ($saco[clase]!='empresa') { ?>
      <? echo "$sc[email1]"; ?>
    <? } else { echo $sc[email]; } ?></td>
  </tr>
  
  
  <tr>
    <td><? if ($saco[clase]!='empresa') {  echo $sc[direccion]." ".$sc[cp]; } else { echo "$sc[calle] <em>$sc[codigopostal]</em> $sc[localidad]"; } ?></td>
    <td ><? if ($saco[clase]!='empresa') { ?>
      DNI: <strong><? echo $sc[dni]; ?></strong>
    <? } else { echo "CIF: <strong>$sc[cif]</strong>"; } ?></td>
  </tr>
  
  <tr>
    <td colspan="2" class="titulo">&nbsp;</td>
  </tr>
  <tr><? $estilo="style='border-bottom:1px dotted #666'"; ?>
    <td colspan="2"><table width="670" border="0" cellspacing="0" cellpadding="4" style="border:1px solid #666">
      <tr <? echo $estilo; ?>>
        <td  width="50" height="30" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>UDS</strong></td>
        <td  height="30" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>CONCEPTO</strong></td>
        <td  width="120" height="30" align="right" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>PRECIO</strong></td>
        <td  width="120" height="30" align="right" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>TOTAL</strong></td>
      </tr>
      <? if ($saco[aprobado]=="si" and $saco[venta]!="si") { ?>
      <tr >
        <td <? echo $estilo; ?> >1</td>
        <td <? echo $estilo; ?> >Mano de obra</td>
        <td <? echo $estilo; ?>  align="right"><? echo $so[presupuesto]; ?> &#8364; </td>
        <td <? echo $estilo; ?>  align="right"><? echo $so[presupuesto]; ?> &#8364; </td>
      </tr>
      <? 
	  
	  	if ($sucursal=="Arrecife") { $tablacomp="componentes_arrecife"; }
		if ($sucursal=="Tias") { $tablacomp="componentes_tias"; } 
		if ($sucursal=="Centro") { $tablacomp="componentes_centro"; } 
				
				
	  	$bcom=mysql_query("select * from $tablacomp where clase='$saco[tipo]' and id='$saco[caso]'");
		while ($scom=mysql_fetch_array($bcom)) { 
													?>
												   <tr>
													<td <? echo $estilo; ?> ><? echo $scom[unidades]; ?></td>
													<td <? echo $estilo; ?> ><? echo nl2br(utf8_encode($scom[descripcion])); ?></td>
													<td <? echo $estilo; ?>  align="right"><? echo $scom[precio]; ?> &#8364; </td>
													<td <? echo $estilo; ?>  align="right"><? echo $scom[total]; ?> &#8364; </td>
												  </tr>
												  <? } ?>
      
      <? } else { if ($saco[venta]!="si") { ?>
                  <tr>
                    <td <? echo $estilo; ?> >1</td>
                    <td <? echo $estilo; ?> >Elaboraci&oacute;n de presupuesto</td>
                    <td <? echo $estilo; ?>  align="right">12.00 &#8364; </td>
                    <td <? echo $estilo; ?>  align="right">12.00 &#8364; </td>
                  </tr>
                  <? } ?>
     
      <? } ?>
      <? if ($saco[venta]=="si") { 
      				
					if ($sucursal=="Arrecife") { $tabla_art="ventas_art_arrecife"; }
					if ($sucursal=="Tias") { $tabla_art="ventas_art_tias"; }
					if ($sucursal=="Centro") { $tabla_art="ventas_art_centro"; }
					
					$bo=mysql_query("select * from $tabla_art where id='$id'");
					while ($so=mysql_fetch_array($bo)) { 
												?><tr>
												<td <? echo $estilo; ?> ><? echo $so[unidades]; ?></td>
												<td <? echo $estilo; ?> ><? $concepto=limpiar($so[concepto]); echo nl2br($concepto); ?></td>
												<td <? echo $estilo; ?>  align="right"><? echo $so[precio]; ?> &#8364; </td>
												<td <? echo $estilo; ?>  align="right"><? echo $so[total]; ?> &#8364; </td>
											  </tr>
                                              <? } ?>
                  
                  <? } ?>
      <tr ><td  height="40" colspan="3" align="right" class="texto"><strong>Forma de pago:</strong></td>
        <td   align="right" class="texto"><strong><?  echo $saco[forma]; ?></strong></td>
      </tr>
      <tr >
        <td colspan="3" align="right"><strong> Empresa minorista exenta de IGIC</strong></td>
        <td   align="right" class="titulo">&nbsp;</td>
      </tr>
      <tr >
        <td  height="20" colspan="3" align="right" class="titulo">Importe de la factura: </td>
        <td   align="right" class="titulo"><?  echo $saco[total]; ?>
          &#8364;
          <?   ?></td>
        </tr>

    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" colspan="2" align="center"><img src='barras/image.php?code=F<?  if ($saco[venta]=="si") { echo "VF"; }  echo strtoupper($saco[tipo]); ?><? if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[0]);  ?>&amp;style=68&amp;type=C128B&amp;width=210&amp;height=55&amp;xres=1&amp;font=3&amp;drawtext=on&amp;output=jpeg&amp;border=off' alt="" name="RP<? if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[0]); $saco[0]; ?>.jpg" id="RP<? if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[0]); $saco[0]; ?>.jpg" /></td>
  </tr>
  
  
  
  <tr>
    <td colspan="2" align="center" style="border-bottom:1px dotted #666">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="button" name="button" id="button" value="     Imprimir factura      " onclick="location.href='facturas_imprimir.php?id=<? echo $id; ?>'" /> &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" name="actualizar" id="button2" value="    Volver      " onclick="location.href='facturas.php'" />
    </td>
  </tr>
</table>
</body>
</html>
<? if ($cqm=="136187236452") { ?><? } ?>
<? } else { ?><script>location.href='login.php'</script><? } ?>