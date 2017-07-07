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
			
			$criteria = new CDbCriteria ();
			$criteria->alias = "CP";
			$criteria->condition = "CP.id_category=" . $categoria->id_category . " AND CP.b_calificada=1 AND CP.id_pic NOT IN (SELECT id_pic FROM 2gom_calificaciones_desempate WHERE id_juez=".$idJuez.")";
			$criteria->join = "JOIN (SELECT distinct num_calificacion score3
     					 FROM 2gom_view_calificacion_by_pic
      					WHERE id_category=" . $categoria->id_category . " AND b_calificada=1
      					ORDER BY num_calificacion DESC LIMIT 3 ) x ON CP.num_calificacion = x.score3";
			$criteria->order = "CP.num_calificacion DESC";
			$lugares = ViewCalificacionByPic::model ()->findAll ( $criteria );
			
			// Contamos cuantos valores hay
			$valoresEmpatados = array ();
			foreach ( $lugares as $lugar ) {
				$valoresEmpatados [] = $lugar->num_calificacion;
			}
			
			$countCalificaciones = array_count_values ( $valoresEmpatados );
			$val = 0;
			foreach ( $countCalificaciones as $key => $value ) {
				
				if ($value > 1) {
					
					$val = $val + intval ( $value );
				}
			}
			
			if (! empty ( $lugares ) && $val > 0) {
				?>
				<div class="col-md-3 margin-vertical-10">
			<div class="col-breaker-round">
				<h3 class="font-size-30"><?=$categoria->txt_name?></h3>
				<h5 class="font-size-20"><?=$val?> photos tied</h5>
			</div>
			<div class="text-right">
			<?php echo CHtml::link("Resolve", array("jueces/breakerRoundByCategory", "id"=>$categoria->id_category), array("class"=>"btn btn-raised btn-primary ladda-button", "data-style"=>"expand-left", "data-plugin"=>"ladda"))?>
			</div>
		</div>		
		<?php
			}
			?>
		
		<?php }?>
	</div>
</div>