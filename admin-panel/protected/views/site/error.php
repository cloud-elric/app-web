<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<?php 
if($code == "500"){
	
	$this->renderPartial("//site/500");
	
}

if($code == "404"){
	$this->renderPartial("//site/404");
}
?>
