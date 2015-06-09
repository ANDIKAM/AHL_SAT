<? 

 include("logadmin.php"); 
	$buscado=$cliente;
	
	if ($sucursal=="Arrecife") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Tias") { $tabla_empresas=" empresas_integradas "; }
if ($sucursal=="Centro") { $tabla_empresas=" empresas_integradas "; } 
	
	
	$filtro=" where ( nombre like '%$buscado%' or email like '%$buscado%' or cif like '%$buscado%' or calle like '%$buscado%' or codigopostal like '%$buscado%' ) ";
	
if ($logadmin) {  
?><select name="cliente" id="cliente">
                  <? $busco=mysql_query("select * from $tabla_empresas $filtro order by nombre");
				  	while ($saco=mysql_fetch_array($busco)) {  ?>
                  <option value="<? echo $saco[0]; ?>"><? echo "$saco[nombre] - $saco[email1]"; ?></option>
                  <? } ?>
                  </select><input type="hidden" name="nocache" id="nocache" value="<? echo rand(111111,999999);?>" /><?   }   ?>