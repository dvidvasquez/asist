$(document).ready(function() {
// $("a").click(function(e){e.preventDefault();});	
});



function validar(){
		var pass1 = $('#pass1').val();
		var pass2 = $('#pass2').val();
		if(pass1 != pass2)
		{
			console.log('Error');	
			return false;
		}
}
