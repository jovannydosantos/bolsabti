<script type="text/javascript">
	// Obtener las Escuelas/Facultades dependiendo del nivel
		$("#StudentAcademicLevelId").on('change',function (){
			if($("#StudentAcademicLevelId").val() != 0)
				{
				$('#loading').show();
				$.get('http://localhost/bolsabti/app/webroot/php/derpEsc.php',{level: $('#StudentAcademicLevelId').find(":selected").index() },function(JSON)
					{
					
					$('#StudentInstitution').empty();
					$('#StudentInstitution').append('<option value="">Escuela / Facultad</option>');
					$('#StudentCareer').empty();
					$('#StudentCareer').append('<option value="">Carrera / Programa</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});
					
					$.each(JSON, function(key, val){
						$('#StudentInstitution').append('<option value="' + val.id + '">' + val.escuela + '</option>');
						
						if (--waitCount == 0) {
							$('#loading').hide();
							$('.selectpicker').selectpicker('refresh');
						}
					});
					});
				}
				else
				{
					$('#StudentInstitution').empty();
					$('#StudentInstitution').append('<option value="">Escuela / Facultad</option>');
					$('#StudentCareer').empty();
					$('#StudentCareer').append('<option value="">Carrera / Programa</option>');
					$('.selectpicker').selectpicker('refresh');
				}
		});
		
		//Obtener Carreras / Áreas en base al nivel y escuela seleccionada (Registro)
		$("#StudentInstitution").on('change',function (){
		if($("#StudentInstitution").val() != 0)
			{
			$('#loading').show();
			$.get('http://localhost/bolsabti/app/webroot/php/derpCarrerasRegistro.php',{escuela: $('#StudentInstitution').val(), level: $('#StudentAcademicLevelId').find(":selected").index() },function(JSON)
				{
				$('#StudentCareer').empty();
				$('#StudentCareer').append('<option value="">Carrera / Programa</option>');
				
				var waitCount = 0;
				$.each(JSON, function(key, val){
					waitCount++;
				});
					
				$.each(JSON, function(key, val){
					$('#StudentCareer').append('<option value="' + val.id + '">' + val.carrera + '</option>');
					
					if (--waitCount == 0) {
						$('#loading').hide();
						$('.selectpicker').selectpicker('refresh');
					}
					
				});
				});
			}
			else
			{
				$('#StudentCareer').empty();
				$('#StudentCareer').append('<option value="">Carrera / Programa</option>');
				$('.selectpicker').selectpicker('refresh');
			}
		});
				
		// Obtener las Escuelas/Facultades dependiendo del nivel (Automático)
		if($("#StudentAcademicLevelId").val() != 0)
				{
				$('#loading').show();
				$.get('http://localhost/bolsabti/app/webroot/php/derpEsc.php',{level: $('#StudentAcademicLevelId').find(":selected").index() },function(JSON)
					{
					$('#StudentInstitution').empty();
					$('#StudentInstitution').append('<option value="">Escuela / Facultad</option>');
					$('#StudentCareer').empty();
					$('#StudentCareer').append('<option value="">Carrera / Programa</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});

					$.each(JSON, function(key, val){
						if(val.id == '<?php echo $this->Session->read('escuelaSeleccionada'); ?>'){
							$('#StudentInstitution').append('<option value="' + val.id + '" selected>' + val.escuela + '</option>');
						}else{
							$('#StudentInstitution').append('<option value="' + val.id + '">' + val.escuela + '</option>');
						}
						
						if (--waitCount == 0) {
							$('#loading').hide();
							$('.selectpicker').selectpicker('refresh');
						}

					});
					
					//Obtener Carreras / Áreas en base al nivel y escuela seleccionada (Registro)	(Automático)	
					if($("#StudentInstitution").val() != 0)
						{
						$('#loading').show();
						$.get('http://localhost/bolsabti/app/webroot/php/derpCarrerasRegistro.php',{escuela: $('#StudentInstitution').val(), level: $('#StudentAcademicLevelId').find(":selected").index() },function(JSON)
							{
							$('#StudentCareer').empty();
							$('#StudentCareer').append('<option value="">Carrera / Programa</option>');
							
							var waitCount2 = 0;
							$.each(JSON, function(key, val){
								waitCount2++;
							});
					
							$.each(JSON, function(key, val){
								if(val.id == '<?php echo $this->Session->read('carreraSeleccionada'); ?>'){
									$('#StudentCareer').append('<option value="' + val.id + '" selected>' + val.carrera + '</option>');
								}else{
									$('#StudentCareer').append('<option value="' + val.id + '">' + val.carrera + '</option>');
								}
								
								if (--waitCount2 == 0) {
									$('#loading').hide();
									$('.selectpicker').selectpicker('refresh');
								}

							});
							});
						}
						else
						{
							$('#StudentCareer').empty();
							$('#StudentCareer').append('<option value="">Carrera / Programa</option>');
							$('.selectpicker').selectpicker('refresh');
						}		
					});
				}
				else
				{
					$('#StudentInstitution').empty();
					$('#StudentInstitution').append('<option value="">Escuela / Facultad</option>');
					$('#StudentCareer').empty();
					$('#StudentCareer').append('<option value="">Carrera / Programa</option>');
					$('.selectpicker').selectpicker('refresh');
				}

</script>