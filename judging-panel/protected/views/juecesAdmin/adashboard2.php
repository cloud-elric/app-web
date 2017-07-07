<div class="popup-gallery">

	<div class="container-fluid padding-0">
		<!-- Columna Izquierda y Galeria -->
		<div class="col-md-9">
			<div
				class="page-content container-fluid padding-vertical-20 padding-horizontal-0">
				<div class="grid-stack grid-stack-3848 grid-stack-animate"
					id="dgom-js-grid" data-plugin="gridstack" data-gs-width="12"
					data-gs-animate="yes" style="height: 580px;">

				<?php
				$constantes = new Constantes ();
				$coordenadas = $constantes->coordenadas;
				$row = 0;
				$index = 0;
				foreach ( $picsCategoria as $pic ) {
					?>
					<div
						class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide ui-resizable-disabled"
						data-gs-x="<?=$coordenadas[$index]["x"]?>"
						data-gs-y="<?=$coordenadas[$index]["y"] + $row?>"
						data-gs-width="<?=$coordenadas[$index]["w"]?>"
						data-gs-height="<?=$coordenadas[$index]["h"]?>"
						data-gs-no-resize="yes">

						<div
						class="grid-stack-item-content panel ui-draggable-handle img-box bg-box-one" style="background:url('<?php echo Yii::app ()->params ['pathBaseImages']."idu_".$pic->iD->txt_usuario_number."/small_".$pic->txt_file_name?>')  no-repeat 50%; background-size: cover;">
							<div class="smallFull">
							<?php
					
echo CHtml::link ( '
							<div class="icon-middle">
								<div>
									<p>
										<i class="icon wb-pencil" aria-hidden="true"></i>
									</p>
									<span>' . Yii::t ( 'site', 'viewPhoto' ) . '</span>
								</div>
							</div>
							', array (
							"adminPanel/viewRatingPhoto",
							"t" => $pic->txt_pic_number 
					), array (
							"class" => "viewImage" 
					) );

?>



						</div>
						<?php if($pic->b_mencion==1){?>
							<button type="button" class="btn btn-floating btn-primary btn-sm">
								<i class="icon wb-check" aria-hidden="true"></i>
							</button>
						<?php }?>


					</div>

						<div
							class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se"
							style="z-index: 90; display: none;"></div>
					</div>			
					
				<?php
					
					if ($index == 17) {
						$index = 0;
						$row += 8;
						echo ("<!-- Cambio de renglon-->");
					} else {
						$index ++;
					}
				}
				?>
				<!-- Fila 1 : Primer grupo de 3 -->
				</div>
			</div>


		</div>

		<!-- Columna Derecha Filtros -->
		<div class="col-md-3 padding-0">
			<div class="dgom-ui-col-right-overall-progress">


				<h3 class="dgom-ui-col-right-title"><?=$categoria->txt_name?></h3>
				<p class="dgom-ui-col-right-sub-title"><?=$categoria->num_fotos_calificadas." / ".$categoria->num_total_fotos?></p>

				<div class="progress progress-lg dgom-ui-col-right-progress">
					<div
					class="progress-bar progress-bar-primary progress-bar-striped active"
					aria-valuenow="<?=$categoria->num_porcentaje_general?>" aria-valuemin="0" aria-valuemax="100"
					style="width: <?=$categoria->num_porcentaje_general?>%" role="progressbar"><?=$categoria->num_porcentaje_general?>%</div>
				</div>
				<span class="dgom-ui-col-right-progress-texto"><?=Yii::t('site','progresoProgress')?></span>


				<h3 class="dgom-ui-col-right-title-light"><?=Yii::t('site','filters')?></h3>


				<div class="dgom-ui-range-content">
					<span><?=Yii::t('site','score')?></span>
					<div class="nstSlider" data-range_min="1" data-range_max="100"
						data-cur_min="1" data-cur_max="100">

						<div class="bar"></div>
						<div class="leftGrip"></div>
						<div class="rightGrip"></div>
					</div>
					<div class="leftLabel"></div>
					<div class="rightLabel"></div>
				</div>

				<article class="pull-ok">
					<input type="checkbox" class="icheckbox-primary"
						id="inputUnchecked" name="inputiCheckCheckboxes"
						data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue" />
					<label class="label-check" for="inputUnchecked"><?=Yii::t('site','honorableMentions')?></label>
				</article>

			</div>
		</div>

	</div>
</div>
<?php

Yii::app ()->clientScript->registerScript ( 'my vars', '
$(document).ready(function(){

	//
	addHeight();
	
	// Agregar height a la columna right
	function addHeight(){
		var heightScreen = $( window ).height() - 100;
		$(".dgom-ui-col-right-overall-progress").css("height", heightScreen);
	}

	$(window).on("resize", function(){
		addHeight();
	});
		
	var idCategoria = "' . $categoria->txt_token_category . '";
	var calMin = 0;
	var calMax = 100;

	// Slider 	
	$(".nstSlider").nstSlider({
    "crossable_handles": false,
    "left_grip_selector": ".leftGrip",
    "right_grip_selector": ".rightGrip",
    "value_bar_selector": ".bar",
    "value_changed_callback": function(cause, leftValue, rightValue) {
        $(this).parent().find(".leftLabel").text(leftValue);
        $(this).parent().find(".rightLabel").text(rightValue);
    },
	"user_mouseup_callback":function(vmin, vmax, left_grip_moved) {
			calMin = vmin;
			calMax = vmax;
			search();
		}	
	});
		
	function isMention(){
		return $("#inputUnchecked").is(":checked");
	}
		
	function search(){
	var isHonorable = isMention();
	var data = {idCategoria: idCategoria, isHonorable: isHonorable, calMin:calMin, calMax:calMax};	
		
		$.ajax({
			url:"' . Yii::app ()->createAbsoluteUrl ( "juecesAdmin/searchImage" ) . '",
			data: data,
			type:"get",
			success: function(res){
				$("#dgom-js-grid").html(res);
				}
			})
		
	}
		
	$("#inputUnchecked").on("ifChanged", function(event){
		calMin = $(".leftLabel").text() ;
		calMax = $(".rightLabel").text() ;
		search();
		});

		
});

', CClientScript::POS_END );

?>

