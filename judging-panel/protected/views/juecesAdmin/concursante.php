
<?php
$hasFeedBack = "dgom-ui-competitors-category-no-feedback";
// $p =$competidor->id_product;
// if($p==2 || $p==4 || $p==6){
// $hasFeedBack ="";
// }
$hasFeedBack = ViewUsersProducts::model ()->find ( array (
		"condition" => "id_contest=1 AND id_usuario=:idUsuario",
		"params" => array (
				":idUsuario" => $data->id_usuario 
		) 
) );

$numPics = WrkPics::model ()->findAll ( array (
		"condition" => "b_status=2 AND ID=:idUsuario AND id_contest=1",
		"params" => array (
				":idUsuario" => $data->id_usuario 
		) 
) );

$numPicsTotal = WrkPics::model ()->findAll ( array (
		"condition" => "ID=:idUsuario AND id_contest=1",
		"params" => array (
				":idUsuario" => $data->id_usuario
		)
) );
$id = uniqid();
?>

<div class="row row-line row-line-item row-line-item-<?=$data->txt_usuario_number ?>" data-link="<?=$data->txt_usuario_number ?>">
	<div class="col-md-1 text-center">
		<div class="dgom-ui-competitors-wrap-line-foto">
			<div class="dgom-ui-competitors-wrap-line-foto-int">
				<?php if(empty($data->txt_image_url)){?>
					<img src="<?php echo Yii::app()->params["pathBaseProfiles"] ?>images/users.jpg" alt="">
				<?php }else if($data->b_login_social_network){?>
					<img src="<?=$data->txt_image_url?>" alt="">
				<?php }else{?>
					<img src="<?=Yii::app()->params["pathBaseProfiles"] ."images/profiles/".$data->txt_usuario_number."/".$data->txt_image_url?>" alt="">
				<?php }?>
				<?php
				if($hasFeedBack->num_addons>0){
				?>
				<small><i class="icon ion-android-microphone"></i></small>
				
				<?php }?>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<h4 class="dgom-ui-competitors-wrap-line-nombre">
			<?=$data->txt_nombre." ".$data->txt_apellido_paterno?>
		</h4>
		<p class="dgom-ui-competitors-wrap-line-correo">
			<!-- <i class="fa fa-envelope-o" aria-hidden="true"></i>--> <?=$data->txt_correo?>
		</p>
	</div>
	<div class="col-md-2">
		<p class="no-text-decoration dgom-ui-competitors-wrap-line-numfotos"><?php echo count($numPics)." ".Yii::t('competitors', 'of')." ".count($numPicsTotal). ' ' . Yii::t('competitors','numFotos') ?></p>
			<?php # echo CHtml::link( count($numPics)." fotos", array("viewPhotosCompetitor", "t"=>$data->txt_usuario_number), array("class"=>"no-text-decoration dgom-ui-competitors-wrap-line-numfotos"));?>
	</div>
	<div class="col-md-5">
		<div class="popup-gallery-<?=$data->txt_usuario_number?> dgom-ui-competitors-wrap-line-tolink dgom-ui-competitors-popup-gallery">
				<?php
				foreach ( $numPics as $pic ) {
					$mencionFoto = "dgom-ui-competitors-wrap-line-numfotos-foto-box";
					if($pic->b_mencion==1){
						$mencionFoto = "dgom-ui-competitors-wrap-line-numfotos-foto-box-r";
					}
					?>
					<a href="<?= Yii::app()->params["pathImage"] . $data->txt_usuario_number . "/large_" . $pic->txt_file_name?>" class="<?=$mencionFoto?>" style='background-image: url(<?php echo Yii::app()->params["pathImage"] . $data->txt_usuario_number . "/small_" . $pic->txt_file_name?>);'>
						<?php # echo CHtml::image ( Yii::app()->params["pathImage"] . $data->txt_usuario_number . "/small_" . $pic->txt_file_name, '', array ("class" => "dgom-ui-competitors-wrap-line-numfotos-foto dgom-ui-tolink" ) )?>
					</a>
					<!-- <div class="dgom-ui-competitors-wrap-line-numfotos-foto-box-punto"></div> -->
				<?php }
				?>
			</div>
	</div>
	<div class="col-md-1 text-center">
		<div class="check-style check-style-ind">
			<?php
			echo CHtml::label ( "", $data->txt_usuario_number.$id, array("class"=>"dgom-ui-tolink") ) . CHtml::checkBox ( "competitors[]", "", array (
					"class" => "competidor_check dgom-ui-tolink",
					"id" => $data->txt_usuario_number.$id,
					"value" => $data->txt_usuario_number 
			) );
			?>
			<div class="check"></div>
		</div>
		<?php # CHtml::checkBox("competitors[]", "", array("class"=>"competidor_check", "value"=>$data->txt_usuario_number))?>
	</div>
</div>

<?php

Yii::app ()->clientScript->registerScript ( 'carrusel'. $data->txt_usuario_number, '


$(document).ready(function(){
	$(".popup-gallery-' . $data->txt_usuario_number . '").magnificPopup({
	    delegate: "a",
	    type: "image",
	    tLoading: "Loading image #%curr%...",
	    removalDelay: 500,
	    mainClass: "mfp-img-mobile",
	    gallery: {
			enabled: true,
			navigateByImgClick: false,
			preload: [0,1]
	    },
		callbacks: {
			buildControls: function() {
				this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
			}
		},
		image: {
			tError: "Error al cargar la imagen.",
			
		}

	});

	var url = "'.Yii::app()->createUrl("adminPanel/viewPhotosCompetitor").'";
	// Fila item - Re-direccionamiento
	$(".row-line-item-'.$data->txt_usuario_number.'").on("click", function(e){
		
		var lineLink = $(this).data("link");
 		if(e.target.className=="dgom-ui-tolink" || e.target.className=="dgom-ui-competitors-wrap-line-numfotos-foto-box-r" || e.target.className=="dgom-ui-competitors-wrap-line-numfotos-foto-box" || e.target.nodeName=="INPUT"){
		//if (e.target !== this){
		//alert();
		}
		else{
			$(location).attr("href", url + "/"+lineLink)
		}

	});
		
});

', CClientScript::POS_END );

?>