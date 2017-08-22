	<?php 
		$this->layout = 'administrator'; 
	?>
	<script>
		
		$(document).ready(function() {
			$("#AdministratorProfileStartDateExpirationInformeYear").css("width", "65px");
			$("#AdministratorProfileStartDateExpirationInformeMonth").css("width", "90px");
			$("#AdministratorProfileStartDateExpirationInformeDay").css("width", "60px");
			
			$("#AdministratorProfileEndDateExpirationInformeYear").css("width", "65px");
			$("#AdministratorProfileEndDateExpirationInformeMonth").css("width", "90px");
			$("#AdministratorProfileEndDateExpirationInformeDay").css("width", "60px");
		

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
		 // checkDate();
		 setDates();

		});	

        function checkDate(){
			document.getElementById('AdministratorProfileStartDateExpirationInformeYear').options[0].selected = 'selected';
			document.getElementById('AdministratorProfileStartDateExpirationInformeMonth').options[0].selected = 'selected';
			document.getElementById('AdministratorProfileStartDateExpirationInformeDay').options[0].selected = 'selected';
			
			document.getElementById('AdministratorProfileEndDateExpirationInformeYear').options[0].selected = 'selected';
			document.getElementById('AdministratorProfileEndDateExpirationInformeMonth').options[0].selected = 'selected';
			document.getElementById('AdministratorProfileEndDateExpirationInformeDay').options[0].selected = 'selected';
			
        	var opcionSeleccionada = $("#AdministratorStatusFecha option:selected").index();

			if((opcionSeleccionada == 0) || (opcionSeleccionada == 1)){  
				$("#AdministratorProfileStartDateExpirationInformeDay").show();	
				$("#AdministratorProfileStartDateExpirationInformeMonth").show();

				$("#AdministratorProfileEndDateExpirationInformeDay").show();	
				$("#AdministratorProfileEndDateExpirationInformeMonth").show();
				$("#AdministratorProfileEndDateExpirationInformeYear").show();
				
				$("#IdLabelFin").show();
				$("#IdLabelA").show();
				$("#IdLabelYear").hide();
				$("#IdLabelInicio").show();
			}
			else
			if(opcionSeleccionada == 2){  
				$("#AdministratorProfileStartDateExpirationInformeDay").hide();	
				$("#AdministratorProfileStartDateExpirationInformeMonth").show();
				
				$("#AdministratorProfileEndDateExpirationInformeDay").hide();	
				$("#AdministratorProfileEndDateExpirationInformeMonth").show();
				$("#AdministratorProfileEndDateExpirationInformeYear").show();
				
				$("#IdLabelFin").show();
				$("#IdLabelA").show();
				$("#IdLabelYear").hide();
				$("#IdLabelInicio").show();
			}
			else 
			if(opcionSeleccionada == 3){
				$("#AdministratorProfileStartDateExpirationInformeDay").hide();
				$("#AdministratorProfileStartDateExpirationInformeMonth").hide();

				$("#AdministratorProfileEndDateExpirationInformeDay").hide();
				$("#AdministratorProfileEndDateExpirationInformeMonth").hide();
				$("#AdministratorProfileEndDateExpirationInformeYear").hide();
				
				$("#IdLabelFin").hide();
				$("#IdLabelInicio").hide();
				$("#IdLabelA").hide();
				$("#IdLabelYear").show();
			}
        }

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

				if (dia < 1 || dia > 31) {
					jAlert('El valor del día debe estar comprendido entre 1 y 31.');
				return false;
				}
					if (mes < 1 || mes > 12) { 
						jAlert('El valor del mes debe estar comprendido entre 1 y 12.');
						return false;
					}
						if ((mes==4 || mes==6 || mes==9 || mes==11) && dia==31) {
							jAlert('El mes '+mes+'no tiene 31 días!');
							return false;
						}
					if (mes == 2) { // bisiesto
						var bisiesto = (aho % 4 == 0 && (aho % 100 != 0 || aho % 400 == 0));
						if (dia > 29 || (dia==29 && !bisiesto)) {
							jAlert('Febrero del' + aho + 'no contiene '+ dia + 'dias!');
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
						
			vigenciaFecha1 = validarFecha(fecha1);
			vigenciaFecha2 = validarFecha(fecha2);
			
			// dd/mm/yyyy
			valida1 = day1+'/'+month1+'/'+year1;
			valida2 = day2+'/'+month2+'/'+year2;
			resultadoComparativa=validate_fechaMayorQue(valida1,valida2);
			
			var seleccionado = $("#AdministratorTipoInforme option:selected").index();
			
			var columnasCurriculum = $('#AdministratorColumnasCurriculum > option:selected');
			var columnasEmpresa = $('#AdministratorColumnasEmpresa > option:selected');
			var columnasOferta = $('#AdministratorColumnasOferta > option:selected');

				if(statusFecha == 0){
					jAlert('Indica como se realizará la descarga ya sea por día, mes o año', 'Mensaje');
					document.getElementById('AdministratorStatusFecha').focus();
					return false;
				}else
				if(tipoInforme == 0){
					jAlert('Indique el tipo de informe que solicita', 'Mensaje');
					document.getElementById('AdministratorTipoInforme').focus();
					return false;
				}else 				
				if((statusFecha==1) && ((year1 == '') || (month1 == '') || (day1 == '') || (year2 == '') || (month2 == '') || (day2 == ''))){
					jAlert('Seleccione las fechas completas para la búsqueda por dias', 'Mensaje');
					document.getElementById('AdministratorStatusFecha').focus();
					return false;
				}else
				if((statusFecha==2) && ((year1 == '') || (month1 == '') || (year2 == '') || (month2 == ''))){
					jAlert('Seleccione las fechas completas para la búsqueda por meses', 'Mensaje');
					document.getElementById('AdministratorStatusFecha').focus();
					return false;
				}else
				if((statusFecha==3) && ((year1 == ''))){
					jAlert('Seleccione las fechas completas para la búsqueda por año', 'Mensaje');
					document.getElementById('AdministratorTipoInforme').focus();
					return false;
				}
				else if(vigenciaFecha1 == false){
					jAlert('La fecha inicio de informe es incorrecta', 'Mensaje');
					document.getElementById('AdministratorProfileStartDateExpirationInformeDay').focus();
					return false;
				} else if(vigenciaFecha2 == false){
					jAlert('La fecha fin de informe es incorrecta', 'Mensaje');
					document.getElementById('AdministratorProfileEndDateExpirationInformeDay').focus();
					return false;
				} else if(resultadoComparativa==1){
					jAlert('La fecha inicio de informe debe ser menor a la final', 'Mensaje');
					document.getElementById('AdministratorProfileStartDateExpirationInformeDay').focus();
					return false;
				}else {
					return true;
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
		
		// function checkInputs(){
			
		// }
		
	


	</script>
	<?php echo $this->Session->flash(); ?>
		
		<?php	echo $this->Form->create('Administrator', array(
						'class' => 'form-horizontal', 
						'role' => 'form',
						'inputDefaults' => array(
							'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
							'div' => array('class' => 'form-group'),
							'class' => 'form-control',
							'label' => array('class' => 'col-md-2 control-label '),
							'before' => '<div class="col-md-11 col-md-offset-1">',
							'between' => '<div class="col-md-11">',
							'after' => '</div></div>',
							'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style'=>'padding-left: 5px; padding-right: 5px;'))
						),
						'action' => 'grafica',
						'onsubmit' => 'return validateDates();'
		)); ?>		
		
		<fieldset>
			<center>
			<div class="col-md-8 col-md-offset-2" style="margin-top: 30px;">

			 <div class="col-md-8">
				<?php  
					$options = array(1 => 'Día', 2 => 'Mes', 3 => 'Año');
					echo $this->Form->input('status_fecha', array(
																'type'=>'select',
																'before' => '<div class="col-md-12">',
																'label' => '',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '560px',
																'style' => 'width: 553px; margin-left: -122px;',
																'options' => $options,
																'default'=>'', 'empty' => 'El informe se descargara por Dias Meses o Año',
																// 'onChange' => 'checkDate()',
																));
				?>
				</div>
				
				<div  class="col-md-6"  style="font-weight: bold;"  >
				   <p id="IdLabelInicio"> Fecha inicio de informe</p>
				</div>
				<div  class="col-md-6" style="font-weight: bold;" >
				   <p id="IdLabelFin">Fecha fin de informe</p>
				</div>
				<div class="col-md-11" style="text-align: center; font-weight: bold; height: 0px; margin-left: 15px;" >
				   <p id="IdLabelA"> a </p>
				</div>
				<div class="col-md-6"  style="padding-left: 0px;">
					
					<?php echo $this->Form->input('AdministratorProfile.start_date_expiration_informe', array(
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
																'minYear' => date('Y') - 3,
																'maxYear' => date('Y') - 0,
																'onchange' => 'setDates();',
																'placeholder' => 'Vigencia que aparecerá en la oferta',
																'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
								));
					?>
				</div>
				<div class="col-md-6" style="padding-left: 0px;">
					<?php echo $this->Form->input('AdministratorProfile.end_date_expiration_informe', array(
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
																'minYear' => date('Y') - 3,
																'maxYear' => date('Y') - 0,
																'onchange' => 'setDates();',
																'placeholder' => 'Vigencia que aparecerá en la oferta',
																'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
								)); 
					?>
				</div>	
				<div class="col-md-11" style="font-weight: bold; margin-top: 15px;" >
				   <p> Tipos de informe</p>
				</div>

				<?php  
					$options = array(0 => 'Currículums', 1 => 'Empresas', 2 => 'Ofertas', 3 => 'Postulaciones', 4 => 'Entrevistas telefónicas', 5 => 'Entrevistas presenciales', 6 => 'Contrataciones', 7 => 'Universitarios eliminados', 8 => 'Empresas eliminadas', 9 => 'Encuestas de salida de universitarios', 10 => 'Encuestas de salida de empresas',11 => 'Competencias profesionales');
					echo $this->Form->input('tipo_informe', array(
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-actions-box' => 'true',
																'before' => '<div class="col-md-12" style="padding-right: 5px; padding-left: 30px;">',
																'label' => '',
																'options' => $options,'default'=>'', 'empty' => 'Selecciona un tipo de informe',
																'onChange' => 'checkStatus()',
								));
			   ?>
			   <div id="contentStatusId" style="display: none">
				<?php  
					$options = array(1 => 'Activo', 0 => 'Inactivo');
					echo $this->Form->input('status_informe', array(
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'before' => '<div class="col-md-12" style="padding-right: 5px; padding-left: 30px;">',
																'label' => '',
																'options' => $options,'default'=>'', 'empty' => 'Estatus',
																));
				?>
				</div>
			</div>
			</center>
		</fieldset>
		
			<div style="margin-top: 20px;" class="col-md-3 col-md-offset-4">
					<?php 
						echo $this->Form->button('Descargar excel &nbsp;<i class="glyphicon glyphicon-save"></i>', array(
											'type' => 'submit', 
											'div' => 'form-group',
											'class' => 'btn btnBlue btn-default col-md-offset-4',
											'escape' => false,
						));
						
						echo $this->Form->end(); 
					?>
			</div>
