<?
$xml = file_get_contents("mailconf.xml");
    $DOM = new SimpleXMLElement($xml);
    $SMTPAuth = strval($DOM->MailConfs->MailConf[0]->SMTPAuth);
    $SMTPSecure = strval($DOM->MailConfs->MailConf[0]->SMTPSecure);
    $HOST = strval($DOM->MailConfs->MailConf[0]->HOST);
    $Port = strval($DOM->MailConfs->MailConf[0]->Port);
    $Username = strval($DOM->MailConfs->MailConf[0]->Username);
    $Password = strval($DOM->MailConfs->MailConf[0]->Password);
    $SetFrom = strval($DOM->MailConfs->MailConf[0]->SetFrom);
    $SetFromName= strval($DOM->MailConfs->MailConf[0]->SetFromName);
    $AddReplyTo = strval($DOM->MailConfs->MailConf[0]->AddReplyTo);
if (!ini_get('register_globals')) {   
    $superglobales = array($_SERVER, $_ENV,   
        $_FILES, $_COOKIE, $_POST, $_GET);   
    if (isset($_SESSION)) {   
        array_unshift($superglobales, $_SESSION);   
		}   
		foreach ($superglobales as $superglobal) {   
			extract($superglobal, EXTR_SKIP);   
		}   
	} 
	
	include("logadmin.php"); 
	
	if ($logadmin) { 

	  
									

	
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
	
	$busco=mysql_query("select * from news_empresas where id_news='$id'");
	$saco=mysql_fetch_array($busco);
	$destinatarios_enviados=$saco[enviados_clientes];
	$el_link=$saco[el_link];  
	
	$encontrado=0; 
	$b=mysql_query("select * from clientes where email1!='' order by email1");
	while ($s=mysql_fetch_array($b) ) { 
	if ($encontrado=='0') {
						if (!strpos($destinatarios_enviados,$s[email1]) and $s[email1]!="") 
										{ $encontrado=1; 
										  $destinatario=$s[email1];
										  $codigo_desuscribir=$s[codigo];
										  $env=$destinatarios_enviados."|".$destinatario;
										  $actualizo=mysql_query("update news_empresas set enviados_clientes='$env' where id_news='$id'");
										}
							}
	} 
	
if ($encontrado=="0") 
	{  
	$actualizo=mysql_query("update news_empresas  set completo_clientes='si', fecha='$lafechadehoy', enviado_clientes='si' where id_news='$id'");
	echo "Envío completo<br><br>"; ?><a href='empresas_news.php'>&laquo; Volver al inicio</a><? 
	} else { 
			//// Envio el news
		
			$elarchivo="news_empresas/$saco[archivo]";
			if ($el_link!="") { $el_nuevo_link="http://".$el_link; } else { $el_nuevo_link="http://sat.ahlinformatica.com/news_empresas/$saco[archivo]"; } 
			$link="http://sat.ahlinformatica.com/empresas_desuscribir.php?id=".rand(111111,999999)."&cls=".$codigo_desuscribir."&contacto=".rand(111111,999999)."&fecha=$s[0]&mail=".$destinatario;
			$msj="<div style='margin-bottom:15px' align='center'><a href='$el_nuevo_link'>Si no puedes ver correctamente este e-mail haz click aquí</a></div><img src='http://sat.ahlinformatica.com/$elarchivo'><br><br><hr>
			Este mensaje y los ficheros anexos son confidenciales. Los mismos contienen información reservada que no puede ser difundida. Si usted ha recibido este correo por error, tenga la amabilidad de eliminarlo de su sistema y avisar al remitente mediante reenvío a su dirección electrónica; no debe copiar el mensaje ni divulgar su contenido a ninguna persona.
Su dirección de correo electrónico, junto con sus datos personales, constan en un fichero titularidad de LANZACOMPUTER S.L.. cuya finalidad es la de mantener el contacto con usted y hacerles llegar las propuestas de servicios o productos. Si quiere saber de qué información acerca de usted disponemos, modificarla, y, en su caso, cancelarla, puede hacerlo enviando un escrito al efecto, acompañado de una fotocopia de su DNI a la siguiente dirección: LANZACOMPUTER , S.L., calle Puerto Rico, 50, 35500 de Arrecife de Lanzarote. Asimismo, se le advierte que toda la información personal contenida en este mensaje se encuentra protegida por la Ley 15/1999, de 13 de Diciembre, de protección de datos de carácter personal, quedando totalmente prohibido su uso y/o tratamiento, así como la cesión de aquella a terceros al margen de lo dispuesto en la citada ley protectora de datos personales y de su normativa de desarrollo. Conforme al Código Penal será castigado el que, para descubrir los secretos o vulnerar la intimidad de otro, sin su consentimiento, se apodere de faxes o cartas. También incurre en delito aquel que descubriere, revelare o cediere datos reservados de personas jurídicas, sin el consentimiento de sus representantes. Asimismo es su responsabilidad comprobar que este mensaje o sus archivos adjuntos no contengan virus informático.
<hr> <strong>Para dejar de recibir nuestra publicidad, es suficiente con hacer click en el siguiente link:</strong><br><a href='$link'>$link</a>";
			
			/*$msj="<img src='http://sat.ahlinformatica.com/imagen_newsletter.php?news=$id&file=$saco[archivo]&usr=$destinatario'><br><br><hr>
			Este mensaje y los ficheros anexos son confidenciales. Los mismos contienen información reservada que no puede ser difundida. Si usted ha recibido este correo por error, tenga la amabilidad de eliminarlo de su sistema y avisar al remitente mediante reenvío a su dirección electrónica; no debe copiar el mensaje ni divulgar su contenido a ninguna persona.
Su dirección de correo electrónico, junto con sus datos personales, constan en un fichero titularidad de LANZACOMPUTER S.L.. cuya finalidad es la de mantener el contacto con usted y hacerles llegar las propuestas de servicios o productos. Si quiere saber de qué información acerca de usted disponemos, modificarla, y, en su caso, cancelarla, puede hacerlo enviando un escrito al efecto, acompañado de una fotocopia de su DNI a la siguiente dirección: LANZACOMPUTER , S.L., calle Puerto Rico, 50, 35500 de Arrecife de Lanzarote. Asimismo, se le advierte que toda la información personal contenida en este mensaje se encuentra protegida por la Ley 15/1999, de 13 de Diciembre, de protección de datos de carácter personal, quedando totalmente prohibido su uso y/o tratamiento, así como la cesión de aquella a terceros al margen de lo dispuesto en la citada ley protectora de datos personales y de su normativa de desarrollo. Conforme al Código Penal será castigado el que, para descubrir los secretos o vulnerar la intimidad de otro, sin su consentimiento, se apodere de faxes o cartas. También incurre en delito aquel que descubriere, revelare o cediere datos reservados de personas jurídicas, sin el consentimiento de sus representantes. Asimismo es su responsabilidad comprobar que este mensaje o sus archivos adjuntos no contengan virus informático.
<hr> <strong>Para dejar de recibir nuestra publicidad, es suficiente con hacer click en el siguiente link:</strong><br><a href='$link'>$link</a>";
						*/													  
																			  
			echo "Enviando a: <strong>$destinatario</strong><br><br>";
			require_once 'class.phpmailer.php';
																								
			  $mail = new PHPMailer ();
			  $mail -> From = $SetFrom;
			  $mail -> FromName = $SetFromName;
                          $mail -> SMTPAuth = $SMTPAuth =='true'?true:false;
                          if($SMTPSecure!='none') {$mail -> SMTPSecure = $SMTPSecure;}
                          $mail -> Port = $Port;
                          $mail -> Username = $Username;
                          $mail -> Password = $Password;
			  $mail -> AddAddress("$destinatario");
			  $mail->CharSet = "utf-8";
			  $mail -> Subject = "$saco[asunto]";
			  $mail -> Body = $msj;
			  $mail -> IsHTML (true);
			  $mail->Host = $HOST;
			  $mail->AddReplyTo($AddReplyTo, $AddReplyTo);
			  $mail->Timeout=30;
			  //$mail->AddEmbeddedImage($elarchivo);
			  $mail->Send();
	
	
			}



	} ?><input type="hidden" id="nocache" name="nocache" value="<? echo rand(1111111,9999999); ?>">