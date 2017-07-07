<?php
$porcentajeAvance = ViewAvanceTotalJuez::model ()->findAll ( array (
		"condition" => "id_contest=1" 
) );
$percent = count ( $porcentajeAvance );
$total = 0;
foreach ( $porcentajeAvance as $avance ) {
	$total += $avance->num_porcentaje;
}

$complete = $total / $percent;
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en" style="background:#2A2A2A url(<?=Yii::app()->theme->baseUrl?>/assets/images/cfm-dashboard-bkgd.png) no-repeat fixed;
    background-size: cover;">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="72x72" href="<?= Yii::app()->theme->baseUrl ?>/assets/images/apple-icon-72x72.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?= Yii::app()->theme->baseUrl ?>/assets/images/android-icon-72x72.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?= Yii::app()->theme->baseUrl ?>/assets/images/favicon-96x96.png">
<meta name="msapplication-CFM" content="<?= Yii::app()->theme->baseUrl ?>/assets/images/ms-icon-150x150.png">

<!-- Stylesheets -->
<link rel="stylesheet"
	href="<?= Yii::app()->theme->baseUrl ?>/assets/css/bootstrap.min.css">
<link rel="stylesheet"
	href="<?= Yii::app()->theme->baseUrl ?>/assets/css/bootstrap-extend.min.css">
<link rel="stylesheet"
	href="<?= Yii::app()->theme->baseUrl ?>/assets/css/site.min.css">

<!-- Plugins For This Page -->
<link rel="stylesheet"
	href="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/asrange/asRange.css">

<!-- Plugins -->
<link rel="stylesheet"
	href="<?= Yii::app()->request->baseUrl ?>/plugins/animsition/animsition.min.css">
<link rel="stylesheet"
	href="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/asscrollable/asScrollable.css">
<link rel="stylesheet"
	href="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/switchery/switchery.css">
<link rel="stylesheet"
	href="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/intro-js/introjs.css">
<link rel="stylesheet"
	href="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/slidepanel/slidePanel.css">
<link rel="stylesheet"
	href="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/flag-icon-css/flag-icon.css">
<link rel="stylesheet"
	href="<?= Yii::app()->theme->baseUrl ?>/assets/css/marka.min.css">
<link rel="stylesheet"
	href="<?= Yii::app()->theme->baseUrl ?>/assets/css/ladda-themeless.min.css">


<!-- Fonts -->
<link rel="stylesheet"
	href="<?= Yii::app()->theme->baseUrl ?>/assets/fonts/web-icons/web-icons.min.css">
<link rel="stylesheet"
	href="<?= Yii::app()->theme->baseUrl ?>/assets/fonts/brand-icons/brand-icons.min.css">
<link rel="stylesheet"
	href="<?= Yii::app()->theme->baseUrl ?>/assets/fonts/font-awesome/font-awesome.min.css">
<link rel='stylesheet'
	href='//fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/ionicons.min.css">
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/fonts/material-design/material-design.css">

<!-- Inline -->
<link rel="stylesheet"
	href="<?= Yii::app()->theme->baseUrl ?>/assets/examples/css/uikit/icon.css">

<link rel="stylesheet"
	href="<?= Yii::app()->theme->baseUrl ?>/assets/css/jquerysctipttop.css">
<link rel="stylesheet"
	href="<?= Yii::app()->theme->baseUrl ?>/assets/css/magnific-popup.css">


<!--[if lt IE 9]>
	      <script src="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/html5shiv/html5shiv.min.js"></script>
	      <![endif]-->

<!--[if lt IE 10]>
	      <script src="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/media-match/media.match.min.js"></script>
	      <script src="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/respond/respond.min.js"></script>
	      <![endif]-->

<!-- Scripts -->
<script
	src="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/modernizr/modernizr.js"></script>
<script
	src="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/breakpoints/breakpoints.js"></script>
<script>
      Breakpoints();
    </script>

<title><?=$this->title?></title>

</head>

