<? include("logadmin.php"); 
	$logadmin=true;
if ($logadmin) { 

if ($aceptar) { 
				    $tipo=substr($parte, 0,2);
					$nm=substr($parte,3,10); 
					$numero=(int)$nm; 
					$sucursal=substr($parte, 2,1);
					
					if ($tipo=="rp") { $tabla="computadoras"; }
					if ($tipo=="rm") { $tabla="repmovil";   }
					if ($tipo=="lm") { $tabla="libmovil";   }
					if ($tipo=="rc") { $tabla="consolas";   }
				
				$actualizo=mysql_query("update $tabla set aprobado='si' where id_$tabla='$numero'");
				?><script>location.href='presupuesto.php?cls=3452986159183583461908243'</script><?
				
				$mensaje="El presupuesto para la orden de reparación  $parte ha sido aceptado"; $mensaje=utf8_encode($mensaje);
				$asunto="Presupuesto aceptado";
				$headers = "MIME-Version: 1.0\r\n"; 
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
				$headers .= "From: SAT AHL Informatica <info@ahlinformatica.com>\r\n";
				//$elmail="ahl@lanzarote.net"; 
				$elmail="matias_ferradas@hotmail.com"; 
				if (mail ($elmail,$asunto,$mensaje,$headers)){ } else {  }
				} ?>
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
    <td width="642" align="right">&nbsp;
      <div align="center"><img src="images/sat.png" width="257" height="41" vspace="10" /></div>
      &nbsp;</td>
  </tr>
  
  <tr>
    <td height="17" colspan="2" background="images/top.png"></td>
  </tr>
  <tr>
    <td height="400" colspan="2" valign="top" background="images/medio.png">
    <div style="margin-left:20px; margin-right:20px">
      <h1>Servicio de Asistencia Técnica</h1>
      
      <? 
	  if ($cls!="3452986159183583461908243") { 
	  
	  
	  if (!$consultar)  { ?>
      <p><br />
        Ingrese los datos de su orden de reparación.<br />
        Puede encontrar el número de parte en el margen superior derecho de su hoja de reparación.<br />
        <br />
      </p>
      <form id="form2" name="form2" method="post" action="#SELF">
        <table width="507" border="0" align="center" cellpadding="0" cellspacing="5" style="border: 1px dotted #666">
          <tr>
            <td width="44">Parte: </td>
            <td width="448"><input name="parte" type="text" id="parte"  style=" width:97%" />
                <span class="texto_chico"><br />
              Ejemplos: <strong>RPT00001, RMT00001, LM0001...</strong></span></td>
          </tr>
          <tr>
            <td>DNI:</td>
            <td><input name="dni" type="text" id="dni"style=" width:97%" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="consultar" id="consultar" value="Consultar" /></td>
          </tr>
        </table>
            </form>
      <br />
      <? } else {   $valido=false;
	  				$parte=strtolower($parte);
	  				$tipo=substr($parte, 0,2);
					$sucursal=substr($parte, 2,1);
					
					if ($tipo=="rp") {   if ($sucursal=="a") { $tabla="computadoras_arrecife"; }
									    if ($sucursal=="t") { $tabla="computadoras_tias"; }
										
										$nm=substr($parte,3,10); $numero=(int)$nm;  
										$busco=mysql_query("select * from $tabla where id_computadoras='$numero'");
										$saco=mysql_fetch_array($busco); 
										
										$b=mysql_query("select * from clientes where id_clientes='$saco[cliente]'");
										$s=mysql_fetch_array($b);
									
										if ($s[dni]==$dni) { $valido=true; }
										
										if ($saco[aprobado]!="si") { ?><script>location.href='presupuesto.php?consultar=true&parte=<? echo $parte; ?>&dni=<? echo $dni; ?>'</script><? }
										}
										
					if ($tipo=="rm") {  
										if ($sucursal=="a") { $tabla="repmovil_arrecife"; }
										if ($sucursal=="t") { $tabla="repmovil_tias"; }
										
										$nm=substr($parte,3,10); $numero=(int)$nm;  
										$busco=mysql_query("select * from $tabla where id_repmovil='$numero'");
										$saco=mysql_fetch_array($busco); 
										
										$b=mysql_query("select * from clientes where id_clientes='$saco[cliente]'");
										$s=mysql_fetch_array($b);
									
										if ($s[dni]==$dni) { $valido=true; }
										if ($saco[aprobado]!="si") { ?><script>location.href='presupuesto.php?consultar=true&parte=<? echo $parte; ?>&dni=<? echo $dni; ?>'</script><? }

										} 
				
				    if ($tipo=="lm") { 
										if ($sucursal=="a") { $tabla="libmovil_arrecife"; }
										if ($sucursal=="t") { $tabla="libmovil_tias"; }
										 
										 $nm=substr($parte,3,10); $numero=(int)$nm;  
										$busco=mysql_query("select * from $tabla where id_libmovil='$numero'");
										$saco=mysql_fetch_array($busco); 
										
										$b=mysql_query("select * from clientes where id_clientes='$saco[cliente]'");
										$s=mysql_fetch_array($b);
									
										if ($s[dni]==$dni) { $valido=true; }
										if ($saco[aprobado]!="si") { ?><script>location.href='presupuesto.php?consultar=true&parte=<? echo $parte; ?>&dni=<? echo $dni; ?>'</script><? }
										} 
				
				
				if ($tipo=="rc") {  	if ($sucursal=="a") { $tabla="consolas_arrecife"; }
										if ($sucursal=="t") { $tabla="consolas_tias"; } 
										
										$nm=substr($parte,3,10); $numero=(int)$nm;  
										$busco=mysql_query("select * from $tabla where id_consolas='$numero'");
										$saco=mysql_fetch_array($busco); 
										
										$b=mysql_query("select * from clientes where id_clientes='$saco[cliente]'");
										$s=mysql_fetch_array($b);
									
										if ($s[dni]==$dni) { $valido=true; }
										if ($saco[aprobado]!="si") { ?><script>location.href='presupuesto.php?consultar=true&parte=<? echo $parte; ?>&dni=<? echo $dni; ?>'</script><? }
										} 
				
				
				
				
				
				 if ($valido) {
				 				if ($tipo=="rp") { 
											  ?>
                                              <br />
                                              <br />
                                              <form id="form1" name="form1" method="post" action="#SELF">
                                                    <table width="800" border="0" align="center" cellpadding="0" cellspacing="7" style="border:1px dotted #666">
                                                  <tr>
                                                    <td width="128"  style="border-bottom:1px dotted #CCC">Equipo:</td>
                                                    <td width="649" style="border-bottom:1px dotted #CCC"><strong><? echo $saco[modelo]; ?></strong></td>
                                                  </tr>
                                                  <tr>
                                                    <td  style="border-bottom:1px dotted #CCC">Avería:</td>
                                                    <td  style="border-bottom:1px dotted #CCC"><? echo $saco[averia]; ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td nowrap="nowrap"  style="border-bottom:1px dotted #CCC">Trabajo a realizar: </td>
                                                    <td  style="border-bottom:1px dotted #CCC"><? echo nl2br($saco[solucion]); ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td nowrap="nowrap"  style="border-bottom:1px dotted #CCC"><strong>Trabajo realizado:</strong></td>
                                                    <td  style="border-bottom:1px dotted #CCC"><? echo nl2br($saco[trabajo]); ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td  style="border-bottom:1px dotted #CCC">Componentes</td>
                                                    <td  style="border-bottom:1px dotted #CCC">  
                                                        <? if ($sucursal=="a") { $tablacomp="componentes_arrecife"; }
																if ($sucursal=="t") { $tablacomp="componentes_tias"; } 
						
															$bcom=mysql_query("select * from $tablacomp where clase='rp' and id='$saco[0]'"); 
                                                            $ncom=mysql_num_rows($bcom); 
                                                            if ($ncom>0) { ?>
                                                                <table width="100%" border="0" cellpadding="0" cellspacing="3" style="border:1px dotted #333">
                                                                <tr><td width="40" height="25" bgcolor="#FFFFCC"><strong>Cant.</strong></td>
                                                                <td bgcolor="#FFFFCC"><strong>Descripción</strong></td><td width="80" bgcolor="#FFFFCC"><strong>Precio</strong></td>
                                                                <td width="38" bgcolor="#FFFFCC"><strong>SubTotal</strong></td>
                                                                </tr><?
                                                                                        while ($scom=mysql_fetch_array($bcom)) { $totalcomp=$totalcomp+$scom[total];
                                                                                                                                ?><tr><td><? echo $scom[unidades]; ?></td><td><? echo $scom[descripcion]; ?></td><td nowrap="nowrap">&#8364; <? echo $scom[precio]; ?></td><td align="right" nowrap="nowrap">&#8364; <? echo $scom[total]; ?></td>
                                                                  <?
                                                                                                                                }
                                                                                        ?><tr><td>&nbsp;</td><td>&nbsp;</td>
                                                                <td align="right" nowrap="nowrap"><strong>Total &nbsp;</strong></td>
                                                                <td align="right" nowrap="nowrap"><strong>&#8364; <? printf("%'11.2f",$totalcomp);  ?></strong></td>
                                                                </tr>
                                                                </table>
                                                                <? } else { ?>No son necesarios componentes extra para la reparación<? } ?>                                        </td>
                                                  </tr>
                                                  <tr>
                                                    <td  style="border-bottom:1px dotted #CCC">Mano de obra</td>
                                                    <td  style="border-bottom:1px dotted #CCC"><strong>&#8364; <? printf("%'11.2f",$saco[presupuesto]);  ?></strong></td>
                                                  </tr>
                                                  
                                                  <tr>
                                                    <td align="right" class="titulo"  style="border-bottom:1px dotted #CCC">Total</td>
                                                    <td height="40" class="titulo" style="border-bottom:1px dotted #CCC">&#8364;                                          <? $totalreparacion=$saco[presupuesto]+$totalcomp; printf("%'11.2f",$totalreparacion); ?><input type="hidden" name="parte" value="<? echo $parte; ?>" /></td>
                                                  </tr>
                                                </table>
		</form>
                                                
                                              <? }
								
								
								
								
								if ($tipo=="rm") { 
											   ?>
                                              <br />
                                              <br />
                                              <form id="form1" name="form1" method="post" action="#SELF">
                                                    <table width="800" border="0" align="center" cellpadding="0" cellspacing="7" style="border:1px dotted #666">
                                                  <tr>
                                                    <td width="128"  style="border-bottom:1px dotted #CCC">Equipo:</td>
                                                    <td width="649" style="border-bottom:1px dotted #CCC"><strong><? echo "$saco[marca] $saco[modelo]"; ?></strong></td>
                                                  </tr>
                                                  <tr>
                                                    <td  style="border-bottom:1px dotted #CCC">Avería:</td>
                                                    <td  style="border-bottom:1px dotted #CCC"><? echo $saco[averia]; ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td nowrap="nowrap"  style="border-bottom:1px dotted #CCC">Trabajo a realizar: </td>
                                                    <td  style="border-bottom:1px dotted #CCC"><? echo nl2br($saco[solucion]); ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td nowrap="nowrap"  style="border-bottom:1px dotted #CCC"><strong>Trabajo realizado:</strong></td>
                                                    <td  style="border-bottom:1px dotted #CCC"><? echo nl2br($saco[trabajo]); ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td  style="border-bottom:1px dotted #CCC">Componentes</td>
                                                    <td  style="border-bottom:1px dotted #CCC">  
                                                        <? if ($sucursal=="a") { $tablacomp="componentes_arrecife"; }
															if ($sucursal=="t") { $tablacomp="componentes_tias"; } 
															
															$bcom=mysql_query("select * from $tablacomp where clase='rm' and id='$saco[0]'"); 
                                                            $ncom=mysql_num_rows($bcom); 
                                                            if ($ncom>0) { ?>
                                                                <table width="100%" border="0" cellpadding="0" cellspacing="3" style="border:1px dotted #333">
                                                                <tr><td width="40" height="25" bgcolor="#FFFFCC"><strong>Cant.</strong></td>
                                                                <td bgcolor="#FFFFCC"><strong>Descripción</strong></td><td width="80" bgcolor="#FFFFCC"><strong>Precio</strong></td>
                                                                <td width="38" bgcolor="#FFFFCC"><strong>SubTotal</strong></td>
                                                                </tr><?
                                                                                        while ($scom=mysql_fetch_array($bcom)) { $totalcomp=$totalcomp+$scom[total];
                                                                                                                                ?><tr><td><? echo $scom[unidades]; ?></td><td><? echo $scom[descripcion]; ?></td><td nowrap="nowrap">&#8364; <? echo $scom[precio]; ?></td><td align="right" nowrap="nowrap">&#8364; <? echo $scom[total]; ?></td>
                                                                  <?
                                                                                                                                }
                                                                                        ?><tr><td>&nbsp;</td><td>&nbsp;</td>
                                                                <td align="right" nowrap="nowrap"><strong>Total &nbsp;</strong></td>
                                                                <td align="right" nowrap="nowrap"><strong>&#8364; <? printf("%'11.2f",$totalcomp);  ?></strong></td>
                                                                </tr>
                                                                </table>
                                                                <? } else { ?>No son necesarios componentes extra para la reparación<? } ?>                                        </td>
                                                  </tr>
                                                  <tr>
                                                    <td  style="border-bottom:1px dotted #CCC">Mano de obra</td>
                                                    <td  style="border-bottom:1px dotted #CCC"><strong>&#8364; <? printf("%'11.2f",$saco[presupuesto]);  ?></strong></td>
                                                  </tr>
                                                  
                                                  <tr>
                                                    <td align="right" class="titulo"  style="border-bottom:1px dotted #CCC">Total</td>
                                                    <td height="40" class="titulo" style="border-bottom:1px dotted #CCC">&#8364;                                          <? $totalreparacion=$saco[presupuesto]+$totalcomp; printf("%'11.2f",$totalreparacion); ?><input type="hidden" name="parte" value="<? echo $parte; ?>" /></td>
                                                  </tr>
                                                </table>
		</form>
                                                
                                              <? }
								
								
								
								
								
								if ($tipo=="rc") { 
											  ?>
                                              <br />
                                              <br />
                                              <form id="form1" name="form1" method="post" action="#SELF">
                                                    <table width="800" border="0" align="center" cellpadding="0" cellspacing="7" style="border:1px dotted #666">
                                                  <tr>
                                                    <td width="128"  style="border-bottom:1px dotted #CCC">Consola:</td>
                                                    <td width="649" style="border-bottom:1px dotted #CCC"><strong><? echo "$saco[consola]"; ?></strong></td>
                                                  </tr>
                                                  <tr>
                                                    <td  style="border-bottom:1px dotted #CCC">Avería:</td>
                                                    <td  style="border-bottom:1px dotted #CCC"><? echo $saco[averia]; ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td nowrap="nowrap"  style="border-bottom:1px dotted #CCC">Trabajo a realizar: </td>
                                                    <td  style="border-bottom:1px dotted #CCC"><? echo nl2br($saco[solucion]); ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td nowrap="nowrap"  style="border-bottom:1px dotted #CCC"><strong>Trabajo realizado:</strong></td>
                                                    <td  style="border-bottom:1px dotted #CCC"><? echo nl2br($saco[trabajo]); ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td  style="border-bottom:1px dotted #CCC">Componentes</td>
                                                    <td  style="border-bottom:1px dotted #CCC">  
                                                        <? if ($sucursal=="a") { $tablacomp="componentes_arrecife"; }
															if ($sucursal=="t") { $tablacomp="componentes_tias"; } 
															
															$bcom=mysql_query("select * from $tablacomp where clase='rc' and id='$saco[0]'"); 
                                                            $ncom=mysql_num_rows($bcom); 
                                                            if ($ncom>0) { ?>
                                                                <table width="100%" border="0" cellpadding="0" cellspacing="3" style="border:1px dotted #333">
                                                                <tr><td width="40" height="25" bgcolor="#FFFFCC"><strong>Cant.</strong></td>
                                                                <td bgcolor="#FFFFCC"><strong>Descripción</strong></td><td width="80" bgcolor="#FFFFCC"><strong>Precio</strong></td>
                                                                <td width="38" bgcolor="#FFFFCC"><strong>SubTotal</strong></td>
                                                                </tr><?
                                                                                        while ($scom=mysql_fetch_array($bcom)) { $totalcomp=$totalcomp+$scom[total];
                                                                                                                                ?><tr><td><? echo $scom[unidades]; ?></td><td><? echo $scom[descripcion]; ?></td><td nowrap="nowrap">&#8364; <? echo $scom[precio]; ?></td><td align="right" nowrap="nowrap">&#8364; <? echo $scom[total]; ?></td>
                                                                  <?
                                                                                                                                }
                                                                                        ?><tr><td>&nbsp;</td><td>&nbsp;</td>
                                                                <td align="right" nowrap="nowrap"><strong>Total &nbsp;</strong></td>
                                                                <td align="right" nowrap="nowrap"><strong>&#8364; <? printf("%'11.2f",$totalcomp);  ?></strong></td>
                                                                </tr>
                                                                </table>
                                                                <? } else { ?>No son necesarios componentes extra para la reparación<? } ?>                                        </td>
                                                  </tr>
                                                  <tr>
                                                    <td  style="border-bottom:1px dotted #CCC">Mano de obra</td>
                                                    <td  style="border-bottom:1px dotted #CCC"><strong>&#8364; <? printf("%'11.2f",$saco[presupuesto]);  ?></strong></td>
                                                  </tr>
                                                  
                                                  <tr>
                                                    <td align="right" class="titulo"  style="border-bottom:1px dotted #CCC">Total</td>
                                                    <td height="40" class="titulo" style="border-bottom:1px dotted #CCC">&#8364;                                          <? $totalreparacion=$saco[presupuesto]+$totalcomp; printf("%'11.2f",$totalreparacion); ?><input type="hidden" name="parte" value="<? echo $parte; ?>" /></td>
                                                  </tr>
                                                </table>
		</form>
                                               
                                              <? }
								
								
								
								
								
								
								
								
								} else { ?>
      <div align="center"><br />
        <br />
        Los datos ingresados son <strong>incorrectos</strong>, por favor verifíquelos e intente nuevamente.<br />
        Si desea puede comunicarse telefónicamente al 928.80.50.93<br />
        <br />
        <br />
      </div>
      <? } 
				
				
				
					?><? } ?>
                    
                    
                    
                    <? } else { ?><br /><br />
                    <div align="center"><span class="titulo">El presupuesto ha sido aceptado</span><br />
                      <br />
                    Será notificado cuando la reparación esté terminada y deba retirar el equipo.<br />
                        <em>Muchas gracias por confiar en AHL Informática.</em></div>
                    <? } ?>
                    
                    
                    
                    
                    
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
