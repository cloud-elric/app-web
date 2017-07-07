<?php
$idConcurso = Yii::app ()->user->concurso;
$idUsuario = Yii::app ()->user->concursante->id_usuario;

// Buscamos las fotos del competidor
$fotosCompetidor = WrkPics::model ()->findAll ( array (
		"condition" => "ID=:idUsuario AND id_contest=:idConcurso",
		"params" => array (
				":idUsuario" => $idUsuario,
				":idConcurso" => $idConcurso 
		) 
) );

$this->pageTitle = 'Haz clic con México - Cargar Materiales. ';

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
				<button class="btn toast-menu-ok participarCloud" data-toggle="tooltip" data-placement="top" title="Subir">Concursar</button>
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
					<div class="toast-msj-success <?=$claseMensaje?>">Tus materiales ya fueron ingresados
						al consurso - ¡Mucho Éxito!</div>
					<!-- end /.toast-msj-success -->	
					<!-- .rowToast -->
					<div class="row rowToast">

						<h2>
							Mis<span>Fotos</span>
						</h2>
						
					<div class="popup-gallery">
						<?php
						foreach ( $fotosCompetidor as $foto ) {

							if(Yii::app ()->user->concursante->b_participa==1){
								$this->renderPartial ( "usuarioParticipa", array (
										"pic" => $foto,
										"categorias" => $categorias 
								) );
							}else{
								$this->renderPartial ( "_formFotos", array (
										"pic" => $foto,
										"categorias" => $categorias 
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
				<p data-toggle="modal" data-target="#modal-necesito-ayuda">Necesito Ayuda</p>
				
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
				<h4 class="modal-title"><i class="icon ion-alert-circled"></i> Aviso</h4>
			</div>
			<!-- end / .modal-header -->

			<!-- .modal-body -->
			<div class="modal-body">
			<p class="messageWarningModal"></p>
				<p>Al presionar este botón consursaras con las fotos en el estado en que se encuentran actualmente</p>
			</div>
			<!-- end / .modal-body -->

			<!-- .modal-footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-red btn-small" data-dismiss="modal">Mejor reviso que todo este completo</button>
                <button type="button" class="btn btn-green participar btn-small">Listo todos los datos estan completos</button>
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
		tLoading: 'Cargando imagen #%curr%...',
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
				tLoading: 'Cargando imagen #%curr%...',
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
		toastrError('Estas usando un navegador no soportado.');
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
		type:"POST",
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
