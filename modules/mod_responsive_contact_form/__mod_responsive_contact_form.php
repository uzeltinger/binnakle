<?php
/**
 * @package Module Responsive Contact Form for Joomla! 3.x
 * @version 3.0: mod_responsive_contact_form.php Novembar,2013
 * @author Joomla Drive Team
 * @copyright (C) 2013- Joomla Drive
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('_JEXEC') or die;
/*
$document = JFactory::getDocument();
$document->addScriptDeclaration('jQuery.noConflict();');
// Javascript
$document->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
$document->addScript(JURI::base(true) . '/modules/mod_responsive_contact_form/js/jqBootstrapValidation.min.js');
$document->addScriptDeclaration('jQuery(function () { jQuery("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );');
// Stylesheet
$document->addStylesheet(JURI::base(true) . '/modules/mod_responsive_contact_form/css/style.css');
require_once('modules/mod_responsive_contact_form/formkey_class.php');
require_once('modules/mod_responsive_contact_form/recaptchalib.php');
$formKey = new formKey();
*/
	//print_r($_POST); die();

	if (isset($_POST['contacto_enviado'])) {
		JSession::checkToken() or die( 'Invalid Token' );

// Requesting form elements
		$app		= JFactory::getApplication();

		$sitename 		= $app->getCfg( 'sitename' );		
		$mailfrom 		= $app->getCfg( 'mailfrom' );
		$fromname 		= $app->getCfg( 'fromname' );		
		$siteURL		= JURI::base();

		$salto = "\r\n";
		$salto = "<br>";
		$body_html = "";
		$error = false;
		$errorText = "";
		if (isset($_POST['politica']) && $_POST['politica']==1) {

		}else{
			$error = true;
			$errorText = "Debe aceptar la política de privacidad";
		}
		if (isset($_POST['nombre'])) {
			$nombre = $_POST['nombre'];
			$body_html .= 'Nombre: ' . $nombre . '' . $salto;
		}
		if (isset($_POST['apellido'])) {
			$apellido = $_POST['apellido'];
			$body_html .= 'Apellido: ' . $apellido . '' . $salto;
		}
		if (isset($_POST['empresa'])) {
			$empresa = $_POST['empresa'];
			$body_html .= 'Empresa: ' . $empresa . '' . $salto;
		}
		if (isset($_POST['cargo'])) {
			$cargo = $_POST['cargo'];
			$body_html .= 'Cargo: ' . $cargo . '' . $salto;
		}
		if (isset($_POST['pais'])) {
			$pais = $_POST['pais'];
			$body_html .= 'País: ' . $pais . '' . $salto;
		}
		if (isset($_POST['email'])) {
			$email = $_POST['email'];
			$body_html .= 'E-mail: ' . $email . '' . $salto;
		}
		if (isset($_POST['telefono'])) {
			$telefono = $_POST['telefono'];
			$body_html .= 'Teléfono: ' . $telefono . '' . $salto;
		}
		if (isset($_POST['interes'])) {
			$interes = $_POST['interes'];
			$body_html .= 'Interes: ' . $interes . '' . $salto;
		}
		if (isset($_POST['comentario'])) {
			$comentario = $_POST['comentario'];
			$body_html .= 'Comentario: ' . $comentario . '' . $salto;
		}		

		//print_r($body_html);require('0');

		// Requesting Configuration elements
		$admin_email 	= $params->get('admin_email',$mailfrom);
		$cc_email 		= $params->get('cc_email');
		$bcc_email 		= $params->get('bcc_email');
		$success_notify	= $params->get('success_notify');
		$failure_notify	= $params->get('failure_notify');
		$ffield_name	= $params->get('ffield_name');
		$sfield_name	= $params->get('sfield_name');
		$tfield_name	= $params->get('tfield_name');
		$fofield_name	= $params->get('fofield_name');
		$fifield_name	= $params->get('fifield_name');		
				
		// Enter a subject, only you will see this so make it useful
		$subject ="Contacto desde ".$_SERVER['HTTP_HOST'].'. '.date('Hmi');		
		
		$sender = array($email, $nombre);			
//print_r($admin_email);
//die();
		// Mail Configuration
		$mail = JFactory::getMailer();
		$mail->isHtml();
		$mail->addRecipient($admin_email);
		$mail->addReplyTo($email, $nombre);
		$mail->setSender($sender);
		
		$mail->addCC('fabiouz@gmail.com');			
				
		if(isset($cc_email))
		{
			$mail->addCC($cc_email);
		}
		if(isset($bcc_email))
		{
			$mail->addBCC($bcc_email);
		}

		$mail->setSubject($subject);
		//$mail->Encoding = 'base64';	
		$mail->setBody($body_html);
		$status = $mail->Send();

			if(isset($_POST['email_copy'])){			
				if($_POST['email_copy']==1){
					$mail = JFactory::getMailer();
					$mail->isHtml();
					$mail->addRecipient($email);
					$mail->addReplyTo($mailfrom, $fromname);
					$mail->setSender(array($mailfrom, $fromname));
					$mail->setSubject($subject);
					$mail->setBody($body_html);			
					$sent = $mail->Send();
				}
			}

			if($status){
				$mensaje = '<b>¡Gracias por contactar con nosotros!</b> <br> No es necesario que hagas nada más. Intentamos responder lo más rápido posible,
				así que pronto nos pondremos en contacto contigo. ' ;
				/*if(JRequest::getInt('Itemid') == 105)
				{
					$mensaje = 'Hemos recibido tus datos correctamente, Muchas gracias por tu participación!';
				}*/
				//echo 'status'.$status;			
				JFactory::getApplication()->enqueueMessage($mensaje);
			}
}
?>

