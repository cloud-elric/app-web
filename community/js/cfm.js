//var base = 'http://localhost/wwwComite2017/';
//var base = 'https://globaljudging.com/community/';
//var base = 'https://hazclicconmexico.comitefotomx.com/concursar/';

var loaginModal = '<div class="dgom-ui-opayForm-wrapper-loading"><img src="'
		+ base + 'images/loading.gif" alt="Loading"></div>';

/*
 * !
 * 
 * CFM Descripción de lo que es proyecto
 *  # url http://www.proyecto.com/ # author Damián <@damian> # copyright
 * Copyright (c) 2016, Proyecto
 */

/*
 * ! -------------------------------------------------------- CFM.js
 * -------------------------------------------------------- @Pago # Participante
 * @Pago # Seleccion --------------------------------------------------------
 */

$(document)
		.ready(
				function() {
					
					
					$(window).bind("pageshow", function(){
						$("#form-pago").trigger("reset");
					});
					

					var panels = document.querySelectorAll(".zflip-panel");
					for (var i = 0, len = panels.length; i < len; i++) {
						var panel = panels[i];
						clickListener(panel);
					}

					function clickListener(panel) {
						panel.addEventListener("click", function() {
							var c = this.classList;
							c.contains("flipped") === true ? c
									.remove("flipped") : c.add("flipped");
						});
					}

					/**
					 * Obtener height y ajustar Height
					 */
					var height = $(window).height();
					var heightModal70 = height - 150;
					var heightModal60 = height - 190;
					obtenerAlto(height, heightModal70, heightModal60);

					/**
					 * Resize y ajustar Height
					 */
					$(window).resize(function() {
						obtenerAlto(height, heightModal70, heightModal60);
					});

					/**
					 * Scroll
					 */
					//Holder.run();

					$(".box").asScrollable();

					$(".example").on("asScrollable::scrolltop",
							function(e, api, direction) {
								console.info("top:" + direction);
							});

					$(".example").on("asScrollable::scrollend",
							function(e, api, direction) {
								console.info("end:" + direction);
							});
					
					

					/**
					 * Effect - Click
					 */
					$(".paper")
							.mousedown(
									function(e) {
										var ripple = $(this).find(".ripple");
										ripple.removeClass("animate");
										var x = parseInt(e.pageX
												- $(this).offset().left)
												- (ripple.width() / 2);
										var y = parseInt(e.pageY
												- $(this).offset().top)
												- (ripple.height() / 2);
										ripple.css({
											top : y,
											left : x
										}).addClass("animate");
									});

					/**
					 * Effect - Click XS
					 */
					$(".paperxs")
							.mousedown(
									function(e) {
										var ripple = $(this).find(".ripplexs");
										ripple.removeClass("animatexs");
										var x = parseInt(e.pageX
												- $(this).offset().left)
												- (ripple.width() / 1.1);
										var y = parseInt(e.pageY
												- $(this).offset().top)
												- (ripple.height() / 1.1);
										ripple.css({
											top : y,
											left : x
										}).addClass("animatexs");
									});

					/**
					 * 
					 * @Pago Participante
					 * 
					 */

					// Cambia el texto dependiendo de la forma de pago
					// seleccionada
					$(".formaPago")
							.on(
									"change",
									function() {
										var formaPago = $(
												'input[name="tipoPago"]:checked',
												'#form-pago').data("name");

										// Paypal
										if (formaPago == "Paypal") {
											$('#pagar').attr("value", "Pagar cuota de recuperación");
										} else if (formaPago == "Open Pay") {

											$('#pagar').attr("value",
													"Pagar cuota de recuperación");
										}
									});

					$(".formaPago").on("click", function(e) {
						var contador = $('.productoCheck:checked').length
						if (contador < 1) {

							toastrWarning("Por favor debe seleccionar un tipo de inscripción");
							e.preventDefault();
							return false;
						}
					});

					/**
					 * Check terminos
					 */
					$(".check-terminos").change(function() {
						
						if ($('input[name="terminos"]').is(':checked')) {
							$(".check-mask").hide();
							$(".btn-pagar").prop("disabled", false);

						} else {
							$(".check-mask").show();
							$(".btn-pagar").prop("disabled", true);
						}
					});

					/**
					 * Check Mask
					 */
					$(".check-mask").click(function() {
						$(".text").hide();
						$(".terminos-condiciones").show();
					});

					/**
					 * Close -Terminos y condiciones
					 */
					$(".terminos-condiciones-close").click(function() {
						$(".text").show();
						$(".terminos-condiciones").hide();
					});

					/**
					 * Acepto -Terminos y condiciones
					 */
					$(".terminos-condiciones-acepto").click(function(e) {
						e.preventDefault();
						$(".terminos-condiciones").hide();
						$(".check-mask").hide();
						$(".text").show();
						$('input[name="terminos"]').prop("checked", true);
						$(".btn-pagar").prop("disabled", false);
					});

					/**
					 * 
					 * @Pago Seleccion
					 * 
					 */

					/**
					 * Cerrar -Terminos y condiciones
					 */
					$(".terminos-condiciones-closer").click(
							function() {
								$(".screen-pago-terminos").animate({left: "100%"}, 800, "easeOutQuint" );
								$(".pago-seleccion-user").css("color", "#3a3a3a");
							});

					

					/**
					 * Validar check -Terminos y condiciones
					 */
					$(".check-terminos-condiciones").change(
							function() {

								if ($('input[name="terminoscondiciones"]').is(
										':checked')) {
									$(".mask-check").hide();
									$(".mask-pagar").hide();
									$(".radio").css("opacity", 1);
									$(".btn-pagar").prop("disabled", true);

									$(".items-pay").css("opacity", 1);

								} else {
									$(".mask-check").show();
									$(".mask-pagar").show();

									$(".radio").css("opacity", .5);
									$(".btn-pagar").css("opacity", .5);

									$(".items-pay").css("opacity", .5);

									$(".btn-pagar").prop("disabled", true);
								}

							});

					/**
					 * Validar radio button -PayPall & OpenPay
					 */
					$("input[name=tipoPago]").on("change", function() {
						// $(".radio-style-pay").on("change",function() {


						var pay = $(this).data("name");

						// // $(".radio").css( "opacity", 1 );
						// // $(".btn-pagar").css( "opacity", 1 );

						$(".btn-pagar").css("opacity", 1);
						$(".btn-pagar").prop("disabled", false);
						// $(".pago-seleccion-datos-recibo").hide();

						if (pay == "Paypal") {
							// $(".pago-seleccion-datos-int").show();
							$(".btn-pagar").text('PayPall');
							// alert("Pay");
						} else if (pay == "Open Pay") {
							$(".btn-pagar").text('Pagar');
							// alert("Open");
						}

					});

					$(".picDescripcion").on(
							"focus",
							function() {
								var elemento = $(this).parents("form");
								var identificador = elemento.attr("id");

								$("#" + identificador + " .caracteres").css(
										"display", "block");

							});

					$(".picDescripcion").on(
							"blur",
							function() {
								var elemento = $(this).parents("form");
								var identificador = elemento.attr("id");

								$("#" + identificador + " .caracteres").css(
										"display", "none");

							});

					/**
					 * 
					 * @Toast Flip
					 * 
					 */
					$(".dgom-menu-btn-group").click(
							function(e) {
								e.preventDefault();
								var elemento = $(this);
								var data = elemento.attr("data-flip");
								var identificador = elemento.parents("form")
										.attr("id");

								$(".dgom-menu-btn-group").removeClass(
										"dgom-menu-btn-group-active");
								$(this).addClass("dgom-menu-btn-group-active");

								if (data == "edit") {
									$("#" + identificador + " .flip-panel")
											.addClass("flipped");

									// alert("if");
								} else if (data == "view") {
									$(".flip-panel").removeClass("flipped");

									// alert("else if");
								} else {
									// alert("else");
								}

							});

					/**
					 * 
					 * @Pago Boton pagar - PayPal OpenPay
					 * 
					 */
					$(".btn-pagar").click(function() {
						// $('#modalOpenPay').modal('show');
					});

					$(".dgom-js-toastError").click(function() {
						toastrError();
					});

					$(".dgom-js-toastInfo").click(function() {
						toastrInfo();
					});

					$(".dgom-js-toastSuccess").click(function() {
						toastrSuccess();
					});

					$(".dgom-js-toastWarning").click(function() {
						toastrWarning();
					});

					/**
					 * 
					 * @User Flip
					 * 
					 */
					$(".user-side").click(function() {

						var data = $(this).attr("data-flip");

						// $(".dgom-menu-btn-group").removeClass("dgom-menu-btn-group-active");
						// $(this).addClass("dgom-menu-btn-group-active");

						if (data == "front") {
							$(".user-flip").addClass("flipped");

							// alert("if");
						} else if (data == "back") {
							$(".user-flip").removeClass("flipped");

							// alert("else if");
						} else {
							// alert("else");
						}

					});

					/**
					 * 
					 * @Pago Terminos y condiiones (Flip)
					 * 
					 */
					$(".dgom-js-pago-terminos-flip").click(function() {
						$(".pago-terminos-flip").addClass("flipped");
					});

					$(".dgom-js-pago-terminos-flips").click(function() {
						$(".pago-terminos-flip").removeClass("flipped");
					});

					/**
					 * 
					 * @Pago User Flip
					 * 
					 */
					$(".pago-user-flip").click(
							function(e) {
								e.preventDefault();
								var data = $(this).attr("data-flip");
								if (data == "front") {
									$(".pago-seleccion-user-flip").addClass(
											"flipped");
								} else if (data == "back") {
									$(".pago-seleccion-user-flip").removeClass(
											"flipped");
								}
							});

					/**
					 * 
					 * @Pago Modal Open Pay - Imprimir
					 * 
					 */
					$(".modal-imprimir-ticket").click(function() {
						$("#print").printArea();
						//window.print();
					});

					/**
					 * 
					 * @Pago Modal Mensaje del Pago
					 * 
					 */
					// $(".pago-mensaje-modal").click(function(){
					// alert();
					// $('#modalOpenPayMensaje').modal('show');
					// });

					$(".closeSession").on("click", function(e) {
						location.replace(base + "site/logout");
					});

					$(".picDescripcion").on("keyup", function(e) {
						var len = $(this).val().length;
						var ide = $(this).data("ide");

						$("#" + ide + " .caracteres-limitados").text(len);

					});

					/**
					 * 
					 * MisFotos Select - Placeholder
					 * 
					 */
					$('.categoria').change(
							function() {
								if ($(this).children('option:first-child').is(
										':selected')) {
									$(this).addClass('placeholder');
								} else {
									$(this).removeClass('placeholder');
								}
							});

					/**
					 * Boton para participar
					 */
					$(".participar")
							.on(
									"click",
									function() {
										var idToken = $('#aceptarConcursar').data('token');
										$
												.ajax({
													url : base
															+ "usrUsuarios/usurioParticipar?idTok="+idToken,
													success : function() {
														$(".participarCloud")
																.css("display",
																		"none");
														$(
																'#modalDatosCompletos')
																.modal('hide');
														$(".editPhoto")
																.remove();
														$(".deletePhoto")
																.remove();
														$("form .flip-panel")
																.removeClass(
																		"flipped");

														$(".toast-msj-success")
																.addClass(
																		"toast-msj-success-final");

														$(".back-side")
																.remove();

													},
													statusCode : {
														404 : function() {
															toastrError("Ocurrio un problema al iniciar participación");
														},
														500 : function() {
															toastrError("Ocurrio un problema al guardar los datos.");

														}
													}

												});

									});

					/**
					 * 
					 * Login Flip Login & Olvide contraseña
					 * 
					 */
					// Mostrar Olvide contraseña
					$(".login-form-flip-back").click(function(e) {
						e.preventDefault();
						$(".login-form-flip").addClass("flipped");
					});
					// Mostrar Login
					$(".login-form-flip-front").click(function(e) {
						e.preventDefault();
						$(".login-form-flip").removeClass("flipped");
					});
					


				});
