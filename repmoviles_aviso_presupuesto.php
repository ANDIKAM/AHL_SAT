<? include("logadmin.php"); 
	
if ($logadmin) { 

if ($enviar) {   if ($sucursal=="Arrecife") { $tabla="repmovil_arrecife"; }
       			if ($sucursal=="Tias") { $tabla="repmovil_tias"; } 
				if ($sucursal=="Centro") { $tabla="repmovil_centro"; } 
				
				 $busco=mysql_query("select * from $tabla where id_repmovil='$id'");
				 $saco=mysql_fetch_array($busco);
				 
				 $b=mysql_query("select * from clientes where id_clientes='$saco[cliente]'");
				 $s=mysql_fetch_array($b);
				 
				$mensaje="El presupuesto de su reparación está terminado, para continuar la reparación debe aceptarlo desde la siguiente dirección: http://sat.ahlinformatica.com/presupuesto";
				$mensaje=utf8_decode($mensaje);
				$asunto="Presupuesto de reparacion";
				$headers = "MIME-Version: 1.0\r\n"; 
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
				$headers .= "From: AHL Informatica <info@ahlinformatica.com>\r\n";
				
				if ($s[email1]!="") { $elmail=$s[email1]; if (mail ($elmail,$asunto,$mensaje,$headers)){ } else {  }   }
				if ($s[email2]!="") { $elmail=$s[email2]; if (mail ($elmail,$asunto,$mensaje,$headers)){  } else {  }   }
				
				
				include_once('SendMessages.php');
				
				if ($s[movil1]!="") { 
										//$send = new SendMessages();
										$xid = 1;
										$txt = "El presupuesto de su reparacion esta terminado, puede verificarlo en http://sat.ahlinformatica.com/clientes";
                                                                                $cod="RM".($saco[tienda]=="Tias"?"T":($saco[tienda]=="Centro"?"C":($saco[tienda]=="Arrecife"?"A":""))).str_pad($saco[0], 5, "0", STR_PAD_LEFT);
                                                                                $txt2="El presupuesto de su reparación $cod está terminado, tiene un costo de €$saco[presupuesto], para continuar la reparación debe aceptarlo desde la siguiente dirección: http://sat.ahlinformatica.com/presupuesto";
										$dst = "+34".$s[movil1];
										//$send->sendOneSMS($xid, $txt, $dst); 
                                                                                
                                                                                EnviarWhats($s[movil1],$txt2);
                                                                                EnviarWhats($s[movil2],$txt2);
									} 
									
								
				
				$actualizo=mysql_query("update $tabla set sms='si' where id_repmovil='$id'");
				
				
				
				
				?><script>location.href='repmoviles_editar.php?id=<? echo $id; ?>'</script><?
				
				}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
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
      <h1>Aviso de presupuesto </h1>
      <br />
      <br />
      <form id="form1" name="form1" method="post" action="#SELF">
        <div align="center">¿ Está seguro que desea enviar el aviso de presupuesto terminado ?<br />
            <br />
            <input type="submit" name="enviar" id="enviar" value="Si, enviar" />
          &nbsp;&nbsp;&nbsp;<a href="#" onClick="location.href='repmoviles_editar.php?id=<? echo $id; ?>'">No, cancelar </a></div>
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
