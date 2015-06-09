<?php
header("Content-Type: text/html;charset=utf-8");
/**
 * Description of whatsproperties
 *
 * @author ANDIKAM SAS
 */
class WhatsProperties {
    private $userphone;     //Mobile Phone prefixed with country code so for Spain it will be 34xxxxxxxx
    private $password;      //Associated password to the user's Mobile Phone
    private $application;   //Name of the application that sends the message
    private $debug;         //Debug on or off, false by default.
    private $codpais;         //Debug on or off, false by default.
    private $prefix="";
    /**
     * Default Class Constructor
     *
     * @return void
     */
    function __construct() {
        $xml = file_get_contents($_SERVER["DOCUMENT_ROOT"].$this->prefix.'/whatsapp/whatsappconf.xml');
        $DOM = new SimpleXMLElement($xml);
        $userphone = (strval($DOM->WhatsappConfs->WhatsappConf[0]->userphone));
        $password = strval($DOM->WhatsappConfs->WhatsappConf[0]->password);
        $application = strval($DOM->WhatsappConfs->WhatsappConf[0]->application);
        $debug = strval($DOM->WhatsappConfs->WhatsappConf[0]->debug)=='false'?false:true;
        $codpais = (strval($DOM->WhatsappConfs->WhatsappConf[0]->codpais));
        $this->userphone = $userphone;
        $this->password = $password;
        $this->application = $application;
        $this->debug = $debug;
        $this->codpais=$codpais;
    }
    
    public function getUserphone() {
        return $this->codpais.$this->userphone;
    }

    public function getPassword() {
        return $this->password;
    }
    
    public function getCodPais() {
        return $this->codpais;
    }

    public function getApplication() {
        return $this->application;
    }

