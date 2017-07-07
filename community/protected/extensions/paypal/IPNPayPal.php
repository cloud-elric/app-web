<?php
class IPNPayPal {
	const DEBUG = 1;
	const USE_SANDBOX = 1;
	
	/**
	 * IPN para paypal
	 */
	public function payPalIPN() {
		$save_post = array ();
		
		// Read POST data
		// reading posted data directly from $_POST causes serialization
		// issues with array data in POST. Reading raw POST data from input stream instead.
		$raw_post_data = file_get_contents ( 'php://input' );
		$raw_post_array = explode ( '&', $raw_post_data );
		$myPost = array ();
		foreach ( $raw_post_array as $keyval ) {
			$keyval = explode ( '=', $keyval );
			
			Yii::log ( "\n\r Can't connect to PayPal to validate IPN message: " . print_r($keyval) , "debug", 'paypal' );
			
			if (count ( $keyval ) == 2)
				$myPost [$keyval [0]] = urldecode ( $keyval [1] );
				
				// Copia el post para futuro uso
			$save_post [$keyval [0]] = urldecode ( $keyval [1] );
		}
		
		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		if (function_exists ( 'get_magic_quotes_gpc' )) {
			$get_magic_quotes_exists = true;
		}
		
		foreach ( $myPost as $key => $value ) {
			if ($get_magic_quotes_exists == true && get_magic_quotes_gpc () == 1) {
				$value = urlencode ( stripslashes ( $value ) );
			} else {
				$value = urlencode ( $value );
			}
			$req .= "&$key=$value";
		}
		
		// Post IPN data back to PayPal to validate the IPN data is genuine
		// Without this step anyone can fake IPN data
		
		if (self::USE_SANDBOX) {
			$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
		} else {
			$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
		}
		
		$ch = curl_init ( $paypal_url );
		if ($ch == FALSE) {
			return FALSE;
		}
		
		curl_setopt ( $ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $req );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, 1 );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
		curl_setopt ( $ch, CURLOPT_FORBID_REUSE, 1 );
		
		if (self::DEBUG == true) {
			curl_setopt ( $ch, CURLOPT_HEADER, 1 );
			curl_setopt ( $ch, CURLINFO_HEADER_OUT, 1 );
		}
		
		// CONFIG: Optional proxy configuration
		// curl_setopt($ch, CURLOPT_PROXY, $proxy);
		// curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
		
