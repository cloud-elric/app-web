<?php
$this->pageTitle = 'Haz clic con México - Recuperar Contraseña';
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
		<div class="login-col-flex col-sm-6 col-md-6">
			<div class="login-text">
				<h2>
					<?=Yii::t('general', 'bienvenido')?> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/hardcode/Contest-Logo.png" alt="<?=$concurso->txt_name?>">
				</h2>
				<!-- <button type="button" class="btn btn-blue">Consulta las bases del concurso</button> -->
				<a href="<?=$concurso->txt_url_contest?>" target="_blank" class="btn btn-blue"><?=Yii::t('general', 'consulta')?></a>
			</div>
		</div>
		<!-- end / .col -->

		<!-- .col -->
		<div class="login-col-flex col-sm-6 col-md-6">
			<!-- .login-form -->
			<div class="login-form">

				<img src="<?= Yii::app()->request->baseUrl ?>/images/hardcode/WPC-Logo.png" alt="CFM">
				<h1><?=$concurso->txt_name?></h1>

				<?php
				$form = $this->beginWidget ( 'CActiveForm', array (
					'id' => 'login-form',
				) );
				?>

					<p><?=Yii::t('formRecoveryPass', 'instrucciones')?></p>
					
					<?php # echo $form->labelEx($model,'username'); ?>
					<?php echo $form->textField($model,'username', array("class"=>"form-control",'placeholder'=>Yii::t('login', 'user'))); ?>
					<?php  echo $form->error($model,'username'); ?>
					
					<?php echo CHtml::submitButton(Yii::t('formRecoveryPass', 'submit'), array("class"=>"btn btn-blue")); ?>

					<?php # echo CHtml::link("Olvide mi contraseña", array("site/requestPassword/t/".$concurso->txt_token), array("class"=>"olvide"))?>

					<?php echo CHtml::link(Yii::t('login','necesitarCuenta'), array("usrUsuarios/registrar/t/".$concurso->txt_token), array("class"=>"necesito recuperar-necesito")); ?>

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
