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
    header("content-disposition: attachment;filename=clientes-$fechadehoy.xls");
    if ($or=="") { $or="nom"; } 
 
 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>
</head>

<body>
      
      
      <table style="border:1px solid #E5E5E5" width="100%" border="0" cellspacing="3" cellpadding="0">
        <tr >
          <th width="300" height="30" bgcolor="#DBDBDB">Nombre</th>
          <th width="300" height="30" align="center" bgcolor="#DBDBDB">E-mail</th>
          <th width="300" height="30" align="center" bgcolor="#DBDBDB">E-mail 2</th>
          <th width="300" height="30" align="center" bgcolor="#DBDBDB">Dirección</th>
          <th width="300" height="30" align="center" bgcolor="#DBDBDB">CP</th>
          <th width="300" height="30" align="center" bgcolor="#DBDBDB">Teléfono</th>
          <th width="300" height="30" align="center" bgcolor="#DBDBDB">Movil 1</th>
          <th width="300" height="30" align="center" bgcolor="#DBDBDB">Movil 2</th>
          <th width="300" height="30" align="center" bgcolor="#DBDBDB">CIF</th>
          <th width="700" height="30" align="center" bgcolor="#DBDBDB">Extras</th>
        </tr>
        <? 
		
		
		$busco=mysql_query("select * from clientes  order by apellido, nombre"); 
		while ($saco=mysql_fetch_array($busco)) { 
		 ?>
        
        <tr >
          <td nowrap="nowrap" style="border-bottom:1px dotted #666;border-right:1px dotted #666;"><? echo "$saco[apellido] $saco[nombre]"; ?></td>
          <td nowrap="nowrap" style="border-bottom:1px dotted #666;border-right:1px dotted #666;" ><? echo $saco[email1]; ?>&nbsp;</td>
          <td nowrap="nowrap" style="border-bottom:1px dotted #666;border-right:1px dotted #666;" ><? echo $saco[email2]; ?>&nbsp;</td>
          <td nowrap="nowrap" style="border-bottom:1px dotted #666;border-right:1px dotted #666;"><? echo $saco[direccion]; ?>&nbsp;</td>
          <td nowrap="nowrap" style="border-bottom:1px dotted #666;border-right:1px dotted #666;"><? echo $saco[cp]; ?>&nbsp;</td>
          <td nowrap="nowrap" style="border-bottom:1px dotted #666;border-right:1px dotted #666;"><? echo $saco[telefono]; ?>&nbsp;</td>
          <td nowrap="nowrap" style="border-bottom:1px dotted #666;border-right:1px dotted #666;"><? echo $saco[movil1]; ?>&nbsp;</td>
          <td nowrap="nowrap" style="border-bottom:1px dotted #666;border-right:1px dotted #666;"><? echo $saco[movil2]; ?>&nbsp;</td>
          <td nowrap="nowrap" style="border-bottom:1px dotted #666;border-right:1px dotted #666;"><? echo $saco[cif]; ?>&nbsp;</td>
          <td nowrap="nowrap" style="border-bottom:1px dotted #666;border-right:1px dotted #666;"><? echo $saco[extras]; ?>&nbsp;</td>
        </tr>
        <? } ?>
      </table>

</body>
</html>
<? } else { ?><script>location.href='login.php'</script><? } ?>
