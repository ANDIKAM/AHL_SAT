<? include("logadmin.php"); 
	
if ($logadmin) { 

if ($sucursal=="Arrecife") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Tias") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Centro") { $tabla_empresas=" empresas_integradas "; } 

							
 $busco_presu=mysql_query("select * from empresa_presupuesto where id_empresa_presupuesto='$id_presupuesto'");
 $saco_presu=mysql_fetch_array($busco_presu);
 $laempresa=$saco_presu[empresa];
 
 $bn=mysql_query("select * from $tabla_empresas where id_empresa='$laempresa'");
 $sn=mysql_fetch_array($bn);
 
 if ($sucursal=="Tias") { $datos="C.\ Libertad, 55<br />
        35572 - T&iacute;as<br />
        TF/FAX: 928.52.40.75<br />
        ahltias@hotmail.com<br />";
         } 
		if ($sucursal=="Arrecife")  {
      $datos="C/ Puerto Rico, 50<br />
      35500 - Arrecife de Lanzarote<br />
      TF/FAX: 928.80.50.93<br />
      info@ahlinformatica.com<br />";
      } 
	   if ($sucursal=="Centro") {
		   						
                                $datos="C.\ ALFEREZ CABRERA TAVIO, 3<br />
                                35500 - ARRECIFE DE LANZAROTE <br />
                                TFNO: 928.597119<br />
                                arrecifecentro@ahlinformatica.com<br />";
								
								} 
      $datos.="CIF: B35859412";			
 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<? include("funciones.php"); ?>
<script>

function confirmar_enviar() { if (confirm('Seguro que desea enviar el presupuesto')) { location.href='empresas_nuevo_presupuesto.php?id=<? echo $id; ?>&id_presupuesto=<? echo $id_presupuesto; ?>&enviar=92346124'} }

</script>
<style type="text/css">
<!--
.style1 {color: #EEEEEE}
-->
</style>
</head>

<body onLoad="document.getElementById('unidades').focus();">
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="343"><img src="images/LOGO-AHL.png" /></td>
    <td width="357" align="right" valign="middle"><? echo $datos; ?></td>
  </tr>
  <tr>
    <td colspan="2"><div id="agregarcliente" style="margin:20px 5px; padding:10px; border:1px solid #BBBBBB;  background-color:#E5E5E5"><strong>Fecha:</strong> <a href='#'><? echo substr($saco_presu[fecha],0,16)." hs."; ?></a>
    <div style="float:right;"><strong>Cliente:</strong> <a href="#"><? echo $sn[nombre]; ?></a></div></div><br />
    <? $bcom=mysql_query("select * from empresa_presupuesto_detalle where presupuesto='$id_presupuesto' order by id_empresa_presupuesto_detalle desc");
			$cnt=mysql_num_rows($bcom);
			
		if ($cnt>0) {  ?>
          <br />
<table width="700" border="0" cellspacing="0" cellpadding="4" style="border:1px solid #666">
  <tr <? echo $estilo; ?>>
          <td  width="50" height="30" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>UDS</strong></td>
          <td  height="30" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>CONCEPTO</strong></td>
          <td  width="100" height="30" align="right" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>PRECIO</strong></td>
          <td  width="100" height="30" align="right" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>DESCUENTO</strong></td>
          <td  width="100" align="right" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>TOTAL</strong></td>
        </tr>
        <? 
	  	
		while ($scom=mysql_fetch_array($bcom)) { 
		$totalventa=$totalventa+$scom[total];
	  	$estilo="style='border-bottom:1px dotted #666'";
		?>
        <tr>
          <td  <? echo $estilo; ?> ><? echo $scom[unidades]; ?></td>
          <td <? echo $estilo; ?> ><? echo $scom[concepto]; ?></td>
          <td <? echo $estilo; ?>  align="right"><? echo $scom[precio]; ?> &#8364; </td>
          <td  align="right" <? echo $estilo; ?>><? if ($scom[descuento]!="0") { echo $scom[descuento]; ?>
%
  <? } else { echo "&nbsp;" ;} ?></td>
          <td  align="right" <? echo $estilo; ?>><? echo $scom[total]; ?> &#8364; </td>
        </tr>
        <? } ?>
        <tr >
          <td colspan="5" align="left" style="padding:10px" bgcolor="#FFFFCC" class="titulo"><span class="texto">Comentarios</span><br />
            <br />
            <span class=" texto_gris">
            <? echo $saco_presu[comentario]; ?>
            </span>
           </td>
          </tr>
        <tr >
          <td  height="40" colspan="3" align="right" class="titulo">Total presupuesto con IGIC incluido:</td>
          <td colspan="2"   align="right" class="titulo"><?  printf("%'11.2f",$totalventa); ?>
            &#8364;</td>
        </tr>
        </table>
      <br />
      <? } ?>
    
    
    
    
    </td>
  </tr>
</table>
<script language="JavaScript">window.print();  window.setTimeout("location.href='empresas_editar.php?id=<? echo $id; ?>';",1000);  </script> 
</body>
</html>
<? } else { ?><script>location.href='login.php'</script><? } ?>
