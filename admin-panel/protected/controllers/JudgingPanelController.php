<?php
class JudgingPanelController extends Controller {
	public function init() {
		$lan = Yii::app ()->session ['_lang'];
		
		if (empty ( $lan )) {
			$lan = Yii::app ()->language;
		}
		// Here you can add specific code for generating Menu, but the code to change the Yii's default language
		Yii::app ()->language = $lan;
	}
	
	/**
	 *
	 * @return array action filters
	 */
	public function filters() {
		return array (
				'accessControl' 
		); // perform access control for CRUD operations
			   // we only allow deletion via POST request
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
								'login' 
						),
						'users' => array (
								'*' 
						) 
				),
				array (
						'allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions' => array (
								'index',
								'photoViewer',
								'photoReview',
								'tieBreakerRound',
								'categoriaFinalizada',
								'viewPhotosCategory',
								'breakerRoundByCategory',
								'desempate',
								'voice',
								'feedback',
								'saveCal',
								'viewScorePhoto',
								'test' 
						),
						'users' => array (
								'@' 
						),
						'roles' => array (
								"0" 
						) 
				),
				// Actions para el usuario juez
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
	 * Revisa si existe el concurso al que pretende ingresar el juez
	 *
	 * @param string $t        	
	 */
	public function existeConcurso($t = null) {
		// Obtenemos el concurso a cual prentende ingresar el juez
		$concurso = ConContests::buscarPorToken ( $t );
		
		// Si no existe el concurso lo mandamos a la pantalla con error 404
		if (empty ( $concurso )) {
			throw new CHttpException ( 404, 'La pagina solicitada no existe' );
			return;
		}
		
		return $concurso;
	}
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 * Action para ver el dashboard del juez
	 */
	public function actionIndex($t = '3c391e5c9feec1f95282a36bdd5d41ba') {
		// Obtenemos el id del juez
		$idJuez = Yii::app ()->user->juezLogueado->id_juez;
		
		// Revisa si existe y obtenemos el concurso
		$concurso = $this->existeConcurso ( $t );
		
		// Revisa si el juez pertenece al concurso
		$isJuez = JueRelJuecesContests::model ()->find ( array (
				"condition" => "id_juez=:idJuez AND id_contests=:idContest",
				"params" => array (
						":idJuez" => $idJuez,
						":idContest" => $concurso->id_contest 
				) 
		) );
		
		// Revisa si el juez finalizo su trabajo
		$this->isJuezCompleted ( $idJuez, $concurso->id_contest );
		
		// Obtenemos el avance del juez
		$avance = ViewAvanceTotalJuez::model ()->findAll ( array (
				"condition" => "id_juez=:idJuez AND id_contest=:idContest",
				"params" => array (
						":idJuez" => $idJuez,
						":idContest" => $concurso->id_contest 
				) 
		) );
		
		$this->layout = "column5";
		
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"c_geek" 
		), "css" );
		
		$this->render ( 'index', array (
				'avance' => $avance,
				't' => $t 
		) );
		// 'avance'=>$avance
	}
	
	/**
	 * Pinta todas las fotos
	 */
	public function actionPhotoViewer() {
		$modelPhoto = ViewFotosData::model ()->findAll ();
		
		$this->render ( 'photoViewer', array (
				'modelPhoto' => $modelPhoto 
		) );
	}
	
	/**
	 * Busca la fotografia que no haya calificado el juez
	 *
	 * @param unknown $idJuez        	
	 * @param unknown $idCategoria        	
	 * @param number $concurso        	
	 */
	private function searchPicCal($idJuez, $idCategoria, $concurso = 1) {
		
		// Condiciones de busqueda
		$criteria = new CDbCriteria ();
		$criteria->alias = "P";
		$criteria->condition = "P.id_category_original =:idCategoria AND
								P.id_pic NOT IN(SELECT PC.id_pic FROM 2gom_wrk_pics_calificaciones PC INNER JOIN 2gom_wrk_pics_juez_cal C on C.id_juez = PC.id_juez AND C.id_pic = PC.id_pic AND C.id_contest = PC.id_contest 
								WHERE PC.id_pic =P.id_pic AND PC.id_juez=:idJuez AND PC.id_contest=:idContest) 
								AND P.b_status=2";
		$criteria->params = array (
				":idJuez" => $idJuez,
				":idCategoria" => $idCategoria,
				":idContest" => $concurso 
		);
		
		$photoCalificar = WrkPics::model ()->find ( $criteria );
		
		return $photoCalificar;
	}
	
	/**
	 * Busca la fotografia que no haya calificado el juez
	 *
	 * @param unknown $idJuez        	
	 * @param unknown $idCategoria        	
	 * @param number $concurso        	
	 */
	private function searchPicCalById($idPic, $idJuez, $idCategoria, $concurso = 1) {
		
		// Condiciones de busqueda
		$criteria = new CDbCriteria ();
		$criteria->alias = "P";
		$criteria->condition = "P.id_category_original =:idCategoria  AND P.txt_pic_number = :idPic AND
								P.id_pic IN(SELECT id_pic FROM 2gom_wrk_pics_calificaciones WHERE id_pic =P.id_pic AND id_juez=:idJuez AND id_contest=:idContest AND txt_retro IS NULL) AND P.b_status=2";
		$criteria->params = array (
				":idJuez" => $idJuez,
				":idCategoria" => $idCategoria,
				":idContest" => $concurso,
				':idPic' => $idPic 
		);
		
		$photoCalificar = WrkPics::model ()->find ( $criteria );
		
		return $photoCalificar;
	}
	
	/**
	 * Guarda la calificacion
	 */
	public function actionSaveCal($idCategoria = null, $t = null) {
		$concurso = $this->existeConcurso ( $t );
		
		$idJuez = Yii::app ()->user->juezLogueado->id_juez;
		
		$categoria = Categoiries::model ()->find ( array (
				"condition" => "txt_token_category=:t AND id_contest=:idConcurso",
				"params" => array (
						":t" => $idCategoria,
						":idConcurso" => $concurso->id_contest 
				) 
		) );
		
		$photoCalificar = $this->searchPicCal ( $idJuez, $categoria->id_category );
		
		// Si no hay foto a calificar
		if (empty ( $photoCalificar )) {
			$this->redirect ( array (
					"judgingPanel/index",
					"t" => $t 
			) );
		}
		
		// Cargamos categorias
		$criteriaCategorias = new CDbCriteria ();
		$criteriaCategorias->condition = 'id_contest=1 AND id_category NOT IN (:idPic)';
		$criteriaCategorias->params = array (
				':idPic' => $photoCalificar->id_category_original 
		);
		
		$categorias = Categoiries::model ()->findAll ( $criteriaCategorias );
		$categoriasList = CHtml::listData ( $categorias, "id_category", "txt_name" );
		// Cargamos rubros
		$rubros = CatCalificacionesRubros::model ()->findAll ( array (
				"condition" => "b_habilitado=1 AND id_contest=:idContest",
				"params" => array (
						":idContest" => $concurso->id_contest 
				) 
		) );
		
		// Si vienen datos por POST asignamos
		if (isset ( $_POST ["WrkPics"] )) {
			
			$wrkPicsCalificaciones = WrkPicsCalificaciones::model ()->findAll ( array (
					'condition' => 'id_contest=1 AND id_juez=:idJuez AND id_pic=:idPic',
					'params' => array (
							':idJuez' => $idJuez,
							':idPic' => $photoCalificar->id_pic 
					) 
			) );
			
			$categoria = $photoCalificar->id_category;
			$photoCalificar->attributes = $_POST ["WrkPics"];
			$photoCalificar->WrkPicsCalificaciones = $_POST ["WrkPics"] ["WrkPicsCalificaciones"];
			$bMencion = 0;
			$retro = NULL;
			$categoriaPropuesta = NULL;
			
			// Es mencion
			if (isset ( $_POST ["b_mencion"] )) {
				$bMencion = $_POST ["b_mencion"];
			}
			
			// Suguieren otra categoria
			if (empty ( $photoCalificar->id_category )) {
				$photoCalificar->id_category = NULL;
			}
			
			// Guardamos las calificaciones
			foreach ( $photoCalificar->WrkPicsCalificaciones as $key => $value ) {
				
				$calificacion = new WrkPicsCalificaciones ();
				$calificacion->id_juez = $idJuez;
				$calificacion->id_pic = $photoCalificar->id_pic;
				$calificacion->txt_retro = $retro;
				$calificacion->id_contest = $concurso->id_contest;
				
				foreach ( $wrkPicsCalificaciones as $wrkCalificacion ) {
					if ($photoCalificar->id_pic == $wrkCalificacion->id_pic && $idJuez == $wrkCalificacion->id_juez && $wrkCalificacion->id_rubro == $key) {
						$calificacion = $wrkCalificacion;
					}
				}
				
				$calificacion->id_rubro = $key;
				$calificacion->id_categoria_propuesta = $photoCalificar->id_category;
				$calificacion->num_calificacion = $value;
				$calificacion->b_mencion = $bMencion;
				
				// $calificacion->id_categoria_propuesta;
				// return;
				// $calificaciones[]= $calificacion;
				$calificacion->save ();
			}
			
			// Busca si el dueño de la fotografía compro con feedback
			$hasFeedback = ViewUsuarioPicsProductos::model ()->find ( array (
					'condition' => 'id_pic=:idPic AND num_addons>0',
					'params' => array (
							':idPic' => $photoCalificar->id_pic 
					) 
			) );
			
			if (! empty ( $hasFeedback )) {
				// if (true) {
				$this->redirect ( array (
						"feedback",
						"idPhoto" => $photoCalificar->txt_pic_number,
						't' => $t,
						'idCategory' => $idCategoria 
				) );
			} else {
				$cJ = new WrkPicsJuezCal ();
				$cJ->id_contest = $photoCalificar->id_contest;
				$cJ->id_juez = $idJuez;
				$cJ->id_pic = $photoCalificar->id_pic;
				$cJ->id_status_calificacion = 2;
				$cJ->id_usuario = $photoCalificar->ID;
				$cJ->save ();
			}
		}
		
		// Vista
		$this->redirect ( array (
				'judgingPanel/photoReview',
				'idCategoria' => $idCategoria,
				't' => $t 
		) );
	}
	
	/**
	 * Pintamos el score de la pic
	 *
	 * @param unknown $idPic        	
	 */
	public function actionViewScorePhoto($idPic, $idCategoria, $t) {
		$this->layout = "column3";
		
		// Scripts y css
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"c_select2",
				"c_asPieProgress",
				"c_pie_progress",
				"c_asRange",
				"c_icheck",
				"c_advanced",
				"c_geek" 
		), "css" );
		
		$cargarScripts->getScripts ( array (
				"j_select2",
				"j_jquery_placeholder",
				"j_select2_components",
				"j_jquery_placeholder_components",
				"j_jquery_asPieProgress",
				"j_aspieprogress",
				"j_pie_progress",
				"j_jquery_asRange",
				"j_icheck_min",
				"j_icheck",
				"j_jquery_knob",
				"j_components_jquery_knob" 
		), 
				// "j_dgom_panels_juez",
				// "j_dgom_photo_juez"
				"js" );
		
		$concurso = $this->existeConcurso ( $t );
		
		$idJuez = Yii::app ()->user->juezLogueado->id_juez;
		
		$categoria = Categoiries::model ()->find ( array (
				"condition" => "txt_token_category=:t AND id_contest=:idConcurso",
				"params" => array (
						":t" => $idCategoria,
						":idConcurso" => $concurso->id_contest 
				) 
		) );
		
		$photoCalificar = $this->searchPicCalById ( $idPic, $idJuez, $categoria->id_category );
		
		// Si no hay foto a calificar
		if (empty ( $photoCalificar )) {
			$this->redirect ( array (
					"judgingPanel/index",
					"t" => $t 
			) );
		}
		
		// Cargamos categorias
		$criteriaCategorias = new CDbCriteria ();
		$criteriaCategorias->condition = 'id_contest=1 AND id_category NOT IN (:idPic)';
		$criteriaCategorias->params = array (
				':idPic' => $photoCalificar->id_category_original 
		);
		
		$categorias = Categoiries::model ()->findAll ( $criteriaCategorias );
		$categoriasList = CHtml::listData ( $categorias, "id_category", "txt_name" );
		// Cargamos rubros
		// $rubros = CatCalificacionesRubros::model ()->findAll ( array (
		// "condition" => "b_habilitado=1 AND id_contest=:idContest",
		// "params" => array (
		// ":idContest" => $concurso->id_contest
		// )
		// ) );
		
		$rubros = WrkPicsCalificaciones::model ()->findAll ( array (
				'condition' => 'id_juez=:idJuez AND id_pic=:idPic',
				'params' => array (
						':idJuez' => $idJuez,
						':idPic' => $photoCalificar->id_pic 
				) 
		) );
		
		$photoCalificar->id_category = $rubros [0]->id_categoria_propuesta;
		$photoCalificar->b_mencion = $rubros [0]->b_mencion;
		
		// Vista
		$this->render ( 'photoScore', array (
				"photoCalificar" => $photoCalificar,
				"categoriasList" => $categoriasList,
				"rubros" => $rubros,
				't' => $t,
				'idCategoria' => $idCategoria 
		) );
	}
	
	/**
	 * Calificamos fotos por categoria seleccionada
	 *
	 * @param Integer $idCategoria        	
	 */
	public function actionPhotoReview($idCategoria = null, $t = null) {
		$this->layout = "column3";
		
		// Scripts y css
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"c_select2",
				"c_asPieProgress",
				"c_pie_progress",
				"c_asRange",
				"c_icheck",
				"c_advanced",
				"c_geek" 
		), "css" );
		
		$cargarScripts->getScripts ( array (
				"j_select2",
				"j_jquery_placeholder",
				"j_select2_components",
				"j_jquery_placeholder_components",
				"j_jquery_asPieProgress",
				"j_aspieprogress",
				"j_pie_progress",
				"j_jquery_asRange",
				"j_icheck_min",
				"j_icheck",
				"j_jquery_knob",
				"j_components_jquery_knob" 
		), 
				// "j_dgom_panels_juez",
				// "j_dgom_photo_juez"
				"js" );
		
		$concurso = $this->existeConcurso ( $t );
		
		$idJuez = Yii::app ()->user->juezLogueado->id_juez;
		
		$categoria = Categoiries::model ()->find ( array (
				"condition" => "txt_token_category=:t AND id_contest=:idConcurso",
				"params" => array (
						":t" => $idCategoria,
						":idConcurso" => $concurso->id_contest 
				) 
		) );
		
		$photoCalificar = $this->searchPicCal ( $idJuez, $categoria->id_category );
		
		// Si no hay foto a calificar
		if (empty ( $photoCalificar )) {
			$this->redirect ( array (
					"judgingPanel/index",
					"t" => $t 
			) );
		}
		
		// Cargamos categorias
		$criteriaCategorias = new CDbCriteria ();
		$criteriaCategorias->condition = 'id_contest=1 AND id_category NOT IN (:idPic)';
		$criteriaCategorias->params = array (
				':idPic' => $photoCalificar->id_category_original 
		);
		
		$categorias = Categoiries::model ()->findAll ( $criteriaCategorias );
		$categoriasList = CHtml::listData ( $categorias, "id_category", "txt_name" );
		// Cargamos rubros
		
		$rubros = WrkPicsCalificaciones::model ()->findAll ( array (
				'condition' => 'id_juez=:idJuez AND id_pic=:idPic',
				'params' => array (
						':idJuez' => $idJuez,
						':idPic' => $photoCalificar->id_pic 
				) 
		) );
		
		// Busca si el dueño de la fotografía compro con feedback
		$hasFeedback = ViewUsuarioPicsProductos::model ()->find ( array (
				'condition' => 'id_pic=:idPic AND num_addons>0',
				'params' => array (
						':idPic' => $photoCalificar->id_pic 
				) 
		) );
		
		if (empty ( $rubros )) {
			$rubros = CatCalificacionesRubros::model ()->findAll ( array (
					"condition" => "b_habilitado=1 AND id_contest=:idContest",
					"params" => array (
							":idContest" => $concurso->id_contest 
					) 
			) );
			
			// Vista
			$this->render ( 'photoReview', array (
					"photoCalificar" => $photoCalificar,
					"categoriasList" => $categoriasList,
					"rubros" => $rubros,
					't' => $t,
					'idCategoria' => $idCategoria,
					'hasFeedback' => $hasFeedback 
			) );
			
			return;
		} else {
			$this->redirect ( array (
					"judgingPanel/feedback",
					"idPhoto" => $photoCalificar->txt_pic_number,
					't' => $t,
					'idCategory' => $idCategoria 
			) );
		}
		
		// // Vista
		// $this->render ( 'photoScore', array (
		// "photoCalificar" => $photoCalificar,
		// "categoriasList" => $categoriasList,
		// "rubros" => $rubros,
		// 't' => $t,
		// 'idCategoria' => $idCategoria,
		// 'hasFeedback' => $hasFeedback
		// ) );
	}
	
	/**
	 *
	 * @param string $idPhoto        	
	 */
	public function actionFeedback($idPhoto = null, $t = null, $idCategory = null) {
		$this->layout = "column3";
		$idJuez = Yii::app ()->user->juezLogueado->id_juez;
		
		// Scripts y css
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"c_select2",
				"c_asPieProgress",
				"c_pie_progress",
				"c_asRange",
				"c_icheck",
				"c_advanced",
				"c_geek" 
		), "css" );
		
		$cargarScripts->getScripts ( array (
				"j_select2",
				"j_jquery_placeholder",
				"j_select2_components",
				"j_jquery_placeholder_components",
				"j_jquery_asPieProgress",
				"j_aspieprogress",
				"j_pie_progress",
				"j_jquery_asRange",
				"j_icheck_min",
				"j_icheck",
				"j_jquery_knob",
				"j_components_jquery_knob" 
		), 
				// "j_dgom_panels_juez",
				// "j_dgom_photo_juez"
				"js" );
		
		$concurso = $this->existeConcurso ( $t );
		
		$categoria = Categoiries::model ()->find ( array (
				"condition" => "txt_token_category=:t AND id_contest=:idConcurso",
				"params" => array (
						":t" => $idCategory,
						":idConcurso" => $concurso->id_contest 
				) 
		) );
		
		$photoCalificar = $this->searchPicCalById ( $idPhoto, $idJuez, $categoria->id_category );
		
		// Si no hay foto a calificar
		if (empty ( $photoCalificar )) {
			
			$this->redirect ( array (
					'judgingPanel/photoReview',
					'idCategoria' => $idCategory,
					't' => $t 
			) );
		}
		
		$idJuez = Yii::app ()->user->juezLogueado->id_juez;
		$calificaciones = WrkPicsCalificaciones::model ()->findAll ( array (
				'condition' => 'id_pic=:idPic AND id_juez=:idJuez AND id_contest=1',
				'params' => array (
						':idPic' => $photoCalificar->id_pic,
						':idJuez' => $idJuez 
				) 
		) );
		
		// Si vienen datos por POST asignamos
		if (isset ( $_POST ["txt_retro"] )) {
			
			$retro = nl2br ( $_POST ["txt_retro"] );
			
			// Guardamos las calificaciones
			foreach ( $calificaciones as $calificacion ) {
				$calificacion->txt_retro = $retro;
				
				// $calificacion->id_categoria_propuesta;
				// return;
				$calificacion->save ();
			}
			
			$cJ = new WrkPicsJuezCal ();
			$cJ->id_contest = $photoCalificar->id_contest;
			$cJ->id_juez = $idJuez;
			$cJ->id_pic = $photoCalificar->id_pic;
			$cJ->id_status_calificacion = 2;
			$cJ->id_usuario = $photoCalificar->ID;
			$cJ->save ();
			
			$this->redirect ( array (
					"judgingPanel/photoReview",
					"idCategoria" => $idCategory,
					't' => $t 
			) );
		}
		
		$this->render ( 'feedback', array (
				'photoCalificar' => $photoCalificar,
				't' => $t,
				'idCategoria' => $idCategory 
		) );
	}
	
	/**
	 * action para Tie breaker round
	 */
	public function actionTieBreakerRound() {
		$this->layout = "column5";
		$this->title = "Dashboard3";
		
		$idJuez = Yii::app ()->user->juezLogueado->id_juez;
		
		$existEmpate = Yii::app()->db->createCommand()
		->from('2gom_view_calificacion_final')
		->where('b_empate=1
AND id_pic NOT IN (SELECT id_pic FROM 2gom_con_calificaciones_desempate WHERE id_juez=:idJuez)', array(':idJuez'=>$idJuez))
		->queryAll();
		
		if(count($existEmpate)==0){
			
			$this->render('categoriaFinalizada');
			return;
		}
		
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"c_geek" 
		), "css" );
		
		$categorias = Categoiries::model ()->findAll ( 'id_contest=1' );
		$this->render ( 'tieBreakerPanel', array (
				"categorias" => $categorias 
		) );
	}
	
	/**
	 * Action que se muestra cuando una categoria esta finalizada
	 */
	public function actionCategoriaFinalizada() {
		$idJuez = Yii::app ()->user->juezLogueado->id_juez;
		$this->layout = "column5";
		$this->title = "Trabajo terminado";
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"c_geek" 
		), "css" );
		
		if (Configuracion::TIE_BREAKER) {
			
			$this->redirect ( array (
					"tieBreakerRound" 
			) );
		} else {
			$this->layout = "column5";
			$this->render ( "categoriaFinalizada" );
			return;
		}
	}
	
	/**
	 * Action para ver las fotos de una categoria en especifico
	 *
	 * @param Integer $id        	
	 */
	public function actionViewPhotosCategory($id) {
		$this->layout = "column5";
		$this->title = "Dashboard4";
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"c_geek" 
		), "css" );
		$this->render ( 'viewPhotosCategory' );
	}
	
	/**
	 * Verificamos si el juez ya finalizo su trabajo
	 *
	 * @param Integer $idJuez        	
	 */
	public function isJuezCompleted($idJuez, $idConcurso) {
		$porcentajeJuez = ViewPorcentajeJuez::model ()->find ( array (
				"condition" => "id_juez=:idJuez AND id_contest=:idConcurso",
				"params" => array (
						":idJuez" => $idJuez,
						":idConcurso" => $idConcurso 
				) 
		) );
		
		if ($porcentajeJuez->num_total == 100) {
			$this->layout = "column5";
			$this->redirect ( array (
					"judgingPanel/categoriaFinalizada" 
			) );
			exit ();
		}
	}
	
	/**
	 * Vista que muestra las fotografias para desempate
	 */
	public function actionBreakerRoundByCategory($id) {
		$this->layout = "column12";
		$this->title = "Breaker Round";
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"c_asPieProgress",
				"c_pie_progress",
				"c_geek" 
		), "css" );
		
		$cargarScripts->getScripts ( array (
				"j_jquery_asPieProgress",
				"j_aspieprogress",
				"j_pie_progress",
				"j_raty" 
		), "js" );
		
		$categoria = Categoiries::model ()->find ( array (
				"condition" => "b_enabled=1 AND id_category=:idCategory",
				"params" => array (
						":idCategory" => $id 
				),
				"order" => "txt_name" 
		) );
		
		$numeroLugares = 3;
		$idJuez = Yii::app ()->user->juezLogueado->id_juez;
		// $criteria = new CDbCriteria ();
		// $criteria->alias = "CP";
		// $criteria->condition = "CP.id_category=:idCategory AND CP.b_calificada=1 AND
		// CP.num_calificacion IN (SELECT num_calificacion
		// FROM 2gom_view_calificacion_by_pic
		// WHERE id_category = :idCategory
		// GROUP BY num_calificacion
		// HAVING COUNT(*) > 1)";
		// $criteria->params = array (
		// ":idCategory" => $categoria->id_category
		// );
		// $criteria->join = "JOIN (SELECT distinct num_calificacion score3 FROM 2gom_view_calificacion_by_pic WHERE id_category=:idCategory AND
		// b_calificada=1 ORDER BY num_calificacion DESC
		// LIMIT ".$numeroLugares." ) x
		// ON CP.num_calificacion = x.score3";
		// $criteria->order = "CP.num_calificacion DESC";
		
		$c = new CDbCriteria ();
		$c->alias = 'CF';
		$c->condition = 'CF.id_category =:idCategoria  AND CF.b_empate = 1 AND CF.b_calificada_desempate=0 AND CF.id_pic NOT IN (SELECT id_pic FROM 2gom_con_calificaciones_desempate WHERE id_juez=:idJuez)';
		$c->join = 'INNER JOIN (SELECT DISTINCT F.num_calificacion
						FROM 2gom_view_calificacion_final F
						WHERE F.id_category=:idCategoria
						order by F.num_calificacion DESC
						LIMIT 10
						) AS W ON W.num_calificacion = CF.num_calificacion';
		$c->params = array (
				':idCategoria' => $categoria->id_category,
				':idJuez' => $idJuez 
		);
		$c->order = 'CF.num_calificacion DESC, CF.b_calificada_desempate DESC';
		
		$lugares = ViewCalificacionFinal::model ()->findAll ( $c );
		
		// Contamos cuantos valores hay
		$valoresEmpatados = array ();
		foreach ( $lugares as $lugar ) {
			$valoresEmpatados [] = $lugar->num_calificacion;
		}
		
		$countCalificaciones = array_count_values ( $valoresEmpatados );
		
		$lugaresCategoria = Yii::app ()->db->createCommand ()->selectDistinct ( 'F.num_calificacion' )
		->from ( '2gom_view_calificacion_final F' )
		->where ( 'F.id_category=:idCategoria', array (':idCategoria' => $id 
		) )->order('F.num_calificacion DESC')->limit(10)->queryAll ();
		
		$this->render ( 'breakerRoundByCategory', array (
				"lugares" => $lugares,
				"categoria" => $categoria,
				"countCalificaciones" => $countCalificaciones,
				'lugaresCategoria'=>$lugaresCategoria,
		) );
	}
	
	/**
	 * Action para desempatar fotos calificando con estrellas
	 */
	public function actionDesempate() {
		$idJuez = Yii::app ()->user->juezLogueado->id_juez;
		if (isset ( $_POST ["CalificacionesDesempate"] )) {
			$calificaciones = $_POST ["CalificacionesDesempate"];
			$calificacionesGuardar = array ();
			$validar = true;
			
			foreach ( $calificaciones as $calificacion ) {
				$model = new CalificacionesDesempate ();
				
				$model->attributes = $calificacion;
				$model->id_juez = $idJuez;
				
				/**
				 *
				 * @todo poner el concurso actual
				 */
				$model->id_contest = 1;
				
				$isPicCalificada = CalificacionesDesempate::model ()->find ( array (
						"condition" => "id_pic=:idPic AND id_juez=:idJuez",
						"params" => array (
								":idPic" => $model->id_pic,
								":idJuez" => $idJuez 
						) 
				) );
				if (empty ( $isPicCalificada )) {
					if ($model->validate ()) {
						$calificacionesGuardar [] = $model;
					} else {
						$validar = false;
						$calificacionesGuardar = array ();
						break;
					}
				} else {
					
					echo "error";
					$validar = false;
					break;
				}
			}
			
			if (! $validar) {
				echo "error";
				return;
			}
			
			if (count ( $calificacionesGuardar ) > 0) {
				
				foreach ( $calificacionesGuardar as $calificacionGuardar ) {
					
					$calificacionGuardar->save ();
				}
			}
			
			echo "success";
		}
	}
	public function actionVoice() {
		$this->layout = "column3";
		$this->render ( "voice" );
	}
	public function actionTest() {
		$command = Yii::app ()->db->createCommand ( 'CALL getPorcentajeAvance(1, 3, @porcentaje)' );
		
		$command->execute ();
		
		print_r ( $valueOut = Yii::app ()->db->createCommand ( "select @porcentaje as result;" )->queryScalar () );
	}
}