<?php 
$this->title = Yii::t('site', 'titleAdminPanel');
?>
<div class="container">
	<div class="row">
	
		<div class="col-md-12 margin-bottom-30">
			<h2 class="grey-100 font-size-40"><?=Yii::t('site','progreso');?></h2>
		</div>

		<?php
		foreach ( $porcentajeCategoria as $cat ) :
		
		$porcentaje = 0;
		
		$command = Yii::app()->db->createCommand('CALL getPorcentajeAvance(1, '.$cat->id_category.', @porcentaje)');
		
		$command->execute();
		
		$porcentaje = Yii::app()->db->createCommand("select @porcentaje as result;")->queryScalar();
		
		?>	
		<div class="col-xlg-4 col-lg-4 col-sm-12 margin-bottom-50 <?=$cat->num_fotos_calificadas==0?'dgom-ui-dashboard-box-finish':'' ?>" >
			<!-- Panel Stacked Bar -->
			<div class="widget-shadow" id="chartStackedBar">
				<div class="widget-content height-full">

					<div class="grey-100 padding-10">
					
						<?php 
						//if($cat->num_fotos_calificadas!=0){
							echo CHtml::link('<h2 class="dgom-ui-dashboard-box-heading dgom-ui-dashboard-box-heading-white">'.$cat->txt_name.'</h2>', array('adminPanel/photosCategory', 't'=>$cat->txt_token_category), array("class"=>"dgom-ui-link-dashboard-admin animsition-link"));
// 						}else{
// 							echo '<h2 class="dgom-ui-dashboard-box-heading dgom-ui-dashboard-box-heading-white">'.$cat->txt_name.'</h2>';
// 						}
						?>

						<!-- <p class="font-size-24"><?=$cat->num_fotos_calificadas?> / <?= $cat->num_total_fotos?></p>-->

						<div class="progress progress-lg dgom-ui-hr-progress-bar">
	                    	<div class="progress-bar progress-bar-primary progress-bar-striped" style="width: <?=round($porcentaje)?>%;" role="progressbar"><?=round($porcentaje)?>%</div>
	                    </div>

						<h6 class="dgom-ui-hr-progress-text"><?=Yii::t('site','progresoProgress');?></h6>

					</div>

				</div>
			</div>
			<!-- End Panel Stacked Bar -->
		</div>
		<?php
		endforeach
		;
		?> 

	</div>
</div>
