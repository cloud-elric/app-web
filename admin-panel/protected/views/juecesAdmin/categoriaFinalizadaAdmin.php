<div class="container">
	<div class="row">
		<div class="pleca-finished">
			<div class="finished-header">
				<h2>Hay empate</h2>
			</div>
			<div class="finished-contend">
				<p>
					Los finalistas se mostraran una vez termine la ronda de desempate
				</p>
			</div>
		</div>
	</div>
	<?php foreach($avanceJueces as $avance){?>
	<div class="row">
		<div class="col-md-6">
		<h3><?=$avance->txt_nombre_juez?></h3>
		<h3><?=$avance->num_pics_desempatadas?></h3>
		<h3><?=$avance->num_total_empate?></h3>
		</div>
	</div>
	<?php }?>
</div>