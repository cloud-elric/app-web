<div class="container">
	<div class="row padding-horizontal-50">
		<div class="col-md-12">
			<h2 class="title-section-breaker-round">Finalists Round</h2>
		</div>
	</div>
	<div class="row padding-vertical-30 padding-horizontal-50">
		<?php
		$idJuez = Yii::app ()->user->juezLogueado->id_juez;
		foreach ( $categorias as $categoria ) {
	
				$calificadas = Yii::app()->db->createCommand()
		->from('2gom_view_calificacion_final CF')
		->leftJoin('2gom_con_calificaciones_finalistas CFF', 'CFF.id_pic = CF.id_pic')
		->where('CF.id_category = :idCategory AND CF.b_status = 2 AND CF.b_calificada = 1 AND CFF.id_juez =:idJuez', array(':idJuez'=>$idJuez, ':idCategory'=>$categoria->id_category))
		->queryAll();

if(count($calificadas)==0){
				
				?>
				
		<div class="col-md-3 margin-vertical-10">
			<div class="col-breaker-round">
				<h3 class="font-size-30"><?=$categoria->txt_name?></h3>
				
			</div>
			<div class="text-right">
			<?php echo CHtml::link("Resolve", array("judgingPanel/finalistasByCategory", "id"=>$categoria->id_category, 't'=>$t), array("class"=>"btn btn-raised btn-primary ladda-button", "data-style"=>"expand-left", "data-plugin"=>"ladda"))?>
			</div>
		</div>	
		<?php }} ?>
	</div>
</div>

<script>

$(window).bind("pageshow", function(event) {
    if (event.originalEvent.persisted) {
        window.location.reload() 
    }
});

</script>