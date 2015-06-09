<?php
/**
 * socket-const.php
 *
 * Se definen las constantes por defecto para conectar con Lleida.net
 *
 * @author David Tapia (c) 2008 - LleidaNetworks Serveis Telem&agrave;tics, S.L.
 * @version 1.2
 */

if(!defined('HOST')){
    define('HOST', 'sms.lleida.net');
}

if(!defined('PORT')){
    define('PORT', 2048);
}

if(!defined('SOCKET_DEBUG')){
    define('SOCKET_DEBUG', false); // Set to true, if you want debuger info
}

define('SOCKET_NOCONNECT', 0);
define('SOCKET_CONNECT', 1);
define('SOCKET_TIMEOUT', 30);

define('SOCKET_SOMAXCONN', 5); // backlog for socket listen
define('SOCKET_BUFFER', 1024); // socket_read()
?>