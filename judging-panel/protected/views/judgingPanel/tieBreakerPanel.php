<div class="container">
	<div class="row padding-horizontal-50">
		<div class="col-md-12">
			<h2 class="title-section-breaker-round">Tie Breaker Round</h2>
		</div>
	</div>
	<div class="row padding-vertical-30 padding-horizontal-50">
		<?php
		$idJuez = Yii::app ()->user->juezLogueado->id_juez;
		foreach ( $categorias as $categoria ) {
			
			$c = new CDbCriteria ();
			$c->alias = 'CF';
			$c->condition = 'CF.id_category =:idCategoria  AND CF.b_empate_alterno = 1 AND CF.b_calificada_desempate=0 AND CF.id_pic NOT IN (SELECT id_pic FROM 2gom_con_calificaciones_desempate WHERE id_juez=:idJuez) AND id_contest=:idContest';
			$c->join = 'INNER JOIN (SELECT DISTINCT F.num_calificacion
						FROM 2gom_view_calificacion_final F
						WHERE F.id_category=:idCategoria
						order by F.num_calificacion DESC
						LIMIT 10
						) AS W ON W.num_calificacion = CF.num_calificacion';
			$c->params = array (
					':idCategoria' => $categoria->id_category,
					':idJuez' => $idJuez,
					':idContest' =>$concurso->id_contest
			);
			
			$fotosEmpatadas = ViewCalificacionFinal::model ()->findAll ( $c);
			
			$numFotos = count ( $fotosEmpatadas );
			if ($numFotos > 0) {
				
				?>
				
		<div class="col-md-3 margin-vertical-10">
			<div class="col-breaker-round">
				<h3 class="font-size-30"><?=$categoria->txt_name?></h3>
				<h5 class="font-size-20"><?=$numFotos?> photos tied</h5>
			</div>
			<div class="text-right">
			<?php echo CHtml::link("Resolve", array("judgingPanel/breakerRoundByCategory", "id"=>$categoria->id_category, 't'=>$t), array("class"=>"btn btn-raised btn-primary ladda-button", "data-style"=>"expand-left", "data-plugin"=>"ladda"))?>
			</div>
		</div>	
		<?php } }?>
	</div>
</div>

<script>

$(window).bind("pageshow", function(event) {
    if (event.originalEvent.persisted) {
        window.location.reload() 
    }
});

</script>