    public function getDebug() {
        return $this->debug;
    }
    public function msg($msg){
        $mostrar=0;
        if($mostrar=1){
            echo $msg."<br>";
        }
    }
    public function MensajeRespuesta($mensaje,$movil=array(),$msgID){
        $host_db="localhost";
        $usuario_db="dbu_64.ahlinform";
        $pass_db="R7prE67Hespu";
        $base_db="ahlinformatica_sat";
        $link=mysql_connect($host_db,$usuario_db,$pass_db);
        mysql_select_db($base_db);
        $busco=mysql_query("select * from ahl_parametros");
        $ahlparametros = array();
        while ($saco=mysql_fetch_array($busco)) {
            $clave=$saco["codigo"];
            $ahlparametros[$clave]=$saco;
        }
        $mensaje = trim(strtoupper($mensaje));
        $messageDefault = "Gracias por escribir a ".$this->application.", esta es ".
                       "una cuenta de WhatsApp no monitoreada, por favor comuniquese ".
                       "con nosotros por nuestros teléfonos o página web donde con ".
                       "gusto le atenderemos.";
        if($mensaje=="BAJA" || $mensaje=="BAJAS"){
            foreach ($movil as $numero) {
                if(strlen($numero)>=10){                    
                    $numero=  substr($numero, 2);
                }
                $val=mysql_query("update clientes set whatsapp='NO' where movil1 like '%$numero' or movil2 like '%$numero'");
                if($val===true){
                    $val="true";
                }else{
                    $val=mysql_error();
                }
            }
            mysql_query("INSERT INTO GESTOR_WHATS_MSG (MSGID,TONUMBER,FECHA,MSG,TIPO_W,TIPO_S,SUBTIPO_S,ENVIADO) VALUES ('$msgID',$movil[0],".time().",'Se ha dado de baja en nuestro servicio de mensajes por WHATSAPP - Gracias por confiar en AHL INFORMÁTICA. Le recordamos que para volver a inscribirse a nuestro servicio de notificaciones y ofertas solo debe enviar un mensaje de Whatsapp a este número con la palabra ALTA',6,3,0,0)");
            return;
            //return array(0 => "Se ha dado de baja en nuestro servicio de mensajes por WHATSAPP - Gracias por confiar en AHL INFORMÁTICA. Le recordamos que para volver a inscribirse a nuestro servicio de notificaciones y ofertas solo debe enviar un mensaje de Whatsapp a este número con la palabra 'ALTA'",1 => "",2 => "");
        }
        if($mensaje=="ALTA" || $mensaje=="ALTAS"){
            foreach ($movil as $numero) {
                if(strlen($numero)>=10){                    
                    $numero=  substr($numero, 2);
                }
                mysql_query("update clientes set whatsapp='SI' where movil1 like '%$numero' or movil2 like '%$numero'");
            }
            mysql_query("INSERT INTO GESTOR_WHATS_MSG (MSGID,TONUMBER,FECHA,MSG,TIPO_W,TIPO_S,SUBTIPO_S,ENVIADO) VALUES ('$msgID',$movil[0],".time().",'Se ha dado de alta en nuestro servicio de mensajes por WHATSAPP - Gracias por confiar en AHL INFORMÁTICA. Le recordamos que para no recibir más nuestros mensajes de notificaciones y ofertas solo debe enviar un mensaje de Whatsapp a este número con la palabra BAJA',6,4,0,0)");
            return;
            //return array(0 => "Se ha dado de alta en nuestro servicio de mensajes por WHATSAPP - Gracias por confiar en AHL INFORMÁTICA. Le recordamos que para no recibir más nuestros mensajes de notificaciones y ofertas solo debe enviar un mensaje de Whatsapp a este número con la palabra 'BAJA'",1 => "",2 => "");
        }
        foreach ($movil as $numero) {
                if(strlen($numero)>=10){                    
                    $numero=  substr($numero, 2);
                }
                $busco_N=mysql_query("select * from clientes where movil1 LIKE '%$numero' OR movil2 LIKE '%$numero'");
                $saco_N=mysql_fetch_array($busco_N);
                if($saco_N["whatsapp"]=='NO'){
                    //return array(0 => "Usted con anterioridad se ha dado de baja en nuestro servicio de mensajes por WHATSAPP - Gracias por confiar en AHL INFORMÁTICA. Le recordamos que para volver a inscribirse a nuestro servicio de notificaciones y ofertas solo debe enviar un mensaje de Whatsapp a este número con la palabra 'ALTA'",1 => "",2 => "");
                    mysql_query("INSERT INTO GESTOR_WHATS_MSG (MSGID,TONUMBER,FECHA,MSG,TIPO_W,TIPO_S,SUBTIPO_S,ENVIADO) VALUES ('$msgID',$movil[0],".time().",'Usted con anterioridad se ha dado de baja en nuestro servicio de mensajes por WHATSAPP - Gracias por confiar en AHL INFORMÁTICA. Le recordamos que para volver a inscribirse a nuestro servicio de notificaciones y ofertas solo debe enviar un mensaje de Whatsapp a este número con la palabra ALTA',6,5,0,0)");
                    return;
                }
        }
        
        if($mensaje=="OFERTA" || $mensaje=="OFERTAS" || $mensaje=="oferta" || $mensaje=="ofertas" || $mensaje=="Oferta"){
            $Text = ($ahlparametros["em_ofrtdr_texto"]["descripcion"]=="1"?$ahlparametros["em_ofrtdr"]["descripcion"]:""). ". Para no recibir más ofertas, responda este mensaje con la palabra BAJA";
            $Img = $ahlparametros["em_ofrtdr_imagen"]["descripcion"]=="1"?$ahlparametros["em_ofrtdr_imagenurl"]["descripcion"]:"";
            $Aud = $ahlparametros["em_ofrtdr_audio"]["descripcion"]=="1"?$ahlparametros["em_ofrtdr_audiourl"]["descripcion"]:"";
            mysql_query("INSERT INTO GESTOR_WHATS_MSG (MSGID,TONUMBER,FECHA,MSG,TIPO_W,TIPO_S,SUBTIPO_S,ENVIADO) VALUES ('".$msgID."-1',$movil[0],".time().",'$Text',6,1,1,".($Text==""?"1":"0").")");
            mysql_query("INSERT INTO GESTOR_WHATS_MSG (MSGID,TONUMBER,FECHA,MSG,TIPO_W,TIPO_S,SUBTIPO_S,ENVIADO) VALUES ('".$msgID."-2',$movil[0],".time().",'$Img',2,1,2,".($Img==""?"1":"0").")");
            mysql_query("INSERT INTO GESTOR_WHATS_MSG (MSGID,TONUMBER,FECHA,MSG,TIPO_W,TIPO_S,SUBTIPO_S,ENVIADO) VALUES ('".$msgID."-3',$movil[0],".time().",'$Aud',3,1,3,".($Aud==""?"1":"0").")");
            return;
            //return array($Text,$Img,$Aud);
        }
        
        $cantidad=split(" ", $mensaje);
        if(count($cantidad)==2 && (strpos($cantidad[0], 'RP') !== false || strpos($cantidad[0], 'RM') !== false || strpos($cantidad[0], 'LM') !== false || strpos($cantidad[0], 'RC') !== false)){
            $orden=$cantidad[0];
            $complemento=substr($cantidad[0],2,1);
            
            $TablaPortatil="";
            $TablaMoviles="";
            $TablaConsolas="";
            $TablaLiberacion="";
            if($complemento=='A'){
                $TablaPortatil=" computadoras_arrecife ";
                $TablaMoviles=" repmovil_arrecife ";
                $TablaConsolas=" consolas_arrecife ";
                $TablaLiberacion=" libmovil_arrecife ";
            }
            if($complemento=='T'){
                $TablaPortatil=" computadoras_tias ";
                $TablaMoviles=" repmovil_tias ";
                $TablaConsolas=" consolas_tias ";
                $TablaLiberacion=" libmovil_tias ";
            }
            if($complemento=='C'){
                $TablaPortatil=" computadoras_centro ";
                $TablaMoviles=" repmovil_centro ";
                $TablaConsolas=" consolas_centro ";
                $TablaLiberacion=" libmovil_centro ";
            }
            
            if(strpos($cantidad[0], 'RP')!==false){
                //Reparación de portatiles
                $idbusqueda=str_replace('RP'.$complemento,'', $cantidad[0]);
                if(is_numeric($idbusqueda)){
                    $busco=mysql_query("select * from $TablaPortatil where id_computadoras=$idbusqueda");
                    $saco1=mysql_fetch_array($busco);
                    $busco=mysql_query("select * from clientes where dni='$cantidad[1]'");
                    $saco2=mysql_fetch_array($busco);
                    if(count($saco1)>=1 && count($saco2)>=1 and $saco1["cliente"]==$saco2["id_clientes"]){
                        $mensaje="$orden: La reparación con número de orden: $orden se encuentra en estado: $saco1[estado]".(trim($saco1["trabajo"])!=''?", y se le ha realizado el siguiente trabajo: ".trim($saco1["trabajo"]):'');
                    }else{
                        $mensaje="La combinación de DNI: $cantidad[1] y Número de orden: $orden no ha traido ningun resultado.";
                    }
                }else
                {
                    $mensaje="El número de orden $orden de reparacion de esta mal formado, por favor reviselo e intente de nuevo.";
                }
                mysql_query("INSERT INTO GESTOR_WHATS_MSG (MSGID,TONUMBER,FECHA,MSG,TIPO_W,TIPO_S,SUBTIPO_S,ENVIADO) VALUES ('$msgID',$movil[0],".time().",'$mensaje',6,2,0,0)");
                return;
                //return array(0 => $mensaje,1 => "",2 => "");
            }
            if(strpos($cantidad[0], 'RM')!==false){
                //Reparación de Moviles
                $idbusqueda=str_replace('RM'.$complemento,'', $cantidad[0]);
                if(is_numeric($idbusqueda)){
                    $idbusqueda=  intval($idbusqueda);
                    $busco=mysql_query("select * from $TablaMoviles where id_repmovil=$idbusqueda");
                    $saco1=mysql_fetch_array($busco);
                    $busco=mysql_query("select * from clientes where dni='$cantidad[1]'");
                    $saco2=mysql_fetch_array($busco);
                    if(count($saco1)>=1 && count($saco2)>=1 and $saco1["cliente"]==$saco2["id_clientes"]){
                        $mensaje="La reparación con número de orden: $orden se encuentra en estado: $saco1[estado]".(trim($saco1["trabajo"])!=''?", y se le ha realizado el siguiente trabajo: ".trim($saco1["trabajo"]):'');
                    }else{
                        $mensaje="La combinación de DNI: $cantidad[1] y Número de orden: $orden no ha traido ningun resultado.";
                    }
                }else
                {
                    $mensaje="El número de orden $orden de reparacion de esta mal formado, por favor reviselo e intente de nuevo.";
                }
                mysql_query("INSERT INTO GESTOR_WHATS_MSG (MSGID,TONUMBER,FECHA,MSG,TIPO_W,TIPO_S,SUBTIPO_S,ENVIADO) VALUES ('$msgID',$movil[0],".time().",'$mensaje',6,2,0,0)");
                return;
                //return array(0 => $mensaje,1 => "",2 => "");
            }
            $tesval=strpos($cantidad[0], 'RC');
            if(strpos($cantidad[0], 'RC')!==false){
                //Reparación de consolas
                $idbusqueda=str_replace('RC'.$complemento,'', $cantidad[0]);
                if(is_numeric($idbusqueda)){
                    $idbusqueda=  intval($idbusqueda);
                    $busco=mysql_query("select * from $TablaConsolas where id_consolas=$idbusqueda");
                    $saco1=mysql_fetch_array($busco);
                    $busco=mysql_query("select * from clientes where dni='$cantidad[1]'");
                    $saco2=mysql_fetch_array($busco);
                    if(count($saco1)>=1 && count($saco2)>=1 and $saco1["cliente"]==$saco2["id_clientes"]){
                        $mensaje="La reparación con número de orden: $orden se encuentra en estado: $saco1[estado]".(trim($saco1["trabajo"])!=''?", y se le ha realizado el siguiente trabajo: ".trim($saco1["trabajo"]):'');
                    }else{
                        $mensaje="La combinación de DNI: $cantidad[1] y Número de orden: $orden no ha traido ningun resultado.";
                    }
                }else
                {
                    $mensaje="El número de orden $orden de reparacion de esta mal formado, por favor reviselo e intente de nuevo.";
                }
                mysql_query("INSERT INTO GESTOR_WHATS_MSG (MSGID,TONUMBER,FECHA,MSG,TIPO_W,TIPO_S,SUBTIPO_S,ENVIADO) VALUES ('$msgID',$movil[0],".time().",'$mensaje',6,2,0,0)");
                return;
                //return array(0 => $mensaje,1 => "",2 => "");
            } 
            if(strpos($cantidad[0], 'LM')!==false){
                //Liberación de móviles
                $idbusqueda=str_replace('LM'.$complemento,'', $cantidad[0]);
                if(is_numeric($idbusqueda)){
                    $idbusqueda=  intval($idbusqueda);
                    $busco=mysql_query("select * from $TablaLiberacion where id_libmovil=$idbusqueda");
                    $saco1=mysql_fetch_array($busco);
                    $busco=mysql_query("select * from clientes where dni='$cantidad[1]'");
                    $saco2=mysql_fetch_array($busco);
                    if(count($saco1)>=1 && count($saco2)>=1 and $saco1["cliente"]==$saco2["id_clientes"]){
                        $mensaje="La liberación de móvil con número de orden: $orden se encuentra en estado: $saco1[estado]".(trim($saco1["trabajo"])!=''?", y se le ha realizado el siguiente trabajo: ".trim($saco1["trabajo"]):'');
                    }else{
                        $mensaje="La combinación de DNI: $cantidad[1] y Número de orden: $orden no ha traido ningun resultado.";
                    }
                }else
                {
                    $mensaje="El número de orden $orden de reparacion de esta mal formado, por favor reviselo e intente de nuevo.";
                }
                mysql_query("INSERT INTO GESTOR_WHATS_MSG (MSGID,TONUMBER,FECHA,MSG,TIPO_W,TIPO_S,SUBTIPO_S,ENVIADO) VALUES ('$msgID',$movil[0],".time().",'$mensaje',6,2,0,0)");
                return;
                //return array(0 => $mensaje,1 => "",2 => "");
            }
        }
        mysql_query("INSERT INTO GESTOR_WHATS_MSG (MSGID,TONUMBER,FECHA,MSG,TIPO_W,TIPO_S,SUBTIPO_S,ENVIADO) VALUES ('$msgID',$movil[0],".time().",'$messageDefault',6,6,0,0)");
        return;
        //return array(0 => ,1 => "",2 => "");
        
    }

}
