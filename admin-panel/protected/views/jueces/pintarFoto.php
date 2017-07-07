<div id="page" class="photo-page">
			<?php
			$form = $this->beginWidget ( 'CActiveForm', array (
					'id' => 'calificar-foto-form',
					
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// There is a call to performAjaxValidation() commented in generated controller code.
					// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation' => false 
			) );
			?>
	<!-- Loading Juez -->
	<div class="dgom-ui-loading-juez">
		<div class="loader-default loader vertical-align-middle"
			data-type="default"></div>
	</div>

	<!-- Panel de Buttons -->
	<div class="photo-toolbar dgom-ui-btn-wrapper ">
		<?php echo CHtml::link('Back to Dashboard',array('jueces/index',"t"=>$t), array("class"=>"dgom-ui-Btn dgom-ui-a")); ?>
		<!-- dgom-js-beginReview -->
		<button id="dgom-js-pintar-photo-wrap-panel-score" class="dgom-ui-Btn dgom-ui-Btn-photoReview">Begin Review</button>
	</div>


	<section class="dgom-ui-pintar-photo-wrap">
		<div class="dgom-ui-pintar-photo-wrap-panel dgom-ui-pintar-photo-wrap-panel-score">
			
			<div class="row rowTotal margin-0">
				<div class="col-md-7 text-left">
					<p class="margin-0">Category:</p>
					<h2 class="margin-vertical-3 dgom-ui-pintarFoto-text-categoria"><?=$photoCalificar->idCategoryOriginal->txt_name_es?></h2>
					<div class="example margin-0 text-left">
						<?php
						$photoCalificar->id_category = NULL;
						echo $form->dropDownList ( $photoCalificar, "id_category", $categoriasList, array (
								"class" => "form-control select2-hidden-accessible select-2-style",
								"data-plugin" => "select2",
								"tabindex" => "-1",
								"aria-hidden" => "true",
								"prompt" => "Swap Category" 
						) )?>
					</div>
				</div>
			</div>

			<article class="col-lg-8 col-sm-12 pull-ok">

				<label for="inputUnchecked">Consider for honorable mention</label>
				<?php
				echo CHtml::checkBox ( "b_mencion", false, array (
						"class" => "icheckbox-primary",
						"id" => "inputUnchecked",
						"data-plugin" => "iCheck",
						"data-checkbox-class" => "icheckbox_flat-blue icheckbox_flat-blue-radius" 
				) )?>

			</article>

			<div class="row margin-0">
				
				<?php
				$index = 1;
				foreach ( $rubros as $rubro ) {
					
					?>
					<div class="col-sm-12 dgom-ui-score-sliders">
					<div class="row rowRange">
						<div class="col-sm-10">
							<div class="example-wrap">
								<h4 class="example-title"><?=$rubro->txt_nombre?></h4>
								<div class="example">
									<div class="asRange rangeUi asRange-<?=$index?>"
										data-plugin="asRange" data-namespace="rangeUi" data-value="1"></div>
								</div>
							</div>
							<p class="rowRange-p as-Range-<?=$index?>">Below exhibition standards</p>
						</div>

						<div class="col-sm-2" tabindex="0">
								<?=$form->hiddenField($photoCalificar, "WrkPicsCalificaciones[$rubro->id_rubro]num_calificacion", array("class"=>"dgom-js-sum dgom-js-calificacion-".$index, "value"=>1))?>
								<span class="rangeRight js-valRange-<?=$index?>">1 </span>
						</div>

					</div>
				</div>
				<?php
					$index ++;
				}
				?>

			</div>

			<div class="row">
				<div class="col-lg-12 col-sm-12 col-md-12  text-center" style="margin-top: 60px;">
					<p class="margin-bottom-0 dgom-ui-content-input-progress-p">Total
						Score</p>
					<div class="dgom-ui-content-input-progress-canvas">
						<input type="text" class="knob-chart knob-example-1"
							data-plugin="knob" data-fg-color="#75E268" data-min="0"
							data-max="100" value="4" disabled data-readonly="true"/>
					</div>
				</div>
			</div>

		</div>

		<div class="dgom-ui-pintar-photo-wrap-panel dgom-ui-pintar-photo-wrap-panel-notes">

		<!-- <div class="dgom-ui-pintar-photo-wrap-panel dgom-ui-pintar-photo-wrap-panel-notes dgom-ui-pintar-photo-wrap-panel-notes-textarea"> -->
			
			<!-- Dictation -->
			<div class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-dictation">
				<!-- Begin -->
				<div id="dgom-js-recording">
					<div class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-dictation-icon"></div>
					<p>Begin Feedback Dictation</p>
				</div>
				<!-- Message -->
				<div class="dgom-ui-pintar-photo-wrap-panel-notes-message">
					<!-- Necesitas un Navegador (Chrome 33+ o Firefox 44+)-->
					<div class="dgom-ui-pintar-photo-wrap-panel-notes-message-navegador" id="dgom-ui-pintar-photo-message-navegador">
						El dictado por voz solo funciona en los navegadores Chrome(ver. 33+) y Firefox(ver. 44+)
					</div>
				</div>
			</div>
			
			
			<!-- Textarea -->
			<div class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea-on">
				<?php echo CHtml::textArea("txt_retro", "",array("class"=>"form-control form-transpent","id"=>"textareaDefault",  "pattern"=>".{1,500}", "title"=>"Enter Feedback here... 30chars minimun", "placeholder"=>""))?>
			</div>


			<!-- Recording -->
			<div class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording">
				<div class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording-int">
					<p class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording-p-recording">Recording</p>
					<div class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording-graphic"><div id="siri-container" style="width: 100%;"></div></div>
					<p class="dgom-js-pintar-photo-wrap-panel-notes-begin-feedback-recording-p-stop">Stop</p>
				</div>
				<!-- Habla FUERTE -->
				<div class="dgom-ui-pintar-photo-wrap-panel-notes-message-hablar-fuerte" id="dgom-ui-pintar-photo-message-hablar-fuerte">
					Habla FUERTE!
				</div>
			</div>
			
			<!-- Record -->
			<div class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record">
				<div class="dgom-js-pintar-photo-wrap-panel-notes-begin-feedback-record-new">
					<div class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-icon"></div>
					<p>Record</p>
				</div>
				<p class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-limited"><label class="contadorCaracteres">2500</label>/2500 chars allowed</p>
			</div>

			<!-- <div class="form-group">
				<?php # echo CHtml::textArea("txt_retro", "",array("class"=>"form-control form-transpent","id"=>"textareaDefault", "rows"=>"3", "required"=>"required", "pattern"=>".{1,500}", "maxlength"=>"500", "title"=>"Enter Feedback here... 30chars minimun", "placeholder"=>"Minimun 30 chars"))?>
				
				<div id="beginSpeack" onclick="startButton(event);"><img alt="Start" id="start_img" src="https://speechlogger.appspot.com/images/micoff2.png"></div>
				<div id="siri-container" style="width: 100%;"></div>
				<div id="dgom-func-TxtAreaCharCounter-count">500 chars left</div>
			</div> -->
			
		</div>


		<div class="row">
			<div class="col-lg-12 col-sm-12 form-group padding-vertical-15 text-center">
				<button type="submit" class="btn btn-primary enviar ladda-button dgom-ui-pintarFoto-next" id="dgom-js-next-photo" data-style="zoom-out"><span class="ladda-label">Next Photo</span></button>
				<!-- .dgom-ui-pintarFoto-next-message -->
				<div class="dgom-ui-pintarFoto-next-message dgom-ui-pintarFoto-next-message-alert">
					<?=Yii::t('site','messageNextPintarFoto');?>.
				</div>
				<!-- end / .dgom-ui-pintarFoto-next-message -->
			</div>
		</div>

		<div class="row dgom-ui-alert-invalid alert margin-right-20"
			style="display: none;">Feed back must be at least 30 chars long</div>

	</section>

	<section class="dgom-ui-photo-wrapper">
		<div class="dgom-ui-photo">
			<img style="display: none;" id="dgom-js-bkgdImage" name="dgom-js-bkgdImage" src="<?php echo Yii::app ()->params ['pathBaseImages']."idu_".$photoCalificar->iD->txt_usuario_number.DIRECTORY_SEPARATOR."large_".$photoCalificar->txt_file_name?>">
		</div>
	</section>
	
	<?php $this->endWidget(); ?>
