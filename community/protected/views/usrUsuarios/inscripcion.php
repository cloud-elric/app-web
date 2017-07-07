<?php 
$this->pageTitle = Yii::t('general', 'inscripcionTitle');
?>
  <script type="text/javascript" 
        src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
<script type='text/javascript' 
  src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>
<!-- .pago-seleccion -->
<div class="pago-seleccion container-fluid">
	<!-- .row -->
	<div class="row">
		<!-- .col (left) -->
		<div class="col-sm-6 col-md-6 pago-participante-col-flex">

			<!-- .text -->
			<div class="text">
				<h2 class="bienvenido">
					<?=Yii::t('general', 'bienvenido')?> <img
						src="<?php echo Yii::app()->request->baseUrl; ?>/images/hardcode/<?= $concurso->txt_banner_img ?>"
						alt="<?=$concurso->txt_name?>">
				</h2>
				<!-- <button type="button" class="btn btn-blue">Consulta las bases del concurso</button> -->
				<a href="<?=$concurso->txt_url_contest?>" target="_blank"
					class="btn btn-blue"><?=Yii::t('general', 'consulta')?></a>
				<!-- <p class="necesito-ayuda-p" data-toggle="modal" data-target="#modal-necesito-ayuda">Necesito Ayuda</p> -->

				<?php $this->renderPartial ( "necesitoAyuda", array()); ?>
			</div>
			<!-- end / .text -->


			<!-- footer -->
			<footer class="footer-fixed-int">
				<a href="http://2gom.com.mx/" target="_blank">powered by 2 Geeks one Monkey</a>
			</footer>
			<!-- end / footer -->

		</div>
		<!-- end / .col (left) -->

		<!-- .col (right) -->
		<div class="col-sm-6 col-md-6 pago-seleccion-datos">

			<!-- .pago-seleccion-user -->
			<div class="pago-seleccion-user">

				<p><?=Yii::t('general', 'saludo')?> <?=CHtml::encode(Yii::app()->user->concursante->txt_nombre)?> </p>
				<!-- .pago-seleccion-user-flip -->
				<div class="pago-seleccion-user-flip">
						
					<!-- .pago-seleccion-user-flip-front-side -->
									<div class="pago-user-flip pago-seleccion-user-flip-front-side" data-flip="front">
										<?php if(empty(Yii::app()->user->concursante->txt_image_url)){?>
										<span style="background-image: url(<?php echo Yii::app()->theme->baseUrl; ?>/images/users.jpg)"></span>
										<?php }else if(Yii::app()->user->concursante->b_login_social_network){?>
										<span style="background-image: url(<?=Yii::app()->user->concursante->txt_image_url?>)"></span>
										<?php }else{?>
										<span style="background-image: url(<?=Yii::app()->request->baseUrl."/images/profiles/".Yii::app()->user->concursante->txt_usuario_number."/".Yii::app()->user->concursante->txt_image_url?>)"></span>
										<?php }?>
									</div>
									<!-- end / .pago-seleccion-user-flip-front-side -->

					<!-- .pago-seleccion-user-flip-back-side  -->
					<div class="pago-user-flip pago-seleccion-user-flip-back-side closeSession"
						data-flip="back">
						<?php echo CHtml::link('<i class="icon ion-power"></i>',array('site/logout'), array("class"=>"pago-seleccion-user-logout")); ?>
					</div>
					<!-- end / .pago-seleccion-user-flip-back-side  -->
				</div>
				<!-- end / .pago-seleccion-user-flip -->

			</div>
			<!-- end / .pago-seleccion-user -->


			<?php
			
			$form = $this->beginWidget ( 'CActiveForm', array (
				'id' => 'form-pago',
				'action'=>Yii::app()->request->baseUrl.'/payments/saveOrdenCompra?idToken=' . $concurso->txt_token,
				'enableAjaxValidation' => false 
			) );
			?>
				<!-- .pago-terminos-flip -->
				<div class="pago-terminos-flip">


					<!-- .pago-terminos-front-side -->
					<div class="pago-terminos-front-side pago-terminos-click"
						data-flip="front">



						<!-- .screen-int -->
						<div class="example box screen-pago"
							data-options='{"direction": "vertical", "contentSelector": ">", "containerSelector": ">"}'>
							<!-- SCROLL -->
							<div>
								<!-- SCROLL -->
								<div>

									<!-- .pago-seleccion-producto -->
									<div class="pago-seleccion-producto">

										<h2 class="selecciona-inscripcion"><?=Yii::t('inscripcion', 'header')?></h2>
											<h6 class="selecciona-inscripcion" style="font-size: 1em;"><?=Yii::t('inscripcion', 'note')?></h6>

									<?php
									// Pinta los productos
									foreach ( $productos as $producto ) {
										?>
									<!-- .rowProductos -->
										<div class="row rowProductos"
											id='producto-<?=$producto->txt_product_number?>'>
											<div class="col-sm-8 col-md-8 padding-0">
												<div class="radio-style">
												<?php
										// Radio button para el producto
										echo CHtml::radioButton ( "producto", false, array (
												"data-producto" => $producto->txt_product_number,
												"class" => "productoCheck",
												"value" => $producto->txt_product_number,
												"id" => "producto" . $producto->txt_product_number,
												"data-price" => $producto->num_price 
										) );
										?> 
									<label for="<?="producto".$producto->txt_product_number?>"><?php echo $producto->txt_name?></label>
													<p class="concurso-descripcion"><?php echo  $producto->txt_desc?></p>
													<div class="check"></div>
												</div>
											</div>
											<div class="col-sm-4 col-md-4 padding-0 text-right">
												<span class="text-right-precio">$ <?php echo $producto->num_price . " " . $concurso->txt_moneda ?></span>
											</div>
										<?php
			
										
										// Pintas los sub productos de cada producto
										foreach ( $producto->conProductsAddonses as $subProductos ) {
											?>
										<!-- .radio-style-retro-alim -->
											<div class="radio-style radio-style-retro-alim">
											<?php
											
echo CHtml::radioButton ( "subProducto", false, array (
													"data-subproducto" => $subProductos->txt_product_number,
													"data-producto" => $producto->txt_product_number,
													"class" => "subProductoCheck",
													"value" => $subProductos->txt_product_number,
													"data-price" => $subProductos->num_price,
													'id' => "subProducto" . $subProductos->txt_product_number,
													"data-ischecked"=>"no"
											)
											 );
											?>
										<label
													for="<?="subProducto".$subProductos->txt_product_number?>">
													<p><?=$subProductos->txt_name?></p> <span>+ $ <?=$subProductos->num_price . " " . $concurso->txt_moneda?></span>
												</label>
												<div class="check"></div>
											</div>
											<!-- end / .radio-style-retro-alim -->
										<?php } ?>
										<!-- <div class="line"></div> -->
										</div>
										<!-- end / .rowProductos -->

									<?php }?>

									</div>
									<!-- end / .pago-seleccion-producto -->

								</div>
								<!-- end / SCROLL -->
							</div>
							<!-- end / SCROLL -->


						</div>
						<!-- end / .screen-int -->


						<!-- .pago-seleccion-pago -->
						<div class="pago-seleccion-pago">

							<!-- .row -->
							<div class="row margin-0">

								<!-- <div class="col-sm-4 col-md-3 items">
									<div class="items-total">
										Total <span id="total">$ 0</span>
									</div>
								</div> -->

								<div class="col-sm-12 col-md-12 items">

									<div class="check-style">
										<input class="check-terminos-condiciones" type="checkbox"
											id="terminoscondiciones" name="terminoscondiciones"> <label
											for="terminoscondiciones"> <span><?=Yii::t('inscripcion', 'terminos')?></span>
										</label>
										<div class="check"></div>
									</div>

									<div class="mask-check"></div>
								</div>

								<!-- <div class="col-sm-12 col-md-12 items items-pay"> -->
								<div class="col-sm-12 col-md-12 items">
								<!-- 
									<?php
									// Pinta los tipos de forma de pago por concurso
									foreach ( $tiposPagos as $tipoPago ) {
										?>
										<div class="radio-style radio-style-pay">
										<?php 
// Radio button para el tipo de pago
										echo CHtml::radioButton ( "tipoPago", false, array (
												"class" => "formaPago",
												"data-formapago" => $tipoPago->idTipoPago->txt_payment_type_number,
												"value" => $tipoPago->idTipoPago->txt_payment_type_number,
												"data-name" => $tipoPago->idTipoPago->txt_name,
												"id" => "tipoPago" . $tipoPago->idTipoPago->txt_payment_type_number 
										) );
										
										// Imagen del tipo de pago
										echo "<label for='tipoPago" . $tipoPago->idTipoPago->txt_payment_type_number . "'>" . CHtml::image ( Yii::app ()->theme->baseUrl . "/images/" . $tipoPago->idTipoPago->txt_icon_url ) . "</label>";
										echo "<div class='check'></div>";
										// echo $tipoPago->idTipoPago->txt_icon_url;
										?>
										</div>
										<?php
									}
									?>
								 -->
								<?php
