<?php
	$suma = 0;
	foreach ( $calificacionRubro as $rubro ) {
		
		$suma += number_format ( $rubro->num_calificacion_actual, 1 );
	}
	?>

<!-- Btn Back -->
<!-- <a class="dgom-ui-Btn dgom-ui-a-admin" href="javascript:history.back();">Back</a> -->

<?php # CHtml::link("<span class='ladda-label'>Full-size</span>", array("evaluador", "t"=>$photo->txt_pic_number), array("id"=>"dgom-js-cuenta-fullsize", "class"=>"dgom-ui-Btn dgom-ui-a-admin ladda-button", "style"=>"clear:left;", "data-style"=>"zoom-in"));?>

<!-- <a class="dgom-ui-Btn dgom-ui-a-admin image-popup-vertical-fit" style="clear:left;" href="<?php # echo Yii::app ()->params ['pathBaseImages']."idu_".$photo->iD->txt_usuario_number."/medium_".$photo->txt_file_name?>">
	Full-size
</a>
 -->
<!-- Consulta Wrapper -->
<div class="dgom-ui-consulta-wrapper">
	<div class="dgom-ui-consulta-wrapper-contend dgom-ui-impresion-contenedor">

		<!-- Bloque 1 -->
		<div class="row">
			
			<!-- Column Left -->
			<div class="col-md-7 grid grid7 dgom-ui-column-left">

				<h2 class="dgom-ui-consulta-wrapper-contend-titulo"><?=$photo->txt_pic_name?></h2>
				
				<!-- Imagen -->
				<div class="dgom-ui-consulta-wrapper-contend-foto">
					<!-- FOTO -->
					<img src="<?php echo Yii::app ()->params ['pathBaseImages']."idu_".$photo->iD->txt_usuario_number."/medium_".$photo->txt_file_name?>" alt="">
					
					<!-- Total Score -->
					<div class="progreso dgom-ui-consulta-wrapper-contend-progreso">
						<!-- <p>Total Score</p> -->
						<div class="pie-progress pie-progress-sm" data-plugin="pieProgress"
							data-barcolor="#75E268" data-size="100" data-barsize="4"
							data-goal="<?=$suma?>" aria-valuenow="<?=$suma?>" role="progressbar">
							<div class="pie-progress-number"><?=$suma?></div>
						</div>
					</div>
					
					<!-- MASK -->
					<div class="dgom-ui-consulta-wrapper-contend-foto-mask"></div>

					<!-- Mención -->
					<span class="dgom-ui-consulta-wrapper-contend-mention">
						<!-- <span class="dgom-ui-consulta-wrapper-contend-mention-icon"><i class="icon wb-check" aria-hidden="true"></i></span> -->
						<?php
						if ($photo->b_mencion == 1) {
							echo '<button type="button" class="btn btn-mention"><i class="icon wb-check" aria-hidden="true"></i></button>';
							?>
							<span>Honorable Mention</span>
						<?php }?>
					</span>

					<!-- Ver imagen / Descripción -->
					<div class="dgom-ui-consulta-wrapper-contend-detalles">
						<div class="dgom-ui-consulta-wrapper-contend-detalles-int dgom-js-consulta-leer-descripcion">
							<i class="icon ion-ios-paper"></i>
							<p><?=Yii::t('consulta', 'read')?></p>
						</div>
						<!-- <i class="site-menu-icon wb-menu" aria-hidden="true"></i> 
						<i class="site-menu-icon wb-file" aria-hidden="true"></i> 
						<i class="site-menu-icon wb-image" aria-hidden="true"></i> -->
					</div>

				</div>


				<div class="row dgom-ui-consulta-wrapper-contend-foto-row">
					<?php
					$suma = 0;
					foreach ( $calificacionRubro as $rubro ) {
						?>
							<!-- col-md-3 grid grid3 -->
							<div class="col-md-3 grid grid3 dgom-ui-consulta-wrapper-contend-foto-row-col">
								<h5><?php echo $rubro->txt_nombre_rubro?></h5>
								<p><?=number_format($rubro->num_calificacion_actual,1)?></p>
							</div>
					<?php
						$suma += number_format ( $rubro->num_calificacion_actual, 1 );
					}
					?>
				</div>

				<!-- .dgom-ui-consulta-wrapper-contend-foto-toogle -->
				<div class="dgom-ui-consulta-wrapper-contend-foto-toogle">
					

					<!-- Button -->
					<div class="dgom-ui-consulta-wrapper-contend-foto-toogle-btn">Detalle por Juez <span>+</span></div>
					
					<!-- Content -->
					<div class="dgom-ui-consulta-wrapper-contend-foto-toogle-cont">
				
						<div class="row dgom-ui-consulta-wrapper-contend-foto-row">

							<?php
							$nombre = false;
							$contara = 0;
							foreach($calificacionesJueces as $calificacion){
								?>
							<?php 
							if($contara==4){
								$nombre = false;
								$contara=0;
							}
							
										if(!$nombre){
											echo '<h5 class="dgom-ui-consulta-wrapper-contend-foto-row-tile-toogle-juez">'.$calificacion->idJuez->txt_nombre_juez. '</h5>';
											$nombre = true;
										}
										$contara++;
										?>
								<div class="dgom-ui-consulta-wrapper-contend-foto-row-item-toogle">
									<!-- col-md-3 grid grid3 -->
									<div class="col-md-3 grid grid3 dgom-ui-consulta-wrapper-contend-foto-row-col">
										<?=$calificacion->idRubro->txt_nombre?>
										<p><?=number_format($calificacion->num_calificacion)?></p>
									</div>	
								</div>
							<?php
							}
							?>
						</div>

					</div>

				</div>
				<!-- end / .dgom-ui-consulta-wrapper-contend-foto-toogle -->

			</div>

			<!-- Column Right -->
			<div class="col-md-5 grid grid5">
				

				<div class="flip-panel">

					<div class="front-side">

						<h4 class="dgom-ui-feedback-descripcion-tile">Feedback</h4>
				
						<div id="container-main" class="front-side-scroll">

							<?php
							$contador = 0;
							foreach($feedBacks as $feed){
							?>
								<div class="accordion-container">
							
									<a href="#" class="accordion-titulo"><?php echo $feed->idJuez->txt_nombre_juez; ?> <span class="toggle-icon"></span></a>
									<div class="accordion-content">
										<p><?php echo $feed->txt_retro?></p>
									</div>
						    	</div>
							<?php }?>
						    
						</div>

					</div>
					<!-- End Front Side -->


					<div class="back-side">

						<h4 class="dgom-ui-feedback-descripcion-tile"><?=Yii::t('consulta', 'description')?><span class="dgom-js-consulta-close-descripcion">+</span></h4>
						
						<div class="back-side-scroll">
							<p class="dgom-ui-descripcion-p">
								<?=$photo->txt_pic_desc?>
							</p>
						</div>
							
					</div>
					<!-- End Back Side -->

				</div> <!-- Flip Panel -->


			</div>
		</div>

		

	</div>

