<? include("logadmin.php"); 
	
if ($logadmin) { 

if ($sucursal=="Arrecife") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Tias") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Centro") { $tabla_empresas=" empresas_integradas "; } 

if ($agregar) {   
				$numero_rand=rand(111111,999999);
				$ingreso=mysql_query("insert into $tabla_empresas (nombre, contacto, cif, tel1, tel2, email, comentarios, activo, codigo, tinta) values ('$nombre', '$contacto', '$cif', '$tel1', '$tel2', '$email', '$comentarios', 'si', '$numero_rand', '$tinta')"); 
				EnviarWhats($tel1,$ahlparametros["em_whtsppbnvnd"]["descripcion"]);
                                EnviarWhats($tel2,$ahlparametros["em_whtsppbnvnd"]["descripcion"]);
				
				if ($email!='' and $bienvenida) {   $busco=mysql_query("select * from mensaje where clase='bienvenida'");
													$saco=mysql_fetch_array($busco);
													
													$mensaje=nl2br($saco[mensaje]);
													
													$mensaje=str_replace('[nombre]',"<strong>$contacto</strong>",$mensaje);
													 
											  require_once 'class.phpmailer.php';
											  													
											  $mail = new PHPMailer ();
											  $mail -> From = "info@ahlinformatica.com";
											  $mail -> FromName = "AHL Informatica";
											  $mail -> AddAddress("$email");
											  $mail->CharSet = "utf-8";
											  $mail -> Subject = "$saco[asunto]";
											  $mail -> Body = $mensaje;
											  $mail -> IsHTML (true);
											  $mail->Host = "mail.ahlinformatica.com";
											  $mail->AddReplyTo("info@ahlinformatica.com", "info@ahlinformatica.com");
											  $mail->Timeout=30;
											  //$mail->AddEmbeddedImage($elarchivo);
											  $mail->Send();
											  
											 $b=mysql_query("select * from $tabla_empresas order by id_empresa desc");
											 $s=mysql_fetch_array($b);
											 
											 $actualizo=mysql_query("update $tabla_empresas set mail_bienvenida='si' where id_empresa='$s[0]'"); 
								}
				
				
				?><script>location.href='empresas_lista.php?ssid=<? echo rand(111111,999999); ?>'</script><? }
 
if ($or=="") { $or="nom"; } 
 
 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<link href="js/DataTables/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<script src="js/DataTables/js/jquery.js"></script>
