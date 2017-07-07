<?php
/* @var $this UsrUsuariosController */
/* @var $model UsrUsuarios */

$this->breadcrumbs=array(
	'Usr Usuarioses'=>array('index'),
	$model->id_usuario=>array('view','id'=>$model->id_usuario),
	'Update',
);

$this->menu=array(
	array('label'=>'List UsrUsuarios', 'url'=>array('index')),
	array('label'=>'Create UsrUsuarios', 'url'=>array('create')),
	array('label'=>'View UsrUsuarios', 'url'=>array('view', 'id'=>$model->id_usuario)),
	array('label'=>'Manage UsrUsuarios', 'url'=>array('admin')),
);
?>

<h1>Update UsrUsuarios <?php echo $model->id_usuario; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>