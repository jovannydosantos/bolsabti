<script type="text/javascript">
	$("#StudentProfessionalProfileUndergraduateInstitution").on('change',function (){
			
			if($("#StudentProfessionalProfileUndergraduateInstitution").val() != 0)
				{
				$('#loading').show();
				$.get('http://localhost/bolsabti/app/webroot/php/derpCarreras.php',{escuela: $('#StudentProfessionalProfileUndergraduateInstitution').val(), level: <?php echo $this->Session->read('tipoProfessionalProfile'); ?> },function(JSON)
					{
					<?php if($this->Session->read('tipoProfessionalProfile') == 1): ?>
						$('#idCarrera1').empty();
						$('#idCarrera1').append('<option value="">Carrera</option>');
					<?php else: ?>
						$('#StudentProfessionalProfilePosgradoProgramId').empty();
						$('#StudentProfessionalProfilePosgradoProgramId').append('<option value="">Programa</option>');
					<?php endif; ?>

					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});

					$.each(JSON, function(key, val){
						<?php if($this->Session->read('tipoProfessionalProfile') == 1): ?>
							$('#idCarrera1').append('<option value="' + val.id + '">' + val.carrera + '</option>');
						<?php else: ?>
							$('#StudentProfessionalProfilePosgradoProgramId').append('<option value="' + val.id + '">' + val.carrera + '</option>');
						<?php endif; ?>

						if (--waitCount == 0) {
							$('#loading').hide();
							$('.selectpicker').selectpicker('refresh');
						}

					});
					});
				}
				else
				{
					<?php if($this->Session->read('tipoProfessionalProfile') == 1): ?>
						$('#idCarrera1').empty();
						$('#idCarrera1').append('<option value="">Carrera</option>');
					<?php else: ?>
						$('#StudentProfessionalProfilePosgradoProgramId').empty();
						$('#StudentProfessionalProfilePosgradoProgramId').append('<option value="">Programa</option>');
					<?php endif; ?>

					$('.selectpicker').selectpicker('refresh');
				}
		});
</script>