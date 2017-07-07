<div id="page" class="photo-page">
	
	<!-- Loading Juez -->
	<div class="dgom-ui-loading-juez">
		<div class="loader-default loader vertical-align-middle" data-type="default"></div>
	</div>

	<!-- Panel de Buttons -->
	<div class="photo-toolbar dgom-ui-btn-wrapper ">
		<button id="dgom-js-scorePanel" class="dgom-ui-Btn dgom-ui-Btn-score"><?=Yii::t('evaluador','showScore');?></button>

		<a class="dgom-ui-Btn dgom-ui-a-admin" href="javascript:history.back();"><?=Yii::t('evaluador','back');?></a>
		
		<button id="dgom-js-notesPanel" class="dgom-ui-Btn dgom-ui-Btn-notes"><?=Yii::t('evaluador','showNotes');?></button>
		
		<button id="dgom-js-full-admin" class="dgom-ui-Btn" data-toggle="fullscreen"><?=Yii::t('evaluador','fullScreen');?></button>

		<button id="dgom-js-beginReview" class="dgom-ui-Btn dgom-ui-Btn-photoReview dgom-ui-Btn-w-200"><?=Yii::t('evaluador','beginPhotoReview');?></button>
	</div>
	<section id="dgom-js-panel-wrapper" class="dgom-ui-panel-wrapper">
		<!-- Columna Left -->
		<div id="dgom-js-scorePanel" class="dgom-ui-sidePanel dgom-ui-sidePanel-score dgom-ui-evaluador-sidePanel-left">
			<div class="row">
				<!-- Columna Score -->
				<div class="col-md-6 padding-right-20">
					<form id="dgom-js-calificacionAdmin">
						<p class="dgom-ui-clear-both margin-0"><?=Yii::t('evaluador','category');?>:</p>
						<h2 class="margin-vertical-3 text-white">
							<?=empty($photoCalificar->idCategoryOriginal)? Yii::t('evaluador','nocategory') : $photoCalificar->idCategoryOriginal->txt_name?>
							<?= CHtml::hiddenField("idPic", $photoCalificar->id_pic);?>
						</h2>
						<article class="pull-ok">
						<?= CHtml::checkBox("b_mencion", $photoCalificar->b_mencion, array("class"=>"icheckbox-primary", "id"=>"inputUnchecked", "data-plugin"=>"iCheck","data-checkbox-class"=>"icheckbox_flat-blue"))?>
							<label class="label-check" for="inputUnchecked"><?=Yii::t('evaluador','honorableMention');?></label>
						</article>

						<div class="row rowTotal text-left">
							<div class="col-md-12 padding-0">
								<div class="example margin-0">
									<?php
									echo CHtml::dropDownList ( "id_category", $photoCalificar->id_category, $categoriasList, array (
											"class" => "form-control",
											"data-plugin" => "select2",
											"data-placeholder" => "Select a category",
											"data-allow-clear" => "true",
											"prompt" => "Select a category" 
									) );
									?>
								</div>
							</div>
							<button type="button" class="btn btn-primary margin-top-20 ladda-button" data-style="zoom-out" id="dgom-js-update-pic"><span class="ladda-label">Update</span></button>
							
							<div class="rowTotal-cont-message">
								<div class="rowTotal-cont-message-success">
									<?=Yii::t('evaluador','messageSuccess');?>
								</div>
								<div class="rowTotal-cont-message-error">
									<?=Yii::t('evaluador','messageError');?>
								</div>
							</div>
								
						</div>
						<div class="row dgom-ui-evaluador-row-textos">
							<?php
							$suma = 0;
							foreach ( $calificacionRubro as $rubro ) {
								?>
								
								<div class="col-sm-12">
								<h4><?php echo $rubro->txt_nombre_rubro?></h4>
								<span><?=number_format($rubro->num_calificacion_actual,1)?></span>
							</div>
							<?php
								$suma += number_format ( $rubro->num_calificacion_actual, 1 );
							}
							?>
						</div>
						<div class="row margin-0">
							<div class="col-md-12 padding-0 text-left">
								<p class="dgom-ui-content-input-progress-p-evaluador"><?=Yii::t('photoReview','total');?></p>
								<p class="dgom-ui-content-input-progress-p-evaluador-green"><?=$suma?></p>
								<!-- <div class="pie-progress pie-progress-sm dgom-ui-content-input-progress-canvas-evaluador" data-plugin="pieProgress"
									data-barcolor="#75E268" data-size="100" data-barsize="4"
									data-goal="<?=$suma?>" aria-valuenow="<?=$suma?>"
									role="progressbar">

									<div class="pie-progress-number"><?=$suma?></div>
								</div> -->
							</div>
						</div>
					</form>
				</div>
				<!-- Columna Category -->
				<div class="col-md-6">
					
					<?php
					$feedbacks = array ();
					$indexJuez = 0;
					foreach ( $jueces as $juez ) {
						?>
						<div class="dgom-ui-col-int-right-contenido dgom-ui-col-int-right-contenido-white">
							<h2>
								<?php echo $juez->txt_iniciales?>     
								<div class="pull-right dgom-pull-right">
								<?php $calificacionesBMencion = WrkPicsCalificaciones::model()->findAll(array("condition"=>"id_pic=".$photoCalificar->id_pic." AND id_juez=".$juez->id_juez));
									foreach($calificacionesBMencion as $mencion){
										if($mencion->b_mencion==1){
											echo '<i class="icon wb-check" aria-hidden="true"></i>' . Yii::t('evaluador','honorableMention');
											break;
										}
										
									}
								?>
									
								</div>
							</h2>
							<h4><?=Yii::t('evaluador','categorySuggestions');?>:</h4>
							<?php
							foreach($calificacionesBMencion as $mencion){
							
							if (empty ( $mencion->idCategoriaPropuesta )) {
								
								echo '<button type="button" class="btn btn-transpatente">'.Yii::t('evaluador','noSuggestions').':</button>';
							} else {
								
								echo '<button type="button" class="btn btn-primary">' . $mencion->idCategoriaPropuesta->txt_name . '</button>';
							}
							break;
						}
						?>
							<div class="row margin-top-30">
							<?php
						// Calificaciones del juez para la foto
						$calificaciones = WrkPicsCalificaciones::model ()->findAll ( array (
								"condition" => "id_juez =:idJuez AND id_pic=:idPic",
								"params" => array (
										":idJuez" => $juez->id_juez,
										":idPic" => $photoCalificar->id_pic 
								),
								"order" => "id_rubro" 
						) );
						
						foreach ( $calificaciones as $calificacion ) {
							
							$feedbacks [$indexJuez] = array (
									"juezNombre" => $juez->txt_nombre_juez,
									"feedBack" => $calificacion->txt_retro 
							);
							?>
								<div class="col-xs-12 col-md-6">
									<p><?= empty($calificacion->idRubro)? Yii::t('evaluador','empty') :$calificacion->idRubro->txt_nombre?></p>
									<span><?= $calificacion->num_calificacion?></span>
								</div>
							<?php }?>
							</div>

						</div>
						<?php
						$indexJuez ++;
					}
					?>
					
				</div>
			</div>

		</div>
		
		<!-- Columna Right -->
		<div id="dgom-js-notesPanel" class="dgom-ui-sidePanel dgom-ui-sidePanel-notes dgom-ui-evaluador-sidePanel-right">

			<div class="flip-panel">

				<div class="front-side">
					<div class="front-int">
						<div class="pull-right">
							<button type="button" class="btn btn-primary dgom-js-go-to-btn-feedback"><?=Yii::t('evaluador','goToFeedbacks');?></button>
						</div>

						<div class="dgom-ui-col-int-right-text-contenido">
							<h2><?php echo $photoCalificar->txt_pic_name?></h2>
							<p><?php echo $photoCalificar->txt_pic_desc?></p>
						</div>
					</div>
				</div>

				<div class="back-side">
					<div class="front-int">
						<div class="pull-right">
							<button type="button" class="btn btn-primary dgom-js-go-to-btn-description"><?=Yii::t('evaluador','goToDescription');?></button>
						</div>

						<div class="dgom-ui-col-int-right-text-contenido">
							<?php foreach($feedbacks as $feedback){?>
								<h2><?= $feedback["juezNombre"]?></h2>
								<p><?= $feedback["feedBack"]?></p>
							<?php }?> 
						</div>
					</div>
				</div>

			</div>

		</div>
	</section>

	<!-- Imagen -->
	<section class="dgom-ui-photo-wrapper">
		<div class="dgom-ui-photo">
			<img style="display:none" id="dgom-js-bkgdImage" src="<?php echo Yii::app ()->params ['pathBaseImages']."idu_".$photoCalificar->iD->txt_usuario_number."/large_".$photoCalificar->txt_file_name?>" alt="<?=$photoCalificar->txt_pic_name?>">
		</div>
	</section>

