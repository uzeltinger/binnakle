<?php
$maletas = $this->maletas;
//print_r($maletas);
$carrito = $this->carrito;
//print_r($carrito);
if (count($carrito) > 0) {
    ?>

<script>
    var nfEs = new Intl.NumberFormat('de-DE',{minimumFractionDigits:2});
    /*costoTotal_ = 1234;
    descuento = 55;
    costoTotal_ = costoTotal_.toFixed(2);
    descuento_ = descuento.toFixed(2);
    console.log('costoTotal_', costoTotal_);
    console.log('descuento_', descuento_);
    console.log('costoTotal_ f', nfEs.format(costoTotal_));
    console.log('descuento_ f', nfEs.format(descuento_));*/

    var codigoValidado = false;
    

function calcularDescuentos(){
    let costoDescuento = document.getElementById("costoDescuento").value;
    let discountDescuento = document.getElementById("discountDescuento").value;
    var costoTotal_ = parseFloat(document.getElementById("costoTotal").value);
    let descuento = 0;
    if(costoDescuento>0){
    descuento = descuento + parseFloat(costoDescuento);
    console.log('descuento', descuento);
    }

    if(discountDescuento>0){        
        let discount = parseFloat(discountDescuento);
        console.log('costoTotal_', costoTotal_);
        console.log('descuento', descuento);
        descuento = (discount*costoTotal_/100) + descuento;
        console.log('discount', discount);
        console.log('descuento', descuento);
    }

    
    if (descuento != 0) {                        
        costoTotal_ = costoTotal_ - descuento;
        costoTotal_ = costoTotal_.toFixed(2);
        descuento_ = descuento.toFixed(2);
        console.log('costoTotal_', costoTotal_);
        document.getElementById("costoTotal").value = costoTotal_;
        //document.getElementById("valorTotalDescuentos").innerHTML = new Intl.NumberFormat("es-ES", {minimumFractionDigits: 2}).format(descuento_);
        document.getElementById("valorTotalDescuentos").innerHTML = nfEs.format(descuento_);        

        //document.getElementById("valorTotalConDescuentos").innerHTML = costoTotal_; <?php echo JText::_('BINNAKLE_CODIGO_PROMOCIONAL');?>
        document.getElementById("validar-codigo").innerHTML = "<?php echo JText::_('BINNAKLE_CODIGO_APLICADO');?>"; 
        
        document.getElementById("tr-carrito-descuentos").style.visibility = "visible";

        document.getElementById("showSpinner").style.visibility = "hidden";
        codigoValidado = true;
    }else{
        document.getElementById("tr-carrito-descuentos").style.visibility = "hidden";
    }
    
    document.getElementById("valorTotalConDescuentos").innerHTML =nfEs.format(costoTotal_);
    

    console.log('costoTotal_.toLocaleString()',costoTotal_.toLocaleString());


}
    function validarCodigo() {
        

        if (!codigoValidado) {
            document.getElementById("showSpinner").style.visibility = "visible";
            
            var codigo = document.getElementById("validarCodigoDescuento");
            var costoTotal_ = parseFloat(document.getElementById("costoTotal").value);
            console.log('costoTotal_', costoTotal_);
            var descuento = 0;
            //console.log(codigo.value);
            fetch('index.php?option=com_compras&task=validarcodigo&codigo=' + codigo.value)
                .then(function(response) {
                    return response.text();
                })
                .then(function(text) {
                    if(text=='null'){
                        alert('Código incorrecto');
                        document.getElementById("showSpinner").style.visibility = "hidden";
                    }
                    if(text!='null'){
                        console.log(text);
                        var obj = JSON.parse(text);
                        console.log(obj);
                        if (obj.costo) {
                            document.getElementById("costoDescuento").value = obj.costo;
                            document.getElementById("codigoDescuento").value = codigo.value;
                        }
                        if (obj.discount) {
                            document.getElementById("discountDescuento").value = obj.discount;
                            document.getElementById("codigoDescuento").value = codigo.value;
                        }
                        document.getElementById("idDescuento").value = obj.id;
                        calcularDescuentos();

                        document.getElementById("showSpinner").style.visibility = "hidden";
                    }
                });
        }
    }

    jQuery(document).ready(function() {

        jQuery("#checkboxWebinar").prop("checked", false);

        var checkboxWebinar = jQuery("#checkboxWebinar");
        var costoTotal_ = parseFloat(document.getElementById("costoTotal").value);

        jQuery("#agregarWebinar").on( 'change', function() {
        var idWebinar = parseFloat(document.getElementById("idWebinar").value);
        var costoWebinar = parseFloat(document.getElementById("costoWebinar").value);
        let costoDescuento = document.getElementById("costoDescuento").value;
        let discountDescuento = document.getElementById("discountDescuento").value;

            if( jQuery(this).is(':checked') ) {
                checkboxWebinar.addClass("webinar-checked");
                newCostoTotal = costoTotal_ + costoWebinar;
                document.getElementById("costoTotal").value = newCostoTotal;
                document.getElementById("valorTotalConDescuentos").innerHTML = newCostoTotal;
                document.getElementById("webinar").value = idWebinar;

                // Hacer algo si el checkbox ha sido seleccionado
                //alert("El checkbox con valor " + jQuery(this).val() + " ha sido seleccionado");
            } else {
                let costoTotalInicial = parseFloat(document.getElementById("costoTotalInicial").value);
                checkboxWebinar.removeClass("webinar-checked");
                document.getElementById("costoTotal").value = costoTotalInicial;
                document.getElementById("valorTotalConDescuentos").innerHTML = costoTotalInicial;
                document.getElementById("webinar").value = "";
            }

            calcularDescuentos();

        });

        /*
        jQuery('button.borrar').on('click', function() {
            maleta = jQuery(this).data("maleta");
            console.log('maleta', maleta);
            var index = carrito.indexOf(parseInt(maleta));
            if (index) >= 0) {
                carrito.splice(index, 1);
            }
            console.log('carrito', carrito);
            localStorage.setItem('carrito', JSON.stringify(carrito));
            localStorage.setItem('carrito', 'null');
            window.location.href = '/comprar-maleta.html?borrarmaleta=' + maleta;
        });
        */
    });

</script>




<div id="showSpinner" class="showSpinner">
    <div class="loader"></div>
</div>
    <section class="page checkout">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="comprar-maleta">
                        <div class="carrito-container">
                            <h1 class="page-title mb-4"><?php echo JText::_('BINNAKLE_DETALLE_DE_TU_PEDIDO');?></h1>
                            <?php
                            $ofrecerWebinar = null;
                                $totalMaletasComprar = 0;
                                $costoTotal = 0;
                                $purchase_units = [];
                                $description = "";
                                $tabla = '<table>';
                                foreach ($carrito as $item) {
                                    if($item->webinar == 1){
                                        if($item->id<10){
                                            $ofrecerWebinar = 7;
                                        }else if($item->id < 20){
                                            $ofrecerWebinar = 20;
                                        }
                                    }
                                    $totalMaletasComprar++;
                                    $tabla .= '
                                    <tr>
                                        <td class="item-name">' . $item->name . '</td><td class="item-costo">' . number_format($item->costo, 2, ',', '.') . '€</td><td> <a href="comprar-maleta.html?borrarmaleta=' . $item->id . '"> <span style="
                                        padding-left: 10px;" class="far fa-trash-alt"><span></a></td>
                                    </tr>
                                    <tr>
                                        <td class="item-detail">' . $item->detail . '</td><td></td><td></td>
                                    </tr>
                                ';

                                    $costoTotal += $item->costo;

                                    if ($totalMaletasComprar > 1) {
                                        $description = $description . " / ";
                                    }

                                    $description = $description . $item->name . "";

                                    /*$unit = new JObject;
                            $unit->description = $item->name;
                            $unit->amount = new JObject;
                            $unit->amount->value = $item->costo;                            
                            $purchase_units[] = $unit;*/
                                }

                                if($ofrecerWebinar){
                                    $webinar = $maletas[$ofrecerWebinar];
                                    $tabla .= '
                                    <tr><td><p><br></p></td></tr>
                                    <tr id="checkboxWebinar">
                                        <td><span class="item-name"><label>
                                        <input type="checkbox" name="agregarWebinar" id="agregarWebinar" value="' . $webinar->id .'">
                                        '.JText::_('BINNAKLE_ANIADIR').' ' . $webinar->name . '</span></label><br><span class="item-detail">' . $webinar->detail .'</td><td class="item-costo">' . number_format($webinar->costo, 2, ',', '.') . '€</span></td>
                                    </tr>';
                                    ?>                                    
                                    <input type="hidden" name="idWebinar" id="idWebinar" value="<?php echo $webinar->id; ?>">
                                    <input type="hidden" name="costoWebinar" id="costoWebinar" value="<?php echo $webinar->costo; ?>">
                                    <?php
                                }

                                $tablaFooter = "";

                                $tablaFooter .= '<tr><td><p></p></td></tr>
                                    <tr class="tr-carrito-descuentos"  id="tr-carrito-descuentos">
                                        <td class="item-name"><span>'.JText::_("BINNAKLE_CODIGO_PROMOCIONAL").'</span></td><td class="item-costo">-<span id="valorTotalDescuentos"></span>€</td>
                                    </tr>
                                ';
                                $tablaFooter .= '
                                    <tr class="tr-carrito-total">
                                        <td class="item-name"><span>TOTAL </span></td><td class="item-costo"><span id="valorTotalConDescuentos">' . number_format($costoTotal, 2, ',', '.') . '</span>€</td>
                                    </tr>
                                ';


                                echo $tabla;
                                ?>

<input type="hidden" name="costoTotalInicial" id="costoTotalInicial" value="<?php echo $costoTotal; ?>">

                            <tr class="tr-carrito-separator">
                                <td colspan="2">
                                    <p><br></p>
                                </td>
                            </tr>

                            <tr class="tr-carrito-promo">
                                <td class="item-promo-texto" colspan="2">
                                    <form class="form-inline" action="">
                                        <div class="form-validar-codigo">
                                            <div class="label-validar-codigo">
                                                <label for="codigo"><?php echo JText::_('BINNAKLE_CODIGO_PROMOCIONAL');?> </label>
                                            </div>
                                            <div class="div-validar-codigo">
                                                <input type="text" class="form-control" id="validarCodigoDescuento" name="codigo" value="">
                                                <br>
                                                <button onclick="validarCodigo()" type="button" class="validar-codigo"
                                                id="validar-codigo"><?php echo JText::_('BINNAKLE_VALIDAR_CODIGO');?></button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>

                            <?php
                                echo $tablaFooter;
                                ?>

                            <tr class="calculo-impuestos">
                                <td colspan="2">
                                    <p><?php echo JText::_('BINNAKLE_CALCULAREMOS');?></p>
                                </td>
                            </tr>

                            </table>

                            <!--
                        <div class="carrito-totales">
                            <div class="carrito-total">
                                <span>TOTAL </span><?php echo number_format($costoTotal, 2); ?> €
                            </div>
                            <div class="ver-resto">
                                <a class="btn btn-primary btn-white float-right" href="/maletas.html">Seguir comprando</a>
                            </div>
                        </div>
                        -->

                        </div>

                        <div id="paypal-button-container"></div>
                        <p><br></p>

                    </div>

                </div>
            </div>
        </div>

        <?php
            //echo '<pre>'.print_r($this->comprador); echo '</pre>';
            ?>

        <form action="" method="post" class="form-contacto form-validate form-horizontal well">
            <div class="container formulario">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="formulario-columna">
                            <div class="formulario-titulo">
                                <span>1 - <?php echo JText::_('BINNAKLE_DATOS_DE_CONTACTO');?></span>
                            </div>

                            <div class="formulario-campos">

                                <div class="form-group">
                                    <label for="nombre" class="col-form-label"><?php echo JText::_('BINNAKLE_CONTACTO_NOMBRE'); ?>*</label>
                                    <div>
                                        <input type="text" class="form-control required" name="nombre" id="nombre" value="<?php echo $this->comprador['nombre']; ?>" required aria-required="true" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="apellido" class="col-form-label"><?php echo JText::_('BINNAKLE_CONTACTO_APELLIDO'); ?>*</label>
                                    <div>
                                        <input type="text" class="form-control required" name="apellido" id="apellido" value="<?php echo $this->comprador['apellido']; ?>" required aria-required="true" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="empresa" class="col-form-label"><?php echo JText::_('BINNAKLE_CONTACTO_EMPRESA'); ?>*</label>
                                    <div>
                                        <input type="text" class="form-control required" name="empresa" id="empresa" value="<?php echo $this->comprador['empresa']; ?>" required aria-required="true" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cargo" class="col-form-label"><?php echo JText::_('BINNAKLE_CONTACTO_CARGO'); ?></label>
                                    <div>
                                        <input type="text" class="form-control" name="cargo" id="cargo" value="<?php echo $this->comprador['cargo']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pais" class="col-form-label"><?php echo JText::_('BINNAKLE_CONTACTO_PAIS'); ?>*</label>
                                    <div>
                                        <?php
                                            echo JHTML::_('select.genericlist', $this->paises, 'pais', 'class="form-control required"', 'id', 'name', $this->comprador['pais'], 'pais');
                                            ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="telefono" class="col-form-label"><?php echo JText::_('BINNAKLE_CONTACTO_TELEFONO'); ?>*</label>
                                    <div>
                                        <input type="text" class="form-control required" name="telefono" id="telefono" value="<?php echo $this->comprador['telefono']; ?>" required aria-required="true" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-form-label required"><?php echo JText::_('BINNAKLE_CONTACTO_EMAIL'); ?>*</label>
                                    <div>
                                        <input type="email" class="form-control" name="email" id="email" value="<?php echo $this->comprador['email']; ?>" required aria-required="true" />
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="formulario-columna">
                            <div class="formulario-titulo">
                                <span>2 - <?php echo JText::_('BINNAKLE_DATOS_DE_FACTURACION');?></span>
                            </div>

                            <div class="formulario-campos">

                                <div class="form-group">
                                    <label for="nombre" class="col-form-label"><?php echo JText::_('COM_COMPRAS_NOMBRE_RAZON_SOCIAL'); ?>*</label>
                                    <div>
                                        <input type="text" class="form-control required" name="factura_nombre" id="factura_nombre" value="<?php echo $this->comprador['factura_nombre']; ?>" required aria-required="true" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="factura_nif" class="col-form-label"><?php echo JText::_('COM_COMPRAS_IDENTIFICACION_FISCAL'); ?>*</label>
                                    <div>
                                        <input type="text" class="form-control required" name="factura_nif" id="factura_nif" value="<?php echo $this->comprador['factura_nif']; ?>" required aria-required="true" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="apellido" class="col-form-label"><?php echo JText::_('COM_COMPRAS_DOMICILIO'); ?>*</label>
                                    <div>
                                        <input type="text" class="form-control required" name="factura_domicilio" id="factura_domicilio" value="<?php echo $this->comprador['factura_domicilio']; ?>" required aria-required="true" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pais" class="col-form-label"><?php echo JText::_('BINNAKLE_CONTACTO_PAIS'); ?>*</label>
                                    <div>
                                        <?php

                                        //$paises_ = new JObject;$paises_->id = null;$paises_->name = "Seleccione país";array_unshift($this->paises,$paises_);
                                           //print_r($this->paises);
                                            echo JHTML::_('select.genericlist', $this->paises, 'factura_pais', 'class="form-control required"', 'id', 'name', $this->comprador['factura_pais'], 'factura_pais');
                                            ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="factura_provincia" class="col-form-label"><?php echo JText::_('COM_COMPRAS_PROVINCIA'); ?>*</label>
                                    <div>
                                        <input type="text" class="form-control required" name="factura_provincia" id="factura_provincia" value="<?php echo $this->comprador['factura_provincia']; ?>" required aria-required="true" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="factura_ciudad" class="col-form-label"><?php echo JText::_('COM_COMPRAS_CIUDAD'); ?>*</label>
                                    <div>
                                        <input type="text" class="form-control required" name="factura_ciudad" id="factura_ciudad" value="<?php echo $this->comprador['factura_ciudad']; ?>" required aria-required="true" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="telefono" class="col-form-label"><?php echo JText::_('COM_COMPRAS_ZIP'); ?>*</label>
                                    <div>
                                        <input type="text" class="form-control required" name="factura_zip" id="factura_zip" value="<?php echo $this->comprador['factura_zip']; ?>" required aria-required="true" />
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="formulario-columna">
                            <div class="formulario-titulo">
                                <span>3 - <?php echo JText::_('BINNAKLE_DATOS_DE_ENVIO');?></span>
                            </div>

                            <div class="formulario-campos">

                                <div class="form-check checkbox-mismos">
                                    <input class="form-check-input mismos" type="checkbox" value="1" name="mismos" id="mismos" onchange="mismosChanged(this)">
                                    <label class="form-check-label" for="mismos">
                                        <?php echo JText::_('COM_COMPRAS_MISMOS_DATOS'); ?>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label for="nombre" class="col-form-label"><?php echo JText::_('COM_COMPRAS_NOMBRE_RAZON_SOCIAL'); ?>*</label>
                                    <div>
                                        <input type="text" class="form-control required" name="envio_nombre" id="envio_nombre" value="<?php echo $this->comprador['envio_nombre']; ?>" required aria-required="true" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="apellido" class="col-form-label"><?php echo JText::_('COM_COMPRAS_DOMICILIO'); ?>*</label>
                                    <div>
                                        <input type="text" class="form-control required" name="envio_domicilio" id="envio_domicilio" value="<?php echo $this->comprador['envio_domicilio']; ?>" required aria-required="true" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pais" class="col-form-label"><?php echo JText::_('BINNAKLE_CONTACTO_PAIS'); ?>*</label>
                                    <div>
                                        <?php
                                            echo JHTML::_('select.genericlist', $this->paises, 'envio_pais', 'class="form-control required"', 'id', 'name', $this->comprador['envio_pais'], 'envio_pais');
                                            ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="envio_provincia" class="col-form-label"><?php echo JText::_('COM_COMPRAS_PROVINCIA'); ?>*</label>
                                    <div>
                                        <input type="text" class="form-control required" name="envio_provincia" id="envio_provincia" value="<?php echo $this->comprador['envio_provincia']; ?>" required aria-required="true" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="envio_ciudad" class="col-form-label"><?php echo JText::_('COM_COMPRAS_CIUDAD'); ?>*</label>
                                    <div>
                                        <input type="text" class="form-control required" name="envio_ciudad" id="envio_ciudad" value="<?php echo $this->comprador['envio_ciudad']; ?>" required aria-required="true" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="telefono" class=" col-form-label"><?php echo JText::_('COM_COMPRAS_ZIP'); ?>*</label>
                                    <div>
                                        <input type="text" class="form-control required" name="envio_zip" id="envio_zip" value="<?php echo $this->comprador['envio_zip']; ?>" required aria-required="true" />
                                    </div>
                                </div>

                                <div class="form-check checkbox-mismos">
                                    <input class="form-check-input acepta_politicas" type="checkbox" value="1" name="acepta_politicas" id="acepta_politicas" required>
                                    <label class="form-check-label" for="acepta_politicas">
                                        <?php
                                        if ($this->language == 'es-es') {
                                        $href= './aviso-legal-y-politica-de-privacidad.html';
                                        }else{
                                            $href= './en/general-conditions-of-sale.html';
                                        }
                                        ?>
                                        <?php echo JText::_('BINNAKLE_POLITICA_HE_LEIDO'); ?> <a class="link-politicas" target="blank_" href="<?php echo $href;?>"><?php echo JText::_('BINNAKLE_CONDICIONES_GENERALES_DE_COMPRA'); ?></a>
                                    </label>
                                </div>

                                <button name="comprar_enviada" type="submit" class="btn btn-primary btn-white float-right"><?php echo JText::_('COM_COMPRAS_ACEPTAR'); ?></button>

                                <div style="clear: both;"></div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <input type="hidden" name="pagar" value="1">
            <input type="hidden" name="idDescuento" id="idDescuento">
            <input type="hidden" name="codigoDescuento" id="codigoDescuento">
            <input type="hidden" name="costoDescuento" id="costoDescuento" value="0">
            <input type="hidden" name="discountDescuento" id="discountDescuento" value="0">
            <input type="hidden" name="costoTotal" id="costoTotal" value="<?php echo $costoTotal; ?>">
            
            <input type="hidden" name="webinar" id="webinar">

        </form>
    </section>
    <p><br></p>
    <p><br></p>

    <script type="text/javascript">
        function mismosChanged(e) {
            let envio_nombre = document.getElementById('envio_nombre');
            let factura_nombre = document.getElementById('factura_nombre');
            let envio_domicilio = document.getElementById('envio_domicilio');
            let factura_domicilio = document.getElementById('factura_domicilio');
            let envio_pais = document.getElementById('envio_pais');
            let envio_provincia = document.getElementById('envio_provincia');
            let envio_ciudad = document.getElementById('envio_ciudad');

            let factura_pais = document.getElementById('factura_pais');
            let factura_provincia = document.getElementById('factura_provincia');
            let factura_ciudad = document.getElementById('factura_ciudad');
            let envio_zip = document.getElementById('envio_zip');
            let factura_zip = document.getElementById('factura_zip');
            if (e.checked) {
                console.log('checked');
                envio_nombre.value = factura_nombre.value;
                envio_domicilio.value = factura_domicilio.value;
                envio_pais.value = factura_pais.value;
                envio_provincia.value = factura_provincia.value;
                envio_ciudad.value = factura_ciudad.value;
                envio_zip.value = factura_zip.value;
            } else {
                console.log('nooooo');
                envio_nombre.value = "";
                envio_domicilio.value = "";
                envio_pais.value = "";
                envio_provincia.value = "";
                envio_ciudad.value = "";
                envio_zip.value = "";
            }
            console.log('e', e);
            console.log('mismosChanged');
        }

        jQuery(document).ready(function() {
            jQuery("a.link-politicas").click(function(event) {
                event.preventDefault();
                jQuery('#politicas-modal').modal({
                    show: true
                });
            });
        });
    </script>

<?php
}


?>

<div class="modal fade politicas-modal" id="politicas-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div id="politicas-modal">
                <?php if ($this->language == 'es-es') { ?>
                    <iframe class="iframe-politicas" width="100%" height="500" src="./condiciones-generales-de-venta.html?tmpl=component" frameborder="0"></iframe>
                <?php } else { ?>
                    <iframe class="iframe-politicas" width="100%" height="500" src="./en/general-conditions-of-sale.html?tmpl=component" frameborder="0"></iframe>
                <?php } ?>
            </div>
        </div>
    </div>
</div>