<?php
$debug = false;
$dataBase = array ();
if ($debug) {
	$dataBase = array (
			'connectionString' => 'mysql:host=mysql3000.mochahost.com;dbname=beto2gom_comite2017_des',
			'emulatePrepare' => true,
			'username' => 'beto2gom_develop',
			'password' => 'c0d1ngG33k',
			'charset' => 'utf8',
			
			'schemaCachingDuration'=>3600,		
	);
} else {
	$dataBase = array (
			
// 			'connectionString' => 'sqlite:' . dirname ( __FILE__ ) . '/../data/testdrive.db',
// 			'connectionString' => 'mysql:host=mysql1003.mochahost.com;dbname=beto2gom_comiteFoto2016',
// 			'emulatePrepare' => true,
// 			'username' => 'beto2gom_c0m1teF',
// 			'password' => '2PMOq[aWdmF6',
// 			'charset' => 'utf8',
// 			'tablePrefix' => 'tbl_'
			
			'connectionString' => 'mysql:host=globaljudging.com;dbname=globalju_hazclic',
		'emulatePrepare' => true,
		'username' => 'globalju_GeekDeveloper',
		'password' => 'c0d1ngG33k',
		'charset' => 'utf8',
		'tablePrefix' => 'tbl_',

// 			'connectionString' => 'mysql:host=comitefotomx.com;dbname=clubfoto_photoContestAppMainDB',
// 			'emulatePrepare' => true,
// 			'username' => 'clubfoto_FADB',
// 			'password' => 'Z1J5GBLCkzb',
// 			'charset' => 'utf8',
// 			'tablePrefix' => 'tbl_'
			
// 			'connectionString' => 'mysql:host=us-cdbr-azure-central-a.cloudapp.net;dbname=dgom_photo_contest',
// 			'emulatePrepare' => true,
// 			'username' => 'b95d0e7251d5d6',
// 			'password' => '5c4c54e7',
// 			'charset' => 'utf8',
// 			'tablePrefix' => 'tbl_' 
	)
	;
}
return $dataBase;