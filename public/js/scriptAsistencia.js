var conteo = 0;
var estudiantes = [];
var posicion = 0;

$(document).ready(function() {
	$('.footable').footable();	
	 $(".footable1").footable();
	$('table').trigger('footable_clear_filter');$('.filter-api').click(function (e) {    e.preventDefault();var footableFilter = $('table').data('footable-filter');alert('about to filter table by "tech"');footableFilter.filter('tech');if (confirm('clear filter now?')) {footableFilter.clearFilter();}});	
	$('.sort-column').click(function (e) {e.preventDefault();var footableSort = $('table').data('footable-sort');var index = $(this).data('index');var ascending = $(this).data('ascending');footableSort.doSort(index, ascending);});
	$('.btnlist').each(function(index, el) {
	$(this).addClass('glyphicon glyphicon-ok');
	});

	$('.btnlist').click(function(){
		var tr = $(this).parent().parent();
		var nombre = tr.find(".tNombre").html();
		var grado = tr.find(".tGrado").html();
		var documento = tr.find(".tDoc").html();		
		var edad = tr.find(".tEdad").html();
		var datos = $(this).data("i");
		var idDato = $(this).data("ide");

		var tratt = tr.attr('selected');
		if(tratt==null)
		{
			$(this).removeClass('glyphicon glyphicon-ok');
			$(this).addClass('glyphicon glyphicon-remove');
			tr.addClass('selected');
			tr.attr('selected', '1');
			ftAddRow(".footable1",[nombre,grado,documento,edad],datos,idDato);
			conteo++;
			$('.conteo').html(conteo);
			$('.conteo').hide();
			$('.conteo').show('Bounce');
		}
		else{
			$(this).removeClass('glyphicon glyphicon-remove');
			$(this).addClass('glyphicon glyphicon-ok');
			tr.removeClass('selected');
			tr.attr('selected', null);
			ftRemoveRow(".footable1",idDato);
			conteo--;
			$('.conteo').html(conteo);
			$('.conteo').hide();
			$('.conteo').show('Bounce');
		}
	});
	

});


function ftAddRow(ti, fila,datos,id){	
	var tds = "";
	$.each(fila, function (j, col){
            	tds = tds+"<td>"+col+"</td>";
                });
	var footable = $(ti).data('footable');
    footable.appendRow("<tr class='confirmaAsiste rConfirma-"+id+"' data-in='"+datos+"' >"+tds+"</td>");
}

function ftRemoveRow(ti, id){	
	var footable = $(ti).data('footable');
    var row = $(ti+' .rConfirma-'+id);
    footable.removeRow(row);
}

function asistencias(){	
	conteo > 0 ?$('.hide').trigger('click'): false;
}


function enviarAsistencia(){
	//console.log(html2json(".footable1"));
	var jsonConfirm = [];
	$("#table2 .confirmaAsiste").each(function(i,v){
		var parts = $(v).data("in").split(";");
		 jsonConfirm.push({idEstudiante: parts[0],numEvento: parts[1],idProyecto: parts[2]});
	});
	console.log(JSON.stringify(jsonConfirm));
}

function html2json(laTabla) {
   var json = '{';
   var otArr = [];
   var tbl2 = $(laTabla+' tr').each(function(i) {        
      x = $(this).children();
      var itArr = [];
      x.each(function() {
         itArr.push('"' + $(this).text() + '"');
      });
      otArr.push('"' + i + '": [' + itArr.join(',') + ']');
   })
   json += otArr.join(",") + '}'

   return json;
}