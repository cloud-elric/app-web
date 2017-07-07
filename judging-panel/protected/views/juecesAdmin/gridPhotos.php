<?php

$constantes = new Constantes();
$coordenadas = $constantes->coordenadas;
$row = 0;
$index = 0;
foreach($picsCategoria as $pic){?>
					<div
					class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide ui-resizable-disabled"
					data-gs-x="<?=$coordenadas[$index]["x"]?>" data-gs-y="<?=$coordenadas[$index]["y"] + $row?>" data-gs-width="<?=$coordenadas[$index]["w"]?>"
					data-gs-height="<?=$coordenadas[$index]["h"]?>" data-gs-no-resize="yes">

					<div
						class="grid-stack-item-content panel ui-draggable-handle img-box bg-box-one" 
						style="background:url('<?php echo Yii::app ()->params ['pathBaseImages']."idu_".$pic->iD->txt_usuario_number."/small_".$pic->txt_file_name?>')  no-repeat 50%; background-size: cover;">
						<div class="smallFull">
							<div class="icon-middle">
								<p>
								<?php echo CHtml::link('<i class="icon wb-pencil" aria-hidden="true"></i>', array("evaluador", "id"=>$pic->id_pic))?>
								</p>
								<a href="#">View Photo</a>
							</div>
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
				
					if($index==17){
						$index=0;
						$row+=8;
						echo ("<!-- Cambio de renglon-->");
					}else{
						$index++;
					}
					
				}
				?>
				
