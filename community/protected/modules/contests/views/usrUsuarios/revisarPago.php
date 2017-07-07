<!-- .revisar-pago-wrap -->
<div class="revisar-pago-wrap">
	<div class="revisar-pago-wrap-cont">
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" alt="Cargando...">
		<p>Procesando su pago</p>
	</div>
</div>
<!-- end / .revisar-pago-wrap -->

<script>
var time=20000;

validarPago();

function validarPago(){

	setTimeout(function(){
		$.ajax({
			url:'<?=Yii::app()->request->baseUrl?>/usrUsuarios/revisarValidarPago',
			success:function(response){
					if(response=="success"){
						window.location
						.replace('<?=Yii::app()->request->baseUrl?>/usrUsuarios/concurso');
					}else{
						validarPago();
						time = time * 2;
						}
				
				},
				error:function(){

					}
		});	 
		}, time);

}


</script>