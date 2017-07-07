// Variables
var page = document.getElementById( 'page' ),
	bkgdImage = document.getElementById( 'dgom-js-bkgdImage' ),

	//Toggle Btns
	imageFitWidthToggle = document.getElementById( 'dgom-js-toggleFitW' ),
	imageFitHeightToggle = document.getElementById( 'dgom-js-toggleFitH' ),
	fullSizeToggle = document.getElementById( 'dgom-js-toggleFullSize' ),
	beginPhotoReviewBtn = document.getElementById( 'dgom-js-beginReview' ),

	//Conditional validators
	isFullSize = false,
	imageOrientationLandscape = true,

	//Bkgd image properties
	fullSizeImageWidth,
	fullSizeImageHeight,
	bkgdImage = new Image(),
	src = $( '#dgom-js-bkgdImage' ).attr('src');
	bkgdImage.src = src;

function photoInit() {

	//BKGD image init
	bkgdImage.onload = function() {
	  fullSizeImageWidth = this.width;
	  fullSizeImageHeight = this.height;
	  detectImageOrientation();
	}

	//Btn Listener Init
//	imageFitWidthToggle.addEventListener ('click',function(){
//		fitImageToWidth();
//	} );	
//	imageFitHeightToggle.addEventListener ('click',function(){
//		fitImageToHeight();
//	} );
//	fullSizeToggle.addEventListener ('click',function(){
//		toggleFullsize();
//	} );
	beginPhotoReviewBtn.addEventListener ('click',function(){
		toggleImageFitToScreen();
	} );	
};

function toggleImageFitToScreen() {
	if (imageOrientationLandscape) {
		fitImageToHeight();
	}
	else {
		fitImageToWidth();
	}
}

function toggleFullsize() {

	if( !isFullSize ) {
		$('#page').removeClass('fitImageToWidth');
		$('#page').removeClass('setImageToPortrait');
		$('#page').removeClass('fitImageToHeight');
		$('#page').removeClass('setImageToLandscape');
		$('#page').addClass('setImageToFullSize');
		$('#dgom-js-toggleFullSize').html( 'FitScreen' );
		
		if (notesPanelIsShowing) {
			toggleNotes();
			$('#dgom-js-beginReview').html( 'Show Panels' );
		}
		if (scorePanelIsShowing) {
			toggleScore();
			$('#dgom-js-beginReview').html( 'Show Panels' );
		}
		if (imageDarken) {
			panelWrapperTint();
			$('#dgom-js-beginReview').html( 'Show Panels' );
		}
		
	}
	else {
		setImageOnViewPort();
		$('#page').removeClass('setImageToFullSize');
		$('#dgom-js-toggleFullSize').html( 'FullSize' );
	}
	isFullSize = !isFullSize;
}


function detectImageOrientation() {
	if ( fullSizeImageHeight >= fullSizeImageWidth) {
		imageOrientationLandscape = false;
		setImageOnViewPort()
	}
	else {
		setImageOnViewPort()
	}
}

function fitImageToHeight(){
	console.log('Setting image dimensions to ScreenHeight');
	if (imageOrientationLandscape) {
		$('#page').removeClass('setImageToLandscape');
		$('#page').removeClass('fitImageToWidth');
		$('#page').addClass('fitImageToHeight');
	}
	else{
		$('#page').removeClass('setImageToPortrait');
		$('#page').removeClass('fitImageToWidth');
		$('#page').addClass('fitImageToHeight');
	}
}
function fitImageToWidth(){
	if (imageOrientationLandscape) {
		$('#page').removeClass('setImageToLandscape');
		$('#page').removeClass('fitImageToHeight');
		$('#page').addClass('fitImageToWidth');
	}
	else{
		$('#page').removeClass('setImageToPortrait');
		$('#page').removeClass('fitImageToHeight');
		$('#page').addClass('fitImageToWidth');
	}
}

function setImageOnViewPort(){
	if ( imageOrientationLandscape ) {
		$('#page').addClass('setImageToLandscape');
	}
	else {
		$('#page').addClass('setImageToPortrait');
	}
}

photoInit();

function controlPanel(target , showHide){

	switch (target){
		case  "notas":
			if (showHide) {
				$('#page').addClass('showScore');
				notesPanelIsShowing = true;
			}
			else{
				$('#page').removeClass('showScore');
				notesPanelIsShowing = false;
			}
		break;
		case  "score":
			if (showHide) {
				$('#page').addClass('showNotes');
				scorePanelIsShowing = true;
			}
			else{
				$('#page').removeClass('showNotes');
				scorePanelIsShowing = false;
			}
		break;			
		case  "both":
			controlPanel("notas" , showHide);
			controlPanel("score" , showHide);
		break;
	}
	setToolBarBtnText();
	
	if( notesPanelIsShowing || scorePanelIsShowing ) {
			$('#dgom-js-panel-wrapper').addClass('imageDarken');
		}
		else {
			$('#dgom-js-panel-wrapper').removeClass('imageDarken');
	}
}