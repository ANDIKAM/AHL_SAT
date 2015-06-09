<table  border="0" cellspacing="0" cellpadding="0">
  <? if ($_COOKIE["satPass"]!="ahlnews2012") { ?>
  <tr>
    <td width="3" height="27" nowrap></td>
    <td width="10" nowrap background="images/fondo_menu_izq.png">&nbsp;</td>
    <td align="center" nowrap background="images/fondo_menu_medio.png"><a <? if ($sec=="inicio") { ?>class="menu"<? } ?> href="index.php">Inicio</a> | <a  <? if ($sec=="ventas") { ?>class="menu"<? } ?> href="ventas.php">Ventas</a> | <a  <? if ($sec=="tintas") { ?>class="menu"<? } ?> href="tintas.php">Tintas</a> | <a  <? if ($sec=="computadoras") { ?>class="menu"<? } ?>  href="computadoras.php">PC's</a> | <a  <? if ($sec=="repmoviles") { ?>class="menu"<? } ?>  href="repmoviles.php">Rep. Móviles</a> | <a  <? if ($sec=="libmoviles") { ?>class="menu"<? } ?>  href="libmoviles.php">Lib. Móviles</a> | <a  <? if ($sec=="consolas") { ?>class="menu"<? } ?>  href="consolas.php">Consolas</a> | <a  <? if ($sec=="clientes") { ?>class="menu"<? } ?>  href="clientes.php">Clientes</a> | <a  <? if ($sec=="facturas") { ?>class="menu"<? } ?>  href="facturas.php">Facturas</a> | <a  <? if ($sec=="pendientes") { ?>class="menu"<? } ?>  href="pendientes.php">Pend. de cobro</a> | <a  <? if ($sec=="empresas_news") { ?>class="menu"<? } ?>  href="empresas_news.php">News</a> | <a  <? if ($sec=="empresas_listado") { ?>class="menu"<? } ?>  href="empresas_lista.php">Empresas</a> | <a  <? if ($sec=="plantillas") { ?>class="menu"<? } ?> href="empresas_mensajes.php">Plantillas</a></td>
    <td width="10" nowrap background="images/fondo_menu_der.png">&nbsp;</td>
    <td width="7" height="27" nowrap></td>
  </tr>
  <? } else { ?>
    <tr>
    <td width="13" nowrap background="images/fondo_menu_izq.png">&nbsp;</td>
    <td align="center" nowrap background="images/fondo_menu_medio.png">&nbsp;&nbsp;Gestor de envío de Newsletters&nbsp;&nbsp;</td>
    <td width="13" nowrap background="images/fondo_menu_der.png">&nbsp;</td>
    <td width="20" height="27" nowrap></td>
  </tr><? }?>
</table>
