<? include("logadmin.php"); 
	
if ($logadmin) { 

if ($sucursal=="Arrecife") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Tias") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Centro") { $tabla_empresas=" empresas_integradas "; } 

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

$busco=mysql_query("select * from news where id_news='$id'");
$saco=mysql_fetch_array($busco);
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
<script>
        $(document).ready(function(){
            $('#DataTabla').DataTable({
                "order": [[ 0, "desc" ]]
            });
        });
    </script>
<? include("funciones.php"); ?>
<script>
function confirmar_envio_news(id_empresa, nombre_empresa) {
												 if (confirm('Está seguro que desea enviar el Newsletter a '+nombre_empresa)) { location.href='empresas_news_enviar_simple.php?id=<? echo $id; ?>&id_empresa='+id_empresa; }
												}

</script>
</head>

<body >
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
      <h1>Newsletter</h1>
      <? if ($id_empresa=="") { ?>
      <br />Seleccionar empresa<br />
      <br />
      <table id="DataTabla" style="border:1px solid #E5E5E5" width="930" border="0" cellspacing="3" cellpadding="3">
          <thead>
          <tr >
          <th height="30" bgcolor="#DBDBDB">Nombre</th>
          <th width="200" height="30" align="center" bgcolor="#DBDBDB">E-mail</th>
          <th width="90" height="30" align="center" bgcolor="#DBDBDB">Tel 1</th>
          <th width="90" height="30" align="center" bgcolor="#DBDBDB">Tel 2</th>
          <th width="60" align="center" bgcolor="#DBDBDB">Activo</th>
          </tr>
          </thead>
          <tbody>
        <? 
		 $busco=mysql_query("select * from $tabla_empresas order by nombre"); 
		while ($saco=mysql_fetch_array($busco)) { 
		$link=" style='cursor:pointer; border-bottom:1px dotted #666;' onclick=\"confirmar_envio_news('$saco[0]','$saco[nombre]');\""; 
        if ($saco[desuscripto]=="si") { $fondo=" bgcolor='#FFFF99' "; } else { $fondo=""; } 
		?>
        <tr >
          <td <? echo $link; echo $fondo; ?>><? echo $saco[nombre]; ?></td>
          <td nowrap="nowrap" <? echo $link; echo $fondo; ?>><? echo $saco[email]; ?>&nbsp;</td>
          <td nowrap="nowrap" <? echo $link; echo $fondo; ?>><? echo $saco[tel1]; ?>&nbsp;</td>
          <td nowrap="nowrap" <? echo $link; echo $fondo; ?>><? echo $saco[tel2]; ?>&nbsp;</td>
          <td <? echo $fondo; ?> style="border-bottom:1px dotted #666;" align="center"><? if ($saco[activo]=="no") { ?><span style="color:#F00; font-weight:bold">NO</span><? } else { echo $saco[activo]; } ?></td>
          </tr>
        <? } ?>
      </tbody>
      </table>
      <? } else {
		  					$busco=mysql_query("select * from news_empresas where id_news='$id'");
							$saco=mysql_fetch_array($busco);
							$el_link=$saco[el_link];  
							$destinatarios_enviados=$saco[enviados];
							$elarchivo="news_empresas/$saco[archivo]";
							$b=mysql_query("select * from $tabla_empresas where id_empresa='$id_empresa'");
							$s=mysql_fetch_array($b);
							$destinatario=$s[email];
							
							$env=$destinatarios_enviados."|".$destinatario;
							
							$actualizo=mysql_query("update news_empresas set enviados='$env' where id_news='$id'");
							
							
							
							
							
							
							
							
			if ($el_link!="") { $el_nuevo_link="http://".$el_link; } else { $el_nuevo_link="http://sat.ahlinformatica.com/news_empresas/$saco[archivo]"; } 
			$link="http://sat.ahlinformatica.com/empresas_desuscribir.php?id=".rand(111111,999999)."&cls=".$codigo_desuscribir."&contacto=".rand(111111,999999)."&fecha=$s[0]&mail=".$destinatario;
			$msj="<div style='margin-bottom:15px' align='center'><a href='$el_nuevo_link'>Si no puedes ver correctamente este e-mail haz click aquí</a></div><img src='http://sat.ahlinformatica.com/$elarchivo'><br><br><hr>
			Este mensaje y los ficheros anexos son confidenciales. Los mismos contienen información reservada que no puede ser difundida. Si usted ha recibido este correo por error, tenga la amabilidad de eliminarlo de su sistema y avisar al remitente mediante reenvío a su dirección electrónica; no debe copiar el mensaje ni divulgar su contenido a ninguna persona.
Su dirección de correo electrónico, junto con sus datos personales, constan en un fichero titularidad de LANZACOMPUTER S.L.. cuya finalidad es la de mantener el contacto con usted y hacerles llegar las propuestas de servicios o productos. Si quiere saber de qué información acerca de usted disponemos, modificarla, y, en su caso, cancelarla, puede hacerlo enviando un escrito al efecto, acompañado de una fotocopia de su DNI a la siguiente dirección: LANZACOMPUTER , S.L., calle Puerto Rico, 50, 35500 de Arrecife de Lanzarote. Asimismo, se le advierte que toda la información personal contenida en este mensaje se encuentra protegida por la Ley 15/1999, de 13 de Diciembre, de protección de datos de carácter personal, quedando totalmente prohibido su uso y/o tratamiento, así como la cesión de aquella a terceros al margen de lo dispuesto en la citada ley protectora de datos personales y de su normativa de desarrollo. Conforme al Código Penal será castigado el que, para descubrir los secretos o vulnerar la intimidad de otro, sin su consentimiento, se apodere de faxes o cartas. También incurre en delito aquel que descubriere, revelare o cediere datos reservados de personas jurídicas, sin el consentimiento de sus representantes. Asimismo es su responsabilidad comprobar que este mensaje o sus archivos adjuntos no contengan virus informático.
<hr> <strong>Para dejar de recibir nuestra publicidad, es suficiente con hacer click en el siguiente link:</strong><br><a href='$link'>$link</a>";
			
												  
																			  
			
			require_once 'class.phpmailer.php';
																								
			  $mail = new PHPMailer ();
			  $mail -> From = "info@ahlinformatica.com";
			  $mail -> FromName = "Novedades - AHL Informatica";
			  $mail -> AddAddress("$destinatario");
			  $mail->CharSet = "utf-8";
			  $mail -> Subject = "$saco[asunto]";
			  $mail -> Body = $msj;
			  $mail -> IsHTML (true);
			  $mail->Host = "mail.ahlinformatica.com";
			  $mail->AddReplyTo("info@ahlinformatica.com", "info@ahlinformatica.com");
			  $mail->Timeout=30;
			  $mail->Send();
							
			?><div style="margin:10px; padding:10px; background-color:#FFFFCC; border: 1px dotted #999; text-align:center">El Newsletter se ha enviado a <strong><? echo $destinatario; ?></strong> <br /><br /><a href='empresas_news.php'>&laquo; Volver...</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='empresas_news_enviar_simple.php?id=<? echo $id; ?>'>&raquo; Enviar a otra empresa...</a></div><?				
		  		
				} ?>
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
