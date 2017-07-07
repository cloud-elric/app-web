<?php
/**
 * @var WpUsers $competidor
 */
 
$this->title = Yii::t('site','titleCompetitors');
?>
<div class="container">
	<div class="row">
		<div class="col-md-12 padding-0">
			<h2 class="title-section-competitors">
				<?=Yii::t('site','competitors');?> <span><?=Yii::t('competitors','titleTotal');?> <?=$competidores->totalItemCount;?></span>
			</h2>
		</div>
	</div>
</div>

<!-- .dgom-ui-competitors -->
<div class="dgom-ui-competitors">

	<div class="row">
		<div class="col-md-6">

			<!-- .dgom-ui-competitors-search -->
			<div class="dgom-ui-competitors-search">
				<?php
				echo CHtml::beginForm ( CHtml::normalizeUrl ( array (
						'adminPanel/competitors' 
				) ), 'get', array (
						'id' => 'filter-form' 
				) );
				?>
				<div class="dgom-ui-competitors-search-line">
					<i class="dgom-ui-competitors-search-icon wb-search"
						aria-hidden="true"></i>
					<?php
					
echo CHtml::textField ( 'string', (isset ( $_GET ['string'] )) ? $_GET ['string'] : '', array (
							'id' => 'string',
							'placeholder' => Yii::t('competitors', 'inputSearch') 
					) ) . CHtml::submitButton ( 'Search', array (
							'name' => '',
							'class' => 'dgom-ui-competitors-search-button',
							'id' => 'buttonSearch' 
					) ) . CHtml::endForm ();
					?>
				</div>
			</div>
			<!-- end / .dgom-ui-competitors-search -->
		</div>
		<div class="col-md-6 dgom-ui-competitors-search-radio">

			<!-- <div class="radio-style">
				<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
				<label for="optionsRadios1">Csv</label>
				<div class="check"></div>
			</div>

			<div class="radio-style">
				<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
				<label for="optionsRadios2">Csv+Fotos</label>
				<div class="check"></div>
			</div> -->

			<?php
			echo CHtml::beginForm ( "", 'get', array (
					'id' => 'file-form' 
			) ) . '

				<div class="radio-style">' . CHtml::radioButton ( 'file', '', array (
					'id' => 'csv' 
			) ) . CHtml::label ( Yii::t('competitors','exportarRadioCsv'), 'csv' ) . ' <div class="check"></div>
				</div> ' . '
				<div class="radio-style">' . CHtml::radioButton ( 'file', '', array (
					'id' => 'zip' 
			) ) . CHtml::label ( Yii::t('competitors','exportarRadioCsvFotos'), 'zip' ) . ' <div class="check"></div>
				</div>
				<div class="radio-style">' . CHtml::radioButton ( 'file', '', array (
					'id' => 'zipResolution' 
			) ) . CHtml::label ( Yii::t('competitors','exportarRadioCsvRaw'), 'zipResolution' ) . ' <div class="check"></div>
				</div>
				<button type="submit" id="descargarArchivo" class="btn btn-cv ladda-button dgom-ui-competitors-search-download" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-download" aria-hidden="true"></i> '.Yii::t('competitors','exportarBtn').'</span></button>'
				/*. 
				CHtml::submitButton ( 'Exportar', array (
					"id" => "descargarArchivo",
					"encode" => false,
					"class"=>"btn btn-cv ladda-button dgom-ui-competitors-search-download",
					"data-style"=>"zoom-in"
				) )*/
				. CHtml::endForm ();
			?>

		</div>

	</div>

	<!-- .dgom-ui-competitors-wrap -->
	<div class="dgom-ui-competitors-wrap">

		<div class="toolbar">
			<div class="tabs">

				<div class="row">
					<div class="col-sm-7 col-md-7">
						<ul class="tabs-nav">
							<li class="tabitem active todos"><a href="#box1"><?=Yii::t('competitors','tabAll');?></a></li>
							<li class="tabitem feedback"><a href="#box2"><?=Yii::t('competitors','tabConFeedback');?></a></li>
							<li class="tabitem noFeedback"><a href="#box3"><?=Yii::t('competitors','tabSinFeedback');?></a></li>
							<li class="tabitem menciones"><a href="#box4"><?=Yii::t('competitors','tabConMenciones');?></a></li>
						</ul>
					</div>

					<div class="col-sm-5 col-md-5 text-right tabs-filtar">

						<p><?=Yii::t('site','selectOrdenBy');?>:</p>
						<div class="dgom-ui-drop-order">
							<div class="button-group">
								<i id="icon"></i>
								<p id="input"><?=Yii::t('competitors','selectSelecciona');?></p>
								<ul id="dropdown-menu">

									<li><?=CHtml::link("Name", array("adminPanel/competitors", "string"=>(isset ( $_GET ['string'] )) ? $_GET ['string'] : '',  "UsrUsuarios_sort_nombre"=>(isset ( $_GET ['UsrUsuarios_sort'] )) ? $_GET ['UsrUsuarios_sort'] : 'txt_nombre'), array("class"=>"animsition-link"))?></li>
									<li><?=CHtml::link("Email", array("adminPanel/competitors", "string"=>(isset ( $_GET ['string'] )) ? $_GET ['string'] : '',  "UsrUsuarios_sort_correo"=>(isset ( $_GET ['UsrUsuarios_sort'] )) ? $_GET ['UsrUsuarios_sort'] : 'txt_correo'), array("class"=>"animsition-link"))?></li>
								</ul>
							</div>
						</div>

						<div class="check-style" style="margin-right: 28px;">
							<?php
							echo CHtml::label ( Yii::t('competitors','checkBoxAll'), "select_all" ) . CHtml::checkBox ( "select_all", '', array (
									"class" => "select_all" 
							) );
							?>
							<div class="check"></div>
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="content">
			<div id="box1" class="box show dgom-ui-competitors-wrap-line">
				<form id="all">
				<?php
				$this->widget ( 'zii.widgets.CListView', array (
						'dataProvider' => $competidores,
						'itemView' => 'concursante',
						'sorterHeader' => 'Ordenar por',
						'summaryText' => '',
						'id' => 'ajaxListView' 
				) );
				
				?>
	</form>
	
	<div>
	
	</div>
			</div>
			<div id="box2" class="box dgom-ui-competitors-wrap-line">
				<form id="feedback">
				<?php
				$this->widget ( 'zii.widgets.CListView', array (
						'dataProvider' => $competidoresFeedback,
						'itemView' => 'concursante',
						'sorterHeader' => 'Ordenar por',
						'summaryText' => '',
						'id' => 'ajaxListView2' 
				) );
				?>
	</form>
			</div>

			<div id="box3" class="box dgom-ui-competitors-wrap-line">
				<form id="noFeedback">
				<?php
				$this->widget ( 'zii.widgets.CListView', array (
						'dataProvider' => $competidoresNoFeedback,
						'itemView' => 'concursante',
						'sorterHeader' => 'Ordenar por',
						'summaryText' => '',
						'id' => 'ajaxListView3' 
				) );
				
				?>
