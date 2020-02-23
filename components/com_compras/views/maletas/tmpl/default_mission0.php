<?php

foreach ($this->items as $key => $value) {
    $maleta[$value->id] = $value;
    if($maleta[$value->id]->costo<1){
        $maleta[$value->id]->costo = number_format($maleta[$value->id]->costo, 2, ',', '.');
    }else{
        $maleta[$value->id]->costo = number_format($maleta[$value->id]->costo, 2, ',', '.');
    }
    $maleta[$value->id]->detail = str_replace("\n","<br>",$maleta[$value->id]->detail);
}
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
                            <a href="/comprar-binnakle-the-expedition.html" type="button" id="expedition" class="btn expedition"><span class="binnakle">Binnakle<span> <br class="d-lg-none"><span>The Expedition</span></a>
                        </div>
                        <div class="boton">
                            <a type="button" id="mission0" class="btn mission0 <?php echo $this->game == 2 ? "activo" : ""; ?>"><span class="binnakle">Binnakle<span> <br class="d-lg-none"><span>Mission 0</span></a>
                        </div>
                        <!--<div class="boton">
                            <button type="button" id="kit" class="btn kit"><span class="binnakle">Binnakle<span> <br class="d-lg-none"><span>KIT Ideación</span></button>
                        </div>-->
                    </div>
                </div>
                <div class="botones-seleccion d-lg-none">
                    <div class="boton">
                        <a href="/comprar-binnakle-the-expedition.html" type="button" id="expedition_mobile" class="btn expedition"><span class="binnakle">Binnakle<span> <br class="d-lg-none"><span>The Expedition</span></a>
                    </div>
                    <div class="boton">
                        <a type="button" id="mission0_mobile" class="btn mission0 <?php echo $this->game == 2 ? "activo" : ""; ?>"><span class="binnakle">Binnakle<span> <br class="d-lg-none"><span>Mission 0</span></a>
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

        <div class="separar-titulo" id="mission0_target"></div>

        <div class="row">
            <div class="col-9">
                <!--Binnakle Mission 0-->
                <h2 class="titulo titulo-mission0">Binnakle Mission 0</h2>
            </div>
        </div>


        <div class="row">

            <div class="col-6 col-juego maletas-mission0">
                <div class="top-categoria categoria-mission0"><?php echo JText::_('BINNAKLE_COMPRAR_ONLINE');?></div>
            </div>

            <div class="col-3 col-juego maletas-mission0">
                <div class="top-categoria categoria-mission0"><?php echo JText::_('BINNAKLE_COMPRAR_TALLERES');?> </div>
            </div>
            <div class="col-3 col-juego maletas-mission0"></div>

            <div class="col-12">
                <p><br></p>
            </div>

            <div class="col-3 col-juego maletas-mission0">

                <div class="juego-header">
                    <div class="categoria categoria-mission0">
                        <div class="categoria-titulo"><?php echo JText::_('BINNAKLE_COMPRAR_PARTIDAS_MISSION');?></div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="maleta maleta-mission0">
                        <div class="maleta-titulo"><?php echo $maleta[11]->name; ?></div>
                        <div class="maleta-precio"><?php echo $maleta[11]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo $maleta[11]->detail; ?></div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="11"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-mission0">
                        <div class="maleta-titulo"><?php echo $maleta[12]->name; ?></div>
                        <div class="maleta-precio"><?php echo $maleta[12]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo $maleta[12]->detail; ?></div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="12"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-mission0">
                        <div class="maleta-titulo"><?php echo $maleta[13]->name; ?></div>
                        <div class="maleta-precio"><?php echo $maleta[13]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo $maleta[13]->detail; ?></div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="13"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-3 col-juego maletas-mission0">

                <div class="juego-header">
                    <div class="categoria categoria-mission0">
                        <div class="categoria-titulo"><?php echo JText::_('BINNAKLE_COMPRAR_PARTIDAS_MISSION_MAS_WEBINAR');?>
                            
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-mission0">
                        <div class="maleta-titulo"><?php echo $maleta[14]->name; ?></div>
                        <div class="maleta-precio"><?php echo $maleta[14]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo $maleta[14]->detail; ?></div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="14"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="maleta maleta-mission0">
                        <div class="maleta-titulo"><?php echo $maleta[15]->name; ?></div>
                        <div class="maleta-precio"><?php echo $maleta[15]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo $maleta[15]->detail; ?></div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="15"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                        </div>
                    </div>
                </div>

                
                <div class="card">
                    <div class="maleta maleta-mission0">
                        <div class="maleta-titulo"><?php echo $maleta[16]->name; ?></div>
                        <div class="maleta-precio"><?php echo $maleta[16]->costo; ?> €</div>
                        <div class="maleta-detalle"><?php echo $maleta[16]->detail; ?></div>
                        <div class="maleta-comprar">
                            <button type="button" class="btn comprar" data-maleta="16"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                        </div>
                    </div>
                </div>


                <div class="card">
                            <div class="maleta maleta-mission0">
                                <div class="maleta-titulo"><?php echo $maleta[17]->name; ?></div>
                                <div class="maleta-precio"><?php echo $maleta[17]->costo; ?> €</div>
                                <div class="maleta-detalle"><?php echo $maleta[17]->detail; ?></div>
                                <div class="maleta-comprar">
                                    <button type="button" class="btn comprar" data-maleta="17"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                                </div>
                            </div>
                        </div>

            </div>




            <div class="col-3 col-juego maletas-mission0">

                <div class="juego-header">
                    <div class="categoria categoria-mission0">
                        <div class="categoria-titulo"><?php echo JText::_('BINNAKLE_COMPRAR_DINAMIZACION');?></small></div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-mission0">
                        <div class="maleta-detalle">
                        <?php echo JText::_('BINNAKLE_COMPRAR_MISSION0_1');?>
                        </div>
                        <div class="maleta-comprar">
                            <a href="/quiero-que-vengan-a-mi-empresa.html?maleta=31" class="btn comprar"><span><?php echo JText::_('BINNAKLE_CONTACTAR');?></span></a>
                        </div>
                    </div>
                </div>

                <p><br></p>


                <div class="juego-header">
                    <div class="categoria categoria-mission0">
                        <div class="categoria-titulo"><?php echo JText::_('BINNAKLE_COMPRAR_FORMACIONES');?></small></div>
                    </div>
                </div>

                <div class="card">
                    <div class="maleta maleta-mission0">
                        <div class="maleta-detalle">
                        <?php echo JText::_('BINNAKLE_COMPRAR_MISSION0_2');?>
                        </div>
                        <div class="maleta-comprar">
                            <a href="/quiero-que-vengan-a-mi-empresa.html?maleta=32" class="btn comprar"><span><?php echo JText::_('BINNAKLE_CONTACTAR');?></span></a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


















    <div class="container accordion d-lg-none" id="expedition_target_mobile">

        <div class="accordion-inner accordion-expedition" id="accordionExpedition">

            <div class="separar-titulo" id="mission0_target_mobile"></div>
            <!--Binnakle  Binnakle Mission 0-->
            <h2 class="titulo-mission0">Binnakle Mission 0</h2>

            <div class="accordion-header">
                <a class="collapsed accordion-link" data-toggle="collapse" href="#collapseTwoOne" aria-expanded="false" aria-controls="collapseTwoOne">
                    <div class="top-categoria categoria-mission0">Quiero comprar on-line</div>
                    <div class="categoria-flecha">
                        <i class="fa fa-angle-down rotate-icon"></i>
                    </div>
                </a>
            </div>






            <div id="collapseTwoOne" class="collapse collapseContent" data-parent="#accordionExpedition">
                <div class="card-body">
                    <div class="collapseContentInner">
                        <div class="categoria categoria-mission0">
                            <div class="categoria-titulo">Partidas Binnakle Mission 0 </div>
                        </div>


                        <div class="card">
                            <div class="maleta maleta-mission0">
                                <div class="maleta-titulo"><?php echo $maleta[11]->name; ?></div>
                                <div class="maleta-precio"><?php echo $maleta[11]->costo; ?> €</div>
                                <div class="maleta-detalle"><?php echo $maleta[11]->detail; ?></div>
                                <div class="maleta-comprar">
                                    <button type="button" class="btn comprar" data-maleta="11"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="maleta maleta-mission0">
                                <div class="maleta-titulo"><?php echo $maleta[12]->name; ?></div>
                                <div class="maleta-precio"><?php echo $maleta[12]->costo; ?> €</div>
                                <div class="maleta-detalle"><?php echo $maleta[12]->detail; ?></div>
                                <div class="maleta-comprar">
                                    <button type="button" class="btn comprar" data-maleta="12"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="maleta maleta-mission0">
                                <div class="maleta-titulo"><?php echo $maleta[13]->name; ?></div>
                                <div class="maleta-precio"><?php echo $maleta[13]->costo; ?> €</div>
                                <div class="maleta-detalle"><?php echo $maleta[13]->detail; ?></div>
                                <div class="maleta-comprar">
                                    <button type="button" class="btn comprar" data-maleta="13"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                                </div>
                            </div>
                        </div>

                        <p><br></p>

                        <div class="categoria categoria-mission0">
                            <div class="categoria-titulo">Partidas Binnakle Mission 0 + Webinar para formar a dinamizadores internos</div>
                        </div>


                        <div class="card">
                            <div class="maleta maleta-mission0">
                                <div class="maleta-titulo"><?php echo $maleta[14]->name; ?></div>
                                <div class="maleta-precio"><?php echo $maleta[14]->costo; ?> €</div>
                                <div class="maleta-detalle"><?php echo $maleta[14]->detail; ?></div>
                                <div class="maleta-comprar">
                                    <button type="button" class="btn comprar" data-maleta="14"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                                </div>
                            </div>
                        </div>



                        <div class="card">
                            <div class="maleta maleta-mission0">
                                <div class="maleta-titulo"><?php echo $maleta[15]->name; ?></div>
                                <div class="maleta-precio"><?php echo $maleta[15]->costo; ?> €</div>
                                <div class="maleta-detalle"><?php echo $maleta[15]->detail; ?></div>
                                <div class="maleta-comprar">
                                    <button type="button" class="btn comprar" data-maleta="15"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="maleta maleta-mission0">
                                <div class="maleta-titulo"><?php echo $maleta[16]->name; ?></div>
                                <div class="maleta-precio"><?php echo $maleta[16]->costo; ?> €</div>
                                <div class="maleta-detalle"><?php echo $maleta[16]->detail; ?></div>
                                <div class="maleta-comprar">
                                    <button type="button" class="btn comprar" data-maleta="16"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="maleta maleta-mission0">
                                <div class="maleta-titulo"><?php echo $maleta[17]->name; ?></div>
                                <div class="maleta-precio"><?php echo $maleta[17]->costo; ?> €</div>
                                <div class="maleta-detalle"><?php echo $maleta[17]->detail; ?></div>
                                <div class="maleta-comprar">
                                    <button type="button" class="btn comprar" data-maleta="17"><span><?php echo JText::_('BINNAKLE_COMPRAR');?></span></button>
                                </div>
                            </div>
                        </div>


                        <p><br></p>


                    </div>
                </div>
            </div>




            <div class="accordion-header">
                <a class="collapsed accordion-link" data-toggle="collapse" href="#collapseTwoFour" aria-expanded="false" aria-controls="collapseTwoFour">
                    <div class="top-categoria categoria-mission0">Talleres y formaciones in company </div>
                    <div class="categoria-flecha">
                        <i class="fa fa-angle-down rotate-icon"></i>
                    </div>

                </a>
            </div>

            <div id="collapseTwoFour" class="collapse collapseContent" data-parent="#accordionExpedition">
                <div class="card-body">
                    <div class="collapseContentInner">

                        <div class="categoria categoria-mission0">
                            <div class="categoria-titulo">Dinamización de talleres o eventos</div>
                        </div>

                        <div class="card">
                            <div class="maleta maleta-mission0">
                                <div class="maleta-detalle">Puedes organizar un <span class="maleta-titulo">taller con Binnakle Mission 0</span> en tu empresa para trabajar sobre una problemática concreta, dinamizado por un consultor Binnakle.
                            <br>También puedes utilizar Binnakle Mission 0 en tus <span class="maleta-titulo">eventos o reuniones corportivas</span>, hasta 120 participantes.
                            <br>Contacta con nosotros para conocer mejor tu necesidad y elaborar una propuesta a medida.</div>
                                <div class="maleta-comprar">
                                    <a href="/quiero-que-vengan-a-mi-empresa.html?maleta=31" class="btn comprar"><span><?php echo JText::_('BINNAKLE_CONTACTAR');?></span></a>
                                </div>
                            </div>
                        </div>

                        <p><br></p>

                        <div class="categoria categoria-mission0">
                            <div class="categoria-titulo">Formaciones</div>
                        </div>

                        <div class="card">
                            <div class="maleta maleta-mission0">
                                <div class="maleta-detalle">Formamos presencialmente a dinamizadores internos de Binnakle Mission 0 con el programa <span class="maleta-titulo">Train The Trainers</span>.
                                <br>El programa incluye un código de acceso a la plataforma para jugar todas las partidas que quieras durante 1 año.
                                    Contacta con nosotros para conocer mejor tu necesidad y elaborar una propuesta a medida.</div>
                                <div class="maleta-comprar">
                                    <a href="/quiero-que-vengan-a-mi-empresa.html?maleta=31" class="btn comprar"><span><?php echo JText::_('BINNAKLE_CONTACTAR');?></span></a>
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