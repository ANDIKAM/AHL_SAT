<? 
$total=$cantidad;
$cantidad=$cantidad/$cantcol; ?>

<html>
<head>
<title>Codigo de Barras</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<table width="100%" border="1" align="center" bordercolor="#CCCCCC">

<? 
$cant=0;
$columna=0;
for ($i=0;$i<$cantidad;$i++) {
?>  
<tr>
	<? for ($columna=0;$columna<$cantcol;$columna++) {  ?>
    <td align='center'><? $cant++; if ($cant<=$total){ include("http://www.avesargentinas.org.ar/barras/index.php?barcode=$idbarras");  ?><? echo $idbarras; } else echo "&nbsp;";?></td>
	<? } ?>
  </tr>
 
<?
}
?>
<script>javascript:window.print()</script>
</table>
</body>
</html>