<script src="js/DataTables/js/jquery.dataTables.js"></script>
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
      <div style="float:right; margin-right:10px" align="right">
          <form id="form2" name="form2" method="post" action="#SELF">
          <? if ($or=="nom") { ?>
          <a href="empresas_lista.php?or=fec">Ordenar por fecha</a>
          <? } else { ?>
          <a href="empresas_lista.php?or=nom">Ordenar por nombre</a>
          <? }  if ($buscar) { ?>
          <a href="empresas_lista.php">&laquo; Volver a todas las empresas...</a> &nbsp;
          <?  } ?><div style="height:7px"></div>
          <input type="text" name="buscado" id="buscado"  style="width:200px" <? if ($buscar) { ?> value="<? echo $buscado; ?>"<? } ?>/> 
          <input type="submit" name="buscar" id="buscar" value=" Buscar " />
          </form>
        </div>
      <h1><a href='empresas_news.php'>Newsletters</a> &raquo; Empresas</h1>
      <a href="#" onClick="mostrar('agregarcliente');">[+]Nueva empresa</a> &nbsp;&nbsp;&nbsp; <a href='empresas_exportar.php'>[+] Exportar</a><br />
      <div id="agregarcliente" style="display:<? echo "none"; ?>; margin:20px; padding:10px; border:1px solid #BBBBBB; width:620px; background-color:#E5E5E5">
        <form id="form1" name="form1" method="post" action="#SELF">
          <table width="600" border="0" cellspacing="3" cellpadding="0">
            <tr>
              <td height="30" colspan="2" valign="top" class="titulo">Nueva empresa</td>
              </tr>
            <tr>
              <td height="30" colspan="2" class="texto_gris">&nbsp;</td>
              </tr>
            <tr>
              <td width="84">Nombre</td>
              <td width="507"><input style="width:98%" type="text" name="nombre" id="nombre" /></td>
            </tr>
            <tr>
              <td>Contacto</td>
              <td><input style="width:98%" type="text" name="contacto" id="contacto" onChange="habilitar_enviar();"  /></td>
            </tr>
            <tr>
              <td>CIF</td>
              <td><input style="width:98%" type="text" name="cif" id="cif" onChange="habilitar_enviar();"  /></td>
            </tr>
            <tr>
              <td>Tel 1</td>
              <td><input style="width:98%" type="text" name="tel1" id="tel1" /></td>
            </tr>
            <tr>
              <td>Tel 2</td>
              <td><input style="width:98%" type="text" name="tel2" id="tel2" /></td>
            </tr>
            <tr>
              <td>E-mail</td>
              <td><input style="width:98%" type="text" name="email" id="email" /></td>
            </tr>
            <tr>
              <td colspan="2">Email de Bienvenida: 
                <input name="bienvenida" type="checkbox" id="bienvenida" checked="checked" />
                <label for="bienvenida"></label></td>
              </tr>
            <tr>
              <td>Tinta</td>
              <td><textarea name="tinta" rows="5" id="tinta" style="width:98%"></textarea></td>
            </tr>
            <tr>
              <td>Comentarios</td>
              <td><textarea name="comentarios" rows="5" id="comentarios" style="width:98%"></textarea></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td valign="middle"><input type="submit" name="agregar" id="agregar" value="  Agregar  "  /> 
                <a href="#" onClick="ocultar('agregarcliente');">Cancelar</a></td>
            </tr>
          </table>
          </form>
        </div>
      <br />
      <table id="empresas" style="border:1px solid #E5E5E5" width="930" border="0" cellspacing="3" cellpadding="0">
        <thead>
            <tr>
              <th height="30" bgcolor="#DBDBDB">Nombre</th>
              <th width="50" height="30" align="center" bgcolor="#DBDBDB">E-mail</th>
              <th width="90" height="30" align="center" bgcolor="#DBDBDB">Tel 1</th>
              <th width="43" height="30" align="center" bgcolor="#DBDBDB">Email<br />
                Bienvenida</th>
              <th width="44" align="center" bgcolor="#DBDBDB">Email<br />
                Solicitud</th>
              <th width="60" align="center" bgcolor="#DBDBDB">Activo</th>
              <th width="60" height="30" align="center" bgcolor="#DBDBDB">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <? 
		$filtro; $orden;
		if ($or=="nom") { $orden=" order by nombre";  } 
		if ($or=="fec") { $orden=" order by id_empresa desc";  } 
		if ($buscar) { $filtro=" where ( nombre like '%$buscado%' 
										or email like '%$buscado%' 
										or contacto like '%$buscado%' 
										or tel1 like '%$buscado%' 
										or tel2 like '%$buscado%' 
										or comentarios like '%$buscado%' ) "; } 
		 $busco=mysql_query("select * from $tabla_empresas $filtro $orden"); 
		while ($saco=mysql_fetch_array($busco)) { 
		$link=" style='cursor:pointer; border-bottom:1px dotted #666;' onclick=\"location.href='empresas_editar.php?id=$saco[0]'\""; 
        if ($saco[desuscripto]=="si") { $fondo=" bgcolor='#FFFF99' "; } else { $fondo=""; } 
		?>
        <tr >
          <td <? echo $link; echo $fondo; ?>><? echo $saco[nombre]; ?></td>
          <td nowrap="nowrap" <? echo $link; echo $fondo; ?>><? echo $saco[email]; ?>&nbsp;</td>
          <td <? echo $link; echo $fondo; ?>><? echo $saco[tel1]; ?>&nbsp;</td>
          <td <? echo $link; echo $fondo; ?>><? echo $saco[mail_bienvenida]; ?></td>
          <td <? echo $link; echo $fondo; ?>><? echo $saco[mail_solicitud]; ?></td>
          <td <? echo $fondo; ?> style="border-bottom:1px dotted #666;" align="center"><? if ($saco[activo]=="no") { ?><span style="color:#F00; font-weight:bold">NO</span><? } else { echo $saco[activo]; } ?></td>
          <td <? echo $fondo; ?> style="border-bottom:1px dotted #666;" align="center"><a href="empresas_eliminar.php?id=<? echo $saco[0]; ?>">Eliminar</a></td>
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
