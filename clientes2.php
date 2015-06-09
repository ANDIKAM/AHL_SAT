<? include("logadmin.php"); 
	
if ($logadmin) { 

if ($agregar) {
				$ingreso=mysql_query("insert into clientes (nombre, apellido, email1, email2, direccion, cp, telefono, movil1, movil2, extras, dni, news) values ('$nombre', '$apellido', '$email1', '$email2', '$direccion', '$cp', '$telefono', '$movil1', '$movil2', '$extras', '$dni', '$news')"); 
				
								if ($email1!='' and $bienvenida) {   
											
											$busco=mysql_query("select * from mensaje where clase='bienvenida'");
											$saco=mysql_fetch_array($busco);
													 
											  require_once 'class.phpmailer.php';
											  
											
											$mensaje=nl2br($saco[mensaje]);
											$mensaje=str_replace('[nombre]',"<strong>$apellido $nombre</strong>",$mensaje);
													
																										
											  $mail = new PHPMailer ();
											  $mail -> From = "info@ahlinformatica.com";
											  $mail -> FromName = "AHL Informatica";
											  $mail -> AddAddress("$email1");
											  $mail->CharSet = "utf-8";
											  $mail -> Subject = "$saco[asunto]";
											  $mail -> Body = $mensaje;
											  $mail -> IsHTML (true);
											  $mail->Host = "mail.ahlinformatica.com";
											  $mail->AddReplyTo("info@ahlinformatica.com", "info@ahlinformatica.com");
											  $mail->Timeout=30;
											  //$mail->AddEmbeddedImage($elarchivo);
											  $mail->Send();
											  
											 $b=mysql_query("select * from clientes order by id_clientes desc");
											 $s=mysql_fetch_array($b);
											 
											 $actualizo=mysql_query("update clientes set mail_bienvenida='si' where id_clientes='$s[0]'"); 
								
								
								}
				
				
				?><script>location.href='clientes.php?ssid=<? echo rand(111111,999999); ?>'</script><? }
 
if ($eliminar) {
				$elimino=mysql_query("delete from clientes where id_clientes='$id_cliente'");
				?><script>location.href='clientes.php?ssid=<? echo rand(111111,999999); ?>'</script><?
				}  
 
 
if ($or=="") { $or="nom"; } 
 
 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<? include("funciones.php"); ?>
<script>
function confirmar_eliminar_cliente(id_cliente, nombre) {
												if (confirm('Está seguro que desea eliminar el cliente '+nombre+'?')) { location.href='clientes.php?eliminar=true&id_cliente='+id_cliente; } 
													
												}

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
        <form id="form2" name="form2" method="post" action="#SELF">
         &nbsp;
          <? if ($or=="nom") { ?>
          <a href="clientes.php?or=fec">Ordenar por fecha</a>
          <? } else { ?>
          <a href="clientes.php?or=nom">Ordenar por apellido</a>
          <? }  if ($buscar) { ?>
          <a href="clientes.php">&laquo; Volver a todos los clientes...</a> &nbsp;
          <?  } ?><div style="height:7px"></div>
          <input type="text" name="buscado" id="buscado"  style="width:200px" <? if ($buscar) { ?> value="<? echo $buscado; ?>"<? } ?>/> 
          <input type="submit" name="buscar" id="buscar" value=" Buscar " />
          </form>
        </div><h1>Clientes</h1>
      <a href="#" onClick="mostrar('agregarcliente');">[+] Nuevo cliente</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="clientes_exportar.php">[+] Exportar</a><br />
      <div id="agregarcliente" style="display:<? echo "none"; ?>; margin:20px; padding:10px; border:1px solid #BBBBBB; width:620px; background-color:#E5E5E5">
        <form id="form1" name="form1" method="post" action="#SELF">
          <table width="600" border="0" cellspacing="3" cellpadding="0">
            <tr>
              <td height="30" colspan="2" valign="top" class="titulo">Nuevo Cliente</td>
              </tr>
            <tr>
              <td height="30" colspan="2" class="texto_gris">Los campos <strong>Nombres</strong>, <strong>Apellidos</strong> y <strong>DNI</strong> son <strong>OBLIGATORIOS</strong></td>
              </tr>
            <tr>
              <td width="84">Nombres</td>
              <td width="507"><input style="width:98%" type="text" name="nombre" id="nombre" onChange="habilitar_enviar();" /></td>
            </tr>
            <tr>
              <td>Apellidos</td>
              <td><input style="width:98%" type="text" name="apellido" id="apellido" onChange="habilitar_enviar();"  /></td>
            </tr>
            <tr>
              <td>DNI</td>
              <td><input style="width:98%" type="text" name="dni" id="dni" onChange="habilitar_enviar();"  /></td>
            </tr>
            <tr>
              <td>Dirección</td>
              <td><input style="width:98%" type="text" name="direccion" id="direccion" /></td>
            </tr>
            <tr>
              <td>C.P.</td>
              <td><input style="width:98%" type="text" name="cp" id="cp" /></td>
            </tr>
            <tr>
              <td>E-mail 1</td>
              <td><input style="width:98%" type="text" name="email1" id="email1" /></td>
            </tr>
            <tr>
              <td>E-mail 2</td>
              <td><input style="width:98%" type="text" name="email2" id="email2" /></td>
            </tr>
            <tr>
              <td>Teléfono</td>
              <td><input style="width:98%" type="text" name="telefono" id="telefono" /></td>
            </tr>
            <tr>
              <td>Movil 1</td>
              <td><input style="width:98%" type="text" name="movil1" id="movil1" /></td>
            </tr>
            <tr>
              <td>Movil 2</td>
              <td><input style="width:98%" type="text" name="movil2" id="movil2" /></td>
            </tr>
            <tr>
              <td colspan="2">Email de Bienvenida:
                <input name="bienvenida" type="checkbox" id="bienvenida" checked="checked" />
                <label for="bienvenida"></label></td>
              </tr>
            <tr>
              <td>Comentarios</td>
              <td><textarea name="extras" rows="5" id="extras" style="width:98%"></textarea></td>
            </tr>
            <tr>
              <td>Newsletter</td>
              <td valign="middle"><input name="news" type="checkbox" id="news" value="si" checked="checked" />
                <label for="news"></label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td valign="middle"><input type="submit" name="agregar" id="agregar" value="  Agregar  " disabled="disabled" /> 
                <a href="#" onClick="ocultar('agregarcliente');">Cancelar</a></td>
            </tr>
          </table>
          </form>
        </div>
      <br />
      <table style="border:1px solid #E5E5E5" width="930" border="0" cellspacing="3" cellpadding="0">
        <tr >
          <th height="30" bgcolor="#DBDBDB">Nombre</th>
          <th width="200" height="30" align="center" bgcolor="#DBDBDB">E-mail</th>
          <? /*<th width="250" height="30" align="center" bgcolor="#DBDBDB">Dirección</th>*/ ?>
          <th width="100" height="30" align="center" bgcolor="#DBDBDB">Movil</th>
          <th width="20" align="center" bgcolor="#DBDBDB">Bienvenida</th>
          <th width="20" align="center" bgcolor="#DBDBDB">Solicitud</th>
          <th width="60" height="30" align="center" bgcolor="#DBDBDB">&nbsp;</th>
        </tr>
        <? 
		$filtro; $orden;
		if ($or=="nom") { $orden=" order by apellido, nombre";  } 
		if ($or=="fec") { $orden=" order by id_clientes desc";  } 
		if ($buscar) { $filtro=" where ( nombre like '%$buscado%' or apellido like '%$buscado%' or email1 like '%$buscado%' or email2 like '%$buscado%' or direccion like '%$buscado%' or cp like '%$buscado%' or telefono like '%$buscado%' or movil1 like '%$buscado%' or movil2 like '%$buscado%' or extras like '%$buscado%' or dni like '%$buscado%' ) "; } 
		 $busco=mysql_query("select * from clientes $filtro $orden"); 
		while ($saco=mysql_fetch_array($busco)) { 
		$link=" style='cursor:pointer; border-bottom:1px dotted #666;' onclick=\"location.href='clientes_editar.php?id=$saco[0]'\""; ?>
        
        <tr >
          <td <? echo $link; ?>><? echo "$saco[apellido] $saco[nombre]"; ?></td>
          <td nowrap="nowrap" <? echo $link; ?>><? echo $saco[email1]; ?>&nbsp;</td>
          <? /* <td <? echo $link; ?>><? echo $saco[direccion]; ?>&nbsp;</td>*/ ?>
          <td <? echo $link; ?>><? echo $saco[movil1]; ?>&nbsp;</td>
          <td width="20" <? echo $link; ?>><? echo $saco[mail_bienvenida]; ?></td>
          <td width="20" <? echo $link; ?>><? echo $saco[mail_solicitud]; ?></td>
          <td style="border-bottom:1px dotted #666;" align="center"><a href="Javascript:void(0);" onClick="confirmar_eliminar_cliente('<? echo $saco[0]; ?>', '<? echo "$saco[apellido] $saco[nombre]"; ?>');">Eliminar</a></td>
        </tr>
        <? } ?>
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
