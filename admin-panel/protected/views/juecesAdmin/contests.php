<div class="container">
	<div class="row padding-50">
	<?php foreach($concursos as $concurso){?>
		<a class="col-md-4" href="<?=Yii::app()->request->baseUrl?>/adminPanel/dashboard/<?=$concurso->txt_token?>">
			
				<div class="panel" style="background:url('<?=Yii::app()->params['pathBase']?>images/<?=$concurso->txt_token?>/<?=$concurso->txt_ico_url?>');    background-repeat: no-repeat;
    background-position: center;
    background-size: cover; height:120px;">
					<div class="panel-body">
						<h3></h3>
					</div>
				</div>
		</a>
	<?php }?>	
	</div>
</div>