
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
	<!-- Texto de primer, segundo, tercer lugar  -->
	<h3><?=$places[$index]?></h3>
	
	<?php
		
		for($i = 1; $i <= $empatadas; $i ++) {
			echo '<div class="ratingBegin' . $key . $i . '" data-score="4"
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
		
		echo CHtml::link ( "Resolve", array (), array (
				"id" => "resolveConflict" . $key,
				"class" => "btn btn-success" 
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
				
							
						}
					});
				});
		
		', CClientScript::POS_END );
		
		?>
	
	
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

			<div class="dgom-ui-col-overlay">
				<figure class="overlay overlay-hover dgom-ui-overlay-cont">
					<img class="overlay-figure"
						src="<?php echo Yii::app ()->params ['pathBaseImages']."thumbnails/thumb_".$lugar->txt_file_name?>"
						alt="...">

					<figcaption
						class="overlay-panel overlay-background overlay-fade overlay-icon">

					</figcaption>
					
					<?php if($lugar->b_mencion==1){?>
					<button type="button" class="btn btn-floating btn-primary btn-sm">
						<i class="icon wb-check" aria-hidden="true"></i>
					</button>
					<?php }?>
					<div
						class="rating<?=$lugar->id_pic?> rating rating<?=$key.$ratingIndex?>"
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
						var encontrado = false;
						for	(var i =0; i<totalStar' . $key . '.length; i++){
							if(totalStar' . $key . '[i]==score){
								var ex = totalStar' . $key . '.indexOf(score);
								if(ex != -1) {
									totalStar' . $key . '.splice(ex, 1);
									usedStar' . $key . '.push(score);
								}
								encontrado = true;	
							}
						}
									
						if(encontrado){
							
						}else{
							for(var i=1; i<=' . $empatadas . '; i++){
								var revisando = $(".rating' . $key . '"+i).raty("score");
									console.log(revisando+" - "+ score);
								if(revisando==score){
									$(".rating' . $key . '"+i).raty("score", 0);
								}	
							}
						}			
									
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
