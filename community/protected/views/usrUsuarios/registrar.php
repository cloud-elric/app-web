<?php
/* @var $this UsrUsuariosController */
/* @var $competidor UsrUsuarios */
/* @var $datosWeb UsrUsuariosWebsites */
/* @var $datosTelefonos UsrUsuariosTelefonos */
/* @var $form CActiveForm */
$this->pageTitle = Yii::t('general', 'registrarTitle');
$cs = Yii::app ()->getClientScript ();
$cs->registerScriptFile ( Yii::app ()->request->baseUrl . "/js/facebook/fb.js" );
?>

<div class="registro container">
	<div class="row">
		<div class="col-sm-12 col-md-12">

			<h2><?=Yii::t('registrar', 'header')?></h2>

			<!-- form -->
			<?php
			
			$form = $this->beginWidget ( 'CActiveForm', array (
				'id' => 'usr-usuarios-form',
				'htmlOptions' => array (
						'enctype' => 'multipart/form-data' 
				),
				'enableAjaxValidation' => false 
			) );
			?>
				
				<!-- .form-body -->
			<div class="form-body">

				<p><?=Yii::t('registrar', 'instrucciones')?>
				</p>

				<div class="row">

					<div class="col-sm-4 col-md-4 padding-left-0 text-center">

						<label class="myFile">
							<div class="myFiler">
								<img id="previewImage">
								<p><?=Yii::t('registrar', 'upload')?></p>
							</div>
							<p><?=Yii::t('registrar', 'imgMaxSize')?></p>
							<p><?=Yii::t('registrar', 'imgsize')?></p>
							<?php echo $form->fileField($competidor,'nombreImagen', array("class"=>"imageProfile")); ?>
						</label>
					</div>

					<div class="col-sm-4 col-md-4">
							
						<?php echo $form->textField($competidor,'txt_nombre',array('size'=>50,'maxlength'=>50,"class"=>"form-control",'placeholder'=>Yii::t('registrar', 'nombre'))); ?>
						<?php # echo $form->error($competidor,'txt_nombre'); ?>

						<?php echo $form->textField($competidor,'txt_apellido_paterno',array('size'=>50,'maxlength'=>50,"class"=>"form-control",'placeholder'=>Yii::t('registrar', 'apellido'))); ?>
						<?php # echo $form->error($competidor,'txt_apellido_paterno'); ?>

						<?php echo $form->passwordField($competidor,'txt_password',array('size'=>10,'maxlength'=>20,"class"=>"passwordFix form-control",'placeholder'=>Yii::t('registrar', 'pass'))); ?>
						
						<?php echo $form->passwordField($competidor,'repetirPassword',array("class"=>"form-control passwordFix",'placeholder'=>Yii::t('registrar', 'repeatPass'))); ?>
						<?php # echo $form->error($competidor,'repetirPassword'); ?>


					</div>
					<div class="col-sm-4 col-md-4">

						<?php echo $form->textField($datosTelefonos,'txt_telefono',array('size'=>13,'maxlength'=>10,"class"=>"form-control",'placeholder'=>Yii::t('registrar', 'telefono'))); ?>
						<?php # echo $form->error($datosTelefonos,'txt_telefono'); ?>

						<?php echo $form->textField($competidor,'txt_correo',array('size'=>50,'maxlength'=>50,"class"=>"form-control",'placeholder'=>Yii::t('registrar', 'email'))); ?>
						<?php # echo $form->error($competidor,'txt_correo'); ?>

						<?php echo $form->textField($datosWeb,'txt_url',array("class"=>"form-control",'placeholder'=>Yii::t('registrar', 'webSite'))); ?>
						
						<?php echo $form->dropDownList($competidor,'id_pais',$paises,array('prompt'=>Yii::t('registrar', 'pais'),"class"=>"form-control", 'style'=>'margin-top:16px')); ?>
						
						<?php # echo $form->error($datosWeb,'txt_url'); ?>
						
					</div>
					
					
				</div>

					<?php
					$hasErrorCompetidor = $competidor->getErrors(); 
					$hasErrorTel = $datosTelefonos->getErrors();
					$hasErrorWeb = $datosWeb->getErrors();
					
					if(!empty($hasErrorCompetidor)||!empty($hasErrorTel)||!empty($hasErrorWeb)){
					?>
					<div class="errores">
				
						<?php echo $errorMessage?>
					</div>
						
					<?php }?>
				</div>
			<!-- end / .form-body -->

			<!-- .form-footer -->
			<div class="form-footer">
				<div class="row">
					<div class="col-sm-6 col-md-6">
					<?php echo CHtml::link(Yii::t('registrar', 'miembro')." <div class='ripple'></div>",array("site/login"), array("class"=>"btn btn-blue paper"))?>
					</div>
					<div class="col-sm-6 col-md-6">
						<?php # echo CHtml::submitButton("Crear cuenta <div class='ripple'></div>", array("class"=>"btn btn-green paper")); ?>
						<!-- <button class="btn btn-green paper registrar-btn"><?=Yii::t('registrar', 'submit')?> <div class='ripple'></div></button>-->
						<button class="btn btn-green btn-pagar ladda-button registrar-btn"  data-style="zoom-out"><span class="ladda-label"><?=Yii::t('registrar', 'submit')?></span></button>
					</div>
				</div>

				<!-- <div class="btn btn-blue paper">
					<p id="num">1</p>
					<div class='ripple'></div>
				</div> -->


			</div>
			<!-- end / .form-footer -->

			<?php $this->endWidget(); ?>
			<!-- end / form -->

		</div>
	</div>
