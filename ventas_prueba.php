<? include("logadmin.php"); 
	
if ($logadmin) { 
if ($cls=="cancel") { $cancelo=mysql_query("delete from ventas where tienda='$sucursal'"); 
						?><script>location.href='ventas.php?idclss=<? echo rand(111111,999999); ?>'</script><? 
						} 
if ($agregarart) { 
				$total=$unidades*$precio;
				$ingreso=mysql_query("insert into ventas (unidades, concepto, precio, total, tienda) values ('$unidades','$concepto','$precio','$total', '$sucursal')"); 
				
				?><script>location.href='ventas.php?idclss=<? echo rand(111111,999999); ?>'</script><? 
				} 



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<? include("funciones.php"); ?>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
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
      <h1>Ventas</h1>
      <form id="form1" name="form1" method="post" action="#SELF">
        <table width="600" border="0" cellpadding="0" cellspacing="5" style="border: 1px dotted #666">
          <tr>
            <td height="30" colspan="2"><strong>Agregar artículo a la venta</strong></td>
            </tr>
          <tr>
            <td width="44">Unidades:</td>
            <td width="448"><input name="unidades" type="text" id="unidades" size="5" /></td>
          </tr>
          <tr>
            <td>Concepto:</td>
            <td><textarea name="concepto" rows="3" id="concepto" style="width:97%"></textarea></td>
          </tr>
          <tr>
            <td>Precio:</td>
            <td><input name="precio" type="text" id="precio" size="10" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="agregarart" id="agregarart" value="Agregar" /></td>
          </tr>
        </table>
        </form>
        
       <? $bcom=mysql_query("select * from ventas where tienda='$sucursal' ");
	   $cnt=mysql_num_rows($bcom);
	   
	   if ($cnt>0) { 
        ?>
        <br />
            <span class="titulo">Venta actual</span><br />
            <br />
            
            <table width="800" border="0" cellspacing="0" cellpadding="4" style="border:1px solid #666">
      <tr <? echo $estilo; ?>>
        <td  width="50" height="30" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>UDS</strong></td>
        <td  height="30" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>CONCEPTO</strong></td>
        <td  width="120" height="30" align="right" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>PRECIO</strong></td>
        <td  width="120" height="30" align="right" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>TOTAL</strong></td>
        <td  width="30" align="right" bgcolor="#F7F7F7" <? echo $estilo; ?>>&nbsp;</td>
      </tr>
      <? 
	  	
		while ($scom=mysql_fetch_array($bcom)) { 
		$totalventa=$totalventa+$scom[total];
	  	?>
       <tr>
        <td <? echo $estilo; ?> ><? echo $scom[unidades]; ?></td>
        <td <? echo $estilo; ?> ><? echo $scom[concepto]; ?></td>
        <td <? echo $estilo; ?>  align="right"><? echo $scom[precio]; ?> &#8364; </td>
        <td  align="right" <? echo $estilo; ?>><? echo $scom[total]; ?> &#8364; </td>
        <td  align="center" <? echo $estilo; ?>><a href="ventas_eliminar.php?id=<? echo $scom[0]; ?>">X</a></td>
       </tr>
      <? } ?>
      
      <tr ><td  height="40" colspan="3" align="right" class="titulo">Total factura con IGIC incluido:</td>
        <td   align="right" class="titulo"><?  printf("%'11.2f",$totalventa); ?>&#8364;</td>
        <td   align="right" class="titulo">&nbsp;</td>
      </tr>
    </table>
    <br /><br />
    
    
    
    

            <form id="form2" name="form2" method="post" action="ventas_facturar.php">
          
          <span class="titulo">Datos del Cliente</span><br />
          <br />
          <input name="vernuevocliente" type="radio" id="buscar" value="no" checked="checked"   onclick="versinuevo();habilitado_enviar();" />
          Seleccionar Cliente    
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input name="vernuevocliente" type="radio"  id="crearnuevo" value="si" onClick="versinuevo();habilitar_enviar();" />
          Nuevo cliente
          <br /><br />
          
          <div id="nuevocliente" style="display:<? echo "none"; ?>; border:1px dotted #CCC; margin:8px; padding:8px; background-color:#E8FFFF;">
          <table width="600" border="0" cellspacing="3" cellpadding="0">
            
            <tr>
              <td>&nbsp;</td>
              <td height="30"><strong>Datos del nuevo cliente</strong></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td height="25"><span class="texto_gris">Los campos <strong>Nombres</strong>, <strong>Apellidos</strong> y <strong>DNI</strong> son <strong>OBLIGATORIOS</strong></span></td>
            </tr>
            
            <tr>
              <td width="90">Nombres</td>
              <td width="507"><input style="width:90%" type="text" name="nombre" id="nombre" onChange="habilitar_enviar();"  /></td>
            </tr>
            <tr>
              <td>Apellidos</td>
              <td><input style="width:90%" type="text" name="apellido" id="apellido" onChange="habilitar_enviar();"  /></td>
            </tr>
            <tr>
              <td>DNI</td>
              <td><input style="width:90%" type="text" name="dni" id="dni" onChange="habilitar_enviar();"  /></td>
            </tr>
            <tr>
              <td>Dirección</td>
              <td><input style="width:90%" type="text" name="direccion" id="direccion" /></td>
            </tr>
            <tr>
              <td>C.P.</td>
              <td><input style="width:90%" type="text" name="cp" id="cp" /></td>
            </tr>
            <tr>
              <td>E-mail 1</td>
              <td><input style="width:90%" type="text" name="email1" id="email1" /></td>
            </tr>
            <tr>
              <td>E-mail 2</td>
              <td><input style="width:90%" type="text" name="email2" id="email2" /></td>
            </tr>
            <tr>
              <td>Teléfono</td>
              <td><input style="width:90%" type="text" name="telefono" id="telefono" /></td>
            </tr>
            <tr>
              <td>Movil 1</td>
              <td><input style="width:90%" type="text" name="movil1" id="movil1" /></td>
            </tr>
            <tr>
              <td>Movil 2</td>
              <td><input style="width:90%" type="text" name="movil2" id="movil2" /></td>
            </tr>
            <tr>
              <td>Comentarios</td>
              <td><textarea name="extras" rows="5" id="extras" style="width:90%"></textarea></td>
            </tr>
          </table>
          </div>
          
          <div id="buscarcliente">
            <table width="600" border="0" cellspacing="3" cellpadding="0">
                 <tr>
                  <td>&nbsp;</td>
                  <td height="30"><input type="text" name="clientebuscado" id="clientebuscado"  /> <input type="button" name="button" id="button" value=" Filtrar" onClick="cargarclientes(document.getElementById('clientebuscado').value,document.getElementById('nocache').value);" /></td>
                </tr>
                <tr>
                  <td width="55">Cliente</td>
                  <td width="536"><div id="listadeclientes" style="margin:0px; padding:0px"><select name="cliente" id="cliente">
                  <? $busco=mysql_query("select * from clientes order by apellido");
				  	while ($saco=mysql_fetch_array($busco)) {  ?>
                  <option value="<? echo $saco[0]; ?>"><? echo "$saco[apellido], $saco[nombre] - $saco[email1]"; ?></option>
                  <? } ?>
                  </select><input type="hidden" name="nocache" id="nocache" value="<? echo rand(111111,999999);?>" /></div></td>
                </tr>
            </table>
          </div>
        
          
          
          
<br />
<br />


      <input name="agregar" type="submit" class="style1" id="agregar" value="      Facturar      " onclick="location.href='ventas_facturar.php'" />
&nbsp;&nbsp;&nbsp;
<input type="button" name="button2" id="button2" value="Cancelar venta" onclick="location.href='ventas.php?cls=cancel'" />
        </form>
    <? } ?>
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
