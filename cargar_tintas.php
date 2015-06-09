<? include("logadmin.php"); 
	
if ($logadmin) {  
?>
<!-- Copyright 2000-2006 Adobe Macromedia Software LLC and its licensors. All rights reserved. -->
<title>Campo de texto</title>



<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td height="30" bgcolor="#FFFFCC"><strong>Nombre</strong></td>
    <td height="30" bgcolor="#FFFFCC"><strong>Comentarios</strong></td>
    <td height="30" bgcolor="#FFFFCC"><strong>Precio</strong></td>
    <td height="30" bgcolor="#FFFFCC"><strong>Cantidad</strong></td>
  </tr>

<?				
$busco=mysql_query("select * from tinta where impresoras like '%$modelo_impresora%'");
while ($saco=mysql_fetch_array($busco)) {
	?>

  <tr>
    <td><? echo $saco[nombre]; ?></td>
    <td><? echo $saco[comentarios]; ?></td>
    <td><? echo $saco[precio]; ?></td>
    <td width="30"><select id="tinta[<? echo $saco[0]; ?>]" name="tinta[<? echo $saco[0]; ?>]">
      <option value="0" selected="selected">0</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
      <option value="17">17</option>
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
    
    </select></td>
  </tr>
         <? } ?>          
<tr>
  <td height="30" colspan="4" align="center"><input type="submit" name="agregar_tinta" id="agregar_tinta" value="Agregar a la venta" /></td></tr>          
</table>
<?             
 } ?>