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
			var year1  = $( "#AdministratorProfileStartDateExpirationInformeYear" ).val();
			var month1 = $( "#AdministratorProfileStartDateExpirationInformeMonth" ).val();
			var day1   = $( "#AdministratorProfileStartDateExpirationInformeDay" ).val();
				
			var year2  = $( "#AdministratorProfileEndDateExpirationInformeYear" ).val();
			var month2 = $( "#AdministratorProfileEndDateExpirationInformeMonth" ).val();
			var day2   = $( "#AdministratorProfileEndDateExpirationInformeDay" ).val();
			
			var fecha1 = document.getElementById('AdministratorProfileStartDateExpirationInformeDay').value	+ "/" +
						document.getElementById('AdministratorProfileStartDateExpirationInformeMonth').value	+ "/" +
						document.getElementById('AdministratorProfileStartDateExpirationInformeYear').value;
			
			var fecha2 = document.getElementById('AdministratorProfileEndDateExpirationInformeDay').value	+ "/" +
						document.getElementById('AdministratorProfileEndDateExpirationInformeMonth').value	+ "/" +
						document.getElementById('AdministratorProfileEndDateExpirationInformeYear').value;

			var statusFecha = document.getElementById("AdministratorStatusFecha").selectedIndex;
			var tipoInforme = document.getElementById("AdministratorTipoInforme").selectedIndex;
						
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

				if(statusFecha == 0){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Indica como se realizará la descarga ya sea por día, mes o año'});
					return false;
				}else
				if(tipoInforme == 0){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Indique el tipo de informe que solicita'});
					return false;
				}else 				
				if((statusFecha==1) && ((year1 == '') || (month1 == '') || (day1 == '') || (year2 == '') || (month2 == '') || (day2 == ''))){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione las fechas completas para la búsqueda por dias'});
					return false;
				}else
				if((statusFecha==2) && ((year1 == '') || (month1 == '') || (year2 == '') || (month2 == ''))){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione las fechas completas para la búsqueda por meses'});
					return false;
				}else
				if((statusFecha==3) && ((year1 == ''))){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione las fechas completas para la búsqueda por año'});
					return false;
				}
				else if(vigenciaFecha1 == false){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha inicio de informe es incorrecta'});
					return false;
				} else if(vigenciaFecha2 == false){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha fin de informe es incorrecta'});
					return false;
				} else if(resultadoComparativa==1){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha inicio de informe debe ser menor a la final'});
					return false;
				}else {
					return true;
				}
		}
		
		function checkStatus(){ 
			var seleccionado = $("#AdministratorTipoInforme option:selected").index();
			
			if(seleccionado > 0){
				$("#BloqueInformativoId").show();	
			}else{
				$("#BloqueInformativoId").hide();	
			}
			
			$( "#informeSeleccionadoId" ).empty();
			$( "#descripcionInformeId" ).empty();
	
			if(seleccionado == 1){
				$( "#informeSeleccionadoId" ).append('Informe de currículums');	
				$( "#descripcionInformeId" ).append('Descargar el resumen diario de la cantidad de currículums registrados en el sistema por status y su gráfica de comportamiento correspondientes a las fechas seleccionadas para la consulta.');
			}else if(seleccionado == 2){
				$( "#informeSeleccionadoId" ).append('Informe de empresas');	
				$( "#descripcionInformeId" ).append('Descargar el resumen diario de la cantidad de empresas registradas en el sistema por status y su gráfica de comportamiento correspondientes a las fechas seleccionadas para la consulta.');
			}else if(seleccionado == 3){
				$( "#informeSeleccionadoId" ).append('Informe de ofertas');	
				$( "#descripcionInformeId" ).append('Descargar el resumen diario de la cantidad de ofertas registradas en el sistema por status y su gráfica de comportamiento correspondientes a las fechas seleccionadas para la consulta.');
			}else if(seleccionado == 4){
				$( "#informeSeleccionadoId" ).append('Informe de postulaciones');	
				$( "#descripcionInformeId" ).append('Descargar el resumen diario de la cantidad de postulaciones registradas en el sistema por giro y su gráfica de comportamiento correspondientes a las fechas seleccionadas para la consulta.');
			}else if(seleccionado == 5){
				$( "#informeSeleccionadoId" ).append('Informe de entrevistas telefónicas');	
				$( "#descripcionInformeId" ).append('Descargar el resumen diario de la cantidad de entrevistas telefónicas registradas en el sistema y su gráfica de comportamiento correspondientes a las fechas seleccionadas para la consulta.');
			}else if(seleccionado == 6){
				$( "#informeSeleccionadoId" ).append('Informe de entrevistas presenciales');	
				$( "#descripcionInformeId" ).append('Descargar el resumen diario de la cantidad de entrevistas presenciales registradas en el sistema y su gráfica de comportamiento correspondientes a las fechas seleccionadas para la consulta.');
			}else if(seleccionado == 7){
				$( "#informeSeleccionadoId" ).append('Informe de contrataciones');	
				$( "#descripcionInformeId" ).append('Descargar el resumen diario de la cantidad de contrataciones registradas en el sistema y su gráfica de comportamiento correspondientes a las fechas seleccionadas para la consulta.');
			}else if(seleccionado == 8){
				$( "#informeSeleccionadoId" ).append('Informe de universitarios eliminados');	
				$( "#descripcionInformeId" ).append('Descargar el resumen diario de la cantidad de universitarios eliminados en el sistema, los motivos y su gráfica de comportamiento correspondientes a las fechas seleccionadas para la consulta.');
			}else if(seleccionado == 9){
				$( "#informeSeleccionadoId" ).append('Informe de empresas eliminadas');	
				$( "#descripcionInformeId" ).append('Descargar el resumen diario de la cantidad de empresas eliminadas en el sistema, responsables y su gráfica de comportamiento correspondientes a las fechas seleccionadas para la consulta.');
			}else if(seleccionado == 10){
				$( "#informeSeleccionadoId" ).append('Informe de encuestas de salida de universitarios');	
				$( "#descripcionInformeId" ).append('Descargar el resumen diario de la cantidad de encuestas de salida de universitarios registradas en el sistema, los motivos y su gráfica de comportamiento correspondientes a las fechas seleccionadas para la consulta.');
			}else if(seleccionado == 11){
				$( "#informeSeleccionadoId" ).append('Encuestas de salida de empresas');	
				$( "#descripcionInformeId" ).append('Descargar el resumen diario de la cantidad de encuestas de salida de empresas registradas en el sistema, los motivos y su gráfica de comportamiento correspondientes a las fechas seleccionadas para la consulta.');
			}else if(seleccionado == 12){
				$( "#informeSeleccionadoId" ).append('Competencias profesionales');	
				$( "#descripcionInformeId" ).append('Descargar el resumen diario de la cantidad de competencias profesionales registradas en el sistema y su gráfica de comportamiento correspondientes a las fechas seleccionadas para la consulta.');
			}
		}
		
	</script>

	<div class="col-md-10 col-md-offset-1 fondoBti" style="margin-top: 20px;">
		<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 15px;margin-bottom: 5px;">
	        <p style="color: #fff">Buscar informes por rango de fechas.</p>
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
								'action' => 'grafica',
								'onsubmit' => 'return validateDates();']); ?>
			
			<fieldset>
			
			<div class="col-md-5">
				<?php $options = array(1 => 'Día', 2 => 'Mes', 3 => 'Año'); ?>
				<?= $this->Form->input('status_fecha', ['type'=>'select','options' => $options,'selected' => $this->Session->read('tipoBusqueda'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'El informe se descargara por Dias Meses o Año']); ?>
			</div>

			<div class="col-md-5">
				<?php $options = array(0 => 'Currículums', 1 => 'Empresas', 2 => 'Ofertas', 3 => 'Postulaciones', 4 => 'Entrevistas telefónicas', 5 => 'Entrevistas presenciales', 6 => 'Contrataciones', 7 => 'Universitarios eliminados', 8 => 'Empresas eliminadas', 9 => 'Encuestas de salida de universitarios', 10 => 'Encuestas de salida de empresas',11 => 'Competencias profesionales'); ?>
				<?= $this->Form->input('tipo_informe', ['type'=>'select','options' => $options,'selected' => $this->Session->read('tipoBusqueda'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'', 'empty' => 'Seleccione el tipo de informe','onChange' => 'checkStatus()']); ?>
			</div>

			<div class="col-md-5">
				<?= $this->Form->input('AdministratorProfile.start_date_expiration_informe', [
														'type' => 'date',
														'class' => 'selectpicker show-tick form-control show-menu-arrow',
														'data-width'=> '33.333%',
														'dateFormat' => 'YMD',
														'separator' => '',
														'minYear' => date('Y') - 2,
														'maxYear' => date('Y') - 0]); ?>
			</div>
			<div class="col-md-5">
				<?= $this->Form->input('AdministratorProfile.end_date_expiration_informe', [
														'type' => 'date',
														'class' => 'selectpicker show-tick form-control show-menu-arrow',
														'data-width'=> '33.333%',
														'dateFormat' => 'YMD',
														'separator' => '',
														'minYear' => date('Y') - 2,
														'maxYear' => date('Y') - 0]); ?>
			</div>		

			<div id="contentStatusId" style="display: none" class="col-md-12">
				<?php $options = array(1 => 'Activo', 0 => 'Inactivo'); ?>
				<?= $this->Form->input('status_informe', ['type'=>'select','options' => $options,'selected' => $this->Session->read('tipoBusqueda'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Estatus']); ?>
			</div>

			<div class="col-md-1" style="padding-top: 6px;">
				<?= $this->Form->button('Descargar &nbsp;<i class="fa fa-file-excel-o" aria-hidden="true"></i>',['type'=>'submit','class' => 'btn btn-default','escape' => false,'style' => 'width:120px;']);?>
				<?= $this->Form->end(); ?>
			</div>	

		</fieldset>				
	</div>