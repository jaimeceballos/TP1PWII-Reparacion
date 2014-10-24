<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		$("#idp").change(function(event)
		{
			
			if($("#idp").val() == 1){
				$("#pais_p").fadeIn();
				var miselect=$("#pais");
			 /*VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
			miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("carga_json.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].id + '">' + data[i].descripcion_equipo + '</option>');
					}
			}, "json");
			}
			/*var miselect=$("#pais");
			 VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... 
			miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("carga_json.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].id + '">' + data[i].literal + '</option>');
					}
			}, "json");*/
		});
		/*$(".reiniciar").bind("click",function()
		{
			var miselect=$("#pais");
			miselect.find('option').remove().end().append('<option value="">Selecciona...</option>').val('');
		});*/
	});
	</script>

</head>
<body>
<form class="validacion" action="" method="post">
<fieldset>
	<p><label>desea seleccionar pais?</label><select  name="idp" id="idp"><option value="">Selecciona...</option>
	<option value="0">no</option><option value="1">Si</option></select></p>
<div  id="pais_p" style="display:none"><p><label>Selecciona un país</label><select multiple name="pais" id="pais"><option value="">Selecciona...</option></select></p></div>
</fieldset>
<p><input type="button" value="Cargar datos en el select" class="cargar"><input type="button" value="Reiniciar select" class="reiniciar"></p>
</form>
</body>

</html>
