$(document).ready(function(){
   $("#juridica").change(function () {
      if($("#juridica").val() == "0"){
          $('#cuit').removeAttr("required");
          $('#divcuit').fadeOut(1);
          $('#dni').attr("required","required");
          $('#divdni').fadeIn(1);
      }else{
          $('#dni').removeAttr("required");
          $('#divdni').fadeOut('slow');
          $('#cuit').attr("required","required");
          $('#divcuit').fadeIn('slow');
      }
    });
   $("#cliente_id").change(function(){
      if($("#cliente_id").val() != ""){
          var miselect=$("#equipo");
         $.get("negocio/equipo_cliente_json.php?cliente="+$("#cliente_id").val(), function(data){
             miselect.empty();
             if(data.length > 0){
                for (var i=0; i<data.length; i++) {
                    miselect.append('<option value="' + data[i].id + '">' + data[i].descripcion_equipo + '</option>');
                    miselect.removeAttr("disabled");
                    $("#nuevo").fadeOut();
                }
             }else{
                 miselect.find('option').remove().end().append('<option value="">No hay equipos para este cliente</option>').val('');
                 miselect.attr('disabled', 'disabled');
                 $("#nuevo").fadeIn();
                 $("#guardar").attr("disabled","disabled");
             }
         },"json");
      }else{
                 var miselect=$("#equipo");
                 miselect.find('option').remove().end().append('<option value="">Seleccione un cliente</option>');
                 miselect.attr('disabled', 'disabled');
                 $("#nuevo").fadeOut();
                 $("#guardar").attr("disabled","disabled");
      }
   });
   $("#equipo").change(function(){
       $("#guardar").removeAttr("disabled");
   });
});


