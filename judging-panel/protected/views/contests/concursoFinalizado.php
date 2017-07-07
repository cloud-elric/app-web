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
						alt="">
				</h2>
				<!-- <button type="button" class="btn btn-blue">Consulta las bases del concurso</button> -->
				<a href="https://comitefotomx.com/concurso/#Bases" target="_blank" class="btn btn-blue">Comite</a>
			</div>
		</div>
		<!-- end / .col -->

		<!-- .col -->
		<div class="login-col-flex col-sm-6 col-md-6">
			<!-- .login-form -->
			<div class="login-form concurso-finalizado">

				<img src="<?= Yii::app()->request->baseUrl ?>/images/hardcode/WPC-Logo.png" alt="CFM">
				<!-- <h1>Title</h1> -->

				<p>
					El periodo para concursar ha finalizado y estamos evaluando tus fotográfias
				</p>
				<p>
					Los Ganadores serán anunciados en <a href="http://comitefotomx.com">nuestra página</a> y redes sociales el 1ro de Septiembre de 2016
				</p>
				<p>
					Si ya estas inscrito te deseamos mucho éxito y queremos agradecerte el haber participado en esta edición del concurso
				</p>
				<p>¡ Gracias !</p>

				<span>- Marian Blake</span>
				<span>Directora del Comite</span>
				<span class="margin-bottom-40">Fotográfico Mexicano</span>

				
				<button type="button" class="btn btn-blue btn-facebook" onClick="logInWithFacebook()" scope="public_profile, email">
					<i class="fa fa-facebook"></i> Siguenos en Facebook
				</button>
					

				<div class="all-right">&copy; <?=date('Y')?> <?=Yii::t('general','derechos')?></div>

			</div>
			<!-- end / .login-form -->
		</div>
		<!-- end / .col -->

	</div>
	<!-- end / .row -->
</div>
<!-- end / .login -->