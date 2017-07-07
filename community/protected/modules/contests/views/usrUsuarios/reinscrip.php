<!-- .pago-seleccion -->
<div class="pago-seleccion container-fluid">
	<!-- .row -->
	<div class="row">
		<!-- .col (left) -->
		<div class="col-sm-6 col-md-6 pago-participante-col-flex">

			<!-- .text -->
			<div class="text">
				<h2 class="bienvenido">
					Bienvenido al concurso <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/hazClickMexico.png" alt="Haz Clic con México">
				</h2>
				<button type="button" class="btn btn-blue">Consulta las bases del
					concurso</button>
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

				<p>Hola <?=Yii::app()->user->concursante->txt_nombre?> </p>
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

			<form id="form-pago">
				

				<div class="zflip-panel">

				 	<div class="zfront-side">



						<!-- .screen-int -->
						<div class="example box screen-pago"
							data-options='{"direction": "vertical", "contentSelector": ">", "containerSelector": ">"}'>
							<!-- SCROLL -->
							<div>
								<!-- SCROLL -->
								<div>




			            <div class="content-box">
							<div class="content-box-title content-box-title-dark">
								imagen
								<div class="usr-name-box">
									<h1>
										<span class="enfasis">Administrador</span> <br> Alfredo Elizondo
									</h1>
								</div>
							</div>
							<div class="content-box-inner">
								<ul>
									<li><a href="">Mis Puntos <span>12</span></a></li>
									<li><a href="">Puntos Disponibles <span>13</span></a></li>
								</ul>
							</div>
							<div class="content-box-footer">
								<!-- Contenido si es necesario -->
							</div>
						</div><!-- End of content Box -->

						<div class="content-box">
							<div class="content-box-title">
								<h1><i class="icon icon-paperclip"></i>Mis Herramientas</h1>
							</div>
							<div class="content-box-inner">
								<ul>
									<li><a href="">Buscar Candidato</a></li>
									<li><a href="">Enviar</a></li>
								</ul>
							</div>
							<div class="content-box-footer">
								<!-- Contenido si es necesario -->
							</div>
						</div><!-- End of content Box -->

						<div class="content-box">
							<form>
								<div class="content-box-title">
									<h1><i class="icon icon-idcard"></i> Invitar Candidato</h1>
								</div>
								<div class="content-box-inner">
									<ul>
										<li><input type="text" placeholder="E-mail.."/></li>
									</ul>
								</div>
								<div class="content-box-footer">
									<button class="primaryBtn">Enviar</button>
								</div>
							</form>
						</div><!-- End of content Box -->

						<div class="content-box">
							<div class="content-box-title">
								<h1><i class="icon icon-agenda"></i>Invitaciones</h1>
							</div>
							<div class="content-box-inner">
								<ul>
									<li><i class="icon icon-check greencheck"></i><span class="email-note">alfredo@2gom.com.mx</span></li>
									<li><i class="icon icon-question greyedOut"></i><span class="email-note">damian@2gom.com.mx</span></li>
									<li><i class="icon icon-question greyedOut"></i><span class="email-note">humberto@2gom.com.mx</span></li>
									<li><i class="icon icon-question greyedOut"></i><span class="email-note">beto@2gom.com.mx</span></li>
								</ul>
							</div>
							<div class="content-box-footer">
								<!-- Contenido si es necesario -->
							</div>
						</div><!-- End of content Box -->

						<div class="content-box">
							<div class="content-box-title">
								<h1><i class="icon icon-archive"></i>Administracion</h1>
							</div>
							<div class="content-box-inner">
								<ul>
									<li><a href="">Crear Vacantes</a></li>
									<li><a href="">Clientes</a></li>
									<li><a href="">Reclutadores</a></li>
								</ul>
							</div>
							<div class="content-box-footer">
								<!-- Contenido si es necesario -->
							</div>
						</div><!-- End of content Box -->

						<div class="content-box">
							<div class="content-box-title">
								<h1><i class="icon icon-bars"></i>Reportes</h1>
							</div>
							<div class="content-box-inner">
								<ul>
									<li><a href="">Reclutadores</a></li>
									<li><a href="">Vacantes</a></li>
								</ul>
							</div>
							<div class="content-box-footer">
								<!-- Contenido si es necesario -->
							</div>
						</div><!-- End of content Box -->
								



								</div>
								<!-- end / SCROLL -->
							</div>
							<!-- end / SCROLL -->


						</div>
						<!-- end / .screen-int -->



	    			</div>
					<!-- End Front Side -->


		            <div class="zback-side">



		            	<!-- .screen-int -->
						<div class="example box screen-pago-terminos"
							data-options='{"direction": "vertical", "contentSelector": ">", "containerSelector": ">"}'>
							<!-- SCROLL -->
							<div>
								<!-- SCROLL -->
								<div>




		            	
		            	<div class="content-box">
							<div class="content-box-title">
								<h1><i class="icon icon-chart"></i>Mi progreso</h1>
							</div>
							<div class="content-box-inner chart-list">

								<div id="reporte_usuario" class="content-box-chart">
									imagen
								</div>
								<ul>
									<li><a href="">Pendientes <span class="bullet blueBtn"></span><span>35</span></a></li>
									<li><a href="">Cerradas <span class="bullet greenBtn"></span><span>15</span></a></li>
									<li><a href="">Canceladas<span class="bullet redBtn"></span><span>5</span></a></li>
								</ul>
							</div>
							<div class="content-box-footer">
							</div>
						</div><!-- End of content Box -->

						<div class="content-box">
							<div class="content-box-title">
								<h1><i class="icon icon-notes"></i>Mis Asignaciones</h1>
							</div>
							<div class="content-box-inner">
								<ul>
									<li><a href="" >Vacantes del Mes<span>11</span></a></li>
									<li><a href="" >Entrevistas Pendientes<span>2</span></a></li>

								</ul>
							</div>
							<div class="content-box-footer">
								<!-- Contenido si es necesario -->
							</div>
						</div><!-- End of content Box -->

						<div class="content-box">
							<div class="content-box-title">
								<h1><i class="icon icon-chart"></i>Progreso Gral</h1>
							</div>
							<div class="content-box-inner chart-list">

								<div id="reporte_usuario" class="content-box-chart">
									imagen
								</div>
								<ul>
									<li><a href="">Pendientes <span class="bullet blueBtn"></span><span>35</span></a></li>
									<li><a href="">Cerradas <span class="bullet greenBtn"></span><span>15</span></a></li>
									<li><a href="">Canceladas<span class="bullet redBtn"></span><span>5</span></a></li>
								</ul>
							</div>
							<div class="content-box-footer">
								<!-- <button class="primaryBtn">Enviar</button> -->
							</div>
						</div><!-- End of content Box -->

						<div class="content-box">
							<div class="content-box-title">
								<h1><i class="icon icon-pen"></i>Vacantes por Cliente</h1>
							</div>
							<div class="content-box-inner">
								<ul>
									<li><a href="" >Publiza<span>11</span></a></li>
									<li><a href="" >Indra<span>2</span></a></li>
									<li><a href="" >Sony<span>13</span></a></li>
									<li><a href="" >Bancomer<span>45</span></a></li>
									<li><a href="" >Motorola<span>12</span></a></li>
									<li><a href="" >Movistar<span>34</span></a></li>
									<li><a href="" >Telcel<span>87</span></a></li>
									<li><a href="" >Pepsico<span>8</span></a></li>

								</ul>
							</div>
							<div class="content-box-footer">
								<!-- Contenido si es necesario -->
							</div>
						</div><!-- End of content Box -->


								</div>
								<!-- end / SCROLL -->
							</div>
							<!-- end / SCROLL -->
						</div>
						<!-- end / .screen-int -->



						
		            </div>
		            <!-- End Back Side -->
	  			
	  			</div> <!-- Flip Panel -->

			</form>




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




