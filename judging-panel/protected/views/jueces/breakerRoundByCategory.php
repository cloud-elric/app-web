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

	<!-- Rating -->
	<div class="row padding-vertical-0 padding-horizontal-50">

		<div class="col-md-12 dgom-ui-col-breakRound-category" style="margin-top: 80px;">

			<h3 class="dgom-ui-col-breakRound-category-subTitle"><?=$places[$index]?></h3>
		
			<!-- Texto de primer, segundo, tercer lugar  -->
			<?php
			
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
			
			echo "<br>".CHtml::link ( "Resolve", array (), array (
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
			
			?>
		</div>
	</div> <!-- End / Row Rating -->
	
	<div class="row padding-vertical-0 padding-horizontal-50">
	<?php
		echo CHtml::beginForm ( '', '', array (
				"id" => "formStars" . $key 
		) );
		
		$ratingIndex = 1;
		foreach ( $lugares as $lugar ) {
			if ($key == $lugar->num_calificacion) {
				?>
		<div class="col-md-4">

			<div class="dgom-ui-col-overlay dgom-ui-col-overlay-finalists">
				<figure class="overlay overlay-hover dgom-ui-overlay-cont">
					<img class="overlay-figure"
						src="<?php echo Yii::app ()->params ['pathBaseImages']."thumbnails/thumb_".$lugar->txt_file_name?>"
						alt="...">

					<figcaption
						class="overlay-panel overlay-background overlay-fade overlay-icon">

					</figcaption>
					
					<?php if($lugar->b_mencion==4){?>
					<button type="button" class="btn btn-floating btn-primary btn-sm">
						<i class="icon wb-check" aria-hidden="true"></i>
					</button>
					<?php }?>
					<div class="dgom-ui-col-breakRound-category-cont-stars rating<?=$lugar->id_pic?> rating rating<?=$key.$ratingIndex?>"
						data-score="4" data-star-off="icon wb-heart-outline"
						data-star-on="icon wb-heart red-600" data-plugin="rating"></div>
						
					<?=CHtml::hiddenField("CalificacionesDesempate[".$ratingIndex."][id_pic]", $lugar->id_pic)?>
						
				<?php
				Yii::app ()->clientScript->registerScript ( 'starDisponibles' . $lugar->id_pic, '
					
					$(".rating' . $key . $ratingIndex . '").raty({
					targetKeep: true,
					scoreName: "CalificacionesDesempate['.$ratingIndex.'][num_calificacion]",
			    	icon: "font",
			   	 	starType: "i",
					hints: [null,null,null,null,null,null], 
			    	starOff: "icon wb-star",
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
			</div>
				
		</div>
	
	<?php
				
				$ratingIndex ++;
			}
		}
		
		
		?>
	<?php 
	echo CHtml::endForm ();	
	?>	
	</div>
<?php
	}
	$index ++;
}
?>
</div>
