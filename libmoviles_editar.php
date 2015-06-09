<? include("logadmin.php"); 
	
if ($logadmin) {  

if ($agregar) {  
				
						$estado="abierto";		
						
						if ($sucursal=="Arrecife") { $tabla="libmovil_arrecife"; }
	   			 if ($sucursal=="Tias") { $tabla="libmovil_tias"; }
				 if ($sucursal=="Centro") { $tabla="libmovil_centro"; } 
				 
				$ingreso=mysql_query("update $tabla set marca='$marca', modelo='$modelo', imei='$imei', extras='$extras', cliente='$cliente', aprobado='$aprobado', total='$total', cargador='$cargador', bateria='$bateria',  solucion='$solucion', presupuesto='$presupuesto',    trabajo='$trabajo' where id_libmovil='$id'");
				
				?><script>location.href='libmoviles.php?ssid=<? echo rand(111111,999999); ?>'</script><? }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<? include("funciones.php");
 
 if ($sucursal=="Arrecife") { $tabla="libmovil_arrecife"; }
	   			 if ($sucursal=="Tias") { $tabla="libmovil_tias"; }
				 if ($sucursal=="Centro") { $tabla="libmovil_centro"; } 
				 
				 
	  	 $busco=mysql_query("select * from $tabla where id_libmovil='$id'");
		 $saco=mysql_fetch_array($busco);
	     ?>
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
      <h1>Liberación de móviles</h1>
      <span class="titulo">Orden de reparación: LM<? if ($saco[tienda]=="Tias") {  echo "T"; } if ($saco[tienda]=="Centro") {  echo "C"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[0]); $saco[0]; ?>
      </span>
      
      
      
      <div style="float:right; margin-top:17px">
        
        
        <div align="center" style=" margin-right:20px; margin-top:20px; width:220px; padding:10px; border:1px dotted #999999; background-color: #FFFFCC"><span class="titulo">Hoja de reparación</span><br />
            <br />
            <a href="libmoviles_orden.php?id=<? echo $id; ?>">Imprimir hoja de reparación</a><br />
        </div>
      
     
      <div  style=" margin-right:20px; margin-top:20px; width:220px; padding:10px; border:1px dotted #999999; background-color: #FFFFCC">
	  <? $bc=mysql_query("select * from clientes where id_clientes='$saco[cliente]'");
	  $sc=mysql_fetch_array($bc); ?>
       
        <span class="titulo">Datos del cliente</span><br />
        <br />
        <? echo "$sc[apellido], $sc[nombre]<br>"; ?>  
        <? if ($sc[email1]!="") { echo "$sc[email1]<br>"; } ?>
        <? if ($sc[email2]!="") { echo "$sc[email2]<br>"; } ?>
        <? if ($sc[direccion]!="") { echo "$sc[direccion] $sc[cp] <br>"; } ?>
        <? if ($sc[movil1]!="") { echo "$sc[movil1]<br>"; } ?>
        <? if ($sc[movil2]!="") { echo "$sc[movil2]"; } ?>
        <br />
        <br />
      </div>
      
       <? if ($saco[estado]!="finalizado") { ?>
      <div align="center" style=" margin-right:20px; margin-top:20px; width:220px; padding:10px; border:1px dotted #999999; background-color: #FFFFCC"><span class="titulo">Avisos</span><br />
            <br />
            <? if ($saco[sms]!="si") { ?><a href="libmoviles_aviso_presupuesto.php?id=<? echo $id; ?>">Enviar aviso de <strong>Presupuesto</strong></a><? } else { echo "Aviso de presupuesto enviado !"; } ?>
            <div style="height:7px"></div>
            <? if ($saco[sms2]!="si") { ?><a href="libmoviles_aviso_terminado.php?id=<? echo $id; ?>">Enviar aviso de <strong>reparacion lista</strong></a><? } else { echo "Aviso de finalización enviado !"; }?><br />
        </div>
        
        
        <div align="center" style=" margin-right:20px; margin-top:20px; width:220px; padding:10px; border:1px dotted #999999; background-color: #FFFFCC"><span class="titulo">Facturación</span><br />
            <br />
            <a href="libmoviles_facturar.php?cls=1&amp;tipo=lm&amp;idcl=<? echo $saco[cliente]; ?>&amp;id=<? echo $id; ?>&amp;mdo=<? echo $saco[presupuesto]; ?>">Facturar reparación</a>
            <div style="height:7px"></div>
            <a href="libmoviles_facturar.php?cls=2&tipo=lm&idcl=<? echo $saco[cliente]; ?>&id=<? echo $id; ?>">Facturar Presupuesto 12 &#8364;</a>
             <div style="height:7px"></div>
            <a href="libmoviles_facturar.php?cls=3&tipo=lm&idcl=<? echo $saco[cliente]; ?>&id=<? echo $id; ?>">Cerrar sin facturar</a><br />
        </div>
        
        <? } ?>
        
      
      
      
      </div>
      
      
      
      
      <div id="agregar" style="display:<? echo "block"; ?>; margin:20px; padding:10px; border:1px solid #BBBBBB; width:620px; background-color:#E5E5E5">
        <form id="form1" name="form1" method="post" action="#SELF">
          
          <span class="titulo">Datos del Cliente</span><br />
          <br />
          <div id="buscarcliente">
            <table width="600" border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td width="55">Cliente</td>
                  <td width="536"><select style="width:536px" name="cliente" id="cliente">
                  <? $b=mysql_query("select * from clientes order by apellido");
				  	while ($s=mysql_fetch_array($b)) {  ?>
                  <option value="<? echo $s[0]; ?>" <? if ($s[0]==$saco[cliente]) {  $dni=$s[dni]; ?>selected="selected"<? } ?>><? echo "$s[apellido], $s[nombre] - $s[email1]"; ?></option>
                  <? } ?>
                  </select>                  </td>
                </tr>
              </table>
              <? echo "&nbsp;DNI: $dni"; ?>
          </div>
          
          
         
          <br />
            <br />
            <span class="titulo">Datos del Equipo</span><br />
            <br />
            <table width="600" border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td width="90">Marca</td>
                <td><input style="width:98%" type="text" name="marca" id="marca" value="<? echo $saco[marca]; ?>" /></td>
              </tr>
              <tr>
                <td>Modelo</td>
                <td><input style="width:98%" type="text" name="modelo" id="modelo"  value="<? echo $saco[modelo]; ?>" /></td>
              </tr>
              <tr>
                <td nowrap="nowrap">IMEI</td>
                <td><input style="width:98%" type="text" name="imei" id="imei"  value="<? echo $saco[imei]; ?>" /></td>
              </tr>
              <tr>
                <td nowrap="nowrap">Deja cargador</td>
                <td><select name="cargador" id="cargador">
                  <option <? if ($saco[cargador]=="si") { ?>selected="selected"<? } ?>>si</option>
                  <option <? if ($saco[cargador]=="no") { ?>selected="selected"<? } ?>>no</option>
                </select>                </td>
              </tr>
              <tr>
                <td nowrap="nowrap">Deja bateria</td>
                <td><select name="bateria" id="bateria">
                  <option <? if ($saco[bateria]=="si") { ?>selected="selected"<? } ?>>si</option>
                  <option <? if ($saco[bateria]=="no") { ?>selected="selected"<? } ?>>no</option>
                </select></td>
              </tr>
              <tr>
                <td>Avería</td>
                <td><textarea name="averia" rows="5" id="averia" style="width:98%"><? echo $saco[averia]; ?></textarea></td>
              </tr>
              <tr>
                <td nowrap="nowrap"><p>Trabajo a realizar<br />
                    <span class="texto_chico"><em>(Este texto se <br />
                    utilizaráen la vista<br />
                    del presupuesto del <br />
                    cliente)</em></span></p>                  </td>
                <td><textarea name="solucion" rows="6" id="solucion" style="width:98%"><? echo $saco[solucion]; ?></textarea></td>
              </tr>
              <tr>
                <td>Observaciones de daños o problemas<br /></td>
                <td><textarea name="extras" rows="3" id="extras" style="width:98%"><? echo $saco[extras]; ?></textarea></td>
              </tr>
              <tr>
                <td nowrap="nowrap">Trabajo realizado</td>
                <td><textarea name="trabajo" rows="6" id="trabajo" style="width:98%"><? echo $saco[trabajo]; ?></textarea></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Componentes</td>
                <td><div id="loscomponentes"><? 
				
						if ($sucursal=="Arrecife") { $tablacomp="componentes_arrecife"; }
			    		if ($sucursal=="Tias") { $tablacomp="componentes_tias"; } 
				
				$bcom=mysql_query("select * from $tablacomp where clase='lm' and id='$id'");
						$cant=mysql_num_rows($bcom); 
						if ($cant>0) { $totalcomp=0;  ?>
                        
                        <table width="100%" border="0" cellpadding="0" cellspacing="3" style="border:1px dotted #333">
                <tr><td width="40" height="25" bgcolor="#FFFFCC"><strong>Cant.</strong></td>
                <td bgcolor="#FFFFCC"><strong>Descripción</strong></td><td width="80" bgcolor="#FFFFCC"><strong>Precio</strong></td>
                <td width="80" bgcolor="#FFFFCC"><strong>SubTotal</strong></td>
                <td width="20" bgcolor="#FFFFCC">&nbsp;</td>
                </tr><?
										while ($scom=mysql_fetch_array($bcom)) { $totalcomp=$totalcomp+$scom[total];
																				?><tr><td><? echo $scom[unidades]; ?></td><td><? echo $scom[descripcion]; ?></td><td nowrap="nowrap">&#8364; <? echo $scom[precio]; ?></td>
                  
                  <td align="right" nowrap="nowrap">&#8364; <? echo $scom[total]; ?></td>
                  <td align="center"><a href="componentes_eliminar.php?clase=lm&id=<? echo $id; ?>&idcom=<? echo $scom[0]; ?>">X</a></td>
                <?
																				}
										?><tr><td>&nbsp;</td><td><input type="hidden" id="nocache" value="<? echo rand(111111,999999); ?>" /></td>
                  <td align="right"><strong>Total </strong></td>
                <td align="right" nowrap="nowrap"><strong>&#8364; <? printf("%'11.2f",$totalcomp);  ?>&nbsp;</strong></td>
                <td align="right">&nbsp;</td></tr>
                </table>
                
                
          <?
										} else {  ?>No hay componentes ingresados para esta reparación<? } ?>
                      </div>
                                        <? if ($saco[estado]!="finalizado") { ?><div id="agregarcomp" style=" padding:10px;cursor:pointer" onClick="mostrar('detallecomp'); ocultar('agregarcomp'); ">[+]Agregar componente</div><? } ?>
                                        <div id="detallecomp" style="display:<? echo "none"; ?>; margin-top:10px; border:1px dotted #333">
                                          <table width="100%" border="0" cellspacing="3" cellpadding="0">
                                            <tr>
                                              <td>Cantidad:&nbsp;</td>
                                              <td><input name="cant" type="text" id="cant" size="6" /></td>
                                            </tr>
                                            <tr>
                                              <td>Descripción:</td>
                                              <td><input name="desc" type="text" id="desc" size="60" /></td>
                                            </tr>
                                            <tr>
                                              <td>Precio:</td>
                                              <td><input name="precio" type="text" id="precio" size="8" /></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td><input type="button" name="button" id="button" value="Agregar componente" onClick="cargar_componente_lm(document.getElementById('cant').value,document.getElementById('desc').value,document.getElementById('precio').value,'<? echo $id; ?>','<? echo rand(111111,999999); ?>');mostrar('agregarcomp'); ocultar('detallecomp');document.getElementById('cant').value='';document.getElementById('desc').value='';document.getElementById('precio').value=''" /> 
                                              <span style="cursor:pointer" onClick="mostrar('agregarcomp'); ocultar('detallecomp');">Cancelar</span></td>
                                            </tr>
                                          </table>
                  </div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Mano de obra</td>
                <td><strong>&#8364;</strong> 
                  <input style="width:30%" type="text" name="presupuesto" id="presupuesto" value="<? echo $saco[presupuesto]; ?>"  /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="radio" name="aprobado" id="radio3" value="si" <? if ($saco[aprobado]=="si") { ?> checked="checked" <? } ?> />
                  Aprobado                &nbsp;&nbsp;&nbsp;
                  <input name="aprobado" type="radio" id="radio4" value="no"  <? if ($saco[aprobado]=="no") { ?> checked="checked" <? } ?>  />
                A confirmar</td>
              </tr>
               <? if ($saco[estado]!="finalizado") { ?>
               <tr>
                <td>&nbsp;</td>
                <td valign="middle"><input type="submit" name="agregar" id="agregar" value="  Actualizar  " /></td>
              </tr>
              <? } ?>
            </table>
          </form>
        </div>
      <br />
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
