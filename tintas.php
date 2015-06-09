<? include("logadmin.php"); 
	
if ($logadmin) { 

if ($agregar_impresora) {
				$ingreso=mysql_query("insert into impresora (marca, modelo) values ('$marca_impresora', '$modelo_impresora')"); 
				?><script>location.href='tintas.php?ssid=<? echo rand(111111,999999); ?>'</script><? }
 
if ($agregar_tinta) { $detalle="";
						$bi=mysql_query("select * from impresora order by marca, modelo");
			  			while ($si=mysql_fetch_array($bi)) { $num=$si[0]; if ($impresora[$num])
																								{ $detalle.=$si[modelo]." | "; } 
														}
						$corte=strlen($detalle)-3; $detalle=substr($detalle,0,$corte);
						$ingreso=mysql_query("insert into tinta (nombre, comentarios, precio, impresoras) values ('$nombre_tinta','$comentarios_tinta','$precio_tinta','$detalle')");
						?><script>location.href='tintas.php?ssid=<? echo rand(111111,999999); ?>'</script><?
						} 
 
 if ($eliminar_tinta) { $elimino=mysql_query("delete from tinta where id_tinta='$id_tinta'");
 						?><script>location.href='tintas.php?ssid=<? echo rand(111111,999999); ?>'</script><?
						 }
						 
 if ($eliminar_impresora) { $elimino=mysql_query("delete from impresora where id_impresora='$id_impresora'");
 						?><script>location.href='tintas.php?ssid=<? echo rand(111111,999999); ?>'</script><?
						 }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<? include("funciones.php"); ?>
<script>
function confirmar_eliminar_tinta(id_tinta, nombre_tinta) { if (confirm('Está seguro que desea eliminar la tinta '+nombre_tinta)) { location.href='tintas.php?eliminar_tinta=true&id_tinta='+id_tinta;} }

function confirmar_eliminar_impresora(id_impresora, nombre_impresora) { if (confirm('Está seguro que desea eliminar la impresora '+nombre_impresora)) { location.href='tintas.php?eliminar_impresora=true&id_impresora='+id_impresora;} }

</script>

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
        </div><h1>Tintas</h1>
      <a href="#" onClick="mostrar('agregarcliente'); ocultar('agregartinta');">[+] Nueva Impresora</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#" onClick="ocultar('agregarcliente');mostrar('agregartinta');">[+] Nueva Tinta</a><br />
      <div id="agregarcliente" style="display:<? echo "none"; ?>; margin:20px; padding:10px; border:1px solid #BBBBBB; width:620px; background-color:#E5E5E5">
        <form id="form1" name="form1" method="post" action="#SELF">
          <table width="600" border="0" cellspacing="3" cellpadding="0">
            <tr>
              <td height="30" colspan="2" valign="top" class="titulo">Nueva Impresora</td>
            </tr>
            <tr>
              <td width="84">Marca</td>
              <td width="507"><label for="marca_impresora"></label>
                <select name="marca_impresora" id="marca_impresora">
                  <option>BROTHER</option>
                  <option>CANON</option>
                  <option>DELL</option>
                  <option>EPSON</option>
                  <option>HP</option>
                  <option>IBM-LEXMARK</option>
                  <option>KYOCERA</option>
                  <option>MINOLTA</option>
                  <option>OKI </option>
                  <option>SAMSUNG</option>
                  <option>RICOH</option>
                  <option>XEROX</option>
                </select></td>
            </tr>
            <tr>
              <td>Modelo</td>
              <td><input style="width:98%" type="text" name="modelo_impresora" id="modelo_impresora"   /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td valign="middle"><input type="submit" name="agregar_impresora" id="agregar_impresora" value="  Agregar  "  />
                <a href="#" onClick="ocultar('agregarcliente');">Cancelar</a></td>
            </tr>
          </table>
        </form>
      </div>
      <div id="agregartinta" style="display:<? echo "none"; ?>; margin:20px; padding:10px; border:1px solid #BBBBBB; width:620px; background-color:#E5E5E5">
        <form id="form3" name="form1" method="post" action="#SELF">
          <table width="600" border="0" cellspacing="3" cellpadding="0">
            <tr>
              <td height="30" colspan="2" valign="top" class="titulo">Nueva tinta</td>
            </tr>
            <tr>
              <td width="84">Nombre</td>
              <td width="507"><label for="marca_impresora2">
                <input style="width:98%" type="text" name="nombre_tinta" id="nombre_tinta"   />
              </label></td>
            </tr>
            <tr>
              <td>Comentarios</td>
              <td><textarea name="comentarios_tinta" rows="3" id="comentarios_tinta" style="width:98%"></textarea></td>
            </tr>
            <tr>
              <td>Precio</td>
              <td><input name="precio_tinta" type="text" id="precio_tinta" style="width:98%" value="0.00"   /></td>
            </tr>
            <tr>
              <td>Impresoras</td>
              <td><? $bi=mysql_query("select * from impresora order by marca, modelo");
			  			while ($si=mysql_fetch_array($bi)) { ?>
                <input type="checkbox" name="impresora[<? echo $si[0]; ?>]" id="impresora[<? echo $si[0]; ?>]" /> <? echo "$si[marca] - $si[modelo]"; ?><br />
                <label for="checkbox"></label>                <? } ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td valign="middle"><input type="submit" name="agregar_tinta" id="agregar_tinta" value="  Agregar  "  />
                <a href="#" onClick="ocultar('agregartinta');">Cancelar</a></td>
            </tr>
          </table>
        </form>
      </div>
<br />
<span class="titulo">Impresoras</span>
<table id="impresoras" style="border:1px solid #E5E5E5" width="930" border="0" cellspacing="3" cellpadding="0">
   <thead>
        <tr>
         <th width="200" height="30" bgcolor="#DBDBDB">Marca</th>
         <th height="30" align="center" bgcolor="#DBDBDB">Modelo</th>
         <th width="60" height="30" align="center" bgcolor="#DBDBDB">&nbsp;</th>
        </tr>     
   </thead>
   <tbody>
        <? 
		$filtro; $orden;
		if ($buscar) { $filtro=" where modelo like '%$buscado%' or marca like '%$buscado%' "; } 
		 $busco=mysql_query("select * from impresora $filtro order by marca, modelo"); 
		while ($saco=mysql_fetch_array($busco)) { 
		?>
        
        <tr >
          <td style="border-bottom:1px dotted #666;" nowrap="nowrap" ><? echo "$saco[marca] "; ?></td>
          <td style="border-bottom:1px dotted #666;" nowrap="nowrap" ><? echo $saco[modelo]; ?>&nbsp;</td>
          <td style="border-bottom:1px dotted #666;" align="center"><a href="Javascript:void(0);" onClick="confirmar_eliminar_impresora('<? echo $saco[0]; ?>','<? echo "$saco[marca] $saco[modelo]"; ?>');">Eliminar</a></td>
        </tr>
        <? } ?>
    </tbody>
    </table>
    
    <br />
    <br />
<span class="titulo">Tintas</span>
<table id="tintas" style="border:1px solid #E5E5E5" width="930" border="0" cellspacing="3" cellpadding="0">
    <thead>
    <tr >
        <th width="200" height="30" bgcolor="#DBDBDB">Nombre</th>
        <th height="30" align="center" bgcolor="#DBDBDB">Comentarios</th>
        <th align="center" bgcolor="#DBDBDB">Impresoras</th>
        <th width="60" align="center" bgcolor="#DBDBDB">Precio</th>
        <th width="60" height="30" align="center" bgcolor="#DBDBDB">&nbsp;</th>
      </tr>
    </thead>
    <tbody>
        <? 
		$filtro; $orden;
		if ($buscar) { $filtro=" where ( nombre like '%$buscado%' or comentarios like '%$buscado%' or impresoras like '%$buscado%' ) "; } 
		 
		 $busco=mysql_query("select * from tinta $filtro order by nombre"); 
		while ($saco=mysql_fetch_array($busco)) { $link=" style=\"cursor:pointer; border-bottom:1px dotted #666;\" onclick=\"location.href='tintas_editar.php?id_tinta=$saco[0]'\" "; 
		?>
        
        <tr >
          <td <? echo $link; ?> nowrap="nowrap" ><? echo "$saco[nombre] "; ?></td>
          <td <? echo $link; ?>  nowrap="nowrap" ><? echo $saco[comentarios]; ?>&nbsp;</td>
          <td  <? echo $link; ?> class="texto_chico"  ><div style="line-height:20px"><? echo $saco[impresoras]; ?></div></td>
          <td <? echo $link; ?>   align="center"><? echo $saco[precio]; ?></td>
          <td style="border-bottom:1px dotted #666;" align="center"><a href="Javascript:void(0);" onClick="confirmar_eliminar_tinta('<? echo $saco[0]; ?>','<? echo $saco[nombre]; ?>');">Eliminar</a></td>
        </tr>
        <? } ?>
    </tbody>
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