</form>
			</div>

			<div id="box4" class="box dgom-ui-competitors-wrap-line">
				<form id="mencion">
				<?php
				$this->widget ( 'zii.widgets.CListView', array (
						'dataProvider' => $competidoreMencion,
						'itemView' => 'concursante',
						'sorterHeader' => 'Ordenar por',
						'summaryText' => '',
						'id' => 'ajaxListView4' 
				) );
				
				?>
</form>
			</div>
		</div>

	</div>
	<!-- end / .dgom-ui-competitors-wrap -->

</div>
<!-- end / .dgom-ui-competitors -->

<?php

Yii::app ()->clientScript->registerScript ( 'downloadFile', '

// Tabs (material design)
window.onload = function() {
    var heart = document.getElementsByClassName("heart");
    var classname = document.getElementsByClassName("tabitem");
    var boxitem = document.getElementsByClassName("box");

    var clickFunction = function(e) {
        e.preventDefault();
        var a = this.getElementsByTagName("a")[0];
        var span = this.getElementsByTagName("span")[0];
        var href = a.getAttribute("href").replace("#","");
        for(var i=0;i<boxitem.length;i++){
            boxitem[i].className =  boxitem[i].className.replace(/(?:^|\s)show(?!\S)/g, "");
        }
        document.getElementById(href).className += " show";
        for(var i=0;i<classname.length;i++){
            classname[i].className =  classname[i].className.replace(/(?:^|\s)active(?!\S)/g, "");
        }
        this.className += " active";
        span.className += "active";
        var left = a.getBoundingClientRect().left;
        var top = a.getBoundingClientRect().top;
        var consx = (e.clientX - left);
        var consy = (e.clientY - top);
        span.style.top = consy+"px";
        span.style.left = consx+"px";
        span.className = "clicked";
        span.addEventListener("webkitAnimationEnd", function(event){
            this.className = "";
        }, false);  
    };

    for(var i=0;i<classname.length;i++){
        classname[i].addEventListener("click", clickFunction, false);
    }
    for(var i=0;i<heart.length;i++){
        heart[i].addEventListener("click", function(e) {
            var classString = this.className, nameIndex = classString.indexOf("active");
            if (nameIndex == -1) {
                classString += " " + "active";
            }
            else {
                classString = classString.substr(0, nameIndex) + classString.substr(nameIndex+"active".length);
            }
            this.className = classString;

        }, false);
    }
}


$(document).ready(function(){

	function downloadFile(url, urlFile, id, l){
		$.ajax({
				url:url,
				success:function(response){
					var hiddenIFrameID = "hiddenDownloader" + id;
   					var iframe = document.createElement("iframe");
   					iframe.id = hiddenIFrameID;
   					iframe.style.display = "none";
   					document.body.appendChild(iframe);
   					iframe.src = urlFile+"?file="+response;
		
				l.stop();
				$("#descargarArchivo").removeClass("dgom-ui-competitors-search-download-active");
				}
			});
	}
		
		
	$("#descargarArchivo").on("click", function(e){
		e.preventDefault();
		
		var l = Ladda.create(this);
	 	l.start();
		
		var isCSV = $("#csv").prop("checked");
		var isZIP = $("#zip").prop("checked");
		var isZIPRAW = $("#zipResolution").prop("checked");
		
		var competitors = [];
		var feedback = "";
		if($(".feedback").hasClass("active")){
			feedback = 1;
			competitors = $("form#feedback").serialize();
		}else if($(".noFeedback").hasClass("active")){
			feedback = 0;
			competitors = $("form#noFeedback").serialize();
		}else if($(".menciones").hasClass("active")){
			feedback = 0;
			competitors = $("form#noFeedback").serialize();
		}else{
			competitors = $("form#all").serialize();
		}
		
		
		// Si se selecciono CSV descarga un archivo CSV
		if(isCSV){
			downloadFile("' . CHtml::normalizeUrl ( array (
		'juecesAdmin/createCSV',
		"string" => isset ( $_GET ['string'] ) ? $_GET ['string'] : '' 
)
 ) . '&feedback="+feedback+"&"+competitors, "' .Configuracion::DOMINIO_SITIO. CHtml::normalizeUrl ( array (
		'juecesAdmin/downloadCSV' 
) ) . '", "csv", l);
		}
		
		
		if(isZIP){
		downloadFile("' . CHtml::normalizeUrl ( array (
		'juecesAdmin/createZIP',
		"string" => isset ( $_GET ['string'] ) ? $_GET ['string'] : '' 
)
  ) . '&feedback="+feedback+"&"+competitors, "' .Configuracion::DOMINIO_SITIO. CHtml::normalizeUrl ( array (
		'juecesAdmin/downloadZIP' 
) ) . '", "zip", l);
		}
		// Clase active
		//$("#descargarArchivo").addClass("dgom-ui-competitors-search-download-active");
		
		
		
		if(isZIPRAW){
		downloadFile("' . CHtml::normalizeUrl ( array (
		'juecesAdmin/createZIP',
		"string" => isset ( $_GET ['string'] ) ? $_GET ['string'] : '' 
)
  ) . '&feedback="+feedback+"&"+competitors+"&raw=RAW", "' . Configuracion::DOMINIO_SITIO.CHtml::normalizeUrl ( array (
		'juecesAdmin/downloadZIP' 
) ) . '", "zip", l);
		}
		// Clase active
		$("#descargarArchivo").addClass("dgom-ui-competitors-search-download-active");
	
	
	});
	
	// Dropdown
	var triggerOpen = $("#input");
	var triggerClose = $("#dropdown-menu").find("li");
	var marka = $("#icon");
	// set initial Marka icon
	var m = new Marka("#icon");
	m.set("triangle").size(10);
	m.rotate("down");
	// trigger dropdown
	triggerOpen.add(marka).on("click", function(e) {
		e.preventDefault();
		$("#dropdown-menu").add(triggerOpen).toggleClass("open");
		if($("#icon").hasClass("marka-icon-times")) {
			m.set("triangle").size(10);
		} else {
			m.set("times").size(15);
		}
	});
	triggerClose.on("click", function() {
		// set new placeholder for demo
		var options = $(this).find("a").html();
		triggerOpen.text(options);
		$("#dropdown-menu").add(triggerOpen).toggleClass("open");
		m.set("triangle").size(10);
	});



	// Bind normal buttons
	//Ladda.bind( "div:not(.progress-demo) button", { timeout: 1000000 } );

	// Bind progress buttons and simulate loading progress
