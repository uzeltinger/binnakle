<div class="form-contacto-titulo form-contacto-<?php echo JRequest::getInt('Itemid')?>">

<?php if (JRequest::getInt('Itemid') == 114) { ?>
    <p><b>¡Gracias por tu interés en Binnakle The Expedition!</b></p>
    <p>Muy pronto tendremos disponible la zona de compra on-line de nuestros serious games.
        <br>
        Mientras tanto puedes contactar con nosotros a través del siguiente formulario y un consultor de Binnakle se pondrá en contacto contigo.
    </p>
<?php } ?>

<?php if (JRequest::getInt('Itemid') == 116) { ?>
    <p><b>¡Gracias por tu interés en Binnakle Mission 0!</b></p>
    <p>Muy pronto tendremos disponible la zona de compra on-line de nuestros serious games.
        <br>
        Mientras tanto puedes contactar con nosotros a través del siguiente formulario y un consultor de Binnakle se pondrá en contacto contigo.
    </p>
<?php } ?>

<?php if (JRequest::getInt('Itemid') == 115) { ?>
    <p><b>Estamos trabajando en las plataformas digitales para jugar con nuestros serious games</b></p>
    <p>¡Muy pronto estarán disponibles!
        <br>
        Mientras tanto puedes contactar con nosotros a través del siguiente formulario y un consultor de Binnakle se pondrá en contacto contigo.
    </p>
<?php } ?>

<?php if (JRequest::getInt('Itemid') == 117) { ?>
    <p><b>Estamos trabajando en las plataformas digitales para jugar con nuestros serious games</b></p>
    <p>¡Muy pronto estarán disponibles!
        <br>
        Mientras tanto puedes contactar con nosotros a través del siguiente formulario y un consultor de Binnakle se pondrá en contacto contigo.
    </p>
<?php } ?>

</div>


<form action="contacto.html" method="GET" class="form-contacto">
        <section class="page contacto">


            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6 fondo-azul">
                        <h1 class="page-title">CONTACTA CON NOSOTROS</h1>
                        <div class="contact-form-left">

                            <div class="form-group row">
                                <label for="nombre" class="col-sm-3 col-form-label">Nombre*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nombre" id="nombre"
                                        placeholder="Nombre" value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="apellido" class="col-sm-3 col-form-label">Apellido*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="apellido" id="apellido"
                                        placeholder="Apellido">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="empresa" class="col-sm-3 col-form-label">Empresa*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="empresa" id="empresa"
                                        placeholder="Empresa">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cargo" class="col-sm-3 col-form-label">Cargo</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pais" class="col-sm-3 col-form-label">Pais*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="pais" id="pais" placeholder="Pais">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">E-mail*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="email" id="email"
                                        placeholder="E-mail">
                                </div>
                            </div>

                            <div class="form-group-campos-obligatorios">
                                <p class="campos-obligatorios">* Campos obligatorios</p>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="contact-form-right align-middle">

                            <div class="form-group">
                                <label for="textareaComentario" class="textarea-comentario-label">Comentario</label>
                                <textarea class="form-control textarea-comentario" name="comentario"
                                    id="textareaComentario" rows="3"></textarea>
                            </div>

                            <div class="form-check checkbox-politica">
                                <input class="form-check-input" type="checkbox" value="" name="politica" id="politica">
                                <label class="form-check-label" for="politica">
                                    He leído y acepto la política de privacidad
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-azul float-right">ENVIAR</button>

                            <div style="clear: both;"></div>

                        </div>
                    </div>
                </div>
            </div>

        </section>

    </form>