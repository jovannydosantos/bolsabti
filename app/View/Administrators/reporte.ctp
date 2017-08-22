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
			var columnasSeguimiento = $('#AdministratorColumnasSeguimiento > option:selected');
			
				var year1  = $( "#AdministratorProfileStartDateExpirationInformeYear" ).val();
				var month1 = $( "#AdministratorProfileStartDateExpirationInformeMonth" ).val();
				var day1   = $( "#AdministratorProfileStartDateExpirationInformeDay" ).val();
				
				var year2  = $( "#AdministratorProfileEndDateExpirationInformeYear" ).val();
				var month2 = $( "#AdministratorProfileEndDateExpirationInformeMonth" ).val();
				var day2   = $( "#AdministratorProfileEndDateExpirationInformeDay" ).val();
				
				if((year1 == '') || (month1 == '') || (day1 == '') || (year2 == '') || (month2 == '') || (day2 == '')){
					jAlert('Seleccione las fechas completas para la búsqueda de coincidencias', 'Mensaje');
					document.getElementById('AdministratorProfileStartDateExpirationInformeYear').focus();
					return false;
				} else if(vigenciaFecha1 == false){
					jAlert('La fecha inicio de reporte es incorrecta', 'Mensaje');
					document.getElementById('AdministratorProfileStartDateExpirationInformeDay').focus();
					return false;
				} else if(vigenciaFecha2 == false){
					jAlert('La fecha fin de reporte es incorrecta', 'Mensaje');
					document.getElementById('AdministratorProfileEndDateExpirationInformeDay').focus();
					return false;
				} else if(resultadoComparativa==1){
					jAlert('La fecha inicio de reporte debe ser menor a la final', 'Mensaje');
					document.getElementById('AdministratorProfileStartDateExpirationInformeDay').focus();
					return false;
				}else if(seleccionado == 0){
					jAlert('Seleccione un tipo de reporte', 'Mensaje');
					document.getElementById('AdministratorTipoInforme').focus();
					return false;
				}else if(seleccionadoEstatus == 0){ 
					jAlert('Seleccione el estatus', 'Mensaje');
					document.getElementById('AdministratorTipoInforme').focus();
					return false;
				}else if((seleccionado == 1) && (columnasCurriculum.length == 0)){
					jAlert('Seleccione las columnas de descarga', 'Mensaje');
					document.getElementById('AdministratorTipoInforme').focus();
					return false;
				}else if((seleccionado == 2) && (columnasEmpresa.length == 0)){
					jAlert('Seleccione las columnas de descarga', 'Mensaje');
					document.getElementById('AdministratorTipoInforme').focus();
					return false;
				}else if((seleccionado == 3) && (columnasOferta.length == 0)){
					jAlert('Seleccione las columnas de descarga', 'Mensaje');
					document.getElementById('AdministratorTipoInforme').focus();
					return false;
				}else if((seleccionado == 4) && (columnasSeguimiento.length == 0)){
					jAlert('Seleccione las columnas de descarga', 'Mensaje');
					document.getElementById('AdministratorTipoInforme').focus();
					return false;
				}else{
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
	<?php echo $this->Session->flash(); ?>
		
		<?php	echo $this->Form->create('Administrator', array(
						'id' => 'formReport',
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
						'action' => '',
						'onsubmit' =>'return validateDates();'
		)); ?>		
		
		<fieldset>
			<center>
			<div class="col-md-8 col-md-offset-2" style="margin-top: 30px;">
				
				<div  class="col-md-6"  style="font-weight: bold;" >
				   <p> Fecha inicio de reporte</p>
				</div>
				<div  class="col-md-6" style="font-weight: bold; left: -20px;" >
				   <p>Fecha fin de reporte</p>
				</div>
				<div class="col-md-11" style="text-align: center; font-weight: bold; height: 0px; margin-left: 15px;" >
				   <p> a </p>
				</div>
				<div class="col-md-6" style="padding-left: 0px;" >
					
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
																'before' => '<div class="col-md-11" style="padding-left: 0px; padding-right: 0px;">',
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
				   <p> Tipos de reportes</p>
				</div>

				<?php  
					$options = array(0 => 'Currículums', 1 => 'Empresas', 2 => 'Ofertas y vacantes', 3 => 'Contratación y seguimiento');
					// $options = array(0 => 'Currículums', 1 => 'Empresas', 2 => 'Ofertas y vacantes');
					echo $this->Form->input('tipo_informe', array(
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
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
				 <div class="col-md-11" style="font-weight: bold;" id="leyendaId" >
				   <p> Seleccione los campos de descarga</p>
				</div>
				
				<div id="columnasCurriculumId" style="display: none">
				<?php 
					$columnas = array(0 => 'Descarga completa', 1 => 'Datos personales', 2 => 'Objetivo profesional', 3 => 'Competencias profesionales', 4 => 'Expectativa laboral', 5 => 'Nivel académico y formación académica', 6 => 'Movilidad estudiantil', 7 => 'Experiencia profesional', 8 => 'Proyectos extracurriculares', 9 => 'Idiomas', 10 => 'Computo', 11 => 'Conocimientos y habilidades profesionales');
					echo $this->Form->input('columnas_curriculum', array(
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'before' => '<div class="col-md-12" style="padding-right: 5px; padding-left: 30px;">',
																'multiple' => 'multiple',
																'data-selected-text-format' => 'count > 4',
																'data-actions-box' => 'true',
																'label' => '',
																'div' => array('class' => 'form-group', 'style'=> 'margin-bottom: 3px;'),
																'options' => $columnas,
																	)
												);
				?>
				</div>
				
				<div id="columnasOfertaId" style="display: none">
				<?php 
					$columnas = array(0 => 'Responsable de oferta', 1 => 'Perfil de la oferta', 2 => 'Modalidad de contratación', 3 => 'Competencias profesionales', 4 => 'Conocimientos y habilidades profesionales', 5 => 'Nivel académico y formación académica', 6 => 'Idiomas estudiantil', 7 => 'Computo');
					echo $this->Form->input('columnas_oferta', array(
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'before' => '<div class="col-md-12" style="padding-right: 5px; padding-left: 30px;">',
																'multiple' => 'multiple',
																'data-selected-text-format' => 'count > 4',
																'data-actions-box' => 'true',
																'label' => '',
																'div' => array('class' => 'form-group', 'style'=> 'margin-bottom: 3px;'),
																'options' => $columnas,
																	)
												);
				?>
				</div>		
				
				<div id="columnasEmpresaId" style="display: none">
				<?php 
					$columnas = array(0 => 'Datos institucionales', 1 => 'Domicilio fiscal', 2 => 'Domicilio Sede', 3 => 'Datos del contacto', 4 => 'Acceso', 5 => 'Lineamento de publicación');
					echo $this->Form->input('columnas_empresa', array(
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'before' => '<div class="col-md-12" style="padding-right: 5px; padding-left: 30px;">',
																'multiple' => 'multiple',
																'data-selected-text-format' => 'count > 4',
																'data-actions-box' => 'true',
																'label' => '',
																'div' => array('class' => 'form-group', 'style'=> 'margin-bottom: 3px;'),
																'options' => $columnas,
																	)
												);
				?>
				</div>	
				
				<div id="columnasSeguimientoId" style="display: none">
				<?php 
					$columnas = array(0 => 'Descarga completa', 1 => 'Datos personales', 2 => 'Objetivo profesional', 3 => 'Competencias profesionales', 4 => 'Expectativa laboral', 5 => 'Nivel académico y formación académica', 6 => 'Movilidad estudiantil', 7 => 'Experiencia profesional', 8 => 'Proyectos extracurriculares', 9 => 'Idiomas', 10 => 'Computo', 11 => 'Conocimientos y habilidades profesionales');
					echo $this->Form->input('columnas_seguimiento', array(
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'before' => '<div class="col-md-12" style="padding-right: 5px; padding-left: 30px;">',
																'multiple' => 'multiple',
																'data-selected-text-format' => 'count > 4',
																'data-actions-box' => 'true',
																'label' => '',
																'div' => array('class' => 'form-group', 'style'=> 'margin-bottom: 3px;'),
																'options' => $columnas,
																	)
												);
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

