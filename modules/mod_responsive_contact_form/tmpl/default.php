<form action="" method="post" class="form-contacto form-validate form-horizontal well">
	<section class="page contacto">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-12 col-md-6 fondo-azul">
					<?php if (JRequest::getInt('Itemid') != 101) { ?>
						<h1 class="page-title"><?php echo JText::_('BINNAKLE_CONTACTA_CON_NOSOTROS');?></h1>
					<?php } ?>
					<div class="contact-form-left">

						<div class="form-group row">
							<label for="nombre" class="col-sm-3 col-form-label"><?php echo JText::_('BINNAKLE_CONTACTO_NOMBRE');?>*</label>
							<div class="col-sm-9">
								<input type="text" class="form-control required" name="nombre" id="nombre" placeholder="Nombre" value="" required aria-required="true" />
							</div>
						</div>

						<div class="form-group row">
							<label for="apellido" class="col-sm-3 col-form-label"><?php echo JText::_('BINNAKLE_CONTACTO_APELLIDO');?>*</label>
							<div class="col-sm-9">
								<input type="text" class="form-control required" name="apellido" id="apellido" placeholder="Apellido" value="" required aria-required="true" />
							</div>
						</div>

						<div class="form-group row">
							<label for="empresa" class="col-sm-3 col-form-label"><?php echo JText::_('BINNAKLE_CONTACTO_EMPRESA');?>*</label>
							<div class="col-sm-9">
								<input type="text" class="form-control required" name="empresa" id="empresa" placeholder="Empresa" value="" required aria-required="true" />
							</div>
						</div>

						<div class="form-group row">
							<label for="cargo" class="col-sm-3 col-form-label"><?php echo JText::_('BINNAKLE_CONTACTO_CARGO');?></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo" value="">
							</div>
						</div>

						<div class="form-group row">
							<label for="pais" class="col-sm-3 col-form-label"><?php echo JText::_('BINNAKLE_CONTACTO_PAIS');?>*</label>
							<div class="col-sm-9">
								<input type="text" class="form-control required" name="pais" id="pais" placeholder="Pais" value="" required aria-required="true" />
							</div>
						</div>

						<div class="form-group row">
							<label for="email" class="col-sm-3 col-form-label required"><?php echo JText::_('BINNAKLE_CONTACTO_EMAIL');?>*</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="" required aria-required="true" />
							</div>
						</div>

						<?php if ($esCompraJuega) { ?>

							<div class="form-group row">
								<label for="telefono" class="col-sm-3 col-form-label"><?php echo JText::_('BINNAKLE_CONTACTO_TELEFONO');?>*</label>
								<div class="col-sm-9">
									<input type="text" class="form-control required" name="telefono" id="telefono" placeholder="Teléfono" value="" required aria-required="true" />
								</div>
							</div>

							<div class="form-group row">
								<label for="interes" class="col-sm-3 col-form-label"><?php echo JText::_('BINNAKLE_CONTACTO_INTERES');?>*</label>
								<div class="col-sm-9">
									<input type="text" class="form-control required" name="interes" id="interes" placeholder="Interés" value="" required aria-required="true" />
								</div>
							</div>

						<?php } else { ?>

						<?php } ?>

						<div class="form-group-campos-obligatorios">
							<p class="campos-obligatorios">* <?php echo JText::_('BINNAKLE_CONTACTO_CAMPOS_OBLIGATORIOS');?></p>
						</div>

					</div>
				</div>

				<div class="col-12 col-md-6">
					<div class="contact-form-right align-middle">

						<div class="form-group">
							<label for="textareaComentario" class="textarea-comentario-label"><?php echo JText::_('BINNAKLE_EMAIL_COMENTARIO');?></label>
							<textarea class="form-control textarea-comentario" name="comentario" id="textareaComentario" rows="3"></textarea>
						</div>

						<div class="form-check checkbox-politica">
							<input class="form-check-input" type="checkbox" value="1" name="politica" id="politica" required>
							<label class="form-check-label" for="politica">
							<?php echo JText::_('BINNAKLE_POLITICA_HE_LEIDO');?> <a target="blank_" href="./aviso-legal-y-politica-de-privacidad.html"><?php echo JText::_('BINNAKLE_POLITICA_DE_PRIVACIDAD');?></a>
							</label>
						</div>
						
						<!-- Captcha Field -->
						<div id="html_element"></div>		

						<button name="contacto_enviado" type="submit" class="btn btn-primary btn-azul float-right"><?php echo JText::_('BINNAKLE_CONTACTO_ENVIAR');?></button>

						<div style="clear: both;"></div>
	

					</div>
				</div>
			</div>
		</div>

	</section>

	<div class="controls">		
		<?php echo JHtml::_('form.token'); ?>
	</div>

</form>