// END - document ready

// Function toastr ERROR
function toastrError(mensaje) {
	Command: toastr["error"](mensaje);
	toastr.options = {
		"closeButton" : false,
		"debug" : true,
		"newestOnTop" : true,
		"progressBar" : false,
		"positionClass" : "toast-top-right",
		"preventDuplicates" : true,
		"onclick" : null,
		"showDuration" : "300",
		"hideDuration" : "1000",
		"timeOut" : "5000",
		"extendedTimeOut" : "1000",
		
		"showEasing" : "swing",
		"hideEasing" : "linear",
		"showMethod" : "slideDown",
		"hideMethod" : "slideUp",
		"closeMethod" : "slideUp"
	}
}

// Function toastr INFO
function toastrInfo(mensaje) {
	Command: toastr["success"](mensaje);
	toastr.options = {
		"closeButton" : false,
		"debug" : true,
		"newestOnTop" : true,
		"progressBar" : false,
		"positionClass" : "toast-top-right",
		"preventDuplicates" : true,
		"onclick" : null,
		"showDuration" : "300",
		"hideDuration" : "1000",
		"timeOut" : "5000",
		"extendedTimeOut" : "1000",
		"showEasing" : "swing",
		"hideEasing" : "linear",
		"showMethod" : "slideDown",
		"hideMethod" : "slideUp",
		"closeMethod" : "slideUp"
	}
}

