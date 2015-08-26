
function confirmarAsistencia(jasonConfirma){
    var token = $("#tokenAsitencia").val();
    var pathSitio = $("#pathSitio").val();
    var deAction =  pathSitio+"asistencia/confirmar";
    //console.log(deAction);
    var parametros = {
      "json": jasonConfirma,
      "token":token
    };
     $.ajax(
          {      
              url : deAction,
              type: "POST",
              data : parametros,
              beforeSend: function(){
                $('body,html').animate({scrollTop: 0}, 800);
                mt("s");
              },
              success:function(data) 
              {       
                $("#cerrarAsistenciaModal").click();
                //console.log(data);
                 if ($.trim(data) == 1) 
                  {                                                                          
                    mt("o");
                  }
                 else
                  {    
                  	mt("e");
                  };
              }
              
          }); 
};
