<script type="text/javascript">
	
	//Obtener áreas en base al giro Carga automática (specificSearch)
	if ($("#CompanyJobProfileDynamicGiro0Giro").length > 0){
		if($("#CompanyJobProfileDynamicGiro0Giro").val() != 0)
			{
			$('#loading').show();
			$.get('http://localhost/bolsabti/app/webroot/php/derpAreas.php',{giro: $('#CompanyJobProfileDynamicGiro0Giro').val()},function(JSON)
				{
				$('#CompanyJobProfileDynamicArea0AreaInteres').empty();
				$('#CompanyJobProfileDynamicArea0AreaInteres').append('<option value="">Área de interés</option>');
				
				var waitCount = 0;
				$.each(JSON, function(key, val){
					waitCount++;
				});

				$.each(JSON, function(key, val){
					$('#CompanyJobProfileDynamicArea0AreaInteres').append('<option value="' + val.id + '">' + val.area + '</option>');
					
					if (--waitCount == 0) {
						$('#loading').hide();
						$('.selectpicker').selectpicker('refresh');
					}

				});
				});
			}
			else
			{
				$('#CompanyJobProfileDynamicArea0AreaInteres').empty();
				$('#CompanyJobProfileDynamicArea0AreaInteres').append('<option value="">Área de interés</option>');
				$('.selectpicker').selectpicker('refresh');
			}
		}
			
	// Funcion de carga de áreas
	function cargaAreas(id){
		if($('#CompanyJobProfileDynamicGiro'+id+'Giro').val() != 0)
			{
			$('#loading').show();
			$.get('http://localhost/bolsabti/app/webroot/php/derpAreas.php',{giro: $('#CompanyJobProfileDynamicGiro'+id+'Giro').val()},function(JSON)
				{
						
				$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').empty();
				$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').append('<option value="">Área de interés</option>');
				
				var waitCount = 0;
				$.each(JSON, function(key, val){
					waitCount++;
				});
						
				$.each(JSON, function(key, val){
					$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').append('<option value="' + val.id + '">' + val.area + '</option>');
					
					if (--waitCount == 0) {
						$('#loading').hide();
						$('.selectpicker').selectpicker('refresh');
					}

				});
				});
			}
			else
			{
				$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').empty();
				$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').append('<option value="">Área de interés</option>');
				$('.selectpicker').selectpicker('refresh');
			}
	}

</script>