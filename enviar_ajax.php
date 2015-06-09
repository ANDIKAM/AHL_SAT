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
	
	$busco=mysql_query("select * from news where id_news='$id'");
	$saco=mysql_fetch_array($busco);
	
	$b=mysql_query("select * from clientes where news='si' order by id_clientes");
	$total=mysql_num_rows($b);
	$nuevoparcial=$saco[parcial]+1;
	$env=$saco[parcial]-1;
	$elarchivo="news/$saco[archivo]";
	
	if ($saco[parcial]>=$total) { $actualizo=mysql_query("update news set enviado='si', destinatarios='$env', fecha='$lafechadehoy' where id_news='$id'"); }
	
	if ($saco[enviado]=="no") { 
								
								$cant=-1;
								
								while ($s=mysql_fetch_array($b)) { $cant++; 
																	$link="http://sat.ahlinformatica.com/desuscribir.php?id=".rand(111111,999999)."&cls=".rand(111111,999999)."&contacto=".rand(111111,999999)."&fecha=$s[0]&ssid=".rand(111111,999999);
																	$msj="<img src='http://sat.ahlinformatica.com/$elarchivo'><br><br>Si no desea recibir e-mails de novedades de AHL informatica haga click en el siguiente link:<br><a href='$link'>$link</a>";
																  if ($saco[parcial]==$cant) {  echo "Enviando a: <strong>$s[email1]</strong><br><br>";
																  								require_once 'class.phpmailer.php';
																								$mail = new PHPMailer ();
																								$mail -> From = $SetFrom;
                                                                                                                                                                                                $mail -> SMTPAuth = $SMTPAuth =='true'?true:false;
                                                                                                                                                                                                if($SMTPSecure!='none') {$mail -> SMTPSecure = $SMTPSecure;}
                                                                                                                                                                                                $mail -> Port = $Port;
                                                                                                                                                                                                $mail -> Username = $Username;
                                                                                                                                                                                                $mail -> Password = $Password;
																								$mail -> FromName = $SetFromName;
																								$mail -> AddAddress("$s[email1]");
																								$mail -> Subject = "$saco[asunto]";
																								$mail -> Body = $msj;
																								$mail -> IsHTML (true);
																								$mail->Host = $HOST;
																								$mail->AddReplyTo($AddReplyTo, $AddReplyTo);
																								$mail->Timeout=30;
																								//$mail->AddEmbeddedImage($elarchivo);
																								$mail->Send();
																								
																								
																								
																								
																								}
																 
																 }
								echo "Total: <strong>$total</strong><br><br>Enviados: <strong>$saco[parcial]</strong>";
								$actualizo=mysql_query("update news set parcial='$nuevoparcial' where id_news='$id'");
								} else { echo "Envío completo<br><br>"; ?><a href='news.php'>&laquo; Volver al inicio</a><? }
	
	
	
	
	
	}



?><input type="hidden" id="nocache" name="nocache" value="<? echo rand(1111111,9999999); ?>">