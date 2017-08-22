<?php 
	$this->layout = 'student'; 
?>
<script>
	$(document).ready(function() {
		//Agrega opciones dependiendo del la situación académica
		$('#StudentProfessionalProfileAcademicSituationId option').remove();
		$('#StudentProfessionalProfileAcademicSituationId').append(new Option('Situación académica', ''));
		$('#StudentProfessionalProfileAcademicSituationId').append(new Option('Estudiante', '1'));
		$('#StudentProfessionalProfileAcademicSituationId').append(new Option('Egresado', '2'));
			
		<?php if($this->Session->read('tipoProfessionalProfile') == 1): ?>
			$('#StudentProfessionalProfileAcademicSituationId').append(new Option('Titulado', '3'));
		<?php else: 
				if($this->Session->read('tipoProfessionalProfile') == 2):
		?>
			$('#StudentProfessionalProfileAcademicSituationId').append(new Option('Con diploma', '4'));
		<?php 	else: ?>
			$('#StudentProfessionalProfileAcademicSituationId').append(new Option('Con grado', '5'));
		<?php 	endif; 
			endif;
		?>

		$('#StudentProfessionalProfileAcademicSituationId option:eq('+<?php echo $this->request->data['StudentProfessionalProfile']['academic_situation_id'] ?>+')').prop('selected', true);
		<?php if($this->request->data['StudentProfessionalProfile']['academic_situation_id']==1): ?>	
			$('#StudentProfessionalProfileSemester option:eq('+<?php echo $this->request->data['StudentProfessionalProfile']['semester'] ?>+')').prop('selected', true);
		<?php endif; ?>
	
		<?php 
				if($this->request->data['StudentProfessionalProfile']['mobility_start_date']==null): 
		?>
					$('#StudentProfessionalProfileMobilityStartDateYear').prepend('<option value="" selected>AAAA</option>');
					$('#StudentProfessionalProfileMobilityStartDateMonth').prepend('<option value="" selected>MM</option>');
					$('#StudentProfessionalProfileMobilityStartDateDay').prepend('<option value="" selected>DD</option>');
		<?php 	
				else:
		?>
					$('#StudentProfessionalProfileMobilityStartDateYear').prepend('<option value="">AAAA</option>');
					$('#StudentProfessionalProfileMobilityStartDateMonth').prepend('<option value="">MM</option>');
					$('#StudentProfessionalProfileMobilityStartDateDay').prepend('<option value="">DD</option>');
		<?php 	
				endif;
		?>
		
		<?php 
				if($this->request->data['StudentProfessionalProfile']['mobility_end_date']==null): 
		?>
					$('#StudentProfessionalProfileMobilityEndDateYear').prepend('<option value="" selected>AAAA</option>');
					$('#StudentProfessionalProfileMobilityEndDateMonth').prepend('<option value="" selected>MM</option>');
					$('#StudentProfessionalProfileMobilityEndDateDay').prepend('<option value="" selected>DD</option>');
		
		<?php 	
				else:
		?>
					$('#StudentProfessionalProfileMobilityEndDateYear').prepend('<option value="">AAAA</option>');
					$('#StudentProfessionalProfileMobilityEndDateMonth').prepend('<option value="">MM</option>');
					$('#StudentProfessionalProfileMobilityEndDateDay').prepend('<option value="">DD</option>');
		<?php 	
				endif;
		?>
		
		institucionUnam();
		academicSituation();
		desabilityMobility();
		desabilityScholarship();
		resetFechaTermino();
		desabilityMobilityCity();
		$('.selectpicker').selectpicker('refresh');
	});	

	function institucionUnam(){
		
		if ($('#StudentProfessionalProfileUnamStudent').val() == 's'){
			$("#bloque1").show();
			$('#StudentProfessionalProfileAnotherUndergraduateInstitution').val('');
			$('#StudentProfessionalProfileAnotherCareer').val('');
			$("#StudentProfessionalProfileAnotherUndergraduateInstitution").prop( "disabled", true );
			$("#StudentProfessionalProfileUndergraduateInstitution").prop( "disabled", false );
			$("#StudentProfessionalProfileAnotherCareer").prop( "disabled", true );
			$("#divInstitucionId").hide();
			$("#divAreaId").hide();
			$("#divFacultadId").show();
			$("#divEscuelaId").show();
			$("#divCarreraId").hide();
			$("#divCarreraEquivalente").show();
			$("#divAreaEquivalente").show();
			
			var pathname = $(location).attr('href');
			var nombres = pathname.split("/");
			
			if(nombres[nombres.length-1] == 2){
				var programa = 'Programa para especialidad';				
			} else if(nombres[nombres.length-1] == 3){
				var programa = 'Programa para maestría';
			} else if(nombres[nombres.length-1] == 4){
				var programa = 'Programa para doctorado';
			} else{
				var programa = 'Programa';
			}
			
			$("#StudentProfessionalProfilePosgradoProgramId option:eq(0)").text(programa);
			$("#idCarrera1 option:eq(0)").text("Carrera");
			$('.selectpicker').selectpicker('refresh');
			
		} else if (document.getElementById("StudentProfessionalProfileUnamStudent").value == 'n'){
			document.getElementById('StudentProfessionalProfileUndergraduateInstitution').options[0].selected = 'selected';
			$("#bloque1").show();
			$("#StudentProfessionalProfileAnotherUndergraduateInstitution").prop( "disabled", false );
			$("#StudentProfessionalProfileUndergraduateInstitution").prop( "disabled", true );
			$("#StudentProfessionalProfileAnotherCareer").prop( "disabled", false );
			$("#divInstitucionId").show();
			$("#divAreaId").show();
			$("#divFacultadId").hide();
			$("#divEscuelaId").hide();
			$("#divCarreraId").show();
			$("#StudentProfessionalProfilePosgradoProgramId option:eq(0)").text("Programa equivalente en la UNAM");
			$("#idCarrera1 option:eq()").text("Carrera equivalente en la UNAM");
			$("#divCarreraEquivalente").hide();
			$("#divAreaEquivalente").hide();
			$('.selectpicker').selectpicker('refresh');
		} else {
			$("#bloque1").hide();
		}
	}
	
	function promedio(){
		var promedio = $('#StudentProfessionalProfileAverageId').val();
		if(promedio == 1){
			document.getElementById('StudentProfessionalProfileDecimalAverageId').options[10].selected = 'selected';
			$('.selectpicker').selectpicker('refresh');
		}
	}
	
	function resetFechaTermino(){
		if($('#StudentProfessionalProfileCurrent').val() == 's'){
			document.getElementById('StudentProfessionalProfileMobilityEndDateYear').options[0].selected = 'selected';
			document.getElementById('StudentProfessionalProfileMobilityEndDateMonth').options[0].selected = 'selected';
			document.getElementById('StudentProfessionalProfileMobilityEndDateDay').options[0].selected = 'selected';
			$('.selectpicker').selectpicker('refresh');
		}
	}
	
	function academicSituation(){
		var disabilityValue = $('#StudentProfessionalProfileAcademicSituationId').val();

		if (disabilityValue != 1){
			$('#divSemestre').hide();
			$('#divYearEgreso').show();
			document.getElementById('StudentProfessionalProfileSemester').options[0].selected = 'selected';
		} else {
			$('#divSemestre').show();
			$('#divYearEgreso').hide();
		}
		
		if((disabilityValue == 1) || (disabilityValue == "") ){
			document.getElementById('StudentProfessionalProfileEgressYearDegreeYear').options[0].selected = 'selected';
		}
		$('.selectpicker').selectpicker('refresh');
	}
	
	function desabilityMobility(){
		if($("#StudentProfessionalProfileStudentMobility").val() == 's'){
			$('#bloque2').show();
		} else {		
			$('#bloque2').hide();
		}
	}
	
	function desabilityMobilityCity(){
		var pais = $( "#StudentProfessionalProfileStudentMobilityCity option:selected" ).text();
		
		if(($("#StudentProfessionalProfileStudentMobility").val() == "n") || ($("#StudentProfessionalProfileStudentMobility").val() == "")){
			document.getElementById('StudentProfessionalProfileStudentMobilityCity').options[0].selected = 'selected';
			document.getElementById('StudentProfessionalProfileStudentMobilityState').options[0].selected = 'selected';
		}
		
		if(pais == "México"){
			$("#divEstado").show();
		} else{
			$("#divEstado").hide();
			document.getElementById('StudentProfessionalProfileStudentMobilityState').options[0].selected = 'selected';
		}
		$('.selectpicker').selectpicker('refresh');
	}
	
	function desabilityScholarship(){
		if($("#StudentProfessionalProfileScholarship").val() != 's'){
			document.getElementById('StudentProfessionalProfileScholarshipProgram').options[0].selected = 'selected';
			$('#bloque3').hide();
		} else {
			$('#bloque3').show();
		}
		$('.selectpicker').selectpicker('refresh');
	}
	
	function alerta(mensaje){
		$.alert({ title: '!Aviso!',type: 'red',content: mensaje});
	}

	function validateInputs(){
        var unamStudent = $("#StudentProfessionalProfileUnamStudent").val();  
        var value3 = $("#StudentProfessionalProfileStudentMobility").val();  
		var value4 = $("#StudentProfessionalProfileScholarship").val(); 
		var actual = $("#StudentProfessionalProfileCurrent").val();
		
		var value2 = $('#StudentProfessionalProfileAcademicSituationId').val();
		var value5 = $('#StudentProfessionalProfileEntranceYearDegreeYear').val();
		var value6 = $('#StudentProfessionalProfileEgressYearDegreeYear').val();
		
		var yearInicio = $('#StudentProfessionalProfileMobilityStartDateYear').val();
		var mesInicio = $('#StudentProfessionalProfileMobilityStartDateMonth').val();
		var diaInicio = $('#StudentProfessionalProfileMobilityStartDateDay').val();
		
		var yearTermino = $('#StudentProfessionalProfileMobilityEndDateYear').val();
		var mesTermino = $('#StudentProfessionalProfileMobilityEndDateMonth').val();
		var diaTermino = $('#StudentProfessionalProfileMobilityEndDateDay').val();

		if ((unamStudent == 's') && ($('#StudentProfessionalProfileUndergraduateInstitution').val() == '')){
			alerta('Seleccione la escuela / facultad.');
			return false;
		} else 
		if ((unamStudent == 's') && ($('#idCarrera1').val() == '')){
			alerta('Seleccione la carrera.');
			return false;
		} else
		if ((unamStudent == 'n') && ($('#StudentProfessionalProfileAnotherUndergraduateInstitution').val() == '')){
			alerta('Ingrese el nombre de la institución.');
			return false;
		} else 
		if ((unamStudent == 'n') && ($('#StudentProfessionalProfileAnotherCareer').val() == '')){
			alerta('Ingrese el nombre de la carrera / área.');
			return false;
		} else 
		if ((value2 == '1') && ($('#StudentProfessionalProfileSemester').val() == '')){
			alerta('Ingrese el semestre en el que se encuentra.');
			return false;
		} else 
		if (value5 == ''){
			alerta('Seleccione el año de ingreso.');
			return false;
		} else 
		if (((value2 != '1') && (value2 != "")) && (value6 == '')){
			alerta('Seleccione el año de egreso.');
			return false;
		} else
		if (((value2 != "1") && (value2 != "")) && (value5 > value6)){
			alerta('El año de egreso no puede ser menor al año de ingreso.');
			return false;
		} else 
		if ((value3 == 's') && ($('#StudentProfessionalProfileStudentMobilityInstitution').val() == '')){
			alerta('Ingrese la institución.');
			return false;
		} else 
		if ((value3 == 's') && ($('#StudentProfessionalProfileStudentMobilityProgram').val() == '')){
			alerta('Ingrese el nombre del programa / Proyecto.');
			return false;
		} else 
		if ((value3 == 's') && ((yearInicio=='') || (mesInicio=='') || (diaInicio==''))){
			alerta('Seleccione la fecha completa de inicio de la movilidad estudiantil');
			return false;
		} else 
		if ((value3 == 's') && (((yearTermino=='') || (mesTermino=='') || (diaTermino=='')) && (actual==''))){
			alerta('Seleccione la fecha de término de movilidad estudiantil o especifique si es actual');;
			return false;
		} else 
		if ((value3 == 's') && (actual == 'n') && (((yearTermino<=yearInicio) && (mesTermino<=mesInicio)) || (yearTermino<yearInicio ))){
			alerta('La fecha de inicio debe ser menor a la de término');
			return false;
		} else 
		if ((value3 == 's') && ($('#StudentProfessionalProfileStudentMobilityCity').val() == '')){
			alerta('Seleccione el país de la movilidad estudiantil');
			return false;
		} else 
		if ((value3 == 's') && ($('#StudentProfessionalProfileStudentMobilityCity').val() == '117')  && ($('#StudentProfessionalProfileStudentMobilityState').val() == '')){
			alerta('Seleccione el estado');
			return false;
		} else  
		if ((value4 == 's') && ($('#StudentProfessionalProfileScholarshipProgram').val() == '')){
			alerta('Seleccione su programa de beca');
			return false;
		} else{
		if (value3 == 'n'){
				$('#StudentProfessionalProfileStudentMobilityInstitution').val('');
				$('#StudentProfessionalProfileStudentMobilityProgram').val('');
				document.getElementById('StudentProfessionalProfileMobilityStartDateYear').options[0].selected = 'selected';
				document.getElementById('StudentProfessionalProfileMobilityStartDateMonth').options[0].selected = 'selected';
				document.getElementById('StudentProfessionalProfileMobilityEndDateYear').options[0].selected = 'selected';
				document.getElementById('StudentProfessionalProfileMobilityEndDateMonth').options[0].selected = 'selected';
				document.getElementById('StudentProfessionalProfileStudentMobilityCity').options[0].selected = 'selected';
				document.getElementById('StudentProfessionalProfileStudentMobilityState').options[0].selected = 'selected';
				document.getElementById('StudentProfessionalProfileCurrent').options[0].selected = 'selected';
				$("#divEstado").hide();
		}
		if (value4 == 'n'){
			document.getElementById('StudentProfessionalProfileScholarshipProgram').options[0].selected = 'selected';
		}

		$('.selectpicker').selectpicker('refresh');
		return true;

		}			
	}