// Function toastr SUCCESS
function toastrSuccess(mensaje) {
	Command: toastr["success"](mensaje);
	toastr.options = {
		"closeButton" : false,
		"debug" : true,
		"newestOnTop" : true,
		"progressBar" : false,
		"positionClass" : "toast-top-right",
		"preventDuplicates" : true,
		"onclick" : null,
		"showDuration" : "300",
		"hideDuration" : "1000",
		"timeOut" : "5000",
		"extendedTimeOut" : "1000",
		"showEasing" : "swing",
		"hideEasing" : "linear",
		"showMethod" : "slideDown",
		"hideMethod" : "slideUp",
		"closeMethod" : "slideUp"
	}
}

// Function toastr WARNING
function toastrWarning(mensaje) {
	Command: toastr["warning"](mensaje);
	toastr.options = {
		"closeButton" : false,
		"debug" : true,
		"newestOnTop" : true,
		"progressBar" : false,
		"positionClass" : "toast-top-right",
		"preventDuplicates" : true,
		"onclick" : null,
		"showDuration" : "300",
		"hideDuration" : "1000",
		"timeOut" : "5000",
		"extendedTimeOut" : "1000",
		"showEasing" : "swing",
		"hideEasing" : "linear",
		// "showMethod": "fadeIn",
		// "hideMethod": "fadeOut"
		"showMethod" : "slideDown",
		"hideMethod" : "slideUp",
		"closeMethod" : "slideUp"
	}
}



