<?php

defined('_JEXEC') or die;

class ComprasViewCheckout extends JViewLegacy
{
	public function display($tpl = null)
	{
		$app        = JFactory::getApplication();
		$user       = JFactory::getUser();
		$dispatcher = JEventDispatcher::getInstance();
		$jinput = JFactory::getApplication()->input;
		$this->lang = substr( JRequest::getVar('lang','es') , 0, 2);

		$doc = JFactory::getDocument();
		$this->language = $doc->language;

		$this->items  = $this->get('Items');
		$this->state = $this->get('State');
		$this->user  = $user;

		if($this->lang=='en'){
			foreach ($this->items as $key => $value) {
				//echo $this->items[$key]->name_en.'<br>';
				$this->items[$key]->name = $this->items[$key]->name_en; 
				$this->items[$key]->detail = $this->items[$key]->detail_en; 
			}
		}
		
		$maletas = [];
		foreach ($this->items as $item) {
			$maletas[$item->id] = $item; 
		}

		/*$this->impuestos  = $this->get('Impuestos');
		$this->envios  = $this->get('Envios');
		echo '<pre>';print_r($this->impuestos);echo '</pre>';
		echo '<pre>';print_r($this->envios);echo '</pre>';*/
		$this->countries  = $this->get('Paises');

		$paises = [];
		foreach ($this->countries as $pais) {
			$paises[$pais->id] = $pais;
		}
		$this->paises = $paises;

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));
			return false;
		}

		$session = JFactory::getSession();
		$carrito = $session->get('carrito');

		if (JRequest::getInt('maleta')) {
			$maletaId = JRequest::getInt('maleta');
			
			$session->set('reference_id', time());

			if (!isset($carrito)) {
				$carrito = [];				
			}
			if (isset($maletas[$maletaId])) {
				$carrito[$maletaId] = $maletas[$maletaId];
			}
			$session->set('maleta', JRequest::getInt('maleta'));
			$session->set('carrito', $carrito);			
		}

		

		if (JRequest::getInt('borrarmaleta')) {
			$maletaId = JRequest::getInt('borrarmaleta');
			$session->set('reference_id', time());
			if (isset($maletas[$maletaId]) && $carrito[$maletaId]) {
				unset($carrito[$maletaId]);
				$session->set('carrito', $carrito);
			}
		
			if(count($carrito)==0){
				switch ($maletas[$maletaId]->game) {
					case 1:
						$redirectTo = "comprar-binnakle-the-expedition.html";
						break;					
					case 2:
						$redirectTo = "comprar-binnakle-mission-0.html";
						break;
					default:
						$redirectTo = "comprar-binnakle-mission-0.html";
						break;
				}				
				$app->redirect($redirectTo);
			}

		}
		

		$this->maletas = $maletas;
		$this->carrito = $carrito;
		$this->reference_id = $session->get('reference_id');

		$this->_prepareDocument();


		$session = JFactory::getSession();
		$this->comprador = [];
		if ($session->get('comprador')) {
			$this->comprador = $session->get('comprador');
		} else {
			$comprador = [];
			$comprador['nombre'] = "";
			$comprador['apellido'] = "";
			$comprador['empresa'] = "";
			$comprador['cargo'] = "";
			$comprador['pais'] = "";
			$comprador['telefono'] = "";
			$comprador['email'] = "";
			$comprador['factura_nombre'] = "";
			$comprador['factura_nif'] = "";
			$comprador['factura_domicilio'] = "";
			$comprador['factura_pais'] = "";
			$comprador['factura_provincia'] = "";
			$comprador['factura_ciudad'] = "";
			$comprador['factura_zip'] = "";
			$comprador['envio_nombre'] = "";
			$comprador['envio_domicilio'] = "";
			$comprador['envio_pais'] = "";
			$comprador['envio_provincia'] = "";
			$comprador['envio_ciudad'] = "";
			$comprador['envio_zip'] = "";
			$this->comprador = $comprador;
		}

		

		if (JRequest::getInt('pagar')) {

			$this->webinar = $jinput->get('webinar');
			$session->set('webinar', $this->webinar);

			if($this->webinar>0){
				$carrito[$this->webinar] = $maletas[$this->webinar];
				$this->carrito = $carrito;
				$session->set('carrito', $carrito);
			}
			
			$this->idDescuento = $jinput->get('idDescuento', 0);
			$session->set('idDescuento', $this->idDescuento);			

			$this->descuento = $this->getDescuento($this->idDescuento);
			//echo $this->descuento;
			$nombre = $jinput->get('nombre', '', 'raw');
			$apellido = $jinput->get('apellido', '', 'raw');
			$empresa = $jinput->get('empresa', '', 'raw');
			$cargo = $jinput->get('cargo', '', 'raw');
			$pais = $jinput->get('pais', '', 'raw');
			$telefono = $jinput->get('telefono', '');
			$email = $jinput->get('email', '', 'raw');
			$factura_nif = $jinput->get('factura_nif', '', 'raw');
			$factura_nombre = $jinput->get('factura_nombre', '');
			$factura_domicilio = $jinput->get('factura_domicilio', '', 'raw');
			$factura_pais = $jinput->get('factura_pais', '', 'raw');
			$factura_provincia = $jinput->get('factura_provincia', '', 'raw');
			$factura_ciudad = $jinput->get('factura_ciudad', '', 'raw');
			$factura_zip = $jinput->get('factura_zip', '', 'raw');
			$envio_nombre = $jinput->get('envio_nombre', '', 'raw');
			$envio_domicilio = $jinput->get('envio_domicilio', '', 'raw');
			$envio_pais = $jinput->get('envio_pais', '', 'raw');
			$envio_provincia = $jinput->get('envio_provincia', '', 'raw');
			$envio_ciudad = $jinput->get('envio_ciudad', '', 'raw');
			$envio_zip = $jinput->get('envio_zip', '', 'raw');

			$comprador['nombre'] = $nombre;
			$comprador['apellido'] = $apellido;
			$comprador['empresa'] = $empresa;
			$comprador['cargo'] = $cargo;
			$comprador['pais'] = $pais;
			$comprador['telefono'] = $telefono;
			$comprador['email'] = $email;
			$comprador['factura_nif'] = $factura_nif;
			$comprador['factura_nombre'] = $factura_nombre;
			$comprador['factura_domicilio'] = $factura_domicilio;
			$comprador['factura_pais'] = $factura_pais;
			$comprador['factura_provincia'] = $factura_provincia;
			$comprador['factura_ciudad'] = $factura_ciudad;
			$comprador['factura_zip'] = $factura_zip;
			$comprador['envio_nombre'] = $envio_nombre;
			$comprador['envio_domicilio'] = $envio_domicilio;
			$comprador['envio_pais'] = $envio_pais;
			$comprador['envio_provincia'] = $envio_provincia;
			$comprador['envio_ciudad'] = $envio_ciudad;
			$comprador['envio_zip'] = $envio_zip;

			$session->set('comprador', $comprador);
			$this->comprador = $comprador;
			
			$tpl = 'pagar';
		}
		
		if (JRequest::getInt('pago_transferencia')) {
			$this->saveCompraTransferencia();
			if($this->sendEmail('transferencia')){					
				$session->set('carrito', null);
				$this->carrito = null;
				
			}
			$tpl = 'pago_transferencia';
		}

		if (JRequest::getInt('pago_online')) {			

			if (JRequest::getInt('pago_online')==4){
				echo $this->saveCompra();
				 die();
			}

			if (JRequest::getInt('pago_online')==1){

				if(JRequest::getInt('order')>0){
					$this->numeroPedido = JRequest::getInt('order');
				}
				

				if($this->sendEmail('online')){
					
					$session->set('carrito', null);
					$this->carrito = null;
					$tpl = 'pago_transferencia';
				}			
			}

		}
		//$tpl = 'pagar';
		parent::display($tpl);
		//require('ava');

		//echo '<pre>';print_r($this->paises);echo '</pre>';
	}

	private function getDescuento($idDescuento){
		
		$descuento = 0;
		$costoTotal = 0;
		$carrito = $this->carrito;
		foreach ($carrito as $item) {			
			$costoTotal += $item->costo;
		}
		$cupon = $this->getCupon($idDescuento);
		//echo '<pre>';print_r($cupon);echo '</pre>';
		if($cupon){
		if($cupon->costo){
			$descuento = $cupon->costo;
		}
		if($cupon->discount){
			$descuento = ($cupon->discount * $costoTotal / 100) + $descuento;			
		}
	}

		return $descuento;
	}

	public function getCupon($codigo){
		$db 	= JFactory::getDBO(); 
		$query = 'SELECT a.id, a.name, a.code, a.costo, a.discount FROM #__compras_cupones as a WHERE
		a.published = 1 AND a.id = "'.$codigo.'"';				
		$db->setQuery($query);        
		$cupon = $db->loadObject();		
		return $cupon;
	}

	protected function saveCompraTransferencia(){

		$pais_envio = $this->paises[$this->comprador['envio_pais']];
		$pais_facturacion = $this->paises[$this->comprador['factura_pais']];
		// Get the input data as JSON
		$comprador = $this->comprador;
		$saveData = [];
		$saveData['id']=0;
		$saveData['comprador']=json_encode($comprador);
		$saveData['published']=1;		
		$model = $this->getModel('checkout');					
		$row = $model->storeCompra($saveData);
		$this->numeroPedido = $row->id;
		$saveData['id']=$row->id;
		$saveData['detalles']=$this->getBodyHtml('transferencia');
		$model->storeCompra($saveData);
		//print_r($saveData);die();
		//die();
	}

	protected function saveCompra(){
		// Get the input data as JSON
		$json = new JInputJSON;
		$json_data = json_decode($json->getRaw(), true);
		$file = 'get_post_'.time().'.json';
		file_put_contents($file, $json->getRaw());
		$json_data_body = $json_data['body'];
		$comprador = $json_data_body['comprador'];
		$data = $json_data_body['data'];
		$details = $json_data_body['details'];
		$saveData = [];
		$saveData['id']=0;
		$saveData['paypal_orderID']=$data['orderID'];
		$saveData['paypal_payerID']=$data['payerID'];
		$saveData['paypal_details']=json_encode($details);
		$saveData['comprador']=json_encode($comprador);
		$saveData['published']=1;
		//$saveData['created'] = JFactory::getDate()->toSql();
		$model = $this->getModel('checkout');				
		$row = $model->storeCompra($saveData);
		$this->numeroPedido = $row->id;		
		JFactory::getSession()->set('numeroPedido', $this->numeroPedido);
		$saveData['id']=$row->id;
		$saveData['detalles']=$this->getBodyHtml('online');
		$model->storeCompra($saveData);
return $this->numeroPedido;
		//print_r($json_data_body);
		//print_r($json_data);
	}

	protected function sendEmail($tipo = '')
	{
		$app		= JFactory::getApplication();

		$sitename 		= $app->getCfg('sitename');
		$mailfrom 		= $app->getCfg('mailfrom');
		$fromname 		= $app->getCfg('fromname');
		$siteURL		= JURI::base();
		$sender = array('no-reply@binnakle.com', 'Binnakle');

		$body_html = $this->getBodyHtml($tipo,true);

			//print_r($body_html); die();
			if($this->lang=='es'){
				$subject = "NUEVO PEDIDO BINNAKLE. Nº pedido: " . $this->numeroPedido;
			}else{
				$subject = "NUEVO PEDIDO BINNAKLE. Nº pedido: " . $this->numeroPedido;
			}
			
			
			$mail = JFactory::getMailer();
			$mail->isHtml();
			$mail->addRecipient('orders@binnakle.com');
			$mail->addReplyTo('no-reply@binnakle.com', 'Binnakle');
			$mail->setSender($sender);			
			$mail->addCC('silvia@binnakle.com');
			$mail->addCC('fbehar@evoltis.com');
			$mail->addCC('fabiouz@gmail.com');
			$mail->setSubject($subject);
			$mail->setBody($body_html);
			$status = $mail->Send();
//echo $body_html;
			if($this->lang=='es'){
				$subject = "Confirmación de tu pedido BINNAKLE. Nº pedido: " . $this->numeroPedido;
			}else{
				$subject = "Confirmation of Your BINNAKLE Order, No. " . $this->numeroPedido;
			}

			$body_html = $this->getBodyHtml($tipo,false);

			$mail = JFactory::getMailer();
			$mail->isHtml();
			$mail->addRecipient($this->comprador['email']);
			$mail->addReplyTo('no-reply@binnakle.com', 'Binnakle');		
			$mail->addCC('silvia@binnakle.com');
			$mail->addCC('fbehar@evoltis.com');
			$mail->addCC('fabiouz@gmail.com');
			$mail->setSender($sender);
			$mail->setSubject($subject);
			$mail->setBody($body_html);
			$sent = $mail->Send();
//echo '<br><br>------------------------------------------<br><br>';echo $body_html;die();
			if ($sent) {
				$mensaje = 'Hemos recibido tus datos correctamente, Muchas gracias!';
				//JFactory::getApplication()->enqueueMessage($mensaje);
			}
			
			return $sent;
		
	}

	public function getBodyHtml($tipo = '',$mailToAdmin = true){
		
		//return true;
		jimport('joomla.filesystem.folder');	
		jimport('joomla.filesystem.file');	

		$pais_domicilio = $this->paises[$this->comprador['pais']];
		$pais_envio = $this->paises[$this->comprador['envio_pais']];
		$pais_facturacion = $this->paises[$this->comprador['factura_pais']];
//print_r($pais_facturacion);
		$salto = "\r\n";
		$salto = "<br>";
		$body_html = "";
		$subject = "";

		$path=JPATH_SITE.'/media/com_compras/mail/';
		
		$totalMaletasComprar = 0;
		$itemRenglon = '';
		$costoTotal = 0;
		$maletaTieneEnvio = false;
//print_r($this->carrito); die();
		foreach ($this->carrito as $item) {
			if($item->envio) {
				$maletaTieneEnvio = true;
			}
			$totalMaletasComprar++;			
			$itemRenglon .= '
			<tr><td style="text-align: left; padding: 10px;"><h2 style="font-size: 18px;color: #000000;margin-top: 0;margin-bottom: 0;">
			';
			$itemRenglon .= $item->name.'</h2><p style="margin-top: 0;">'.$item->detail.'</p>';
			$itemRenglon .= '</td><td style="text-align: right; color: #000000; padding: 10px; vertical-align: top;"><h2 style="font-size: 18px;margin-top: 0;margin-bottom: 0;margin-top: 0;margin-bottom: 0;">';
			$itemRenglon .= number_format($item->costo, 2, ',', '.');
			$itemRenglon .= '€ </h2>';
			$itemRenglon .= '</td></tr>';

			$costoTotal += $item->costo;
			//print_r($costoTotal);echo '<br>';
		}
		$session = JFactory::getSession();
		
		$descuento = $this->getDescuento($session->get('idDescuento'));
		
		//print_r($costoTotal);echo '<br>';

		$rowDescuento = "";
		if($descuento>0){
			if($this->lang=='es'){
				$codigoPromocionalTexto = 'CÓDIGO PROMOCIONAL';
			}else{
				$codigoPromocionalTexto = 'PROMOTIONAL CODE';
			}
			$costoTotal = $costoTotal - $descuento; 
			$costoTotalHtml = number_format($costoTotal, 2);
			$rowDescuento = '
			<tr>
				<td style="text-align: right; padding: 5px 10px 5px 10px; border-bottom: 1px solid #dee2e6">'.$codigoPromocionalTexto.'</td>
				<td nowrap style="text-align: right; padding: 5px 10px 5px 10px; border-bottom: 1px solid #dee2e6">-'.number_format($descuento, 2, ',', '.').' €</td>
			</tr>
			';
		}
		//print_r($costoTotal);echo '<br>';
		if($maletaTieneEnvio){
			$envio_name = $pais_envio->envio_name;
			$envio_costo = $pais_envio->envio_costo;
			$envio_dias = $pais_envio->envio_dias;
		}else{
			$envio_costo = 0;
		}
		$impuesto_name = $pais_facturacion->impuesto_name;
		$impuesto_value = $pais_facturacion->impuesto_value;
		//print_r($envio_costo);echo '<br>';
		$costoTotal = $costoTotal + $envio_costo;
		$impuesto = round(($costoTotal / 100)*$impuesto_value, 2);
		$total = $costoTotal + $impuesto;

		//print_r($costoTotal);die();

		$envio_costo = number_format($envio_costo,2, ',', '.');
		$costoTotal = number_format($costoTotal, 2, ',', '.');
		$impuesto = number_format($impuesto,2, ',', '.');
		$total = number_format($total, 2, ',', '.');
		if ($tipo == 'transferencia') {
			$plantilla = $path.$this->lang.'-pago_transferencia.html';
			if($mailToAdmin){
				$plantilla = $path.'admin_pago_transferencia.html';
			}
		}

		if ($tipo == 'online') {
			$plantilla = $path.$this->lang.'-pago_online.html';			
			if($mailToAdmin){
				$plantilla = $path.'admin_pago_online.html';
			}
			$this->numeroPedido = $session->get('numeroPedido');
		}


		$tablaComprador = "";

		if($mailToAdmin){	
			$tablaComprador = '<table border="0" cellpadding="5" cellspacing="5" width="100%"
			style="max-width:600px!important;border-collapse:collapse!important;color:#222222;background:#ffffff;">';
			$tablaComprador .= '<tr><td colspan="2"><b>Datos del contacto: </b></td></tr>';
			foreach($this->comprador as $k=>$v){
				//echo '<br>k: '.$k.' v: '. $v . ' ' ;
				if($k == "pais"){
					$v = $pais_domicilio->name;
					//echo '<br>k: '.$k.' v: '. $v . ' ' ;
				}
				if($k == "factura_pais"){
					$v = $pais_facturacion->name;
					//echo '<br>k: '.$k.' v: '. $v . ' ' ;
				}
				if($k == "envio_pais"){
					$v = $pais_envio->name;
					//echo '<br>k: '.$k.' v: '. $v . ' ' ;
				}
				$tablaComprador .= '<tr><td>'. JText::_('campo_comprador_'.$k).'</td><td>'.$v.'</td></tr>';
				if($k == "email"){$tablaComprador .= '<tr><td><b><br>Datos de facturación: </b></td><td></td></tr>';}
				if($k == "factura_zip"){$tablaComprador .= '<tr><td><b><br>Datos de envío: </b></td><td></td></tr>';}
			}
			$tablaComprador .= '</table><p><br></p>';	
		}		

		$textoTotal = "";
		switch ($pais_facturacion->id) {
			case 194: //es
				$textoImpuestos = "IVA 21%";
				$textoTotal = JText::_('BINNAKLE_TOTAL_IVA_INCLUIDO');
				break;		
			default:
				$textoImpuestos = JText::_('BINNAKLE_IVA_OTROS_IMPUESTOS');
				$textoTotal = "TOTAL ";
				break;
		}

		$rowImpuesto = "";
		if($impuesto_value>0){
			$rowImpuesto = '
			<tr>
				<td style="text-align: right; padding: 5px 10px 5px 10px; border-bottom: 1px solid #dee2e6">TOTAL</td>
				<td nowrap style="text-align: right; padding: 5px 10px 5px 10px; border-bottom: 1px solid #dee2e6">'.$costoTotal.' €</td>
			</tr>
			<tr>
				<td style="text-align: right; padding: 5px 10px 5px 10px; border-bottom: 1px solid #dee2e6">'.$textoImpuestos.'</td>
				<td nowrap style="text-align: right; padding: 5px 10px 5px 10px; border-bottom: 1px solid #dee2e6">'.$impuesto.' €</td>
			</tr>
			';
			
		}
		
		$campoDias = "";
		$rowEnvio = "";
		if($maletaTieneEnvio){
			if($this->lang=='es'){
				$envioTexto = "Plazo de entrega estimado: $envio_dias días laborables";
			}else{
				$envioTexto = "Estimated delivery period: $envio_dias working days";
			}
			$rowEnvio = '
			<tr>
				<td style="text-align: right; padding: 5px 10px 5px 10px; border-bottom: 1px solid #dee2e6">'.JText::_('BINNAKLE_GASTOS_DE_ENVIO').'</td>
				<td nowrap style="text-align: right; padding: 5px 10px 5px 10px; border-bottom: 1px solid #dee2e6">'.$envio_costo.' €</td>
			</tr>
			';
			$campoDias = '
			<tr>
				<td style="padding: 10px;"> '.$envioTexto.' </td>
				<td></td>
			</tr>
			';
		}

			$body_html = JFile::read($plantilla);	
			$body_html = str_replace('CAMPO_NOMBRE',$this->comprador['nombre'],$body_html);
			$body_html = str_replace('CAMPO_ITEMS',$itemRenglon,$body_html);
			//$body_html = str_replace('CAMPO_ENVIO',$envio_costo,$body_html);
			$body_html = str_replace('CAMPO_IMPUESTO',$impuesto,$body_html);
			$body_html = str_replace('ROW_ENVIO',$rowEnvio,$body_html);
			$body_html = str_replace('ROW_DESCUENTO',$rowDescuento,$body_html);
			$body_html = str_replace('ROW_IMPUESTO',$rowImpuesto,$body_html);
			$body_html = str_replace('CAMPO_TEXTO_TOTAL',$textoTotal,$body_html);
			$body_html = str_replace('CAMPO_TOTAL',$total,$body_html);
			$body_html = str_replace('CAMPO_DIAS',$campoDias,$body_html);
			$body_html = str_replace('CAMPO_NUMEROPEDIDO',$this->numeroPedido,$body_html);
			$body_html = str_replace('TABLA_COMPRADOR',$tablaComprador,$body_html); 
			$this->emal_body_html = $body_html;	
			//echo $body_html; die();
			return $body_html;
	}

	/**
	 * Prepares the document.
	 *
	 * @return  void
	 */
	protected function _prepareDocument()
	{
		$app     = JFactory::getApplication();
		$menus   = $app->getMenu();
		$pathway = $app->getPathway();
		$title   = null;
		/**
		 * Because the application sets a default page title,
		 * we need to get it from the menu item itself
		 */
		$menu = $menus->getActive();
	}
}
