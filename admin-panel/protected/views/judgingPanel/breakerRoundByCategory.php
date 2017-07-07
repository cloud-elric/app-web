<?php
$places = array (
		"1st place",
		"2nd place",
		"3rd place" 
);

$bloques = 1;
$index = 0;

?>
<div class="container">

	<!-- Title -->
	<div class="row padding-horizontal-50">
		<div class="col-md-12">
			<h2 class="dgom-ui-title-section-finalists font-size-40"><?= $categoria->txt_name?></h2>
		</div>
	</div>
<?php

foreach ( $countCalificaciones as $key => $empatadas ) {
	if ($empatadas > 1) {
		Yii::app ()->clientScript->registerScript ( 'initVariables' . $key, '
			var max' . $key . ' = ' . $empatadas . ';
			var aux' . $key . ' = 0;
			var totalStar' . $key . ' = [];
			var usedStar' . $key . ' = [];
		', CClientScript::POS_END );
		
		?>
	<!-- Rating ->
	<div class="row padding-vertical-0 padding-horizontal-50">

		<div class="col-md-12 dgom-ui-col-breakRound-category" style="margin-top: 80px;">

			<h3 class="dgom-ui-col-breakRound-category-subTitle"></h3>
		
			<!- Texto de primer, segundo, tercer lugar  ->
			<?php
			/*
			
			for($i = 1; $i <= $empatadas; $i ++) {
				echo '<div class="dgom-ui-col-breakRound-rating ratingBegin' . $key . $i . '" data-score="4"
							data-star-off="icon wb-heart-outline"
							data-star-on="icon wb-heart red-600" data-plugin="rating"></div>';
				
				Yii::app ()->clientScript->registerScript ( 'raty' . $key . $i, '
					totalStar' . $key . '.push(' . $i . '); 
					$(".ratingBegin' . $key . $i . '").raty({
					targetKeep: true,
			    	icon: "font",
					hints: [null,null,null,null,null,null], 
			   	 	starType: "i",
			    	starOff: "icon wb-star",
			    	starOn: "icon wb-star orange-600",
			    	cancelOff: "icon wb-minus-circle",
			    	cancelOn: "icon wb-minus-circle orange-600",
			    	starHalf: "icon wb-star-half orange-500",
					readOnly: true,
					score: ' . ($i) . ',
					number: ' . ($i) . '
			});

			', CClientScript::POS_END );
			}
			
			echo "<br>".CHtml::link ( Yii::t('breakerRoundByCategory','resolve'), array (), array (
					"id" => "resolveConflict" . $key,
					"class" => "btn btn-success dgom-ui-col-breakRound-btn" 
			) );
			
			Yii::app ()->clientScript->registerScript ( 'resoveConflict' . $key, '
					$("#resolveConflict' . $key . '").on("click", function(e){
						e.preventDefault();
						var data = $("#formStars' . $key . '").serialize();
						$.ajax({
							url: "'. Yii::app()->controller->createUrl("desempate") .'",
							data:data,
							type:"POST",
							success:function(response){
					if(response=="success"){
								btnSuccess' . $key.'();
								}else{
									 $("#resolveConflict' . $key.'").html("Please resolve all pictures");
								}
							}
						});
					});
					
			// funcion para agregar estado a btn Update (Success y Update)
	function btnSuccess' . $key.'(){
		setTimeout(function() {
	        $("#resolveConflict' . $key.'").html("Success");
			$("#resolveConflict' . $key.'").addClass("dgom-ui-update-succes");
			$("#resolveConflict' . $key.'").attr("id","finished");		
	    },50);

	}		
			
			', CClientScript::POS_END );
			*/
			?>
		</div>
	</div> <!- End / Row Rating -->

	
	<div class="row padding-vertical-0 padding-horizontal-50" style="margin-bottom: 40px;">
			<div class="popup-gallery-<?=$key?>">
		<?php
		echo CHtml::beginForm ( '', '', array (
				"id" => "formStars" . $key 
		) );
		
		$ratingIndex = 1;
		$isPintadoLugar = true;
		foreach ( $lugares as $lugar ) {
			
			if ($key == $lugar->num_calificacion) {
				
				foreach($lugaresCategoria as $llave=>$value){
					
					if($value['num_calificacion']==$lugar->num_calificacion){
						$lugarPintarNumero = $llave;
					}
				}
				
				if($isPintadoLugar){
					?>

					<!-- Title & Boton -->
					<div class="col-md-12 margin-bottom-30">
						<div class="row">
							<div class="col-md-8">
								<!-- Title -->
								<h3 class="dgom-ui-title-breakRound"><?=Utils::ordinalSuffix($lugarPintarNumero+1).' '.Yii::t('breakerRoundByCategory','place')?></h3>
							</div>
							<div class="col-md-4">
								<!-- Btn Resolve -->
								<div class="text-right">
								<button id="resolveConflict<?=$key?>" data-style="zoom-out" class="btn btn-success dgom-ui-col-breakRound-btn ladda-button"><span class='ladda-label'><?=Yii::t('breakerRoundByCategory','resolve')?></span></button>
								</div>
							</div>
						</div>
					</div>

					<!-- echo '<h3 class="dgom-ui-title-breakRound">'.Utils::ordinalSuffix($lugarPintarNumero+1).' '.Yii::t('breakerRoundByCategory','place').'</h3>';					 -->
					<?php
					$isPintadoLugar = false;
					
				}
				?>
		<!-- Columnas de Imagenes -->
		<div class="col-md-4">

			<!-- Stars -->
			<div class="dgom-ui-col-breakRound-category-cont-stars rating<?=$lugar->id_pic?> rating rating<?=$key.$ratingIndex?>" data-score="4" data-star-off="icon wb-heart-outline" data-star-on="icon wb-heart red-600" data-plugin="rating"></div>
			<?=CHtml::hiddenField("CalificacionesDesempate[".$ratingIndex."][id_pic]", $lugar->id_pic)?>
			
			<!-- Imagen Figure -->
			<div class="dgom-ui-col-overlay dgom-ui-col-overlay-finalists">
				<!-- <img class="overlay-figure" src="<?php # echo Yii::app ()->params ['pathBaseImages']."idu_".$lugar->txt_usuario_number.DIRECTORY_SEPARATOR."small_".$lugar->txt_file_name?>" alt="..."> -->
				
				<!-- <figure class="overlay overlay-hover dgom-ui-overlay-cont dgom-ui-overlay-cont-bg" style="background-image: url(http://lorempixel.com/400/200/animals/);"> -->
				<a href="<?php echo Yii::app ()->params ['pathBaseImages']."idu_".$lugar->txt_usuario_number.DIRECTORY_SEPARATOR."/large_".$lugar->txt_file_name?>">
					<figure class="overlay overlay-hover dgom-ui-overlay-cont dgom-ui-overlay-cont-bg" style="background-image: url(<?php echo Yii::app ()->params ['pathBaseImages']."idu_".$lugar->txt_usuario_number.DIRECTORY_SEPARATOR."/small_".$lugar->txt_file_name?>);">
						<figcaption class="overlay-panel overlay-background overlay-fade overlay-icon"></figcaption>
					
						<?php if($lugar->b_mencion==4){?>
						<button type="button" class="btn btn-floating btn-primary btn-sm">
							<i class="icon wb-check" aria-hidden="true"></i>
						</button>
						<?php }?>
					<!--  
					<div class="dgom-ui-col-breakRound-category-cont-stars rating<?#=$lugar->id_pic?> rating rating<?#=$key.$ratingIndex?>"
						data-score="4" data-star-off="icon wb-heart-outline"
						data-star-on="icon wb-heart red-600" data-plugin="rating"></div>
						
					<?#=CHtml::hiddenField("CalificacionesDesempate[".$ratingIndex."][id_pic]", $lugar->id_pic)?>
					-->

				<?php
				Yii::app ()->clientScript->registerScript ( 'starDisponibles' . $lugar->id_pic, '
					
					$(".rating' . $key . $ratingIndex . '").raty({
					targetKeep: true,
					scoreName: "CalificacionesDesempate['.$ratingIndex.'][num_calificacion]",
			    	icon: "font",
			   	 	starType: "i",
					hints: [null,null,null,null,null,null], 
			    	starOff: "icon wb-star-outline",
			    	starOn: "icon wb-star orange-600",
			    	cancelOff: "icon wb-minus-circle",
			    	cancelOn: "icon wb-minus-circle orange-600",
			    	starHalf: "icon wb-star-half orange-500",
					number: ' . $empatadas . ',
					click: function(score, evt){
						
							for(var i=1; i<=' . $empatadas . '; i++){
								var revisando = $(".rating' . $key . '"+i).raty("score");
						
								if(revisando==score){
									$(".rating' . $key . '"+i).raty("set", { score: 0 });
								}
								
							}
						
							$(".rating' . $key . $ratingIndex . '").raty("set", { score: score });
						
// 							for(var i=1; i<=' . $empatadas . '; i++){
// 								var revisando = $(".rating' . $key . '"+i).raty("score");
// 								console.log(revisando);
// 								if(revisando>=1){
// 									$(".ratingBegin'. $key .'"+revisando).css("opacity", 0.5);
// 								}else{
// 									$(".ratingBegin'. $key .'"+revisando).css("opacity", 1);
// 								}
								
// 							}
						
						//$(".ratingBegin'. $key .'"+score).css("opacity", 0.5);
						
						
						return false;			
									
					}					
			});
					
			', CClientScript::POS_END );
				?>	
					</figure>
				</a>
			</div>
				
		</div>
	
	<?php
				
				$ratingIndex ++;
			}
		}
		
		
		?>
		</div>
		</div>
	<?php 
	echo CHtml::endForm ();	
	?>	
	
	
<?php
	}
Yii::app ()->clientScript->registerScript ( 'breakerRoundByCategory' . $key , '
$(document).ready(function(){
		
		
		$(".popup-gallery-' . $key . '").magnificPopup({
	    delegate: "a",
	    type: "image",
	    tLoading: "Loading image #%curr%...",
	    removalDelay: 500,
	    mainClass: "mfp-img-mobile",
	    gallery: {
			enabled: true,
			navigateByImgClick: false,
			preload: [0,1]
	    },
		callbacks: {
			buildControls: function() {
				this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
			}
		},
		image: {
			tError: "Error al cargar la imagen.",
			
		}

	});


	$("#resolveConflict' . $key . '").on("click", function(e){
		e.preventDefault();
		var l = Ladda.create(this);
	 	l.start();
		var data = $("#formStars' . $key . '").serialize();
		$.ajax({
			url: "'. Yii::app()->controller->createUrl("desempate") .'",
			data:data,
			type:"POST",
			success:function(response){
			if(response=="success"){
				// btnSuccess' . $key.'();
				// $("#resolveConflict' . $key . '").addClass("dgom-ui-col-breakRound-btn-label");
				$("#resolveConflict' . $key . '").replaceWith("<label class=\'dgom-ui-col-breakRound-btn-label\'><i class=\'icon ion-checkmark-round\'></i> Solved</label>");
				}else{
					$("#resolveConflict' . $key.'").html("Please resolve all pictures");
				}
				l.stop();
			}
		});
	});
					
	// funcion para agregar estado a btn Update (Success y Update)
	function btnSuccess' . $key.'(){
		setTimeout(function() {
	        $("#resolveConflict' . $key.'").html("Success");
			$("#resolveConflict' . $key.'").addClass("dgom-ui-update-succes");
			$("#resolveConflict' . $key.'").attr("id","finished");		
	    },50);

	}		


});

', CClientScript::POS_END );
$index ++;

}
?>
	
	</div>
</div>