/**
 * Muestra la barra
 * 
 * @param identificador
 */
function mostrarBarraEstado(identificador, nombre) {
	$(identificador + " .progress-upload").css("display", "block");
	$(identificador + " .progress-nom p").text(nombre);
}
/**
 * Ocultar la barra
 * 
 * @param identificador
 */
function ocultarBarraEstado(identificador) {
	$(identificador + " .progress-upload").css("display", "none");
}

/**
 * Oculta icono de subir archivo
 * 
 * @param elemento
 */
function ocultarIconoUpload(identificador) {
	$(identificador + " .myFileText").css("display", "none");
}

/**
 * Muestra icono de subir archivo
 * 
 * @param elemento
 */
function mostrarIconoUpload(identificador) {
	$(identificador + " .myFileText").css("display", "block");
}

/**
 * cuando se arrastra un elemento dentro del archivo
 * 
 * @param elemento
 */
function ondragoverFile(elemento) {

	elemento.addClass("myFile-drag");
}

/**
 * Cuando se arrastra fuera del elemento
 * 
 * @param elemento
 */
function ondragleaveFile(elemento) {
	elemento.removeClass("myFile-drag");
}

/**
 * Cuando se suelta el elemento dentro del contenedor
 */
function ondropFile(elemento) {
	elemento.removeClass("myFile-drag");
}

/**
 * 
 * @Pago Click en Pagar
 * 
 */
function mostrarRecibo() {
	// $(".pago-seleccion-datos-int").hide();
	// $(".pago-seleccion-datos-recibo").show();

	$('#modalOpenPay').modal('show');
};

// muestra modal con información sobre el pago
function mensajeConfirmacion() {
	$('#modalOpenPayMensaje').modal('show');

}

function cerrarMensajeConfirmacion() {
	$('#modalOpenPayMensaje').modal('hide');

}

// Formulario
function managerFormaPago(res) {
	var formaPago = $('input[name="tipoPago"]:checked', '#tipo-pago').data(
			"name");
	
	// Paypal
	if (formaPago == "Paypal") {
		
		$('#container-pay-pal').html(res);
		$('#formPayPal').submit();
		
	} else if (formaPago == "Open Pay") {
		// cerrarMensajeConfirmacion();
		$('.dgom-ui-opayForm-wrapper').html(res);
		
		$('#modalOpenPayMensaje').modal('hide');
		
		$('#modalOpenPay').modal('show');
//		var l = Ladda.create(document.getElementById('pagarCheck'));
// 		l.start();
//		l.stop();
		
	}
}

// maneger
function managerPa() {

	var formaPago = $('input[name="tipoPago"]:checked', '#form-pago').data(
			"name");

	// Paypal
	if (formaPago == "Open Pay") {
		cerrarMensajeConfirmacion();
		$('.dgom-ui-opayForm-wrapper').html(loaginModal);
		mostrarRecibo();

	}

}

/**
 * Height
 */
