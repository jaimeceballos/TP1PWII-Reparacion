$(document).ready(function(){
   $("#juridica").change(function () {
      if($("#juridica").val() == "1"){
          $('#cuit').fadeOut(1);
          $('#dni').fadeIn(1);
      }else{
          $('#dni').fadeOut('slow');
          $('#cuit').fadeIn('slow');
      }
    }); 
});


