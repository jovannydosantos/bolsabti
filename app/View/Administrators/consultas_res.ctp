<?php 
	$this->layout = 'administrator'; 
	ini_set('memory_limit', '512M');
	ini_set('max_execution_time', 180);
?>
	<script>
		$(document).ready(function() {
			desabilityconfidencial();
			
			$("#AdministratorFechaInicioEmpresasYear").css("width", "65px");
			$("#AdministratorFechaInicioEmpresasMonth").css("width", "90px");
			$("#AdministratorFechaInicioEmpresasDay").css("width", "60px");
			$("#AdministratorFechaFinEmpresasYear").css("width", "65px");
			$("#AdministratorFechaFinEmpresasMonth").css("width", "90px");
			$("#AdministratorFechaFinEmpresasDay").css("width", "60px");
			
			$("#AdministratorFechaInicioUniversitariosYear").css("width", "65px");
			$("#AdministratorFechaInicioUniversitariosMonth").css("width", "90px");
			$("#AdministratorFechaInicioUniversitariosDay").css("width", "60px");
			$("#AdministratorFechaFinUniversitariosYear").css("width", "65px");
			$("#AdministratorFechaFinUniversitariosMonth").css("width", "90px");
			$("#AdministratorFechaFinUniversitariosDay").css("width", "60px");
			
			$("#AdministratorFechaInicioContratacionesYear").css("width", "65px");
			$("#AdministratorFechaInicioContratacionesMonth").css("width", "90px");
			$("#AdministratorFechaInicioContratacionesDay").css("width", "60px");
			$("#AdministratorFechaFinContratacionesYear").css("width", "65px");
			$("#AdministratorFechaFinContratacionesMonth").css("width", "90px");
			$("#AdministratorFechaFinContratacionesDay").css("width", "60px");
			
			$("#AdministratorFechaInicioCompetenciasYear").css("width", "65px");
			$("#AdministratorFechaInicioCompetenciasMonth").css("width", "90px");
			$("#AdministratorFechaInicioCompetenciasDay").css("width", "60px");
			$("#AdministratorFechaFinCompetenciasYear").css("width", "65px");
			$("#AdministratorFechaFinCompetenciasMonth").css("width", "90px");
			$("#AdministratorFechaFinCompetenciasDay").css("width", "60px");
			
			//universitarios
			
			<?php if(!empty($this->request->data['Administrator']['fecha_inicio_universitarios']) and ($this->request->data['Administrator']['fecha_inicio_universitarios']<>'') and ($this->request->data['Administrator']['fecha_inicio_universitarios'] <> '0000-00-00')): ?>
				 $('#AdministratorFechaInicioUniversitariosYear').prepend('<option value="" >AAAA</option>');
				 $('#AdministratorFechaInicioUniversitariosMonth').prepend('<option value="">MM</option>');
				 $('#AdministratorFechaInicioUniversitariosDay').prepend('<option value="">DD</option>');
				
				 $('#AdministratorFechaFinUniversitariosYear').prepend('<option value="" >AAAA</option>');
				 $('#AdministratorFechaFinUniversitariosMonth').prepend('<option value="" >MM</option>');
				 $('#AdministratorFechaFinUniversitariosDay').prepend('<option value="" >DD</option>');
			 <?php else: ?>
			 
				 $('#AdministratorFechaInicioUniversitariosYear').prepend('<option value="" selected>AAAA</option>');
				 $('#AdministratorFechaInicioUniversitariosMonth').prepend('<option value="" selected>MM</option>');
				 $('#AdministratorFechaInicioUniversitariosDay').prepend('<option value="" selected>DD</option>');
				 
				 $('#AdministratorFechaFinUniversitariosYear').prepend('<option value="" selected>AAAA</option>');
				 $('#AdministratorFechaFinUniversitariosMonth').prepend('<option value="" selected>MM</option>');
				 $('#AdministratorFechaFinUniversitariosDay').prepend('<option value="" selected>DD</option>');
			 <?php endif; ?>
			 
			 //Empresas
			
			<?php if(!empty($this->request->data['Administrator']['fecha_inicio_empresas']) and ($this->request->data['Administrator']['fecha_inicio_empresas']<>'') and ($this->request->data['Administrator']['fecha_inicio_empresas'] <> '0000-00-00')): ?>
				 $('#AdministratorFechaInicioEmpresasYear').prepend('<option value="" >AAAA</option>');
				 $('#AdministratorFechaInicioEmpresasMonth').prepend('<option value="">MM</option>');
				 $('#AdministratorFechaInicioEmpresasDay').prepend('<option value="">DD</option>');
				
				 $('#AdministratorFechaFinEmpresasYear').prepend('<option value="" >AAAA</option>');
				 $('#AdministratorFechaFinEmpresasMonth').prepend('<option value="" >MM</option>');
				 $('#AdministratorFechaFinEmpresasDay').prepend('<option value="" >DD</option>');
			 <?php else: ?>
			 
				 $('#AdministratorFechaInicioEmpresasYear').prepend('<option value="" selected>AAAA</option>');
				 $('#AdministratorFechaInicioEmpresasMonth').prepend('<option value="" selected>MM</option>');
				 $('#AdministratorFechaInicioEmpresasDay').prepend('<option value="" selected>DD</option>');
				 
				 $('#AdministratorFechaFinEmpresasYear').prepend('<option value="" selected>AAAA</option>');
				 $('#AdministratorFechaFinEmpresasMonth').prepend('<option value="" selected>MM</option>');
				 $('#AdministratorFechaFinEmpresasDay').prepend('<option value="" selected>DD</option>');
			 <?php endif; ?>
			
			 //Contrataciones y seguimientos
			
			<?php if(!empty($this->request->data['Administrator']['fecha_inicio_contrataciones']) and ($this->request->data['Administrator']['fecha_inicio_contrataciones']<>'') and ($this->request->data['Administrator']['fecha_inicio_contrataciones'] <> '0000-00-00')): ?>
				 $('#AdministratorFechaInicioContratacionesYear').prepend('<option value="" >AAAA</option>');
				 $('#AdministratorFechaInicioContratacionesMonth').prepend('<option value="">MM</option>');
				 $('#AdministratorFechaInicioContratacionesDay').prepend('<option value="">DD</option>');
				
				 $('#AdministratorFechaFinContratacionesYear').prepend('<option value="" >AAAA</option>');
				 $('#AdministratorFechaFinContratacionesMonth').prepend('<option value="" >MM</option>');
				 $('#AdministratorFechaFinContratacionesDay').prepend('<option value="" >DD</option>');
			 <?php else: ?>
			 
				 $('#AdministratorFechaInicioContratacionesYear').prepend('<option value="" selected>AAAA</option>');
				 $('#AdministratorFechaInicioContratacionesMonth').prepend('<option value="" selected>MM</option>');
				 $('#AdministratorFechaInicioContratacionesDay').prepend('<option value="" selected>DD</option>');
				 
				 $('#AdministratorFechaFinContratacionesYear').prepend('<option value="" selected>AAAA</option>');
				 $('#AdministratorFechaFinContratacionesMonth').prepend('<option value="" selected>MM</option>');
				 $('#AdministratorFechaFinContratacionesDay').prepend('<option value="" selected>DD</option>');
			 <?php endif; ?>
			 
			 //Competencias
			
			<?php if(!empty($this->request->data['Administrator']['fecha_inicio_contrataciones']) and ($this->request->data['Administrator']['fecha_inicio_contrataciones']<>'') and ($this->request->data['Administrator']['fecha_inicio_contrataciones'] <> '0000-00-00')): ?>
				 $('#AdministratorFechaInicioCompetenciasYear').prepend('<option value="" >AAAA</option>');
				 $('#AdministratorFechaInicioCompetenciasMonth').prepend('<option value="">MM</option>');
				 $('#AdministratorFechaInicioCompetenciasDay').prepend('<option value="">DD</option>');
				
				 $('#AdministratorFechaFinCompetenciasYear').prepend('<option value="" >AAAA</option>');
				 $('#AdministratorFechaFinCompetenciasMonth').prepend('<option value="" >MM</option>');
				 $('#AdministratorFechaFinCompetenciasDay').prepend('<option value="" >DD</option>');
			 <?php else: ?>
			 
				 $('#AdministratorFechaInicioCompetenciasYear').prepend('<option value="" selected>AAAA</option>');
				 $('#AdministratorFechaInicioCompetenciasMonth').prepend('<option value="" selected>MM</option>');
				 $('#AdministratorFechaInicioCompetenciasDay').prepend('<option value="" selected>DD</option>');
				 
				 $('#AdministratorFechaFinCompetenciasYear').prepend('<option value="" selected>AAAA</option>');
				 $('#AdministratorFechaFinCompetenciasMonth').prepend('<option value="" selected>MM</option>');
				 $('#AdministratorFechaFinCompetenciasDay').prepend('<option value="" selected>DD</option>');
			 <?php endif; ?>
		}); 
		
		function desabilityconfidencial(){ 		
			if($("#AdministratorOptionSelect option:selected").index() == 1) {  
				$("#contenedorUniversitariosId").show();	
				$("#contenedorContratacionesId").hide();
				$("#contenedorCompetenciasId").hide();
				$("#contenedorEmpresasId").hide();
			} else if($("#AdministratorOptionSelect option:selected").index() == 2) {  
				$("#contenedorUniversitariosId").hide();
				$("#contenedorContratacionesId").hide();
				$("#contenedorCompetenciasId").hide();				
				$("#contenedorEmpresasId").show();
			} else if($("#AdministratorOptionSelect option:selected").index() == 3) {  
				$("#contenedorUniversitariosId").hide();
				$("#contenedorContratacionesId").show();
				$("#contenedorCompetenciasId").hide();
				$("#contenedorEmpresasId").hide();
			}else if($("#AdministratorOptionSelect option:selected").index() == 4) {  
				$("#contenedorUniversitariosId").hide();
				$("#contenedorContratacionesId").hide();
				$("#contenedorCompetenciasId").show();
				$("#contenedorEmpresasId").hide();
			}else{
				$("#contenedorUniversitariosId").hide();	
				$("#contenedorEmpresasId").hide();
				$("#contenedorCompetenciasId").hide();
				$("#contenedorContratacionesId").hide();
				}
		}
		
		function negativo(){
			return false;
		}
		
		function validateDates(tipoFormulario){
			
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
				
				var selecciones = $('#AdministratorFrecuenciasUniversitarios > option:selected');
				
				
				
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
				
				var selecciones = $('#AdministratorFrecuenciasEmpresas > option:selected');
				
			}else 
				if(tipoFormulario==3){
				
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
				var selecciones = 1;
				
			}else 
				if(tipoFormulario==4){
				
				
				vigenciaFecha1 = 1;
				vigenciaFecha2 = 1;
				resultadoComparativa = 0;
				var selecciones = 1;
			}
			
			
			if(tipoFormulario!=4){
				vigenciaFecha1 = validarFecha(fecha1);
				vigenciaFecha2 = validarFecha(fecha2);
				
				// dd/mm/yyyy
				valida1 = day1+'/'+month1+'/'+year1;
				valida2 = day2+'/'+month2+'/'+year2;
				resultadoComparativa=validate_fechaMayorQue(valida1,valida2);
			}
			
				if((year1 == '') || (month1 == '') || (day1 == '') || (year2 == '') || (month2 == '') || (day2 == '')){
					jAlert('Seleccione las fechas completas para la búsqueda de coincidencias', 'Mensaje');
					return false;
				} else if(vigenciaFecha1 == false){
					jAlert('La fecha inicio de reporte es incorrecta', 'Mensaje');
					return false;
				} else if(vigenciaFecha2 == false){
					jAlert('La fecha fin de reporte es incorrecta', 'Mensaje');
					return false;
				} else if(resultadoComparativa==1){
					jAlert('La fecha inicio de reporte debe ser menor a la final', 'Mensaje');
					return false;
				}else if(selecciones.length == 0){
					jAlert('Selecione los rubros que desea consultar', 'Mensaje');
					return false;
				}else{
					return true;
				}
		}
		
		function validarFecha(fecha){
				 //valida fecha en formato aaaa-mm-dd
				 var fechaArr = fecha.split('/');
				 var aho = fechaArr[2];
				 var mes = fechaArr[1];
				 var dia = fechaArr[0];
				 
				 var plantilla = new Date(aho, mes - 1, dia);//mes empieza de cero Enero = 0

				 if(!plantilla || plantilla.getFullYear() == aho && plantilla.getMonth() == mes -1 && plantilla.getDate() == dia){
				 return true;
				 }else{
				 return false;
				 }
		}
		
		function validate_fechaMayorQue(fechaInicial,fechaFinal){
			
			valuesStart=fechaInicial.split("/");
            valuesEnd=fechaFinal.split("/");
			
            // Verificamos que la fecha no sea posterior a la actual

            var dateStart=new Date(valuesStart[2],(valuesStart[1]-1),valuesStart[0]);
            var dateEnd=new Date(valuesEnd[2],(valuesEnd[1]-1),valuesEnd[0]);

            if(dateStart>dateEnd)
            {
                return 1;
            }
            return 0;
        }
		
		
		
		
	</script>
	<style>
		.myStyle{
			font-size: 11px;
		}
	</style>
	<div class="col-md-12" >	

		<?php echo $this->Session->flash(); ?>	
		
		<div class="col-md-10 col-md-offset-2" style="left: -30px;">	<!--contenedor-->
			<div class="col-md-5 col-md-offset-2" style="margin-top: 50px;">	
				<p style="font-size: 18px;">Seleccione el tipo de frecuencia</p>
			</div>
			<div class="col-md-12"  style="padding-left: 0px;">	
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
									'between' => '<div class="col-md-9 ">',
									'after' => '</div></div>',
									'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
								),
								'onsubmit' =>'return negativo();',
								'action' => 'register',
								
				)); ?>
				<fieldset>
				<?php  
					$options = array(1 => 'Universitarios', 2 => 'Empresas', 3 => 'Contrataciones y Seguimientos', 4 => 'Competencias');
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
		</div>
	
		<div class="col-md-11 col-md-offset-2" style="left: -30px; display: none;" id="contenedorUniversitariosId">	
			<div class="col-md-4 col-md-offset-2" >	
				<p style="font-size: 18px; ">Frecuencias Universitarios</p>
			</div>
			
			<div class="col-md-12" style="padding-left: 0px;">
				<?php 
				echo $this->Form->create('Administrator', array(
															'class' => 'form-horizontal', 
															'role' => 'form',
															'inputDefaults' => array(
																	'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																	'div' => array('class' => 'form-group '),
																	'class' => 'form-control',
																	'before' => '<div class="col-md-6 ">',
																	'between' => ' <div class="col-md-9">',
																	'after' => '</div></div>',
																	'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
															),
													
													'onsubmit' =>'return validateDates(1);',
													'action' => 'consultas',
				)); ?>	
				<fieldset>
				<div  class="col-md-4"  style="font-weight: bold;" >
				   <p> Fecha inicio de frecuencia</p>
				</div>
				<div  class="col-md-6" style="font-weight: bold; margin-left: 25px;" >
				   <p>Fecha fin de frecuencia</p>
				</div>
				<div class="col-md-8" style="text-align: center; font-weight: bold; height: 0px; margin-left: 15px; left: -5px;" >
				   <p> a </p>
				</div>
				
				<div class="col-md-5" style="margin-bottom: 20px; padding-left: 0px;">
					
					<?php echo $this->Form->input('fecha_inicio_universitarios', array(
																'type' => 'date',
																'before' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">',
																'between' => '<div class="col-md-12 ">',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '80px',
																'label' => array(
																			'class' => 'col-md-0 col-md-offset-0 control-label',
																			'text' => '',),
																'style' => 'width: 120px;  margin-left: -10px; margin-right: 18px;  padding-left: 0px; padding-right: 0px; font-size: 12px;',
																'div' => array('class' => 'form-inline'),
																'label' => array(
																	'class' => 'col-sm-0 col-md-0 control-label',
																	'text' => '',),
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - 15,
																'maxYear' => date('Y') - 0,
																
																'placeholder' => 'Vigencia que aparecerá en la oferta',
																'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
								));
					?>
				</div>
				
				<div class="col-md-6" style="margin-bottom: 20px;  left: -60px;">
					<?php echo $this->Form->input('fecha_fin_universitarios', array(
																'type' => 'date',
																'before' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">',
																'between' => '<div class="col-md-12 ">',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '80px',
																'label' => array(
																			'class' => 'col-md-0 col-md-offset-0 control-label',
																			'text' => '',),
																'style' => 'width: 120px;  margin-left: -10px; margin-right: 18px;  padding-left: 0px; padding-right: 0px; font-size: 12px;',
																'div' => array('class' => 'form-inline'),
																'label' => array(
																	'class' => 'col-sm-0 col-md-0 control-label',
																	'text' => '',),
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - 15,
																'maxYear' => date('Y') - 0,
																
																'placeholder' => 'Vigencia que aparecerá en la oferta',
																'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
								)); 
					?>
				</div>
				
				<?php  
					$options = array(1 => 'Perfil', 2 => 'Idiomas', 3 => 'Programa de becas', 4 => 'Escuela/Facultad', 5 => 'Carrera/Area', 6 => 'Competencias');
					echo $this->Form->input('frecuencias_universitarios', array(	
															'multiple' => 'multiple',
															'class' => 'selectpicker show-tick form-control show-menu-arrow',
															'title' => 'Selecciona los bloques a consultar de estudiantes',
															'data-selected-text-format' => 'count > 10',
															'data-actions-box' => 'true',
															'type' => 'select',
															'before' => '<div class="col-md-11" style=" "><img data-toggle="tooltip" id="" data-placement="top" title="Opciones de servicios y apoyos que son adicionales al sueldo que son otorgadas al trabajador para hacer más atractiva la oferta." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',			
															'label' => '',
															'options' => $options
							));
				?>
				
				</fieldset>
				<div class="col-md-2 col-md-offset-3">
				<?php 
					echo $this->Form->button('Consultar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>', 
												array(
													'type' => 'submit', 
													'style'=>'width: 115px;',
													'div' => 'form-group',
													'class' => 'btn btnBlue btn-default',
													'escape' => false,
					));
								
					echo $this->Form->end(); 
				?>
				</div>
			</div>	
		</div>
				
		
		<div class="col-md-11 col-md-offset-2" style="left: -30px; display: none;" id="contenedorEmpresasId">	
			<div class="col-md-4 col-md-offset-2" >	
				<p style="font-size: 18px;">Frecuencias Empresas</p>
			</div>
			
			<div class="col-md-12" style="padding-left: 0px;">
			<?php 
				echo $this->Form->create('Administrator', array(
															'class' => 'form-horizontal', 
															'role' => 'form',
															'inputDefaults' => array(
																	'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																	'div' => array('class' => 'form-group '),
																	'class' => 'form-control',
																	'before' => '<div class="col-md-6 ">',
																	'between' => ' <div class="col-md-9">',
																	'after' => '</div></div>',
																	'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
															),
													'action' => 'consultas',
													'onsubmit' =>'return validateDates(2);'
				)); ?>	
				<fieldset>
				<div  class="col-md-4"  style="font-weight: bold;" >
				   <p> Fecha inicio de frecuencia</p>
				</div>
				<div  class="col-md-6" style="font-weight: bold; margin-left: 25px;" >
				   <p>Fecha fin de frecuencia</p>
				</div>
				<div class="col-md-8" style="text-align: center; font-weight: bold; height: 0px; margin-left: 15px; left: -5px;" >
				   <p> a </p>
				</div>
				
				<div class="col-md-5" style="margin-bottom: 20px; padding-left: 0px;">
					
					<?php echo $this->Form->input('fecha_inicio_empresas', array(
																'type' => 'date',
																'before' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">',
																'between' => '<div class="col-md-12 ">',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '80px',
																'label' => array(
																			'class' => 'col-md-0 col-md-offset-0 control-label',
																			'text' => '',),
																'style' => 'width: 120px;  margin-left: -10px; margin-right: 18px;  padding-left: 0px; padding-right: 0px; font-size: 12px;',
																'div' => array('class' => 'form-inline'),
																'label' => array(
																	'class' => 'col-sm-0 col-md-0 control-label',
																	'text' => '',),
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - 15,
																'maxYear' => date('Y') - 0,
																
																'placeholder' => 'Vigencia que aparecerá en la oferta',
																'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
								));
					?>
				</div>
				
				<div class="col-md-6" style="margin-bottom: 20px;  left: -60px;">
					<?php echo $this->Form->input('fecha_fin_empresas', array(
																'type' => 'date',
																'before' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">',
																'between' => '<div class="col-md-12 ">',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '80px',
																'label' => array(
																			'class' => 'col-md-0 col-md-offset-0 control-label',
																			'text' => '',),
																'style' => 'width: 120px;  margin-left: -10px; margin-right: 18px;  padding-left: 0px; padding-right: 0px; font-size: 12px;',
																'div' => array('class' => 'form-inline'),
																'label' => array(
																	'class' => 'col-sm-0 col-md-0 control-label',
																	'text' => '',),
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - 15,
																'maxYear' => date('Y') - 0,
																
																'placeholder' => 'Vigencia que aparecerá en la oferta',
																'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
								)); 
					?>
				</div>
				<?php  
					 $options = array(1 => 'Perfil', 2 => 'Ofertas', 3 => 'Idiomas', 4 => 'Competencias', 5 => 'Vacantes');
					echo $this->Form->input('frecuencias_empresas', array(	
															'multiple' => 'multiple',
															'class' => 'selectpicker show-tick form-control show-menu-arrow',
															'title' => 'Selecciona los bloques a consultar de empres',
															'data-selected-text-format' => 'count > 10',
															'data-actions-box' => 'true',
															'type' => 'select',
															'before' => '<div class="col-md-11" style=" "><img data-toggle="tooltip" id="" data-placement="top" title="Opciones de servicios y apoyos que son adicionales al sueldo que son otorgadas al trabajador para hacer más atractiva la oferta." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',			
															'label' => '',
															'placeholder' => 'Prestaciones y apoyos',
															'options' => $options, 'default'=>'0'
							)); 
				?>
				</fieldset>
				<div class="col-md-2 col-md-offset-3">
				<?php 
					echo $this->Form->button('Consultar &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>', 
												array(
													'type' => 'submit', 
													'style'=>'width: 115px;',
													'div' => 'form-group',
													'class' => 'btn btnBlue btn-default',
													'escape' => false,
					));
								
					echo $this->Form->end(); 
				?>
				</div>
			</div>
		</div>
		
		<div class="col-md-11 col-md-offset-2" style="left: -30px; display: none;" id="contenedorContratacionesId">	
			<div class="col-md-4 col-md-offset-2" >	
				<p style="font-size: 18px;">Frecuencia Contrataciones</p>
			</div>
			
			<div class="col-md-12" style="padding-left: 0px;">
			<?php 
				echo $this->Form->create('Administrator', array(
															'class' => 'form-horizontal', 
															'role' => 'form',
															'inputDefaults' => array(
																	'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																	'div' => array('class' => 'form-group '),
																	'class' => 'form-control',
																	'before' => '<div class="col-md-6 ">',
																	'between' => ' <div class="col-md-9">',
																	'after' => '</div></div>',
																	'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
															),
													'action' => 'consultas',
													'onsubmit' =>'return validateDates(3);'
				)); ?>	
				<fieldset>
				<div  class="col-md-4"  style="font-weight: bold;" >
				   <p> Fecha inicio de frecuencia</p>
				</div>
				<div  class="col-md-6" style="font-weight: bold; margin-left: 25px;" >
				   <p>Fecha fin de frecuencia</p>
				</div>
				<div class="col-md-8" style="text-align: center; font-weight: bold; height: 0px; margin-left: 15px; left: -5px;" >
				   <p> a </p>
				</div>
				
				<div class="col-md-5" style="margin-bottom: 20px; padding-left: 0px;">
					
					<?php echo $this->Form->input('fecha_inicio_contrataciones', array(
																'type' => 'date',
																'before' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">',
																'between' => '<div class="col-md-12 ">',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '80px',
																'label' => array(
																			'class' => 'col-md-0 col-md-offset-0 control-label',
																			'text' => '',),
																'style' => 'width: 120px;  margin-left: -10px; margin-right: 18px;  padding-left: 0px; padding-right: 0px; font-size: 12px;',
																'div' => array('class' => 'form-inline'),
																'label' => array(
																	'class' => 'col-sm-0 col-md-0 control-label',
																	'text' => '',),
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - 15,
																'maxYear' => date('Y') - 0,
																
																'placeholder' => 'Vigencia que aparecerá en la oferta',
																'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
								));
					?>
				</div>
				
				<div class="col-md-6" style="margin-bottom: 20px;  left: -60px;">
					<?php echo $this->Form->input('fecha_fin_contrataciones', array(
																'type' => 'date',
																'before' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">',
																'between' => '<div class="col-md-12 ">',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '80px',
																'label' => array(
																			'class' => 'col-md-0 col-md-offset-0 control-label',
																			'text' => '',),
																'style' => 'width: 120px;  margin-left: -10px; margin-right: 18px;  padding-left: 0px; padding-right: 0px; font-size: 12px;',
																'div' => array('class' => 'form-inline'),
																'label' => array(
																	'class' => 'col-sm-0 col-md-0 control-label',
																	'text' => '',),
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - 15,
																'maxYear' => date('Y') - 0,
																
																'placeholder' => 'Vigencia que aparecerá en la oferta',
																'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
								)); 
					?>
				</div>
				<?php  
					echo $this->Form->input('frecuencias_contrataciones', array(	
															'type' => 'hidden',
															'before' => '<div class="col-md-11" style=" "><img data-toggle="tooltip" id="" data-placement="top" title="Opciones de servicios y apoyos que son adicionales al sueldo que son otorgadas al trabajador para hacer más atractiva la oferta." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',			
															'value' => 1,
															'placeholder' => 'Prestaciones y apoyos',
							)); 
				?>
				</fieldset>
				<div class="col-md-2 col-md-offset-3">
				<?php 
					echo $this->Form->button('Consultar &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>', 
												array(
													'type' => 'submit', 
													'style'=>'width: 115px;',
													'div' => 'form-group',
													'class' => 'btn btnBlue btn-default',
													'escape' => false,
					));
								
					echo $this->Form->end(); 
				?>
				</div>
			</div>
		</div>
		
		<div class="col-md-11 col-md-offset-2" style="left: -30px; display: none;" id="contenedorCompetenciasId">	
			<div class="col-md-4 col-md-offset-2" >	
				<p style="font-size: 18px;">Frecuencia Competencias</p>
			</div>
			
			<div class="col-md-12" style="padding-left: 0px;">
			<?php 
				echo $this->Form->create('Administrator', array(
															'class' => 'form-horizontal', 
															'role' => 'form',
															'inputDefaults' => array(
																	'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																	'div' => array('class' => 'form-group '),
																	'class' => 'form-control',
																	'before' => '<div class="col-md-6 ">',
																	'between' => ' <div class="col-md-9">',
																	'after' => '</div></div>',
																	'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
															),
													'action' => 'consultas',
													'onsubmit' =>'return validateDates(4);'
				)); ?>	
				<fieldset>
				
				
				<?php  
					echo $this->Form->input('frecuencias_competencias', array(	
															'type' => 'hidden',
															'before' => '<div class="col-md-11" style=" "><img data-toggle="tooltip" id="" data-placement="top" title="Opciones de servicios y apoyos que son adicionales al sueldo que son otorgadas al trabajador para hacer más atractiva la oferta." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',			
															'value' => 1,
															'placeholder' => 'Prestaciones y apoyos',
							)); 
				?>
				</fieldset>
				<div class="col-md-2 col-md-offset-3">
				<?php 
					echo $this->Form->button('Consultar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>', 
												array(
													'type' => 'submit', 
													'style'=>'width: 115px; left: -25px;',
													'div' => 'form-group',
													'class' => 'btn btnBlue btn-default',
													'escape' => false,
					));
								
					echo $this->Form->end(); 
				?>
				</div>
			</div>
		</div>
		
	</div>

	<?php // Variables para los collaps
		if(isset($this->request->data['Administrator'])):
			
			//Perfil Universitario
			
				$ShowPerfil = 0;
				$ShowIdiomas = 0;
				$ShowBecas = 0;
				$ShowEscuelas = 0;
				$ShowCarrera = 0;
				$ShowCompetencia = 0;
			if(isset($this->request->data['Administrator']['frecuencias_universitarios'])):
				
				
				foreach($this->request->data['Administrator']['frecuencias_universitarios'] as $peticionVista):
					if($peticionVista==1):
						$ShowPerfil = 1;
					endif;
					if($peticionVista==2):
						$ShowIdiomas = 1;
					endif;
					if($peticionVista==3):
						$ShowBecas = 1;
					endif;
					if($peticionVista==4):
						$ShowEscuelas = 1;
					endif;
					if($peticionVista==5):
						$ShowCarrera = 1;
					endif;
					if($peticionVista==6):
						$ShowCompetencia = 1;
					endif;
				endforeach;
			endif;
			
			//Perfil Empresas
		
				$ShowPerfilEmpresa = 0;
				$ShowOfertasEmpresa = 0;
				$ShowIdiomasEmpresa = 0;
				$ShowCompetenciasEmpresa = 0;
				$ShowVacantesEmpresa = 0;
		
		if(isset($this->request->data['Administrator']['frecuencias_empresas'])):
				
				
				foreach($this->request->data['Administrator']['frecuencias_empresas'] as $peticionVista):
					if($peticionVista==1):
						$ShowPerfilEmpresa = 1;
					endif;
					if($peticionVista==2):
						$ShowOfertasEmpresa = 1;
					endif;
					if($peticionVista==3):
						$ShowIdiomasEmpresa = 1;
					endif;
					if($peticionVista==4):
						$ShowCompetenciasEmpresa = 1;
					endif;
					if($peticionVista==5):
						$ShowVacantesEmpresa = 1;
					endif;
				endforeach;
			endif;
			
		//Contrataciones y seguimiento
		
		$ShowContrataciones = 0;
		
		if(isset($this->request->data['Administrator']['frecuencias_contrataciones'])):		
				$ShowContrataciones = 1;
		endif;
			
		//Competencias	
		
			$ShowCompetenciasComp = 0;
		
		if(isset($this->request->data['Administrator']['frecuencias_competencias'])):		
				$ShowCompetenciasComp = 1;
		endif;

	?>
	
