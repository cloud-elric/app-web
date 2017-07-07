<?php

$this->pageTitle = Yii::t('general', 'revisarPagoTitle');

?>
<!-- .revisar-pago-wrap -->
<div class="revisar-pago-wrap">
	<div class="revisar-pago-wrap-cont">
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" alt="<?=Yii::t('revisarPago', 'loading')?>">
		<p><?=Yii::t('revisarPago', 'procesandoPago')?></p>
		<p>Esta transaccion puede tardar varios minutos</p>
	</div>
</div>
<!-- end / .revisar-pago-wrap -->

<script>
var time=20000;

validarPago();

function validarPago(){

	setTimeout(function(){
		$.ajax({
			url:'<?=Yii::app()->request->baseUrl?>/usrUsuarios/revisarValidarPago?idConcurso=<?=$concusoToken?>',
			success:function(response){
					if(response=="success"){
						window.location
						.replace('<?=Yii::app()->request->baseUrl?>/usrUsuarios/concurso?idToken=<?=$concusoToken?>');
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