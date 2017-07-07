<?php 
$this->title = Yii::t('site', 'Photo Judging - Photo Review');
?>
<div id="page" class="photo-page">
			<?php
			$form = $this->beginWidget ( 'CActiveForm', array (
					'id' => 'calificar-foto-form',
					'action' => Yii::app()->createUrl('judgingPanel/saveCal' , array('idCategoria'=>$idCategoria, 't'=>$t, "idPic" => $photoCalificar->txt_pic_number)),
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// There is a call to performAjaxValidation() commented in generated controller code.
					// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation' => false 
			) );
			?>
	<!-- Loading Juez -->
	<div class="dgom-ui-loading-juez">
		<div class="loader-default loader vertical-align-middle"
			data-type="default"></div>
	</div>

	<!-- Panel de Buttons -->
	<div class="photo-toolbar dgom-ui-btn-wrapper ">
		<?= CHtml::link(Yii::t('photoReview', 'return'),array('judgingPanel/index',"t"=>$t), array("class"=>"dgom-ui-Btn dgom-ui-a")); ?>
		
		<!-- dgom-js-beginReview -->
		<button id="dgom-js-pintar-photo-wrap-panel-score" class="dgom-ui-Btn dgom-ui-Btn-photoReview"><?=Yii::t('photoReview', 'beginReview')?></button>
	</div>


	<section class="dgom-ui-pintar-photo-wrap">
		<div class="dgom-ui-pintar-photo-wrap-panel dgom-ui-pintar-photo-wrap-panel-score">
			
			<div class="row rowTotal margin-0">
				<!-- Category -->
				<div class="col-md-7 text-left">
					<p class="margin-0"><?=Yii::t('site','category')?>:</p>
					<h2 class="margin-vertical-3 dgom-ui-pintarFoto-text-categoria"><?=$photoCalificar->idCategoryOriginal->txt_name?></h2>
					<div class="example margin-0 text-left">
						<?php
						$photoCalificar->id_category = NULL;
						echo $form->dropDownList ( $photoCalificar, "id_category", $categoriasList, array (
								"class" => "form-control select2-hidden-accessible select-2-style",
								"data-plugin" => "select2",
								"tabindex" => "-1",
								"aria-hidden" => "true",
								"prompt" => "Swap Category" 
						) )?>
					</div>
					<div class="row">
						<article class="col-lg-12 col-sm-12 pull-ok">

							<label for="inputUnchecked"><?=Yii::t('photoReview','mention')?></label>
							<?php
							echo CHtml::checkBox ( "b_mencion", false, array (
									"class" => "icheckbox-primary",
									"id" => "inputUnchecked",
									"data-plugin" => "iCheck",
									"data-checkbox-class" => "icheckbox_flat-blue icheckbox_flat-blue-radius" 
							) )?>

						</article>
					</div>
				</div>
				<!-- Total Score -->
				<div class="col-lg-5 col-sm-5 col-md-5 text-center" style="margin-top: 60px;">
					<p class="margin-bottom-0 dgom-ui-content-input-progress-p"><?=Yii::t('photoReview','total')?></p>
					<p id="dgom-ui-content-input-progress-p-total" class="dgom-ui-content-input-progress-p" style="color: #75E268; font-size: 2.4em; margin-left: 14px; font-weight: bold;">4</p>
					<!--
					<div class="dgom-ui-content-input-progress-canvas">
						<input type="text" class="knob-chart knob-example-1"
							data-plugin="knob" data-fg-color="#75E268" data-min="0"
							data-max="100" value="4" disabled data-readonly="false"/>
					</div>-->
				</div>
			</div>

						

			<div class="row margin-0">
				
				<?php
				$index = 1;
				foreach ( $rubros as $rubro ) {
					
					?>
					<div class="col-sm-12 dgom-ui-score-sliders">
					<div class="row rowRange">
						<div class="col-sm-10">
							<div class="example-wrap">
								<h4 class="example-title"><?=$rubro->txt_nombre?></h4>
								<div class="example">
									<div class="asRange rangeUi asRange-<?=$index?>"
										data-plugin="asRange" data-namespace="rangeUi" data-value="1"></div>
								</div>
							</div>
							<p class="rowRange-p as-Range-<?=$index?>"><?=Yii::t('photoReview','level1')?></p>
						</div>

						<div class="col-sm-2" tabindex="0">
								<?=$form->hiddenField($photoCalificar, "WrkPicsCalificaciones[$rubro->id_rubro]num_calificacion", array("class"=>"dgom-js-sum dgom-js-calificacion-".$index, "value"=>1))?>
								<span class="rangeRight js-valRange-<?=$index?>">1 </span>
						</div>

					</div>
				</div>
				<?php
					$index ++;
				}
				?>
			
				<div class="col-sm-12 text-right">
					<div class="checkbox-custom checkbox-primary">
	                  <?=CHtml::checkbox('isCalificada')?>
	                  <label for="isCalificada"><?=Yii::t('photoReview', 'isCalificada')?></label>
	                </div>
                </div>

                <?php # CHtml::checkbox('isCalificada')?>
				<!-- <label for='isCalificada'><?php # Yii::t('photoReview', 'isCalificada')?></label> -->
				
			</div>
			
		</div>
				
		<!-- Button -->
		<div class="row">
			
			<div class="col-lg-12 col-sm-12 form-group padding-vertical-15 text-center">
				<button type="submit" class="btn btn-primary enviar ladda-button dgom-ui-pintarFoto-next" id="dgom-js-next-photo" data-style="zoom-out"><span class="ladda-label">
				<?php 
				if(empty($hasFeedback) || empty($relJuezCat)){
					echo Yii::t('photoReview','nextWithoutFeed'); 	
				}else{
					echo Yii::t('photoReview','next');					
				}
				?>
				</span></button>
				<!-- .dgom-ui-pintarFoto-next-message -->
				<div class="dgom-ui-pintarFoto-next-message dgom-ui-pintarFoto-next-message-alert">
				
					<?=Yii::t('photoReview','messageNextPintarFoto');?>
				</div>
				<!-- end / .dgom-ui-pintarFoto-next-message -->
			</div>
		</div>

		<div class="row dgom-ui-alert-invalid alert margin-right-20"
			style="display: none;"><?=Yii::t('photoReview','minimunText')?></div>

	</section>

	<section class="dgom-ui-photo-wrapper">
		<div class="dgom-ui-photo">
			<!--<img style="display: none;" id="dgom-js-bkgdImage" name="dgom-js-bkgdImage" src="<?php echo Yii::app ()->params ['pathBaseImages']."con_". $concurso->txt_token."/idu_". $photoCalificar->iD->txt_usuario_number.DIRECTORY_SEPARATOR."large_".$photoCalificar->txt_file_name?>">-->
			<img style="display: none;" id="dgom-js-bkgdImage" name="dgom-js-bkgdImage" src="<?php echo Yii::app ()->params ['pathBaseImages']."con_". $concurso->txt_token."/idu_". $photoCalificar->iD->txt_usuario_number.DIRECTORY_SEPARATOR.$photoCalificar->txt_file_name?>">
		</div>
	</section>
	
	<?php $this->endWidget(); ?>
