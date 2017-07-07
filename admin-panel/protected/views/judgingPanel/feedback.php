<?php
$this->title = Yii::t ( 'site', 'Photo Judging - Photo Review' );
?>
<div id="page" class="photo-page">
			<?php
			$form = $this->beginWidget ( 'CActiveForm', array (
					'id' => 'calificar-foto-form',
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
		<?= CHtml::link(Yii::t('photoReview', 'return'),array('judgingPanel/index',"t"=>$t), array("class"=>"dgom-ui-Btn dgom-ui-a")); ?>
		<!-- dgom-js-beginReview -->
<!-- 
		<button id="dgom-js-pintar-photo-wrap-panel-view-score"
			class="dgom-ui-Btn dgom-ui-Btn-photoReview ladda-button"
			data-style="zoom-out">
			<span class="ladda-label"><?#Yii::t('photoReview', 'finished')?></span>
		</button>
		 -->
		<button type="submit"
			class="btn btn-primary enviar ladda-button dgom-ui-Btn dgom-ui-Btn-photoReview ladda-button dgom-js-next-photo-btns"
			id="dgom-js-next-photo" data-style="zoom-out">
			<span class="ladda-label"><?=Yii::t('photoReview','finished');?></span>
		</button>
	</div>
	<section
		class="dgom-ui-pintar-photo-wrap dgom-ui-pintar-photo-wrap-feedback">

		<div
			class="dgom-ui-pintar-photo-wrap-panel2 dgom-ui-pintar-photo-wrap-panel-photo">
			<img
				src="<?php echo Yii::app ()->params ['pathBaseImages']."idu_".$photoCalificar->iD->txt_usuario_number.DIRECTORY_SEPARATOR."medium_".$photoCalificar->txt_file_name?>"
				alt="" id="dgom-ui-pintar-photo-wrap-panel2-image">
		</div>


		<div
			class="dgom-ui-pintar-photo-wrap-panel dgom-ui-pintar-photo-wrap-panel-notes">


			<!-- Message -->
			<div class="dgom-ui-pintar-photo-wrap-panel-notes-message">
				<!-- Necesitas un Navegador (Chrome 33+ o Firefox 44+)-->
				<div class="dgom-ui-pintar-photo-wrap-panel-notes-message-navegador"
					id="dgom-ui-pintar-photo-message-navegador">
					<?=Yii::t('photoReview','tip1')?>
				</div>
			</div>

			<!-- Habla FUERTE -->
			<div style="text-align: center;">
				<div class="dgom-ui-pintar-photo-wrap-panel-notes-message-hablar-fuerte" id="dgom-ui-pintar-photo-message-hablar-fuerte">
					<?=Yii::t('photoReview','tip2')?>
				</div>

				<div class="dgom-ui-pintar-photo-wrap-panel-notes-message-hablar-fuerte" id="dgom-ui-pintar-photo-message-hablar-no-se-entiende">
					<?=Yii::t('photoReview','tip3')?>
				</div>

			</div>

			<!-- Textarea -->
			<div
				class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea-on textFeedback">
				<?php echo CHtml::textArea("txt_retro", "",array("class"=>"form-control form-transpent","id"=>"textareaDefault",  "pattern"=>".{1,500}", "title"=>"Enter Feedback here... 30chars minimun", "placeholder"=>""))?>
				<div class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea-preview">
					<span id="textoOriginal" style="display: none;"></span>
					<span style="display: none;" id="textoProvicional"></span>
				</div>
			</div>


			<!-- Recording -->
			<div
				class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording">
				<div
					class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording-int">

				</div>

			</div>

			<!-- Record -->
			<div
				class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record">
				<!-- <div class="dgom-js-pintar-photo-wrap-panel-notes-begin-feedback-record-new">
					<div class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-icon"></div>
					<p><?php # echo Yii::t('photoReview','grabar')?></p>
				</div> -->
				<p
					class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-limited">
					<label class="contadorCaracteres">0</label>/2500 <?Yii::t('photoReview', 'charsMax')?></p>
			</div>

		</div>

		<!-- Button -->
		<div class="row">
			<div
				class="col-lg-12 col-sm-12 form-group padding-vertical-15 text-center">
				<button type="submit"
					class="btn btn-primary enviar ladda-button dgom-ui-pintarFoto-next dgom-ui-pintarFoto-next-feedback dgom-js-next-photo-btns"
					id="dgom-js-next-photo" data-style="zoom-out">
					<span class="ladda-label"><?=Yii::t('photoReview','scoreNextPhoto');?></span>
				</button>
				<!-- .dgom-ui-pintarFoto-next-message -->
				<div
					class="dgom-ui-pintarFoto-next-message dgom-ui-pintarFoto-next-message-alert">
					<?=Yii::t('photoReview','messageNextPintarFoto');?>
				</div>
				<!-- end / .dgom-ui-pintarFoto-next-message -->
			</div>
		</div>

		<div class="row dgom-ui-alert-invalid alert margin-right-20"
			style="display: none;"><?=Yii::t('photoReview','minimunText')?></div>

	</section>


	<!-- Dictation -->
	<div
		class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-dictation">
		<!-- Begin -->
		<div
			class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-dictation-icon">
			<div id="dgom-js-recording"
				class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-dictation-icon-star"></div>
			<div
				class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-dictation-icon-stop dgom-js-pintar-photo-wrap-panel-notes-begin-feedback-recording-p-stop"></div>
		</div>
		<!-- dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-dictation-icon  -  dgom-js-pintar-photo-wrap-panel-notes-begin-feedback-recording-p-stop -->
		<!-- <p><?php # echo Yii::t('photoReview','iniciarDictado')?></p> -->

		<div
			class="dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording-graphic">
			<div id="siri-container" style="width: 100%;"></div>
		</div>

	</div>

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

	// alert(heightScreenOriginal);
	
	// Si es Safari, usar height por pixeles
	var ua = navigator.userAgent.toLowerCase(); 
	if (ua.indexOf("safari") != -1) { 
	  if (ua.indexOf("chrome") > -1) {
	    // console.log("chrome");
	  } else {
	  	// console.log("safari");
	    $(".dgom-ui-pintar-photo-wrap").css("height", heightScreenOriginal);
		$(".dgom-ui-pintar-photo-wrap-panel").css("height", heightScreenOriginal - 140);
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea textarea").css("height", heightScreenOriginal - 220);
	  }
	}

	$("button").on("click", function(e){
		e.preventDefault();
	});
	
	$("<img/>").on("load", function() {
		var imgs = document.getElementById("dgom-ui-pintar-photo-wrap-panel2-image");
		var width = imgs.clientWidth;
		var height = imgs.clientHeight;
		if(width >= height){
			$("#dgom-ui-pintar-photo-wrap-panel2-image").css("width", "100%");
		}
		// } else{
		// 	$("#dgom-ui-pintar-photo-wrap-panel2-image").css("maxHeight", "100%");
		// }
	}).attr("src", $("#dgom-ui-pintar-photo-wrap-panel2-image").attr("src"));

	// Obtener dimensiones del Screen del dispositivo
	function getWinDim()
	{
		alert("Fun");
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
	
	// Loading button de Next Photo
	$(".dgom-js-next-photo-btns").click(function(e){
	 	var l = Ladda.create(this);
	 	var valTextArea = $("textarea").val();
		
		var textMessage = "";
		
	 	if(valTextArea.length>30){
	 		$(this).prop("disabled", true);
	 		l.start();
		
			return false;
	 	}else if(valTextArea.length==0){
	 		textMessage = "'.Yii::t('photoReview','messageNextPintarFoto').'";
		}else{
			textMessage = "'.Yii::t('photoReview','minimunText').'";
		}
		
		e.preventDefault();
	 		// Deshabilitar boton
			$(".dgom-js-next-photo-btns").prop("disabled", true);
		
			$(".dgom-ui-pintarFoto-next-message").text(textMessage);
		
			// Mostar animación y agregar mensaje
			$(".dgom-ui-pintarFoto-next-message").animate({ "bottom": "80px" }, 600 );
			// $(".dgom-ui-pintarFoto-next-message").html("Para continuar, debes calificar la FOTO.");
			// Ocultar message de error - next foto
			setTimeout(hideMessageNext, 3800);
	 	
	});

	function hideMessageNext() {
		$(".dgom-ui-pintarFoto-next-message").animate({ "bottom": "-100px" }, 600 );
		$(".dgom-js-next-photo-btns").prop("disabled", false);
		$(".dgom-ui-pintarFoto-next-message").removeAttr("style");
	}

	// View Score
	$("#dgom-js-pintar-photo-wrap-panel-view-score").on("click",function(){
		var url = "'.Yii::app()->createUrl("judgingPanel/viewScorePhoto", array('idPic'=>$photoCalificar->txt_pic_number, 'idCategoria'=>$idCategoria, 't'=>$t)).'";
		var l = Ladda.create(this);
	 	$(this).prop("disabled", true);
	 	l.start();
	 	$(location).attr("href", url);
	});

	setTimeout(showReviewBtn, 2000);

	function showReviewBtn() {
		$(".dgom-ui-loading-juez").css("display","none");
		$("#dgom-js-next-photo").addClass("dgom-ui-Btn-photoReview-on");
	}
	

	// Textarea
	var textarea = document.querySelector("textarea");
	
	// Click y empezar a grabar
	$("#dgom-js-recording").on("click",function(){

		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-dictation-icon-star").hide();
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-dictation-icon-stop").show();
		$(".dgom-ui-pintar-photo-wrap-panel-notes").addClass("dgom-ui-pintar-photo-wrap-panel-notes-textarea");
		// $(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-dictation").hide();

		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea").show();
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording").show();
		setTimeout(zoomRecording, 400);
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording").show();
		
		$("#dgom-ui-pintar-photo-message-navegador").hide();
		$("#dgom-ui-pintar-photo-message-hablar-fuerte").show();
		$("#dgom-ui-pintar-photo-message-hablar-fuerte").css("display", "inline-block");
		
		// Mostrar grafica, que se está grabando el audio
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording-graphic").addClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording-graphic-active");
		startButton();
		siri.start();
		// textarea.addEventListener("keydown", autosize);
		
		// Ocultar message de error - next foto
		setTimeout(hideMessageNext, 0);

	});
	
	// Anim Zoom Recording
	function zoomRecording() {
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording").addClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording-zoom");
	}
	

	var siri = new SiriWave9({
	 width:300,
	  height: 50,
	  speed: 0.2,
	  container: document.getElementById("siri-container"),
	  autostart: false,
	  frequency:0,
	});

	var recognizing = false;
	
	
	if (!("webkitSpeechRecognition" in window)) {
		
		// alert("No compatible");
		
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea").show();

		$("#dgom-ui-pintar-photo-message-navegador").show();
		$("#dgom-ui-pintar-photo-message-navegador").css("display", "inline-block");

		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record").show();
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record").animate({ "bottom": "6%" }, 600 );

		$(".dgom-js-pintar-photo-wrap-panel-notes-begin-feedback-record-new").show();
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-limited").show();

	    //Speech API not supported here…
	} else { //Let’s do some cool stuff :)
	    var recognition = new webkitSpeechRecognition(); //That is the object that will manage our whole recognition process. 
	    recognition.continuous = true;   //Suitable for dictation. 
	    recognition.interimResults = true;  //If we want to start receiving results even if they are not final.
	    //Define some more additional parameters for the recognition:
	    //recognition.lang = "es-MX"; 
	    recognition.lang = "' . Yii::app ()->user->juezLogueado->txt_lenguaje . '";
	    recognition.maxAlternatives = 1; //Since from our experience, the highest result is really the best...
	}
	
	recognition.onstart = function() {
		recognizing = true;
		
	    //Listening (capturing voice from audio input) started.
	    //This is a good place to give the user visual feedback about that (i.e. flash a red light, etc.)
	};
	recognition.onerror = function(event) { 

		// alert("No se entiende");

		$("#dgom-ui-pintar-photo-message-hablar-no-se-entiende").show();
		$("#dgom-ui-pintar-photo-message-hablar-no-se-entiende").css("display", "inline-block");

		console.log("Error");
	}
	
	recognition.onaudiostart = function(event) { 
		console.log("inicio de audio");
	}
		
	recognition.onsoundstart = function(event) { 
		console.log("inicio de sonido");
	}
		
	recognition.onspeechstart = function(event) { 
		console.log("innicio de habla");
	}
		
	recognition.onspeechend = function(event) { 
		console.log("fin de habla");
	}
		
	recognition.onsoundend = function(event) { 
		console.log("fin de sonido");
	}	
		
	recognition.onaudioend = function(event) { 
		console.log("Fin de audio");
	}	
	
	recognition.onnomatch = function(event) { 
		console.log("No hay comparacion");
	}	
		
		
	 var textoProvicional = $("#textoProvicional");
		var textoOriginal = $("#textoOriginal");
		var textAreaView = $("#textareaDefault");		
		
	recognition.onend = function() {
		textoProvicional.text("");
		
		siri.stop();
		
		console.log("stop");
		 var texto = $("#textareaDefault").val();
		 
		 $("#textareaDefault").val(texto+"\n");
		 
		recognizing = false;
		 if($("#textareaDefault").val().length<1){
		
			// alert("volver a poner el recoding inicial");
			$(".dgom-ui-pintar-photo-wrap-panel-notes").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-textarea");
			// $(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-dictation").show();
			$("#dgom-ui-pintar-photo-message-navegador").show();
			// setTimeout(showTimeDictation, 700);
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea").hide();
			
			// $(".dgom-js-pintar-photo-wrap-panel-notes-begin-feedback-record-new").hide();
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-limited").hide();

			// Ocultar message de error - next foto
			setTimeout(hideMessageNext, 0);
			
			//alert("IF");
		}
		else{
			//alert("ELSE");
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea-on");
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record").show();
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record").animate({ "bottom": "6%" }, 600 );
			
			// $(".dgom-js-pintar-photo-wrap-panel-notes-begin-feedback-record-new").show();
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-limited").show();
			
			// Ocultar message de error - next foto
			setTimeout(hideMessageNext, 0);

		}
		
		// alert("YA");
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-dictation-icon-star").show();
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-dictation-icon-stop").hide();
		$("#dgom-ui-pintar-photo-message-hablar-fuerte").hide();
		$("#dgom-ui-pintar-photo-message-navegador").hide();
		$("#dgom-ui-pintar-photo-message-hablar-no-se-entiende").hide();

		// $(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording-graphic").css("overflow", "hidden");

		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording-graphic").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording-graphic-active");

		// Animacion-Hide a Recording
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording-zoom");
		setTimeout(hideRecording, 400);
	    //Again – give the user feedback that you are not listening anymore. If you wish to achieve continuous recognition – you can write a script to start the recognizer again here.
	    textAreaView.show();
	    $(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea-preview").hide();
		$(".textFeedback span").hide();
	};
	
	recognition.onresult = function(event) {
	//the event holds the results
	//Yay – we have results! Let’s check if they are defined and if final or not:
		
	    if (typeof(event.results) === "undefined") { //Something is wrong…
	    	console.log(event);
		
	        recognition.stop();
	        return;
	    }
	    for (var i = event.resultIndex; i < event.results.length; ++i) {      
	        if (event.results[i].isFinal) { //Final results
	        	textoOriginal.text(textoOriginal.text()+event.results[i][0].transcript+"\n");
				 textAreaView.val(textoOriginal.text()+"\n");
				textoProvicional.text("");
		
	             contadorValidacionCaracteres($("#textareaDefault"));
	             
	            console.log("final results: " + event.results[i][0].transcript);   //Of course – here is the place to do useful things with the results.
	        } else {
				 textoProvicional.text(event.results[i][0].transcript);
		
				 textAreaView.val(textoOriginal.text()+textoProvicional.text());

	              //i.e. interim...
	            console.log("interim results: " + event.results[i][0].transcript);  //You can use these results to give the user near real time experience.
	        } 
	    } //end for loop
	}; 
	
	
	function startButton() {
		textAreaView.hide();
	    recognition.start();
	    $(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea-preview").show();
	    $(".textFeedback span").show();
		// $(".textFeedback #textoProvicional").css("opacity","0.5");
	}
		
	// TextArea para validar 500 caracteres
	$("#textareaDefault").keyup(function () {
		validarTextAreaFeedBack($(this));
		
		$("#textoOriginal").text($(this).val()+" ");
		
    });
		
	//Función para validar el textArea		
	function validarTextAreaFeedBack(elemento){
	  var max = 2500;
      var len = elemento.val().length;

      if (len >= max) {
        $("#dgom-func-TxtAreaCharCounter-count").text(max + " is the maximun allowed.");
        $("#dgom-func-TxtAreaCharCounter-count").css("color","#EF4836");
      } else {
        var char = max - len;
        $("#dgom-func-TxtAreaCharCounter-count").text(char + " chars left");
        $("#dgom-func-TxtAreaCharCounter-count").css("color","#FFF");
      }
	
	} 	
		

	// Validar TEXTAREA
	$("#textareaDefault").on("keyup",function(e){ 
		contadorValidacionCaracteres($(this));
		
	});
		
	function contadorValidacionCaracteres(elemento){
		var textoTextArea = elemento.val().length;
		
		if(textoTextArea >= 2500) {
			
			notWriteMore();
			var limitChar = elemento.val(); 
			textoTextArea = limitChar.substring(0,2500);
			elemento.val(textoTextArea);
		
		}
		else if(textoTextArea < 2500) {
			writeMore();
		}
		
		$(".contadorCaracteres").text(elemento.val().length);
		return false;
	} 
		
	function notWriteMore(){
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record").show();
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record").animate({ "bottom": "6%" }, 600 );
		
		// $(".dgom-js-pintar-photo-wrap-panel-notes-begin-feedback-record-new").show();
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-limited").show();
		//alert();
			$(".dgom-ui-pintarFoto-next-view").addClass("dgom-ui-pintarFoto-next-view-finish");
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording").hide();
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-recording-zoom");
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea-on");
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-limited").addClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-error");
		 	recognition.stop();
			 
			return false;
	}	
		
	function writeMore(){
		
		$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record").show();
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record").animate({ "bottom": "6%" }, 600 );

			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-limited").show();
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-new").css("display", "inline-block");

			$(".dgom-ui-pintarFoto-next-view").removeClass("dgom-ui-pintarFoto-next-view-finish");
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-textarea-on");
			$(".dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-limited").removeClass("dgom-ui-pintar-photo-wrap-panel-notes-begin-feedback-record-error");
			
			return false;
	
	}	


	// Click stop grabación
	$(".dgom-js-pintar-photo-wrap-panel-notes-begin-feedback-recording-p-stop").on("click",function(){
		
		recognition.stop();
		

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

<script
	src="<?=Yii::app()->request->baseUrl?>/plugins/siriwave/siriwave9.js"></script>

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