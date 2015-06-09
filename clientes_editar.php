<? include("logadmin.php"); 
	
if ($logadmin) { 

if ($enviar_mail_bienvenida) {
											$busco_cliente=mysql_query("select * from clientes where id_clientes='$id'"); 
											$saco_cliente=mysql_fetch_array($busco_cliente);
	
											$busco=mysql_query("select * from mensaje where clase='bienvenida'");
											$saco=mysql_fetch_array($busco);
											
											$busco_cliente=mysql_query("select * from clientes where id_clientes='$id'"); 
											$saco_cliente=mysql_fetch_array($busco_cliente);
											
											$mensaje=nl2br($saco[mensaje]);
											$mensaje=str_replace('[nombre]',"<strong>$saco_cliente[apellido] $saco_cliente[nombre]</strong>",$mensaje);
												
											$intro="<div style='width:600px'>
													<div align='center'><img src='http://sat.ahlinformatica.com/images/LOGO-AHL.png'></div><br>";
													
											$pie="<br><br><img src='http://sat.ahlinformatica.com/images/AHL-PIE.png'><hr>Este mensaje y los ficheros anexos son confidenciales. Los mismos contienen información reservada que no puede ser difundida. Si usted ha recibido este correo por error, tenga la amabilidad de eliminarlo de su sistema y avisar al remitente mediante reenvío a su dirección electrónica; no debe copiar el mensaje ni divulgar su contenido a ninguna persona.
Su dirección de correo electrónico, junto con sus datos personales, constan en un fichero titularidad de LANZACOMPUTER S.L.. cuya finalidad es la de mantener el contacto con usted y hacerles llegar las propuestas de servicios o productos. Si quiere saber de qué información acerca de usted disponemos, modificarla, y, en su caso, cancelarla, puede hacerlo enviando un escrito al efecto, acompañado de una fotocopia de su DNI a la siguiente dirección: LANZACOMPUTER , S.L., calle Puerto Rico, 50, 35500 de Arrecife de Lanzarote. Asimismo, se le advierte que toda la información personal contenida en este mensaje se encuentra protegida por la Ley 15/1999, de 13 de Diciembre, de protección de datos de carácter personal, quedando totalmente prohibido su uso y/o tratamiento, así como la cesión de aquella a terceros al margen de lo dispuesto en la citada ley protectora de datos personales y de su normativa de desarrollo. Conforme al Código Penal será castigado el que, para descubrir los secretos o vulnerar la intimidad de otro, sin su consentimiento, se apodere de faxes o cartas. También incurre en delito aquel que descubriere, revelare o cediere datos reservados de personas jurídicas, sin el consentimiento de sus representantes. Asimismo es su responsabilidad comprobar que este mensaje o sus archivos adjuntos no contengan virus informático. 
Para dejar de recibir nuestra publicidad, es suficiente con indicarlo a cualquiera de nuestros comerciales o enviando un e-mail a: soporte@ahlinformatica.com asunto baja.</div>";		 
											 
											 $mensaje=$intro.$mensaje.$pie;
											 
											  require_once 'class.phpmailer.php';
											  													
											  $mail = new PHPMailer ();
											  $mail -> From = "info@ahlinformatica.com";
											  $mail -> FromName = "AHL Informatica";
											  $mail -> AddAddress("$saco_cliente[email1]");
											  $mail->CharSet = "utf-8";
											  $mail -> Subject = "$saco[asunto]";
											  $mail -> Body = $mensaje;
											  $mail -> IsHTML (true);
											  $mail->Host = "mail.ahlinformatica.com";
											  $mail->AddReplyTo("info@ahlinformatica.com", "info@ahlinformatica.com");
											  $mail->Timeout=30;
											  //$mail->AddEmbeddedImage($elarchivo);
											  $mail->Send();
											  
											 										 
											 if ($actualizo=mysql_query("update clientes set mail_bienvenida='si' where id_clientes='$id'")) { } else {  }  
								?><script>location.href='clientes_editar.php?id=<? echo $id; ?>&cls=1'</script><? 
								}


if ($enviar_mail_solicitud) {				
											$busco_cliente=mysql_query("select * from clientes where id_clientes='$id'"); 
											$saco_cliente=mysql_fetch_array($busco_cliente);
											
											$busco=mysql_query("select * from mensaje where clase='solicitud'");
											$saco=mysql_fetch_array($busco);
											
											$busco_cliente=mysql_query("select * from clientes where id_clientes='$id'"); 
											$saco_cliente=mysql_fetch_array($busco_cliente);
											
											$mensaje=nl2br($saco[mensaje]);
											$mensaje=str_replace('[nombre]',"<strong>$saco_cliente[apellido] $saco_cliente[nombre]</strong>",$mensaje);
											
											$mensaje=str_replace('[nombre]',"<strong>$saco_cliente[apellido] $saco_cliente[nombre]</strong>",$mensaje);
												
											$intro="<div style='width:600px'>
													<div align='center'><img src='http://sat.ahlinformatica.com/images/LOGO-AHL.png'></div><br>";
													
											$pie="<br><br><img src='http://sat.ahlinformatica.com/images/AHL-PIE.png'><hr>Este mensaje y los ficheros anexos son confidenciales. Los mismos contienen información reservada que no puede ser difundida. Si usted ha recibido este correo por error, tenga la amabilidad de eliminarlo de su sistema y avisar al remitente mediante reenvío a su dirección electrónica; no debe copiar el mensaje ni divulgar su contenido a ninguna persona.
Su dirección de correo electrónico, junto con sus datos personales, constan en un fichero titularidad de LANZACOMPUTER S.L.. cuya finalidad es la de mantener el contacto con usted y hacerles llegar las propuestas de servicios o productos. Si quiere saber de qué información acerca de usted disponemos, modificarla, y, en su caso, cancelarla, puede hacerlo enviando un escrito al efecto, acompañado de una fotocopia de su DNI a la siguiente dirección: LANZACOMPUTER , S.L., calle Puerto Rico, 50, 35500 de Arrecife de Lanzarote. Asimismo, se le advierte que toda la información personal contenida en este mensaje se encuentra protegida por la Ley 15/1999, de 13 de Diciembre, de protección de datos de carácter personal, quedando totalmente prohibido su uso y/o tratamiento, así como la cesión de aquella a terceros al margen de lo dispuesto en la citada ley protectora de datos personales y de su normativa de desarrollo. Conforme al Código Penal será castigado el que, para descubrir los secretos o vulnerar la intimidad de otro, sin su consentimiento, se apodere de faxes o cartas. También incurre en delito aquel que descubriere, revelare o cediere datos reservados de personas jurídicas, sin el consentimiento de sus representantes. Asimismo es su responsabilidad comprobar que este mensaje o sus archivos adjuntos no contengan virus informático. 
Para dejar de recibir nuestra publicidad, es suficiente con indicarlo a cualquiera de nuestros comerciales o enviando un e-mail a: soporte@ahlinformatica.com asunto baja.</div>";		 
											 
											 $mensaje=$intro.$mensaje.$pie;
											 			 
											  require_once 'class.phpmailer.php';
											  													
											  $mail = new PHPMailer ();
											  $mail -> From = "info@ahlinformatica.com";
											  $mail -> FromName = "AHL Informatica";
											  $mail -> AddAddress("$saco_cliente[email1]");
											  $mail->CharSet = "utf-8";
											  $mail -> Subject = "$saco[asunto]";
											  $mail -> Body = $mensaje;
											  $mail -> IsHTML (true);
											  $mail->Host = "mail.ahlinformatica.com";
											  $mail->AddReplyTo("info@ahlinformatica.com", "info@ahlinformatica.com");
											  $mail->Timeout=30;
											  //$mail->AddEmbeddedImage($elarchivo);
											  $mail->Send();
											  
											 										 
											 $actualizo=mysql_query("update clientes set mail_solicitud='si' where id_clientes='$id'"); 
								?><script>location.href='clientes_editar.php?id=<? echo $id; ?>'</script><? 
								}
 
if ($agregar) {
				$ingreso=mysql_query("update clientes set nombre='$nombre', apellido='$apellido', email1='$email1', email2='$email2', direccion='$direccion', cp='$cp', telefono='$telefono', movil1='$movil1', movil2='$movil2', extras='$extras', dni='$dni', news='$news' where id_clientes='$id'"); 
				?><script>location.href='clientes.php?ssid=<? echo rand(111111,999999); ?>'</script><? }
 
 
 
 
 if ($enviar_mensaje) {	$busco_cliente=mysql_query("select * from clientes where id_clientes='$id'"); 
						$saco_cliente=mysql_fetch_array($busco_cliente);
							$fecha = time ();
							$fecha=$fecha-8100;
							$ano=date ( "Y" , $fecha );
							$mes=date ( "m" , $fecha );
							$dia=date ( "d" , $fecha );
							$hora=date ( "H" , $fecha ); 
							$minuto=date ( "i" , $fecha );
							$fechadehoy="$ano-$mes-$dia $hora:$minuto:$segundo";
						
						$intro="<div style='width:600px'>
													<div align='center'><img src='http://sat.ahlinformatica.com/images/LOGO-AHL.png'></div><br>";
													
											$pie="<br><br><img src='http://sat.ahlinformatica.com/images/AHL-PIE.png'><hr>Este mensaje y los ficheros anexos son confidenciales. Los mismos contienen información reservada que no puede ser difundida. Si usted ha recibido este correo por error, tenga la amabilidad de eliminarlo de su sistema y avisar al remitente mediante reenvío a su dirección electrónica; no debe copiar el mensaje ni divulgar su contenido a ninguna persona.
Su dirección de correo electrónico, junto con sus datos personales, constan en un fichero titularidad de LANZACOMPUTER S.L.. cuya finalidad es la de mantener el contacto con usted y hacerles llegar las propuestas de servicios o productos. Si quiere saber de qué información acerca de usted disponemos, modificarla, y, en su caso, cancelarla, puede hacerlo enviando un escrito al efecto, acompañado de una fotocopia de su DNI a la siguiente dirección: LANZACOMPUTER , S.L., calle Puerto Rico, 50, 35500 de Arrecife de Lanzarote. Asimismo, se le advierte que toda la información personal contenida en este mensaje se encuentra protegida por la Ley 15/1999, de 13 de Diciembre, de protección de datos de carácter personal, quedando totalmente prohibido su uso y/o tratamiento, así como la cesión de aquella a terceros al margen de lo dispuesto en la citada ley protectora de datos personales y de su normativa de desarrollo. Conforme al Código Penal será castigado el que, para descubrir los secretos o vulnerar la intimidad de otro, sin su consentimiento, se apodere de faxes o cartas. También incurre en delito aquel que descubriere, revelare o cediere datos reservados de personas jurídicas, sin el consentimiento de sus representantes. Asimismo es su responsabilidad comprobar que este mensaje o sus archivos adjuntos no contengan virus informático. 
Para dejar de recibir nuestra publicidad, es suficiente con indicarlo a cualquiera de nuestros comerciales o enviando un e-mail a: soporte@ahlinformatica.com asunto baja.</div>";		 
											 
											$mensaje=$intro.$mensaje_enviar.$pie;
											 	 
											  require_once 'class.phpmailer.php';
											  													
											  $mail = new PHPMailer ();
											  $mail -> From = "info@ahlinformatica.com";
											  $mail -> FromName = "AHL Informatica";
											  $mail -> AddAddress("$saco_cliente[email1]");
											  $mail->CharSet = "utf-8";
											  $mail -> Subject = $asunto_enviar;
											  $mail -> Body = $mensaje;
											  $mail -> IsHTML (true);
											  $mail->Host = "mail.ahlinformatica.com";
											  $mail->AddReplyTo("info@ahlinformatica.com", "info@ahlinformatica.com");
											  $mail->Timeout=30;
											  //$mail->AddEmbeddedImage($elarchivo);
											  $mail->Send();
											  
								$guardo=mysql_query("insert into cliente_mensaje (empresa,  fecha, sucursal, asunto, mensaje, veces) values ('$id','$fechadehoy','$sucursal','$asunto_enviar','$mensaje_enviar','1')");
						
						?><script>location.href='clientes_editar.php?id=<? echo $id; ?>&cls=1'</script><?
						}  
 
if ($volver_a_enviar) { $busco_mensaje=mysql_query("select * from cliente_mensaje where id_cliente_mensaje='$id_mensaje'");
							$saco_mensaje=mysql_fetch_array($busco_mensaje);
							
							$asunto_enviar=$saco_mensaje[asunto]; 
							$mensaje_enviar=$saco_mensaje[mensaje];
							$veces=$saco_mensaje[veces]+1;
							  
						$busco_cliente=mysql_query("select * from clientes where id_clientes='$id'"); 
						$saco_cliente=mysql_fetch_array($busco_cliente);
							$fecha = time ();
							$fecha=$fecha-8100;
							$ano=date ( "Y" , $fecha );
							$mes=date ( "m" , $fecha );
							$dia=date ( "d" , $fecha );
							$hora=date ( "H" , $fecha ); 
							$minuto=date ( "i" , $fecha );
							$fechadehoy="$ano-$mes-$dia $hora:$minuto:$segundo";
						
						$intro="<div style='width:600px'>
													<div align='center'><img src='http://sat.ahlinformatica.com/images/LOGO-AHL.png'></div><br>";
													
											$pie="<br><br><img src='http://sat.ahlinformatica.com/images/AHL-PIE.png'></div>";		 
											 
											$mensaje=$intro.$mensaje_enviar.$pie;
											 	 
											  require_once 'class.phpmailer.php';
											  													
											  $mail = new PHPMailer ();
											  $mail -> From = "info@ahlinformatica.com";
											  $mail -> FromName = "AHL Informatica";
											  $mail -> AddAddress("$saco_cliente[email1]");
											  $mail->CharSet = "utf-8";
											  $mail -> Subject = $asunto_enviar;
											  $mail -> Body = $mensaje;
											  $mail -> IsHTML (true);
											  $mail->Host = "mail.ahlinformatica.com";
											  $mail->AddReplyTo("info@ahlinformatica.com", "info@ahlinformatica.com");
											  $mail->Timeout=30;
											  //$mail->AddEmbeddedImage($elarchivo);
											  $mail->Send();
											  
								$actualizo=mysql_query("update cliente_mensaje set veces='$veces' where id_cliente_mensaje='$id_mensaje'");
						
						?><script>location.href='clientes_editar.php?id=<? echo $id; ?>&cls=1'</script><?
						
						
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
function volver_a_enviar(presu) { 
									if (confirm('Esta seguro que desea volver a enviar el presupuesto ?')) { location.href='clientes_nuevo_presupuesto.php?id=<? echo $id; ?>&id_presupuesto='+presu+'&enviar=92346124'; } 
									}
									
function volver_a_enviar_mensaje(mensaje) { 
									if (confirm('Esta seguro que desea volver a enviar el mensaje ?')) { location.href='clientes_editar.php?id=<? echo $id; ?>&id_mensaje='+mensaje+'&volver_a_enviar=true'; } 
									}
</script>

<style type="text/css">
<!--
.style1 {color: #EEEEEE}
-->
</style>
</head>

<body onLoad="habilitar_enviar();">
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
      <h1>Clientes &raquo; Editar</h1>
      
      <div id="agregarcliente" style="margin:20px; padding:10px; border:1px solid #BBBBBB; width:620px; background-color:#E5E5E5">
      <? 
	  $busco=mysql_query("select * from clientes where id_clientes='$id'"); 
	$saco=mysql_fetch_array($busco);
		?>
        <form id="form1" name="form1" method="post" action="#SELF">
          <table width="600" border="0" cellspacing="3" cellpadding="0">
            
            <tr>
              <td width="128">Nombres</td>
              <td width="461"><input name="nombre" type="text" id="nombre" style="width:98%" value="<? echo $saco[nombre]; ?>" onChange="habilitar_enviar();"  /></td>
            </tr>
            <tr>
              <td>Apellidos</td>
              <td><input style="width:98%" type="text" name="apellido" id="apellido"  value="<? echo $saco[apellido]; ?>" onChange="habilitar_enviar();"  /></td>
            </tr>
            <tr>
              <td>DNI</td>
              <td><input style="width:98%" type="text" name="dni" id="dni"  value="<? echo $saco[dni]; ?>" onChange="habilitar_enviar();"  /></td>
            </tr>
            <tr>
              <td>Dirección</td>
              <td><input style="width:98%" type="text" name="direccion" id="direccion"  value="<? echo $saco[direccion]; ?>" /></td>
            </tr>
            <tr>
              <td>C.P.</td>
              <td><input style="width:98%" type="text" name="cp" id="cp"  value="<? echo $saco[cp]; ?>" /></td>
            </tr>
            <tr>
              <td>E-mail 1</td>
              <td><input style="width:98%" type="text" name="email1" id="email1" value="<? echo $saco[email1]; ?>"  /></td>
            </tr>
            <tr>
              <td>E-mail 2</td>
              <td><input style="width:98%" type="text" name="email2" id="email2"  value="<? echo $saco[email2]; ?>" /></td>
            </tr>
            <tr>
              <td>Teléfono</td>
              <td><input style="width:98%" type="text" name="telefono" id="telefono"  value="<? echo $saco[telefono]; ?>" /></td>
            </tr>
            <tr>
              <td>Movil 1</td>
              <td><input style="width:98%" type="text" name="movil1" id="movil1"  value="<? echo $saco[movil1]; ?>" /></td>
            </tr>
            <tr>
              <td>Movil 2</td>
              <td><input style="width:98%" type="text" name="movil2" id="movil2"  value="<? echo $saco[movil2]; ?>" /></td>
            </tr>
            <tr>
              <td>Comentarios</td>
              <td><textarea name="extras" rows="5" id="extras" style="width:98%"><? echo $saco[extras]; ?></textarea></td>
            </tr>
            <tr>
              <td>                Bienvenida</td>
              <td height="25" valign="middle"><? if ($saco[mail_bienvenida]=="si") { echo "Enviado"; ?> <a href='clientes_editar.php?id=<? echo $id; ?>&enviar_mail_bienvenida=true'>Reenviar</a><?  } else { ?><a href='clientes_editar.php?id=<? echo $id; ?>&enviar_mail_bienvenida=true'>Enviar E-mail de Bienvenida</a><? } ?></td>
            </tr>
            <tr>
              <td nowrap="nowrap">E-mail tintas</td>
              <td height="25" valign="middle"><? if ($saco[mail_solicitud]=="si") { echo "Enviado"; ?> <a href='clientes_editar.php?id=<? echo $id; ?>&enviar_mail_solicitud=true'>Reenviar</a><?  } else { ?>
                <a href='clientes_editar.php?id=<? echo $id; ?>&enviar_mail_solicitud=true'>Enviar e-mail de solicitud de información</a>
                <? } ?></td>
            </tr>
            <tr>
              <td>Newsletter</td>
              <td valign="middle"><input name="news" type="checkbox" id="news" value="si" <? if ($saco[news]=="si") { ?>checked="checked"<? } ?> />
                <label for="news"></label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td valign="middle"><input type="submit" name="agregar" id="agregar" value="  Actualizar  " /> 
                <a href="clientes.php" >Cancelar</a></td>
            </tr>
          </table>
          </form>
        
        </div>
      <br />
      <span class="titulo">Historial de reparaciones</span><br />
      <br />
<table width="90%" style="border:1px solid #999">
          <tr >
            <td width="170" style="border-bottom:1px solid #999"><strong>Fecha</strong></td>
            <td style="border-bottom:1px solid #999"><strong>Tipo</strong></td>
            <td width="100" style="border-bottom:1px solid #999"><strong>Total</strong></td>
          </tr>
          <? 
		    if ($sucursal=="Arrecife") { $tabla_facturas="facturas_arrecife"; }
		    if ($sucursal=="Tias") { $tabla_facturas="facturas_tias"; }
		    if ($sucursal=="Centro") { $tabla_facturas="facturas_centro"; } 

			$estilo="style='border-bottom:1px dotted #999'";
			$busco=mysql_query("select * from $tabla_facturas where cliente='$id'"); 
			while ($saco=mysql_fetch_array($busco)) {   
					if ($saco[tipo]=="rm") { $clase="Reparación de Movil"; $link="repmoviles_editar.php?id=$saco[caso]"; }
					if ($saco[tipo]=="rp") { $clase="Reparación de PC/Portatil"; $link="computadoras_editar.php?id=$saco[caso]"; }
					if ($saco[tipo]=="rc") { $clase="Reparación de Consola"; $link="consolas_editar.php?id=$saco[caso]"; }
					if ($saco[tipo]=="lm") { $clase="Liberación de Movil"; $link="libmoviles_editar.php?id=$saco[caso]"; }
					if ($saco[tipo]=="" and $saco[venta]=="si") { $clase="Venta"; $link="facturas_detalle.php?id=$saco[0]"; }
			?>
          <tr style="cursor:pointer" onClick="location.href='<? echo $link; ?>'">
            <td <? echo $estilo; ?>><? echo substr($saco[fecha],0,16); ?> hs.</td>
            <td <? echo $estilo; ?>><? echo $clase;	 ?></td>
            <td <? echo $estilo; ?>><? echo $saco[total]; ?></td>
          </tr>
          <? } ?>
        </table>
    
    
    
        <div style="margin-top:30px">
      	<span class="titulo">Presupuestos</span>
      	<div style="margin:8px"> <? $bp=mysql_query("select * from clientes_presupuesto where sucursal='$sucursal' and empresa='$id' and enviado!='si'"); if (!$sp=mysql_fetch_array($bp)) {  ?>[+] <a href="clientes_nuevo_presupuesto.php?id=<? echo $id; ?>&class=new">Nuevo presupuesto</a><? } else { ?>&raquo; <a href='clientes_nuevo_presupuesto.php?id=<? echo $id; ?>&id_presupuesto=<? echo $sp[0]; ?>'>Continuar presupuesto</a><? } ?></div> 
        <div style=" display:<? echo "none"; ?>; margin:10px; background-color:#FFC;"></div>
        
        <? $bp=mysql_query("select * from clientes_presupuesto where sucursal='$sucursal' and empresa='$id' and enviado='si' order by id_clientes_presupuesto desc");
			$cnt=mysql_num_rows($bp);
			if ($cnt>0) { ?>
			
        <a name="presupuestos" id="presupuestos"></a>
        <table width="100%" border="0" cellspacing="4" cellpadding="4">
          <tr>
            <td width="17%" align="center" bgcolor="#D6D6D6"><strong>Fecha</strong></td>
            <td align="center" bgcolor="#D6D6D6"><strong>Comentarios</strong></td>
            <td width="100" align="center" bgcolor="#D6D6D6">Enviado</td>
            <td width="100" align="center" bgcolor="#D6D6D6">&nbsp;</td>
            <td width="48" align="center" bgcolor="#D6D6D6">&nbsp;</td>
            <td width="48" align="center" bgcolor="#D6D6D6">&nbsp;</td>
            <? while ($sp=mysql_fetch_array($bp)) { ?> </tr>
          <tr>
            <td><a href='clientes_presupuesto_ver.php?id=<? echo $id; ?>&id_presupuesto=<? echo $sp[0]; ?>'><? echo substr($sp[fecha],0,16)." hs."; ?></a></td>
            <td><a href='clientes_presupuesto_ver.php?id=<? echo $id; ?>&id_presupuesto=<? echo $sp[0]; ?>'><? echo $sp[comentario]; ?></a></td>
            <td align="center"><? if ($sp[veces]>1) { echo $sp[veces]." Veces"; } else { echo "1 vez"; }?></td>
            <td align="center"><a href='Javascript:void(0)' onClick="return volver_a_enviar('<? echo $sp[0]; ?>');">Volver a enviar</a></td>
            <td align="center"><a href="clientes_reutilizar.php?id=<? echo $id; ?>&id_presupuesto=<? echo $sp[0]; ?>">Reutilizar</a></td>
            <td align="center"><a href="clientes_presupuesto_imprimir.php?id=<? echo $id; ?>&id_presupuesto=<? echo $sp[0]; ?>">Imprimir</a></td>
            </tr>
          <? } ?>
        </table>
        <?  } ?>
        
      </div>
    
    
    
    
    <div style="margin-top:30px">
      	<span class="titulo">Mensajes</span>
      	<div style="margin:8px"> [+] <a href="Javascript:void(0);" onclick="mostrar('nuevo_mensaje');">Nuevo mensaje</a></div> 
        <div id="nuevo_mensaje" style=" display:<? echo "none"; ?>; margin:10px; background-color:#FFC;">
          <form id="form2" name="form2" method="post" action="">
            <table width="100%" border="0" cellspacing="4" cellpadding="4">
              <tr>
                <td width="9%">Asunto: </td>
                <td width="91%"><input style="width:98%" type="text" name="asunto_enviar" id="asunto_enviar" /></td>
              </tr>
              <tr>
                <td>Mensaje: </td>
                <td><textarea name="mensaje_enviar" rows="5" id="mensaje_enviar" style="width:98%"><? echo $saco[tinta]; ?></textarea></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="enviar_mensaje" id="enviar_mensaje" value="  Enviar  " />
                  <a href="Javascript:void(0);" onclick="ocultar('nuevo_mensaje');" >Cancelar</a></td>
              </tr>
            </table>
          </form>
        </div>
        
        <? $bp=mysql_query("select * from cliente_mensaje where sucursal='$sucursal' and empresa='$id' order by id_cliente_mensaje desc");
			$cnt=mysql_num_rows($bp);
			if ($cnt>0) { ?>
			
        <a name="mensajes" id="mensajes"></a>
        <table width="100%" border="0" cellspacing="4" cellpadding="4">
          <tr>
            <td width="17%" align="center" bgcolor="#D6D6D6"><strong>Fecha</strong></td>
            <td align="center" bgcolor="#D6D6D6"><strong>Asunto</strong></td>
            <td width="100" align="center" bgcolor="#D6D6D6">Enviado</td>
            <td width="100" align="center" bgcolor="#D6D6D6">&nbsp;</td>
            <? while ($sp=mysql_fetch_array($bp)) { ?> </tr>
          <tr>
            <td><? echo substr($sp[fecha],0,16)." hs."; ?></td>
            <td><a href='Javascript:void(0);' onclick="mostrar('mensaje_<? echo $sp[0]; ?>');"><? echo $sp[asunto]; ?></a><div onclick="ocultar('mensaje_<? echo $sp[0]; ?>');" style=" cursor:pointer; border:1px dotted #666; margin:5px; padding:5px; background-color:#FFFFCC; display:<? echo "none"; ?>" id="mensaje_<? echo $sp[0]; ?>"><strong>Mensaje:</strong> <? echo $sp[mensaje]; ?></div></td>
            <td align="center"><? if ($sp[veces]>1) { echo $sp[veces]." Veces"; } else { echo "1 vez"; }?></td>
            <td align="center"><a href='Javascript:void(0)' onClick="return volver_a_enviar_mensaje('<? echo $sp[0]; ?>');">Volver a enviar</a></td>
            </tr>
          <? } ?>
        </table>
        <?  } ?>
        
        
      </div>
      
      
      </div>
      
      </td>
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