</div>
<?php
/**
 *
 * @todo meterlo al ciclo foreach de los rubros
 */
Yii::app ()->clientScript->registerScript ( 'my vars', '
$(document).ready(function(){

	var heightScreenOriginal = $( window ).height();
	$(".dgom-ui-photo").css("height", heightScreenOriginal);
	
	// Si es Safari, usar height por pixeles
	var ua = navigator.userAgent.toLowerCase(); 
	if (ua.indexOf("safari") != -1) { 
	  if (ua.indexOf("chrome") > -1) {
	    // console.log("chrome");
	  } else {
	  	// console.log("safari");
	    $(".dgom-ui-pintar-photo-wrap").css("height", heightScreenOriginal);
		$(".dgom-ui-pintar-photo-wrap-panel").css("height", heightScreenOriginal - 140);
	  }
	}
		

	$("button").on("click", function(e){
		e.preventDefault();
	});
	
	$("<img/>").on("load", function() {
		
		$(".dgom-ui-loading-juez").css("display","none");
		$("#dgom-js-bkgdImage").css("display","inline-block");

		var imgs = document.getElementById("dgom-js-bkgdImage");
		winDim = getWinDim();

		$("#dgom-js-bkgdImage").css("height", winDim.y);
		
		if (imgs.offsetWidth >= winDim.x)
		{
			$("#dgom-js-bkgdImage").removeAttr( "style" );
			$("#dgom-js-bkgdImage").css("width", winDim.x);
		}
	

	}).attr("src", $("#dgom-js-bkgdImage").attr("src"));
	// Obtener dimensiones del Screen del dispositivo
	function getWinDim()
	{
	    var body = document.documentElement || document.body;

	    return {
	        x: window.innerWidth  || body.clientWidth,
	        y: window.innerHeight || body.clientHeight
	    }
	}


	// Enviar formulario
	$(".enviar").on("click",function(event){
		event.preventDefault();
		// var texto = $("#textareaDefault").val();
		

		$("form").submit();

		// if(texto.length>=30){
		// 	$(".btn-load").addClass("btn-load-spinner");
		// 	$("form").submit();
		// }else{
		// 	$(".btn-load").addClass("btn-load-spinner");
		// 	$(".alert").css("display", "block");
		// }
	});

	// Quitar clase de fondo
	$("body").removeClass("body-page-full");
	
	// Sumas Rangos
	function sumVal(){
		var sum = 0;
		
		$( ".dgom-js-sum" ).each(function( index ) {
  			sum += parseInt( $( this ).val());
		});
		
		console.log(sum);
		// $(".knob-chart").val(sum).trigger("change");
		$("#dgom-ui-content-input-progress-p-total").text(sum);
	}	
	
	// Coloca el texto de acuerdo a la calificacion	
	function changeTextRange(index, val){
		var instanceText = "";
		
		if(val>=1 && val<=5){
			instanceText = "'.Yii::t('photoReview','level1').'";
		}else if(val>=6 && val<=10){
			instanceText = "'.Yii::t('photoReview','level2').'";
		}else if(val>=11 && val<=15){
			instanceText = "'.Yii::t('photoReview','level3').'";
		}else if(val>=16 && val<=20){
			instanceText = "'.Yii::t('photoReview','level4').'";
		}else if(val>=21 && val<=25){
			instanceText = "'.Yii::t('photoReview','level5').'";
		}
		
		$(".as-Range-"+index).text(instanceText);	
	}
	
	// Rango Impact
	$(".asRange-1").asRange({
		namespace: "rangeUi",
		skin: null,
        max: 25,
        min: 1,
		scale: false,
        tip: false,
        step: 1,
        onChange: function(instance) {
	    	$(".js-valRange-1").text(instance);
			$(".dgom-js-calificacion-1").val(instance);
		sumVal();
		changeTextRange(1, instance);
	    },
	});
	
	// Rango Creativity
	$(".asRange-2").asRange({
		namespace: "rangeUi",
		skin: null,
        max: 25,
        min: 1,
		scale: false,
        tip: false,
        step: 1,
        onChange: function(instance) {
	    	$(".js-valRange-2").text(instance);
			$(".dgom-js-calificacion-2").val(instance);
		sumVal();
		changeTextRange(2, instance);
	    },
	});
	
	// Rango Composition
	$(".asRange-3").asRange({
		namespace: "rangeUi",
		skin: null,
        max: 25,
        min: 1,
		scale: false,
        tip: false,
        step: 1,
        onChange: function(instance) {
	    	$(".js-valRange-3").text(instance);
			$(".dgom-js-calificacion-3").val(instance);
		sumVal();
		changeTextRange(3, instance);
	    },
	});
	
	// Rango Technicall Excelence
	$(".asRange-4").asRange({
		namespace: "rangeUi",
		skin: null,
        max: 25,
        min: 1,
		scale: false,
        tip: false,
        step: 1,
        onChange: function(instance) {
	    	$(".js-valRange-4").text(instance);
			$(".dgom-js-calificacion-4").val(instance);
		sumVal();
		changeTextRange(4, instance);
	    },
	});

	//
	addHeight();
	
	// Agregar height a las 3 columnas de Evaluador
	function addHeight(){
		var heightScreen = $( window ).height();
		$(".dgom-ui-evaluador-content").css("height", heightScreen);
		$(".dgom-ui-col-int-right-bg").css("height", heightScreen);
		$(".dgom-ui-col-int-right-text").css("height", heightScreen);
	}

	$(window).on("resize", function(){
		addHeight();
	});
	
	// Click para esconder columnas en FullScreen
	$(".dgom-js-hide-juez").click(function() {
		$(".dgom-js-col-1").hide();
		$(".dgom-ui-full").show();
		$(".dgom-js-evaluador-fullScreen").show();
	});
	
	// Esc para esconder columnas en FullScreen
	$(document).keydown(function(tecla){ 
	    if (tecla.keyCode == 27) { 
	        alert();
	        $(".dgom-js-evaluador-col-1").show();
			$(".dgom-js-evaluador-col-2").show();
			$(".dgom-js-evaluador-fullScreen").hide();
	    } 
	});

	// Click para mostrar columnas en resolución normal
	$(".dgom-js-show-juez").click(function() {
		$(".dgom-js-col-1").show();
		$(".dgom-ui-full").hide();
		$(".dgom-js-evaluador-fullScreen").hide();
		addHeight();
	});

	// Btn para mostar FitScreen
	$(".dgom-js-show-fitScreen").click(function() {
		$(".dgom-js-evaluador-col-1").hide();
		$(".dgom-js-evaluador-col-2").hide();
		$(".dgom-js-evaluador-fullScreen").hide();
		$(".dgom-js-evaluador-fitScreen").show();
		$(".dgom-ui-wrapper-content").addClass("dgom-ui-fullSize");
	});

	// Btn para ocultar FitScreen
	$(".dgom-js-hidden-fitScreen").click(function() {
		$(".dgom-js-evaluador-col-1").hide();
		$(".dgom-js-evaluador-col-2").hide();
		$(".dgom-js-evaluador-fullScreen").show();
		$(".dgom-js-evaluador-fitScreen").hide();
		$(".dgom-ui-wrapper-content").removeClass("dgom-ui-fullSize");
	});

	// Loading button de Next Photo
	$("#dgom-js-next-photo").click(function(){
	 	var l = Ladda.create(this);
	 	// var valTextArea = $("textarea").val();
	 	
		$(this).prop("disabled", true);
	 	l.start();

	 // 	if(valTextArea.length>30){
	 // 		$(this).prop("disabled", true);
	 // 		l.start();
	 // 	}else{
	 // 		e.preventDefault();
	 // 		// Deshabilitar boton
		// 	$("#dgom-js-next-photo").prop("disabled", true);
		// 	// Mostar animación y agregar mensaje
		// 	$(".dgom-ui-pintarFoto-next-message").animate({ "bottom": "80px" }, 600 );
		// 	// $(".dgom-ui-pintarFoto-next-message").html("Para continuar, debes calificar la FOTO.");
		// 	// Ocultar message de error - next foto
		// 	setTimeout(hideMessageNext, 3800);
		// }
	 	
	});

	function hideMessageNext() {
		$(".dgom-ui-pintarFoto-next-message").animate({ "bottom": "-100px" }, 600 );
		$("#dgom-js-next-photo").prop("disabled", false);
		$(".dgom-ui-pintarFoto-next-message").removeAttr("style");
	}


	var panelSelect = false;
	// View Colums (Left-Right)
	$("#dgom-js-pintar-photo-wrap-panel-score").on("click",function(){
		// alert(panelSelect);

		if(!panelSelect){
			$("#dgom-js-pintar-photo-wrap-panel-score").removeClass("dgom-ui-Btn-photoReview-on");
			// Mask
			$(".dgom-ui-pintar-photo-wrap").addClass("dgom-ui-pintar-photo-wrap-mask");
			// Cambio de texto
			$(this).html("Hide Review");
			// Mostrar Paneles
			$(".dgom-ui-pintar-photo-wrap-panel-score").addClass("dgom-ui-pintar-photo-wrap-panel-score-view");
			
			// Colocar Imagen de fondo
			$("#dgom-js-bkgdImage").hide();
			$(".dgom-ui-photo").addClass("dgom-ui-photo-bg-full");
			//$(".dgom-ui-photo").css("backgroundImage", "url('. Yii::app ()->params ["pathBaseImages"]."idu_".$photoCalificar->iD->txt_usuario_number.DIRECTORY_SEPARATOR."/large_".$photoCalificar->txt_file_name .')");
			$(".dgom-ui-photo").css("backgroundImage", "url('. Yii::app ()->params ["pathBaseImages"]."idu_".$photoCalificar->iD->txt_usuario_number.DIRECTORY_SEPARATOR."/large_".$photoCalificar->txt_file_name .')");
			panelSelect = true;
		}
		else{
			// Mask
			$(".dgom-ui-pintar-photo-wrap").removeClass("dgom-ui-pintar-photo-wrap-mask");
			// Cambio de texto
			$(this).html("Begin Review");
			// Ocultar Paneles
			$(".dgom-ui-pintar-photo-wrap-panel-score").removeClass("dgom-ui-pintar-photo-wrap-panel-score-view");

			// Quitar Imagen de fondo
			$("#dgom-js-bkgdImage").show();
			$(".dgom-ui-photo").removeClass("dgom-ui-photo-bg-full");
			$(".dgom-ui-photo").css("background-image", ""); 
			panelSelect = false;

			// Ocultar message de error - next foto
			setTimeout(hideMessageNext, 0);
		}
	});

	setTimeout(showReviewBtn, 2000);

	function showReviewBtn() {
		$("#dgom-js-pintar-photo-wrap-panel-score").addClass("dgom-ui-Btn-photoReview-on");
	}


	// Check Aceep
	$("#isCalificada").on("change",function(){
		if ($("#isCalificada").prop("checked")==true){
			// Boton next
			$(".dgom-ui-pintarFoto-next").addClass("dgom-ui-pintarFoto-next-view");
		} else{
			// Boton next
			$(".dgom-ui-pintarFoto-next").removeClass("dgom-ui-pintarFoto-next-view");
		}
	});


});

', CClientScript::POS_END );

?>


