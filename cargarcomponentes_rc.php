<? include("logadmin.php"); 
	
if ($logadmin) {  
				$total=$cant*$precio;
				
				if ($sucursal=="Arrecife") { $tabla="componentes_arrecife"; }
			    if ($sucursal=="Tias") { $tabla="componentes_tias"; } 
				if ($sucursal=="Centro") { $tabla="componentes_centro"; } 
$ingreso=mysql_query("insert into $tabla (clase, id, unidades, descripcion, precio, total) values ('$clase','$id','$cant','$desc','$precio','$total')");


$bcom=mysql_query("select * from $tabla where clase='rc' and id='$id'");
					 ?>
                     
                <table width="100%" border="0" cellpadding="0" cellspacing="3" style="border:1px dotted #333">
                <tr><td width="40" height="25" bgcolor="#FFFFCC"><strong>Cant.</strong></td>
                <td bgcolor="#FFFFCC"><strong>Descripción</strong></td><td width="80" bgcolor="#FFFFCC"><strong>Precio</strong></td>
                <td width="38" bgcolor="#FFFFCC"><strong>SubTotal</strong></td>
                <td width="20" bgcolor="#FFFFCC">&nbsp;</td>
                </tr><?
										while ($scom=mysql_fetch_array($bcom)) { $totalcomp=$totalcomp+$scom[total];
																				?><tr><td><? echo $scom[unidades]; ?></td><td><? echo $scom[descripcion]; ?></td><td nowrap="nowrap">&#8364; <? echo $scom[precio]; ?></td>
                <td align="right" nowrap="nowrap">&#8364; <? echo $scom[total]; ?></td>
                  <td align="center"><a href="componentes_eliminar.php?clase=rm&id=<? echo $id; ?>&idcom=<? echo $scom[0]; ?>">X</a></td>
                  <?
																				}
										?><tr><td>&nbsp;</td><td>&nbsp;</td>
                <td align="right"><strong>Total &nbsp;</strong></td>
                <td align="right" nowrap="nowrap"><strong>&#8364; <? printf("%'11.2f",$totalcomp);  ?></strong></td>
                <td align="right">&nbsp;</td>
                  </tr>
                </table>
<? } ?>