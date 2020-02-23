<?php
$maleta = [];

foreach ($this->items as $key => $value) {
    $maleta[$value->id] = $value;
    if($maleta[$value->id]->costo<1){
        $maleta[$value->id]->costo = number_format($maleta[$value->id]->costo, 2, ',', '.');
    }else{
        $maleta[$value->id]->costo = number_format(($maleta[$value->id]->costo), 2, ',', '.');
    }
}

//echo '<pre>';print_r($maleta);echo '<pre>';
?>

<section class="comprar">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="titulo"><?php echo JText::_('BINNAKLE_AUNPASO');?></h1>
            </div>
            <div class="col-12 botones-seleccion-container">
                <div class="d-none d-lg-block">
                    <div class="botones-seleccion">
                        <div class="boton">
                            <a type="button" id="expedition" class="btn expedition <?php echo $this->game == 1 ? "activo" : ""; ?>"><span class="binnakle">Binnakle<span> <br class="d-lg-none"><span>The Expedition</span></a>
                        </div>
                        <div class="boton">
                            <a href="/comprar-binnakle-mission-0.html" type="button" id="mission0" class="btn mission0"><span class="binnakle">Binnakle<span> <br class="d-lg-none"><span>Mission 0</span></a>
                        </div>
                        <!--<div class="boton">
                            <button type="button" id="kit" class="btn kit"><span class="binnakle">Binnakle<span> <br class="d-lg-none"><span>KIT Ideación</span></button>
                        </div>-->
                    </div>
                </div>
                <div class="botones-seleccion d-lg-none">
                    <div class="boton">
                        <a type="button" id="expedition_mobile" class="btn expedition <?php echo $this->game == 1 ? "activo" : ""; ?>"><span class="binnakle">Binnakle<span> <br class="d-lg-none"><span>The Expedition</span></a>
                    </div>
                    <div class="boton">
                        <a href="/comprar-binnakle-mission-0.html" type="button" id="mission0_mobile" class="btn mission0"><span class="binnakle">Binnakle<span> <br class="d-lg-none"><span>Mission 0</span></a>
                    </div>
                    <!--<div class="boton">
                        <button type="button" id="kit_mobile" class="btn kit"><span class="binnakle">Binnakle<span> <br class="d-lg-none"><span>KIT Ideación</span></button>
                    </div>-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="f-s-12"><?php echo JText::_('BINNAKLE_AUNPASO_IMPORTANTE');?></p>
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
                <div class="top-categoria categoria-expedition"><?php echo JText::_('BINNAKLE_COMPRAR_ONLINE');?></div>

            </div>
            <div class="col-3 col-juego maletas-the-expedition">
                <div class="top-categoria categoria-expedition"><?php echo JText::_('BINNAKLE_COMPRAR_TALLERES');?></div>
            </div>
            <div class="col-12">
                <p><br></p>
            </div>

            <div class="col-3 col-juego maletas-the-expedition">

                <div class="juego-header">
                    <div class="categoria categoria-expedition">
                        <div class="categoria-titulo"><?php echo JText::_('BINNAKLE_COMPRAR_MALETA_TEHEXPEDITION');?></div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-titulo"><?php echo $maleta[1]->name; ?></div>
                        <div class="maleta-precio"><?php echo $maleta[1]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo str_replace("\n","<br>",$maleta[1]->detail); ?></div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="1"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-3 col-juego maletas-the-expedition">

                <div class="juego-header">
                    <div class="categoria categoria-expedition">
                        <div class="categoria-titulo"><?php echo JText::_('BINNAKLE_COMPRAR_MALETA_TEHEXPEDITION_2');?></div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-titulo"><?php echo $maleta[2]->name; ?></div>
                        <div class="maleta-precio"><?php echo $maleta[2]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo str_replace("\n","<br>",$maleta[2]->detail); ?></div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="2"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-3 col-juego maletas-the-expedition">

                <div class="juego-header">
                    <div class="categoria categoria-expedition">
                        <div class="categoria-titulo"><?php echo JText::_('BINNAKLE_COMPRAR_PARTIDA_TEHEXPEDITION');?></small></div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-titulo"><?php echo $maleta[3]->name; ?></div>
                        <div class="maleta-precio"><?php echo $maleta[3]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo str_replace("\n","<br>",$maleta[3]->detail); ?></div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="3"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-titulo"><?php echo $maleta[4]->name; ?></div>
                        <div class="maleta-precio"><?php echo $maleta[4]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo str_replace("\n","<br>",$maleta[4]->detail); ?></div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="4"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-titulo"><?php echo $maleta[5]->name; ?></div>
                        <div class="maleta-precio"><?php echo $maleta[5]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo str_replace("\n","<br>",$maleta[5]->detail); ?></div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="5"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-titulo"><?php echo $maleta[6]->name; ?></div>
                        <div class="maleta-precio"><?php echo $maleta[6]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo str_replace("\n","<br>",$maleta[6]->detail); ?></div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="6"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-3 col-juego maletas-the-expedition">

                <div class="juego-header">
                    <div class="categoria categoria-expedition">
                        <div class="categoria-titulo"><?php echo JText::_('BINNAKLE_COMPRAR_DINAMIZACION');?></small></div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-detalle"><?php echo JText::_('BINNAKLE_COMPRAR_DINAMIZACION_1');?></div>
                        <div class="maleta-comprar">
                            <a href="/quiero-que-vengan-a-mi-empresa.html?maleta=21" class="btn comprar"><span><?php echo JText::_('BINNAKLE_CONTACTAR');?></span></a>
                        </div>
                    </div>
                </div>

                <p><br></p>


                <div class="juego-header">
                    <div class="categoria categoria-expedition">
                        <div class="categoria-titulo"><?php echo JText::_('BINNAKLE_COMPRAR_FORMACIONES');?></small></div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-detalle"><?php echo JText::_('BINNAKLE_COMPRAR_FORMACION_1');?></div>
                        <div class="maleta-comprar">
                            <a href="/quiero-que-vengan-a-mi-empresa.html?maleta=22" class="btn comprar"><span><?php echo JText::_('BINNAKLE_CONTACTAR');?></span></a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-detalle"><?php echo JText::_('BINNAKLE_COMPRAR_FORMACION_2');?></div>
                        <div class="maleta-comprar">
                            <a href="/quiero-que-vengan-a-mi-empresa.html?maleta=22" class="btn comprar"><span><?php echo JText::_('BINNAKLE_CONTACTAR');?></span></a>
                        </div>
                    </div>
                </div>

            </div>


        </div>


        <div class="separar-titulo" id="mission0_target"></div>

    </div>


















    <div class="container accordion d-lg-none" id="expedition_target_mobile">

        <div class="accordion-inner accordion-expedition" id="accordionExpedition">
            <!--Binnakle  Binnakle The Expedition-->
            <h2 class="titulo-expedition">Binnakle The Expedition</h2>
            <div class="accordion-header">
                <a class="collapsed accordion-link" data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <div class="top-categoria categoria-expedition">Comprar on-line</div>
                    <div class="categoria-flecha">
                        <i class="fa fa-angle-down rotate-icon"></i>
                    </div>
                </a>
            </div>

            <div id="collapseOne" class="collapse collapseContent" data-parent="#accordionExpedition">
                <div class="card-body">
                    <div class="collapseContentInner">

                        <div class="categoria categoria-expedition">
                            <div class="categoria-titulo">Maleta Binnakle The Expedition (incluye acceso ilimitado a la plataforma Binnakle The Expedition durante 1 año) </div>
                        </div>
                        <div class="maleta maleta-expedition">
                            <div class="maleta-titulo"><?php echo $maleta[1]->name; ?></div>
                            <div class="maleta-precio"><?php echo $maleta[1]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo str_replace("\n","<br>",$maleta[1]->detail); ?></div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="1"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                            </div>
                        </div>
                        <p><br></p>

                        <div class="categoria categoria-expedition">
                            <div class="categoria-titulo">Maleta Binnakle The Expedition (incluye acceso ilimitado a la plataforma Binnakle The Expedition durante 1 año) + Webinar para formar a dinamizadores internos

                            </div>
                        </div>
                        <div class="maleta maleta-expedition">
                            <div class="maleta-titulo"><?php echo $maleta[2]->name; ?></div>
                            <div class="maleta-precio"><?php echo $maleta[2]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo str_replace("\n","<br>",$maleta[2]->detail); ?></div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="2"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                            </div>
                        </div>
                        <p><br></p>



                        <div class="categoria categoria-expedition">
                            <div class="categoria-titulo">Comprar partidas adicionales<br><small>(Ya tengo una Maleta Binnakle The Expedition)</small></div>
                        </div>

                        <div class="maleta maleta-expedition">
                            <div class="maleta-titulo"><?php echo $maleta[3]->name; ?></div>
                            <div class="maleta-precio"><?php echo $maleta[3]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo str_replace("\n","<br>",$maleta[3]->detail); ?></div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="3"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                            </div>
                        </div>
                        <p><br></p>



                        <p><br></p>
                        <div class="maleta maleta-expedition">
                            <div class="maleta-titulo"><?php echo $maleta[4]->name; ?></div>
                            <div class="maleta-precio"><?php echo $maleta[4]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo str_replace("\n","<br>",$maleta[4]->detail); ?></div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="4"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                            </div>
                        </div>


                        <p><br></p>
                        <div class="maleta maleta-expedition">
                            <div class="maleta-titulo"><?php echo $maleta[5]->name; ?></div>
                            <div class="maleta-precio"><?php echo $maleta[5]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo str_replace("\n","<br>",$maleta[5]->detail); ?></div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="5"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                            </div>
                        </div>

                        <p><br></p>
                        <div class="maleta maleta-expedition">
                            <div class="maleta-titulo"><?php echo $maleta[6]->name; ?></div>
                            <div class="maleta-precio"><?php echo $maleta[6]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo str_replace("\n","<br>",$maleta[6]->detail); ?></div>
                            <div class="maleta-comprar">
                                <button type="button" class="btn comprar" data-maleta="6"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>





            <div class="accordion-header">
                <a class="collapsed accordion-link" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <div class="top-categoria categoria-expedition">Talleres y formaciones in company</div>
                    <div class="categoria-flecha">
                        <i class="fa fa-angle-down rotate-icon"></i>
                    </div>
                </a>
            </div>

            <div id="collapseFour" class="collapse collapseContent" data-parent="#accordionExpedition">
                <div class="card-body">
                    <div class="collapseContentInner">

                        <div class="categoria categoria-expedition">
                            <div class="categoria-titulo">Dinamización de talleres o eventos</div>
                        </div>
                        <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-detalle">Puedes organizar un <span class="maleta-titulo">taller con Binnakle The Expedition</span> en tu empresa para solucionar un reto concreto, dinamizado por un consultor Binnakle. 
                        <br>También puedes utilizar Binnakle The Expedition en tus <span class="maleta-titulo">eventos o reuniones corportivas</span>, hasta 250 participantes. 
                        <br>Contacta con nosotros para conocer mejor tu necesidad y elaborar una propuesta a medida.</div>
                        <div class="maleta-comprar">
                            <a href="/quiero-que-vengan-a-mi-empresa.html?maleta=21" class="btn comprar"><span><?php echo JText::_('BINNAKLE_CONTACTAR');?></span></a>
                        </div>
                    </div>
                </div>

                        <p><br></p>

                        <div class="categoria categoria-expedition">
                            <div class="categoria-titulo">Formaciones</div>
                        </div>

                       
                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-detalle">Ofrecemos un programa de formación concentrada en “Pensamiento Creativo para Innovar”, a través de nuestro programa presencial <span class="maleta-titulo">Binnakle InnoLearning</span>. <br>Contacta con nosotros para conocer mejor tu necesidad y elaborar una propuesta a medida</div>
                        <div class="maleta-comprar">
                            <a href="/quiero-que-vengan-a-mi-empresa.html?maleta=22" class="btn comprar"><span><?php echo JText::_('BINNAKLE_CONTACTAR');?></span></a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-expedition">
                        <div class="maleta-detalle">Si tienes una Maleta Binnakle The Expedition o quieres adquirirla, también podemos formar presencialmente a dinamizadores internos, con el programa <span class="maleta-titulo">Train The Trainers</span>.
                        <br>Contacta con nosotros para conocer mejor tu necesidad y elaborar una propuesta a medida.</div>
                        <div class="maleta-comprar">
                            <a href="/quiero-que-vengan-a-mi-empresa.html?maleta=22" class="btn comprar"><span><?php echo JText::_('BINNAKLE_CONTACTAR');?></span></a>
                        </div>
                    </div>
                </div>
                        <p><br></p>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <p><br></p>
</section>
<p><br></p>

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
        let hrefGo = '/comprar-maleta.html?maleta=';
        <?php if($this->lang=='en'){?>
            hrefGo = '/en/comprar-maleta.html?maleta=';
        <?php }?>

        jQuery('button.comprar').on('click', function() {
            maleta = jQuery(this).data("maleta");
            console.log('maleta', maleta);
            if (carrito.indexOf(parseInt(maleta)) < 0) {
                carrito.push(maleta);
            }
            console.log('carrito', carrito);
            localStorage.setItem('carrito', JSON.stringify(carrito));
            localStorage.setItem('carrito', 'null');
            window.location.href = hrefGo + maleta;
        });
        jQuery('#goPaypal').on('click', function() {
            window.location.href = hrefGo + maleta;
        });
    });
</script>