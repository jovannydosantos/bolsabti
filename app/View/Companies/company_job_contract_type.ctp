<?php 
	$this->layout = 'company'; 
?>
	<style>
	.required label:after {
		  content:"*";
		  display: block;
		  position: absolute;
		  left: 10px;
		  color:red;
	} 
	</style>
	<script>
		
		$(document).ready(function() {
			var helpText = [
							"", 
							"", 
							"",
							"",
							"",
							"Al seleccionar Sí el sueldo no será visible al candidato.",
							"Opciones de servicios y apoyos que son adicionales al sueldo que son otorgadas al trabajador para hacer más atractiva la oferta.",
							"En este apartado podrá describir las prestaciones o apoyos adicionales a las descritas en el campo anterior."
							];
			 
			$('.form-group').each(function(index, element) {
				$(this).find(".cambia").attr("id", index);
				$(this).find('#'+index).attr("data-original-title", helpText[index]);
			});

			$("#estado").on('change',function (){
				if($("#estado").val() != 0)
					{	
						$('#loading').show();
						// $.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
						$.get('http://localhost/unam/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
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
					}
					else
					{
						$('#ciudad').empty();
						$('#ciudad').append('<option value="">Delegación / Municipio</option>');
						$('.selectpicker').selectpicker('refresh');
					}
					
			});	
			
			// Carga automática de las ciudades si es que existe un estado seleccionado (AUTOMÁTICO)
			if($("#estado").val() != 0)
				{	
					$('#loading').show();
					// $.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
					$.get('http://localhost/unam/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
						{	
							$('#ciudad').empty();
							$('#ciudad').append('<option value="">Delegación / Municipio</option>');
							
							var waitCount = 0;
							$.each(JSON, function(key, val){
								waitCount++;
							});
								
							$.each(JSON, function(key, val){
								if(val.mun == '<?php echo (isset($this->request->data['CompanyJobContractType']['subdivision']) and ($this->request->data['CompanyJobContractType']['subdivision'] <> '')) ? $this->request->data['CompanyJobContractType']['subdivision']: ''; ?>'){
									$('#ciudad').append('<option value="' + val.mun + '" selected>' + val.mun + '</option>');
								}else{
									$('#ciudad').append('<option value="' + val.mun + '">' + val.mun + '</option>');
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
					$('#ciudad').empty();
					$('#ciudad').append('<option value="">Delegación / Municipio</option>');
					$('.selectpicker').selectpicker('refresh');
				}
				
			init_contadorTa("CompanyJobContractTypeOtherBenefits","contadorTaComentario", 316);
			updateContadorTa("CompanyJobContractTypeOtherBenefits","contadorTaComentario", 316);
			
				desabilityMobility();
				desabilityMobility2();	
				mobilityCityOption();
				mobilityCityOption2();
			

			<?php if(isset($this->request->data['CompanyJobContractTypeBenefit']) and (!empty($this->request->data['CompanyJobContractTypeBenefit']))){ ?>
				var totalBeneficios = <?php echo count($this->request->data['CompanyJobContractTypeBenefit']); ?>;
			<?php } else { ?> 
				var totalBeneficios = 0;
			<?php } ?> 
			
			if(totalBeneficios>0){
				var arrayBeneficiosOferta = new Array();
				var indexArray = 0;
				<?php 
					foreach($BeneficiosOferta as $k => $BeneficioOferta): 
				?>;	
					arrayBeneficiosOferta[indexArray] = <?php echo $BeneficioOferta['CompanyJobContractTypeBenefit']['benefit_id'] ?>;
					indexArray++;
				<?php 
					endforeach;
				?>;
				
				$("#CompanyJobContractTypeBenefitBenefits option").each(function () {
					for( c = 0; c < indexArray; c++ ){
						if($(this).val() == arrayBeneficiosOferta[c]){
							$('#CompanyJobContractTypeBenefitBenefits option[value='+$(this).val()+']').attr('selected','selected');
						}
					}
				});
				$('.selectpicker').selectpicker('refresh');
			}
			
		});
	
		function init_contadorTa(idtextarea, idcontador,max)
		{
			$("#"+idtextarea).keyup(function()
					{
						updateContadorTa(idtextarea, idcontador,max);
					});
			
			$("#"+idtextarea).change(function()
			{
					updateContadorTa(idtextarea, idcontador,max);
			});
			
		}

		function updateContadorTa(idtextarea, idcontador,max)
		{
			var contador = $("#"+idcontador);
			var ta =     $("#"+idtextarea);
			contador.html("0/"+max);
			
			contador.html(ta.val().length+"/"+max);
			if(parseInt(ta.val().length)>max)
			{
				ta.val(ta.val().substring(0,max-1));
				contador.html(max+"/"+max);
			}

		}
 	
	function desabilityMobility(){
		<?php if(($this->Session->check('companyJobContractType.id') == false) and (empty($this->request->data))): ?>
			$( "#CompanyJobContractTypeMobilityOption1" ).prop( "checked", false );
			$( "#CompanyJobContractTypeMobilityOption2" ).prop( "checked", false );
			document.getElementById('CompanyJobContractTypeMobilityCity1').options[0].selected = 'selected';
		<?php endif; ?>
		
		$("#divMobilityCityOption1").hide();
			
		if($("#CompanyJobContractTypeMobilityS").is(':checked')) {  
            var disabilityValue = 's';  
        } else if($("#CompanyJobContractTypeMobilityN").is(':checked')) {  
            var disabilityValue = 'n';   
        } else{
			var disabilityValue = '';   
		}

		if(disabilityValue == "s"){
			$("#bloque2").show();
		} else {		
			$("#bloque2").hide();
		}
		$('.selectpicker').selectpicker('refresh');
	}

	function desabilityMobility2(){
		<?php if(($this->Session->check('companyJobContractType.id') == false) and (empty($this->request->data))): ?>
			$( "#CompanyJobContractTypeChangeResidenceOption1" ).prop( "checked", false );
			$( "#CompanyJobContractTypeChangeResidenceOption2" ).prop( "checked", false );
			document.getElementById('CompanyJobContractTypeChangeResidenceState').options[0].selected = 'selected';
		<?php endif; ?>
		
		$("#divMobilityCityOption2").hide();
		
		if($("#CompanyJobContractTypeChangeResidenceS").is(':checked')) {  
            var disabilityValue = 's';  
        } else if($("#CompanyJobContractTypeChangeResidenceN").is(':checked')) {  
            var disabilityValue = 'n';   
        } else{
			var disabilityValue = '';   
		}

		if(disabilityValue == "s"){
			$("#bloque3").show();
		} else {		
			$("#bloque3").hide();
		}
		$('.selectpicker').selectpicker('refresh');
	}
	
	function mobilityCityOption(){
		<?php if(($this->Session->check('companyJobContractType.id') == false) and (empty($this->request->data))): ?>
			document.getElementById('CompanyJobContractTypeMobilityCity1').options[0].selected = 'selected';
		<?php endif; ?>
		
		if($("#CompanyJobContractTypeMobilityOption1").is(':checked')) {  
            var valor = '1';  
        } else if($("#CompanyJobContractTypeMobilityOption2").is(':checked')) {  
            var valor = '2';   
        } else{
			var valor = '';   
		}

		if(valor == "1"){
			$('#loading').show();
			$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derp.php',function(JSON)
		   	{
				$('#CompanyJobContractTypeMobilityCity1').empty();
				$('#CompanyJobContractTypeMobilityCity1').append('<option value="">Estado / Entidad Federativa</option>');
				
				var waitCount = 0;
				$.each(JSON, function(key, val){
					waitCount++;
				});

				$.each(JSON, function(key, val){
					if(val.estado == '<?php echo (isset($this->request->data['CompanyJobContractType']['mobility_city']) and ($this->request->data['CompanyJobContractType']['mobility_city'] <> '')) ? $this->request->data['CompanyJobContractType']['mobility_city']: ''; ?>'){
						$('#CompanyJobContractTypeMobilityCity1').append('<option value="' + val.estado + '" selected>' + val.estado + '</option>');
					}else{
						$('#CompanyJobContractTypeMobilityCity1').append('<option value="' + val.estado + '">' + val.estado + '</option>');
					}
					
					if (--waitCount == 0) {
						$('#loading').hide();
						$('.selectpicker').selectpicker('refresh');
					}

				});
				$("#divMobilityCityOption1").show();
				$('#loading').hide();
				$('.selectpicker').selectpicker('refresh');
		   	});
			
			
		} else 
		if(valor == "2"){
			$('#loading').show();
			$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpPaises.php',function(JSON)
		   	{
				$('#CompanyJobContractTypeMobilityCity1').empty();
				$('#CompanyJobContractTypeMobilityCity1').append('<option value="">País</option>');
				
				var waitCount = 0;
				$.each(JSON, function(key, val){
					waitCount++;
				});
				
				$.each(JSON, function(key, val){
					if(val.pais == '<?php echo (isset($this->request->data['CompanyJobContractType']['mobility_city']) and ($this->request->data['CompanyJobContractType']['mobility_city'] <> '')) ? $this->request->data['CompanyJobContractType']['mobility_city']: ''; ?>'){
						$('#CompanyJobContractTypeMobilityCity1').append('<option value="' + val.pais + '" selected>' + val.pais + '</option>');
					}else{
						$('#CompanyJobContractTypeMobilityCity1').append('<option value="' + val.pais + '">' + val.pais + '</option>');
					}
					
					if (--waitCount == 0) {
						$('#loading').hide();
						$('.selectpicker').selectpicker('refresh');
						$("#divMobilityCityOption1").show();
					}
					
				});
		   	});	

		} else {
			$("#divMobilityCityOption1").hide();
		}

	}
	
	function mobilityCityOption2(){
		<?php if(($this->Session->check('companyJobContractType.id') == false) and (empty($this->request->data))): ?>
			document.getElementById('CompanyJobContractTypeChangeResidenceState').options[0].selected = 'selected';
		<?php endif; ?>
		
		
		if($("#CompanyJobContractTypeChangeResidenceOption1").is(':checked')) {  
            var valor = '1';  
        } else if($("#CompanyJobContractTypeChangeResidenceOption2").is(':checked')) {  
            var valor = '2';   
        } else{
			var valor = '';   
		}

		if(valor == "1"){
			$('#loading').show();
			$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derp.php',function(JSON)
		   	{
				$('#CompanyJobContractTypeChangeResidenceState').empty();
				$('#CompanyJobContractTypeChangeResidenceState').append('<option value="">Estado / Entidad Federativa</option>');
				
				var waitCount = 0;
				$.each(JSON, function(key, val){
					waitCount++;
				});

				$.each(JSON, function(key, val){
					if(val.estado == '<?php echo (isset($this->request->data['CompanyJobContractType']['change_residence_state']) and ($this->request->data['CompanyJobContractType']['change_residence_state'] <> '')) ? $this->request->data['CompanyJobContractType']['change_residence_state']: ''; ?>'){
						$('#CompanyJobContractTypeChangeResidenceState').append('<option value="' + val.estado + '" selected>' + val.estado + '</option>');
					}else{
						$('#CompanyJobContractTypeChangeResidenceState').append('<option value="' + val.estado + '">' + val.estado + '</option>');
					}
					
					if (--waitCount == 0) {
						$('#loading').hide();
						$('.selectpicker').selectpicker('refresh');
						$("#divMobilityCityOption2").show();
					}

				});
		   	});
			
			
		} else 
		if(valor == "2"){
			$('#loading').show();
			$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpPaises.php',function(JSON)
		   	{
				$('#CompanyJobContractTypeChangeResidenceState').empty();
				$('#CompanyJobContractTypeChangeResidenceState').append('<option value="">País</option>');
				
				var waitCount = 0;
				$.each(JSON, function(key, val){
					waitCount++;
				});
				
				$.each(JSON, function(key, val){
					if(val.pais == '<?php echo (isset($this->request->data['CompanyJobContractType']['change_residence_state']) and ($this->request->data['CompanyJobContractType']['change_residence_state'] <> '')) ? $this->request->data['CompanyJobContractType']['change_residence_state']: ''; ?>'){
						$('#CompanyJobContractTypeChangeResidenceState').append('<option value="' + val.pais + '" selected>' + val.pais + '</option>');
					}else{
						$('#CompanyJobContractTypeChangeResidenceState').append('<option value="' + val.pais + '">' + val.pais + '</option>');
					}
					
					if (--waitCount == 0) {
						$('#loading').hide();
						$('.selectpicker').selectpicker('refresh');
						$("#divMobilityCityOption2").show();
					}
					
				});
		   	});	

		} else {
			$("#divMobilityCityOption2").hide();
		}

	}
	
    function validateInputs(){
		var selectViajar = $('#CompanyJobContractTypeMobilityCity1').val();
		var selecttResidencia = $('#CompanyJobContractTypeChangeResidenceState').val();
		
		if($("#CompanyJobContractTypeConfidentialSalaryS").is(':checked')) {  
            var sueldoConfidencial = 's';  
        } else if($("#CompanyJobContractTypeConfidentialSalaryN").is(':checked')) {  
            var sueldoConfidencial = 'n';   
        } else{
			var sueldoConfidencial = '';   
		}
		
		if($("#CompanyJobContractTypeMobilityS").is(':checked')) {  
            var viajar = 's';  
        } else if($("#CompanyJobContractTypeMobilityN").is(':checked')) {  
            var viajar = 'n';   
        } else{
			var viajar = '';   
		}	
		
		if($("#CompanyJobContractTypeMobilityOption1").is(':checked')) {  
            var opcionViajar = 's';  
        } else if($("#CompanyJobContractTypeMobilityOption2").is(':checked')) {  
            var opcionViajar = 'n';   
        } else{
			var opcionViajar = '';   
		}	
		
		if($("#CompanyJobContractTypeChangeResidenceS").is(':checked')) {  
            var residencia = 's';  
        } else if($("#CompanyJobContractTypeChangeResidenceN").is(':checked')) {  
            var residencia = 'n';   
        } else{
			var residencia = '';   
		}	
		
		if($("#CompanyJobContractTypeChangeResidenceOption1").is(':checked')) {  
            var opcionResidencia = 's';  
        } else if($("#CompanyJobContractTypeChangeResidenceOption2").is(':checked')) {  
            var opcionResidencia = 'n';   
        } else{
			var opcionResidencia = '';   
		}	
		
		var beneficios = $('#CompanyJobContractTypeBenefitBenefits > option:selected');
	
		if(sueldoConfidencial == ''){
			jAlert('Seleccione una opción para sueldo conficencial', 'Mensaje');
			document.getElementById('CompanyJobContractTypeConfidentialSalaryS').focus();
			return false;
		} else 
		if(viajar == ''){
			jAlert('Seleccione la disponibilidad para viajar', 'Mensaje');
			document.getElementById('CompanyJobContractTypeMobilityS').focus();
			return false;
		} else 
		if((viajar == 's') && (opcionViajar == '')){
			jAlert('Seleccione una opción de disponibilidad para viajar', 'Mensaje');
			document.getElementById('CompanyJobContractTypeMobilityOption1').focus();
			return false;
		} else 
		if((opcionViajar != '') && (selectViajar=='')){
			jAlert('Indique el lugar de disponibilidad para viajar', 'Mensaje');
			document.getElementById('CompanyJobContractTypeMobilityCity1').focus();
			return false;
		} else 
		if(residencia == ''){
			jAlert('Seleccione la disponibilidad para cambiar de residencia', 'Mensaje');
			document.getElementById('CompanyJobContractTypeChangeResidenceS').focus();
			return false;
		} else
		if((residencia == 's') && (opcionResidencia == '')){
			jAlert('Seleccione una opción de disponibilidad para cambiar de residencia', 'Mensaje');
			document.getElementById('CompanyJobContractTypeMobilityOption1').focus();
			return false;
		} else 
		if((opcionResidencia != '') && (selecttResidencia=='')){
			jAlert('Indique el lugar de disponibilidad para cambiar de residencia', 'Mensaje');
			document.getElementById('CompanyJobContractTypeChangeResidenceState').focus();
			return false;
		} else 
		if(beneficios.length == 0){
			 jAlert('Selecciona las prestaciones y apoyos', 'Mensaje');
			document.getElementById('CompanyJobContractTypeBenefitBenefits').focus();
			return false;
		} else 
		{
			return true;
		}
		
	}
</script>

	<div  class="col-md-12 " style="margin-top: 15px;margin-left: 20px;">
	
		<?php echo $this->Session->flash(); ?>	
		
		<?php 
				echo $this->Html->link(	'<i class="glyphicon glyphicon-arrow-left"></i> &nbsp; Regresar',
													array(
															'controller'=>'Companies',
															'action'=>'companyJobProfile',
															),
													array(
															'class' => 'btn btn-default btnBlue ',
															'style' => 'margin-top: 5px; width: 120px;',
															'escape' => false,
															)	
										); 
		?>	
		
					<?php
							echo $this->Form->create('Company', array(
												'class' => 'form-horizontal', 
												'role' => 'form',
												'inputDefaults' => array(
														'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
														'div' => array('class' => 'form-group'),
														'class' => 'form-control',
														'before' => '<div class="col-md-12"><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
														'between' => ' <div class="col-md-11">',
														'after' => '</div></div>',
														'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
												),
										'onsubmit' =>'return validateInputs();',
										'action' => 'CompanyJobContractType',
							)); ?>
					    
						<fieldset style="margin-top: 30px; margin-bottom: 100px;">
							<div class="col-md-6">	
							<?php echo $this->Form->input('CompanyJobContractType.id', array(				
											'label' => '',
											'placeholder' => 'Id',					
							)); ?>
							<?php 	echo $this->Form->input('CompanyJobContractType.contract_type', array(	
											'type' => 'select',
											'before' => '<div class="col-md-11 col-md-offset-1">',
											'class' => 'selectpicker show-tick form-control show-menu-arrow',
											'label' => '',
											'placeholder' => 'Tipo de contrato',
											'options' => $TiposContratos, 'default'=>'0', 'empty' => 'Tipo de contrato'
							)); ?>	
							<?php 	echo $this->Form->input('CompanyJobContractType.contract_length', array(										
											'before' => '<div class="col-md-11 col-md-offset-1">',
											'label' => '',
											'placeholder' => 'Duración de contrato',
							)); ?>	
							<?php 	echo $this->Form->input('CompanyJobContractType.workday', array(										
											'type' => 'select',
											'before' => '<div class="col-md-11 col-md-offset-1">',
											'class' => 'selectpicker show-tick form-control show-menu-arrow',
											'label' => '',
											'placeholder' => 'Jornada laboral',
											'options' => $JornadasLaborales, 'default'=>'0', 'empty' => 'Jornada laboral'
							)); ?>	
							<?php 	echo $this->Form->input('CompanyJobContractType.schedule', array(										
											'before' => '<div class="col-md-11 col-md-offset-1">',
											'label' => '',
											'placeholder' => 'Horario',
							)); ?>	
							<?php 	echo $this->Form->input('CompanyJobContractType.salary', array(	
											'type' => 'select',
											'label' => '',
											'before' => '<div class="col-md-11 col-md-offset-1">',
											'class' => 'selectpicker show-tick form-control show-menu-arrow',
											'options' => $Salarios, 'default'=>'0', 'empty' => 'Sueldo (Neto)'
							)); ?>	
                            
                             <div class="col-md-12" style="margin-left: 35px;" >
								<?php 	
										$options = array('s' => 'Si', 'n' => 'No');
										echo $this->Form->input('CompanyJobContractType.confidential_salary', array(
															'type' => 'radio',
															// 'style' => 'margin-left: -18px; margin-top: 0; top: 1px; width: 15px;',
															'default'=> 0,
															'legend' => false,
															'before' => '<div class="col-xs-12 col-sm-12 col-md-9" style="color: #fff;margin-left: -30px;">
															<img data-toggle="tooltip" id="" data-placement="top" title="Al seleccionar Sí el sueldo no será visible al candidato." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: 5px; margin-left: 5px;">
															<div class="radio-inline col-xs-2 col-sm-2 col-md-2" style=" margin-left: 245px;">',
															'after' => '</label></div></div>',
															'separator' => '</label></div><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
															'options' => $options,
										));
								?>

								<p style="position: absolute; margin-top: -46px;"><span style="color:red;">*</span>Sueldo confidencial</p>
							</div>

							<!--div class="col-md-11" style="margin-left: 41px; margin-top: -8px;">
							<p style="font-size: 16px; margin-bottom: 35px;"> Prestaciones / Apoyos
							</div-->
							<div class="col-md-6"  style="left: 22px; height: 10px;"> <span style="color:red;">*</span> </div>
							<?php 	echo $this->Form->input('CompanyJobContractTypeBenefit.benefits', array(	
															'before' => '<div class="col-md-11 col-md-offset-1" style="margin-top: -20px;"><img data-toggle="tooltip" id="" data-placement="top" title="Opciones de servicios y apoyos que son adicionales al sueldo que son otorgadas al trabajador para hacer más atractiva la oferta." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',			
															
															'multiple' => 'multiple',
															'class' => 'selectpicker show-tick form-control show-menu-arrow',
															'data-live-search' => "true",
															'data-selected-text-format' => 'count > 3',
															'title' => 'Prestaciones / Apoyos ',
															'data-actions-box' => 'true',
																	
															'label' => '',
															'placeholder' => 'Prestaciones y apoyos',
															'options' => $Prestaciones
							)); ?>	

							
							<?php 	echo $this->Form->input('CompanyJobContractType.other_benefits', array(					
															'before' => '<div class="col-md-11 col-md-offset-1"><img data-toggle="tooltip" id="" data-placement="top" title="En este apartado podrá describir las prestaciones o apoyos adicionales a las descritas en el campo anterior." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: 100px;">',					
															'maxlength' => '316',
															'style' => 'resize: vertical; min-height: 120px;  max-height: 120px; height: 120px;',
															'label' => array(
																			'text' => '',),
															'placeholder' => 'Otras',
							)); ?>	
							<div class="col-md-11" style="text-align: right; right; top: -10px;">
								<span id="contadorTaComentario">0/316</span><span> caracteres máx.</span>
							</div>
							</div>
							<div class="col-md-6" style="top: -38px;">	
							<p style="margin-left: 15px;">Lugar de trabajo</p>
							
							<?php 	echo $this->Form->input('CompanyJobContractType.state', array(	
															'type' => 'select',
															'id' =>'estado',
															'before' => '<div class="col-md-11">',
															'class' => 'selectpicker show-tick form-control show-menu-arrow',
															'data-live-search' => "true",
															'label' => '',
															'options' => $Estados,'default'=>'0', 'empty' => 'Estado / Entidad Federativa',
							)); ?>	
							
							<?php 
								echo $this->Form->input('CompanyJobContractType.subdivision', array(	
															'type' => 'select',
															'id' => 'ciudad',
															'before' => '<div class="col-md-11">',
															'class' => 'selectpicker show-tick form-control show-menu-arrow',
															'data-live-search' => "true",
															'label' => '',
															'default'=>'0', 'empty' => 'Delegación / Municipio',
							)); ?>	
							<?php 	echo $this->Form->input('CompanyJobContractType.location_reference', array(								
															'before' => '<div class="col-md-11">',
															'style' => 'resize: vertical; min-height: 120px;  max-height: 120px; height: 120px;',
															'label' => array(
																			'text' => '',),
															'placeholder' => 'Referencia de ubicación...',
							)); ?>	

                        <div class="col-md-12" >
								<?php 	
										$options = array('s' => 'Si', 'n' => 'No');
										echo $this->Form->input('CompanyJobContractType.mobility', array(
															'type' => 'radio',
															// 'style' => 'margin-left: -18px; margin-top: 0; top: 1px; width: 15px;',
															'default'=> 0,
															'legend' => false,
															'before' => '<div class="col-xs-12 col-sm-12 col-md-9" style="color: #fff;"><div class="radio-inline col-xs-2 col-sm-2 col-md-2" style=" margin-left: 245px;"><label>',
															'after' => '</label></div></div>',
															'separator' => '</label></div><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
															'options' => $options,
															'onclick' => 'desabilityMobility()'
										));
								?>

								<p style="position: absolute; margin-top: -46px;"><span style="color:red;">*</span>Disponibilidad para viajar</p>
							</div>
							<div id="bloque2">
								<div class="col-md-12" >
									<?php 	
										$options = array('1' => 'Dentro del país', '2' => 'Fuera del país');
										echo $this->Form->input('CompanyJobContractType.mobility_option', array(
															'type' => 'radio',
															// 'style' => 'margin-left: -18px; margin-top: 0; top: 1px; width: 15px;',
															'default'=> 0,
															'legend' => false,
															'before' => '<div class="col-xs-12 col-sm-12 col-md-12" style="color: #fff;margin-left:40px"><div class="radio-inline col-xs-5 col-sm-5 col-md-5"><label>',
															'after' => '</label></div></div>',
															'separator' => '</label></div><div class="radio-inline col-xs-5 col-sm-5 col-md-5"><label>',
															'options' => $options,
															'onclick' => 'mobilityCityOption();'
										));
										
									?>
								<div id="divMobilityCityOption1" >
									<?php 	echo $this->Form->input('CompanyJobContractType.mobility_city', array(									
																'type'=> 'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-live-search' => "true",
																'id' => 'CompanyJobContractTypeMobilityCity1',
																'before' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 30px;"> ',
																'style' => 'margin-left: -15px;',
																'label' => '',
																'default'=>'0', 'empty' => 'Sin opciones',
									)); ?>	
								</div>
								</div>
							</div>
							
							<div class="col-md-12" >
								<?php 	
										$options = array('s' => 'Si', 'n' => 'No');
										echo $this->Form->input('CompanyJobContractType.change_residence', array(
															'type' => 'radio',
															// 'style' => 'margin-left: -18px; margin-top: 0; top: 1px; width: 15px;',
															'default'=> 0,
															'legend' => false,
															'before' => '<div class="col-xs-12 col-sm-12 col-md-9" style="color: #fff;"style="margin-left:60px";><div class="radio-inline col-xs-2 col-sm-2 col-md-2" style=" margin-left: 245px;"><label>',
															'after' => '</label></div></div>',
															'separator' => '</label></div><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
															'options' => $options,
															'onclick' => 'desabilityMobility2()'
										));
								?>

								<p style="position: absolute; margin-top: -46px;  width: 210px;"><span style="color:red;">*</span>Disponibilidad para cambiar de residencia</p>
							</div>
							<div id="bloque3" >
								<div class="col-md-12" style="padding-left: 0px; padding-right: 30px;" >
								<?php 	
										$options = array('1' => 'Dentro del país', '2' => 'Fuera del país');
										echo $this->Form->input('CompanyJobContractType.change_residence_option', array(
															'type' => 'radio',
															// 'style' => 'margin-left: -18px; margin-top: 0; top: 1px; width: 15px;',
															'default'=> 0,
															'legend' => false,
															'before' => '<div class="col-xs-12 col-sm-12 col-md-12" style="color: #fff;  margin-top: 15px;margin-left:60px"><div class="radio-inline col-xs-5 col-sm-5 col-md-5"><label>',
															'after' => '</label></div></div>',
															'separator' => '</label></div><div class="radio-inline col-xs-5 col-sm-5 col-md-5"><label>',
															'options' => $options,
															'onclick' => 'mobilityCityOption2();'
										));
								?>
								<div id="divMobilityCityOption2" >
									<?php 	echo $this->Form->input('CompanyJobContractType.change_residence_state', array(			
																'type' => 'select',
																'style' => 'margin-left: -15px;',
																'before' => '<div class="col-md-12">',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-live-search' => "true",																
																'class' => 'selectpicker show-tick form-control show-menu-arrow',														
																'label' => '',
																'placeholder' => 'País',
																'default'=>'0', 'empty' => 'Sin opciones',
									)); ?>	
								</div>
								</div>
							

							</div>
							<div class="col-md-12" style="margin-top: 30px;">
								
								<?php if(($this->Session->check('companyJobContractType.id') == true) and (!empty($this->request->data))): ?>
									<div class="col-md-6">
								<?php else:;?>
									<div class="col-md-6 col-md-offset-2">
								<?php endif; ?>
								
								<?php echo $this->Form->button('<i class=" glyphicon glyphicon-floppy-save"></i>&nbsp; Guardar',array(
														'type' => 'submit', 
														'div' => 'form-group',
														'escape' => false,
														'class' => 'btn btnBlue btn-default col-md-9 col-md-offset-3',
														'escape' => false,
											));
								echo $this->Form->end(); 
								?>
								</div>
								<?php if(($this->Session->check('companyJobContractType.id') == true) and (!empty($this->request->data))): ?>
								<div class="col-md-6">
									<div class="btn-group">
											<?php 
													echo $this->Html->link('Continuar &nbsp; <i class="glyphicon glyphicon-arrow-right"></i>',
																				array(
																					'controller'=>'Companies',
																					'action'=>'companyCandidateProfile',
																				),
																				array(
																					'class' => 'btn btn-default btnBlue ',
																					'style' => 'width: 130px;',
																					'escape' => false,
																					)	
												); 	?> 
									</div>
								</div>
								<?php endif; ?>
							</div>
						</div>
						</fieldset>
							
	</div>