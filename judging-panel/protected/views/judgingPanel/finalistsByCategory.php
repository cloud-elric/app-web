<?php
$bloques = 1;
$index = 0;

?>

<style>
.icon.wb-star.orange-600{
	color: #2D90E9 !important;
}

</style>
<div class="container">

	<!-- Title -->
	<div class="row padding-horizontal-50">
		<div class="col-md-12">
			<h2 class="dgom-ui-title-section-finalists font-size-40"><?= $categoria->txt_name?></h2>
		</div>
	</div>
<?php

		Yii::app ()->clientScript->registerScript ( 'initVariables', '
			var max = ' . $numLugares . ';
			var aux = 0;
			var totalStar = [];
			var usedStar = [];
		', CClientScript::POS_END );
		
		?>
	

	
	<div class="row padding-vertical-0 padding-horizontal-50" style="margin-bottom: 40px;">
			<div class="popup-gallery">
		<?php
		echo CHtml::beginForm ( '', '', array (
				"id" => "formStars" 
		) );
	
					?>

					<!-- Title & Boton -->
					<div class="col-md-12 margin-bottom-30">
						<div class="row">
							<div class="col-md-8">
								<!-- Title -->
								<h3 class="dgom-ui-title-breakRound">Finalists</h3>
							</div>
							<div class="col-md-4">
								<!-- Btn Resolve -->
								<div class="text-right">
								<button id="resolveConflict" data-style="zoom-out" class="btn btn-success dgom-ui-col-breakRound-btn ladda-button"><span class='ladda-label'><?=Yii::t('breakerRoundByCategory','resolve')?></span></button>
								</div>
							</div>
						</div>
					</div>

					<!-- echo '<h3 class="dgom-ui-title-breakRound">'.Utils::ordinalSuffix($lugarPintarNumero+1).' '.Yii::t('breakerRoundByCategory','place').'</h3>';					 -->
		<?php foreach ( $finalistas as $finalista ) {
			$idJuez = Yii::app ()->user->juezLogueado->id_juez;
		$fotoCalificada = CalificacionesFinalistas::model()->find(array(
				'condition'=>'id_pic=:idPic AND id_juez=:idJuez',
				'params'=>array(':idPic'=>$finalista->id_pic, ':idJuez'=>$idJuez)
				));
		if(empty($fotoCalificada)){
				?>	
		<!-- Columnas de Imagenes -->
		<div class="col-md-4">

			<!-- Stars -->
			<div class="dgom-ui-col-breakRound-category-cont-stars rating<?=$finalista->id_pic?> rating rating<?=$index?>" data-score="4" data-star-off="icon wb-heart-outline" data-star-on="icon wb-heart red-600" data-plugin="rating"></div>
			<?=CHtml::hiddenField("CalificacionesDesempate[".$index."][id_pic]", $finalista->id_pic)?>
			
			<!-- Imagen Figure -->
			<div class="dgom-ui-col-overlay dgom-ui-col-overlay-finalists">
				<!-- <img class="overlay-figure" src="<?php # echo Yii::app ()->params ['pathBaseImages']."idu_".$lugar->txt_usuario_number.DIRECTORY_SEPARATOR."small_".$lugar->txt_file_name?>" alt="..."> -->
				
				<!-- <figure class="overlay overlay-hover dgom-ui-overlay-cont dgom-ui-overlay-cont-bg" style="background-image: url(http://lorempixel.com/400/200/animals/);"> -->
				<a href="<?php echo Yii::app ()->params ['pathBaseImages'].'con_'.$t."/idu_".$finalista->txt_usuario_number."/".$finalista->txt_file_name?>">
					<figure class="overlay overlay-hover dgom-ui-overlay-cont dgom-ui-overlay-cont-bg" style="background-image: url(<?php echo Yii::app ()->params ['pathBaseImages'].'con_'.$t."/idu_".$finalista->txt_usuario_number."/small_".$finalista->txt_file_name?>);">
						<figcaption class="overlay-panel overlay-background overlay-fade overlay-icon"></figcaption>
					
						<?php if($finalista->b_mencion==1){?>
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
				Yii::app ()->clientScript->registerScript ( 'starDisponibles' . $finalista->id_pic, '
					
					$(".rating' . $index . '").raty({
					targetKeep: true,
					scoreName: "CalificacionesDesempate['.$index.'][num_calificacion]",
			    	icon: "font",
			   	 	starType: "i",
					hints: [null,null,null,null,null,null], 
			    	starOff: "icon wb-star-outline",
			    	starOn: "icon wb-star orange-600",
			    	cancelOff: "icon wb-minus-circle",
			    	cancelOn: "icon wb-minus-circle orange-600",
			    	starHalf: "icon wb-star-half orange-500",
					number: ' . $numLugares . ',
					click: function(score, evt){
						
							for(var i=0; i<' . $numLugares . '; i++){
								var revisando = $(".rating"+i).raty("score");
						
								if(revisando==score){
									$(".rating"+i).raty("set", { score: 0 });
								}
								
							}
						
							$(".rating' .$index . '").raty("set", { score: score });
						
// 							for(var i=1; i<=' . $numLugares . '; i++){
// 								var revisando = $(".rating' . $index . '"+i).raty("score");
// 								console.log(revisando);
// 								if(revisando>=1){
// 									$(".ratingBegin'. $index .'"+revisando).css("opacity", 0.5);
// 								}else{
// 									$(".ratingBegin'. $index .'"+revisando).css("opacity", 1);
// 								}
								
// 							}
						
						//$(".ratingBegin'. $index .'"+score).css("opacity", 0.5);
						
						
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
		}
			$index++;
		
		}
		
		
		?>
		</div>
		</div>
	<?php 
	echo CHtml::endForm ();	
	?>	
	
	
<?php
	
Yii::app ()->clientScript->registerScript ( 'breakerRoundByCategory', '
$(document).ready(function(){
		
		 
		$(".popup-gallery").magnificPopup({
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


	$("#resolveConflict").on("click", function(e){
		e.preventDefault();
		var l = Ladda.create(this);
	 	l.start();
		var data = $("#formStars").serialize();
		$.ajax({
			url: "'. Yii::app()->controller->createUrl("desempateFinalistas") .'?t='.$t.'",
			data:data,
			type:"POST",
			success:function(response){
			if(response=="success"){
				
				$("#resolveConflict").replaceWith("<label class=\'dgom-ui-col-breakRound-btn-label\'><i class=\'icon ion-checkmark-round\'></i> Solved</label>");
				}else{
					$("#resolveConflict").html("Please resolve all pictures");
				}
				l.stop();
			}
		});
	});
					
	// funcion para agregar estado a btn Update (Success y Update)
	function btnSuccess(){
		setTimeout(function() {
	        $("#resolveConflict").html("Success");
			$("#resolveConflict").addClass("dgom-ui-update-succes");
			$("#resolveConflict").attr("id","finished");		
	    },50);

	}		


});

', CClientScript::POS_END );

?>
	
	</div>
</div>