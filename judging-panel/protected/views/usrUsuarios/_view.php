<?php
/* @var $this UsrUsuariosController */
/* @var $data UsrUsuarios */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_usuario')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_usuario), array('view', 'id'=>$data->id_usuario)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_usuario_facebook')); ?>:</b>
	<?php echo CHtml::encode($data->id_usuario_facebook); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('txt_correo')); ?>:</b>
	<?php echo CHtml::encode($data->txt_correo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('txt_usuario_number')); ?>:</b>
	<?php echo CHtml::encode($data->txt_usuario_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('txt_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->txt_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('txt_apellido_paterno')); ?>:</b>
	<?php echo CHtml::encode($data->txt_apellido_paterno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('txt_apellido_materno')); ?>:</b>
	<?php echo CHtml::encode($data->txt_apellido_materno); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('txt_password')); ?>:</b>
	<?php echo CHtml::encode($data->txt_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('txt_image_url')); ?>:</b>
	<?php echo CHtml::encode($data->txt_image_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('b_login_social_network')); ?>:</b>
	<?php echo CHtml::encode($data->b_login_social_network); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('b_participa')); ?>:</b>
	<?php echo CHtml::encode($data->b_participa); ?>
	<br />

	*/ ?>

</div>