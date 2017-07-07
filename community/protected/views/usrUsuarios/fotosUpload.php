<?php
//$idConcurso = Yii::app ()->user->concurso;
$idUsuario = Yii::app ()->user->concursante->id_usuario;

// Buscamos las fotos del competidor
$fotosCompetidor = WrkPics::model ()->findAll ( array (
		"condition" => "ID=:idUsuario AND id_contest=:idConcurso",
		"params" => array (
				":idUsuario" => $idUsuario,
				":idConcurso" => $idConcurso 
		) 
) );

$con = ConContests::model()->find(array(
	'condition' => 'id_contest=:idContest',
	'params' => array(
		':idContest' => $idConcurso
	)
));

$this->pageTitle = Yii::t('general', 'subirFotosTitle');

?>

<!-- .screen-seccion -->
<div class="example box screen-seccion"
	data-options='{"direction": "vertical", "contentSelector": ">", "containerSelector": ">"}'>
	<div>
		<div>

			<?php
			if(Yii::app()->user->concursante->b_participa==0){
			?>
			<!-- .toast-menu -->
			<div class="toast-menu">
				<button class="btn toast-menu-ok participarCloud"><?=Yii::t('fotosUpload', 'concursarBtn')?></button>
			</div>
			<!-- end / .toast-menu -->
			<?php }?>

			<!-- .mis-fotos -->
			<div class="mis-fotos container">

				<!-- .toas -->
				<div class="toas">

					<?php 
					$claseMensaje = "";
					if(Yii::app ()->user->concursante->b_participa==1){
						$claseMensaje = "toast-msj-success-final";
					}?>
					<!-- .toast-msj-success -->
					<div class="toast-msj-success <?=$claseMensaje?>"><?=Yii::t('fotoUpload', 'mensajeFinalizacion')?></div>
					<!-- end /.toast-msj-success -->	
					<!-- .rowToast -->
					<div class="row rowToast">

						<h2>
							<?=Yii::t('fotosUpload', 'header')?>
						</h2>
						
					<div class="popup-gallery">
						<?php
						foreach ( $fotosCompetidor as $foto ) {

							if(Yii::app ()->user->concursante->b_participa==1){
								$this->renderPartial ( "usuarioParticipa", array(
										"pic" => $foto,
										"categorias" => $categorias 
								) );
							}else{
								$this->renderPartial ( "_formFotos", array (
										"pic" => $foto,
										"categorias" => $categorias,
										"idConcurso" => $idConcurso
								) );
							}
						}
						?>
						</div>
					</div>
					<!-- end / .rowToast -->
				</div>
				<!-- end / .toas -->

			</div>
			<!-- end / .mis-fotos -->


			<!-- footer -->
			<footer>
				<a href="http://2gom.com.mx/" target="_blank">powered by 2 Geeks one Monkey</a>
				<p data-toggle="modal" data-target="#modal-necesito-ayuda"><?=Yii::t('fotoUpload', 'needHelp')?></p>
				
				<?php $this->renderPartial ( "necesitoAyuda", array()); ?>

			</footer>
			<!-- end / footer -->


		</div>
	</div>
</div>
<!-- end / .screen-seccion -->



<!-- Modal Mensaje de DATOS COMPLETOS -->
<div class="modal fade in modal-primary modal-mensaje-datos-completos" id="modalDatosCompletos" aria-hidden="true" aria-labelledby="modalDatosCompletos" role="dialog" tabindex="-1">
	<!-- .modal-dialog -->
	<div class="modal-dialog modal-center">
		<!-- .modal-content -->
		<div class="modal-content">

			<!-- .modal-header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="icon ion-close-circled"></i>
				</button>
				<h4 class="modal-title"><i class="icon ion-alert-circled"></i> <?= Yii::t('fotosUpload', 'headerModal')?></h4>
			</div>
			<!-- end / .modal-header -->

			<!-- .modal-body -->
			<div class="modal-body">
			<p class="messageWarningModal label-lg label-round label-danger text-white"></p>
				<p><?=Yii::t('fotosUpload', 'warningMessage')?></p>
			</div>
			<!-- end / .modal-body -->

			<!-- .modal-footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-red btn-small" data-dismiss="modal"><?=Yii::t('fotosUpload', 'cancelBtn')?></button>
                <button type="button" id="aceptarConcursar" data-token="<?= $con->txt_token ?>" class="btn btn-green participar btn-small"><?=Yii::t('fotosUpload', 'successBtn')?></button>
			</div>
			<!-- end / .modal-footer -->

		</div>
		<!-- end / .modal-content -->
	</div>
	<!-- end / .modal-dialog -->
</div>
<!-- Modal Mensaje de DATOS COMPLETOS -->



<script>

