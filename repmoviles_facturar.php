<? include("logadmin.php"); 
	
if ($logadmin) { 


$fecha = time ();
$fecha=$fecha-8100; // Con esto lo pongo en cero

$ano=date ( "Y" , $fecha );
$mes=date ( "m" , $fecha );
$dia=date ( "d" , $fecha );
$hora=date ( "H" , $fecha ); 
$minuto=date ( "i" , $fecha );
$fechadehoy="$ano-$mes-$dia $hora:$minuto:00";
				if ($facturar) {
				     			if ($sucursal=="Arrecife") { $tabla="repmovil_arrecife"; }
								if ($sucursal=="Tias") { $tabla="repmovil_tias"; } 
								if ($sucursal=="Centro") { $tabla="repmovil_centro"; } 
				
								if ($cls=="3") { $actualizo=mysql_query("update $tabla set estado='finalizado' where id_repmovil='$id'"); 
											     ?><script>location.href='repmoviles.php'</script><?
												} 
												
								if ($cls=="2") { $actualizo=mysql_query("update $tabla set estado='finalizado' where id_repmovil='$id'"); 
													
													if ($sucursal=="Arrecife") { $tabla_facturas="facturas_arrecife"; }
														if ($sucursal=="Tias") { $tabla_facturas="facturas_tias"; }
														if ($sucursal=="Centro") { $tabla_facturas="facturas_centro"; } 
														
												 $ingresofactura=mysql_query("insert into $tabla_facturas (fecha, cliente, total, tipo, caso, aprobado, tienda) values ('$fechadehoy', '$idcl', '12', '$tipo', '$id', 'no', '$sucursal')");
												    
													if ($sucursal=="Arrecife") { $tabla_facturas="facturas_arrecife"; }
														if ($sucursal=="Tias") { $tabla_facturas="facturas_tias"; } 
														if ($sucursal=="Centro") { $tabla_facturas="facturas_centro"; } 
														
													$bf=mysql_query("select * from $tabla_facturas order by id_facturas desc");
													$sf=mysql_fetch_array($bf);
													
													?><script>location.href='facturas_imprimir.php?id=<? echo $sf[0]; ?>'</script><?
												}
								
								if ($cls=="1") {    $actualizo=mysql_query("update $tabla set estado='finalizado' where id_repmovil='$id'");
													
													$totalcom=0;
													
													if ($sucursal=="Arrecife") { $tablacomp="componentes_arrecife"; }
													if ($sucursal=="Tias") { $tablacomp="componentes_tias"; } 
													if ($sucursal=="Centro") { $tablacomp="componentes_centro"; } 
						
						
													$bcom=mysql_query("select * from $tablacomp where clase='$tipo' and id='$id'");
													while ($scom=mysql_fetch_array($bcom)) { $totalcom=$totalcom+$scom[total]; }
													$totalrep=$totalcom+$mdo;
													
													if ($sucursal=="Arrecife") { $tabla_facturas="facturas_arrecife"; }
														if ($sucursal=="Tias") { $tabla_facturas="facturas_tias"; }
														if ($sucursal=="Centro") { $tabla_facturas="facturas_centro"; } 
														
													$ingresofactura=mysql_query("insert into $tabla_facturas (fecha, cliente, total, tipo, caso, aprobado, tienda) values ('$fechadehoy', '$idcl', '$totalrep', '$tipo', '$id', 'si', '$sucursal')");
												    
													if ($sucursal=="Arrecife") { $tabla_facturas="facturas_arrecife"; }
														if ($sucursal=="Tias") { $tabla_facturas="facturas_tias"; } 
														if ($sucursal=="Centro") { $tabla_facturas="facturas_centro"; } 
														
													$bf=mysql_query("select * from $tabla_facturas order by id_facturas desc");
													$sf=mysql_fetch_array($bf);
													
													?><script>location.href='facturas_imprimir.php?id=<? echo $sf[0]; ?>&cqm=136187236452'</script><?
												}
								
								
								} ?>
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
      <h1>Facturar reparación</h1>
      <br />
      <br />
        <br />
        <form id="form1" name="form1" method="post" action="#SELF">
          <p align="center">¿ Está seguro que desea <? if ($cls=="1") { echo "Facturar la reparaci&oacute;n"; } 
		  											   if ($cls=="2") { echo "Facturar presupuesto de 12 Euros"; }
													   if ($cls=="3") { echo "Finalizar la reparaci&oacute;n SIN facturar"; }
													?> ?
            <br />  
            <br />  
            <? if ($cls=="1" or $cls=="2") { ?>
            <span class="texto">Forma de pago:&nbsp;
<div style="float: left;position: relative;left: 50%;">
        <div style="float: left;position: relative;left: -50%;width: 15%">
            <input name="forma" type="radio" id="radio" value="Efectivo" checked="checked" />
            <label for="forma">Efectivo</label>
        </div>
        <div style="float: left;position: relative;left: -50%;width: 15%">
            <input name="forma" type="radio" id="radio2" value="Tarjeta" />
            <label for="forma">Tarjeta</label>
        </div>
        <div style="float: left;position: relative;left: -50%;width: 30%">
            <input name="forma" type="radio" id="radio3" value="Pendiente de cobro" />
        <label for="forma">Pendiente de cobro</label>
        </div>
        <div style="float: left;position: relative;left: -50%;width: 15%">
            <input name="forma" type="radio" id="radio4" value="Talon" />
            <label for="forma">Tal&oacute;n</label>
        </div>
        <div style="float: left;position: relative;left: -50%;width: 15%">
            <input name="forma" type="radio" id="radio5" value="Otro" />
            <label for="forma">Otro</label>
            <textarea name="forma2" rows="3" type="text" id="radio5"></textarea>
        </div>
        </div></span><br /><br /><? } ?>
        <div style="clear:both; width:100%;text-align: center">
            <input type="submit" name="facturar" id="facturar" value="Si, <? if ($cls=="1" or $cls=="2") { echo "facturar"; } else { echo "finalizar sin facturar"; }  ?>" /> 
            <a href="#" onClick="location.href='repmoviles_editar.php?id=<? echo $id; ?>'">No cancelar </a></p>
        </div>
        </form>
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
