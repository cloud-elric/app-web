<!-- Modal Necesito Ayuda FORM -->
<div class="modal fade in modal-warning modal-necesito-ayuda"
	id="modal-necesito-ayuda" aria-hidden="true"
	aria-labelledby="modalDatosCompletos" role="dialog" tabindex="-1">
	<!-- .modal-dialog -->
	<div class="modal-dialog modal-center">
		<!-- .modal-content -->
		<div class="modal-content">

			<!-- .modal-header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<i class="icon ion-close-circled"></i>
				</button>
				<h4 class="modal-title">
					<i class="icon ion-alert-circled"></i> <?=Yii::t('necesitoAyuda', 'talk')?>
				</h4>
			</div>
			<!-- end / .modal-header -->

			<!-- .modal-body -->
			<div class="modal-body">

				<?php echo CHtml::beginForm("", "POST", array("id"=>"sendReport")); ?>
					<div class="form-group">
					<label for="selectError"><?=Yii::t('necesitoAyuda', 'tipoProblemaHeader')?>
						</label>
						 <?php echo CHtml::dropDownList("txt_tipo_incidencia", "", array(Yii::t('necesitoAyuda', 'tipoProblema1')=>Yii::t('necesitoAyuda', 'tipoProblema1'), Yii::t('necesitoAyuda', 'tipoProblema2')=>Yii::t('necesitoAyuda', 'tipoProblema2'), Yii::t('necesitoAyuda', 'tipoProblema3')=>Yii::t('necesitoAyuda', 'tipoProblema3'), Yii::t('necesitoAyuda', 'tipoProblema4')=>Yii::t('necesitoAyuda', 'tipoProblema4')), array("id"=>"selectError", "class"=>"categoria form-control"))?>
						
					</div>
				<div class="form-group">
					<label for="textAreaError"><?=Yii::t('necesitoAyuda', 'descripcionProblema')?></label>
					 <?php echo CHtml::textArea("txt_descripcion", "",array("class"=>"form-control", "id"=>"textAreaError", "placeholder"=>Yii::t('necesitoAyuda', 'descripcionProblema')))?>
				</div>
				<?php echo CHtml::endForm(); ?>
				
				
				<div class="form-group text-right">
				<?php echo CHtml::submitButton(Yii::t('necesitoAyuda', 'submit'), array("class"=>"btn btn-green btn-necesito-ayuda")); ?>
				</div>

			</div>
			<!-- end / .modal-body -->

		</div>
		<!-- end / .modal-content -->
	</div>
	<!-- end / .modal-dialog -->
</div>
<!-- Modal Necesito Ayuda FORM -->

<script>

$(document).ready(function(){

	/**
	 *  Necesito Ayuda
	 */
	$(".btn-necesito-ayuda").on("click", function() {
		var boton = $(this);
		boton.addClass("btn-necesito-ayuda-anim");
		boton.prop( "disabled", true );

		var forma = $("#sendReport");
			var formData = forma.serialize();

			$.ajax({
				url: '<?=Yii::app()->request->baseUrl?>/usrUsuarios/sendReport',
				method: "POST",
				data:  formData,
				success: function(response) {
					boton.prop( "disabled", false );
					$("#modal-necesito-ayuda").modal("hide");
					boton.removeClass("btn-necesito-ayuda-anim");
					$("#textAreaError").val("");
				},
				error: function() {
					boton.prop( "disabled", false );
					$("#modal-necesito-ayuda").modal("hide");
					boton.removeClass("btn-necesito-ayuda-anim");
					$("#textAreaError").val("");
				}

			});

	});
	
});

</script>