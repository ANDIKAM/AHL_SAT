<? include("logadmin.php"); 
	
if ($logadmin) {



$fecha = time ();
$fecha=$fecha-8100; // Con esto lo pongo en cero

$ano=date ( "Y" , $fecha );
$mes=date ( "m" , $fecha );
$dia=date ( "d" , $fecha );
$hora=date ( "H" , $fecha ); 
$minuto=date ( "i" , $fecha );
$fechadehoy="$ano-$mes-$dia $hora:$minuto:00";


if ($sucursal=="Arrecife") { $tabla_facturas="facturas_arrecife"; }
if ($sucursal=="Tias") { $tabla_facturas="facturas_tias"; }
if ($sucursal=="Centro") { $tabla_facturas="facturas_centro"; } 

$totalventa=0;
$bcom=mysql_query("select * from ventas where tienda='$sucursal' ");

$cnt=mysql_num_rows($bcom);




while ($scom=mysql_fetch_array($bcom)) { 
		$totalventa=$totalventa+$scom[total]; 
		}
														
if ($vernuevocliente=="si")  { $ingreso=mysql_query("insert into clientes (nombre, apellido, email1, email2, direccion, cp, telefono, movil1, movil2, extras, dni) values ('$nombre', '$apellido', '$email1', '$email2', '$direccion', '$cp', '$telefono', '$movil1', '$movil2', '$extras', '$dni')");  
												$b=mysql_query("select * from clientes order by id_clientes desc"); $s=mysql_fetch_array($b);
												$cliente=$s[0]; 
												 }
EnviarWhats($movil1,$ahlparametros["em_whtsppbnvnd"]["descripcion"]);
EnviarWhats($movil2,$ahlparametros["em_whtsppbnvnd"]["descripcion"]);



$ingresofactura=mysql_query("insert into $tabla_facturas (fecha, cliente, total, tipo, caso, aprobado, tienda, venta, forma, clase) values ('$fechadehoy', '$cliente', '$totalventa', '', '', 'si', '$sucursal', 'si', '$forma', '$clase_venta')");
												    
$bf=mysql_query("select * from $tabla_facturas order by id_facturas desc");
$sf=mysql_fetch_array($bf);
												
													
$bcom=mysql_query("select * from ventas where tienda='$sucursal' ");
while ($scom=mysql_fetch_array($bcom)) { 
		if ($sucursal=="Arrecife") { $tabla_art="ventas_art_arrecife"; }
		if ($sucursal=="Tias") { $tabla_art="ventas_art_tias"; }
		if ($sucursal=="Centro") { $tabla_art="ventas_art_centro"; } 
		
		$ingreso=mysql_query("insert into $tabla_art (unidades, concepto, precio, total, id) values ('$scom[unidades]','$scom[concepto]','$scom[precio]','$scom[total]', '$sf[0]')");
		}
		
		$cancelo=mysql_query("delete from ventas where tienda='$sucursal'"); 
																
		//$actualizototal=mysql_query("update $tabla_facturas set total='$totalventa' where id_facturas='$sf[0]'");
													
		?><script>location.href='facturas_imprimir.php?id=<? echo $sf[0]; ?>&cqm=136187236452&cl=<? echo $cliente; ?>'</script><?




 } else { ?><script>location.href='login.php'</script><? } ?>