</div>

<script>
	
$(".registrar-btn").on("click", function(e){
	e.preventDefault();
	var l = Ladda.create(this);
 	l.start();
	
	$("form").submit();
	
})	
	
//Create the preview image 
var _URL = window.URL || window.webkitURL;
$(".imageProfile").on("change",function (){    
    var file = this.files[0];
    var imagefile = file.type;
    var match= ["image/jpeg","image/png","image/jpg","image/gif"];


    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3])))
    {
        toastrError("<?=Yii::t('registrar', 'fileNoValid')?>");
		return false;
    }

    var img;
    if ((file = this.files[0])) {
        img = new Image();
        img.onload = function () {
            //alert(this.width + " " + this.height);
        	if(this.width <= 360 && this.height <= 360){
//         		alert("La imagen es muy grande");
//         		$(this).value = "";
        	
  
    var reader = new FileReader();
    // Set preview image into the popover data-content
    reader.onload = function (e) {

    	$(".myFiler").css('opacity', '1');
    	$(".myFiler p").hide();
    	$(".myFile p").css('opacity', '.45');
    	$("#previewImage").removeAttr( 'style' );


$('#previewImage').load(function() {


		// $("#previewImage").attr('src', e.target.result);

        $(".myFiler").css("background-image", "none");


        // Obtiendo tamaños de la imagen
		var imgS = document.getElementById('previewImage');
		var realWidth = imgS.clientWidth;
		var realHeight = imgS.clientHeight;


		// alert(realWidth + " - " + realHeight);

		// Asignando Alto o Ancho a imagen
    	if(realWidth >= realHeight){
    		$("#previewImage").css("height", "120px");
    	}
    	else if(realHeight > realWidth){
    		$("#previewImage").css("width", "120px");
    	}




    	// Variables para centrar imagen
    	var modWidth = $("#previewImage").width();
		var modHeight = $("#previewImage").height();

		var modWidthMide = modWidth / 2;
		var modHeightMide = modHeight / 2;


		// Ajustando la imagen al centro
    	if(realWidth >= realHeight){
    		$("#previewImage").css("marginLeft", "-" + modWidthMide + "px");
    		$("#previewImage").css("left", "50%");
    	}
    	else if(realHeight > realWidth){
    		$("#previewImage").css("marginLeft", "-" + modWidthMide + "px");
    		$("#previewImage").css("left", "50%");
    		$("#previewImage").css("marginTop", "-" + modHeightMide + "px");
    		$("#previewImage").css("top", "50%");
    	}
    	

}).attr('src',e.target.result);



    	
        
       
    }        
    reader.readAsDataURL(file);
    console.log(file);

        	}else{
        		toastrError("La imagen es muy grande");
        	}
        };
        img.src = _URL.createObjectURL(file);
    }



});


</script>