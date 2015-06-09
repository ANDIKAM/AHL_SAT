<?php

require_once 'whatssend.class.php'; 


$ws = new WhatsSend();
$ws->sendMessage(array(573016405903), 1, "Os quiero");

//$otra = $ws->receivedMessage();
//$ws->sendMessage(array(573016405903), 2, $_SERVER["DOCUMENT_ROOT"].'/SGAFISJ/img/foto-perfil.jpg');
//$ws->sendMessage(array(573016405903,573016403475), 3, $_SERVER["DOCUMENT_ROOT"].'/SGAFISJ/img/Meghan_Trainor_-_The_Best_Part_(Interlude).mp3');


