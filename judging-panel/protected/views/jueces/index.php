<div class="container">
	<div class="row padding-50">
		<?php
		foreach ( $avance as $av ) :
		?>
		<div class="col-xlg-4 col-lg-4 col-sm-12 <?=$av->num_fotos_calificadas==$av->num_fotos_total?'dgom-ui-dashboard-box-finish':''?>">
			<!-- Panel Stacked Bar -->
			<div class="" id="chartStackedBar">
				<div class="">

					<div class="dgom-ui-dashboard-box blue-grey-700 padding-30">
					<?php if($av->num_porcentaje>=100){?>
						<h2 class='dgom-ui-dashboard-box-heading'><?=$av->txt_name_es?></h2>
					<?php }else{?>
						<?= CHtml::link("<h2 class='dgom-ui-dashboard-box-heading'>".$av->txt_name_es."</h2>", array("pintarFoto", "idCategoria"=>$av->txt_token_category, "t"=>$t))?>
					<?php }?>	
						<h3 class="dgom-ui-dashboard-box-number">
							<?=$av->num_fotos_calificadas?> / <?=$av->num_fotos_total?>
						</h3>

						<div class="progress progress-lg">
							<div class="progress-bar progress-bar-primary progress-bar-striped" style="width: <?=$av->num_porcentaje?>%;" role="progressbar"><?=$av->num_porcentaje?>%</div>
						</div>

						<h6 class="dgom-ui-dashboard-box-progress-txt">Progress</h6>
					</div>

				</div>
			</div>
			<!-- End Panel Stacked Bar -->
		</div>
		<?php
		endforeach;
		?> 
	</div>
</div>

