<div class="container">
  <div class="row padding-horizontal-50">
    <div class="col-md-12">
      <h2 class="title-section-competitors2 font-size-40">
        <!-- <button type="button" class="btn btn-floating btn-success"><?=$concursante->txt_nombre?></button> -->
        <span><?=$concursante->txt_nombre?></span>
      </h2>
    </div>
  </div>
  
  <div class="popup-gallery">
			
			
	  <div class="row padding-vertical-30 padding-horizontal-50">
	  
	  
		<?php foreach($photos as $photo){?>
		    <div class="dgom-ui-col-md-4 margin-bottom-20">
	
		      <div class="dgom-ui-col-overlay dgom-ui-col-overlay-bg" style="background-image: url(<?php echo Yii::app ()->params ['pathBaseImages']."idu_".$photo->txt_usuario_number."/small_".$photo->txt_file_name?>);">
	
		        <figure class="overlay overlay-hover dgom-ui-overlay-cont">
		        <!-- <img class="overlay-figure" src="<?php #echo Yii::app ()->params ['pathBaseImages']."idu_".$photo->txt_usuario_number."/small_".$photo->txt_file_name?>" alt="<?php # echo $photo->txt_pic_name?>"> -->
		        
		          <?= CHtml::link('<figcaption class="overlay-panel overlay-background overlay-fade overlay-icon"><span class="icon wb-search icon-middle"></span></figcaption>', array("consulta", "t"=>$photo->txt_pic_number))?>
		          <?php if($photo->b_mencion==1){?>
		         	 <button type="button" class="btn btn-floating btn-primary btn-sm"><i class="icon wb-check" aria-hidden="true"></i></button>
		          <?php }?>
		          
		          <?php if(number_format($photo->num_calificacion,0)>0){?>
		          <div class="progreso">
		            <div class="pie-progress pie-progress-sm" data-plugin="pieProgress" data-barcolor="#75E268" data-size="100" data-barsize="4" data-goal="<?=number_format($photo->num_calificacion,0) ?>" aria-valuenow="<?=number_format($photo->num_calificacion,0) ?>" role="progressbar">
		              <div class="pie-progress-number"><?=number_format($photo->num_calificacion,0) ?></div>
		            </div>
		          </div>
		          <?php }?>
		        </figure>
		      </div>
		    </div>
		<?php }?>
	  </div>
 </div>
</div>

<?php

Yii::app ()->clientScript->registerScript ( 'carruselC', '


// $(document).ready(function(){
// 	$(".popup-gallery").magnificPopup({
// 	    delegate: "a",
// 	    type: "iframe",
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
			
// 		}

// 	});

		
// });

', CClientScript::POS_END );

?>