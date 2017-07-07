// Ready
$( document ).ready(function() {
	// Obtener altura y agregarselo a PAGE
	var heightPage = $( window ).height();
	heightPages(heightPage);
	
});

// Resize
$(window).resize(function(){
	// Obtener altura y agregarselo a PAGE
	var heightPage = $( window ).height();
    heightPages(heightPage);
});

// Agregar altura a PAGE
function heightPages(heightPage){
	$("#page").css("height", heightPage - 66);
}