<? include("logadmin.php"); 
	
if ($logadmin) { 

if ($class=="new") { $creo=mysql_query("insert into empresa_presupuesto (empresa, sucursal) values ('$id','$sucursal')");
						$b=mysql_query("select * from empresa_presupuesto order by id_empresa_presupuesto desc"); $s=mysql_fetch_array($b); 
						?><script>location.href='empresas_nuevo_presupuesto.php?id=<? echo $id; ?>&id_presupuesto=<? echo $s[0]; ?>'</script><? } 

if ($sucursal=="Arrecife") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Tias") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Centro") { $tabla_empresas=" empresas_integradas "; } 


if ($agregar) { if ($descuento=="" or $descuento=="0") { $total=$unidades*$precio; }  else {
														$total=$unidades*$precio;
														$desc=$total*$descuento/100;
														$total=$total-$desc;
														}
				$ingreso=mysql_query("insert into empresa_presupuesto_detalle (unidades, concepto, precio, total, descuento, presupuesto) values ('$unidades','$concepto','$precio','$total', '$descuento', '$id_presupuesto')");
				?><script>location.href='empresas_nuevo_presupuesto.php?id=<? echo $id; ?>&id_presupuesto=<? echo $id_presupuesto; ?>'</script><? }
 

if ($guardar_comentarios) { $actualizo=mysql_query("update empresa_presupuesto set comentario='$comentarios' where id_empresa_presupuesto='$id_presupuesto'"); 

			?><script>location.href='empresas_nuevo_presupuesto.php?id=<? echo $id; ?>&id_presupuesto=<? echo $id_presupuesto; ?>'</script><? } 



