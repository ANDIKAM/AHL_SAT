<? 
//$prefijo="/AHL";
$prefijo="";
// Emular register_globals on   
if (!ini_get('register_globals')) {   
    $superglobales = array($_SERVER, $_ENV,   
        $_FILES, $_COOKIE, $_POST, $_GET);   
    if (isset($_SESSION)) {   
        array_unshift($superglobales, $_SESSION);   
    }   
    foreach ($superglobales as $superglobal) {   
        extract($superglobal, EXTR_SKIP);   
    }   
}  
if($forma=="Otro"){
    $forma2= str_replace('\n', ' - ', $forma2);
    $forma2= str_replace('\r', ' - ', $forma2);
    $forma=$forma2!=""?$forma2:"Otro";
}
$host_db="localhost";
$usuario_db="dbu_64.ahlinform";
$pass_db="R7prE67Hespu";
$base_db="ahlinformatica_sat";

$link=mysql_connect($host_db,$usuario_db,$pass_db);
mysql_select_db($base_db);

$logadmin = false; 

if(isset($_COOKIE["satNick"]) && isset($_COOKIE["satPass"])) 
{ 

if(($_COOKIE["satPass"]=="tiasahl2012" or $_COOKIE["satPass"]=="arrecifeahl2012" or $_COOKIE["satPass"]=="centroahl2012" or $_COOKIE["satPass"]=="ahlnews2012") and $_COOKIE["satNick"]=="admin")
{ 

if ($_COOKIE["satPass"]=="tiasahl2012") { $sucursal="Tias"; }
if ($_COOKIE["satPass"]=="arrecifeahl2012") { $sucursal="Arrecife"; }
if ($_COOKIE["satPass"]=="centroahl2012") { $sucursal="Centro"; }

$logadmin = true; 

} 
else 
{ 

} 
mysql_free_result($result); 
} 

//--- OBTENER PARÁMETROS
$busco=mysql_query("select * from ahl_parametros");
$ahlparametros = array();
while ($saco=mysql_fetch_array($busco)) {
    $clave=$saco["codigo"];
    $ahlparametros[$clave]=$saco;
}
//---
function EnviarWhats($numero,$mensaje){
    if($numero!="" && $mensaje!=""){
        $xml = file_get_contents($_SERVER["DOCUMENT_ROOT"].$prefijo.'/whatsapp/whatsappconf.xml');
        $DOM = new SimpleXMLElement($xml);
        $codpais = (strval($DOM->WhatsappConfs->WhatsappConf[0]->codpais));
        $msgID = "app-".strval(time()). rand (1,1000);
        mysql_query("INSERT INTO GESTOR_WHATS_MSG (MSGID,TONUMBER,FECHA,MSG,TIPO_W,TIPO_S,SUBTIPO_S,ENVIADO) VALUES ('$msgID',$numero,".time().",'$mensaje',6,3,0,0)");
    }
}

$url=$_SERVER['PHP_SELF'];
$laurl=substr($url,1,5);
if ($laurl=="index") { $sec="inicio"; } 
if ($laurl=="clien") { $sec="clientes"; }
if ($laurl=="venta") { $sec="ventas"; }
if ($laurl=="compu") { $sec="computadoras"; }
if ($laurl=="repmo") { $sec="repmoviles"; }
if ($laurl=="conso") { $sec="consolas"; }
if ($laurl=="factu") { $sec="facturas"; }
if ($laurl=="libmo") { $sec="libmoviles"; }
if ($laurl=="pendi") { $sec="pendientes"; }
if ($laurl=="whats") { $sec="whatsappconf"; }
if ($laurl=="empre") { $sec="empresas_news"; }
if ($laurl=="tinta") { $sec="tintas"; }
if (substr($url,1,21)=="empresas_mensajes.php") { $sec="plantillas";}
if (substr($url,1,18)=="empresas_lista.php") { $sec="empresas_listado";}
if (substr($url,1,19)=="empresas_editar.php") { $sec="empresas_listado";}
function limpiar($content)
{
		$content = str_replace('&Atilde;&sup3;', "ó", $content);
		
		
		//$content = str_replace('"', "'", $content);
		
		 
	return $content;
}
?>