</div>

<?php

Yii::app ()->clientScript->registerScript ( 'my vars', '
$(document).ready(function(){
	
	var heightScreenOriginal = $( window ).height();
	
	// Si es Safari, usar height por pixeles
	var ua = navigator.userAgent.toLowerCase(); 
	if (ua.indexOf("safari") != -1) { 
	  if (ua.indexOf("chrome") > -1) {
	    // console.log("chrome");
	  } else {
	  	// console.log("safari");
	    $(".flip-panel").css("height", heightScreenOriginal);
	  }
	}


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
	

	// Btn para mostar con giro Feedback
	$(".dgom-js-go-to-btn-feedback").click(function() {
		$(".flip-panel").addClass("flipped");
	});

	// Btn para mostar con giro Description
	$(".dgom-js-go-to-btn-description").click(function() {
		$(".flip-panel").removeClass("flipped");
	});
	
	// Actualizar
	$("#dgom-js-update-pic").on("click", function(){
		
		$("#dgom-js-update-pic").prop("disabled", true);

		var data = $("#dgom-js-calificacionAdmin").serialize();
		$.ajax({
			url:"' . Yii::app ()->createAbsoluteUrl ( "juecesAdmin/updatePicAdmin" ) . '",
			type:"post",
			data:data,
			success:function(response){
				btnSuccess();
				// Mostrar mensaje de update correcto
				$(".rowTotal-cont-message-success").show();
				$(".rowTotal-cont-message-success").animate({ "left": 0 }, 600 );
				setTimeout(hideMessageUpdate, 3800);
				$("#dgom-js-update-pic").prop("disabled", false);
				// $("#dgom-js-update-pic").html("Success");
				// $("#dgom-js-update-pic").addClass("dgom-ui-update-succes");
			},
			error:function(xhr, error, status){
				// alert("error");
				// Mostrar mensaje de update error
				$(".rowTotal-cont-message-error").show();
				$(".rowTotal-cont-message-error").animate({ "left": 0 }, 600 );
				setTimeout(hideMessageUpdate, 4000);
				$("#dgom-js-update-pic").prop("disabled", false);
			}
		});
	});
	
	// Ocultar mensaje de update correcto/error
	function hideMessageUpdate() {
		$(".rowTotal-cont-message-success").hide();
		$(".rowTotal-cont-message-error").hide();
	}
	
	// funcion para agregar estado a btn Update (Success y Update)
	function btnSuccess(){
		setTimeout(function() {
	        $("#dgom-js-update-pic").html("Success");
			$("#dgom-js-update-pic").addClass("dgom-ui-update-succes");
	    },50);

		setTimeout(function() {
	        $("#dgom-js-update-pic").html("Update");
			$("#dgom-js-update-pic").removeClass("dgom-ui-update-succes");
	    },4000);
	}
		

});

', CClientScript::POS_END );

?>