<? include("logadmin.php"); 
	
if ($logadmin) {  
    
if(isset($_REQUEST["UpdatePendiente"])&& $_REQUEST["UpdatePendiente"]=='S' &&
   isset($_REQUEST["UpdateType"])&& $_REQUEST["UpdateType"]=='1'){
    //Actualizar ARCHIVOS
    
    //Actualizar Archivo XML.
    $XMLFile="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<xml>
	<pendientepagos>
		<informacion>
			<texto>".str_replace("\r"," - ",str_replace("\n","", $_REQUEST["textopendiente"]))."</texto>
		</informacion>
	</pendientepagos>
</xml>";
$XMLConf = simplexml_load_string($XMLFile);
$XMLConf->asXml('pendientepagoinfo.xml');
}

$xml = file_get_contents($_SERVER["DOCUMENT_ROOT"].$prefijo.'/pendientepagoinfo.xml');
$DOM = new SimpleXMLElement($xml);

$TextoPendientes = nl2br(strval($DOM->pendientepagos->informacion[0]->texto));
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAT - AHL Informatica</title>
<link href="js/basic.css" rel="stylesheet" type="text/css" />
<link href="estilos.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.js"></script>
<script src="js/jquery.simplemodal.1.4.4.min.js"></script>
<script>
    var texto = "<? echo $TextoPendientes ?>";
    function ModificarTextPendientes(){
        $("<div><b>TEXTO PARA FACTURAS PENDIENTES DE COBRO</b><br>"+
          "**Al modificar la siguiente informaci&oacute;n aparecer&aacute;<br>en las facturas pendientes de cobro.<br>"+
          "<br>"+
          "<form action='pendientes.php'>"+
          "<div style='margin-bottom:5px'><div style='width:400px;padding-right:3px;float:left'>Texto para pendientes de cobro:</div><br><textarea name='textopendiente' rows='7' style='width:375px'>"+texto+"</textarea></div>"+
          "<div style='width:100%;text-align:center'><button style='width:100px;padding:3px'>Actualizar</button></div>"+
          "<input type='hidden' name='UpdatePendiente' value='S'></input>"+
          "<input type='hidden' name='UpdateType' value='1'></input>"+
          "</form>"+
          "</div>").modal({containerCss:{width:'420px',height:'250px'}});
    }
    function LaunchModal(NFactura,TablaFactura,TablaEmpresas,IDFactura){
        $("<div><b>PAGAR FACTURA.</b><br>"+
          "<b>Factura No.</b>:"+NFactura+"<br>"+
          "<br>"+
          "Seleccione el m&eacute;todo de pago:"+
          "<form action='facturas_detalle.php'>"+
          "&nbsp;&nbsp;&nbsp;&nbsp;<input name='Uforma' type='radio' id='radio' value='Efectivo' checked='checked'/>"+
          "<label for='Uforma'>Efectivo</label><br>"+
          "&nbsp;&nbsp;&nbsp;&nbsp;<input name='Uforma' type='radio' id='radio' value='Tarjeta'/>"+
          "<label for='Uforma'>Tarjeta</label><br>"+
          "&nbsp;&nbsp;&nbsp;&nbsp;<input name='Uforma' type='radio' id='radio' value='Talon'/>"+
          "<label for='Uforma'>Tal&oacute;n</label><br>"+
          "&nbsp;&nbsp;&nbsp;&nbsp;<input name='Uforma' type='radio' id='radio' value='Pendiente de cobro'/>"+
          "<label for='Uforma'>Pendiente de cobro</label><br>"+
          "&nbsp;&nbsp;&nbsp;&nbsp;<input name='Uforma' type='radio' id='radio' value='Transferencia Bancaria BBVA'/>"+
          "<label for='Uforma'>Transferencia Bancaria BBVA</label><br>"+
          "&nbsp;&nbsp;&nbsp;&nbsp;<input name='Uforma' type='radio' id='radio' value='Transferencia Bancaria CAIXA'/>"+
          "<label for='Uforma'>Transferencia Bancaria CAIXA</label><br>"+
          "&nbsp;&nbsp;&nbsp;&nbsp;<input name='Uforma' type='radio' id='radio' value='Transferencia Bancaria BANKIA'/>"+
          "<label for='Uforma'>Transferencia Bancaria BANKIA</label><br>"+
          "&nbsp;&nbsp;&nbsp;&nbsp;<input name='Uforma' type='radio' id='radio' value='Otro'/>"+
          "<label for='Uforma'>Otro</label><br>"+
          "<div style='padding-left:45px'><textarea name='Uforma2' rows='4'></textarea></div><br>"+
          "<div style='width:100%;text-align: center;'><button style='width:40%'>Pagar/Actualizar</button></div>"+
          "<input type='hidden' name='TablaFactura' value='"+TablaFactura+"'></input>"+
          "<input type='hidden' name='IDFactura' value='"+IDFactura+"'></input>"+
          "<input type='hidden' name='TablaEmpresas' value='"+TablaEmpresas+"'></input>"+
          "<input type='hidden' name='id' value='"+IDFactura+"'></input>"+
          "<input type='hidden' name='UpdatePago' value='S'></input>"+
          "</form>"+
          "</div>").modal({containerCss:{width:'300px',height:'320px'}});
    }
    function PagarFactura(NFactura,FormaPago){
        $.post("pendientes.php", { "NFactura": NFactura,"FormaPago":FormaPago});
    }
</script>
<? include("funciones.php"); ?>
</head>

<body>
<table width="979" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="337"><img src="images/LOGO-AHL.png" /></td>
    <td width="642" align="right"><? include("encabezado.php"); ?>
      <div align="left"><img src="images/sat.png" width="257" height="41" vspace="10" /></div>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><? include("menu.php"); ?></td>
  </tr>
  
  <tr>
    <td height="17" colspan="2" background="images/top.png"></td>
  </tr>
  <tr>
    <td height="500" colspan="2" valign="top" background="images/medio.png">
    <div style="margin-left:20px; margin-right:20px">
      <h1>Facturas Pendientes de Cobro</h1>
      <a href='facturas_exportar.php'>[+] Exportar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor:pointer;" onclick="ModificarTextPendientes()">[+] Texto pendientes de cobro</span><br/><br />
      
        <? 
	  	 
		 if ($sucursal=="Arrecife") { $tabla_facturas="facturas_arrecife"; }
		 if ($sucursal=="Tias") { $tabla_facturas="facturas_tias"; }
		 if ($sucursal=="Centro") { $tabla_facturas="facturas_centro"; } 
		
											
	     $busco=mysql_query("select * from $tabla_facturas where forma NOT IN ('Efectivo','Tarjeta','Talon','Transferencia Bancaria BBVA','Transferencia Bancaria BANKIA','Transferencia Bancaria CAIXA','')  order by id_facturas desc");
	     $cnt=mysql_num_rows($busco); 
		 if ($cnt>0) { ?>
      <br />
      <table id="facturas" style="border:1px solid #E5E5E5" width="930" border="0" cellspacing="3" cellpadding="0">
        <thead>
            <tr >
              <th width="170" bgcolor="#DBDBDB">Fecha</th>
              <th width="100" bgcolor="#DBDBDB">Número</th>
              <th width="100" bgcolor="#DBDBDB">Parte</th>
              <th bgcolor="#DBDBDB">Cliente</th>
              <th width="98" height="30" bgcolor="#DBDBDB">Total</th>
              <th width="60" bgcolor="#DBDBDB">Pagar</th>
              <th width="60" bgcolor="#DBDBDB">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <? 
		
		
		
		
		while ($saco=mysql_fetch_array($busco)) { 
		$link=" style='cursor:pointer; border-bottom:1px dotted #666;' onclick=\"location.href='facturas_detalle.php?id=$saco[0]'\""; ?>
        <tr>
          <td <? echo $link; ?>><? echo substr($saco[fecha],0,16)." hs."; ?></td>
          <td align="center" <? echo $link; ?>><strong>F<?  if ($saco[venta]=="si") { echo "VF"; }    echo strtoupper($saco[tipo]); ?><? if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[0]);  ?>
            &nbsp; </strong></td>
          <td align="center" style='border-bottom:1px dotted #666;'><a href='<? if ($saco[tipo]=="rp") { echo "computadoras"; }  if ($saco[tipo]=="rm") { echo "repmoviles"; } if ($saco[tipo]=="rc") { echo "consolas"; } if ($saco[tipo]=="lm") { echo "libmoviles"; }   ?>_editar.php?id=<? echo $saco[caso]; ?>'><? if ($saco[venta]!="si") {   echo strtoupper($saco[tipo]); if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[caso]);    } ?></a>&nbsp;</td>
          <td <? echo $link; ?>><? if ($saco[clase]!='empresa') { 
		  														$b=mysql_query("select * from clientes where id_clientes='$saco[cliente]'"); 
																$s=mysql_fetch_array($b);
																echo "$s[apellido] $s[nombre]"; 
																} else { 
																			if ($sucursal=="Arrecife") { $tabla_empresas=" empresas_integradas "; }
																			if ($sucursal=="Tias") { $tabla_empresas=" empresas_integradas "; }
																			if ($sucursal=="Centro") { $tabla_empresas=" empresas_integradas "; } 
																			$b=mysql_query("select * from $tabla_empresas where id_empresa='$saco[cliente]'"); 
																			$s=mysql_fetch_array($b);
																			echo "<span class='nombre_empresa'>$s[nombre]</span>";
																			}   ?></td>
          <td <? echo $link; ?>><? echo $saco[total]; ?> &#8364;</td>
          <td style='border-bottom:1px dotted #666;' align="center"><? /*echo $saco[forma];*/echo "<button class='btn btn-primary' onclick='"."LaunchModal(\"F"; if ($saco[venta]=="si") { echo "VF"; }    echo strtoupper($saco[tipo]);
            if ($saco[tienda]=="Tias") {  echo "T"; }  
            if ($saco[tienda]=="Arrecife") {  echo "A"; } 
            printf("%05d",  $saco[0]); echo "\",\"".$tabla_facturas."\",\"".$tabla_empresas."\",\"".$saco[0]."\")"."'>Pagar factura</button>"; ?></td>
          <td style='border-bottom:1px dotted #666;' align="center"><?  if ($saco[venta]=="si") { ?>
            <a href="facturas_editar.php?id=<? echo $saco[0]; ?>">Editar</a>            <? } else { echo "&nbsp;"; } ?></td>
        </tr>
        <? } ?>
      </tbody>
      </table>
      <? } else { ?>No hay facturas<? } ?>
      
    </div>    </td>
  </tr>
  <tr>
    <td height="17" colspan="2" background="images/abajo.png"></td>
  </tr>
  <tr>
    <td height="17" colspan="2"><? include("pie.php"); ?></td>
  </tr>
</table>
</body>
</html>
<? } else { ?><script>location.href='login.php'</script><? } ?>
