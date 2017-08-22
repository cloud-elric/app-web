<?php
class JudgingPanelController extends Controller
{
	public function init()
	{
		$lan = Yii::app()->session['_lang'];

		if (empty($lan)) {
			$lan = Yii::app()->language;
		}
		// Here you can add specific code for generating Menu, but the code to change the Yii's default language
		Yii::app()->language = $lan;
	}

	/**
	 *
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
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
	public function accessRules()
	{
		return array(
			array(
				'allow', // allow all users to perform 'index' and 'view' actions
				'actions' => array(
					'login'
				),
				'users' => array(
					'*'
				)
			),
			array(
				'allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array(
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
					'test',
					'concursos',
					'feedbackReview',
					'feedbackDashBoard',
					'finalistas',
					'finalistasByCategory',
					'desempateFinalistas'
				),
				'users' => array(
					'@'
				),
				'roles' => array(
					"0"
				)
			),
				// Actions para el usuario juez
			array(
				'allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions' => array(
					'admin',
					'delete'
				),
				'users' => array(
					'admin'
				)
			),
			array(
				'deny', // deny all users
				'users' => array(
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
	public function existeConcurso($t = null)
	{

		if (Yii::app()->user->getState($t . "concurso")) {
			$concurso = Yii::app()->user->getState($t . "concurso");
			//Yii::app ()->user->setState ( "concursante", $usuario);

		}
		else {
			// Obtenemos el concurso a cual prentende ingresar el juez
			$concurso = ConContests::buscarPorToken($t);

			Yii::app()->user->setState($t . "concurso", $concurso);
		}
		
		
		// Si no existe el concurso lo mandamos a la pantalla con error 404
		if (empty($concurso)) {
			throw new CHttpException(404, 'La pagina solicitada no existe');
			return;
		}

		return $concurso;
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 * Action para ver el dashboard del juez
	 */
	public function actionIndex($t = '3c391e5c9feec1f95282a36bdd5d41ba')
	{


		// Obtenemos el id del juez
		$idJuez = Yii::app()->user->juezLogueado->id_juez;
		
		// Revisa si existe y obtenemos el concurso
		$concurso = $this->existeConcurso($t);
		
		// Revisa si el juez pertenece al concurso
		$isJuez = JueRelJuecesContests::model()->find(array(
			"condition" => "id_juez=:idJuez AND id_contests=:idContest",
			"params" => array(
				":idJuez" => $idJuez,
				":idContest" => $concurso->id_contest
			)
		));
		
		// Revisa si el juez finalizo su trabajo
		$this->isJuezCompleted($idJuez, $concurso->id_contest, $t);
		
		// Obtenemos el avance del juez
		$avance = ViewAvanceTotalJuez::model()->findAll(array(
			"condition" => "id_juez=:idJuez AND id_contest=:idContest",
			"params" => array(
				":idJuez" => $idJuez,
				":idContest" => $concurso->id_contest
			)
		));



		$this->layout = "column5";

		$cargarScripts = new CargarScripts();
		$cargarScripts->getScripts(array(
			"c_geek"
		), "css");

		$this->render('index', array(
			'avance' => $avance,
			't' => $t
		));
		// 'avance'=>$avance

	}

	/**
	 * Pinta todas las fotos
	 */
	public function actionPhotoViewer()
	{
		$modelPhoto = ViewFotosData::model()->findAll();

		$this->render('photoViewer', array(
			'modelPhoto' => $modelPhoto
		));
	}

	/**
	 * Busca la fotografia que no haya calificado el juez
	 *
	 * @param unknown $idJuez        	
	 * @param unknown $idCategoria        	
	 * @param number $concurso        	
	 */
	private function searchPicCal($idJuez, $idCategoria, $concurso = 1)
	{
		
		// Condiciones de busqueda
		$criteria = new CDbCriteria();
		$criteria->alias = "P";
		$criteria->condition = "P.id_category_original =:idCategoria AND
								P.id_pic NOT IN(SELECT PC.id_pic FROM 2gom_wrk_pics_calificaciones PC INNER JOIN 2gom_wrk_pics_juez_cal C on C.id_juez = PC.id_juez AND C.id_pic = PC.id_pic AND C.id_contest = PC.id_contest 
								WHERE PC.id_pic =P.id_pic AND PC.id_juez=:idJuez AND PC.id_contest=:idContest) 
								AND P.b_status=2";
		$criteria->order = 'RAND()';
		$criteria->params = array(
			":idJuez" => $idJuez,
			":idCategoria" => $idCategoria,
			":idContest" => $concurso
		);

		$photoCalificar = WrkPics::model()->find($criteria);

		return $photoCalificar;
	}

