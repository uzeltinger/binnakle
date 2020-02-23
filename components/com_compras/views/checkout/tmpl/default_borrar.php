<?php
$maletas = [];
$maletas[0] = new JObject;
$maletas[0]->titulo = "tituloMaleta";
$maletas[0]->precio = 1.00;
$maletas[1] = new JObject;
$maletas[1]->titulo = "Maleta Binnakle The Expedition + Pack de partidas en la plataforma Binnakle The expedition";
$maletas[1]->precio = 0.10;
$maletas[2] = new JObject;
$maletas[2]->titulo = "Maleta Binnakle The Expedition + Pack de partidas + Formación vía Webinar";
$maletas[2]->precio = 0.20;
$maletas[3] = new JObject;
$maletas[3]->titulo = "Partidas adicionales (Ya tengo una Maleta Binnakle The Expedition)";
$maletas[3]->precio = 0.30;
$maletas[4] = new JObject;
$maletas[4]->titulo = "Pack de partidas en la plataforma Binnakle Mission 0";
$maletas[4]->precio = 0.40;
$maletas[5] = new JObject;
$maletas[5]->titulo = "Pack de partidas en la plataforma Binnakle Mission 0 + Formación para dinamizadores internos vía Webinar";
$maletas[5]->precio = 0.50;
$maletas[6] = new JObject;
$maletas[6]->titulo = "KIT de ideación Binnakle";
$maletas[6]->precio = 0.60;


if (JRequest::getInt('maleta')) {
    $maletaId = JRequest::getInt('maleta');
    $session = JFactory::getSession();
    $session->set('maleta', JRequest::getInt('maleta'));
    //echo "maleta is: " . $session->get('maleta', 0);

    $maleta = $maletas[$maletaId];

    ?>

    <!--<script src="https://www.paypal.com/sdk/js?client-id=AZ6cGShTBpw5t6-vAQosRT9C5366JWdMeGjWzAlDntCWlDAxkzXo5xrug3dR0yEY2pRHvQauBbdPu2Fe&locale=es_ES">-->
    <script src="https://www.paypal.com/sdk/js?client-id=AQjc5obDnET1dhukTQMMVpok6phTEjsHjECD7_NCY2AlcrjKDYG0n14r2F5mZ_c1O_yvak7zYwAZIu-r&locale=es_ES">
    </script>

    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="comprar-maleta">

                    <h1>Comprar Maleta:</h1>
                    <h2><?php echo $maleta->titulo; ?> <?php echo $maleta->precio; ?>€</h2>
                    <p><br></p>
                    <div id="paypal-button-container"></div>
                    <p><br></p>

                </div>

            </div>
        </div>
    </div>



    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        reference_id: '<?php echo $maletaId; ?>',
                        description: '<?php echo $maleta->titulo; ?>',
                        amount: {
                            value: '<?php echo $maleta->precio; ?>'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // Capture the funds from the transaction
                return actions.order.capture().then(function(details) {
                    // Show a success message to your buyer
                    console.log('details', details);
                    console.log('details.payer', details.payer);
                    alert('Compra completada. Gracias ' + details.payer.name.given_name + ' ' + details.payer.name.surname);
                    //window.location.href = '/comprar.html?maleta=' + maleta;
                    
                    console.log('name', details.payer.name.given_name);
                    console.log('surname', details.payer.name.surname);
                    console.log('country_code', details.payer.address.country_code);
                    console.log('email_address', details.payer.email_address);                    
                    console.log('value', details.purchase_units[0].amount.value);
                    console.log('currency_code', details.purchase_units[0].amount.currency_code);
                    console.log('description', details.purchase_units[0].description);
                    
                    let data = { 
                        name: details.payer.name.given_name, 
                        surname: details.payer.name.surname,
                        country_code: details.payer.address.country_code, 
                        email_address: details.payer.email_address, 
                        value: details.purchase_units[0].amount.value, 
                        currency_code: details.purchase_units[0].amount.currency_code, 
                        description: details.purchase_units[0].description
                        }
                    jQuery.post("https://binnakle.com/comprar.html?send-email=1", data, function(result){
                        console.log('result', result);
                    });
                    
                });
            }
        }).render('#paypal-button-container');
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