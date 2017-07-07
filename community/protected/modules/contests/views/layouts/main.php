<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

		<!-- Favicon -->
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-icon-72x72.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo Yii::app()->request->baseUrl; ?>/images/android-icon-72x72.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon-96x96.png">
		<meta name="msapplication-CFM" content="<?php echo Yii::app()->request->baseUrl; ?>/images/ms-icon-150x150.png">

		<!-- Style -->
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/normalize.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/bootstrap-extend.min.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ionicons.min.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/asScrollable.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/toastr.min.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/magnific-popup.css">

		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/cfm.css">
		
		<script src="<?php echo Yii::app()->baseUrl ?>/js/jquery-1.9.1.min.js"></script>
		
    	<script src="<?php echo Yii::app()->baseUrl ?>/js/cfm.js"></script>
		<script src="<?php echo Yii::app()->baseUrl ?>/plugins/form/jquery.form.js"></script>

		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-78503947-3', 'auto');
  ga('send', 'pageview');

</script>
	</head>
	<body>
		
		<!-- .wrap -->
		<section class="wrap wrap-bg">

			<!-- header -->
			<header class="header-user">
				<div class="container-fluid">
					<div class="row">
						<!-- .logo -->
						<div class="logo col-xs-6 col-sm-6 col-md-4">
							<a href="http://www.comitefotomx.com" target="_blank">
								<span style="background-image: url(<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png)"></span>
								<h1>Haz clic con México</h1>
							</a>
						</div>
						<!-- end / .logo -->

						<!-- .user -->
						<div class="user col-xs-6 col-sm-6 col-md-8">
							<!-- .pago-seleccion-user -->
							<div class="pago-seleccion-user">
								
								<p>Hola  <?=CHtml::encode(Yii::app()->user->concursante->txt_nombre)?></p>

								<!-- .pago-seleccion-user-flip -->
								<div class="pago-seleccion-user-flip">

									<!-- .pago-seleccion-user-flip-front-side -->
									<div class="pago-user-flip pago-seleccion-user-flip-front-side" data-flip="front">
										<?php if(empty(Yii::app()->user->concursante->txt_image_url)){?>
										<span style="background-image: url(<?php echo Yii::app()->theme->baseUrl; ?>/images/users.jpg)"></span>
										<?php }else if(Yii::app()->user->concursante->b_login_social_network){?>
										<span style="background-image: url(<?=Yii::app()->user->concursante->txt_image_url?>)"></span>
										<?php }else{?>
										<span style="background-image: url(<?=Yii::app()->request->baseUrl."/images/profiles/".Yii::app()->user->concursante->txt_usuario_number."/".Yii::app()->user->concursante->txt_image_url?>)"></span>
										<?php }?>
									</div>
									<!-- end / .pago-seleccion-user-flip-front-side -->

									<!-- .pago-seleccion-user-flip-back-side  -->
									<div class="pago-user-flip pago-seleccion-user-flip-back-side closeSession" data-flip="back">

										<?php echo CHtml::link('<i class="icon ion-power"></i>',array('site/logout'), array("class"=>"pago-seleccion-user-logout")); ?>

										<!-- <a href="#" class="pago-seleccion-user-logout" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="icon ion-power"></i></a> -->
									</div>
									<!-- end / .pago-seleccion-user-flip-back-side  -->
								</div>
								<!-- end / .pago-seleccion-user-flip -->

							</div>
							<!-- end / .pago-seleccion-user -->

						</div>
						<!-- end / .user -->

					</div>
					<!-- end / .row -->
				</div>
				<!-- end / .container -->
			</header>
			<!-- end / header -->

			<!-- main -->
			<main>
				
				<?php echo $content; ?>

			</main>
			<!-- end / main -->
			

		</section>
		<!-- end / .wrap -->

		<!-- Script's -->
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>

		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.mousewheel.min.js"></script>
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.asScrollbar.js"></script>
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/holder.js"></script>
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.asScrollable.js"></script>

		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/toastr.min.js"></script>

		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.magnific-popup.js"></script>

    <script>

<?php if(Yii::app()->user->hasFlash('success')):?>

	toastrSuccess("<?php echo Yii::app()->user->getFlash('success'); ?>");

<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('info')):?>

toastrInfo("<?php echo Yii::app()->user->getFlash('info'); ?>");

<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('warning')):?>

toastrWarning("<?php echo Yii::app()->user->getFlash('warning'); ?>");

<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('error')):?>

toastrError("<?php echo Yii::app()->user->getFlash('error'); ?>");

<?php endif; ?>

</script>

<script>
// $(document).ready(function() {
// 	$('.popup-gallery').magnificPopup({
// 	delegate: 'a',
// 	type: 'image',
// 	tLoading: 'Loading image #%curr%...',
// 	mainClass: 'mfp-img-mobile',
// 	gallery: {
// 	enabled: true,
// 	navigateByImgClick: true,
// 	preload: [0,1] // Will preload 0 - before current, and 1 after the current image
// 	},
// 	image: {
// 	tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
// 	titleSrc: function(item) {
// 	return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
// 	}
// 	}
// 	});
// });
</script>


	</body>
</html>