	/**
	 * Busca la fotografia que no haya calificado el juez
	 *
	 * @param unknown $idJuez        	
	 * @param unknown $idCategoria        	
	 * @param number $concurso        	
	 */
	private function searchPicCalById($idPic, $idJuez, $idCategoria, $concurso = 1)
	{
		// Condiciones de busqueda
		$criteria = new CDbCriteria();
		$criteria->alias = "P";
		$criteria->condition = "P.id_category_original =:idCategoria  AND P.txt_pic_number = :idPic AND
								P.id_pic IN(SELECT id_pic FROM 2gom_wrk_pics_calificaciones WHERE id_pic =P.id_pic AND id_juez=:idJuez AND id_contest=:idContest AND txt_retro IS NULL) AND P.b_status=2";
		$criteria->params = array(
			":idJuez" => $idJuez,
			":idCategoria" => $idCategoria,
			":idContest" => $concurso,
			':idPic' => $idPic
		);

		$photoCalificar = WrkPics::model()->find($criteria);

		return $photoCalificar;
	}

	/**
	 * Busca la fotografia que no haya calificado el juez
	 *
	 * @param unknown $idJuez
	 * @param unknown $idCategoria
	 * @param number $concurso
	 */
	private function searchPicCalById2($idPic, $idJuez, $idCategoria, $concurso = 1)
	{

		$photoCalificar = WrkPics::model()->find(array(
			'condition' => 'txt_pic_number=:idPic and id_category_original=:idCategoria and id_contest=:idContest and b_status=:tipoStatus',
			'params' => array(
				":idCategoria" => $idCategoria,
				":idContest" => $concurso,
				':idPic' => $idPic,
				':tipoStatus' => 2
			)
		));

		return $photoCalificar;
	}

	private function searchPicCalById3($idPic, $idJuez, $idCategoria, $concurso = 1)
	{

		$photoCalificar = WrkPics::model()->find(array(
			'condition' => 'id_pic=:idPic and id_category_original=:idCategoria and id_contest=:idContest and b_status=:tipoStatus',
			'params' => array(
				":idCategoria" => $idCategoria,
				":idContest" => $concurso,
				':idPic' => $idPic,
				':tipoStatus' => 2
			)
		));

		return $photoCalificar;
	}