<div class="col-md-12" style="margin-top: 30px;">	
	<div class = "panel-group" id = "accordion">
	   <div class = "panel panel-default">
		  
			<?php
			if($ShowPerfil == 1):
			?>
			<div class = "panel-heading"> <!-- Perfil Universitarios-->
			 <h4 class = "panel-title">
				<a data-toggle = "collapse" data-parent = "#accordion" href = "#collapse1">
				  Perfil universitarios
				</a>
			 </h4>
		  </div>
		  
			<div id = "collapse1" class = "panel-collapse collapse">
			 <div class = "panel-body"> <!-- fin1-->
			 
			   <!-- Inicio de tabla PERFIL UNIVERSITARIO -->
		
				<div class="col-md-12" style="margin-top: 30px;" >
					<table class="table">
						<thead>
						 <center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Perfil Universitarios</strong></P></center> 
						</thead>
						<tbody>
							<tr>
								<td>Total de Registros <?php echo count($estudiantes);?></td>
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
						
						$tabla='';
						$tabla.= '<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Sexos</strong></P></center></th></tr>';
						
						if(count($estudiantes)== 0):
							$tabla.='<tr><td>Femenino 0.0% - ('.$mujeres.')</td></tr>';
							$tabla.='<tr><td>Masculino 0.0% - ('.$hombres.')</td></tr>';
						else:
						
							$porcientoMujeres = ($mujeres * 100) / count($estudiantes);
							$porcientoHombres = ($hombres * 100) / count($estudiantes);	

							$tabla.='<tr><td>Femenino  '.number_format($porcientoMujeres, 2, '.', '').'% - ('.$mujeres.')</td></tr>';
							$tabla.='<tr><td>Masculino '.number_format($porcientoHombres, 2, '.', '').'% - ('.$hombres.')</td></tr>';
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
					
					foreach($estudiantes as $estudiante):
						$porciones = explode("-", $estudiante['StudentProfile']['date_of_birth']);
							
						$dianaz=$porciones[2];
						$mesnaz=$porciones[1];
						$anonaz=$porciones[0];

						if (($mesnaz == $mes) && ($dianaz > $dia)) {
							$ano=($ano-1); 
						}

						if ($mesnaz > $mes) {
							$ano=($ano-1);
						}

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
											if($edad > 40):
												$edad6++;
											endif;
										endif;
									endif;
								endif; 
							endif;
						endif;
				
					endforeach;
					
					$tabla='';
					$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Edad</strong></P></center></th></tr>';
					if(count($estudiantes)== 0):

						$tabla.='<tr><td>Menor a 0.0% - ('.$edad1.')</td></tr>';
						$tabla.='<tr><td>De 19 a 24 0.0% - ('.$edad2.')</td></tr>';
						$tabla.='<tr><td>De 25 a 29 0.0% - ('.$edad3.')</td></tr>'; 
						$tabla.='<tr><td>De 30 a 34 0.0% - ('.$edad4.')</td></tr>';
						$tabla.='<tr><td>De 35 a 39 0.0% - ('.$edad5.')</td></tr>';
						$tabla.='<tr><td>Mayores de 40 0.0% - ('.$edad6.')</td></tr>';
					else:

						$porcientoEdad1 = ($edad1 * 100) / count($estudiantes);
						$porcientoEdad2 = ($edad2 * 100) / count($estudiantes);	
						$porcientoEdad3 = ($edad3 * 100) / count($estudiantes);
						$porcientoEdad4 = ($edad4 * 100) / count($estudiantes);		
						$porcientoEdad5 = ($edad5 * 100) / count($estudiantes);
						$porcientoEdad6 = ($edad6 * 100) / count($estudiantes);	

						$tabla.='<tr><td>Menor a'.number_format($porcientoEdad1, 2, '.', '').'% - ('.$edad1.')</td></tr>';
						$tabla.='<tr><td>De 19 a 24 '.number_format($porcientoEdad2, 2, '.', '').'% - ('.$edad2.')</td></tr>';
						$tabla.='<tr><td>De 25 a 29 '.number_format($porcientoEdad3, 2, '.', '').'% - ('.$edad3.')</td></tr>'; 
						$tabla.='<tr><td>De 30 a 34 '.number_format($porcientoEdad4, 2, '.', '').'% - ('.$edad4.')</td></tr>';
						$tabla.='<tr><td>De 35 a 39 '.number_format($porcientoEdad5, 2, '.', '').'% - ('.$edad5.')</td></tr>';
						$tabla.='<tr><td>Mayores de 40 '.number_format($porcientoEdad6, 2, '.', '').'% - ('.$edad6.')</td></tr>';
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
						
						foreach ($estudiantes as $estudiante):
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
						$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Tipo de discapacidad</strong></P></center></th></tr>';	
						
						if(count($estudiantes) == 0):
						
							$tabla.='<tr><td>Ceguera 0.0% - ('.$ceguera.')</td></tr>';
							$tabla.='<tr><td>Debilidad auditiva 0.0% - ('.$auditiva.')</td></tr>';
							$tabla.='<tr><td>Devilidad visual 0.0% - ('.$visual.')</td></tr>'; 
							$tabla.='<tr><td>Motriz o motora 0.0% - ('.$motora.')</td></tr>';
							$tabla.='<tr><td>Multiples 0.0% - ('.$multiple.')</td></tr>'; 
							$tabla.='<tr><td>Sordera 0.0% - ('.$sordera.')</td></tr>';
							$tabla.='<tr><td>Sin discapacidad 0.0% - ('.$ninguna.')</td></tr>';
						else:
						
							$porcientoCeguera = ($ceguera * 100) / count($estudiantes);
							$porcientoAuditiva = ($auditiva * 100) / count($estudiantes);
							$porcientoVisual = ($visual * 100) / count($estudiantes);
							$porcientoMotora = ($motora * 100) / count($estudiantes);
							$porcientoMultiple = ($multiple * 100) / count($estudiantes);
							$porcientoSordera = ($sordera * 100) / count($estudiantes);
							$porcientoNinguna = ($ninguna * 100) / count($estudiantes);
						
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
						
						$tabla='';
						$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Nivel Academico</strong></P></center></th></tr>';
						
						if(count($estudiantes) == 0):
						
							$tabla.='<tr><td>Licenciatura 0.0% - ('.$licenciatura.')</td></tr>'; 
							$tabla.='<tr><td>Especialidad 0.0% - ('.$especialidad.')</td></tr>';
							$tabla.='<tr><td>Maestria 0.0% - ('.$maestria.')</td></tr>';
							$tabla.='<tr><td>Doctorado 0.0% - ('.$doctorado.')</td></tr>';
							$tabla.='<tr><td>Sin nivel 0.0% - ('.$sinNivel.')</td></tr>';  
						
						else:
						
							$porcientoLicenciatura = ($licenciatura * 100) / count($estudiantes);
							$porcientoEspecialidad = ($especialidad * 100) / count($estudiantes);
							$porcientoMaestria = ($maestria * 100) / count($estudiantes);
							$porcientoDoctorado = ($doctorado * 100) / count($estudiantes);	
							$porcientoSinNivel = ($sinNivel * 100) / count($estudiantes);
						
							$tabla.='<tr><td>Licenciatura '.number_format($porcientoLicenciatura, 2, '.', '').'% - ('.$licenciatura.')</td></tr>'; 
							$tabla.='<tr><td>Especialidad '.number_format($porcientoEspecialidad, 2, '.', '').'% - ('.$especialidad.')</td></tr>';
							$tabla.='<tr><td>Maestria '.number_format($porcientoMaestria, 2, '.', '').'% - ('.$maestria.')</td></tr>';
							$tabla.='<tr><td>Doctorado '.number_format($porcientoDoctorado, 2, '.', '').'% - ('.$doctorado.')</td></tr>';
							$tabla.='<tr><td>Sin nivel '.number_format($porcientoSinNivel, 2, '.', '').'% - ('.$sinNivel.')</td></tr>';  

						endif;
						echo $tabla;
								
					?>

					
		<!-- Situación Academica-->
					
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
						
						$tabla='';
						$tabla.='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Situación Academica</strong></P></center></th>';
						
						if(count($estudiantes) == 0):
						
							$tabla.='<tr><td>Estudiante 0.0% - ('.$alumno.')</td></tr>'; 
							$tabla.='<tr><td>Egresado 0.0% - ('.$egresado.')</td></tr>'; 
							$tabla.='<tr> <td>Titulado 0.0% - ('.$titulado.')</td></tr>'; 
							$tabla.='<tr><td>Con diploma 0.0% - ('.$diploma.')</td></tr>';
							$tabla.='<tr><td>Con Grado 0.0% - ('.$grados.')</td></tr>';
							$tabla.='<tr><td>Sin situación academica 0.0% - ('.$sinSituacion.')</td></tr>'; 
						
						else:
						
							$porcientoAlumno = ($alumno * 100) / count ($estudiantes);
							$porcientoEgresado = ($egresado * 100) / count($estudiantes);
							$porcientoTitulado = ($titulado * 100) / count($estudiantes);
							$porcientoDiploma = ($diploma * 100) / count($estudiantes);			
							$porcientoGrados = ($grados * 100) / count($estudiantes);
							$porcientoSinSituacion = ($sinSituacion * 100) / count($estudiantes);
					
							$tabla.='<tr><td>Estudiante '.number_format($porcientoAlumno, 2, '.', '').'% - ('.$alumno.')</td></tr>'; 
							$tabla.='<tr><td>Egresado '.number_format($porcientoEgresado, 2, '.', '').'% - ('.$egresado.')</td></tr>'; 
							$tabla.='<tr> <td>Titulado '.number_format($porcientoTitulado, 2, '.', '').'% - ('.$titulado.')</td></tr>'; 
							$tabla.='<tr><td>Con diploma '.number_format($porcientoDiploma, 2, '.', '').'% - ('.$diploma.')</td></tr>';
							$tabla.='<tr><td>Con Grado '.number_format($porcientoGrados, 2, '.', '').'% - ('.$grados.')</td></tr>';
							$tabla.='<tr><td>Sin situación academica '.number_format($porcientoSinSituacion, 2, '.', '').'% - ('.$sinSituacion.')</td></tr>'; 
						endif;
						echo $tabla;
					?>
		
					<!-- Movilidad Estudiantil-->
						
					<?php
						$si = 0; 
						$no = 0; 
						
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
						endforeach;
						
						$tabla='';
						$tabla.='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Movilidad Estudiantil</strong></P></center></th>';
						
						if(count($estudiantes)==0):
						
							$tabla.='<tr><td>Si 0.0% - ('.$si.')</td></tr>'; 
							$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';
						
						else:
						
							$porcientoSi = ($si * 100) / count($estudiantes);
							$porcientoNo = ($no * 100) / count($estudiantes);	
							
							$tabla.='<tr><td>Si '.number_format($porcientoSi, 2, '.', '').'% - ('.$si.')</td></tr>'; 
							$tabla.='<tr><td>No '.number_format($porcientoNo, 2, '.', '').'% - ('.$no.')</td></tr>';
							
						endif;
						echo $tabla;
					?>
						

					<!-- Beca durante los estudios -->
						
					<?php
						$sib = 0; 
						$nob = 0; 
						//$total = 0;
						
						foreach($estudiantes as $estudiante):
							foreach($estudiante['StudentProfessionalProfile'] as $beca):
								if($beca['scholarship']== 's'):
								 $sib++;
									else: 
										if($beca['scholarship'] ==  'n'):
									 $nob++; 
								 endif;
							endif;
							//$total++;
							endforeach;			
						endforeach;
						
						$tabla='';
						$tabla.='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Beca durate sus estudios</strong></P></center></th>';
						
						if(count($estudiantes) == 0):
							
							$tabla.='<tr><td>Si 0.0% - ('.$sib.')</td></tr>'; 
							$tabla.='<tr><td>No 0.0% - ('.$nob.')</td></tr>'; 
						
						else:
						
							$porcientoSib = ($sib * 100) / count($estudiantes);
							$porcientoNob = ($nob * 100) / count($estudiantes);	
						
							$tabla.='<tr><td>Si '.number_format($porcientoSib, 2, '.', '').'% - ('.$sib.')</td></tr>'; 
							$tabla.='<tr><td>No '.number_format($porcientoNob, 2, '.', '').'% - ('.$nob.')</td></tr>'; 
						endif;
						echo $tabla;
					?>

					<!-- Certificación en computo-->
						
					<?php
						$sic = 0; 
						$noc = 0;
						
						foreach($estudiantes as $estudiante):
								foreach($estudiante['StudentTechnologicalKnowledge'] as $comp):
									if($comp['institution']==''):
										$noc++;
									else:
										$sic++;
									endif;
								endforeach;	
						endforeach;
						
						$tabla='';
						$tabla.='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Totales que presentan una certificación en Computo</strong></P></center></th>';
						
						if(count($estudiantes)== 0):
						
							$tabla.='<tr><td>Si 0.0% - ('.$sic.')</td></tr>';
							$tabla.='<tr><td>No 0.0% - ('.$noc.')</td></tr>';

						else:
						
							$porcientoSic = ($sic * 100) / count($estudiantes);
							$porcientoNoc = ($noc * 100) / count($estudiantes);	
							
							$tabla.='<tr><td>Si '.number_format($porcientoSic, 2, '.', '').'% - ('.$sic.')</td></tr>';
							$tabla.='<tr><td>No '.number_format($porcientoNoc, 2, '.', '').'% - ('.$noc.')</td></tr>';
						endif;
						echo $tabla;
					?>
		
					<!-- Trabaja actualmente-->
					
					<?php
						$sit = 0; 
						$not = 0; 
						
						foreach($estudiantes as $estudiante):
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
						endforeach;
						
						$tabla='';
						$tabla.='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Trabaja actualmente</strong></P></center></th>';
						
						if(count($estudiantes) == 0):
						
							$tabla.='<tr><td>Si 0.0% - ('.$sit.')</td></tr>';
							$tabla.='<tr><td>No 0.0% - ('.$not.')</td></tr>'; 
						
						else:
						
							$porcientoSit = ($sit * 100) / count($estudiantes);
							$porcientoNot = ($not * 100) / count($estudiantes);
							
							$tabla.='<tr><td>Si '.number_format($porcientoSit, 2, '.', '').'% - ('.$sit.')</td></tr>';
							$tabla.='<tr><td>No '.number_format($porcientoNot, 2, '.', '').'% - ('.$not.')</td></tr>'; 
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
						$tercerización = 0;
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
																$tercerización++; 
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
						
						$tabla='';
						$tabla.='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Tipo de contrato</strong></P></center></th>';
						
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
						
							$porcientoBase = ($base * 100) / count($estudiantes);
							$porcientoBecarios = ($becario * 100) / count($estudiantes);	
							$porcientoCapacitacion = ($capacitacion * 100) / count($estudiantes);
							$porcientoConfianza = ($confianza * 100) / count($estudiantes);
							$porcientoHonorarios = ($honorarios * 100) / count($estudiantes);	
							$porcientoHoras = ($horas * 100) / count($estudiantes);
							$porcientoPracticas = ($practicas * 100) / count($estudiantes);	
							$porcientoTercerización = ($tercerización * 100) / count($estudiantes);
							$porcientoIndeterminado = ($indeterminado * 100) / count($estudiantes);	
							$porcientoPrueba = ($prueba * 100) / count($estudiantes);
							$porcientoDefinido = ($definido * 100) / count($estudiantes);	
							
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
					<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Areas de Experiencia </strong></P></center></th>
					
					<?php 
						$tabla='';
						for($cont=1; $cont<count($AreasExperiencia); $cont++):
						
							if(count($estudiantes) == 0):
							
									$tabla.='<tr><td>('.$AreasExperiencia[$cont].') 0.0% - ('.$areasExperiencia[$cont].')</td></tr>';
								else:
									$tabla.='<tr><td>('.$AreasExperiencia[$cont].') '.number_format(($areasExperiencia[$cont] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasExperiencia[$cont].')</td></tr>';
							endif;
							$cont++;
					

							if(count($estudiantes) == 0):
							
									$tabla.='<tr><td>('.$AreasExperiencia[$cont].') 0.0% - ('.$areasExperiencia[$cont].')</td></tr>';
								else:
									$tabla.='<tr><td>('.$AreasExperiencia[$cont].') '.number_format(($areasExperiencia[$cont] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasExperiencia[$cont].')</td></tr>';
							endif;

						endfor; 
						echo $tabla;
					?>
					
					
					<!-- Proyectos Academicos-->
					
					<?php
						$sip = 0; 
						$nop = 0; 
						
						foreach($estudiantes as $estudiante):
							foreach($estudiante['StudentAcademicProject'] as $proyecto):
									if($proyecto['name']==''):
										$nop++;
									else:
										$sip++;
									endif;			
							endforeach;
						endforeach;
						
						$tabla='';
						$tabla.='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Proyectos Academicos</strong></P></center></th>';
						
						if(count($estudiantes) == 0):
						
							$tabla.='<tr><td>Si 0.0% - ('.$sip.')</td></tr>';
							$tabla.='<tr><td>No 0.0% - ('.$nop.')</td></tr>';
						
						else:
						
							$porcientoSip = ($sip * 100) / count($estudiantes);
							$porcientoNop = ($nop * 100) / count($estudiantes);	
							
							$tabla.='<tr><td>Si '.number_format($porcientoSip, 2, '.', '').'% - ('.$sip.')</td></tr>';
							$tabla.='<tr><td>No '.number_format($porcientoNop, 2, '.', '').'% - ('.$nop.')</td></tr>';
						endif;
						echo $tabla;
						
					?>
						

		<!--Area de Interes-->
					<?php
						$areaInteres = array(); 
						for($contInteres=1; $contInteres<=25; $contInteres++):
							$areasInteres[$contInteres] = 0;
						endfor;
								
						 foreach($estudiantes as $estudiante):
							foreach($estudiante['StudentInterestJob'] as $interes):
								
									
									for($contInteres=1; $contInteres<=25; $contInteres++):
										if($interes['interest_area_id'] == $contInteres):
											$areasInteres[$contInteres]++;
										endif;
									endfor;
									
							endforeach;
						endforeach;
						
						$tabla='';
						$tabla.='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Areas de Interes</strong></P></center></th>';
						
						if(count($estudiantes) == 0):
							
							$tabla.='<tr><td>Actuación 0.0% - ('.$areasInteres[1].')</td></tr>';
							$tabla.='<tr><td>Administración 0.0% - ('.$areasInteres[2].')</td></tr>';
							$tabla.='<tr><td>Administración de Instituciones Internacionales 0.0% - ('.$areasInteres[3].')</td></tr>'; 
							$tabla.='<tr><td>Administración Pública 0.0% - ('.$areasInteres[4].')</td></tr>';
							$tabla.='<tr><td>Administración y Finanzas 0.0% - ('.$areasInteres[5].')</td></tr>';
							$tabla.='<tr><td>Administración y Gestión Educativa 0.0% - ('.$areasInteres[6].')</td></tr>';
							$tabla.='<tr><td>Administración y Mantenimiento de Obra 0.0% - ('.$areasInteres[7].')</td></tr>';
							$tabla.='<tr><td>Administrador de Riesgos Financieros 0.0% - ('.$areasInteres[8].')</td></tr>';
							$tabla.='<tr><td>Aduanas 0.0% - ('.$areasInteres[9].')</td></tr>';
							$tabla.='<tr><td>Aeronáutica 0.0% - ('.$areasInteres[10].')</td></tr>';
							$tabla.='<tr><td>Agronomía 0.0% - ('.$areasInteres[11].')</td></tr>';
							$tabla.='<tr><td>Agropecuaria 0.0% - ('.$areasInteres[12].')</td></tr>'; 
							$tabla.='<tr><td>Alimentos y Bebidas 0.0% - ('.$areasInteres[13].')</td></tr>'; 
							$tabla.='<tr><td>Análisis y Procesamiento de Datos 0.0% - ('.$areasInteres[14].')</td></tr>';
							$tabla.='<tr><td>Aseguramiento de Calidad 0.0% - ('.$areasInteres[15].')</td></tr>';
							$tabla.='<tr><td>Asesoría Editorial 0.0% - ('.$areasInteres[16].')</td></tr>';
							$tabla.='<tr><td>Atención a Clientes 0.0% - ('.$areasInteres[17].')</td></tr>';
							$tabla.='<tr><td>Auditoría 0.0% - ('.$areasInteres[18].')</td></tr>'; 
							$tabla.='<tr><td>Auditoría Externa 0.0% - ('.$areasInteres[19].')</td></tr>';
							$tabla.='<tr><td>Auditoría Forense 0.0% - ('.$areasInteres[20].')</td></tr>';
							$tabla.='<tr><td>Auditoría Gubernamental 0.0% - ('.$areasInteres[21].')</td></tr>';
							$tabla.='<tr><td>Auditoría Interna 0.0% - ('.$areasInteres[22].')</td></tr>';
							$tabla.='<tr><td>Automatización de Operaciones 0.0% - ('.$areasInteres[23].')</td></tr>'; 
							$tabla.='<tr><td>Banca y Servicios Financieros 0.0% - ('.$areasInteres[24].')</td></tr>'; 
							$tabla.='<tr><td>Capacitación 0.0% - ('.$areasInteres[25].')</td></tr>'; 
						
						else:
						
							$tabla.='<tr><td>Actuación '.number_format(($areasInteres[1] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[1].')</td></tr>';
							$tabla.='<tr><td>Administración '.number_format(($areasInteres[2] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[2].')</td></tr>';
							$tabla.='<tr><td>Administración de Instituciones Internacionales '.number_format(($areasInteres[3] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[3].')</td></tr>'; 
							$tabla.='<tr><td>Administración Pública '.number_format(($areasInteres[4] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[4].')</td></tr>';
							$tabla.='<tr><td>Administración y Finanzas '.number_format(($areasInteres[5] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[5].')</td></tr>';
							$tabla.='<tr><td>Administración y Gestión Educativa '.number_format(($areasInteres[6] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[6].')</td></tr>';
							$tabla.='<tr><td>Administración y Mantenimiento de Obra '.number_format(($areasInteres[7] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[7].')</td></tr>';
							$tabla.='<tr><td>Administrador de Riesgos Financieros '.number_format(($areasInteres[8] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[8].')</td></tr>';
							$tabla.='<tr><td>Aduanas '.number_format(($areasInteres[9] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[9].')</td></tr>';
							$tabla.='<tr><td>Aeronáutica '.number_format(($areasInteres[10] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[10].')</td></tr>';
							$tabla.='<tr><td>Agronomía '.number_format(($areasInteres[11] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[11].')</td></tr>';
							$tabla.='<tr><td>Agropecuaria '.number_format(($areasInteres[12] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[12].')</td></tr>'; 
							$tabla.='<tr><td>Alimentos y Bebidas '.number_format(($areasInteres[13] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[13].')</td></tr>'; 
							$tabla.='<tr><td>Análisis y Procesamiento de Datos '.number_format(($areasInteres[14] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[14].')</td></tr>';
							$tabla.='<tr><td>Aseguramiento de Calidad '.number_format(($areasInteres[15] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[15].')</td></tr>';
							$tabla.='<tr><td>Asesoría Editorial '.number_format(($areasInteres[16] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[16].')</td></tr>';
							$tabla.='<tr><td>Atención a Clientes '.number_format(($areasInteres[17] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[17].')</td></tr>';
							$tabla.='<tr><td>Auditoría '.number_format(($areasInteres[18] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[18].')</td></tr>'; 
							$tabla.='<tr><td>Auditoría Externa '.number_format(($areasInteres[19] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[19].')</td></tr>';
							$tabla.='<tr><td>Auditoría Forense '.number_format(($areasInteres[20] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[20].')</td></tr>';
							$tabla.='<tr><td>Auditoría Gubernamental '.number_format(($areasInteres[21] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[21].')</td></tr>';
							$tabla.='<tr><td>Auditoría Interna '.number_format(($areasInteres[22] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[22].')</td></tr>';
							$tabla.='<tr><td>Automatización de Operaciones '.number_format(($areasInteres[23] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[23].')</td></tr>'; 
							$tabla.='<tr><td>Banca y Servicios Financieros '.number_format(($areasInteres[24] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[24].')</td></tr>'; 
							$tabla.='<tr><td>Capacitación '.number_format(($areasInteres[25] * 100) / count($estudiantes), 2, '.', '').'% - ('.$areasInteres[25].')</td></tr>'; 
						endif;
						echo $tabla;
					?>

					</tbody>
					</table>
				</div>

			 </div>
		  </div>
		  
			<?php
			endif;
			?>
			
			
			<?php
			if($ShowIdiomas == 1):
			?>
			<br> 
			<div class = "panel-heading"> <!-- idiomas Universitarios-->
			 <h4 class = "panel-title">
				<a data-toggle = "collapse" data-parent = "#accordion" href = "#collapse2">
				 Idiomas Universitarios
				</a>
			 </h4>
		  </div>
		  
			<div id = "collapse2" class = "panel-collapse collapse">
			 <div class = "panel-body">
			 
			 <!-- Idiomas - Universitarios -->

<div class="col-md-12" style="margin-top: 30px;">
	<table class="table ">
		<thead>
			<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Idiomas Universitarios</strong></P></center></th>
		</thead>
		<tbody>	
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
		
		for($cont=1; $cont<=143; $cont++):
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
			
		endfor;
		

		foreach($estudiantes as $estudiante):
			foreach ($estudiante ['StudentLenguage'] as $lengua):
					for($cont=1; $cont<=143; $cont++):
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
					endfor;
			endforeach;
		endforeach;
		
	?>
	<?php  
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
			  <td>  bajo </td>
			  <td>  medio </td>
			  <td>  alto </td>
			  <td>  baja </td>
			  <td>  media </td>
			  <td>  alta </td>
			  <td>  baja </td>
			  <td>  media </td>
			  <td>  alta </td>
			  <td> Total </td></tr></thead> 
			  <thead><tr><th colspan="11">  </th></tr></thead>';
			  
			
			
				
			$i=1;
			foreach ($Lenguages as $lenguage):
			
				if($Idiomas[$i]==0):
					$PorcentajeIdioma = '0.0';
					$tabla='<tr><td>'.$lenguage.'</td>';
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
					
					$PorcentajeLbajo = ($Lbajo[$i] * 100) / count($Idiomas[$i]);
					$PorcentajeLmedio = ($Lmedio[$i] * 100) / count($Idiomas[$i]);
					$PorcentajeLalto = ($Lalto[$i] * 100) / count($Idiomas[$i]);
					$PorcentajeEbajo = ($Ebajo[$i] * 100) / count($Idiomas[$i]);
					$PorcentajeEmedio = ($Emedio[$i] * 100) / count($Idiomas[$i]);
					$PorcentajeEalto = ($Ealto[$i] * 100) / count($Idiomas[$i]);
					$PorcentajeCbajo = ($Cbajo[$i] * 100) / count($Idiomas[$i]);
					$PorcentajeCmedio = ($Cmedio[$i] * 100) / count($Idiomas[$i]);
					$PorcentajeCalto = ($Calto[$i] * 100) / count($Idiomas[$i]);
					
					$tabla='<tr><td>'.$lenguage.'</td>';
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
				
				$tabla.='<td colspan="2">Total: '.number_format($PorcentajeIdioma, 2, '.', '').' % - ('.$Idiomas[$i].')</td></tr>';
			
			$i++;
			echo $tabla;
			endforeach;
		//echo '</table>';		
?>	
		</tbody>
	</table>
</div>

			</div>
		</div>
			<?php
			endif;
			?>
			
			
			<?php
			if($ShowBecas == 1):
			?>
			<br> 
			<div class = "panel-heading"> <!-- becas-->
			 <h4 class = "panel-title">
				<a data-toggle = "collapse" data-parent = "#accordion" href = "#collapse3">
				 Programa de becas
				</a>
			 </h4>
		  </div>
		  
			<div id = "collapse3" class = "panel-collapse collapse">
			 <div class = "panel-body">
			 
	<!-- Inicio de tabla BECAS -->
		
				<div class="col-md-12" style="margin-top: 30px;" >
					<table class="table">
						<thead>
						 <center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Programa de Becas</strong></P></center> 
						</thead>
						<tbody>
						
						<?php
						$programasBeca = array(); 
						
						for($cont=1; $cont<=99; $cont++):
							$programasBeca[$cont] = 0;
						endfor;
								
						 foreach($estudiantes as $estudiante):
							foreach($estudiante['StudentProfessionalProfile'] as $beca):
									for($cont=1; $cont<=99; $cont++):
										if($beca['scholarship_program'] == $cont):
											$programasBeca[$cont]++;
										endif;
									endfor;
							endforeach;
						endforeach;
					 
						$tabla ='';
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
			<?php
			endif;
			?>
		
		
			 
			<?php
			if($ShowEscuelas == 1):
			?>
			<br> 
			<div class = "panel-heading"> <!-- Escuela / Facultad-->
			 <h4 class = "panel-title">
				<a data-toggle = "collapse" data-parent = "#accordion" href = "#collapse4">
				 Escuela / Facultad
				</a>
			 </h4>
		  </div>
		  
			<div id = "collapse4" class = "panel-collapse collapse">
			 <div class = "panel-body">

				<!-- Escuela y Facultad - Universitarios -->
	
<div class="col-md-12" style="margin-top: 30px;">
	<table class="table">
		<thead>
			<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Facultad Licenciaturas</strong></P></center></th>
		</thead>
		<tbody>
	<?php
		
		$licenciatura = array(); 
		
		for($cont=1; $cont<=70; $cont++):
			$licenciatura[$cont] = 0;
		endfor;
				
		 foreach($estudiantes as $estudiante):
			foreach($estudiante['StudentProfessionalProfile'] as $escuelaLic):
					for($cont=1; $cont<=70; $cont++):
						if($escuelaLic['undergraduate_institution'] == $cont):
							$licenciatura[$cont]++;
						endif;
					endfor;
			endforeach;
		endforeach;
	?>
			
	<?php
		$i=1; 
		foreach ($Escuelas as $escuela):
			if(count($estudiantes)==0):
				$tabla='<tr><td>'.$escuela.' 0.0% - ('.$licenciatura[$i].')</td>';
			else:
				$tabla='<tr><td>'.$escuela.' '.number_format(($licenciatura[$i] * 100) / count($estudiantes), 2, '.', '').' % - ('.$licenciatura[$i].')</td>';
				$i++;
			endif;
		echo $tabla;
		endforeach;
	?>
		<tr>
			<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Facultad Posgrado</strong></P></center></th>
		</tr>
	<?php
		$posgrado = array(); 
		
		for($cont=1; $cont<=93; $cont++):
			$posgrado[$cont] = 0;
		endfor;
				
		 foreach($estudiantes as $estudiante):
			foreach($estudiante['StudentProfessionalProfile'] as $escuelaPos):
					for($cont=1; $cont<=93; $cont++):
						if($escuelaPos['undergraduate_institution'] == $cont):
							$posgrado[$cont]++;
						endif;
					endfor;
			endforeach;
		endforeach;
	?>
			
	<?php
		$i=1; 
		foreach ($Facultades as $facultad):
			if(count($estudiantes)==0):
				$tabla='<tr><td>'.$facultad.' 0.0% - ('.$posgrado[$i].')</td>';
			else:
				$tabla='<tr><td>'.$facultad.' '.number_format(($posgrado[$i] * 100) / count($estudiantes), 2, '.', '').' % - ('.$posgrado[$i].')</td>';
			$i++;
			endif;
		echo $tabla;
		endforeach;
	?>
		</tbody>
	</table>
</div>

			</div>
		</div>		
			<?php
			endif;
			?>
			
			
			<?php
			if($ShowCarrera == 1):
			?>
			<br> 
			<div class = "panel-heading"> <!-- carreras-->
			 <h4 class = "panel-title">
				<a data-toggle = "collapse" data-parent = "#accordion" href = "#collapse5">
				 Carreras Universitarios
				</a>
			 </h4>
		  </div>
		  
			<div id = "collapse5" class = "panel-collapse collapse">
			 <div class = "panel-body">
			
			<!-- Carreas / Areas -->	

<div class="col-md-12" style="margin-top: 30px;">
	<table class="table ">
		<thead>
			<tr>
			  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Escuelas / Carreras</strong></P></center></th>
			</tr>
		</thead>
		<tbody>
		
		<?php
		
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
			
			
			foreach($estudiantes as $estudiante):
				foreach($estudiante['StudentProfessionalProfile'] as $escuelaStudent):
					
					//Solo licenciaturas
					foreach($escuelasId as $escuelaId):	
						if(($escuelaId['FacultadLicenciatura']['id'] == $escuelaStudent['undergraduate_institution']) AND ($escuelaStudent['academic_level_id'] == 1)):
							
							
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
		
					// FACULTADES 
					foreach($facultadesId as $facultadId):	
						if(($facultadId['FacultadPosgrado']['id'] == $escuelaStudent['undergraduate_institution']) AND ($escuelaStudent['academic_level_id'] <> 1)):
							
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

				endforeach;
			endforeach;	


			//Impresion de escuelas 
			
			$tabla='';
			foreach ($escuelasId as $escuelaId):
			
				if(count($estudiantes)==0):
					$tabla.='<tr><td style="COLOR: #000000; BACKGROUND-COLOR: #426AD2;">'.$escuelaId['FacultadLicenciatura']['facultad_licenciatura'].' 0.0% - ('.$escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']].')</td>';
				else:
					$tabla.='<tr><td style="COLOR: #000000; BACKGROUND-COLOR: #426AD2;">'.$escuelaId['FacultadLicenciatura']['facultad_licenciatura'].' '.number_format(($escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']] * 100) / count($estudiantes), 2, '.', '').' % - ('.$escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']].')</td>';
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
		
		//Imprimir Facultades 
			echo '<thead><tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Facultades / Programas</strong></P></center></th></tr></thead>';	
			$tabla='';
			foreach ($facultadesId as $facultadId):	
				if(count($estudiantes)==0):
					$tabla.='<tr><td style="COLOR: #000000; BACKGROUND-COLOR: #426AD2;">'.$facultadId['FacultadPosgrado']['facultad_posgrado'].' 0.0% - ('.$facultadPostgrado[$facultadId['FacultadPosgrado']['id']].')</td>';
				else:
					$tabla.='<tr><td style="COLOR: #000000; BACKGROUND-COLOR: #426AD2;">'.$facultadId['FacultadPosgrado']['facultad_posgrado'].' '.number_format(($facultadPostgrado[$facultadId['FacultadPosgrado']['id']] * 100) / count($estudiantes), 2, '.', '').' % - ('.$facultadPostgrado[$facultadId['FacultadPosgrado']['id']].')</td>';
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
		?>
			
		
		</tbody>
	</table>
</div>
			</div>
		   </div>
		    <?php
			endif;
			?>
		   
		   
		    <?php
			if($ShowCompetencia == 1):
			?>
			<br> 
			<div class = "panel-heading"> <!-- Competencias-->
			 <h4 class = "panel-title">
				<a data-toggle = "collapse" data-parent = "#accordion" href = "#collapse6">
				 Competencias Universitarios
				</a>
			 </h4>
		  </div>
		  
			<div id = "collapse6" class = "panel-collapse collapse">
			 <div class = "panel-body">
		   
		   <!-- Inicio de tabla Competencias - Universitarios -->

			<div class="col-md-12" style="margin-top: 30px;">
	<table class="table">
		<thead>
			<tr>
			<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Competencias registradas</strong></P></center></th>
			</tr>
		</thead>
		<tbody>
		
	<?php
	
		$competency = array(); 
		
		for($cont=1; $cont<=20; $cont++):
			$competency[$cont] = 0;
		endfor;
				
		 foreach($estudiantes as $estudiante):
			foreach($estudiante['StudentProfessionalSkill'] as $comp):
					for($cont=1; $cont<=20; $cont++):
						if($comp['competency_id'] == $cont):
							$competency[$cont]++;
						endif;
					endfor;
			endforeach;
		endforeach;
	?>
			
	<?php
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
	?>
		</tbody>
	</table>
</div>
			</div>
		</div>
		    <?php
			endif;
			?>
		   
		   
		    <?php
			if($ShowPerfilEmpresa == 1):
			?>
			<br> 
			<div class = "panel-heading"> <!-- Perfil de empresas-->
			 <h4 class = "panel-title">
				<a data-toggle = "collapse" data-parent = "#accordion" href = "#collapse7">
				 Perfil de Empresas
				</a>
			 </h4>
		  </div>
		  
			<div id = "collapse7" class = "panel-collapse collapse">
			 <div class = "panel-body">
			 
			 <!-- Inicio de tabla PERFIL EMPRESAS -->
	
			<div class="col-md-12" style="margin-top: 30px;">
	<table class="table ">
		  <thead>
			<tr>
			  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Perfil de Empresas</strong></P></center></th>
			</tr>
		  </thead>
		<tbody>	
			<tr>
				<td colspan="2">Total de Empresas <?php echo count($empresas);?></td>
			</tr>
			<tr>
			  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Tipos  de Empresas</strong></P></center></th>
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
			$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Sectores</strong></P></center></th></tr>';
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
			  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Giros</strong></P></center></th>
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
			  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Numero de Empleados</strong></P></center></th>
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
			<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Entidad Federativa (Sede)</strong></P></center></th>
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
			// echo '<pre>';
			// print_r($Estados);
			// echo '<pre>';
			
			$i=1;
			foreach ($Estados as $entidad):
				if(count($empresas)==0):
					echo '<tr><td colspan="2">'.$entidad.' 0.0% - ('.$estado[$i].')</td>';
				else:
					$PorcentajeEntidad = ($estado[$i] * 100) / count($empresas);
					echo '<tr><td colspan="2">'.$entidad.' '.number_format($PorcentajeEntidad, 2, '.', '').' % - ('.$estado[$i].')</td>';
				endif;
				$i++;
				echo $tabla;
			endforeach;
		?>	
		</tbody>
	</table>
</div>
		   </div>
		   </div>
		    <?php
			endif;
			?>
		   
		  

			<?php
			if($ShowOfertasEmpresa == 1):
			?>
			<br> 
			<div class = "panel-heading"> <!-- Ofertas de empresas-->
			 <h4 class = "panel-title">
				<a data-toggle = "collapse" data-parent = "#accordion" href = "#collapse8">
				 Ofertas de Empresas
				</a>
			 </h4>
		  </div>
		  
			<div id = "collapse8" class = "panel-collapse collapse">
			 <div class = "panel-body">   

		<!-- Inicio de tabla OFERTAS - Empresas -->

<div class="col-md-12" style="margin-top: 30px;">
	<table class="table">
		<thead>
			<tr>
			  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Ofertas</strong></P></center></th>
			</tr>
		</thead>
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
		$tabla.='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Confidencial</strong></P></center></th>';
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
			<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Giros</strong></P></center></th>
		</tr>
	<?php
		$Rotation = array(); 
		
		for($cont=1; $cont<=20; $cont++):
			$Rotation[$cont] = 0;
		endfor;
				
		foreach($ofertas as $oferta):
					for($cont=1; $cont<=20; $cont++):
						if($oferta['CompanyJobProfile']['rotation'] == $cont):
							$Rotation[$cont]++;
						endif;
					endfor;
		endforeach;
	?>
			
	<?php
		$i=1;
		$tabla='';
		foreach ($Giros as $giro):
			if(count($ofertas)== 0):
				$tabla.='<tr><td colspan="2">'.$giro.' 0.0% - ('.$Rotation[$i].')</td>';
			else:
				$porcentajeGiro = ($Rotation[$i] * 100) / count($ofertas);
				$tabla.='<tr><td colspan="2">'.$giro.' '.number_format($porcentajeGiro, 2, '.', '').' % - ('.$Rotation[$i].')</td>';
			endif;
			$i++;
			echo $tabla;
		endforeach;
	?>	
	
	<!-- Oferta incluyente -->
	
	<?php
	
		$si = 0; 
		$no = 0; 
							
		foreach($ofertas as $oferta):
			if($oferta['CompanyJobProfile']['disability'] == 's'):
				 $si++;
			else: 
				if($oferta['CompanyJobProfile']['disability'] == 'n'):
					$no++; 
				endif;
			endif; 
		endforeach;
		
		$tabla='';
		$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Incluyentes</strong></P></center></th></tr>';
		
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
		$tabla.='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Tipo de discapacidad</strong></P></center></th>';
			
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
		$tabla.='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Tipo de Contrato</strong></P></center></th>';
		
		if(count($ofertas)==0):
		
			$tabla.='<tr><td>Base 0.0% - ('.$base.')</td></tr>';
			$tabla.='<tr><td>Becario 0.0% - ('.$becario.')</td></tr>';
			$tabla.='<tr><td>Capacitación inicial 0.0% - ('.$capacitacion.')</td></tr>';
			$tabla.='<tr><td>Confianza 0.0% - ('.$confianza.')</td></tr>';
			$tabla.='<tr><td>Honorarios 0.0% - ('.$honorarios.')</td></tr>';
			$tabla.='<tr><td>por horas 0.0% - ('.$horas.')</td></tr>';
			$tabla.='<tr><td>Prácticas 0.0% - ('.$practicas.')></td></tr>';
			$tabla.='<tr><td>Tercerización 0.0% - ('.$tercerización.')</td></tr>';
			$tabla.='<tr><td>Tiempo indeterminado 0.0% - ('.$indeterminado.')</td></tr>';
			$tabla.='<tr><td>Periodo de prueba 0.0% - ('.$prueba.')</td></tr>';
			$tabla.='<tr><td>Contrato por tiempo definido 0.0% - ('.$definido.')</td></tr>'; 
		
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
			
			$tabla.='<tr><td>Base '.number_format($porcientoBase, 2, '.', '').'% - ('.$base.')</td></tr>';
			$tabla.='<tr><td>Becario '.number_format($porcientoBecarios, 2, '.', '').'% - ('.$becario.')</td></tr>';
			$tabla.='<tr><td>Capacitación inicial '.number_format($porcientoCapacitacion, 2, '.', '').'% - ('.$capacitacion.')</td></tr>';
			$tabla.='<tr><td>Confianza '.number_format($porcientoConfianza, 2, '.', '').'% - ('.$confianza.')</td></tr>';
			$tabla.='<tr><td>Honorarios '.number_format($porcientoHonorarios, 2, '.', '').'% - ('.$honorarios.')</td></tr>';
			$tabla.='<tr><td>por horas '.number_format($porcientoHoras, 2, '.', '').'% - ('.$horas.')</td></tr>';
			$tabla.='<tr><td>Prácticas '.number_format($porcientoPracticas, 2, '.', '').'% - ('.$practicas.')></td></tr>';
			$tabla.='<tr><td>Tercerización '.number_format($porcientoTercerización, 2, '.', '').'% - ('.$tercerización.')</td></tr>';
			$tabla.='<tr><td>Tiempo indeterminado '.number_format($porcientoIndeterminado, 2, '.', '').'% - ('.$indeterminado.')</td></tr>';
			$tabla.='<tr><td>Periodo de prueba '.number_format($porcientoPrueba, 2, '.', '').'% - ('.$prueba.')</td></tr>';
			$tabla.='<tr><td>Contrato por tiempo definido '.number_format($porcientoDefinido, 2, '.', '').'% - ('.$definido.')</td></tr>'; 
		
		endif;
		echo $tabla;

	?>

	<!-- Jornada Laboral -->
		<tr>
			 <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Jornada laboral</strong></P></center></th>
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
		?>
		
	<!-- SUELDOS -->
	
		<tr>
			<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Sueldos</strong></P></center></th>
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
	?>
			
	<?php
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
	?>
	
	
	<!-- ENTIDADES FEDERATIVAS -->
		<tr>
			<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Entidad Federativa</strong></P></center></th>
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
						$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Disponibilidad para viajar</strong></P></center></th></tr>';
						
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
			$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Total dentro del país</strong></P></center></th></tr>';
				
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
			$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Total fuera del país</strong></P></center></th></tr>';
				if(count($ofertas)==0):		
					$tabla.='<tr><td>Si '.number_format($porcientoSi, 2, '.', '').'% - ('.$si.')</td></tr>';
					$tabla.='<tr><td>No '.number_format($porcientoNo, 2, '.', '').'% - ('.$no.')</td></tr>';
				
				else:

					$porcientoSi = ($si * 100) / count($ofertas);
					$porcientoNo = ($no * 100) / count($ofertas);	

					$tabla.='<tr><td>Si '.number_format($porcientoSi, 2, '.', '').'% - ('.$si.')</td></tr>';
					$tabla.='<tr><td>No '.number_format($porcientoNo, 2, '.', '').'% - ('.$no.')</td></tr>';
				endif;
			echo $tabla;
			
	?>
				
	<!-- Total por nivel acaddemico-->
	
	<?php
		$licenciatura = 0; 
		$especialidad = 0; 
		$maestria = 0;
		$doctorado = 0;
		$sinNivel = 0;
		
		foreach($ofertas as $oferta):
	
				if($oferta['CompanyCandidateProfile']['licenciatura'] == 1):
					$licenciatura++; 
				endif;
					if($oferta['CompanyCandidateProfile']['especialidad'] == 1):
					  $especialidad++; 
					endif;
						if($oferta['CompanyCandidateProfile']['maestria'] == 1):
						  $maestria++; 
						endif;
							if($oferta['CompanyCandidateProfile']['doctorado'] == 1):
						      $doctorado++;
							endif;
	
			
			if(empty($oferta['CompanyCandidateProfile'])):
				$sinNivel++;
			endif;
		endforeach;
		
		$tabla='';
		$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Nivel Academico</strong></P></center></th></tr>';
		
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
	?>
	 
	<!-- Total por situacion academica -->

<?php
		$alumno = 0; 
		$egresado = 0; 
		$titulado = 0;
		$diploma = 0;
		$grados = 0;
		$sinSituacion = 0;	
		
		foreach($ofertas as $oferta):
				if($oferta['CompanyCandidateProfile']['academic_situation'] == 1):
					 $alumno++;
				else: 
					if($oferta['CompanyCandidateProfile']['academic_situation']  == 2):
						 $egresado++; 
					else:
						if($oferta['CompanyCandidateProfile']['academic_situation']  == 3):
						$titulado++; 
						else:
							if($oferta['CompanyCandidateProfile']['academic_situation']  == 4):
							$diploma++; 
							else:
								if($oferta['CompanyCandidateProfile']['academic_situation']  == 5):
								$grados++; 
								endif;
							endif;
						endif;
					endif;
				endif;
			if(empty($estudiante['StudentProfessionalProfile'])):
				$sinSituacion++;
			endif;
		endforeach;
		
		$tabla='';
		$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Situación Academica</strong></P></center></th></tr>';
		
		if(count ($ofertas)==0):
		
		$tabla.='<tr><td>Estudiante 0.0% - ('.$alumno.')</td></tr>';
		$tabla.='<tr><td>Egresado 0.0% - ('.$egresado.')</td></tr>';
		$tabla.='<tr><td>Titulado 0.0% - ('.$titulado.')</td></tr>';
		$tabla.='<tr><td>Con diploma 0.0% - ('.$diploma.')</td></tr>';
		$tabla.='<tr><td>Con Grado 0.0% - ('.$grados.')</td></tr>'; 
		$tabla.='<tr><td>Sin situación academica 0.0% - ('.$sinSituacion.')</td></tr>'; 
		
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
		$tabla.='<tr><td>Sin situación academica '.number_format($porcientoSinSituacion, 2, '.', '').'% - ('.$sinSituacion.')</td></tr>'; 
		
		endif;
		echo $tabla;
	?>

		
		</tbody>
	</table>
</div>

			</div>
		   </div>
		    <?php
			endif;
			?>
		   
		   
			<?php
			if($ShowIdiomasEmpresa == 1):
			?>
			<br> 
			<div class = "panel-heading"> <!-- idiomas de empresas-->
			 <h4 class = "panel-title">
				<a data-toggle = "collapse" data-parent = "#accordion" href = "#collapse9">
				 Idiomas de Empresas
				</a>
			 </h4>
		  </div>
		  
			<div id = "collapse9" class = "panel-collapse collapse">
			 <div class = "panel-body">   
			
		<!-- Idiomas - Empresas -->

<div class="col-md-12" style="margin-top: 30px;">
	<table class="table ">
		<thead>
			<tr>
			  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Idiomas Empresas</strong></P></center></th>
			</tr>
		</thead>
		<tbody>	
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
		
		for($cont=1; $cont<=143; $cont++):
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
		endfor;
		
		foreach($ofertas as $oferta):
			if(isset($oferta['CompanyJobLanguage'])):
			foreach ($oferta['CompanyJobLanguage'] as $lengua):
					for($cont=1; $cont<=143; $cont++):
						if($lengua['language_id'] == $cont):
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
					endfor;
			endforeach;
			endif;
		endforeach;	
	?>
	<?php  
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
			  <td>  bajo </td>
			  <td>  medio </td>
			  <td>  alto </td>
			  <td>  baja </td>
			  <td>  media </td>
			  <td>  alta </td>
			  <td>  baja </td>
			  <td>  media </td>
			  <td>  alta </td>
			  <td> Total </td></tr></thead> 
			  <thead><tr><th colspan="11">  </th></tr></thead>';
			  
			$i=1;
			// $tabla='';
			foreach ($Lenguages as $lenguage):
				if($Idiomas[$i]==0):
					$PorcentajeIdioma = '0.0';
					$tabla='<tr><td>'.$lenguage.'</td>';
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
					$PorcentajeIdioma = ($Idiomas[$i] * 100) / count($ofertas);
					$PorcentajeLbajo = ($Lbajo[$i] * 100) / count($Idiomas[$i]);
					$PorcentajeLmedio = ($Lmedio[$i] * 100) / count($Idiomas[$i]);
					$PorcentajeLalto = ($Lalto[$i] * 100) / count($Idiomas[$i]);
					$PorcentajeEbajo = ($Ebajo[$i] * 100) / count($Idiomas[$i]);
					$PorcentajeEmedio = ($Emedio[$i] * 100) / count($Idiomas[$i]);
					$PorcentajeEalto = ($Ealto[$i] * 100) / count($Idiomas[$i]);
					$PorcentajeCbajo = ($Cbajo[$i] * 100) / count($Idiomas[$i]);
					$PorcentajeCmedio = ($Cmedio[$i] * 100) / count($Idiomas[$i]);
					$PorcentajeCalto = ($Calto[$i] * 100) / count($Idiomas[$i]);
					
					$tabla='<tr><td>'.$lenguage.'</td>';
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
			
				$tabla.='<td colspan="2">Total: '.number_format($PorcentajeIdioma, 2, '.', '').' % - ('.$Idiomas[$i].')</td></tr>';
				$i++;
				echo $tabla;
			endforeach;
			
	
?>	

		</table>
   </body>
</div>		
			 </div>
		   </div>
		    <?php
			endif;
			?>
			
			
		    <?php
			if($ShowCompetenciasEmpresa == 1):
			?>
			<br> 
			<div class = "panel-heading"> <!-- competencias de empresas-->
			 <h4 class = "panel-title">
				<a data-toggle = "collapse" data-parent = "#accordion" href = "#collapse10">
				 Competencias de Empresas
				</a>
			 </h4>
		  </div>
		  
			<div id = "collapse10" class = "panel-collapse collapse">
			 <div class = "panel-body">  
		   
		   <!-- Competencias requeridas para la oferta -->
	
	<div class="col-md-12" style="margin-top: 30px;">
	<table class="table ">
		<thead>
			<tr>
			  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Competencias</strong></P></center></th>
			</tr>
		</thead>
		<tbody>	
	<?php
		$competency = array(); 
		
		for($cont=1; $cont<=20; $cont++):
			$competency[$cont] = 0;
		endfor;
				
		 foreach($ofertas as $oferta):
			if($oferta['CompanyCandidateProfile']['id']<>''):
			foreach($oferta['CompanyCandidateProfile']['CompanyJobOfferCompetency'] as $comp):
					for($cont=1; $cont<=20; $cont++):
						if($comp['competency_id'] == $cont):
							$competency[$cont]++;
						endif;
					endfor;
			endforeach;
			endif;
		endforeach;
	
	?>
			
		<?php
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
		?>	
	</tbody>
	</table>
</div>
		   	 </div>
		   </div>
			<?php
			endif;
			?>
			
			
			<?php
			if($ShowVacantesEmpresa == 1):
			?>
			<br> 
			<div class = "panel-heading"> <!-- vacantes-->
			 <h4 class = "panel-title">
				<a data-toggle = "collapse" data-parent = "#accordion" href = "#collapse11">
				Vacantes
				</a>
			 </h4>
		  </div>
		  
			<div id = "collapse11" class = "panel-collapse collapse">
			 <div class = "panel-body">   
		   
		<!-- Inicio de tabla VACANTES (PUBLICADAS) -->
	
<div class="col-md-12" style="margin-top: 30px;">
	<table class="table">
		<thead>
		
			<?php
			$totalVacantes = 0;
			foreach($ofertas as $oferta):
				$totalVacantes = $totalVacantes + $oferta['CompanyJobProfile']['vacancy_number'];
			endforeach;
			?>
						
			<tr>
			   <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Vacantes</strong></P></center></th>
			</tr>
		</thead>
		<tbody>	
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
						$tabla.='<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Confidencial</strong></P></center></th>';
						
						if($totalVacantes==0):
						
							$tabla.='<tr><td>Si 0.0% - ('.$si.')</td></tr>';
							$tabla.='<tr><td>No 0.0% - ('.$no.')</td></tr>';
						
						else:
						
							$porcientoSi = ($si * 100) / ($totalVacantes);
							$porcientoNo = ($no * 100) / ($totalVacantes);	
							
							$tabla.='<tr><td>Si '.number_format($porcientoSi, 2, '.', '').'% - ('.$si.')</td></tr>';
							$tabla.='<tr><td>No '.number_format($porcientoNo, 2, '.', '').'% - ('.$no.')</td></tr>';
						
						endif;
						echo $tabla;
					?>
			
	<!-- GIROS OFERTAS -->
		<tr>
			<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Giros</strong></P></center></th>
		</tr>
	<?php
		$Rotation = array(); 
		
		for($cont=1; $cont<=20; $cont++):
			$Rotation[$cont] = 0;
		endfor;
				
		foreach($ofertas as $oferta):
					for($cont=1; $cont<=20; $cont++):
						if($oferta['CompanyJobProfile']['rotation'] == $cont):
							$Rotation[$cont]++;
						endif;
					endfor;
		endforeach;
		
		
		?>
			
		<?php
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
							
						foreach($ofertas as $oferta):
							if($oferta['CompanyJobProfile']['disability'] == 's'):
								 $si++;
							 else: 
								 if($oferta['CompanyJobProfile']['disability'] == 'n'):
									 $no++; 
								 endif;
							endif; 
						endforeach;
						
						$tabla='';
						$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Incluyentes</strong></P></center></th></tr>';
						
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
				$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Tipo de discapacidad</strong></P></center></th></tr>';
				
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
		$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Tipo de contrato</strong></P></center></th></tr>';
		
		if($totalVacantes==0):
		
			$tabla.='<tr><td>Base 0.0% - ('.$base.')</td></tr>';
			$tabla.='<tr><td>Becario 0.0% - ('.$becario.')</td></tr>';	
			$tabla.='<tr><td>Capacitación inicial 0.0% - ('.$capacitacion.')</td></tr>'; 
			$tabla.='<tr><td>Confianza 0.0% - ('.$confianza.')></td></tr>';
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
			<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Jornada laboral</strong></P></center></th>
		</tr>
	<?php
	
		$jornadas = array(); 
		
		for($cont=1; $cont<=20; $cont++):
			$jornadas[$cont] = 0;
		endfor;
				
		foreach($ofertas as $oferta):
			//foreach($empresa['StudentProfessionalSkill'] as $comp):
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
			<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Sueldos</strong></P></center></th>
		</tr>
	<?php
		$sueldos = array(); 
		
		for($cont=1; $cont<=count($Salarios); $cont++):
			$sueldos[$cont] = 0;
		endfor;
				
		foreach($ofertas as $oferta):
			//foreach($empresa['StudentProfessionalSkill'] as $comp):
					for($cont=1; $cont<=count($Salarios); $cont++):
						if($oferta['CompanyJobContractType']['salary'] == $cont):
							$sueldos[$cont]++;
						endif;
					endfor;
		endforeach;
		?>
			
		<?php
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
			<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Entidad federativa</strong></P></center></th>
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
						$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Disponibilidad para viajar</strong></P></center></th></tr>';
						
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
			$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Total dentro del pais</strong></P></center></th></tr>';
						
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
			$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Total fuera del pais</strong></P></center></th></tr>';
			
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
	
	<!-- Total por nivel academico-->
	
	<?php
		$licenciatura = 0; 
		$especialidad = 0; 
		$maestria = 0;
		$doctorado = 0;
		$sinNivel = 0;
		
		foreach($ofertas as $oferta):
	
				if($oferta['CompanyCandidateProfile']['licenciatura'] == 1):
					$licenciatura++; 
				endif;
					if($oferta['CompanyCandidateProfile']['especialidad'] == 1):
					  $especialidad++; 
					endif;
						if($oferta['CompanyCandidateProfile']['maestria'] == 1):
						  $maestria++; 
						endif;
							if($oferta['CompanyCandidateProfile']['doctorado'] == 1):
						      $doctorado++;
							endif;
	
			
			if(empty($oferta['CompanyCandidateProfile'])):
				$sinNivel++;
			endif;
		endforeach;
		
		$tabla='';
		$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Nivel academico</strong></P></center></th></tr>';
		
		if($totalVacantes==0):
		
			$tabla.='<tr><td>Licenciatura 0.0% - ('.$licenciatura.')</td></tr>';
			$tabla.='<tr><td>Especialidad 0.0% - ('.$especialidad.')</td></tr>';
			$tabla.='<tr><td>Maestria 0.0% - ('.$maestria.')></td></tr>';
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

	<!-- Total por situacion academica -->

<?php
		$alumno = 0; 
		$egresado = 0; 
		$titulado = 0;
		$diploma = 0;
		$grados = 0;
		$sinSituacion = 0;	
		
		foreach($ofertas as $oferta):
				if($oferta['CompanyCandidateProfile']['academic_situation'] == 1):
					 $alumno++;
				else: 
					if($oferta['CompanyCandidateProfile']['academic_situation']  == 2):
						 $egresado++; 
					else:
						if($oferta['CompanyCandidateProfile']['academic_situation']  == 3):
						$titulado++; 
						else:
							if($oferta['CompanyCandidateProfile']['academic_situation']  == 4):
							$diploma++; 
							else:
								if($oferta['CompanyCandidateProfile']['academic_situation']  == 5):
								$grados++; 
								endif;
							endif;
						endif;
					endif;
				endif;
			if(empty($estudiante['StudentProfessionalProfile'])):
				$sinSituacion++;
			endif;
		endforeach;
		
		$tabla='';
		$tabla.='<tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Nivel academico</strong></P></center></th></tr>';
		
		if($totalVacantes==0):
		
			$tabla.='<tr><td>Estudiante 0.0% - ('.$alumno.')</td></tr>';
			$tabla.='<tr><td>Egresado 0.0% - ('.$egresado.')</td></tr>';
			$tabla.='<tr><td>Titulado 0.0% - ('.$titulado.')</td></tr>';
			$tabla.='<tr><td>Con diploma 0.0% - ('.$diploma.')</td></tr>';   
			$tabla.='<tr><td>Con Grado 0.0% - ('.$grados.')</td></tr>';
			$tabla.='<tr><td>Sin situación academica 0.0% - ('.$sinSituacion.')</td></tr>'; 
		
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
				$tabla.='<tr><td>Sin situación academica 0.0% - ('.$sinSituacion.')</td></tr>'; 
			else:	
				$porcientoSinSituacion = ($sinSituacion * 100) / ($totalVacantes);
				$tabla.='<tr><td>Sin situación academica '.number_format($porcientoSinSituacion, 2, '.', '').'% - ('.$sinSituacion.')</td></tr>'; 
			endif;
			
		endif;
		echo $tabla;
	?>
		
	
    <!-- Competencias requeridas para la oferta -->
	
	<tr>
		<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Competencias requeridas para la oferta</strong></P></center></th>
	</tr>
	<?php
		$competency = array(); 
		
		for($cont=1; $cont<=20; $cont++):
			$competency[$cont] = 0;
		endfor;
				
		 foreach($ofertas as $oferta):
			if($oferta['CompanyCandidateProfile']['id']<>''):
			foreach($oferta['CompanyCandidateProfile']['CompanyJobOfferCompetency'] as $comp):
					for($cont=1; $cont<=20; $cont++):
						if($comp['competency_id'] == $cont):
							$competency[$cont]++;
						endif;
					endfor;
			endforeach;
		endif;
		endforeach;
		
	?>
	
		<?php
			$i=1;
			foreach($Competencias as $competencia):
				if($totalVacantes==0):
					$tabla='<tr><td colspan="2">'.$competencia.' 0.0% - ('.$competency[$i].')</td></tr>';
				else:
					if($competency[$i]==0):
						$tabla='<tr><td colspan="2">'.$competencia.' 0.0% - ('.$competency[$i].')</td></tr>';
					else:
						$porcentajeComp = ($competency[$i] * 100) /($totalVacantes);
						$tabla='<tr><td colspan="2">'.$competencia.' '.number_format($porcentajeComp, 2, '.', '').' % - ('.$competency[$i].')</td></tr>';
					endif;
				endif;
				$i++;
			echo $tabla;
			endforeach;
			
		?>
	
		</tbody>
	</table>
</div> 
				</div>
		   </div>
		    <?php
			endif;
			?>
		   
		   
		   <?php
			if($ShowCompetenciasComp == 1):
			?>
			<br> 
			<div class = "panel-heading"> <!-- Competencias-->
			 <h4 class = "panel-title">
				<a data-toggle = "collapse" data-parent = "#accordion" href = "#collapse12">
				Competencias 
				</a>
			 </h4>
		  </div>
		  
			<div id = "collapse12" class = "panel-collapse collapse">
			 <div class = "panel-body"> 
	
	<!-- Competencias -->	

<div class="col-md-12" style="margin-top: 30px;">
	<table class="table ">
		<thead>
			<tr>
			  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Competencias</strong></P></center></th>
			</tr>
			<tr>
			  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Escuelas y carreras</strong></P></center></th>
			</tr>
		</thead>
		<tbody>
		
		<?php
		
			$escuelaLicenciatura = array(); 
			
			foreach($escuelasId as $escuelaId):
				$escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']] = 0;
			endforeach;
			
			foreach($facultadesId as $facultadId):
				$facultadPostgrado[$facultadId['FacultadPosgrado']['id']] = 0;
			endforeach;
			
			$prefijo= "competencia"; 
			foreach($relacionEscuelaCarrera as $relacion):
				$relEscCar[$relacion['RelacionEscuelaCarrera']['id']] = 0;
				for($i=1; $i<=count($Competencias); $i++):
					${$prefijo.$i}[$relacion['RelacionEscuelaCarrera']['id']] = 0;
				endfor;
			endforeach;
			
			foreach($relacionFacultadProgramas as $relacionF):
				$relFacPro[$relacionF['relacionFacultadProgramas']['id']] = 0;
				for($i=1; $i<=count($Competencias); $i++):
					${$prefijo.$i}[$relacionF['relacionFacultadProgramas']['id']] = 0;
				endfor;
			endforeach;

			foreach($facultadesComplete as $programa):
				$totalProgramas[$programa['PosgradoProgram']['id']] = 0;
			endforeach;
			
			
			foreach($estudiantes as $estudiante):
				foreach($estudiante['StudentProfessionalProfile'] as $escuelaStudent):
					
					//Solo licenciaturas
					foreach($escuelasId as $escuelaId):	
						if(($escuelaId['FacultadLicenciatura']['id'] == $escuelaStudent['undergraduate_institution']) AND ($escuelaStudent['academic_level_id'] == 1)):
							
							
							//Busca si la carrera es impartida en esa escuela
							foreach($carrerasComplete as $carrera):
								if($carrera['Career']['id'] == $escuelaStudent['career_id']):
									
									//Compara la escuela y carrera en la tabla de relaciones y la agrega en la misma
									foreach($relacionEscuelaCarrera as $relacion):
										if(($relacion['RelacionEscuelaCarrera']['facultad_licenciatura_id']==$escuelaId['FacultadLicenciatura']['id']) AND ($relacion['RelacionEscuelaCarrera']['career_id']==$carrera['Career']['career_id'])):
											$relEscCar[$relacion['RelacionEscuelaCarrera']['id']]++;
											$escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']]++;
										
											//Variables dináicas
											$prefijo= "competencia"; 
											foreach($estudiante['StudentProfessionalSkill'] as $competenciaAlumno):
												
												for($i=1; $i<=count($Competencias); $i++):
													if($competenciaAlumno['competency_id']==$i):
														${$prefijo.$i}[$relacion['RelacionEscuelaCarrera']['id']]++;
													endif;
												endfor;
												
											endforeach;

										endif;
									endforeach;
									
								endif;
							endforeach;
							
						endif;
					endforeach;	
					

					// FACULTADES 
					foreach($facultadesId as $facultadId):	
						if(($facultadId['FacultadPosgrado']['id'] == $escuelaStudent['undergraduate_institution']) AND ($escuelaStudent['academic_level_id'] <> 1)):
							
							//Busca si la carrera es impartida en esa facultad
							foreach($facultadesComplete as $programa):
								if($programa['PosgradoProgram']['id'] == $escuelaStudent['posgrado_program_id']):
		
									//Compara la escuela y carrera en la tabla de relación 
									foreach($relacionFacultadProgramas as $relacionF):
										if(($relacionF['relacionFacultadProgramas']['facultad_posgrado_id']==$facultadId['FacultadPosgrado']['id']) AND ($relacionF['relacionFacultadProgramas']['posgrado_program_id']==$programa['PosgradoProgram']['posgrado_program_id'])):
											$relFacPro[$relacionF['relacionFacultadProgramas']['id']]++;
											$facultadPostgrado[$facultadId['FacultadPosgrado']['id']]++;
											
											$prefijo= "competencia"; 
											foreach ($estudiante['StudentProfessionalSkill'] as $competenciaAlumno):
												for($i=1; $i<=count($Competencias); $i++):
													if($competenciaAlumno['competency_id']==$i):
														${$prefijo.$i}[$relacionF['relacionFacultadProgramas']['id']]++;
													endif;
												endfor;
											endforeach;
										
										endif;
									endforeach;
								endif;
							endforeach;
							
						endif;
					endforeach;	
					
				endforeach;
			endforeach;	
			
			//Impresion de escuelas 
			foreach ($escuelasId as $escuelaId):
				$tabla='<tr><td style="COLOR: #000000; BACKGROUND-COLOR: #426AD2;">'.$escuelaId['FacultadLicenciatura']['facultad_licenciatura'].' '.number_format(($escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']] * 100) / count($estudiantes), 2, '.', '').' % - ('.$escuelaLicenciatura[$escuelaId['FacultadLicenciatura']['id']].')</td></tr>';

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
							
							$tabla.='<tr><td style="padding-left: 20px;"><span class="glyphicon glyphicon-play"></span> '.$carreraImprimir.' '.$res.'% - ('.$totalImprimir.')</td></tr>';
							$prefijo= "competencia"; 
							for($i=1; $i<=count($Competencias); $i++):
								if($totalImprimir == 0):
									$tabla.='<tr><td style="padding-left: 20px;">'.$Competencias[$i].' 0% - ('. ${$prefijo.$i}[$relacion['RelacionEscuelaCarrera']['id']] .')</td></tr>';
								else:
									$tabla.='<tr><td style="padding-left: 20px;">'.$Competencias[$i].' '.number_format(( ${$prefijo.$i}[$relacion['RelacionEscuelaCarrera']['id']] * 100) / $totalImprimir, 2, '.', '').'% - ('. ${$prefijo.$i}[$relacion['RelacionEscuelaCarrera']['id']].')</td></tr>';
								endif;
								
							endfor;

						endif;
					endforeach;
				
				echo $tabla;
			endforeach;	

		// Imprimir Facultades 
			echo '<thead><tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Facultades / Programas</strong></P></center></th></tr></thead>';	
			foreach ($facultadesId as $facultadId):		    
				$tabla ='<tr><td style="COLOR: #000000; BACKGROUND-COLOR: #426AD2;">'.$facultadId['FacultadPosgrado']['facultad_posgrado'].' '.number_format(($facultadPostgrado[$facultadId['FacultadPosgrado']['id']] * 100) / count($estudiantes), 2, '.', '').' % - ('.$facultadPostgrado[$facultadId['FacultadPosgrado']['id']].')</td></tr>';
					foreach($relacionFacultadProgramas as $relacionF):
						if($relacionF['relacionFacultadProgramas']['facultad_posgrado_id'] == $facultadId['FacultadPosgrado']['id']):
							
							foreach($facultadesComplete as $programa):
								
								if($programa['PosgradoProgram']['posgrado_program_id'] == $relacionF['relacionFacultadProgramas']['posgrado_program_id']):
									$facultadImprimir = $programa['PosgradoProgram']['posgrado_program'];
									$totalImprimir = $relFacPro[$relacionF['relacionFacultadProgramas']['id']];
									break;
								endif;
								
							endforeach;

							if($facultadPostgrado[$facultadId['FacultadPosgrado']['id']] == 0):
								$res = 0;
								else:
									$res = number_format(($totalImprimir* 100) / $facultadPostgrado[$facultadId['FacultadPosgrado']['id']], 2, '.', '');
							endif;
							
							$tabla.='<tr><td style="padding-left: 20px;"><span class="glyphicon glyphicon-play"></span> '.$facultadImprimir.' '.$res.'% - ('.$totalImprimir.')</td></tr>';
							$prefijo= "competencia"; 
							for($i=1; $i<=count($Competencias); $i++):
								if($totalImprimir == 0):
									$tabla.='<tr><td style="padding-left: 60px;">'.$Competencias[$i].' 0% - ('. ${$prefijo.$i}[$relacionF['relacionFacultadProgramas']['id']] .')</td></tr>';
								else:
									$tabla.='<tr><td style="padding-left: 60px;">'.$Competencias[$i].' '.number_format(( ${$prefijo.$i}[$relacionF['relacionFacultadProgramas']['id']] * 100) / $totalImprimir, 2, '.', '').'% - ('. ${$prefijo.$i}[$relacionF['relacionFacultadProgramas']['id']].')</td></tr>';
								endif;
								
							endfor;
						endif;
					endforeach;
				
				echo $tabla;
			endforeach;	 
		?>
		
		<thead>
			<tr>
				<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Competencias de Ofertas por Carrera</strong></P></center></th>
			</tr>
			<tr>
				<td colspan="2">Total de Ofertas <?php echo count($ofertas);?></td>
			</tr>
		</thead>
		<tbody>	
		
		<?php
			$prefijo= "competenciaOfertaCarrera"; 
			foreach($carrerasComplete as $carrera):
				$carreraOfertaCarrera[$carrera['Career']['id']] = 0;
				for($i=1; $i<=count($Competencias); $i++):
					${$prefijo.$i}[$carrera['Career']['id']] = 0;
				endfor;
			endforeach;
			
			// Imprimir carreras con sus competencias
			foreach($carrerasComplete as $carrera):
				foreach($ofertas as $oferta):
					
					// Suma las ofertas que pertenecen a la carrera
					if($oferta['CompanyCandidateProfile']['id'] <> ''):
					foreach($oferta['CompanyCandidateProfile']['CompanyJobRelatedCareer'] as $carreraOferta):
						if($carrera['Career']['id'] == $carreraOferta['career_id']):
							$carreraOfertaCarrera[$carrera['Career']['id']]++;
							
							foreach($oferta['CompanyCandidateProfile']['CompanyJobOfferCompetency'] as $competenciaOferta):
							for($i=1; $i<=count($Competencias); $i++):
								if($competenciaOferta['competency_id']==$i):
									${$prefijo.$i}[$carrera['Career']['id']]++;
								endif;
							endfor;
						endforeach;

						endif;
					endforeach;
					endif;
				endforeach;
			endforeach;
			
		
			$tabla = '';
			foreach($carrerasComplete as $carrera):
				
				if($carreraOfertaCarrera[$carrera['Career']['id']] == 0):
					$tabla.='<tr><td style="COLOR: #000000; BACKGROUND-COLOR: #426AD2;">'.$careers[$carrera['Career']['id']].' 0.0 % - ('.$carreraOfertaCarrera[$carrera['Career']['id']].')</td></tr>';
				else:
					$tabla.='<tr><td style="COLOR: #000000; BACKGROUND-COLOR: #426AD2;">'.$careers[$carrera['Career']['id']].' '.number_format(($carreraOfertaCarrera[$carrera['Career']['id']] * 100) / count($ofertas), 2, '.', '').' % - ('.$carreraOfertaCarrera[$carrera['Career']['id']].')</td></tr>';
				endif;
				
				for($i=1; $i<=count($Competencias); $i++):
				
					if($carreraOfertaCarrera[$carrera['Career']['id']] == 0):
						$res = "0.0";
					else:
						$res = number_format((${$prefijo.$i}[$carrera['Career']['id']] * 100) / $carreraOfertaCarrera[$carrera['Career']['id']], 2, '.', '');
					endif;
				
					$tabla.='<tr><td>'.$Competencias[$i].' '.$res.'% - ('.${$prefijo.$i}[$carrera['Career']['id']].')</td></tr>';
				endfor;
				
			endforeach;
			echo $tabla;
			
			// facultades 
			
				$prefijo= "competenciaOfertaPrograma"; 
			foreach($facultadesComplete as $facultad):
				$carreraOfertaCarrera[$facultad['PosgradoProgram']['id']] = 0;
				for($i=1; $i<=count($Competencias); $i++):
					${$prefijo.$i}[$facultad['PosgradoProgram']['id']] = 0;
				endfor;
			endforeach;
				
			// Imprimir carreras con sus competencias
			foreach($facultadesComplete as $facultad):
				foreach($ofertas as $oferta):
					
					// Suma las ofertas que pertenecen a la carrera
					if($oferta['CompanyCandidateProfile']['id'] <> ''):
					foreach($oferta['CompanyCandidateProfile']['CompanyJobRelatedCareer'] as $carreraOferta):
						if($facultad['PosgradoProgram']['id'] == $carreraOferta['id']):
							$carreraOfertaCarrera[$facultad['PosgradoProgram']['id']]++;
						
						
						foreach($oferta['CompanyCandidateProfile']['CompanyJobOfferCompetency'] as $competenciaOferta):
							for($i=1; $i<=count($Competencias); $i++):
								if($competenciaOferta['competency_id']==$i):
									${$prefijo.$i}[$facultad['PosgradoProgram']['id']]++;
								endif;
							endfor;
						endforeach;

						endif;
					endforeach;
					endif;
				endforeach;
			endforeach;
			
				$tabla = '';
			    foreach($facultadesComplete as $facultad):
					if(count($ofertas) == 0):
						$tabla.='<tr><td style="COLOR: #000000; BACKGROUND-COLOR: #426AD2;">'.$AreasPosgrado[$facultad['PosgradoProgram']['id']].' 0.0 % - '.$carreraOfertaCarrera[$facultad['PosgradoProgram']['id']].'</td></tr>';
					else:
						$tabla.='<tr><td style="COLOR: #000000; BACKGROUND-COLOR: #426AD2;">'.$AreasPosgrado[$facultad['PosgradoProgram']['id']].' '.number_format(($carreraOfertaCarrera[$facultad['PosgradoProgram']['id']] * 100) / count($ofertas), 2, '.', '').' % - ('.$carreraOfertaCarrera[$facultad['PosgradoProgram']['id']].')</td></tr>';
					endif;
				
				for($i=1; $i<=count($Competencias); $i++):
				
					if($carreraOfertaCarrera[$facultad['PosgradoProgram']['id']] == 0):
						$res = "0.0";
					else:
						$res = number_format((${$prefijo.$i}[$facultad['PosgradoProgram']['id']]* 100) / $carreraOfertaCarrera[$facultad['PosgradoProgram']['id']], 2, '.', '');
					endif;
				
					$tabla .='<tr><td>'.$Competencias[$i].' '.$res.'.% - ('.${$prefijo.$i}[$facultad['PosgradoProgram']['id']].')</td></tr>';
				endfor;
				
			endforeach;
			echo $tabla;
		?>
	<thead>
			<tr>
				<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Competencias por Giros</strong></P></center></th>
			</tr>
		</thead>
		<tbody>

		<?php
			$prefijo= "competenciaGiro"; 
			$cont = 1;
			foreach($Giros as $giro):
				$ofertaGiro[$cont] = 0;
					for($i=1; $i<=count($Competencias); $i++): // competencias
						${$prefijo.$cont}[$i] = 0;
					endfor;
			$cont++;
			endforeach;
			
				$cont = 1;
				foreach($Giros as $giro):
					
					//Suma los giros (ofertas) que pertenecen a la oferta (carrera)
					foreach($ofertas as $oferta):
						if($oferta['CompanyJobProfile']['rotation'] == $cont):
							$ofertaGiro[$cont]++;
							
							if($oferta['CompanyCandidateProfile']['id'] <> ''):
								foreach($oferta['CompanyCandidateProfile']['CompanyJobOfferCompetency'] as $competenciaOferta):
									for($i=1; $i<=count($Competencias); $i++):
										if($competenciaOferta['competency_id']==$i):
											${$prefijo.$cont}[$i]++;
										endif;
									endfor;
								endforeach;
							endif;
							
						endif;
				
					endforeach;
				$cont++;
				endforeach;
			
			
			
			$tabla = '';
			$cont = 1;
			foreach($Giros as $giro):
					if($carreraOfertaCarrera[$facultad['PosgradoProgram']['id']] == 0):
						$tabla.='<tr><td style="COLOR: #000000; BACKGROUND-COLOR: #426AD2;">'.$giro.' 0.0 % - ('.$carreraOfertaCarrera[$facultad['PosgradoProgram']['id']].')</td></tr>';
					else:
						$tabla .='<tr><td style="COLOR: #000000; BACKGROUND-COLOR: #426AD2;">'.$giro.' '.number_format(($ofertaGiro[$cont] * 100) / count($ofertas), 2, '.', '').'% -('.$ofertaGiro[$cont].')</td></tr>';
					endif;
				for($i=1; $i<=count($Competencias); $i++):
				
				if($ofertaGiro[$cont] == 0):
						$res = 0;
					else:
						$res = number_format((${$prefijo.$cont}[$i] * 100) / $ofertaGiro[$cont], 2, '.', '');
				endif;
				
					$tabla .='<tr><td>'.$Competencias[$i].' '.$res.'% - ('.${$prefijo.$cont}[$i].')</td></tr>';
				endfor;
				
			$cont++;
			endforeach;
			echo $tabla; 
		?>
		<thead>
			<tr>
				<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Competencias por Areas de Experiencia</strong></P></center></th>
			</tr>
		</thead>
		<tbody>

		<?php 
			$prefijo= "competenciaArea"; 
			$cont = 1;
			foreach($AreasExperiencia as $area):
				$ofertaArea[$cont] = 0;
					for($i=1; $i<=count($Competencias); $i++): // competencias
						${$prefijo.$cont}[$i] = 0;
					endfor;
			$cont++;
			endforeach;
			
			$cont = 1;
			foreach($AreasExperiencia as $area):
					
					// Suma los giros (ofertas) que pertenecen a la oferta (carrera)
					foreach($ofertas as $oferta):
						if($oferta['CompanyJobProfile']['interest_area'] == $cont):
							$ofertaArea[$cont]++;
							
							if($oferta['CompanyCandidateProfile']['id'] <> ''):
							foreach($oferta['CompanyCandidateProfile']['CompanyJobOfferCompetency'] as $competenciaOferta):
								for($i=1; $i<=count($Competencias); $i++):
									if($competenciaOferta['competency_id']==$i):
										${$prefijo.$cont}[$i]++;
									endif;
								endfor;
							endforeach;
							endif;
							
						endif;
				
					endforeach;
					
				$cont++;
			endforeach;
		
			$tabla = '';
			$cont = 1;
		

			foreach($AreasExperiencia as $area):
					if($ofertaArea[$cont] == 0):
						$tabla.='<tr><td style="COLOR: #000000; BACKGROUND-COLOR: #426AD2;">'.$area.' 0.0 % - ('.$ofertaArea[$cont].')</td></tr>';
					else:
						$tabla.='<tr><td style="COLOR: #000000; BACKGROUND-COLOR: #426AD2;">'.$area.' '.number_format(($ofertaArea[$cont] * 100) / count($ofertas), 2, '.', '').'% - ('.$ofertaArea[$cont].')</td></tr>';
					endif;
				
				for($i=1; $i<=count($Competencias); $i++):
				
					if($ofertaArea[$cont] == 0):
						$res = '0.0';
					else:
						$res = number_format((${$prefijo.$cont}[$i] * 100) / $ofertaArea[$cont], 2, '.', '');
					endif;
				
					$tabla.='<tr><td>'.$Competencias[$i].' '.$res.'% - ('.${$prefijo.$cont}[$i].')</td></tr>';
				endfor;
				
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
	   </div>
			<?php
			endif;
			?>
			
			
			<?php
			if($ShowContrataciones == 1):
			?>
			<br> 
			<div class = "panel-heading"> <!-- Contrataciones y seguimientos-->
			 <h4 class = "panel-title">
				<a data-toggle = "collapse" data-parent = "#accordion" href = "#collapse13">
				Contrataciones y Seguimientos 
				</a>
			 </h4>
		  </div>
		  
			<div id = "collapse13" class = "panel-collapse collapse">
			 <div class = "panel-body"> 
			
			<!-- Contrataciones y Seguimientos -->

			<div class="col-md-12" style="margin-top: 30px;">
	<table class="table ">
		<thead>
			<tr>
			  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Contrataciones y seguimientos</strong></P></center></th>
			</tr>
			<tr>
			  <th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Total de alumnos en un proceso de R&S </strong></P></th>
			</tr>
		</thead>
		<tbody>
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
			  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>En Proceso</strong></P></center></th>
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
			  <th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Contratados</strong></P></center></th>
			</tr>
			<tr>
			  <th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Total contratados </strong></P></th>
			</tr>
	<?php
	
	$contratado = 0;
	
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
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Rango de sueldos</strong></P></th>
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
	
	<tr>
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Escuela / Carrera</strong></P></th>
	</tr>
	
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
				$relFacPro[$relacionF['relacionFacultadProgramas']['id']] = 0;
			endforeach;

			foreach($facultadesComplete as $programa):
				$totalProgramas[$programa['PosgradoProgram']['id']] = 0;
			endforeach;
			
			
			foreach($notificaciones as $notificacion):
				
				if (($notificacion['StudentNotification']['step_process'] == 3) AND ($notificacion['StudentNotification']['type_respons_company'] == 4)):
				
					foreach($notificacion['Student']['StudentProfessionalProfile'] as $escuelaStudent):

						//Solo licenciaturas
						foreach($escuelasId as $escuelaId):	
							if(($escuelaId['FacultadLicenciatura']['id'] == $escuelaStudent['undergraduate_institution']) AND ($escuelaStudent['academic_level_id'] == 1)):

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
			
			
			
						// FACULTADES 
						foreach($facultadesId as $facultadId):	
							if(($facultadId['FacultadPosgrado']['id'] == $escuelaStudent['undergraduate_institution']) AND ($escuelaStudent['academic_level_id'] <> 1)):
								
								// Busca si la carrera es impartida en esa facultad
								foreach($facultadesComplete as $programa):
									if($programa['PosgradoProgram']['id'] == $escuelaStudent['posgrado_program_id']):
			
										// Compara la escuela y carrera en la tabla de relación 
										foreach($relacionFacultadProgramas as $relacionF):
											if(($relacionF['relacionFacultadProgramas']['facultad_posgrado_id']==$facultadId['FacultadPosgrado']['id']) AND ($relacionF['relacionFacultadProgramas']['posgrado_program_id']==$programa['PosgradoProgram']['posgrado_program_id'])):
												$relFacPro[$relacionF['relacionFacultadProgramas']['id']]++;
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
			echo '<thead><tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Facultades / Programas</strong></P></center></th></tr></thead>';	
			
			$tabla='';
			foreach ($facultadesId as $facultadId):	
				
				if($facultadPostgrado[$facultadId['FacultadPosgrado']['id']] == 0):
					$tabla.='<tr><td><span class="glyphicon glyphicon-play"></span>' .$facultadId['FacultadPosgrado']['facultad_posgrado'].' 0.0 % - ('.$facultadPostgrado[$facultadId['FacultadPosgrado']['id']].')</td>';
				else:
					$tabla.='<tr><td><span class="glyphicon glyphicon-play"></span>'.$facultadId['FacultadPosgrado']['facultad_posgrado'].' '.number_format(($facultadPostgrado[$facultadId['FacultadPosgrado']['id']] * 100) / count($notificaciones), 2, '.', '').' % - ('.$facultadPostgrado[$facultadId['FacultadPosgrado']['id']].')</td>';
				endif;
				
					foreach($relacionFacultadProgramas as $relacionF):
						if($relacionF['relacionFacultadProgramas']['facultad_posgrado_id'] == $facultadId['FacultadPosgrado']['id']):
							
							foreach($facultadesComplete as $programa):
								
								if($programa['PosgradoProgram']['posgrado_program_id'] == $relacionF['relacionFacultadProgramas']['posgrado_program_id']):
									$facultadImprimir = $programa['PosgradoProgram']['posgrado_program'];
									$totalImprimir = $relFacPro[$relacionF['relacionFacultadProgramas']['id']];
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
	
	<tr>
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Nivel academico</strong></P></th>
	</tr>
	
	<?php
	
	//Nivel academico
	
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
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Situación Academica</strong></P></th>
	</tr>
	
	<?php
	
	//Situacion academica
	
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
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Tipos de discapacidad</strong></P></th>
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
	
	
	<tr>
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Experiencia profesional</strong></P></th>
	</tr>
	
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
	
	<tr>
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Giros</strong></P></th>
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
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Sectores</strong></P></th>
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

	$tabla = '';
	$cont = 1;
	
	foreach($Sectores as $sector):
		if($sectorCont[$cont] == 0):
			$tabla.='<tr><td>'.$sector.' 0.0 % - ('.$sectorCont[$cont].')</td></tr>';
		else:
			$tabla.='<tr><td>'.$sector.' '.number_format(($sectorCont[$cont] * 100) / count($notificaciones), 2, '.', '').'% - ('.$sectorCont[$cont].')</td></tr>';
		endif;
	$cont++;
	endforeach;
	echo $tabla;
	?>
	
	<tr>
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Contratados externos</strong></P></th>
	</tr>
	
	
	<tr><td>Contratados externos <?php echo($contratacionesExternas)?></td></tr>
	
	
	
	
	<!--TOTAL POR EMPRESAS EN EL UNIVERSO DE UNIVERSITARIOS CONTRATADOS-->
	

	<tr>
		<th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Empresa/Contrataciones</strong></P></center></th>
	</tr>
	<tr>
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Por Empresa / Universitarios</strong></P></th>
	</tr>
	
	<?php
	
	foreach($contrataciones as $contratacion):
		$totalEmpresas[$contratacion['Company']['id']] = 0;
	endforeach;	
	
	$totalContratados = 0;
	foreach($contrataciones as $contratacion):
		if (($contratacion['Report']['registered_by'] == 'company') AND ($contratacion['Report']['response_notification'] == 1)):
			$totalContratados++;
			$totalEmpresas[$contratacion['Company']['id']]++;
		endif;	
	endforeach;
		
	foreach($contrataciones as $contratacion):
		$tabla = '';
		if($totalEmpresas[$contratacion['Company']['id']]==0):
			$tabla.='<tr><td>'.$contratacion['Company']['CompanyProfile']['company_name'].' 0.0% - ('.$totalEmpresas[$contratacion['Company']['id']].')</td></tr>';
		else:
			$tabla.='<tr><td>'.$contratacion['Company']['CompanyProfile']['company_name'].' '.number_format(($totalEmpresas[$contratacion['Company']['id']] * 100) /count($contrataciones), 2, '.', '').'% - ('.$totalEmpresas[$contratacion['Company']['id']].')</td></tr>';
		endif;
	endforeach;	
	echo $tabla;
	?>

	<tr>
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Rango de sueldos</strong></P></th>
	</tr>
	
	<?php
	
	//salarios
	
	$cont = 1;
	foreach($Salarios as $sueldo):
		$salario[$cont] = 0;
		$cont++;
	endforeach;		

	
	foreach($contrataciones as $contratacion):
		if (($contratacion['Report']['registered_by'] == 'company') AND ($contratacion['Report']['response_notification'] == 1)):
				
				$cont = 1;
				foreach($Salarios as $sueldo):
					if($contratacion['CompanyJobProfile']['CompanyJobContractType']['salary'] == $cont):
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
			$tabla.='<tr><td>'.$sueldo.' '.number_format(($salario[$cont] * 100) / $totalContratados, 2, '.', '').'% - ('.$salario[$cont].')</td></tr>';
		endif;
	$cont++;
	endforeach;
	echo $tabla;
	?>
	
	<tr>
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Escuela / Carrera</strong></P></th>
	</tr>
	
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
				$relFacPro[$relacionF['relacionFacultadProgramas']['id']] = 0;
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
											if(($relacionF['relacionFacultadProgramas']['facultad_posgrado_id']==$facultadId['FacultadPosgrado']['id']) AND ($relacionF['relacionFacultadProgramas']['posgrado_program_id']==$programa['PosgradoProgram']['posgrado_program_id'])):
												$relFacPro[$relacionF['relacionFacultadProgramas']['id']]++;
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
		//Imprimir Facultades 
			echo '<thead><tr><th colspan="5"><center><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Facultades / Programas</strong></P></center></th></tr></thead>';	
			
			$tabla='';
			foreach ($facultadesId as $facultadId):	
				if($facultadPostgrado[$facultadId['FacultadPosgrado']['id']] == 0):
					$tabla.='<tr><td><span class="glyphicon glyphicon-play"></span>' .$facultadId['FacultadPosgrado']['facultad_posgrado'].' 0.0 % - ('.$facultadPostgrado[$facultadId['FacultadPosgrado']['id']].')</td>';
				else:
				$tabla.='<tr><td><span class="glyphicon glyphicon-play"></span>'.$facultadId['FacultadPosgrado']['facultad_posgrado'].' '.number_format(($facultadPostgrado[$facultadId['FacultadPosgrado']['id']] * 100) / $totalContratados, 2, '.', '').' % - ('.$facultadPostgrado[$facultadId['FacultadPosgrado']['id']].')</td>';
				endif;
					foreach($relacionFacultadProgramas as $relacionF):
						if($relacionF['relacionFacultadProgramas']['facultad_posgrado_id'] == $facultadId['FacultadPosgrado']['id']):
							
							foreach($facultadesComplete as $programa):
								
								if($programa['PosgradoProgram']['posgrado_program_id'] == $relacionF['relacionFacultadProgramas']['posgrado_program_id']):
									$facultadImprimir = $programa['PosgradoProgram']['posgrado_program'];
									$totalImprimir = $relFacPro[$relacionF['relacionFacultadProgramas']['id']];
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
	
	<tr>
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Nivel Academico</strong></P></th>
	</tr>
	
	<?php
	
	//Tipos de discapacidad
	
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
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Situación Academica</strong></P></th>
	</tr>
	
	<?php
	
	//Situacion academica
	
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
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Tipos de discapacidad</strong></P></th>
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
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Experiencia profesional</strong></P></th>
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
	
	<tr>
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Giros</strong></P></th>
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
		<th colspan="5"><P style="COLOR: #000000; BACKGROUND-COLOR: #AD8D51;"><strong>Sectores</strong></P></th>
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
			<?php
			endif;
			?>
			
			</div>
		</div>
			
	</div>
</div>

<?php endif; ?>