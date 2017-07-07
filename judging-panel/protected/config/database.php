<?php
$debug = false;
$dataBase = array ();
if ($debug) {
	$dataBase = array (
				
			'connectionString' => 'mysql:host=localhost;dbname=global_judgin_produccion_backup',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			//'charset' => 'utf8',
				
			'schemaCachingDuration'=>3600,
	);
} else {
	$dataBase = array (
			'connectionString' => 'mysql:host=mysql3000.mochahost.com;dbname=beto2gom_comite2017_des',
			'emulatePrepare' => true,
			'username' => 'beto2gom_develop',
			'password' => 'c0d1ngG33k',
			'charset' => 'utf8',
			
			'schemaCachingDuration'=>3600,		
	)
	;
}
return $dataBase;
