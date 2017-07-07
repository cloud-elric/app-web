<div class="container-fluid padding-0">
	<!-- Columna Izquierda y Galeria -->
	<div class="col-md-9">
		<div 
			class="page-content container-fluid padding-vertical-20 padding-horizontal-0">
			<div class="grid-stack grid-stack-3848 grid-stack-animate" id="dgom-js-grid"
				data-plugin="gridstack" data-gs-width="12" data-gs-animate="yes"
				style="height: 580px;">

				<?php
				$constantes = new Constantes();
				$coordenadas = $constantes->coordenadas;
				$row = 0;
				$index = 0;
				foreach($menciones as $pic){
				
					?>
					<div
					class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide ui-resizable-disabled"
					data-gs-x="<?=$coordenadas[$index]["x"]?>" data-gs-y="<?=$coordenadas[$index]["y"] + $row?>" data-gs-width="<?=$coordenadas[$index]["w"]?>"
					data-gs-height="<?=$coordenadas[$index]["h"]?>" data-gs-no-resize="yes">

					<div
						class="grid-stack-item-content panel ui-draggable-handle img-box bg-box-one" style="background:url('<?php echo Yii::app ()->params ['pathBaseImages']."idu_".$pic->txt_usuario_number."/small_".$pic->txt_file_name?>')  no-repeat 50%; background-size: cover;">
						<div class="smallFull">
							<?php echo CHtml::link('
							<div class="icon-middle">
								<div>
									<p>
										<i class="icon wb-pencil" aria-hidden="true"></i>
									</p>
									<span>'.Yii::t('site','viewPhoto').'</span>
								</div>
							</div>
							', array("consulta", "t"=>$pic->txt_pic_number), array("class"=>"viewImage"))?>
						</div>
							<button type="button" class="btn btn-floating btn-primary btn-sm">
								<i class="icon wb-check" aria-hidden="true"></i>
							</button>
					</div>

					<div
						class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se"
						style="z-index: 90; display: none;"></div>
				</div>			
					
				<?php
				
					if($index==17){
						$index=0;
						$row+=8;
						echo ("<!-- Cambio de renglon-->");
					}else{
						$index++;
					}
					
				}
				?>
				<!-- Fila 1 : Primer grupo de 3 -->
			</div>
		</div>


	</div>

</div>
