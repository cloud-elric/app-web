<?php
class SiteController extends Controller {
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		$this->layout = 'mainError';
		if ($error = Yii::app ()->errorHandler->error) {
			if (Yii::app ()->request->isAjaxRequest)
				echo $error ['message'];
			else
				$this->render ( 'error', $error );
		}
	}
	
	/**
	 * Verifica que el token pertenezca a un concurso
	 *
	 * @param unknown $t        	
	 * @return ConContests
	 */
	private function concursoNoEspecificado($t) {
		
		// Busqueda de concurso en la base de datos
		$concurso = ConContests::buscarPorToken ( $t );
		
		// Si no existe manda un error al usuario
		if (empty ( $concurso )) {
			
			$concurso = new ConContests ();
			// throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		
		return $concurso;
	}
	
	/**
	 * Obtiene el concurso o regresa null
	 *
	 * @param unknown $t        	
	 * @return ConContests
	 */
	private function getConcurso($t) {
		$concurso = null;
		
		if (! empty ( $t )) {
			// Verifica que exista el concurso a partir del token enviado
			$concurso = ConContests::buscarPorToken ( $t );
		}
		
		return $concurso;
	}
	
	/**
	 * Pagina de login para el concurso
	 *
	 * @param string $t        	
	 */
	public function actionLogin($t = null) {
		
		// Obtiene el concurso
		$concurso = $this->getConcurso ( $t );
		
		// Layout que se utilizara
		$this->layout = 'mainLogin';
		
		// Modelo para el login
		$model = new LoginForm ();
		
		// if it is ajax validation request
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'login-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
		
		// Si se envia el formulario
		if (isset ( $_POST ['LoginForm'] )) {
			
			// Asigna los valores enviados por POST hacia el modelo
			$model->attributes = $_POST ['LoginForm'];
			
			// Valida las reglas del modelo y autentifica al usuario
			if ($model->validate () && $model->login ()) {
				
				// Guarda el inicio de sesión en la base de datos
				$this->guardarInicioSesionBaseDatos ( Yii::app ()->user->concursante->id_usuario );
				
				$this->redirectAfterLogin ( $concurso );
			}
		}
		// display the login form
		$this->render ( 'login', array (
				'model' => $model,
				't'=>$t
		) );
	}
	
	/**
	 * Redireccionamiento
	 *
	 * @param unknown $concurso        	
	 */
	private function redirectAfterLogin($concurso) {
		if (empty ( $concurso )) {
			$this->redirect ( array (
					"usrUsuarios/profile" 
			) );
		}
		
		$this->validarStatusConcurso ( $concurso );
	}
	
	/**
	 * Analiza el estatus del concurso y determinar la vista adecuada
	 *
	 * @param ConContests $concurso        	
	 */
	private function validarStatusConcurso(ConContests $concurso) {
		$status = $concurso->id_status;
		$render = null;
		switch ($status) {
			case 1 : // Concurso se ha creado pero no configurado
				$this->layout = 'mainError';
				$this->render ( '//contests/concursoNoIniciado' );
				exit ();
				break;
			case 2 : // Concurso en etapa de inscripción de competidores
				$this->redirect ( array (
						"usrUsuarios/concurso",
						't' => $concurso->txt_token 
				) );
				break;
			case 3 : // Concurso en etapa de calificación por parte de los jueces
				$this->layout = 'mainError';
				$this->render ( '//contests/concursoEnCalificacion' );
				exit ();
				break;
			case 4 : // Concurso en etapa de resolución de conflictos
				$this->layout = 'mainError';
				$this->render ( '//contests/concursoEnConflictos' );
				exit ();
				break;
			case 5 : // Concurso en etapa de desempate por parte de los jueces
				$this->layout = 'mainError';
				$this->render ( '//contests/concursoEnEmpates' );
				exit ();
				break;
			case 6 : // Concurso ha cerrado y existen ganadores
				$this->layout = 'mainError';
				$this->render ( '//contests/concursoFinalizado' );
				exit ();
				break;
		}
	}
	
	/**
	 * Guarda un registro de sesion en la base de datos
	 * y guardamos en sesion el identificador de la sesión para poder actualizar la salida
	 *
	 * @param integer $idUsuario        	
	 */
	public function guardarInicioSesionBaseDatos($idUsuario) {
		$sl = new UsrLogsLogin ();
		
		$s = $sl->guardarInicioSesionDB ( $idUsuario );
		
		Yii::app ()->user->setState ( 'idSesion', $s->id_log );
	}
	
	/**
	 * Actualiza el registro de las sesion como finalizada
	 *
	 * @param integer $idSesion        	
	 */
	public function guardarFinSesionBaseDatos($idSesion) {
		$sl = new UsrLogsLogin ();
		
		$sl->guardarSalidaSesionDB ( $idSesion );
	}
	
	/**
	 * Crea sesion para el usuario
	 *
	 * @param integer $idCompetidor        	
	 * @param integer $idConcurso        	
	 */
	public function crearSesionUsuarioConcurso($idCompetidor, $concurso) {
		$identificacorUnico = $this->crearIdentificadorSesion ( $idCompetidor, $concurso->id_contest );
		$isUsuarioInscrito = ConRelUsersContest::isUsuarioInscrito ( $idCompetidor, $concurso->id_contest );
		
		// Sesión con los datos del concurso
		Yii::app ()->user->setState ( $identificacorUnico, $concurso );
		Yii::app ()->user->setState ( "concurso", $concurso->id_contest );
		Yii::app ()->user->setState ( "competidorInscrito", $isUsuarioInscrito );
	}
	
	/**
	 * Crea un identificador sesion
	 *
	 * @param unknown $idCompetidor        	
	 * @param unknown $idConcurso        	
	 * @return string
	 */
	public function crearIdentificadorSesion($idCompetidor, $idConcurso) {
		return $identificador = md5 ( "sesion-" . $idCompetidor . "-" . $idConcurso );
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		
		// Obtenemos el identificador de la sesion y guardamos la salida
		$idSesion = Yii::app ()->user->getState ( 'idSesion' );
		$this->guardarFinSesionBaseDatos ( $idSesion );
		
		Yii::app ()->user->logout ();
		$this->redirect ( Yii::app ()->homeUrl );
	}
	
	/**
	 * Action Pago
	 */
	public function actionPago() {
		$this->layout = 'mainScroll';
		$this->render ( 'pago' );
	}
	
	/**
	 * Recuperar contraseña mediante un correo electronico
	 */
	public function actionRequestPassword($t = null) {
		$this->layout = 'mainLogin';
		// Verifica que exita el concurso
		$concurso = $this->verificarToken ( $t );
		
		// Iniciamos el modelo
		$model = new LoginForm ();
		
		if (isset ( $_POST ['LoginForm'] )) {
			$model->attributes = $_POST ['LoginForm'];
			
			// Busca el la base de datos por su email
			$usuario = UsrUsuarios::model ()->find ( array (
					"condition" => "txt_correo=:email",
					"params" => array (
							":email" => $model->username 
					) 
			) );
			
			// Si no encuentra el correo electronico mandamos un error
			if (empty ( $usuario )) {
				$model->addError ( "username", "El correo ingresado no se encuentra registrado" );
				// Si se encuentra el usuario
			} else {
				// Se genera un token para que el usuario pueda ser identificado y cambiar su password
				$recuperarPass = new UsrUsuariosRecuperarPasswords ();
				$isSaved = $recuperarPass->saveRecoveryPass ( $usuario->id_usuario );
				
				if ($isSaved) {
					// Preparamos los datos para enviar el correo
					$view = "_recoveryPassword";
					$data ["hash"] = $recuperarPass;
					$data ["usuario"] = $usuario;
					$data ["t"] = $t;
					
					// Envia correo electronico
					
					$this->sendEmail ( "Recuperar contraseña", $view, $data, $usuario );
					Yii::app ()->user->setFlash ( 'success', "Te hemos enviado un correo" );
				} else {
				}
			}
		}
		$this->render ( "formRecoveryPass", array (
				"model" => $model,
				"concurso" => $concurso 
		) );
	}
	
	/**
	 * Action para cambiar password del usuario
	 */
	public function actionResetPassword($hide = null, $t = null) {
		
		// Verifica que exita el concurso
		$concurso = $this->verificarToken ( $t );
		
		$this->layout = "mainLogin";
		if (! empty ( $hide )) {
			$recovery = new UsrUsuariosRecuperarPasswords ();
			$recuperar = $recovery->searchMd5 ( $hide );
			
			if (! empty ( $recuperar )) {
				
				$usuario = $recuperar->idUsuario;
				$usuario->scenario = "recovery";
				$usuario->txt_password = NULL;
				
				if (isset ( $_POST ["UsrUsuarios"] )) {
					
					$usuario->attributes = $_POST ["UsrUsuarios"];
					$tx = Yii::app ()->db->beginTransaction ();
					if ($usuario->save ()) {
						
						$recuperar->b_usado = 1;
						if ($recuperar->save ()) {
							
							$tx->commit ();
							Yii::app ()->user->setState ( "complete", "La contraseña ha sido cambiada exitosamente" );
							if (empty ( $t )) {
								$this->redirect ( "login", array (
										"t" => $t 
								) );
							}
							$this->redirect ( Yii::app ()->homeUrl );
						} else {
							Yii::app ()->user->setFlash ( 'error', "Ocurrió un problema al momento de guardar los datos" );
						}
						$tx->rollback ();
					}
				}
				
				$this->render ( "resetPassword", array (
						"model" => $usuario,
						"t" => $t 
				) );
				
				// Yii::app ()->user->setState ( "recoveryForm", $usuario );
				// $this->redirect ( "index" );
			} else {
				Yii::app ()->user->setFlash ( 'error', "La solicitud para recuperar contraseña ha expirado" );
				$this->redirect ( "requestPassword/t/" . $t );
				// echo "1";
				// return;
				// Yii::app ()->user->setFlash ( $type, "Ha expirado" );
				// $this->redirect ( "recoveryPassword" );
			}
		} else {
			throw new CHttpException ( 404, 'The requested page does not exist.' );
			// echo "2";
			// return;
			// Yii::app ()->user->setFlash ( $type, $message );
			// $this->redirect ( "recoveryPassword" );
		}
	}
	
	/**
	 * Envia correo
	 *
	 * @param unknown $view        	
	 * @param unknown $data        	
	 * @param unknown $usuario        	
	 */
	public function sendEmail($asunto, $view, $data, $usuario) {
		$template = $this->generateTemplateRecoveryPass ( $view, $data );
		$sendEmail = new SendEMail ();
		$sendEmail->SendMailPass ( $asunto, $usuario->txt_correo, $usuario->txt_nombre . " " . $usuario->txt_apellido_paterno, $template );
	}
	
	/**
	 * Generamos template con la informacion necesaria
	 */
	public function generateTemplateRecoveryPass($view, $data) {
		
		// Render view and get content
		// Notice the last argument being `true` on render()
		$content = $this->renderPartial ( $view, array (
				'data' => $data 
		), true );
		
		return $content;
	}
	
	// Verifica que exista el concurso
	public function verificarToken($t) {
		// Busqueda de concurso en la base de datos
		$concurso = ConContests::buscarPorToken ( $t );
		
		// Si no existe manda un error al usuario
		if ($concurso == null) {
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		
		return $concurso;
	}

}