</div>
<?php
/**
 *
 * @todo meterlo al ciclo foreach de los rubros
 */
Yii::app ()->clientScript->registerScript ( 'my vars', '
$(document).ready(function(){

	var heightScreenOriginal = $( window ).height();
	$(".dgom-ui-photo").css("height", heightScreenOriginal);

	$("button").on("click", function(e){
		e.preventDefault();
	});
	
	$("<img/>").on("load", function() {
		
		$(".dgom-ui-loading-juez").css("display","none");
		$("#dgom-js-bkgdImage").css("display","inline-block");

		var imgs = document.getElementById("dgom-js-bkgdImage");
		winDim = getWinDim();

		$("#dgom-js-bkgdImage").css("height", winDim.y);
		
		if (imgs.offsetWidth >= winDim.x)
		{
			$("#dgom-js-bkgdImage").removeAttr( "style" );
			$("#dgom-js-bkgdImage").css("width", winDim.x);
		}
		
	
		// // Obtener medidas de imagen
		// var imgS = document.getElementById("dgom-js-bkgdImage");
		// var realWidth = imgS.clientWidth;
		// var realHeight = imgS.clientHeight;

		// var hScreen = $( window ).height();
		// var wScreen = $( window ).width();

		// alert(realWidth + " - " + realHeight + " : " + hScreen + " : " + wScreen);

		// // Asignando Alto o Ancho a imagen
		// if(realWidth >= realHeight){
		// 	// alert("IF");
		// 	if(realHeight > hScreen){
		// 		// alert("IF IF");
		// 		$("#dgom-js-bkgdImage").css("height", "100vh");
		// 	}
		// 	else{
		// 		// alert("IF ELSE");
		// 		$("#dgom-js-bkgdImage").css("width", "100%");
		// 	}
		// }
		// else if(realHeight > realWidth){
		// 	// alert("ELSE");
		// 	if(realWidth > wScreen){
		// 		// alert("ELSE IF");
		// 		$("#dgom-js-bkgdImage").css("width", "100%");
		// 		$("#dgom-js-bkgdImage").css("height", "100vh");
		// 	}
		// 	else{
		// 		// alert("ELSE ELSE");
		// 		$("#dgom-js-bkgdImage").css("height", "100vh");
		// 	}
		// }

	}).attr("src", $("#dgom-js-bkgdImage").attr("src"));
	// Obtener dimensiones del Screen del dispositivo
	function getWinDim()
	{
	    var body = document.documentElement || document.body;

	    return {
	        x: window.innerWidth  || body.clientWidth,
	        y: window.innerHeight || body.clientHeight
	    }
	}


	// Enviar formulario
	$(".enviar").on("click",function(event){
		event.preventDefault();
		var texto = $("#textareaDefault").val();
		
		if(texto.length>=30){
			$(".btn-load").addClass("btn-load-spinner");
			$("form").submit();
		}else{
			$(".btn-load").addClass("btn-load-spinner");
			$(".alert").css("display", "block");
		}
	});

	// Quitar clase de fondo
	$("body").removeClass("body-page-full");
	
	// Sumas Rangos
	function sumVal(){
		var sum = 0;
		
		$( ".dgom-js-sum" ).each(function( index ) {
  			sum += parseInt( $( this ).val());
		});
		
		console.log(sum);
		$(".knob-chart").val(sum).trigger("change");
	}	
	
	// Coloca el texto de acuerdo a la calificacion	
	function changeTextRange(index, val){
		var instanceText = "";
		
		if(val>=1 && val<=5){
			instanceText = "Below exhibition standards";
		}else if(val>=6 && val<=10){
			instanceText = "Average";
		}else if(val>=11 && val<=15){
			instanceText = "Deserving of recognition";
		}else if(val>=16 && val<=20){
			instanceText = "Excellent";
		}else if(val>=21 && val<=25){
			instanceText = "Exceptional";
		}
		
		$(".as-Range-"+index).text(instanceText);	
	}
	
	// Rango Impact
	$(".asRange-1").asRange({
		namespace: "rangeUi",
		skin: null,
        max: 25,
        min: 1,
		scale: false,
        tip: false,
        step: 1,
        onChange: function(instance) {
	    	$(".js-valRange-1").text(instance);
			$(".dgom-js-calificacion-1").val(instance);
		sumVal();
		changeTextRange(1, instance);
	    },
	});
	
	// Rango Creativity
	$(".asRange-2").asRange({
		namespace: "rangeUi",
		skin: null,
        max: 25,
        min: 1,
		scale: false,
        tip: false,
        step: 1,
        onChange: function(instance) {
	    	$(".js-valRange-2").text(instance);
			$(".dgom-js-calificacion-2").val(instance);
		sumVal();
		changeTextRange(2, instance);
	    },
	});
	
	// Rango Composition
	$(".asRange-3").asRange({
		namespace: "rangeUi",
		skin: null,
        max: 25,
        min: 1,
		scale: false,
        tip: false,
        step: 1,
        onChange: function(instance) {
	    	$(".js-valRange-3").text(instance);
			$(".dgom-js-calificacion-3").val(instance);
		sumVal();
		changeTextRange(3, instance);
	    },
	});
	
	// Rango Technicall Excelence
	$(".asRange-4").asRange({
		namespace: "rangeUi",
		skin: null,
        max: 25,
        min: 1,
		scale: false,
        tip: false,
        step: 1,
        onChange: function(instance) {
	    	$(".js-valRange-4").text(instance);
			$(".dgom-js-calificacion-4").val(instance);
		sumVal();
		changeTextRange(4, instance);
	    },
	});

	//
	addHeight();
	
	// Agregar height a las 3 columnas de Evaluador
	function addHeight(){
		var heightScreen = $( window ).height();
		$(".dgom-ui-evaluador-content").css("height", heightScreen);
		$(".dgom-ui-col-int-right-bg").css("height", heightScreen);
		$(".dgom-ui-col-int-right-text").css("height", heightScreen);
	}

	$(window).on("resize", function(){
		addHeight();
	});
	
	// Click para esconder columnas en FullScreen
	$(".dgom-js-hide-juez").click(function() {
		$(".dgom-js-col-1").hide();
		$(".dgom-ui-full").show();
		$(".dgom-js-evaluador-fullScreen").show();
	});
	
	// Esc para esconder columnas en FullScreen
	$(document).keydown(function(tecla){ 
	    if (tecla.keyCode == 27) { 
	        alert();
	        $(".dgom-js-evaluador-col-1").show();
			$(".dgom-js-evaluador-col-2").show();
			$(".dgom-js-evaluador-fullScreen").hide();
	    } 
	});

	// Click para mostrar columnas en resolución normal
	$(".dgom-js-show-juez").click(function() {
		$(".dgom-js-col-1").show();
		$(".dgom-ui-full").hide();
		$(".dgom-js-evaluador-fullScreen").hide();
		addHeight();
	});

	// Btn para mostar FitScreen
	$(".dgom-js-show-fitScreen").click(function() {
		$(".dgom-js-evaluador-col-1").hide();
		$(".dgom-js-evaluador-col-2").hide();
		$(".dgom-js-evaluador-fullScreen").hide();
		$(".dgom-js-evaluador-fitScreen").show();
		$(".dgom-ui-wrapper-content").addClass("dgom-ui-fullSize");
	});

	// Btn para ocultar FitScreen
	$(".dgom-js-hidden-fitScreen").click(function() {
		$(".dgom-js-evaluador-col-1").hide();
		$(".dgom-js-evaluador-col-2").hide();
		$(".dgom-js-evaluador-fullScreen").show();
		$(".dgom-js-evaluador-fitScreen").hide();
		$(".dgom-ui-wrapper-content").removeClass("dgom-ui-fullSize");
	});

	// TextArea para validar 500 caracteres
	$("#textareaDefault").keyup(function () {
      var max = 500;
      var len = $(this).val().length;

      if (len >= max) {
        $("#dgom-func-TxtAreaCharCounter-count").text(max + " is the maximun allowed.");
        $("#dgom-func-TxtAreaCharCounter-count").css("color","#EF4836");
      } else {
        var char = max - len;
        $("#dgom-func-TxtAreaCharCounter-count").text(char + " chars left");
        $("#dgom-func-TxtAreaCharCounter-count").css("color","#FFF");
      }
    });

	// Loading button de Next Photo
	$("#dgom-js-next-photo").click(function(e){
	 	var l = Ladda.create(this);
	 	var valTextArea = $("textarea").val();
	 	if(valTextArea.length>30){
	 		$(this).prop("disabled", true);
	 		l.start();
	 	}else{
	 		e.preventDefault();
	 		// Deshabilitar boton
			$("#dgom-js-next-photo").prop("disabled", true);
			// Mostar animación y agregar mensaje
			$(".dgom-ui-pintarFoto-next-message").animate({ "bottom": "80px" }, 600 );
			// $(".dgom-ui-pintarFoto-next-message").html("Para continuar, debes calificar la FOTO.");
			// Ocultar message de error - next foto
			setTimeout(hideMessageNext, 3800);
		}
	 	
	});

	function hideMessageNext() {
		$(".dgom-ui-pintarFoto-next-message").animate({ "bottom": "-100px" }, 600 );
		$("#dgom-js-next-photo").prop("disabled", false);
		$(".dgom-ui-pintarFoto-next-message").removeAttr("style");
	}


	var panelSelect = false;
	// View Colums (Left-Right)
	$("#dgom-js-pintar-photo-wrap-panel-score").on("click",function(){
		// alert(panelSelect);

		if(!panelSelect){
			// Mask
			$(".dgom-ui-pintar-photo-wrap").addClass("dgom-ui-pintar-photo-wrap-mask");
			// Cambio de texto
			$(this).html("Hide Review");
			// Mostrar Paneles
			$(".dgom-ui-pintar-photo-wrap-panel-score").addClass("dgom-ui-pintar-photo-wrap-panel-score-view");
			$(".dgom-ui-pintar-photo-wrap-panel-notes").addClass("dgom-ui-pintar-photo-wrap-panel-notes-view");
			// Boton next
			$(".dgom-ui-pintarFoto-next").addClass("dgom-ui-pintarFoto-next-view");
			panelSelect = true;
		}
		else{
			// Mask
			$(".dgom-ui-pintar-photo-wrap").removeClass("dgom-ui-pintar-photo-wrap-mask");
			// Cambio de texto
			$(this).html("Begin Review");
			// Ocultar Paneles
			$(".dgom-ui-pintar-photo-wrap-panel-score").removeClass("dgom-ui-pintar-photo-wrap-panel-score-view");
			$(".dgom-ui-pintar-photo-wrap-panel-notes").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-view");
			// Boton next
			$(".dgom-ui-pintarFoto-next").removeClass("dgom-ui-pintarFoto-next-view");
			panelSelect = false;

			// Ocultar message de error - next foto
			setTimeout(hideMessageNext, 0);
		}
	});

	setTimeout(showReviewBtn, 2000);

	function showReviewBtn() {
		$("#dgom-js-pintar-photo-wrap-panel-score").addClass("dgom-ui-Btn-photoReview-on");
	}
	

	// Textarea
	var textarea = document.querySelector("textarea");
	
	// Click y empezar a grabar
	$("#dgom-js-recording").on("click",function(){
		
		$(".dgom-ui-pintar-photo-wrap-panel-notes").addClass("dgom-ui-pintar-photo-wrap-panel-notes-textarea");
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-dictation").hide();

		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea").show();
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording").show();
		setTimeout(zoomRecording, 400);
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording").show();
		
		$("#dgom-ui-pintar-photo-message-navegador").hide();
		// $("#dgom-ui-pintar-photo-message-hablar-fuerte").show();
		$("#dgom-ui-pintar-photo-message-hablar-fuerte").css("display", "inline-block");

		startButton();
		siri.start();
		// textarea.addEventListener("keydown", autosize);

		// Mask
		$(".dgom-ui-pintar-photo-wrap").removeClass("dgom-ui-pintar-photo-wrap-mask");
		// Cambio de texto
		$("#dgom-js-pintar-photo-wrap-panel-score").html("Begin Review");
		// Ocultar Paneles
		$(".dgom-ui-pintar-photo-wrap-panel-score").removeClass("dgom-ui-pintar-photo-wrap-panel-score-view");
		$(".dgom-ui-pintar-photo-wrap-panel-notes").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-view");
		// Boton next
		$(".dgom-ui-pintarFoto-next").removeClass("dgom-ui-pintarFoto-next-view");
		panelSelect = false;
		
		// Ocultar message de error - next foto
		setTimeout(hideMessageNext, 0);

	});
	
	// Anim Zoom Recording
	function zoomRecording() {
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording").addClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording-zoom");
	}
	

	// Textarea Height Auto
	// function autosize(){
	// 	var el = this;
	// 	setTimeout(function(){
	// 		el.style.cssText = "height:auto; padding:0";
	// 		// for box-sizing other than "content-box" use:
	// 		// el.style.cssText = "-moz-box-sizing:content-box";
	// 		el.style.cssText = "height: calc(" + el.scrollHeight + "px - 200px";
	// 	},0);
	// }

	var siri = new SiriWave9({
	 width:300,
	  height: 80,
	  speed: 0.2,
	  container: document.getElementById("siri-container"),
	  autostart: false,
	  frequency:0,
	});

	var recognizing = false;
	
	
	if (!("webkitSpeechRecognition" in window)) {
	    //Speech API not supported here…
	} else { //Let’s do some cool stuff :)
	    var recognition = new webkitSpeechRecognition(); //That is the object that will manage our whole recognition process. 
	    recognition.continuous = true;   //Suitable for dictation. 
	    recognition.interimResults = true;  //If we want to start receiving results even if they are not final.
	    //Define some more additional parameters for the recognition:
	    //recognition.lang = "es-MX"; 
	    recognition.lang = "'.Yii::app()->user->juezLogueado->txt_lenguaje.'";
	    recognition.maxAlternatives = 1; //Since from our experience, the highest result is really the best...
	}
	
	recognition.onstart = function() {
		recognizing = true;
		
	    //Listening (capturing voice from audio input) started.
	    //This is a good place to give the user visual feedback about that (i.e. flash a red light, etc.)
	};
	
	recognition.onend = function() {
		
		console.log("stop");
		 var texto = $("#textareaDefault").val();
		 
		 $("#textareaDefault").val(texto+"\n");
		 
		recognizing = false;
		 //start_img.src = "https://speechlogger.appspot.com/images/micoff2.png"; 
	    //Again – give the user feedback that you are not listening anymore. If you wish to achieve continuous recognition – you can write a script to start the recognizer again here.
	};
	
	recognition.onresult = function(event) { //the event holds the results
	//Yay – we have results! Let’s check if they are defined and if final or not:
		
	    if (typeof(event.results) === "undefined") { //Something is wrong…
	    	
	        recognition.stop();
	        return;
	    }
	
	    var texto = $("#textareaDefault").val();
	
	    for (var i = event.resultIndex; i < event.results.length; ++i) {      
	        if (event.results[i].isFinal) { //Final results
	        	
	            texto+= event.results[i][0].transcript;
	
	             $("#textareaDefault").val(texto);
	             
	             
	            console.log("final results: " + event.results[i][0].transcript);   //Of course – here is the place to do useful things with the results.
	        } else { 
	
	              //i.e. interim...
	            console.log("interim results: " + event.results[i][0].transcript);  //You can use these results to give the user near real time experience.
	        } 
	    } //end for loop
	}; 
	
	
	function startButton() {
		
	    recognition.start();
	    
	}

	// Validar TEXTAREA
	$("#textareaDefault").on("keyup",function(e){ 
		var textoTextArea = $(this).val().length;
		if(textoTextArea >= 2500) {
			
			notWriteMore();
			var limitChar = $(this).val(); 
			textoTextArea = limitChar.substring(0,2500);
			$(this).val(textoTextArea);
		e.preventDefault();
		}
		else if(textoTextArea < 2500) {
			writeMore();
		}
		
		$(".contadorCaracteres").text($(this).val().length);
		return false;
	});
		
	function notWriteMore(){
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record").show();
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record").animate({ "bottom": "6%" }, 600 );
		
		$(".dgom-js-pintar-photo-wrap-panel-notes-begin-feedback-record-new").show();
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-limited").show();
		
			$(".dgom-ui-pintarFoto-next-view").addClass("dgom-ui-pintarFoto-next-view-finish");
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording").hide();
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording-zoom");
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea-on");
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-limited").addClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-error");
		 	recognition.stop();
			// alert("IF");
			return false;
	}	
		
	function writeMore(){
		
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record").show();
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record").animate({ "bottom": "6%" }, 600 );

			$(".dgom-js-pintar-photo-wrap-panel-notes-begin-feedback-record-new").hide();
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-limited").show();
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-new").css("display", "inline-block");

			$(".dgom-ui-pintarFoto-next-view").removeClass("dgom-ui-pintarFoto-next-view-finish");
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea-on");
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-limited").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-error");
			// alert("ELSE");
			return false;
	
	}	

	// Click para volver a grabar
	$(".dgom-js-pintar-photo-wrap-panel-notes-begin-feedback-record-new").on("click",function(){
		
		// $(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record").show();
		// $(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record").removeAttr("style");

		$(".dgom-js-pintar-photo-wrap-panel-notes-begin-feedback-record-new").hide();
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-limited").show();

		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording").show();
		setTimeout(zoomRecording, 600);
		// $(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording").animate({ "top": "50%" }, 600 );
		$(".dgom-ui-pintarFoto-next-view").removeClass("dgom-ui-pintarFoto-next-view-finish");

		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea").addClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea-on");
		startButton();

		// Mask
		$(".dgom-ui-pintar-photo-wrap").removeClass("dgom-ui-pintar-photo-wrap-mask");
		// Cambio de texto
		$("#dgom-js-pintar-photo-wrap-panel-score").html("Begin Review");
		// Ocultar Paneles
		$(".dgom-ui-pintar-photo-wrap-panel-score").removeClass("dgom-ui-pintar-photo-wrap-panel-score-view");
		$(".dgom-ui-pintar-photo-wrap-panel-notes").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-view");
		// Boton next
		$(".dgom-ui-pintarFoto-next").removeClass("dgom-ui-pintarFoto-next-view");
		panelSelect = false;

		// Ocultar message de error - next foto
		setTimeout(hideMessageNext, 0);

	});

	// Click stop grabación
	$(".dgom-js-pintar-photo-wrap-panel-notes-begin-feedback-recording-p-stop").on("click",function(){
		
		recognition.stop();

		if($("#textareaDefault").val().length<1){
		
			// alert("volver a poner el recoding inicial");
			$(".dgom-ui-pintar-photo-wrap-panel-notes").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-textarea");
			// $(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-dictation").show();
			$("#dgom-ui-pintar-photo-message-navegador").show();
			setTimeout(showTimeDictation, 700);
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea").hide();
			
			$(".dgom-js-pintar-photo-wrap-panel-notes-begin-feedback-record-new").hide();
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-limited").hide();
		//alert("IF");
		}
		else{
			//alert("ELSE");
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea-on");
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record").show();
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record").animate({ "bottom": "6%" }, 600 );
			
			$(".dgom-js-pintar-photo-wrap-panel-notes-begin-feedback-record-new").show();
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-limited").show();
			
			

		}
		// Mask
		$(".dgom-ui-pintar-photo-wrap").addClass("dgom-ui-pintar-photo-wrap-mask");
		// Cambio de texto
		$("#dgom-js-pintar-photo-wrap-panel-score").html("Hide Review");
		// Mostrar Paneles
		$(".dgom-ui-pintar-photo-wrap-panel-score").addClass("dgom-ui-pintar-photo-wrap-panel-score-view");
		$(".dgom-ui-pintar-photo-wrap-panel-notes").addClass("dgom-ui-pintar-photo-wrap-panel-notes-view");
		// Boton next
		$(".dgom-ui-pintarFoto-next").addClass("dgom-ui-pintarFoto-next-view");
		panelSelect = true;

		// Animacion-Hide a Recording
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording-zoom");
		setTimeout(hideRecording, 400);

	});

	// Hide Recording
	function hideRecording() {
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording").hide();
	}

	// Show Time Dictation
	function showTimeDictation() {
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-dictation").show();
	}

});

