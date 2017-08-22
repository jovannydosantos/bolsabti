<?php 
	$this->layout = 'student'; 
?>
<script type="text/javascript">
	$(document).ready(function() {
		changeAcademicLevel(0);
		desabilityOptions();		
	});  
	
	var cont = 1;
	var cont2 = 1;
	var cont3 = 1;
	var cont4 = 1;

	function desabilityOptions(){
		if($("#CompanyJobProfileDisability").val()=='s') {  
			$('#tipoDiscapacidadId1').show();
		} else {
			document.getElementById('CompanyJobProfileDisabilityType').options[0].selected = 'selected';
			$('#tipoDiscapacidadId1').hide();
		}
		$('.selectpicker').selectpicker('refresh');
	}
		
</script>
	
	<div class="col-md-4">
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
								'action' => '',
								'onsubmit' =>'addNameSearch(); return false;']); ?>

				<?= $this->Form->button('Guardar Búsqueda &nbsp; <span class="glyphicon glyphicon-floppy-disk"></span> ',['type'=>'submit','class' => 'btn btn-primary col-md-12','escape' => false]);?>
				<?= $this->Form->end(); ?>
		</div>
	</div>	

	<div class="col-md-4">	
		<div class="col-md-12">	
			<?= $this->Form->create('Student', [
									'class' => 'form-horizontal', 
									'id' => 'viewSearchId',
									'role' => 'form',
									'inputDefaults' => [
										'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
										'div' => ['class' => 'form-group','style'=>'margin-bottom: 0px;'],
										'class' => 'form-control',
										'label' => ['text'=>''],
										'between' => '<div class="col-md-12">',
										'after' => '</div>',
										'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
									],
									'action' => 'specificSearchResults']); ?>

			<?= $this->Form->input('busqueda_guardada', ['type'=>'select','options' => $busquedasGuardadas,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Búsquedas guardadas','onchange' => 'viewSearch()']); ?>
			<span style="float: right;">(máx. 10)</span>
			<?= $this->Form->end(); ?>	
		</div>
	</div>	

	<?= $this->Form->create('Student', [
							'class' => 'form-horizontal', 
							'id' => 'requestForm',
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
							'onsubmit' =>'return checkAlInputs();',
							'action' => 'specificSearchResults',]); ?>	

	<div class="col-md-4">	
		<div class="col-md-12">
				<?php $options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200); ?>
				<?= $this->Form->input('limit', ['type'=>'select','options' => $options,'label' => ['text'=>''],'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0','selected' => $this->Session->read('limit'),'empty' => 'Resultados por hoja']); ?> 		
				<?= $this->Form->input('StudentSavedSearch.name', ['type' => 'hidden']); ?>
		</div>
	</div>

	<div class="col-md-6" style="margin-top: 15px">		
		<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
	        <p style="color: #588BAD">Palabras clave.</p>
	    </blockquote>

		<?= $this->Form->input('CompanyJobProfile.job_name', ['placeholder' => 'Palabras clave (60 caracteres máx.)']); ?>
		
		<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
	        <p style="color: #588BAD">Perfil de la oferta.</p>
	    </blockquote>

	    <?= $this->Form->input('CompanyJobContractType.contract_type', ['type'=>'select','options' => $TiposContratos,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Tipo de contrato','required' => false]); ?>
	    <?= $this->Form->input('CompanyJobContractType.workday', ['type'=>'select','options' => $JornadasLaborales,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Jornada laboral','required' => false]); ?>
	    <?= $this->Form->input('CompanyJobContractType.salary', ['type'=>'select','options' => $Salarios,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Sueldo','required' => false]); ?>

		<div id="original" class="clonGiro">
			<?= $this->Form->input('CompanyJobProfileDynamicGiro.0.giro', ['type'=>'select','options' => $Giros,'class' => 'selectpicker show-tick form-control show-menu-arrow clonAreaReindexa','data-live-search' => 'true','default'=>'0', 'empty' => 'Giro de interés','onchange' => 'cargaAreas(0)']); ?>
			<?= $this->Form->input('CompanyJobProfileDynamicArea.0.area_interes', ['type'=>'select','class' => 'selectpicker show-tick form-control show-menu-arrow clonAreaReindexa','data-live-search' => 'true','default'=>'0', 'empty' => 'Áreas de interés']); ?>
		</div>
		<div class="contenedorClonesGiros"></div>
		
		<div style="text-align: right;">
			<span>Agregar otro giro y área (máx. 2)</span>
			<button type="button" class="btn btn-default btn-sm" onclick="clonarGiro();">
	          <span class="glyphicon glyphicon-plus-sign"></span>
	        </button>
		</div>

		<?php 	$options = array('s' => 'Si', 'n' => 'No'); ?>
		<?= $this->Form->input('CompanyJobProfile.disability', ['type'=>'select','options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Oferta incluyente','onchange' => 'desabilityOptions()']); ?>

		<div id="tipoDiscapacidadId1">
			<?= $this->Form->input('CompanyJobProfile.disability_type', ['type'=>'select','options' => $TiposDiscapacidad,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Tipo de discapacidad']); ?>
		</div>

		<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
	        <p style="color: #588BAD">Lugar de trabajo.</p>
	    </blockquote>

	    <?= $this->Form->input('CompanyJobContractType.state', ['type'=>'select','options' => $Estados,'id'=>'estado','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Estado / Entidad federativa']); ?>	
	    <?= $this->Form->input('CompanyJobContractType.subdivision', ['type'=>'select','id' => 'ciudad','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Delegación / Municipio']); ?>	
	    <?php $options = array('s' => 'Si', 'n' => 'No'); ?>
		<?= $this->Form->input('CompanyJobContractType.mobility', ['type'=>'select','options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Disponibilidad para viajar']); ?>
	</div>
					
	<div class="col-md-6" style="margin-top: 15px">	
		<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
	        <p style="color: #588BAD"> Formación académica.</p>
	    </blockquote>

		<div id="original" class="clon">
			<?= $this->Form->input('CompanyCandidateProfileDynamicNivelAcademico.0.academic_level', ['type'=>'select','options' => $NivelesAcademicos,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Nivel académico','onchange' => 'changeAcademicLevel(0);']); ?>	

			<div id="divCarrerasId0" style="display: none">
				<?= $this->Form->input('CompanyJobRelatedCareerDynamicCarrera.0.career_id', ['type'=>'select','options' => $careers,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Carrera']); ?>	
			</div>
			<div id="divAreasId0" style="display: none">
				<?= $this->Form->input('CompanyJobRelatedAreaDynamicArea.0.area_id', ['type'=>'select','options' => $AreasPosgrado,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Área']); ?>
			</div>
				<?= $this->Form->input('CompanyCandidateProfileDynamicSituacionAcademica.0.academic_situation', ['type'=>'select','options' => $SituacionesAcademicas,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Situación académica']); ?>
		</div>

		<div class="contenedorClonesFormacionAcademica"></div>
		
		<div style="text-align: right;">
			<span>Agregar otra formación académica (máx. 3)</span>
			<button type="button" class="btn btn-default btn-sm" onclick="clonarFormacionAcademica();">
	          <span class="glyphicon glyphicon-plus-sign"></span>
	        </button>
		</div>

		<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
	        <p style="color: #588BAD">Conocimientos y habilidades profesionales.</p>
	    </blockquote>

	    <div class="col-md-12">
			<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
		        <p style="color: #588BAD">Idiomas.</p>
		    </blockquote>
	    </div>
		
		<div id="original" class="clon">
			<?= $this->Form->input('CompanyJobLanguage.0.language_id', ['type'=>'select','options' => $lenguages,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Idioma']); ?>
			<?= $this->Form->input('CompanyJobLanguage.0.level', ['type'=>'select','options' => $NivelesIdioma,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Nivel']); ?>
		</div>
			
		<div class="contenedorClonesLanguages"></div>
		
		<div style="text-align: right;">
			<span>Agregar otro idioma (máx. 3)</span>
			<button type="button" class="btn btn-default btn-sm" onclick="clonarLenguaje();">
	          <span class="glyphicon glyphicon-plus-sign"></span>
	        </button>
		</div>

		<div class="col-md-12">
			<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
		        <p style="color: #588BAD">Cómputos.</p>
		    </blockquote>
	    </div>

		<div id="originalComputo" class="clonComputo">
			<?= $this->Form->input('CompanyJobComputingSkill.0.name', ['placeholder' => 'Cómputo']); ?>
			<?= $this->Form->input('CompanyJobComputingSkill.0.level', ['type'=>'select','options' => $NivelesSoftware,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Nivel']); ?>
		</div>
			
		<div class="contenedorClonesComputo"></div>
		
		<div style="text-align: right;">
			<span>Agregar otro cómputo (máx. 3)</span>
			<button type="button" class="btn btn-default btn-sm" onclick="clonarComputo();">
	          <span class="glyphicon glyphicon-plus-sign"></span>
	        </button>
		</div>
	</div>
	
	<div class="col-md-12 text-center">
		<?= $this->Form->button('Filtrar &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-filter"></i>',['type'=>'submit','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px;']);?>
		<?= $this->Form->end(); ?>
	</div>

	<?= $this->element('scriptGirosDinamicos'); ?>
	<?= $this->element('scriptBuscarOfertas'); ?>
	<?= $this->element('direccion'); ?>