<style>
h4.alert-heading {
	display: none;
}
#system-message {
	margin-top: 30px;
	margin-bottom: 30px;	
}
#system-message .alert-notice{
	max-width: 620px;
	text-align: center;
	margin: 0 auto;
	background: #000;
	color: #fff;
	border-radius: 15px;
}
#system-message .alert-notice .alert-message{
	background: #000;
}
#system-message .alert-message{
	max-width: 620px;
	text-align: center;
	margin: 0 auto;
	background: #90A82F;
	color: #fff;
	border-radius: 15px;
}
</style>

		<?php if( isset ($error)) {?>
		<div class="alert alert-error">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong> <?=$error; ?></strong>
		</div>
		<?php } ?>

<?php $esCompraJuega = false; ?>

	<?php if (JRequest::getInt('Itemid') == 114) {
		$esCompraJuega = true; ?>
		<div class="form-contacto-titulo form-contacto-<?php echo JRequest::getInt('Itemid') ?>">
		<p><b>¡Gracias por tu interés en Binnakle The Expedition!</b></p>
		<p>Muy pronto tendremos disponible la zona de compra on-line de nuestros serious games.
			<br>
			Mientras tanto puedes contactar con nosotros a través del siguiente formulario y un consultor de Binnakle se pondrá en contacto contigo.
		</p>
		</div>
	<?php } ?>

	<?php if (JRequest::getInt('Itemid') == 116) {
		$esCompraJuega = true; ?>
		<div class="form-contacto-titulo form-contacto-<?php echo JRequest::getInt('Itemid') ?>">
		<p><b>¡Gracias por tu interés en Binnakle Mission 0!</b></p>
		<p>Muy pronto tendremos disponible la zona de compra on-line de nuestros serious games.
			<br>
			Mientras tanto puedes contactar con nosotros a través del siguiente formulario y un consultor de Binnakle se pondrá en contacto contigo.
		</p>
		</div>
	<?php } ?>

	<?php if (JRequest::getInt('Itemid') == 115) {
		$esCompraJuega = true; ?>
		<div class="form-contacto-titulo form-contacto-<?php echo JRequest::getInt('Itemid') ?>">
		<p><b>Estamos trabajando en las plataformas digitales para jugar con nuestros serious games</b></p>
		<p>¡Muy pronto estarán disponibles!
			<br>
			Mientras tanto puedes contactar con nosotros a través del siguiente formulario y un consultor de Binnakle se pondrá en contacto contigo.
		</p>
		</div>
	<?php } ?>

	<?php if (JRequest::getInt('Itemid') == 117) {
		$esCompraJuega = true; ?>
		<div class="form-contacto-titulo form-contacto-<?php echo JRequest::getInt('Itemid') ?>">
		<p><b>Estamos trabajando en las plataformas digitales para jugar con nuestros serious games</b></p>
		<p>¡Muy pronto estarán disponibles!
			<br>
			Mientras tanto puedes contactar con nosotros a través del siguiente formulario y un consultor de Binnakle se pondrá en contacto contigo.
		</p>
		</div>
	<?php } ?>