</div>


<!-- Test de button/link Ladda -->
<!-- 
<button class="btn btn-info ladda-button" data-style="zoom-in"><span class="ladda-label">enviar</span></button>
<button class="btn btn-info ladda-button" data-style="zoom-out"><span class="ladda-label">agregar</span></button>

<a href="#" id="form-submit" class="ladda-button" data-style="zoom-in"><span class="ladda-label">Submit form</span></a>

 -->

<?php
Yii::app ()->clientScript->registerScript ( 'my vars', '
$(document).ready(function(){

	//var categorias = $calificacionRubro->txt_nombre_rubro;

	//alert("Categorias: " + categorias);

	$(".dgom-ui-consulta-wrapper-contend-foto-toogle-cont").slideUp();
	
	// Toogle
	var estado = false;
	$(".dgom-ui-consulta-wrapper-contend-foto-toogle-btn").on("click",function(){
		$(".dgom-ui-consulta-wrapper-contend-foto-toogle-cont").slideToggle();

		if (estado == true) {
			$( ".dgom-ui-consulta-wrapper-contend-foto-toogle-btn span" ).addClass("foto-toogle-btn-anim");
			$( ".dgom-ui-consulta-wrapper-contend-foto-toogle-btn span" ).text("+");
			estado = false;
		} else {
			$( ".dgom-ui-consulta-wrapper-contend-foto-toogle-btn span" ).removeClass("foto-toogle-btn-anim");
			$( ".dgom-ui-consulta-wrapper-contend-foto-toogle-btn span" ).text("-");
			estado = true;
		}
	});
	
	
	// Agregar flip y mostrar descripción
	$(".dgom-js-consulta-leer-descripcion").on("click",function(){
		$(".flip-panel").addClass("flipped");
	});

	// Quitar flip y mostrar descripción
	$(".dgom-js-consulta-close-descripcion").on("click",function(){
		$(".flip-panel").removeClass("flipped");
	});


	// Bind normal buttons
	Ladda.bind( "div:not(.progress-demo) button", { timeout: 2000 } );

	// Bind progress buttons and simulate loading progress
	Ladda.bind( ".progress-demo button", {
		callback: function( instance ) {
			var progress = 0;
			var interval = setInterval( function() {
				progress = Math.min( progress + Math.random() * 0.1, 1 );
				instance.setProgress( progress );

				if( progress === 1 ) {
					instance.stop();
					clearInterval( interval );
				}
			}, 200 );
		}
	} );
	

	$("#dgom-js-cuenta-fullsize").on("click",function(){
	 	var l = Ladda.create(this);
	 	l.start();
	 	$.post("your-url", 
	 	    { data : data },
	 	  function(response){
	 	    console.log(response);
	 	  }, "json")
	 	.always(function() { l.stop(); });
	 	return false;
	});
	

	// // Acordeon Feedback (Consulta)
	// (function(){
	// 	var d = document,
	// 	accordionToggles = d.querySelectorAll(".js-accordionTrigger"),
	// 	setAria,
	// 	setAccordionAria,
	// 	switchAccordion,
	// 	touchSupported = ("ontouchstart" in window),
	// 	pointerSupported = ("pointerdown" in window);

	// 	skipClickDelay = function(e){
	// 		e.preventDefault();
	// 		e.target.click();
	// 	}

	// 	setAriaAttr = function(el, ariaType, newProperty){
	// 		el.setAttribute(ariaType, newProperty);
	// 	};
	// 	setAccordionAria = function(el1, el2, expanded){
	// 		switch(expanded) {
	// 			case "true":
	// 			setAriaAttr(el1, "aria-expanded", "true");
	// 			setAriaAttr(el2, "aria-hidden", "false");
	// 			break;
	// 			case "false":
	// 			setAriaAttr(el1, "aria-expanded", "false");
	// 			setAriaAttr(el2, "aria-hidden", "true");
	// 			break;
	// 			default:
	// 			break;
	// 		}
	// 	};

	// 	//function
	// 	switchAccordion = function(e) {
	// 		console.log("triggered");
	// 		e.preventDefault();
	// 		var thisAnswer = e.target.parentNode.nextElementSibling;
	// 		var thisQuestion = e.target;

	// 		if(thisAnswer.classList.contains("is-collapsed")) {
	// 			setAccordionAria(thisQuestion, thisAnswer, "true");
	// 		} else {
	// 			setAccordionAria(thisQuestion, thisAnswer, "false");
	// 		}

	// 		thisQuestion.classList.toggle("is-collapsed");
	// 		thisQuestion.classList.toggle("is-expanded");
	// 		thisAnswer.classList.toggle("is-collapsed");
	// 		thisAnswer.classList.toggle("is-expanded");

	// 		thisAnswer.classList.toggle("animateIn");
	// 	};

	// 	for (var i=0,len=accordionToggles.length; i<len; i++) {
	// 		if(touchSupported) {
	// 			accordionToggles[i].addEventListener("touchstart", skipClickDelay, false);
	// 		}
	// 		if(pointerSupported){
	// 			accordionToggles[i].addEventListener("pointerdown", skipClickDelay, false);
	// 		}
	// 		accordionToggles[i].addEventListener("click", switchAccordion, false);
	// 	}
	// })();

	$(function(){
	  $(".accordion-titulo").click(function(e){
	           
	        e.preventDefault();
	    
	        var contenido=$(this).next(".accordion-content");

	        if(contenido.css("display")=="none"){ //open        
	          contenido.slideDown(250);         
	          $(this).addClass("open");
	        }
	        else{ //close       
	          contenido.slideUp(250);
	          $(this).removeClass("open");  
	        }

	      });
	});

	



	// Gallery
	$(".image-popup-vertical-fit").magnificPopup({
		type: "image",
		closeOnContentClick: true,
		mainClass: "mfp-img-mobile",
		image: {
			verticalFit: true
		}

	});


	// Obtener Alto de div
	var heightColumnLeft = $(".dgom-ui-column-left").height();
	var heightDetalleToogle = $(".dgom-ui-consulta-wrapper-contend-foto-toogle").height();
	$(".flip-panel").css("height", heightColumnLeft - heightDetalleToogle);

});
', CClientScript::POS_END );
?>


<?php
Yii::app ()->clientScript->registerScript ( 'documentLoad', '
$(window).load(function(){
	// Obtener Alto de div
	var heightColumnLeft = $(".dgom-ui-column-left").height();
	var heightDetalleToogle = $(".dgom-ui-consulta-wrapper-contend-foto-toogle").height();
	$(".flip-panel").css("height", heightColumnLeft - heightDetalleToogle);
});
', CClientScript::POS_END );
?>