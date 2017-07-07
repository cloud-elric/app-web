<?php
/* @var $this UsrUsuariosController */
/* @var $model UsrUsuarios */

$this->breadcrumbs=array(
	'Usr Usuarioses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UsrUsuarios', 'url'=>array('index')),
	array('label'=>'Create UsrUsuarios', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#usr-usuarios-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Usr Usuarioses</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usr-usuarios-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_usuario',
		'id_usuario_facebook',
		'txt_correo',
		'txt_usuario_number',
		'txt_nombre',
		'txt_apellido_paterno',
		/*
		'txt_apellido_materno',
		'txt_password',
		'txt_image_url',
		'b_login_social_network',
		'b_participa',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
