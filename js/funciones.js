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
          //miselect.find('option').remove().val('');
          $.post("negocio/equipo_cliente_json.php",{cliente:$("#cliente_id").val()},
                function(data) {
                    alert('VIENE');
                        miselect.empty();
                        for (var i=0; i<data.length; i++) {
                                miselect.append('<option value="' + data[i].id + '">' + data[i].descripcion_equipo + '</option>');
                        }
                 }, "json"
             );
      }
   });
});


