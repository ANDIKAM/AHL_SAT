<? include("logadmin.php"); 
if ($logadmin) { 
//Texto de Envio de las ofertas a el O los usuarios
    if(isset($_REQUEST["reset"])&&$_REQUEST["reset"]=="resetearenvio"){
         mysql_query("update clientes set enviado = 0");
    }
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
    if(isset($_REQUEST["ofertas"])&& is_numeric($_REQUEST["ofertas"])){
        if($_REQUEST["ofertas"]=='0'){ //Enviar a todos los usuarios
            if(isset($_REQUEST["bloque"])&& is_numeric($_REQUEST["bloque"])){
                $bloque1=$_REQUEST["bloque"]*2;
                $bloque2=$bloque1+2;
                $bloque1--;
                $bloque2++;
                include_once('whatsapp/whatssend.class.php');
                $id_ofertas=$_REQUEST['ofertas'];
                $wsa = new WhatsSend();
                $cant=mysql_query("select MAX(id_clientes) conteo from clientes where whatsapp='SI'");
                $cant=mysql_fetch_array($cant); 
                $cant=$cant["conteo"];
                $cant=round(($bloque2*100)/$cant,2);
                if($cant>=100){$cant=100;}
                $buscon=mysql_query("select nombre,movil1,movil2 from clientes where whatsapp='SI' AND id_clientes BETWEEN $bloque1 AND $bloque2");
                $counting=0;
                unset($numeros);
                $filas=mysql_num_rows($buscon);
                $numeros=array();
                $enviado=false;
                if($filas>=1){
                    while ($saco=mysql_fetch_array($buscon)){
                        $mov1=str_replace("-","",str_replace("+","",str_replace(" ", "",$saco["movil1"])));
                        $mov2=str_replace("-","",str_replace("+","",str_replace(" ", "",$saco["movil2"])));
                        if($mov1!=""){array_push($numeros,$mov1);}
                        if($mov2!=""){array_push($numeros,$mov2);}
                    }
                    if(count($numeros)>0){
                            $wsa->SendOfertasoReportes($numeros, "OFERTA");
                            $enviado=true;
                    }
                }
                $object = (object) array('enviado' => $enviado, 'numeros' => $numeros,'bloque'=>$bloque,'avance'=>$cant);
                echo json_encode($object);
            } 
        }else{ //Enviar al usuario identificado por ID
            include_once('whatsapp/whatssend.class.php');
            $id_ofertas=$_REQUEST['ofertas'];
            $busco=mysql_query("select movil1,movil2 from clientes where id_clientes=$id_ofertas AND whatsapp='SI'");
            $saco=mysql_fetch_array($busco); 
            $wsa = new WhatsSend();
            if(count($saco)>0){
                $msgID="app-".strval(time()).rand (1,1000);
                $wsa->SendOfertasoReportes(array($saco[0],$saco[1]), "OFERTA",$msgID);
                mysql_query("update clientes set enviado = 1 where  id_clientes=$id_ofertas");
                
            }
            
        }
    }
?>
<? } else { ?><script>location.href='login.php'</script><? } ?>

