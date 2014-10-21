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
});