function obtenerAlto(height, heightModal70, heightModal60) {
	$(".login-col-flex").css("height", height); // 95
	$(".registro").css("height", height);
	$(".pago-participante-col-flex").css("height", height);
	$(".pago-seleccion-datos").css("height", height);
	$(".pago-terminos-flip").css("height", height);
	$(".pago-terminos-front-side").css("height", height);
	$(".pago-terminos-back-side").css("height", height);
	$(".screen-seccion").css("height", height);
	// Sección Mis fotos - footer
	var heightFotos = height - 22;
	$(".mis-fotos").css("minHeight", heightFotos);
	$(".screen-pago-ticket").css("height", heightModal70); // 70
	$(".screen-int-pago").css("height", heightModal60); // 60
	$(".asScrollable-container").css("height", height);
	$(".screen-pago").css("height", height);
	$(".screen-pago-terminos").css("height", height);
	$(".screen").css("height", height);
	$(".screen-int").css("height", height);
	$(".error-404").css("height", height);
	$(".error-500").css("height", height);
	$(".revisar-pago-wrap").css("height", height);

	// alert("Entro: " + height + " - " + heightModal70 + " - " + heightModal60);
}

function borrarImagen(elemento, token) {

	elemento.prop("disabled", true);
	elemento.addClass("btn-borrar-foto-anim");
	
	var data = elemento.data("value");
	$
			.ajax({
				url : base + 'usrUsuarios/deletePhoto/id/' + data+'/token/'+token,
				type : "GET",
				success : function(response) {

					$("#wrk-pic-form_" + data + " .error").each(
							function(index) {
								$(this).removeClass("error");
							});

					$(".front_" + data + " .form-tipo").text("");
					$(".front_" + data + " .txt_pic_name_label").text("");
					$(".front_" + data + " .form-titulo").text("");
					// $(".front_"+data+" .imagePreviewFront").attr("src",
					// "http://lorempixel.com/300/200/city/1/");
					$(".front_" + data + " .imagePreviewFront").css(
							"background-image",
							"url(" + base + "images/miFotoDefault.jpg)");

					$(".back_" + data + " .myFile-default").css(
							"background-image",
							"url(" + base + "images/miFotoDefault.jpg)");
					$(".back_" + data + " .categoria").val("");
					$(".back_" + data + " .picName").val("");
					$(".back_" + data + " .picDescripcion").val("");
					$(".back_" + data + " .caracteres-limitados").text("0");
					
					$("#wrk-pic-form_" + data + " .lightBox").attr("href",
							base+"images/miFotoDefaultLg.jpg");
					
					$("#wrk-pic-form_" + data + " .lightBox").attr("title","Foto sin cargar");

					$(".back_" + data + " .myFile").removeClass(
							"myFile-noSlash");
					$(".back_" + data + " .myFile").removeClass("myFile-drag");

					mostrarIconoUpload("#wrk-pic-form_" + data, "");

					$("#wrk-pic-form_" + data + " .flip-panel").addClass(
							"flipped");
					$("#wrk-pic-form_" + data + " .myFile-default")
							.removeClass("myFile-default-upload-anim");
					
					$("#wrk-pic-form_" + data + ' .verificarButtonAjax').fadeOut("slow");
					toastrSuccess("Photo deleted successfully");
					
					$("#modalEliminarFoto-" + data).modal("hide");
					
					$("#wrk-pic-form_" + data ).removeClass("contadorForm");
					
					$("#wrk-pic-form_"+ data).addClass("contadorForm");
					
					elemento.prop("disabled", false);
					elemento.removeClass("btn-borrar-foto-anim");

				},
				statusCode : {
					404 : function() {
						elemento.prop("disabled", false);
						elemento.removeClass("btn-borrar-foto-anim");
						toastrError("There was a problem deleting the photo");
					},
					500 : function() {
						elemento.prop("disabled", false);
						elemento.removeClass("btn-borrar-foto-anim");
						toastrError("There was a problem deleting the photo");

					}
				}
			});

}

/**
 * Cierra el error
 */
function closeErrorUpload(elemento) {

	if (!elemento.hasClass("cerrarUpload")) {
		return false;
	}

	var formulario = elemento.parents("form");
	var identificador = formulario.attr("id");

	ocultarBarraEstado("#" + identificador);
	mostrarIconoUpload("#"+identificador);
	elemento.removeClass("cerrarUpload");
	$("#" + identificador + " .pictureUpload").prop("disabled", false);
	
}


(function() {

    var beforePrint = function() {
        alert('Functionality to run before printing.');
    };

    var afterPrint = function() {
    	alert('Functionality to run after printing');
    };

    if (window.matchMedia) {
        var mediaQueryList = window.matchMedia('print');
        mediaQueryList.addListener(function(mql) {
            if (mql.matches) {
                beforePrint();
            } else {
                afterPrint();
            }
        });
    }

    window.onbeforeprint = beforePrint;
    window.onafterprint = afterPrint;

}());


