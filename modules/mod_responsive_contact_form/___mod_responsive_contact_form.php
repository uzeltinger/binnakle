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

	//<script src="https://www.google.com/recaptcha/api.js" async defer></script>

	
//$document = JFactory::getDocument();
//$document->addScript('https://www.google.com/recaptcha/api.js');
//require_once('modules/mod_responsive_contact_form/recaptchalib.php');

use Joomla\CMS\Captcha\Google\HttpBridgePostRequestMethod;
use Joomla\Utilities\IpHelper;

JHtml::_('script', 'plg_captcha_recaptcha/recaptcha.min.js', array('version' => 'auto', 'relative' => true));
$file = 'https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=' . JFactory::getLanguage()->getTag();
JHtml::_('script', $file);

	$error = false;
	$errorText = "";

	if (isset($_POST['contacto_enviado'])) {
		
			$private_key = $params->get('private_key');
			
			//$resp = recaptcha_check_answer ($private_key,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
			
			$resp_is_valid = onCheckAnswer($params);


			if (!$resp_is_valid) {

				// What happens when the CAPTCHA was entered incorrectly
				echo "<script>javascript:Recaptcha.reload();</script>"; // reload captcha
				$error = true;
				//$errorText = "Debe aceptar la casilla de verificación, por favor intente nuevamente."; // kill program and return error message
				$errorText = JText::_('BINNAKLE_DEBE_ACEPTAR_RECAPTCHA');
			}else{

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
		if (isset($_POST['politica']) && $_POST['politica']==1) {

		}else{
			$error = true;
			$errorText = JText::_('BINNAKLE_DEBE_ACEPTAR_POLITICA');
		}
		if (isset($_POST['nombre'])) {
			$nombre = $_POST['nombre'];
			$body_html .= JText::_('BINNAKLE_EMAIL_NOMBRE') . $nombre . '' . $salto;
		}
		if (isset($_POST['apellido'])) {
			$apellido = $_POST['apellido'];
			$body_html .= JText::_('BINNAKLE_EMAIL_APELLIDO') . $apellido . '' . $salto;
		}
		if (isset($_POST['empresa'])) {
			$empresa = $_POST['empresa'];
			$body_html .= JText::_('BINNAKLE_EMAIL_EMPRESA') . $empresa . '' . $salto;
		}
		if (isset($_POST['cargo'])) {
			$cargo = $_POST['cargo'];
			$body_html .= JText::_('BINNAKLE_EMAIL_CARGO') . $cargo . '' . $salto;
		}
		if (isset($_POST['pais'])) {
			$pais = $_POST['pais'];
			$body_html .= JText::_('BINNAKLE_EMAIL_PAIS') . $pais . '' . $salto;
		}
		if (isset($_POST['email'])) {
			$email = $_POST['email'];
			$body_html .= JText::_('BINNAKLE_EMAIL_EMAIL') . $email . '' . $salto;
		}
		if (isset($_POST['telefono'])) {
			$telefono = $_POST['telefono'];
			$body_html .= JText::_('BINNAKLE_EMAIL_TELEFONO') . $telefono . '' . $salto;
		}
		if (isset($_POST['interes'])) {
			$interes = $_POST['interes'];
			$body_html .= JText::_('BINNAKLE_EMAIL_INTERES') . $interes . '' . $salto;
		}
		if (isset($_POST['comentario'])) {
			$comentario = $_POST['comentario'];
			$body_html .= JText::_('BINNAKLE_EMAIL_COMENTARIO') . $comentario . '' . $salto;
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
		if (JRequest::getInt('Itemid') == 120) {
			$subject = "Interesado en campaña: Gamificación para formar en cultura y metodología para innovar"; 
		}
		if (JRequest::getInt('Itemid') == 121) {
			$subject = "Interesado en campaña: Gamificación para añadir valor a eventos corporativos y hackatones de innovación"; 
		}
		if (JRequest::getInt('Itemid') == 122) {
			$subject = "Interesado en campaña: Gamificación para detectar perfiles innovadores y ágiles"; 
		}
		
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
				$mensaje =  JText::_('BINNAKLE_CONTACTO_MENSAJE_EXITO');
				/*if(JRequest::getInt('Itemid') == 105)
				{
					$mensaje = 'Hemos recibido tus datos correctamente, Muchas gracias por tu participación!';
				}*/
				//echo 'status'.$status;			
				JFactory::getApplication()->enqueueMessage($mensaje);
			}
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





<script type="text/javascript">
  var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '<?php echo $params->get('public_key');?>'
        });
      };