<!-- Modal Ticket OpenPay -->
<div class="modal fade modal-warning modal-open-pay" id="modalOpenPay"
	aria-hidden="true" aria-labelledby="modalOpenPay"
	aria-labelledby="exampleModalWarning" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg modal-center">
		<div class="modal-content">

			<!-- .modal-header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<p class="modal-imprimir-ticket">
					<i class="fa fa-print"></i> Imprimir ticket
				</p>
				<h4 class="modal-title">Ticket de OpenPay</h4>
			</div>
			<!-- end / .modal-header -->

			<!-- .modal-body -->
			<div class="modal-body">

				<!-- .screen-pago-ticket -->
				<div class="example box screen-pago-ticket"
					data-options='{"direction": "vertical", "contentSelector": ">", "containerSelector": ">"}'>
					<!-- SCROLL -->
					<div>
						<!-- SCROLL -->
						<div>

							<div class="dgom-ui-opayForm-wrapper"></div>

						</div>
						<!-- end / SCROLL -->
					</div>
					<!-- end / SCROLL -->
				</div>
				<!-- end / .screen-pago-ticket -->

			</div>
			<!-- end / .modal-body -->

		</div>
	</div>
</div>
<!-- end / Modal Ticket OpenPay-->


<!-- Modal Mensaje referente al Pago OpenPay -->
<div class="modal fade modal-primary in modal-open-pay-mensaje"
	id="modalOpenPayMensaje" aria-hidden="true"
	aria-labelledby="modalOpenPayMensaje" role="dialog" tabindex="-1">
	<!-- .modal-dialog -->
	<div class="modal-dialog modal-center">
		<!-- .modal-content -->
		<div class="modal-content">

			<!-- .modal-header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="icon ion-close-circled"></i>
				</button>
				<h4 class="modal-title"><i class="icon ion-alert-circled"></i> Aviso</h4>
			</div>
			<!-- end / .modal-header -->

			<!-- .modal-body -->
			<div class="modal-body">
				<p>
					Recuerda que una vez realizado tu pago puede tardar hasta 72 hrs para verse reflejado en nuestra plataforma.
				</p>
			</div>
			<!-- end / .modal-body -->

			<!-- .modal-footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-red" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-green" id="continuarOpenPay">Continuar</button>
			</div>
			<!-- end / .modal-footer -->

		</div>
		<!-- end / .modal-content -->
	</div>
	<!-- end / .modal-dialog -->
