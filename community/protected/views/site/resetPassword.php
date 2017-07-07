<?php
/* @var $this UsrUsuariosController */
/* @var $competidor UsrUsuarios */
/* @var $datosWeb UsrUsuariosWebsites */
/* @var $datosTelefonos UsrUsuariosTelefonos */
/* @var $form CActiveForm */
$this->pageTitle = Yii::t('general', 'cambiarPassTitle');
?>


<!-- .login -->
<div class="login container">
	<!-- .row -->
	<div class="row">

		<!-- .col -->
<!-- 		<div class="login-col-flex col-sm-6 col-md-6"> -->
<!-- 			<div class="login-text"> -->
<!-- 				<h2> -->
					<?php //echo Yii::t('general', 'bienvenido')?> <!-- <img
						src="<?php //echo Yii::app()->request->baseUrl; ?>/images/hardcode/Contest-Logo.png"
						alt="<?php //echo$concurso->txt_name?>"> -->
<!-- 				</h2> -->
				<!-- <button type="button" class="btn btn-blue">Consulta las bases del concurso</button> -->
				<!-- <a href="<?php //echo $concurso->txt_url_contest?>" target="_blank"
					class="btn btn-blue"><?php //echo Yii::t('general', 'consulta')?></a> -->
<!-- 			</div> -->
<!-- 		</div> -->
		<!-- end / .col -->

		<!-- .col -->
		<div class="login-col-flex col-sm-6 col-md-6 col-md-offset-3">
			<!-- .login-form -->
			<div class="login-form">

				<img src="<?= Yii::app()->request->baseUrl ?>/images/hardcode/ms-icon-150x150.png"
					alt="CFM">
				

				<?php
				$form = $this->beginWidget ( 'CActiveForm', array (
				'id' => 'usr-usuarios-form',
				'htmlOptions' => array (
					'enctype' => 'multipart/form-data',
					'class' => 'form-reset'
				),
				'enableAjaxValidation' => false
				) );
				?>


					<p><?=Yii::t('resetPassword', 'instrucciones')?></p>


					<?php echo $form->passwordField($model,'txt_password',array(/*'size'=>10,'maxlength'=>10,*/ 'minlength'=>8 ,"class"=>"form-control",'placeholder'=>Yii::t('resetPassword', 'Agregar contraseña'))); ?>

					<?php echo $form->passwordField($model,'repetirPassword',array('minlength'=>8, "class"=>"form-control",'placeholder'=>Yii::t('resetPassword', 'Repetir contraseña'))); ?>

					<?php # echo $form->error($model,'username'); ?>
					
					<?php 
					$getErrors=($model->getErrors());
					if(!empty($getErrors)){?>
					<div class="errorMessage"><?=Yii::t('resetPassword', 'errorMessage')?></div>
					<?php }?>

					<?php echo CHtml::submitButton(Yii::t('resetPassword', 'submit'), array("class"=>"btn btn-blue")); ?>

					<?php echo CHtml::link(Yii::t('login', 'necesitarCuenta'), array("usrUsuarios/registrar"), array("class"=>"necesito")); ?>

				<?php $this->endWidget(); ?>

				<div class="all-right">&copy; 2016 All Right Reserved</div>

			</div>
			<!-- end / .login-form -->
		</div>
		<!-- end / .col -->

	</div>
	<!-- end / .row -->
</div>
<!-- end / .login -->