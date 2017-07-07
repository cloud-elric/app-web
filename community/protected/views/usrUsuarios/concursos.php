<?php 
$cs = Yii::app ()->getClientScript ();
$cs->registerCssFile ( Yii::app ()->request->baseUrl . "/css/concursos.css" );
?>
<style>

.tab-pane .card-concurso .panel{
	background-repeat: no-repeat;
	background-size:cover;
	background-position:center;
}

	.panel-body{
		min-height: 150px;
	}
</style>
<div class="container concursos">

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Concursos abiertos</a></li>
   <li><a data-toggle="tab" href="#menu1">Concursos inscrito</a></li> 
<!--   <li><a data-toggle="tab" href="#menu2">Próximos concursos</a></li> -->
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
   	<div class="row">
	<?php 
	
foreach($concursosDisponibles as $concurso){
?>
<a class="card-concurso" href="<?=Yii::app()->request->baseUrl?>/usrUsuarios/concurso?idToken=<?=$concurso->txt_token?>">
	<div class="col-md-4">
		<div class="panel" style="background-image:url(<?=Yii::app()->request->baseUrl?>/images/<?=$concurso->txt_token?>/<?=$concurso->txt_ico_url?>)">
			<div class="panel-body">
				<!--  <h2><?=$concurso->txt_name?></h2>-->
			</div> 
		</div>
	</div>
	</a>
	<?php }?>	
	</div>
  </div>
  
  <div id="menu1" class="tab-pane">
   	<div class="row">
	<?php 
	
foreach($concursosUsuario as $concursoUsuario){
?>
<a class="card-concurso" href="<?=Yii::app()->request->baseUrl?>/usrUsuarios/concurso?idToken=<?=$concursoUsuario->txt_token?>">
	<div class="col-md-4">
		<div class="panel" style="background-image:url(<?=Yii::app()->request->baseUrl?>/images/<?=$concursoUsuario->txt_token?>/<?=$concursoUsuario->txt_ico_url?>)">
			<div class="panel-body">
				<!--  <h2><?=$concursoUsuario->txt_name?></h2>-->
			</div> 
		</div>
	</div>
	</a>
	<?php }?>	
	</div>
  </div>
 
</div>
</div>