// 								echo CHtml::button ( "", array (
// 										"id" => "pagar",
// 										"class" => "btn btn-yellow btn-pagar",
// 										"disabled" => "disabled",
// 										'style'=>'font-size: .9em;',
// 										'value'=>'Pagar cuota de recuperación'
// 								) );
								?>
								
								<?php
								// echo CHtml::button ( '<span class="ladda-label">Pagar cuota de recuperación</span>', array (
								// 		"id" => "pagarCheck",
								// 		"class" => "btn btn-yellow btn-pagar ladda-button",
								// 		"disabled" => "disabled",
								// 		'style'=>'font-size: .9em;',
								// 		// 'value'=>'Pagar cuota de recuperación',
								// 		'data-style'=>'expand-left'
								// ) );
								?>

								<button class="btn btn-yellow btn-pagar btn-checkout ladda-button" disabled="disabled" id="pagarCheck" data-style="zoom-out"><span class="ladda-label"><?=Yii::t('inscripcion', 'submit')?></span></button>

								<div class="mask-pagar"></div>

								</div>

							</div>
							<!-- end / .row -->

						</div>
						<!-- end / .pago-seleccion-pago -->

						<!-- .screen-int -->
						<div class="example box screen-pago-terminos animated"
							data-options='{"direction": "vertical", "contentSelector": ">", "containerSelector": ">"}'>
							<!-- SCROLL -->
							<div>
								<!-- SCROLL -->
								<div>

									<!-- .terminos-condiciones -->
									<div class="terminos-condiciones">

										<span class="terminos-condiciones-closer">
											<i class="icon ion-close-circled"></i>
										</span>

										<h2><?=Yii::t('inscripcion', 'headerTerminos')?></h2>

										<p><?=$terminosCondiciones->txt_terminos?></p>
										
										<p><?=$terminosCondiciones->txt_condiciones?></p>

										<div class="text-center">
											<button class="btn btn-green terminos-condiciones-aceptor">
											<?=Yii::t('inscripcion', 'acepto')?>
											</button>
										</div>

									</div>
									<!-- end / .terminos-condiciones -->

								</div>
								<!-- end / SCROLL -->
							</div>
							<!-- end / SCROLL -->
						</div>
						<!-- end / .screen-int -->

					</div>
					<!-- end / .pago-terminos-front-side -->

				</div>
				<!-- end / .pago-terminos-flip -->
			<?php $this->endWidget(); ?>




			<!-- .pago-seleccion-datos-recibo -->
			<div class="pago-seleccion-datos-recibo">

				<!-- .screens -->
				<div class="example box screen-int-pago"
					data-options='{"direction": "vertical", "contentSelector": ">", "containerSelector": ">"}'>
					<!-- SCROLL -->
					<div>
						<!-- SCROLL -->
						<div>dfdf</div>
						<!-- end / SCROLL -->
					</div>
					<!-- end / SCROLL -->

				</div>
				<!-- end / .screens -->

			</div>
			<!-- end / .pago-seleccion-datos-recibo -->




		</div>
		<!-- end / .col (right) -->
	</div>
	<!-- end / .row -->
