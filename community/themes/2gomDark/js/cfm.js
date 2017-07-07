/*!
	*	CFM
	*	Descripción de lo que es proyecto

	# url         http://www.proyecto.com/
	# author      Damián <@damian>
	# copyright   Copyright (c) 2016, Proyecto
	*/

/*!
	--------------------------------------------------------
	CFM.js
	--------------------------------------------------------
	@Ready
		# Scroll
	@Pago
		# Participante
	@Pago
		# Seleccion
	@Toast
		# Flip
	--------------------------------------------------------
	*/


/**
 * 
 * @Ready
 * Scroll
 * 
 */
$(document).ready(function(){

	/**
	 *  Scroll
	 */
	//Holder.run();

	$(".box").asScrollable();

	$(".example").on("asScrollable::scrolltop", function(e, api, direction){
		console.info("top:"+direction);
	});

	$(".example").on("asScrollable::scrollend", function(e, api, direction){
		console.info("end:"+direction);
	});

});

/**
 * 
 * @Pago
 * Participante
 * 
 */

/**
 *  Check terminos
 */
$(".check-terminos").change(function() {
	if($('input[name="terminos"]').is(':checked')){
		$(".check-mask").hide();
		$(".btn-pagar").prop( "disabled", false );

	} else{
		$(".check-mask").show();
		$(".btn-pagar").prop( "disabled", true );
	}
});

/**
 *  Check Mask
 */
$(".check-mask").click(function() {
	$(".text").hide();d
	$(".terminos-condiciones").show();
});

/**
 *  Close -Terminos y condiciones
 */
$(".terminos-condiciones-close").click(function() {
	$(".text").show();
	$(".terminos-condiciones").hide();
});

/**
 *  Acepto -Terminos y condiciones
 */
$(".terminos-condiciones-acepto").click(function() {
	$(".terminos-condiciones").hide();
	$(".check-mask").hide();
	$(".text").show();
	$('input[name="terminos"]').prop( "checked", true );
	$(".btn-pagar").prop( "disabled", false );
});





/**
 * 
 * @Pago
 * Seleccion
 * 
 */

/**
 *  Abrir -Terminos y condiciones
 */
// Abrir terminos y condiciones
$(".mask-check").click(function() {
	$(".terminos-condiciones").show();
});

/**
 *  Cerrar -Terminos y condiciones
 */
$(".terminos-condiciones-closer").click(function() {
	$(".terminos-condiciones").hide();
});

/**
 *  Acepto -Terminos y condiciones
 */
$(".terminos-condiciones-aceptor").click(function() {
	$(".terminos-condiciones").hide();
	$(".mask-check").hide();
	$(".mask-pagar").hide();

	$('input[name="terminoscondiciones"]').prop( "checked", true );
	$(".radio").css( "opacity", 1 );
});

/**
 *  Validar check -Terminos y condiciones
 */
$(".check-terminos-condiciones").change(function() {

	if($('input[name="terminoscondiciones"]').is(':checked')){
		$(".mask-check").hide();
		$(".mask-pagar").hide();
		$(".radio").css( "opacity", 1 );
		$(".btn-pagar").prop( "disabled", true );

	} else{
		$(".mask-check").show();
		$(".mask-pagar").show();

		$(".radio").css( "opacity", .5 );
		$(".btn-pagar").css( "opacity", .5 );

		$(".btn-pagar").prop( "disabled", true );
	}

});

/**
 *  Validar radio button -PayPall & OpenPay
 */
$("input[name=optionsRadios2]").change(function() {

	var pay = $(this).val();

	if(pay == "paypal"){
		$(".btn-pagar").css( "opacity", .5 );
		$(".btn-pagar").prop( "disabled", true );
		$(".pago-seleccion-datos-recibo").hide();
		$(".pago-seleccion-datos-int").show();
	} else if(pay == "openpay"){
		$(".btn-pagar").css( "opacity", 1 );
		$(".btn-pagar").prop( "disabled", false );
		$(".pago-seleccion-datos-recibo").hide();
	}
});


/**
 *  Click en Pagar
 */
$(".btn-pagar").click(function() {
	$(".pago-seleccion-datos-int").hide();
	$(".pago-seleccion-datos-recibo").show();
});




/**
 * 
 * @Toast
 * Flip
 * 
 */
$(".dgom-menu-btn-group").click(function(){

	var data = $(this).attr("data-flip");

	$(".dgom-menu-btn-group").removeClass("dgom-menu-btn-group-active");
	$(this).addClass("dgom-menu-btn-group-active");
	

	if(data == "edit"){
		$(".flip-panel").addClass("flipped");

		// alert("if");
	} else if(data == "view"){
		$(".flip-panel").removeClass("flipped");

		// alert("else if");
	} else{
		alert("else");
	}

});