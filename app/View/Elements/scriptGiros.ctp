<script type="text/javascript">
	
		//Obtener áreas en base al giro Carga automática (studentProspect)
		if ($("#StudentInterestJobBusinessActivity").length > 0){
			if($("#StudentInterestJobBusinessActivity").val() != 0)
				{
				$('#loading').show();
				$.get('http://localhost/bolsabti/app/webroot/php/derpAreas.php',{giro: $('#StudentInterestJobBusinessActivity').val()},function(JSON)
					{
					$('#StudentInterestJobInterestAreaId').empty();
					$('#StudentInterestJobInterestAreaId').append('<option value="">Área de experiencia</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});

					$.each(JSON, function(key, val){
						if(val.id == '<?php 	if(!empty($this->request->data['StudentWorkArea'])):
													echo $this->request->data['StudentWorkArea'][0]['experience_area'];
												else:
													echo '';
												endif;
												 ?>'){
							$('#StudentInterestJobInterestAreaId').append('<option value="' + val.id + '" selected>' + val.area + '</option>');
						}else{
							$('#StudentInterestJobInterestAreaId').append('<option value="' + val.id + '">' + val.area + '</option>');
						}
						
						if (--waitCount == 0) {
							$('#loading').hide();
							$('.selectpicker').selectpicker('refresh');
						}

					});
					});

				}
				else
				{
					$('#StudentInterestJobInterestAreaId').empty();
					$('#StudentInterestJobInterestAreaId').append('<option value="">Área de experiencia</option>');
					$('.selectpicker').selectpicker('refresh');
				}
			}
			
		//Obtener áreas en base al giro seleccionado (studentProspect)
		$("#StudentInterestJobBusinessActivity").on('change',function (){
			$("#divSubarea").hide();
			if($("#StudentInterestJobBusinessActivity").val() != 0)
				{
				$('#loading').show();
				$.get('http://localhost/bolsabti/app/webroot/php/derpAreas.php',{giro: $('#StudentInterestJobBusinessActivity').val()},function(JSON)
					{
					
					$('#StudentInterestJobInterestAreaId').empty();
					$('#StudentInterestJobInterestAreaId').append('<option value="">Área de experiencia</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});
					
					$.each(JSON, function(key, val){
						$('#StudentInterestJobInterestAreaId').append('<option value="' + val.id + '">' + val.area + '</option>');
						
						if (--waitCount == 0) {
							$('#loading').hide();
							$('.selectpicker').selectpicker('refresh');
						}
						
					});
					});
				}
				else
				{
					$('#StudentInterestJobInterestAreaId').empty();
					$('#StudentInterestJobInterestAreaId').append('<option value="">Área de experiencia</option>');
					$('.selectpicker').selectpicker('refresh');
				}
		});
</script>