if ($enviar=="92346124") {	$b=mysql_query("select * from $tabla_empresas where id_empresa='$id'"); 
							$s=mysql_fetch_array($b);
							$destinatario=$s[email];
							
							$busco_presu=mysql_query("select * from empresa_presupuesto where id_empresa_presupuesto='$id_presupuesto'");
 							$saco_presu=mysql_fetch_array($busco_presu);
 							$veces=$saco_presu[veces]+1;
							
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
							
							
							
							
							
							
							
			$bcom=mysql_query("select * from empresa_presupuesto_detalle where presupuesto='$id_presupuesto' order by id_empresa_presupuesto_detalle desc");
			
if ($sucursal=="Tias") { $datos="C.\ Libertad, 55<br />
        35572 - T&iacute;as<br />
        TF/FAX: 928.52.40.75<br />
        ahltias@hotmail.com<br />";
         } 
		if ($sucursal=="Arrecife")  {
      $datos="C/ Puerto Rico, 50<br />
      35500 - Arrecife de Lanzarote<br />
      TF/FAX: 928.80.50.93<br />
      info@ahlinformatica.com<br />";
      } 
	   if ($sucursal=="Centro") {
		   						
                                $datos="C.\ ALFEREZ CABRERA TAVIO, 3<br />
                                35500 - ARRECIFE DE LANZAROTE <br />
                                TFNO: 928.597119<br />
                                arrecifecentro@ahlinformatica.com<br />";
								
								} 
      $datos.="CIF: B35859412";			
		 
 ?>
<?        
$msj="<table width='700' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='400'><img src='http://sat.ahlinformatica.com/images/LOGO-AHL.png'></td>
    <td align='right'>$datos</td>
  </tr>
  <tr><td colspan='2'>&nbsp;</td></tr>
</table>
	  <table width='700' border='0' cellspacing='0' cellpadding='4' style='border:1px solid #666'>
  		<tr>
          <td  width='50' height='30' bgcolor='#F7F7F7' ><strong>UDS</strong></td>
          <td  height='30' bgcolor='#F7F7F7' ><strong>CONCEPTO</strong></td>
          <td  width='120' height='30' align='right' bgcolor='#F7F7F7' ><strong>PRECIO</strong></td>
		  <td  width='100' height='30' align='right' bgcolor='#F7F7F7' ><strong>DESCUENTO</strong></td>
          <td  width='120' height='30' align='right' bgcolor='#F7F7F7' ><strong>TOTAL</strong></td>
          <td  width='30' align='right' bgcolor='#F7F7F7' >&nbsp;</td>
        </tr>";
        
	  	
		while ($scom=mysql_fetch_array($bcom)) { 
		$totalventa=$totalventa+$scom[total];
	  	$estilo="style='border-bottom:1px dotted #666'";
		
        $msj.="<tr>
          <td  $estilo >$scom[unidades]</td>
          <td  $estilo >$scom[concepto]</td>
          <td  $estilo  align='right'>$scom[precio] &#8364; </td>
		  <td  align='right'  $estilo>";
		  
		  if ($scom[descuento]!="0") {  $msj.="$scom[descuento]  % "; } else {  $msj.="&nbsp;"; }
		  
           $msj.="</td>
		   <td  align='right'  $estilo>$scom[total]  &#8364; </td>
          <td  align='center'  $estilo>&nbsp;</td>
        </tr>";
        
		 } 
         
		if ($saco_presu[comentario]!="") { 
        $msj.="<tr >
          <td colspan='5' align='left' style='padding:10px' bgcolor='#FFFFCC' class='titulo'><strong>Comentarios</strong><br />
            <br />
            $saco_presu[comentario]
           </td>
          </tr>";
		}
		
        $msj.="<tr >
          <td  height='40' colspan='3' align='right' ><strong>Total presupuesto con IGIC incluido:</strong></td>
          <td   align='right'>"; 
		  $tot=number_format($totalventa,2); 
		  $msj.="<strong>$tot &#8364;</strong></td>
          <td   align='right'>&nbsp;</td>
        </tr>
        </table>";
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							$msj.="<br><br><strong>El equipo de AHL Informática</strong><hr>Este mensaje y los ficheros anexos son confidenciales. Los mismos contienen información reservada que no puede ser difundida. Si usted ha recibido este correo por error, tenga la amabilidad de eliminarlo de su sistema y avisar al remitente mediante reenvío a su dirección electrónica; no debe copiar el mensaje ni divulgar su contenido a ninguna persona.
Su dirección de correo electrónico, junto con sus datos personales, constan en un fichero titularidad de LANZACOMPUTER S.L.. cuya finalidad es la de mantener el contacto con usted y hacerles llegar las propuestas de servicios o productos. Si quiere saber de qué información acerca de usted disponemos, modificarla, y, en su caso, cancelarla, puede hacerlo enviando un escrito al efecto, acompañado de una fotocopia de su DNI a la siguiente dirección: LANZACOMPUTER , S.L., calle Puerto Rico, 50, 35500 de Arrecife de Lanzarote. Asimismo, se le advierte que toda la información personal contenida en este mensaje se encuentra protegida por la Ley 15/1999, de 13 de Diciembre, de protección de datos de carácter personal, quedando totalmente prohibido su uso y/o tratamiento, así como la cesión de aquella a terceros al margen de lo dispuesto en la citada ley protectora de datos personales y de su normativa de desarrollo. Conforme al Código Penal será castigado el que, para descubrir los secretos o vulnerar la intimidad de otro, sin su consentimiento, se apodere de faxes o cartas. También incurre en delito aquel que descubriere, revelare o cediere datos reservados de personas jurídicas, sin el consentimiento de sus representantes. Asimismo es su responsabilidad comprobar que este mensaje o sus archivos adjuntos no contengan virus informático. 
Para dejar de recibir nuestra publicidad, es suficiente con indicarlo a cualquiera de nuestros comerciales o enviando un e-mail a: soporte@ahlinformatica.com asunto baja.";
							
							require_once 'class.phpmailer.php';
																								
							  $mail = new PHPMailer ();
							  $mail -> From = "info@ahlinformatica.com";
							  $mail -> FromName = "AHL Informatica";
							  $mail -> AddAddress("$destinatario");
							  $mail->CharSet = "utf-8";
							  $mail -> Subject = "Presupuesto";
							  $mail -> Body = $msj;
							  $mail -> IsHTML (true);
							  $mail->Host = "mail.ahlinformatica.com";
							  $mail->AddReplyTo("info@ahlinformatica.com", "info@ahlinformatica.com");
							  $mail->Timeout=30;
							  //$mail->AddEmbeddedImage($elarchivo);
							  $mail->Send();
	
							  $actualizo=mysql_query("update empresa_presupuesto set enviado='si', fecha='$lafechadehoy', veces='$veces' where id_empresa_presupuesto='$id_presupuesto'");
							?><script>location.href='empresas_editar.php?id=<? echo $id; ?>&enviado=true'</script><? }
							
							
 $busco_presu=mysql_query("select * from empresa_presupuesto where id_empresa_presupuesto='$id_presupuesto'");
 $saco_presu=mysql_fetch_array($busco_presu);
 
 
 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<? include("funciones.php"); ?>
<script>

function confirmar_enviar() { if (confirm('Seguro que desea enviar el presupuesto')) { location.href='empresas_nuevo_presupuesto.php?id=<? echo $id; ?>&id_presupuesto=<? echo $id_presupuesto; ?>&enviar=92346124'} }

