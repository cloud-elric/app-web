
<?php
$lugares ["-1"] = "All";
$li = '';
for($i = 1; $i <= 10; $i ++) {
	$li.= "<li>".CHtml::link($i, array("juecesAdmin/finalists", "places"=>$i), array("class"=>"animsition-link"))."</li>"; 
	// $li.= "<li><span>".$i." Finalistas<span></li>"; 
}

?>
	<div class="dgom-ui-finalist-dropdown-right">
		<p><?=Yii::t('finalists','selectMostrar')?>:</p>
		<div class="dgom-ui-drop-order">
			<div class="button-group">
				<i id="icon"></i>
				<p id="input"><?=$places?></p>
				<ul id="dropdown-menu">
					<?=$li?>
				</ul>
			</div>
		</div>
	</div>
	<?php if(Yii::app()->user->hasFlash('error')):?>
	
	<div class="container container-message">
    <div class="toast-msj-success-final toast-msj-success" >
       <?=Yii::t('finalists', 'warningFinal');?> <?= Yii::app()->user->getFlash('error'); ?>
    </div>
    </div>
<?php endif; ?>
	<div class="popup-gallery">
<?php
foreach ( $categorias as $categoria ) {
	$index = 1;
	
	$lugares = ViewCalificacionFinal::model ()->findAll ( array (
			"condition" => "b_status=2 AND b_calificada = 1 AND id_category=:idCategoria",
			"params" => array (
					":idCategoria" => $categoria->id_category 
			),
			"order" => "num_calificacion DESC, num_calificacion_desempate DESC",
			//'limit'=>$places
	) );
	
	$calificacionAnterior = NULL;
	
	?>
	
<div class="container dgom-ui-finalist-cat-box">
		<div class="row padding-horizontal-50">
			<div class="col-md-12">
				<h2 class="dgom-ui-title-section-finalists font-size-40"><?= $categoria->txt_name?></h2>
			</div>
		</div>
		<div class="row padding-vertical-0 padding-horizontal-50">
	   <?php
	   $concursantes = array();
	foreach ( $lugares as $lugar ) {
		
		if(($index-1)==$places){
			break;
		}
		
		if(!in_array($lugar->ID,$concursantes)){
		
		$concursantes[]=$lugar->ID; 
		
		if (empty ( $calificacionAnterior )) {
			
			$calificacionAnterior = $lugar->num_calificacion;
		}
		
		if ($calificacionAnterior != $lugar->num_calificacion) {
			
		}
		
		$calificacionAnterior = $lugar->num_calificacion;
		?>
	   
		<div class="col-md-4 margin-bottom-20">
				<div
					class="dgom-ui-col-overlay dgom-ui-col-overlay-finalists dgom-ui-col-overlay-finalistsHeight">
					<figure class="overlay overlay-hover dgom-ui-overlay-cont">
						<img class="overlay-figure"
							src="<?php echo Yii::app ()->params ['pathBaseImages']."idu_".$lugar->txt_usuario_number."/small_".$lugar->txt_file_name?>"
							alt="...">

						<figcaption
							class="overlay-panel overlay-background overlay-fade overlay-icon overlay-panel-link">

<!-- 							<a 
								href="<?php echo Yii::app ()->params ['pathBaseImages']."idu_".$lugar->txt_usuario_number."/medium_".$lugar->txt_file_name?>"
								title="<?=$lugar->txt_pic_name?>">
								<i class="icon wb-search " aria-hidden="true"></i>
							</a> -->
						
						<?php echo CHtml::link('<i class="icon wb-search " aria-hidden="true"></i>', array("juecesAdmin/consulta", "t"=>$lugar->txt_pic_number))?>
						<?php # echo CHtml::link("", array("juecesAdmin/evaluador", "id"=>$lugar->id_pic), array("class"=>"icon wb-search icon-middle"))?>
					</figcaption>
					
					<?php if($lugar->num_calificacion_desempate>0){ ?>
						<div class="dgom-ui-col-finalist-desempate">
							<span><?=$lugar->num_calificacion_desempate;?></span>
							<i class="fa fa-star" aria-hidden="true"></i>
						</div>
					<?php } ?>
					
					<?php if($lugar->b_mencion==1){?>
					<button type="button" class="btn btn-floating btn-primary btn-sm">
							<i class="icon wb-check" aria-hidden="true"></i>
						</button>
					<?php }
					?>
					<div class="progreso">
							<div class="pie-progress pie-progress-sm"
								data-plugin="pieProgress" data-barcolor="#75E268"
								data-size="100" data-barsize="4"
								data-goal="<?=$lugar->num_calificacion?>"
								aria-valuenow="<?=$lugar->num_calificacion?>" role="progressbar">
								<div class="pie-progress-number"><?=$lugar->num_calificacion?></div>
							</div>
						</div>
						<div>
						

						
					</figure>
				</div>

				<h5 class="dgom-ui-h5-place" style="text-align: left;"><?php echo Utils::ordinalSuffix ( $index);?> PLACE</h5>

				<h6 class="dgom-ui-h6-datos dgom-ui-h6-datos"><?=$lugar->display_name ?></h6>
				<!--  	<h6 class="dgom-ui-h6-datos"><?=$lugar->txt_email?></h6>
			<h6 class="dgom-ui-h6-datos"><?=$lugar->txt_pic_name?></h6>-->

			</div>
	
		<?php
		$index ++;
		}
	}
	?>
	</div>
	</div>
<?php
}
?>

