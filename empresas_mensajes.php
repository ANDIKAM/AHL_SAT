<? include("logadmin.php"); 
header("Content-Type: text/html;charset=utf-8");
if(isset($_REQUEST["UpdateConf"])&& $_REQUEST["UpdateConf"]=='S' &&
   isset($_REQUEST["UpdateType"])&& $_REQUEST["UpdateType"]=='1'){
    //Actualizar ARCHIVOS
    
    //Actualizar Archivo XML.
    $XMLFile="<?xml version='1.0' encoding='UTF-8'?>
<xml>
	<WhatsappConfs>
		<WhatsappConf>
			<userphone>".$_REQUEST["userphone"]."</userphone>
			<password>".$_REQUEST["password"]."</password>
			<application>".$_REQUEST["application"]."</application>
			<debug>".$_REQUEST["debug"]."</debug>
                        <codpais>".$_REQUEST["codpais"]."</codpais>
		</WhatsappConf>
	</WhatsappConfs>
</xml>";
$XMLConf = simplexml_load_string($XMLFile);
$XMLConf->asXml('whatsapp/whatsappconf.xml');
}
if(isset($_REQUEST["UpdateConf"])&& $_REQUEST["UpdateConf"]=='S' &&
   isset($_REQUEST["UpdateType"])&& $_REQUEST["UpdateType"]=='2'){
    if(isset($_FILES) && count($_FILES)> 0)
    {  
        $files = array();
        $dir = $_SERVER["DOCUMENT_ROOT"].$prefijo."/js/ofertadiaria/";
        foreach($_FILES as $fl){
                $ext = strtolower(substr($fl['name'],strrpos($fl['name'],'.') +1));
                if(!($ext !='jpg' && $ext !='mp3')){
                $name= $ext=='jpg'?'imagen.jpg':'audio.mp3';
                if($fl['size']<=1048576 && $fl['error']==UPLOAD_ERR_OK){ //Solo admite 1MB
                    if(file_exists($dir.$name)){
                        unlink($dir.$name);
                    }
                    move_uploaded_file($fl['tmp_name'],$dir.$name);
                }
            }
        }
    }
    //Actualizar Archivo XML.
    $r1=$_REQUEST['Texto'];
    $r2=(isset($_REQUEST['ofer_audio'])?'1':'0');
    $r3=(isset($_REQUEST['ofer_imagen'])?'1':'0');
    $r4=(isset($_REQUEST['ofer_texto'])?'1':'0');
    $r5=$_SERVER['DOCUMENT_ROOT'].$prefijo."/js/ofertadiaria/imagen.jpg";
    $r6=$_SERVER['DOCUMENT_ROOT'].$prefijo."/js/ofertadiaria/audio.mp3";
    $actualizo=mysql_query("update ahl_parametros set descripcion='$r1' where codigo='em_ofrtdr'");
    $actualizo=mysql_query("update ahl_parametros set descripcion='$r2' where codigo='em_ofrtdr_audio'");
    $actualizo=mysql_query("update ahl_parametros set descripcion='$r3' where codigo='em_ofrtdr_imagen'");
    $actualizo=mysql_query("update ahl_parametros set descripcion='$r4' where codigo='em_ofrtdr_texto'");
    $actualizo=mysql_query("update ahl_parametros set descripcion='$r5' where codigo='em_ofrtdr_imagenurl'");
    $actualizo=mysql_query("update ahl_parametros set descripcion='$r6' where codigo='em_ofrtdr_audiourl'");
    $busco=mysql_query("select * from ahl_parametros");
    $ahlparametros = array();
    while ($saco=mysql_fetch_array($busco)) {
        $clave=$saco["codigo"];
        $ahlparametros[$clave]=$saco;
    }
}

