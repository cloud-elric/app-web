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
					Bienvenido al concurso <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/hazClickMexico.png" alt="Haz Clic con México">
				</h2>
				<!-- <button type="button" class="btn btn-blue">Consulta las bases del concurso</button> -->
				<a href="https://comitefotomx.com/concurso/#Bases" target="_blank" class="btn btn-blue">Consulta las bases del concurso</a>
			</div>
		</div>
		<!-- end / .col -->

		<!-- .col -->
		<div class="login-col-flex col-sm-6 col-md-6">
			<!-- .login-form -->
			<div class="login-form">

				<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/login.png" alt="CFM">
				<h1>Comite Fotográfico Mexicano</h1>

				<?php
				$form = $this->beginWidget ( 'CActiveForm', array (
					'id' => 'login-form',
				) );
				?>

					<p>Para recuperar tu contraseña necesitamos nos proporciones el correo electrónico con el que te registraste</p>
					
					<?php # echo $form->labelEx($model,'username'); ?>
					<?php echo $form->textField($model,'username', array("class"=>"form-control",'placeholder'=>'Correo electrónico')); ?>
					<?php  echo $form->error($model,'username'); ?>
					
					<?php echo CHtml::submitButton('Recuperar contraseña', array("class"=>"btn btn-blue")); ?>

					<?php # echo CHtml::link("Olvide mi contraseña", array("site/requestPassword/t/".$concurso->txt_token), array("class"=>"olvide"))?>

					<?php echo CHtml::link("Necesito una cuenta", array("usrUsuarios/registrar/t/".$concurso->txt_token), array("class"=>"necesito recuperar-necesito")); ?>

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
