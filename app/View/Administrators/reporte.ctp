<?php 
	$this->layout = 'administrator'; 
?>
	<script type="text/javascript">
		
		$(document).ready(function() {
			<?php if(!empty($this->request->data['AdministratorProfile']['start_date_expiration_informe']) and ($this->request->data['AdministratorProfile']['start_date_expiration_informe']<>'') and ($this->request->data['AdministratorProfile']['start_date_expiration_informe'] <> '0000-00-00')): ?>
			 $('#AdministratorProfileStartDateExpirationInformeYear').prepend('<option value="">AAAA</option>');
			 $('#AdministratorProfileStartDateExpirationInformeMonth').prepend('<option value="">MM</option>');
			 $('#AdministratorProfileStartDateExpirationInformeDay').prepend('<option value="">DD</option>');
			 
			 $('#AdministratorProfileEndDateExpirationInformeYear').prepend('<option value="">AAAA</option>');
			 $('#AdministratorProfileEndDateExpirationInformeMonth').prepend('<option value="">MM</option>');
			 $('#AdministratorProfileEndDateExpirationInformeDay').prepend('<option value="">DD</option>');
			<?php else: ?>
			 $('#AdministratorProfileStartDateExpirationInformeYear').prepend('<option value="" selected>AAAA</option>');
			 $('#AdministratorProfileStartDateExpirationInformeMonth').prepend('<option value="" selected>MM</option>');
			 $('#AdministratorProfileStartDateExpirationInformeDay').prepend('<option value="" selected>DD</option>');
			 
			 $('#AdministratorProfileEndDateExpirationInformeYear').prepend('<option value="" selected>AAAA</option>');
			 $('#AdministratorProfileEndDateExpirationInformeMonth').prepend('<option value="" selected>MM</option>');
			 $('#AdministratorProfileEndDateExpirationInformeDay').prepend('<option value="" selected>DD</option>');
			<?php endif; ?>
		 
		 checkStatus();
		 setDates();
		});	
		
		function setDates(){
			if ($('#AdministratorProfileUnlimited').is(':checked')) {
					document.getElementById('AdministratorProfileStartDateExpirationInformeYear').options[0].selected = 'selected';
					document.getElementById('AdministratorProfileStartDateExpirationInformeMonth').options[0].selected = 'selected';
					document.getElementById('AdministratorProfileStartDateExpirationInformeDay').options[0].selected = 'selected';
					
					document.getElementById('AdministratorProfileEndDateExpirationInformeYear').options[0].selected = 'selected';
					document.getElementById('AdministratorProfileEndDateExpirationInformeMonth').options[0].selected = 'selected';
					document.getElementById('AdministratorProfileEndDateExpirationInformeDay').options[0].selected = 'selected';
			}
		}
		
		function validarFechaAdmin(fecha){
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
			if (dia < 1 || dia > 31) {
				$.alert({ title: '!Aviso!',type: 'blue',content: 'El valor del día debe estar comprendido entre 1 y 31.'});
				return false;
			}
			if (mes < 1 || mes > 12) { 
				$.alert({ title: '!Aviso!',type: 'blue',content: 'El valor del mes debe estar comprendido entre 1 y 12.'});
				return false;
			}
			if ((mes==4 || mes==6 || mes==9 || mes==11) && dia==31) {
				$.alert({ title: '!Aviso!',type: 'blue',content: 'El mes '+mes+'no tiene 31 días!'});
				return false;
			}
			if (mes == 2) { // bisiesto
				var bisiesto = (aho % 4 == 0 && (aho % 100 != 0 || aho % 400 == 0));
				if (dia > 29 || (dia==29 && !bisiesto)) {
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Febrero del' + aho + 'no contiene '+ dia + 'dias!'});
					return false;
				}
			}
		}
	
		function validateDates(){
			
			var seleccionadoEstatus = $("#AdministratorStatusInforme option:selected").index();
			
			var year1  = $( "#AdministratorProfileStartDateExpirationInformeYear" ).val();
			var month1 = $( "#AdministratorProfileStartDateExpirationInformeMonth" ).val();
			var day1   = $( "#AdministratorProfileStartDateExpirationInformeDay" ).val();
				
			var year2  = $( "#AdministratorProfileEndDateExpirationInformeYear" ).val();
			var month2 = $( "#AdministratorProfileEndDateExpirationInformeMonth" ).val();
			var day2   = $( "#AdministratorProfileEndDateExpirationInformeDay" ).val();
			
			var fecha1 = document.getElementById('AdministratorProfileStartDateExpirationInformeDay').value	+ "/" +
						document.getElementById('AdministratorProfileStartDateExpirationInformeMonth').value + "/" +
						document.getElementById('AdministratorProfileStartDateExpirationInformeYear').value;
			
			var fecha2 = document.getElementById('AdministratorProfileEndDateExpirationInformeDay').value + "/" +
						document.getElementById('AdministratorProfileEndDateExpirationInformeMonth').value + "/" +
						document.getElementById('AdministratorProfileEndDateExpirationInformeYear').value;
						
			vigenciaFecha1 = validarFechaAdmin(fecha1);
			vigenciaFecha2 = validarFechaAdmin(fecha2);
			
			// dd/mm/yyyy
			valida1 = day1+'/'+month1+'/'+year1;
			valida2 = day2+'/'+month2+'/'+year2;
			resultadoComparativa=validate_fechaMayorQue(valida1,valida2);
			
			var seleccionado = $("#AdministratorTipoInforme option:selected").index();
			
			var columnasCurriculum = $('#AdministratorColumnasCurriculum > option:selected');
			var columnasEmpresa = $('#AdministratorColumnasEmpresa > option:selected');
			var columnasOferta = $('#AdministratorColumnasOferta > option:selected');
			var columnasSeguimiento = $('#AdministratorColumnasSeguimiento > option:selected');
			
				var year1  = $( "#AdministratorProfileStartDateExpirationInformeYear" ).val();
				var month1 = $( "#AdministratorProfileStartDateExpirationInformeMonth" ).val();
				var day1   = $( "#AdministratorProfileStartDateExpirationInformeDay" ).val();
				
				var year2  = $( "#AdministratorProfileEndDateExpirationInformeYear" ).val();
				var month2 = $( "#AdministratorProfileEndDateExpirationInformeMonth" ).val();
				var day2   = $( "#AdministratorProfileEndDateExpirationInformeDay" ).val();
				
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
				}else if(seleccionado == 0){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione un tipo de reporte.'});
					return false;
				}else if(seleccionadoEstatus == 0){ 
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione el estatus.'});
					return false;
				}else if((seleccionado == 1) && (columnasCurriculum.length == 0)){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione las columnas de descarga.'});
					return false;
				}else if((seleccionado == 2) && (columnasEmpresa.length == 0)){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione las columnas de descarga.'});
					return false;
				}else if((seleccionado == 3) && (columnasOferta.length == 0)){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione las columnas de descarga.'});
					return false;
				}else if((seleccionado == 4) && (columnasSeguimiento.length == 0)){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione las columnas de descarga.'});
					return false;
				}else{
					return true;
				}
		}
		
		function checkStatus(){ 
			var seleccionado = $("#AdministratorTipoInforme option:selected").index();
			
			if((seleccionado == 1) || (seleccionado == 2) || (seleccionado == 3) || (seleccionado == 4)){  
				$("#contentStatusId").show();	
			}else{
				$("#contentStatusId").hide();
				document.getElementById('AdministratorStatusInforme').options[0].selected = 'selected';
			}
				
			if(seleccionado > 0){
				$("#BloqueInformativoId").show();	
			}else{
				$("#BloqueInformativoId").hide();	
			}
			
			$( "#informeSeleccionadoId" ).empty();
			$( "#descripcionInformeId" ).empty();
			
			$("#columnasCurriculumId").hide();	
			$("#columnasEmpresaId").hide();	
			$("#columnasOfertaId").hide();
			$("#columnasSeguimientoId").hide();
			$('#leyendaId').hide();
			
			$("#AdministratorColumnasCurriculum").selectpicker('deselectAll');
			$("#AdministratorColumnasEmpresa").selectpicker('deselectAll');
			$("#AdministratorColumnasOferta").selectpicker('deselectAll');
			$("#AdministratorColumnasSeguimiento").selectpicker('deselectAll');
			
			if(seleccionado == 0){
				$("#formReport").attr("action","reporte");
			}else if(seleccionado == 1){
				$("#columnasCurriculumId").show();		
				$('#leyendaId').show();
				
				$( "#informeSeleccionadoId" ).append('Reporte de currículums');	
				$( "#descripcionInformeId" ).append('Descarga de toda la información contenida en cada uno de los currículums de los universitarios registrados en el sistema por status.');
				
				$("#formReport").attr("action","studentReportExcel");
			}else if(seleccionado == 2){
				$("#columnasEmpresaId").show();		
				$('#leyendaId').show();
				
				$( "#informeSeleccionadoId" ).append('Reporte de empresas');	
				$( "#descripcionInformeId" ).append('Descarga de toda la información contenida en cada perfil de empresa registrada en el sistema por status.');
				
				$("#formReport").attr("action","companyReportExcel");
			}else if(seleccionado == 3){
				$("#columnasOfertaId").show();	
				$('#leyendaId').show();
				
				$( "#informeSeleccionadoId" ).append('Reporte de ofertas y vacantes');	
				$( "#descripcionInformeId" ).append('Descarga de toda la información contenida en cada oferta y sus vacantes registradas en el sistema por status.');
				
				$("#formReport").attr("action","reportOfferExcel");
			}else if(seleccionado == 4){
				$("#columnasSeguimientoId").show();	
				$('#leyendaId').show();
				
				$( "#informeSeleccionadoId" ).append('Reporte de contratación y seguimiento');	
				$( "#descripcionInformeId" ).append('Descarga de toda la información correspondiente a los procesos de reclutamiento y selección; así como contrataciones registradas en el sistema por universitario.');
				
				$("#formReport").attr("action","reportContratacionExcel");
			}
			
		}		
	</script>

	<div class="col-md-10 col-md-offset-1 fondoBti" style="margin-top: 20px;">
		<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 15px;margin-bottom: 5px;">
	        <p style="color: #fff">Buscar reportes por rango de fechas.</p>
	    </blockquote>

		<?= $this->Form->create('Administrator', [
								'id' => 'formReport',
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
								'action' => '',
								'onsubmit' => 'return validateDates();']); ?>
		<fieldset>

			<div class="col-md-6">
				<?= $this->Form->input('AdministratorProfile.start_date_expiration_informe', [
														'type' => 'date',
														'class' => 'selectpicker show-tick form-control show-menu-arrow',
														'data-width'=> '33.333%',
														'dateFormat' => 'YMD',
														'separator' => '',
														'minYear' => date('Y') - 2,
														'maxYear' => date('Y') - 0]); ?>
			</div>
			
			<div class="col-md-6">
				<?= $this->Form->input('AdministratorProfile.end_date_expiration_informe', [
														'type' => 'date',
														'class' => 'selectpicker show-tick form-control show-menu-arrow',
														'data-width'=> '33.333%',
														'dateFormat' => 'YMD',
														'separator' => '',
														'minYear' => date('Y') - 2,
														'maxYear' => date('Y') - 0]); ?>
			</div>		

			<div class="col-md-12">
				<?php $options = array(0 => 'Currículums', 1 => 'Empresas', 2 => 'Ofertas y vacantes', 3 => 'Contratación y seguimiento'); ?>
				<?= $this->Form->input('tipo_informe', ['type'=>'select','options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'', 'empty' => 'Selecciona un tipo de reporte','onChange' => 'checkStatus()']); ?>
			</div>
		  
		    <div id="contentStatusId" style="display: none" class="col-md-6">
				<?php $options = array(1 => 'Activo', 0 => 'Inactivo'); ?>
				<?= $this->Form->input('status_informe', ['type'=>'select','options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'', 'empty'=>'Estatus']); ?>
			</div>

			<div id="columnasCurriculumId" style="display: none" class="col-md-6">
				<?php $options = array(0 => 'Descarga completa', 1 => 'Datos personales', 2 => 'Objetivo profesional', 3 => 'Competencias profesionales', 4 => 'Expectativa laboral', 5 => 'Nivel académico y formación académica', 6 => 'Movilidad estudiantil', 7 => 'Experiencia profesional', 8 => 'Proyectos extracurriculares', 9 => 'Idiomas', 10 => 'Computo', 11 => 'Conocimientos y habilidades profesionales'); ?>
				<?= $this->Form->input('columnas_curriculum', ['type'=>'select','options' => $options,'multiple' => 'multiple','data-selected-text-format' => 'count > 4','class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'', 'data-header'=>'Seleccione las columnas de descarga','multiple data-actions-box'=>'true']); ?>
			</div>
			
			<div id="columnasOfertaId" style="display: none" class="col-md-6">
				<?php $options = array(0 => 'Responsable de oferta', 1 => 'Perfil de la oferta', 2 => 'Modalidad de contratación', 3 => 'Competencias profesionales', 4 => 'Conocimientos y habilidades profesionales', 5 => 'Nivel académico y formación académica', 6 => 'Idiomas estudiantil', 7 => 'Computo'); ?>
				<?= $this->Form->input('columnas_oferta', ['type'=>'select','options' => $options,'multiple' => 'multiple','data-selected-text-format' => 'count > 4','class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'', 'data-header'=>'Seleccione las columnas de descarga','multiple data-actions-box'=>'true']); ?>
			</div>		
			
			<div id="columnasEmpresaId" style="display: none" class="col-md-6"> 
				<?php $options = array(0 => 'Datos institucionales', 1 => 'Domicilio fiscal', 2 => 'Domicilio Sede', 3 => 'Datos del contacto', 4 => 'Acceso', 5 => 'Lineamento de publicación'); ?>
				<?= $this->Form->input('columnas_empresa', ['type'=>'select','options' => $options,'multiple' => 'multiple','data-selected-text-format' => 'count > 4','class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'', 'data-header'=>'Seleccione las columnas de descarga','multiple data-actions-box'=>'true']); ?>
			</div>	
			
			<div id="columnasSeguimientoId" style="display: none" class="col-md-6">
				<?php $options = array(0 => 'Descarga completa', 1 => 'Datos personales', 2 => 'Objetivo profesional', 3 => 'Competencias profesionales', 4 => 'Expectativa laboral', 5 => 'Nivel académico y formación académica', 6 => 'Movilidad estudiantil', 7 => 'Experiencia profesional', 8 => 'Proyectos extracurriculares', 9 => 'Idiomas', 10 => 'Computo', 11 => 'Conocimientos y habilidades profesionales'); ?>
				<?= $this->Form->input('columnas_seguimiento', ['type'=>'select','options' => $options,'multiple' => 'multiple','data-selected-text-format' => 'count > 4','class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'', 'data-header'=>'Seleccione las columnas de descarga','multiple data-actions-box'=>'true']); ?>
			</div>	

			<div class="col-md-2 " style="margin-bottom:15px; ">
				<?= $this->Form->button('Descargar &nbsp;<i class="fa fa-file-excel-o" aria-hidden="true"></i>',['type'=>'submit','class' => 'btn btn-default','escape' => false,'style' => 'width:120px;']);?>
				<?= $this->Form->end(); ?>
			</div>	

		</fieldset>
	</div>