$xml = file_get_contents($_SERVER["DOCUMENT_ROOT"].$prefijo.'/whatsapp/whatsappconf.xml');
$DOM = new SimpleXMLElement($xml);
$userphone = strval($DOM->WhatsappConfs->WhatsappConf[0]->userphone);
$password = strval($DOM->WhatsappConfs->WhatsappConf[0]->password);
$application = strval($DOM->WhatsappConfs->WhatsappConf[0]->application);
$debug = strval($DOM->WhatsappConfs->WhatsappConf[0]->debug);
$codpais = strval($DOM->WhatsappConfs->WhatsappConf[0]->codpais);

$Text = $ahlparametros["em_ofrtdr"]["descripcion"];
$imagenprev= $_SERVER["DOCUMENT_ROOT"].$prefijo."/js/ofertadiaria/imagen.jpg";
$audioprev= $_SERVER["DOCUMENT_ROOT"].$prefijo."/js/ofertadiaria/audio.mp3";
$ofer_img = $ahlparametros["em_ofrtdr_imagen"]["descripcion"];
$ofer_aud = $ahlparametros["em_ofrtdr_audio"]["descripcion"];
$ofer_txt = $ahlparametros["em_ofrtdr_texto"]["descripcion"];
if ($logadmin) { 

if ($sucursal=="Arrecife") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Tias") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Centro") { $tabla_empresas=" empresas_integradas "; } 

if ($actualizar && $actualizar=='Actualizar mensajes') {   
					$actualizo=mysql_query("update mensaje set asunto='$bienvenida_asunto', mensaje='$bienvenida_mensaje' where clase='bienvenida'");
					$actualizo=mysql_query("update mensaje set asunto='$solicitud_asunto', mensaje='$solicitud_mensaje' where clase='solicitud'");			
                                        $actualizo=mysql_query("update ahl_parametros set descripcion='$bienvenida_mensaje_whats' where codigo='em_whtsppbnvnd'");
                                        $busco=mysql_query("select * from ahl_parametros");
                                        $ahlparametros = array();
                                        while ($saco=mysql_fetch_array($busco)) {
                                            $clave=$saco["codigo"];
                                            $ahlparametros[$clave]=$saco;
                                        }
				?><script>location.href='empresas_mensajes.php?ssid=<? echo rand(111111,999999); ?>'</script><? }
 

 
 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>SAT - AHL Informatica</title>
<link href="js/basic.css" rel="stylesheet" type="text/css" />
<link href="estilos.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.js"></script>
<script src="js/jquery.simplemodal.1.4.4.min.js"></script>
<? include("funciones.php"); ?><script>
    function ModificarWhatsApp(){
        $("<div><b>DATOS DE CONFIGURACI&Oacute;N DE WHATSAPP</b><br>"+
          "**Modifique los siguientes datos s&oacute;lo si esta seguro.<br>"+
          "**El Tel&eacute;fono debe tener el indicativo de pa&iacute;s sin el '+'.<br>"+
          "<br>"+
          "<form action='empresas_mensajes.php'>"+
          "<div style='margin-bottom:5px'><div style='width:150px;text-align: right;padding-right:3px;float:left'>C&oacute;digo de pa&iacute;s:</div><input name='codpais' style='width:250px' value='<? echo $codpais; ?>'></div>"+
          "<div style='margin-bottom:5px'><div style='width:150px;text-align: right;padding-right:3px;float:left'>Tel&eacute;fono remitente:</div><input name='userphone' style='width:250px' value='<? echo $userphone; ?>'></div>"+
          "<div style='margin-bottom:5px'><div style='width:150px;text-align: right;padding-right:3px;float:left'>Contrase&ntilde;a:</div><input name='password' style='width:250px' value='<? echo $password; ?>'></div>"+
          "<div style='margin-bottom:5px'><div style='width:150px;text-align: right;padding-right:3px;float:left'>Aplicaci&oacute;n:</div><input name='application' style='width:250px' value='<? echo $application; ?>'></div>"+
          "<div style='margin-bottom:5px'><div style='width:150px;text-align: right;padding-right:3px;float:left'>Depuraci&oacute;n:</div><select name='debug' style='width:250px'><? 
                        if($debug=='true'){
                            echo "<option selected=true value='true'>Si</option><option value='false'>No</option>";
                        }else{
                            echo "<option value='true'>Si</option><option value='false' selected=true>No</option>";
                            
                        } ?></select></div>"+
          "<div style='width:100%;text-align:center'><button style='width:100px;padding:3px'>Actualizar</button></div>"+
          "<input type='hidden' name='UpdateConf' value='S'></input>"+
          "<input type='hidden' name='UpdateType' value='1'></input>"+
          "</form>"+
          "</div>").modal({containerCss:{width:'450px',height:'230px'}});
    }
