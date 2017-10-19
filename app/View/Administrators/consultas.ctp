<?php 
	$this->layout = 'administrator'; 
	ini_set('memory_limit', '512M');
	ini_set('max_execution_time', 180);
?>
	<script>
		$(document).ready(function() {
			
			<?php if(isset($this->request->data['Administrator']['seleccion']) and ($this->request->data['Administrator']['seleccion']<>'')): ?>
			
				if( <?php echo $this->request->data['Administrator']['seleccion']; ?> == 1){
					$('#AdministratorOptionSelect').val("1");
				}else if ( <?php echo $this->request->data['Administrator']['seleccion']; ?> == 2){
					$('#AdministratorOptionSelect').val("2");
				}else if ( <?php echo $this->request->data['Administrator']['seleccion']; ?> == 3){
					$('#AdministratorOptionSelect').val("3");
				}else if ( <?php echo $this->request->data['Administrator']['seleccion']; ?> == 4){
					$('#AdministratorOptionSelect').val("4");
				}else if ( <?php echo $this->request->data['Administrator']['seleccion']; ?> == 5){
					$('#AdministratorOptionSelect').val("5");
				}
			<?php endif; ?>
			$('.selectpicker').selectpicker('refresh');
			desabilityconfidencial();
		}); 
		
		function desabilityconfidencial(){ 		
			if($("#AdministratorOptionSelect option:selected").index() == 1) {  
				$("#contenedorUniversitariosId").show();	
				$("#contenedorEmpresasId").hide();
				$("#contenedorOfertasId").hide();
				$("#contenedorVacantesId").hide();
				$("#contenedorContratacionesId").hide();
				$("#contenedorCompetenciasId").hide();
				$(".seleccionClass").val('1');
			} else if($("#AdministratorOptionSelect option:selected").index() == 2) {  
				$("#contenedorUniversitariosId").hide();	
				$("#contenedorEmpresasId").show();
				$("#contenedorOfertasId").hide();
				$("#contenedorVacantesId").hide();
				$("#contenedorContratacionesId").hide();
				$("#contenedorCompetenciasId").hide();
				$(".seleccionClass").val('2');
			} else if($("#AdministratorOptionSelect option:selected").index() == 3) {  
				$("#contenedorUniversitariosId").hide();	
				$("#contenedorEmpresasId").hide();
				$("#contenedorOfertasId").show();
				$("#contenedorVacantesId").hide();
				$("#contenedorContratacionesId").hide();
				$("#contenedorCompetenciasId").hide();
				$(".seleccionClass").val('3');
			}else if($("#AdministratorOptionSelect option:selected").index() == 4) {  
				$("#contenedorUniversitariosId").hide();	
				$("#contenedorEmpresasId").hide();
				$("#contenedorOfertasId").hide();
				$("#contenedorVacantesId").show();
				$("#contenedorContratacionesId").hide();
				$("#contenedorCompetenciasId").hide();
				$(".seleccionClass").val('4');
			}else if($("#AdministratorOptionSelect option:selected").index() == 5) {  
				$("#contenedorUniversitariosId").hide();	
				$("#contenedorEmpresasId").hide();
				$("#contenedorOfertasId").hide();
				$("#contenedorVacantesId").hide();
				$("#contenedorContratacionesId").show();
				$("#contenedorCompetenciasId").hide();
				$(".seleccionClass").val('5');
			}else{
				$("#contenedorUniversitariosId").hide();	
				$("#contenedorEmpresasId").hide();
				$("#contenedorOfertasId").hide();
				$("#contenedorVacantesId").hide();
				$("#contenedorContratacionesId").hide();
				$("#contenedorCompetenciasId").hide();
				}
		}
		
		function negativo(){
			return false;
		}
		
		function validateDates(tipoFormulario){
			// desabilityconfidencial();
			if(tipoFormulario==1){
				var year1  = $( "#AdministratorFechaInicioUniversitariosYear" ).val();
				var month1 = $( "#AdministratorFechaInicioUniversitariosMonth" ).val();
				var day1   = $( "#AdministratorFechaInicioUniversitariosDay" ).val();
					
				var year2  = $( "#AdministratorFechaFinUniversitariosYear" ).val();
				var month2 = $( "#AdministratorFechaFinUniversitariosMonth" ).val();
				var day2   = $( "#AdministratorFechaFinUniversitariosDay" ).val();
				
				var fecha1 = document.getElementById('AdministratorFechaInicioUniversitariosDay').value	+ "/" +
							document.getElementById('AdministratorFechaInicioUniversitariosMonth').value	+ "/" +
							document.getElementById('AdministratorFechaInicioUniversitariosYear').value;
				
				var fecha2 = document.getElementById('AdministratorFechaFinUniversitariosDay').value	+ "/" +
							document.getElementById('AdministratorFechaFinUniversitariosMonth').value	+ "/" +
							document.getElementById('AdministratorFechaFinUniversitariosYear').value;	
				
			} else
			if(tipoFormulario==2){
				
				var year1  = $( "#AdministratorFechaInicioEmpresasYear" ).val();
				var month1 = $( "#AdministratorFechaInicioEmpresasMonth" ).val();
				var day1   = $( "#AdministratorFechaInicioEmpresasDay" ).val();
					
				var year2  = $( "#AdministratorFechaFinEmpresasYear" ).val();
				var month2 = $( "#AdministratorFechaFinEmpresasMonth" ).val();
				var day2   = $( "#AdministratorFechaFinEmpresasDay" ).val();
				
				var fecha1 = document.getElementById('AdministratorFechaInicioEmpresasDay').value	+ "/" +
							document.getElementById('AdministratorFechaInicioEmpresasMonth').value	+ "/" +
							document.getElementById('AdministratorFechaInicioEmpresasYear').value;
				
				var fecha2 = document.getElementById('AdministratorFechaFinEmpresasDay').value	+ "/" +
							document.getElementById('AdministratorFechaFinEmpresasMonth').value	+ "/" +
							document.getElementById('AdministratorFechaFinEmpresasYear').value;
				
			}else 
			if(tipoFormulario==3){
				
				var year1  = $( "#AdministratorFechaInicioOfertasYear" ).val();
				var month1 = $( "#AdministratorFechaInicioOfertasMonth" ).val();
				var day1   = $( "#AdministratorFechaInicioOfertasDay" ).val();
					
				var year2  = $( "#AdministratorFechaFinOfertasYear" ).val();
				var month2 = $( "#AdministratorFechaFinOfertasMonth" ).val();
				var day2   = $( "#AdministratorFechaFinOfertasDay" ).val();
				
				var fecha1 = document.getElementById('AdministratorFechaInicioOfertasDay').value	+ "/" +
							document.getElementById('AdministratorFechaInicioOfertasMonth').value	+ "/" +
							document.getElementById('AdministratorFechaInicioOfertasYear').value;
				
				var fecha2 = document.getElementById('AdministratorFechaFinOfertasDay').value	+ "/" +
							document.getElementById('AdministratorFechaFinOfertasMonth').value	+ "/" +
							document.getElementById('AdministratorFechaFinOfertasYear').value;
			}else 
			if(tipoFormulario==4){
				
				var year1  = $( "#AdministratorFechaInicioVacantesYear" ).val();
				var month1 = $( "#AdministratorFechaInicioVacantesMonth" ).val();
				var day1   = $( "#AdministratorFechaInicioVacantesDay" ).val();
					
				var year2  = $( "#AdministratorFechaFinVacantesYear" ).val();
				var month2 = $( "#AdministratorFechaFinVacantesMonth" ).val();
				var day2   = $( "#AdministratorFechaFinVacantesDay" ).val();
				
				var fecha1 = document.getElementById('AdministratorFechaInicioVacantesDay').value	+ "/" +
							document.getElementById('AdministratorFechaInicioVacantesMonth').value	+ "/" +
							document.getElementById('AdministratorFechaInicioVacantesYear').value;
				
				var fecha2 = document.getElementById('AdministratorFechaFinVacantesDay').value	+ "/" +
							document.getElementById('AdministratorFechaFinVacantesMonth').value	+ "/" +
							document.getElementById('AdministratorFechaFinVacantesYear').value;
			}else 
			if(tipoFormulario==5){
				
				var year1  = $( "#AdministratorFechaInicioContratacionesYear" ).val();
				var month1 = $( "#AdministratorFechaInicioContratacionesMonth" ).val();
				var day1   = $( "#AdministratorFechaInicioContratacionesDay" ).val();
					
				var year2  = $( "#AdministratorFechaFinContratacionesYear" ).val();
				var month2 = $( "#AdministratorFechaFinContratacionesMonth" ).val();
				var day2   = $( "#AdministratorFechaFinContratacionesDay" ).val();
				
				var fecha1 = document.getElementById('AdministratorFechaInicioContratacionesDay').value	+ "/" +
							document.getElementById('AdministratorFechaInicioContratacionesMonth').value	+ "/" +
							document.getElementById('AdministratorFechaInicioContratacionesYear').value;
				
				var fecha2 = document.getElementById('AdministratorFechaFinContratacionesDay').value	+ "/" +
							document.getElementById('AdministratorFechaFinContratacionesMonth').value	+ "/" +
							document.getElementById('AdministratorFechaFinContratacionesYear').value;
			}else 
			if(tipoFormulario==6){ 
				vigenciaFecha1 = 1;
				vigenciaFecha2 = 1;
				resultadoComparativa = 0;
			}
			
			
			if(tipoFormulario!=6){
				vigenciaFecha1 = validarFecha(fecha1);
				vigenciaFecha2 = validarFecha(fecha2);
				
				// dd/mm/yyyy
				valida1 = day1+'/'+month1+'/'+year1;
				valida2 = day2+'/'+month2+'/'+year2;
				resultadoComparativa=validate_fechaMayorQue(valida1,valida2);
			}
			
				if((year1 == '') || (month1 == '') || (day1 == '') || (year2 == '') || (month2 == '') || (day2 == '')){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione las fechas completas para la búsqueda de coincidencias.'});
					return false;
				} else if(vigenciaFecha1 == false){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha inicio de reporte es incorrecta.'});
					return false;
				} else if(vigenciaFecha2 == false){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha fin de reporte es incorrecta.'});
					return false;
				} else if(resultadoComparativa==1){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha inicio de reporte debe ser menor a la final.'});
					return false;
				}else{
					return true;
				}
		}
			
	</script>
	
	<style>
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
	   padding: 0px;
	   border-top: 0px solid #ddd;
	}
	.table{
		border-collapse: initial;
	}
	</style>
	
	<div class="col-md-10 col-md-offset-1 fondoBti" style="margin-top: 20px; margin-bottom: 30px">
		<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 15px;margin-bottom: 5px;">
	        <p style="color: #fff">Seleccione el tipo de frecuencia.</p>
	    </blockquote>

	    <div class="col-md-12">
			<?php
				echo $this->Form->create('Administrator', array(
								'class' => 'form-horizontal', 
								'role' => 'form',
								'inputDefaults' => array(
									'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
									'div' => array('class' => 'form-group'),
									'class' => 'form-control',
									'label' => array('class' => 'col-md-4 control-label '),
									'before' => '<div class="col-md-12 ">',
									'between' => '<div class="col-md-12 ">',
									'after' => '</div></div>',
									'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
								),
								'onsubmit' =>'return negativo();',
								'action' => 'register',
								
				)); ?>
				<fieldset>
				<?php  
					$options = array(1 => 'Universitarios', 2 => 'Empresas', 3 => 'Ofertas', 4 => 'Vacantes', 5 => 'Contrataciones y seguimiento');
					echo $this->Form->input('Administrator.optionSelect', array(
								'type'=>'select',
								'before' => '<div class="col-md-12 ">',
								'class' => 'selectpicker show-tick form-control show-menu-arrow',
								'label' => '',
								'options' => $options,'default'=>'', 'empty' => 'Selecciona una opción',
								'onChange' => 'desabilityconfidencial()',
								));
			   ?>
			   </fieldset>
				<?php
				echo $this->Form->end(); 
				?>	
		</div>
	
		<div class="col-md-12" style="display: none;" id="contenedorUniversitariosId">	
			<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 15px;margin-bottom: 5px;">
		        <p style="color: #fff">Seleccione el rango de fechas a consultar.</p>
		    </blockquote>
			
				<?= $this->Form->create('Administrator', [
								'class' => 'form-horizontal', 
								'role' => 'form',
								'inputDefaults' => [
									'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
									'div' => ['class' => 'form-group'],
									'class' => 'form-control',
									'label' => ['class' => 'col-md-12  control-label', 'text'=>''],
									'between' => '<div class="col-md-12">',
									'after' => '</div>',
									'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
								],
								'onsubmit' =>'return validateDates(1);',
								'action' => 'consultas',]); ?>

				<fieldset>
					<div class="col-md-6">
						<?= $this->Form->input('fecha_inicio_universitarios', [
																'type' => 'date',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '33.333%',
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - 2,
																'maxYear' => date('Y') - 0]); ?>
					</div>
					
					<div class="col-md-6">
						<?= $this->Form->input('fecha_fin_universitarios', [
																'type' => 'date',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '33.333%',
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - 2,
																'maxYear' => date('Y') - 0]); ?>
					</div>		

					<?= $this->Form->input('Administrator.seleccion', ['type'=>'hidden','class' => 'seleccionClass']); ?>

					<div class="col-md-2 " style="margin-bottom:15px; ">
						<?= $this->Form->button('Consultar &nbsp;<i class="fa fa-search" aria-hidden="true"></i>',['type'=>'submit','class' => 'btn btn-default','escape' => false,'style' => 'width:120px;']);?>
						<?= $this->Form->end(); ?>
					</div>	

				</fieldset>
		</div>
		
		<div class="col-md-12" style="display: none;" id="contenedorEmpresasId">	
			<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 15px;margin-bottom: 5px;">
		        <p style="color: #fff">Seleccione el rango de fechas a consultar.</p>
		    </blockquote>
			
				<?= $this->Form->create('Administrator', [
								'class' => 'form-horizontal', 
								'role' => 'form',
								'inputDefaults' => [
									'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
									'div' => ['class' => 'form-group'],
									'class' => 'form-control',
									'label' => ['class' => 'col-md-12  control-label', 'text'=>''],
									'between' => '<div class="col-md-12">',
									'after' => '</div>',
									'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
								],
								'onsubmit' =>'return validateDates(2);',
								'action' => 'consultas',]); ?>

				<fieldset>
					<div class="col-md-6">
						<?= $this->Form->input('fecha_inicio_empresas', [
																'type' => 'date',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '33.333%',
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - 2,
																'maxYear' => date('Y') - 0]); ?>
					</div>
					
					<div class="col-md-6">
						<?= $this->Form->input('fecha_fin_empresas', [
																'type' => 'date',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '33.333%',
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - 2,
																'maxYear' => date('Y') - 0]); ?>
					</div>		

					<?= $this->Form->input('Administrator.seleccion', ['type'=>'hidden','class' => 'seleccionClass']); ?>

					<div class="col-md-2 " style="margin-bottom:15px; ">
						<?= $this->Form->button('Consultar &nbsp;<i class="fa fa-search" aria-hidden="true"></i>',['type'=>'submit','class' => 'btn btn-default','escape' => false,'style' => 'width:120px;']);?>
						<?= $this->Form->end(); ?>
					</div>	
				</fieldset>
		</div>
		
		<div class="col-md-12" style="display: none;" id="contenedorOfertasId">	
			<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 15px;margin-bottom: 5px;">
		        <p style="color: #fff">Seleccione el rango de fechas a consultar.</p>
		    </blockquote>
			
			<?= $this->Form->create('Administrator', [
								'class' => 'form-horizontal', 
								'role' => 'form',
								'inputDefaults' => [
									'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
									'div' => ['class' => 'form-group'],
									'class' => 'form-control',
									'label' => ['class' => 'col-md-12  control-label', 'text'=>''],
									'between' => '<div class="col-md-12">',
									'after' => '</div>',
									'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
								],
								'onsubmit' =>'return validateDates(3);',
								'action' => 'consultas',]); ?>

				<fieldset>
					<div class="col-md-6">
						<?= $this->Form->input('fecha_inicio_ofertas', [
																'type' => 'date',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '33.333%',
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - 2,
																'maxYear' => date('Y') - 0]); ?>
					</div>
					
					<div class="col-md-6">
						<?= $this->Form->input('fecha_fin_ofertas', [
																'type' => 'date',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '33.333%',
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - 2,
																'maxYear' => date('Y') - 0]); ?>
					</div>		

					<?= $this->Form->input('Administrator.seleccion', ['type'=>'hidden','class' => 'seleccionClass']); ?>

					<div class="col-md-2 " style="margin-bottom:15px; ">
						<?= $this->Form->button('Consultar &nbsp;<i class="fa fa-search" aria-hidden="true"></i>',['type'=>'submit','class' => 'btn btn-default','escape' => false,'style' => 'width:120px;']);?>
						<?= $this->Form->end(); ?>
					</div>	
				</fieldset>
		</div>
		
		<div class="col-md-12" style="display: none;" id="contenedorVacantesId">	
			<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 15px;margin-bottom: 5px;">
		        <p style="color: #fff">Seleccione el rango de fechas a consultar.</p>
		    </blockquote>
			
			<?= $this->Form->create('Administrator', [
								'class' => 'form-horizontal', 
								'role' => 'form',
								'inputDefaults' => [
									'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
									'div' => ['class' => 'form-group'],
									'class' => 'form-control',
									'label' => ['class' => 'col-md-12  control-label', 'text'=>''],
									'between' => '<div class="col-md-12">',
									'after' => '</div>',
									'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
								],
								'onsubmit' =>'return validateDates(4);',
								'action' => 'consultas',]); ?>

				<fieldset>
					<div class="col-md-6">
						<?= $this->Form->input('fecha_inicio_vacantes', [
																'type' => 'date',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '33.333%',
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - 2,
																'maxYear' => date('Y') - 0]); ?>
					</div>
					
					<div class="col-md-6">
						<?= $this->Form->input('fecha_fin_vacantes', [
																'type' => 'date',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '33.333%',
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - 2,
																'maxYear' => date('Y') - 0]); ?>
					</div>		

					<?= $this->Form->input('Administrator.seleccion', ['type'=>'hidden','class' => 'seleccionClass']); ?>

					<div class="col-md-2 " style="margin-bottom:15px; ">
						<?= $this->Form->button('Consultar &nbsp;<i class="fa fa-search" aria-hidden="true"></i>',['type'=>'submit','class' => 'btn btn-default','escape' => false,'style' => 'width:120px;']);?>
						<?= $this->Form->end(); ?>
					</div>	
				</fieldset>
		</div>

		<div class="col-md-12" style="display: none;" id="contenedorContratacionesId">	
			<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 15px;margin-bottom: 5px;">
		        <p style="color: #fff">Seleccione el rango de fechas a consultar.</p>
		    </blockquote>
			
			<?= $this->Form->create('Administrator', [
								'class' => 'form-horizontal', 
								'role' => 'form',
								'inputDefaults' => [
									'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
									'div' => ['class' => 'form-group'],
									'class' => 'form-control',
									'label' => ['class' => 'col-md-12  control-label', 'text'=>''],
									'between' => '<div class="col-md-12">',
									'after' => '</div>',
									'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
								],
								'onsubmit' =>'return validateDates(5);',
								'action' => 'consultas',]); ?>

				<fieldset>
					<div class="col-md-6">
						<?= $this->Form->input('fecha_inicio_contrataciones', [
																'type' => 'date',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '33.333%',
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - 2,
																'maxYear' => date('Y') - 0]); ?>
					</div>
					
					<div class="col-md-6">
						<?= $this->Form->input('fecha_fin_contrataciones', [
																'type' => 'date',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '33.333%',
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - 2,
																'maxYear' => date('Y') - 0]); ?>
					</div>		

					<?= $this->Form->input('Administrator.seleccion', ['type'=>'hidden','class' => 'seleccionClass']); ?>
					<?= $this->Form->input('frecuencias_contrataciones', ['type'=>'hidden']); ?>

					<div class="col-md-2 " style="margin-bottom:15px; ">
						<?= $this->Form->button('Consultar &nbsp;<i class="fa fa-search" aria-hidden="true"></i>',['type'=>'submit','class' => 'btn btn-default','escape' => false,'style' => 'width:120px;']);?>
						<?= $this->Form->end(); ?>
					</div>	
				</fieldset>
		</div>
		
		<div class="col-md-12" style="display: none;" id="contenedorCompetenciasId">	
			<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 15px;margin-bottom: 5px;">
		        <p style="color: #fff">Seleccione el rango de fechas a consultar.</p>
		    </blockquote>
			
			<?= $this->Form->create('Administrator', [
								'class' => 'form-horizontal', 
								'role' => 'form',
								'inputDefaults' => [
									'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
									'div' => ['class' => 'form-group'],
									'class' => 'form-control',
									'label' => ['class' => 'col-md-12  control-label', 'text'=>''],
									'between' => '<div class="col-md-12">',
									'after' => '</div>',
									'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
								],
								'onsubmit' =>'return validateDates(6);',
								'action' => 'consultas',]); ?>

				<fieldset>

					<?= $this->Form->input('Administrator.seleccion', ['type'=>'hidden','class' => 'seleccionClass']); ?>
					<?= $this->Form->input('frecuencias_competencias', ['type'=>'hidden']); ?>

					<div class="col-md-2 " style="margin-bottom:15px; ">
						<?= $this->Form->button('Consultar &nbsp;<i class="fa fa-search" aria-hidden="true"></i>',['type'=>'submit','class' => 'btn btn-default','escape' => false,'style' => 'width:120px;']);?>
						<?= $this->Form->end(); ?>
					</div>	
				</fieldset>
		</div>
		
	</div>

	<?php // Variables para los collaps

		$ShowPerfil = 0; 			//Perfil Universitario
		$ShowPerfilEmpresa = 0; 	//Perfil Empresas
		$ShowOfertas = 0; 			//Ofertas
		$ShowVacantes = 0;			//Vacantes
		$ShowContrataciones = 0; 	//Contrataciones y seguimiento
		$ShowCompetenciasComp = 0; 	//Competencias	

		if(isset($this->request->data['Administrator'])):

			if($this->request->data['Administrator']['seleccion']==1):
				$ShowPerfil = 1;
			else:
				if($this->request->data['Administrator']['seleccion']==2):
					$ShowPerfilEmpresa = 1;
				else:
					if($this->request->data['Administrator']['seleccion']==3):
						$ShowOfertas = 1; 	
					else:
						if($this->request->data['Administrator']['seleccion']==4):
							$ShowVacantes = 1;
						else:
							if($this->request->data['Administrator']['seleccion']==5):
								$ShowContrataciones = 1;
							else:
								if($this->request->data['Administrator']['seleccion']==6):
									$ShowCompetenciasComp = 1;
								endif;
							endif;
						endif;
					endif;
				endif;
			endif;	

	?>
	
	<div class="col-md-12" >	
	<div class = "panel-group" id = "accordion">
	   <div class = "panel panel-default">
		  
			<?php
			if($ShowPerfil == 1):
			?>
			<div class = "panel-heading"> <!-- Perfil Universitarios-->
				 <h4 class = "panel-title">
					<a data-toggle = "collapse" data-parent = "#accordion" class="chevron" href = "#collapse1">
					  Perfil universitarios
					</a>
					<button type="button" class="btn btn-primary btnBlue" style="float: right; padding-top: 6px; margin-top: -10px;" onclick="javascript:imprSelec('collapse1');
																					function imprSelec(muestra)
																						{
																							var ficha=document.getElementById(muestra);
																							var ventimp=window.open(' ','popimpr');
																							ventimp.document.write(ficha.innerHTML);
																							ventimp.document.close();
																							ventimp.print();
																							ventimp.close();
																						};">Imprimir <span class="glyphicon glyphicon-print"></span> </button>

				 </h4>
			  </div>
			  
