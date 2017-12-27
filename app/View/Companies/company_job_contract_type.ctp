<?php 
	$this->layout = 'company'; 
?>

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
						//http://localhost/bolsabti/app/webroot/php/derpAreas.php
						// $.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
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
					$.get('http://localhost/bolsabti/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
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
	
	function desabilityMobility(){
		<?php if(($this->Session->check('companyJobContractType.id') == false) and (empty($this->request->data))): ?>
			$( "#CompanyJobContractTypeMobilityOption1" ).prop( "checked", false );
			$( "#CompanyJobContractTypeMobilityOption2" ).prop( "checked", false );
			document.getElementById('CompanyJobContractTypeMobilityCity1').options[0].selected = 'selected';
		<?php endif; ?>
		
		$("#divMobilityCityOption1").hide();
		
	
			if(document.getElementById("CompanyJobContractTypeMobility").value == 's') {  
				  var disabilityValue = 's';
			} else if(document.getElementById("CompanyJobContractTypeMobility").value == 'n'){
				 var disabilityValue = 'n';   
			}else{
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
				
		
		if(document.getElementById("CompanyJobContractTypeChangeResidence").value == 's') {  
				  var disabilityValue = 's';  
			} else if(document.getElementById("CompanyJobContractTypeChangeResidence").value == 'n'){
				var disabilityValue = 'n';   
			}else{
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
		
		if(document.getElementById("CompanyJobContractTypeMobilityOption").value == '1') {  
				  var valor = '1';
			} else if(document.getElementById("CompanyJobContractTypeMobilityOption").value == '2'){
				 var valor = '2';   
			}else{
				var valor = '';  
			}
		
		

		if(valor == "1"){
			$('#loading').show();
			$.get('http://localhost/bolsabti/app/webroot/php/derp.php',function(JSON)
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
			$.get('http://localhost/bolsabti/app/webroot/php/derpPaises.php',function(JSON)
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
		
		if(document.getElementById("CompanyJobContractTypeChangeResidenceOption").value == '1') {  
				  var valor = '1';
			} else if(document.getElementById("CompanyJobContractTypeChangeResidenceOption").value == '2'){
				 var valor = '2';   
			}else{
				var valor = '';  
			}
		
		

		if(valor == "1"){
			$('#loading').show();
			$.get('http://localhost/bolsabti/app/webroot/php/derp.php',function(JSON)
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
			$.get('http://localhost/bolsabti/app/webroot/php/derpPaises.php',function(JSON)
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
		
		if(document.getElementById("CompanyJobContractTypeConfidentialSalary").value == 's') {  
				 var sueldoConfidencial = 's';  
			} else if(document.getElementById("CompanyJobContractTypeConfidentialSalary").value == 'n'){
				var sueldoConfidencial = 'n';   
			}else{
				var sueldoConfidencial = '';  
			}

		if(document.getElementById("CompanyJobContractTypeMobility").value == 's') {  
				 var viajar = 's';  
			} else if(document.getElementById("CompanyJobContractTypeMobility").value == 'n'){
				var viajar = 'n';   
			}else{
				var viajar = '';  
			}
			
		if(document.getElementById("CompanyJobContractTypeMobilityOption").value == '1') {  
				  var opcionViajar = '1';
			} else if(document.getElementById("CompanyJobContractTypeMobilityOption").value == '2'){
				 var opcionViajar = '2';   
			}else{
				var opcionViajar = '';  
			}
			
			if(document.getElementById("CompanyJobContractTypeChangeResidence").value == 's') {  
				 var residencia = 's';  
			} else if(document.getElementById("CompanyJobContractTypeChangeResidence").value == 'n'){
				var residencia = 'n';   
			}else{
				var residencia = '';  
			}
		
			if(document.getElementById("CompanyJobContractTypeChangeResidenceOption").value == '1') {  
				  var opcionResidencia = '1';
			} else if(document.getElementById("CompanyJobContractTypeChangeResidenceOption").value == '2'){
				 var opcionResidencia = '2';   
			}else{
				var opcionResidencia = '';  
			}
		
			
		
		var beneficios = $('#CompanyJobContractTypeBenefitBenefits > option:selected');
	
		if(sueldoConfidencial == ''){
		
				 $.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione una opción para sueldo conficencial'});
			document.getElementById('CompanyJobContractTypeConfidentialSalary').focus();
			return false;
		} else 
			if(beneficios.length == 0){
			 $.alert({ title: '!Aviso!',type: 'blue',content: 'Selecciona las prestaciones y apoyos'});
				
			document.getElementById('CompanyJobContractTypeBenefitBenefits').focus();
			return false;
		} else 
		if(viajar == ''){

				 $.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione la disponibilidad para viajar'});
			document.getElementById('CompanyJobContractTypeMobility').focus();
			return false;
		} else 
		if((viajar == 's') && (opcionViajar == '')){
				 $.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione una opción de disponibilidad para viajar'});
			document.getElementById('CompanyJobContractTypeMobilityOption').focus();
			return false;
		} else 
		if((opcionViajar != '') && (selectViajar=='')){
				 $.alert({ title: '!Aviso!',type: 'blue',content: 'Indique el lugar de disponibilidad para viajar'});
			document.getElementById('CompanyJobContractTypeMobilityCity1').focus();
			return false;
		} else 
		if(residencia == ''){
				 $.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione la disponibilidad para cambiar de residencia'});
			document.getElementById('CompanyJobContractTypeChangeResidence').focus();
			return false;
		} else
		if((residencia == 's') && (opcionResidencia =='')){
				 $.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione una opción de disponibilidad para cambiar de residencia'});
			document.getElementById('CompanyJobContractTypeMobilityOption').focus();
			return false;
		} else 
		if((opcionResidencia !='') && (selecttResidencia=='')){
			 $.alert({ title: '!Aviso!',type: 'blue',content: 'Indique el lugar de disponibilidad para cambiar de residencia'});
				 document.getElementById('CompanyJobContractTypeChangeResidenceState').focus();
			return false;
		} else 
		
		{
			return true;
		}
		
	}
</script>

<div class="col-md-12">
	<?= $this->Form->create('Company', [
										'class' => 'form-horizontal', 
										'role' => 'form',
										'inputDefaults' => [
											'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
											'div' => ['class' => 'form-group'],
											'class' => 'form-control',
											'label' => ['class' => 'col-md-12 control-label', 'text'=>''],
											'between' => '<div class="col-md-12">',
											'after' => '</div>',
											'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
										],
									'action' => 'CompanyJobContractType',
								'onsubmit' =>'return validateInputs();']); ?>
	<fieldset>
		<div class="col-md-6">
			<div class="col-md-12">
				<?php echo $this->Form->input('CompanyJobContractType.id', array('label' => '','placeholder' => 'Id',)); ?>
				<?= $this->Form->input('CompanyJobContractType.contract_type', ['type'=>'select','options' => $TiposContratos,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Tipo de contrato']); ?>
				<?= $this->Form->input('CompanyJobContractType.contract_length', ['placeholder' => 'Duración de contrato']); ?>
				<?= $this->Form->input('CompanyJobContractType.workday', ['type'=>'select','options' => $JornadasLaborales,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Jornada laboral']); ?>
				<?= $this->Form->input('CompanyJobContractType.schedule', ['placeholder' => 'Horario']); ?>
				<?= $this->Form->input('CompanyJobContractType.salary', ['type'=>'select','options' => $Salarios,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Sueldo (Neto)']); ?>
				<?php $options = array('s' => 'Si', 'n' => 'No');
					echo $this->Form->input('CompanyJobContractType.confidential_salary', ['type' => 'select','default'=> 0,'empty' => '¿Sueldo confidencial?','options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow']);
				?>
				<?= $this->Form->input('CompanyJobContractTypeBenefit.benefits', ['multiple' => 'multiple','data-selected-text-format' => 'count > 3','data-live-search' => "true",'data-actions-box' => 'true','placeholder' => 'Prestaciones y apoyos','title' => 'Prestaciones / Apoyos ','options' => $Prestaciones,'class' => 'selectpicker show-tick form-control show-menu-arrow']); ?>
				<?= $this->Form->input('CompanyJobContractType.other_benefits', ['placeholder' => 'Otras...','style' => ' max-height: 280px; margin-top: 10px;','maxlength' => '316',]); ?>
				<div class="col-md-12" style="text-align: right;">
				<span id="contadorTaComentario">0/316</span><span> caracteres máx.</span>
				</div>
				
			</div>		
		</div>
		<div class="col-md-6">
			<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
				<p style="color: #588BAD">Lugar de trabajo:</p>
			</blockquote>
			<?= $this->Form->input('CompanyJobContractType.state', ['type'=>'select','id' =>'estado','options' => $Estados,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Estado / Entidad Federativa']); ?>	
			<?= $this->Form->input('CompanyJobContractType.subdivision', ['type'=>'select','id' => 'ciudad','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Delegación / Municipio']); ?>
			<?= $this->Form->input('CompanyJobContractType.location_reference', ['placeholder' => 'Referencia de ubicación...','style' => 'max-height: 280px; margin-top: 0px;','maxlength' => '316',]); ?>
			
			<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
				<p style="color: #588BAD">Disponibilidad para viajar:</p>
			</blockquote>
			
			<?php $options = array('s' => 'Si', 'n' => 'No');
					echo $this->Form->input('CompanyJobContractType.mobility', ['type' => 'select','default'=> 0,'empty' => '¿Disponibilidad para viajar?','options' => $options,'onchange' => 'desabilityMobility()','class' => 'selectpicker show-tick form-control show-menu-arrow']);
			?>
			
			<div id="bloque2" style="display:none">
				<?php $options = array('1' => 'Dentro del país', '2' => 'Fuera del país');
					echo $this->Form->input('CompanyJobContractType.mobility_option', ['type' => 'select','default'=> 0,'empty' => '¿Donde?','options' => $options,'onchange' => 'mobilityCityOption()','class' => 'selectpicker show-tick form-control show-menu-arrow']);
				?>
				<div id="divMobilityCityOption1" >
				<?php 
					echo $this->Form->input('CompanyJobContractType.mobility_city', ['type' => 'select','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => "true",'id' => 'CompanyJobContractTypeMobilityCity1','label' => '','default'=>'0','empty' => 'Sin opciones']);
				?>
				</div>	
			</div>
		
			<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
				<p style="color: #588BAD">Disponibilidad para cambio de residencia:</p>
			</blockquote>
			<?php $options = array('s' => 'Si', 'n' => 'No');
					echo $this->Form->input('CompanyJobContractType.change_residence', ['type' => 'select','default'=> 0,'empty' => '¿Disponibilidad para cambiar de residencia?','options' => $options,'onchange' => 'desabilityMobility2()','class' => 'selectpicker show-tick form-control show-menu-arrow']);
			?>
			<div id="bloque3" style="display:none">
				<?php $options = array('1' => 'Dentro del país', '2' => 'Fuera del país');
					echo $this->Form->input('CompanyJobContractType.change_residence_option', ['type' => 'select','default'=> 0,'empty' => '¿Donde?','options' => $options,'onchange' => 'mobilityCityOption2()','class' => 'selectpicker show-tick form-control show-menu-arrow']);
				?>
				<div id="divMobilityCityOption2" >
				<?php 
					echo $this->Form->input('CompanyJobContractType.change_residence_state', ['type' => 'select','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => "true",'placeholder' => 'País','label' => '','default'=>'0','empty' => 'Sin opciones']);
				?>
				</div>	
			</div>
		</div>	
	</fieldset>	
</div>
<div class="col-md-12  text-center" style="margin-top: 30px;">
	<?php echo $this->Form->button('<i class=" glyphicon glyphicon-floppy-disk"></i>&nbsp; Guardar',array(
							'type' => 'submit', 
							'div' => 'form-group',
							'class' => 'btn btn-primary',
							'escape' => false,
				));
	echo $this->Form->end(); 				
	?>
</div>