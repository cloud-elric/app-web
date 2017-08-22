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

<style>
.container-botones{
	margin: 0 auto;
	margin-bottom: 10px;
    width: 90%;
}

.btn.btn-comite{
	background: rgba(0, 0, 0, 0.6);
	color: white;
}

</style>

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
			<div class="container-botones">
				<?php 
				$categorias = [];
					foreach($categorias as $categoria){
						
				 ?>
				<a target="_blank" class="btn btn-comite" href="<?=Yii::app()->request->baseUrl?>/usrUsuarios/verFotosCategoria?token=<?=$categoria->txt_token_category?>" ><?=$categoria->txt_name_es?></a>
				<?php }?>
			</div>
				
				<!-- .toas -->
				<div class="toas">

					<?php 
					$claseMensaje = "";
					if(Yii::app ()->user->concursante->b_participa==1){
						$claseMensaje = "toast-msj-success-final";
					}?>
					
					<div class="row rowToast">

						<h2>
							<?=Yii::t('fotosUpload', 'header')?>
						</h2>
						
					<div class="popup-gallery">
						<?php
						foreach ( $fotosCompetidor as $foto ) {

							if(Yii::app ()->user->concursante->b_participa==1){
								$this->renderPartial ( "usuarioParticipaFinalizado", array(
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
				<p data-toggle="modal" data-target="#modal-necesito-ayuda"><?=Yii::t('fotoUpload', 'needHelp')?></p>
				
				<?php $this->renderPartial ( "necesitoAyuda", array()); ?>

			</footer>
			<!-- end / footer -->


		</div>
	</div>
</div>
<!-- end / .screen-seccion -->




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
		delegate: '.lightBox',
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
				delegate: '.lightBox',
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





	
});

</script>
