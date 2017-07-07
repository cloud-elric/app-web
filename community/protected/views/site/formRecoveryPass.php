<?php
$this->pageTitle = Yii::t('general', 'recuperarPassTitle');
/*
$form = $this->beginWidget ( 'CActiveForm', array (
		'id' => 'login-form',
) );
*/
?>

<!-- <p>Por favor ingresa tu email para iniciar la recuperación de tu contraseña</p> -->

<?php # echo $form->labelEx($model,'username'); ?>
<?php # echo $form->textField($model,'username', array("class"=>"form-control",'placeholder'=>'Correo electrónico')); ?>
<?php # echo $form->error($model,'username'); ?>


<?php # echo CHtml::submitButton('Solicitar', array("class"=>"btn btn-blue")); ?>


<?php # echo CHtml::link("Iniciar sesión", array("site/login/t/".$concurso->txt_token), array("class"=>"olvide")); ?>

<!-- <a class="necesito" href="">Necesito una cuenta</a> -->

<?php # echo CHtml::link("Registrar", array("usrUsuarios/registrar/t/".$concurso->txt_token), array("class"=>"necesito")); ?>

<!-- <span>&copy; 2016 All Right Reserved</span> -->

<?php # $this->endWidget(); ?>


<!-- .login -->
<div class="login container">
	<!-- .row -->
	<div class="row">
		
		<!-- .col -->
		<div class="login-col-flex col-sm-6 col-md-6 col-md-offset-3">
			<!-- .login-form -->
			<div class="login-form">

				<img src="<?= Yii::app()->request->baseUrl ?>/images/hardcode/ms-icon-150x150.png" alt="CFM">
				<h1><?php //echo $concurso->txt_name?></h1>

				<?php
				$form = $this->beginWidget ( 'CActiveForm', array (
					'id' => 'login-form',
				) );
				?>

					<p><?=Yii::t('formRecoveryPass', 'instrucciones')?></p>
					
					<?php # echo $form->labelEx($model,'username'); ?>
					<?php echo $form->textField($model,'username', array("class"=>"form-control",'placeholder'=>Yii::t('login', 'usuario'))); ?>
					<?php  echo $form->error($model,'username'); ?>
					
					<?php echo CHtml::submitButton(Yii::t('formRecoveryPass', 'submit'), array("class"=>"btn btn-blue")); ?>

					<?php # echo CHtml::link("Olvide mi contraseña", array("site/requestPassword/t/".$concurso->txt_token), array("class"=>"olvide"))?>

					<?php echo CHtml::link(Yii::t('login','necesitarCuenta'), array("usrUsuarios/registrar/t/"/*.$concurso->txt_token*/), array("class"=>"necesito recuperar-necesito")); ?>

				<?php $this->endWidget(); ?>

					<div class="all-right">&copy; <?=date('Y')?> <?=Yii::t('general','derechos')?></div>


			</div>
			<!-- end / .login-form -->
		</div>
		<!-- end / .col -->

	</div>
	<!-- end / .row -->
</div>
<!-- end / .login -->
