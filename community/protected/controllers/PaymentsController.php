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

	public function actionOPCodeBar($description = null, $orderId = null, $amount, $idToken) {

		$this->layout = false;

		$openPayCharge = new PayOpenPayCharge();

		$openPayCharge->txt_token_charge = "opes_" . md5 ( uniqid ( "opes_" ) ) . uniqid ();

		$openPayCharge->id_orden_compra = $orderId;

		$openPayCharge->save();

		// Pruebas

		 //$openpay = Openpay::getInstance('mgvepau0yawr74pc5p5x','pk_a4208044e7e4429090c369eae2f2efb3');

		 $openpay = Openpay::getInstance ( 'mgvepau0yawr74pc5p5x', 'sk_b1885d10781b4a05838869f02c211d48' );

		 // Produccion

		 //$openpay = Openpay::getInstance ( 'mxmzxkxphmwhz8hnbzu8', 'sk_a9c337fd308f4838854f422c802f4645' );

		

		// Para producción usar el que empieza con pk_ para pruebas el sk y

		// para producción hay que cambiar el valor de la variable $sandboxMode a false en el archivo OpenpayApi.php

		//$openpay = Openpay::getInstance ( 'mxmzxkxphmwhz8hnbzu8', 'sk_a9c337fd308f4838854f422c802f4645' );

		

		$custom = array (

				"name" => "-",

				"email" => "correo@dominio.com" 

		);

		

		$chargeData = array (

				'method' => 'store',

				'amount' => $amount,

				'description' => $description,

				'customer' => $custom,

				'order_id' => $openPayCharge->txt_token_charge 

		);

		

		$charge = $openpay->charges->create ( $chargeData );

		

		

		

		$this->render ( "//openpay/recibo", array (

				"charge" => $charge,

				"idToken" => $idToken

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

				// error_log('verification_code ' . $json['verification_code']. "\n\r", 3,LOG_FILE_PAYMENT_OP);

				// error_log('id ' . $json['id'] . "\n\r", 3,LOG_FILE_PAYMENT_OP);

				$this->logOpenPay ( "Codigo de verificacion:" . $json ["verification_code"] );

				$this->logOpenPay ( "Id de peticion:" . $json ["id"] );

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

		

		$charge = PayOpenPayCharge::model()->find(array (

				"condition" => "txt_token_charge=:order",

				"params" => array (

						":order" => $order_id 

				) 

		) );

		

		if(empty($charge)){

			$this->logOpenPay ( "El order ID no existe o ya esta marcado como completo :" . $order_id );

			return;

		}

		

		// Verifica que no este pagada la orden de compra

		$ordenCompra = PayOrdenesCompras::model ()->find ( array (

				"condition" => "id_orden_compra=:order AND b_pagado=0",

				"params" => array (

						":order" => $charge->id_orden_compra 

				) 

		) );

		

		if (empty ( $ordenCompra )) {

			$this->logOpenPay ( "La orden de compra no existe o ya esta marcado como completo :" . $order_id );

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

		$pagoRecibido->id_tipo_pago = 2;

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

						$data= [];

						$data["ordenCompra"] = $ordenCompra;

						$data["usuario"] = $usuario;

						$data["concurso"] = $concurso;

						$data["transaccion"]=$pagoRecibido->txt_transaccion;

						$this->sendEmail ( "Pago completado", $view, $data, $usuario );

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

	 * Creacion de log

	 *

	 * @param unknown $message        	

	 */

	private function logOpenPay($message) {

		Yii::log ( "\n\r " . $message . PHP_EOL, "info", 'openpay' );

	}

	private function logFreePay($message) {

		Yii::log ( "\n\r " . $message . PHP_EOL, "info", 'free' );

	}

	

	/**

	 * Guarda la orden de compra

	 */

	public function actionSaveOrdenCompra($idToken) {

		$this->layout = false;

		// Obtiene datos de sesión

		//$idConcurso = Yii::app ()->user->concurso;

		$conc = ConContests::model()->find(array(

				'condition' => "txt_token=:idToken",

				'params' => array(

						':idToken' => $idToken

				)

		));

		$idConcurso = $conc->id_contest;

		$idUsuario = Yii::app ()->user->concursante->id_usuario;

		

		// Buscamos el concurso y mandamos error en caso de no encontrarlo

		$concurso = ConContests::model ()->findByPK ( $idConcurso );

		if (empty ( $concurso )) {

			throw new CHttpException ( 404, 'The requested page does not exist.' );

		}

		

		// Contadores de productos

		$productosCont = 0;

		$subProductosCont = 0;

		$total = 0;

		$subTotal = 0;

		$productName = '';

		$totalFotos = 0;

		// Recorremos lo que se envio por post

		//foreach ( $_POST as $key => $value ) {

			// Revisamos los productos

			if (isset($_POST['producto'])) {

				$producto = ConProducts::getProductoByToken ( $_POST['producto'] );

				if (empty ( $producto )) {

					throw new CHttpException ( 404, 'The requested page does not exist.' );

				}

				

				$total += floatval($producto->num_price);

				$productName .= $producto->txt_name . " ";

				$productosCont ++;

				$totalFotos += $producto->num_photos;

			}

			

			

			// Revisa los subproductos

			if (isset($_POST['subProducto'])) {

				

				$subProducto = ConProducts::getProductoByToken ( $_POST['subProducto']);

				if (empty ( $subProducto )) {

					throw new CHttpException ( 404, 'The requested page does not exist.' );

				}

				

				$total += floatval($subProducto->num_price);

				$productName .= $subProducto->txt_name . " ";

				$subProductosCont ++;

				$totalFotos += $subProducto->num_photos;

			}

		//}

		

		// $ordenCompra = PayOrdenesCompras::model ()->find ( array (

		// 'condition' => 'id_contest=:idContest AND id_usuario=:idUsuario',

		// 'params' => array (

		// ':idContest' => $idConcurso,

		// ':idUsuario' => $idUsuario

		// )

		// ) );

		

		// if (empty ( $ordenCompra )) {

		$ordenCompra = new PayOrdenesCompras ();

		// }

		

		// Crea objeto y asigna valores para guardar la orden de compra

		floatval($total);

		$ordenCompra->txt_order_number = "oc_" . md5 ( uniqid ( "oc_" ) ) . uniqid ();

		$ordenCompra->id_usuario = $idUsuario;

		$ordenCompra->id_contest = $idConcurso;

		$ordenCompra->id_cliente = $concurso->id_cliente;

		$ordenCompra->id_payment_type = null;

		$ordenCompra->fch_creacion = date ( 'Y-m-d H:i:s' );

		$ordenCompra->b_pagado = 0;

		$ordenCompra->num_sub_total = $subTotal;

		$ordenCompra->num_products = $productosCont;

		$ordenCompra->num_addons = $subProductosCont;

		

		$ordenCompra->num_sub_total =$total;

		

		$tax = $total * (0.16);

		

		$ordenCompra->num_total =$total + $tax;

		

		$ordenCompra->b_habilitado = 1;

		$ordenCompra->txt_description = $productName;

		$ordenCompra->num_fotos_permitidas = $totalFotos;

		

		if ($ordenCompra->save ()) {

			

			// Busca la configuracion para el tipo de pago

			// $configuracionPagos = ConRelContestPayments::model ()->find ( array (

			// "condition" => "id_contest=:idConcurso AND id_tipo_pago=:idTipoPago",

			// "params" => array (

			// ":idConcurso" => $idConcurso,

			// ":idTipoPago" => $formaPago->id_payment_type

			// )

			// ) );

			

			// Obtiene los terminos y condiciones del concurso

			$terminosCondiciones = ConTerminosCondiciones::model ()->find ( array (

					"condition" => "id_contest=:idContest AND b_Actual=1",

					

					"params" => array (

							":idContest" => $idConcurso 

					) 

			) );

			

			$this->guardarTerminos ( $idConcurso, $idUsuario, $terminosCondiciones->id_terminos_condiciones );

			

			$this->redirect ( array (

					'usrUsuarios/checkOut',

					't' => $ordenCompra->txt_order_number,

					'idToken' => $concurso->txt_token

			) );

			

			// Yii::app()->request->getUserHostAddress

			

			// Si el pago se hara por paypal

			// if ($ordenCompra->id_payment_type == 1) {

			// // Render del formulario para paypal

			// $this->renderPartial ( "//paypal/_form", array (

			// "idForm" => "formPayPal",

			// "cmd" => "_xclick",

			// "return" => Yii::app ()->params ["returnUrl"],

			// "custom" => Yii::app ()->user->concursante->id_usuario,

			// "notify_url" => Yii::app ()->params ["notifyUrl"],

			// "lc" => "US",

			// // "business" => "beto@2gom.com.mx",

			// "business" => $configuracionPagos->txt_config_1,

			// "item_name" => $productName,

			// "item_number" => $ordenCompra->txt_order_number,

			// "amount" => $ordenCompra->num_total,

			// "currency_code" => $configuracionPagos->txt_config_2

			// ) );

			// } else if ($ordenCompra->id_payment_type == 2) {

			

			// // Imprime el barcode de open pay

			// $this->redirect ( array (

			// "oPCodeBar",

			// "description" => $productName,

			

			// "orderId" => $ordenCompra->txt_order_number,

			// "amount" => $ordenCompra->num_total

			// ) );

			// }

		} else {

			print_r ( $ordenCompra->getErrors () );

		}

	}

	

	/**

	 * Actualiza la orden de compra

	 *

	 * @param string $t        	

	 * @throws CHttpException

	 */

	public function actionUpdateOrdenCompra($t = null, $idToken, $creditCard=null) {

		

		$this->layout = false;

		// Obtiene datos de sesión

		

		$conc = ConContests::model()->find(array(

				'condition' => "txt_token=:idToken",

				'params' => array(

						':idToken' => $idToken

				)

		));

		

		$idConcurso = $conc->id_contest;

		$idUsuario = Yii::app ()->user->concursante->id_usuario;

		

		$oc = PayOrdenesCompras::getOrdenCompraByToken ( $t, $idConcurso );

		

		if (empty($oc)) {

			

			$this->redirect ( 'concurso' );

			return;

			throw new CHttpException ( 404, 'The requested page does not exist.' );

		}

		

		

		if ($oc->num_total == 0) {

			

			$this->redirect ( array ('payments/savePagoRecibido', 

					't'=>$oc->txt_order_number,

					'idToken' => $conc->txt_token

			) );

			

		}

		

		

		if ($_POST ['tipoPago']) {

			

			$iFP = $_POST ['tipoPago'];

			

			$formaPago = PayCatPaymentsTypes::model ()->find ( array (

					'condition' => 'txt_payment_type_number=:iFP',

					'params' => array (

							':iFP' => $iFP 

					) 

			) );

			

			$oc->id_payment_type = $formaPago->id_payment_type;

			

			if($formaPago->id_payment_type==2){

					$oc->txt_order_open_pay = "opc_" . md5 ( uniqid ( "opc_" ) ) . uniqid ();

			}else{

				$oc->txt_order_open_pay = null;

			}

			$oc->save ();

			

			// Busca la configuracion para el tipo de pago

			$configuracionPagos = ConRelContestPayments::model ()->find ( array (

					"condition" => "id_contest=:idConcurso AND id_tipo_pago=:idTipoPago",

					"params" => array (

							":idConcurso" => $idConcurso,

							":idTipoPago" => $formaPago->id_payment_type 

					) 

			) );

			

			// Si el pago se hara por paypal

			if ($oc->id_payment_type == 1) {

				// Render del formulario para paypal

				$this->renderPartial ( "//paypal/_form", array (

						"idForm" => "formPayPal",

						"cmd" => "_xclick",

						"return" => Yii::app ()->params ["returnUrl"],

						"custom" => Yii::app ()->user->concursante->id_usuario,

						"notify_url" => Yii::app ()->params ["notifyUrl"],

						"lc" => "US",

						'contest'=>$conc->txt_token,

						// "business" => "beto@2gom.com.mx",

						"business" => $configuracionPagos->txt_config_1,

						"item_name" => '5044-002-'.$oc->txt_description,

						"item_number" => $oc->txt_order_number,

						"amount" => $oc->num_total,

						"currency_code" => $configuracionPagos->txt_config_2 

				) );

			} else if ($oc->id_payment_type == 2) {

				

				if($creditCard){

					

					$openPayCharge = new PayOpenPayCharge();

					

					$openPayCharge->txt_token_charge = "opes_" . md5 ( uniqid ( "opes_" ) ) . uniqid ();

					$openPayCharge->id_orden_compra = $oc->id_orden_compra;

					$openPayCharge->save();

					

					$this->render ( "//openpay/showCreditCardPayments", array (

							"description" =>  $oc->txt_description,

								

							"orderId" => $openPayCharge->txt_token_charge,

							"amount" => $oc->num_total,

							'concurso'=>$conc->txt_token

					) );

					

					return;

				}

				// Imprime el barcode de open pay

				$this->redirect ( array (

						"oPCodeBar",

						"description" => $oc->txt_description,

						"orderId" => $oc->id_orden_compra,

						"amount" => $oc->num_total,

						"idToken" => $idToken,

				) );

			}

		} else { // Pago gratis

		}

	}

	

	/**

	 * Genera el pago para el cliente

	 */

	public function actionSavePagoRecibido($t = null, $idToken) {

		//$idConcurso = Yii::app ()->user->concurso;

		$conc = ConContests::model()->find(array(

				'condition' => "txt_token=:idToken",

				'params' => array(

						':idToken' => $idToken

				)

		));

		$idConcurso = $conc->id_contest;

		$idUsuario = Yii::app ()->user->concursante->id_usuario;

		

		$oc = PayOrdenesCompras::getOrdenCompraByToken ( $t, $idConcurso );

		

		if (empty ( $oc ) || $oc->num_total > 0) {

			$this->redirect ( array('usrUsuarios/concurso?idToken='.$idToken));

			return;

			throw new CHttpException ( 404, 'The requested page does not exist.' );

		}

		

		if($this->generatePagoRecibido ( $oc, $idUsuario, $idConcurso )){

			

			

		}else{

			

		}

		

		$this->redirect ( array('usrUsuarios/concurso?idToken='.$idToken));

		return;

	}

	

	/**

	 * Genera el pago en la base de datos

	 * 

	 * @param PayOrdenesCompras $ordenCompra        	

	 */

	private function generatePagoRecibido($ordenCompra, $idUsuario, $idConcurso) {

		if ($ordenCompra->id_usuario != $idUsuario) {

			

			return false;

		}

		

		if ($ordenCompra->id_contest != $idConcurso) {

			

			return false;

		}

		

		

		

		$pagoRecibido = new PayPaymentsRecibed ();

		$pagoRecibido->id_usuario = $idUsuario;

		$pagoRecibido->id_tipo_pago = 3;

		$pagoRecibido->txt_transaccion_local = 'Local';

		$pagoRecibido->txt_notas = 'Pago gratuito';

		$pagoRecibido->txt_estatus = 'Completed';

		$pagoRecibido->txt_transaccion = $ordenCompra->txt_order_number;

		$pagoRecibido->txt_cadena_comprador = $ordenCompra->txt_order_number;

		$pagoRecibido->txt_monto_pago = 0;

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

						$this->logFreePay ( "Error al guardar orden de compra " . print_r ( $ordenCompra->getErrors () ) );

					}

					

					$cupon = PayCupons::model()->find(array('condition'=>'id_cupon=:cupon', 'params'=>array(':cupon'=>$ordenCompra->id_cupon)));

					if($cupon){

						$cupon->num_cupones = $cupon->num_cupones - 1;

						if(!$cupon->save()){

							$error = true;

							$this->logFreePay ( "Error al guardar orden de compra " . print_r ( $cupon->getErrors () ) );

						}

					}

					

				} else {

					$error = true;

					$this->logFreePay ( "Error al guardar inscripcion " . print_r ( $inscribirConcurso->getErrors () ) );

				}

			} else {

				$error = true;

				$this->logFreePay ( "Error al guardar el pago " . print_r ( $pagoRecibido->getErrors () ) );

			}

			if ($error) {

				$transaction->rollback ();

				return;

			} else {

				$transaction->commit ();

				

				return true;

			}

		} catch ( ErrorException $e ) {

			$this->logFreePay ( "Ocurrio un problema al guardar la información=print_r($e)\n\r" );

			$transaction->rollback ();

		}

		

		return false;

	}

	

	/**

	 * Guarda los terminos y condiciones del usuario

	 *

	 * @param unknown $idConcurso        	

	 * @param unknown $idUsuario        	

	 */

	private function guardarTerminos($idConcurso, $idUsuario, $idTerminos) {

		

		// $relUsrTerminos = ConRelUsersTerminos::model()->find(array("condition"=>"id_usuario=:"));

		$relUsrTerminos = new ConRelUsersTerminos ();

		$relUsrTerminos->id_termino = $idTerminos;

		$relUsrTerminos->id_usuario = $idUsuario;

		$relUsrTerminos->txt_ip = Yii::app ()->request->getUserHostAddress ();

		

		// $relUsrTerminos->save();

	}

}