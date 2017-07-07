<?php
/* @var $this UsrUsuariosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usr Usuarioses',
);

$this->menu=array(
	array('label'=>'Create UsrUsuarios', 'url'=>array('create')),
	array('label'=>'Manage UsrUsuarios', 'url'=>array('admin')),
);
?>

<h1>Usr Usuarioses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
