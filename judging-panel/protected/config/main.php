<?php



// uncomment the following to define a path alias

// Yii::setPathOfAlias('local','path/to/local-folder');



// This is the main Web application configuration. Any writable

// CWebApplication properties can be configured here.

return array(

	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',

	'name'=>'Photo Judging',

	'language'=>"es",

	'theme'=>'2gomDark',

	'defaultController'=>'login/index',	



	// preloading 'log' component

	'preload'=>array('log'),



	// autoloading model and component classes

	'import'=>array(

		'application.models.*',

		'application.components.*',

	),



	'modules'=>array(

		// uncomment the following to enable the Gii tool

		

		'gii'=>array(

			'class'=>'system.gii.GiiModule',

			'password'=>'12345678',

			// If removed, Gii defaults to localhost only. Edit carefully to taste.

			//'ipFilters'=>array('127.0.0.1','::1'),

		),

		

	),



	// application components

	'components'=>array(

		'user'=>array(

			'class' => 'WebUser',

			// enable cookie-based authentication

			'allowAutoLogin'=>true,

			'loginUrl'=>array("login/index")	

		),

		// uncomment the following to enable URLs in path-format

		

		'urlManager'=>array(

			'urlFormat' => 'path',

			'showScriptName'=>false,

			'rules'=>array(

				'logout'=>'login/logout',

				'judgingPanel/photoReview/<idCategoria:\w+>/<t:\w+>'=>'judgingPanel/photoReview',

				'judgingPanel/test'=>'judgingPanel/test',

				'judgingPanel/categoriaFinalizada'=>'judgingPanel/categoriaFinalizada',

				'judgingPanel/tieBreakerRound'=>'judgingPanel/tieBreakerRound',	

				'judgingPanel/breakerRoundByCategory/<id:\w+>'=>'judgingPanel/breakerRoundByCategory',

				'judgingPanel/desempate'=>'judgingPanel/desempate',

				'judgingPanel/viewScorePhoto/<idPic:\w+>/<idCategoria:\w+>/<t:\w+>'=>'judgingPanel/viewScorePhoto',

				'judgingPanel/feedbackReview/<idCategoria:\w+>/<t:\w+>'=>'judgingPanel/feedbackReview',



// 				'judgingPanel/<t:\w+>'=>'judgingPanel/index',

// 				'judgingPanel/concursos'=>'judgingPanel/concursos',



					

// 				'adminPanel/photosCategory/<t:\w+>'=>'juecesAdmin/adashboard2',

// 				'adminPanel/resolveConflict/<t:\w+>'=>'juecesAdmin/evaluador',

// 				'adminPanel/viewRatingPhoto/<t:\w+>'=>'juecesAdmin/consulta',

// 				'adminPanel/viewPhotosCompetitor/<t:\w+>'=>'juecesAdmin/viewPhotosCompetitor',	

// 				'adminPanel'=>'juecesAdmin/index',

// 				'adminPanel/judgeProgress'=>'juecesAdmin/judgeProgress',

// 				'adminPanel/competitors'=>'juecesAdmin/competitors',

// 				'adminPanel/finalists'=>'juecesAdmin/finalists',

// 				'adminPanel/mentions'=>'juecesAdmin/menciones',

// 				'adminPanel/categoryConflicts'=>'juecesAdmin/conflicts',

// 				'<controller:\w+>/<action:\w+>/<t:\w+>'=>'<controller>/<action>',

				

				'<controller:\w+>/<id:\d+>'=>'<controller>/view',

				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',

				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

 			),

		),

			'cache'=>array(

					'class'=>'CDbCache',

			),

		'db'=>array(

			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',

		),

		// uncomment the following to use a MySQL database



			'db'=>require (dirname ( __FILE__ ) . '/database.php'),





			



		

		'errorHandler'=>array(

			// use 'site/error' action to display errors

			// 'errorAction'=>'site/error',

		),

		'log'=>array(

			'class'=>'CLogRouter',

			'routes'=>array(

				array(

					'class'=>'CFileLogRoute',

					'levels'=>'error, warning',

				),

				// uncomment the following to show log messages on web pages

				/*

				array(

					'class'=>'CWebLogRoute',

				),

				*/

			),

		),

	),



	// application-level parameters that can be accessed

	// using Yii::app()->params['paramName']

	'params'=>array(

		// this is used in contact page

		'adminEmail'=>'webmaster@example.com',

		// 'pathBaseImages'=>"https://globaljudging.com/community/pictures/contests/",//con_con_73cdf1c4f187ef82b94a945feae9d32a5783ddc623258/,

		//'pathBaseImages'=>"http://localhost/wwwComiteConcursante/pictures/contests/con_3c391e5c9feec1f95282a36bdd5d41ba/",

		'pathBaseImages'=>"https://qa.2geeksonemonkey.com/global_judging/mexico/community/pictures/contests/",

			

		'pathBaseProfiles'=>"https://qa.2geeksonemonkey.com/global_judging/mexico/community/pictures/contests/",

		//'pathBaseProfiles'=>"http://localhost/wwwComiteConcursante/",

		// 'pathBaseProfiles'=>"https://globaljudging.com/community/",

			

			//'pathBaseProfiles'=>"https://hazclicconmexico.comitefotomx.com/concursar/",

			

			

		'pathImage'	=>"../../community/pictures/contests/" ,

		'pathImageFile'	=>"../community/pictures/contests/" ,

	),

);