 <?php 
	$this->layout = 'administrator';
?>
<script>
	$(document).ready(function() {
		$("#estado").on('change',function (){
					if($("#estado").val() != 0)
						{	
							$('#loading').show();
							$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
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
					$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
						{	
							$('#ciudad').empty();
							$('#ciudad').append('<option value="">Delegación / Municipio</option>');
							
							var waitCount = 0;
							$.each(JSON, function(key, val){
								waitCount++;
							});
									
							$.each(JSON, function(key, val){
								if(val.mun == '<?php echo (($this->Session->check('city')) and ($this->Session->read('city') <> '')) ? $this->Session->read('city'): ''; ?>'){
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
				}
		});			

</script>
		<div class="col-md-12" style="margin-top: 60px;">
		
		<div id="loading" class="modal">
			<p><img src="<?php echo $this->webroot; ?>/img/loading.gif"  style="width: 20px; height: 20px;" /> Cargando catálogo...</p>
		</div>
		
			<?php echo $this->Session->flash(); ?>
			
			<?php	echo $this->Form->create('Administrator', array(
							'type' => 'file',
							'class' => 'form-horizontal', 
							'role' => 'form',
							'inputDefaults' => array(
								'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
								'div' => array('class' => 'form-group'),
								'class' => 'form-control',
								'before' => '<div class="col-md-12 ">',
								'between' => '<div class="col-md-11 ">',
								'after' => '</div></div>',
								'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style'=>'padding-left: 5px; padding-right: 5px;'))
							),
							'action' => 'resultsSpecificSearchCompany',
			)); ?>		
			
			<fieldset>
			<div class="col-md-12" >
				<div class="col-md-6" >
				<?php echo $this->Form->input('company_name', array(
									'label' => '',
									'placeholder' => 'Nombre comercial',
									'value' => $this->Session->read('company_name'),
				)); ?>
				<?php 	echo $this->Form->input('company_type', array(				
									'type'=>'select',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'before' => '<div class="col-md-12 " >',
									'label' => '',
									'placeholder' => 'Tipo',
									'value' => $this->Session->read('company_type'),
									'options' => $tipoEmpresas,'default'=>'0', 'empty' => 'Tipo',								
				)); ?>
				<?php 	echo $this->Form->input('sector', array(		
									'type' => 'select',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'before' => '<div class="col-md-12 " >',
									'label' => '',
									'placeholder' => 'Sector',	
									'value' => $this->Session->read('sector'),
									'options' => $Sectores,'default'=>'0', 'empty' => 'Sector',
				)); ?>
				<?php 	echo $this->Form->input('company_rotation', array(		
									'type' => 'select',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'value' => $this->Session->read('company_rotation'),
									'before' => '<div class="col-md-12 " >',
									'label' => '',
									'placeholder' => 'Giro',	
									'options' => $Giros,'default'=>'0', 'empty' => 'Giro',
				)); ?>
				<?php 	
						$options = array(1 => 'Activa', 0 => 'Inactiva');
						echo $this->Form->input('status', array(		
									'type' => 'select',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'value' => $this->Session->read('status'),
									'before' => '<div class="col-md-12 " >',
									'label' => '',
									'placeholder' => 'Giro',	
									'options' => $options,'default'=>'', 'empty' => 'Estatus',
				)); ?>
				</div>		
				<div class="col-md-6" >
				<?php 	echo $this->Form->input('employees_number', array(		
									'type' => 'select',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'value' => $this->Session->read('employees_number'),
									'label' => '',
									'placeholder' => 'Número de empleados',	
									'options' => $numeroEmpleados,'default'=>'0', 'empty' => 'Número de empleados',
				)); ?>
				<?php echo $this->Form->input('state', array(	
									'id' => 'estado',
									'type' => 'select',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'data-live-search' => 'true',
									'value' => $this->Session->read('state'),
									'before' => '<div class="col-md-12 " >',
									'label' => '',
									'placeholder' => 'Entidad Federativa / Estado',
									'options' => $Estados,'default'=>'0', 'empty' => 'Estado / Entidad Federativa',
				)); ?>
				<?php echo $this->Form->input('city', array(	
									'id' => 'ciudad',
									'type' => 'select',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'data-live-search' => 'true',
									'value' => $this->Session->read('city'),
									'before' => '<div class="col-md-12 " >',
									'label' => '',
									'placeholder' => 'Delegación / Municipio',
									'default'=>'0', 'empty' => 'Delegación / Municipio',
				)); ?>
				<?php echo $this->Form->input('zip', array(	
									'before' => '<div class="col-md-12 " >',	
									'value' => $this->Session->read('zip'),
									'label' => '',
									'placeholder' => 'Código postal',
				)); ?>
				<?php echo $this->Form->input('limite', array('type'=>'hidden')); ?>
				<?php echo $this->Form->input('newSearch', array('type'=>'hidden','value'=> 'nuevaBusqueda')); ?>
				</div>	
			</div>	
			</fieldset>
			
			<div class="col-md-2 col-md-offset-9">
				<?php 
					echo $this->Form->button('Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>', 
													array(
														'type' => 'submit',
														'div' => 'form-group',
														'class' => 'btn btnBlue btn-default',
														'style' => 'width: 150px;',
														'escape' => false,
													)
							);
							echo $this->Form->end(); 
				?>
			</div>
			
		</div>
	