</div>

<?php
/*
 * Yii::app ()->clientScript->registerScript ( 'myfinalist', '
 * $(document).ready(function(){
 *
 * $(".popup-gallery").magnificPopup({
 * delegate: "a",
 * type: "image",
 * tLoading: "Loading image #%curr%...",
 * removalDelay: 500,
 * mainClass: "mfp-img-mobile",
 * gallery: {
 * enabled: true,
 * navigateByImgClick: false,
 * preload: [0,1] // Will preload 0 - before current, and 1 after the current image
 * },
 * callbacks: {
 * buildControls: function() {
 * // re-appends controls inside the main container
 * this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
 * }
 * },
 * image: {
 * tError: "Error al cargar la imagen.",
 * markup: "<div></div>",
 * }
 *
 * });
 *
 *
 * });
 * ', CClientScript::POS_END );
 */
?>
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
<script>
$(document).ready(function(){

// 	$(".popup-gallery").magnificPopup({
// 	    delegate: "a",
// 	    type: "image",
// 	    tLoading: "Loading image #%curr%...",
// 	    removalDelay: 500,
// 	    mainClass: "mfp-img-mobile",
// 	    gallery: {
// 			enabled: true,
// 			navigateByImgClick: false,
// 			preload: [0,1]
// 	    },
// 		callbacks: {
// 			buildControls: function() {
// 				this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
// 			}
// 		},
// 		image: {
// 			tError: "Error al cargar la imagen.",
// 			// markup: '<div class="mfp-content"><div class="mfp-figure">'+
// 			// 	'<div class="mfp-close"></div>'+
// 			// 	'<div class="mfp-img"></div>'+
// 			// 	'<div class="mfp-bottom-bar">'+
// 			// 	$(".mfp-content").append(arrowLeft)+
// 			// 	'<button title="Siguiente" type="button" class="mfp-arrow mfp-arrow-right mfp-prevent-close">Siguiente</button>'+
// 			// 	'</div>'+
// 			// 	'</div>'+
// 			// 	'</div>',
// 		}

// 	});

	// Dropdown
	var triggerOpen = $("#input");
	var triggerClose = $("#dropdown-menu").find("li");
	var marka = $("#icon");
	// set initial Marka icon
	var m = new Marka("#icon");
	m.set("triangle").size(10);
	m.rotate("down");
	// trigger dropdown
	triggerOpen.add(marka).on("click", function(e) {
		e.preventDefault();
		$("#dropdown-menu").add(triggerOpen).toggleClass("open");
		if($("#icon").hasClass("marka-icon-times")) {
			m.set("triangle").size(10);
		} else {
			m.set("times").size(15);
		}
	});
	triggerClose.on("click", function() {
		// set new placeholder for demo
		var options = $(this).find("a").html();
		triggerOpen.text(options);
		$("#dropdown-menu").add(triggerOpen).toggleClass("open");
		m.set("triangle").size(10);
	});
	

});


</script>