</script>
<script>
var mensajes="";
var telefonos="";
function enviarWhatsApp(){
    mensaje="";
    $("<div><b>ENVIAR WHATSAPP:"+ 
        "<div>Telefono:</div>"+
        "<input type='text' name='' value='Celular' onchange=\"setTelefono(this.value)\"><br><br>"+
        "<div>Mensaje:</div>"+
        "<textarea style='width:380px' rows='5' value='Mensaje' onchange=\"setMensaje(this.value)\"></textarea><br>"+
        "<button style='width:100px;padding:3px' onclick=\"send()\">Enviar</button>"+ 
        "</div>").modal({containerCss:{width:'420px',height:'200px'}});
}
function setTelefono(value){
    telefonos=value;
}
function setMensaje(value){
    mensajes=value;
}
function send(){
    $.post("SendWhats.php", { numero: telefonos,mensaje:mensajes } );
    alert("Mensaje enviado");
}
        $(document).ready(function(){
            $('#udt_oferta_imagen').change(function (){
                if(!$('#udt_oferta_imagen').is(':checked')){
                    $("#udt_oferta_imagen_file").replaceWith($("#udt_oferta_imagen_file").clone());
                    $("#udt_oferta_imagen_file").hide();
                }else{
                    $("#udt_oferta_imagen_file").show();
                }
            });
            $('#udt_oferta_audio').change(function (){
                if(!$('#udt_oferta_audio').is(':checked')){
                    $("#udt_oferta_audio_file").replaceWith($("#udt_oferta_audio_file").clone());
                    $("#udt_oferta_audio_file").hide();
                }else{
                    $("#udt_oferta_audio_file").show();
                }
            });
            $("#udt_oferta_imagen_file").hide();
            $("#udt_oferta_audio_file").hide();
        });
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
      <div style="float:right; margin-right:10px" align="right"></div>
      <h1><a href='empresas_news.php'>Newsletters</a> &raquo; Mensajes</h1>
      
      <div style="margin:10px; padding:10px; background-color:#FFC; border:1px dotted #999">Nota: para incluir el nombre del cliente agregue <strong>[nombre]</strong>   Ejemplo: Hola [nombre], Bienvenido a AHL... <br/>(**No aplica para ofertas diarias)</div>
      <span style="cursor:pointer;" onclick="ModificarWhatsApp()">[+] Configuraci&oacute;n WhatsApp</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor:pointer;" onclick="enviarWhatsApp()">[+] Enviar WhatsApp</span><br/><br/>
      <form id="OfertasDiarias" enctype="multipart/form-data" name="OfertasDiarias" method="post" action="#SELF">
          <strong>Ofertas diarias </strong>(Ser&aacute;n enviadas por Whatsapp):<br/>
          <table width="100%" border="0" cellspacing="4" cellpadding="4">
          <tr>
            <td width="9%">Texto Ofertas: </td>
            <td><textarea style="width:98%" rows="7" name="Texto" id="Texto"  ><? echo $Text; ?></textarea><br>
                    <input type="checkbox" <? echo $ofer_img=="0"?"":"checked='checked'"; ?> name='ofer_imagen' value="1"/>Imagen JPG&nbsp;&nbsp;&nbsp;<input type="checkbox" <? echo $ofer_aud=="0"?"":"checked='checked'"; ?> name='ofer_audio' value="1"/>Audio&nbsp;&nbsp;&nbsp;<input type="checkbox" <? echo $ofer_txt=="0"?"":"checked='checked'"; ?> name='ofer_texto' value="1"/>Texto&nbsp;&nbsp;&nbsp;<br/><br/>
                        <div>**S&oacute;lo se aceptan im&aacute;genes JPG y Audio MP3. (Max. 1mb cada uno)</div><br/>
                        <div style="width:100%">
                            <div style="width:50%;float:left">
                                <div style="width:30%;float:left">
                                    <img style="max-width:100%" src="<? echo (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $prefijo."/js/ofertadiaria/imagen.jpg"; ?>"/>
                                </div>
                                <div style="width:70%;float:left">
                                    <input type="checkbox" id="udt_oferta_imagen" value="0"/>Imagen de oferta diaria<br/><br/>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                    <input name="ofer_imagen_file" id="udt_oferta_imagen_file" type="file"/>
                                </div>
                            </div>
                            <div style="width:50%;float:left">
                                <div style="width:30%;float:left">
                                    <a href="<? echo (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $prefijo."/js/ofertadiaria/audio.mp3"; ?>" target="_blank">DESCARGAR AUDIO</a>
                                </div>
                                <div style="width:70%;float:left">
                                    <input type="checkbox" id="udt_oferta_audio" value="0"/>Audio de oferta diaria<br/>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                    <input name="ofer_audio_file" id="udt_oferta_audio_file" type="file"/>
                                </div>
                            </div>
                        </div>
                 <input type='hidden' name='UpdateConf' value='S'></input>
                 <input type='hidden' name='UpdateType' value='2'></input>
            </td>
          </tr>
          <tr>
              <td height="40" colspan="2" align="center">
                  <input style="margin:7px; padding:7px;" type="submit" name="actualizar_w" id="actualizar_w" value="Actualizar Ofertas" />
              </td>
          </tr>
          </table>
      </form>
      <form id="form1" name="form1" method="post" action="">
        <strong>Mensaje de Bienvenida Whatsapp</strong><br />
        <br />         
        <table width="100%" border="0" cellspacing="4" cellpadding="4">
          <tr>
            <td>Mensaje: </td>
            <td td width="91%"><textarea name="bienvenida_mensaje_whats" rows="7" id="bienvenida_mensaje_whats" style="width:98%"><? echo $ahlparametros["em_whtsppbnvnd"]["descripcion"]; ?></textarea></td>
          </tr>
        </table>
        <strong>Mensaje de Bienvenida</strong><br />
        <br />
        <? $busco=mysql_query("select * from mensaje where clase='bienvenida'");
	  	 $saco=mysql_fetch_array($busco); ?>
         
        <table width="100%" border="0" cellspacing="4" cellpadding="4">
          <tr>
            <td width="9%">Asunto: </td>
            <td><input style="width:98%" type="text" name="bienvenida_asunto" id="bienvenida_asunto" value="<? echo $saco[asunto]; ?>" /></td>
          </tr>
          <tr>
            <td>Mensaje: </td>
            <td><textarea name="bienvenida_mensaje" rows="7" id="bienvenida_mensaje" style="width:98%"><? echo $saco[mensaje]; ?></textarea></td>
          </tr>
        </table>
        <br />
        <br />
        <strong>Mensaje de Solicitud de información</strong><br />
        <br />
        <? $busco=mysql_query("select * from mensaje where clase='solicitud'");
	  	 $saco=mysql_fetch_array($busco); ?>
        <table width="100%" border="0" cellspacing="4" cellpadding="4">
          <tr>
            <td width="9%">Asunto: </td>
            <td><input style="width:98%" type="text" name="solicitud_asunto" id="olicitud_asunto" value="<? echo $saco[asunto]; ?>" /></td>
          </tr>
          <tr>
            <td>Mensaje: </td>
            <td><textarea name="solicitud_mensaje" rows="7" id="solicitud_mensaje" style="width:98%"><? echo $saco[mensaje]; ?></textarea></td>
          </tr>
          <tr>
            <td height="40" colspan="2" align="center"><input style="margin:7px; padding:7px;" type="submit" name="actualizar" id="actualizar" value="Actualizar mensajes" /></td>
          </tr>
        </table>
      </form>
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
