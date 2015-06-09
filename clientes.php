<? include("logadmin.php"); 
	
if ($logadmin) { 

if ($agregar) {
				$ingreso=mysql_query("insert into clientes (nombre, apellido, email1, email2, direccion, cp, telefono, movil1, movil2, extras, dni, news) values ('$nombre', '$apellido', '$email1', '$email2', '$direccion', '$cp', '$telefono', '$movil1', '$movil2', '$extras', '$dni', '$news')"); 
                                EnviarWhats($movil1,$ahlparametros["em_whtsppbnvnd"]["descripcion"]);
                                EnviarWhats($movil2,$ahlparametros["em_whtsppbnvnd"]["descripcion"]);
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
<link href="js/basic.css" rel="stylesheet" type="text/css" />
<link href="estilos.css" rel="stylesheet" type="text/css" />
<script src="js/DataTables/js/jquery.js"></script>
<script src="js/jquery.simplemodal.1.4.4.min.js"></script>
<? include("funciones.php"); ?>
<script>
var mensajes="";
function confirmar_eliminar_cliente(id_cliente, nombre) {
												if (confirm('Está seguro que desea eliminar el cliente '+nombre+'?')) { location.href='clientes.php?eliminar=true&id_cliente='+id_cliente; } 
													
												}
function enviarWhatsApp(Nombre,Telf1,Telf2){
    mensaje="";
    $("<div><b>ENVIAR WHATSAPP: </b>"+Nombre+"<br>"+ 
        "<textarea style='width:380px' rows='5' name='UpdatePendiente' value='Texto' onchange=\"setMensaje(this.value)\"></textarea><br>"+
        "<button style='width:100px;padding:3px' onclick=\"send('"+Telf1+"','"+Telf2+"')\">Enviar</button>"+ 
        "</div>").modal({containerCss:{width:'420px',height:'150px'}});
}
function setMensaje(value){
    mensajes=value;
}
function send(Telf1,Telf2){
    $.post("SendWhats.php", { numero: Telf1,mensaje:mensajes } );
    $.post("SendWhats.php", { numero: Telf1,mensaje:mensajes } );
    alert("Mensaje enviado");
}
function JQueryAJAX (type,url,data,datatype,exito,error,auxiliar){
    //data.push({name: 'auxiliar', value: typeof auxiliar==='undefined'?'':auxiliar});
    $.ajax({
        type: type=="GET"?"GET":"POST",
        url: typeof url==='undefined' || url==''?'#':url,
        data: data,
        datatype:datatype
      })
        .done(function(msg){
            //alert(msg);
            if( datatype.toUpperCase()=="JSON"){
            var _msg;
            try { _msg=JSON.parse(msg);}
            catch (e) {
                //MANEJADOR PARA RESPUESTA CORRECTA PERO CON ERROR
                //alert("Error en JSON");
                return;
            }
            exito(_msg);
         }else{
             exito(msg);
         }        
         })
        .fail(function(XMLHttpRequest, textStatus, errorThrown) {
            alert('XMLHttpRequest.responseText: '+textStatus+errorThrown);
         });
}
function llamado(block){
    var auxiliar=0;
    JQueryAJAX("POST","OfertasDiariasSend.php",{'ofertas':0,'bloque':block},'JSON',
                                    function(e){/*EXITO*/
                                        $('#textoprogreso').text(e.avance+"%");
                                        if(e.avance!='100'){
                                            block=block+1;
                                            llamado2(block);
                                        }else{
                                            alert("Envio concluido");
                                        }
                                    },
                                    function(e){/*ERROR*/},
                                    auxiliar);
}
function llamado2(block){
    var auxiliar=0;
    JQueryAJAX("POST","OfertasDiariasSend.php",{'ofertas':0,'bloque':block},'JSON',
                                    function(e){/*EXITO*/
                                        $('#textoprogreso').text(e.avance+"%");
                                        if(e.avance!='100'){
                                            block=block+1;
                                            llamado(block);
                                        }else{
                                            alert("Envio concluido");
                                        }
                                    },
                                    function(e){/*ERROR*/},
                                    auxiliar);
}
function ResetEnvioOfertas(){
    $.post( "OfertasDiariasSend.php", { reset:"resetearenvio" } );
    location.reload();
}
function confirmar_enviar_cliente(id_cliente, nombre) {
                if(id_cliente!='0'){
                    if (confirm('Está seguro que desea enviar la oferta diaria al cliente '+nombre+'?')){
                        $("#img-"+id_cliente).attr("src","/images/02.png");
                        $.post( "OfertasDiariasSend.php", { ofertas: id_cliente } );
                    } 
                }
                if(id_cliente=='0'){
                    if (confirm('Está seguro que desea enviar la oferta diaria a todos los clientes registrados')){
                        //$.post( "OfertasDiariasSend.php", { ofertas: 0 } );
                        $("<div><b>ENV&Iacute;O DE OFERTAS</b><br>"+
                            "**Por favor no cierre la ventana hasta que el progreso sea del 100%<br>"+
                            "<br>"+
                            "<div style='margin:20px'>"+
                            "Se esta realizando el envio:<br>"+
                            "Progreso:<div id='textoprogreso' style='color:red;font-size: 25px;'>0%</div><br>"+
                            "</div>"+
                            "</div>").modal({containerCss:{width:'420px',height:'250px'}});
                            llamado(0);
                    } 
                }
    }
</script>
</head>

<body>
<style>
    tr>td:nth-child(2), tr>th:nth-child(2){
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
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
        <a href="#" onClick="mostrar('agregarcliente');">[+] Nuevo cliente</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="clientes_exportar.php">[+] Exportar</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="Javascript:void(0);" onclick="ResetEnvioOfertas();">[+] Reset envio de ofertas</a>&nbsp<br />
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
      <table id="clientes" style="border:1px solid #E5E5E5"  class="stripe" width="930" border="0" cellspacing="3" cellpadding="0">
        <thead>
            <tr>
              <th width="200" bgcolor="#DBDBDB">Nombre</th>
              <th width="75" height="30" align="center" bgcolor="#DBDBDB">E-mail</th>
              <? /*<th width="250" height="30" align="center" bgcolor="#DBDBDB">Dirección</th>*/ ?>
              <th width="40" height="30" align="center" bgcolor="#DBDBDB">Movil</th>
              <th width="20" align="center" bgcolor="#DBDBDB">Bienvenida</th>
              <th width="20" align="center" bgcolor="#DBDBDB">Solicitud</th>
              <th width="20" align="center" bgcolor="#DBDBDB">Oferta diaria</th>
              <th width="20" align="center" bgcolor="#DBDBDB">¿Oferta enviada?</th>
              <th width="20" align="center" bgcolor="#DBDBDB">Enviar WhatsApp</th>
              <th width="60" height="30" align="center" bgcolor="#DBDBDB">&nbsp;</th>
            </tr>
        </thead>
          <tbody>
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
          <td width="20" nowrap="nowrap" <? echo $link; ?>><? echo mb_strimwidth($saco[email1], 0, 25, "..."); ?>&nbsp;</td>
          <? /* <td <? echo $link; ?>><? echo $saco[direccion]; ?>&nbsp;</td>*/ ?>
          <td <? echo $link; ?>><? echo $saco[movil1]; ?>&nbsp;</td>
          <td width="20" <? echo $link; ?>><? echo $saco[mail_bienvenida]; ?></td>
          <td width="20" <? echo $link; ?>><? echo $saco[mail_solicitud]; ?></td>
          <td width="20" style="border-bottom:1px dotted #666;" ><? if($saco["whatsapp"]=='SI'){ ?><a href="Javascript:void(0);" onClick="confirmar_enviar_cliente('<? echo $saco[0];?>','<? echo $saco[apellido].' '.$saco[nombre];?>');">Enviar</a><?}else{ echo "---";}?></td>
          <td width="20" style="border-bottom:1px dotted #666;" ><div style="width:100%; text-align: center"><? if($saco["enviado"]=='0'){ ?><img id="img-<? echo $saco[0];?>" width="20px" height="20px" src="/images/01.png"/><?}else{?><img id="img-<? echo $saco[0];?>" width="20px" height="20px" src="/images/02.png"/><?}?></div></td>
          <td width="20" style="border-bottom:1px dotted #666;" ><div style="width:100%; text-align: center"><? if(true/*$saco["whatsapp"]=='SI'*/){ ?><img width="20px" style="cursor:pointer;" height="20px" onClick="enviarWhatsApp('<? echo $saco[apellido].' '.$saco[nombre];?>','<? echo $saco["movil1"];?>','<? echo $saco["movil2"];?>');" src="/images/whatsapp.png"/><?}?></div></td>
          <td style="border-bottom:1px dotted #666;" align="center"><a href="Javascript:void(0);" onClick="confirmar_eliminar_cliente('<? echo $saco[0]; ?>', '<? echo "$saco[apellido] $saco[nombre]"; ?>');">Eliminar</a></td>
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
