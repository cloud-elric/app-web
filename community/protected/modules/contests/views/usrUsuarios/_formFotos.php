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
				
				<div class="dgom-menu-btn-group editPhoto" data-flip="edit">
					<i class="icon ion-edit"></i><span>editar</span>
				</div>
				<div class="dgom-menu-btn-borrar deletePhoto dgom-menu-btn-borrar-<?php echo $pic->txt_pic_number ?>">
					<i class="icon ion-close-circled"></i><span>borrar</span>
				</div>
			</div>
			<!-- End .dgom-ui-front-side -->

		</div>
		<!-- End .front-side -->

		<!-- .back-side -->
		<div class="back-side back_<?=$pic->txt_pic_number?>">

			<!-- .toast-col-row -->
			<div class="row toast-col-row" id="<?=$pic->txt_pic_number?>">

				<div class="col-xs-3 col-sm-4 col-md-4 text-center">
				<?php 
				$classFile = "";
				if(!empty($pic->txt_file_name)){
					$classFile = "myFile-noSlash";
				}
				?>
					<label class="myFile <?=$classFile?>" ondragover="ondragoverFile($(this));" ondragend="console.log('end');" ondrop="ondropFile($(this))" ondragleave="ondragleaveFile($(this))">
					<?php if(empty($pic->txt_file_name)){?>
						<div class="myFile-default" style='background-image: url(<?=Yii::app()->request->baseUrl?>/images/miFotoDefault.jpg);'></div>
							<div class="myFileText">
							<i class="fa fa-upload" aria-hidden="true"></i>
							<p>Subir foto</p> <!-- Input -->
						</div>
					<?php }else{?>
							<div class="myFile-default myFile-default-upload-anim"
							style='background-image: url(<?=Yii::app()->request->baseUrl."/pictures/contests/con_".$pic->idContest->txt_token."/idu_".Yii::app()->user->concursante->txt_usuario_number."/small_".$pic->txt_file_name?>);'></div>
							<div class="myFileText" style="display:none;">
							<i class="fa fa-upload" aria-hidden="true"></i>
							<p>Subir foto</p> <!-- Input -->
						</div>
					<?php }?>		
						
						<?php echo $form->hiddenField($pic,'txt_pic_number');?>
						<?php echo $form->fileField($pic,'txt_file_name', array("onchange"=>"uploadImage('wrk-pic-form_" . $pic->txt_pic_number ."', $(this), this);", "class"=>"pictureUpload")); ?>

						<!-- .progress-upload -->
						<div class="progress-upload" >
							<div class="progress-nom"><i class="icon ion-ios-reverse-camera"></i> <p>img_32423423.jpgdsfdsfdsfdsfdsfdjhfdsgfjdsgfhdsjfgjdsgjfgdsjgfjsdgfgdsjgfhgds</p></div>
							<div class="progress">
								<div class="progress-bar progress-bar-blue active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
							</div>
							<div class="progress-num">0% completado</div>
							<div class="progress-close" data-value="cancelFoto" onclick="closeErrorUpload($(this))"><i class="icon ion-close-circled"></i><span></div>
							
						</div>
						<!-- end / .progress-upload -->
							
					</label>

					<!-- <input type="file" id="upload_file" name="upload_file" />
					
					<div class='progress' id="progress_div">
						<div class='bar' id='bar1'></div>
						<div class='percent' id='percent1'>0%</div>
					</div>
					<div id='output_image'></div> -->

					<?php echo $form->dropDownList($pic,'id_category_original',$categorias, array("prompt"=>"Seleccionar categoria", "class"=>"categoria form-control")); ?>
				</div>

				<div class="col-xs-9 col-sm-8 col-md-8">

					<div class="form-group">

						<!-- Input -->
						<?php echo $form->textField($pic,'txt_pic_name',array('class'=>"picName form-control form-control-titulo", "placeholder"=>"Agregar título")); ?>

					</div>
					<?php echo $form->textArea($pic,'txt_pic_desc', array('class'=>"picDescripcion form-control", "placeholder"=>"Agregar descripción", "maxlength"=>"500", "data-ide"=>$pic->txt_pic_number)); ?>
					
					<!-- .caracteres-wrap -->
					<div class="caracteres-wrap">
						<div class="caracteres"><span class="caracteres-limitados"><?=strlen(($pic->txt_pic_desc))?></span>/500</div>
					</div>
					<!-- end / .caracteres-wrap -->

					<!-- .text-right -->
					<div class="text-right">
						<?php
						echo CHtmlExtra::ajaxSubmitButtonExtra ( 'Guardar fotos <div class="ripplexs"></div>', CHtml::normalizeUrl ( array (
								'usrUsuarios/guardarInformacionPhoto' 
						) ), array (
								'dataType' => 'JSON',
								'type' => 'post',
								'success' => 'function(data) {

									if(data.status=="success"){
											$("#wrk-pic-form_' . $pic->txt_pic_number . ' .flip-panel").removeClass("flipped");
											$("#wrk-pic-form_' . $pic->txt_pic_number . '").removeClass("contadorForm");
											toastrSuccess("Fotografía guardada con éxito");
								
									}else{
										$("#wrk-pic-form_' . $pic->txt_pic_number . '").addClass("contadorForm");
										$.each(data, function(key, val) {
											if(key=="WrkPics_txt_file_name"){
												$("#wrk-pic-form_' . $pic->txt_pic_number . ' .myFile").addClass("myFile-drag"); 
											}
											$("#wrk-pic-form_' . $pic->txt_pic_number . ' #"+key).addClass("error");                                                    
										});
										toastrError("Hay campos sin completar");
										
									} 
								
									var  boton = $("#mybtn'. $pic->txt_pic_number.'");
									boton.removeClass("btn-white-anim");
									boton.prop("disabled", false);
							}',
								'beforeSend' => 'function(){  

									var  boton = $("#mybtn'. $pic->txt_pic_number.'");
									boton.prop("disabled", true);
									boton.addClass("btn-white-anim");
									var problem = false;
									
									var picName = $("#wrk-pic-form_' . $pic->txt_pic_number . ' .picName");
									if(picName.val().length === 0){
										picName.addClass("error");
										problem = true;
									}else{
										picName.removeClass("error");
									}
									
									var picDescripcion = $("#wrk-pic-form_' . $pic->txt_pic_number . ' .picDescripcion"); 
									if(picDescripcion.val().length === 0){
										picDescripcion.addClass("error");
										problem = true;
									}else{
										picDescripcion.removeClass("error");
									}
									
									var categoria = $("#wrk-pic-form_' . $pic->txt_pic_number . ' .categoria"); 
									if(categoria.val().length === 0){
										categoria.addClass("error");
										problem = true;
									}else{
										categoria.removeClass("error");
									}
									
									if(problem){
									$("#wrk-pic-form_' . $pic->txt_pic_number . '").addClass("contadorForm");
										toastrError("Hay campos sin completar");
								
								var  boton = $("#mybtn'. $pic->txt_pic_number.'");
									boton.removeClass("btn-white-anim");
									boton.prop("disabled", false);
								
										return false;
	   								}
								}' 
						), array (
								'id' => 'mybtn' . $pic->txt_pic_number,
								'class' => 'btn btn-white paperxs verificarButtonAjax',
								'data-flip' => "view",
								'style'=>empty($pic->txt_file_name)?"":"visibility: visible;display:inline-block;",
								"tabindex"=>"-1"
						) );
						?>
					</div>
					<!-- end / .text-right -->

				</div>
			</div>
			<!-- End .toast-col-row -->

		</div>
		<!-- End .back-side -->

	</div>
	<!-- End .flip-panel -->
	<!-- Finalizacion de la etiqueta form -->
	<?php $this->endWidget(); ?>