<div id = "collapse1" class = "panel-collapse collapse in">
	<div class = "panel-body"> <!-- fin1-->
				 
				   <!-- Inicio de tabla PERFIL UNIVERSITARIO -->
			<div class="panel-group">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h4 class="panel-title">
				  <a class="intoCollaps" data-toggle="collapse" href="#datosPersonalesId">Datos Personales</a>
				</h4>
			  </div>
			  <div id="datosPersonalesId" class="panel-collapse collapse">
				<div class="panel-body">	   
				   
			
					<div class="col-md-12"  >
						<table class="table">

								<tr><th colspan="5"><center><p style="color: #000; background-color: #efeeee"><strong>Datos Personales</strong></P></center></th></tr>

								<tbody>			
									<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Total de Universitarios Inscritos</strong></P></center></th></tr>
									<tr>
										<?php 
										if(isset($estudiantes)):
											echo '<td>Total de Registros'. count($estudiantes).'</td>';
										else:
											echo '<td>Total de Registros 0</td>';
										endif;
										?>
										
									</tr>
							
										<!-- sexos-->	
										<?php
											$hombres = 0; 
											$mujeres = 0; 
											$indefinido = 0;

											foreach($estudiantes as $estudiante):
												if($estudiante['StudentProfile']['sex'] == 2):
													$hombres++;
												else: 
													if($estudiante['StudentProfile']['sex'] == 1):
														$mujeres++; 
													else:
														$indefinido++; 
													endif;
												endif; 
											endforeach;
							
											$tabla = '<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Sexos</strong></P></center></th></tr>';
							
											if(count($estudiantes)== 0):
												$tabla.='<tr><td>Femenino 0.0% - ('.$mujeres.')</td></tr>';
												$tabla.='<tr><td>Masculino 0.0% - ('.$hombres.')</td></tr>';
												$tabla.='<tr><td>Sin editar perfil 0.0% - ('.$indefinido.')</td></tr>';
											else:
												if($mujeres == 0):
													$tabla.='<tr><td>Femenino 0.0% - ('.$mujeres.')</td></tr>';
												else:
													$porcientoMujeres = ($mujeres * 100) / count($estudiantes);
													$tabla.='<tr><td>Femenino  '.number_format($porcientoMujeres, 2, '.', '').'% - ('.$mujeres.')</td></tr>';
												endif;
												
												if($hombres == 0):
													$tabla.='<tr><td>Masculino 0.0% - ('.$hombres.')</td></tr>';
												else:
													$porcientoHombres = ($hombres * 100) / count($estudiantes);	
													$tabla.='<tr><td>Masculino '.number_format($porcientoHombres, 2, '.', '').'% - ('.$hombres.')</td></tr>';
												endif;
												
												if($indefinido == 0):
													$tabla.='<tr><td>Sin editar perfil 0.0% - ('.$indefinido.')</td></tr>';
												else:
													$porcientoIndefinido = ($indefinido * 100) / count($estudiantes);	
													$tabla.='<tr><td>Sin editar perfil '.number_format($porcientoIndefinido, 2, '.', '').'% - ('.$indefinido.')</td></tr>';
												endif;
												
											endif;
											echo $tabla;
										?>
							
									<!-- edades -->	

									<?php
										$dia=date('j');
										$mes=date('n');
										$ano=date('Y');
										$edad1 = 0;
										$edad2 = 0;
										$edad3 = 0;
										$edad4 = 0;
										$edad5 = 0;
										$edad6 = 0;
										$sinDefinir = 0;
						
										foreach($estudiantes as $estudiante):
										
											if($estudiante['StudentProfile']['date_of_birth'] <> '000-00-00'):
												$porciones = explode("-", $estudiante['StudentProfile']['date_of_birth']);
												
												$dianaz=$porciones[2];
												$mesnaz=$porciones[1];
												$anonaz=$porciones[0];

												if (($mesnaz == $mes) && ($dianaz > $dia)):
													$ano=($ano-1); 
												endif;

												if ($mesnaz > $mes):
													$ano=($ano-1);
												endif;
												
											else:
												$edad = 201;
											endif;
				
											$edad=($ano-$anonaz);

											if($edad < 19):
												$edad1++;
											else: 
												if($edad >= 19 and $edad <= 24):
													$edad2++; 
												else:
													if($edad >= 25 and $edad <= 29):
														$edad3++; 
													else: 
														if($edad >= 30 and $edad <= 34):
															$edad4++;
														else:
															if($edad >= 35 and $edad <= 39):
																$edad5++;
															else:
																if($edad >= 40 and  $edad < 200):
																	$edad6++;
																else:
																	$sinDefinir++;
																endif;
															endif;
														endif;
													endif; 
												endif;
											endif;
									
										endforeach;
						
										$tabla ='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Edad</strong></P></center></th></tr>';
										if(count($estudiantes)== 0):
											$tabla.='<tr><td>Menor a 19 0.0% - ('.$edad1.')</td></tr>';
											$tabla.='<tr><td>De 19 a 24 0.0% - ('.$edad2.')</td></tr>';
											$tabla.='<tr><td>De 25 a 29 0.0% - ('.$edad3.')</td></tr>'; 
											$tabla.='<tr><td>De 30 a 34 0.0% - ('.$edad4.')</td></tr>';
											$tabla.='<tr><td>De 35 a 39 0.0% - ('.$edad5.')</td></tr>';
											$tabla.='<tr><td>Mayores de 40 0.0% - ('.$edad6.')</td></tr>';
											$tabla.='<tr><td>Sin editar perfil 0.0% - ('.$sinDefinir.')</td></tr>';
										else:
											if ($edad1 == 0):
												$tabla.='<tr><td>Menor a 19 0.0% - ('.$edad1.')</td></tr>';
											else:
												$porcientoEdad1 = ($edad1 * 100) / count($estudiantes);
												$tabla.='<tr><td>Menor a 19 '.number_format($porcientoEdad1, 2, '.', '').'% - ('.$edad1.')</td></tr>';
											endif;
											
											if($edad2 == 0):
												$tabla.='<tr><td>De 19 a 24 0.0% - ('.$edad2.')</td></tr>';
											else:
												$porcientoEdad2 = ($edad2 * 100) / count($estudiantes);	
												$tabla.='<tr><td>De 19 a 24 '.number_format($porcientoEdad2, 2, '.', '').'% - ('.$edad2.')</td></tr>';
											endif;
											
											if ($edad3 == 0):
												$tabla.='<tr><td>De 25 a 29 0.0% - ('.$edad3.')</td></tr>';
											else:
												$porcientoEdad3 = ($edad3 * 100) / count($estudiantes);
												$tabla.='<tr><td>De 25 a 29 '.number_format($porcientoEdad3, 2, '.', '').'% - ('.$edad3.')</td></tr>';	
											endif;
											
											if($edad4 == 0):
												$tabla.='<tr><td>De 30 a 34 0.0% - ('.$edad4.')</td></tr>';
											else:
												$porcientoEdad4 = ($edad4 * 100) / count($estudiantes);
												$tabla.='<tr><td>De 30 a 34 '.number_format($porcientoEdad4, 2, '.', '').'% - ('.$edad4.')</td></tr>';
											endif;
											
											if($edad5 == 0):
												$tabla.='<tr><td>De 35 a 39 0.0% - ('.$edad5.')</td></tr>';
											else:
												$porcientoEdad5 = ($edad5 * 100) / count($estudiantes);
												$tabla.='<tr><td>De 35 a 39 '.number_format($porcientoEdad5, 2, '.', '').'% - ('.$edad5.')</td></tr>';
											endif;
											
											if($edad6 == 0):
												$tabla.='<tr><td>Mayores de 40 0.0% - ('.$edad6.')</td></tr>';
											else:
												$porcientoEdad6 = ($edad6 * 100) / count($estudiantes);	
												$tabla.='<tr><td>Mayores de 40 '.number_format($porcientoEdad6, 2, '.', '').'% - ('.$edad6.')</td></tr>';
											endif;	
											
											if($sinDefinir == 0):
												$tabla.='<tr><td>Sin editar perfil 0.0% - ('.$sinDefinir.')</td></tr>';
											else:
												$porcientoSindefinir = ($sinDefinir * 100) / count($estudiantes);	
												$tabla.='<tr><td>Sin editar perfil '.number_format($porcientoSindefinir, 2, '.', '').'% - ('.$sinDefinir.')</td></tr>';
											endif;	

										endif;
										echo $tabla;
									?>
						
									<!-- discapacidades -->		
									
									<?php 		
										$ceguera = 0; 
										$auditiva = 0; 
										$visual = 0;
										$motora = 0;
										$multiple = 0;
										$sordera = 0; 
										$ninguna = 0;
										$sinDefinir = 0;
										
										foreach ($estudiantes as $estudiante):
										
											
											if($estudiante ['StudentProfile']['disability'] == ''):
												$sinDefinir++;
											else:
												if($estudiante ['StudentProfile']['disability'] == 'n'):
													$ninguna++;
												else:
													if ($estudiante ['StudentProfile']['disability_type'] == 1):
														$ceguera++;
													else:
														if ($estudiante ['StudentProfile']['disability_type'] == 2):
															$auditiva++;
														else:
															if ($estudiante ['StudentProfile']['disability_type'] == 3):
																$visual++;
															else:
																if ($estudiante ['StudentProfile']['disability_type'] == 4):
																	$motora++;
																else:
																	if ($estudiante ['StudentProfile']['disability_type'] == 5):
																		$multiple++;
																	else:
																		if ($estudiante ['StudentProfile']['disability_type'] == 6):
																			$sordera++;
																		endif;
																	endif;
																endif;
															endif;
														endif;
													endif;
												endif;
											endif;
										endforeach;
							
										$tabla ='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Tipo de discapacidad</strong></P></center></th></tr>';	
							
										if(count($estudiantes) == 0):
											$tabla.='<tr><td>Ceguera 0.0% - ('.$ceguera.')</td></tr>';
											$tabla.='<tr><td>Debilidad auditiva 0.0% - ('.$auditiva.')</td></tr>';
											$tabla.='<tr><td>Devilidad visual 0.0% - ('.$visual.')</td></tr>'; 
											$tabla.='<tr><td>Motriz o motora 0.0% - ('.$motora.')</td></tr>';
											$tabla.='<tr><td>Multiples 0.0% - ('.$multiple.')</td></tr>'; 
											$tabla.='<tr><td>Sordera 0.0% - ('.$sordera.')</td></tr>';
											$tabla.='<tr><td>Sin discapacidad 0.0% - ('.$ninguna.')</td></tr>';
											$tabla.='<tr><td>Sin editar perfil 0.0% - ('.$sinDefinir.')</td></tr>';
										else:
										
											if($ceguera == 0):
												$tabla.='<tr><td>Ceguera 0.0% - ('.$ceguera.')</td></tr>';
											else:
												$porcientoCeguera = ($ceguera * 100) / count($estudiantes);
												$tabla.='<tr><td>Ceguera '.number_format($porcientoCeguera, 2, '.', '').'% - ('.$ceguera.')</td></tr>';
											endif;
											
											if($auditiva == 0):
												$tabla.='<tr><td>Debilidad auditiva 0.0% - ('.$auditiva.')</td></tr>';
											else:
												$porcientoAuditiva = ($auditiva * 100) / count($estudiantes);
												$tabla.='<tr><td>Debilidad auditiva '.number_format($porcientoAuditiva, 2, '.', '').'% - ('.$auditiva.')</td></tr>';
											endif;
											
											if($visual == 0):
												$tabla.='<tr><td>Devilidad visual 0.0% - ('.$visual.')</td></tr>';
											else:
												$porcientoVisual = ($visual * 100) / count($estudiantes);
												$tabla.='<tr><td>Devilidad visual '.number_format($porcientoVisual, 2, '.', '').'% - ('.$visual.')</td></tr>'; 
											endif;
											
											if($motora == 0):
												$tabla.='<tr><td>Motriz o motora 0.0% - ('.$motora.')</td></tr>';
											else:
												$porcientoMotora = ($motora * 100) / count($estudiantes);
												$tabla.='<tr><td>Motriz o motora '.number_format($porcientoMotora, 2, '.', '').'% - ('.$motora.')</td></tr>';
											endif;
											
											if($multiple == 0):
												$tabla.='<tr><td>Multiples 0.0% - ('.$multiple.')</td></tr>'; 
											else:
												$porcientoMultiple = ($multiple * 100) / count($estudiantes);
												$tabla.='<tr><td>Multiples '.number_format($porcientoMultiple, 2, '.', '').'% - ('.$multiple.')</td></tr>'; 
											endif;
											
											if($sordera == 0):
												$tabla.='<tr><td>Sordera 0.0% - ('.$sordera.')</td></tr>';
											else:
												$porcientoSordera = ($sordera * 100) / count($estudiantes);
												$tabla.='<tr><td>Sordera '.number_format($porcientoSordera, 2, '.', '').'% - ('.$sordera.')</td></tr>';
											endif;
											
											if($ninguna == 0):
												$tabla.='<tr><td>Sin discapacidad 0.0% - ('.$ninguna.')</td></tr>';
											else:
												$porcientoNinguna = ($ninguna * 100) / count($estudiantes);
												$tabla.='<tr><td>Sin discapacidad '.number_format($porcientoNinguna, 2, '.', '').'% - ('.$ninguna.')</td></tr>';
											endif;	
											
											if($sinDefinir == 0):
												$tabla.='<tr><td>Sin editar perfil 0.0% - ('.$sinDefinir.')</td></tr>';
											else:
												$porcientosinDefinir = ($sinDefinir * 100) / count($estudiantes);
												$tabla.='<tr><td>Sin editar perfil '.number_format($porcientosinDefinir, 2, '.', '').'% - ('.$sinDefinir.')</td></tr>';
											endif;	
											
										endif;
										echo $tabla;
									?>
				
								</tbody>
						</table>
					</div>
			</div>
		  </div>
		</div>
	  </div>
							
		<div class="panel-group">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h4 class="panel-title">
			  <a class="intoCollaps" data-toggle="collapse" href="#formacionAcademicaId">Formación Académica</a>
			</h4>
		  </div>
		  <div id="formacionAcademicaId" class="panel-collapse collapse">
			<div class="panel-body">	

				<table class="table">
				<tbody>
									<!-- Nivel Academico-->

									<?php
										$licenciatura = 0; 
										$especialidad = 0; 
										$maestria = 0;
										$doctorado = 0;
										$sinNivel = 0;
							
										foreach($estudiantes as $estudiante):
											foreach($estudiante['StudentProfessionalProfile'] as $nivel):
												if($nivel['academic_level_id'] == 4):
													$doctorado++; 
												else:
													if($nivel['academic_level_id'] == 3):
													  $maestria++; 
													else:
														if($nivel['academic_level_id'] == 2):
														  $especialidad++; 
														else:
															if($nivel['academic_level_id'] == 1):
															  $licenciatura++;
															endif;
														endif;
													endif;
												endif;
											endforeach;
											
											if(empty($estudiante['StudentProfessionalProfile'])):
												$sinNivel++;
											endif;
										endforeach;
						
										$tabla ='<th><center><P style="color: #000; background-color: #efeeee"><strong>Formación Académica</strong></P></center></th>';
										$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Nivel Academico</strong></P></center></th></tr>';
										
										if(count($estudiantes) == 0):
											$tabla.='<tr><td>Licenciatura 0.0% - ('.$licenciatura.')</td></tr>'; 
											$tabla.='<tr><td>Especialidad 0.0% - ('.$especialidad.')</td></tr>';
											$tabla.='<tr><td>Maestria 0.0% - ('.$maestria.')</td></tr>';
											$tabla.='<tr><td>Doctorado 0.0% - ('.$doctorado.')</td></tr>';
											$tabla.='<tr><td>Sin ningún nivel 0.0% - ('.$sinNivel.')</td></tr>';  
										else:
											if($licenciatura == 0):
												$tabla.='<tr><td>Licenciatura 0.0% - ('.$licenciatura.')</td></tr>'; 
											else:
												$porcientoLicenciatura = ($licenciatura * 100) / count($estudiantes);
												$tabla.='<tr><td>Licenciatura '.number_format($porcientoLicenciatura, 2, '.', '').'% - ('.$licenciatura.')</td></tr>'; 
											endif;
											
											if($especialidad==0):
												$tabla.='<tr><td>Especialidad 0.0% - ('.$especialidad.')</td></tr>';
											else:
												$porcientoEspecialidad = ($especialidad * 100) / count($estudiantes);
												$tabla.='<tr><td>Especialidad '.number_format($porcientoEspecialidad, 2, '.', '').'% - ('.$especialidad.')</td></tr>';
											endif;
											
											if($maestria == 0):
												$tabla.='<tr><td>Maestria 0.0% - ('.$maestria.')</td></tr>';
											else:
												$porcientoMaestria = ($maestria * 100) / count($estudiantes);
												$tabla.='<tr><td>Maestria '.number_format($porcientoMaestria, 2, '.', '').'% - ('.$maestria.')</td></tr>';
											endif;
											
											if($doctorado == 0):
												$tabla.='<tr><td>Doctorado 0.0% - ('.$doctorado.')</td></tr>';
											else:
												$porcientoDoctorado = ($doctorado * 100) / count($estudiantes);	
												$tabla.='<tr><td>Doctorado '.number_format($porcientoDoctorado, 2, '.', '').'% - ('.$doctorado.')</td></tr>';
											endif;
											
											if($sinNivel == 0):
												$tabla.='<tr><td>Sin ningún nivel 0.0% - ('.$sinNivel.')</td></tr>';  
											else:
												$porcientoSinNivel = ($sinNivel * 100) / count($estudiantes);
												$tabla.='<tr><td>Sin ningún nivel '.number_format($porcientoSinNivel, 2, '.', '').'% - ('.$sinNivel.')</td></tr>'; 
											endif; 
										endif;
										echo $tabla;
									?>

									<!-- Situación Académica-->
						
									<?php
										$alumno = 0; 
										$egresado = 0; 
										$titulado = 0;
										$diploma = 0;
										$grados = 0;
										$sinSituacion = 0;	
							
										foreach($estudiantes as $estudiante):
											foreach($estudiante['StudentProfessionalProfile'] as $profesional):
												if($profesional['academic_situation_id'] == 1):
													 $alumno++;
												else: 
													if($profesional['academic_situation_id'] == 2):
														 $egresado++; 
													else:
														if($profesional['academic_situation_id'] == 3):
														$titulado++; 
														else:
															if($profesional['academic_situation_id'] == 4):
															$diploma++; 
															else:
																if($profesional['academic_situation_id'] == 5):
																$grados++; 
																endif;
															endif;
														endif;
													endif;
												endif;
											endforeach;
											if(empty($estudiante['StudentProfessionalProfile'])):
												$sinSituacion++;
											endif;
										endforeach;
							
										$tabla ='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Situación Académica</strong></P></center></th>';
							
										if(count($estudiantes) == 0):
											$tabla.='<tr><td>Estudiante 0.0% - ('.$alumno.')</td></tr>'; 
											$tabla.='<tr><td>Egresado 0.0% - ('.$egresado.')</td></tr>'; 
											$tabla.='<tr> <td>Titulado 0.0% - ('.$titulado.')</td></tr>'; 
											$tabla.='<tr><td>Con diploma 0.0% - ('.$diploma.')</td></tr>';
											$tabla.='<tr><td>Con Grado 0.0% - ('.$grados.')</td></tr>';
											$tabla.='<tr><td>Sin situación académica 0.0% - ('.$sinSituacion.')</td></tr>'; 
										else:
											if($alumno == 0):
												$tabla.='<tr><td>Estudiante 0.0% - ('.$alumno.')</td></tr>'; 
											else:
												$porcientoAlumno = ($alumno * 100) / count ($estudiantes);
												$tabla.='<tr><td>Estudiante '.number_format($porcientoAlumno, 2, '.', '').'% - ('.$alumno.')</td></tr>'; 
											endif;
											
											if($egresado == 0):
												$tabla.='<tr><td>Egresado 0.0% - ('.$egresado.')</td></tr>';
											else:
												$porcientoEgresado = ($egresado * 100) / count($estudiantes);
												$tabla.='<tr><td>Egresado '.number_format($porcientoEgresado, 2, '.', '').'% - ('.$egresado.')</td></tr>'; 
											endif;
											
											if($titulado == 0):
												$tabla.='<tr> <td>Titulado 0.0% - ('.$titulado.')</td></tr>'; 
											else:
												$porcientoTitulado = ($titulado * 100) / count($estudiantes);
												$tabla.='<tr> <td>Titulado '.number_format($porcientoTitulado, 2, '.', '').'% - ('.$titulado.')</td></tr>';
											endif;
											
											if($diploma == 0):
												$tabla.='<tr><td>Con diploma 0.0% - ('.$diploma.')</td></tr>';
											else:
												$porcientoDiploma = ($diploma * 100) / count($estudiantes);	
												$tabla.='<tr><td>Con diploma '.number_format($porcientoDiploma, 2, '.', '').'% - ('.$diploma.')</td></tr>';
											endif;
											
											if($grados == 0):
												$tabla.='<tr><td>Con Grado 0.0% - ('.$grados.')</td></tr>';
											else:
												$porcientoGrados = ($grados * 100) / count($estudiantes);
												$tabla.='<tr><td>Con Grado '.number_format($porcientoGrados, 2, '.', '').'% - ('.$grados.')</td></tr>';
											endif;
											
											if($sinSituacion == 0):
												$tabla.='<tr><td>Sin situación académica 0.0% - ('.$sinSituacion.')</td></tr>'; 
											else:
												$porcientoSinSituacion = ($sinSituacion * 100) / count($estudiantes);
												$tabla.='<tr><td>Sin situación académica '.number_format($porcientoSinSituacion, 2, '.', '').'% - ('.$sinSituacion.')</td></tr>'; 
											endif;
										endif;
										echo $tabla;
									?>
			
									<!-- Movilidad Estudiantil-->
										
									<?php
										$si = 0; 
										$no = 0; 
										$sinMovilidad = 0;
							
										foreach($estudiantes as $estudiante):
											foreach($estudiante['StudentProfessionalProfile'] as $movilidad):
											 if($movilidad['student_mobility']== 's'):
												 $si++;
											 else: 
												 if($movilidad['student_mobility'] ==  'n'):
													 $no++; 
												 endif;
											endif;
											endforeach;		
											if(empty($estudiante['StudentProfessionalProfile'])):
												$sinMovilidad++;
											endif;
										endforeach;
								
										$tabla ='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Movilidad Estudiantil</strong></P></center></th>';
								
								
										if(count($estudiantes)==0):
											$tabla.='<tr><td>Si 0.0% - ('.$si.')</td></tr>'; 
											$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';
											$tabla.='<tr><td>Sin perfil profesional 0.0% - ('.$sinMovilidad.')</td></tr>';
										else:
											if($si == 0):
												$tabla.='<tr><td>Si 0.0% - ('.$si.')</td></tr>';
											else:
												$porcientoSi = ($si * 100) / count($estudiantes);
												$tabla.='<tr><td>Si '.number_format($porcientoSi, 2, '.', '').'% - ('.$si.')</td></tr>';
											endif;
											
											if($no == 0):
												$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';
											else:
												$porcientoNo = ($no * 100) / count($estudiantes);	
												$tabla.='<tr><td>No '.number_format($porcientoNo, 2, '.', '').'% - ('.$no.')</td></tr>';
											endif;
											
											if($sinMovilidad == 0):
												$tabla.='<tr><td>in perfil profesional 0.0% - ('.$sinMovilidad.')</td></tr>';
											else:
												$porcientoSinPerfil = ($sinMovilidad * 100) / count($estudiantes);	
												$tabla.='<tr><td>Sin perfil profesional '.number_format($porcientoSinPerfil, 2, '.', '').'% - ('.$sinMovilidad.')</td></tr>';
											endif;
										endif;
										echo $tabla;
									?>
									
									<!-- Beca durante los estudios -->
										
									<?php
										$sib = 0; 
										$nob = 0; 
										$sinPerfilProfexional = 0;
										
										foreach($estudiantes as $estudiante):
											if(empty($estudiante['StudentProfessionalProfile'])):
												$sinPerfilProfexional++;
											else:
												foreach($estudiante['StudentProfessionalProfile'] as $beca):
													if($beca['scholarship']== 's'):
														$sib++;
														break;
													else: 
														if($beca['scholarship'] ==  'n'):
															$nob++; 
															break;
														endif;
													endif;
												endforeach;			
											endif;
										endforeach;

										$tabla ='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Beca durate sus estudios</strong></P></center></th>';
								
										if(count($estudiantes) == 0):
											
											$tabla.='<tr><td>Si 0.0% - ('.$sib.')</td></tr>'; 
											$tabla.='<tr><td>No 0.0% - ('.$nob.')</td></tr>'; 
											$tabla.='<tr><td>Sin perfil profesional 0.0% - ('.$sinPerfilProfexional.')</td></tr>'; 
										
										else:
											if($sib == 0):
												$tabla.='<tr><td>Si 0.0% - ('.$sib.')</td></tr>'; 
											else:
												$porcientoSib = ($sib * 100) / count($estudiantes);
												$tabla.='<tr><td>Si '.number_format($porcientoSib, 2, '.', '').'% - ('.$sib.')</td></tr>'; 
											endif;
											
											if($nob == 0):
												$tabla.='<tr><td>No 0.0% - ('.$nob.')</td></tr>';
											else:
												$porcientoNob = ($nob * 100) / count($estudiantes);	
												$tabla.='<tr><td>No '.number_format($porcientoNob, 2, '.', '').'% - ('.$nob.')</td></tr>';
											endif;	
											
											if($sinPerfilProfexional == 0):
												$tabla.='<tr><td>Sin perfil profesional 0.0% - ('.$sinPerfilProfexional.')</td></tr>';
											else:
												$porcientosinPerfilProfexional = ($sinPerfilProfexional * 100) / count($estudiantes);	
												$tabla.='<tr><td>Sin perfil profesional '.number_format($porcientosinPerfilProfexional, 2, '.', '').'% - ('.$sinPerfilProfexional.')</td></tr>';
											endif;	
											
										endif;
										echo $tabla;
									?>
							
							
									<!-- programa de becas -->

									<?php
										$programasBeca = array(); 
										
										for($cont=1; $cont<=count($ProgramaBecas); $cont++):
											$programasBeca[$cont] = 0;
										endfor;

										foreach($estudiantes as $estudiante):
											foreach($estudiante['StudentProfessionalProfile'] as $beca):
												for($cont=1; $cont<=count($ProgramaBecas); $cont++):
													if($beca['scholarship_program'] == $cont):
														$programasBeca[$cont]++;
													endif;
												endfor;
											endforeach;
										endforeach;
							 
										$tabla='';
										$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Programa de Becas</strong></P></center></th></tr>';
										for($cont=1;$cont<=count($ProgramaBecas); $cont++):
											if(count($estudiantes)==0):
												$tabla.='<tr><td colspan="4">'.$ProgramaBecas[$cont].' 0.0% - ('.$programasBeca[$cont].')</td></tr>'; 
											else:
												$tabla.='<tr><td colspan="4">'.$ProgramaBecas[$cont].' '.number_format(($programasBeca[$cont] * 100) / count($estudiantes), 2, '.', '').'% - ('.$programasBeca[$cont].')</td></tr>'; 
												$cont++; 	
											endif;
										endfor; 
										echo $tabla;
									?>
				</tbody>
				</table>
			</div>
		  </div>
		</div>
	  </div>

		<div class="panel-group">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h4 class="panel-title">
			  <a class="intoCollaps" data-toggle="collapse" href="#escuelasFacultadesId">Escuelas y Facultades</a>
			</h4>
		  </div>
		  <div id="escuelasFacultadesId" class="panel-collapse collapse">
			<div class="panel-body">	

				<table class="table">
				<tbody>
	  
			
										<tr><th colspan="5"><center><P style="color: #000; background-color: #efeeee"><strong>Escuelas / Facultades / Carreras / Programas</strong></P></center></th></tr>
										
									<?php
										// INICIALIZADMOS TODAS LAS VARIABLES A 0
										$escuelaLicenciatura = array(); 
										$facultadPostgrado = array(); 
										$relEscCar = array(); 
										$relFacPro = array(); 
										$totalProgramas = array(); 
				
										foreach($escuelasId as $escuelaId):
											$escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']] = 0;
										endforeach;
										
										foreach($facultadesId as $facultadId):
											$facultadPostgrado[$facultadId['FacultadPosgrado']['id']] = 0;
										endforeach;
										
										foreach($relacionEscuelaCarrera as $relacion):
											$relEscCar[$relacion['RelacionEscuelaCarrera']['id']] = 0;
										endforeach;
										
										foreach($relacionFacultadProgramas as $relacionF):
											$relFacPro[$relacionF['RelacionFacultadProgramas']['id']] = 0;
										endforeach;

										foreach($facultadesComplete as $programa):
											$totalProgramas[$programa['PosgradoProgram']['id']] = 0;
										endforeach;
										
										$otraInstitucionFacultad = 0;
										$otraInstitucionLicenciatura = 0;
										
										
										foreach($estudiantes as $estudiante):
											foreach($estudiante['StudentProfessionalProfile'] as $escuelaStudent):
												
												//ESCUELAS Y CARRERAS
												if($escuelaStudent['academic_level_id'] == 1):
													// Verifica si es de otra institucion 
													if($escuelaStudent['unam_student'] == 'n'):
														$otraInstitucionLicenciatura++;
													else:
														foreach($escuelasId as $escuelaId):	
															if($escuelaId['FacultadLicenciatura']['id'] == $escuelaStudent['undergraduate_institution']):
																
																//Busca si la carrera es impartida en esa escuela
																foreach($carrerasComplete as $carrera):
																	if($carrera['Career']['id'] == $escuelaStudent['career_id']):
																		
																		//Compara la escuela y carrera en la tabla de relaciones y la agrega en la misma
																		foreach($relacionEscuelaCarrera as $relacion):
																			if(($relacion['RelacionEscuelaCarrera']['facultad_licenciatura_id']==$escuelaId['FacultadLicenciatura']['id']) AND ($relacion['RelacionEscuelaCarrera']['career_id']==$carrera['Career']['career_id'])):
																				$relEscCar[$relacion['RelacionEscuelaCarrera']['id']]++;
																				$escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']]++;
																			endif;
																		endforeach;
																		
																	endif;
																endforeach;
																
															endif;
														endforeach;	
													endif;
												endif;
									
												// FACULTADES Y PROGRAMAS
												if($escuelaStudent['academic_level_id'] > 1):
													if($escuelaStudent['unam_student'] == 'n'):
														$otraInstitucionLicenciatura++;
													else:
														foreach($facultadesId as $facultadId):	
															//Verifica si es la misma Institución
															if($facultadId['FacultadPosgrado']['id'] == $escuelaStudent['undergraduate_institution']): 
																
																//Busca si la carrera es impartida en esa facultad
																foreach($facultadesComplete as $programa):
																	if($programa['PosgradoProgram']['id'] == $escuelaStudent['posgrado_program_id']):
											
																		//Compara la escuela y carrera en la tabla de relación 
																		foreach($relacionFacultadProgramas as $relacionF):
																			if(($relacionF['RelacionFacultadProgramas']['facultad_posgrado_id']==$facultadId['FacultadPosgrado']['id']) AND ($relacionF['RelacionFacultadProgramas']['posgrado_program_id']==$programa['PosgradoProgram']['posgrado_program_id'])):
																				$relFacPro[$relacionF['RelacionFacultadProgramas']['id']]++;
																				$facultadPostgrado[$facultadId['FacultadPosgrado']['id']]++;
																			endif;
																		endforeach;
																	endif;
																endforeach;
																
															endif;
														endforeach;	
													endif;
												endif;
												

											endforeach;
										endforeach;	

										//Imprimir Facultades 
										$facultades = array(); 
										
										foreach($facultadesId as $facultad):
											$facultades[$facultad['FacultadPosgrado']['id']] = 0;
										endforeach;
											
										 foreach($estudiantes as $estudiante):
											foreach($estudiante['StudentProfessionalProfile'] as $escuelaFac):
												if(($escuelaFac['undergraduate_institution'] <> '') AND ($escuelaFac['academic_level_id']>1)):
													$facultades[$escuelaFac['undergraduate_institution']]++;
												endif;
											endforeach;
										endforeach;
										
										echo '<tr><th colspan="5"><center><P  style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Facultades</strong></P></center></th></tr>';	

										foreach($facultadesId as $facultad):
											if(count($estudiantes)==0):
												$tabla='<tr><td>'.$facultad['FacultadPosgrado']['facultad_posgrado'].' 0.0% - ('.$facultades[$facultad['FacultadPosgrado']['id']].')</td></tr>';
											else:
												$tabla='<tr><td>'.$facultad['FacultadPosgrado']['facultad_posgrado'].' '.number_format(($facultades[$facultad['FacultadPosgrado']['id']] * 100) / count($estudiantes), 2, '.', '').' % - ('.$facultades[$facultad['FacultadPosgrado']['id']].')</td></tr>';
											endif;
											
										echo $tabla;
										endforeach;
										
										if(count($estudiantes)==0):
											echo '<tr><td>FACULTAD NO UNAM 0.0% - ('.$otraInstitucionFacultad.')</td></tr>';
										else:
											echo '<tr><td>FACULTAD NO UNAM '.number_format(($otraInstitucionFacultad * 100) / count($estudiantes), 2, '.', '').' % - ('.$otraInstitucionFacultad.')</td></tr>';
										endif;
										
										echo '<tr><th colspan="5"><center><P  style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Facultades / Programas</strong></P></center></th></tr>';	
										
										foreach ($facultadesId as $facultadId):	
											$tabla='';
											if(count($estudiantes)==0):
												$tabla.='<tr><td style="color: #000; background-color: #efeeee">'.$facultadId['FacultadPosgrado']['facultad_posgrado'].' 0.0% - ('.$facultadPostgrado[$facultadId['FacultadPosgrado']['id']].')</td></tr>';
											else:
												$tabla.='<tr><td style="color: #000; background-color: #efeeee">'.$facultadId['FacultadPosgrado']['facultad_posgrado'].' '.number_format(($facultadPostgrado[$facultadId['FacultadPosgrado']['id']] * 100) / count($estudiantes), 2, '.', '').' % - ('.$facultadPostgrado[$facultadId['FacultadPosgrado']['id']].')</td></tr>';
											endif;
											
												foreach($relacionFacultadProgramas as $relacionF):
													if($relacionF['RelacionFacultadProgramas']['facultad_posgrado_id'] == $facultadId['FacultadPosgrado']['id']):
														
														foreach($facultadesComplete as $programa):
															
															if($programa['PosgradoProgram']['posgrado_program_id'] == $relacionF['RelacionFacultadProgramas']['posgrado_program_id']):
																$facultadImprimir = $programa['PosgradoProgram']['posgrado_program'];
																$totalImprimir = $relFacPro[$relacionF['RelacionFacultadProgramas']['id']];
																break;
															endif;
															
														endforeach;
														
														if($facultadPostgrado[$facultadId['FacultadPosgrado']['id']] == 0):
															$res = 0;
														else:
															$res = number_format(($totalImprimir* 100) / $facultadPostgrado[$facultadId['FacultadPosgrado']['id']], 2, '.', '');
														endif;
														
														$tabla.='<tr><td style="padding-left: 20px;">'.$facultadImprimir.' '.$res.'% - ('.$totalImprimir.')</td></tr>';
													endif;
												endforeach;
											
											echo $tabla;
										endforeach;	 	
										
										if(count($estudiantes)==0):
											echo '<tr><td style="color: #000; background-color: #efeeee">FACULTAD NO UNAM 0.0% - ('.$otraInstitucionFacultad.')</td></tr>';
										else:
											echo '<tr><td style="color: #000; background-color: #efeeee">FACULTAD NO UNAM '.number_format(($otraInstitucionFacultad * 100) / count($estudiantes), 2, '.', '').' % - ('.$otraInstitucionFacultad.')</td></tr>';
										endif;
											
										if(count($estudiantes)==0):
											echo '<tr><td style="padding-left: 20px;" >PROGRAMA NO UNAM 0.0% - ('.$otraInstitucionFacultad.')</td></tr>';
										else:
											echo '<tr><td style="padding-left: 20px;" >PROGRAMA NO UNAM '.number_format(($otraInstitucionFacultad * 100) / count($estudiantes), 2, '.', '').' % - ('.$otraInstitucionFacultad.')</td></tr>';
										endif;
										
										//Imprimir Escuelas 
										
										$licenciatura = array(); 
										foreach($escuelasId as $escuela):
											$licenciatura[$escuela['FacultadLicenciatura']['id']] = 0;
										endforeach;
										
										foreach($estudiantes as $estudiante):
											foreach($estudiante['StudentProfessionalProfile'] as $escuelaLic):
												if(($escuelaLic['undergraduate_institution'] <> '') AND ($escuelaLic['academic_level_id']==1)):
													$licenciatura[$escuelaLic['undergraduate_institution']]++;
												endif;
											endforeach;
										endforeach;

										echo '<tr><th colspan="5"><center><P  style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Escuelas</strong></P></center></th></tr>';	
										 
										foreach ($escuelasId as $escuela):
											if(count($estudiantes)==0):
												$tabla='<tr><td>'.$escuela['FacultadLicenciatura']['facultad_licenciatura'].' 0.0% - ('.$licenciatura[$escuela['FacultadLicenciatura']['id']].')</td></tr>';
											else:
												$tabla='<tr><td>'.$escuela['FacultadLicenciatura']['facultad_licenciatura'].' '.number_format(($licenciatura[$escuela['FacultadLicenciatura']['id']] * 100) / count($estudiantes), 2, '.', '').' % - ('.$licenciatura[$escuela['FacultadLicenciatura']['id']].')</td></tr>';
											endif;
										echo $tabla;
										endforeach;
										
										if(count($estudiantes)==0):
											echo '<tr><td>ESCUELA NO UNAM 0.0% - ('.$otraInstitucionLicenciatura.')</td></tr>';
										else:
											echo '<tr><td>ESCUELA NO UNAM '.number_format(($otraInstitucionLicenciatura * 100) / count($estudiantes), 2, '.', '').' % - ('.$otraInstitucionLicenciatura.')</td></tr>';
										endif;
										
										echo '<tr><th colspan="5"><center><P  style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Escuelas / Carreras</strong></P></center></th></tr>';	
										
										foreach ($escuelasId as $escuelaId):
											$tabla='';
											if(count($estudiantes)==0):
												$tabla.='<tr><td style="color: #000; background-color: #efeeee">'.$escuelaId['FacultadLicenciatura']['facultad_licenciatura'].' 0.0% - ('.$escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']].')</td></tr>';
											else:
												$tabla.='<tr><td style="color: #000; background-color: #efeeee">'.$escuelaId['FacultadLicenciatura']['facultad_licenciatura'].' '.number_format(($escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']] * 100) / count($estudiantes), 2, '.', '').' % - ('.$escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']].')</td></tr>';
											endif;
											
												$var = $escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']];
												foreach($relacionEscuelaCarrera as $relacion):
													if($relacion['RelacionEscuelaCarrera']['facultad_licenciatura_id'] == $escuelaId['FacultadLicenciatura']['id']):
														
														foreach($carrerasComplete as $carrera):
															
															if($carrera['Career']['career_id'] == $relacion['RelacionEscuelaCarrera']['career_id']):
																$carreraImprimir = $carrera['Career']['career'];
																$totalImprimir = $relEscCar[$relacion['RelacionEscuelaCarrera']['id']];
																break;
															endif;
															
														endforeach;
														
														if($escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']] == 0):
															$res = 0;
														else:
															$res = number_format(($totalImprimir* 100) / $escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']], 2, '.', '');
														endif;
														
														$tabla.='<tr><td style="padding-left: 20px;">'.$carreraImprimir.' '.$res.'% - ('.$totalImprimir.')</td></tr>';
													endif;
												endforeach;
											
											echo $tabla;
										endforeach;	
										
										if(count($estudiantes)==0):
											echo '<tr><td style="color: #000; background-color: #efeeee">INSTITUCION NO UNAM 0.0% - ('.$otraInstitucionLicenciatura.')</td></tr>';
										else:
											echo '<tr><td style="color: #000; background-color: #efeeee">INSTITUCION NO UNAM '.number_format(($otraInstitucionLicenciatura * 100) / count($estudiantes), 2, '.', '').' % - ('.$otraInstitucionLicenciatura.')</td></tr>';
										endif;
										
										if(count($estudiantes)==0):
											echo '<tr><td style="padding-left: 20px;" >CARRERA NO UNAM 0.0% - ('.$otraInstitucionLicenciatura.')</td></tr>';
										else:
											echo '<tr><td style="padding-left: 20px;" >CARRERA NO UNAM '.number_format(($otraInstitucionLicenciatura * 100) / count($estudiantes), 2, '.', '').' % - ('.$otraInstitucionLicenciatura.')</td></tr>';
										endif;
									
									?>
				</tbody>
				
				</table>

		</div>
		  </div>
		</div>
	  </div>
			
		<div class="panel-group">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h4 class="panel-title">
			  <a class="intoCollaps" data-toggle="collapse" href="#conocimientosProfecionalessId">Conocimientos y Habilidades Profesionales</a>
			</h4>
		  </div>
		  <div id="conocimientosProfecionalessId" class="panel-collapse collapse">
			<div class="panel-body">

				<table class="table">
					<tbody>
			
		
									<!-- Certificación en computo-->
								
									<?php
										$sic = 0; 
										$noc = 0;
										$sinCertificacion = 0;
										
										foreach($estudiantes as $estudiante):
											if(empty($estudiante['StudentTechnologicalKnowledge'])):
												$sinCertificacion++;
											else:
												foreach($estudiante['StudentTechnologicalKnowledge'] as $comp):
													if($comp['institution']==''):
														$noc++;
													else:
														$sic++;
													endif;
												endforeach;	
											endif;
										endforeach;
										
										$tabla ='<tr><th colspan="5"><center><p style="color: #000; background-color: #efeeee"><strong>Conocimientos y habilidades profesionales</strong></P></center></th></tr>';
										$tabla.='<tr><th colspan="5"><center><p style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Totales que presentan una certificación en cómputo</strong></P></center></th></tr>';
										
										if(count($estudiantes)== 0):
											$tabla.='<tr><td>Si 0.0% - ('.$sic.')</td></tr>';
											$tabla.='<tr><td>No 0.0% - ('.$noc.')</td></tr>';
											$tabla.='<tr><td>Sin perfil profesional 0.0% - ('.$sinCertificacion.')</td></tr>';
										else:
											if($sic == 0):
												$tabla.='<tr><td>Si 0.0% - ('.$sic.')</td></tr>';
											else:
												$porcientoSic = ($sic * 100) / count($estudiantes);
												$tabla.='<tr><td>Si '.number_format($porcientoSic, 2, '.', '').'% - ('.$sic.')</td></tr>';
											endif;
												
											if($noc == 0):
												$tabla.='<tr><td>No 0.0% - ('.$noc.')</td></tr>';
											else:
												$porcientoNoc = ($noc * 100) / count($estudiantes);	
												$tabla.='<tr><td>No '.number_format($porcientoNoc, 2, '.', '').'% - ('.$noc.')</td></tr>';
											endif;
											
											if($sinCertificacion == 0):
												$tabla.='<tr><td>Sin perfil profesional 0.0% - ('.$sinCertificacion.')</td></tr>';
											else:
												$porcientosinCertificacion = ($sinCertificacion * 100) / count($estudiantes);	
												$tabla.='<tr><td>Sin perfil profesional '.number_format($porcientosinCertificacion, 2, '.', '').'% - ('.$sinCertificacion.')</td></tr>';
											endif;
										endif;
										echo $tabla;
									?>

									<tr><th colspan="5"><center><p style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Idiomas Universitarios</strong></P></center></th></tr>
						</tbody>
				</table>
									<?php
										$Idiomas = array(); 
										$SinIdiomas = 0;
										$Lbajo = array(); 
										$Lmedio = array(); 
										$Lalto = array(); 
										$Ebajo = array(); 
										$Emedio = array(); 
										$Ealto = array(); 
										$Cbajo = array(); 
										$Cmedio = array(); 
										$Calto = array(); 
				
										foreach($Lenguagesid as $Lenguageid):
											$cont = $Lenguageid['Lenguage']['id'];
											$Idiomas[$cont] = 0;
											$Lbajo[$cont] = 0;
											$Lmedio[$cont] = 0;
											$Lalto[$cont] = 0;
											$Ebajo[$cont] = 0;
											$Emedio[$cont] = 0;
											$Ealto[$cont] = 0;
											$Cbajo[$cont] = 0;
											$Cmedio[$cont] = 0;
											$Calto[$cont] = 0;
										endforeach;
				
										foreach($estudiantes as $estudiante):
											if(empty($estudiante ['StudentLenguage'])):
												$SinIdiomas++;
											endif;
										
											foreach ($estudiante ['StudentLenguage'] as $lengua):
												foreach($Lenguagesid as $Lenguageid):
													$cont = $Lenguageid['Lenguage']['id'];
													if($lengua ['language_id'] == $cont):
														$Idiomas[$cont]++;
														
														if($lengua['reading_level'] == 1):
															$Lbajo[$cont]++;
														endif;
																
														if($lengua['reading_level'] == 2):
															$Lmedio[$cont]++;
														endif;
																	
														if($lengua['reading_level'] == 3):
															$Lalto[$cont]++;	
														endif;
																		
														if($lengua['writing_level'] == 1):
															$Ebajo[$cont]++;
														endif;
																			
														if($lengua['writing_level'] == 2):
															$Emedio[$cont]++;
														endif;
																				
														if($lengua['writing_level'] == 3):
															$Ealto[$cont]++;	
														endif;
														
														if($lengua['conversation_level'] == 1):
															$Cbajo[$cont]++;
														endif;
																						
														if($lengua['conversation_level'] == 2):
															$Cmedio[$cont]++;
														endif;
																							
														if($lengua['conversation_level'] == 3):
															$Calto[$cont]++;	
														endif;		
														
													endif;										
												endforeach;
											endforeach;
										endforeach;
				
									?>
							<table class="table myStyle">
								
								<?php  
		
							echo '<tr>
								  <td></td>
								  <td colspan="3"> Lectura  </td>
								  <td colspan="3"> Escritura  </td>
								  <td colspan="3"> Comprensión  </td>
								  <td></td></tr>		
								  <tr><th colspan="11">  </th></tr>';
							echo '<tr>
								  <td> Idioma </td>
								  <td>  Bajo </td>
								  <td>  Medio </td>
								  <td>  Alto </td>
								  <td>  Baja </td>
								  <td>  Media </td>
								  <td>  Alta </td>
								  <td>  Baja </td>
								  <td>  Media </td>
								  <td>  Alta </td>
								  <td> Total </td></tr>
								  <tr><th colspan="11">  </th></tr>';

								// $i=1;
								foreach($Lenguagesid as $Lenguageid):
									$i = $Lenguageid['Lenguage']['id'];
								
									if($Idiomas[$i]==0):
										$PorcentajeIdioma = '0.0';
										$tabla='<tr><td>'.$Lenguageid['Lenguage']['lenguage'].'</td>';
										$tabla.='<td> 0.0% - ('.$Lbajo[$i].')</td>';
										$tabla.='<td> 0.0% - ('.$Lmedio[$i].')</td>';
										$tabla.='<td> 0.0% - ('.$Lalto[$i].')</td>';
										$tabla.='<td> 0.0% - ('.$Ebajo[$i].')</td>';
										$tabla.='<td> 0.0% - ('.$Emedio[$i].')</td>';
										$tabla.='<td> 0.0% - ('.$Ealto[$i].')</td>';
										$tabla.='<td> 0.0% - ('.$Cbajo[$i].')</td>';
										$tabla.='<td> 0.0% - ('.$Cmedio[$i].')</td>';
										$tabla.='<td> 0.0% - ('.$Calto[$i].')</td>';
									else:
										$PorcentajeIdioma = ($Idiomas[$i] * 100) / count($estudiantes);
										
										$PorcentajeLbajo = ($Lbajo[$i] * 100) / $Idiomas[$i];
										$PorcentajeLmedio = ($Lmedio[$i] * 100) / $Idiomas[$i];
										$PorcentajeLalto = ($Lalto[$i] * 100) / $Idiomas[$i];
										$PorcentajeEbajo = ($Ebajo[$i] * 100) / $Idiomas[$i];
										$PorcentajeEmedio = ($Emedio[$i] * 100) / $Idiomas[$i];
										$PorcentajeEalto = ($Ealto[$i] * 100) / $Idiomas[$i];
										$PorcentajeCbajo = ($Cbajo[$i] * 100) / $Idiomas[$i];
										$PorcentajeCmedio = ($Cmedio[$i] * 100) / $Idiomas[$i];
										$PorcentajeCalto = ($Calto[$i] * 100) / $Idiomas[$i];
										
										$tabla='<tr><td>'.$Lenguageid['Lenguage']['lenguage'].'</td>';
										$tabla.='<td> '.number_format($PorcentajeLbajo, 2, '.', '').' % - ('.$Lbajo[$i].')</td>';
										$tabla.='<td> '.number_format($PorcentajeLmedio, 2, '.', '').' % - ('.$Lmedio[$i].')</td>';
										$tabla.='<td> '.number_format($PorcentajeLalto, 2, '.', '').' % - ('.$Lalto[$i].')</td>';
										$tabla.='<td> '.number_format($PorcentajeEbajo, 2, '.', '').' % - ('.$Ebajo[$i].')</td>';
										$tabla.='<td> '.number_format($PorcentajeEmedio, 2, '.', '').' % - ('.$Emedio[$i].')</td>';
										$tabla.='<td> '.number_format($PorcentajeEalto, 2, '.', '').' % - ('.$Ealto[$i].')</td>';
										$tabla.='<td> '.number_format($PorcentajeCbajo, 2, '.', '').' % - ('.$Cbajo[$i].')</td>';
										$tabla.='<td> '.number_format($PorcentajeCmedio, 2, '.', '').' % - ('.$Cmedio[$i].')</td>';
										$tabla.='<td> '.number_format($PorcentajeCalto, 2, '.', '').' % - ('.$Calto[$i].')</td>';
									endif;
									
									$tabla.='<td colspan="2">'.number_format($PorcentajeIdioma, 2, '.', '').' % - ('.$Idiomas[$i].')</td></tr>';
								
								// $i++;
								echo $tabla;
								endforeach;
								
								if($SinIdiomas == 0):
									echo '<tr><td colspan="10">Sin idioma agregado</td><td>0.0% - ('.$SinIdiomas.')</td></tr>';
								else:
									$porcientoSinIdiomas = ($SinIdiomas * 100) / count($estudiantes);	
									echo '<tr><td  colspan="10">Sin idioma agregado </td><td>'.number_format($porcientoSinIdiomas, 2, '.', '').'% - ('.$SinIdiomas.')</td></tr>';
								endif;
						?>	
							
						</table>

					
				</div>
			</div>
		</div>
	</div>
					
		<div class="panel-group">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h4 class="panel-title">
			  <a class="intoCollaps" data-toggle="collapse" href="#experienciaProfecionalId">Experiencia Profesional</a>
			</h4>
		  </div>
		  <div id="experienciaProfecionalId" class="panel-collapse collapse">
			<div class="panel-body">

		<table class="table">
		<tbody>	
								<!-- Trabaja actualmente-->
						
								<?php
									$sit = 0; 
									$not = 0; 
									$SinExperienciaEditada = 0;
									
									foreach($estudiantes as $estudiante):
										if(!empty($estudiante['StudentProfessionalExperience'])):
											foreach($estudiante['StudentProfessionalExperience'] as $profess):
												foreach ($profess['StudentWorkArea'] as $actual):
													if($actual['current'] == 1):
														$sit++;
													else: 
													if ($actual ['current'] == 0): 
														$not++; 
													endif;
													endif;
												endforeach;			
											endforeach;
										else:
											$SinExperienciaEditada++;
										endif;
									endforeach;
									
									$tabla ='<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Experiencia profesional</strong></P></center></th></tr>';
									$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Trabaja actualmente</strong></P></center></th></tr>';
									
									if(count($estudiantes) == 0):							
										$tabla.='<tr><td>Si 0.0% - ('.$sit.')</td></tr>';
										$tabla.='<tr><td>No 0.0% - ('.$not.')</td></tr>'; 	
										$tabla.='<tr><td>Sin experiencias registradas 0.0% - ('.$SinExperienciaEditada.')</td></tr>'; 										
									else:								
										if($sit == 0):
											$tabla.='<tr><td>Si 0.0% - ('.$sit.')</td></tr>';
										else:
											$porcientoSit = ($sit * 100) / count($estudiantes);
											$tabla.='<tr><td>Si '.number_format($porcientoSit, 2, '.', '').'% - ('.$sit.')</td></tr>';
										endif;
										
										if($not == 0):
											$tabla.='<tr><td>No 0.0% - ('.$not.')</td></tr>';
										else:
											$porcientoNot = ($not * 100) / count($estudiantes);
											$tabla.='<tr><td>No '.number_format($porcientoNot, 2, '.', '').'% - ('.$not.')</td></tr>'; 
										endif;
										
										if($SinExperienciaEditada == 0):
											$tabla.='<tr><td>Sin experiencias registradas 0.0% - ('.$SinExperienciaEditada.')</td></tr>';
										else:
											$porcientoSinExperienciaEditada = ($SinExperienciaEditada * 100) / count($estudiantes);
											$tabla.='<tr><td>Sin experiencias registradas '.number_format($porcientoSinExperienciaEditada, 2, '.', '').'% - ('.$SinExperienciaEditada.')</td></tr>'; 
										endif;
										
									endif;
									echo $tabla;
								?>

								<!-- Tipo de contrato-->
						
								<?php
									$base = 0; 
									$becario = 0; 
									$capacitacion = 0;
									$confianza = 0; 
									$honorarios = 0; 
									$horas = 0;
									$practicas = 0; 
									$tercerizacion = 0;
									$indeterminado = 0; 
									$prueba = 0;
									$definido = 0;
										
									 foreach($estudiantes as $estudiante):
										foreach($estudiante['StudentProfessionalExperience'] as $contrato):
											if($contrato['contract_type'] == 1):
												 $base++; 
											else:
												if($contrato['contract_type'] == 2):
												 $becario++; 
												else:
													if($contrato['contract_type'] == 3):
													$capacitacion++; 
													else:
														if($contrato['contract_type'] == 4):
														 $confianza++;
														else:
															if($contrato['contract_type'] == 5):
																$honorarios++; 
															else:
																if($contrato['contract_type'] == 6):
																	$horas++; 
																else:
																	if($contrato['contract_type'] == 7):
																		$practicas++; 
																	else:
																		if($contrato['contract_type'] == 8):
																			$tercerizacion++; 
																		else:
																			if($contrato['contract_type'] == 9):
																				$indeterminado++; 
																			else:
																				if($contrato['contract_type'] == 10):
																					$prueba++; 
																				else:
																					if($contrato['contract_type'] == 11):
																						$definido++; 
																					endif;
																				endif;
																			endif;
																		endif;
																	endif;
																endif;
															endif;
														endif;
													endif;
												endif;
											endif;
										endforeach;
									endforeach;
									
									$tabla ='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Tipo de contrato</strong></P></center></th></tr>';
									
									if(count($estudiantes) == 0):
										$tabla.='<tr><td>Base 0.0% - ('.$base.')</td></tr>';
										$tabla.='<tr><td>Becario 0.0% - ('.$becario.')</td></tr>';
										$tabla.='<tr><td>Capacitación inicial 0.0% - ('.$capacitacion.')</td></tr>';
										$tabla.='<tr><td>Confianza 0.0% - ('.$confianza.')</td></tr>';
										$tabla.='<tr><td>Honorarios 0.0% - ('.$honorarios.')</td></tr>'; 
										$tabla.='<tr><td>por horas 0.0% - ('.$horas.')</td></tr>';
										$tabla.='<tr><td>Prácticas 0.0% - ('.$practicas.')</td></tr>';
										$tabla.='<tr><td>Tercerización 0.0% - ('.$tercerización.')</td></tr>';
										$tabla.='<tr><td>Tiempo indeterminado 0.0% - ('.$indeterminado.')</td></tr>';
										$tabla.='<tr><td>Periodo de prueba 0.0% - ('.$prueba.')</td></tr>';
										$tabla.='<tr><td>Contrato por tiempo definido 0.0% - ('.$definido.')</td></tr>'; 
									else:
										if($base == 0):
											$tabla.='<tr><td>Base 0.0% - ('.$base.')</td></tr>';
										else:
											$porcientoBase = ($base * 100) / count($estudiantes);
											$tabla.='<tr><td>Base '.number_format($porcientoBase, 2, '.', '').'% - ('.$base.')</td></tr>';
										endif;
										if($becario == 0):
											$tabla.='<tr><td>Becario 0.0% - ('.$becario.')</td></tr>';
										else:
											$porcientoBecarios = ($becario * 100) / count($estudiantes);	
											$tabla.='<tr><td>Becario '.number_format($porcientoBecarios, 2, '.', '').'% - ('.$becario.')</td></tr>';
										endif;
										if($capacitacion == 0):
											$tabla.='<tr><td>Capacitación inicial 0.0% - ('.$capacitacion.')</td></tr>';
										else:
											$porcientoCapacitacion = ($capacitacion * 100) / count($estudiantes);
											$tabla.='<tr><td>Capacitación inicial '.number_format($porcientoCapacitacion, 2, '.', '').'% - ('.$capacitacion.')</td></tr>';
										endif;
										if($confianza == 0):
											$tabla.='<tr><td>Confianza 0.0% - ('.$confianza.')</td></tr>';
										else:
											$porcientoConfianza = ($confianza * 100) / count($estudiantes);
											$tabla.='<tr><td>Confianza '.number_format($porcientoConfianza, 2, '.', '').'% - ('.$confianza.')</td></tr>';
										endif;
										if($honorarios == 0):
											$tabla.='<tr><td>Honorarios 0.0% - ('.$honorarios.')</td></tr>';
										else:
											$porcientoHonorarios = ($honorarios * 100) / count($estudiantes);	
											$tabla.='<tr><td>Honorarios '.number_format($porcientoHonorarios, 2, '.', '').'% - ('.$honorarios.')</td></tr>'; 
										endif;
										if($horas == 0):
											$tabla.='<tr><td>por horas 0.0% - ('.$horas.')</td></tr>';
										else:
											$porcientoHoras = ($horas * 100) / count($estudiantes);
											$tabla.='<tr><td>por horas '.number_format($porcientoHoras, 2, '.', '').'% - ('.$horas.')</td></tr>';
										endif;
										if($practicas == 0):
											$tabla.='<tr><td>Prácticas 0.0% - ('.$practicas.')</td></tr>';
										else:
											$porcientoPracticas = ($practicas * 100) / count($estudiantes);	
											$tabla.='<tr><td>Prácticas '.number_format($porcientoPracticas, 2, '.', '').'% - ('.$practicas.')</td></tr>';
										endif;
										if($tercerizacion == 0):
											$tabla.='<tr><td>Tercerización 0.0% - ('.$tercerizacion.')</td></tr>';
										else:
											$porcientoTercerización = ($tercerizacion * 100) / count($estudiantes);
											$tabla.='<tr><td>Tercerización '.number_format($porcientoTercerización, 2, '.', '').'% - ('.$tercerizacion.')</td></tr>';
										endif;
										if($indeterminado == 0):
											$tabla.='<tr><td>Tiempo indeterminado 0.0% - ('.$indeterminado.')</td></tr>';
										else:
											$porcientoIndeterminado = ($indeterminado * 100) / count($estudiantes);	
											$tabla.='<tr><td>Tiempo indeterminado '.number_format($porcientoIndeterminado, 2, '.', '').'% - ('.$indeterminado.')</td></tr>';
										endif;
										if($prueba == 0):
											$tabla.='<tr><td>Periodo de prueba 0.0% - ('.$prueba.')</td></tr>';
										else:
											$porcientoPrueba = ($prueba * 100) / count($estudiantes);
											$tabla.='<tr><td>Periodo de prueba '.number_format($porcientoPrueba, 2, '.', '').'% - ('.$prueba.')</td></tr>';
										endif;
										if($definido == 0):
											$tabla.='<tr><td>Contrato por tiempo definido 0.0% - ('.$definido.')</td></tr>'; 
										else:
											$porcientoDefinido = ($definido * 100) / count($estudiantes);	
											$tabla.='<tr><td>Contrato por tiempo definido '.number_format($porcientoDefinido, 2, '.', '').'% - ('.$definido.')</td></tr>'; 
										endif;
									endif;
									echo $tabla;
								?>

								<!-- Área de Experiencia-->
								
								<?php
									$areasExperiencia = array(); 
									
									for($cont=1; $cont<=20; $cont++):
										$areasExperiencia[$cont] = 0;
									endfor;
											
									 foreach($estudiantes as $estudiante):
										foreach($estudiante['StudentProfessionalExperience'] as $empresa):
											foreach($empresa['StudentWorkArea'] as $puesto):
												
												for($cont=1; $cont<=20; $cont++):
													if($puesto['experience_area'] == $cont):
														$areasExperiencia[$cont]++;
													endif;
												endfor;
												
											endforeach;
										endforeach;
									endforeach;
								?>

								<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Areas de Experiencia </strong></P></center></th></tr>
								
								<?php 
									$tabla='';
									for($cont=1; $cont<count($AreasExperiencia); $cont++):
									
										if(count($estudiantes) == 0):
											$tabla.='<tr><td>'.$AreasExperiencia[$cont].' 0.0% - ('.$areasExperiencia[$cont].')</td></tr>';
										else:
											if($areasExperiencia[$cont] == 0):
												$tabla.='<tr><td>'.$AreasExperiencia[$cont].' 0.0% - ('.$areasExperiencia[$cont].')</td></tr>';
											else:
												$tabla.='<tr><td>'.$AreasExperiencia[$cont].' '.number_format(($areasExperiencia[$cont] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasExperiencia[$cont].')</td></tr>';
											endif;
										endif;
										$cont++;
								
										if(count($estudiantes) == 0):
											$tabla.='<tr><td>'.$AreasExperiencia[$cont].' 0.0% - ('.$areasExperiencia[$cont].')</td></tr>';
										else:
											if($areasExperiencia[$cont] == 0):
												$tabla.='<tr><td>'.$AreasExperiencia[$cont].' 0.0% - ('.$areasExperiencia[$cont].')</td></tr>';
											else:
												$tabla.='<tr><td>'.$AreasExperiencia[$cont].' '.number_format(($areasExperiencia[$cont] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasExperiencia[$cont].')</td></tr>';
											endif;
										endif;

									endfor; 
									echo $tabla;
								?>
								
								<!-- Proyectos Academicos-->
								
								<?php
									$sip = 0; 
									$nop = 0; 
									$sinProyectosRegistrados = 0; 
									foreach($estudiantes as $estudiante):
										foreach($estudiante['StudentAcademicProject'] as $proyecto):
												if($proyecto['name']==''):
													$nop++;
												else:
													$sip++;
												endif;			
										endforeach;
										
										if(empty($estudiante['StudentAcademicProject'])):
											$sinProyectosRegistrados++;
										endif;
									endforeach;
									
									$tabla ='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Proyectos Academicos</strong></P></center></th></tr>';
									
									if(count($estudiantes) == 0):								
										$tabla.='<tr><td>Si 0.0% - ('.$sip.')</td></tr>';
										$tabla.='<tr><td>No 0.0% - ('.$nop.')</td></tr>';			
										$tabla.='<tr><td>Sin proyectos registrados 0.0% - ('.$sinProyectosRegistrados.')</td></tr>';											
									else:
										if($sip == 0):
											$tabla.='<tr><td>Si 0.0% - ('.$sip.')</td></tr>';
										else:
											$porcientoSip = ($sip * 100) / count($estudiantes);
											$tabla.='<tr><td>Si '.number_format($porcientoSip, 2, '.', '').'% - ('.$sip.')</td></tr>';
										endif;
										
										if($nop == 0):
											$tabla.='<tr><td>No 0.0% - ('.$nop.')</td></tr>';
										else:
											$porcientoNop = ($nop * 100) / count($estudiantes);	
											$tabla.='<tr><td>No '.number_format($porcientoNop, 2, '.', '').'% - ('.$nop.')</td></tr>';
										endif;
										
										if($sinProyectosRegistrados == 0):
											$tabla.='<tr><td>Sin proyectos registrados 0.0% - ('.$nop.')</td></tr>';
										else:
											$porcientosinProyectosRegistrados = ($sinProyectosRegistrados * 100) / count($estudiantes);	
											$tabla.='<tr><td>Sin proyectos registrados '.number_format($porcientosinProyectosRegistrados, 2, '.', '').'% - ('.$sinProyectosRegistrados.')</td></tr>';
										endif;
									endif;
									echo $tabla;							
								?>
						</tbody>
				</table>
		</div>
		  </div>
		</div>
	  </div>
	
		<div class="panel-group">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h4 class="panel-title">
			  <a class="intoCollaps" data-toggle="collapse" href="#competenciasID">Competencias Profecionales</a>
			</h4>
		  </div>
		  <div id="competenciasID" class="panel-collapse collapse">
			<div class="panel-body">
			
			<table class="table">
				<tbody>	
					

								<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Competencias profesionales</strong></P></center></th></tr>
								<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Competencias</strong></P></center></th></tr>	
			
								<?php
									$competency = array(); 
									$sinCompetencias = 0;
									
									for($cont=1; $cont<=20; $cont++):
										$competency[$cont] = 0;
									endfor;
											
									 foreach($estudiantes as $estudiante):
										if(empty($estudiante['StudentProfessionalSkill'])):
											$sinCompetencias++;
										endif;
										
										foreach($estudiante['StudentProfessionalSkill'] as $comp):
												for($cont=1; $cont<=20; $cont++):
													if($comp['competency_id'] == $cont):
														$competency[$cont]++;
													endif;
												endfor;
										endforeach;
									endforeach;

									$i=1;
									
									foreach ($Competencias as $competencia):
										if(count($estudiantes)==0):
											$tabla='<tr><td>'.$competencia.' 0.0% - ('.$competency[$i].')</td></tr>';
										else:
											$porcentajeComp = ($competency[$i] * 100) / count($estudiantes);
											$tabla='<tr><td>'.$competencia.' '.number_format($porcentajeComp, 2, '.', '').' % - ('.$competency[$i].')</td></tr>';
										endif;
									$i++;
									echo $tabla;
									endforeach;
									
									
									if($sinCompetencias == 0):
										echo '<tr><td>Sin competencias seleccionadas 0.0% - ('.$sinCompetencias.')</td></tr>';
									else:
										$porcientosinsinCompetencias = ($sinCompetencias * 100) / count($estudiantes);	
										echo '<tr><td>Sin proyectos registrados '.number_format($porcientosinsinCompetencias, 2, '.', '').'% - ('.$sinCompetencias.')</td></tr>';
									endif;

								?>
								</tbody>
						</table>
						
					</div>
					  </div>
					</div>
				  </div>
				
		<div class="panel-group">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h4 class="panel-title">
			  <a class="intoCollaps" data-toggle="collapse" href="#expectativasLaboralesId">Expectativas Laborales</a>
			</h4>
		  </div>
		  <div id="expectativasLaboralesId" class="panel-collapse collapse">
			<div class="panel-body">
					<table class="table">
						<tbody>	
								<!--Area de Interes-->
						
								<?php
									$areaInteres = array(); 
									$SinAreaInteres = 0;
									
									for($contInteres=1; $contInteres<=count($AreasInteres); $contInteres++):
										$areasInteres2[$contInteres] = 0;
									endfor;
											
									 foreach($estudiantes as $estudiante):
									 
										IF(empty($estudiante['StudentInterestJob'])):
											$SinAreaInteres++;
										ENDIF;
										
										foreach($estudiante['StudentInterestJob'] as $interes):
											
												
												for($contInteres=1; $contInteres<=count($AreasInteres); $contInteres++):
													if($interes['interest_area_id'] == $contInteres):
														$areasInteres2[$contInteres]++;
													endif;
												endfor;
												
										endforeach;
									endforeach;
									
									$tabla ='<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Expectativas Laborales</strong></P></center></th></tr>';
									$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Areas de Interes</strong></P></center></th></tr>';
									
									$aux=1;
									if(count($estudiantes) == 0):
										 foreach($AreasInteres as $area):
											$tabla.='<tr><td>'.$area.' 0.0% - ('.$areasInteres2[$aux].')</td></tr>';
											$aux++;
										 endforeach;
										 $tabla.='<tr><td>Sin áreas de interés registradas 0.0% - ('.$SinAreaInteres.')</td></tr>';
									else:
										 foreach($AreasInteres as $area):
											if($areasInteres2[$aux] == 0):
												$tabla.='<tr><td>'.$area.' 0.0% - ('.$areasInteres2[$aux].')</td></tr>';
											else:
												$tabla.='<tr><td>'.$area.number_format(($areasInteres2[$aux] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres2[$aux].')</td></tr>';
											endif;
											$aux++;
										 endforeach;
										 
										 if($SinAreaInteres == 0):
											$tabla.= '<tr><td>Sin áreas de interés registradas 0.0% - ('.$SinAreaInteres.')</td></tr>';
										 else:
											$porcientoSinAreaInteres = ($SinAreaInteres * 100) / count($estudiantes);	
											$tabla.= '<tr><td>Sin áreas de interés registradas '.number_format($porcientoSinAreaInteres, 2, '.', '').'% - ('.$SinAreaInteres.')</td></tr>';
										 endif;
										
									endif;
									echo $tabla;
								?>

							</tbody>
						</table>
						
			</div>
		  </div>
		</div>
	  </div>
						
					</div>
				</div>
			<?php
			endif;
			?>
			
  
		    <?php
			if($ShowPerfilEmpresa == 1):
			?>
			<div class = "panel-heading"> <!-- Empresas -->
			 <h4 class = "panel-title">
				<a data-toggle = "collapse" data-parent = "#accordion" class="chevron" href = "#collapse7">
				 Empresas / Institución
				</a>
				<button type="button" class="btn btn-primary btnBlue" style="float: right; padding-top: 6px; margin-top: -10px;" onclick="javascript:imprSelec('collapse7');
																				function imprSelec(muestra)
																					{
																						var ficha=document.getElementById(muestra);
																						var ventimp=window.open(' ','popimpr');
																						ventimp.document.write(ficha.innerHTML);
																						ventimp.document.close();
																						ventimp.print();
																						ventimp.close();
																					};">Imprimir <span class="glyphicon glyphicon-print"></span> </button>
			 </h4>
		  </div>
		  
			<div id = "collapse7" class = "panel-collapse collapse in">
			 <div class = "panel-body">
			 
			 <!-- Inicio de tabla PERFIL EMPRESAS -->
	
	<div class="panel-group">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h4 class="panel-title">
			  <a class="intoCollaps" data-toggle="collapse" href="#perfilEmpresaId">Perfil de empresas e instituciones</a>
			</h4>
		  </div>
		  <div id="perfilEmpresaId" class="panel-collapse collapse">
			<div class="panel-body">	
			
			<div class="col-md-12" >
			<table class="table ">

			 <tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Perfil de empresas e instituciones</strong></P></center></th></tr>
			 <tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Total de Empresas</strong></P></center></th></tr>

		<tbody>	
			<tr>
				<td colspan="2">Total de Empresas <?php echo count($empresas);?></td>
			</tr>
			<tr>
			  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Tipos  de Empresas</strong></P></center></th>
			</tr>
		<?php 		
	    $corporativo = 0; 
		$matriz = 0; 
		$planta = 0;
		$sede = 0;
		$sucursal = 0;
		
		foreach ($empresas as $empresa):
			if ($empresa ['CompanyProfile']['company_type']== 1):
			    $corporativo++;
			else:
				if ($empresa ['CompanyProfile']['company_type']== 2):
		            $matriz++;
				else:
					if ($empresa ['CompanyProfile']['company_type']== 3):
						$planta++;
					else:
						if ($empresa ['CompanyProfile']['company_type']== 4):
						    $sede++;
						else:
							if ($empresa ['CompanyProfile']['company_type']== 5):
								$sucursal++;
							endif;
						endif;
					endif;
				endif;
			endif;
		endforeach;
			
			$tabla='';
			if(count($empresas)==0):
			
				$tabla.='<tr><td>Corporativo 0.0% - ('.$corporativo.')</td></tr>'; 
				$tabla.='<tr><td>Matriz 0.0% - ('.$matriz.')</td></tr>';
				$tabla.='<tr><td>Planta 0.0% - ('.$planta.')</td></tr>'; 
				$tabla.='<tr><td>Sede unica 0.0% - ('.$sede.')</td></tr>'; 
				$tabla.='<tr><td>Sucursal 0.0% - ('.$sucursal.')</td></tr>';
			
			else:
				
				$porcientoCorporativo = ($corporativo * 100) / count($empresas);
				$porcientoMatriz = ($matriz * 100) / count($empresas);
				$porcientoPlanta = ($planta * 100) / count($empresas);
				$porcientoSede = ($sede * 100) / count($empresas);
				$porcientoSucursal = ($sucursal * 100) / count($empresas);
				
				$tabla.='<tr><td>Corporativo '.number_format($porcientoCorporativo, 2, '.', '').'% - ('.$corporativo.')</td></tr>'; 
				$tabla.='<tr><td>Matriz '.number_format($porcientoMatriz, 2, '.', '').'% - ('.$matriz.')</td></tr>';
				$tabla.='<tr><td>Planta '.number_format($porcientoPlanta, 2, '.', '').'% - ('.$planta.')</td></tr>'; 
				$tabla.='<tr><td>Sede unica '.number_format($porcientoSede, 2, '.', '').'% - ('.$sede.')</td></tr>'; 
				$tabla.='<tr><td>Sucursal '.number_format($porcientoSucursal, 2, '.', '').'% - ('.$sucursal.')</td></tr>';
			
			endif;
			echo $tabla;
		?>
	
		
	 <?php 		
	    $privado = 0; 
		$publico = 0; 
		$social = 0;
		
		foreach ($empresas as $empresa):
			if ($empresa ['CompanyProfile']['sector']== 1):
			    $privado++;
			else:
				if ($empresa ['CompanyProfile']['sector']== 2):
		            $publico++;
				else:
					if ($empresa ['CompanyProfile']['sector']== 3):
						$social++;
					else:
					endif;
				endif;
			endif;
		endforeach;
		
			$tabla='';
			$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Sectores</strong></P></center></th></tr>';
			if(count($empresas)==0):
				
				$tabla.='<tr><td>Privado 0.0% - ('.$privado.')</td></tr>';
				$tabla.='<tr><td>Público 0.0% - ('.$publico.')</td></tr>';
				$tabla.='<tr><td>Social 0.0% - ('.$social.')</td></tr>'; 
			
			else:

				$porcientoPrivado = ($privado * 100) / count($empresas);
				$porcientoPublico = ($publico * 100) / count($empresas);
				$porcientoSocial = ($social * 100) / count($empresas);
				
				$tabla.='<tr><td>Privado '.number_format($porcientoPrivado, 2, '.', '').'% - ('.$privado.')</td></tr>';
				$tabla.='<tr><td>Público '.number_format($porcientoPublico, 2, '.', '').'% - ('.$publico.')</td></tr>';
				$tabla.='<tr><td>Social '.number_format($porcientoSocial, 2, '.', '').'% - ('.$social.')</td></tr>'; 
			endif;
			echo $tabla;
	?>
	
 <!-- GIROS -->
	
			<tr>
			  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Giros</strong></P></center></th>
			</tr>
		<?php
		$Rotation = array(); 
		
		for($cont=1; $cont<=20; $cont++):
			$Rotation[$cont] = 0;
		endfor;
				
		foreach($empresas as $empresa):
					for($cont=1; $cont<=20; $cont++):
						if($empresa['CompanyProfile']['company_rotation'] == $cont):
							$Rotation[$cont]++;
						endif;
					endfor;
		endforeach;
		
		?>
			
		<?php
			$i=1;
			
			foreach ($Giros as $giro):
				if (count($empresas)==0):
					$tabla='<tr><td colspan="2">'.$giro.' 0.0% - ('.$Rotation[$i].')</td>';
				else:
					$porcentajeGiro = ($Rotation[$i] * 100) / count($empresas);
					$tabla='<tr><td colspan="2">'.$giro.' '.number_format($porcentajeGiro, 2, '.', '').' % - ('.$Rotation[$i].')</td>';
				endif;
				$i++;
				echo $tabla;
			endforeach;
		?>	
	<!-- EMPLEADOS -->
	
		<tr>
			  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Numero de Empleados</strong></P></center></th>
		</tr>
	<?php
		$Empleados = array(); 
		
		for($cont=1; $cont<=8; $cont++):
			$Empleados[$cont] = 0;
		endfor;
				
		foreach($empresas as $empresa):
					for($cont=1; $cont<=8; $cont++):
						if($empresa['CompanyProfile']['employees_number'] == $cont):
							$Empleados[$cont]++;
						endif;
						
						
					endfor;
		endforeach;
		
	?>
			
		<?php
			$i=1;
			
			foreach ($numeroEmpleados as $NE):
			if (count($empresas)==0):
				$tabla='<tr><td colspan="2">'.$NE.' 0.0% - ('.$Empleados[$i].')</td>';
			else:
				$porcentajeEmpleado = ($Empleados[$i] * 100) / count($empresas);
				$tabla='<tr><td colspan="2">'.$NE.' '.number_format($porcentajeEmpleado, 2, '.', '').' % - ('.$Empleados[$i].')</td>';
			endif;
			$i++;
			echo $tabla;
			endforeach;
		?>	
		<tr>
			<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Entidad Federativa (Sede)</strong></P></center></th>
		</tr>
	<?php
		$estado = array(); 
		
		for($cont=1; $cont<=32; $cont++):
			$estado[$cont] = 0;
		endfor;
				
		foreach($empresas as $empresa):
					for($cont=1; $cont<=32; $cont++):
						if($empresa['CompanyProfile']['state'] == $Estados[$cont]):
							$estado[$cont]++;
						endif;
					endfor;
		endforeach;
		
	?>
			
		<?php  
			$i=1;
			foreach ($Estados as $entidad):
				if(count($empresas)==0):
					echo '<tr><td colspan="2">'.$entidad.' 0.0% - ('.$estado[$i].')</td>';
				else:
					$PorcentajeEntidad = ($estado[$i] * 100) / count($empresas);
					echo '<tr><td colspan="2">'.$entidad.' '.number_format($PorcentajeEntidad, 2, '.', '').' % - ('.$estado[$i].')</td>';
				endif;
				$i++;
			endforeach;
		?>	
		</tbody>
		</table>

		   
		  	</div>
		  </div>
		</div>
	  </div>
	</div>
		   
					</div>
				</div>
		   <?php
			endif;
			?>
		   
			<?php
			if($ShowOfertas == 1):
			?>
			<div class = "panel-heading"> <!-- Ofertas de empresas-->
			 <h4 class = "panel-title">
				<a data-toggle = "collapse" data-parent = "#accordion" class="chevron" href = "#collapse8">
				 Ofertas 
				</a>
				<button type="button" class="btn btn-primary btnBlue" style="float: right; padding-top: 6px; margin-top: -10px;" onclick="javascript:imprSelec('collapse8');
																				function imprSelec(muestra)
																					{
																						var ficha=document.getElementById(muestra);
																						var ventimp=window.open(' ','popimpr');
																						ventimp.document.write(ficha.innerHTML);
																						ventimp.document.close();
																						ventimp.print();
																						ventimp.close();
																					};">Imprimir <span class="glyphicon glyphicon-print"></span> </button>
			 </h4>
		  </div>
		  
			<div id = "collapse8" class = "panel-collapse collapse in">
			 <div class = "panel-body">   
			
		<div class="panel-group">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h4 class="panel-title">
			  <a class="intoCollaps" data-toggle="collapse" href="#perfilOfertasId">Perfil de Ofertas</a>
			</h4>
		  </div>
		  <div id="perfilOfertasId" class="panel-collapse collapse">
			<div class="panel-body">	
		<!-- Inicio de tabla OFERTAS - Empresas -->

			<div class="col-md-12" >
						<table class="table">

						<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Perfil de Ofertas</strong></P></center></th></tr>
						<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Total de Ofertas</strong></P></center></th></tr>

					<tbody>	
					<tr>
						<td colspan="2">Total de Ofertas <?php echo count($ofertas);?></td>
					</tr>
				<!-- CONFIDENCIALES -->
				
				<?php

					$si = 0; 
					$no = 0; 
										
					foreach($ofertas as $oferta):
						if($oferta['CompanyJobOffer']['confidential_job_offer'] == 's'):
							$si++;
						else: 
							if($oferta['CompanyJobOffer']['confidential_job_offer'] == 'n'):
							  $no++; 
							endif;
						endif; 
					endforeach;
					
					$tabla='';
					$tabla.='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Confidencial</strong></P></center></th>';
					if(count($ofertas)==0):
					
						$tabla.='<tr><td>Si 0.0% - ('.$si.')</td></tr>';
						$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';
					
					else:
						$porcientoSi = ($si * 100) / count($ofertas);
						$porcientoNo = ($no * 100) / count($ofertas);
						
						$tabla.='<tr><td>Si '.number_format($porcientoSi, 2, '.', '').'% - ('.$si.')</td></tr>';
						$tabla.='<tr><td>No '.number_format($porcientoNo, 2, '.', '').'% - ('.$no.')</td></tr>';

					endif;
					echo $tabla;

				?>
				
					
				<!-- GIROS OFERTAS -->
				
					<tr>
						<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Giros</strong></P></center></th>
					</tr>
				<?php

					$Rotation = array(); 
					$sinDefinir = 0;
					
					for($cont=1; $cont<=count($Giros); $cont++):
						$Rotation[$cont] = 0;
					endfor;
							
					foreach($ofertas as $oferta):
								for($cont=1; $cont<=count($Giros); $cont++):
									if($oferta['CompanyJobProfile']['rotation'] == $cont):
										$Rotation[$cont]++;
									endif;
								endfor;
					endforeach;

					$i=1;
					
					foreach ($Giros as $giro):
						$tabla='';
						if(count($ofertas)== 0):
							$tabla.='<tr><td colspan="2">'.$giro.' 0.0% - ('.$Rotation[$i].')</td>';
						else:
							$porcentajeGiro = ($Rotation[$i] * 100) / count($ofertas);
							$tabla.='<tr><td colspan="2">'.$giro.' '.number_format($porcentajeGiro, 2, '.', '').' % - ('.$Rotation[$i].')</td>';
						endif;
						$i++;
						echo $tabla;
					endforeach;

					//Oferta incluyente
				
					$si = 0; 
					$no = 0;
					$sinDefinir = 0;
										
					foreach($ofertas as $oferta):
						if($oferta['CompanyJobProfile']['disability'] == 's'):
							 $si++;
						else: 
							if($oferta['CompanyJobProfile']['disability'] == 'n'):
								$no++; 
							endif;
						endif; 
						
						if(($oferta['CompanyJobProfile']['disability'] == '') or ($oferta['CompanyJobProfile']['disability'] == null)):
							$sinDefinir++;
						endif;
						
					endforeach;
					
					$tabla='';
					$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Incluyentes</strong></P></center></th></tr>';
					
					if(count($ofertas)==0):
					
						$tabla.='<tr><td>Si 0.0% - ('.$si.')</td></tr>';
						$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';
					
					else:
					
						$porcientoSi = ($si * 100) / count($ofertas);
						$porcientoNo = ($no * 100) / count($ofertas);
						$porcientoSinDefinir = ($sinDefinir * 100) / count($ofertas);
						
						$tabla.='<tr><td>Si '.number_format($porcientoSi, 2, '.', '').'% - ('.$si.')</td></tr>';
						$tabla.='<tr><td>No '.number_format($porcientoNo, 2, '.', '').'% - ('.$no.')</td></tr>';
						$tabla.='<tr><td>Sin definir '.number_format($porcientoSinDefinir, 2, '.', '').'% - ('.$sinDefinir.')</td></tr>';
					
					endif;
					echo $tabla;
					
					// Tipos de Discapacidad
					$ceguera = 0; 
					$auditiva = 0; 
					$visual = 0;
					$motora = 0;
					$multiple = 0;
					$sordera = 0; 
					$ninguna = 0;
					
					foreach ($ofertas as $oferta):
						if ($oferta ['CompanyJobProfile']['disability_type'] == 1):
							$ceguera++;
						else:
							if ($oferta ['CompanyJobProfile']['disability_type'] == 2):
								$auditiva++;
							else:
								if ($oferta ['CompanyJobProfile']['disability_type'] == 3):
									$visual++;
								else:
									if ($oferta ['CompanyJobProfile']['disability_type'] == 4):
										$motora++;
									else:
										if ($oferta ['CompanyJobProfile']['disability_type'] == 5):
											$multiple++;
										else:
											if ($oferta ['CompanyJobProfile']['disability_type'] == 6):
												$sordera++;
											else:
												$ninguna++;
											endif;
										endif;
									endif;
								endif;
							endif;
						endif;
					endforeach;
					
					$tabla='';
					$tabla.='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Tipo de discapacidad</strong></P></center></th>';
						
					if(count($ofertas)==0):
						$tabla.='<tr><td>Ceguera 0.0% - ('.$ceguera.')</td></tr>';
						$tabla.='<tr><td>Debilidad auditiva 0.0% - ('.$auditiva.')</td></tr>';
						$tabla.='<tr><td>Devilidad visual 0.0% - ('.$visual.')</td></tr>';
						$tabla.='<tr><td>Motriz o motora 0.0% - ('.$motora.')</td></tr>'; 
						$tabla.='<tr><td>Multiples 0.0% - ('.$multiple.')</td></tr>';
						$tabla.='<tr><td>Sordera 0.0% - ('.$sordera.')</td></tr>';
						$tabla.='<tr><td>Sin discapacidad 0.0% - ('.$ninguna.')</td></tr>';
					else:
						$porcientoCeguera = ($ceguera * 100) / count($ofertas);
						$porcientoAuditiva = ($auditiva * 100) / count($ofertas);
						$porcientoVisual = ($visual * 100) / count($ofertas);
						$porcientoMotora = ($motora * 100) / count($ofertas);
						$porcientoMultiple = ($multiple * 100) / count($ofertas);
						$porcientoSordera = ($sordera * 100) / count($ofertas);
						$porcientoNinguna = ($ninguna * 100) / count($ofertas);
					
						$tabla.='<tr><td>Ceguera '.number_format($porcientoCeguera, 2, '.', '').'% - ('.$ceguera.')</td></tr>';
						$tabla.='<tr><td>Debilidad auditiva '.number_format($porcientoAuditiva, 2, '.', '').'% - ('.$auditiva.')</td></tr>';
						$tabla.='<tr><td>Devilidad visual '.number_format($porcientoVisual, 2, '.', '').'% - ('.$visual.')</td></tr>';
						$tabla.='<tr><td>Motriz o motora '.number_format($porcientoMotora, 2, '.', '').'% - ('.$motora.')</td></tr>'; 
						$tabla.='<tr><td>Multiples '.number_format($porcientoMultiple, 2, '.', '').'% - ('.$multiple.')</td></tr>';
						$tabla.='<tr><td>Sordera '.number_format($porcientoSordera, 2, '.', '').'% - ('.$sordera.')</td></tr>';
						$tabla.='<tr><td>Sin discapacidad '.number_format($porcientoNinguna, 2, '.', '').'% - ('.$ninguna.')</td></tr>';
					endif;
					echo $tabla;
				

					// Tipo de contrato Ofertas
					$base = 0; 
					$becario = 0; 
					$capacitacion = 0;
					$confianza = 0; 
					$honorarios = 0; 
					$horas = 0;
					$practicas = 0; 
					$tercerización = 0;
					$indeterminado = 0; 
					$prueba = 0;
					$definido = 0;
					$siDefinir = 0;
						
					foreach($ofertas as $oferta):
							if($oferta['CompanyJobContractType']['id'] == null):
								 $siDefinir++; 
							else:
								if($oferta['CompanyJobContractType']['contract_type'] == 1):
									 $base++; 
								else:
									if($oferta['CompanyJobContractType']['contract_type'] == 2):
									 $becario++; 
									else:
										if($oferta['CompanyJobContractType']['contract_type'] == 3):
										$capacitacion++; 
										else:
											if($oferta['CompanyJobContractType']['contract_type'] == 4):
											 $confianza++;
											else:
												if($oferta['CompanyJobContractType']['contract_type'] == 5):
													$honorarios++; 
												else:
													if($oferta['CompanyJobContractType']['contract_type'] == 6):
														$horas++; 
													else:
														if($oferta['CompanyJobContractType']['contract_type'] == 7):
															$practicas++; 
														else:
															if($oferta['CompanyJobContractType']['contract_type'] == 8):
																$tercerización++; 
															else:
																if($oferta['CompanyJobContractType']['contract_type'] == 9):
																	$indeterminado++; 
																else:
																	if($oferta['CompanyJobContractType']['contract_type'] == 10):
																		$prueba++; 
																	else:
																		if($oferta['CompanyJobContractType']['contract_type'] == 11):
																			$definido++; 
																		endif;
																	endif;
																endif;
															endif;
														endif;
													endif;
												endif;
											endif;
										endif;
									endif;
								endif;
							endif;
							
					endforeach;
					
					$tabla='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Tipo de Contrato</strong></P></center></th>';
					
					if(count($ofertas)==0):
						$tabla.='<tr><td>Base 0.0% - ('.$base.')</td></tr>';
						$tabla.='<tr><td>Becario 0.0% - ('.$becario.')</td></tr>';
						$tabla.='<tr><td>Capacitación inicial 0.0% - ('.$capacitacion.')</td></tr>';
						$tabla.='<tr><td>Confianza 0.0% - ('.$confianza.')</td></tr>';
						$tabla.='<tr><td>Honorarios 0.0% - ('.$honorarios.')</td></tr>';
						$tabla.='<tr><td>por horas 0.0% - ('.$horas.')</td></tr>';
						$tabla.='<tr><td>Prácticas 0.0% - ('.$practicas.')</td></tr>';
						$tabla.='<tr><td>Tercerización 0.0% - ('.$tercerización.')</td></tr>';
						$tabla.='<tr><td>Tiempo indeterminado 0.0% - ('.$indeterminado.')</td></tr>';
						$tabla.='<tr><td>Periodo de prueba 0.0% - ('.$prueba.')</td></tr>';
						$tabla.='<tr><td>Contrato por tiempo definido 0.0% - ('.$definido.')</td></tr>'; 
						$tabla.='<tr><td>Sin espeficiar 0.0% - ('.$siDefinir.')</td></tr>'; 
					else:
						$porcientoBase = ($base * 100) / count($ofertas);
						$porcientoBecarios = ($becario * 100) / count($ofertas);	
						$porcientoCapacitacion = ($capacitacion * 100) / count($ofertas);
						$porcientoConfianza = ($confianza * 100) / count($ofertas);
						$porcientoHonorarios = ($honorarios * 100) / count($ofertas);	
						$porcientoHoras = ($horas * 100) / count($ofertas);
						$porcientoPracticas = ($practicas * 100) / count($ofertas);	
						$porcientoTercerización = ($tercerización * 100) / count($ofertas);
						$porcientoIndeterminado = ($indeterminado * 100) / count($ofertas);	
						$porcientoPrueba = ($prueba * 100) / count($ofertas);
						$porcientoDefinido = ($definido * 100) / count($ofertas);
						$porcientoSinTipoContrato = ($siDefinir * 100) / count($ofertas);						
						
						$tabla.='<tr><td>Base '.number_format($porcientoBase, 2, '.', '').'% - ('.$base.')</td></tr>';
						$tabla.='<tr><td>Becario '.number_format($porcientoBecarios, 2, '.', '').'% - ('.$becario.')</td></tr>';
						$tabla.='<tr><td>Capacitación inicial '.number_format($porcientoCapacitacion, 2, '.', '').'% - ('.$capacitacion.')</td></tr>';
						$tabla.='<tr><td>Confianza '.number_format($porcientoConfianza, 2, '.', '').'% - ('.$confianza.')</td></tr>';
						$tabla.='<tr><td>Honorarios '.number_format($porcientoHonorarios, 2, '.', '').'% - ('.$honorarios.')</td></tr>';
						$tabla.='<tr><td>por horas '.number_format($porcientoHoras, 2, '.', '').'% - ('.$horas.')</td></tr>';
						$tabla.='<tr><td>Prácticas '.number_format($porcientoPracticas, 2, '.', '').'% - ('.$practicas.')</td></tr>';
						$tabla.='<tr><td>Tercerización '.number_format($porcientoTercerización, 2, '.', '').'% - ('.$tercerización.')</td></tr>';
						$tabla.='<tr><td>Tiempo indeterminado '.number_format($porcientoIndeterminado, 2, '.', '').'% - ('.$indeterminado.')</td></tr>';
						$tabla.='<tr><td>Periodo de prueba '.number_format($porcientoPrueba, 2, '.', '').'% - ('.$prueba.')</td></tr>';
						$tabla.='<tr><td>Contrato por tiempo definido '.number_format($porcientoDefinido, 2, '.', '').'% - ('.$definido.')</td></tr>'; 
						$tabla.='<tr><td>Sin espeficiar '.number_format($porcientoSinTipoContrato, 2, '.', '').'% - ('.$siDefinir.')</td></tr>'; 
					endif;
					echo $tabla;

				?>
				<!-- Jornada Laboral -->
					<tr>
						 <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Jornada laboral</strong></P></center></th>
					</tr>
				<?php 
					$jornadas = array(); 
					
					for($cont=1; $cont<=count($JornadasLaborales); $cont++):
						$jornadas[$cont] = 0;
					endfor;
							
					foreach($ofertas as $oferta):
						for($cont=1; $cont<=count($JornadasLaborales); $cont++):
							if($oferta['CompanyJobContractType']['workday'] == $cont):
								$jornadas[$cont]++;
							endif;
						endfor;
					endforeach;
					
						$i=1;
						$tabla='';
						foreach ($JornadasLaborales as $laboral):
							if(count($ofertas)==0):
								$tabla='<tr><td colspan="2">'.$laboral.' 0.0% - ('.$jornadas[$i].')</td>';
							else:
								$porcentajeLaboral = ($jornadas[$i] * 100) / count($ofertas);
								$tabla='<tr><td colspan="2">'.$laboral.' '.number_format($porcentajeLaboral, 2, '.', '').' % - ('.$jornadas[$i].')</td>';
							endif;
							$i++;
							echo $tabla;
						endforeach;
						
						if(count($ofertas)==0):
							echo '<tr><td colspan="2">Sin definir 0.0% - ('.$siDefinir.')</td>';
						else:
							$porcentaSinDefinir = ($siDefinir * 100) / count($ofertas);
							echo '<tr><td colspan="2">Sin definir '.number_format($porcentaSinDefinir, 2, '.', '').' % - ('.$siDefinir.')</td>';
						endif;

					?>
					
				<!-- SUELDOS -->
				
					<tr>
						<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Sueldos</strong></P></center></th>
					</tr>
				<?php 
					$sueldos = array(); 
					
					for($cont=1; $cont<=count($Salarios); $cont++):
						$sueldos[$cont] = 0;
					endfor;
							
					foreach($ofertas as $oferta):
								for($cont=1; $cont<=count($Salarios); $cont++):
									if($oferta['CompanyJobContractType']['salary'] == $cont):
										$sueldos[$cont]++;
									endif;
								endfor;
					endforeach;

					$i=1;
					foreach ($Salarios as $salario):
						if(count($ofertas)==0):
							$tabla='<tr><td colspan="2">'.$salario.' 0.0% - ('.$sueldos[$i].')</td>';
						else:
							$porcentajeSalario = ($sueldos[$i] * 100) / count($ofertas);
							$tabla='<tr><td colspan="2">'.$salario.' '.number_format($porcentajeSalario, 2, '.', '').' % - ('.$sueldos[$i].')</td>';
						endif;
						$i++;
						echo $tabla;
					endforeach; 
					
					
						if(count($ofertas)==0):
							echo '<tr><td colspan="2">Sin definir 0.0% - ('.$siDefinir.')</td>';
						else:
							$porcentaSinDefinir = ($siDefinir * 100) / count($ofertas);
							echo '<tr><td colspan="2">Sin definir '.number_format($porcentaSinDefinir, 2, '.', '').' % - ('.$siDefinir.')</td>';
						endif;
				?>
				
				
				<!-- ENTIDADES FEDERATIVAS -->
					<tr>
						<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Lugar de Trabajo</strong></P></center></th>
					</tr>
				<?php 
					$estado = array(); 
					
					for($cont=1; $cont<=count($Estados); $cont++):
						$estado[$cont] = 0;
					endfor;
							
					foreach($ofertas as $oferta):
								for($cont=1; $cont<=count($Estados); $cont++):
									if($oferta['CompanyJobContractType']['state'] == $Estados[$cont]):
										$estado[$cont]++;
									endif;
								endfor;
					endforeach;

						$i=1;
						$tabla='';
						foreach ($Estados as $entidad):
							if( count($ofertas)==0):
								$tabla='<tr><td colspan="2">'.$entidad.' 0.0% - ('.$estado[$i].')</td>';
							else:
								$PorcentajeEntidad = ($estado[$i] * 100) / count($oferta);
								$tabla='<tr><td colspan="2">'.$entidad.' '.number_format($PorcentajeEntidad, 2, '.', '').' % - ('.$estado[$i].')</td>';
							endif;
							$i++;
							echo $tabla;
						endforeach;
						
						
						if(count($ofertas)==0):
							echo '<tr><td colspan="2">Sin definir 0.0% - ('.$siDefinir.')</td>';
						else:
							$porcentaSinDefinir = ($siDefinir * 100) / count($ofertas);
							echo '<tr><td colspan="2">Sin definir '.number_format($porcentaSinDefinir, 2, '.', '').' % - ('.$siDefinir.')</td>';
						endif;
						
				// DISPONIVILIDAD PARA VIAJAR
									$si = 0; 
									$no = 0; 
										
									foreach($ofertas as $oferta):
										if($oferta['CompanyJobContractType']['mobility'] == 's'):
											 $si++;
										 else: 
											 if($oferta['CompanyJobContractType']['mobility'] == 'n'):
												$no++; 
											 endif;
										endif; 
									endforeach;
									
									$tabla='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Disponibilidad para viajar</strong></P></center></th></tr>';
									
									if(count($ofertas)==0):
										$tabla.='<tr><td>Si 0.0% - ('.$si.') </td></tr>';
										$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';	
									else:
										$porcientoSi = ($si * 100) / count($ofertas);
										$porcientoNo = ($no * 100) / count($ofertas);	
										
										$tabla.='<tr><td>Si '.number_format($porcientoSi, 2, '.', '').'% - ('.$si.') </td></tr>';
										$tabla.='<tr><td>No '.number_format($porcientoNo, 2, '.', '').'% - ('.$no.')</td></tr>';
									endif;
									echo $tabla;
							
					// Total dentro del pais
					$si = 0; 
					$no = 0; 

						foreach($ofertas as $oferta):
							if($oferta['CompanyJobContractType']['mobility_option'] == 1):
								$si++;
							else: 
								if($oferta['CompanyJobContractType']['mobility_option'] == 2):
									$no++; 
								endif;
							endif; 
						endforeach;
						
						$tabla='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>En México</strong></P></center></th></tr>';
							
							if(count($ofertas)==0):
								$tabla.='<tr><td>Si 0.0% - ('.$si.')</td></tr>';
								$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';
							else:
								$porcientoSi = ($si * 100) / count($ofertas);
								$porcientoNo = ($no * 100) / count($ofertas);	

								$tabla.='<tr><td>Si '.number_format($porcientoSi, 2, '.', '').'% - ('.$si.')</td></tr>';
								$tabla.='<tr><td>No '.number_format($porcientoNo, 2, '.', '').'% - ('.$no.')</td></tr>';
							endif;
						echo $tabla;
						
					// Total fuera del pais
					$si = 0; 
					$no = 0; 

						foreach($ofertas as $oferta):
							if($oferta['CompanyJobContractType']['mobility_option'] == 2):
								$si++;
							else: 
								if($oferta['CompanyJobContractType']['mobility_option'] == 1):
									$no++; 
								endif;
							endif; 
						endforeach;	
						
						$tabla='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Al extranjero</strong></P></center></th></tr>';
							if(count($ofertas)==0):		
								$tabla.='<tr><td>Si 0.0% - ('.$si.') </td></tr>';
								$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';	
							
							else:

								$porcientoSi = ($si * 100) / count($ofertas);
								$porcientoNo = ($no * 100) / count($ofertas);	

								$tabla.='<tr><td>Si '.number_format($porcientoSi, 2, '.', '').'% - ('.$si.')</td></tr>';
								$tabla.='<tr><td>No '.number_format($porcientoNo, 2, '.', '').'% - ('.$no.')</td></tr>';
							endif;
						echo $tabla;
		?>
		
				</tbody>
				</table>
			</div>
		</div>
	  </div>
	</div>
	</div>

	<div class="panel-group">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h4 class="panel-title">
			  <a class="intoCollaps" data-toggle="collapse" href="#perfilCandidatoId">Perfil del candidato</a>
			</h4>
		  </div>
		  <div id="perfilCandidatoId" class="panel-collapse collapse">
			<div class="panel-body">	
				
				<div class="col-md-12" >
					<table class="table">
						<tbody>	
							<?php
							// Total por nivel acaddemico
							$licenciatura = 0; 
							$especialidad = 0; 
							$maestria = 0;
							$doctorado = 0;
							$sinNivel = 0;
							
							foreach($ofertas as $oferta):
								foreach($oferta['CompanyCandidateProfile'] as $nivel):
									if($nivel['academic_level_id'] == 1):
										$licenciatura++; 
									endif;
										if($nivel['academic_level_id'] == 2):
										  $especialidad++; 
										endif;
											if($nivel['academic_level_id'] == 3):
											  $maestria++; 
											endif;
												if($nivel['academic_level_id'] == 4):
												  $doctorado++;
												endif;
									if(empty($oferta['CompanyCandidateProfile'])):
										$sinNivel++;
									endif;
								endforeach;
							endforeach;
							
							$tabla='<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Perfil del candidato</strong></P></center></th></tr>';
							$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Nivel Academico</strong></P></center></th></tr>';
							
							if(count($ofertas)==0):
								$tabla.='<tr><td>Licenciatura 0.0% - ('.$licenciatura.')</td></tr>';
								$tabla.='<tr><td>Especialidad 0.0% - ('.$especialidad.')</td></tr>'; 
								$tabla.='<tr><td>Maestria 0.0% - ('.$maestria.')</td></tr>';
								$tabla.='<tr><td>Doctorado 0.0% - ('.$doctorado.')</td></tr>'; 
								$tabla.='<tr><td>Sin nivel 0.0% - ('.$sinNivel.')</td></tr>';
							else:
								$porcientoLicenciatura = ($licenciatura * 100) / count($ofertas);
								$porcientoEspecialidad = ($especialidad * 100) / count($ofertas);
								$porcientoMaestria = ($maestria * 100) / count($ofertas);
								$porcientoDoctorado = ($doctorado * 100) / count($ofertas);	
								$porcientoSinNivel = ($sinNivel * 100) / count($ofertas);		

								$tabla.='<tr><td>Licenciatura '.number_format($porcientoLicenciatura, 2, '.', '').'% - ('.$licenciatura.')</td></tr>';
								$tabla.='<tr><td>Especialidad '.number_format($porcientoEspecialidad, 2, '.', '').'% - ('.$especialidad.')</td></tr>'; 
								$tabla.='<tr><td>Maestria '.number_format($porcientoMaestria, 2, '.', '').'% - ('.$maestria.')</td></tr>';
								$tabla.='<tr><td>Doctorado '.number_format($porcientoDoctorado, 2, '.', '').'% - ('.$doctorado.')</td></tr>'; 
								$tabla.='<tr><td>Sin nivel '.number_format($porcientoSinNivel, 2, '.', '').'% - ('.$sinNivel.')</td></tr>';
							endif;
							echo $tabla;

							// Total por situacion Académica
							$alumno = 0; 
							$egresado = 0; 
							$titulado = 0;
							$diploma = 0;
							$grados = 0;
							$sinSituacion = 0;	
							
							foreach($ofertas as $oferta):
								foreach($oferta['CompanyCandidateProfile'] as $situacion):
									if($situacion['academic_situation_id'] == 1):
										 $alumno++;
									else: 
										if($situacion['academic_situation_id'] == 2):
											 $egresado++; 
										else:
											if($situacion['academic_situation_id'] == 3):
												$titulado++; 
											else:
												if($situacion['academic_situation_id'] == 4):
													$diploma++; 
												else:
													if($situacion['academic_situation_id'] == 5):
														$grados++; 
													endif;
												endif;
											endif;
										endif;
									endif;
									if(empty($oferta['CompanyCandidateProfile'])):
										$sinSituacion++;
									endif;
								endforeach;
							endforeach;
							
							$tabla='';
							$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Situación Académica</strong></P></center></th></tr>';
							
							if(count ($ofertas)==0):
							
							$tabla.='<tr><td>Estudiante 0.0% - ('.$alumno.')</td></tr>';
							$tabla.='<tr><td>Egresado 0.0% - ('.$egresado.')</td></tr>';
							$tabla.='<tr><td>Titulado 0.0% - ('.$titulado.')</td></tr>';
							$tabla.='<tr><td>Con diploma 0.0% - ('.$diploma.')</td></tr>';
							$tabla.='<tr><td>Con Grado 0.0% - ('.$grados.')</td></tr>'; 
							$tabla.='<tr><td>Sin situación académica 0.0% - ('.$sinSituacion.')</td></tr>'; 
							
							else:
							
							$porcientoAlumno = ($alumno * 100) / count ($ofertas);
							$porcientoEgresado = ($egresado * 100) / count($ofertas);
							$porcientoTitulado = ($titulado * 100) / count($ofertas);
							$porcientoDiploma = ($diploma * 100) / count($ofertas);			
							$porcientoGrados = ($grados * 100) / count($ofertas);
							$porcientoSinSituacion = ($sinSituacion * 100) / count($ofertas);
							
							$tabla.='<tr><td>Estudiante '.number_format($porcientoAlumno, 2, '.', '').'% - ('.$alumno.')</td></tr>';
							$tabla.='<tr><td>Egresado '.number_format($porcientoEgresado, 2, '.', '').'% - ('.$egresado.')</td></tr>';
							$tabla.='<tr><td>Titulado '.number_format($porcientoTitulado, 2, '.', '').'% - ('.$titulado.')</td></tr>';
							$tabla.='<tr><td>Con diploma '.number_format($porcientoDiploma, 2, '.', '').'% - ('.$diploma.')</td></tr>';
							$tabla.='<tr><td>Con Grado '.number_format($porcientoGrados, 2, '.', '').'% - ('.$grados.')</td></tr>'; 
							$tabla.='<tr><td>Sin situación académica '.number_format($porcientoSinSituacion, 2, '.', '').'% - ('.$sinSituacion.')</td></tr>'; 
							
							endif;
							echo $tabla; 
						?>
					</tbody>	
				</table>
			</div>
		</div>
	  </div>
	</div>
	</div>
	
	<div class="panel-group">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h4 class="panel-title">
			  <a class="intoCollaps" data-toggle="collapse" href="#competenciasId">Competencias</a>
			</h4>
		  </div>
		  <div id="competenciasId" class="panel-collapse collapse">
			<div class="panel-body">	
	<div class="col-md-12" >
		<table class="table">
		
		<tbody>
		<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Competencias</strong></P></center></th></tr>
		<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Competencias solicitadas en las ofertas</strong></P></center></th></tr>

	<?php 
		$competency = array(); 
		$sinCompetency = 0;
		
		for($cont=1; $cont<=count($Competencias); $cont++):
			$competency[$cont] = 0;
		endfor;
				
		 foreach($ofertas as $oferta):
				if(isset($oferta['CompanyJobOfferCompetency']) AND (!empty($oferta['CompanyJobOfferCompetency']))):
					foreach($oferta['CompanyJobOfferCompetency'] as $comp):
							for($cont=1; $cont<=count($Competencias); $cont++):
								if($comp['competency_id'] == $cont):
									$competency[$cont]++;
								endif;
							endfor;
					endforeach;
				else:
					$sinCompetency++;
				endif;
		endforeach;
	
			$i=1;
			foreach($Competencias as $competencia):
				if(count($ofertas)==0):
					$tabla='<tr><td colspan="2">'.$competencia.' 0.0% - (0)</td>';
				else:
					if($competency[$i]>0):
						$porcentajeComp = ($competency[$i] * 100) / count($ofertas);
						$tabla='<tr><td colspan="2">'.$competencia.' '.number_format($porcentajeComp, 2, '.', '').' % - ('.$competency[$i].')</td>';
					else:
						$tabla='<tr><td colspan="2">'.$competencia.' 0.0% - (0)</td>';
					endif;
				endif;
			$i++;
			echo $tabla;
			endforeach; 
			
			if($sinCompetency==0):
				echo '<tr><td>OFERTAS SIN COMPETENCIAS 0.0% - ('.$sinCompetency.')</td></tr>'; 
			else:	
				$porcientosinCompetency = ($sinCompetency * 100) / count($ofertas);
				echo '<tr><td>OFERTAS SIN COMPETENCIAS '.number_format($porcientosinCompetency, 2, '.', '').'% - ('.$sinCompetency.')</td></tr>'; 
			endif;
		?>	
					</tbody>
				</table>
			</div>
		</div>
	  </div>
	</div>
	</div>
	
	<div class="panel-group">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h4 class="panel-title">
			  <a class="intoCollaps" data-toggle="collapse" href="#conocimientosId">Conocimientos y habilidades técnico-profesionales</a>
			</h4>
		  </div>
		  <div id="conocimientosId" class="panel-collapse collapse">
			<div class="panel-body">	
		
		<div class="col-md-12" >
		
		<table class="table">
		
		<tbody>
	
		<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Conocimientos y habilidades técnico-profesionales</strong></P></center></th></tr>	
		<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Idiomas requeridos en las ofertas</strong></P></center></th></tr>
					<?php 
						$Idiomas = array(); 
						$Lbajo = array(); 
						$Lmedio = array(); 
						$Lalto = array(); 
						$Ebajo = array(); 
						$Emedio = array(); 
						$Ealto = array(); 
						$Cbajo = array(); 
						$Cmedio = array(); 
						$Calto = array(); 
						$sinIdioma = 0;
						
						foreach($Lenguagesid as $Lenguageid):
							$Idiomas[$Lenguageid['Lenguage']['id']] = 0;
							$Lbajo[$Lenguageid['Lenguage']['id']] = 0;
							$Lmedio[$Lenguageid['Lenguage']['id']] = 0;
							$Lalto[$Lenguageid['Lenguage']['id']] = 0;
							$Ebajo[$Lenguageid['Lenguage']['id']] = 0;
							$Emedio[$Lenguageid['Lenguage']['id']] = 0;
							$Ealto[$Lenguageid['Lenguage']['id']] = 0;
							$Cbajo[$Lenguageid['Lenguage']['id']] = 0;
							$Cmedio[$Lenguageid['Lenguage']['id']] = 0;
							$Calto[$Lenguageid['Lenguage']['id']] = 0;
						endforeach;
						
						foreach($ofertas as $oferta):
							if(isset($oferta['CompanyJobLanguage'])):
								if(!empty($oferta['CompanyJobLanguage'])):
									foreach ($oferta['CompanyJobLanguage'] as $lengua):
										foreach($Lenguagesid as $Lenguageid):
											if($lengua['language_id'] == $Lenguageid['Lenguage']['id']):
												$Idiomas[$Lenguageid['Lenguage']['id']]++;
												
												if($lengua['reading_level'] == 1):
													$Lbajo[$Lenguageid['Lenguage']['id']]++;
												endif;

												if($lengua['reading_level'] == 2):
													$Lmedio[$Lenguageid['Lenguage']['id']]++;
												endif;

												if($lengua['reading_level'] == 3):
													$Lalto[$Lenguageid['Lenguage']['id']]++;	
												endif;

												if($lengua['writing_level'] == 1):
													$Ebajo[$Lenguageid['Lenguage']['id']]++;
												endif;

												if($lengua['writing_level'] == 2):
													$Emedio[$Lenguageid['Lenguage']['id']]++;
												endif;

												if($lengua['writing_level'] == 3):
													$Ealto[$Lenguageid['Lenguage']['id']]++;	
												endif;
												
												if($lengua['conversation_level'] == 1):
													$Cbajo[$Lenguageid['Lenguage']['id']]++;
												endif;

												if($lengua['conversation_level'] == 2):
													$Cmedio[$Lenguageid['Lenguage']['id']]++;
												endif;

												if($lengua['conversation_level'] == 3):
													$Calto[$Lenguageid['Lenguage']['id']]++;	
												endif;		
											endif;										
										endforeach;
									endforeach;
								else:
									$sinIdioma++;
								endif;
							else:
								$sinIdioma++;
							endif;
						endforeach;	

						echo '<table class="table myStyle">';
						echo '<thead><tr>
							  <td></td>
							  <td colspan="3"> Lectura  </td>
							  <td colspan="3"> Escritura  </td>
							  <td colspan="3"> Comprensión  </td>
							  <td></td></tr></thead>		
							  <thead><tr><th colspan="11">  </th></tr></thead>';
						echo '<thead><tr>
							  <td> Idioma </td>
							  <td>  Bajo </td>
							  <td>  Medio </td>
							  <td>  Alto </td>
							  <td>  Baja </td>
							  <td>  Media </td>
							  <td>  Alta </td>
							  <td>  Baja </td>
							  <td>  Media </td>
							  <td>  Alta </td>
							  <td> Total </td></tr></thead> 
							  <thead><tr><th colspan="11">  </th></tr></thead>';
							  
							foreach($Lenguagesid as $Lenguageid):
								if($Idiomas[$Lenguageid['Lenguage']['id']]==0):
									$PorcentajeIdioma = '0.0';
									$tabla='<tr><td style="width: 90px;">'.$Lenguageid['Lenguage']['lenguage'].'</td>';
									$tabla.='<td> 0.0% - ('.$Lbajo[$Lenguageid['Lenguage']['id']].')</td>';
									$tabla.='<td> 0.0% - ('.$Lmedio[$Lenguageid['Lenguage']['id']].')</td>';
									$tabla.='<td> 0.0% - ('.$Lalto[$Lenguageid['Lenguage']['id']].')</td>';
									$tabla.='<td> 0.0% - ('.$Ebajo[$Lenguageid['Lenguage']['id']].')</td>';
									$tabla.='<td> 0.0% - ('.$Emedio[$Lenguageid['Lenguage']['id']].')</td>';
									$tabla.='<td> 0.0% - ('.$Ealto[$Lenguageid['Lenguage']['id']].')</td>';
									$tabla.='<td> 0.0% - ('.$Cbajo[$Lenguageid['Lenguage']['id']].')</td>';
									$tabla.='<td> 0.0% - ('.$Cmedio[$Lenguageid['Lenguage']['id']].')</td>';
									$tabla.='<td> 0.0% - ('.$Calto[$Lenguageid['Lenguage']['id']].')</td>';
								else:
									$PorcentajeIdioma = ($Idiomas[$Lenguageid['Lenguage']['id']] * 100) / count($ofertas);
									$PorcentajeLbajo = ($Lbajo[$Lenguageid['Lenguage']['id']] * 100) / $Idiomas[$Lenguageid['Lenguage']['id']];
									$PorcentajeLmedio = ($Lmedio[$Lenguageid['Lenguage']['id']] * 100) / $Idiomas[$Lenguageid['Lenguage']['id']];
									$PorcentajeLalto = ($Lalto[$Lenguageid['Lenguage']['id']] * 100) / $Idiomas[$Lenguageid['Lenguage']['id']];
									$PorcentajeEbajo = ($Ebajo[$Lenguageid['Lenguage']['id']] * 100) / $Idiomas[$Lenguageid['Lenguage']['id']];
									$PorcentajeEmedio = ($Emedio[$Lenguageid['Lenguage']['id']] * 100) / $Idiomas[$Lenguageid['Lenguage']['id']];
									$PorcentajeEalto = ($Ealto[$Lenguageid['Lenguage']['id']] * 100) / $Idiomas[$Lenguageid['Lenguage']['id']];
									$PorcentajeCbajo = ($Cbajo[$Lenguageid['Lenguage']['id']] * 100) / $Idiomas[$Lenguageid['Lenguage']['id']];
									$PorcentajeCmedio = ($Cmedio[$Lenguageid['Lenguage']['id']] * 100) / $Idiomas[$Lenguageid['Lenguage']['id']];
									$PorcentajeCalto = ($Calto[$Lenguageid['Lenguage']['id']] * 100) / $Idiomas[$Lenguageid['Lenguage']['id']];
									
									$tabla='<tr><td style="width: 90px;">'.$Lenguageid['Lenguage']['lenguage'].'</td>';
									$tabla.='<td> '.number_format($PorcentajeLbajo, 2, '.', '').' % - ('.$Lbajo[$Lenguageid['Lenguage']['id']].')</td>';
									$tabla.='<td> '.number_format($PorcentajeLmedio, 2, '.', '').' % - ('.$Lmedio[$Lenguageid['Lenguage']['id']].')</td>';
									$tabla.='<td> '.number_format($PorcentajeLalto, 2, '.', '').' % - ('.$Lalto[$Lenguageid['Lenguage']['id']].')</td>';
									$tabla.='<td> '.number_format($PorcentajeEbajo, 2, '.', '').' % - ('.$Ebajo[$Lenguageid['Lenguage']['id']].')</td>';
									$tabla.='<td> '.number_format($PorcentajeEmedio, 2, '.', '').' % - ('.$Emedio[$Lenguageid['Lenguage']['id']].')</td>';
									$tabla.='<td> '.number_format($PorcentajeEalto, 2, '.', '').' % - ('.$Ealto[$Lenguageid['Lenguage']['id']].')</td>';
									$tabla.='<td> '.number_format($PorcentajeCbajo, 2, '.', '').' % - ('.$Cbajo[$Lenguageid['Lenguage']['id']].')</td>';
									$tabla.='<td> '.number_format($PorcentajeCmedio, 2, '.', '').' % - ('.$Cmedio[$Lenguageid['Lenguage']['id']].')</td>';
									$tabla.='<td> '.number_format($PorcentajeCalto, 2, '.', '').' % - ('.$Calto[$Lenguageid['Lenguage']['id']].')</td>';
								endif;
							
								$tabla.='<td colspan="2">'.number_format($PorcentajeIdioma, 2, '.', '').' % - ('.$Idiomas[$Lenguageid['Lenguage']['id']].')</td></tr>';
								echo $tabla;

							endforeach; 
							
							if($sinIdioma==0):
								echo '<tr><td colspan=10 >OFERTAS SIN IDIOMAS</td><td> 0.0% - ('.$sinIdioma.')</td></tr>'; 
							else:	
								$porcientoSinIdioma = ($sinIdioma * 100) / count($ofertas);
								echo '<tr><td colspan=10>OFERTAS SIN IDIOMAS </td><td>'.number_format($porcientoSinIdioma, 2, '.', '').'% - ('.$sinIdioma.')</td></tr>'; 
							endif;

					?>
					</tbody>
				</table>
			</div>
		</div>
	  </div>
	</div>
	</div>

			</div>
		   </div>
		    
			<?php
			endif;
			?>

			
			<?php
			if($ShowVacantes == 1):
			?>
			<div class = "panel-heading"> <!-- vacantes-->
			 <h4 class = "panel-title">
				<a data-toggle = "collapse" data-parent = "#accordion" class="chevron" href = "#collapse11">
				Vacantes
				</a>
				<button type="button" class="btn btn-primary btnBlue" style="float: right; padding-top: 6px; margin-top: -10px;" onclick="javascript:imprSelec('collapse11');
																				function imprSelec(muestra)
																					{
																						var ficha=document.getElementById(muestra);
																						var ventimp=window.open(' ','popimpr');
																						ventimp.document.write(ficha.innerHTML);
																						ventimp.document.close();
																						ventimp.print();
																						ventimp.close();
																					};">Imprimir <span class="glyphicon glyphicon-print"></span> </button>
			 </h4>
		  </div>
		  
			<div id = "collapse11" class = "panel-collapse collapse in">
			 <div class = "panel-body">   
		   
		<!-- Inicio de tabla VACANTES (PUBLICADAS) -->
	<div class="panel-group">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h4 class="panel-title">
			  <a class="intoCollaps" data-toggle="collapse" href="#perfilVacantesId">Perfil de Vacantes</a>
			</h4>
		  </div>
		  <div id="perfilVacantesId" class="panel-collapse collapse">
			<div class="panel-body">	
			
						<div class="col-md-12" >
							<table class="table">
								<tbody>
								
									<?php
									$totalVacantes = 0;
									foreach($ofertas as $oferta):
										$totalVacantes = $totalVacantes + $oferta['CompanyJobProfile']['vacancy_number'];
									endforeach;
									?>
												
								<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Perfil de Vacantes</strong></P></center></th></tr>
								<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Total de vacantes publicadas</strong></P></center></th></tr>	
								<tr>
									<td colspan="2">Total de Vacantes <?php echo ($totalVacantes);?></td>
								</tr>
							<!-- CONFIDENCIALES -->
							
							<?php
												$si = 0; 
												$no = 0; 
													
												foreach($ofertas as $oferta):
													if($oferta['CompanyJobOffer']['confidential_job_offer'] == 's'):
														 $si++;
													 else: 
														 if($oferta['CompanyJobOffer']['confidential_job_offer'] == 'n'):
															 $no++; 
														 endif;
													endif; 
												endforeach;
												
												$tabla='';
												$tabla.='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Confidencial</strong></P></center></th>';
												
												if($si==0):
													$tabla.='<tr><td>Si 0.0% - ('.$si.')</td></tr>';

												else:
													$porcientoSi = ($si * 100) / ($totalVacantes);
													$tabla.='<tr><td>Si '.number_format($porcientoSi, 2, '.', '').'% - ('.$si.')</td></tr>';
												endif;
												
												
												if($no==0):
													$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';

												else:
													$porcientoNo = ($no * 100) / ($totalVacantes);	
													$tabla.='<tr><td>No '.number_format($porcientoNo, 2, '.', '').'% - ('.$no.')</td></tr>';
												endif;

												echo $tabla;
											?>
									
							<!-- GIROS OFERTAS -->
								<tr>
									<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Giros</strong></P></center></th>
								</tr>
							<?php
								$Rotation = array(); 
								$sinGiro = 0;
								
								for($cont=1; $cont<=count($Giros); $cont++):
									$Rotation[$cont] = 0;
								endfor;
										
								foreach($ofertas as $oferta):
											for($cont=1; $cont<=count($Giros); $cont++):
												if($oferta['CompanyJobProfile']['rotation'] == $cont):
													$Rotation[$cont]++;
												endif;
											endfor;
								endforeach;

								$i=1;
									
									foreach ($Giros as $giro):
										if($totalVacantes==0):
											$tabla='<tr><td colspan="2">'.$giro.' 0.0% - ('.$Rotation[$i].')</td></tr>';
										else:
											if($Rotation[$i]==0):
												$tabla='<tr><td colspan="2">'.$giro.' 0.0% - ('.$Rotation[$i].')</td></tr>';
											else:
												$porcentajeGiro = ($Rotation[$i] * 100) / ($totalVacantes);
												$tabla='<tr><td colspan="2">'.$giro.' '.number_format($porcentajeGiro, 2, '.', '').' % - ('.$Rotation[$i].')</td></tr>';
											endif;
										endif;
										$i++;
										echo $tabla;
									endforeach;
								?>	
							<!-- Oferta incluyente -->
								<?php
												$si = 0; 
												$no = 0; 
												$sinDefinir = 0;
												
												foreach($ofertas as $oferta):
													if($oferta['CompanyJobProfile']['disability'] == 's'):
														 $si++;
													 else: 
														 if($oferta['CompanyJobProfile']['disability'] == 'n'):
															 $no++; 
														 endif;
													endif; 
													
													if(($oferta['CompanyJobProfile']['disability'] == '') or ($oferta['CompanyJobProfile']['disability'] == null)):
														$sinDefinir++;
													endif;
						
												endforeach;
												
												$tabla='';
												$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Incluyentes</strong></P></center></th></tr>';
												
												if($totalVacantes==0):
													$tabla.='<tr><td>Si 0.0% - ('.$si.')</td></tr>';
													$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';
													$tabla.='<tr><td>Sin definir 0.0% - ('.$sinDefinir.')</td></tr>';
												else:
													if($si==0):
														$tabla.='<tr><td>Si 0.0% - ('.$si.')</td></tr>';
													else:
														$porcientoSi = ($si * 100) / ($totalVacantes);
														$tabla.='<tr><td>Si '.number_format($porcientoSi, 2, '.', '').'% - ('.$si.')</td></tr>';
													endif;
													
													if($no==0):
														$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';
													else:
														$porcientoNo = ($no * 100) / ($totalVacantes);	
														$tabla.='<tr><td>No '.number_format($porcientoNo, 2, '.', '').'% - ('.$no.')</td></tr>';
													endif;
													
													if($sinDefinir>0):
														$porcientoNo = ($sinDefinir * 100) / ($totalVacantes);	
														$tabla.='<tr><td>Sin definir '.number_format($porcientoNo, 2, '.', '').'% - ('.$sinDefinir.')</td></tr>';
													endif;
												endif;
												echo $tabla;

											?>
							
							<!-- Tipos de Discapacidad -->
							<?php 		
								$ceguera = 0; 
								$auditiva = 0; 
								$visual = 0;
								$motora = 0;
								$multiple = 0;
								$sordera = 0; 
								$ninguna = 0;
								
								foreach ($ofertas as $oferta):
									if ($oferta ['CompanyJobProfile']['disability_type'] == 1):
										$ceguera++;
									else:
										if ($oferta ['CompanyJobProfile']['disability_type'] == 2):
											$auditiva++;
										else:
											if ($oferta ['CompanyJobProfile']['disability_type'] == 3):
												$visual++;
											else:
												if ($oferta ['CompanyJobProfile']['disability_type'] == 4):
													$motora++;
												else:
													if ($oferta ['CompanyJobProfile']['disability_type'] == 5):
														$multiple++;
													else:
														if ($oferta ['CompanyJobProfile']['disability_type'] == 6):
															$sordera++;
														else:
															$ninguna++;
														endif;
													endif;
												endif;
											endif;
										endif;
									endif;
								endforeach;
										
										$tabla='';
										$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Tipo de discapacidad</strong></P></center></th></tr>';
										
										if($totalVacantes==0):
										
											$tabla.='<tr><td>Ceguera 0.0% - ('.$ceguera.')</td></tr>';
											$tabla.='<tr><td>Debilidad auditiva 0.0% - ('.$auditiva.')</td></tr>';
											$tabla.='<tr><td>Devilidad visual 0.0% - ('.$visual.')</td></tr>';
											$tabla.='<tr><td>Motriz o motora 0.0% - ('.$motora.')</td></tr>';
											$tabla.='<tr><td>Multiples 0.0% - ('.$multiple.')</td></tr>';
											$tabla.='<tr><td>Sordera 0.0% - ('.$sordera.')</td></tr>';	
											$tabla.='<tr><td>Sin discapacidad 0.0% - ('.$ninguna.')</td></tr>';
										
										else:
										
											$porcientoCeguera = ($ceguera * 100) / ($totalVacantes);
											$porcientoAuditiva = ($auditiva * 100) / ($totalVacantes);
											$porcientoVisual = ($visual * 100) / ($totalVacantes);
											$porcientoMotora = ($motora * 100) / ($totalVacantes);
											$porcientoMultiple = ($multiple * 100) / ($totalVacantes);
											$porcientoSordera = ($sordera * 100) / ($totalVacantes);
											$porcientoNinguna = ($ninguna * 100) / ($totalVacantes);
											
											$tabla.='<tr><td>Ceguera '.number_format($porcientoCeguera, 2, '.', '').'% - ('.$ceguera.')</td></tr>';
											$tabla.='<tr><td>Debilidad auditiva '.number_format($porcientoAuditiva, 2, '.', '').'% - ('.$auditiva.')</td></tr>';
											$tabla.='<tr><td>Devilidad visual '.number_format($porcientoVisual, 2, '.', '').'% - ('.$visual.')</td></tr>';
											$tabla.='<tr><td>Motriz o motora '.number_format($porcientoMotora, 2, '.', '').'% - ('.$motora.')</td></tr>';
											$tabla.='<tr><td>Multiples '.number_format($porcientoMultiple, 2, '.', '').'% - ('.$multiple.')</td></tr>';
											$tabla.='<tr><td>Sordera '.number_format($porcientoSordera, 2, '.', '').'% - ('.$sordera.')</td></tr>';	
											$tabla.='<tr><td>Sin discapacidad '.number_format($porcientoNinguna, 2, '.', '').'% - ('.$ninguna.')</td></tr>';
										
										endif;
										echo $tabla;
							
							?>		 
											
							<!-- Tipo de contrato Ofertas-->
							
							<?php
							
								$base = 0; 
								$becario = 0; 
								$capacitacion = 0;
								$confianza = 0; 
								$honorarios = 0; 
								$horas = 0;
								$practicas = 0; 
								$tercerización = 0;
								$indeterminado = 0; 
								$prueba = 0;
								$definido = 0;
									
								 foreach($ofertas as $oferta):
										
										if($oferta['CompanyJobContractType']['contract_type'] == 1):
											 $base++; 
										else:
											if($oferta['CompanyJobContractType']['contract_type'] == 2):
											 $becario++; 
											else:
												if($oferta['CompanyJobContractType']['contract_type'] == 3):
												$capacitacion++; 
												else:
													if($oferta['CompanyJobContractType']['contract_type'] == 4):
													 $confianza++;
													else:
														if($oferta['CompanyJobContractType']['contract_type'] == 5):
															$honorarios++; 
														else:
															if($oferta['CompanyJobContractType']['contract_type'] == 6):
																$horas++; 
															else:
																if($oferta['CompanyJobContractType']['contract_type'] == 7):
																	$practicas++; 
																else:
																	if($oferta['CompanyJobContractType']['contract_type'] == 8):
																		$tercerización++; 
																	else:
																		if($oferta['CompanyJobContractType']['contract_type'] == 9):
																			$indeterminado++; 
																		else:
																			if($oferta['CompanyJobContractType']['contract_type'] == 10):
																				$prueba++; 
																			else:
																				if($oferta['CompanyJobContractType']['contract_type'] == 11):
																					$definido++; 
																				endif;
																			endif;
																		endif;
																	endif;
																endif;
															endif;
														endif;
													endif;
												endif;
											endif;
										endif;
								endforeach;
								
								$tabla='';
								$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Tipo de contrato</strong></P></center></th></tr>';
								
								if($totalVacantes==0):
								
									$tabla.='<tr><td>Base 0.0% - ('.$base.')</td></tr>';
									$tabla.='<tr><td>Becario 0.0% - ('.$becario.')</td></tr>';	
									$tabla.='<tr><td>Capacitación inicial 0.0% - ('.$capacitacion.')</td></tr>'; 
									$tabla.='<tr><td>Confianza 0.0% - ('.$confianza.')</td></tr>';
									$tabla.='<tr><td>Honorarios 0.0% - ('.$honorarios.')</td></tr>';
									$tabla.='<tr><td>por horas 0.0% - ('.$horas.')</td></tr>';
									$tabla.='<tr><td>Prácticas 0.0% - ('.$practicas.')</td></tr>'; 
									$tabla.='<tr><td>Tercerización 0.0% - ('.$tercerización.')</td></tr>'; 
									$tabla.='<tr><td>Tiempo indeterminado 0.0% - ('.$indeterminado.')</td></tr>';
									$tabla.='<tr><td>Periodo de prueba 0.0% - ('.$prueba.')</td></tr>';
									$tabla.='<tr><td>Contrato por tiempo definido 0.0% - ('.$definido.')</td></tr>';
								
								else:
									if($base==0):
										$tabla.='<tr><td>Base 0.0% - ('.$base.')</td></tr>';
									else:
										$porcientoBase = ($base * 100) / ($totalVacantes);
										$tabla.='<tr><td>Base '.number_format($porcientoBase, 2, '.', '').'% - ('.$base.')</td></tr>';
									endif;
									
									if($becario==0):
										$tabla.='<tr><td>Becario 0.0% - ('.$becario.')</td></tr>';	
									else:
										$porcientoBecarios = ($becario * 100) / ($totalVacantes);
										$tabla.='<tr><td>Becario '.number_format($porcientoBecarios, 2, '.', '').'% - ('.$becario.')</td></tr>';	
									endif;
									
									if($capacitacion==0):
										$tabla.='<tr><td>Capacitación inicial 0.0% - ('.$capacitacion.')</td></tr>'; 
									else:
										$porcientoCapacitacion = ($capacitacion * 100) / ($totalVacantes);
										$tabla.='<tr><td>Capacitación inicial '.number_format($porcientoCapacitacion, 2, '.', '').'% - ('.$capacitacion.')</td></tr>'; 
									endif;
									
									if($confianza==0):
										$tabla.='<tr><td>Confianza 0.0% - ('.$confianza.')</td></tr>';
									else:
										$porcientoConfianza = ($confianza * 100) / ($totalVacantes);
										$tabla.='<tr><td>Confianza '.number_format($porcientoConfianza, 2, '.', '').'% - ('.$confianza.')</td></tr>';
									endif;
									
									if($honorarios==0):
										$tabla.='<tr><td>Honorarios 0.0% - ('.$honorarios.')</td></tr>';
									else:
										$porcientoHonorarios = ($honorarios * 100) / ($totalVacantes);	
										$tabla.='<tr><td>Honorarios '.number_format($porcientoHonorarios, 2, '.', '').'% - ('.$honorarios.')</td></tr>';
									endif;
									
									if($horas==0):
										$tabla.='<tr><td>por horas 0.0% - ('.$horas.')</td></tr>';
									else:
										$porcientoHoras = ($horas * 100) / ($totalVacantes);
										$tabla.='<tr><td>por horas '.number_format($porcientoHoras, 2, '.', '').'% - ('.$horas.')</td></tr>';
									endif;
									
									if($practicas==0):
										$tabla.='<tr><td>Prácticas 0.0% - ('.$practicas.')</td></tr>'; 
									else:
										$porcientoPracticas = ($practicas * 100) / ($totalVacantes);	
										$tabla.='<tr><td>Prácticas '.number_format($porcientoPracticas, 2, '.', '').'% - ('.$practicas.')</td></tr>'; 
									endif;
									
									if($tercerización==0):
										$tabla.='<tr><td>Tercerización 0.0% - ('.$tercerización.')</td></tr>'; 
									else:
										$porcientoTercerización = ($tercerización * 100) / ($totalVacantes);	
										$tabla.='<tr><td>Tercerización '.number_format($porcientoTercerización, 2, '.', '').'% - ('.$tercerización.')</td></tr>'; 
									endif;
									
									if($indeterminado==0):
										$tabla.='<tr><td>Tiempo indeterminado 0.0% - ('.$indeterminado.')</td></tr>';
									else:
										$porcientoIndeterminado = ($indeterminado * 100) / ($totalVacantes);	
										$tabla.='<tr><td>Tiempo indeterminado '.number_format($porcientoIndeterminado, 2, '.', '').'% - ('.$indeterminado.')</td></tr>';
									endif;
									
									if($prueba==0):
										$tabla.='<tr><td>Periodo de prueba 0.0% - ('.$prueba.')</td></tr>';
									else:
										$porcientoPrueba = ($prueba * 100) / ($totalVacantes);
										$tabla.='<tr><td>Periodo de prueba '.number_format($porcientoPrueba, 2, '.', '').'% - ('.$prueba.')</td></tr>';
									endif;
									
									if($definido==0):
										$tabla.='<tr><td>Contrato por tiempo definido 0.0% - ('.$definido.')</td></tr>';
									else:
										$porcientoDefinido = ($definido * 100) / ($totalVacantes);	
										$tabla.='<tr><td>Contrato por tiempo definido '.number_format($porcientoDefinido, 2, '.', '').'% - ('.$definido.')</td></tr>';
									endif;
									
								endif;
								echo $tabla;

							?>
							
							<!-- Jornada Laboral -->
								<tr>
									<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Jornada laboral</strong></P></center></th>
								</tr>
							<?php
							
								$jornadas = array(); 
								
								for($cont=1; $cont<=20; $cont++):
									$jornadas[$cont] = 0;
								endfor;
										
								foreach($ofertas as $oferta):
											for($cont=1; $cont<=20; $cont++):
												if($oferta['CompanyJobContractType']['workday'] == $cont):
													$jornadas[$cont]++;
												endif;
											endfor;
								endforeach;
								
								?>
									
								<?php
									$i=1;
									
									foreach ($JornadasLaborales as $laboral):
										if($totalVacantes==0):
											$tabla='<tr><td colspan="2">'.$laboral.' 0.0% - ('.$jornadas[$i].')</td></tr>';
										else:
											if($jornadas[$i]==0):
												$tabla='<tr><td colspan="2">'.$laboral.' 0.0% - ('.$jornadas[$i].')</td></tr>';
											else:
												$porcentajeLaboral = ($jornadas[$i] * 100) / ($totalVacantes);
												$tabla='<tr><td colspan="2">'.$laboral.' '.number_format($porcentajeLaboral, 2, '.', '').' % - ('.$jornadas[$i].')</td></tr>';
											endif;
										endif;
									$i++;
									echo $tabla;
									endforeach;
								?>
								
							<!-- SUELDOS -->
							
								<tr>
									<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Sueldos</strong></P></center></th>
								</tr>
							<?php
								$sueldos = array(); 
								
								for($cont=1; $cont<=count($Salarios); $cont++):
									$sueldos[$cont] = 0;
								endfor;
										
								foreach($ofertas as $oferta):
											for($cont=1; $cont<=count($Salarios); $cont++):
												if($oferta['CompanyJobContractType']['salary'] == $cont):
													$sueldos[$cont]++;
												endif;
											endfor;
								endforeach;

									$i=1;
									foreach ($Salarios as $salario):
										if($totalVacantes==0):
											$tabla='<tr><td colspan="2">'.$salario.' 0.0% - ('.$sueldos[$i].')</td></tr>';
										else:
											if($sueldos[$i]==0):
												$tabla='<tr><td colspan="2">'.$salario.' 0.0% - ('.$sueldos[$i].')</td></tr>';
											else:
												$porcentajeSalario = ($sueldos[$i] * 100) / ($totalVacantes);
												$tabla='<tr><td colspan="2">'.$salario.' '.number_format($porcentajeSalario, 2, '.', '').' % - ('.$sueldos[$i].')</td></tr>';
											endif;
										endif;
									$i++;
									echo $tabla;
									endforeach;
								?>
							
							
							<!-- ENTIDADES FEDERATIVAS -->
								<tr>
									<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Lugar de Trabajo</strong></P></center></th>
								</tr>
							<?php
								$estado = array(); 
								
								for($cont=1; $cont<=32; $cont++):
									$estado[$cont] = 0;
								endfor;
										
								foreach($ofertas as $oferta):
											for($cont=1; $cont<=32; $cont++):
												if($oferta['CompanyJobContractType']['state'] == $Estados[$cont]):
													$estado[$cont]++;
												endif;
											endfor;
								endforeach;
								
							?>
									
								<?php  
								
									$i=1;
									foreach ($Estados as $entidad):
										if($totalVacantes==0):
											$tabla='<tr><td colspan="2">'.$entidad.' 0.0% - ('.$estado[$i].')</td></tr>';
										else:
											if($estado[$i]==0):
												$tabla='<tr><td colspan="2">'.$entidad.' 0.0% - ('.$estado[$i].')</td></tr>';
											else:
												$PorcentajeEntidad = ($estado[$i] * 100) / ($totalVacantes);
												$tabla='<tr><td colspan="2">'.$entidad.' '.number_format($PorcentajeEntidad, 2, '.', '').' % - ('.$estado[$i].')</td></tr>';
											endif;
										endif;
									$i++;
									echo $tabla;
									endforeach;
								?>	
								
							<!-- DISPONIVILIDAD PARA VIAJAR -->
							<?php
												$si = 0; 
												$no = 0; 
													
												foreach($ofertas as $oferta):
													if($oferta['CompanyJobContractType']['mobility'] == 's'):
														 $si++;
													 else: 
														 if($oferta['CompanyJobContractType']['mobility'] == 'n'):
															 $no++; 
														 endif;
													endif; 
												endforeach;
												
												$tabla='';
												$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Disponibilidad para viajar</strong></P></center></th></tr>';
												
												if($totalVacantes==0):
													
													$tabla.='<tr><td>Si 0.0% - ('.$si.')</td></tr>';
													$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';
												
												else:
													if($si==0):
														$tabla.='<tr><td>Si 0.0% - ('.$si.')</td></tr>';
													else:
														$porcientoSi = ($si * 100) / ($totalVacantes);
														$tabla.='<tr><td>Si '.number_format($porcientoSi, 2, '.', '').'% - ('.$si.')</td></tr>';
													endif;
													
													if($no==0):
														$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';	
													else:
														$porcientoNo = ($no * 100) / ($totalVacantes);
														$tabla.='<tr><td>No '.number_format($porcientoNo, 2, '.', '').'% - ('.$no.')</td></tr>';
													endif;
												
												endif;
												echo $tabla;
											?>
										
									
									
							<!-- Total dentro del pais -->
							
							<?php
								$si = 0; 
								$no = 0; 
													
									foreach($ofertas as $oferta):
										if($oferta['CompanyJobContractType']['mobility_option'] == 1):
											$si++;
										else: 
											if($oferta['CompanyJobContractType']['mobility_option'] == 2):
												$no++; 
											endif;
										endif; 
									endforeach;
									
									$tabla='';
									$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>En México</strong></P></center></th></tr>';
												
									if($totalVacantes==0):
									
										$tabla.='<tr><td>Si 0.0% - ('.$si.')</td></tr>';
										$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';
									
									else:
										if($si==0):
											$tabla.='<tr><td>Si 0.0% - ('.$si.')</td></tr>';
										else:
											$porcientoSi = ($si * 100) / ($totalVacantes);
											$porcientoNo = ($no * 100) / ($totalVacantes);	
										endif;
										
										if($no==0):
											$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';
										else:
											$tabla.='<tr><td>Si '.number_format($porcientoSi, 2, '.', '').'% - ('.$si.')</td></tr>';
											$tabla.='<tr><td>No '.number_format($porcientoNo, 2, '.', '').'% - ('.$no.')</td></tr>';
										endif;
									
									endif;
									echo $tabla;
							?>
							
							<!-- Total fuera del pais -->
							
							<?php
								$si = 0; 
								$no = 0; 
													
									foreach($ofertas as $oferta):
										if($oferta['CompanyJobContractType']['mobility_option'] == 2):
											$si++;
										else: 
											if($oferta['CompanyJobContractType']['mobility_option'] == 1):
												$no++; 
											endif;
										endif; 
									endforeach;	
									
									$tabla='';
									$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Al extranjero</strong></P></center></th></tr>';
									
									if($totalVacantes==0):
										
										$tabla.='<tr><td>Si 0.0% - ('.$si.')</td></tr>';
										$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';
										
									else:
										if($si==0):
											$tabla.='<tr><td>Si 0.0% - ('.$si.')</td></tr>';
										else:
											$porcientoSi = ($si * 100) / ($totalVacantes);
											$tabla.='<tr><td>Si '.number_format($porcientoSi, 2, '.', '').'% - ('.$si.')</td></tr>';
										endif;
										
										if($no==0):
											$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';
										else:
											$porcientoNo = ($no * 100) / ($totalVacantes);	
											$tabla.='<tr><td>No '.number_format($porcientoNo, 2, '.', '').'% - ('.$no.')</td></tr>';
										endif;
										
									
									endif;
									echo $tabla;
							?>
			
					</tbody>
				</table>
			</div>
		  </div>
		</div>
	  </div>
	 </div>
				

		<div class="panel-group">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h4 class="panel-title">
			  <a class="intoCollaps" data-toggle="collapse" href="#perfilCandidatoVacantesId">Perfil del candidato</a>
			</h4>
		  </div>
		  <div id="perfilCandidatoVacantesId" class="panel-collapse collapse">
			<div class="panel-body">	
			
						<div class="col-md-12" >
							<table class="table">		
						
							<tbody>
							
							<!-- Total por nivel academico-->
							
							<?php
								$licenciatura = 0; 
								$especialidad = 0; 
								$maestria = 0;
								$doctorado = 0;
								$sinNivel = 0;
								
								foreach($ofertas as $oferta):
									foreach($oferta['CompanyCandidateProfile'] as $nivel):
										if($nivel['academic_level_id'] == 1):
											$licenciatura++; 
										endif;
											if($nivel['academic_level_id'] == 2):
											  $especialidad++; 
											endif;
												if($nivel['academic_level_id'] == 3):
												  $maestria++; 
												endif;
													if($nivel['academic_level_id'] == 4):
													  $doctorado++;
													endif;
										if(empty($oferta['CompanyCandidateProfile'])):
											$sinNivel++;
										endif;
									endforeach;
								endforeach;
								
								$tabla='<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Perfil del candidato</strong></P></center></th></tr>';
								$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Nivel academico</strong></P></center></th></tr>';
								
								if($totalVacantes==0):
								
									$tabla.='<tr><td>Licenciatura 0.0% - ('.$licenciatura.')</td></tr>';
									$tabla.='<tr><td>Especialidad 0.0% - ('.$especialidad.')</td></tr>';
									$tabla.='<tr><td>Maestria 0.0% - ('.$maestria.')</td></tr>';
									$tabla.='<tr><td>Doctorado 0.0% - ('.$doctorado.')</td></tr>';  
									$tabla.='<tr><td>Sin nivel 0.0% - ('.$sinNivel.')</td></tr>'; 
								
								else:
									
									if($licenciatura==0):
										$tabla.='<tr><td>Licenciatura 0.0% - ('.$licenciatura.')</td></tr>';
									else:
										$porcientoLicenciatura = ($licenciatura * 100) / ($totalVacantes);
										$tabla.='<tr><td>Licenciatura '.number_format($porcientoLicenciatura, 2, '.', '').'% - ('.$licenciatura.')</td></tr>';
									endif;
									
									if($especialidad==0):
										$tabla.='<tr><td>Especialidad 0.0% - ('.$especialidad.')</td></tr>';
									else:
										$porcientoEspecialidad = ($especialidad * 100) / ($totalVacantes);
										$tabla.='<tr><td>Especialidad '.number_format($porcientoEspecialidad, 2, '.', '').'% - ('.$especialidad.')</td></tr>';
									endif;
									
									if($maestria==0):
										$tabla.='<tr><td>Maestria 0.0% - ('.$maestria.')</td></tr>';
									else:
										$porcientoMaestria = ($maestria * 100) / ($totalVacantes);
										$tabla.='<tr><td>Maestria '.number_format($porcientoMaestria, 2, '.', '').'% - ('.$maestria.')</td></tr>';
									endif;
										
									if($doctorado==0):
										$tabla.='<tr><td>Doctorado 0.0% - ('.$doctorado.')</td></tr>';  
									else:
										$porcientoDoctorado = ($doctorado * 100) / ($totalVacantes);
										$tabla.='<tr><td>Doctorado '.number_format($porcientoDoctorado, 2, '.', '').'% - ('.$doctorado.')</td></tr>';  				
									endif;

									if($sinNivel==0):
										$tabla.='<tr><td>Sin nivel 0.0% - ('.$sinNivel.')</td></tr>'; 
									else:
										$porcientoSinNivel = ($sinNivel * 100) / ($totalVacantes);	
										$tabla.='<tr><td>Sin nivel '.number_format($porcientoSinNivel, 2, '.', '').'% - ('.$sinNivel.')</td></tr>'; 
									endif;
									
								endif;
								echo $tabla;
							?>

							<!-- Total por situacion Académica -->

						<?php
								$alumno = 0; 
								$egresado = 0; 
								$titulado = 0;
								$diploma = 0;
								$grados = 0;
								$sinSituacion = 0;	
								
								foreach($ofertas as $oferta):
									foreach($oferta['CompanyCandidateProfile'] as $situacion):
										if($situacion['academic_situation_id'] == 1):
											 $alumno++;
										else: 
											if($situacion['academic_situation_id'] == 2):
												 $egresado++; 
											else:
												if($situacion['academic_situation_id'] == 3):
													$titulado++; 
												else:
													if($situacion['academic_situation_id'] == 4):
														$diploma++; 
													else:
														if($situacion['academic_situation_id'] == 5):
															$grados++; 
														endif;
													endif;
												endif;
											endif;
										endif;
										if(empty($oferta['CompanyCandidateProfile'])):
											$sinSituacion++;
										endif;
									endforeach;
								endforeach;
								
								$tabla='';
								$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Stuación Académica</strong></P></center></th></tr>';
								
								if($totalVacantes==0):
								
									$tabla.='<tr><td>Estudiante 0.0% - ('.$alumno.')</td></tr>';
									$tabla.='<tr><td>Egresado 0.0% - ('.$egresado.')</td></tr>';
									$tabla.='<tr><td>Titulado 0.0% - ('.$titulado.')</td></tr>';
									$tabla.='<tr><td>Con diploma 0.0% - ('.$diploma.')</td></tr>';   
									$tabla.='<tr><td>Con Grado 0.0% - ('.$grados.')</td></tr>';
									$tabla.='<tr><td>Sin situación académica 0.0% - ('.$sinSituacion.')</td></tr>'; 
								
								else:
									if($alumno==0):
										$tabla.='<tr><td>Estudiante 0.0% - ('.$alumno.')</td></tr>';
									else:	
										$porcientoAlumno = ($alumno * 100) / ($totalVacantes);
										$tabla.='<tr><td>Estudiante '.number_format($porcientoAlumno, 2, '.', '').'% - ('.$alumno.')</td></tr>';
									endif;

									if($egresado==0):
										$tabla.='<tr><td>Egresado 0.0% - ('.$egresado.')</td></tr>';
									else:	
										$porcientoEgresado = ($egresado * 100) / ($totalVacantes);
										$tabla.='<tr><td>Egresado '.number_format($porcientoEgresado, 2, '.', '').'% - ('.$egresado.')</td></tr>';
									endif;
									
									if($titulado==0):
										$tabla.='<tr><td>Titulado 0.0% - ('.$titulado.')</td></tr>';
									else:	
										$porcientoTitulado = ($titulado * 100) / ($totalVacantes);
										$tabla.='<tr><td>Titulado '.number_format($porcientoTitulado, 2, '.', '').'% - ('.$titulado.')</td></tr>';
									endif;
									
									if($diploma==0):
										$tabla.='<tr><td>Con diploma 0.0% - ('.$diploma.')</td></tr>';   
									else:	
										$porcientoDiploma = ($diploma * 100) / ($totalVacantes);
										$tabla.='<tr><td>Con diploma '.number_format($porcientoDiploma, 2, '.', '').'% - ('.$diploma.')</td></tr>';  
									endif;
									
									if($grados==0):
										$tabla.='<tr><td>Con Grado 0.0% - ('.$grados.')</td></tr>';   
									else:	
										$porcientoGrados = ($grados * 100) / ($totalVacantes);
										$tabla.='<tr><td>Con Grado '.number_format($porcientoGrados, 2, '.', '').'% - ('.$grados.')</td></tr>';  
									endif;

									if($sinSituacion==0):
										$tabla.='<tr><td>Sin situación académica 0.0% - ('.$sinSituacion.')</td></tr>'; 
									else:	
										$porcientoSinSituacion = ($sinSituacion * 100) / ($totalVacantes);
										$tabla.='<tr><td>Sin situación académica '.number_format($porcientoSinSituacion, 2, '.', '').'% - ('.$sinSituacion.')</td></tr>'; 
									endif;
									
								endif;
								echo $tabla;
							?>
					</tbody>
				</table>
			</div>
		  </div>
		</div>
	  </div>
	  </div>			

		<div class="panel-group">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h4 class="panel-title">
			  <a class="intoCollaps" data-toggle="collapse" href="#competenciasVacantesId">Competencias</a>
			</h4>
		  </div>
		  <div id="competenciasVacantesId" class="panel-collapse collapse">
			<div class="panel-body">	
			
						<div class="col-md-12" >
							<table class="table">		
						
							<tbody>						
							
							<!-- Competencias requeridas para la oferta -->
							
							<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Competencias</strong></P></center></th></tr>
							<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Competencias solicitadas en las vacantes</strong></P></center></th></tr>
							<?php
								$competency = array(); 
		$sinCompetency = 0;
		
		for($cont=1; $cont<=count($Competencias); $cont++):
			$competency[$cont] = 0;
		endfor;
				
		 foreach($ofertas as $oferta):
			if(isset($oferta['CompanyJobOfferCompetency']) and (!empty($oferta['CompanyJobOfferCompetency']))):
				foreach($oferta['CompanyJobOfferCompetency']as $comp):
						for($cont=1; $cont<=count($Competencias); $cont++):
							if($comp['competency_id'] == $cont):
								$competency[$cont]++;
							endif;
						endfor;
				endforeach;
			else:
				$sinCompetency++;
			endif;
		endforeach;
	
			$i=1;
			foreach($Competencias as $competencia):
				if(count($ofertas)==0):
					$tabla='<tr><td colspan="2">'.$competencia.' 0.0% - (0)</td>';
				else:
					if($competency[$i]>0):
						$porcentajeComp = ($competency[$i] * 100) / count($ofertas);
						$tabla='<tr><td colspan="2">'.$competencia.' '.number_format($porcentajeComp, 2, '.', '').' % - ('.$competency[$i].')</td>';
					else:
						$tabla='<tr><td colspan="2">'.$competencia.' 0.0% - (0)</td>';
					endif;
				endif;
			$i++;
			echo $tabla;
			endforeach; 
			
			if($sinCompetency==0):
				echo '<tr><td>OFERTAS SIN COMPETENCIAS 0.0% - ('.$sinCompetency.')</td></tr>'; 
			else:	
				$porcientosinCompetency = ($sinCompetency * 100) / count($ofertas);
				echo '<tr><td>OFERTAS SIN COMPETENCIAS '.number_format($porcientosinCompetency, 2, '.', '').'% - ('.$sinCompetency.')</td></tr>'; 
			endif;
									
								?>
							
					</tbody>
				</table>
			</div>
		  </div>
		</div>
	  </div>
	  </div>
				
			</div>
		  </div>
		    <?php
			endif;
			?>
		   			
			<?php
			if($ShowContrataciones == 1):
			?>
			<div class = "panel-heading"> <!-- Contrataciones y seguimientos-->
			 <h4 class = "panel-title">
				<a data-toggle = "collapse" data-parent = "#accordion" class="chevron"  href = "#collapse13">
				Contrataciones y Seguimientos 
				</a>
				<button type="button" class="btn btn-primary btnBlue" style="float: right; padding-top: 6px; margin-top: -10px;" onclick="javascript:imprSelec('collapse13');
																				function imprSelec(muestra)
																					{
																						var ficha=document.getElementById(muestra);
																						var ventimp=window.open(' ','popimpr');
																						ventimp.document.write(ficha.innerHTML);
																						ventimp.document.close();
																						ventimp.print();
																						ventimp.close();
																					};">Imprimir <span class="glyphicon glyphicon-print"></span> </button>
			 </h4>
		  </div>
		  
			<div id = "collapse13" class = "panel-collapse collapse in">
			 <div class = "panel-body"> 
			
			<!-- Contrataciones y Seguimientos -->
					
					<div class="panel-group">
						<div class="panel panel-default">
						  <div class="panel-heading">
							<h4 class="panel-title">
							  <a class="intoCollaps" data-toggle="collapse" href="#escuelasFacultadesContratacionId">Seguimiento Universitario</a>
							</h4>
						  </div>
						  <div id="escuelasFacultadesContratacionId" class="panel-collapse collapse">
							<div class="panel-body">	
					
						<div class="col-md-12" >
							<table class="table">
							<tbody>

							<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Seguimiento Universitario</strong></P></center></th></tr>
							<tr>
							  <th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Total de alumnos en un proceso de R&S </strong></P></th>
							</tr>

						
						<?php

							$tabla='';
							if(count($notificaciones) == 0):
								$tabla.='<tr><td>Total de estudiantes en proceso de R&S 0.0 % - ('.count($notificaciones).')</td></tr>';
							else:
								$tabla.='<tr><td>Total de estudiantes en proceso de R&S '.number_format((count($notificaciones) * 100) / count($notificaciones), 2, '.', '').'% -  ('.count($notificaciones).')</td></tr>';
							endif;
							echo $tabla;
						?>
						
						<!-- En proceso --> 
						
							<tr>
							  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>En Proceso</strong></P></center></th>
							</tr>
						<?php
						
						$telefonica = 0;
						$presencial = 0;
						$contratado = 0;

						
						foreach ($notificaciones as $notificacion):

								if (($notificacion['StudentNotification']['step_process'] == 1) AND($notificacion['StudentNotification']['type_respons'] == 0)):
									$telefonica++;
								endif;
								if (($notificacion['StudentNotification']['step_process'] == 2) AND($notificacion['StudentNotification']['type_respons'] == 5)):
									$presencial++;
								endif;
								if (($notificacion['StudentNotification']['step_process'] == 3) AND($notificacion['StudentNotification']['type_respons'] == 4)):
									$contratado++;
								endif;	

						endforeach;
						if(count($notificaciones) == 0):
							$tabla ='<tr><td>Entrevista telefonica 0.0% - ('.$telefonica.')</td></tr>';
							$tabla.='<tr><td>Entrevista presencial 0.0% - ('.$presencial.')</td></tr>';
							$tabla.='<tr><td>Contratado 0.0 %- ('.$contratado.')</td></tr>';
						else:
							$tabla ='<tr><td>Entrevista telefonica '.number_format(($telefonica * 100) / count($notificaciones), 2, '.', '').'% - ('.$telefonica.')</td></tr>';
							$tabla.='<tr><td>Entrevista presencial '.number_format(($presencial * 100) / count($notificaciones), 2, '.', '').'% - ('.$presencial.')</td></tr>';
							$tabla.='<tr><td>Contratado '.number_format(($contratado * 100) / count($notificaciones), 2, '.', '').'% - ('.$contratado.')</td></tr>';
						endif;
						echo $tabla;
						?>
						
						<!-- En proceso --> 
						
							<tr>
							  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Contratados</strong></P></center></th>
							</tr>
							<tr>
							  <th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Total contratados </strong></P></th>
							</tr>
					<?php
					
					$contratado = 0;
					$tabla = '';
					foreach($notificaciones as $notificacion):
					
						if (($notificacion['StudentNotification']['step_process'] == 3) AND($notificacion['StudentNotification']['type_respons'] == 4)):
							$contratado++;
						endif;	

					endforeach;
					
						if($contratado == 0):
							$tabla.='<tr><td>Total de Contratados 0.0 % - ('.$contratado.')</td></tr>';
						else:
							$tabla ='<tr><td> Total de Contratados '.number_format(($contratado * 100) / count($notificaciones), 2, '.', '').'% - ('.$contratado.')</td></tr>';
						endif;
					echo $tabla;
					
					?> 
					
					<tr>
						<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Rango de sueldos</strong></P></th>
					</tr>
					
					<?php
					
					//salarios
					
					$cont = 1;
					foreach($Salarios as $sueldo):
						$salario[$cont] = 0;
						$cont++;
					endforeach;		

						
					foreach($notificaciones as $notificacion):
						if (($notificacion['StudentNotification']['step_process'] == 3) AND ($notificacion['StudentNotification']['type_respons_company'] == 4)):

								$cont = 1;
								foreach($Salarios as $sueldo):
									if($notificacion['CompanyJobProfile']['CompanyJobContractType']['salary'] == $cont):
										$salario[$cont]++;
									endif;
									$cont++;
								endforeach;

						endif;
					endforeach;
					
					$tabla = '';
					$cont = 1;
					
					foreach($Salarios as $sueldo):
						if($salario[$cont] == 0):
							$tabla.='<tr><td>'.$sueldo.' 0.0 % - ('.$salario[$cont].')</td></tr>';
						else:
							$tabla.='<tr><td>'.$sueldo.' '.number_format(($salario[$cont] * 100) / count($notificaciones), 2, '.', '').'% - ('.$salario[$cont].')</td></tr>';
						endif;
					$cont++;
					endforeach;
					echo $tabla;
					?>
					
									</tbody>
								</table>
							</div>
						  </div>
						</div>
					  </div>
					  </div> 
					  
					  <div class="panel-group">
						<div class="panel panel-default">
						  <div class="panel-heading">
							<h4 class="panel-title">
							  <a class="intoCollaps" data-toggle="collapse" href="#ContrataciónUniversitarioPerfiId">Contratación Universitario Perfi</a>
							</h4>
						  </div>
						  <div id="ContrataciónUniversitarioPerfiId" class="panel-collapse collapse">
							<div class="panel-body">	

								<table class="table">
								<tbody>
									<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Contratación Universitario Perfil</strong></P></center></th></tr>
									<tr><th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Escuela / Carrera</strong></P></th></tr>

										<?php
										
												$escuelaLicenciatura = array(); 

												foreach($escuelasId as $escuelaId):
													$escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']] = 0;
												endforeach;
												
												foreach($facultadesId as $facultadId):
													$facultadPostgrado[$facultadId['FacultadPosgrado']['id']] = 0;
												endforeach;
												
												foreach($relacionEscuelaCarrera as $relacion):
													$relEscCar[$relacion['RelacionEscuelaCarrera']['id']] = 0;
												endforeach;
												
												foreach($relacionFacultadProgramas as $relacionF):
													$relFacPro[$relacionF['RelacionFacultadProgramas']['id']] = 0;
												endforeach;

												foreach($facultadesComplete as $programa):
													$totalProgramas[$programa['PosgradoProgram']['id']] = 0;
												endforeach;
												
												
												foreach($notificaciones as $notificacion):
													
													if (($notificacion['StudentNotification']['step_process'] == 3) AND ($notificacion['StudentNotification']['type_respons_company'] == 4)):
													
														foreach($notificacion['Student']['StudentProfessionalProfile'] as $escuelaStudent):

															// Solo licenciaturas
															foreach($escuelasId as $escuelaId):	
																if(($escuelaId['FacultadLicenciatura']['id'] == $escuelaStudent['undergraduate_institution']) AND ($escuelaStudent['academic_level_id'] == 1)):

																	// Busca si la carrera es impartida en esa escuela
																	foreach($carrerasComplete as $carrera):
																		if($carrera['Career']['id'] == $escuelaStudent['career_id']):
																			
																			// Compara la escuela y carrera en la tabla de relaciones y la agrega en la misma
																			foreach($relacionEscuelaCarrera as $relacion):
																				if(($relacion['RelacionEscuelaCarrera']['facultad_licenciatura_id']==$escuelaId['FacultadLicenciatura']['id']) AND ($relacion['RelacionEscuelaCarrera']['career_id']==$carrera['Career']['career_id'])):
																					$relEscCar[$relacion['RelacionEscuelaCarrera']['id']]++;
																					$escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']]++;									
																				endif;
																			endforeach;
																			
																		endif;
																	endforeach;
																	
																endif;
															endforeach;	
												
												
												
															// FACULTADES 
															foreach($facultadesId as $facultadId):	
																if(($facultadId['FacultadPosgrado']['id'] == $escuelaStudent['undergraduate_institution']) AND ($escuelaStudent['academic_level_id'] <> 1)):
																	
																	// Busca si la carrera es impartida en esa facultad
																	foreach($facultadesComplete as $programa):
																		if($programa['PosgradoProgram']['id'] == $escuelaStudent['posgrado_program_id']):
												
																			// Compara la escuela y carrera en la tabla de relación 
																			foreach($relacionFacultadProgramas as $relacionF):
																				if(($relacionF['RelacionFacultadProgramas']['facultad_posgrado_id']==$facultadId['FacultadPosgrado']['id']) AND ($relacionF['RelacionFacultadProgramas']['posgrado_program_id']==$programa['PosgradoProgram']['posgrado_program_id'])):
																					$relFacPro[$relacionF['RelacionFacultadProgramas']['id']]++;
																					$facultadPostgrado[$facultadId['FacultadPosgrado']['id']]++;
																				endif;
																			endforeach;
																		endif;
																	endforeach;
																	
																endif;
															endforeach;	
															
												
															
														endforeach;
													
													endif;
													
												endforeach;	
												
												//Impresion de escuelas 
												
												$tabla='';
												foreach ($escuelasId as $escuelaId):

													if($escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']] == 0):
														$tabla.='<tr><td><span class="glyphicon glyphicon-play"></span>' .$escuelaId['FacultadLicenciatura']['facultad_licenciatura'].' 0.0 % - ('.$escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']].')</td>';
													else:
														$tabla.='<tr><td><span class="glyphicon glyphicon-play"></span>' .$escuelaId['FacultadLicenciatura']['facultad_licenciatura'].' '.number_format(($escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']] * 100) / count($notificaciones), 2, '.', '').' % - ('.$escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']].')</td>';
													endif;
										
														foreach($relacionEscuelaCarrera as $relacion):
															if($relacion['RelacionEscuelaCarrera']['facultad_licenciatura_id'] == $escuelaId['FacultadLicenciatura']['id']):
																
																foreach($carrerasComplete as $carrera):
																	
																	if($carrera['Career']['career_id'] == $relacion['RelacionEscuelaCarrera']['career_id']):
																		$carreraImprimir = $carrera['Career']['career'];
																		$totalImprimir = $relEscCar[$relacion['RelacionEscuelaCarrera']['id']];
																		break;
																	endif;
																	
																endforeach;
																
																	if($escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']] == 0):
																		$res = 0;
																	else:
																		$res = number_format(($totalImprimir * 100) / $escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']], 2, '.', '');
																	endif;
																
																$tabla.='<tr><td style="padding-left: 30px;">'.$carreraImprimir.' '.$res.'% - ('.$totalImprimir.')</td></tr>';
															endif;
														endforeach;
												endforeach;	
											echo $tabla;
												
											
											//Imprimir Facultades 
												echo '<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Facultades / Programas</strong></P></center></th></tr>';	
												
												$tabla='';
												foreach ($facultadesId as $facultadId):	
													
													if($facultadPostgrado[$facultadId['FacultadPosgrado']['id']] == 0):
														$tabla.='<tr><td><span class="glyphicon glyphicon-play"></span>' .$facultadId['FacultadPosgrado']['facultad_posgrado'].' 0.0 % - ('.$facultadPostgrado[$facultadId['FacultadPosgrado']['id']].')</td>';
													else:
														$tabla.='<tr><td><span class="glyphicon glyphicon-play"></span>'.$facultadId['FacultadPosgrado']['facultad_posgrado'].' '.number_format(($facultadPostgrado[$facultadId['FacultadPosgrado']['id']] * 100) / count($notificaciones), 2, '.', '').' % - ('.$facultadPostgrado[$facultadId['FacultadPosgrado']['id']].')</td>';
													endif;
													
														foreach($relacionFacultadProgramas as $relacionF):
															if($relacionF['RelacionFacultadProgramas']['facultad_posgrado_id'] == $facultadId['FacultadPosgrado']['id']):
																
																foreach($facultadesComplete as $programa):
																	
																	if($programa['PosgradoProgram']['posgrado_program_id'] == $relacionF['RelacionFacultadProgramas']['posgrado_program_id']):
																		$facultadImprimir = $programa['PosgradoProgram']['posgrado_program'];
																		$totalImprimir = $relFacPro[$relacionF['RelacionFacultadProgramas']['id']];
																		break;
																	endif;
																	
																endforeach;
																
																	if($facultadPostgrado[$facultadId['FacultadPosgrado']['id']] == 0):
																		$res = '0.0';
																	else:
																		$res = number_format(($totalImprimir * 100) / $facultadPostgrado[$facultadId['FacultadPosgrado']['id']], 2, '.', '');
																	endif;
																
																$tabla.='<tr><td style="padding-left: 30px;">'.$facultadImprimir.' '.$res.'% - ('.$totalImprimir.')</td></tr>';
															endif;
														endforeach;
												endforeach;	
												echo $tabla;
											?>
					
					
									</tbody>
								</table>
							</div>
						  </div>
						</div>
					  </div>
	  
					<div class="panel-group">
						<div class="panel panel-default">
						  <div class="panel-heading">
							<h4 class="panel-title">
							  <a class="intoCollaps" data-toggle="collapse" href="#formacionContratacionId">Contratación Universitario Formación</a>
							</h4>
						  </div>
						  <div id="formacionContratacionId" class="panel-collapse collapse">
							<div class="panel-body">	

								<table class="table">
								<tbody>

											<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Contratación Universitario Formación</strong></P></center></th></tr>
											<tr><th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Nivel academico</strong></P></th></tr>
											
											<?php
											
											// Nivel academico
											
											$cont = 1;
											foreach($NivelesAcademicos as $niveles):
												$nivel[$cont] = 0;
												$cont++;
											endforeach;		

												
											foreach($notificaciones as $notificacion):
												if (($notificacion['StudentNotification']['step_process'] == 3) AND ($notificacion['StudentNotification']['type_respons_company'] == 4)):

														$cont = 1;
														foreach($NivelesAcademicos as $niveles):
															if($notificacion['Student']['academic_level_id'] == $cont):
																$nivel[$cont]++;
															endif;
															$cont++;
														endforeach;
												endif;
											endforeach;

											$tabla = '';
											$cont = 1;
											
											foreach($NivelesAcademicos as $niveles):
												if($nivel[$cont] == 0):
													$tabla.='<tr><td>'.$niveles.' 0.0 % - ('.$nivel[$cont].')</td></tr>';
												else:
													$tabla.='<tr><td>'.$niveles.' '.number_format(($nivel[$cont] * 100) / count($notificaciones), 2, '.', '').'% - ('.$nivel[$cont].')</td></tr>';
												endif;
											$cont++;
											endforeach;
											echo $tabla;
											?>
											
											<tr>
												<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Situación Académica</strong></P></th>
											</tr>
											
											<?php
											
											//Situacion Académica
											
											$cont = 1;
											foreach($SituacionesAcademicas as $academic):
												$situacion[$cont] = 0;
												$cont++;
											endforeach;		

												
											foreach($notificaciones as $notificacion):
												if (($notificacion['StudentNotification']['step_process'] == 3) AND ($notificacion['StudentNotification']['type_respons_company'] == 4)):

														$cont = 1;
														foreach($SituacionesAcademicas as $academic):
															if($notificacion['Student']['academic_situation_id'] == $cont):
																$situacion[$cont]++;
															endif;
															$cont++;
														endforeach;
												endif;
											endforeach;

											$tabla = '';
											$cont = 1;
											
											foreach($SituacionesAcademicas as $academic):
												if($situacion[$cont] == 0):
													$tabla.='<tr><td>'.$academic.' 0.0 % - ('.$situacion[$cont].')</td></tr>';
												else:
													$tabla.='<tr><td>'.$academic.' '.number_format(($situacion[$cont] * 100) / count($notificaciones), 2, '.', '').'% - ('.$situacion[$cont].')</td></tr>';
												endif;
											$cont++;
											endforeach;
											echo $tabla;
											?>
											
											<tr>
												<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Tipos de discapacidad</strong></P></th>
											</tr>
											
											<?php
											
											//Tipos de discapacidad
											
											$cont = 1;
											foreach($TiposDiscapacidad as $tipos):
												$discapacidad[$cont] = 0;
												$cont++;
											endforeach;		

												
											foreach($notificaciones as $notificacion):
												if (($notificacion['StudentNotification']['step_process'] == 3) AND ($notificacion['StudentNotification']['type_respons_company'] == 4)):

														$cont = 1;
														foreach($TiposDiscapacidad as $tipos):
															if($notificacion['Student']['academic_level_id'] == $cont):
																$discapacidad[$cont]++;
															endif;
															$cont++;
														endforeach;
												endif;
											endforeach;

											$tabla = '';
											$cont = 1;
											
											foreach($TiposDiscapacidad as $tipos):
												if($discapacidad[$cont] == 0):
													$tabla.='<tr><td>'.$tipos.' 0.0 % - ('.$discapacidad[$cont].')</td></tr>';
												else:
													$tabla.='<tr><td>'.$tipos.' '.number_format(($discapacidad[$cont] * 100) / count($notificaciones), 2, '.', '').'% - ('.$discapacidad[$cont].')</td></tr>';
												endif;
											$cont++;
											endforeach;
											echo $tabla;
											?>
											
											
									</tbody>
								</table>
							</div>
						  </div>
						</div>
					  </div>
						   
					<div class="panel-group">
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a class="intoCollaps" data-toggle="collapse" href="#experienciaContratacionId">Contratación Universitario Experiencia</a>
									</h4>
								  </div>
								  <div id="experienciaContratacionId" class="panel-collapse collapse">
									<div class="panel-body">	

										<table class="table">
										<tbody>
							  
							  
										<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Contratación Universitario Experiencia</strong></P></center></th></tr>
										<tr><th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Experiencia profesional</strong></P></th></tr>
							
							<?php
							
							//Experiencia profecional 
							
									
							$si = 0;
							$no = 0;
								
							foreach($notificaciones as $notificacion):
								if (($notificacion['StudentNotification']['step_process'] == 3) AND ($notificacion['StudentNotification']['type_respons_company'] == 4)):

											foreach($notificacion['Student']['StudentProfessionalExperience'] as $experiencia):
												if(empty($experiencia['contract_type'])):
													$no++;
												else:
													$si++;
												endif;
											endforeach;
								endif;
							endforeach;

								$tabla = '';
									if($si == 0):
										$tabla.='<tr><td>Si 0.0 % - ('.$si.')</td></tr>';
									else:
										$tabla.='<tr><td>Si '.number_format(($si * 100) / count($notificaciones), 2, '.', '').'% - ('.$si.')</td></tr>';
									endif;
									
									if($no == 0):
										$tabla.='<tr><td>No 0.0 % - ('.$no.')</td></tr>';
									else:
										$tabla.='<tr><td>No '.number_format(($no * 100) / count($notificaciones), 2, '.', '').'% - ('.$no.')</td></tr>';
									endif;
							echo $tabla;
							?>
							
							
											</tbody>
										</table>
									</div>
								  </div>
								</div>
							  </div>
			
					<div class="panel-group">
							<div class="panel panel-default">
							  <div class="panel-heading">
								<h4 class="panel-title">
								  <a class="intoCollaps" data-toggle="collapse" href="#ContrataciónUniversitarioExperienciaId">Contratación Universitarios Externos</a>
								</h4>
							  </div>
							  <div id="ContrataciónUniversitarioExperienciaId" class="panel-collapse collapse">
								<div class="panel-body">	

									<table class="table">
									<tbody>
						
										<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Contratación Universitarios Externos</strong></P></center></th></tr>
										<tr>
											<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Contratados externos</strong></P></th>
										</tr>
											
										<tr><td>Contratados externos <?php echo($contratacionesExternas)?></td></tr>
									
										<tr>
											<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Giros</strong></P></th>
										</tr>
										
										<?php
										
										//Giros
										
										$cont = 1;
										foreach($Giros as $giro):
											$giroCont[$cont] = 0;
											$cont++;
										endforeach;		

											
										foreach($notificaciones as $notificacion):
											if (($notificacion['StudentNotification']['step_process'] == 3) AND ($notificacion['StudentNotification']['type_respons_company'] == 4)):

													$cont = 1;
													foreach($Giros as $giro):
														if($notificacion['CompanyJobProfile']['rotation']== $cont):
															$giroCont[$cont]++;
														endif;
														$cont++;
													endforeach;
											endif;
										endforeach;

										$tabla = '';
										$cont = 1;
										
										foreach($Giros as $giro):
											if($giroCont[$cont] == 0):
												$tabla.='<tr><td>'.$giro.' 0.0 % - ('.$giroCont[$cont].')</td></tr>';
											else:
												$tabla.='<tr><td>'.$giro.' '.number_format(($giroCont[$cont] * 100) / count($notificaciones), 2, '.', '').'% - ('.$giroCont[$cont].')</td></tr>';
											endif;
										$cont++;
										endforeach;
										echo $tabla;
										?>
										
										<tr>
											<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Sectores</strong></P></th>
										</tr>
										
										<?php
										
										//Sectores
										
										$cont = 1;
										foreach($Sectores as $sector):
											$sectorCont[$cont] = 0;
											$cont++;
										endforeach;		

											
										foreach($notificaciones as $notificacion):
											if (($notificacion['StudentNotification']['step_process'] == 3) AND ($notificacion['StudentNotification']['type_respons_company'] == 4)):

													$cont = 1;
													foreach($Sectores as $sector):
														if($notificacion['CompanyJobProfile']['Company']['CompanyProfile']['sector']== $cont):
															$sectorCont[$cont]++;
														endif;
														$cont++;
													endforeach;
											endif;
										endforeach;

										$cont = 1;
										
										foreach($Sectores as $sector):
											if($sectorCont[$cont] == 0):
												echo '<tr><td>'.$sector.' 0.0 % - ('.$sectorCont[$cont].')</td></tr>';
											else:
												echo '<tr><td>'.$sector.' '.number_format(($sectorCont[$cont] * 100) / count($notificaciones), 2, '.', '').'% - ('.$sectorCont[$cont].')</td></tr>';
											endif;
										$cont++;
										endforeach;

										?>
										

										</tbody>
									</table>
								</div>
							  </div>
							</div>
						  </div>
	  
					 <div class="panel-group">
						<div class="panel panel-default">
						  <div class="panel-heading">
							<h4 class="panel-title">
							  <a class="intoCollaps" data-toggle="collapse" href="#ContrataciónEmpresaInstitucionId">Contratación por Empresa e Institución</a>
							</h4>
						  </div>
						  <div id="ContrataciónEmpresaInstitucionId" class="panel-collapse collapse">
							<div class="panel-body">	

								<table class="table">
								<tbody>
					
									<!--TOTAL POR EMPRESAS EN EL UNIVERSO DE UNIVERSITARIOS CONTRATADOS-->
									

									<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Contratación por Empresa e Institución</strong></P></center></th></tr>
									<tr><th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Por Empresa / universitario</strong></P></th></tr>
									
									<?php
									
									foreach($contrataciones as $contratacion):
										if (($contratacion['Report']['registered_by'] == 'company') AND ($contratacion['Report']['response_notification'] == 1)):
											$totalEmpresas[$contratacion['Company']['id']] = 0;
											$indices[$contratacion['Company']['id']]=$contratacion['Company']['id'];
											$nombreEmpresas[$contratacion['Company']['id']] = $contratacion['Company']['CompanyProfile']['company_name'];
										endif;
									endforeach;	
									
									$totalContratados = 0;
									foreach($contrataciones as $contratacion):
										if (($contratacion['Report']['registered_by'] == 'company') AND ($contratacion['Report']['response_notification'] == 1)):
											$totalContratados++;
											$totalEmpresas[$contratacion['Company']['id']]++;
										endif;	
									endforeach;
									
									
									$tabla = '';
									if(isset($indices)):
										foreach($indices as $indice):
											if($totalEmpresas[$indice]==0):
												$tabla.='<tr><td>'.$nombreEmpresas[$indice].' 0.0% - ('.$totalEmpresas[$indice].')</td></tr>';
											else:
												$tabla.='<tr><td>'.$nombreEmpresas[$indice].' '.number_format(($totalEmpresas[$indice] * 100) /count($contrataciones), 2, '.', '').'% - ('.$totalEmpresas[$contratacion['Company']['id']].')</td></tr>';
											endif;
										endforeach;	
									else:
										$tabla.='<tr><td>Sin empresas con contrataciones</td></tr>';
									endif;
									echo $tabla;

									 ?>
									
									<tr>
										<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Giros</strong></P></th>
									</tr>

									<?php
									
									//Giros
									
									$cont = 1;
									foreach($Giros as $giro):
										$giroCont[$cont] = 0;
										$cont++;
									endforeach;		

										
									foreach($contrataciones as $contratacion):
										if (($contratacion['Report']['registered_by'] == 'company') AND ($contratacion['Report']['response_notification'] == 1)):

												$cont = 1;
												foreach($Giros as $giro):
													if($contratacion['CompanyJobProfile']['rotation']== $cont):
														$giroCont[$cont]++;
													endif;
													$cont++;
												endforeach;
										endif;
									endforeach;

									$tabla = '';
									$cont = 1;
									
									foreach($Giros as $giro):
									if($giroCont[$cont] == 0):
										$tabla.='<tr><td>'.$giro.' 0.0 % - ('.$giroCont[$cont].')</td></tr>';
									else:
										$tabla.='<tr><td>'.$giro.' '.number_format(($giroCont[$cont] * 100) / $totalContratados, 2, '.', '').'% - ('.$giroCont[$cont].')</td></tr>';
									endif;
									$cont++;
									endforeach;
									echo $tabla;
									?>
									
									<tr>
										<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Sectores</strong></P></th>
									</tr>
									
									<?php								
									//Sectores
									$cont = 1;
									foreach($Sectores as $sector):
										$sectorCont[$cont] = 0;
										$cont++;
									endforeach;		

										
									foreach($contrataciones as $contratacion):
										if (($contratacion['Report']['registered_by'] == 'company') AND ($contratacion['Report']['response_notification'] == 1)):

												$cont = 1;
												foreach($Sectores as $sector):
													if($contratacion['CompanyJobProfile']['Company']['CompanyProfile']['sector']== $cont):
														$sectorCont[$cont]++;
													endif;
													$cont++;
												endforeach;
										endif;
									endforeach;

									$tabla = '';
									$cont = 1;
									
									foreach($Sectores as $sector):
									if($sectorCont[$cont] == 0):
										$tabla.='<tr><td>'.$sector.' 0.0 % - ('.$sectorCont[$cont].')</td></tr>';
										else:
										$tabla.='<tr><td>'.$sector.' '.number_format(($sectorCont[$cont] * 100) / $totalContratados, 2, '.', '').'% - ('.$sectorCont[$cont].')</td></tr>';
									endif;
									$cont++;
									endforeach;
									echo $tabla;
									?>
									
						
									</tbody>
								</table>
							</div>
						  </div>
						</div>
					  </div>
				
				
					<div class="panel-group">
						<div class="panel panel-default">
						  <div class="panel-heading">
							<h4 class="panel-title">
							  <a class="intoCollaps" data-toggle="collapse" href="#ContratacionOfertaId">Contratación Oferta</a>
							</h4>
						  </div>
						  <div id="ContratacionOfertaId" class="panel-collapse collapse">
							<div class="panel-body">	

								<table class="table">
								<tbody>
									
									<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Contratación Oferta </strong></P></center></th></tr>
									<tr><th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Rango de sueldos</strong></P></th></tr>
									
									<?php
									
									//salarios
									
									$cont = 1;
									foreach($Salarios as $sueldo):
										$salario[$cont] = 0;
										$cont++;
									endforeach;		

									$sinEspecificarSueldo = 0;
									foreach($contrataciones as $contratacion):
										if (($contratacion['Report']['registered_by'] == 'company') AND ($contratacion['Report']['response_notification'] == 1)):
												
												$cont = 1;
												
												foreach($Salarios as $sueldo):
													if(!empty($contratacion['CompanyJobProfile']['CompanyJobContractType'])):
														if($contratacion['CompanyJobProfile']['CompanyJobContractType']['salary'] == $cont):
															$salario[$cont]++;
															break;
														endif;
													else:
														$sinEspecificarSueldo++;
														break;
													endif;
												$cont++;
												endforeach;
										endif;
									endforeach;
										
									$tabla = '';
									$cont = 1;
									
									foreach($Salarios as $sueldo):
										if($salario[$cont] == 0):
											$tabla.='<tr><td>'.$sueldo.' 0.0 % - ('.$salario[$cont].')</td></tr>';
										else:
											$tabla.='<tr><td>'.$sueldo.' '.number_format(($salario[$cont] * 100) / $totalContratados, 2, '.', '').'% - ('.$salario[$cont].')</td></tr>';
										endif;
									$cont++;
									endforeach;
									
									if($sinEspecificarSueldo>0):
										$tabla.='<tr><td>Ofertas sin especificar sueldo '.number_format(($sinEspecificarSueldo * 100) / $totalContratados, 2, '.', '').'% - ('.$sinEspecificarSueldo.')</td></tr>';
									endif;
									
									echo $tabla;
									?>
					
					
									</tbody>
								</table>
							</div>
						  </div>
						</div>
					  </div>
				
					
					<div class="panel-group">
						<div class="panel panel-default">
						  <div class="panel-heading">
							<h4 class="panel-title">
							  <a class="intoCollaps" data-toggle="collapse" href="#ContrataciónOfertaCarrerasId">Contratación Oferta Carreras</a>
							</h4>
						  </div>
						  <div id="ContrataciónOfertaCarrerasId" class="panel-collapse collapse">
							<div class="panel-body">	

								<table class="table">
								<tbody>
								
								<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Contratación Oferta Carreras</strong></P></center></th></tr>
								<tr><th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Carrera / áreas</strong></P></th></tr>
								
								
								<?php
								
										$escuelaLicenciatura = array(); 

										foreach($escuelasId as $escuelaId):
											$escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']] = 0;
										endforeach;
										
										foreach($facultadesId as $facultadId):
											$facultadPostgrado[$facultadId['FacultadPosgrado']['id']] = 0;
										endforeach;
										
										foreach($relacionEscuelaCarrera as $relacion):
											$relEscCar[$relacion['RelacionEscuelaCarrera']['id']] = 0;
										endforeach;
										
										foreach($relacionFacultadProgramas as $relacionF):
											$relFacPro[$relacionF['RelacionFacultadProgramas']['id']] = 0;
										endforeach;

										foreach($facultadesComplete as $programa):
											$totalProgramas[$programa['PosgradoProgram']['id']] = 0;
										endforeach;
										
										foreach($contrataciones as $contratacion):
											
											if (($contratacion['Report']['registered_by'] == 'company') AND ($contratacion['Report']['response_notification'] == 1)):
											
												foreach($contratacion['Student']['StudentProfessionalProfile'] as $escuelaStudent):

													// Solo licenciaturas
													foreach($escuelasId as $escuelaId):	
														if(($escuelaId['FacultadLicenciatura']['id'] == $escuelaStudent['undergraduate_institution']) AND ($escuelaStudent['academic_level_id'] == 1)):

															// Busca si la carrera es impartida en esa escuela
															foreach($carrerasComplete as $carrera):
																if($carrera['Career']['id'] == $escuelaStudent['career_id']):
																	
																	// Compara la escuela y carrera en la tabla de relaciones y la agrega en la misma
																	foreach($relacionEscuelaCarrera as $relacion):
																		if(($relacion['RelacionEscuelaCarrera']['facultad_licenciatura_id']==$escuelaId['FacultadLicenciatura']['id']) AND ($relacion['RelacionEscuelaCarrera']['career_id']==$carrera['Career']['career_id'])):
																			$relEscCar[$relacion['RelacionEscuelaCarrera']['id']]++;
																			$escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']]++;									
																		endif;
																	endforeach;
																	
																endif;
															endforeach;
															
														endif;
													endforeach;	
										
										
										
													// FACULTADES 
													foreach($facultadesId as $facultadId):	
														if(($facultadId['FacultadPosgrado']['id'] == $escuelaStudent['undergraduate_institution']) AND ($escuelaStudent['academic_level_id'] <> 1)):
															
															// Busca si la carrera es impartida en esa facultad
															foreach($facultadesComplete as $programa):
																if($programa['PosgradoProgram']['id'] == $escuelaStudent['posgrado_program_id']):
										
																	// Compara la escuela y carrera en la tabla de relación 
																	// Compara la escuela y carrera en la tabla de relación 
																	foreach($relacionFacultadProgramas as $relacionF):
																		if(($relacionF['RelacionFacultadProgramas']['facultad_posgrado_id']==$facultadId['FacultadPosgrado']['id']) AND ($relacionF['RelacionFacultadProgramas']['posgrado_program_id']==$programa['PosgradoProgram']['posgrado_program_id'])):
																			$relFacPro[$relacionF['RelacionFacultadProgramas']['id']]++;
																			$facultadPostgrado[$facultadId['FacultadPosgrado']['id']]++;
																		endif;
																	endforeach;
																endif;
															endforeach;
															
														endif;
													endforeach;	

												endforeach;
											
											endif;
											
										endforeach;	


										// Impresion de escuelas 
										
										$tabla='';
										foreach ($escuelasId as $escuelaId):
										
												if($escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']] == 0):
													$tabla.='<tr><td><span class="glyphicon glyphicon-play"></span>' .$escuelaId['FacultadLicenciatura']['facultad_licenciatura'].' 0.0 % - ('.$escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']].')</td>';
												else:
													$tabla='<tr><td><span class="glyphicon glyphicon-play"></span>' .$escuelaId['FacultadLicenciatura']['facultad_licenciatura'].' '.number_format(($escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']] * 100) / $totalContratados, 2, '.', '').' % - ('.$escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']].')</td>';
												endif;
												foreach($relacionEscuelaCarrera as $relacion):
													if($relacion['RelacionEscuelaCarrera']['facultad_licenciatura_id'] == $escuelaId['FacultadLicenciatura']['id']):
														
														foreach($carrerasComplete as $carrera):
															
															if($carrera['Career']['career_id'] == $relacion['RelacionEscuelaCarrera']['career_id']):
																$carreraImprimir = $carrera['Career']['career'];
																$totalImprimir = $relEscCar[$relacion['RelacionEscuelaCarrera']['id']];
																break;
															endif;
															
														endforeach;
														
															if($escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']] == 0):
																$res = 0;
															else:
																$res = number_format(($totalImprimir* 100) / $escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']], 2, '.', '');
															endif;
														
														$tabla.='<tr><td style="padding-left: 30px;">'.$carreraImprimir.' '.$res.'% - ('.$totalImprimir.')</td></tr>';
													endif;
												endforeach;
											
										endforeach;	
										
									echo $tabla;
									// Imprimir Facultades 
										// echo '<thead><tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Facultades / Programas</strong></P></center></th></tr></thead>';	
										
										$tabla='';
										foreach ($facultadesId as $facultadId):	
											if($facultadPostgrado[$facultadId['FacultadPosgrado']['id']] == 0):
												$tabla.='<tr><td><span class="glyphicon glyphicon-play"></span>' .$facultadId['FacultadPosgrado']['facultad_posgrado'].' 0.0 % - ('.$facultadPostgrado[$facultadId['FacultadPosgrado']['id']].')</td>';
											else:
											$tabla.='<tr><td><span class="glyphicon glyphicon-play"></span>'.$facultadId['FacultadPosgrado']['facultad_posgrado'].' '.number_format(($facultadPostgrado[$facultadId['FacultadPosgrado']['id']] * 100) / $totalContratados, 2, '.', '').' % - ('.$facultadPostgrado[$facultadId['FacultadPosgrado']['id']].')</td>';
											endif;
												foreach($relacionFacultadProgramas as $relacionF):
													if($relacionF['RelacionFacultadProgramas']['facultad_posgrado_id'] == $facultadId['FacultadPosgrado']['id']):
														
														foreach($facultadesComplete as $programa):
															
															if($programa['PosgradoProgram']['posgrado_program_id'] == $relacionF['RelacionFacultadProgramas']['posgrado_program_id']):
																$facultadImprimir = $programa['PosgradoProgram']['posgrado_program'];
																$totalImprimir = $relFacPro[$relacionF['RelacionFacultadProgramas']['id']];
																break;
															endif;
															
														endforeach;
														
															if($facultadPostgrado[$facultadId['FacultadPosgrado']['id']] == 0):
																$tabla.='<tr><td style="padding-left: 30px;">'.$facultadImprimir.' 0.0% - ('.$totalImprimir.')</td></tr>';
															else:
																$tabla.='<tr><td style="padding-left: 30px;">'.$facultadImprimir.' '.number_format(($totalImprimir * 100) / $facultadPostgrado[$facultadId['FacultadPosgrado']['id']], 2, '.', '').'% - ('.$totalImprimir.')</td></tr>';
															endif;
													endif;
												endforeach;
											
										endforeach;	
										echo $tabla; 
									?>
					
					
					
									</tbody>
								</table>
							</div>
						  </div>
						</div>
					  </div>
				
					
					<div class="panel-group">
						<div class="panel panel-default">
						  <div class="panel-heading">
							<h4 class="panel-title">
							  <a class="intoCollaps" data-toggle="collapse" href="#ContrataciónOfertaPerfilId">Contratación Oferta Perfil</a>
							</h4>
						  </div>
						  <div id="ContrataciónOfertaPerfilId" class="panel-collapse collapse">
							<div class="panel-body">	

								<table class="table">
								<tbody>
								
								<tr><th><center><P style="color: #000; background-color: #efeeee"><strong>Contratación Oferta Perfil</strong></P></center></th></tr>
								<tr><th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Nivel Academico</strong></P></th></tr>
								
								<?php
								
								//nivel academico 
								
								$cont = 1;
								foreach($NivelesAcademicos as $niveles):
									$nivel[$cont] = 0;
									$cont++;
								endforeach;		

									
								foreach($contrataciones as $contratacion):
									if (($contratacion['Report']['registered_by'] == 'company') AND ($contratacion['Report']['response_notification'] == 1)):

											$cont = 1;
											foreach($NivelesAcademicos as $niveles):
												if($contratacion['Student']['academic_level_id'] == $cont):
													$nivel[$cont]++;
												endif;
												$cont++;
											endforeach;
									endif;
								endforeach;

								$tabla = '';
								$cont = 1;
								
								foreach($NivelesAcademicos as $niveles):
								if($nivel[$cont] == 0):
									$tabla.='<tr><td>'.$niveles.' 0.0 % - ('.$nivel[$cont].')</td></tr>';
								else:
									$tabla.='<tr><td>'.$niveles.' '.number_format(($nivel[$cont] * 100) / $totalContratados, 2, '.', '').'% - ('.$nivel[$cont].')</td></tr>';
								endif;
								$cont++;
								endforeach;
								echo $tabla;
								?>
								
								<tr>
									<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Situación Académica</strong></P></th>
								</tr>
								
								<?php
								
								//Situacion Académica
								
								$cont = 1;
								foreach($SituacionesAcademicas as $academic):
									$situacion[$cont] = 0;
									$cont++;
								endforeach;		

									
								foreach($contrataciones as $contratacion):
									if (($contratacion['Report']['registered_by'] == 'company') AND ($contratacion['Report']['response_notification'] == 1)):

											$cont = 1;
											foreach($SituacionesAcademicas as $academic):
												if($contratacion['Student']['academic_situation_id'] == $cont):
													$situacion[$cont]++;
												endif;
												$cont++;
											endforeach;
									endif;
								endforeach;

								$tabla = '';
								$cont = 1;
								
								foreach($SituacionesAcademicas as $academic):
									if($situacion[$cont] == 0):
										$tabla.='<tr><td>'.$academic.' 0.0 % - ('.$situacion[$cont].')</td></tr>';
									else:
										$tabla.='<tr><td>'.$academic.' '.number_format(($situacion[$cont] * 100) / $totalContratados, 2, '.', '').'% - ('.$situacion[$cont].')</td></tr>';
									endif;
								$cont++;
								endforeach;
								echo $tabla;
								?>
								
								<tr>
									<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Tipos de discapacidad</strong></P></th>
								</tr>
								
								<?php
								
								//Tipos de discapacidad
								
								$cont = 1;
								foreach($TiposDiscapacidad as $tipos):
									$discapacidad[$cont] = 0;
									$cont++;
								endforeach;		

									
								foreach($contrataciones as $contratacion):
									if (($contratacion['Report']['registered_by'] == 'company') AND ($contratacion['Report']['response_notification'] == 1)):

											$cont = 1;
											foreach($TiposDiscapacidad as $tipos):
												if($contratacion['Student']['academic_level_id'] == $cont):
													$discapacidad[$cont]++;
												endif;
												$cont++;
											endforeach;
									endif;
								endforeach;

								$tabla = '';
								$cont = 1;
								foreach($TiposDiscapacidad as $tipos):
									if($discapacidad[$cont] == 0):
										$tabla.='<tr><td>'.$tipos.' 0.0 % - ('.$discapacidad[$cont].')</td></tr>';
									else:
										$tabla.='<tr><td>'.$tipos.' '.number_format(($discapacidad[$cont] * 100) / $totalContratados, 2, '.', '').'% - ('.$discapacidad[$cont].')</td></tr>';
									endif;
								$cont++;
								endforeach;
								echo $tabla;
								?>
								
								
								<tr>
									<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #efeeee;"><strong>Experiencia profesional</strong></P></th>
								</tr>
								
								<?php
								
								// Experiencia profecional 
									
								$si = 0;
								$no = 0;
									
								foreach($contrataciones as $contratacion):
									if (($contratacion['Report']['registered_by'] == 'company') AND ($contratacion['Report']['response_notification'] == 1)):

												foreach($contratacion['Student']['StudentProfessionalExperience'] as $experiencia):
													if(empty($experiencia['contract_type'])):
														$no++;
													else:
														$si++;
													endif;
												endforeach;
									endif;
								endforeach;
								
								$tabla = '';
									if($si == 0):
										$tabla.='<tr><td>Si 0.0 % - ('.$si.')</td></tr>';
									else:
										$tabla.='<tr><td>Si '.number_format(($si * 100) / $totalContratados, 2, '.', '').'% - ('.$si.')</td></tr>';
									endif;
									
									if($no == 0):
										$tabla.='<tr><td>No 0.0 % - ('.$no.')</td></tr>';
									else:
										$tabla.='<tr><td>No '.number_format(($no * 100) / $totalContratados, 2, '.', '').'% - ('.$no.')</td></tr>';
									endif;

								echo $tabla;
								?>
								
								
									</tbody>
								</table>
							</div>
						  </div>
						</div>
					  </div>
	  
				</div>
			</div>
	
			
			<?php
			endif;
			?>
			
		</div>
	</div>
			
	</div>


<?php endif; ?>
