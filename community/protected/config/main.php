<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array (
		'basePath' => dirname ( __FILE__ ) . DIRECTORY_SEPARATOR . '..',
		'name' => 'Internacional',
		'sourceLanguage'=>'es',
		'language' => 'es_es',
		'theme' => '2gomDark',
		'defaultController' => "usrUsuarios/concursos",
		
		// preloading 'log' component
		'preload' => array (
				'log' 
		),
		
		// autoloading model and component classes
		'import' => array (
				'application.models.*',
				'application.components.*',
				'application.extensions.paypal.*',
				'application.extensions.openpay.*',
				'application.extensions.swiftMailer.SendEMail',
				'application.extensions.facebook.*' 
		),
		
		// GZIP compress
		'onBeginRequest' => create_function ( '$event', 'return ob_start("ob_gzhandler");' ),
		'onEndRequest' => create_function ( '$event', 'return ob_end_flush();' ),
		
		'modules' => array (
				// uncomment the following to enable the Gii tool
				'contests' => array (
						'class' => 'application.modules.contests.ContestsModule' 
				),
				'gii' => array (
						'class' => 'system.gii.GiiModule',
						'password' => '12345678',
						// If removed, Gii defaults to localhost only. Edit carefully to taste.
						'ipFilters' => array (
								'127.0.0.1',
								'::1' 
						) 
				) 
		),
		
		// application components
		'components' => array (
				'clientScript' => array (
						'class' => 'CClientScript',
						'scriptMap' => array (
								'jquery.js' => false 
						) 
				),
				
				'user' => array (
						'loginUrl' => array (
								// Login para concurso de haz clic con México 2016
								//'site/login/t/con_864f324cd5e379b8dc99dd11567c186e5772ed5c80c6b'
								'site/login'
								// Login para el concurso de canada
								//'site/login/t/con_73cdf1c4f187ef82b94a945feae9d32a5783ddc623258'
						),
						// enable cookie-based authentication
						'allowAutoLogin' => true 
				),
				'swiftmailer' => array (
						'class' => 'application.extensions.swiftMailer.SwiftMailer' 
				),
				
				// uncomment the following to enable URLs in path-format
				
				'urlManager' => array (
						'urlFormat' => 'path',
						'showScriptName' => false,
						'rules' => array (
								'<controller:\w+>/<id:\d+>' => '<controller>/view',
								'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
								'<controller:\w+>/<action:\w+>' => '<controller>/<action>' 
						) 
				),
				
				'cache' => array (
						'class' => 'CDbCache' 
				),
				
				// database settings are configured in database.php
				'db' => require (dirname ( __FILE__ ) . '/database.php'),
				
				//'errorHandler' => array ('errorAction'=>'site/error'),
				// use 'site/error' action to display errors
				// 'errorAction'=>'site/error',
				
				'log' => array (
						'class' => 'CLogRouter',
						'routes' => array (
								array (
										'class' => 'CFileLogRoute',
										'levels' => 'error, warning' 
								),
								
								array (
										'class' => 'CFileLogRoute',
										'levels' => "pago",
										'logFile' => 'paypal_pago.log',
										'categories' => 'paypal' 
								),
								array (
										'class' => 'CFileLogRoute',
										'levels' => "errors",
										'logFile' => 'paypal_error.log',
										'categories' => 'paypal' 
								),
								array (
										'class' => 'CFileLogRoute',
										'levels' => "debug",
										'logFile' => 'paypal_debug.log',
										'categories' => 'paypal' 
								),
								array (
										'class' => 'CFileLogRoute',
										'levels' => "info",
										'logFile' => 'openpay.log',
										'categories' => 'openpay' 
								),
								array (
										'class' => 'CFileLogRoute',
										'levels' => "info",
										'logFile' => 'free.log',
										'categories' => 'free'
								),
								array (
										'class' => 'CFileLogRoute',
										'levels' => "debug",
										'logFile' => 'facebook_debug.log',
										'categories' => 'facebook' 
								) 
						) 
				),array(
		  'class'=>'CWebLogRoute',
		  ), 
		)
		// uncomment the following to show log messages on web pages
		/*
		 * array(
		 * 'class'=>'CWebLogRoute',
		 * ),
		 */
		
		,
		
		// application-level parameters that can be accessed
		// using Yii::app()->params['paramName']
		'params' => require (dirname ( __FILE__ ) . '/params.php') 
);
