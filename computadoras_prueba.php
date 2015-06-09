<? 

/*
include_once('SendMessages.php');
$send = new SendMessages();
$id = 1;
$txt = "Mensaje de prueba sistema AHL";
$dst = "+5491136809968";
$send->sendOneSMS($id, $txt, $dst); */

include_once('whatsapp/whatssend.class.php');
$wsa = new WhatsSend();
//$wsa->sendMessage(array([Numero sin Codigo Pais]), 1, "hola");
$wsa->receivedMessage();


 ?>
