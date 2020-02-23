<?php

if (JRequest::getInt('send-email')) {
    $app = JFactory::getApplication();
    $jinput = $app->input;
    $name = $jinput->get('name', null);
    $surname = $jinput->get('surname', null);
    $country_code = $jinput->get('country_code', null);
    $email_address = $jinput->get('email_address', null, 'raw');
    $value = $jinput->get('value', null);
    $currency_code = $jinput->get('currency_code', null);
    $description = $jinput->get('description', null, 'raw');
    //print_r($jinput);

    $MailFrom    = 'binnakle@binnakle.com';
    $FromName    = 'Binnakle';
    $siteURL    = JURI::base();
    $subject    = 'Compra realizada ' . date('d-m-Y H:i:s');
    $body = '';

    $body = 'Gracias por su compra.<br>';
    $body .= '<table>';
    $body .= '<tr><td>Nombre: </td><td>' . $name . '</td></tr>';
    $body .= '<tr><td>Apellido: </td><td>' . $surname . '</td></tr>';
    $body .= '<tr><td>País: </td><td>' . $country_code . '</td></tr>';
    $body .= '<tr><td>E-mail: </td><td>' . $email_address . '</td></tr>';
    $body .= '<tr><td>Valor: </td><td>' . $value . ' ' . $currency_code . '</td></tr>';
    $body .= '<tr><td>Detalle: </td><td>' . $description . '</td></tr>';
    $body .= '</table>';

    $sender = array($MailFrom, $FromName);

    $mail = JFactory::getMailer();
    $mail->isHtml(true);
    $mail->setSender($sender);
    $mail->addRecipient($email_address);
    $mail->addBCC('fabiouz@gmail.com');
    $mail->addBCC('pagos@binnakle.com');
    $mail->addBCC('binnakle@binnakle.com');
    $mail->setSubject($subject);
    $mail->Encoding = 'base64';
    $mail->setBody($body);
    $status = $mail->Send();

    echo json_encode($status);
    $app->close();
    die();
    /*
    [send-email] => 1
[surname] => esteban
[name] => Fabio
[language] => es-ES
[format] => html
[Itemid] => 128
[option] => com_content
[lang] => es-ES
[view] => article
[id] => 118
*/
}
?>



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
//$maletas[6]->titulo = "KIT de ideación Binnakle";
//$maletas[6]->precio = 0.60;


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
                jQuery.post("https://binnakle.com/comprar.html?send-email=1", data, function(result) {
                    console.log('result', result);
                });

            });
        }
    }).render('#paypal-button-container');
</script>

