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

// 				'judgingPanel/photoReview/<idCategoria:\w+>/<t:\w+>'=>'judgingPanel/photoReview',

// 				'judgingPanel/test'=>'judgingPanel/test',

// 				'judgingPanel/categoriaFinalizada'=>'judgingPanel/categoriaFinalizada',

// 				'judgingPanel/tieBreakerRound'=>'judgingPanel/tieBreakerRound',	

// 				'judgingPanel/breakerRoundByCategory/<id:\w+>'=>'judgingPanel/breakerRoundByCategory',

// 				'judgingPanel/desempate'=>'judgingPanel/desempate',

// 				'judgingPanel/viewScorePhoto/<idPic:\w+>/<idCategoria:\w+>/<t:\w+>'=>'judgingPanel/viewScorePhoto',

// 				'judgingPanel/<t:\w+>'=>'judgingPanel/index',

					

				'adminPanel/photosCategory/<t:\w+>/<c:\w+>'=>'juecesAdmin/adashboard2',

				'adminPanel/resolveConflict/<t:\w+>'=>'juecesAdmin/evaluador',

				'adminPanel/viewRatingPhoto/<t:\w+>'=>'juecesAdmin/consulta',

				'adminPanel/viewPhotosCompetitor/<c:\w+>/<t:\w+>'=>'juecesAdmin/viewPhotosCompetitor',	

				'adminPanel/dashboard/<t:\w+>'=>'juecesAdmin/index',

				'adminPanel/contests'=>'juecesAdmin/contests',

				'adminPanel/judgeProgress/<t:\w+>'=>'juecesAdmin/judgeProgress',

				'adminPanel/competitors/<t:\w+>'=>'juecesAdmin/competitors',

				'adminPanel/finalists/<t:\w+>'=>'juecesAdmin/finalists',

				'adminPanel/finalistsTop/<t:\w+>'=>'juecesAdmin/finalistsTop',

				'adminPanel/mentions/<t:\w+>'=>'juecesAdmin/menciones',

				'adminPanel/categoryConflicts/<t:\w+>'=>'juecesAdmin/conflicts',
				'adminPanel/cambiarConfig/<t:\w+>/<s:\w+>'=>'juecesAdmin/cambiarConfig',


				'adminPanel/config/<t:\w+>'=>'juecesAdmin/config',

				'<controller:\w+>/<action:\w+>/<t:\w+>'=>'<controller>/<action>',

				

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

		 'pathBaseImages'=>"https://2geeksonemonkey.com/demos/global-judging/mexico/community/pictures/contests/",

		 'pathBase'=>'https://2geeksonemonkey.com/demos/global-judging/mexico/community/',

		 'pathBaseProfiles'=>"https://2geeksonemonkey.com/demos/global-judging/mexico/community/",

		// 'pathBaseImages'=>"http://globaljudging.com/community/pictures/contests/",

		// 'pathBase'=>'http://globaljudging.com/community/',

		// 'pathBaseProfiles'=>"http://globaljudging.com/community/",

		'pathImage'	=>"../../community/pictures/contests/" ,

		'pathImageFile'	=>"../community/pictures/contests/" ,

	),

);