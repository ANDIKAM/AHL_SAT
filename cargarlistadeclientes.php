<? 

 include("logadmin.php"); 
	$buscado=$cliente;
	$filtro=" where ( nombre like '%$buscado%' or apellido like '%$buscado%' or email1 like '%$buscado%' or email2 like '%$buscado%' or direccion like '%$buscado%' or cp like '%$buscado%' or telefono like '%$buscado%' or movil1 like '%$buscado%' or movil2 like '%$buscado%' or extras like '%$buscado%' or dni like '%$buscado%' ) ";
	
if ($logadmin) {  
?><select name="cliente" id="cliente">
                  <? $busco=mysql_query("select * from clientes $filtro order by apellido");
				  	while ($saco=mysql_fetch_array($busco)) {  ?>
                  <option value="<? echo $saco[0]; ?>"><? echo "$saco[apellido], $saco[nombre] - $saco[email1]"; ?></option>
                  <? } ?>
                  </select><input type="hidden" name="nocache" id="nocache" value="<? echo rand(111111,999999);?>" /><?   }   ?>