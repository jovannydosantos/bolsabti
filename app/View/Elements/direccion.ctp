<script type="text/javascript">
	$("#estado").on('change',function (){
	if($("#estado").val() != 0){	
			$('#loading').show();
			$.get('http://localhost/bolsabti/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
				{	
					$('#ciudad').empty();
					$('#ciudad').append('<option value="">Delegación / Municipio</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});

					$.each(JSON, function(key, val){
						$('#ciudad').append('<option value="' + val.mun + '">' + val.mun + '</option>');
						if (--waitCount == 0) {
							$('#loading').hide();
							$('.selectpicker').selectpicker('refresh');
						}

					});
				});	
		}else{
			$('#ciudad').empty();
			$('#ciudad').append('<option value="">Delegación / Municipio</option>');
			$('.selectpicker').selectpicker('refresh');
		}
	});	

	// Carga automática de las ciudades si es que existe un estado seleccionado (AUTOMÁTICO)
	if($("#estado").val() != 0){	
			$('#loading').show();
			$.get('http://localhost/bolsabti/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
				{	
					$('#ciudad').empty();
					$('#ciudad').append('<option value="">Delegación / Municipio</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});
					
					$.each(JSON, function(key, val){
						<?php if(isset($this->request->data['StudentProfile']['city'])): ?>
							if(val.mun == '<?php echo $this->request->data['StudentProfile']['city']; ?>'){
								$('#ciudad').append('<option value="' + val.mun + '" selected>' + val.mun + '</option>');
							}else{
								$('#ciudad').append('<option value="' + val.mun + '">' + val.mun + '</option>');
							}
						<?php else: ?>
							$('#ciudad').append('<option value="' + val.mun + '">' + val.mun + '</option>');
						<?php endif; ?>
						
						if (--waitCount == 0) {
							$('#loading').hide();
							$('.selectpicker').selectpicker('refresh');
						}
						
					});
				});	
		}else{
			$('#ciudad').empty();
			$('#ciudad').append('<option value="">Delegación / Municipio</option>');
			$('.selectpicker').selectpicker('refresh');
		}
</script>