</div>
<!-- end / .toast-col -->


<div class="progress">
	<div class="bar"></div>
	<div class="percent">0%</div>
</div>

<!-- Modal Mensaje de ELIMINAR foto -->
<div class="modal fade in modal-danger modal-mensaje-eliminar" id="modalEliminarFoto-<?php echo $pic->txt_pic_number ?>" aria-hidden="true" aria-labelledby="modalEliminarFoto-<?php echo $pic->txt_pic_number ?>" role="dialog" tabindex="-1">
	<!-- .modal-dialog -->
	<div class="modal-dialog modal-center">
		<!-- .modal-content -->
		<div class="modal-content">
			<!-- .modal-header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="icon ion-close-circled"></i>
				</button>
				<h4 class="modal-title"><i class="icon ion-alert-circled"></i> Aviso</h4>
			</div>
			<!-- end / .modal-header -->

			<!-- .modal-body -->
			<div class="modal-body">
				<p>Esta acción borrará la foto y los datos asociados a la misma</p>
				<p>¿Seguro deseas continuar?</p>
				<?php # echo $pic->txt_pic_number ?>
			</div>
			<!-- end / .modal-body -->

			<!-- .modal-footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-red btn-small" data-dismiss="modal">Mejor no</button>
                <button type="button" class="btn btn-green btn-small btn-borrar-foto" onClick="borrarImagen($(this));" data-value="<?=$pic->txt_pic_number?>">Estoy seguro</button>
			</div>
			<!-- end / .modal-footer -->

		</div>
		<!-- end / .modal-content -->
	</div>
	<!-- end / .modal-dialog -->
</div>
<!-- Modal Mensaje de ELIMINAR foto -->


<script>
$(document).ready(function(){
	/**
	 * 
	 * @Mis Fotos
	 * Datos completos
	 * 
	 */
	$(".toast-menu-ok").click(function(){
		$('#modalDatosCompletos-<?php echo $pic->txt_pic_number ?>').modal('show');
	});

	/**
	 * 
	 * @Mis Fotos
	 * Eliminar foto
	 * 
	 */
	$(".dgom-menu-btn-borrar-<?php echo $pic->txt_pic_number ?>").click(function(){
		$('#modalEliminarFoto-<?php echo $pic->txt_pic_number ?>').modal('show');
	});
});
</script>