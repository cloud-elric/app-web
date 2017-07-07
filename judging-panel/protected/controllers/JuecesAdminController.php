<?php
class JuecesAdminController extends Controller {
	public function init(){
		$lan = Yii::app()->session['_lang'];
		
		if(empty($lan)){
			$lan = Yii::app()->language;
		}
		//Here you can add specific code for generating Menu, but the code to change the Yii's default language
		Yii::app()->language = $lan;
	
	}
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
								'competitors',
								'evaluador',
								'competitors2',
								'conflicts',
								'adashboard2',
								'viewPhotosCompetitor',
								'updatePicAdmin',
								'judgeProgress',
								'getThumbnail',
								'searchImage',
								'finalists',
								'categoriaFinalizadaAdmin',
								'consulta',
								'menciones',
								'createCSV',
								'createZIP',
								'createZIPRaw',
								'downloadCSV',
								'downloadZIP',
								
								'test' 
						),
						'users' => array (
								
								'@' 
						),
						'roles' => array (
								"1" 
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
	 * Action para ver el dashboard del juez el overrall progress
	 */
	public function actionIndex() {
		$porcentajeCategoria = ViewPorcentajeCategoria::model ()->findAll ( array("condition"=>"id_contest=1", "order"=>"txt_name") );
		
		$this->layout = "column4";
		
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"c_geek",
				
		), "css" );
		
		$cargarScripts->getScripts ( array (
				"jqueryPlaceholder" 
		), "js" );
		
		$this->render ( 'index', array (
				'porcentajeCategoria' => $porcentajeCategoria 
		) );
	}
	
	/**
	 * Action para mostrar todos los competidores
	 */
	public function actionCompetitors($string = '', $feedback = '', $sort = "") {
		$this->layout = "column9";
		
		$cargarScripts = new CargarScripts ();
		
		$cargarScripts->getScripts ( array (
				"c_geek" 
		), "css" );
		
		$criteria = $this->createCriteriaCompetitors ( $string, $feedback );
		$competidores = new CActiveDataProvider ( 'UsrUsuarios', array (
				'criteria' => $criteria,
				"pagination" => false 
		) );
		
		$criteria = $this->createCriteriaCompetitors ( $string, 1 );
		$competidoresFeedback = new CActiveDataProvider ( 'UsrUsuarios', array (
				'criteria' => $criteria,
				"pagination" => false 
		) );
		
		$criteria = $this->createCriteriaCompetitors ( $string, 0);
		$competidoresNoFeedback = new CActiveDataProvider ( 'UsrUsuarios', array (
				'criteria' => $criteria,
				"pagination" => false 
		) );
		
		$criteria = $this->createCriteriaCompetitors($string,'','',array(),1);
		$competidoreMencion = new CActiveDataProvider ( 'UsrUsuarios', array (
				'criteria' => $criteria,
				"pagination" => false 
		) );
		
		$this->render ( 'competitors', array (
				"competidores" => $competidores,
				"competidoresFeedback" => $competidoresFeedback,
				"competidoresNoFeedback" => $competidoresNoFeedback,
				"competidoreMencion"=>$competidoreMencion
		) );
	}
	
	/**
	 * Busca competidor por token
	 *
	 * @param unknown $t        	
	 * @throws CHttpException
	 */
	private function searchCompetidor($t) {
		$competidor = UsrUsuarios::model ()->find ( array (
				"condition" => "txt_usuario_number=:t",
				"params" => array (
						":t" => $t 
				) 
		) );
		
		if (empty ( $competidor )) {
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		
		return $competidor;
	}
	
	/**
	 * Vemos las fotos de cada competidor
	 *
	 * @param unknown $id        	
	 */
	public function actionViewPhotosCompetitor($t) {
		$competidor = $this->searchCompetidor ( $t );
		$id = $competidor->id_usuario;
		$this->layout = "column9";
		
		$this->title = "View photos";
		
		// Carga de scripts
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"c_asPieProgress",
				"c_pie_progress",
				"c_geek" 
		), "css" );
		
		$cargarScripts->getScripts ( array (
				"j_jquery_asPieProgress",
				"j_aspieprogress",
				"j_pie_progress" 
		), "js" );
		
		// Concursante
		$concursante = UsrUsuarios::model ()->find ( array (
				"condition" => "id_usuario=:id",
				"params" => array (
						":id" => $id 
				) 
		) );
		
		// Consulta para identificar las fotos del concursante
		$photos = ViewCalificacionByPic::model ()->findAll ( array (
				"condition" => "id_usuario=:idConcursante",
				"params" => array (
						":idConcursante" => $id 
				) 
		) );
		
		// Vista
		$this->render ( 'competitors2', array (
				"photos" => $photos,
				"concursante" => $concursante 
		) );
	}
	
	/**
	 * Vista con todas las fotos que tienen conflictos
	 */
	public function actionConflicts() {
		$this->layout = "column11";
		$this->title = "Category Conflicts";
		
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"gridstack",
				"panelPortlets",
				
				"c_geek" 
		), "css" );
		
		$cargarScripts->getScripts ( array (
				"lodash",
				"jqueryUi",
				"jsGridstack",
				"panel",
				
				"js2gridstack" 
		), "js" );
		
		$picConflictos = ViewPicsCalificadas::model ()->findAll ( "b_calificada=1 AND (b_conflicto_mencion=1 OR b_conflicto_categoria=1)" );
		
		$this->render ( 'categoryConflicts', array (
				"picConflictos" => $picConflictos 
		) );
	}
	
	/**
	 * Busca la categoria por el token
	 *
	 * @param unknown $t        	
	 */
	private function findCategory($t) {
		$criteria = new CDbCriteria ();
		$criteria->condition = "txt_token_category=:token";
		$criteria->params = array (
				":token" => $t 
		);
		$categoria = Categoiries::model ()->find ( $criteria );
		if (empty ( $categoria )) {
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		
		return $categoria;
	}
	
	/**
	 * Action para ver el dashboard2 del administrador.
	 * Solo se ven las fotos calificadas
	 */
	public function actionAdashboard2($t = null) {
		$id = $t;
		$this->layout = "column6";
		$this->title = Yii::t('site', 'titlePhotosCategory');
		
		$categoria = $this->findCategory ( $id );
		
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"gridstack",
				"panelPortlets",
				"c_asPieProgress",
				"c_pie_progress",
				"c_nstSlider",
				"c_icheck",
				
				"c_geek" 
		), "css" );
		$cargarScripts->getScripts ( array (
				"lodash",
				"jqueryUi",
				"jsGridstack",
				"panel",
				"js2gridstack",
				"j_jquery_placeholder_components",
				"j_jquery_asPieProgress",
				"j_aspieprogress",
				"j_pie_progress",
				"j_nstSlider",
				"j_icheck_min",
				
				"j_icheck" 
		), "js" );
		
		$categorias = ViewPorcentajeCategoria::model ()->find ( array (
				"condition" => "id_category=:idCategory",
				"params" => array (
						":idCategory" => $categoria->id_category 
				) 
		) );
		
		$criteriaPics = new CDbCriteria ();
		$criteriaPics->condition = "if(id_category IS NULL, id_category_original, id_category) =:idCategory";
		$criteriaPics->params = array (
				":idCategory" => $categoria->id_category 
		);
		// $criteriaPics->limit = 18;
		$picsCategoria = WrkPics::model ()->findAll ( $criteriaPics );
		$this->render ( 'adashboard2', array (
				"categoria" => $categorias,
				"picsCategoria" => $picsCategoria 
		) );
	}
	
	/**
	 * Administrador revisa foto y decide categoria y si merece mención
	 *
	 * @param unknown $id        	
	 */
	public function actionEvaluador($t) {
		$pic = $this->searchPic ( $t );
		$id = $pic->id_pic;
		
		$this->layout = "column3";
		$this->title = "Evaluador";
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"c_select2",
				"gridstack",
				"panelPortlets",
				"c_asPieProgress",
				"c_pie_progress",
				"c_asRange",
				"c_icheck",
				"c_geek" 
		), "css" );
		$cargarScripts->getScripts ( array (
				"lodash",
				// "jqueryUi",
				"jsGridstack",
				"panel",
				"js2gridstack",
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
				"j_dgom_panels_admin",
				"j_dgom_photo_admin" 
		), "js" );
		
		// Foto a calificar
		$photoCalificar = WrkPics::model ()->findByPK ( $id );
		
		$criteria = new CDbCriteria ();
		$criteria->condition = "id_juez IN (SELECT id_juez FROM 2gom_wrk_pics_calificaciones WHERE id_pic=:idPic GROUP BY id_pic, id_juez ) AND b_juez_admin=0";
		$criteria->params = array (
				":idPic" => $id 
		);
		$jueces = EntJueces::model ()->findAll ( $criteria );
		
		if (empty ( $photoCalificar )) {
		}
		
		// Calificaciones por rubro
		$calificacionRubro = ViewCalificacionByRubro::model ()->findAll ( array (
				"condition" => "id_pic=:idPic",
				"params" => array (
						":idPic" => $id 
				) 
		) );
		
		// Cargamos categorias
		$categorias = Categoiries::model ()->findAll ();
		$categoriasList = CHtml::listData ( $categorias, "id_category", "txt_name" );
		
		$this->render ( 'evaluador', array (
				"photoCalificar" => $photoCalificar,
				"categoriasList" => $categoriasList,
				'calificacionRubro' => $calificacionRubro,
				'jueces' => $jueces 
		) );
	}
	
	/**
	 * Action para actualizar la imagen (El administrador decide si es honorable mention y la categoria)
	 */
	public function actionUpdatePicAdmin() {
		$idCategory = NULL;
		$bMencion = 0;
		if (isset ( $_POST ["idPic"] )) {
			$idPic = $_POST ["idPic"];
			
			$pic = WrkPics::model ()->findByPK ( $idPic );
			
			if (empty ( $pic )) {
				
				return;
			}
			
			if (isset ( $_POST ["id_category"] )) {
				
				
				$idCategory = $_POST ["id_category"];
				
				if(empty($idCategory)){
					$idCategory = $pic->id_category_original;
				}
				
				
				$pic->id_category = $idCategory;
			}
			
			if (isset ( $_POST ["b_mencion"] )) {
				$bMencion = 1;
			}
			
			$pic->b_mencion = $bMencion;
			$pic->save ();
			
		}
	}
	
	/**
	 * Vista de Judge progress
	 */
	public function actionJudgeProgress() {
		$this->layout = "column8";
		
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"c_geek" 
		), "css" );
		
		$jueces = EntJueces::model ()->findAll ( "b_juez_admin=0" );
		
		$this->render ( 'judgeProgress', array (
				"jueces" => $jueces 
		) );
	}
	
	/**
	 * Buscamos todas las imagenes dependiendo si es honorable o por calificacion
	 *
	 * @param Integer $idCategoria
	 *        	Identificador de la categoria
	 * @param unknown $isHonorable
	 *        	Conocer si el criterio de busqueda es por mencion
	 * @param Integer $calMin
	 *        	Calificación minima
	 * @param Integer $calMax
	 *        	Calificación maxima
	 */
	public function actionSearchImage($idCategoria, $isHonorable, $calMin = 0, $calMax = 100) {
		$categoria = $this->findCategory ( $idCategoria );
		
		$idCategoria = $categoria->id_category;
		
		if ($isHonorable == "true") {
			$bMencion = "(P.b_mencion=1)";
		} else {
			
			$bMencion = "(P.b_mencion IS NULL OR P.b_mencion=0)";
		}
		
		$criteria = new CDbCriteria ();
		$criteria->alias = "P";
		// $criteria->select = "P.*, CP.num_calificacion";
		$criteria->join = "INNER JOIN 2gom_view_calificacion_by_pic AS CP ON CP.id_pic = P.id_pic";
		$criteria->condition = "P.id_pic
		IN(SELECT id_pic
				FROM 2gom_view_pics_calificadas
				WHERE id_category_original=:idCategoria AND b_calificada=1)
				AND CP.num_calificacion BETWEEN :calMin AND :calMax AND " . $bMencion;
		$criteria->params = array (
				":idCategoria" => $idCategoria,
				":calMin" => $calMin,
				":calMax" => $calMax 
		);
		
		$picsCategoria = WrkPics::model ()->findAll ( $criteria );
		
		$this->renderPartial ( '//juecesAdmin/gridPhotos', array (
				'picsCategoria' => $picsCategoria 
		), 
				// 'display' => 'block',
				false, true );
	}
	
	/**
	 * Fotos finalistas
	 */
	public function actionFinalists($places = 3) {
		$this->layout = "column10";
		$this->title = "Finalists";
		
		$picConflictos = ViewPicsCalificadas::model ()->findAll ( "b_calificada=1 AND (b_conflicto_mencion=1 OR b_conflicto_categoria=1)" );
		
		$categoriasCal = ViewPorcentajeCategoria::model()->findAll('id_contest=1');
		$total = 0;
		foreach($categoriasCal as $cal){
			$total += $cal->num_porcentaje_general;
		}
		
		$existEmpate = Yii::app()->db->createCommand()
		->from('2gom_view_calificacion_final CF')
		->join('(SELECT DISTINCT F.num_calificacion
						FROM 2gom_view_calificacion_final F
						order by F.num_calificacion DESC
						LIMIT 10
						) AS W', 'W.num_calificacion = CF.num_calificacion')
		->where('id_contest = 1 AND b_empate=1 AND b_calificada_desempate=0')
		->queryAll();
		
		// Verifica si falta por calificar
		if(($total/count($categoriasCal))<100){
			Yii::app()->user->setFlash('error', Yii::t('finalists', 'incompleted'));
			
		}else if(!empty($picConflictos)){ // Verifica si existen conflictos
			
			Yii::app()->user->setFlash('error', Yii::t('finalists', 'conflicts'));
			
		}else if(count($existEmpate)>0){
			
			// Existen empates 
			Yii::app()->user->setFlash('error', Yii::t('finalists', 'tieBreakerMessage'));
		}
		
		
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"c_asPieProgress",
				"c_pie_progress",
				"c_geek" 
		), "css" );
		
		$cargarScripts->getScripts ( array (
				"j_jquery_asPieProgress",
				"j_aspieprogress",
				"j_pie_progress" 
		), "js" );
		
		$categorias = Categoiries::model ()->findAll ( array (
				"condition" => "b_enabled",
				"order" => "txt_name" 
		) );
		
		$criteria = new CDbCriteria ();
		$criteria->condition = "(b_empate = 0 OR b_calificada_desempate=1)";
		
		
	
		$categoria = ViewCalificacionFinal::model ()->find ( $criteria );
		
		if (empty ( $categoria )) {
			// $this->redirect(array("categoriaFinalizadaAdmin"));
		}
		
		$this->render ( 'finalists', array (
				"categorias" => $categorias,
				'places'=>$places
		) );
	}
	
	/**
	 * Action que se muestra cuando una categoria admin esta finalizada
	 */
	public function actionCategoriaFinalizadaAdmin() {
		$this->layout = "column4";
		$this->title = "Trabajo terminado";
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"c_geek" 
		), "css" );
		
		$avanceJueces = ViewAvanceJuezEmpate::model ()->findAll ();
		
		$this->render ( 'categoriaFinalizadaAdmin', array (
				"avanceJueces" => $avanceJueces 
		) );
	}
	
	/**
	 * Busca por token la imagen
	 *
	 * @param unknown $t        	
	 */
	private function searchPic($t) {
		$pic = WrkPics::model ()->find ( array (
				"condition" => "txt_pic_number=:token",
				"params" => array (
						":token" => $t 
				) 
		) );
		
		if (empty ( $pic )) {
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		
		return $pic;
	}
	
	/**
	 * Pantalla de Consulta
	 */
	public function actionConsulta($t) {
		$pic = $this->searchPic ( $t );
		
		$id = $pic->id_pic;
		
		$this->layout = "column7";
		$this->title = "Pantalla de Consulta";
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"c_asPieProgress",
				"c_pie_progress",
				"c_geek",
				"c_geek_impresion" 
		), "css" );
		
		$cargarScripts->getScripts ( array (
				"j_jquery_asPieProgress",
				"j_aspieprogress",
				"j_pie_progress" 
		), "js" );
		
		// Foto a calificar
		$photo = $this->searchPic ( $t );
		
		// Calificaciones por rubro
		$calificacionRubro = ViewCalificacionByRubro::model ()->findAll ( array (
				"condition" => "id_pic=:idPic",
				"params" => array (
						":idPic" => $photo->id_pic 
				),
				'order'=>'id_rubro'
		) );
		
		$criteria = new CDbCriteria ();
		$criteria->condition = "id_pic=:idPic";
		$criteria->params = array (
				":idPic" => $photo->id_pic 
		);
		$criteria->group = "id_juez, id_pic";
		
		// Busca si el dueño de la fotografía compro con feedback
		$hasFeedback = ViewUsuarioPicsProductos::model ()->find ( array (
				'condition' => 'id_pic=:idPic AND num_addons>0',
				'params' => array (
						':idPic' => $id
				)
		) );
		
		$feedBacks = array();
		if(!empty($hasFeedback)){
			$feedBacks = WrkPicsCalificaciones::model ()->findAll ( $criteria );
		}
		
		
		
		$calificacionesJueces = WrkPicsCalificaciones::model ()->findAll ( array (
				"condition" => "id_pic=:idPic",
				"params" => array (
						":idPic" => $photo->id_pic 
				),
				'order'=>'id_juez, id_rubro'
		) );
		
		$this->render ( 'consulta', array (
				"photo" => $photo,
				"calificacionRubro" => $calificacionRubro,
				"feedBacks" => $feedBacks,
				"calificacionesJueces" => $calificacionesJueces 
		) );
	}
	
	/**
	 * Solo muestra las menciones del concurso
	 */
	public function actionMenciones() {
		$this->layout = "column6";
		$this->title = "Menciones";
		
		$cargarScripts = new CargarScripts ();
		$cargarScripts->getScripts ( array (
				"gridstack",
				"panelPortlets",
				"c_asPieProgress",
				"c_pie_progress",
				"c_nstSlider",
				"c_icheck",
				
				"c_geek" 
		), "css" );
		$cargarScripts->getScripts ( array (
				"lodash",
				"jqueryUi",
				"jsGridstack",
				"panel",
				"js2gridstack",
				"j_jquery_placeholder_components",
				"j_jquery_asPieProgress",
				"j_aspieprogress",
				"j_pie_progress",
				"j_nstSlider",
				"j_icheck_min",
				
				"j_icheck" 
		), "js" );
		
		$picsMenciones = ViewPicsCalificadas::model ()->findAll ( array (
				"condition" => "b_mencion=1 AND id_contest= 1" 
		) );
		
		$this->render ( "menciones", array (
				"menciones" => $picsMenciones 
		) );
	}
	
	/**
	 * Generacion de archivo zip a partir de filtro
	 *
	 * @param string $string        	
	 * @param string $feedback        	
	 */
	public function actionCreateZIP($string = '', $feedback = '', $raw='') {
		
		$competitors = array();
		if(isset($_GET["competitors"])){
			$competitors = $_GET["competitors"];
		}
		
		$criteria = $this->createCriteriaCompetitors ( $string, $feedback,'', $competitors);
		// Busca los competidores dependiendo de los datos enviados
		$competidores = new CActiveDataProvider ( 'UsrUsuarios', array (
				'criteria' => $criteria,
				"pagination" => false 
		) );
		
		// info para armar el csv
		$info = array ();
		$info [0] = array (
				"Name",
				"Last name",
				"Email",
				"#Pics",
				"Id member",
				"Code coupon",
				"Pay",
				"Name pic" 
		);
		
		$usuariosPics = array ();
		$i = 0;
		foreach ( $competidores->data as $data ) {
			
			$name = $data->txt_nombre . " " . $data->txt_apellido_paterno . " - " . $data->txt_correo;
			// Obtiene las fotos del usuario
			$pics = WrkPics::model ()->findAll ( array (
					"condition" => "ID=:id AND id_contest=:idContest AND b_status=2",
					"params" => array (
							":id" => $data->id_usuario,
							":idContest" => 1 
					) 
			) );
			
			
			$infoAdcional = UsrUsuariosInfos::model()->find('id_usuario='.$data->id_usuario.' AND id_info_adicional=1');
			
			$pago = ViewPagosRecibidos::model()->find('id_usuario='.$data->id_usuario.' AND id_contest=1');
			
			if(empty($infoAdcional)){
				$infoAdcional = new UsrUsuariosInfos();
			}
			
			if(empty($pago)){
				$pago = new ViewPagosRecibidos();
			}
			
			// Arreglo con la informacion
			$info [$i + 1] = array (
					$data->txt_nombre,
					$data->txt_apellido_paterno,
					$data->txt_correo,
					count ( $pics ),
					$infoAdcional->txt_valor,
					$pago->txt_identificador_unico,
					$pago->txt_monto_pago
			);
			
			
			$j = 0;
			$nombres = array();
			
			foreach ( $pics as $pic ) {
				$nombrePic = $name . "/" . $pic->txt_pic_name . ".jpg";
				$nombres[]=$nombrePic;
				
				if(in_array($nombrePic, $nombres)){
					$contador = array_count_values($nombres);
					$num = $contador[$nombrePic];
					
					if(($num-1)==0){
						$nombrePic = $name . "/" . $pic->txt_pic_name .".jpg";
					}else{
						$nombrePic = $name . "/" . $pic->txt_pic_name ."(".($num-1). ").jpg";
					}
					
				}
				
				if($raw=="RAW"){
					
					$pathFile = Yii::app()->params["pathImageFile"] . $data->txt_usuario_number . "/" . $pic->txt_file_name;
				}else{
					$pathFile = Yii::app()->params["pathImageFile"] . $data->txt_usuario_number . "/large_" . $pic->txt_file_name;
				}
				
				
				$usuariosPics [$i] ["fileName"] [$j] = array (
						$pathFile,
						$nombrePic 
				);
				$j ++;
			}
			
			$i ++;
		}
		
		// csv
		$filenameCss = uniqid () . ".csv";
		$fileCsv = "temporal/" . $filenameCss;
		
		// Metodo que crea un csv
		$this->createCSV ( $info, $fileCsv );
		
		$usuariosPics ["archivoCsv"] = $fileCsv;
		
		// Zip
		$filename = uniqid () . ".zip";
		$filePath = "temporal/" . $filename;
		
		// Metodo que crea un zip
		$this->createZIP ( $usuariosPics, $filePath );
		
		echo $filename;
	}
	
	/**
	 * Valida de un arreglo que no se repitan los nombres
	 */
	private function validateNameDuplicate($files){
	
	
	
		foreach($files as $f){
				
				
		}
	
		return $files;
	}
	
	/**
	 * Action de prueba
	 */
	public function actionTest() {
		
	}
	/**
	 * Crea y descarga un archivo zip
	 *
	 * @param unknown $files        	
	 * @param string $name        	
	 */
	private function createZIP($files = array(), $name = "pics.zip") {
		
		
		// $files=array("index.php", "index-test.php");
		
		// create new zip opbject
		$zip = new ZipArchive ();
		
		// create a temp file & open it
		
		$zip->open ( $name, ZipArchive::CREATE );
		$zip->addFile (  $files ["archivoCsv"],"competitors.csv" );
		// loop through each file
		foreach ( $files as $file ) {
			
			// Las siguientes lineas descargan el archivo desde una direccion
			// # download file
			// $download_file = file_get_contents($file);
			
			// #add it to the zip
			// $zip->addFromString(basename($file),$download_file);
			
			// Add file to zip
			if (isset ( $file ["fileName"] )) {
				 
				foreach ( $file ["fileName"] as $f ) {
					
					$zip->addFile ( $f [0], $f [1] );
				}
			}
		}
		
		// close zip
		$zip->close ();
	}
	
	/**
	 * Descargar archivo CsV
	 */
	public function actionCreateCSV($string = '', $feedback = '') {
		$competitors = array();
		if(isset($_GET["competitors"])){
			$competitors = $_GET["competitors"];
		}
		$this->layout = false;
		
		$criteria = $this->createCriteriaCompetitors ( $string, $feedback,'',$competitors );
		// Busca los competidores dependiendo de los datos enviados
		$competidores = new CActiveDataProvider ( 'UsrUsuarios', array (
				'criteria' => $criteria,
				"pagination" => false 
		) );
		
		// Prepara la informacion paraguardarlo en el csv
		$info = array ();
		$info [0] = array (
				"Name",
				"Last name",
				"Email",
				"#Pics",
				"Id member",
				"Code coupon",
				"Pay",
				"Name pic" 
		);
		$i = 1;
		foreach ( $competidores->data as $data ) {
			
			// Obtiene las fotos del usuario
			$pics = WrkPics::model ()->findAll ( array (
					"condition" => "ID=:id AND id_contest=:idContest AND b_status=2",
					"params" => array (
							":id" => $data->id_usuario,
							":idContest" => 1 
					) 
			) );
			
			$infoAdcional = UsrUsuariosInfos::model()->find('id_usuario='.$data->id_usuario.' AND id_info_adicional=1');
				
			$pago = ViewPagosRecibidos::model()->find('id_usuario='.$data->id_usuario.' AND id_contest=1');
				
			if(empty($infoAdcional)){
				
				$infoAdcional = new UsrUsuariosInfos();
			}
				
			if(empty($pago)){
				$pago = new ViewPagosRecibidos();
			}
			
			// Arreglo con la informacion
			$info [$i] = array (
					$data->txt_nombre,
					$data->txt_apellido_paterno,
					$data->txt_correo,
					count ( $pics ),
					$infoAdcional->txt_valor,
					$pago->txt_identificador_unico,
					$pago->txt_monto_pago
			);
			
			// Asigna la direccion url de las fotos al archivo
			foreach ( $pics as $pic ) {
				$url = $pic->txt_pic_name;
				array_push ( $info [$i], $url );
			}
			$i ++;
		}
		
		$filename = uniqid () . ".csv";
		$filePath = "temporal/" . $filename;
		
		// Metodo que crea un csv
		$this->createCSV ( $info, $filePath );
		
		echo $filename;
	}
	
	/**
	 * Arma el criteria dependiendo de los filtros para competidores
	 *
	 * @param string $string        	
	 * @param string $feedback        	
	 */
	private function createCriteriaCompetitors($string = '', $feedback = '', $sort = '', $competitors=array(), $mencion=0) {
		$params = array ();
		$criteria = new CDbCriteria ();
		$criteria->alias = "U";
		$criteria->join = "INNER JOIN 2gom_con_rel_users_contest UC ON UC.id_usuario= U.id_usuario
				INNER JOIN 2gom_pay_ordenes_compras OC ON OC.id_usuario = OC.id_usuario AND UC.id_orden_compra = OC.id_orden_compra";
		$criteria->condition = " U.id_usuario IN (select SUC.id_usuario FROM 2gom_con_rel_users_contest SUC) AND UC.id_contest = 1";
		// $criteria->order = "U.txt_nombre";
		
		if($mencion===1){
			$criteria->join.= " INNER JOIN 2gom_wrk_pics P ON P.ID= U.id_usuario AND P.id_contest = UC.id_contest";
			$criteria->addCondition('b_mencion = 1');
			$criteria->group = "U.id_usuario";
		}
		
		if (! isset ( $_GET ["UsrUsuarios_sort_nombre"] )) {
			$criteria->order = "U.txt_nombre";
		} else {
			
			if ($_GET ["UsrUsuarios_sort_nombre"] == "txt_nombre.desc") {
				$criteria->order = "U.txt_nombre DESC";
			} else if ($_GET ["UsrUsuarios_sort_nombre"] == "txt_nombre") {
				$criteria->order = "U.txt_nombre";
			}
		}
		
		if (isset ( $_GET ["UsrUsuarios_sort_correo"] )) {
			if ($_GET ["UsrUsuarios_sort_correo"] == "txt_correo.desc") {
				$criteria->order = "U.txt_correo DESC";
			} else if ($_GET ["UsrUsuarios_sort_correo"] == "txt_correo") {
				$criteria->order = "U.txt_correo";
			}
		}
		
		if (! empty ( $string )) {
			$criteria->addCondition ( 'txt_nombre LIKE :string OR txt_apellido_paterno LIKE :string OR txt_correo LIKE :string' );
			$params [":string"] = "%$string%";
		}
		
		if ($feedback == 1) {
			$criteria->addCondition ( 'num_addons = 1' );
		} else if ($feedback === 0) {
			$criteria->addCondition ( 'num_addons = 0' );
		}
		
		
		$criteria->params = $params;
		
		if(!empty($competitors)){
			$criteria->addInCondition("txt_usuario_number", $competitors, "and");
		}
		
		
		
		return $criteria;
	}
	
	/**
	 * Crea un archivo csv
	 *
	 * @param unknown $data        	
	 * @param unknown $name        	
	 */
	private function createCSV($data, $name) {
		$fp = fopen ( $name, 'a' );
		// ob_clean ();
		foreach ( $data as $da ) {
			fputcsv ( $fp, $da );
		}
		
		fclose ( $fp );
	}
	
	/**
	 * Descarga archivo CSV
	 */
	public function actionDownloadCSV($file) {
		$filename = "competitors.csv";
		header ( 'Content-Type: application/csv' );
		header ( 'Content-Disposition: attachment; filename="' . $filename . '";' );
		
		readfile ( "temporal/" . $file );
		unlink ( "temporal/" . $file );
	}
	
	/**
	 * Action para descargar un archivo zip con las fotos
	 * de los participantes dependiendo de los filtros
	 */
	public function actionDownloadZIP($file) {
		// send the file to the browser as a download
		header ( 'Content-disposition: attachment; filename=pics.zip' );
		header ( 'Content-type: application/zip' );
		readfile ( "temporal/" . $file );
		
		unlink ( "temporal/" . $file );
	}
}