<? include("logadmin.php"); 
	
if ($logadmin) {  
				
?><select id="nombre_modelo" name="nombre_modelo" onchange="cargar_tintas(this.value);" style="margin-bottom:20px;" >
<option>Seleccione modelo...</option><?
$busco=mysql_query("select * from impresora where marca='$marca' ");
while ($saco=mysql_fetch_array($busco)) {
?><option><? echo $saco[modelo]; ?></option><?	
}
?></select>
                     
               
               
<? } ?>