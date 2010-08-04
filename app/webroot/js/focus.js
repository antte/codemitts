$(document).ready(function() {
	var focusObjects = [];
	
	focusObjects.push('#UserLoginForm input#UserUsername');
	focusObjects.push('#UserEditTagsForm input#TagName');

	for (var i in focusObjects) {
		if($(focusObjects[i]).length) {
			$(focusObjects[i]).focus();
			break; //only one object can have focus, no point in continuing
		}
	}
	
});