<form action="contacto.html" method="post" class="form-contacto form-validate form-horizontal well">
	<section class="page contacto">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-12 col-md-6 fondo-azul">
					<?php if (JRequest::getInt('Itemid') != 101) { ?>
						<h1 class="page-title">CONTACTA CON NOSOTROS</h1>
					<?php } ?>
					<div class="contact-form-left">

						<div class="form-group row">
							<label for="nombre" class="col-sm-3 col-form-label">Nombre*</label>
							<div class="col-sm-9">
								<input type="text" class="form-control required" name="nombre" id="nombre" placeholder="Nombre" value="" required aria-required="true" />
							</div>
						</div>

						<div class="form-group row">
							<label for="apellido" class="col-sm-3 col-form-label">Apellido*</label>
							<div class="col-sm-9">
								<input type="text" class="form-control required" name="apellido" id="apellido" placeholder="Apellido" value="" required aria-required="true" />
							</div>
						</div>

						<div class="form-group row">
							<label for="empresa" class="col-sm-3 col-form-label">Empresa*</label>
							<div class="col-sm-9">
								<input type="text" class="form-control required" name="empresa" id="empresa" placeholder="Empresa" value="" required aria-required="true" />
							</div>
						</div>

						<div class="form-group row">
							<label for="cargo" class="col-sm-3 col-form-label">Cargo</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo" value="">
							</div>
						</div>

						<div class="form-group row">
							<label for="pais" class="col-sm-3 col-form-label">Pais*</label>
							<div class="col-sm-9">
								<input type="text" class="form-control required" name="pais" id="pais" placeholder="Pais" value="" required aria-required="true" />
							</div>
						</div>

						<div class="form-group row">
							<label for="email" class="col-sm-3 col-form-label required">E-mail*</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="" required aria-required="true" />
							</div>
						</div>

						<?php if ($esCompraJuega) { ?>

							<div class="form-group row">
								<label for="telefono" class="col-sm-3 col-form-label">Teléfono*</label>
								<div class="col-sm-9">
									<input type="text" class="form-control required" name="telefono" id="telefono" placeholder="Teléfono" value="" required aria-required="true" />
								</div>
							</div>

							<div class="form-group row">
								<label for="interes" class="col-sm-3 col-form-label">Estoy interesado en*</label>
								<div class="col-sm-9">
									<input type="text" class="form-control required" name="interes" id="interes" placeholder="Interés" value="" required aria-required="true" />
								</div>
							</div>

						<?php } else { ?>

						<?php } ?>

						<div class="form-group-campos-obligatorios">
							<p class="campos-obligatorios">* Campos obligatorios</p>
						</div>

					</div>
				</div>

				<div class="col-12 col-md-6">
					<div class="contact-form-right align-middle">

						<div class="form-group">
							<label for="textareaComentario" class="textarea-comentario-label">Comentario</label>
							<textarea class="form-control textarea-comentario" name="comentario" id="textareaComentario" rows="3"></textarea>
						</div>

						<div class="form-check checkbox-politica">
							<input class="form-check-input" type="checkbox" value="1" name="politica" id="politica" required>
							<label class="form-check-label" for="politica">
								He leído y acepto la <a target="blank_" href="./aviso-legal-y-politica-de-privacidad.html">política de privacidad</a>
							</label>
						</div>

						<button name="contacto_enviado" type="submit" class="btn btn-primary btn-azul float-right">ENVIAR</button>

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
