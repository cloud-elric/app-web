<?php
class LoginController extends Controller {
	public function init() {
		$lan = Yii::app ()->session ['_lang'];
		
		if (empty ( $lan )) {
			$lan = Yii::app ()->language;
		}
		// Here you can add specific code for generating Menu, but the code to change the Yii's default language
		Yii::app ()->language = $lan;
	}
	/**
	 * Declares class-based actions.
	 */
	public function actions() {
		return array (
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha' => array (
						'class' => 'CCaptchaAction',
						'backColor' => 0xFFFFFF 
				),
				// page action renders "static" pages stored under 'protected/views/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
				'page' => array (
						'class' => 'CViewAction' 
				) 
		);
	}
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {
		$model = new LoginForm ();
		
		$this->layout = "column3";
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"login",
				"c_geek" 
		), "css" );
		
		$cargarScripts->getScripts ( array (
				"jqueryPlaceholder" 
		), "js" );
		
		// if it is ajax validation request
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'login-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
		
		// collect user input data
		if (isset ( $_POST ['LoginForm'] )) {
			$model->attributes = $_POST ['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate () && $model->login ()) {
				
				$this->validateAdmin ();
				
				// $this->redirect(Yii::app()->user->returnUrl);
			}
		}
		
		$this->render ( "//judgingPanel/login", array (
				"model" => $model 
		) );
	}
	
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
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		Yii::app ()->user->logout ();
		$this->redirect ( Yii::app ()->createUrl ( 'login' ) );
	}
	
	/**
	 * Revisamos si el usuario es admin o solo juez para redireccionarlo a su respectiva pantalla
	 *
	 * @var EntJueces $juezSession
	 */
	public function validateAdmin() {
		// Obtenemos la session
		$juezSession = Yii::app ()->user->getState ( "juezLogueado" );
		// Verificamos
		if (empty ( $juezSession )) {
			$this->redirect ( "login" );
		} else if ($juezSession->b_juez_admin == 0) { // Si el b_juez_admin es 0 es un juez normal
			
			$idJuez = Yii::app ()->user->juezLogueado->id_juez;
			$concursos = JueRelJuecesContests::model ()->find ( array (
					"condition" => "id_juez=:idJuez",
					"params" => array (
							":idJuez" => $idJuez 
					) 
			) );
			
			if (count ( $concursos ) > 1) {
				exit();
			} else {
// 				$url = Yii::app ()->createUrl ( 'judgingPanel/index', array (
// 						"t" => $concursos->idContest->txt_token 
// 				) );

				$url = Yii::app ()->createUrl ( 'judgingPanel/concursos');
				$this->redirect ( $url );
			}
		} else if ($juezSession->b_juez_admin == 1) { // Si el b_juez_admin es 1 es un admin
			$this->redirect ( array (
					"adminPanel/" 
			) );
		}
	}
}