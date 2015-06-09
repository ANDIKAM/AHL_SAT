<? include("logadmin.php"); 
	
if ($logadmin) {  

$fecha = time ();
	$fecha=$fecha-8100;
	$ano=date ( "Y" , $fecha );
	$mes=date ( "m" , $fecha );
	$dia=date ( "d" , $fecha );
	$hora=date ( "H" , $fecha ); 
	$minuto=date ( "i" , $fecha );
	$fechadehoy="$ano-$mes-$dia";

    header("Content-Type: application/vnd.ms-excel");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=facturas-$fechadehoy.xls");
	
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>


</head>

<body>
     
        <? 
	  	 
		 if ($sucursal=="Arrecife") { $tabla_facturas="facturas_arrecife"; }
		 if ($sucursal=="Tias") { $tabla_facturas="facturas_tias"; }
		 if ($sucursal=="Centro") { $tabla_facturas="facturas_centro"; } 
		
											
	     $busco=mysql_query("select * from $tabla_facturas order by id_facturas desc");
	     $cnt=mysql_num_rows($busco); 
		  ?>
    
      <table style="border:1px solid #E5E5E5" width="100%" border="0" cellspacing="3" cellpadding="0">
        <tr >
          <th width="170" bgcolor="#DBDBDB">Fecha</th>
          <th width="100" bgcolor="#DBDBDB">Número</th>
          <th width="100" bgcolor="#DBDBDB">Parte</th>
          <th bgcolor="#DBDBDB">Cliente</th>
          <th width="98" height="30" bgcolor="#DBDBDB">Total</th>
          <th width="60" bgcolor="#DBDBDB">Pago</th>
        </tr>
        <? 
		
		
		
		
		while ($saco=mysql_fetch_array($busco)) { 
		?>
        <tr>
          <td nowrap="nowrap" style='cursor:pointer; border-bottom:1px dotted #666;border-right:1px dotted #666;'><? echo substr($saco[fecha],0,16)." hs."; ?></td>
          <td align="center" nowrap="nowrap" style='cursor:pointer; border-bottom:1px dotted #666;border-right:1px dotted #666;'><strong>F<?  if ($saco[venta]=="si") { echo "VF"; }    echo strtoupper($saco[tipo]); ?><? if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[0]);  ?>
            &nbsp; </strong></td>
          <td align="center" nowrap="nowrap" style='cursor:pointer; border-bottom:1px dotted #666;border-right:1px dotted #666;'><? if ($saco[venta]!="si") {   echo strtoupper($saco[tipo]); if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[caso]);    } ?>&nbsp;</td>
          <td nowrap="nowrap" style='cursor:pointer; border-bottom:1px dotted #666;border-right:1px dotted #666;'><? $b=mysql_query("select * from clientes where id_clientes='$saco[cliente]'"); $s=mysql_fetch_array($b);echo "$s[apellido] $s[nombre]";   ?></td>
          <td nowrap="nowrap" style='cursor:pointer; border-bottom:1px dotted #666;border-right:1px dotted #666;'><? echo $saco[total]; ?> &#8364;</td>
          <td align="center" nowrap="nowrap" style='cursor:pointer; border-bottom:1px dotted #666;border-right:1px dotted #666;'><? echo $saco[forma]; ?></td>
        </tr>
        <? } ?>
      </table>
     
</body>
</html>
<? } else { ?><script>location.href='login.php'</script><? } ?>
