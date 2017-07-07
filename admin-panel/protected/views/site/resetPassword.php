<?php
/* @var $this UsrUsuariosController */
/* @var $competidor UsrUsuarios */
/* @var $datosWeb UsrUsuariosWebsites */
/* @var $datosTelefonos UsrUsuariosTelefonos */
/* @var $form CActiveForm */
?>


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

				<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/login.png"
					alt="CFM">
				<h1>Comite Fotográfico Mexicano</h1>

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


					<p>Por favor ingresa una nueva contraseña</p>


					<?php echo $form->passwordField($model,'txt_password',array('size'=>10,'maxlength'=>10,"class"=>"form-control",'placeholder'=>'Contraseña')); ?>

					<?php echo $form->passwordField($model,'repetirPassword',array("class"=>"form-control",'placeholder'=>'Repetir contraseña')); ?>

					<?php # echo $form->error($model,'username'); ?>
					
					<?php 
					$getErrors=($model->getErrors());
					if(!empty($getErrors)){?>
					<div class="errorMessage">No se ingreso datos o las contraseñas no son iguales.</div>
					<?php }?>

					<?php echo CHtml::submitButton('Ingresar', array("class"=>"btn btn-blue")); ?>

					<?php echo CHtml::link("Necesito una cuenta", array("usrUsuarios/registrar", "t"=>$t), array("class"=>"necesito")); ?>

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