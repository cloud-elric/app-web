<?php
class PaymentsController extends Controller {
	/**
	 *
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 *      using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';
	const DEBUG_PAYMENT = true;
	
	/**
	 * Generar codigo para poder pagar en las tiendas
	 */
	public function actionOPCodeBar($description = null, $orderId = null, $amount) {
		$this->layout = false;
		
		// Pruebas 
		// $openpay = Openpay::getInstance('mgvepau0yawr74pc5p5x','pk_a4208044e7e4429090c369eae2f2efb3');
		//$openpay = Openpay::getInstance ( 'mgvepau0yawr74pc5p5x', 'sk_b1885d10781b4a05838869f02c211d48' );
		
		// Para producción usar el que empieza con pk_ para pruebas el sk y
		// para producción hay que cambiar el valor de la variable $sandboxMode a false en el archivo OpenpayApi.php
		$openpay = Openpay::getInstance ( 'mxmzxkxphmwhz8hnbzu8', 'sk_a9c337fd308f4838854f422c802f4645' );
		
		$custom = array (
				"name" => "-",
				"email" => "correo@dominio.com" 
		);
		
		$chargeData = array (
				'method' => 'store',
				'amount' => $amount,
				'description' => $description,
				'customer' => $custom,
				'order_id' => $orderId 
		);
		
		$charge = $openpay->charges->create ( $chargeData );
		
		$this->render ( "//openpay/recibo", array (
				"charge" => $charge 
		) );
		
		
	}
	
	/**
	 * Open pay hara el registro del pago en este action
	 */
	public function actionOPWebHook() {
		$entityBody = file_get_contents ( 'php://input' );
		$json = json_decode ( $entityBody, true );
		
		// valida que el tipo sea el adecuado
		
		$this->logOpenPay ( "------------- RECEPCION DE WEBHOOK ------------------- " );
		$this->logOpenPay ( "type " . $json ['type'] );
		$this->logOpenPay ( "event_date " . $json ['event_date'] );
		
		switch ($json ['type']) {
			case "verification" :
// 				error_log('verification_code ' . $json['verification_code']. "\n\r", 3,LOG_FILE_PAYMENT_OP);
// 				error_log('id ' . $json['id'] . "\n\r", 3,LOG_FILE_PAYMENT_OP);
				$this->logOpenPay ( "Codigo de verificacion:" . $json ["verification_code"] );
				 $this->logOpenPay ( "Id de peticion:".$json["id"] );
				break;
			
			case "charge.succeeded" :
				$this->processPaymentOP ( $json, $entityBody );
				break;
		}
	}
	
