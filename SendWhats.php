<?
include("logadmin.php"); 
if ($logadmin) { 
    if(isset($_REQUEST["numero"]) && isset($_REQUEST["mensaje"])){
         include_once('whatsapp/whatssend.class.php');
         $wsa = new WhatsSend();
         $wsa->sendMessage(array($_REQUEST["numero"]), 6,$_REQUEST["mensaje"]);
    }
}
?>

