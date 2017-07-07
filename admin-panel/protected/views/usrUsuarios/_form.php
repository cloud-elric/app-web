<?php
/* @var $this UsrUsuariosController */
/* @var $model UsrUsuarios */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usr-usuarios-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'txt_correo'); ?>
		<?php echo $form->textField($model,'txt_correo',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'txt_correo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'txt_nombre'); ?>
		<?php echo $form->textField($model,'txt_nombre',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'txt_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'txt_apellido_paterno'); ?>
		<?php echo $form->textField($model,'txt_apellido_paterno',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'txt_apellido_paterno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'txt_apellido_materno'); ?>
		<?php echo $form->textField($model,'txt_apellido_materno',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'txt_apellido_materno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'txt_password'); ?>
		<?php echo $form->textField($model,'txt_password',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'txt_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'txt_image_url'); ?>
		<?php echo $form->textField($model,'txt_image_url',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'txt_image_url'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->