</script>

	<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
        <p style="color: #588BAD">Editando...</p>
    </blockquote>

	<div class="col-md-12">	
		<?= $this->Form->create('Student', [
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
								'action' => 'editStudentProfessionalProfile',
								'onsubmit' =>'return validateInputs();']); ?>
					
		<fieldset>

			<div class="col-md-6">	
				
				<?= $this->Form->input('StudentProfessionalProfile.id',['type' => 'hidden']); ?>

				<?= $this->Form->input('StudentProfessionalProfile.academic_level_id', ['type' => 'hidden','value' => $this->Session->read('tipoProfessionalProfile')]); ?>	
				
				<?php $options = array('s' => 'Si', 'n' => 'No');
					echo $this->Form->input('StudentProfessionalProfile.unam_student', ['type' => 'select','default'=> 0,'empty' => '¿Institución UNAM?','options' => $options,'onchange' => 'institucionUnam()','class' => 'selectpicker show-tick form-control show-menu-arrow']);
				?>

				<div id="bloque1" style="display:none">	
					<?php if(($this->Session->read('tipoProfessionalProfile') == 1)): ?>

						<div id="divEscuelaId">
							<div class="asterisk">*</div>
							<?= $this->Form->input('StudentProfessionalProfile.undergraduate_institution', ['type'=>'select','options' => $Escuelas,'class' => 'selectpicker show-tick form-control show-menu-arrow required','default'=>'0', 'empty' => 'Escuela / Facultad']); ?>
						</div>

					<?php else: ?> 
						
						<div id="divFacultadId">
							<div class="asterisk">*</div>
							<?= $this->Form->input('StudentProfessionalProfile.undergraduate_institution', ['type'=>'select','options' => $Facultades,'class' => 'selectpicker show-tick form-control show-menu-arrow required','default'=>'0', 'empty' => 'Escuela / Facultad']); ?>
						</div>

					<?php endif; ?> 
					
					<div id="divInstitucionId">
						<div class="asterisk">*</div>
						<?= $this->Form->input('StudentProfessionalProfile.another_undergraduate_institution', ['placeholder' => 'Institución']); ?>
					</div>
					
					<?php if(($this->Session->read('tipoProfessionalProfile') == 1)): ?>
						
						<div id="divCarreraId">
							<div class="asterisk">*</div>
							<?= $this->Form->input('StudentProfessionalProfile.another_career', ['placeholder' => 'Carrera']); ?>
						</div>

						<div id="divCarreraEquivalente">
							<div class="asterisk">*</div>
							<?= $this->Form->input('StudentProfessionalProfile.career_id', ['type'=>'select','id' => 'idCarrera1','class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0','data-live-search' => 'true','empty' => 'Carrera']); ?>
						</div>

					<?php else: ?>
						
						<div id="divAreaId">
							<div class="asterisk">*</div>
							<?= $this->Form->input('StudentProfessionalProfile.another_career', ['placeholder' => 'Programa']); ?>
						</div>
						
						<div id="divAreaEquivalente">
							<div class="asterisk">*</div>
							<?= $this->Form->input('StudentProfessionalProfile.posgrado_program_id', ['type'=>'select','class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0','data-live-search' => 'true','empty' => 'Programa']); ?>
						</div>

					<?php endif; ?> 
					
					<?= $this->Form->input('StudentProfessionalProfile.academic_situation_id', ['type'=>'select','options' => $SituacionesAcademicas,'onchange' => 'academicSituation()','class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Situación académica']); ?>

					<div id="divSemestre">
						<div class="asterisk">*</div>
						<?= $this->Form->input('StudentProfessionalProfile.semester', ['type'=>'select','options' => $Semestres,'onchange' => 'academicSituation()','class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Semestre']); ?>
					</div>

					<?= $this->Form->input('StudentProfessionalProfile.entrance_year_degree', [
								'class' => 'selectpicker show-tick form-control show-menu-arrow',
								'data-live-search' => 'true',
								'dateFormat' => 'Y',
								'separator' => '',
								'minYear' => date('Y') - 200,
								'maxYear' => date('Y') - 0,
								'empty' => 'Año de ingreso']); ?>

					<div id="divYearEgreso">
						<div class="asterisk">*</div>
						<?= $this->Form->input('StudentProfessionalProfile.egress_year_degree', [
								'class' => 'selectpicker show-tick form-control show-menu-arrow',
								'data-live-search' => 'true',
								'dateFormat' => 'Y',
								'separator' => '',
								'minYear' => date('Y') - 200,
								'maxYear' => date('Y') - 0,
								'empty' => 'Año de egreso']); ?>
					</div>

					<?= $this->Form->input('StudentProfessionalProfile.average_id', ['type'=>'select','options' => $Promedios,'onchange' => 'promedio()','class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Promedio']); ?>

					<?= $this->Form->input('StudentProfessionalProfile.decimal_average_id', ['type'=>'select','options' => $Decimales,'onchange' => 'promedio()','class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Decimal']); ?>

				</div>
			</div>

			<div class="col-md-6">	

				<?php $options = array('s' => 'Si', 'n' => 'No');
					echo $this->Form->input('StudentProfessionalProfile.student_mobility', ['type' => 'select','default'=> 0,'empty' => '¿Movilidad estudiantil?','options' => $options,'onchange' => 'desabilityMobility()','class' => 'selectpicker show-tick form-control show-menu-arrow']);
				?>

				<div id="bloque2" style="display:none">
					<div class="asterisk">*</div>
					<?= $this->Form->input('StudentProfessionalProfile.student_mobility_institution', ['placeholder' => 'Institución']); ?>

					<div class="asterisk">*</div>
					<?= $this->Form->input('StudentProfessionalProfile.student_mobility_program', ['placeholder' => 'Nombre del programa / Proyecto']); ?>

					<div class="asterisk">*</div>
					<label style="font-weight: normal;margin-top: 3px;">Fecha de inicio</label>
					<?= $this->Form->input('StudentProfessionalProfile.mobility_start_date', [
											'class' => 'selectpicker show-tick form-control show-menu-arrow',
											'data-width'=> '160px',
											'dateFormat' => 'YMD',
											'separator' => '',
											'minYear' => date('Y') - 200,
											'maxYear' => date('Y') - 0]); ?>

					<div class="asterisk">*</div>
					<label style="font-weight: normal;margin-top: 3px;">Fecha de término</label>
					<?= $this->Form->input('StudentProfessionalProfile.mobility_end_date', [
											'class' => 'selectpicker show-tick form-control show-menu-arrow',
											'data-width'=> '160px',
											'dateFormat' => 'YMD',
											'separator' => '',
											'minYear' => date('Y') - 200,
											'maxYear' => date('Y') - 0,
											'onChange' => 'resetFechaTermino();']); ?>

					<div class="asterisk">*</div>
					<?php $options = array('s' => 'Si', 'n' => 'No');
						echo $this->Form->input('StudentProfessionalProfile.current', ['type' => 'select','default'=> 0,'empty' => '¿Fecha actual de movilidad estudiantil?','options' => $options,'onchange' => 'resetFechaTermino()','class' => 'selectpicker show-tick form-control show-menu-arrow']);
					?>

					<div class="asterisk">*</div>
					<?= $this->Form->input('StudentProfessionalProfile.student_mobility_city', ['type'=>'select','options' => $Paises,'data-live-search' => 'true','onchange' => 'desabilityMobilityCity()','class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'País']); ?>

					<div id="divEstado">
						<div class="asterisk">*</div>
						<?= $this->Form->input('StudentProfessionalProfile.student_mobility_state', ['type'=>'select','options' => $Estados,'data-live-search' => 'true','class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Entidad Federativa / Estado']); ?>
					</div>
				</div>

				<?php $options = array('s' => 'Si', 'n' => 'No');
					echo $this->Form->input('StudentProfessionalProfile.scholarship', ['type' => 'select','default'=> 0,'empty' => '¿Contó con beca durante sus estudios?','options' => $options,'onchange' => 'desabilityScholarship()','class' => 'selectpicker show-tick form-control show-menu-arrow']);
				?>

				<div id="bloque3" style="display:none">
					<div class="asterisk">*</div>
					<?= $this->Form->input('StudentProfessionalProfile.scholarship_program', ['type'=>'select','options' => $ProgramasBeca,'data-live-search' => 'true','onchange' => 'desabilityScholarship()','class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Programa de beca']); ?>
				</div>
			</div>
		</fieldset>
	</div>

	<div class="col-md-12 text-center">
		<?= $this->Form->button('<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
		<?= $this->Form->end(); ?>
	</div>		

	<?= $this->element('scriptEscuelasCarrerasEdit'); ?>
	<?= $this->element('scriptEscuelasCarreras'); ?>