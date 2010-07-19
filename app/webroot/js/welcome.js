$(document).ready(function() {
	
	adjustSectionHeight();
	
	$(window).resize(function() {
		adjustSectionHeight();		
	});
	
	function adjustSectionHeight() {
		var windowHeight = $(window).height();
		var sectionHeight = $("body > section").height();
		var newMargin = ((windowHeight/2) - (sectionHeight/2));
		if(newMargin < 0) {
			newMargin = 0;
		}
		$("body > section").css({
			marginTop: newMargin
		});
	}
	
});