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
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/normalize.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/asScrollable.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/toastr.min.css">
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ladda-themeless.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/cfm.css">
<script>
var base = '<?php echo Yii::app()->request->baseUrl; ?>/';
</script>
    <script src="<?php echo Yii::app()->baseUrl ?>/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl ?>/js/cfm.js"></script>
    <script src="<?php echo Yii::app()->baseUrl ?>/plugins/form/jquery.form.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/toastr.min.js"></script>

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
    <section class="wrap">

      <!-- header -->
      <header class="header-error">
        <div class="container-fluid">
          <div class="row">
            <!-- .logo -->
            <div class="logo col-xs-6 col-sm-6 col-md-4">
              <a href="<?=Yii::app()->request->baseUrl?>">
                <!-- <span style="background-image: url(<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png)"></span> -->
              </a>
            </div>
            <!-- end / .logo -->

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
      
      <!-- footer -->
      <footer class="footer-fixed">
        <a href="http://2gom.com.mx/" target="_blank">powered by 2 Geeks one Monkey</a>
      </footer>
      <!-- end / footer -->

    </section>
    <!-- end / .wrap -->
    
    <!-- Script's -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.mousewheel.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.asScrollbar.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/holder.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.asScrollable.js"></script>
    
      <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/spin.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/ladda.min.js"></script>
    
    <script>

<?php if(Yii::app()->user->hasFlash('success')):?>

	toastrSuccess("<?php echo Yii::app()->user->getFlash('success'); ?>");

<?php endif; ?>

<?php 
$sessionComplete = Yii::app()->user->getState("complete");
if(isset($sessionComplete)){
	echo 'toastrSuccess("'.Yii::app()->user->complete.'");';
	Yii::app()->user->setState("complete", null);
}?>

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

  </body>
</html>