</div>
<!-- end / Modal Mensaje referente al Pago OpenPay -->

<!-- Open pay pal -->
<div id="container-pay-pal"></div>
<!-- Close pay pal -->

<!-- OPEN PAY -->
<div class="dgom-ui-opayForm-wrapper"></div>
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

	
	// Al dar click al botón de pagar
	$("#continuarOpenPay").on("click", function(e){
		e.preventDefault();
		
		generarOrdenCompra();
	
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

		generarOrdenCompra();
		
		
	
	});


	// Al dar click a un radio button de un subproducto marcara el producto
	$(".subProductoCheck").on("click",function(){
		var idP = $(this).data("producto");
		$("#producto-"+idP+" .productoCheck").prop("checked", true);
		
	});

	$(".productoCheck").on("change", function(){
		offRadioSubProductos();
		totalPagar();
	});

	$(".subProductoCheck").on("change", function(){
		
		totalPagar();
	});

$(".subProductoCheck").on("click", function(){
		
		var elemento = $(this);
		var data = elemento.data("ischecked");

		if(data=="si"){
			elemento.prop("checked", false);
			elemento.data("ischecked", "no");
		}else{
			elemento.data("ischecked", "si");
			
		}
		totalPagar();
		
	});


	// Apaga todos los radio cuando se selecciona el producto
	function offRadioSubProductos(){
		$(".subProductoCheck").prop("checked", false);
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

// ------------- Open Pay-----------s

function generateCodeBar(){
	jQuery.ajax({
			url:'<?=Yii::app()->request->baseUrl ?>/payments/oPCodeBar',// cambiar
			method: "POST",
			data: { monto: 6.60, 
					desc: "Esta es una descripcion", 
					idp:1 
				  },
			success: function(res){
				
				jQuery('.dgom-ui-opayForm-wrapper').css('display','block');
				jQuery('.dgom-ui-opayForm-wrapper').html(res);
				jQuery('.dgom-ui-opayForm-wrapper').css('top','-100px');
				
			},
			error:function(p1,p2,p3){}
		});
}

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

	$("#total").text("$ "+total.toFixed(2).replace(/./g, function(c, i, a) {
	    return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
	}));
}
</script>