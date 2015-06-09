<? include("logadmin.php"); 
if(isset($_REQUEST["UpdateConf"])&& $_REQUEST["UpdateConf"]=='S'){
    //Actualizar Archivo XML.
    $XMLFile="<?xml version='1.0' encoding='UTF-8'?>
<xml>
	<MailConfs>
		<MailConf>
			<SMTPAuth>".$_REQUEST["SMTPAuth"]."</SMTPAuth>
			<SMTPSecure>".$_REQUEST["SMTPSecure"]."</SMTPSecure>
			<HOST>".$_REQUEST["HOST"]."</HOST>
			<Port>".$_REQUEST["Port"]."</Port>
			<Username>".$_REQUEST["Username"]."</Username>
			<Password>".$_REQUEST["Password"]."</Password>
			<SetFrom>".$_REQUEST["SetFrom"]."</SetFrom>
                        <SetFromName>".$_REQUEST["SetFromName"]."</SetFromName>
			<AddReplyTo>".$_REQUEST["AddReplyTo"]."</AddReplyTo>
		</MailConf>
	</MailConfs>
</xml> ";
$XMLConf = simplexml_load_string($XMLFile);

$XMLConf->asXml('mailconf.xml');
}
if ($logadmin) { 


if ($subir) {		
					$fecha = time ();
					$fecha=$fecha-8100; // Con esto lo pongo en cero
					$hora=date ( "H" , $fecha ); 
					$minuto=date ( "i" , $fecha );
					$ano=date ( "Y" , $fecha );
					$mes=date ( "m" , $fecha );
					$dia=date ( "d" , $fecha );
					$hora=date ( "H" , $fecha ); 
					$minuto=date ( "i" , $fecha );
					$lafechadehoy="$ano-$mes-$dia $hora:$minuto:$segundo";

					$nombre=$_FILES['archivo']['name'];
					$tipodearchivo=$_FILES['archivo']['type']; 
					
					$nombre= ereg_replace( " ", "_", $nombre );
					
					$busco=mysql_query("select * from news_empresas order by id_news desc");
					$saco=mysql_fetch_array($busco);
					$numero=$saco[0]+1;
					if (strlen($numero)==1) { $numero="000".$numero; }
					if (strlen($numero)==2) { $numero="00".$numero; }
					if (strlen($numero)==3) { $numero="0".$numero; }
					
					$numero.="-";
							
					$dir="news_empresas/";
					move_uploaded_file($_FILES['archivo']['tmp_name'], $dir.$numero.$nombre);
					
					$elarchivo=$numero.$nombre;
					
					
					function createThumb($spath, $dpath, $maxd) {
											 $src=@imagecreatefromjpeg($spath);
											 if (!$src) {return false;} else {
											  $srcw=imagesx($src);
											  $srch=imagesy($src);
											  if ($srcw<$srch) {$height=$maxd;$width=floor($srcw*$height/$srch);}
											  else {$width=$maxd;$height=floor($srch*$width/$srcw);}
											  if ($width>$srcw && $height>$srch) {$width=$srcw;$height=$srch;}  //if image is actually smaller than you want, leave small (remove this line to resize anyway)
											  $thumb=imagecreatetruecolor($width, $height);
											  if ($height<100) {imagecopyresized($thumb, $src, 0, 0, 0, 0, $width, $height, imagesx($src), imagesy($src));}
											  else {imagecopyresampled($thumb, $src, 0, 0, 0, 0, $width, $height, imagesx($src), imagesy($src));}
											  imagejpeg($thumb, $dpath);
											  return true;
											 }
											}
											$src = $dir.$numero.$nombre;
											createThumb($src,$src,700);
											
											$src2 = $dir."TN".$numero.$nombre;
											createThumb($src,$src2,180);
											
					$ingreso=mysql_query("insert into news_empresas (archivo, enviado, asunto, creado, el_link ) values ('$elarchivo','no', '$asunto', '$lafechadehoy', '$el_link')"); 
					
					?><script>location.href='empresas_news.php?sbo=true'</script><?
			} 
    $xml = file_get_contents("mailconf.xml");
    $DOM = new SimpleXMLElement($xml);
    $SMTPAuth = $DOM->MailConfs->MailConf[0]->SMTPAuth;
    $SMTPSecure = $DOM->MailConfs->MailConf[0]->SMTPSecure;
    $HOST = $DOM->MailConfs->MailConf[0]->HOST;
    $Port = $DOM->MailConfs->MailConf[0]->Port;
    $Username = $DOM->MailConfs->MailConf[0]->Username;
    $Password = $DOM->MailConfs->MailConf[0]->Password;
    $SetFrom = $DOM->MailConfs->MailConf[0]->SetFrom;
    $SetFromName=$DOM->MailConfs->MailConf[0]->SetFromName;
    $AddReplyTo = $DOM->MailConfs->MailConf[0]->AddReplyTo;
                        ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>
<link href="js/basic.css" rel="stylesheet" type="text/css" />
<link href="estilos.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.js"></script>
<script src="js/jquery.simplemodal.1.4.4.min.js"></script>
<? include("funciones.php"); ?>
<script>
    function ModificarCorreo(){
        $("<div><b>DATOS SERVIDOR CORREO ELECTR&Oacute;NICO</b><br>"+
          "**Modifique los siguientes datos s&oacute;lo si esta seguro.<br>"+
          "<br>"+
          "<form action='empresas_news.php'>"+
          "<div style='margin-bottom:5px'><div style='width:150px;text-align: right;padding-right:3px;float:left'>Autenticaci&oacute;n SMTP:</div><select name='SMTPAuth' style='width:250px'><? 
                        if($SMTPAuth=='true'){
                            echo "<option selected=true value='true'>Si</option><option value='false'>No</option>";
                        }else{
                            echo "<option value='true'>Si</option><option value='false' selected=true>No</option>";
                            
                        } ?></select></div>"+
          "<div style='margin-bottom:5px'><div style='width:150px;text-align: right;padding-right:3px;float:left'>Seguridad SMTP:</div><select name='SMTPSecure' style='width:250px'><? 
                        if($SMTPSecure=='tls'){
                            echo "<option selected=true value='tls'>TLS</option>"
                                ."<option value='ssl'>SSL</option>"
                                ."<option value='none'>Ninguno</option>";
                        }
                        if($SMTPSecure=='ssl'){
                            echo "<option value='tls'>TLS</option>"
                                ."<option value='ssl' selected=true>SSL</option>"
                                ."<option value='none'>Ninguno</option>";
                        }
                        if($SMTPSecure=='none'){
                            echo "<option value='tls'>TLS</option>"
                                ."<option value='ssl'>SSL</option>"
                                ."<option value='none' selected=true>Ninguno</option>";
                        }
                        ?></select></div>"+
          "<div style='margin-bottom:5px'><div style='width:150px;text-align: right;padding-right:3px;float:left'>Host - Servidor SMTP:</div><input name='HOST' style='width:250px' value='<? echo $HOST; ?>'></div>"+
          "<div style='margin-bottom:5px'><div style='width:150px;text-align: right;padding-right:3px;float:left'>Puerto:</div><input name='Port' style='width:250px' value='<? echo $Port; ?>'></div>"+
          "<div style='margin-bottom:5px'><div style='width:150px;text-align: right;padding-right:3px;float:left'>Usuario:</div><input name='Username' style='width:250px' value='<? echo $Username; ?>'></div>"+
          "<div style='margin-bottom:5px'><div style='width:150px;text-align: right;padding-right:3px;float:left'>Contrase&ntilde;a:</div><input name='Password' style='width:250px' value='<? echo $Password; ?>'></div>"+
          "<div style='margin-bottom:5px'><div style='width:150px;text-align: right;padding-right:3px;float:left'>Enviado de:</div><input name='SetFrom' style='width:250px' value='<? echo $SetFrom; ?>'></div>"+
          "<div style='margin-bottom:5px'><div style='width:150px;text-align: right;padding-right:3px;float:left'>Nombre remitente:</div><input name='SetFromName' style='width:250px' value='<? echo $SetFromName; ?>'></div>"+
          "<div style='margin-bottom:5px'><div style='width:150px;text-align: right;padding-right:3px;float:left'>Responder a:</div><input name='AddReplyTo' style='width:250px' value='<? echo $AddReplyTo; ?>'></div>"+
          "<div style='width:100%;text-align:center'><button style='width:100px;padding:3px'>Actualizar</button></div>"+
          "<input type='hidden' name='UpdateConf' value='S'></input>"+
          "</form>"+
          "</div>").modal({containerCss:{width:'450px',height:'330px'}});
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
      <? /* <div style="width:400px; float:right" ><a href='empresas_lista.php'><span class="titulo">&raquo; Empresas suscriptas</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='empresas_mensajes.php'><span class="titulo">&raquo; Plantillas E-mails</a></span></div>*/ ?>
      <h1>Newsletter</h1>
      <br />
      <span style="cursor:pointer;" onClick="mostrar('subirnews');">[+] Nuevo Newsletter</span><br/>
      <span style="cursor:pointer;" onclick="ModificarCorreo()">[+] Configuraci&oacute;n Servidor de correos</span><br/>
        <br />
      
      <div id="subirnews" style="display:<? echo "none"; ?>; border:1px dotted #666; background-color:#FAF8A0; padding:10px; width:550px">
      <form  id="formulario" name="form1" method="post" action="#SELF" enctype="multipart/form-data">
        Selecciona el archivo a enviar en el Newsletter<br /><br />
        <table width="95%" border="0" cellspacing="5" cellpadding="0">
          <tr>
            <td width="21%">Newsletter:</td>
            <td width="79%"><input type="file" name="archivo" id="archivo"  /></td>
          </tr>
          <tr>
            <td>Asunto:</td>
            <td><label for="asunto"></label>
              <input style="width:97%" type="text" name="asunto" id="asunto" /></td>
          </tr>
          <tr>
            <td>Link:</td>
            <td>http://
              <input style="width:80%" type="text" name="el_link" id="el_link" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="subir" id="subir" value="Subir" /> 
              &nbsp;&nbsp;&nbsp;<a href="#" onClick="ocultar('subirnews');">Cancelar</a></td>
          </tr>
        </table>
        &nbsp;
      </form>
      </div>
      <br />
      <table width="900" border="0" cellpadding="5" cellspacing="0" class="texto" style="border:1px solid #666">
        <tr>
          <td width="190" bgcolor="#E2E2E2">&nbsp;</td>
          <td bgcolor="#E2E2E2"><strong>Asunto</strong></td>
          <td width="100" align="center" bgcolor="#E2E2E2"><strong>Creado</strong></td>
          <td width="130" align="center" bgcolor="#E2E2E2"><strong>Enviado</strong></td>
          <td width="100" align="center" bgcolor="#E2E2E2"><strong>Fecha envío</strong></td>
          <td width="90" align="center" bgcolor="#E2E2E2"><strong>Destinatarios</strong></td>
          <td width="55" align="center" bgcolor="#E2E2E2"><strong>Eliminar</strong></td>
          </tr>
          <? $borde="style='border-bottom:1px dotted #ccc'"; 
		  	$busco=mysql_query("select * from news_empresas order by creado desc");
		  	while ($saco=mysql_fetch_array($busco))  { ?>
        <tr>
          <td <? echo $borde; ?>><? $archivo="news_empresas/TN$saco[archivo]"; if (file_exists($archivo)) { ?><img src="news_empresas/TN<? echo $saco[archivo]; ?>" /><? } else { 
		  
		  $imagen="news_empresas/$saco[archivo]";
		  $tamano=getimagesize($imagen);
					   					$ancho=$tamano[0];
					   					$alto=$tamano[1];
					  					if ($alto > $ancho){ $x=($alto/180); $anchod=($ancho/$x); $altod=180;}
					  					else {$x=($ancho/180); $altod=($alto/$x); $anchod=180;}
										
			?><img src="<? echo $imagen; ?>" width="<? echo $anchod; ?>" height="<? echo $altod; ?>" /><?
		   } ?></td>
          <td <? echo $borde; ?>><? echo $saco[asunto]; ?>&nbsp;</td>
          <td <? echo $borde; ?> align="center"><? echo substr ($saco[creado],0,16)." hs."; ?>&nbsp;</td>
          <td <? echo $borde; ?> align="center"><?
		  if ($saco[enviado]=="si") { ?>
          <div style="margin-top:5px; background-color:#FFFFCC; padding:3px;-moz-border-radius: 3px;border-radius: 3px; padding:3px; border:1px solid #999;"><a href='empresas_news_enviar.php?id=<? echo $saco[0]; ?>'>Reenviar a <strong>nuevas</strong> <strong>Empresas</strong></a></div>
          <? }  else { ?>
          <div style="margin-top:5px; background-color:#CCC8F7;-moz-border-radius: 3px;border-radius: 3px; padding:3px; border:1px solid #999;"><a href='empresas_news_enviar.php?id=<? echo $saco[0]; ?>'>Enviar a <strong>todas </strong>las<strong> empresas</strong></a></div>
          <? } ?>
          <br /><div style="margin:5px 0px; background-color:#D7FACB; padding:3px;-moz-border-radius: 3px;border-radius: 3px; padding:3px; border:1px solid #999;"><a href='empresas_news_enviar_simple.php?id=<? echo $saco[0]; ?>'>Enviar a <strong>una empresa</strong></a></div>
          
         <div style="margin:10px"><hr /></div>
          <?
          if ($saco[enviado_clientes]=="si") { ?>
          <div style="margin-top:5px; background-color:#FFFFCC; padding:3px;-moz-border-radius: 3px;border-radius: 3px; padding:3px; border:1px solid #999;"><a href='empresas_news_enviar_clientes.php?id=<? echo $saco[0]; ?>'>Reenviar a <strong>nuevos</strong> <strong>Clientes</strong></a></div>
          <? }  else { ?>
          <div style="margin-top:5px; background-color:#CCC8F7;-moz-border-radius: 3px;border-radius: 3px; padding:3px; border:1px solid #999;"><a href='empresas_news_enviar_clientes.php?id=<? echo $saco[0]; ?>'>Enviar a <strong>todos </strong>los<strong> clientes</strong></a></div>
          <? } ?>
          <br /><div style="margin:5px 0px; background-color:#D7FACB; padding:3px;-moz-border-radius: 3px;border-radius: 3px; padding:3px; border:1px solid #999;"><a href='empresas_news_enviar_simple_clientes.php?id=<? echo $saco[0]; ?>'>Enviar a <strong>un</strong> cliente</a></div>
          
          </td>
          <td <? echo $borde; ?> align="center"><? if ($saco[fecha]!="0000-00-00 00:00:00") { echo substr($saco[fecha],0,16)." hs."; } ?>&nbsp;</td>
          <td <? echo $borde; ?> align="center"><div onClick="mostrar('dest<? echo $saco[0]; ?>');" style="cursor:pointer;">Ver<br />
            destinatarios</div></td>
          <td <? echo $borde; ?> align="center"><a href="empresas_news_eliminar.php?id=<? echo $saco[0]; ?>">Eliminar</a></td>
          </tr>
          <tr><td colspan="7" ><div style=" display:<? echo "none"; ?>; line-height:22px" id="dest<? echo $saco[0]; ?>" ><? $losdest=str_replace("|", "<br>", $saco[enviados]); echo substr($losdest,4,99999999); ?>
          <div align="center" style=" padding:20px; width:200px;margin:30px; background-color:#FFC; cursor:pointer" onClick="ocultar('dest<? echo $saco[0]; ?>'); ">Ocultar detalles</div></div></td>
          <? } ?>
    </table>
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
