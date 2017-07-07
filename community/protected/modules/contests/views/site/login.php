<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $concurso ConContests */
/* @var $form CActiveForm  */
$this->pageTitle = Yii::t('login', 'title');

$cs = Yii::app ()->getClientScript ();
$cs->registerScriptFile ( Yii::app ()->request->baseUrl . "/js/facebook/fb.js" );
?>

<!-- .login -->
<div class="login container">
	<!-- .row -->
	<div class="row">

		<!-- .col -->
		<div class="login-col-flex col-sm-6 col-md-6">
			<div class="login-text">
				<h2>
					Bienvenido al concurso <img
						src="<?php echo Yii::app()->theme->baseUrl; ?>/images/hazClickMexico.png"
						alt="Haz Clic con México">
				</h2>
				<!-- <button type="button" class="btn btn-blue">Consulta las bases del concurso</button> -->
				<a href="https://comitefotomx.com/concurso/#Bases" target="_blank"
					class="btn btn-blue">Consulta las bases del concurso</a>
			</div>
		</div>
		<!-- end / .col -->

		<!-- .col -->
		<div class="login-col-flex col-sm-6 col-md-6">
			<!-- .login-form -->
			<div class="login-form">

				<img src="<?= Yii::app()->theme->baseUrl ?>/images/login.png"
					alt="CFM">
				

				<?php
				$form = $this->beginWidget ( 'CActiveForm', array (
						'id' => 'login-form',
						'enableClientValidation' => true,
						'clientOptions' => array (
								'validateOnSubmit' => true 
						),
						'htmlOptions' => array (
								"autocomplete" => "off" 
						) 
				) );
				?>

					<p><?=Yii::t('login','instrucciones')?></p>
					
					<?= $form->textField($model,'username', array("class"=>"form-control",'placeholder'=>'Correo electrónico')); ?>
					<?= $form->passwordField($model,'password', array("class"=>"form-control",'placeholder'=>'Password')); ?>

					<?php
					$errores = $model->getErrors ();
					
					if (! empty ( $errores )) {
						?>
					<div class="errorMessage">Usuario y/o password incorrecto.</div>
					<?php }?>
					<?= CHtml::submitButton('Ingresar', array("class"=>"btn btn-blue")); ?>
					
					<button type="button" class="btn btn-blue btn-facebook"
					onClick="logInWithFacebook()" scope="public_profile, email">
					<i class="fa fa-facebook"></i> Ingresar con Facebook
				</button>
					
					<?= CHtml::link("Olvide mi contraseña", array("site/requestPassword/t/".$concurso->txt_token), array("class"=>"olvide"))?>

					<!-- <a class="necesito" href="">Necesito una cuenta</a> -->
					<?= CHtml::link("Necesito una cuenta", array("usrUsuarios/registrar/t/".$concurso->txt_token), array("class"=>"necesito")); ?>

				<?php $this->endWidget(); ?>

				<div class="all-right">&copy; <?=date('Y')?> All Right Reserved</div>

			</div>
			<!-- end / .login-form -->
		</div>
		<!-- end / .col -->

	</div>
	<!-- end / .row -->
</div>
<!-- end / .login -->