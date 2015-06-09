<? 
include_once "whatsapp/whatssend.class.php";
class hiloWhatsAppSend{
    private $hw_prefijo='';
    private $hw_enproceso=false;
    private $counter=0;
    private $hw_WhatsApp=null;
    private $BD;
    public function hiloWhatsAppSend($ObjWhatsApp=null){
        $this->hw_WhatsApp=$ObjWhatsApp;
    }
    private function EnviarLista($Lista){
        foreach($Lista as $elemento){
            echo $elemento["TONUMBER"]."Enviando Mensaje".$elemento["MSG"]."<br>";
            $this->hw_WhatsApp->sendMessage(array($elemento["TONUMBER"]), $elemento["TIPO_W"], $elemento["MSG"]);
            $IDUpdt=$elemento["ID"];
            echo "UPDATE GESTOR_WHATS_MSG SET ENVIADO=1 WHERE ID = $IDUpdt"."<br><br>";
            mysql_query("UPDATE GESTOR_WHATS_MSG SET ENVIADO=1 WHERE ID = $IDUpdt",$this->BD);
        }
    }
    public function Run(){
        $host_db="localhost";
        $usuario_db="dbu_64.ahlinform";
        $pass_db="R7prE67Hespu";
        $base_db="ahlinformatica_sat";
        $link=mysql_connect($host_db,$usuario_db,$pass_db);
        $this->BD= $link;
        mysql_select_db($base_db);
        //Ejecución de Queries
        //Consulta para enviar las 5 consultas de mayor tiempo
        $ListaConsultas = mysql_query("SELECT * FROM GESTOR_WHATS_MSG WHERE TIPO_S = 2 AND ENVIADO = 0 ORDER BY FECHA ASC LIMIT 5");
        $ListaConsultasDAT=array();
        echo "Creando lista de Consulta Texto";
        while($saco=mysql_fetch_array($ListaConsultas)){
            $ListaConsultasDAT[]=$saco;
        }
        //Consulta para enviar las 5 ofertas más antiguas de tipo Texto
        $ListaOfertasTXT = mysql_query("SELECT * FROM GESTOR_WHATS_MSG WHERE TIPO_S = 1 AND ENVIADO = 0 AND SUBTIPO_S=1 ORDER BY FECHA ASC LIMIT 5");
        $ListaOfertasTXTDAT=array();
        echo "Creando lista de Ofertas TEXTO<br>";
        while($saco=mysql_fetch_array($ListaOfertasTXT)){
            $ListaOfertasTXTDAT[]=$saco;
        }
        //Consulta para enviar las 5 ofertas más antiguas de tipo Imagen
        $ListaOfertasIMG = mysql_query("SELECT * FROM GESTOR_WHATS_MSG WHERE TIPO_S = 1 AND ENVIADO = 0 AND SUBTIPO_S=2 ORDER BY FECHA ASC LIMIT 5");
        $ListaOfertasIMGDAT=array();
        echo "Creando lista de Ofertas IMAGEN<br>";
        while($saco=mysql_fetch_array($ListaOfertasIMG)){
            $ListaOfertasIMGDAT[]=$saco;
        }
        //Consulta para enviar las 5 ofertas más antiguas de tipo Audio
        $ListaOfertasAUD = mysql_query("SELECT * FROM GESTOR_WHATS_MSG WHERE TIPO_S = 1 AND ENVIADO = 0 AND SUBTIPO_S=3 ORDER BY FECHA ASC LIMIT 5");
        $ListaOfertasAUDDAT=array();
        echo "Creando lista de Ofertas AUDIO<br>";
        while($saco=mysql_fetch_array($ListaOfertasAUD)){
            $ListaOfertasAUDDAT[]=$saco;
        }
        //Consulta para enviar los 5 mensajes de ALTA más antiguos
        $ListaALTA = mysql_query("SELECT * FROM GESTOR_WHATS_MSG WHERE TIPO_S = 3 AND ENVIADO = 0 ORDER BY FECHA ASC LIMIT 5");
        $ListaALTADAT=array();
        echo "Creando lista de ALTA<br>";
        while($saco=mysql_fetch_array($ListaALTA)){
            $ListaALTADAT[]=$saco;
        }
        //Consulta para enviar los 5 mensajes de BAJA más antiguos
        $ListaBAJA = mysql_query("SELECT * FROM GESTOR_WHATS_MSG WHERE TIPO_S = 4 AND ENVIADO = 0 ORDER BY FECHA ASC LIMIT 5");
        $ListaBAJADAT=array();
        echo "Creando lista de Ofertas BAJA<br>";
        while($saco=mysql_fetch_array($ListaBAJA)){
            $ListaBAJADAT[]=$saco;
        }
        //Consulta para enviar los 5 mensajes de ERROR más antiguos
        $ListaERROR = mysql_query("SELECT * FROM GESTOR_WHATS_MSG WHERE TIPO_S = 5 AND ENVIADO = 0 ORDER BY FECHA ASC LIMIT 5");
        $ListaERRORDAT=array();
        echo "Creando lista de Ofertas ERROR<br>";
        while($saco=mysql_fetch_array($ListaERROR)){
            $ListaERRORDAT[]=$saco;
        }
        //Consulta para enviar los 5 mensajes de NO IDENTIFICADOS más antiguos
        $ListaNI = mysql_query("SELECT * FROM GESTOR_WHATS_MSG WHERE TIPO_S = 6 AND ENVIADO = 0 ORDER BY FECHA ASC LIMIT 5");
        $ListaNIDAT=array();
        echo "Creando lista de Ofertas NO IDENTIFICADOS<br>";
        while($saco=mysql_fetch_array($ListaNI)){
            $ListaNIDAT[]=$saco;
        }
        if((count($ListaConsultasDAT)+
           count($ListaOfertasTXTDAT)+
           count($ListaOfertasIMGDAT)+
           count($ListaOfertasAUDDAT)+
           count($ListaALTADAT)+
           count($ListaBAJADAT)+
           count($ListaERRORDAT)+
           count($ListaNIDAT))!=0){
           if(is_null($this->hw_WhatsApp)){
               $this->hw_WhatsApp = new WhatsSend();
               if(count($ListaConsultas)!=0){
                   echo "Enviando Listas Consulta<br>";
                   $this->EnviarLista($ListaConsultasDAT);
               }
               if(count($ListaOfertasTXT)!=0){
                   echo "Enviando Listas Ofertas TXT<br>";
                   $this->EnviarLista($ListaOfertasTXTDAT);
               }
               if(count($ListaALTA)!=0){
                   echo "Enviando Listas ALTA<br>";
                   $this->EnviarLista($ListaALTADAT);
               }
               if(count($ListaBAJA)!=0){
                   echo "Enviando Listas BAJA<br>";
                   $this->EnviarLista($ListaBAJADAT);
               }
               if(count($ListaERROR)!=0){
                   echo "Enviando Listas ERROR<br>";
                   $this->EnviarLista($ListaERRORDAT);
               }
               if(count($ListaNI)!=0){
                   echo "Enviando Listas NO IDENTIFICADO<br>";
                   $this->EnviarLista($ListaNIDAT);
               }
               if(count($ListaOfertasIMG)!=0){
                   echo "Enviando Listas IMAGEN<br>";
                   $this->EnviarLista($ListaOfertasIMGDAT);
               }
               if(count($ListaOfertasAUD)!=0){
                   echo "Enviando Listas AUDIO<br>";
                   $this->EnviarLista($ListaOfertasAUDDAT);
               }
           }
        }
    }
}
$hilo = new hiloWhatsAppSEND();
$hilo->Run();
?>
