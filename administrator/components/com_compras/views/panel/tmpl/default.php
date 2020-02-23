<?php
/*
echo '<br>Maletas: ' . count($this->maletas);
echo '<br>Regiones: ' . count($this->regiones);
echo '<br>Países: ' . count($this->paises);
echo '<br>Impuestos: ' . count($this->impuestos);
echo '<br>Envios: ' . count($this->envios);
echo '<br>Compras: ' . count($this->compras);
*/
?>
<!--
<style>
    .cards {
        display: flex;
        background-color: #f9fafb !important;
    }

    .cards .card {
        padding: 15px;
        margin: 15px;
        border: 1px solid #d1d1d1;
    }
</style>
<div class="cards">
    <div class="card">
        <div class="text-info text-center mt-3">
            <h4>Maletas</h4>
        </div>
        <div class="text-info text-center mt-2">
            <h1><?php echo count($this->maletas); ?></h1>
        </div>
    </div>

    <div class="card">
        <div class="text-success text-center mt-3">
            <h4>Regiones</h4>
        </div>
        <div class="text-success text-center mt-2">
            <h1><?php echo count($this->regiones); ?></h1>
        </div>
    </div>

    <div class="card">
        <div class="text-danger text-center mt-3">
            <h4>Países</h4>
        </div>
        <div class="text-danger text-center mt-2">
            <h1><?php echo count($this->paises); ?></h1>
        </div>
    </div>

    <div class="card">
        <div class="text-warning text-center mt-3">
            <h4>Impuestos</h4>
        </div>
        <div class="text-warning text-center mt-2">
            <h1><?php echo count($this->impuestos); ?></h1>
        </div>
    </div>

    <div class="card">
        <div class="text-info text-center mt-3">
            <h4>Envios</h4>
        </div>
        <div class="text-info text-center mt-2">
            <h1><?php echo count($this->maletas); ?></h1>
        </div>
    </div>

    <div class="card">
        <div class="text-success text-center mt-3">
            <h4>Compras</h4>
        </div>
        <div class="text-success text-center mt-2">
            <h1><?php echo count($this->compras); ?></h1>
        </div>
    </div>
</div>


-->










<style>
    .row {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.gap-20>* {
    padding: 10px!important;
}
.w-100 {
    width: 100%!important;
}
.gap-20 {
    margin: -10px!important;
}
.bd {
    border: 1px solid rgba(0,0,0,.0625)!important;
}
.p-20 {
    padding: 20px!important;
}
.mB-10 {
    margin-bottom: 10px!important;
}
.lh-1 {
    line-height: 1!important;
}


.fxw-nw {
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
}

.peers {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    display: -webkit-box!important;
    display: -ms-flexbox!important;
    display: flex!important;
    -webkit-box-align: start;
    -ms-flex-align: start;
    align-items: flex-start;
    -webkit-box-pack: start;
    -ms-flex-pack: start;
    justify-content: flex-start;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-flow: row wrap;
    flex-flow: row wrap;
    height: auto;
    max-width: 100%;
    margin: 0;
    padding: 0;
}
.peer-greed, .peers-greed>.peer, .peers-greed>.peers {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
}




.c-green-500, .cH-green-500:hover {
    color: #4caf50!important;
}
.c-red-500, .cH-red-500:hover {
    color: #f44336!important;
}

.bgc-green-50, .bgcH-green-50:hover {
    background-color: #e8f5e9!important;
}
.bgc-red-50, .bgcH-red-50:hover {
    background-color: #ffebee!important;
}

.c-purple-500, .cH-purple-500:hover {
    color: #9c27b0!important;
}
.bgc-purple-50, .bgcH-purple-50:hover {
    background-color: #f3e5f5!important;
}

.bgc-blue-50, .bgcH-blue-50:hover {
    background-color: #e3f2fd!important;
}
.bdrs-10em {
    border-radius: 10em!important;
}

.bdrs-10em {
    border-radius: 10em!important;
}
.lh-0 {
    line-height: 0!important;
}
.fw-600 {
    font-weight: 600!important;
}
.pX-15 {
    padding-left: 15px!important;
    padding-right: 15px!important;
}
.pY-15 {
    padding-top: 15px!important;
    padding-bottom: 15px!important;
}
.va-m {
    vertical-align: middle!important;
}
.d-ib {
    display: inline-block!important;
}


</style>




<div class="masonry-item w-100">
    <div class="row gap-20">
        <div class="col-md-3">
            <div class="layers bd bgc-white p-20">
                <div class="layer w-100 mB-10">
                    <h6 class="lh-1">Maletas Totales</h6>
                </div>
                <div class="layer w-100">
                    <div class="peers ai-sb fxw-nw">
                        <div class="peer peer-greed"><span id="sparklinedash"><canvas width="45" height="20" style="display: inline-block; width: 45px; height: 20px; vertical-align: top;"></canvas></span></div>
                        <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500"><?php echo count($this->maletas); ?></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="layers bd bgc-white p-20">
                <div class="layer w-100 mB-10">
                    <h6 class="lh-1">Regiones Totales</h6>
                </div>
                <div class="layer w-100">
                    <div class="peers ai-sb fxw-nw">
                        <div class="peer peer-greed"><span id="sparklinedash2"><canvas width="45" height="20" style="display: inline-block; width: 45px; height: 20px; vertical-align: top;"></canvas></span></div>
                        <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500"><?php echo count($this->regiones); ?></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="layers bd bgc-white p-20">
                <div class="layer w-100 mB-10">
                    <h6 class="lh-1">Países Totales</h6>
                </div>
                <div class="layer w-100">
                    <div class="peers ai-sb fxw-nw">
                        <div class="peer peer-greed"><span id="sparklinedash3"><canvas width="45" height="20" style="display: inline-block; width: 45px; height: 20px; vertical-align: top;"></canvas></span></div>
                        <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500"><?php echo count($this->paises); ?></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="layers bd bgc-white p-20">
                <div class="layer w-100 mB-10">
                    <h6 class="lh-1">Impuestos Totales</h6>
                </div>
                <div class="layer w-100">
                    <div class="peers ai-sb fxw-nw">
                        <div class="peer peer-greed"><span id="sparklinedash4"><canvas width="45" height="20" style="display: inline-block; width: 45px; height: 20px; vertical-align: top;"></canvas></span></div>
                        <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500"><?php echo count($this->impuestos); ?></span></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="layers bd bgc-white p-20">
                <div class="layer w-100 mB-10">
                    <h6 class="lh-1">Envios Totales</h6>
                </div>
                <div class="layer w-100">
                    <div class="peers ai-sb fxw-nw">
                        <div class="peer peer-greed"><span id="sparklinedash"><canvas width="45" height="20" style="display: inline-block; width: 45px; height: 20px; vertical-align: top;"></canvas></span></div>
                        <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500"><?php echo count($this->envios); ?></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="layers bd bgc-white p-20">
                <div class="layer w-100 mB-10">
                    <h6 class="lh-1">Compras Totales</h6>
                </div>
                <div class="layer w-100">
                    <div class="peers ai-sb fxw-nw">
                        <div class="peer peer-greed"><span id="sparklinedash2"><canvas width="45" height="20" style="display: inline-block; width: 45px; height: 20px; vertical-align: top;"></canvas></span></div>
                        <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500"><?php echo count($this->compras); ?></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>