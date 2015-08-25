
function errLogIn(){
	var usr = $('#usuario');
	var contra = $('#contra');
		usr.addClass('error');
		contra.addClass('error');
		$('.merror').css('display','block');
		$('.mcontra').css('display','block');
}