', CClientScript::POS_END );

?>

<script src="<?=Yii::app()->request->baseUrl?>/plugins/siriwave/siriwave9.js"></script>

<script>

// Idioma
var langs =
[['Afrikaans',       ['af-ZA']],
 ['Bahasa Indonesia',['id-ID']],
 ['Bahasa Melayu',   ['ms-MY']],
 ['Català',          ['ca-ES']],
 ['Čeština',         ['cs-CZ']],
 ['Dansk',           ['da-DK']],
 ['Deutsch',         ['de-DE']],
 ['English',         ['en-AU', 'Australia'],
                     ['en-CA', 'Canada'],
                     ['en-IN', 'India'],
                     ['en-NZ', 'New Zealand'],
                     ['en-ZA', 'South Africa'],
                     ['en-GB', 'United Kingdom'],
                     ['en-US', 'United States']],
 ['Español',         ['es-AR', 'Argentina'],
                     ['es-BO', 'Bolivia'],
                     ['es-CL', 'Chile'],
                     ['es-CO', 'Colombia'],
                     ['es-CR', 'Costa Rica'],
                     ['es-EC', 'Ecuador'],
                     ['es-SV', 'El Salvador'],
                     ['es-ES', 'España'],
                     ['es-US', 'Estados Unidos'],
                     ['es-GT', 'Guatemala'],
                     ['es-HN', 'Honduras'],
                     ['es-MX', 'México'],
                     ['es-NI', 'Nicaragua'],
                     ['es-PA', 'Panamá'],
                     ['es-PY', 'Paraguay'],
                     ['es-PE', 'Perú'],
                     ['es-PR', 'Puerto Rico'],
                     ['es-DO', 'República Dominicana'],
                     ['es-UY', 'Uruguay'],
                     ['es-VE', 'Venezuela']],
 ['Euskara',         ['eu-ES']],
 ['Filipino',        ['fil-PH']],
 ['Français',        ['fr-FR']],
 ['Galego',          ['gl-ES']],
 ['Hrvatski',        ['hr_HR']],
 ['IsiZulu',         ['zu-ZA']],
 ['Íslenska',        ['is-IS']],
 ['Italiano',        ['it-IT', 'Italia'],
                     ['it-CH', 'Svizzera']],
 ['Lietuvių',        ['lt-LT']],
 ['Magyar',          ['hu-HU']],
 ['Nederlands',      ['nl-NL']],
 ['Norsk bokmål',    ['nb-NO']],
 ['Polski',          ['pl-PL']],
 ['Português',       ['pt-BR', 'Brasil'],
                     ['pt-PT', 'Portugal']],
 ['Română',          ['ro-RO']],
 ['Slovenščina',     ['sl-SI']],
 ['Slovenčina',      ['sk-SK']],
 ['Suomi',           ['fi-FI']],
 ['Svenska',         ['sv-SE']],
 ['Tiếng Việt',      ['vi-VN']],
 ['Türkçe',          ['tr-TR']],
 ['Ελληνικά',        ['el-GR']],
 ['български',       ['bg-BG']],
 ['Pусский',         ['ru-RU']],
 ['Српски',          ['sr-RS']],
 ['Українська',      ['uk-UA']],
 ['한국어',            ['ko-KR']],
 ['中文',             ['cmn-Hans-CN', '普通话 (中国大陆)'],
                     ['cmn-Hans-HK', '普通话 (香港)'],
                     ['cmn-Hant-TW', '中文 (台灣)'],
                     ['yue-Hant-HK', '粵語 (香港)']],
 ['日本語',           ['ja-JP']],
 ['हिन्दी',            ['hi-IN']],
 ['ภาษาไทย',         ['th-TH']]];



</script>