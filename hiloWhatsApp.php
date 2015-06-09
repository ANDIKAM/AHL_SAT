<? 
include_once "whatsapp/whatssend.class.php";
class hiloWhatsApp{
    private $hw_prefijo='';
    private $hw_enproceso=false;
    private $counter=0;
    private $hw_WhatsApp=null;
    public function hiloWhatsApp($ObjWhatsApp=null){
        $this->hw_WhatsApp=$ObjWhatsApp;
    }
    public function Run(){
        if(is_null($this->hw_WhatsApp))
        {$hw_WhatsApp = new WhatsSend();}
        //-----------------------
            $this->counter++;
            $hw_WhatsApp->receivedMessage();
            return;     
    }
}
$hilo = new hiloWhatsApp();
$hilo->Run();
?>
