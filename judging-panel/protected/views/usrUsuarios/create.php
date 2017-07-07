<?php
/* @var $this UsrUsuariosController */
/* @var $model UsrUsuarios */

$this->breadcrumbs=array(
	'Usr Usuarioses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UsrUsuarios', 'url'=>array('index')),
	array('label'=>'Manage UsrUsuarios', 'url'=>array('admin')),
);
?>

<h1>Create UsrUsuarios</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>