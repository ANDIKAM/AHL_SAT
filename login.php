<? 
setcookie("satNick"); setcookie("satPass");

// Emular register_globals on   
if (!ini_get('register_globals')) {   
    $superglobales = array($_SERVER, $_ENV,   
        $_FILES, $_COOKIE, $_POST, $_GET);   
    if (isset($_SESSION)) {   
        array_unshift($superglobales, $_SESSION);   
    }   
    foreach ($superglobales as $superglobal) {   
        extract($superglobal, EXTR_SKIP);   
    }   
}  
if ($entrar) { 
$mensaje="";
function quitar($mensaje) 
{ 
$mensaje = str_replace("<","&lt;",$mensaje); 
$mensaje = str_replace(">","&gt;",$mensaje); 
$mensaje = str_replace("\'","&#39;",$mensaje); 
$mensaje = str_replace('\"',"&quot;",$mensaje); 
$mensaje = str_replace("\\\\","&#92",$mensaje); 
return $mensaje; 
} 

$nickN = quitar($_POST["nick"]); 
$passN = quitar($_POST["password"]); 


if($nickN=="admin" and ($passN=="tiasahl2012" or $passN=="arrecifeahl2012"  or $passN=="centroahl2012" or $passN=="ahlnews2012") ) 
{ 

	setcookie("satNick",$nickN); 
 	setcookie("satPass",$passN);
					
		
		?><SCRIPT LANGUAGE="javascript"> location.href = '<? if ($passN!="ahlnews2012") { ?>index.php<? } else { echo "news.php"; }?>'; </SCRIPT><?


} 
else 
{ 
$mensaje= "Nombre de usuario o contraseña incorrecto";  
} 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="979" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="408" rowspan="2"><img src="images/LOGO-AHL.png" /></td>
    <td width="571" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td valign="middle"><div align="left"><img src="images/sat.png" alt="" width="257" height="41" vspace="10" /></div></td>
  </tr>
  <tr>
    <td height="17" colspan="2" background="images/top.png"></td>
  </tr>
  <tr>
    <td colspan="2" background="images/medio.png">
      <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inicio de sesión<br />
        <br />
        <br />
        <br />
        <br />
      </h1>
      <div align="center"><? echo $mensaje; ?></div>
    <form id="form1" name="form1" method="post" action="#SELF">
      <table width="400" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td width="80">Usuario: </td>
          <td width="320"><input style="width:98%" type="text" name="nick" id="nick" /></td>
        </tr>
        <tr>
          <td>Contraseña: </td>
          <td><input style="width:98%" type="password" name="password" id="password" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" name="entrar" id="entrar" value="   Entrar   " /></td>
        </tr>
      </table>
    </form>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br /></td>
  </tr>
  <tr>
    <td height="17" colspan="2" background="images/abajo.png"></td>
  </tr>
</table>
</body>
</html>
