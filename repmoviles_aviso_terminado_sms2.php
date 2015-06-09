<? include("logadmin.php"); 
	
if ($logadmin) { 

  if ($sucursal=="Arrecife") { $tabla="repmovil_arrecife"; }
       			if ($sucursal=="Tias") { $tabla="repmovil_tias"; }
				if ($sucursal=="centro") { $tabla="repmovil_centro"; } 
				
				 $busco=mysql_query("select * from $tabla where id_repmovil='$id'");
				 $saco=mysql_fetch_array($busco);
				 
				 $b=mysql_query("select * from clientes where id_clientes='$saco[cliente]'");
				 $s=mysql_fetch_array($b);
				 
				$mensaje="Su reparación está terminada, puede retirar su equipo en la sucursal de AHL Informatica. Muchas gracias.";
				$mensaje=utf8_decode($mensaje);
				$asunto="Reparacion terminada";
				$headers = "MIME-Version: 1.0\r\n"; 
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
				$headers .= "From: AHL Informatica <info@ahlinformatica.com>\r\n";
														
				include_once('SendMessages.php');
				//$send = new SendMessages();
				$xid = 1;
				$txt = "2 Su reparacion esta terminada, puede retirar su equipo en la sucursal de AHL Informatica. Muchas gracias.";
				$dst = "+54".$s[movil2];
				//$send->sendOneSMS($xid, $txt, $dst); 
                                
                                EnviarWhats($s[movil1],$txt);
                                EnviarWhats($s[movil2],$txt);
				
				
				
				?><script>location.href='repmoviles_editar.php?id=<? echo $id; ?>&cs=3'</script><?
				
} else { ?><script>location.href='login.php'</script><? } ?>
