<?php
$constantes = new Constantes ();
$colores = $constantes->colors;
$this->title = Yii::t('site', 'titleJudgeProgress');
?>
<div class="container">
	<div class="row">

		<div class="col-xs-12 col-md-12 margin-bottom-30">
			<h2 class="dgom-ui-h4-title font-size-40"><?=Yii::t('site','progresoJueces');?></h2>
		</div>
<?php
$index = 0;
foreach ( $jueces as $juez ) {
	?>

		<div class="col-xs-4 col-md-4 dgom-ui-judge-progress-col-margin-right">
			<!-- Judge Progress Box -->
			<div class="dgom-ui-judge-progress-box">
				<!-- Judge Progress Header -->
				<div class="dgom-ui-judge-progress-box-header <?=$colores[$index]?>">
					<h3>
					<?php echo $juez->txt_iniciales;?>
					</h3>
					<div class="text-right">
						<span><?php echo $juez->txt_nombre_juez?></span>
					</div>
				</div>
				<!-- Judge Progress Conten -->
				<div class="dgom-ui-judge-progress-box-conten">
					<?php
	$avance = ViewAvanceTotalJuez::model ()->findAll ( "id_juez=" . $juez->id_juez." AND id_contest=1" );
	foreach ( $avance as $avanceJuez ) {
		?>
					<div class="dgom-ui-judge-progress-box-conten-row">
						<div class="progress progress-lg dgom-ui-hr-progress-bar">
							<div class="progress-bar progress-bar-primary progress-bar-striped" style="width: <?php echo $avanceJuez->num_porcentaje?>%;" role="progressbar"><?php echo $avanceJuez->num_porcentaje?>%</div>
						</div>
						<h6 class="dgom-ui-judge-progress-box-conten-row-progress"><?php echo $avanceJuez->txt_name?></h6>
					</div>
                    
                    <?php }?>


				</div>
			</div>
		</div>
<?php
if($index==3){
	$index=0;
	
}else{
	$index++;
}

}
?>
	</div>
</div>