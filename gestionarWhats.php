<?
if(isset($_REQUEST["numero"]) && isset($_REQUEST["mensaje"])){
    $numero=$_REQUEST["numero"];
    $mensaje=$_REQUEST["mensaje"];
    if($numero!="" && $mensaje!=""){
        
        $xml = file_get_contents($_SERVER["DOCUMENT_ROOT"].'/whatsapp/whatsappconf.xml');
        $DOM = new SimpleXMLElement($xml);
        $codpais = (strval($DOM->WhatsappConfs->WhatsappConf[0]->codpais));
        $msgID = "app-".time();
        mysql_query("INSERT INTO GESTOR_WHATS_MSG (MSGID,TONUMBER,FECHA,MSG,TIPO_W,TIPO_S,SUBTIPO_S,ENVIADO) VALUES ('$msgID',$numero,".time().",'$mensaje',6,3,0,0)");
    }
}
?>
