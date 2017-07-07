<?php
class JuecesController extends Controller {
	
	public function init(){
		//Here you can add specific code for generating Menu, but the code to change the Yii's default language
		Yii::app()->language = Yii::app()->session['_lang'];
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
								'pintarFoto',
								'tieBreakerRound',
								'categoriaFinalizada',
								'viewPhotosCategory',
								'breakerRoundByCategory',
								'desempate',
								'voice' 
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
	public function actionIndex($t = null) {
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
		$this->isJuezCompleted ( $idJuez, $concurso->id_contest);
		
		// Obtenemos el avance del juez
		$avance = ViewAvanceTotalJuez::model ()->findAll ( array (
				"condition" => "id_juez=:idJuez AND id_contest=:idContest",
				"params" => array (
						":idJuez" => $idJuez,
						":idContest" => $concurso->id_contest 
				) 
		) );
		
		$this->layout = "column5";
		$this->title = "Dashboard";
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
	 * Calificamos fotos por categoria seleccionada
	 *
	 * @param Integer $idCategoria        	
	 */
	public function actionPintarFoto($idCategoria = null, $t = null) {
		$this->layout = "column3";
		$this->title = "Pintar Foto";
		
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
				"j_components_jquery_knob",
				// "j_dgom_panels_juez",
				// "j_dgom_photo_juez"
		), "js" );
		
		$concurso = $this->existeConcurso($t);
		
		$idJuez = Yii::app ()->user->juezLogueado->id_juez;
		
		$categoria = Categoiries::model ()->find ( array (
				"condition" => "txt_token_category=:t AND id_contest=:idConcurso",
				"params" => array (
						":t" => $idCategoria,
						":idConcurso"=>$concurso->id_contest
				) 
		) );
		
		// Condiciones de busqueda
		$criteria = new CDbCriteria ();
		$criteria->alias = "P";
		$criteria->condition = "P.id_category_original =:idCategoria AND 
								P.id_pic NOT IN(SELECT id_pic FROM 2gom_wrk_pics_calificaciones WHERE id_pic =P.id_pic AND id_juez=:idJuez AND id_contest=:idContest)";
		$criteria->params = array (
				":idJuez" => $idJuez,
				":idCategoria" => $categoria->id_category,
				":idContest"=>$concurso->id_contest
		);
		
		$photoCalificar = WrkPics::model ()->find ( $criteria );
		
		// Si no hay foto a calificar
		if (empty ( $photoCalificar )) {
			$this->redirect ( array("index", "t"=>$t ));
		}
		
		// Cargamos categorias
		$categorias = Categoiries::model ()->findAll ();
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
			
			// Tiene feedback
			if (isset ( $_POST ["txt_retro"] )) {
				$retro = nl2br($_POST ["txt_retro"]);
				
			}
			
			// Suguieren otra categoria
			if (empty ( $photoCalificar->id_category )) {
				$photoCalificar->id_category = NULL;
			}
			
			// Guardamos las calificaciones
			foreach ( $photoCalificar->WrkPicsCalificaciones as $key => $value ) {
				
				echo $categoriaPropuesta;
				$calificacion = new WrkPicsCalificaciones ();
				$calificacion->id_juez = $idJuez;
				$calificacion->id_pic = $photoCalificar->id_pic;
				$calificacion->id_rubro = $key;
				$calificacion->id_categoria_propuesta = $photoCalificar->id_category;
				$calificacion->num_calificacion = $value;
				$calificacion->txt_retro = $retro;
				$calificacion->b_mencion = $bMencion;
				$calificacion->id_contest = $concurso->id_contest;
				
				// $calificacion->id_categoria_propuesta;
				// return;
				$calificacion->save ();
			}
			
			$this->redirect ( array (
					"pintarFoto",
					"idCategoria" => $idCategoria,
					't' => $t
			) );
		}
		
		// Vista
		$this->render ( 'pintarFoto', array (
				"photoCalificar" => $photoCalificar,
				"categoriasList" => $categoriasList,
				"rubros" => $rubros,
				't' => $t 
		) );
	}
	/**
	 * action para Tie breaker round
	 */
	public function actionTieBreakerRound() {
		$this->layout = "column5";
		$this->title = "Dashboard3";
		
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"c_geek" 
		), "css" );
		
		$categorias = Categoiries::model ()->findAll ();
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
			
			// $categorias = Categoiries::model()->findAll();
			
			// foreach($categorias as $categoria){
			
			// $existsBreaker = Yii::app()->db->createCommand()
			// ->select('COUNT(C.num_calificacion) AS contador')
			// ->from('2gom_view_calificacion_by_pic C')
			// ->join('JOIN (SELECT distinct num_calificacion score3
			// FROM 2gom_view_calificacion_by_pic
			// WHERE id_category='.$categoria->id_category.' AND b_calificada=1
			// ORDER BY num_calificacion DESC LIMIT 3 ) x ', 'ON C.num_calificacion = x.score3')
			// ->where("C.id_category='.$categoria->id_category.' AND C.b_calificada=1 AND C.id_pic NOT IN (SELECT id_pic FROM 2gom_calificaciones_desempate WHERE id_juez=".$idJuez.")")
			// ->group("C.num_calificacion")
			// ->having("COUNT(contador)>1")
			// ->order("C.num_calificacion DESC")
			// ->queryRowAll();
			// print_r($existsBreaker);
			
			// if(count($existsBreaker>0)){
			// $this->redirect ( array (
			// "tieBreakerRound"
			// ) );
			
			// }else{
			
			// $this->render ( "categoriaFinalizada" );
			// }
			
			// }
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
						":idConcurso"=>$idConcurso
				) 
		)
		 );
		
		if ($porcentajeJuez->num_total == 100) {
			$this->layout = "column5";
			$this->render ( "categoriaFinalizada" );
			exit;
		}
	}
	
	/**
	 * Vista que muestra las fotografias para desempate
	 */
	public function actionBreakerRoundByCategory($id) {
		$this->layout = "column5";
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
		
		$criteria = new CDbCriteria ();
		$criteria->alias = "CP";
		$criteria->condition = "CP.id_category=" . $categoria->id_category . " AND CP.b_calificada=1 
				AND CP.id_pic NOT IN (SELECT id_pic FROM 2gom_calificaciones_desempate WHERE id_juez=" . $idJuez . ")";
		$criteria->join = "JOIN (SELECT distinct num_calificacion score3
     					 FROM 2gom_view_calificacion_by_pic
      					WHERE id_category=" . $categoria->id_category . " AND b_calificada=1
      					ORDER BY num_calificacion DESC LIMIT 3 ) x ON CP.num_calificacion = x.score3";
		$criteria->order = "CP.num_calificacion DESC";
		$lugares = ViewCalificacionByPic::model ()->findAll ( $criteria );
		
		// Contamos cuantos valores hay
		$valoresEmpatados = array ();
		foreach ( $lugares as $lugar ) {
			$valoresEmpatados [] = $lugar->num_calificacion;
		}
		
		$countCalificaciones = array_count_values ( $valoresEmpatados );
		
		$this->render ( 'breakerRoundByCategory', array (
				"lugares" => $lugares,
				"categoria" => $categoria,
				"countCalificaciones" => $countCalificaciones 
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
}