<?php 
$this->title = "Login";
?>
<!-- Page -->
<div class="page animsition vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
	<div class="page-content vertical-align-middle dgom-ui-page-login">

		<div class="brand">
			<img class="brand-img"
				src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/logo-login.png"
				alt="Comite">
			<h2 class="brand-text">Comité Fotográfico Mexicano</h2>
		</div>
		<?php
		$form = $this->beginWidget ( 'CActiveForm', array (
				'id' => 'login-form',
				
		) );
		?>

		<div class="form-group">
			<?php echo $form->labelEx($model,'username', array("class"=>"sr-only")); ?>
			<?php echo $form->textField($model,'username', array("class"=>"form-control","required"=>"required", "placeholder"=>"Usuario" )); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>
		<div class="form-group">
			<?php echo $form->labelEx($model,'password', array("class"=>"sr-only")); ?>
			<?php echo $form->passwordField($model,'password', array("class"=>"form-control","required"=>"required", "placeholder"=>"Password" )); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>
		<?php echo CHtml::submitButton('Sign in', array("class"=>"btn btn-primary btn-block")); ?>
		<?php
		$this->endWidget ();
		?>
		<!-- 
		<p>Still no account? Please go to <a href="register.html">Register</a></p>
		 -->
		<footer class="page-copyright page-copyright-inverse dgom-ui-page-login-footer">
			<p>
				Desarrollado por <a href="http://2gom.com.mx/" target="_blannk">2 Geeks one Monkey</a>
			</p>
			<p>© 2015. All RIGHT RESERVED.</p>
		</footer>

	</div>
</div>
<!-- End Page -->

</div>
