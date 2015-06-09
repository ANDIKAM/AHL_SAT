<?php
/**
 * Envio de WhatsApp con el apoyo de la Api Oficial
 *
 * @author ANDIKAM SAS
 * Marzo 2015
 * 
 */
require_once 'whatsprot.class.php';
require_once 'whatsproperties.php'; 

class WhatsSend {
    private $user;
    private $sendphone;       // Mobile Phone prefixed with country code so for Spain it will be 34xxxxxxxx
    private $countrycode;     // Country code for send messages       
    private $pass;            // Associated password to the user's Mobile Phone
    private $appl;            // Name of the application that sends the message
    private $debug;           // Debug on or off, false by default.
    private $wa;              // An instance of the WhatsApi.
    private $connected;       // Status of WhatsApi instance
    private $messages = array(); // $Messages received

    /**
     * Default Class Constructor
     * @return void
     */
    function __construct() {
        $this->user = new WhatsProperties();
        $this->sendphone = $this->user->getUserphone();
        $this->pass = $this->user->getPassword();
        $this->appl = $this->user->getApplication();
        $this->debug = $this->user->getDebug();
        $this->countrycode = $this->user->getCodPais();
       
        $this->wa = new WhatsProt($this->sendphone,$this->appl,false);
        $this->wa->eventManager()->bind('onGetMessage', array($this, 'receivedMessage2'));
        $this->wa->eventManager()->bind('onConnect', array($this, 'connected'));
    }
    
    /**
     * Connect to Whatsapp.
     *
     * Create a connection to the whatsapp servers using the supplied password.
     *
     * @return boolean
     */
    private function connectToWhatsApp()
    {
        if (isset($this->wa)) {
            $this->wa->connect();
            $this->wa->loginWithPassword($this->pass);
            return true;
        }
        return false;
    }
    
    /**
    * Sets flag when there is a connection with WhatsAPP servers.
    *
    * @return void
    */
    public function connected()
    {
        $this->connected = true;
    }
    
    /**
     * Sends a message to a contact.
     *
     * Depending on the type sends a message/image/audio/video/location message to a contact.
     *
     * @param $target array receiver phone with country code so for Spain it will be 34xxxxxxxx
     * @param $type Type of message to send:
     *         1. Text
     *         2. Image url/uri allowed extension jpg, jpeg, gif, png
     *         3. Audio url/uri allowed extension 3gp, caf, wav, mp3, wma, ogg, aif, aac, m4a
     *         4. Video url/uri allowed extension mp4, mov
     *         5. location
     * @param $message Value according to $type
     * @param $longitude Value for $type location
     * @param $latitude Value for $type location
     * 
     * @return void
     */
    public function sendMessage($target,$type,$message,$longitude = null,$latitude = null)
    {
        if(!$this->connected){
            $this->connectToWhatsApp();
        }
        if($this->connected){
            foreach ($target as $to) {
            if (trim($to) !== '' && is_numeric($to)) {
                /*if($type != 6){}*/
                if(strlen($to)<=10){
                    $to = '34'.$to;
                }
                /**/
                switch ($type){
                    case 1: 
                        $this->wa->sendMessageComposing($to);
                        $this->wa->sendMessage($to, $message);
                    break;
                    case 2:
                        $this->wa->sendMessageComposing($to);
                        $this->wa->sendMessageImage($to, $message);
                    break;
                    case 3: 
                        $this->wa->sendMessageComposing($to);
                        $this->wa->sendMessageAudio($to, $message);
                    break;
                    case 4:
                        $this->wa->sendMessageVideo($to, $message);
                    break;
                    case 5:
                        $this->wa->sendMessageLocation($to, $longitude, $latitude, $message, null);
                    break;
                    case 6:
                        $this->wa->sendMessageComposing($to);
                        $this->wa->sendMessage($to, $message);
                    break;
                    default: 
                        $this->wa->sendMessageComposing($to);
                        $this->wa->sendMessage($to, $message);
                    break;
                }
            }
            } //foreach
        }
    }
    
    /**
     * Process inbound text messages.
     *
     * If an inbound message is detected, this method will
     * store the details so that it can be shown to the user
     * at a suitable time.
     *
     * @return void
     */
    public function receivedMessage2($mynumber, $from, $id, $type, $time, $name, $body){
        $this->SendOfertasoReportes(array(str_replace("@s.whatsapp.net", "", $from)), $body,$id);
    }
    public function receivedMessage()
    {
        $counter=0;
        while($counter<25){
            $counter++;
            if(!$this->connected){
                $this->connectToWhatsApp();
            }
            if($this->connected){
                $this->wa->pollMessage();
            }
        }
        /*if(!$this->connected){
            $this->connectToWhatsApp();
        }
        if($this->connected){
            $this->wa->pollMessage();
            //$this->wa->sendMessage(array("573142577446"), "hello");
            /*$msg = $this->wa->getMessages();
            $auxmsg = array();
            $contador=0;
            foreach ($msg as $m) {
                //print_r($m);
                $contador++;
                $id = $m->getAttribute('id');
                $from = str_replace("@s.whatsapp.net", "", $m->getAttribute('from'));
                $time = date("m/d/Y H:i", $m->getAttribute('t'));
                $name = $m->getAttribute('notify')!=null ? "(unknown)" : $m->getAttribute('notify');
                $type = $m->getAttribute('type');
                foreach ($m->getChildren() as $child) {
                    $body = "";
                    $media = "";
                    if(strcmp($child->getTag(), "body") == 0){
                        $body = $child->getData();
                    }else if ((strcmp($child->getTag(), "media") == 0)){ 
                        $media = $child->getData();
                    }
                }
                if (!empty($body)) {
                    $auxmsg[] = array ("id" => $id,"from"=> $from,"message"=>$body,"name"=>$name,"type" => $type,"time" => $time);
					//print_r($auxmsg);
                } else if(!empty($media)){
                    //recibir imagen
                }
                
            }*/
        //}
        /*if(count($auxmsg) > 0){
            for($i=0;$i<count($auxmsg);$i++){
                $this->SendOfertasoReportes(array($auxmsg[$i]["from"]), $auxmsg[$i]["message"],$auxmsg[$i]["id"]);
            }
        }*/
    }
    
    public function SendOfertasoReportes($numero,$mensaje,$msgID){
        $this->user->MensajeRespuesta($mensaje,$numero,$msgID);
        /*if(count($msg)>=1){
            if($msg[0]!=""){//Enviar TEXTO
                $this->sendMessage($numero, 6, $msg[0]);
            }
            if($msg[1]!=""){//Enviar Imagen
                $this->sendMessage($numero, 2, $msg[1]);
                
            }
            if($msg[2]!=""){//Enviar Audio
                $this->sendMessage($numero, 3, $msg[2]);
                
            }
        }*/
    }
    
     /**
     * Cleanly disconnect from Whatsapp.
     *
     * @return void
     */
    public function disconnect()
    {
        if (isset($this->wa) && $this->connected) {
            $this->wa->disconnect();
        }
    }

    public function getMessages() {
        $ret = $this->messages;
        $this->messages = array();
        return $ret;
    }


}