$(document).ready(function(){

	/**
	 * 
	 * @Mis Fotos Datos completos
	 * 
	 */
	$(".toast-menu-ok").click(function() {

		$('#aceptarConcursar').show();
		
		var numItems = $(".contadorForm").length;
		if(numItems>0){
			$(".messageWarningModal").html("Looks like you haven't uploaded "+numItems+" pictures");
		}else{
			$(".messageWarningModal").html(" ");
			}

		if(numItems==3){
			$('#aceptarConcursar').hide();
			}
		
		$('#modalDatosCompletos').modal('show');
	});

	/**
	 *  Tooltip
	 */
	$('[data-toggle="tooltip"]').tooltip();
<?php
if(count($fotosCompetidor)>1){
?>
	/**
	 *  Pop Gallery
	 */
	$('.popup-gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: '<?=Yii::t('fotoUpload', 'loadImage')?> #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">La imagen #%curr%</a> no puede ser visualizada.',
			titleSrc: function(item) {
				return item.el.attr('title');
			}
		}
	});
	<?php
}else{
			?>
			/**
			 *  Pop Gallery
			 */
			$('.popup-gallery').magnificPopup({
				delegate: 'a',
				type: 'image',
				tLoading: '<?=Yii::t('fotoUpload', 'loadImage')?> #%curr%...',
				mainClass: 'mfp-img-mobile',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1], // Will preload 0 - before current, and 1 after the current image
					tPrev: '',
					tNext: '',
					tCounter: '',
					arrowMarkup: '',
				},
				image: {
					tError: '<a href="%url%">La imagen #%curr%</a> no puede ser visualizada.',
					titleSrc: function(item) {
						return item.el.attr('title');
					}
				}
			});

			<?php
}
			?>	

	// Check for the various File API support.
	if (window.File && window.FileReader && window.FileList && window.Blob) {
	  // Great success! All the File APIs are supported.
	} else {
		toastrError("<?=Yii::t('fotoUpload', 'browserNoSupport')?>");
	}

<?php if(Yii::app()->user->hasFlash('firstTime')):?>
    
   toastrSuccess("<?php echo Yii::app()->user->getFlash('firstTime'); ?>");

<?php endif; ?>
//Cuando se cambia el texto	
$(".picName").on("change", function(){

	var elemento = $(this);
	var id = elemento.parents("form").attr("id");
	
	$("#" + id + " .txt_pic_name_label").text(elemento.val());

	$("#" + id + " .lightBox").attr("title",elemento.val());
	
});

//Cuando se cambia el texto	
$(".picDescripcion").on("change", function(){
	var elemento = $(this);
	var id = elemento.parents("form").attr("id");
	
	$("#" + id + " .form-titulo").text(elemento.val());
	
});

//Cuando se cambia el texto	
$(".categoria").on("change", function(){
	var elemento = $(this);
	var id = elemento.parents("form").attr("id");

	var texto = $("#" + id + " .categoria option:selected").text();
	
	$("#" + id + " .form-tipo").text(texto);
	
});


// Manda la informacion del formulario
function sendAjaxInfo(elemento){

	var form = elemento.parents("form");
	var button = form.find(".verificarButtonAjax");
	var data = form.serialize();
	button.prop("disabled", true);
	$.ajax({
		url:'<?=Yii::app()->request->baseUrl?>/usrUsuarios/guardarInformacionPhoto',
		data: data,
		method:'POST',
		type:"JSON",
		success:function(response){
			button.prop("disabled", false);
		},
		statusCode: {
			404: function() {
				//alert( "Colocar un mensaje 404" );
			},
			500:function(){
				//alert( "Colocar un mensaje 500" );
					
			}
		}
	});
}

	
});

