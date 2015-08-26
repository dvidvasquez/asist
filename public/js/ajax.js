$("#frmRecuperar").submit(function(e){
  var token = $("#token").val();
  var action = $("#frmRecuperar").attr("action");
  var user = $("#usuario").val();

  var parametros = {
      "user": user,
      "token":token
    };

     $.ajax(
          {      
              url : action,
              type: "POST",
              data : parametros,
              beforeSend: function(){
                $('body,html').animate({scrollTop: 0}, 800);
                mt("s");
              },
              success:function(data) 
              {
                console.log(data);
                 if ($.trim(data) == "ok") 
                  {                                                                          
                    mt("o");
                    /**/
                  }
                 else
                  {    
                    mt("e");
                  };
              }
              
          }); 
  e.preventDefault();
});
/*
function confirmarAsistencia(jasonConfirma){
    var token = $("#tokenAsitencia").val();
    var pathSitio = $("#pathSitio").val();
    var deAction =  pathSitio+"asistencia/confirmar";
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
*/




function confirmarCorreo(jasonConfirma){
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