		// Set TCP timeout to 30 seconds
		curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 30 );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
				'Connection: Close' 
		) );
		
		// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
		// of the certificate as shown below. Ensure the file is readable by the webserver.
		// This is mandatory for some environments.
		
		// $cert = __DIR__ . "./cacert.pem";
		// curl_setopt($ch, CURLOPT_CAINFO, $cert);
		
		$res = curl_exec ( $ch );
		if (curl_errno ( $ch ) != 0) // cURL error
{
			if (self::DEBUG == true) {
				Yii::log ( "\n\r Can't connect to PayPal to validate IPN message: " . curl_error ( $ch ), "debug", 'paypal' );
			}
			curl_close ( $ch );
			exit ();
		} else {
			// Log the entire HTTP response if debug is switched on.
			if (self::DEBUG == true) {
				Yii::log ( "\n\r HTTP request of validation request:" . curl_getinfo ( $ch, CURLINFO_HEADER_OUT ) . " for IPN payload: $req", "debug", 'paypal' );
				Yii::log ( "\n\r HTTP response of validation request: $res" , "debug", 'paypal' );
			}
			curl_close ( $ch );
		}
		
		// Inspect IPN validation result and act accordingly
		
		// Split response headers and payload, a better way for strcmp
		$tokens = explode ( "\r\n\r\n", trim ( $res ) );
		$res = trim ( end ( $tokens ) );
		
		if (strcmp ( $res, "VERIFIED" ) == 0) {
			// check whether the payment_status is Completed
			// check that txn_id has not been previously processed
			// check that receiver_email is your PayPal email
			// check that payment_amount/payment_currency are correct
			// process payment and mark item as paid.
			
			if (self::DEBUG == true) {
				Yii::log ( "\n\r Verified IPN: $req ", "debug", 'paypal' );
			}
			
			Yii::log ( "\n\r A procesar el pago y guardar.", "debug", 'paypal' );
			$this->processPayment ( $save_post, $req );
		} else if (strcmp ( $res, "INVALID" ) == 0) {
			// log for manual investigation
			// Add business logic here which deals with invalid IPN messages
			if (self::DEBUG == true) {
				Yii::log ( "\n\r Invalid IPN: $req" , "debug", 'paypal' );
			}
		}
	}
	
	/**
	 * Procesa la respuesta de paypal
	 * 
	 * @param unknown $_req        	
	 * @param unknown $req        	
	 */
	public function processPayment($_req, $req) {
		$item_name = $_req ['item_name'];
		$item_number = $_req ['item_number'];
		$quantity = $_req ['quantity'];
		$payer_email = $_req ['payer_email'];
		$payment_status = $_req ['payment_status'];
		$payment_amount = $_req ['mc_gross'];
		$payment_currency = $_req ['mc_currency'];
		$txn_id = $_req ['txn_id'];
		$receiver_email = $_req ['receiver_email'];
		$payer_email = $_req ['payer_email'];
		$custom = $_req ['custom'];
		$mc_gross = $_req ['mc_gross'];
		$verify_sign = $_req ['verify_sign'];
		$txt_cadena_pago = $req;
		
		Yii::log ( "\n\r------------- PAGO RECIBIDO de $payer_email transacción :$txn_id -----------", "pago", 'paypal' );
		
		if (self::DEBUG == true) {
			
			Yii::log ( "\n\r Item name:" . $item_name, "debug", 'paypal' );
			Yii::log ( "\n\r Item number :" . $item_number, "debug", 'paypal' );
			Yii::log ( "\n\r quantity :" . $quantity, "debug", 'paypal' );
			Yii::log ( "\n\r Payment Status :" . $payment_status, "debug", 'paypal' );
			Yii::log ( "\n\r Payment amount :" . $payment_amount, "debug", 'paypal' );
			Yii::log ( "\n\r Txn Id :" . $txn_id, "debug", 'paypal' );
			Yii::log ( "\n\r receiver email :" . $receiver_email, "debug", 'paypal' );
			Yii::log ( "\n\r custom :" . $custom, "debug", 'paypal' );
			Yii::log ( "\n\r mc gross :" . $mc_gross, "debug", 'paypal' );
			Yii::log ( "\n\r verify_sign :" . $verify_sign, "debug", 'paypal' );
		}
		
		// Verifica que no este pagada la orden de compra
		$ordenCompra = PayOrdenesCompras::model ()->find ( array (
				"condition" => "txt_order_number=:order AND b_pagado=0",
				"params" => array (
						":order" => $item_number 
				) 
		) );
		if (empty ( $ordenCompra )) {
			Yii::log ( "\n\r No existe orden de compra: $item_number ", "errors", 'paypal' );
			return;
		}
		
		$existeTransaccion = $this->existeTransaccion ( $txn_id );
		if ($existeTransaccion) {
			Yii::log ( "\n\r TRANSACCION REPETIDA: $txn_id ", "errors", 'paypal' );
			return;
		}
		
		$isPriceEqual = $this->isPriceEqual ( $ordenCompra, $mc_gross );
		// Verifica el precio vs el producto
		if (! $isPriceEqual) {
			Yii::log ( "\n\r PRODUCTO Y MONTO INCORRECTO: id_product=".(double)$item_number." AND num_price=".(double)$mc_gross, "errors", 'paypal' );
			return;
		}
		
		// Verifica que la cantidad de productos adquiridos sean 1
		if ($quantity != 1) {
			Yii::log ( "\n\r CANTIDAD DE PRODUCTOS INCORRECTO: quantity=$quantity", "errors", 'paypal' );
			return;
		}
		
		Yii::log ( "\n\r id_usuario " . $custom, "pago", 'paypal' );
		Yii::log ( "\n\r item_number " . $item_number, "pago", 'paypal' );
		Yii::log ( "\n\r mc_gross " . $mc_gross, "pago", 'paypal' );
		Yii::log ( "\n\r txn_id " . $txn_id, "pago", 'paypal' );
		Yii::log ( "\n\r txt_cadena_pago " . $txt_cadena_pago, "pago", 'paypal' );
		Yii::log ( "\n\r verify_sign " . $verify_sign, "pago", 'paypal' );
		
	$pagoRecibido = new PayPaymentsRecibed ();
		$pagoRecibido->id_usuario = $ordenCompra->id_usuario;
		$pagoRecibido->id_tipo_pago = 1;
		$pagoRecibido->txt_transaccion_local = 'Local';
		$pagoRecibido->txt_notas = 'Notas';
		$pagoRecibido->txt_estatus = $payment_status;
		$pagoRecibido->txt_transaccion = $txn_id;
		$pagoRecibido->txt_cadena_comprador = $req;
		$pagoRecibido->txt_monto_pago = $mc_gross;
		$pagoRecibido->id_orden_compra = $ordenCompra->id_orden_compra;
		
		
		$transaction = $pagoRecibido->dbConnection->beginTransaction ();
		$error = false;
		try {
			if ($pagoRecibido->save ()) {
				$inscribirConcurso = new ConRelUsersContest ();
				$inscribirConcurso->id_usuario = $ordenCompra->id_usuario;
				$inscribirConcurso->id_orden_compra = $ordenCompra->id_orden_compra;
				$inscribirConcurso->id_payment_recibed = $pagoRecibido->id_payment_recibed;
				$inscribirConcurso->id_contest = $ordenCompra->id_contest;
				$inscribirConcurso->num_fotos_permitidas = $ordenCompra->num_fotos_permitidas;
				
				if ($inscribirConcurso->save ()) {
					$ordenCompra->b_pagado = 1;
					
					if (! $ordenCompra->save ()) {
						$error = true;
						Yii::log ( "Error al guardar orden de compra " . print_r($ordenCompra->getErrors()), "pago", 'paypal' );
					}else{
						$usuario = UsrUsuarios::model()->find(array(
								'condition' => 'id_usuario=:idUser',
								'params' => array(
										':idUser' => $pagoRecibido->id_usuario
								)
						));
						$concurso = ConContests::model()->find(array(
								'condition' => 'id_contest=:idConcurso',
								'params' => array(
										':idConcurso' => $ordenCompra->id_contest
								)
						));
						// Preparamos los datos para enviar el correo
						$view = "_pagoCompletado";
						$data["ordenCompra"] = $ordenCompra;
						$data["usuario"] = $usuario;
						$data["concurso"] = $concurso;
						$data["transaccion"]=$pagoRecibido->txt_transaccion;
						//$this->sendEmail ( "Pago completado", $view, $data, $usuario );
					}
				} else {
					$error = true;
					Yii::log ( "Error al guardar inscripcion " . print_r($inscribirConcurso->getErrors()), "pago", 'paypal' );
				}
				
				
			}else{
				$error = true;
				Yii::log ("Error al guardar el pago " . print_r($pagoRecibido->getErrors()), "pago", 'paypal' );
				
			}
			if ($error) {
					$transaction->rollback ();
					return;
				} else {
					$transaction->commit ();
				}
			
		} catch ( ErrorException $e ) {
			
			Yii::log ("Ocurrio un problema al guardar la información=print_r($e)\n\r", "pago", 'paypal' );
			$transaction->rollback ();
		}
		
		Yii::log ( "\n\r ------------- FIN DE PAGO de $payer_email transacción :$txn_id -----------", "pago", 'paypal' );
	}
	
	public function sendEmail($asunto, $view, $data, $usuario) {
		$template = $this->generateTemplatePagoCompletado ( $view, $data );
		$sendEmail = new SendEMail ();
		$sendEmail->SendMailPass ( $asunto, $usuario->txt_correo, $usuario->txt_nombre . " " . $usuario->txt_apellido_paterno, $template );
	}
	
	/**
	 * Generamos template con la informacion necesaria
	 */
	public function generateTemplatePagoCompletado($view, $data) {
	
		// Render view and get content
		// Notice the last argument being `true` on render()
		$content = $this->renderPartial ( $view, array (
				'data' => $data
		), true );
	
		return $content;
	}
	
	/**
	 * VALIDA QUE LA TRANSACCION NO SE ENCUIENTRE REGISTRADA EN LA BASE DE DATOS PREVIAMENTE
	 */
	public function existeTransaccion($txn_id) {
		$criteria = new CDbCriteria ();
		$criteria->condition = "txt_transaccion=:txtTransaccion";
		$criteria->params = array (
				":txtTransaccion" => $txn_id 
		);
		$existeTransaccion = PayPaymentsRecibed::model ()->find ( $criteria );
		
		if (empty ( $existeTransaccion )) {
			
			return false;
		}
		return true;
	}
	
	/**
	 * Verifica que el precio enviado por paypal sea igual al del producto
	 */
	public function isPriceEqual($ordenCompra, $mc_gross) {
		
		
		if ((double)$ordenCompra->num_total != (double)$mc_gross) {
			Yii::log ( "\n\r PRODUCTO Y MONTO INCORRECTO: id_product=$ordenCompra->num_total AND num_price=$mc_gross", "errors", 'paypal' );
			return false;
		}
		
		return true;
	}
	
	
}