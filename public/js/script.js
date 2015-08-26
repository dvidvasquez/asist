$('.mcontra').click(function(event) {
  window.location.href ="recuperar";
});


function errLogIn(){
	var usr = $('#usuario');
	var contra = $('#contra');
		usr.addClass('error');
		contra.addClass('error');
		$('.merror').css('display','block');
		$('.mcontra').css('display','block');
}

$(".cerrarTelon").click(function(){
   $("#telon").addClass("hide"); 
   $("#successConfirma, #errorConfirma, #sending").removeClass("animated bounce");
  $("#successConfirma, #errorConfirma, #sending").addClass("hide");
});

function cs(){
    $("#successConfirma, #errorConfirma, #sending").removeClass("animated bounce");
    $("#successConfirma, #errorConfirma, #sending ,#ajmensaje").addClass("hide");
}


function mt(which){
      $("#telon").removeClass("hide");
      switch (which) {
          case "o":  
          cs();
          $("#successConfirma").removeClass("hide").addClass("animated bounce");
          $("#ajmensaje").removeClass("hide").addClass("animated zoomIn").html("<p>Le hemos enviado a su correo la contraseña nueva</p>");
           break;
          case "e":  
          cs();
          $("#errorConfirma").removeClass("hide").addClass("animated bounce");
          $("#ajmensaje").removeClass("hide").addClass("animated zoomIn").html("<p>La identificación es incorrecta</p>");
           break;
          case "s": 
          cs(); 
          $("#sending").removeClass("hide");
          $("#ajmensaje").removeClass("hide").addClass("animated zoomIn").html("<p>Enviando correo</p>");
           break;
                  }  
};