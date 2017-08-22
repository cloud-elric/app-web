
<div class="container">

		<!-- Bloque 1 -->
	<div class="row">
			
		<div class="col-md-12 margin-bottom-30">
			<h2 class="grey-100 font-size-40">Configuración</h2>
		</div>

        <div class="col-xlg-4 col-lg-4 col-sm-12 margin-bottom-50 ">
			  
              
               <button class="btn btn-config <?=$concurso->id_status==2?"btn-success":"btn-primary"?>" data-token="2" >Inscripción</button> 
               
               <button class="btn btn-config <?=$concurso->id_status==3?"btn-success":"btn-primary"?>" data-token="3">Calificación</button>
               
              
		</div>    

    </div>
</div>        


<?php
Yii::app ()->clientScript->registerScript ( 'my vars', '

$(document).ready(function(){

    $(".btn-config").on("click", function(e){
        e.preventDefault();
        var token = $(this).data("token");

        $(".btn-success").addClass("btn-primary");
        $(".btn-success").removeClass("btn-success");

        $(this).removeClass("btn-primary");
        $(this).addClass("btn-success");

        $.ajax({
			url:"' . Yii::app ()->createAbsoluteUrl ( "adminPanel/cambiarConfig") . '/'.$concurso->txt_token.'/"+token,
			type:"post",
			success:function(response){
				
			},
			error:function(xhr, error, status){
				
			}
		});

    });

});    

', CClientScript::POS_END );