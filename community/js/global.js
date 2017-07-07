$(document).ready(function() {
	$(".animsition").animsition({
		loading : false
	});
	
	$('.animsition').on('animsition.inStart', function() {
		$(".animsition-loading").hide();
	});

	$('.animsition').on('animsition.outStart', function() {
		$(".animsition-loading").show();
	});
	
});