	/**
	 * Guarda registro del pago
	 *
	 * @param unknown $json        	
	 * @param unknown $data        	
	 */
	private function processPaymentOP($json, $data) {
		$transaction = $json ['transaction'];
		
		$txn_id = $transaction ['id'];
		$payment_amount = $transaction ['amount'];
		$payment_currency = "NOT DEFINED";
		$payment_status = $transaction ['status'];
		$quantity = 1;
		$mc_gross = $transaction ['amount'];
		$order_id = $transaction ['order_id'];
		
		// Verifica que no este pagada la orden de compra
		$ordenCompra = PayOrdenesCompras::model ()->find ( array (
				"condition" => "txt_order_number=:order AND b_pagado=0",
				"params" => array (
						":order" => $order_id 
				) 
		) );
		
		if (empty ( $ordenCompra )) {
			$this->logOpenPay ( "El order ID no existe o ya esta marcado como completo :" . $order_id );
			// @todo Hacer algo con el pago no encontrado en la BD
			return;
		}
		
		// Carga la orden
		$item_number = $ordenCompra->txt_order_number;
		$custom = $ordenCompra->id_usuario;
		$item_name = $ordenCompra->txt_description;
		
		$this->logOpenPay ( "------------- PAGO RECIBIDO de transacción :$txn_id -----------\n\r" );
		
		// Solo genera el log cambiar al de yii
		if (self::DEBUG_PAYMENT) {
			
			$this->logOpenPay ( "Item name:" . $item_name . "\n\r" . "Item number :" . $item_number . "\n\r" . "quantity :" . $quantity . "\n\r" . "Payment Status :" . $payment_status . "\n\r" . "Payment amount :" . $payment_amount . "\n\r" . "Txn Id :" . $txn_id . "\n\r" . "custom :" . $custom . "\n\r" . "mc gross :" . $mc_gross . "\n\r" );
		}
		
		// VALIDA QUE LA TRANSACCION NO SE ENCUIENTRE REGISTRADA EN LA BASE DE DATOS PREVIAMENTE
		$pagoRecibed = PayPaymentsRecibed::model ()->find ( array (
				"condition" => "txt_transaccion=:transaccion",
				"params" => array (
						":transaccion" => $txn_id 
				) 
		) );
		if (! empty ( $pagoRecibed )) {
			$this->logOpenPay ( "TRANSACCION REPETIDA: $txn_id \n\r" );
			return;
		}
		
		// Verifica el precio vs el producto
		if (( double ) $ordenCompra->num_total != ( double ) $mc_gross) {
			$this->logOpenPay ( "PRODUCTO Y MONTO INCORRECTO: id_product=$item_number AND num_price=$mc_gross\n\r" );
			return;
		}
		
		// Verifica que la cantidad de productos adquiridos sean 1
		if ($quantity != 1) {
			$this->logOpenPay ( "CANTIDAD DE PRODUCTOS INCORRECTO: quantity=$quantity\n\r" );
		}
		
		$pagoRecibido = new PayPaymentsRecibed ();
		$pagoRecibido->id_usuario = $ordenCompra->id_usuario;
		$pagoRecibido->id_tipo_pago = $ordenCompra->id_payment_type;
		$pagoRecibido->txt_transaccion_local = 'Local';
		$pagoRecibido->txt_notas = 'Notas';
		$pagoRecibido->txt_estatus = $payment_status;
		$pagoRecibido->txt_transaccion = $txn_id;
		$pagoRecibido->txt_cadena_comprador = $data;
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
						$this->logOpenPay ( "Error al guardar orden de compra " . print_r ( $ordenCompra->getErrors () ) );
					}
				} else {
					$error = true;
					$this->logOpenPay ( "Error al guardar inscripcion " . print_r ( $inscribirConcurso->getErrors () ) );
				}
			} else {
				$error = true;
				$this->logOpenPay ( "Error al guardar el pago " . print_r ( $pagoRecibido->getErrors () ) );
			}
			if ($error) {
				$transaction->rollback ();
				return;
			} else {
				$transaction->commit ();
			}
		} catch ( ErrorException $e ) {
			$this->logOpenPay ( "Ocurrio un problema al guardar la información=print_r($e)\n\r" );
			$transaction->rollback ();
		}
		
		$this->logOpenPay ( "------------------- PAGO CORRECTO ---------------------\n\r" );
	}
	
	/**
	 * Creacion de log
	 *
	 * @param unknown $message        	
	 */
	private function logOpenPay($message) {
		Yii::log ( "\n\r " . $message . PHP_EOL, "info", 'openpay' );
	}
	
	/**
	 * Guarda la orden de compra
	 */
	public function actionSaveOrdenCompra() {
		$this->layout = false;
		// Obtiene datos de sesión
		$idConcurso = Yii::app ()->user->concurso;
		$idUsuario = Yii::app ()->user->concursante->id_usuario;
		
		// Buscamos el concurso y mandamos error en caso de no encontrarlo
		$concurso = ConContests::model ()->findByPK ( $idConcurso );
		if (empty ( $concurso )) {
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		
		// Forma de pago
		$formaPago = isset ( $_POST ["tipoPago"] ) ? $_POST ["tipoPago"] : 0;
		$formaPago = PayCatPaymentsTypes::model()->find ( array (
				"condition" => "txt_payment_type_number=:formaPago",
				"params" => array (
						":formaPago" => $formaPago 
				) 
		) );
		if (empty($formaPago)) {
			throw new CHttpException ( 400, 'Datos requeridos.' );
		}
		
		// Contadores de productos
		$productosCont = 0;
		$subProductosCont = 0;
		$total = 0;
		$subTotal = 0;
		$productName = '';
		$totalFotos = 0;
		// Recorremos lo que se envio por post
		foreach ( $_POST as $key => $value ) {
			
			// Revisamos los productos
			if ($key == "producto") {
				$producto = ConProducts::getProductoByToken ( $value );
				if (empty ( $producto )) {
					throw new CHttpException ( 404, 'The requested page does not exist.' );
				}
				$total += $producto->num_price;
				$productName .= $producto->txt_name . " ";
				$productosCont ++;
				$totalFotos += $producto->num_photos;
			}
			
			// Revisa los subproductos
			if ($key == "subProducto") {
				$subProducto = ConProducts::getProductoByToken ( $value );
				if (empty ( $subProducto )) {
					throw new CHttpException ( 404, 'The requested page does not exist.' );
				}
				$total += $subProducto->num_price;
				$productName .= $subProducto->txt_name . " ";
				$subProductosCont ++;
				$totalFotos += $subProducto->num_photos;
			}
			
		}
		
		// Crea objeto y asigna valores para guardar la orden de compra
		$ordenCompra = new PayOrdenesCompras ();
		$ordenCompra->txt_order_number = "oc_" . md5 ( uniqid ( "oc_" ) ) . uniqid ();
		$ordenCompra->id_usuario = $idUsuario;
		$ordenCompra->id_contest = $idConcurso;
		$ordenCompra->id_cliente = $concurso->id_cliente;
		$ordenCompra->id_payment_type = $formaPago->id_payment_type;
		$ordenCompra->fch_creacion = date ( 'Y-m-d H:i:s' );
		$ordenCompra->b_pagado = 0;
		$ordenCompra->num_sub_total = $subTotal;
		$ordenCompra->num_products = $productosCont;
		$ordenCompra->num_addons = $subProductosCont;
		$ordenCompra->num_total = $total;
		$ordenCompra->b_habilitado = 1;
		$ordenCompra->txt_description = $productName;
		$ordenCompra->num_fotos_permitidas = $totalFotos;
		
		if ($ordenCompra->save ()) {
			
			// Busca la configuracion para el tipo de pago
			$configuracionPagos = ConRelContestPayments::model ()->find ( array (
					"condition" => "id_contest=:idConcurso AND id_tipo_pago=:idTipoPago",
					"params" => array (
							":idConcurso" => $idConcurso,
							":idTipoPago" => $formaPago->id_payment_type 
					) 
			) );
			
			// Obtiene los terminos y condiciones del concurso
			$terminosCondiciones = ConTerminosCondiciones::model ()->find ( array (
					"condition" => "id_contest=:idContest AND b_Actual=1",
			
					"params" => array (
							":idContest" => $idConcurso
					)
			)
			);
			
			$this->guardarTerminos($idConcurso, $idUsuario, $terminosCondiciones->id_terminos_condiciones);
			
			//Yii::app()->request->getUserHostAddress
			
			// Si el pago se hara por paypal
			if ($ordenCompra->id_payment_type == 1) {
				// Render del formulario para paypal
				$this->renderPartial ( "//paypal/_form", array (
						"idForm" => "formPayPal",
						"cmd" => "_xclick",
						"return" => Yii::app ()->params ["returnUrl"],
						"custom" => Yii::app ()->user->concursante->id_usuario,
						"notify_url" => Yii::app ()->params ["notifyUrl"],
						"lc" => "US",
						// "business" => "beto@2gom.com.mx",
						"business" => $configuracionPagos->txt_config_1,
						"item_name" => $productName,
						"item_number" => $ordenCompra->txt_order_number,
						"amount" => $ordenCompra->num_total,
						"currency_code" => $configuracionPagos->txt_config_2 
				) );
			} else if ($ordenCompra->id_payment_type == 2) {
				
				// Imprime el barcode de open pay
				$this->redirect ( array (
						"oPCodeBar",
						"description" => $productName,
						
						"orderId" => $ordenCompra->txt_order_number,
						"amount" => $ordenCompra->num_total 
				) );
			}
		} else {
			print_r ( $ordenCompra->getaErrors () );
		}
	}
	
	/**
	 * Guarda los terminos y condiciones del usuario
	 * @param unknown $idConcurso
	 * @param unknown $idUsuario
	 */
	private function guardarTerminos($idConcurso, $idUsuario, $idTerminos){
		
		//$relUsrTerminos  = ConRelUsersTerminos::model()->find(array("condition"=>"id_usuario=:"));
		
		$relUsrTerminos = new ConRelUsersTerminos();
		$relUsrTerminos->id_termino = $idTerminos;
		$relUsrTerminos->id_usuario = $idUsuario;
		$relUsrTerminos->txt_ip = Yii::app()->request->getUserHostAddress();
		
		
			
		//$relUsrTerminos->save();
		
	}
	
}