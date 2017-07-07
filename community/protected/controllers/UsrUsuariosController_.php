<?php
class UsrUsuariosController extends Controller {
	/**
	 *
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 *      using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';
	
	/**
	 *
	 * @return array action filters
	 */
	public function filters() {
		return array (
				'accessControl', // perform access control for CRUD operations
				'postOnly + delete' 
		); // we only allow deletion via POST request
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 *
	 * @return array access control rules
	 */
	public function accessRules() {
		return array (
				array (
						'allow', // allow all users to perform 'index' and 'view' actions
						'actions' => array (
								'registrar',
								'iPNPayPal',
								'callbackFacebook' 
						),
						'users' => array (
								'*' 
						) 
				),
				array (
						'allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions' => array (
								'inscripcion',
								'fotosUsuario',
								'guardarFotosCompetencia',
								'concurso',
								'guardarInformacionPhoto',
								'guardarFotosCompetencia',
								'validateForm',
								'deletePhoto',
								'usurioParticipar',
								'reinscrip',
								'revisarPago',
								'revisarValidarPago',
								'necesitoAyuda',
								'sendReport',
								'profile',
								'myContests'
						),
						'users' => array (
								'@' 
						) 
				),
				array (
						'allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions' => array (
								'admin',
								'delete' 
						),
						'users' => array (
								'admin' 
						) 
				),
				array (
						'deny', // deny all users
						'users' => array (
								'*' 
						) 
				) 
		);
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 *
	 * @param integer $id
	 *        	the ID of the model to be loaded
	 * @return UsrUsuarios the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$model = UsrUsuarios::model ()->findByPk ( $id );
		if ($model === null)
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		return $model;
	}
	
	/**
	 * Valida el token enviado
	 *
	 * @param unknown $token        	
	 * @throws CHttpException
	 */
	public function validarToken($token) {
		
		// Buscamos el concurso mediante el token
		$concurso = ConContests::buscarPorToken ( $token );
		// Si no existe el concurso le mandamos error
		if (empty ( $concurso )) {
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		
		return $concurso;
	}
	
	/**
	 * Registrar usuario
	 */
	public function actionRegistrar($t = null) {
		$this->layout = 'mainLogin';
		$errorMessage = 'Mensaje de error';
		
		// Buscamos el concurso
		$concurso = $this->validarToken ( $t );
		
		// Inicializacion de modelos
		$competidor = new UsrUsuarios ();
		$competidor->scenario = "register";
		$datosWeb = new UsrUsuariosWebsites ();
		$datosTelefonos = new UsrUsuariosTelefonos ();
		
		// Verifica si se han enviado los datos
		if (isset ( $_POST ['UsrUsuarios'] ) && isset ( $_POST ['UsrUsuariosWebsites'] ) && isset ( $_POST ['UsrUsuariosTelefonos'] )) {
			
			// Asignamos los datos del formulario a sus respectivos modelos
			$competidor->attributes = $_POST ['UsrUsuarios'];
			$datosWeb->attributes = $_POST ["UsrUsuariosWebsites"];
			$datosTelefonos->attributes = $_POST ["UsrUsuariosTelefonos"];
			
			$competidor->txt_usuario_number = "usr_" . md5 ( uniqid ( "usr_" ) ) . uniqid ();
			
			// Obtenemos el archivo enviado
			$competidor->nombreImagen = CUploadedFile::getInstance ( $competidor, 'nombreImagen' );
			$size = null;
			$imageWrong = false;
			// Revisa que se haya subido un archivo
			if (! empty ( $competidor->nombreImagen )) {
				$raw_file_name = $competidor->nombreImagen->getTempName ();
				
				if(@is_array(getimagesize($mediapath))){
					// Valida que sea una imagen
					$size = getimagesize ( $raw_file_name );
				}else{
					$imageWrong = true;
				} 
				
				
			}
			
			// Asignamos la validación de los modelos
			$competidorValido = $competidor->validate ();
			$datosWebValido = $datosWeb->validate ();
			$datosTefononosValido = $datosTelefonos->validate ();
			
			
			if ($competidor->validaUsuarioExistente2 ()) {
				$errorMessage = "Ya estas registrado con este correo";
			} else if (! $competidorValido || ! $datosWebValido) {
				
				
				$errorMessage = "Parece que te faltan algunos campo por completar";
				
			}else if(!$datosTefononosValido){
					$errorMessage = "Escribe un telefono a 10 digitos sin signos, espacios ni guiones";
					
				}  else if (! $competidor->validarPasswordLength ()) {
				$competidor->addError("txt_password", "La contraseña debe contener mínimo 8 caracteres");
				$errorMessage = "Tu contraseña debe ser de al menos 8 caracteres";
				$competidorValido = false;
				
			}else if(!$competidor->validarEmail()){
					$errorMessage = "Necesitas ingresar un correo válido";
					
				}  else if (! $competidor->validarPasswordLength ()) {
				$competidor->addError("txt_password", "La contraseña debe contener mínimo 8 caracteres");
				$errorMessage = "Tu contraseña debe ser de al menos 8 caracteres";
				$competidorValido = false;
				
			}else if (! $competidor->validarPassword ()) {
				$errorMessage = "Revisa que ambas contraseñas coincidan";
				$competidorValido = false;
				$competidor->validarRepetirPass ();
			}else if($imageWrong){
				$competidor->addError("nombreImagen", "El archivo que intente subir esta dañado");
				$competidorValido = false;
				$errorMessage = "Formato de imagen invalido";
			}
			
			if (! empty ( $competidor->nombreImagen ) && !empty($size)) {
				// Nombre unico para la imagen
				$competidor->txt_image_url = $this->getNombreUnico () . "." . $competidor->nombreImagen->extensionName;
			}
			
			// Verifica que todos los modelos sean validos
			if ($competidorValido && $datosWebValido && $datosTefononosValido) {
				
				// Iniciamos transaccion a la base de datos
				$transaction = $competidor->dbConnection->beginTransaction ();
				try {
					
					// Guardar competidor
					if ($competidor->save ()) {
						
						// Asignamos el id del competidor al weby tel
						$datosWeb->id_usuario = $competidor->id_usuario;
						$datosTelefonos->id_usaurio = $competidor->id_usuario;
						
						if (! empty ( $datosWeb->txt_url )) {
							$datosTelefonos->save ();
						}
						
						// Guardar los datos del competidor (Telefono y web)
						if ($datosWeb->save ()) {
							
							// Guarda la imagen de perfil del usuario
							if (! empty ( $size )) {
								
								$this->guardarImagenCompetidor ( $competidor );
							}
							$transaction->commit ();
							
							$this->loginCompetidor ( $competidor, $concurso );
						} else {
							$transaction->rollback ();
						}
					}
					// Si existe un error realizamos un rollback
				} catch ( ErrorException $e ) {
					$transaction->rollback ();
				}
			}
		}
		
		// Vista a mostrar
		$this->render ( "registrar", array (
				"competidor" => $competidor,
				"datosWeb" => $datosWeb,
				"datosTelefonos" => $datosTelefonos,
				"t" => $t,
				"errorMessage" => $errorMessage 
		) );
	}
	
	private function getConcurso($t){
		// Busqueda de concurso en la base de datos
		$concurso = ConContests::buscarPorToken ( $t );
		
		// Si no existe manda un error al usuario
		if (empty ( $concurso )) {
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		
		return $concurso;
	}
	
	/**
	 */
	public function actionConcurso($t) {
		$concurso = $this->getConcurso($t);
		
		$idUsuario = Yii::app ()->user->concursante->id_usuario;
		
		$isUsuarioInscrito = ConRelUsersContest::isUsuarioInscrito ( $idUsuario, $concurso->id_contest );
		
		// Si el usuario esta inscrito lo enviamos a ver sus fotografias
		if ($isUsuarioInscrito) {
			$this->usuarioInscrito ($t);
			// Si el usuario no esta inscrito
		} else {
			
			$this->usuarioNoInscrito ($t);
		}
	}
	
	/**
	 * Usuario inscrito
	 */
	public function usuarioInscrito($t) {
		$concurso = $this->getConcurso($t);
		$idUsuario = Yii::app ()->user->concursante->id_usuario;
		
		$concursoDatos = ConRelUsersContest::model ()->find ( array (
				"condition" => "id_usuario=:idUsuario AND id_contest=:idConcurso",
				"params" => array (
						":idUsuario" => $idUsuario,
						":idConcurso" => $concurso->id_contest 
				) 
		) );
		
		// Revisamos si es la primera vez que el usuario entra al concurso
		if ($concursoDatos->b_primera_vez == 1) {
			$concursoDatos->b_primera_vez = 0;
			$concursoDatos->save ();
			Yii::app ()->user->setFlash ( 'success', "Su pago se ha realizado correctamente" );
		}
		
		// Obtenemos el numero de fotos que compro el usuario
		$numberFotosCompradas = $concursoDatos->num_fotos_permitidas;
		
		// Buscamos las fotos del competidor
		$fotosCompetidor = WrkPics::model ()->findAll ( array (
				"condition" => "ID=:idUsuario AND id_contest=:idConcurso",
				"params" => array (
						":idUsuario" => $idUsuario,
						":idConcurso" => $concurso->id_contest 
				) 
		) );
		
		$fotosCompetidor = count ( $fotosCompetidor );
		
		$fotosFaltantes = $numberFotosCompradas - $fotosCompetidor;
		
		// Guardar número de fotos para el usuario
		for($i = 0; $i < $fotosFaltantes; $i ++) {
			$photo = new WrkPics ();
			
			$photo->ID = $idUsuario;
			$photo->id_contest = $concurso->id_contest;
			$photo->txt_pic_number = "pic_" . md5 ( uniqid ( "pic_" ) ) . uniqid ();
			$photo->save ();
		}
		
		// Obtenemos todas las categorias del concurso
		$categorias = ConCategoiries::model ()->findAll ( array (
				"condition" => "id_contest=:idConcurso",
				"params" => array (
						":idConcurso" => $concurso->id_contest 
				),
				"order" => "txt_name_es" 
		) );
		$categorias = CHtml::listData ( $categorias, "id_category", "txt_name_es" );
		
		
		// Muestra las fotos
		$this->render ( "fotosUpload", array (
				"categorias" => $categorias 
		) );
	}
	
	/**
	 * Action que guarda la información de la foto
	 */
	public function actionGuardarInformacionPhoto() {
		$concurso = $this->getConcurso($t);
		$idUsuario = Yii::app ()->user->concursante->id_usuario;
		//$participa = Yii::app ()->user->concursante->b_participa;
		
		$isUsuarioInscrito = ConRelUsersContest::isUsuarioInscrito ( $idUsuario, $idConcurso );
		
		if(Yii::app()->user->concursante->b_participa==1){
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		
		if ($isUsuarioInscrito && $participa == 0) {
			$pic = new WrkPics ();
			
			if (isset ( $_POST ["WrkPics"] )) {
				$pic->setAttributes ( $_POST ["WrkPics"], false );
				
				$pic = WrkPics::validarUsuarioFoto ( $idConcurso, $idUsuario, $pic->txt_pic_number );
				
				if (! empty ( $pic )) {
					
					$image = $pic->txt_file_name;
					
					$pic->attributes = $_POST ["WrkPics"];
					$pic->ID = $idUsuario;
					
					$pic->txt_file_name = $image;
					
					foreach ( $pic->getAttributes () as $attribute => $value ) {
						if (empty ( $pic->$attribute )) {
							$pic->$attribute = null;
						}
					}
					
					$pic->scenario = "complete";
					$valid = $pic->save ();
					
					if ($valid) {
						
						// do anything here
						echo CJSON::encode ( array (
								'status' => 'success' 
						) );
						Yii::app ()->end ();
					} else {
						$error = CActiveForm::validate ( $pic );
						if ($error != '[]')
							echo $error;
						Yii::app ()->end ();
					}
				} else {
					throw new CHttpException ( 404, 'The requested page does not exist.' );
				}
			}
		}
	}
	
	/**
	 * Usuario no inscrito
	 */
	public function usuarioNoInscrito($t) {
		$this->layout = 'mainScroll';
		$concurso = $this->getConcurso($t);
		
		// Obtenemos los productos y los tipos de pagos para el concurso
		$productos = ConProducts::obtenerProductosPorConcurso ( $concurso->id_contest  );
		$tiposPagos = ConRelContestPayments::model ()->findAll ( array (
				"condition" => "id_contest=:idContest",
				"params" => array (
						":idContest" => $concurso->id_contest 
				) 
		) );
		
		// Obtiene los terminos y condiciones del concurso
		$terminosCondiciones = ConTerminosCondiciones::model ()->find ( array (
				"condition" => "id_contest=:idContest AND b_Actual=1",
				
				"params" => array (
						":idContest" => $concurso->id_contest 
				) 
		) );
		
		$this->render ( "inscripcion", array (
				"productos" => $productos,
				"tiposPagos" => $tiposPagos,
				"terminosCondiciones" => $terminosCondiciones 
		) );
	}
	
	/**
	 * Loguea al usuario despues de registrarse
	 *
	 * @param UsrUsuarios $competidor        	
	 */
	private function loginCompetidor($competidor, $concurso) {
		$model = new LoginForm ();
		$model->username = $competidor->txt_correo;
		$model->password = $competidor->txt_password;
		// validate user input and redirect to the previous page if valid
		if ($model->validate () && $model->login ()) {
			$this->crearSesionUsuarioConcurso ( $competidor->id_usuario, $concurso );
			$this->redirect ( Yii::app ()->user->returnUrl );
		}
	}
	
	/**
	 * Crea sesion para el usuario
	 *
	 * @param unknown $idCompetidor        	
	 * @param unknown $idConcurso        	
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
	 * Action inscripcion
	 */
	public function actionInscripcion($concurso = null) {
		$concursos = ConContests::model ()->findAll ();
		
		$this->render ( "inscripcion", array (
				"concursos" => $concursos 
		) );
	}
	
	/**
	 * Action para ver las fotos subidas del usuario al concurso
	 */
	public function actionFotosUsuario() {
		$this->revisarSesion ();
		
		$this->render ( "fotosUsuario" );
	}
	
	/**
	 * Revisa que la sesion sea valida si no lo desloguea
	 */
	public function revisarSesion() {
		$idConcurso = Yii::app ()->user->concurso;
		$idUsuario = Yii::app ()->user->concursante->id_usuario;
		
		$session = Yii::app ()->user->getState ( md5 ( "sesion-" . $idUsuario . "-" . $idConcurso ) );
		
		if (empty ( $session )) {
			
			Yii::app ()->user->logout ();
			$this->redirect ( Yii::app ()->homeUrl );
		}
	}
	
	/**
	 * Busca el concurso
	 *
	 * @param unknown $idConcurso        	
	 */
	private function searchConcurso($idConcurso) {
		$concurso = ConContests::model ()->findByPK ( $idConcurso );
		
		if (empty ( $concurso )) {
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		
		return $concurso;
	}
	
	/**
	 * Action para agregar fotos del usuario
	 */
	public function actionGuardarFotosCompetencia() {
		$idConcurso = Yii::app ()->user->concurso;
		$idUsuario = Yii::app ()->user->concursante->id_usuario;
		$tokenUsuario = Yii::app ()->user->concursante->txt_usuario_number;
		$respuesta = array ();
		
		if(Yii::app()->user->concursante->b_participa==1){
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		
		// Recupera el concurso
		$concurso = $this->searchConcurso ( $idConcurso );
		
		$isUsuarioInscrito = ConRelUsersContest::isUsuarioInscrito ( $idUsuario, $idConcurso );
		try {
			$pics = new WrkPics ();
			
			if (isset ( $_POST ["WrkPics"] )) {
				$pics->setAttributes ( $_POST ["WrkPics"], false );
				
				// Metodo que valida que la foto realmente pertenezca al usuario
				$pic = WrkPics::validarUsuarioFoto ( $idConcurso, $idUsuario, $pics->txt_pic_number );
				
				if (empty ( $pic )) {
					$respuesta ["status"] = "error";
					$respuesta ["message"] = "Ocurrio un problema al procesar la información";
					
					echo json_encode ( $respuesta );
					
					return;
				}
				
				$pics->txt_file_name = CUploadedFile::getInstance ( $pics, 'txt_file_name' );
				
				$raw_file_name = $pics->txt_file_name->getTempName ();
				
				// Valida que sea una imagen
				$size = getimagesize ( $raw_file_name );
				list ( $width, $height, $otro, $wh ) = getimagesize ( $raw_file_name );
				
				if(!is_array($size)){
					$respuesta ["status"] = "error";
					$respuesta ["message"] = "Formato de archivo incorrecto";
					echo json_encode ( $respuesta );
					return;
				}
				
				if(!array_key_exists("channels", $size)){
					$respuesta ["status"] = "error";
					$respuesta ["message"] = "Formato de archivo incorrecto";
					echo json_encode ( $respuesta );
					return;
				}
				
				$bits = $size ['bits'];
				$channels = $size ['channels'];
				$mime = $size ['mime'];
				
				if($bits>6144){
					$respuesta ["message"] = "El archivo no puede ser mayor a 6MB.";
				}
				
				// echo ("<br><br><br><br><br><br>w:" . $width . " H:" . $height . " wh:" . $wh . " b:" . $bits . " c:" . $channels . " m:" . $mime);
				
				if ($size == null || $size = 0 || empty ( $size )) {
					
					$respuesta ["status"] = "error";
					$respuesta ["message"] = "Formato de archivo inválido.";
					
					echo json_encode ( $respuesta );
					return;
					// No es una imagen
					// $uploadedImageMessage = "<p class='dgom-ui-message-error'>Archivo incorrecto, intentalo de nuevo.</p>";
					$error = true;
				}
				
				if ($width > 4000 || $height > 4000) {
					$respuesta ["status"] = "error";
					$respuesta ["message"] = "El archivo no puede medir más de 4000px en su lado más largo.";
					
					echo json_encode ( $respuesta );
					return;
					// $uploadedImageMessage = "<p class='dgom-ui-message-error'>La foto no debe exeder 4,000 pixeles.</p>";
					$error = true;
				}
				
				if ($mime !== 'image/jpeg') {
					$respuesta ["status"] = "error";
					$respuesta ["message"] = "El formato del archivo debe ser JPG";
					
					echo json_encode ( $respuesta );
					return;
					// echo("MIME ERROR");
					// $uploadedImageMessage = "<p class='dgom-ui-message-error'>Tu archivo debe ser JPG.</p>";
					$error = true;
				}
				
				$dirBase = "pictures/contests/con_" . $concurso->txt_token . "/idu_" . $tokenUsuario;
				$iuf = uniqid ( "pic_" ) . ".jpg";
				
				// Elimina la foto anterior
				if ($this->hasPreviousImage ( $pic )) {
					$this->deleteImages ( $dirBase, "small_" . $pic->txt_file_name );
					$this->deleteImages ( $dirBase, "medium_" . $pic->txt_file_name );
					$this->deleteImages ( $dirBase, "large_" . $pic->txt_file_name );
					$this->deleteImages ( $dirBase, $pic->txt_file_name );
				}
				// Verificamos que exista el directorio si no es así lo crea
				$this->validarDirectorio ( $dirBase );
				
				// Guarda la imagen el el path
				$archivoGuardado = $pics->txt_file_name->saveAs ( $dirBase . "/" . $iuf );
				
				// Redimencionar small
				$nombreNuevo = $dirBase . "/small_" . $iuf;
				$this->rezisePicture ( $dirBase . "/" . $iuf, $width, $height, 400, $nombreNuevo );
				
				// Redimencionar medium
				$nombreNuevo = $dirBase . "/medium_" . $iuf;
				$this->rezisePicture ( $dirBase . "/" . $iuf, $width, $height, 800, $nombreNuevo );
				
				// Redimencionar large
				$nombreNuevo = $dirBase . "/large_" . $iuf;
				$this->rezisePicture ( $dirBase . "/" . $iuf, $width, $height, 1280, $nombreNuevo );
				
				// Guardamos la imagen
				$pic->txt_file_name = $iuf;
				
				$pic->save ();
				// print_r ( $pic->getErrors () );
				$respuesta ["status"] = "success";
				$respuesta ["message"] = "Archivo guardado con exito";
				$respuesta ["urlSmall"] = Yii::app ()->request->baseUrl . "/" . $dirBase . "/small_" . $pic->txt_file_name;
				$respuesta ["urlLarge"] = Yii::app ()->request->baseUrl . "/" . $dirBase . "/large_" . $pic->txt_file_name;
				
				echo json_encode ( $respuesta );
				return;
			}
		} catch ( ErrorException $e ) {
			// echo $e;
			throw new CHttpException ( 500, 'Ocurrio un problema.' );
		}
	}
	
	/**
	 * Elimina la foto del servidor
	 */
	private function deleteImages($path, $name) {
		if (file_exists ( $path . "/" . $name )) {
			unlink ( $path . "/" . $name );
		}
	}
	
	/**
	 * Verifica que exita una foto
	 */
	private function hasPreviousImage($pic) {
		if (isset ( $pic->txt_file_name )) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Metodo para cambiar el tamaño de una imagen
	 *
	 * @param unknown $file        	
	 * @param unknown $ancho        	
	 * @param unknown $alto        	
	 * @param unknown $nuevo_ancho        	
	 * @param unknown $nuevo_alto        	
	 */
	private function rezisePicture($file, $ancho, $alto, $redimencionar, $nombreNuevo) {
		// Factor para el redimensionamiento
		$factor = $this->calcularFactor ( $ancho, $alto, $redimencionar );
		
		$nuevo_ancho = $ancho * $factor;
		$nuevo_alto = $alto * $factor;
		
		// Cargar
		$thumb = imagecreatetruecolor ( $nuevo_ancho, $nuevo_alto );
		$origen = imagecreatefromjpeg ( $file );
		// Cambiar el tamaño
		imagecopyresampled ( $thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto );
		imagejpeg ( $thumb, $nombreNuevo );
	}
	
	/**
	 * Calcula el factor
	 *
	 * @param unknown $ancho        	
	 * @param unknown $alto        	
	 * @param unknown $redimension        	
	 */
	private function calcularFactor($ancho, $alto, $redimension) {
		if ($ancho >= $alto) {
			$factor = $redimension / $ancho;
		} else if ($ancho <= $alto) {
			$factor = $redimension / $alto;
		}
		
		return $factor;
	}
	
	/**
	 * IPN para payl pal
	 */
	public function actionIPNPayPal() {
		$payPal = new IPNPayPal ();
		$payPal->payPalIPN ();
	}
	
	/**
	 * Devuelve un nombre unico
	 */
	private function getNombreUnico() {
		$nombreUnico = md5 ( uniqid ( "dgom" ) );
		return $nombreUnico;
	}
	
	/**
	 * Guarda la imagen que subio el competidor (Perfil)
	 *
	 * @param UsrUsuarios $competidor        	
	 */
	private function guardarImagenCompetidor($competidor) {
		// Path base donde se encuentran las imagenes de perfil
		$dirBase = Yii::app ()->params ['pathBaseImagenes'] . "profiles/" . $competidor->txt_usuario_number . "/";
		
		// Verificamos que exista el directorio si no es así lo crea
		$this->validarDirectorio ( $dirBase );
		
		// Guarda la imagen el el path
		$archivoGuardado = $competidor->nombreImagen->saveAs ( $dirBase . $competidor->txt_image_url );
		
		return $archivoGuardado;
	}
	
	/**
	 * Valida si existe el directorio si no lo crea
	 *
	 * @param String $file        	
	 */
	private function validarDirectorio($dir) {
		if (! file_exists ( $dir )) {
			mkdir ( $dir, 0777, true );
		}
	}
	
	/**
	 * Envia correo
	 *
	 * @param unknown $view        	
	 * @param unknown $data        	
	 * @param unknown $usuario        	
	 */
	public function sendEmail($view, $data, $usuario) {
		$template = $this->generateTemplateRecoveryPass ( $view, $data );
		$sendEmail = new SendEMail ();
		$sendEmail->SendMailPass ( Mensajes::TITLE_EMAIL_RECOVERY, $usuario->txt_correo, $usuario->txt_usuario, $template );
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
	
	/**
	 * Valida el formulario de la foto
	 */
	public function actionValidateForm() {
		$idUsuario = Yii::app ()->user->concursante->id_usuario;
		$model = new WrkPics ();
		$model->ID = $idUsuario;
		
		if (isset ( $_POST ['WrkPics'] )) {
			$model->setAttributes ( $_POST ['WrkPics'], false );
			
			$model = WrkPics::model ()->find ( array (
					"condition" => "txt_pic_number=:id",
					"params" => array (
							":id" => $model->txt_pic_number 
					) 
			) );
			// $this->performAjaxValidation ( $model );
			
			if (empty ( $model )) {
				throw new CHttpException ( 404, 'The requested page does not exist.' );
			}
			$model->scenario = "complete";
			$valid = $model->validate ();
			
			if ($valid) {
				
				// do anything here
				echo CJSON::encode ( array (
						'status' => 'success' 
				) );
				Yii::app ()->end ();
			} else {
				$error = CActiveForm::validate ( $model );
				if ($error != '[]')
					echo $error;
				Yii::app ()->end ();
			}
		}
	}
	
	/**
	 * Performs the AJAX validation.
	 *
	 * @param Candidatos $model
	 *        	the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if (isset ( $_POST ['ajax'] )) {
			
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
	}
	
	/**
	 * Callback con la respuesta de facebook
	 */
	public function actionCallbackFacebook($t = null) {
		
		// Buscamos el concurso
		$concurso = $this->validarToken ( $t );
		
		Yii::log ( "\n\r En callback de facebook", "debug", 'facebook' );
		$fb = new Facebook ();
		
		// Obtenemos la respuesta de facebook
		$usuario = $fb->recoveryDataUserJavaScript ();
		if (gettype ( $usuario ) == "string") {
			if ($usuario == "error") {
				Yii::app ()->user->setFlash ( "error", "Se perdio la comunicación con Facebook. Vuelva a intentarlo" );
				
				$this->redirect ( Yii::app ()->homeUrl );
			}
		}
		
		if (empty ( $usuario )) {
			Yii::log ( "\n\r Regreso vacio", "debug", 'facebook' );
			Yii::app ()->user->setFlash ( "error", "Facebook rechazo la solicitud." );
			// Mandar error
			$this->redirect ( array (
					"site/login" 
			) );
		} else {
			
			Yii::log ( "\n\rDatos de facebook" . print_r ( $usuario ), "debug", 'facebook' );
			
			$entUsuario = new UsrUsuarios ();
			$entUsuario->id_usuario_facebook = $usuario ['profile'] ['id'];
			
			if (isset ( $usuario ['profile'] ['email'] )) {
				$entUsuario->txt_correo = $usuario ['profile'] ['email'];
			} else {
				// $entUsuario->txt_correo = str_replace ( " ", "_", $usuario ['profile'] ['name'] . uniqid () );
				Yii::app ()->user->setFlash ( "info", "Escribir correo electronico." );
				$this->render ( "ingresarCorreo" );
			}
			
			$usuarioDB = $entUsuario->searchUsuarioIdFacebook ();
			$login = new LoginForm ();
			
// 			print_r($usuario);
// 			exit;
			
			if (empty ( $usuarioDB )) {
				
				// Guarda la informacion de facebook
				$entUsuario->b_login_social_network = 1;
				$entUsuario->id_usuario_facebook = $usuario ['profile'] ['id'];
				$entUsuario->txt_nombre = $usuario ['profile'] ['first_name'];
				$entUsuario->txt_apellido_paterno = $usuario ['profile'] ['last_name'];
				$entUsuario->txt_password = NULL;
				$entUsuario->txt_image_url = $usuario ['pictureUrl'];
				$entUsuario->txt_usuario_number = "usr_" . md5 ( uniqid ( "usr_" ) ) . uniqid ();
				
				// Guarda al usuario
				if ($entUsuario->save ()) {
					Yii::log ( "\n\r Se crea un nuevo usuario", "debug", 'facebook' );
					
					// Loguea al usuario
					$login->loginFacebook ( $entUsuario );
					
					// Crea sesiones
					$this->crearSesionUsuarioConcurso ( Yii::app ()->user->concursante->id_usuario, $concurso );
				} else {
					Yii::app ()->user->setFlash ( "error", "No se pudieron guardar los datos." );
					Yii::log ( "\n\r No se pudo guardar el usuario" . $this->getErrors ( $entUsuario->getErrors () ), "debug", 'facebook' );
					// no se pudo guardar
					
					$this->redirect ( array (
							"usrUsuarios/concurso" 
					) );
				}
			} else {
				$usuarioDB->id_usuario_facebook = $entUsuario->id_usuario_facebook;
				$usuarioDB->txt_nombre = $usuario ['profile'] ['first_name'];
				$usuarioDB->txt_apellido_paterno = $usuario ['profile'] ['last_name'];
				$usuarioDB->txt_image_url = $usuario ['pictureUrl'];
				// $usuarioDB->scenario = "register";
				if ($usuarioDB->save ()) {
					Yii::log ( "\n\r Se edita al usuario por face", "debug", 'facebook' );
				} else {
					Yii::log ( "\n\r Ocurrio un error al actualizar el usuario" . $this->getErrors ( $usuarioDB->getErrors () ), "debug", 'facebook' );
				}
				$login->loginFacebook ( $usuarioDB );
				
				// Crea sesiones
				$this->crearSesionUsuarioConcurso ( Yii::app ()->user->concursante->id_usuario, $concurso );
			}
			Yii::log ( "\n\r Redirecciona al index", "debug", 'facebook' );
			$this->redirect ( array (
					"usrUsuarios/concurso" 
			) );
		}
	}
	
	/**
	 * Desenglosa los errores
	 *
	 * @param unknown $errores        	
	 */
	public function getErrors($errores) {
		$erroresS = "";
		foreach ( $errores as $key => $error ) {
			
			foreach ( $error as $e ) {
				
				$erroresS .= $e . " ";
			}
		}
		
		return $erroresS;
	}
	
	/**
	 * Elimina la imagen
	 * 
	 * @param unknown $id        	
	 */
	public function actionDeletePhoto($id) {
		$idConcurso = Yii::app ()->user->concurso;
		$idUsuario = Yii::app ()->user->concursante->id_usuario;
		$tokenUsuario = Yii::app ()->user->concursante->txt_usuario_number;
		
		// Recupera el concurso
		$concurso = $this->searchConcurso ( $idConcurso );
		
		$isUsuarioInscrito = ConRelUsersContest::isUsuarioInscrito ( $idUsuario, $idConcurso );
		
		if(Yii::app()->user->concursante->b_participa==1){
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		
		if ($isUsuarioInscrito) {
			$pic = WrkPics::model ()->find ( array (
					"condition" => "txt_pic_number=:pic AND ID=:idUsuario",
					"params" => array (
							":pic" => $id,
							":idUsuario"=>$idUsuario
					) 
			) );
			
			if (empty ( $pic )) {
				throw new CHttpException ( 404, 'The requested page does not exist.' );
			}
			
			$pic->id_category_original = null;
			$pic->txt_file_name = null;
			$pic->txt_pic_name = null;
			$pic->txt_pic_desc = null;
			
			if ($pic->save ()) {
				$dirBase = "pictures/contests/con_" . $concurso->txt_token . "/idu_" . $tokenUsuario;
				$iuf = uniqid ( "pic_" ) . ".jpg";
				
				// Elimina la foto anterior
				if ($this->hasPreviousImage ( $pic )) {
					$this->deleteImages ( $dirBase, "small_" . $pic->txt_file_name );
					$this->deleteImages ( $dirBase, "medium_" . $pic->txt_file_name );
					$this->deleteImages ( $dirBase, "large_" . $pic->txt_file_name );
					$this->deleteImages ( $dirBase, $pic->txt_file_name );
				}
			}
		}
	}
	
	/**
	 * Usuario se encuentra participando
	 */
	public function usuarioParticipa(){
		
	}
	
	/**
	 * Action para cuando el usuario decide participar al concurso
	 */
	public function actionUsurioParticipar() {
		$idConcurso = Yii::app ()->user->concurso;
		$idUsuario = Yii::app ()->user->concursante->id_usuario;
		$tokenUsuario = Yii::app ()->user->concursante->txt_usuario_number;
		
		// Recupera el concurso
		$concurso = $this->searchConcurso ( $idConcurso );
		
		$isUsuarioInscrito = ConRelUsersContest::isUsuarioInscrito ( $idUsuario, $idConcurso );
		
		if ($isUsuarioInscrito) {
			$usuario = UsrUsuarios::model ()->find ( array (
					"condition" => "id_usuario=:idUsuario",
					"params" => array (
							":idUsuario" => $idUsuario 
					) 
			) );
			
			if (empty ( $usuario )) {
				throw new CHttpException ( 404, 'The requested page does not exist.' );
			}
			
			// Buscamos las fotos del competidor
$fotosCompetidor = WrkPics::model ()->findAll ( array (
		"condition" => "ID=:idUsuario AND id_contest=:idConcurso",
		"params" => array (
				":idUsuario" => $idUsuario,
				":idConcurso" => $idConcurso 
		) 
) );


			foreach($fotosCompetidor as $foto){
				$foto->scenario = "complete";
				
				
				if($foto->validate()){
					
					$foto->b_status = 2;
				}else{
					
					$foto->b_status = 3;
				}
				
				$foto->scenario="";
				$foto->save();
			}

			$usuario->b_participa = 1;
			$usuario->save ();
			
			Yii::app ()->user->setState ( "concursante", $usuario );
		}
	}
	
	/**
	 * Action Pago
	 */
	// public function actionReinscrip() {
	// $this->layout = 'mainScroll';
	// $this->render ( 'reinscrip' );
	// }
	public function actionReinscrip() {
		$this->layout = 'mainScroll';
		$idConcurso = Yii::app ()->user->concurso;
		
		// Obtenemos los productos y los tipos de pagos para el concurso
		$productos = ConProducts::obtenerProductosPorConcurso ( $idConcurso );
		$tiposPagos = ConRelContestPayments::model ()->findAll ( array (
				"condition" => "id_contest=:idContest",
				"params" => array (
						":idContest" => $idConcurso 
				) 
		) );
		
		// Obtiene los terminos y condiciones del concurso
		$terminosCondiciones = ConTerminosCondiciones::model ()->find ( array (
				"condition" => "id_contest=:idContest AND b_Actual=1",
				
				"params" => array (
						":idContest" => $idConcurso 
				) 
		) );
		
		$this->render ( "reinscrip", array (
				"productos" => $productos,
				"tiposPagos" => $tiposPagos,
				"terminosCondiciones" => $terminosCondiciones 
		) );
	}


	/**
	 * Action Pago
	 */
	// public function actionReinscrip() {
	// $this->layout = 'mainScroll';
	// $this->render ( 'reinscrip' );
	// }
	public function actionRevisarPago() {
		$this->layout = 'mainRevisarPago';
		

		$idConcurso = Yii::app ()->user->concurso;
		$idUsuario = Yii::app ()->user->concursante->id_usuario;
		
		
		// Recupera el concurso
		$concurso = $this->searchConcurso ( $idConcurso );
		
		$isUsuarioInscrito = ConRelUsersContest::isUsuarioInscrito ( $idUsuario, $idConcurso );
		
		if ($isUsuarioInscrito) {
			$this->redirect ( "concurso" );
			
		}else{
 			$this->render ( "revisarPago" );
		}
		
		
		
	}
	
	/**
	 * Revisa que el pago ya se encuentre en la base de datos
	 */
	public function actionRevisarValidarPago(){
		
		$idConcurso = Yii::app ()->user->concurso;
		$idUsuario = Yii::app ()->user->concursante->id_usuario;
		
		
		// Recupera el concurso
		$concurso = $this->searchConcurso ( $idConcurso );
		
		$isUsuarioInscrito = ConRelUsersContest::isUsuarioInscrito ( $idUsuario, $idConcurso );
		
		if ($isUsuarioInscrito) {
			echo "success";
			
		}else{
			echo "wait";
		}
		
		
		
	}
	
	/**
	 * Envia reporte via email del problema que se presenta al usuario
	 */
	public function actionSendReport(){
		$this->layout = false;
		$concursante = Yii::app ()->user->concursante;
		
		if(isset($_POST["txt_tipo_incidencia"])&&isset($_POST["txt_descripcion"])){
			
			$data = array("reporte"=>$_POST, "concursante"=>$concursante);
			
			#$this->sendEmailReporte("Reporte de usuario","reporteUsuario", $data, "soporte@comitefotomx.com", "Centro de soporte");
			$this->sendEmailReporte("Reporte de usuario","reporteUsuario", $data, "humberto@2gom.com.mx", "Centro de soporte");
			
		}else{
			
			$this->render("_formReporte");
			
		}
		
	}
	
	
	/**
	 * Envia correo
	 *
	 * @param unknown $view
	 * @param unknown $data
	 * @param unknown $usuario
	 */
	public function sendEmailReporte($asunto, $view, $data, $email, $usuario) {
		$template = $this->generateTemplateRecoveryPass ( $view, $data );
		$sendEmail = new SendEMail ();
		$sendEmail->sendMailSoporte ( $asunto,$email,$usuario, $template );
	}
	
	/**
	 * Perfil del usuario
	 */
	public function actionProfile(){
		
		$this->render('profile');
		
	}
	
	/**
	 * Concursos en los que se encuentra participando el usuario
	 */
	public function actionMyContests(){
		
		$this->render('myContests');
	}
	
	
}
