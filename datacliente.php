<?
include("logadmin.php"); 
header("Content-Type: text/html;charset=utf-8");
$filtro; $orden;
if ($or=="nom") { $orden=" order by apellido, nombre";  } 
if ($or=="fec") { $orden=" order by id_clientes desc";  } 
if ($buscar) { $filtro=" where ( nombre like '%$buscado%' or apellido like '%$buscado%' or email1 like '%$buscado%' or email2 like '%$buscado%' or direccion like '%$buscado%' or cp like '%$buscado%' or telefono like '%$buscado%' or movil1 like '%$buscado%' or movil2 like '%$buscado%' or extras like '%$buscado%' or dni like '%$buscado%' ) "; } 
$busco=mysql_query("select * from clientes $filtro $orden"); 
$dc_counter=0;

echo "{\"data\":[";
do{ 
if($dc_counter!=0){
    echo ",";
}
$dc_counter++;
$link=" style='cursor:pointer; border-bottom:1px dotted #666;' onclick=\"location.href='clientes_editar.php?id=$saco[0]'\"";
echo "[";
echo "\"$saco[apellido] $saco[nombre]\",";
echo "\"$saco[email1]\",";
echo "\"$saco[movil1]\",";
echo "\"$saco[mail_bienvenida]\",";
echo "\"$saco[mail_solicitud]\",";
echo "\"<a href=\\\"clientes_editar.php?id=$saco[0]\\\" >Editar<\/a>\",";
echo "\"<a href=\\\"Javascript:void(0);\\\" onClick=\\\"confirmar_enviar_cliente('$saco','$saco[apellido] $saco[nombre]');\\\">Enviar<\/a>\",";
echo "\"<a href=\\\"Javascript:void(0);\\\" onClick=\\\"confirmar_eliminar_cliente('$saco[0]','$saco[apellido] $saco[nombre]');\\\">Eliminar<\/a>\"";
echo "]";
}while ($saco=mysql_fetch_array($busco));
echo "]}";
?>