<?php
/* @var $this UsrUsuariosController */
/* @var $model WrkPics */
/* @var $form CActiveForm */
?>

<!-- .toast-col -->
<div class="col-xs-12 col-sm-12 col-md-12 toast-col">
	<!-- Creacion de la etiqueta form -->
	<?php
	$pic->scenario = "incomplete";
	$class = "";
	$classForm = "";
	$completePic = $pic->validate ();
	if (! $completePic) {
		$class = "flipped";
		$classForm = "contadorForm";
	}
	
	if(Yii::app()->user->concursante->b_participa==1){
		$class = "";
	}
	
	$form = $this->beginWidget ( 'CActiveForm', array (
			'id' => 'wrk-pic-form_' . $pic->txt_pic_number,
			'htmlOptions' => array (
					'enctype' => 'multipart/form-data',
					'action' => 'usrUsuarios/guardarFotosCompetencia',
					'class' => 'form-wrk-pic '.$classForm 
			),
			'enableAjaxValidation' => true,
			'clientOptions' => array (
					'validateOnSubmit' => true 
			),
			'enableClientValidation' => true 
	) );
	
	
	?>

	<!-- .flip-panel -->
	<div class="flip-panel front_<?=$pic->txt_pic_number?> <?=$class?>">

		<!-- .front-side -->
		<div class="front-side">

			<!-- .toast-col-row -->
			<div class="row toast-col-row">
				<div class="col-xs-3 col-sm-4 col-md-4">
				<?php if(empty($pic->txt_file_name)){?>
					<div class="imagePreviewFront" style="background-image: url(<?=Yii::app()->request->baseUrl?>/images/miFotoDefault.jpg);"></div>
					<!-- <img class="imagePreviewFront" src="http://lorempixel.com/300/200/city/1/" alt=""> -->
				<?php }else{?>
				<div class="imagePreviewFront" style="background-image: url('<?=Yii::app()->request->baseUrl."/pictures/contests/con_".$pic->idContest->txt_token."/idu_".Yii::app()->user->concursante->txt_usuario_number."/small_".$pic->txt_file_name?>');"></div>
				<!-- <img class="imagePreviewFront" src="<? # =Yii::app()->request->baseUrl."/pictures/contests/con_".$pic->idContest->txt_token."/idu_".Yii::app()->user->concursante->txt_usuario_number."/small_".$pic->txt_file_name?>" alt=""> -->
					
				<?php }?>	
					<p class="form-tipo"><?=empty($pic->idCategoriaOriginal)?"Sin categoria":CHtml::encode($pic->idCategoriaOriginal->txt_name)?></p>
				</div>

				<div class="col-xs-9 col-sm-8 col-md-8">
					<h3 class="txt_pic_name_label"><?=empty($pic->txt_pic_name)?"Sin nombre":CHtml::encode($pic->txt_pic_name)?></h3>
					<p class="form-titulo"><?=empty($pic->txt_pic_desc)?"Sin descripción":CHtml::encode($pic->txt_pic_desc)?></p>
				</div>
			</div>
			<!-- End .toast-col-row -->

			<!-- .dgom-ui-front-side -->
			<div class="dgom-ui-front-side">
			
			<?php 
			if(empty($pic->txt_file_name)){
			?>
				<a class="lightBox" href="<?=Yii::app()->request->baseUrl."/images/miFotoDefaultLg.jpg"?>" title="Sin foto"> <i class="fa fa-eye"></i>
					<span>ver</span>
				</a>
				
				<?php }else{?>
				<a class="lightBox" href="<?=Yii::app()->request->baseUrl."/pictures/contests/con_".$pic->idContest->txt_token."/idu_".Yii::app()->user->concursante->txt_usuario_number."/large_".$pic->txt_file_name?>" title="<?=CHtml::encode($pic->txt_pic_name)?>"> <i class="fa fa-eye"></i>
					<span>ver</span>
				</a>
				<?php }?> 
			</div>
			<!-- End .dgom-ui-front-side -->

		</div>
		<!-- End .front-side -->


	</div>
	<!-- End .flip-panel -->
	<!-- Finalizacion de la etiqueta form -->
	<?php $this->endWidget(); ?>
</div>
<!-- end / .toast-col -->