</script>
<script>
var base = "<?=Yii::app()->request->baseUrl?>"+"/";
function uploadImage(forma, input, jav) {

	var file = jav.files[0];

	if (!file) {

		return false;
	}
	
	var imagefile = file.type;

	var identificador = "#" + forma;
	var miForma = $(identificador);
	var bar = $(identificador + ' .progress-bar');
	var percent = $(identificador + ' .progress-num');
	var status = $(identificador + ' #status');
	var url = base + 'usrUsuarios/guardarFotosCompetencia';
	var button = $(identificador + " .verificarButtonAjax");
	var filename = input.val();
	$(identificador + " .progress-close").addClass("cancelarUpload");

	bar.removeClass("progress-bar-red");

	if (filename.substring(3, 11) == 'fakepath') {
		filename = filename.substring(12);
	}// remove c:\fake at beginning from localhost chrome
	// var url = base+'usrUsuarios/guardarFotosCompetencia';

	var match = [ "image/jpeg", "image/jpg" ];

	if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
		
		ocultarIconoUpload(identificador);
		mostrarBarraEstado(identificador, filename);

		var percentVal = '100%';
		bar.css("width", percentVal);
		percent.html(percentVal + " completado");

		$(identificador + " .progress-close").addClass("cerrarUpload");
		percent.html("<?=Yii::t('fotosUpload', 'fileInvalid')?>");
		bar.addClass("progress-bar-red");
		
		$(identificador + "  .imagePreviewFront").css(
				"background-image",
				"url(" + base + "images/miFotoDefault.jpg)");

		$(identificador + "  .myFile-default").css(
				"background-image",
				"url(" + base + "images/miFotoDefault.jpg)");
		$(identificador + ' .myFile').removeClass("myFile-noSlash");
		
		$(identificador + " .myFile-default").removeClass(
		"myFile-default-upload-anim");
		$(identificador + ' .verificarButtonAjax').fadeOut("slow");
		
		miForma.addClass("contadorForm");

		return false;
	}
	
	miForma.attr("action", url);
	miForma.ajaxForm({
		dataType : "JSON",
		type:'POST',
		  contentType: "application/json; charset=utf-8",
		beforeSend : function(xhr) {
			
			// aparecer boton aqui
			$(identificador + ' .verificarButtonAjax').fadeOut("slow");
			
			$(".cancelarUpload").on("click", function() {

				xhr.abort();
				ocultarBarraEstado(identificador);
				input.prop("disabled", false);

				mostrarIconoUpload(identificador);
				
				miForma.addClass("contadorForm");

				return false;
			});

			ocultarIconoUpload(identificador);
			mostrarBarraEstado(identificador, filename);
			status.empty();
			var percentVal = '0%';
			bar.css("width", percentVal);
			percent.html(percentVal + " <?=Yii::t('fotosUpload', 'completed')?>");

		
			input.prop("disabled", true);
			
			$(".participarCloud").fadeOut("slow");

		},
		uploadProgress : function(event, position, total, percentComplete) {
			var percentVal = percentComplete + '%';
			bar.css("width", percentVal);

			percent.html(percentVal + " <?=Yii::t('fotosUpload', 'completed')?>");

			if (percentVal == "100%") {
				percent.html("<?=Yii::t('fotosUpload', 'messageWait')?>");
			}
			// console.log(percentVal, position, total);
		},
		success : function(response) {

			if (response.status == "success") {
				var percentVal = '100%';
				bar.width(percentVal)
				percent.html(percentVal);

				ocultarBarraEstado(identificador);
				// mostrarIconoUpload(identificador);

				// $(identificador+" .imagePreviewFront").attr("src",
				// response.urlSmall);
				$(identificador + " .imagePreviewFront").css(
						"background-image", 'url(' + response.urlSmall + ')');
				$(identificador + " .myFile-default").css("background-image",
						'url(' + response.urlLarge + ')');
				
				$(identificador + " .lightBox").attr("href",
						response.urlLarge);
				
				$(identificador + " .myFile-default").addClass(
						"myFile-default-upload-anim");

				$(identificador + ' .myFile').addClass("myFile-noSlash");

				// aparecer boton aqui
				$(identificador + ' .verificarButtonAjax').fadeIn("slow");
				

			} else if (response.status == "error") {
				$(identificador + " .progress-close").addClass("cerrarUpload");
				percent.html(response.message);
				bar.addClass("progress-bar-red");
				
				$(identificador + "  .imagePreviewFront").css(
						"background-image",
						"url(" + base + "images/miFotoDefault.jpg)");

				$(identificador + "  .myFile-default").css(
						"background-image",
						"url(" + base + "images/miFotoDefault.jpg)");
				
				$(identificador + ' .myFile').removeClass("myFile-noSlash");
				
				$(identificador + " .myFile-default").removeClass(
				"myFile-default-upload-anim");
				$(identificador + ' .verificarButtonAjax').fadeOut("slow");
				
				miForma.addClass("contadorForm");
			}

			input.prop("disabled", false);
			$(".participarCloud").fadeIn("slow");

		},
		complete : function(xhr) {
			status.html(xhr.responseText);
		},
		error : function(xhr, msg, st) {
			input.prop("disabled", false);
			mostrarBarraEstado(identificador, filename);

			var percentVal = '100%';
			bar.css("width", percentVal);
			percent.html("<?=Yii::t('fotosUpload', 'errorMessage')?>");

			$(identificador + " .progress-close").addClass("cerrarUpload");
			bar.addClass("progress-bar-red");
			$(".participarCloud").fadeIn("slow");
			
			$(identificador + "  .imagePreviewFront").css(
					"background-image",
					"url(" + base + "images/miFotoDefault.jpg)");

			$(identificador + "  .myFile-default").css(
					"background-image",
					"url(" + base + "images/miFotoDefault.jpg)");
			
			$(identificador + ' .myFile').removeClass("myFile-noSlash");
			
			$(identificador + " .myFile-default").removeClass(
			"myFile-default-upload-anim");
			
			$(identificador + ' .verificarButtonAjax').fadeOut("slow");
			
			miForma.removeClass("contadorForm");
		}

	});

	miForma.submit();

}

</script>