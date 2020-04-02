<?php
error_reporting();
define('_JEXEC', 1);
define('DS', DIRECTORY_SEPARATOR);
if (file_exists(dirname(__FILE__) . '/defines.php')) {
	include_once dirname(__FILE__) . '/defines.php';
}
if (!defined('_JDEFINES')) {
	define('JPATH_BASE', dirname(__FILE__));
	require_once JPATH_BASE.'/includes/defines.php';
}
require_once JPATH_BASE.'/includes/framework.php';
$app = JFactory::getApplication('site');
// Initialise the application.
$app->initialise();

jimport('joomla.filesystem.folder');
		jimport('joomla.filesystem.file');
		$db			= JFactory::getDbo();

/*
echo '<table>';
foreach($res as $r)
	{
		echo '<tr>';
			echo '<td>';
				echo $r->page;
			echo '</td>';
		echo '</tr>';
	}
echo '</table>';

echo '<br>';
*/


		$d = new DateTime();
		$dateNow = $d->format('Y-m-d');
		$dateNowEspanol = $d->format('d-m-Y');

		$d->modify('-1 day');
		$dateYester = $d->format('Y-m-d');
		$datedateYesterEspanol = $d->format('d-m-Y');

		$productUrl = 'http://www.montehermosoalquila.com.ar/propiedad/';

		//echo 	$dateNowEspanol;

		//$agentInIds = '5,6,7,8,11,12,13,14,15,18,20,21,23,24,25,26,27';

		//$agentInIds = '24';

		//$queryA = 'SELECT id,mid,name,email FROM #__properties_profiles where id in('.$agentInIds.')';
		$queryA = 'SELECT pf.id,pf.mid,pf.name,pf.email FROM #__properties_profiles as pf WHERE pf.published = 1 order by pf.name asc';
		$db->setQuery( $queryA );
		$agents = $db->loadObjectList();
//echo '<br>agents: '.count($agents).'<br>';

$htmlToAgent = '
hola2
';

$htmlToFabio = 'hola2';

		sendMail($htmlToFabio);



function sendMail($htmlToAgent)
	{
	//echo '<br><b>erica</b><br>';
	global $mainframe;
	$app		= JFactory::getApplication();
		jimport('joomla.filesystem.folder');
		jimport('joomla.filesystem.file');
		$siteURL		= JURI::base();

		$MailFrom	= 'admin@montehermosoalquila.com.ar';
		$FromName	= 'Monte Hermoso Alquila';

		$siteURL		= JURI::base();
		$subject	= 'hola '.date('d-m-Y H:i:s');	

		$body = '';//'Informe de Trans '.date('d-m-Y h:i:s').'<br>';
		$body .= $htmlToAgent;

		$sender = array($MailFrom, $FromName);

		$mail = JFactory::getMailer();
		$mail->isHtml(true);
		$mail->setSender($sender);
	
		$mail->addRecipient('fabiouz@gmail.com');	

		$mail->setSubject($subject);
		$mail->Encoding = 'base64';
		$mail->setBody($body_html);

		$mail->SMTPOptions = array(
			'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
			)
		);

		$status = $mail->Send();
		echo '$status: ' . $status;

	}
?>
