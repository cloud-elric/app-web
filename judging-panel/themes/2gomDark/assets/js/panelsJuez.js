// Variables
var page = document.getElementById( 'page' ),
	imageDarkScreen = document.getElementById( 'dgom-js-panel-wrapper' ),
	scorePanelToggle = document.getElementById( 'dgom-js-scorePanel' ),
	notesPanelToggle = document.getElementById( 'dgom-js-notesPanel' ),
	beginPhotoReviewBtn = document.getElementById( 'dgom-js-beginReview' ),
	scorePanelIsShowing = false,
	notesPanelIsShowing = false,
	fullPage = false,
	imageDarken = false;

function toggleScore() {
	if( scorePanelIsShowing ) {
		$('#page').removeClass('showScore');
		$('#dgom-js-scorePanel').html( 'Show Notes' );
		if (scorePanelIsShowing || notesPanelIsShowing) {
			$('#dgom-js-beginReview').html( 'Show Panels' );
		}
	}
	else {
		$('#page').addClass('showScore');
		$('#dgom-js-scorePanel').html( 'Hide Notes' );
	}
	scorePanelIsShowing = !scorePanelIsShowing;
}

function toggleNotes() {
	if( notesPanelIsShowing ) {
		$('#page').removeClass('showNotes');
		$('#dgom-js-notesPanel').html( 'Show Score' );
	}
	else {
		$('#page').addClass('showNotes');
		$('#dgom-js-notesPanel').html( 'Hide Score' );
	}
	notesPanelIsShowing = !notesPanelIsShowing;
}

function showReviewBtn() {
	$('#dgom-js-beginReview').addClass('dgom-ui-Btn-photoReview-on');
}

function panelsInit() {	
	setTimeout(showReviewBtn, 2000);

	scorePanelToggle.addEventListener ('click',function(){
		controlPanel("notas" , !notesPanelIsShowing)
	} );
	notesPanelToggle.addEventListener ('click',function(){
		controlPanel("score" , !scorePanelIsShowing)
	} );
	beginPhotoReviewBtn.addEventListener ('click',function(){

		controlPanel("both" , notesPanelIsShowing || scorePanelIsShowing?false:true);

		$('#dgom-js-beginReview').removeClass('dgom-ui-Btn-photoReview-on');
	} );	
};

function setToolBarBtnText() {
	
	boton = $('#dgom-js-beginReview');
	if (scorePanelIsShowing || notesPanelIsShowing) {
		boton.html( 'Hide Panels' );
	}
	else {
		boton.html( 'Show Panels' );
	}

	//es el boton del panel Izquierdo
	boton = $('#dgom-js-scorePanel');

	if (notesPanelIsShowing) {
		boton.html( 'Hide Notes' );
	}
	else {
		boton.html( 'Show Notes' );
	}

	//es el boton del panel Derecho
	boton = $('#dgom-js-notesPanel');

	if (scorePanelIsShowing) {
		boton.html( 'Hide Score' );
	}
	else {
		boton.html( 'Show Score' );
	}
}

panelsInit();

// Btn para cambiar texto: FullScreen & FitScreen
$('#dgom-js-full-juez').click(function() {
	if(fullPage){
		$("#dgom-js-full-juez").html("Full Screen");
	}
	else{
		$("#dgom-js-full-juez").html("Fit Screen");
	}
	fullPage = !fullPage;
});