</div>
<!-- end / .pago-seleccion -->






<!-- Open pay pal -->
<div id="container-pay-pal"></div>
<!-- Close pay pal -->

<!-- OPEN PAY -->
<!-- <div class="dgom-ui-opayForm-wrapper"></div> -->
<!-- CIERRA OPENPAY -->

<!-- Scripts que controla la seleccion y envío de información de acuerdo a la forma de pago -->
<script>

function generarOrdenCompra(){

	var form = $("#form-pago");
	var data = form.serialize();
	var url = '<?=Yii::app()->request->baseUrl?>/payments/saveOrdenCompra';

	managerPa();
	
	$.ajax({
		url: url,
		data:data,
		type:"POST",
		dataType:"html",
		success:function(response){
			managerFormaPago(response);
		},
		error:function(xhr, textStatus, error){
			//alert("Error");
		},
		statusCode: {
		    404: function() {
		      //alert( "page not found" );
		    },
		    500:function(){
			    //alert("Ocurrio un problema al intentar guardar");
			}
		 }
	});
	
}

$(document).ready(function(){

	/**
	 * Abrir -Terminos y condiciones
	 */
	// Abrir terminos y condiciones
	$(".mask-check")
			.on(
					"click",
					function(e) {


						var contador = $('.productoCheck:checked').length
						if (contador < 1) {

							toastrWarning("<?=Yii::t('inscripcion', 'warningProducto')?>");
							e.preventDefault();
							return false;
						}
						
						
						$(".screen-pago-terminos").animate({left: "0"}, 600, "easeOutCubic" );
						$(".pago-seleccion-user").css("color", "#FFF");
					});


	/**
	 * Acepto -Terminos y condiciones
	 */
	$(".terminos-condiciones-aceptor").click(
			function(e) {
				e.preventDefault();
				
				var contador = $('.productoCheck:checked').length
				if (contador < 1) {

					toastrWarning("<?=Yii::t('inscripcion', 'warningProducto')?>");
					e.preventDefault();
					return false;
				}
				
				$(".btn-pagar").css("opacity", 1);
				$(".btn-pagar").prop("disabled", false);

				$(".screen-pago-terminos").animate({left: "100%"}, 800, "easeOutQuint" );

				$(".mask-check").hide();
				$(".mask-pagar").hide();

				$('input[name="terminoscondiciones"]').prop(
						"checked", true);
				
				
//				$(".items-pay").css("opacity", 1);
//				$(".radio").css("opacity", 1);
			});
	
	//$("#modalAviso").modal("show");
	
	// Al dar click al botón de pagar
	$("#continuarOpenPay").on("click", function(e){
		e.preventDefault();
		
		generarOrdenCompra();
	
	});

	$("#pagarCheck").on("click", function(e){
		e.preventDefault();
		var l = Ladda.create(this);
	 	l.start();
		$('#form-pago').submit();

	});

	// Al dar click al botón de pagar
	$("#pagar").on("click", function(e){
		e.preventDefault();
		

		var formaPago = $('input[name="tipoPago"]:checked', '#form-pago').data("name");

		// Paypal
		if(formaPago=="Open Pay"){
			mensajeConfirmacion();
			return;
		}

		$(".btn-pagar").addClass("btn-yellow-anim");
		$(".btn-pagar").prop( "disabled", true );

		generarOrdenCompra();
		
		
	
	});


	// Al dar click a un radio button de un subproducto marcara el producto
	$(".subProductoCheck").on("click",function(){
		var idP = $(this).data("producto");
		$("#producto-"+idP+" .productoCheck").prop("checked", true);
		

		var elemento = $(this);
		var data = elemento.data("ischecked");

		$(".subProductoCheck").data("ischecked", "no");

		if(data=="si"){
			elemento.prop("checked", false);
			elemento.data("ischecked", "no");
		}else{
			elemento.data("ischecked", "si");
			
		}
		totalPagar();
		
	});

	$(".productoCheck").on("change", function(){
		offRadioSubProductos();
		totalPagar();
	});

	$(".subProductoCheck").on("change", function(){
		
		totalPagar();
	});

$(".subProductoCheck").on("click", function(){
		
		
		
	});


	// Apaga todos los radio cuando se selecciona el producto
	function offRadioSubProductos(){
		$(".subProductoCheck").prop("checked", false);
		$(".subProductoCheck").data("ischecked", "no");
	}

	
	// Método para cuando se selecciona paypal
	function pagarPayPal(){

		// Busca que producto esta seleccionado
		$(".productoCheck").each(function(index){
			var p;
			var ps = $(this); 
			p = ps.prop("checked");

			// Si encuentra el producto seleccionado envia el formulario del producto seleccionado
			if(p){
				var ip = ps.data("producto");
				$("#payPal"+ip).submit();
			}
		});
	}
});

// Calcula el pago 
function totalPagar(){
	var total = 0;
	$(".productoCheck").each(function(index){
		
		var elemento = $(this);
		if(elemento.prop("checked")){
			total+= elemento.data("price");
		}
		
	});

	$(".subProductoCheck").each(function(index){
		var elemento = $(this);
		if(elemento.prop("checked")){
			total+= elemento.data("price");
		}
		
	});

	$("#total").text("$ "+total.toFixed(0).replace(/./g, function(c, i, a) {
	    return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
	}));
}
</script>