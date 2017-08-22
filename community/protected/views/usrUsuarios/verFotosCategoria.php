<div class="mis-fotos container">

	<!-- .screen-seccion -->

	<div class="example box screen-seccion"

		data-options='{"direction": "vertical", "contentSelector": ">", "containerSelector": ">"}'>

		<div>

			<div>

			<?php if(!$isConcursoFinalizado){?>

				<div class="container message-contenedor">

					<p>Los resultados mostrados son parciales.</p>

				</div>

			<?php }?>	

				<div class="container dgom-ui-finalist-cat-box popup-gallery">

					<div class="row padding-horizontal-50">

						<div class="col-md-12">

							<h5 class="dgom-ui-title-section-finalists font-size-40"><?=$categoria->txt_name_es?></h5>

						</div>

					</div>

					<div class="row padding-vertical-0 padding-horizontal-50">

			

			<?php foreach($imagenes as $imagen){?>

					<div class="col-md-4 margin-bottom-20">

						<div class="dgom-ui-col-overlay dgom-ui-col-overlay-finalists dgom-ui-col-overlay-finalistsHeight">

							<figure class="overlay overlay-hover dgom-ui-overlay-cont">

								<img class="overlay-figure" src="<?php echo Yii::app ()->params ['pathBaseImages'].'con_'.$this->tokenContest."/idu_".$imagen->txt_usuario_number."/medium_".$imagen->txt_file_name?>" alt="...">



								<figcaption class="overlay-panel overlay-background overlay-fade overlay-icon overlay-panel-link">

									<a href="<?php echo Yii::app ()->params ['pathBaseImages'].'con_'.$this->tokenContest."/idu_".$imagen->txt_usuario_number."/large_".$imagen->txt_file_name?>"><i class="icon wb-search " aria-hidden="true"></i></a>											

								</figcaption>

								<?php 

								if($imagen->id_contest >= 4){

									if($isConcursoFinalizado && $imagen->b_empate){

								?>

										<div class="dgom-ui-col-finalist-desempate">

											<span><?=$imagen->num_calificacion_desempate?></span>

											<i class="fa fa-star" aria-hidden="true"></i>

										</div>

							<?php }

							}else{

								if($imagen->b_empate){

								?>

									<div class="dgom-ui-col-finalist-desempate">

										<span><?=$imagen->num_calificacion_desempate?></span>

										<i class="fa fa-star" aria-hidden="true"></i>

									</div>

						<?php }

						}?>

									<?php 

									$calificacion = 0;

									if($imagen->id_contest>=4){

										if($imagen->b_calificada == 1){

											$calificacion = round($imagen->num_calificacion);

										}else{

											$calificacion = round($imagen->num_calificacion); 			

										}	

									}else{

										

										$calificacion = round($imagen->num_calificacion);

									}

									?>		

											<div class="progreso">

							<div class="pie-progress pie-progress-sm"

								data-plugin="pieProgress" data-barcolor="#75E268"

								data-size="100" data-barsize="4"

								data-goal="<?=$calificacion?>"

								aria-valuenow="<?=$calificacion?>" role="progressbar">

								<div class="pie-progress-number"><?=$calificacion?></div>

							</div>

						</div>

							</figure>

						</div>				

					</div>



			<?php }?>



					



				</div>

			</div>

		</div>

	</div>

	

<!-- end / .screen-seccion -->

</div>



<!-- footer -->

<footer>

	<a href="http://2gom.com.mx/" target="_blank">powered by 2 Geeks one Monkey</a>

	<p data-toggle="modal" data-target="#modal-necesito-ayuda"><?=Yii::t('fotoUpload', 'needHelp')?></p>

	

	<?php $this->renderPartial ( "necesitoAyuda", array()); ?>



</footer>

<!-- end / footer -->



<script>

$(document).ready(function(){

	$('.popup-gallery').magnificPopup({

				delegate: 'a',

				type: 'image',

				tLoading: '<?=Yii::t('fotoUpload', 'loadImage')?> #%curr%...',

				mainClass: 'mfp-img-mobile',

				gallery: {

					enabled: true,

					navigateByImgClick: true,

					preload: [0,1], // Will preload 0 - before current, and 1 after the current image

					// tPrev: '',

					// tNext: '',

					// tCounter: '',

					// arrowMarkup: '',

				},

				image: {

					tError: '<a href="%url%">La imagen #%curr%</a> no puede ser visualizada.',

					titleSrc: function(item) {

						return item.el.attr('title');

					}

				}

			});

});

</script>	

 