// 	Ladda.bind( ".progress-demo button", {
// 		callback: function( instance ) {
// 			var progress = 0;
// 			var interval = setInterval( function() {
// 				progress = Math.min( progress + Math.random() * 0.1, 1 );
// 				instance.setProgress( progress );

// 				if( progress === 1 ) {
// 					instance.stop();
// 					clearInterval( interval );
// 				}
// 			}, 200 );
// 		}
// 	} );
	
		$("#select_all").on("click", function(){
			var elemento = $(this);
			if(elemento.prop("checked")){
				$(".show .competidor_check").prop("checked", true);
			}else{
				$(".show .competidor_check").prop("checked", false);
			}
		});
		
		$(".competidor_check").on("click", function(){
			$("#select_all").prop("checked", false);
		});
		
		$(".tabitem").on("click", function(){
			$("#select_all").prop("checked", false);
			$(".competidor_check").prop("checked", false);
		});
		
		$("#buttonSearch").on("click", function(e){
			var form = $(this).parents("form");
			var data = form.serialize();
		
			$(".animsition").animsition("out", $("body"), form.attr("action")+"?"+data);
		});

	$("#form-submit").click(function(e){
	 	e.preventDefault();
	 	var l = Ladda.create(this);
	 	l.start();
		alert();
	 	$.post("your-url", 
	 	    { data : data },
	 	  function(response){
	 	    console.log(response);
	 	  }, "json")
	 	.always(function() { l.stop(); });
	 	return false;
	});
		
});

', CClientScript::POS_END );

?>