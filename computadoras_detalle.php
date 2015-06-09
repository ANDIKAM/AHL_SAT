<? include("logadmin.php"); 
	
if ($logadmin) {  

if ($agregar) {  
				if ($vernuevocliente=="si")  { $ingreso=mysql_query("insert into clientes (nombre, apellido, email1, email2, direccion, cp, telefono, movil1, movil2, extras) values ('$nombre', '$apellido', '$email1', '$email2', '$direccion', '$cp', '$telefono', '$movil1', '$movil2', '$extras')");  
												$b=mysql_query("select * from clientes order by id_clientes desc"); $s=mysql_fetch_array($b);
												$cliente=$s[0]; 
												 }
                                EnviarWhats($movil1,$ahlparametros["em_whtsppbnvnd"]["descripcion"]);
                                EnviarWhats($movil2,$ahlparametros["em_whtsppbnvnd"]["descripcion"]);
				$fecha = time ();
				$ano=date ( "Y" , $fecha );
				$mes=date ( "m" , $fecha );
				$dia=date ( "d" , $fecha );
				$lafecha="$ano-$mes-$dia";
				
				$ingreso=mysql_query("insert into computadoras (cliente, tipoequipo, averia, modelo, nserie, danos, cargador, bateria, contrasena, extras, trabajo, presupuesto, total, aprobado, fecha, estado, tienda) values ('$cliente', '$tipoequipo', '$averia', '$modelo', '$nserie', '$danos', '$cargador', '$bateria', '$contrasena', '$extras', '$trabajo', '$presupuesto', '$total', '$aprobado', '$lafecha', 'abierto', '$sucursal')");
				
				?><script>location.href='computadoras.php?ssid=<? echo rand(111111,999999); ?>'</script><? }
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
      <? include("menu.php"); ?></td>
  </tr>
  
  <tr>
    <td height="17" colspan="2" background="images/top.png"></td>
  </tr>
  <tr>
    <td height="500" colspan="2" valign="top" background="images/medio.png">
    <div style="margin-left:20px; margin-right:20px">
      <h1>Pc´s y Portátiles</h1>
      <div id="agregar" style="display:<? echo "block"; ?>; margin:20px; padding:10px; border:1px solid #BBBBBB; width:620px; background-color:#E5E5E5">
        <form id="form1" name="form1" method="post" action="#SELF">
          
          <span class="titulo">Datos del Cliente</span><br />
          <br />
          <div id="buscarcliente">
            <table width="600" border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td width="55">Cliente</td>
                  <td width="536"><select name="cliente" id="cliente">
                  <? $b=mysql_query("select * from clientes order by apellido");
				  	while ($s=mysql_fetch_array($b)) {  ?>
                  <option value="<? echo $s[0]; ?>" <? if ($s[0]==$saco[cliente]) {  ?>selected="selected"<? } ?>><? echo "$s[apellido], $s[nombre] - $s[email1]"; ?></option>
                  <? } ?>
                  </select>                  </td>
                </tr>
              </table>
          </div>
          
          <? 
	  	 $busco=mysql_query("select * from computadoras $filtro $orden");
		 $saco=mysql_fetch_array($busco);
	     ?>
         
          <br />
            <br />
            <span class="titulo">Datos del Equipo</span><br />
            <br />
            <table width="600" border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td width="90">Equipo</td>
                <td><input name="tipoequipo" type="radio" id="radio" value="sobremesa" <? if ($saco[tipoequipo]=="sobremesa") { ?>checked="checked"<? } ?> />
                Sobremesa                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="tipoequipo" id="radio2" value="portatil"  <? if ($saco[tipoequipo]=="portatil") { ?>checked="checked"<? } ?> />
                Portatil &nbsp;</td>
              </tr>
              <tr>
                <td>Modelo</td>
                <td><input style="width:98%" type="text" name="modelo" id="modelo" value="<? echo $saco[modelo]; ?>" /></td>
              </tr>
              <tr>
                <td>N° de serie</td>
                <td><input style="width:98%" type="text" name="nserie" id="nserie"  value="<? echo $saco[nserie]; ?>" /></td>
              </tr>
              <tr>
                <td nowrap="nowrap">Daños visibles</td>
                <td><input style="width:98%" type="text" name="danos" id="danos"  value="<? echo $saco[danos]; ?>" /></td>
              </tr>
              <tr>
                <td>Deja cargador</td>
                <td><select name="cargador" id="cargador">
                  <option <? if ($saco[cargador]=="si") { ?>selected="selected"<? } ?>>si</option>
                  <option <? if ($saco[cargador]=="no") { ?>selected="selected"<? } ?>>no</option>
                </select>                </td>
              </tr>
              <tr>
                <td>Deja bateria</td>
                <td><select name="bateria" id="bateria">
                  <option <? if ($saco[bateria]=="si") { ?>selected="selected"<? } ?>>si</option>
                  <option <? if ($saco[bateria]=="no") { ?>selected="selected"<? } ?>>no</option>
                </select></td>
              </tr>
              <tr>
                <td>Contraseña</td>
                <td><input style="width:98%" type="text" name="contrasena" id="contrasena" value="<? echo $saco[contrasena]; ?>"  /></td>
              </tr>
              <tr>
                <td>Avería</td>
                <td><textarea name="averia" rows="5" id="averia" style="width:98%"><? echo $saco[averia]; ?></textarea></td>
              </tr>
              <tr>
                <td>Extras</td>
                <td><textarea name="extras" rows="3" id="extras" style="width:98%"><? echo $saco[averia]; ?></textarea></td>
              </tr>
              <tr>
                <td>Presupuesto</td>
                <td><strong>&#8364;</strong> 
                  <input style="width:30%" type="text" name="presupuesto" id="presupuesto" value="<? echo $saco[presupuesto]; ?>"  /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="radio" name="aprobado" id="radio3" value="si" <? if ($saco[aprobado]=="si") { ?> checked="checked" <? } ?> />
                  Aprobado                &nbsp;&nbsp;&nbsp;
                  <input name="aprobado" type="radio" id="radio4" value="no"  <? if ($saco[aprobado]=="noEdi") { ?> checked="checked" <? } ?>  />
                A confirmar</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td valign="middle"><input type="submit" name="agregar" id="agregar" value="  Actualizar  " /></td>
              </tr>
            </table>
          </form>
        </div>
      <br />
      
      
		
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