	/**
	 * Guarda la calificacion
	 */
	public function actionSaveCal($idCategoria = null, $t = null, $idPic = null)
	{
		$concurso = $this->existeConcurso($t);

		$idJuez = Yii::app()->user->juezLogueado->id_juez;

		$categoria = Categoiries::model()->find(array(
			"condition" => "txt_token_category=:t AND id_contest=:idConcurso",
			"params" => array(
				":t" => $idCategoria,
				":idConcurso" => $concurso->id_contest
			)
		));
		
		//$photoCalificar = $this->searchPicCal ( $idJuez, $categoria->id_category, $concurso->id_contest);
		$photoCalificar = $this->searchPicCalById2($idPic, $idJuez, $categoria->id_category, $concurso->id_contest);
		
		// Si no hay foto a calificar
		if (empty($photoCalificar)) {
			$this->redirect(array(
				"judgingPanel/index",
				"t" => $t
			));
		}
		
		// Cargamos categorias
		$criteriaCategorias = new CDbCriteria();
		$criteriaCategorias->condition = 'id_contest=1 AND id_category NOT IN (:idPic)';
		$criteriaCategorias->params = array(
			':idPic' => $photoCalificar->id_category_original
		);

		$categorias = Categoiries::model()->findAll($criteriaCategorias);
		$categoriasList = CHtml::listData($categorias, "id_category", "txt_name");
		// Cargamos rubros
		$rubros = CatCalificacionesRubros::model()->findAll(array(
			"condition" => "b_habilitado=1 AND id_contest=:idContest",
			"params" => array(
				":idContest" => $concurso->id_contest
			)
		));
		
		// Si vienen datos por POST asignamos
		if (isset($_POST["WrkPics"])) {

			$wrkPicsCalificaciones = WrkPicsCalificaciones::model()->findAll(array(
				'condition' => 'id_contest=1 AND id_juez=:idJuez AND id_pic=:idPic',
				'params' => array(
					':idJuez' => $idJuez,
					':idPic' => $photoCalificar->id_pic
				)
			));

			$categoria = $photoCalificar->id_category;
			$photoCalificar->attributes = $_POST["WrkPics"];
			$photoCalificar->WrkPicsCalificaciones = $_POST["WrkPics"]["WrkPicsCalificaciones"];
			$bMencion = 0;
			$retro = NULL;
			$categoriaPropuesta = NULL;
			
			// Es mencion
			if (isset($_POST["b_mencion"])) {
				$bMencion = $_POST["b_mencion"];
			}

			$photoWrk = WrkPics::model()->find(array(
				'condition' => 'id_pic=:idPic and id_contest=:idContest and b_status=:tipoStatus',
				'params' => array(

					":idContest" => $concurso->id_contest,
					':idPic' => $photoCalificar->id_pic,
					':tipoStatus' => 2
				)
			));

			if (!$photoWrk->b_mencion) {
				$photoWrk->b_mencion = $bMencion;
			}
			$photoWrk->save();
			
			// Suguieren otra categoria
			if (empty($photoCalificar->id_category)) {
				$photoCalificar->id_category = NULL;
			}
			
			// Guardamos las calificaciones
			foreach ($photoCalificar->WrkPicsCalificaciones as $key => $value) {

				$calificacion = new WrkPicsCalificaciones();
				$calificacion->id_juez = $idJuez;
				$calificacion->id_pic = $photoCalificar->id_pic;
				$calificacion->txt_retro = $retro;
				$calificacion->id_contest = $concurso->id_contest;

				foreach ($wrkPicsCalificaciones as $wrkCalificacion) {
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
				$calificacion->save();
			}




			$cJ = new WrkPicsJuezCal();
			$cJ->id_contest = $photoCalificar->id_contest;
			$cJ->id_juez = $idJuez;
			$cJ->id_pic = $photoCalificar->id_pic;
			$cJ->id_status_calificacion = 2;
			$cJ->id_usuario = $photoCalificar->ID;
			$cJ->save();

		}
		
		// Vista
		$this->redirect(array(
			'judgingPanel/photoReview',
			'idCategoria' => $idCategoria,
			't' => $t
		));
	}

	/**
	 * Pintamos el score de la pic
	 *
	 * @param unknown $idPic        	
	 */
	public function actionViewScorePhoto($idPic, $idCategoria, $t)
	{
		$this->layout = "column3";
		
		// Scripts y css
		$cargarScripts = new CargarScripts();
		$cargarScripts->getScripts(array(
			"c_select2",
			"c_asPieProgress",
			"c_pie_progress",
			"c_asRange",
			"c_icheck",
			"c_advanced",
			"c_geek"
		), "css");

		$cargarScripts->getScripts(
			array(
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
			"js"
		);

		$concurso = $this->existeConcurso($t);

		$idJuez = Yii::app()->user->juezLogueado->id_juez;

		$categoria = Categoiries::model()->find(array(
			"condition" => "txt_token_category=:t AND id_contest=:idConcurso",
			"params" => array(
				":t" => $idCategoria,
				":idConcurso" => $concurso->id_contest
			)
		));

		$photoCalificar = $this->searchPicCalById($idPic, $idJuez, $categoria->id_category);
		
		// Si no hay foto a calificar
		if (empty($photoCalificar)) {
			$this->redirect(array(
				"judgingPanel/index",
				"t" => $t
			));
		}
		
		// Cargamos categorias
		$criteriaCategorias = new CDbCriteria();
		$criteriaCategorias->condition = 'id_contest=:idCon AND id_category NOT IN (:idPic)';
		$criteriaCategorias->params = array(
			':idPic' => $photoCalificar->id_category_original,
			'idCon' => $concurso->id_contest
		);

		$categorias = Categoiries::model()->findAll($criteriaCategorias);
		$categoriasList = CHtml::listData($categorias, "id_category", "txt_name");
		// Cargamos rubros
		// $rubros = CatCalificacionesRubros::model ()->findAll ( array (
		// "condition" => "b_habilitado=1 AND id_contest=:idContest",
		// "params" => array (
		// ":idContest" => $concurso->id_contest
		// )
		// ) );

		$rubros = WrkPicsCalificaciones::model()->findAll(array(
			'condition' => 'id_juez=:idJuez AND id_pic=:idPic',
			'params' => array(
				':idJuez' => $idJuez,
				':idPic' => $photoCalificar->id_pic
			)
		));

		$photoCalificar->id_category = $rubros[0]->id_categoria_propuesta;
		$photoCalificar->b_mencion = $rubros[0]->b_mencion;
		
		// Vista
		$this->render('photoScore', array(
			"photoCalificar" => $photoCalificar,
			"categoriasList" => $categoriasList,
			"rubros" => $rubros,
			't' => $t,
			'idCategoria' => $idCategoria
		));
	}

	/**
	 * Calificamos fotos por categoria seleccionada
	 *
	 * @param Integer $idCategoria        	
	 */
	public function actionPhotoReview($idCategoria = null, $t = null)
	{
		$this->layout = "column3";
		
		// Scripts y css
		$cargarScripts = new CargarScripts();
		$cargarScripts->getScripts(array(
			"c_select2",
			"c_asPieProgress",
			"c_pie_progress",
			"c_asRange",
			"c_icheck",
			"c_advanced",
			"c_geek"
		), "css");

		$cargarScripts->getScripts(
			array(
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
			"js"
		);

		$concurso = $this->existeConcurso($t);

		$idJuez = Yii::app()->user->juezLogueado->id_juez;

		$categoria = Categoiries::model()->find(array(
			"condition" => "txt_token_category=:t AND id_contest=:idConcurso",
			"params" => array(
				":t" => $idCategoria,
				":idConcurso" => $concurso->id_contest
			)
		));

		$photoCalificar = $this->searchPicCal($idJuez, $categoria->id_category, $concurso->id_contest);

		
		// Si no hay foto a calificar
		if (empty($photoCalificar)) {
			$this->redirect(array(
				"judgingPanel/index",
				"t" => $t
			));

			return;
		}
		
		// Cargamos categorias
		$criteriaCategorias = new CDbCriteria();
		$criteriaCategorias->condition = 'id_contest=:idConcurso AND id_category NOT IN (:idPic)';
		$criteriaCategorias->params = array(
			':idPic' => $photoCalificar->id_category_original,
			":idConcurso" => $concurso->id_contest
		);

		$categorias = Categoiries::model()->findAll($criteriaCategorias);
		$categoriasList = CHtml::listData($categorias, "id_category", "txt_name");
		// Cargamos rubros



		$relJuezCat = false;
		
		// Busca si el dueño de la fotografía compro con feedback
		// $hasFeedback = ViewUsuarioPicsProductos::model ()->find ( array (
		// 		'condition' => 'id_pic=:idPic AND num_addons>0',
		// 		'params' => array (
		// 				':idPic' => $photoCalificar->id_pic 
		// 		) 
		// ) );

		$hasFeedback = false;


		$rubros = CatCalificacionesRubros::model()->findAll(array(
			"condition" => "b_habilitado=1 AND id_contest=:idContest",
			"params" => array(
				":idContest" => $concurso->id_contest
			)
		));
			
			// Vista
		$this->render('photoReview', array(
			"photoCalificar" => $photoCalificar,
			"categoriasList" => $categoriasList,
			"rubros" => $rubros,
			't' => $t,
			'idCategoria' => $idCategoria,
			'hasFeedback' => $hasFeedback,
			'concurso' => $concurso,
			'relJuezCat' => $relJuezCat
		));

		return;
	

		// if(!empty ( $rubros ) && $relJuezCat){
		// 	$this->redirect ( array (
		// 			"judgingPanel/feedback",
		// 			"idPhoto" => $photoCalificar->txt_pic_number,
		// 			't' => $t,
		// 			'idCategory' => $idCategoria,
		// 			'idContest' => $concurso->id_contest
		// 	) );
		// }

	}



	public function actionFeedbackReview($idCategoria = null, $t = null)
	{
		$this->layout = "column3";
		
		// Scripts y css
		$cargarScripts = new CargarScripts();
		$cargarScripts->getScripts(array(
			"c_select2",
			"c_asPieProgress",
			"c_pie_progress",
			"c_asRange",
			"c_icheck",
			"c_advanced",
			"c_geek"
		), "css");

		$cargarScripts->getScripts(
			array(
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
			"js"
		);

		$concurso = $this->existeConcurso($t);

		$idJuez = Yii::app()->user->juezLogueado->id_juez;

		$categoria = Categoiries::model()->find(array(
			"condition" => "txt_token_category=:t AND id_contest=:idConcurso",
			"params" => array(
				":t" => $idCategoria,
				":idConcurso" => $concurso->id_contest
			)
		));

		// Buscar una de las fotos que me tocan
		$photoFeedBackCalificar = $this->searchPicRetro($categoria->id_category, $concurso->id_contest, $idJuez);

		// Si no hay foto a calificar
		if (empty($photoFeedBackCalificar)) {

			$this->redirect(array(
				'judgingPanel/feedbackDashBoard',

				't' => $t
			));
		}

		$photoCalificar = $this->searchPicCalById3($photoFeedBackCalificar->id_pic, $idJuez, $categoria->id_category, $concurso->id_contest);

		// Si vienen datos por POST asignamos
		if (isset($_POST["txt_retro"])) {

			$retro = nl2br($_POST["txt_retro"]);

			$calificaciones = WrkPicsCalificaciones::model()->findAll(array(
				'condition' => 'id_pic=:idPic AND id_juez=:idJuez AND id_contest=1',
				'params' => array(
					':idPic' => $photoCalificar->id_pic,
					':idJuez' => $idJuez
				)
			));


			// Guardamos las calificaciones
			foreach ($calificaciones as $calificacion) {
				$calificacion->txt_retro = $retro;
				
				// $calificacion->id_categoria_propuesta;
				// return;
				$calificacion->save();
			}

			$cJ = new WrkPicsJuezCal();
			$cJ->id_contest = $photoCalificar->id_contest;
			$cJ->id_juez = $idJuez;
			$cJ->id_pic = $photoCalificar->id_pic;
			$cJ->id_status_calificacion = 2;
			$cJ->id_usuario = $photoCalificar->ID;
			$cJ->save();

			$guardarFeedback = PicsJuecesRetro::model()->find(array(
				'condition' => 'id_contest=:idContest AND id_pic =:idPic AND id_juez=:idJuez AND id_category=:idCategory',
				'params' => array(
					':idContest' => $concurso->id_contest,
					':idPic' => $photoFeedBackCalificar->id_pic,
					':idJuez' => $idJuez,
					':idCategory' => $categoria->id_category
				)
			));

			$guardarFeedback->b_calificada = 1;
			$guardarFeedback->save();

			$this->redirect(array(
				"judgingPanel/feedBackReview",
				'idCategoria' => $categoria->id_category,
				't' => $t
			));
		}

		$this->render('feedback', array(
			'photoCalificar' => $photoCalificar,
			't' => $t,
			'idCategoria' => $categoria->txt_token_category,
		));
	}

	private function searchPicRetro($idCategoria, $concurso = 1, $idJuez)
	{
		
		// Condiciones de busqueda
		$criteria = new CDbCriteria();

		$criteria->condition = "id_contest=:idContest AND id_category=:idCategoria AND id_juez=:idJuez AND b_calificada=0";
		$criteria->order = 'RAND()';
		$criteria->params = array(
			":idContest" => $concurso,
			":idCategoria" => $idCategoria,
			':idJuez' => $idJuez

		);

		$photoCalificar = PicsJuecesRetro::model()->find($criteria);

		return $photoCalificar;
	}
	/**
	 *
	 * @param string $idPhoto        	
	 */
	public function actionFeedback($idPhoto = null, $t = null, $idCategory = null, $idContest = null)
	{
		$this->layout = "column3";
		$idJuez = Yii::app()->user->juezLogueado->id_juez;
		
		// Scripts y css
		$cargarScripts = new CargarScripts();
		$cargarScripts->getScripts(array(
			"c_select2",
			"c_asPieProgress",
			"c_pie_progress",
			"c_asRange",
			"c_icheck",
			"c_advanced",
			"c_geek"
		), "css");

		$cargarScripts->getScripts(
			array(
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
			"js"
		);

		$concurso = $this->existeConcurso($t);

		$categoria = Categoiries::model()->find(array(
			"condition" => "txt_token_category=:t AND id_contest=:idConcurso",
			"params" => array(
				":t" => $idCategory,
				":idConcurso" => $concurso->id_contest
			)
		));
		$categoria->id_category;
		//$photoCalificar = $this->searchPicCalById($idPhoto, $idJuez, $categoria->id_category );
		$photoCalificar = $this->searchPicCalById3($idPhoto, $idJuez, $categoria->id_category, $concurso->id_contest);
		
		// Si no hay foto a calificar
		if (empty($photoCalificar)) {

			$this->redirect(array(
				'judgingPanel/photoReview',
				'idCategoria' => $idCategory,
				't' => $t
			));
		}

		$idJuez = Yii::app()->user->juezLogueado->id_juez;
		$calificaciones = WrkPicsCalificaciones::model()->findAll(array(
			'condition' => 'id_pic=:idPic AND id_juez=:idJuez AND id_contest=1',
			'params' => array(
				':idPic' => $photoCalificar->id_pic,
				':idJuez' => $idJuez
			)
		));



		if (isset($_POST["txt_retro"])) {

			$retro = nl2br($_POST["txt_retro"]);

			$calificaciones = WrkPicsCalificaciones::model()->findAll(array(
				'condition' => 'id_pic=:idPic AND id_juez=:idJuez AND id_contest=:idContest',
				'params' => array(
					':idPic' => $photoCalificar->id_pic,
					':idJuez' => $idJuez,
					':idContest' => $concurso->id_contest
				)
			));


			// Guardamos las calificaciones
			foreach ($calificaciones as $calificacion) {
				$calificacion->txt_retro = $retro;
				
				// $calificacion->id_categoria_propuesta;
				// return;
				$calificacion->save();
			}

			$cJ = new WrkPicsJuezCal();
			$cJ->id_contest = $photoCalificar->id_contest;
			$cJ->id_juez = $idJuez;
			$cJ->id_pic = $photoCalificar->id_pic;
			$cJ->id_status_calificacion = 2;
			$cJ->id_usuario = $photoCalificar->ID;
			$cJ->save();

			$guardarFeedback = PicsJuecesRetro::model()->find(array(
				'condition' => 'id_contest=:idContest AND id_pic =:idPic AND id_juez=:idJuez AND id_category=:idCategory',
				'params' => array(
					':idContest' => $concurso->id_contest,
					':idPic' => $photoCalificar->id_pic,
					':idJuez' => $idJuez,
					':idCategory' => $categoria->id_category
				)
			));

			$guardarFeedback->b_calificada = 1;
			$guardarFeedback->save();

			$this->redirect(array(
				"judgingPanel/feedBackReview",
				'idCategoria' => $categoria->txt_token_category,
				't' => $t
			));

		}

		$this->render('feedback', array(
			'photoCalificar' => $photoCalificar,
			't' => $t,
			'idCategoria' => $idCategory
		));
	}

	/**
	 * action para Tie breaker round
	 */
	public function actionTieBreakerRound($t = '')
	{
		$this->layout = "column5";
		$this->title = "Dashboard3";

		$idJuez = Yii::app()->user->juezLogueado->id_juez;
		$concurso = $this->existeConcurso($t);
		
// 		$existEmpate = Yii::app()->db->createCommand()
// 		->from('2gom_view_calificacion_final')
// 		->where('b_empate_alterno=1 and id_contest = '.$concurso->id_contest.'
// AND id_pic NOT IN (SELECT id_pic FROM 2gom_con_calificaciones_desempate WHERE id_juez=:idJuez)', array(':idJuez'=>$idJuez))

		// ->queryAll();

		if (true) {

			// $jueces = JueRelJuecesContests::model()->findAll('id_contests='.$concurso->id_contest);
			// $juecesCompletaronDesempate = true;
			// foreach($jueces as $juez){

			// 	if($juecesCompletaronDesempate){
			// 		$calificoJuez = Yii::app()->db->createCommand()
			// 		->from('2gom_view_calificacion_final')
			// 		->where('b_empate=1 and id_contest = '.$concurso->id_contest.'
			// 			AND id_pic NOT IN (SELECT id_pic FROM 2gom_con_calificaciones_desempate WHERE id_juez=:idJuez)', array(':idJuez'=>$juez->id_juez))
					
			// 		->queryAll();

			// 		if(count($calificoJuez)>0){
			// 			$juecesCompletaronDesempate = false;
			// 		}
			// 	}
			// }

			if (true) {

				$this->redirect(array('finalistas', 't' => $t));
			}
			else {
				$this->layout = "column5";
				$this->render('categoriaFinalizada');
				exit;
			}
			//$this->redirect(array('feedbackDashBoard', 't'=>$t));
			return;
		}

		$cargarScripts = new CargarScripts();
		$cargarScripts->getScripts(array(
			"c_geek"
		), "css");

		$categorias = Categoiries::model()->findAll('id_contest=' . $concurso->id_contest);
		$this->render('tieBreakerPanel', array(
			"categorias" => $categorias,
			't' => $t,
			'concurso' => $concurso

		));
	}

	public function actionFinalistas($t = '')
	{
		$this->layout = "column5";
		$this->title = "Dashboard3";

		$idJuez = Yii::app()->user->juezLogueado->id_juez;
		$concurso = $this->existeConcurso($t);

		$cargarScripts = new CargarScripts();
		$cargarScripts->getScripts(array(
			"c_geek"
		), "css");

		$categorias = Categoiries::model()->findAll('id_contest=' . $concurso->id_contest);
		foreach ($categorias as $categoria) {
			$calificadas = Yii::app()->db->createCommand()
				->from('2gom_view_calificacion_final CF')
				->leftJoin('2gom_con_calificaciones_finalistas CFF', 'CFF.id_pic = CF.id_pic')
				->where('CF.id_category = :idCategory AND CF.b_status = 2 AND CF.b_calificada = 1 AND CFF.id_juez =:idJuez', array(':idJuez' => $idJuez, ':idCategory' => $categoria->id_category))
				->queryAll();
			$isCalificadas = 0;
			if (count($calificadas) == 0) {
				$isCalificadas++;
			}
		}

		if ($isCalificadas == 0) {
			$this->redirect(array('feedbackDashBoard', 't' => $t));
		}

		$this->render('finalists', array(
			"categorias" => $categorias,
			't' => $t,
			'concurso' => $concurso

		));

	}


	public function actionFinalistasByCategory($id, $t = null)
	{
		$this->layout = "column12";
		$this->title = "Finalists Round";
		$cargarScripts = new CargarScripts();
		$cargarScripts->getScripts(array(
			"c_asPieProgress",
			"c_pie_progress",
			"c_geek"
		), "css");

		$cargarScripts->getScripts(array(
			"j_jquery_asPieProgress",
			"j_aspieprogress",
			"j_pie_progress",
			"j_raty"
		), "js");

		$categoria = Categoiries::model()->find(array(
			"condition" => "b_enabled=1 AND id_category=:idCategory",
			"params" => array(
				":idCategory" => $id
			),
			"order" => "txt_name"
		));

		$concurso = $this->existeConcurso($t);

		$numeroLugares = 10;
		$idJuez = Yii::app()->user->juezLogueado->id_juez;

		$finalistas = ViewCalificacionFinal::model()->findAll(array(
			"condition" => "b_status=2 AND b_calificada = 1 AND id_category=:idCategoria",
			"params" => array(
				":idCategoria" => $categoria->id_category
			),
			"limit" => $numeroLugares,
			"order" => "num_calificacion_nueva DESC, num_calificacion_desempate DESC",
		));

		$this->render('finalistsByCategory', array(
			"numLugares" => $numeroLugares,
			"categoria" => $categoria,
			'finalistas' => $finalistas,
			't' => $t
		));
	}

	/**
	 * Action para desempatar fotos calificando con estrellas
	 */
	public function actionDesempateFinalistas($t = null)
	{

		$idJuez = Yii::app()->user->juezLogueado->id_juez;
		if (isset($_POST["CalificacionesDesempate"])) {
			$calificaciones = $_POST["CalificacionesDesempate"];
			$calificacionesGuardar = array();
			$validar = true;

			foreach ($calificaciones as $calificacion) {
				$model = new CalificacionesFinalistas();

				$model->attributes = $calificacion;
				$model->id_juez = $idJuez;

				$concurso = $this->existeConcurso($t);
				$model->id_contest = $concurso->id_contest;

				$isPicCalificada = CalificacionesFinalistas::model()->find(array(
					"condition" => "id_pic=:idPic AND id_juez=:idJuez",
					"params" => array(
						":idPic" => $model->id_pic,
						":idJuez" => $idJuez
					)
				));
				if (empty($isPicCalificada)) {
					if ($model->validate()) {
						$calificacionesGuardar[] = $model;
					}
					else {

						$validar = false;
						$calificacionesGuardar = array();
						break;
					}
				}
				else {

					echo "error";
					$validar = false;
					break;
				}
			}

			if (!$validar) {
				echo "error";
				return;
			}

			if (count($calificacionesGuardar) > 0) {

				foreach ($calificacionesGuardar as $calificacionGuardar) {

					$calificacionGuardar->save();
				}
			}

			echo "success";
		}
	}

	/**
	 * 
	 */
	public function actionFeedbackDashBoard($t = '')
	{

		// Obtenemos el id del juez
		$idJuez = Yii::app()->user->juezLogueado->id_juez;
		
		// Revisa si existe y obtenemos el concurso
		$concurso = $this->existeConcurso($t);
		
		// Revisa si el juez pertenece al concurso
		$isJuez = JueRelJuecesContests::model()->find(array(
			"condition" => "id_juez=:idJuez AND id_contests=:idContest",
			"params" => array(
				":idJuez" => $idJuez,
				":idContest" => $concurso->id_contest
			)
		));
		
		// Revisa si el juez finalizo su trabajo
		$this->isJuezCompletedFeedback($idJuez, $concurso->id_contest);
		
			// Obtenemos el avance del juez
		$avance = ConRelJuecesCategories::model()->findAll(
			array(
				'condition' => 'id_juez=:idJuez AND id_contest=:idContest',
				'params' => array(
					':idJuez' => $idJuez,
					':idContest' => $concurso->id_contest
				)
			)
		);



		$this->layout = "column5";

		$cargarScripts = new CargarScripts();
		$cargarScripts->getScripts(array(
			"c_geek"
		), "css");

		$this->render('feedbackDashBoard', array(
			'avance' => $avance,
			't' => $t
		));

	}

	public function isJuezCompletedFeedback($idJuez, $idContest)
	{
			// Obtenemos el avance del juez
		$avance = PicsJuecesRetro::model()->findAll(
			array(
				'condition' => 'id_juez=:idJuez AND id_contest=:idContest AND b_calificada=0',
				'params' => array(':idJuez' => $idJuez, ':idContest' => $idContest)
			)
		);

		if (empty($avance)) {
			$this->layout = "column5";
			$this->render('categoriaFinalizada');
			exit;
		}

	}

	/**
	 * Action que se muestra cuando una categoria esta finalizada
	 */
	public function actionCategoriaFinalizada($token = null)
	{
		$idJuez = Yii::app()->user->juezLogueado->id_juez;
		$this->layout = "column5";
		$this->title = "Trabajo terminado";
		$cargarScripts = new CargarScripts();
		$cargarScripts->getScripts(array(
			"c_geek"
		), "css");

		$concurso = $this->existeConcurso($token);


		$picConflictos = ViewPicsCalificadas::model()->findAll(
			"b_calificada=1 AND id_contest=" . $concurso->id_contest . " AND (b_conflicto_mencion=1 OR b_conflicto_categoria=1)"
		);

		if ($picConflictos) {
			$this->layout = "column5";
			$this->render("categoriaFinalizada");
			return;
		}


		$calificacionesTerminadas = ViewAvanceTotalJuez::model()->findAll(
			array(
				'condition' => 'id_contest=:idContest',
				'params' => array(':idContest' => $concurso->id_contest)
			)
		);

		$porcentaje = 0;
		$numTotal = count($calificacionesTerminadas);

		foreach ($calificacionesTerminadas as $cal) {
			$porcentaje += $cal->num_porcentaje;
		}

		$promedio = $porcentaje / $numTotal;

		if ($promedio == 100) {

			$this->redirect(array(
				"tieBreakerRound", 't' => $token
			));
		}
		else {
			$this->layout = "column5";
			$this->render("categoriaFinalizada");
			return;
		}
	}

	/**
	 * Action para ver las fotos de una categoria en especifico
	 *
	 * @param Integer $id        	
	 */
	public function actionViewPhotosCategory($id)
	{
		$this->layout = "column5";
		$this->title = "Dashboard4";
		$cargarScripts = new CargarScripts();
		$cargarScripts->getScripts(array(
			"c_geek"
		), "css");
		$this->render('viewPhotosCategory');
	}

	/**
	 * Verificamos si el juez ya finalizo su trabajo
	 *
	 * @param Integer $idJuez        	
	 */
	public function isJuezCompleted($idJuez, $idConcurso, $t)
	{

		$juezFinalizo = false;
		if (Yii::app()->user->getState($t . "concurso-finalizo-juez")) {
			$juezFinalizo = true;
		}
		else {
			$porcentajeJuez = ViewPorcentajeJuez::model()->find(array(
				"condition" => "id_juez=:idJuez AND id_contest=:idConcurso",
				"params" => array(
					":idJuez" => $idJuez,
					":idConcurso" => $idConcurso
				)
			));

			if ($porcentajeJuez) {
				if ($porcentajeJuez->num_total == 100) {

					$juezFinalizo = true;
				}
			}
		}

		if ($juezFinalizo) {
			Yii::app()->user->setState($t . "concurso-finalizo-juez", true);

			$this->layout = "column5";
			$this->redirect(array(
				"judgingPanel/categoriaFinalizada", 'token' => $t
			));
			exit();
		}


	}

	/**
	 * Vista que muestra las fotografias para desempate
	 */
	public function actionBreakerRoundByCategory($id, $t = '')
	{
		$this->layout = "column12";
		$this->title = "Breaker Round";
		$cargarScripts = new CargarScripts();
		$cargarScripts->getScripts(array(
			"c_asPieProgress",
			"c_pie_progress",
			"c_geek"
		), "css");

		$cargarScripts->getScripts(array(
			"j_jquery_asPieProgress",
			"j_aspieprogress",
			"j_pie_progress",
			"j_raty"
		), "js");

		$categoria = Categoiries::model()->find(array(
			"condition" => "b_enabled=1 AND id_category=:idCategory",
			"params" => array(
				":idCategory" => $id
			),
			"order" => "txt_name"
		));

		$concurso = $this->existeConcurso($t);

		$numeroLugares = 3;
		$idJuez = Yii::app()->user->juezLogueado->id_juez;

		$c = new CDbCriteria();
		$c->alias = 'CF';
		$c->condition = 'CF.id_category =:idCategoria  AND CF.b_empate_alterno= 1 AND CF.b_calificada_desempate=0 AND CF.id_pic NOT IN (SELECT id_pic FROM 2gom_con_calificaciones_desempate WHERE id_juez=:idJuez) and id_contest=:idContest';
		$c->join = 'INNER JOIN (SELECT DISTINCT F.num_calificacion_nueva
						FROM 2gom_view_calificacion_final F
						WHERE F.id_category=:idCategoria
						order by F.num_calificacion_nueva DESC
						LIMIT 10
						) AS W ON W.num_calificacion_nueva = CF.num_calificacion_nueva';
		$c->params = array(
			':idCategoria' => $categoria->id_category,
			':idJuez' => $idJuez,
			':idContest' => $concurso->id_contest
		);
		$c->order = 'CF.num_calificacion_nueva DESC, CF.b_calificada_desempate DESC';

		$lugares = ViewCalificacionFinal::model()->findAll($c);
		
		// Contamos cuantos valores hay
		$valoresEmpatados = array();
		foreach ($lugares as $lugar) {
			$valoresEmpatados[] = intval($lugar->num_calificacion_nueva);
		}

		$countCalificaciones = array_count_values($valoresEmpatados);

		$lugaresCategoria = Yii::app()->db->createCommand()->selectDistinct('F.num_calificacion_nueva')
			->from('2gom_view_calificacion_final F')
			->where('F.id_category=:idCategoria', array(':idCategoria' => $id))->order('F.num_calificacion_nueva DESC')->limit(10)->queryAll();

		$this->render('breakerRoundByCategory', array(
			"lugares" => $lugares,
			"categoria" => $categoria,
			"countCalificaciones" => $countCalificaciones,
			'lugaresCategoria' => $lugaresCategoria,
			't' => $t
		));
	}

	/**
	 * Action para desempatar fotos calificando con estrellas
	 */
	public function actionDesempate($t = null)
	{
		$idJuez = Yii::app()->user->juezLogueado->id_juez;
		if (isset($_POST["CalificacionesDesempate"])) {
			$calificaciones = $_POST["CalificacionesDesempate"];
			$calificacionesGuardar = array();
			$validar = true;

			foreach ($calificaciones as $calificacion) {
				$model = new CalificacionesDesempate();

				$model->attributes = $calificacion;
				$model->id_juez = $idJuez;

				$concurso = $this->existeConcurso($t);
				$model->id_contest = $concurso->id_contest;

				$isPicCalificada = CalificacionesDesempate::model()->find(array(
					"condition" => "id_pic=:idPic AND id_juez=:idJuez",
					"params" => array(
						":idPic" => $model->id_pic,
						":idJuez" => $idJuez
					)
				));


				if (empty($isPicCalificada)) {
					if ($model->validate()) {
						$calificacionesGuardar[] = $model;
					}
					else {
						print_r($model->getErrors());
						$validar = false;
						$calificacionesGuardar = array();
						break;
					}
				}
				else {

					echo "error";
					$validar = false;
					break;
				}
			}

			if (!$validar) {
				echo "error";
				return;
			}

			if (count($calificacionesGuardar) > 0) {

				foreach ($calificacionesGuardar as $calificacionGuardar) {

					$calificacionGuardar->save();
				}
			}

			echo "success";
		}
	}

	/**
	 * 
	 */
	public function actionConcursos()
	{
		$this->layout = "column5";

		$idJuez = Yii::app()->user->juezLogueado->id_juez;

		$criteria = new CDbCriteria;
		$criteria->condition = 'id_juez=:idJuez';
		$criteria->params = array(":idJuez" => $idJuez);

		$concursosJuez = JueRelJuecesContests::model()->findAll($criteria);

		$concursos = array();

		foreach ($concursosJuez as $concursoJuez) {
			$concursos[] = $concursoJuez->id_contests;
		}

		$criteriaJ = new CDbCriteria;
		$criteriaJ->condition = 'id_status NOT IN (1, 2, 6)';
		$criteriaJ->addInCondition('id_contest', $concursos);
		$concursosJ = ConContests::model()->findAll($criteriaJ);

		$this->render('concursos', array('concursosJuez' => $concursosJ));
	}

	public function actionVoice()
	{
		$this->layout = "column3";
		$this->render("voice");
	}
	public function actionTest()
	{
		$command = Yii::app()->db->createCommand('CALL getPorcentajeAvance(1, 3, @porcentaje)');

		$command->execute();

		print_r($valueOut = Yii::app()->db->createCommand("select @porcentaje as result;")->queryScalar());
	}
}