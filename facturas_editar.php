<? include("logadmin.php"); 
header("Content-Type: text/html;charset=utf-8");
if ($logadmin) { 


if ($chngusr) {
                                                if ($sucursal=="Arrecife") { $tabla_facturas="facturas_arrecife"; }
                                                if ($sucursal=="Tias") { $tabla_facturas="facturas_tias"; } 
                                                if ($sucursal=="Centro") { $tabla_facturas="facturas_centro"; } 
                                                mysql_query("SET NAMES 'utf8'");
						$busco=mysql_query("select * from $tabla_facturas where id_facturas='$id'");
						$saco=mysql_fetch_array($busco);
						
						$actualizototal=mysql_query("update $tabla_facturas set cliente='$iduser' where id_facturas='$id'");
						
						}


if ($agregarart) {
				  if ($sucursal=="Arrecife") { $tabla_art="ventas_art_arrecife"; }
				  if ($sucursal=="Tias") { $tabla_art="ventas_art_tias"; } 
				  if ($sucursal=="Centro") { $tabla_facturas="facturas_centro"; } 
                              $total=$unidades*$precio;
		 	      $ingreso=mysql_query("insert into $tabla_art (unidades, concepto, precio, total, id) values ('$unidades','$concepto','$precio','$total', '$id')");
				  
						if ($sucursal=="Arrecife") { $tabla_facturas="facturas_arrecife"; }
						if ($sucursal=="Tias") { $tabla_facturas="facturas_tias"; } 
																				
						$busco=mysql_query("select * from $tabla_facturas where id_facturas='$id'");
						$saco=mysql_fetch_array($busco);
						
						$nuevototal=$saco[total]+$total;
						
						$actualizototal=mysql_query("update $tabla_facturas set total='$nuevototal' where id_facturas='$id'");

				  ?><script>location.href='facturas_editar.php?id=<? echo $id; ?>&cls=<? echo $nuevototal; ?>'</script><?
				  }



if ($sucursal=="Arrecife") { $tabla_facturas="facturas_arrecife"; }
if ($sucursal=="Tias") { $tabla_facturas="facturas_tias"; } 
if ($sucursal=="Centro") { $tabla_facturas="facturas_centro"; } 
														
$busco=mysql_query("select * from $tabla_facturas where id_facturas='$id'");
$saco=mysql_fetch_array($busco);

if ($sucursal=="Arrecife") {$tabla_empresas="empresas_integradas "; $tabla_computadoras="computadoras_arrecife";  $tabla_repmovil="repmovil_arrecife"; $tabla_libmovil="libmovil_arrecife"; $tabla_consolas="consolas_arrecife";  }
if ($sucursal=="Tias") { $tabla_empresas="empresas_integradas ";$tabla_computadoras="computadoras_tias";  $tabla_repmovil="repmovil_tias"; $tabla_libmovil="libmovil_tias";   $tabla_consolas="consolas_tias"; } 
if ($sucursal=="Centro") { $tabla_empresas="empresas_integradas "; $tabla_computadoras="computadoras_centro";  $tabla_repmovil="repmovil_centro"; $tabla_libmovil="libmovil_centro";   $tabla_consolas="consolas_centro"; } 
				  
if ($saco[tipo]=="rp") { $bo=mysql_query("select * from $tabla_computadoras where id_computadoras='$saco[caso]'"); }
if ($saco[tipo]=="rm") { $bo=mysql_query("select * from $tabla_repmovil where id_repmovil='$saco[caso]'"); }
if ($saco[tipo]=="lm") { $bo=mysql_query("select * from $tabla_libmovil where id_libmovil='$saco[caso]'"); }
if ($saco[tipo]=="rc") { $bo=mysql_query("select * from $tabla_consolas where id_consolas='$saco[caso]'"); }

$so=mysql_fetch_array($bo);
if($saco["clase"]!='empresa'){
    $bc=mysql_query("select * from clientes where id_clientes='$saco[cliente]'");
}else{
    $bc=mysql_query("select * from $tabla_empresas where id_empresa='$saco[cliente]'");
}

$TotalClientes = mysql_query("select * from clientes");
$TotalEmpresas = mysql_query("select * from $tabla_empresas");

$sc=mysql_fetch_array($bc); 
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>AHL Informatica</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<link href="js/jquery-ui.min.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script>
    var EsEmpresa="<? echo $saco["clase"]=='empresa'?'1':'2'; ?>";
    var TipoPago="<? echo ($saco["forma"]); ?>";
    var ClienteAutoComplete=[
        <?
            $stringImprimible="";
            $counter=1;
            while ($s=mysql_fetch_array($TotalClientes)){
                if($counter%100==0){
                    $counter=1;
                    echo $stringImprimible;
                    $stringImprimible="";
                }
                $stringImprimible=$stringImprimible."{value:'".$s["id_clientes"]."',".
                                                      "id:'".$s["dni"]."',".
                                                      "email:'".$s["email1"]."',".
                                                      "desc:'".$s["apellido"]." ".$s["nombre"]." - DNI:".$s["dni"]."',".
                                                      "label:'".$s["apellido"]." ".$s["nombre"]."',".
                                                      "direccion:'".$s["direccion"]."'},";
            }
            $stringImprimible=substr($stringImprimible, 0, -1);
            echo $stringImprimible;
        ?>
    ];
    var EmpresaAutoComplete=[
        <?
        $stringImprimible="";
            $counter=1;
            while ($s=mysql_fetch_array($TotalEmpresas)){
                if($counter%100==0){
                    $counter=1;
                    echo $stringImprimible;
                    $stringImprimible="";
                }
                $stringImprimible=$stringImprimible."{value:'".$s["id_empresa"]."',".
                                                      "id:'".$s["cif"]."',".
                                                      "email:'".$s["email"]."',".
                                                      "desc:'".$s["nombre"]." - CIF:".$s["cif"]."',".
                                                      "label:'".$s["nombre"]."',".
                                                      "direccion:'".$s["localidad"].$s["calle"]."- Cod. Postal".$s["codigopostal"]."'},";
            }
            $stringImprimible=substr($stringImprimible, 0, -1);
            echo utf8_encode($stringImprimible);
        ?>
    ];
    function ImprimirFactura(){
        var tipoPago='0';
        if($('#radio1').is(':checked')){
                tipoPago='Efectivo';
            }
        if($('#radio2').is(':checked')){
                tipoPago='Tarjeta';
            }
        if($('#radio3').is(':checked')){
                tipoPago='Pendiente de cobro';
            }
        if($('#radio4').is(':checked')){
                tipoPago='Talon';
            }
        if($('#radio5').is(':checked')){
                TextOtro=$('#radio5_1').val();
                TextOtro=TextOtro.replace(/\r/g, " - ");
                TextOtro=TextOtro.replace(/\n/g, " - ");
                TextOtro=TextOtro.replace(/ /g, "%20");
                tipoPago=TextOtro;
            }
        location.href='facturas_imprimir.php?id=<? echo $id; ?>'+
                      '&UpdateCliName='+$('#UpdateCliName').val()+
                      '&UpdateCliID='+$('#UpdateCliID').val()+
                      '&UpdateCliTipo='+($('#UpdateCliTipo').val()=='2'?'':'empresa')+
                      '&UpdateCliInicialID='+$('#UpdateCliInicialID').val()+
                      '&UpdateCliInicialTipo='+$('#UpdateCliInicialTipo').val()+
                      '&UpdateTipoPago='+tipoPago+'&UpdateGeneral=1';
    }
    function FunctionPrincipal(){
        if(EsEmpresa=="1"){
            $('#CliEmp').autocomplete({
                minLength: 0,
                source: function(request, response) {
                    var results = $.ui.autocomplete.filter(EmpresaAutoComplete, request.term);
                    response(results.slice(0, 10));
                },
                focus: function( event, ui ) {
                  $( '#CliEmp' ).val( ui.item.label );
                  return false;
                },
                select: function( event, ui ) {
                  $( '#CliEmp' ).val( ui.item.label );
                  $( "#EtiquetaID" ).html('<b>CIF: </b>'+ui.item.id );
                  $( "#EtiquetaEmail" ).html(ui.item.email);
                  $( "#EtiquetaDireccion" ).html(ui.item.direccion);
                  $('#UpdateCliName').val(ui.item.label);
                  $('#UpdateCliID').val(ui.item.value);
                  $('#UpdateCliTipo').val('1');
                  //$( "#project-description" ).html( ui.item.desc );
                  //$( "#project-icon" ).attr( "src", "images/" + ui.item.icon );
                  return false;
                }
                
              }); 
              $('#EsEmpresa').attr('checked','checked');
              $('#CliEmp').focusout(function(){
                  $('#UpdateCliName').val($('#CliEmp').val());
              });
        }else{
            $('#CliEmp').autocomplete({
                minLength: 0,
                source: function(request, response) {
                    var results = $.ui.autocomplete.filter(ClienteAutoComplete, request.term);
                    response(results.slice(0, 10));
                },
                focus: function( event, ui ) {
                  $('#CliEmp').val( ui.item.label );
                  return false;
                },
                select: function( event, ui ) {
                  $('#CliEmp').val( ui.item.label );
                  $( "#EtiquetaID" ).html('<b>DNI: </b>'+ui.item.id );
                  $( "#EtiquetaEmail" ).html(ui.item.email);
                  $( "#EtiquetaDireccion" ).html(ui.item.direccion);
                  $('#UpdateCliName').val(ui.item.label);
                  $('#UpdateCliID').val(ui.item.value);
                  $('#UpdateCliTipo').val('2');
                  //$( "#project-id" ).val( ui.item.value );
                  //$( "#project-description" ).html( ui.item.desc );
                  //$( "#project-icon" ).attr( "src", "images/" + ui.item.icon );
                  return false;
                }
              }); 
              $('#EsCliente').attr('checked','checked');
              $('#CliEmp').focusout(function(){
                  $('#UpdateCliName').val($('#CliEmp').val());
              });
        }
    }
    $(document).ready(function(){
        FunctionPrincipal();
        $('#CliEmp').val('<? echo $saco["clase"]=='empresa'?$sc["nombre"]:$sc["apellido"]." ".$sc["nombre"]; ?>');
        $('#UpdateCliName').val('<? echo $saco["clase"]=='empresa'?$sc["nombre"]:$sc["apellido"]." ".$sc["nombre"]; ?>');
        $('#UpdateCliInicialID').val('<? echo $saco["clase"]=='empresa'?$sc["id_empresa"]:$sc["id_clientes"]; ?>');
        $('#UpdateCliInicialTipo').val('<? echo $saco["clase"]=='empresa'?'1':'2'; ?>');
        $('#UpdateCliID').val('<? echo $saco["clase"]=='empresa'?$sc["id_empresa"]:$sc["id_clientes"]; ?>');
        $('#UpdateCliTipo').val('<? echo $saco["clase"]=='empresa'?'1':'2'; ?>');
        if(TipoPago=='Tarjeta'){
            $('#radio2').attr('checked','checked');
        }else{
            if(TipoPago=='Efectivo'){
            $('#radio1').attr('checked','checked');
            }else{
                if(TipoPago=='Pendiente de cobro'){
                    $('#radio3').attr('checked','checked');
                }else{
                    if(TipoPago=='Talon'){
                        $('#radio4').attr('checked','checked');
                    }else{
                        $('#radio5').attr('checked','checked');
                        $("#radio5_1").val(TipoPago);
                    }
                }
            }
        
        }
        
        $("input[name=Tipo]:radio").change(function () {
                                                 if($('#EsCliente').is(':checked')){
                                                     EsEmpresa='2';
                                                     FunctionPrincipal();
                                                 }else{
                                                     EsEmpresa='1';
                                                     FunctionPrincipal();
                                                 }
                                            });
    });
</script>
<? include("funciones.php"); ?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></head>

<body>
<form id="form1" name="form1" method="post" action="#SELF">
  <table width="680" border="0" align="center" cellpadding="0" cellspacing="3">
    <tr>
      <td colspan="2"><img src="images/LOGO-AHL-2.png" width="278" height="102" /></td>
    </tr>
    <tr>
      <td width="50%" rowspan="4" valign="top"><? if ($sucursal=="Tias") { ?>
        C.\ Libertad, 55<br />
        35572 - T&iacute;as<br />
        TF/FAX: 928.52.40.75<br />
        ahltias@hotmail.com<br />
        <? } else { ?>
        C/ Puerto Rico, 50<br />
        35500 - Arrecife de Lanzarote<br />
        TF/FAX: 928.80.50.93<br />
        info@ahlinformatica.com<br />
        <? } ?>
        CIF: B35859412 </td>
      <td align="right">Fecha: <strong><?echo substr($saco[fecha],0,16)." hs."; ?>&nbsp;</strong></td>
    </tr>
    <tr>
      <td align="right">N&uacute;mero de factura: <strong>F<?  if ($saco[venta]=="si") { echo "VF"; } echo strtoupper($saco[tipo]); ?><? if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[0]);  ?>
        &nbsp; </strong></td>
    </tr>
    <tr>
      <td align="right" class="texto_chico"><? if ($saco[venta]!="si") { ?>
          <em>Parte de reparaci&oacute;n: <? echo strtoupper($saco[tipo]); if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[caso]);  ?></em>
        <? } else { echo "&nbsp;"; } ?>
        &nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="40" colspan="2" class="titulo">Datos del Cliente</td>
    </tr>
    <tr>
        <td>
            <input id='EsCliente' type="radio" name="Tipo" value="1"/> Cliente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input id='EsEmpresa' type="radio" name="Tipo" value="2"/> Empresa
        </td>
    </tr>
    <tr>
        <td>
            <input style='width:100%' id='CliEmp' type='input'/>
        </td>
    </tr>
    <tr>
        <td>
                <input type='hidden' id='UpdateCliName' name='UpdateCliName' value=""/>
                <input type='hidden' id='UpdateCliID' name='UpdateCliID' value=""/>
                <input type='hidden' id='UpdateCliTipo' name='UpdateCliTipo' value=""/>
                <input type='hidden' id='UpdateCliInicialID' name='UpdateCliInicialID' value=""/>
                <input type='hidden' id='UpdateCliInicialTipo' name='UpdateCliInicialTipo' value=""/><br>                    
                    <label>Forma de pago:</label><br>
                <input name="UpdatePago" type="radio" id="radio1" value="Efectivo"/>
                <label for="UpdatePago">Efectivo &nbsp;&nbsp;&nbsp;</label><br>
                <input name="UpdatePago" type="radio" id="radio2" value="Tarjeta" />
                <label for="UpdatePago">Tarjeta &nbsp;&nbsp;&nbsp;</label><br>
                <input name="UpdatePago" type="radio" id="radio3" value="Pendiente de cobro" />
                <label for="UpdatePago">Pendiente de cobro &nbsp;&nbsp;&nbsp;</label><br>
                <input name="UpdatePago" type="radio" id="radio4" value="Talon" />
                <label for="UpdatePago">Tal&oacute;n &nbsp;&nbsp;&nbsp;</label><br>
                <input name="UpdatePago" type="radio" id="radio5" value="Otro" />
                <label for="UpdatePago">Otro &nbsp;&nbsp;&nbsp;</label><br>
                <textarea id="radio5_1" name="UpdatePago2"></textarea>
        </td>
        <td >
            <div id='EtiquetaEmail'><? echo "$sc[email1]"; ?></div><br>
            <div id='EtiquetaDireccion'><? echo $sc[direccion]." ".$sc[cp]; ?></div>
            <div id='EtiquetaID'><? if ($sc[dni]!="") { ?>
                                    DNI: <strong><? echo $sc[dni]; ?></strong>
                                    <? } else { echo "&nbsp;"; } ?></div>
        </td>
    </tr>
    <tr>
        
        
        
        
        
        
        <td></td>
      <td ></td>
    </tr>
    <tr>
      <td colspan="2" class="titulo">&nbsp;</td>
    </tr>
    <tr>
      <? $estilo="style='border-bottom:1px dotted #666'"; ?>
      <td colspan="2"><table width="670" border="0" cellspacing="0" cellpadding="4" style="border:1px solid #666">
          <tr <? echo $estilo; ?>>
            <td  width="50" height="30" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>UDS</strong></td>
            <td  height="30" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>CONCEPTO</strong></td>
            <td  width="120" height="30" align="right" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>PRECIO</strong></td>
            <td  width="60" height="30" align="right" bgcolor="#F7F7F7" <? echo $estilo; ?>><strong>TOTAL</strong></td>
            <td  width="30" align="center" bgcolor="#F7F7F7" <? echo $estilo; ?>>&nbsp;</td>
          </tr>
         <?
           if ($saco[venta]=="si") { 
		   
		   if ($sucursal=="Arrecife") { $tabla_art="ventas_art_arrecife"; }
					if ($sucursal=="Tias") { $tabla_art="ventas_art_tias"; }
					
      				$bo=mysql_query("select * from $tabla_art where id='$id'");
					while ($so=mysql_fetch_array($bo)) { 
												?>
          <tr>
            <td <? echo $estilo; ?> ><? echo $so[unidades]; ?></td>
                          <td <? echo $estilo; ?> ><? echo nl2br($so[concepto]); ?></td>
                          <td <? echo $estilo; ?>  align="right"><? echo $so[precio]; ?> &#8364; </td>
                          <td  align="right" <? echo $estilo; ?>><? echo $so[total]; ?> &#8364; </td>
                          <td  align="center" <? echo $estilo; ?>><a href="facturas_eliminar_item.php?factura=<? echo $id; ?>&id=<? echo $so[0]; ?>">X</a></td>
          </tr>
                          <? } ?>
          <? } ?>
          <tr >
            <td  height="40" colspan="3" align="right" class="titulo">Total factura con IGIC incluido:</td>
            <td   align="right" class="titulo"><?  echo $saco[total]; ?>
              &#8364;
              <?   ?></td>
            <td   align="right" class="titulo">&nbsp;</td>
          </tr>
      </table>
      <br />
      <span style="cursor:pointer" onclick="mostrar('agregaralaventa');">[+] Agregar items</span><br />
		
        
        <div id="agregaralaventa" style="display:<? echo "none"; ?>">
        <table width="600" border="0" cellpadding="0" cellspacing="5" style="border: 1px dotted #666; margin-top:10px">
          <tr>
            <td height="30" colspan="2"><strong>Agregar art&iacute;culo a la factura</strong></td>
            </tr>
          <tr>
            <td width="44">Unidades:</td>
            <td width="448"><input name="unidades" type="text" id="unidades" size="5" /></td>
          </tr>
          <tr>
            <td>Concepto:</td>
            <td><textarea name="concepto" rows="3" id="concepto" style="width:97%"></textarea></td>
          </tr>
          <tr>
            <td>Precio:</td>
            <td><input name="precio" type="text" id="precio" size="10" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="agregarart" id="agregarart" value="Agregar" /> &nbsp;&nbsp;
              <input type="button" name="button2" id="button2" value="Cancelar" onclick="ocultar('agregaralaventa');" /></td>
          </tr>
        </table>
        </div>
        
        
        </td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td height="30" colspan="2" align="center"><img src='barras/image.php?code=F<?  if ($saco[venta]=="si") { echo "VF"; }  echo strtoupper($saco[tipo]); ?><? if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[0]);  ?>&amp;style=68&amp;type=C128B&amp;width=210&amp;height=55&amp;xres=1&amp;font=3&amp;drawtext=on&amp;output=jpeg&amp;border=off' alt="" name="RP<? if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[0]); $saco[0]; ?>.jpg" id="RP<? if ($saco[tienda]=="Tias") {  echo "T"; }  if ($saco[tienda]=="Arrecife") {  echo "A"; } printf("%05d",  $saco[0]); $saco[0]; ?>.jpg" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center" style="border-bottom:1px dotted #666">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="button" name="button" id="button3" value="     Imprimir factura      " onclick="ImprimirFactura()" /> &nbsp;&nbsp;
        <input type="button" name="actualizar" id="button" value="    Volver      " onclick="location.href='facturas.php'" /></td>
    </tr>
  </table>
</form>
</body>
</html>
<? if ($cqm=="136187236452") { ?><? } ?>
<? } else { ?><script>location.href='login.php'</script><? } ?>