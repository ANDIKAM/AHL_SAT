<? include("logadmin.php"); 
	
if ($logadmin) { 

if ($sucursal=="Arrecife") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Tias") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Centro") { $tabla_empresas=" empresas_integradas "; } 

							
 $busco_presu=mysql_query("select * from clientes_presupuesto where id_clientes_presupuesto='$id_presupuesto'");
 $saco_presu=mysql_fetch_array($busco_presu);
 
 
 
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
      <h1>Empresas &raquo; <? $b=mysql_query("select * from clientes where id_clientes='$id'"); $s=mysql_fetch_array($b);  ?><a href='clientes_editar.php?id=<? echo $id; ?>'><? echo "$s[apellido] $s[nombre]"; ?></a> &raquo; ver presupuesto</h1>
       <form id="form1" name="form1" method="post" action="#SELF">
      <div id="agregarcliente" style="margin:20px; padding:10px; border:1px solid #BBBBBB; width:620px; background-color:#E5E5E5">
      Enviado el <a href='empresas_presupuesto_ver.php?id=<? echo $id; ?>&amp;id_presupuesto=<? echo $sp[0]; ?>'><? echo substr($saco_presu[fecha],0,16)." hs."; ?></a></div>
        
        
        <? $bcom=mysql_query("select * from clientes_presupuesto_detalle where presupuesto='$id_presupuesto' order by id_clientes_presupuesto_detalle desc");
			$cnt=mysql_num_rows($bcom);
			
		if ($cnt>0) {  ?>
          <br />
<table width="800" border="0" cellspacing="0" cellpadding="4" style="border:1px solid #666">
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
          <td  align="right" <? echo $estilo; ?>><? if ($scom[descuento]!="0") { echo $scom[descuento]; ?> %<? } else { echo "&nbsp;" ;} ?></td>
          <td  align="right" <? echo $estilo; ?>><? echo $scom[total]; ?> &#8364;</td>
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
      
      </form>
      
      <div>
        <div style=" display:<? echo "none"; ?>; margin:10px; background-color:#FFC;"></div>
      </div>
      
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
