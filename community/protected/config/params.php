<?php


	$params = array (

			// this is used in contact page

			'powered' => array (

					'urlPoweredAuthor' => 'http://2gom.com.mx/' 

			),

			'adminEmail' => 'webmaster@example.com',

			'pathBaseImages'=>"https://2geeksonemonkey.com/demos/global-judging/mexico/community/pictures/contests/",

			// lineas necesarias para enviar email

			'contactEmail' => 'development@2gom.com.mx',

			'contactName' => 'Global Judging',

			// Configuracion para enviar correo

			'SwifMailer' => array (

					// "serverSMTP" => 'node01.tmdhosting710.com',

					"serverSMTP" => 's210.tmd.cloud',

					"secure" => 'tls',

					"port" => 465,

					"userName" => 'development@2gom.com.mx',

					"password" => '_fJ.&@yhA&z;' 

			),

			// Configuración para facebook

			'Facebook' => array (

					"data" => array (

							

							// 'app_id' => '1199871320067085',

							// 'app_secret' => 'e227548bda7d48daa72fff9d1eef864a',

							'app_id' => '118989518756591',

 							'app_secret' => 'a0486996bdae726646eb77e72ec655f7',

							'default_graph_version' => 'v2.6' 

					),

					"callBack" => 'https://2geeksonemonkey.com/demos/global-judging/mexico/community/usrUsuarios/callbackFacebook/' 

			),

			'PayPal' => array (

					// 'payPalEmail' => 'beto@2gom.com.mx',

					'returnUrl' => 'https://2geeksonemonkey.com/demos/global-judging/mexico/community/usrUsuarios/concurso',

					'cancelUrl' => 'https://2geeksonemonkey.com/demos/global-judging/mexico/community/usrUsuarios/concurso',

					'notifyUrl' => 'https://2geeksonemonkey.com/demos/global-judging/mexico/community/usrUsuarios/iPNPayPal' 

			),

			'paginasHabilitadas'=>array(

					'profile'=>true,

			),

	);

return $params;





