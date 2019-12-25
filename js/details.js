$(document).ready(function () {
	$('subdetbtn').click(function(){
		var password = $('#pass').val();
	    var confirmPassword = $('#confpass').val();
	    if (password != confirmPassword)
	    	alert("Passwords do not match.");
		} 
});