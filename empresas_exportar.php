<? include("logadmin.php"); 
	
if ($logadmin) { 

if ($sucursal=="Arrecife") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Tias") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Centro") { $tabla_empresas=" empresas_integradas "; } 

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
    header("content-disposition: attachment;filename=empresas-$fechadehoy.xls");
 
 
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
          <th width="200" height="30" bgcolor="#DBDBDB">Nombre</th>
          <th width="200" height="30" align="center" bgcolor="#DBDBDB">Contacto</th>
          <th width="200" height="30" align="center" bgcolor="#DBDBDB">CIF</th>
		  <th width="200" height="30" align="center" bgcolor="#DBDBDB">Tel 1</th>
          <th width="200" height="30" align="center" bgcolor="#DBDBDB">Tel 2</th>
          <th width="200" height="30" align="center" bgcolor="#DBDBDB">E-mail</th>
          <th width="200" height="30" align="center" bgcolor="#DBDBDB">Calle</th>
          <th width="200" height="30" align="center" bgcolor="#DBDBDB">CP</th>
          <th width="200" height="30" align="center" bgcolor="#DBDBDB">Localidad</th>
          <th width="60" align="center" bgcolor="#DBDBDB">Activo</th>
          <th width="700" align="center" bgcolor="#DBDBDB">Comentarios</th>
        </tr>
        <? 
		 $busco=mysql_query("select * from $tabla_empresas order by nombre"); 
		while ($saco=mysql_fetch_array($busco)) { $link=" style='cursor:pointer; border-bottom:1px dotted #666;border-right:1px dotted #666;' "; 
        if ($saco[desuscripto]=="si") { $fondo=" bgcolor='#FFFF99' "; } else { $fondo=""; } 
		?>
        <tr >
          <td nowrap="nowrap" <? echo $link; echo $fondo; ?>><? echo $saco[nombre]; ?></td>
          <td nowrap="nowrap" <? echo $link; echo $fondo; ?>><? echo $saco[contacto]; ?>&nbsp;</td>
          <td nowrap="nowrap" <? echo $link; echo $fondo; ?>><? echo $saco[cif]; ?>&nbsp;</td>
          <td nowrap="nowrap" <? echo $link; echo $fondo; ?>><? echo $saco[tel1]; ?>&nbsp;</td>
          <td nowrap="nowrap" <? echo $link; echo $fondo; ?>><? echo $saco[tel2]; ?>&nbsp;</td>
          <td nowrap="nowrap" <? echo $link; echo $fondo; ?>><? echo $saco[email]; ?>&nbsp;</td>
          <td nowrap="nowrap" <? echo $link; echo $fondo; ?>><? echo $saco[calle]; ?>&nbsp;</td>
          <td nowrap="nowrap" <? echo $link; echo $fondo; ?>><? echo $saco[codigopostal]; ?>&nbsp;</td>
          <td nowrap="nowrap" <? echo $link; echo $fondo; ?>><? echo $saco[localidad]; ?>&nbsp;</td>
          <td align="center" nowrap="nowrap" style="border-bottom:1px dotted #666;" <? echo $fondo; ?>><? if ($saco[activo]=="no") { ?><span style="color:#F00; font-weight:bold">NO</span><? } else { echo $saco[activo]; } ?></td>
          <td nowrap="nowrap" <? echo $link; echo $fondo; ?>><? echo $saco[comentarios]; ?>&nbsp;</td>
        </tr>
        <? } ?>
      </table>
    
</body>
</html>
<? } else { ?><script>location.href='login.php'</script><? } ?>
