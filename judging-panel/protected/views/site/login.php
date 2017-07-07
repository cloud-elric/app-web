<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $concurso ConContests */
/* @var $form CActiveForm  */
$this->pageTitle = Yii::t('login', 'title');

$cs = Yii::app ()->getClientScript ();
$cs->registerScriptFile ( Yii::app ()->request->baseUrl . "/js/facebook/fb.js" );

?>
<link rel="stylesheet" type="text/css" href="/wwwComiteCanadaConcursante/assets/d7368059/ladda.min.css">
<!-- .login -->
<div class="login container">
	<!-- .row -->
	<div class="row">

		<!-- .col -->
		<div class="login-col-flex col-sm-6 col-md-6">
			<div class="login-text">
				<h2>
					<?=Yii::t('general', 'bienvenido')?> <img
						src="<?php echo Yii::app()->request->baseUrl; ?>/images/hardcode/Contest-Logo.png"
						alt="<?=$concurso->txt_name?>">
				</h2>
				<!-- <button type="button" class="btn btn-blue">Consulta las bases del concurso</button> -->
				<a href="<?=$concurso->txt_url_contest?>" target="_blank"
					class="btn btn-blue"><?=Yii::t('general', 'consulta')?></a>
			</div>
		</div>
		<!-- end / .col -->

		<!-- .col -->
		<div class="login-col-flex col-sm-6 col-md-6">
			<!-- .login-form -->
			<div class="login-form">

				<img src="<?= Yii::app()->request->baseUrl ?>/images/hardcode/WPC-Logo.png"
					alt="CFM">
				<h1><?=$concurso->idCliente->txt_nombre?></h1>

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
					
					<?= $form->textField($model,'username', array("class"=>"form-control",'placeholder'=>Yii::t('login', 'usuario'))); ?>
					<?= $form->passwordField($model,'password', array("class"=>"form-control",'placeholder'=>Yii::t('login', 'password'))); ?>

					<?php
					$errores = $model->getErrors ();
					
					if (! empty ( $errores )) {
						?>
					<div class="errorMessage"><?=Yii::t('login', 'errorInicio')?></div>
					<?php }?>
					<?=CHtml::submitButton(Yii::t('login', 'ingresar'), array("class"=>"btn btn-blue", 'id'=>'login-button')); ?>
					
					
<!-- 					<button id="submit-button" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label">expand-left</span></button> -->
					
					<?php
					
						#$this->widget('application.extensions.ladda.LaddaWidget');
					?>
					
					<button type="button" class="btn btn-blue btn-facebook"
					onClick="logInWithFacebook()" scope="public_profile, email">
					<i class="fa fa-facebook"></i> <?=Yii::t('login', 'facebook')?>
				</button>
					
					<?= CHtml::link(Yii::t('login','olvidePass'), array("site/requestPassword/t/".$concurso->txt_token), array("class"=>"olvide"))?>

					<!-- <a class="necesito" href="">Necesito una cuenta</a> -->
					<?= CHtml::link(Yii::t('login', 'necesitarCuenta'), array("usrUsuarios/registrar/t/".$concurso->txt_token), array("class"=>"necesito")); ?>

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

