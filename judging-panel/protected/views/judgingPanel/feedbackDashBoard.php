<?php
$this->title = Yii::t ( 'site', 'titleJudgePanel' );
?>
<div class="container">
    <div class="row padding-50">
		<?php
// foreach ( $avance as $av ) {
// echo $av->id_contest.'<br>';
//                          echo $av->id_juez.'<br>';
//                          echo $av->id_category.'<br>'.'<br>';
        
//         }

//         exit();
		foreach ( $avance as $av ) :

        $picsConFeedback = PicsJuecesRetro::model()->findAll(
            array(
                'condition'=>'id_contest=:idContest AND id_juez=:idJuez AND id_category=:idCategory',
                'params'=>
                    array(
                         ':idContest'   =>$av->id_contest,
                         ':idJuez'=>$av->id_juez,
                         ':idCategory'=>$av->id_category
                    )
            )
        );

        $numCalificadas = 0;
        $numTotalPics = count($picsConFeedback);
        $numPorCalificar = 0;

        
        foreach($picsConFeedback as $pic){
            if($pic->b_calificada==0){
                $numPorCalificar++;
            }else{
                $numCalificadas++;
            }
        }

        $porcentaje = 100;
        if($numTotalPics){
            $porcentaje = ($numCalificadas * 100)/$numTotalPics;
        }
        
        $categoria = Categoiries::model()->find('id_category='.$av->id_category);

		if($numCalificadas==$numTotalPics){
		?>	
			
			<div class="col-xlg-4 col-lg-4 col-sm-12 dgom-ui-dashboard-box-finish">
			<!-- Panel Stacked Bar -->
			<div class="" id="chartStackedBar">
				<div class="">

					<div class="dgom-ui-dashboard-box dgom-ui-dashboard-box-finished blue-grey-700 padding-30">
					
						<h2 class='dgom-ui-dashboard-box-heading'><?=$categoria->txt_name?></h2>

						<i class="icon wb-check-circle" aria-hidden="true"></i>
						
						<h3 class="dgom-ui-dashboard-box-number">
							<?=Yii::t('photoReview', 'finished')?>
						</h3>

					</div>

				</div>
			</div>
			<!-- End Panel Stacked Bar -->
		</div>
			
		<?php }else{
		?>
		<div class="col-xlg-4 col-lg-4 col-sm-12 <?=$numCalificadas==$numTotalPics?'dgom-ui-dashboard-box-finish':''?>">
			<!-- Panel Stacked Bar -->
			<div class="" id="chartStackedBar">
				<div class="">

					<div class="dgom-ui-dashboard-box blue-grey-700 padding-30">
					<?php if($numPorCalificar==0){?>
						<h2 class='dgom-ui-dashboard-box-heading'><?=$categoria->txt_name?></h2>
					<?php }else{?>
						<?= CHtml::link("<h2 class='dgom-ui-dashboard-box-heading'>".$categoria->txt_name."</h2>", array("feedbackReview", "idCategoria"=>$categoria->txt_token_category, "t"=>$t))?>
					<?php }?>	
						<h3 class="dgom-ui-dashboard-box-number">
							<?=$numCalificadas?> / <?=$numPorCalificar?>
						</h3>

						<div class="progress progress-lg">
							<div class="progress-bar progress-bar-primary progress-bar-striped" style="width: <?=$porcentaje?>%;" role="progressbar"><?=$porcentaje?>%</div>
						</div>

						<h6 class="dgom-ui-dashboard-box-progress-txt"><?=Yii::t('site','progress')?></h6>
					</div>

				</div>
			</div>
			<!-- End Panel Stacked Bar -->
		</div>
		<?php
		}
		endforeach
		;
		?>
 
  
</div>


	
</div>

