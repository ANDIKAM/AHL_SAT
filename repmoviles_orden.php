<? include("logadmin.php");
header("Content-Type: text/html;charset=utf-8");
$xml = file_get_contents($_SERVER["DOCUMENT_ROOT"].$prefijo.'/whatsapp/whatsappconf.xml');
$DOM = new SimpleXMLElement($xml);
$userphone = strval($DOM->WhatsappConfs->WhatsappConf[0]->userphone);
$codpais = strval($DOM->WhatsappConfs->WhatsappConf[0]->codpais);
if ($logadmin) { 

if ($sucursal=="Arrecife") { $tabla="repmovil_arrecife"; }
if ($sucursal=="Tias") { $tabla="repmovil_tias"; }
if ($sucursal=="Centro") { $tabla="repmovil_centro"; }
								
$busco=mysql_query("select * from $tabla where id_repmovil='$id'");
$saco=mysql_fetch_array($busco);

$bc=mysql_query("select * from clientes where id_clientes='$saco[cliente]'");
$sc=mysql_fetch_array($bc); 
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
    <td width="50%" rowspan="4" valign="top"><? if ($sucursal=="Tias") { ?>
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
      CIF: B35859412 </td>
    <td align="right">Fecha: <strong><? echo $saco[fecha]; ?></strong></td>
  </tr>
  <tr>
    <td align="right">Parte: <strong>RM<? if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Centro") {  echo "C"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[0]); $saco[0]; ?>
    </strong></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="40" colspan="2" class="titulo">Datos del Cliente</td>
  </tr>
  <tr>
    <td><? echo "<strong>$sc[apellido], $sc[nombre]</strong>"; ?></td>
    <td rowspan="5" style="border-bottom:1px dotted #666">&nbsp;</td>
  </tr>
  <tr>
    <td><? echo $sc[direccion]." ".$sc[cp]; ?></td>
  </tr>
  <tr>
    <td><? echo "$sc[email1] / $sc[email2]"; ?></td>
  </tr>
  <tr>
    <td>Movil: <? echo "$sc[movil1] / $sc[movil2]"; ?></td>
  </tr>
  <tr>
    <td>Tel: <? echo $sc[telefono]; ?></td>
  </tr>
  <tr>
    <td>DNI: <strong><? echo $sc[dni]; ?></strong></td>
    <td align="center">Firma y nombre legible del cliente</td>
  </tr>
  <tr>
    <td height="20" colspan="2" class="titulo"></td>
  </tr>
  <tr>
    <td height="40" colspan="2" class="titulo">Datos del Equipo</td>
  </tr>
  <tr>
    <td><? echo "<strong>$saco[marca] $saco[modelo]</strong>";?></td>
    <td rowspan="4" valign="top"><strong>Aver&iacute;a:</strong> <? echo $saco[averia]; 
	if ($saco[extras]!="") { echo "<br><br><strong>Observaciones:</strong> $saco[extras]"; } ?></td>
  </tr>
  <tr>
    <td>IMEI: <? echo $saco[imei]; ?></td>
  </tr>
  <tr>
    <td>Deja cargador: <? echo $saco[cargador]; ?> </td>
  </tr>
  <tr>
    <td>Deja bater&iacute;a: <? echo $saco[bateria]; ?></td>
  </tr>
  
  <? if ($saco[solucion]!="") {
  ?>
  <tr>
    <td height="30" colspan="2"><strong>Trabajo a realizar</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo $saco[solucion]; ?></td>
  </tr><? } ?>
  
  
  <? if ($saco[trabajo]!="") {
  ?>
  <tr>
    <td height="30" colspan="2"><strong>Trabajo realizado</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo $saco[trabajo]; ?></td>
  </tr><? } ?>
  
  <tr>
    <td colspan="2" align="center"><img src='barras/image.php?code=RM<? if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[0]); $saco[0]; ?>&style=68&type=C128B&width=210&height=55&xres=1&font=3&drawtext=on&output=jpeg&border=off' name="RM<? if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[0]); $saco[0]; ?>.jpg"></td>
  </tr>
  
  <tr>
    <td colspan="2" style="border-bottom:1px dotted #666">&nbsp;</td>
  </tr>
  
  
 
  <tr>
    <td colspan="2"><span class="texto_chico"><? $b=mysql_query("select * from textos where id_textos='1'"); $s=mysql_fetch_array($b);
						echo utf8_encode(nl2br($s[texto])); ?></span></td>
  </tr>
  <tr>
    <td colspan="2"  style="border-bottom:1px solid #666">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="texto_chico">Justificante de entrega del tel&eacute;fono del parte de reparaci&oacute;n  <strong>RM<? if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } if ($saco[tienda]=="Centro") {  echo "C"; } printf("%05d",  $saco[0]); $saco[0]; ?>
    </strong>      <br />
    Si usted pierde este justificante no nos haremos cargo de la entrega del movil, ya que este documento implica que usted es el due&ntilde;o de dicho terminal.</span></td>
  </tr>
   
  
  <tr>
    <td colspan="2"><span class="texto_chico"><? if ($saco[aprobado]=="si") { ?>Presupuesto por mano de obra (No incluye componentes): <strong>&#8364;<? echo $saco[presupuesto]; ?></strong><? }  ?><br />
      <strong>Puede verificar el estado de su reparaci&oacute;n en</strong> <em>http://sat.ahlinformatica.com/clientes </em>, o enviando un Whatsapp al n&uacute;mero: (+<? echo $codpais.") ".$userphone ?>. C&oacute;digo a enviar: RM<? if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } if ($saco[tienda]=="Centro") {  echo "C"; } printf("%05d",  $saco[0]); echo " ".strtoupper($sc[dni]); ?><? 
      echo "<br/>Para futuras referencias el c&oacute;digo a enviar se encuentra compuesto por '&#35;PARTE DNI'"; ?></span></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
      <td height="80"><div style="margin-top:40px;border-top:1px dotted #666;text-align:center">Sello de la empresa</div></td>
    <td rowspan="2" align="right">Fecha: <strong><? echo $saco[fecha]; ?>
    <div style="height:5px"></div>
    </strong>Cliente: <strong><? echo "<strong>$sc[apellido], $sc[nombre]</strong>"; ?></strong>
    <div style="height:5px"></div>
    </strong>Movil: <strong><? echo "<strong>$saco[marca] $saco[modelo]</strong>"; ?></strong>
    <div style="height:5px"></div>
    TF: <strong><? if ($sucursal=="Tias") { ?>928.52.40.75<? }  if ($sucursal=="Arrecife") { echo "928.805.093"; } if ($sucursal=="Centro") { echo "928.597.119"; } ?></strong></td>
  </tr>
</table>
</body>
</html>
<script>window.print(); window.setTimeout("location.href='repmoviles_editar.php?id=<? echo $id; ?>'",2000)</script>
<? } else { ?><script>location.href='login.php'</script><? } ?>