<body class="dashboard body-page-full" style="rgba(255, 255, 255, 0);">
	<div class="animsition-loading"></div>
	<div class="animsition" data-animsition-out-class="fade-out">
		<!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
		<nav
			class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega"
			role="navigation">

			<div class="navbar-header">
				<button type="button"
					class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
					data-toggle="menubar">
					<span class="sr-only">Toggle navigation</span> <span
						class="hamburger-bar"></span>
				</button>
				<button type="button" class="navbar-toggle collapsed"
					data-target="#site-navbar-collapse" data-toggle="collapse">
					<i class="icon wb-more-horizontal" aria-hidden="true"></i>
				</button>
			</div>

			<div class="navbar-container container-fluid">
				<!-- Navbar Collapse -->
				<div class="collapse navbar-collapse navbar-collapse-toolbar"
					id="site-navbar-collapse">
					<!-- Navbar Toolbar -->
					<ul class="nav navbar-toolbar">
					</ul>
					<!-- End Navbar Toolbar -->

					<!-- Navbar Toolbar Right -->
					<ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
						<li class="dropdown">
	          			<?=CHtml::link ( '<span class="name-user">'.Yii::t('site','sessionStar').'</span><div class="btn-logout-admin"><span class="icon wb-power" aria-hidden="true"></span></div>', array ("logout/" ), array ("class" => "navbar-avatar dropdown-toggle animsition-link" ) );?>
          			</li>

					</ul>
					<!-- End Navbar Toolbar Right -->
				</div>
				<!-- End Navbar Collapse -->

			</div>
		</nav>

			<?php
		$this->renderPartial('//layouts/menu');
		?>
		<div class="site-menubar-footer">
			<a class="site-menubar-footer-desarrollado" href="http://2gom.com.mx/" target="_blank"> <?=Yii::t('site','siteDesarrollado');?> <span><?=Yii::t('site','siteDesarrolladoAuthor');?></span></a>
		</div>
		<!-- Page -->
		<div class="page padding-30" id="page">
      <?=$content?>

    </div>
		<!-- End Page -->

		
		<!-- Core  -->
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/jquery/jquery.js"></script>
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/bootstrap/bootstrap.js"></script>
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/animsition/jquery.animsition.js"></script>
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/asscroll/jquery-asScroll.js"></script>
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/mousewheel/jquery.mousewheel.js"></script>
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/asscrollable/jquery.asScrollable.all.js"></script>
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

		<!-- Plugins -->
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/switchery/switchery.min.js"></script>
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/intro-js/intro.js"></script>
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/screenfull/screenfull.js"></script>
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/slidepanel/jquery-slidePanel.js"></script>

		<!-- Plugins For This Page -->
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/vendor/asrange/jquery-asRange.min.js"></script>

		<!-- Scripts -->
		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/js/core.js"></script>
		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/js/site.js"></script>

		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/js/sections/menu.js"></script>
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/js/sections/menubar.js"></script>
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/js/sections/gridmenu.js"></script>
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/js/sections/sidebar.js"></script>

		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/js/configs/config-colors.js"></script>
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/js/configs/config-tour.js"></script>

		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/js/components/asscrollable.js"></script>
		<script
			src="<?= Yii::app()->request->baseUrl ?>/plugins/animsition/animsition.min.js"></script>
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/js/components/slidepanel.js"></script>
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/js/components/switchery.js"></script>

		<!-- Scripts For This Page -->
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/examples/js/uikit/icon.js"></script>


		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/js/marka.min.js"></script>

		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/js/spin.min.js"></script>
		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/js/ladda.min.js"></script>
		<script
			src="<?= Yii::app()->theme->baseUrl ?>/assets/js/jquery.magnific-popup.js"></script>
		<script src="<?= Yii::app()->theme->baseUrl ?>/js/cfmadmin.js"></script>
		<script>

	$(document).ready(function(){
	});
	
      (function(document, window, $) {
        'use strict';

        var Site = window.Site;
        $(document).ready(function() {
          Site.run();
        });
      })(document, window, jQuery);


      $(document).ready(function() {
    	  $(".animsition").animsition({loading: false});
    	  $(".site-menu-item a").on("click", function(e){
				e.preventDefault();
				$('.animsition').animsition('out', $("body"), $(this).attr("href"));
        	});
      });
      $('.animsition').on('animsition.inStart', function(){
			$(".animsition-loading").hide();
          });

      $('.animsition').on('animsition.outStart', function(){
    	  $(".animsition-loading").show();
          });

    </script>
	</div>
</body>

</html>
