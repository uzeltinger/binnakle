<?php
$maletas = $this->maletas;
$carrito = $this->carrito;
$paises = $this->paises;
if(!isset($this->paises[$this->comprador['envio_pais']])){
    
    ?>
<script></script>
    <?php
}
$pais_envio = $this->paises[$this->comprador['envio_pais']];
$pais_facturacion = $this->paises[$this->comprador['factura_pais']];
$comprador = $this->comprador;
$descuento = $this->descuento;
//echo 'descuento'.$descuento;
//echo $pais_facturacion->id; die($pais_facturacion->id);
switch ($pais_facturacion->id) {
    case 1: //ar
        $pais_code = 'AR';
        $textoImpuestos = JText::_('BINNAKLE_IVA_OTROS_IMPUESTOS');
        $textoTotal = "TOTAL ";
        break;
    case 194: //es
        $pais_code = 'ES';
        $textoImpuestos = "IVA 21%";
        $textoTotal = JText::_('BINNAKLE_TOTAL_IVA_INCLUIDO');
        break;
    case 3: //eng
        $pais_code = 'GB';
        break;
    case 4: //eng
        $pais_code = 'CH';
        break;

    default:
        $pais_code = 'AR';
        $textoImpuestos = JText::_('BINNAKLE_IVA_OTROS_IMPUESTOS');
        $textoTotal = "TOTAL ";
        break;
}
if (count($carrito) > 0) {
    ?>
    
    

<script>
    console.log('carrito', <?php echo json_encode($carrito); ?>);
    console.log('paises', <?php echo json_encode($paises); ?>);
    console.log('fabio');
</script>
<section class="page checkout">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="page-title"><?php echo JText::_('BINNAKLE_RESUMEN_DE_TU_PEDIDO');?></h1>
                <div class="comprar-maleta">
                    <div class="carrito-container resumen-container">

                    <table class="table bordered">
                        
                        <?php
                            $totalMaletasComprar = 0;
                            $costoTotal = 0;
                            $purchase_units = [];
                            $description = "";
                            $envio_costo = 0;                            
                            foreach ($carrito as $item) {
                                $totalMaletasComprar++;
                                echo '<tr><td>
                                <div class="item item-game-' . $item->game . '">
                                    <div class="item-name">' . $item->name . '</div>                                
                                    <div class="item-detail">' . $item->detail . '</div>                                
                                </div>
                                </td>
                                ';
                                echo '<td nowrap class="text-align-right"><div class="item-costo">' . number_format($item->costo, 2, ',', '.') . ' €</div></td></tr>';
                                $costoTotal += $item->costo;

                                if ($totalMaletasComprar > 1) {
                                    $description = $description . " / ";
                                }

                                $description = $description . $item->name . "";

                                if($item->envio){
                                    $envio_costo = $pais_envio->envio_costo;
                                }
                            }
                            if($descuento>0){
                                $costoTotal = $costoTotal - $descuento;                                
                            }

                            //$costoTotal = 1000;

                            $envio_name = $pais_envio->envio_name;
                            
                            $envio_dias = $pais_envio->envio_dias;
                            $impuesto_name = $pais_facturacion->impuesto_name;
                            $impuesto_value = $pais_facturacion->impuesto_value;
                            $costo = $costoTotal;
                            $costoTotal = $costoTotal + $envio_costo;



                            $impuesto = round(($costoTotal / 100) * $impuesto_value, 2);

                            $total = $costoTotal + $impuesto;
                            ?>

                        <?php if($descuento>0){ ?>
                        <tr>
                        <td class="text-align-right"><?php echo JText::_('BINNAKLE_CODIGO_PROMOCIONAL');?></td><td nowrap class="text-align-right">-<?php echo number_format($descuento, 2, ',', '.'); ?> €</td>
                        </tr>
                        <?php } ?>
                        <?php if($envio_costo>0){ ?>
                        <tr>
                        <td class="text-align-right"><?php echo JText::_('BINNAKLE_GASTOS_DE_ENVIO');?></td><td nowrap class="text-align-right"><?php echo number_format($envio_costo, 2, ',', '.'); ?> €</td>
                        </tr>
                        <?php } ?>

<?php if($impuesto>0){ ?>
    
                        <tr>
                        <td class="text-align-right">TOTAL</td><td nowrap class="text-align-right"><?php echo number_format($costoTotal, 2, ',', '.'); ?> €</td>
                        </tr>
                        <tr>
                        <td class="text-align-right"><?php echo $textoImpuestos;?></td><td nowrap class="text-align-right"><?php echo number_format($impuesto, 2, ',', '.'); ?> €</td>
                        </tr>
<?php } ?>
                        <tr>
                        <td class="text-align-right"><b><?php echo $textoTotal;?> </b></td><td nowrap class="text-align-right"><b><?php echo number_format($total, 2, ',', '.'); ?> €</b></td>
                        </tr>
                        <?php if($envio_costo>0){ ?>
                        <tr>
                        <td><?php echo JText::_('BINNAKLE_PLAZO_DE_ENTREGA');?> <?php echo $envio_dias; ?> <?php echo JText::_('BINNAKLE_PLAZO_DE_ENTREGA_DIAS');?></td><td></td>
                        </tr>
                        <?php } ?>
                        </tr>
                    </table>

                        <p><br></p>
                        
                        <h2><?php echo JText::_('BINNAKLE_FORMA_DE_PAGO');?>*</h2>
                        
                    </div>

                    <div class="paypal-button-container" id="paypal-button-container"></div>
                    <p><br></p>

                </div>
                
                <div class="transferencia">
                    <div class="recuadro">
                        <div class="left">
                            <p class="checktext"><?php echo JText::_('BINNAKLE_QUIERO_PAGAR_TRANSFERENCIA');?></p>
                            <p class="peque"><?php echo JText::_('BINNAKLE_QUIERO_PAGAR_TRANSFERENCIA_AL_ACEPTAR');?></p>
                        </div>
                        <div class="right">
                            <form action="" metod="POST">
                                <button class="btn btn-default btn-white" type="submit" value="Aceptar"><?php echo JText::_('COM_COMPRAS_ACEPTAR'); ?></button>
                                <input type="hidden" name="pago_transferencia" value="1">
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>



<div class="container">
    <div class="row">
        <div class="col-12">

            <p class="hipper-small"><?php echo JText::_('BINNAKLE_CHECKOUT_LEGALES');?>
                
            </p>

        </div>
    </div>
</div>
<p><br></p>

<!-- sanbox <script src="https://www.paypal.com/sdk/js?client-id=AS4lYTtG_YsXXoK0cLW63zrWw0u8ItDrbcM3oYhEope6g0yq5lR-_FFbBBIMiZmeYoDpVMj1T9-ymZ4o&locale=es_ES&currency=EUR"></script>-->

<?php if($this->lang=='en'){ ?>
    <script src="https://www.paypal.com/sdk/js?client-id=AQjc5obDnET1dhukTQMMVpok6phTEjsHjECD7_NCY2AlcrjKDYG0n14r2F5mZ_c1O_yvak7zYwAZIu-r&locale=en_GB&currency=USD"></script>
<?php }else{ ?>
    <script src="https://www.paypal.com/sdk/js?client-id=AQjc5obDnET1dhukTQMMVpok6phTEjsHjECD7_NCY2AlcrjKDYG0n14r2F5mZ_c1O_yvak7zYwAZIu-r&locale=es_ES&currency=EUR"></script>
<?php } ?>
<?php
    //print_r( $pais_envio );
    //purchase_units: <?php echo json_encode($purchase_units);

    $descriptionPaypal = substr($description,0,125);
    $descriptionPaypal = strip_tags($descriptionPaypal);
    $descriptionPaypal = str_replace(PHP_EOL, '', $descriptionPaypal);
    $descriptionPaypal = str_replace(array("\n", "\r"), '', $descriptionPaypal);
    //echo $descriptionPaypal;
    ?>
    
<script>
    //let comprador = <?php echo json_encode($this->comprador);?>;
    //console.log('comprador',comprador);
    paypal.Buttons({
        createOrder: function(data, actions) {
            var currency_code = "<?php if($this->lang=='en'){ ?>USD<?php }else{ ?>EUR<?php } ?>";
                let dataSend = {
                email: "<?php echo $comprador['email']; ?>",
                address_details: {
                    street_name: "<?php echo $comprador['factura_domicilio']; ?>",
                    country_code: "<?php echo $pais_code; ?>"
                },
                purchase_units: [{
                    invoice_id: "<?php echo $this->reference_id; ?>",
                    custom_id: "<?php echo $this->reference_id; ?>",
                    reference_id: "<?php echo $this->reference_id; ?>",
                    description: "<?php echo $descriptionPaypal; ?>",
                    shipping: {
                        name: {
                            full_name: "<?php echo $comprador['nombre'] . ' ' . $comprador['apellido']; ?>"
                        },
                        address_line_1: "<?php echo $comprador['envio_domicilio']; ?>",
                        postal_code: "<?php echo $comprador['envio_zip']; ?>",
                        country_code: "<?php echo $pais_code; ?>"
                    },
                    amount: {
                        value: <?php echo $total; ?>,
                        breakdown: {
                            item_total: {
                                currency_code: currency_code,
                                value: <?php echo $costo; ?>
                            },
                            shipping:  {
                                currency_code: currency_code,
                                value: <?php echo number_format($envio_costo, 2, '.', ','); ?>
                            },                            
                            tax_total:  {
                                currency_code: currency_code,
                                value: <?php echo number_format($impuesto, 2, '.', ','); ?>
                            }
                        }
                    },
                    items: [
                        {
                            name:"<?php echo $descriptionPaypal; ?>",
                            unit_amount: {
                                currency_code: currency_code,
                                value: <?php echo $costo; ?>
                            },
                            tax: {
                                currency_code: currency_code,
                                value: <?php echo number_format($impuesto, 2, '.', ','); ?>
                            },
                            quantity: 1
                        }
                    ]
                }]

            };
            //console.log(dataSend);
            return actions.order.create(dataSend);
        },
        onApprove: function(data, actions) {
                console.log('data', data);
                console.log('actions', actions);
            // Capture the funds from the transaction
            return actions.order.capture().then(function(details) {
                // Show a success message to your buyer
                console.log('details', details);
                console.log('details.payer', details.payer);
                //alert('Compra completada. Gracias ' + details.payer.name.given_name + ' ' + details.payer.name.surname);                
                console.log('name', details.payer.name.given_name);
                console.log('surname', details.payer.name.surname);
                console.log('country_code', details.payer.address.country_code);
                console.log('email_address', details.payer.email_address);
                console.log('value', details.purchase_units[0].amount.value);
                console.log('currency_code', details.purchase_units[0].amount.currency_code);
                console.log('description', details.purchase_units[0].description);

                /*
                let dataSendPost = {
                    name: details.payer.name.given_name,
                    surname: details.payer.name.surname,
                    country_code: details.payer.address.country_code,
                    email_address: details.payer.email_address,
                    value: details.purchase_units[0].amount.value,
                    currency_code: details.purchase_units[0].amount.currency_code,
                    description: details.purchase_units[0].description
                }
                
                jQuery.post("https://binnakle.com/comprar.html?send-email=1", data, function(result) {
                    console.log('result', result);
                });
                */
                let comprador = <?php echo json_encode($this->comprador);?>;
                var body = {data: data, details: details, comprador: comprador};

                let dominio = '<?php echo JUri::base();?>';//'https://binnakle.com';//'http://binnakle.joomla';
                <?php 
                if($this->lang=='en'){
                    ?>
                    dominio = dominio + 'en/';
                    <?php
                }
                ?>
                var order = 0;
                fetch(dominio + 'comprar-maleta.html?pago_online=4', {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({body: body}) //JSON.stringify({orderID: data.orderID})
                }).then(function(response) {
                    if(response.ok) {
                        return response.text();
                    } else {
                        console.log('Respuesta de red OK.');
                        alert('Ocurrió un error');
                    }
                })
                .then(function(text) {
                    console.log('text',text);
                    window.location.href = dominio + 'comprar-maleta.html?pago_online=1' + '&order=' + text;
                });
                setTimeout(() => {
//                    window.location.href = dominio + '/comprar-maleta.html?pago_online=1' + '&order=' + order;
                }, 100);
            });
        }
    }).render('#paypal-button-container');











/*
    var body = '{"body":{"data":{"orderID":"88C40130B6167821W","payerID":"2BSRD3R7UWQ76"},"details":{"create_time":"2019-09-25T18:08:42Z","update_time":"2019-09-25T18:08:42Z","id":"88C40130B6167821W","intent":"CAPTURE","status":"COMPLETED","payer":{"email_address":"comprador2-paypal@binnakle.com","payer_id":"2BSRD3R7UWQ76","address":{"country_code":"ES"},"name":{"given_name":"comprador","surname":"comprador"}},"purchase_units":[{"description":"Maleta Binnakle The Expedition + 1 año de tarifa plana / Añadir Webinar de formación para dinamizadores internos","reference_id":"1569434894","custom_id":"1569434894","invoice_id":"1569434894","soft_descriptor":"PAYPAL *VENDEDORPAY","amount":{"value":"4810.00","currency_code":"EUR","breakdown":{"item_total":{"value":"3700.00","currency_code":"EUR"},"shipping":{"value":"333.00","currency_code":"EUR"},"handling":{"value":"0.00","currency_code":"EUR"},"tax_total":{"value":"777.00","currency_code":"EUR"},"insurance":{"value":"0.00","currency_code":"EUR"},"shipping_discount":{"value":"0.00","currency_code":"EUR"}}},"payee":{"email_address":"vendedor-paypal@binnakle.com","merchant_id":"NQPUEEK4JKSNG"},"items":[{"name":"Maleta Binnakle The Expedition + 1 año de tarifa plana / Añadir Webinar de formación para dinamizadores internos","unit_amount":{"value":"3700.00","currency_code":"EUR"},"tax":{"value":"777.00","currency_code":"EUR"},"quantity":"1"}],"shipping":{"name":{"full_name":"comprador comprador"},"address":{"address_line_1":"calle Vilamarï¿½ 76993- 17469","admin_area_2":"Albacete","admin_area_1":"Albacete","postal_code":"02001","country_code":"ES"}},"payments":{"captures":[{"status":"COMPLETED","id":"1G313083BP551041E","invoice_id":"1569434894","final_capture":true,"create_time":"2019-09-25T18:08:42Z","update_time":"2019-09-25T18:08:42Z","amount":{"value":"4810.00","currency_code":"EUR"},"seller_protection":{"status":"ELIGIBLE","dispute_categories":["ITEM_NOT_RECEIVED","UNAUTHORIZED_TRANSACTION"]},"links":[{"href":"https://api.sandbox.paypal.com/v2/payments/captures/1G313083BP551041E","rel":"self","method":"GET","title":"GET"},{"href":"https://api.sandbox.paypal.com/v2/payments/captures/1G313083BP551041E/refund","rel":"refund","method":"POST","title":"POST"},{"href":"https://api.sandbox.paypal.com/v2/checkout/orders/88C40130B6167821W","rel":"up","method":"GET","title":"GET"}]}]}}],"links":[{"href":"https://api.sandbox.paypal.com/v2/checkout/orders/88C40130B6167821W","rel":"self","method":"GET","title":"GET"}]},"comprador":{"nombre":"fabio","apellido":"fabio","empresa":"fabio","cargo":"fabio","pais":"10","telefono":"fabio","email":"fuzeltinger@evoltis.com","factura_nif":"fabio","factura_nombre":"fabio","factura_domicilio":"fabio","factura_pais":"10","factura_provincia":"fabio","factura_ciudad":"fabio","factura_zip":"fabio","envio_nombre":"fabio","envio_domicilio":"fabio","envio_pais":"10","envio_provincia":"fabio","envio_ciudad":"fabio","envio_zip":"fabio"}}}';

*/


</script>

<?php



} else {

    ?>

<script>
    function loadComprarModal() {
        jQuery('#comprar-modal').modal({
            show: true
        });
    }

    function loadPagarModal() {
        jQuery('#pagar-modal').modal({
            show: true
        });
    }
    jQuery(document).ready(function() {
        var maleta = 0;
        jQuery('button.comprar').on('click', function() {
            //loadComprarModal();
            maleta = jQuery(this).data("maleta");
            console.log('maleta', maleta);
            localStorage.setItem('maleta', maleta);
            window.location.href = '/comprar.html?maleta=' + maleta;
        });
        jQuery('#goPaypal').on('click', function() {
            window.location.href = '/comprar.html?maleta=' + maleta;
        });
    });
</script>


<?php
}
?>