</script>




		<?php if( isset ($error)) {?>
		<div class="alert alert-error">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong> <?php echo $errorText; ?></strong>
		</div>
		<?php } ?>

<?php $esCompraJuega = false; ?>

	<?php if (JRequest::getInt('Itemid') == 114 || JRequest::getInt('Itemid') == 127) {
		$esCompraJuega = true; ?>
		<div class="form-contacto-titulo form-contacto-<?php echo JRequest::getInt('Itemid') ?>">
		<p><b><?php echo JText::_('BINNAKLE_CONTACTA_GRACIAS_INTERES_EXPEDITION');?></b></p>
		<p>
			<?php echo JText::_('BINNAKLE_CONTACTA_GRACIAS_INTERES_EXPEDITION_DETALLE');?>
		</p>
		</div>
	<?php } ?>
	
	<?php if (JRequest::getInt('Itemid') == 116 || JRequest::getInt('Itemid') == 128) {
		$esCompraJuega = true; ?>
		<div class="form-contacto-titulo form-contacto-<?php echo JRequest::getInt('Itemid') ?>">
		<p><b><?php echo JText::_('BINNAKLE_CONTACTA_GRACIAS_INTERES_MISSION0');?></b></p>
		<p>
			<?php echo JText::_('BINNAKLE_CONTACTA_GRACIAS_INTERES_MISSION0_DETALLE');?>		
		</p>
		</div>
	<?php } ?>

	<?php if (JRequest::getInt('Itemid') == 115 || JRequest::getInt('Itemid') == 130) {
		$esCompraJuega = true; ?>
		<div class="form-contacto-titulo form-contacto-<?php echo JRequest::getInt('Itemid') ?>">
		<p><b><?php echo JText::_('BINNAKLE_CONTACTA_ESTAMOS_TRABAJANDO_JUEGOS');?></b></p>
		<p>
			<?php echo JText::_('BINNAKLE_CONTACTA_ESTAMOS_TRABAJANDO_JUEGOS_DETALLE');?>
		</p>
		</div>
	<?php } ?>

	<?php if (JRequest::getInt('Itemid') == 117 || JRequest::getInt('Itemid') == 129) {
		$esCompraJuega = true; ?>
		<div class="form-contacto-titulo form-contacto-<?php echo JRequest::getInt('Itemid') ?>">
		<p><b><?php echo JText::_('BINNAKLE_CONTACTA_ESTAMOS_TRABAJANDO_JUEGOS');?></b></p>
		<p>
			<?php echo JText::_('BINNAKLE_CONTACTA_ESTAMOS_TRABAJANDO_JUEGOS_DETALLE');?>
		</p>
		</div>
	<?php } ?>




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









<?php
function onCheckAnswer($params, $code = null)
{
	$input      = \JFactory::getApplication()->input;
	$privatekey = $params->get('private_key');
	
	$remoteip   = IpHelper::getIp();

	
		// Challenge Not needed in 2.0 but needed for getResponse call
		$challenge = null;
		$response  = $input->get('g-recaptcha-response', '', 'string');
		$spam      = ($response === '');

	// Check for Private Key
	if (empty($privatekey))
	{
		return false;
		//throw new \RuntimeException(JText::_('PLG_RECAPTCHA_ERROR_NO_PRIVATE_KEY'));
	}

	// Check for IP
	if (empty($remoteip))
	{
		return false;
		//throw new \RuntimeException(JText::_('PLG_RECAPTCHA_ERROR_NO_IP'));
	}

	// Discard spam submissions
	if ($spam)
	{
		return false;
		//throw new \RuntimeException(JText::_('PLG_RECAPTCHA_ERROR_EMPTY_SOLUTION'));
	}

	return getResponse($privatekey, $remoteip, $response, $challenge);
}

function getResponse($privatekey, $remoteip, $response, $challenge = null)
{
	
			$reCaptcha = new \ReCaptcha\ReCaptcha($privatekey, new HttpBridgePostRequestMethod);
			$response = $reCaptcha->verify($response, $remoteip);

			if (!$response->isSuccess())
			{
				foreach ($response->getErrorCodes() as $error)
				{
					throw new \RuntimeException($error);
				}

				return false;
			}
			
	

	return true;
}
?>