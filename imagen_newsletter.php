<? 

$host_db="localhost";
$usuario_db="dbu_64.ahlinformatica";
$pass_db="R7prE67Hespu";
$base_db="ahlinformatica_sat";

$link=mysql_connect($host_db,$usuario_db,$pass_db);
mysql_select_db($base_db);

$busco=mysql_query("select * from news_confirmar where newsletter='$news' and destinatario='$usr'");
if ($saco=mysql_fetch_array($busco)) { 	$aperturas_total=$saco[aperturas]+1;
										$actualizo=mysql_query("update news_confirmar set aperturas='$aperturas_total' where id_news_confirmar='$saco[0]'");
										} else {
												$ingreso=mysql_query("insert into news_confirmar (newsletter, destinatario, aperturas) values ('$news','$usr','1')");
												}
$filename = "http://sat.ahlinformatica.com/news_empresas/$file";
             header('Content-type: image/jpeg');
             header('Content-transfer-encoding: binary');
             header('Content-length: '.filesize($filename));
             readfile($filename); 
 ?>