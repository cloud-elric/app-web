<?php
$this->title = Yii::t ( 'site', 'titleJudgePanel' );
?>
<div class="container">
	<div class="row padding-50">
		
		<?php foreach($concursosJuez as $concurso){?>
		<div class="col-xlg-4 col-lg-4 col-sm-12">
			<!-- Panel Stacked Bar -->
			<div class="" id="chartStackedBar">
				<div class="">

					<div class="dgom-ui-dashboard-box blue-grey-700 padding-30">
					
						<?= CHtml::link("<h2 class='dgom-ui-dashboard-box-heading'>".$concurso->txt_name."</h2>", array("judgingPanel/index", "t"=>$concurso->txt_token))?>
					</div>

				</div>
			</div>
			<!-- End Panel Stacked Bar -->
		</div>
<?php }?>
	</div>
</div>

