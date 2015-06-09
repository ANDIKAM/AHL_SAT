<? include("logadmin.php"); 
	
if ($logadmin) {  

if ($agregar) {  
				if ($vernuevocliente=="si")  { $ingreso=mysql_query("insert into clientes (nombre, apellido, email1, email2, direccion, cp, telefono, movil1, movil2, extras, dni) values ('$nombre', '$apellido', '$email1', '$email2', '$direccion', '$cp', '$telefono', '$movil1', '$movil2', '$extras', '$dni')");  
												$b=mysql_query("select * from clientes order by id_clientes desc"); $s=mysql_fetch_array($b);
												$cliente=$s[0]; 
												 }
                                EnviarWhats($movil1,$ahlparametros["em_whtsppbnvnd"]["descripcion"]);
                                EnviarWhats($movil2,$ahlparametros["em_whtsppbnvnd"]["descripcion"]);

				$fecha = time ();
				$fecha=$fecha-8100; // Con esto lo pongo en cero
				$ano=date ( "Y" , $fecha );
				$mes=date ( "m" , $fecha );
				$dia=date ( "d" , $fecha );
				$lafecha="$ano-$mes-$dia";
				
				if ($sucursal=="Arrecife") { $tabla="consolas_arrecife"; }
			if ($sucursal=="Tias") { $tabla="consolas_tias"; } 
			if ($sucursal=="Centro") { $tabla="consolas_centro"; } 
		
				$ingreso=mysql_query("insert into $tabla (cliente, consola, nserie, averia, extras, cargador, aprobado, presupuesto, total, fecha, estado, tienda) 
												  values ('$cliente', '$consola', '$nserie', '$averia', '$extras', '$cargador', '$aprobado', '$presupuesto', '$total', '$lafecha', 'abierto', '$sucursal')"); 
				
				?><script>location.href='consolas.php?ssid=<? echo rand(111111,999999); ?>'</script><? }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<? include("funciones.php"); ?>
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
      <h1>Reparación de Consolas</h1>
      <div style="float:right">
       <form id="form2" name="form2" method="post" action="#SELF">
    
     <span class="texto_chico">No es necesario incluir RC<? if ($sucursal=="Arrecife") { echo "A"; } if ($sucursal=="Centro") { echo "C"; } if ($sucursal=="Tias") { echo "T"; }  ?>
     </span> 
       <input type="text" name="buscado" id="buscado"  style="width:200px" <? if ($buscar) { ?> value="<? echo $buscado; ?>"<? } ?>/> 
       &nbsp;
       <input type="submit" name="buscar" id="buscar" value="Buscar" />
       <? if ($buscar) { ?>&nbsp;<a href='consolas.php'>&laquo; Volver</a><? } ?>
      </form>
      </div>
      
      
      <a href="#" onClick="mostrar('agregarcliente');">[+]Nueva orden</a><br />
      <div id="agregarcliente" style="display:<? echo "none"; ?>; margin:20px; padding:10px; border:1px solid #BBBBBB; width:620px; background-color:#FEFBE7">
        <form id="form1" name="form1" method="post" action="#SELF">
          
          <span class="titulo">Datos del Cliente</span><br />
          <br />
          <input name="vernuevocliente" type="radio" id="buscar" value="no" checked="checked"   onclick="versinuevo();habilitado_enviar();" />
          Seleccionar Cliente    
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input name="vernuevocliente" type="radio"  id="crearnuevo" value="si" onClick="versinuevo();habilitar_enviar();" />
          Nuevo cliente
          <br /><br />
          
          <div id="nuevocliente" style="display:<? echo "none"; ?>; border:1px dotted #CCC; margin:8px; padding:8px; background-color:#E8FFFF">
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
              <td width="507"><input style="width:90%" type="text" name="nombre" id="nombre" onChange="habilitar_enviar();" /></td>
            </tr>
            <tr>
              <td>Apellidos</td>
              <td><input style="width:90%" type="text" name="apellido" id="apellido"  onchange="habilitar_enviar();" /></td>
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
                  <td width="536"><div id="listadeclientes" style="margin:0px; padding:0px"><select style="width:536px" name="cliente" id="cliente">
                  <? $busco=mysql_query("select * from clientes order by apellido");
				  	while ($saco=mysql_fetch_array($busco)) {  ?>
                  <option value="<? echo $saco[0]; ?>"><? echo "$saco[apellido], $saco[nombre] - $saco[email1]"; ?></option>
                  <? } ?>
                  </select><input type="hidden" name="nocache" id="nocache" value="<? echo rand(111111,999999);?>" /></div>                </td>
                </tr>
              </table>
          </div>
          <br />
            <br />
            <span class="titulo">Datos del Movil</span><br />
            <br />
            <table width="600" border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td width="90">Consola</td>
                <td><input style="width:98%" type="text" name="consola" id="consola" /></td>
              </tr>
              <tr>
                <td>N° de serie</td>
                <td><input style="width:98%" type="text" name="nserie" id="nserie" /></td>
              </tr>
              <tr>
                <td nowrap="nowrap">Deja cargador</td>
                <td><select name="cargador" id="cargador">
                  <option>si</option>
                  <option selected="selected">no</option>
                </select>                </td>
              </tr>
              <tr>
                <td>Avería</td>
                <td><textarea name="averia" rows="5" id="averia" style="width:98%"></textarea></td>
              </tr>
              <tr>
                <td>Observaciones de<br />
                daños o problemas<br /></td>
                <td><textarea name="extras" rows="3" id="extras" style="width:98%"></textarea></td>
              </tr>
              <tr>
                <td>Presupuesto</td>
                <td><strong>&#8364;</strong> 
                  <input style="width:30%" type="text" name="presupuesto" id="presupuesto" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="radio" name="aprobado" id="radio3" value="si" />
                  Aprobado                &nbsp;&nbsp;&nbsp;
                  <input name="aprobado" type="radio" id="radio4" value="no" checked="CHECKED" />
                A confirmar</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td valign="middle"><input type="submit" name="agregar" id="agregar" value="  Agregar  " />
                  <a href="#" onClick="ocultar('agregarcliente');">Cancelar</a></td>
              </tr>
            </table>
          </form>
        </div>
      <br />
            <div style=" clear:both;float:right;"><? if ($cls!="cerrados") { ?><a href="consolas.php?cls=cerrados">&raquo; ver ordenes finalizadas</a><? } else { ?><a href="consolas.php">&raquo; ver ordenes pendientes</a><? } ?></div>

      <? 
	  	if ($sucursal=="Arrecife") { $tabla="consolas_arrecife"; }
	    if ($sucursal=="Tias") { $tabla="consolas_tias"; } 
		if ($sucursal=="Centro") { $tabla="consolas_centro"; } 
		
	  	 if ($cls=="") { $filtro.="  where estado='abierto' "; } 
		 if ($cls=="cerrados") { $filtro.="  where estado='finalizado' "; } 
	  
	  
	  if ($buscar) { 
		 				$buscadofiltrado = eregi_replace("[a-zA-Z]","",$buscado);
						$buscadofiltrado=(int)$buscadofiltrado;
						
						$filtro.=" and id_consolas like '$buscadofiltrado'"; 
						} 
		 
	  
	  
	  
	  
	     $busco=mysql_query("select * from $tabla $filtro order by id_consolas desc");
	     $cnt=mysql_num_rows($busco); 
		 if ($cnt>0) { ?>
               <span class="titulo">Listado de órdenes <? if ($cls!="cerrados") { ?>pendientes<? } else { echo "finalizadas";} ?></span>

      <table id="consolas" style="border:1px solid #E5E5E5; margin-top:10px" width="930" border="0" cellspacing="3" cellpadding="0">
        <thead>
        <tr>
          <th width="90" bgcolor="#DBDBDB">Orden</th>
          <th width="90" bgcolor="#DBDBDB">Fecha</th>
          <th height="30" bgcolor="#DBDBDB">Cliente</th>
          <th height="30" align="center" bgcolor="#DBDBDB">Consola</th>
          <th width="40" height="30" align="center" bgcolor="#DBDBDB">Ppto.</th>
          <th width="40" align="center" bgcolor="#DBDBDB">sms</th>
          <th width="50" align="center" bgcolor="#DBDBDB">Aprob.</th>
          <th width="40" align="center" bgcolor="#DBDBDB">sms</th>
        </tr>
        </thead>
        <tbody>
        <? 
		
		
		
		
		while ($saco=mysql_fetch_array($busco)) { 
		$link=" style='cursor:pointer; border-bottom:1px dotted #666;' onclick=\"location.href='consolas_editar.php?id=$saco[0]'\""; ?>
        <tr>
          <td <? echo $link; ?>>RC<? if ($saco[tienda]=="Tias") {  echo "T"; } if ($saco[tienda]=="Centro") {  echo "C"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; }  printf("%05d",  $saco[0]); $saco[0]; ?></td>
          <td <? echo $link; ?>><? echo $saco[fecha]; ?></td>
          <td <? echo $link; ?>><? $b=mysql_query("select * from clientes where id_clientes='$saco[cliente]'"); $s=mysql_fetch_array($b); echo "$s[apellido], $s[nombre]"; ?></td>
          <td <? echo $link; ?>><? echo "$saco[consola]"; ?></td>
          <td align="center" <? echo $link; ?>><? if ($saco[presupuesto]!="0.00") { echo "Si"; } else { echo "&nbsp;"; }  ?></td>
          <td align="center" <? echo $link; ?>><? if ($saco[sms]=="si") { echo "Si"; }  else { echo "&nbsp;"; } ?></td>
          <td align="center" <? echo $link; ?>><? if ($saco[aprobado]=="si") { echo "Si"; }  else { echo "&nbsp;"; } ?></td>
          <td align="center" <? echo $link; ?>><? if ($saco[sms2]=="si") { echo "Si"; }  else { echo "&nbsp;"; } ?></td>
        </tr>
        <? } ?>
        </tbody>
      </table>
      <? } else { ?>No hay órdenes<? } ?>
      
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
