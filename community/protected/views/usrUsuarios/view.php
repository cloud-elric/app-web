<?php
/* @var $this UsrUsuariosController */
/* @var $model UsrUsuarios */

$this->breadcrumbs=array(
	'Usr Usuarioses'=>array('index'),
	$model->id_usuario,
);

$this->menu=array(
	array('label'=>'List UsrUsuarios', 'url'=>array('index')),
	array('label'=>'Create UsrUsuarios', 'url'=>array('create')),
	array('label'=>'Update UsrUsuarios', 'url'=>array('update', 'id'=>$model->id_usuario)),
	array('label'=>'Delete UsrUsuarios', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_usuario),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UsrUsuarios', 'url'=>array('admin')),
);
?>

<h1>View UsrUsuarios #<?php echo $model->id_usuario; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_usuario',
		'txt_correo',
		'txt_nombre',
		'txt_apellido_paterno',
		'txt_apellido_materno',
		'txt_password',
		'txt_image_url',
	),
)); ?>