</script>
<style type="text/css">
<!--
.style1 {color: #EEEEEE}
-->
</style>
</head>

<body onLoad="document.getElementById('unidades').focus();">
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
      <h1><a href="empresas_lista.php">Empresas</a> &raquo; <? $b=mysql_query("select * from $tabla_empresas where id_empresa='$id'"); $s=mysql_fetch_array($b);  ?><a href='empresas_editar.php?id=<? echo $id; ?>'><? echo $s[nombre]; ?></a> &raquo; Nuevo presupuesto</h1>
       <form id="form1" name="form1" method="post" action="#SELF">
      <div id="agregarcliente" style="margin:20px; padding:10px; border:1px solid #BBBBBB; width:620px; background-color:#E5E5E5">
      <? 
	  $busco=mysql_query("select * from $tabla_empresas where id_empresa='$id'"); 
	$saco=mysql_fetch_array($busco);
		?>
       
          <table width="600" border="0" cellspacing="3" cellpadding="0">
           <tr>
              <td width="84">Unidades</td>
              <td width="507"><input name="unidades" type="text" id="unidades" autocomplete="off" /></td>
            </tr>
            <tr>
              <td>Concepto</td>
              <td><textarea name="concepto" rows="5" id="concepto" style="width:98%"></textarea></td>
            </tr>
            <tr>
              <td>Precio</td>
              <td><input  type="text" name="precio" id="precio"   autocomplete="off" /></td>
            </tr>
            <tr>
              <td>Descuento</td>
              <td valign="middle">
                <input name="descuento" type="text" id="descuento" autocomplete="off" value="0" />
                %</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td valign="middle"><input type="submit" name="agregar" id="agregar" value="  Agregar  " /></td>
            </tr>
          </table>
         
        
        </div>
        
        
        <? $bcom=mysql_query("select * from empresa_presupuesto_detalle where presupuesto='$id_presupuesto' order by id_empresa_presupuesto_detalle desc");
			$cnt=mysql_num_rows($bcom);
			
		if ($cnt>0) {  ?>
      <strong>Presupuesto actual</strong><br />
      <br />
<table width="800" border="0" cellspacing="0" cellpadding="4" style="border:1px solid #666">
  <tr <? echo $estilo; ?>>
          <td  width="50" height="30" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>UDS</strong></td>
          <td  height="30" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>CONCEPTO</strong></td>
          <td  width="120" height="30" align="right" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>PRECIO</strong></td>
          <td  width="100" align="right" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>DESCUENTO</strong></td>
          <td  width="120" height="30" align="right" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>TOTAL</strong></td>
          <td  width="30" align="right" bgcolor="#F7F7F7" <? echo $estilo; ?>>&nbsp;</td>
        </tr>
        <? 
	  	
		while ($scom=mysql_fetch_array($bcom)) { 
		$totalventa=$totalventa+$scom[total];
	  	$estilo="style='border-bottom:1px dotted #666'";
		?>
        <tr>
          <td  <? echo $estilo; ?> ><? echo $scom[unidades]; ?></td>
          <td <? echo $estilo; ?> ><? echo $scom[concepto]; ?></td>
          <td <? echo $estilo; ?>  align="right"><? echo $scom[precio]; ?> &#8364; </td>
          <td  align="right" <? echo $estilo; ?>><? if ($scom[descuento]!="0") { echo $scom[descuento]; ?>% <? } else { echo "&nbsp;"; } ?></td>
          <td  align="right" <? echo $estilo; ?>><? echo $scom[total]; ?> &#8364; </td>
          <td  align="center" <? echo $estilo; ?>><a href="empresas_presupuesto_eliminar.php?id=<? echo $id; ?>&id_art=<? echo $scom[0]; ?>&id_presupuesto=<? echo $id_presupuesto; ?>">X</a></td>
        </tr>
        <? } ?>
        <tr >
          <td  height="150" colspan="6" align="left" bgcolor="#FFFFCC" class="titulo"><span class="texto">Comentarios</span><br />
            <span class="texto">
            <textarea name="comentarios" rows="3" id="comentarios" style="margin-top:7px; margin-bottom:7px; width:90%"><? echo $saco_presu[comentario]; ?></textarea>
            <br />
            <input type="submit" name="guardar_comentarios" id="guardar_comentarios" value="Guardar comentarios" />
            </span></td>
          </tr>
        <tr >
          <td  height="40" colspan="3" align="right" class="titulo">Total presupuesto con IGIC incluido:</td>
          <td   align="right" class="titulo">&nbsp;</td>
          <td   align="right" class="titulo"><?  printf("%'11.2f",$totalventa); ?>
            &#8364;</td>
          <td   align="right" class="titulo">&nbsp;</td>
        </tr>
        <tr >
          <td  height="60" colspan="6" align="center" class="titulo"><input name="enviar_presupuesto" type="button" class="titulo" id="enviar_presupuesto" value="Enviar presupuesto" onClick="return confirmar_enviar();" /></td>
          </tr>
  </table>
      <br />
      <? } ?>
      
      </form>
      
      <div>
        <div style=" display:<? echo "none"; ?>; margin:10px; background-color:#FFC;"></div>
      </div>
      
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
