<?php
class OpenpayController extends Controller {
	
	/**
	 * Generar pago
	 */
	public function actionShowCreditCardPayments() {
		if (isset ( $_POST ["token_id"] ) && $_POST ["orderId"]) {
			
			$charge = PayOpenPayCharge::model()->find(array (
					"condition" => "txt_token_charge=:order",
					"params" => array (
							":order" =>  $_POST ["orderId"] 
					)
			) );
			
			// Verifica que no este pagada la orden de compra
		$ordenCompra = PayOrdenesCompras::model ()->find ( array (
				"condition" => "id_orden_compra=:order AND b_pagado=0",
				"params" => array (
						":order" => $charge->id_orden_compra 
				) 
		) );
			
			
			
			if (empty ( $ordenCompra )) {
				throw new CHttpException ( 400, 'Datos requeridos.' );
			}
			
			try {
				$charge = $this->createChargeCreditCard ( $ordenCompra->txt_description, $charge->txt_token_charge, $ordenCompra->num_total );
				#Yii::app ()->user->setFlash ( 'success', "Pago exitoso ");
				#$this->redirect (array("usrUsuarios/revisarPago"));
				echo "success";
			} catch ( Exception $e ) {
				
				#Yii::app ()->user->setFlash ( 'error', "Ocurrio un problema con su tarjeta: ".$e->getMessage() );
				echo $e->getMessage ();
				$this->logOpenPay ( "Error al guardar orden de compra " .$e  );
				#$this->redirect(array("usrUsuarios/concurso"));
			}
			
			
			exit;
			$this->redirect(array("usrUsuarios/concurso"));
		}
		
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
	 * Cargo
	 * 
	 * @param string $description        	
	 * @param string $orderId        	
	 * @param string $amount        	
	 * @return unknown
	 */
	private function createChargeCreditCard($description = null, $orderId = null, $amount = null) {
		// pruebas
		$openpay = Openpay::getInstance ( 'mgvepau0yawr74pc5p5x', 'sk_b1885d10781b4a05838869f02c211d48' );
		
		// produccion
		//$openpay = Openpay::getInstance ( 'mxmzxkxphmwhz8hnbzu8', 'sk_a9c337fd308f4838854f422c802f4645' );
		
		//$openpay = Openpay::getInstance ( 'muqckh3xbqhszkgapcer', 'sk_e4b7e0e618804517bea2a0fef5e0609e' );
		//$openpay = Openpay::getInstance ( 'mxmzxkxphmwhz8hnbzu8', 'sk_a9c337fd308f4838854f422c802f4645' );
		$usuario = Yii::app()->user->concursante->txt_nombre;
		$correo = Yii::app()->user->concursante->txt_correo;
		$custom = array (
				"name" => $usuario,
				"email" => $correo 
		);
		
		$chargeData = array (
				'method' => 'card',
				'customer' => $custom,
				'source_id' => $_POST ["token_id"],
				'amount' => ( float ) $amount,
				'description' => $description,
				'order_id' => $orderId,
				// 'use_card_points' => $_POST["use_card_points"], // Opcional, si estamos usando puntos
				'device_session_id' => $_POST ["deviceIdHiddenFieldName"] 
		);
		
		$charge = $openpay->charges->create ( $chargeData );
		return $charge;
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
		$formaPago = PayCatPaymentsTypes::model ()->find ( array (
				"condition" => "txt_payment_type_number=:formaPago",
				"params" => array (
						":formaPago" => $formaPago 
				) 
		) );
		if (empty ( $formaPago )) {
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
			) );
			
			$this->guardarTerminos ( $idConcurso, $idUsuario, $terminosCondiciones->id_terminos_condiciones );
			
			// Yii::app()->request->getUserHostAddress
			
			// Imprime el barcode de open pay
			$this->render ( "showCreditCardPayments", array (
					"description" => $productName,
					
					"orderId" => $ordenCompra->txt_order_number,
					"amount" => $ordenCompra->num_total 
			) );
		} else {
			print_r ( $ordenCompra->getaErrors () );
		}
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