<?php
} else {

    ?>


<section class="comprar">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="titulo">¡Estás a un paso de disfrutar de los Serious Games de BINNAKLE en tu empresa!</h1>
            </div>
            <div class="col-12 botones-seleccion-container">
                <div class="d-none d-lg-block">
                    <div class="botones-seleccion">
                        <div class="boton">
                            <button type="button" id="expedition" class="btn expedition"><span class="binnakle">Binnakle<span> <br class="d-lg-none"><span>The Expedition</span></button>
                        </div>
                        <div class="boton">
                            <button type="button" id="mission0" class="btn mission0"><span class="binnakle">Binnakle<span> <br class="d-lg-none"><span>Mission 0</span></button>
                        </div>
                        <!--<div class="boton">
                            <button type="button" id="kit" class="btn kit"><span class="binnakle">Binnakle<span> <br class="d-lg-none"><span>KIT Ideación</span></button>
                        </div>-->
                    </div>
                </div>
                <div class="botones-seleccion d-lg-none">
                    <div class="boton">
                        <button type="button" id="expedition_mobile" class="btn expedition"><span class="binnakle">Binnakle<span> <br class="d-lg-none"><span>The Expedition</span></button>
                    </div>
                    <div class="boton">
                        <button type="button" id="mission0_mobile" class="btn mission0"><span class="binnakle">Binnakle<span> <br class="d-lg-none"><span>Mission 0</span></button>
                    </div>
                    <!--<div class="boton">
                        <button type="button" id="kit_mobile" class="btn kit"><span class="binnakle">Binnakle<span> <br class="d-lg-none"><span>KIT Ideación</span></button>
                    </div>-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="f-s-12">Importante: La compra de material y/o partidas de los juegos BINNAKLE es para uso exclusivo interno en las organizaciones.<br>
                    <b>Sólo los partners oficiales de BINNAKLE</b> están autorizados para comercializar los Serious Games de BINNAKLE.<br>
                    Si quieres ser partner autorizado o si eres un consultor interesado en utilizar BINNAKLE con tus clientes, puedes contactar con nosotros enviando un correo a binnakle@binnakle.com</p>
            </div>
        </div>
    </div>


    <div class="container container-games d-none d-lg-block" id="expedition_target">
        <div class="row">
            <div class="col-12">
                <!--Binnakle The Expedition-->
                <h2 class="titulo titulo-expedition">Binnakle The Expedition</h2>
            </div>
        </div>
        <div class="row">

            <div class="col-9 col-juego maletas-the-expedition">
                <div class="top-categoria categoria-expedition">Quiero comprar online</div>

            </div>
            <div class="col-3 col-juego maletas-the-expedition">
                <div class="top-categoria categoria-expedition">Quiero que vengan a mi empresa</div>
            </div>
            <div class="col-12">
                <p><br></p>
            </div>

            <div class="col-3 col-juego maletas-the-expedition">

                <div class="juego-header">
                    <div class="categoria categoria-expedition">
                        <div class="categoria-titulo">Maleta Binnakle The Expedition<br>+<br>Pack de partidas en la plataforma Binnakle The expedition</div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-titulo">Maleta Binnakle The Expedition<br>+<br>1 año de tarifa plana</div>
                        <div class="maleta-precio">x.xxx €</div>
                        <div class="maleta-detalle">Podrás jugar todas las partidas que quieras durante un año</div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="1"><span>COMPRAR</span></button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-3 col-juego maletas-the-expedition">

                <div class="juego-header">
                    <div class="categoria categoria-expedition">
                        <div class="categoria-titulo">Maleta Binnakle The Expedition<br>+<br>Pack de partidas en la plataforma Binnakle The expedition<br>+<br>Formación para dinamizadores internos vía Webinar</div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-titulo">Maleta Binnakle The Expedition<br>+<br>Pack X partidas<br>+<br>Webinar*</div>
                        <div class="maleta-precio">x.xxx €</div>
                        <div class="maleta-detalle">*Formación para dinamizadores internos vía Webinar El Webinar tiene una duración de XX horas , nos pondremos en contacto contigo para agendarlo</div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="2"><span>COMPRAR</span></button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-titulo">Maleta Binnakle The Expedition<br>+<br>Pack X partidas<br>+<br>Webinar*</div>
                        <div class="maleta-precio">x.xxx €</div>
                        <div class="maleta-detalle">*Formación para dinamizadores internos vía Webinar El Webinar tiene una duración de XX horas , nos pondremos en contacto contigo para agendarlo</div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="3"><span>COMPRAR</span></button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-titulo">Maleta Binnakle The Expedition<br>+<br>1 año de tarifa plana*<br>+<br>Webinar*</div>
                        <div class="maleta-precio">x.xxx €</div>
                        <div class="maleta-detalle">*Podrás jugar todas las partidas que quieras
                            durante un año
                            *Formación para dinamizadores internos vía Webinar
                            El Webinar tiene una duración de XX horas , nos
                            pondremos en contacto contigo para agendarlo</div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="4"><span>COMPRAR</span></button>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-3 col-juego maletas-the-expedition">

                <div class="juego-header">
                    <div class="categoria categoria-expedition">
                        <div class="categoria-titulo">Partidas adicionales<br><small>(Ya tengo una Maleta Binnakle The Expedition)</small></div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-titulo">Pack X partidas*</div>
                        <div class="maleta-precio">x.xxx €</div>
                        <div class="maleta-detalle">Si ya tienes tu Maleta Binnakle The Expedition puedes comprar un pack de X partidas adicionales</div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="5"><span>COMPRAR</span></button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-titulo">Pack X partidas*</div>
                        <div class="maleta-precio">x.xxx €</div>
                        <div class="maleta-detalle">Si ya tienes tu Maleta Binnakle The Expedition puedes comprar un pack de X partidas adicionales</div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="6"><span>COMPRAR</span></button>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-titulo">1 año de tarifa plana*</div>
                        <div class="maleta-precio">x.xxx €</div>
                        <div class="maleta-detalle">*Si ya tienes tu Maleta Binnakle The Expedition
                            puedes realizar una suscripción de tarifa plana
                            anual, para jugar todas las partidas que quieras
                            durante un año</div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="7"><span>COMPRAR</span></button>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-3 col-juego maletas-the-expedition">

                <div class="juego-header">
                    <div class="categoria categoria-expedition">
                        <div class="categoria-titulo">Quiero que un consultor de Binnakle venga a mi empresa a dinamizar un taller o un evento</small></div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-detalle">Puedes organizar un taller con Binnakle en tu
                            empresa para solucionar un reto concreto.
                            También puedes utilizar Binnakle The Expedtition
                            en tus eventos corportivos, hasta 250 participantes.
                            Ponte en contacto con nosotros para conocer mejor
                            cuál es tu necesidad y elaborar una propuesta a
                            medida</div>
                        <div class="maleta-comprar">
                            <a href="/quiero-que-vengan-a-mi-empresa.html?maleta=21" class="btn comprar"><span>CONTACTAR</span></a>
                        </div>
                    </div>
                </div>

                <p><br></p>


                <div class="juego-header">
                    <div class="categoria categoria-expedition">
                        <div class="categoria-titulo">Quiero que un consultor de Binnakle venga a mi empresa a impartir una formación presencial con Binnakle The Expedition</small></div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-detalle">Formamos presencialmente a dinamizadores
                            internos de Binnakle The Expedition con el
                            programa Train The Trainers
                            También ofrecemos un programa de formación
                            concentrada en “Pensamiento creativo para
                            Innovar”, a través de nuestro programa presencial
                            Binnakle InnoLearning
                            Ponte en contacto con nosotros para conocer
                            mejor cuál es tu necesidad y elaborar una
                            propuesta a medida</div>
                        <div class="maleta-comprar">
                            <a href="/quiero-que-vengan-a-mi-empresa.html?maleta=22" class="btn comprar"><span>CONTACTAR</span></a>
                        </div>
                    </div>
                </div>

            </div>


        </div>


        <div class="separar-titulo" id="mission0_target"></div>

        <div class="row">
            <div class="col-9">
                <!--Binnakle Mission 0-->
                <h2 class="titulo titulo-mission0">Binnakle Mission 0</h2>
            </div>
        </div>


        <div class="row">

            <div class="col-6 col-juego maletas-mission0">
                <div class="top-categoria categoria-mission0">Quiero comprar online</div>
            </div>

            <div class="col-3 col-juego maletas-mission0">
                <div class="top-categoria categoria-mission0">Quiero que vengan a mi empresa</div>
            </div>
            <div class="col-3 col-juego maletas-mission0"></div>

            <div class="col-12">
                <p><br></p>
            </div>

            <div class="col-3 col-juego maletas-mission0">

                <div class="juego-header">
                    <div class="categoria categoria-mission0">
                        <div class="categoria-titulo">Pack de partidas en la plataforma Binnakle Mission 0</small></div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-mission0">

                        <div class="maleta-titulo">1 año de tarifa plana*</div>
                        <div class="maleta-precio">x.xxx €</div>
                        <div class="maleta-detalle">Podrás jugar todas las partidasque quieras durante un año</div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="8"><span>COMPRAR</span></button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-3 col-juego maletas-mission0">

                <div class="juego-header">
                    <div class="categoria categoria-mission0">
                        <div class="categoria-titulo">Pack de partidas en la plataforma Binnakle Mission 0<br>+<br>Formación para dinamizadores
                            internos vía Webinar
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-mission0">

                        <div class="maleta-titulo">Pack X partidas<br>+<br>Webinar*</div>
                        <div class="maleta-precio">x.xxx €</div>
                        <div class="maleta-detalle">*Formación para dinamizadores internos vía Webinar
                            El Webinar tiene una duración de XX horas, nos
                            pondremos en contacto contigo para agendarlo</div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="9"><span>COMPRAR</span></button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-mission0">

                        <div class="maleta-titulo">Pack Y partidas<br>+<br>Webinar*</div>
                        <div class="maleta-precio">x.xxx €</div>
                        <div class="maleta-detalle">*Formación para dinamizadores internos vía Webinar
                            El Webinar tiene una duración de XX horas, nos
                            pondremos en contacto contigo para agendarlo</div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="10"><span>COMPRAR</span></button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-mission0">

                        <div class="maleta-titulo">Pack X partidas<br>+<br>Webinar*</div>
                        <div class="maleta-precio">x.xxx €</div>
                        <div class="maleta-detalle">*Podrás jugar todas las partidas que quieras durante
                            un año
                            *Formación para dinamizadores internos vía Webinar
                            El Webinar tiene una duración de XX horas , nos
                            pondremos en contacto contigo para agendarlo</div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="11"><span>COMPRAR</span></button>
                        </div>
                    </div>
                </div>

            </div>




            <div class="col-3 col-juego maletas-mission0">

                <div class="juego-header">
                    <div class="categoria categoria-mission0">
                        <div class="categoria-titulo">Quiero que un consultor de Binnakle venga a mi empresa a dinamizar un taller o un evento</small></div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-mission0">
                        <div class="maleta-detalle">Puedes organizar un taller en tuempresa para trabajar sobre una problemática concreta.
                            También puedes utilizar Binnakle Mission 0 en tus eventos corportivos,hasta 250 participantes</div>
                        <div class="maleta-comprar">
                            <a href="/quiero-que-vengan-a-mi-empresa.html?maleta=31" class="btn comprar"><span>CONTACTAR</span></a>
                        </div>
                    </div>
                </div>

                <p><br></p>


                <div class="juego-header">
                    <div class="categoria categoria-mission0">
                        <div class="categoria-titulo">Quiero que un consultor de Binnakle venga a mi empresa a impartir una formación presencial con Binnakle Mission 0</small></div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-mission0">
                        <div class="maleta-detalle">Formamos presencialmente a dinamizadores
                            internos de Binnakle Mission 0 con el
                            programa Train The Trainers</div>
                        <div class="maleta-comprar">
                            <a href="/quiero-que-vengan-a-mi-empresa.html?maleta=32" class="btn comprar"><span>CONTACTAR</span></a>
                        </div>
                    </div>
                </div>


            </div>
        </div>

<!--Binnakle
        <div class="separar-titulo" id="kit_target"></div>

        <div class="row">
            <div class="col-3">
                
                <h2 class="titulo titulo-kit">Binnakle KIT Ideación</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-3 col-juego maletas-kit">

                <div class="juego-header">
                    <div class="top-categoria categoria-kit">Quiero comprar online</div>
                    <div class="categoria categoria-kit">
                        <div class="categoria-titulo">KIT de ideación Binnakle</small></div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-kit">
                        <div class="maleta-detalle">Contenido del kit:<br>
                            40 cartas con técnicas y estímulos para generar ideas<br>
                            Croky</div>
                        <div class="maleta-precio">x.xxx €</div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="12"><span>COMPRAR</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>KIT Ideación-->
    </div>


















    <div class="container accordion d-lg-none" id="expedition_target_mobile">

        <div class="accordion-inner accordion-expedition" id="accordionExpedition">
            <!--Binnakle  Binnakle The Expedition-->
            <h2 class="titulo-expedition">Binnakle The Expedition</h2>
            <div class="accordion-header">
                <a class="collapsed accordion-link" data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <div class="top-categoria categoria-expedition">Quiero comprar online</div>
                    <div class="categoria-flecha">
                        <i class="fa fa-angle-down rotate-icon"></i>
                    </div>
                </a>
            </div>

            <div id="collapseOne" class="collapse collapseContent" data-parent="#accordionExpedition">
                <div class="card-body">
                    <div class="collapseContentInner">

                        <div class="categoria categoria-expedition">
                            <div class="categoria-titulo">Maleta Binnakle The Expedition + Pack de partidas en la plataforma Binnakle The expedition</div>
                        </div>
                        <div class="maleta maleta-expedition">
                            <div class="maleta-titulo">Maleta Binnakle The Expedition + 1 año de tarifa plana</div>
                            <div class="maleta-precio">x.xxx €</div>
                            <div class="maleta-detalle">Podrás jugar todas las partidas que quieras durante un año</div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="1"><span>COMPRAR</span></button>
                            </div>
                        </div>
                        <p><br></p>

                        <div class="categoria categoria-expedition">
                            <div class="categoria-titulo">Maleta Binnakle The Expedition + Pack de partidas en la plataforma Binnakle The Expedition + Formación para dinamizadores internos vía Webinar</div>
                        </div>
                        <div class="maleta maleta-expedition">
                            <div class="maleta-titulo">Maleta Binnakle The Expedition + 1 año de tarifa plana</div>
                            <div class="maleta-precio">x.xxx €</div>
                            <div class="maleta-detalle">*Formación para dinamizadores internos vía Webinar El Webinar tiene una duración de XX horas , nos pondremos en contacto contigo para agendarlo</div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="2"><span>COMPRAR</span></button>
                            </div>
                        </div>
                        <p><br></p>

                        <div class="categoria categoria-expedition">
                            <div class="categoria-titulo">Maleta Binnakle The Expedition + Pack X partidas + Webinar*</small></div>
                        </div>

                        <div class="maleta maleta-expedition">
                            <div class="maleta-titulo">*Formación para dinamizadores internos vía Webinar El Webinar tiene una duración de XX horas , nos pondremos en contacto contigo para agendarlo</div>
                            <div class="maleta-precio">x.xxx €</div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="3"><span>COMPRAR</span></button>
                            </div>
                        </div>
                        <p><br></p>





                        <div class="categoria categoria-expedition">
                            <div class="categoria-titulo">Partidas adicionales<br><small>(Ya tengo una Maleta Binnakle The Expedition)</small></div>
                        </div>

                        <div class="maleta maleta-expedition">
                            <div class="maleta-titulo">Maleta Binnakle The Expedition + 1 año de tarifa plana</div>
                            <div class="maleta-precio">x.xxx €</div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="3"><span>COMPRAR</span></button>
                            </div>
                        </div>
                        <p><br></p>

                    </div>
                </div>
            </div>





            <div class="accordion-header">
                <a class="collapsed accordion-link" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <div class="top-categoria categoria-expedition">Quiero que vengan a mi empresa</div>
                    <div class="categoria-flecha">
                        <i class="fa fa-angle-down rotate-icon"></i>
                    </div>
                </a>
            </div>

            <div id="collapseFour" class="collapse collapseContent" data-parent="#accordionExpedition">
                <div class="card-body">
                    <div class="collapseContentInner">

                        <div class="categoria categoria-expedition">
                            <div class="categoria-titulo">Quiero que un consultor de Binnakle venga a mi empresa a dinamizar un taller o un evento</div>
                        </div>
                        <div class="maleta maleta-expedition">
                            <div class="maleta-titulo">Maleta Binnakle The Expedition + 1 año de tarifa plana</div>
                            <div class="maleta-precio">x.xxx €</div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="4"><span>COMPRAR</span></button>
                            </div>
                        </div>
                        <p><br></p>

                        <div class="categoria categoria-expedition">
                            <div class="categoria-titulo">Quiero que un consultor de Binnakle venga a mi empresa a impartir una formación presencial </div>
                        </div>

                        <div class="maleta maleta-expedition">
                            <div class="maleta-titulo">Maleta Binnakle The Expedition + 1 año de tarifa plana</div>
                            <div class="maleta-precio">x.xxx €</div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="5"><span>COMPRAR</span></button>
                            </div>
                        </div>
                        <p><br></p>

                    </div>
                </div>
            </div>




            <div class="separar-titulo" id="mission0_target_mobile"></div>
            <!--Binnakle  Binnakle Mission 0-->
            <h2 class="titulo-mission0">Binnakle Mission 0</h2>

            <div class="accordion-header">
                <a class="collapsed accordion-link" data-toggle="collapse" href="#collapseTwoOne" aria-expanded="false" aria-controls="collapseTwoOne">
                    <div class="top-categoria categoria-mission0">Quiero comprar online</div>
                    <div class="categoria-flecha">
                        <i class="fa fa-angle-down rotate-icon"></i>
                    </div>
                </a>
            </div>

            <div id="collapseTwoOne" class="collapse collapseContent" data-parent="#accordionExpedition">
                <div class="card-body">
                    <div class="collapseContentInner">
                        <div class="categoria categoria-mission0">
                            <div class="categoria-titulo">Pack de partidas en la plataforma Binnakle Mission 0</div>
                        </div>
                        <div class="maleta maleta-mission0">
                            <div class="maleta-titulo">Maleta Binnakle Mission 0 + 1 año de tarifa plana</div>
                            <div class="maleta-precio">x.xxx €</div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="6"><span>COMPRAR</span></button>
                            </div>
                        </div>
                        <p><br></p>

                        <div class="categoria categoria-mission0">
                            <div class="categoria-titulo">Pack de partidas en la plataforma Binnakle Mission 0 + Formación para dinamizadores internos vía Webinar</div>
                        </div>

                        <div class="maleta maleta-mission0">
                            <div class="maleta-titulo">Maleta Binnakle Mission 0 + 1 año de tarifa plana</div>
                            <div class="maleta-precio">x.xxx €</div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="7"><span>COMPRAR</span></button>
                            </div>
                        </div>
                        <p><br></p>



                        <div class="categoria categoria-mission0">
                            <div class="categoria-titulo">Una partida en la plataforma de Binnakle Mission 0</div>
                        </div>

                        <div class="maleta maleta-mission0">
                            <div class="maleta-titulo">Partida Binnakle Mission 0</div>
                            <div class="maleta-precio">x.xxx €</div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="8"><span>COMPRAR</span></button>
                            </div>
                        </div>
                        <p><br></p>

                    </div>
                </div>
            </div>




            <div class="accordion-header">
                <a class="collapsed accordion-link" data-toggle="collapse" href="#collapseTwoFour" aria-expanded="false" aria-controls="collapseTwoFour">
                    <div class="top-categoria categoria-mission0">Quiero que vengan a mi empresa</div>
                    <div class="categoria-flecha">
                        <i class="fa fa-angle-down rotate-icon"></i>
                    </div>

                </a>
            </div>

            <div id="collapseTwoFour" class="collapse collapseContent" data-parent="#accordionExpedition">
                <div class="card-body">
                    <div class="collapseContentInner">

                        <div class="categoria categoria-mission0">
                            <div class="categoria-titulo">Quiero que un consultor de Binnakle venga a mi empresa a dinamizar un taller o un evento</div>

                        </div>


                        <div class="maleta maleta-mission0">
                            <div class="maleta-titulo">Maleta Binnakle Mission 0 + 1 año de tarifa plana</div>
                            <div class="maleta-precio">x.xxx €</div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="9"><span>COMPRAR</span></button>
                            </div>
                        </div>
                        <p><br></p>

                        <div class="categoria categoria-mission0">
                            <div class="categoria-titulo">Quiero que un consultor de Binnakle venga a mi empresa a impartir una formación presencial </div>

                        </div>
                        <div class="maleta maleta-mission0">
                            <div class="maleta-titulo">Maleta Binnakle Mission 0 + 1 año de tarifa plana</div>
                            <div class="maleta-precio">x.xxx €</div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="10"><span>COMPRAR</span></button>
                            </div>
                        </div>
                        <p><br></p>

                    </div>
                </div>
            </div>



<!--Binnakle  
            <div class="separar-titulo" id="kit_target_mobile"></div>
            
            <h2 class="titulo-kit">Binnakle KIT Ideación</h2>

            <div class="accordion-header">
                <a class="collapsed accordion-link" data-toggle="collapse" href="#collapseThreeOne" aria-expanded="false" aria-controls="collapseThreeOne">
                    <div class="top-categoria categoria-kit">Quiero comprar online</div>
                    <div class="categoria-flecha">
                        <i class="fa fa-angle-down rotate-icon"></i>
                    </div>

                </a>
            </div>

            <div id="collapseThreeOne" class="collapse collapseContent show" data-parent="#accordionExpedition">
                <div class="card-body">
                    <div class="collapseContentInner">
                        <div class="categoria categoria-kit">
                            <div class="categoria-titulo">KIT de ideación Binnakle</div>

                        </div>
                        <div class="maleta maleta-kit">
                            <div class="maleta-titulo">Maleta Binnakle KIT Ideación + 1 año de tarifa plana</div>
                            <div class="maleta-precio">x.xxx €</div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="11" id="comprarKit"><span>COMPRAR</span></button>
                            </div>
                        </div>
                        <p><br></p>
                    </div>
                </div>
            </div>
KIT Ideación-->



        </div>



    </div>
    <p><br></p>
</section>
<p><br></p>



<script type="text/javascript">
    jQuery(document).ready(function() {

        jQuery('#expedition').on('click', function(event) {
            event.preventDefault();
            var target = jQuery('#expedition_target');
            jQuery('html,body').animate({
                scrollTop: (target.offset().top - 101)
            }, 1000);
            return false;
        });

        jQuery('#mission0').on('click', function(event) {
            event.preventDefault();
            var target = jQuery('#mission0_target');
            jQuery('html,body').animate({
                scrollTop: (target.offset().top - 101)
            }, 1000);
            return false;
        });

        /*jQuery('#kit').on('click', function(event) {
            event.preventDefault();
            var target = jQuery('#kit_target');
            jQuery('html,body').animate({
                scrollTop: (target.offset().top - 101)
            }, 1000);
            return false;
        });*/

        jQuery('#expedition_mobile').on('click', function(event) {
            event.preventDefault();
            var target = jQuery('#expedition_target_mobile');
            jQuery('html,body').animate({
                scrollTop: (target.offset().top - 101)
            }, 1000);
            return false;
        });

        jQuery('#mission0_mobile').on('click', function(event) {
            event.preventDefault();
            var target = jQuery('#mission0_target_mobile');
            jQuery('html,body').animate({
                scrollTop: (target.offset().top - 101)
            }, 1000);
            return false;
        });

        /*jQuery('#kit_mobile').on('click', function(event) {
            event.preventDefault();
            var target = jQuery('#kit_target_mobile');
            jQuery('html,body').animate({
                scrollTop: (target.offset().top - 101)
            }, 1000);
            return false;
        });*/

    });
</script>


<div class="modal fade show comprar" id="comprar-modal22222" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div id="demo-modal">
                loadComprarModal
            </div>
        </div>
    </div>
</div>



<!-- The Modal -->
<div class="modal fade show comprar" id="comprar-modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"> </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <a id="goPaypal" class="goPaypal">
                    <img class="image-fluid" src="images/popup-comprar.png">
                </a>
            </div>



        </div>
    </div>
</div>

<script>
    var maletasArray = [];
    <?php
        foreach ($this->items as $key => $value) {
            echo 'maletasArray[' . $value->id . '] = \'' . json_encode($value) . '\';';
        }
        ?>

    jQuery(document).ready(function() {
        localStorage.setItem('carrito', null);
        let carrito = [];
        let carritoJson = localStorage.getItem('carrito');
        console.log('carrito', carrito);
        console.log('carritoJson typeOf', typeof carritoJson);
        if (carritoJson != 'null') {
            carrito = JSON.parse(carritoJson);
            console.log('carritoJson', carritoJson);
        }
        var maleta = 0;
        jQuery('button.comprar').on('click', function() {
            maleta = jQuery(this).data("maleta");
            console.log('maleta', maleta);
            if (carrito.indexOf(parseInt(maleta)) < 0) {
                carrito.push(maleta);
            }
            console.log('carrito', carrito);
            localStorage.setItem('carrito', JSON.stringify(carrito));
            localStorage.setItem('carrito', 'null');
            window.location.href = '/comprar-maleta.html?maleta=' + maleta;
        });
        jQuery('#goPaypal').on('click', function() {
            window.location.href = '/comprar-maleta.html?maleta=' + maleta;
        });
    });
</script>


<?php
}
?>