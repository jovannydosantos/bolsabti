<?php 
	$this->layout = 'student'; 
?>
	<script type="text/javascript">
		var cont = 1;
		var cont = 1;
		var cont2 = 1;
		var cont3 = 1;
		var cont4 = 1;
		
		function cargaAreas(id, idArea){
				if($('#CompanyJobProfileDynamicGiro'+id+'Giro').val() != 0)
					{
					$('#loading').show();
					$.get('http://localhost/bolsabti/app/webroot/php/derpAreas.php',{giro: $('#CompanyJobProfileDynamicGiro'+id+'Giro').val()},function(JSON)
						{
						$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').empty();
						$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').append('<option value="">Área de experiencia</option>');
						
						var waitCount = 0;
						$.each(JSON, function(key, val){
							waitCount++;
						});

						$.each(JSON, function(key, val){
							if(idArea == val.id){
								$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').append('<option value="' + val.id + '" selected>' + val.area + '</option>');
							}else{
								$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').append('<option value="' + val.id + '">' + val.area + '</option>');
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
						$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').empty();
						$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').append('<option value="">Área de experiencia</option>');
						$('.selectpicker').selectpicker('refresh');
					}
		}
			
		function hideShowCarrerArea(index){
			if($('#CompanyCandidateProfileDynamicNivelAcademico'+index+'AcademicLevel').val() == ''){
				$("#divAreasId"+index).hide();
				$("#divCarrerasId"+index).hide();
			}else if($('#CompanyCandidateProfileDynamicNivelAcademico'+index+'AcademicLevel').val() == 1){ 
				$("#divAreasId"+index).hide();
				$("#divCarrerasId"+index).show();
			} else{
				$("#divAreasId"+index).show();
				$("#divCarrerasId"+index).hide();
			}
		}

		function situacionesAcademicasUpdate(index, seleccionado)	{
			academicLevelSelectedIndex = document.getElementById("CompanyCandidateProfileDynamicNivelAcademico"+index+"AcademicLevel").selectedIndex;
			$('#CompanyCandidateProfileDynamicSituacionAcademica'+index+'AcademicSituation option').remove();
			$('#CompanyCandidateProfileDynamicSituacionAcademica'+index+'AcademicSituation').append(new Option('Situación académica', ''));
			$('#CompanyCandidateProfileDynamicSituacionAcademica'+index+'AcademicSituation').append(new Option('Estudiante', '1'));
			$('#CompanyCandidateProfileDynamicSituacionAcademica'+index+'AcademicSituation').append(new Option('Egresado', '2'));
			
			if (academicLevelSelectedIndex==0){
				$('#CompanyCandidateProfileDynamicSituacionAcademica'+index+'AcademicSituation option').remove();
				$('#CompanyCandidateProfileDynamicSituacionAcademica'+index+'AcademicSituation').append(new Option('Situación académica', ''));
			}else if (academicLevelSelectedIndex==1){
				$('#CompanyCandidateProfileDynamicSituacionAcademica'+index+'AcademicSituation').append(new Option('Titulado', '3'));
			}else if (academicLevelSelectedIndex==2){
				$('#CompanyCandidateProfileDynamicSituacionAcademica'+index+'AcademicSituation').append(new Option('Con diploma', '4'));
			} else if((academicLevelSelectedIndex==3) || (academicLevelSelectedIndex==4)){
				$('#CompanyCandidateProfileDynamicSituacionAcademica'+index+'AcademicSituation').append(new Option('Con grado', '5'));
			}
			
			$('#CompanyCandidateProfileDynamicSituacionAcademica'+index+'AcademicSituation option[value="'+seleccionado+'"]').prop('selected', true);
		}
		
		function closeCollapse(id){
			for (var i = 4; i >= 1; i--) {
				$(".collapse").collapse('hide');
			}
			$( "#idButtonCollapse1" ).removeClass( "active" );
			$( "#idButtonCollapse2" ).removeClass( "active" );
			$( "#idButtonCollapse3" ).removeClass( "active" );
			$( "#idButtonCollapse4" ).removeClass( "active" );
			
			$( "#idButtonCollapse"+id ).addClass( "active" );
		}
			
		function submitSearch(){
			var palabrasClave = document.getElementById("CompanyJobProfileJobName").value;
			textoAreaDividido = palabrasClave.split(" ");
			numeroPalabras = textoAreaDividido.length;

			if((document.getElementById("CompanyJobProfileJobName").value != '') && (numeroPalabras>4)){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Sólo puede ingresar 4 palabras clave y separadas por un espacio'});
				return false;
			} else {
				document.getElementById("formSpecificSearchId").submit();
			}
		}

		function guardarBusqueda(){
			document.getElementById("idFormGuardarBusqueda").submit();
		}
		
		function sendPaginado(){
			var paginas=$('#limit').val();
			$('#StudentLimit').val(paginas);
			 selectedIndex = document.getElementById("limit").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				document.getElementById("formSpecificSearchId").submit();
			 }
		}

	</script>
		
	<nav class="navbar navbar-default navbar-static-top" style="margin-top: 5px;margin-bottom: 10px;z-index: 1;">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-search" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">FILTRO:</a>
	    </div>

	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-search">
	      <ul class="nav navbar-nav">
			<li class="whiteTextMenu" id='idButtonCollapse1'><a href="#collapse1" data-toggle="collapse" onClick="closeCollapse(1);">Palabras clave</a></li>
			<li class="whiteTextMenu" id='idButtonCollapse2'><a href="#collapse2" data-toggle="collapse" onClick="closeCollapse(2);">Formación académica</a></li>
			<li class="whiteTextMenu" id='idButtonCollapse3'><a href="#collapse3" data-toggle="collapse" onClick="closeCollapse(3);">Perfil de la oferta</a></li>
			<li class="whiteTextMenu" id='idButtonCollapse4'><a href="#collapse4" data-toggle="collapse" onClick="closeCollapse(4);">Conocimientos y habilidades</a></li>
			<li class="whiteTextMenu"><a href="#" onClick="addName(); return false;">Guardar búsqueda</a></li>
			<li class="dropdown whiteTextMenu">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Búsquedas guardadas (máx. 10)<span class="caret"></span></a>
        	<ul class="dropdown-menu nav" style="width: 100%;">
        		<?php if(empty($busquedasGuardadas)): ?>
        			<li><a href="#">Sin búsquedas guardadas</a></li>
        		<?php else: ?>
        			<?php foreach ($busquedasGuardadas as $busqueda) { ?>
        				<li><a href="#" onclick="viewSearchResults('<?= $busqueda ?>')"><?= $busqueda ?></a></li>
        			<?php } ?>
        		<?php endif; ?>
        	</ul>
	      	</li>
		  </ul>	
		</div>
	  </div>
    </nav>

    <?= $this->Form->create('Student', [
						'class' => 'form-horizontal', 
						'id' => 'formSpecificSearchId',
						'role' => 'form',
						'inputDefaults' => [
							'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
							'div' => ['class' => 'form-group'],
							'class' => 'form-control',
							'before' => '<div class="col-md-12 ">',
							'label' => ['class' => 'col-md-12 control-label', 'text'=>''],
							'between' => '<div class="col-md-12">',
							'after' => '</div></div>',
							'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
						],
						'action' => 'specificSearchResults',]); ?>

	<fieldset>
		<div id="collapse1" class="collapse">
			<div class="col-md-6 col-md-offset-3 ">
				<div class="col-md-12">
				<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
			        <p style="color: #588BAD">Palabras clave.</p>
			    </blockquote>
			    </div>
		   
				<?= $this->Form->input('CompanyJobProfile.job_name', ['placeholder' => 'Palabras clave (60 caracteres máx.)']); ?>
 				
 				<!--Valores que no se cambian pero que se toman en cuenta -->
 				<?= $this->Form->input('Student.limit', ['type'=>'hidden']); ?>
 				<?= $this->Form->input('CompanyJobProfile.disability', ['type'=>'hidden']); ?>
 				<?= $this->Form->input('CompanyJobProfile.disability_type', ['type'=>'hidden']); ?>
				<?= $this->Form->input('CompanyJobContractType.state', ['type'=>'hidden']); ?>	
			    <?= $this->Form->input('CompanyJobContractType.subdivision', ['type'=>'hidden']); ?>
			    <?= $this->Form->input('CompanyJobContractType.mobility', ['type'=>'hidden']); ?>

			    <div class="col-md-12 text-center">
					<?= $this->Form->button('Filtrar &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-filter"></i>',['type'=>'button','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px; ','onClick' => 'submitSearch();']);?>
				</div>
			</div>
		</div>
			
		<div id="collapse2" class="collapse">
			<div class="col-md-6 col-md-offset-3 ">
				<div class="col-md-12">
				<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
			        <p style="color: #588BAD"> Formación académica.</p>
			    </blockquote>
			    </div>

			    <div id="original" class="clon">
					<?= $this->Form->input('CompanyCandidateProfileDynamicNivelAcademico.0.academic_level', ['type'=>'select','options' => $NivelesAcademicos,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Nivel académico','onchange' => 'changeAcademicLevel(0);']); ?>	

					<div id="divCarrerasId0" style="display: none">
						<?= $this->Form->input('CompanyJobRelatedCareerDynamicCarrera.0.career_id', ['type'=>'select','options' => $careers,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Carrera']); ?>	
					</div>
					<div id="divAreasId0" style="display: none">
						<?= $this->Form->input('CompanyJobRelatedAreaDynamicArea.0.area_id', ['type'=>'select','options' => $AreasPosgrado,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Área']); ?>
					</div>
					
					<?= $this->Form->input('CompanyCandidateProfileDynamicSituacionAcademica.0.academic_situation', ['type'=>'select','options' => $SituacionesAcademicas,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Situación académica']); ?>
					
					<?php if($this->Session->read('serialized_form.CompanyCandidateProfileDynamicSituacionAcademica.0.academic_situation')<>0): ?>
						<script languaje="javascript">
							situacionesAcademicasUpdate('0', <?php echo $this->Session->read('serialized_form.CompanyCandidateProfileDynamicSituacionAcademica.0.academic_situation'); ?>);
						</script>
					<?php else: ?>
						<script languaje="javascript">
								situacionesAcademicasUpdate('0','0');
						</script>
					<?php endif; ?>

				</div>

				<script languaje="javascript">
					hideShowCarrerArea('0');
				</script> 

				
				<?php 
					$cont = 0;
					if(!empty($this->request->data['CompanyCandidateProfileDynamicNivelAcademico'])):
					foreach($this->request->data['CompanyCandidateProfileDynamicNivelAcademico'] as $k => $formacionAcademica): 
					if($cont > 0):
				?>
					<div id="IdClonFormcionAcademica<?= $cont ?>" class="clonFormcionAcademica<?= $cont ?> clonFormcionAcademicaIndependiente">
						
						<?= $this->Form->input('CompanyCandidateProfileDynamicNivelAcademico.'.$cont.'.academic_level', ['type'=>'select','options' => $NivelesAcademicos,'class' => 'selectpicker show-tick form-control show-menu-arrow clonNivelAcademico'.$cont.' clonNivelAcademicoReindexa','data-live-search' => 'true','default'=>'0', 'empty' => 'Nivel académico','onchange' => 'changeAcademicLevel('.$cont.');']); ?>	

						<div id="divCarrerasId<?= $cont ?>" class="divCarreras">
							<?= $this->Form->input('CompanyJobRelatedCareerDynamicCarrera.'.$cont.'.career_id', ['type'=>'select','options' => $careers,'class' => 'selectpicker show-tick form-control show-menu-arrow clonCarrera'.$cont.' clonCarreraReindexa','data-live-search' => 'true','default'=>'0', 'empty' => 'Carrera']); ?>	
						</div>

						<div id="divAreasId<?= $cont ?>" class="divAreas">
							<?= $this->Form->input('CompanyJobRelatedAreaDynamicArea.'.$cont.'.area_id', ['type'=>'select','options' => $AreasPosgrado,'class' => 'selectpicker show-tick form-control show-menu-arrow clonArea'.$cont.' clonAreaReindexa','data-live-search' => 'true','default'=>'0', 'empty' => 'Área']); ?>
						</div>

						<?= $this->Form->input('CompanyCandidateProfileDynamicSituacionAcademica.'.$cont.'.academic_situation', ['type'=>'select','options' => $SituacionesAcademicas,'class' => 'selectpicker show-tick form-control show-menu-arrow clonSituacionAcademica'.$cont.' clonSituacionAcademicaReindexa','default'=>'0', 'empty' => 'Situación académica']); ?>

						<div class="col-md-12 clonFormcionAcademica<?= $cont ?>"><button class="btn btn-danger btn-sm maxFormaciones" onclick="eliminarClonFormacionAcademica(<?= $cont ?>); " type="button"><i class="glyphicon glyphicon-trash"></i></button></div>
					</div>
					
					<?php if($this->Session->read('serialized_form.CompanyCandidateProfileDynamicSituacionAcademica.'.$cont.'.academic_situation')<>''): ?>
						<script languaje="javascript">
							situacionesAcademicasUpdate('<?php echo $cont; ?>', <?php echo $this->Session->read('serialized_form.CompanyCandidateProfileDynamicSituacionAcademica.'.$cont.'.academic_situation'); ?>);
						</script>
					<?php else: ?>
						<script languaje="javascript">
								situacionesAcademicasUpdate(<?php echo $cont; ?>,'0');
						</script>
					<?php endif; ?>
					
					<script languaje="javascript">
						hideShowCarrerArea('<?php echo $cont; ?>');
						cont3++;
					</script> 
				<?php 
					endif;
					$cont++;
					endforeach; 
					endif;
				?>

				<div class="contenedorClonesFormacionAcademica col-md-12"></div>
				
				<div class="col-md-12" style="text-align: right;">
					<span>Agregar otra formación académica (máx. 3)</span>
					<button type="button" class="btn btn-default btn-sm" onclick="clonarFormacionAcademica();">
			          <span class="glyphicon glyphicon-plus-sign"></span>
			        </button>
				</div>
				
				<div class="col-md-12 text-center">
					<?= $this->Form->button('Filtrar &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-filter"></i>',['type'=>'button','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px; ','onClick' => 'submitSearch();']);?>
				</div>
			</div>
		</div>
			
		<div id="collapse3" class="collapse">
			<div class="col-md-6 col-md-offset-3 ">
				<div class="col-md-12">
				<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
			        <p style="color: #588BAD">Perfil de la oferta.</p>
			    </blockquote>
			    </div>

			    <?= $this->Form->input('CompanyJobContractType.contract_type', ['type'=>'select','options' => $TiposContratos,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Tipo de contrato','required' => false]); ?>
			    <?= $this->Form->input('CompanyJobContractType.workday', ['type'=>'select','options' => $JornadasLaborales,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Jornada laboral','required' => false]); ?>
			    <?= $this->Form->input('CompanyJobContractType.salary', ['type'=>'select','options' => $Salarios,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Sueldo','required' => false]); ?>

				<div id="original" class="clonGiro">
					<?= $this->Form->input('CompanyJobProfileDynamicGiro.0.giro', ['type'=>'select','options' => $Giros,'class' => 'selectpicker show-tick form-control show-menu-arrow clonGiroReindexa','data-live-search' => 'true','default'=>'0', 'empty' => 'Giro de interés','onchange' => 'cargaAreas(0)']); ?>
					<?= $this->Form->input('CompanyJobProfileDynamicArea.0.area_interes', ['type'=>'select','options' => $AreasExperiencia,'class' => 'selectpicker show-tick form-control show-menu-arrow clonAreaReindexa','data-live-search' => 'true','default'=>'0', 'empty' => 'Áreas de interés']); ?>
				</div>
				
				
				<?php 
					$cont = 0;
					if(!empty($this->request->data['CompanyJobProfileDynamicGiro'])):
					foreach($this->request->data['CompanyJobProfileDynamicGiro'] as $k => $giros): 
						if($cont > 0):
				?>
						<div id="IdClonGiro<?php echo $cont ?>" class="clonGiro<?php echo $cont ?> clonGiroIndependiente">
							<?= $this->Form->input('CompanyJobProfileDynamicGiro.'.$cont.'.giro', ['type'=>'select','options' => $Giros,'class' => 'selectpicker show-tick form-control show-menu-arrow clonGiroReindexa','data-live-search' => 'true','default'=>'0', 'empty' => 'Giro de interés','onchange' => 'cargaAreas('.$cont.')']); ?>
							<?= $this->Form->input('CompanyJobProfileDynamicArea.'.$cont.'.area_interes', ['type'=>'select','class' => 'selectpicker show-tick form-control show-menu-arrow clonAreaReindexa','data-live-search' => 'true','default'=>'0', 'empty' => 'Áreas de interés']); ?>
							<div class="col-md-12 clonGiro<?php echo $cont ?>"><button class="btn btn-danger btn-sm maxGiros" onclick="eliminarClonGiro(<?php echo $cont ?>);" type="button"><i class="glyphicon glyphicon-trash"></i></button></div>
							<script languaje="javascript">
								cargaAreas('<?php echo $cont; ?>', '<?php echo $this->request->data['CompanyJobProfileDynamicArea'][$cont]['area_interes']; ?>');
								cont2++;
							</script> 
						</div>
				<?php 
						endif;
					$cont++;
					endforeach; 
					endif;
				?>

				<div class="contenedorClonesGiros col-md-12"></div>
				
				<div class="col-md-12" style="text-align: right;">
					<span>Agregar otro giro y área (máx. 2)</span>
					<button type="button" class="btn btn-default btn-sm" onclick="clonarGiro();">
			          <span class="glyphicon glyphicon-plus-sign"></span>
			        </button>
				</div>
				
				<div class="col-md-12 text-center">
					<?= $this->Form->button('Filtrar &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-filter"></i>',['type'=>'button','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px; ','onClick' => 'submitSearch();']);?>
				</div>
			</div>
		</div>
			
		<div id="collapse4" class="collapse">
			<div class="col-md-6 col-md-offset-3 ">

				<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
			        <p style="color: #588BAD">Conocimientos y habilidades profesionales.</p>
			    </blockquote>
		
				<div id="original" class="clon">
					<div class="col-md-12">
					<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
				        <p style="color: #588BAD">Idiomas.</p>
				    </blockquote>
				    </div>

					<div id="original" class="clon">
						<?= $this->Form->input('CompanyJobLanguage.0.language_id', ['type'=>'select','options' => $lenguages,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Idioma']); ?>
						<?= $this->Form->input('CompanyJobLanguage.0.level', ['type'=>'select','options' => $NivelesIdioma,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Nivel']); ?>
					</div>
				</div>
				
				<?php 
					$cont = 0;
					if(!empty($this->request->data['CompanyJobLanguage'])):
					foreach($this->request->data['CompanyJobLanguage'] as $k => $idiomas): 
					if($cont > 0):
				?>

						<div id="IdClonLanguage<?= $cont ?>" class="clonLanguage<?= $cont ?> clonLanguageIndependiente">
							<?= $this->Form->input('CompanyJobLanguage.'.$cont.'.language_id', ['type'=>'select','options' => $lenguages,'class' => 'selectpicker show-tick form-control show-menu-arrow selectClonLanguage'.$cont.' clonLanguageReindexa','data-live-search' => 'true','default'=>'0', 'empty' => 'Idioma']); ?>
							<?= $this->Form->input('CompanyJobLanguage.'.$cont.'.level', ['type'=>'select','options' => $NivelesIdioma,'class' => 'selectpicker show-tick form-control show-menu-arrow selectClonLevelLanguage'.$cont.' clonLevelLanguageReindexa','data-live-search' => 'true','default'=>'0', 'empty' => 'Nivel']); ?>
							<div class="col-md-12 clonLanguage<?= $cont ?>" ><button class="btn btn-danger btn-sm maxIdiomas" onclick="eliminarClonLanguage(<?= $cont ?>); " type="button"><i class="glyphicon glyphicon-trash"></i></button></div>
						</div>
						
						<script languaje="javascript">
							cont++;
						</script> 
			
				<?php 
					endif;
					$cont++;
					endforeach; 
					endif;
				?>
				<div class="contenedorClonesLanguages col-md-12"></div>
			
				<div class="col-md-12" style="text-align: right;">
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
					
				<?php 
					$cont = 0;
					if(!empty($this->request->data['CompanyJobComputingSkill'])):
					foreach($this->request->data['CompanyJobComputingSkill'] as $k => $computos): 
					if($cont > 0):
				?>
						<div id="IdClonComputo<?= $cont; ?>" class="clonComputo<?= $cont; ?> clonComputoIndependiente">
							<?= $this->Form->input('CompanyJobComputingSkill.'.$cont.'.name', ['placeholder' => 'Cómputo','class'=>'form-control clonComputoNameReindexa']); ?>
							<?= $this->Form->input('CompanyJobComputingSkill.'.$cont.'.level', ['type'=>'select','options' => $NivelesSoftware,'class' => 'selectpicker show-tick form-control show-menu-arrow selectClonComputoLevel'.$cont.' clonComputoLevelReindexa','data-live-search' => 'true','default'=>'0', 'empty' => 'Nivel']); ?>
							<div class="col-md-12 clonComputo<?= $cont; ?>"><button class="btn btn-danger btn-sm maxComputos" onclick="eliminarClonComputo(<?= $cont; ?>); " type="button"><i class="glyphicon glyphicon-trash"></i></button></div>
						</div>
						
						<script languaje="javascript">
							cont4++;
						</script> 
					
				<?php 
					endif;
					$cont++;
					endforeach; 
					endif;
				?>
				
				<div class="contenedorClonesComputo col-md-12"></div>
				
				<div class="col-md-12" style="text-align: right;">
					<span>Agregar otro cómputo (máx. 3)</span>
					<button type="button" class="btn btn-default btn-sm" onclick="clonarComputo();">
			          <span class="glyphicon glyphicon-plus-sign"></span>
			        </button>
				</div>

				<div class="col-md-12 text-center">
					<?= $this->Form->button('Filtrar &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-filter"></i>',['type'=>'button','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px; ','onClick' => 'submitSearch();']);?>
					<?= $this->Form->end(); ?>	
				</div>

			</div>
	</fieldset>
	
	<?php if(isset($ofertas)): 
		if(empty($ofertas)):
			echo '<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
			    <p style="color: #588BAD">Sin Resultados.</p>
			  </blockquote>';
		else:
	?>
			<div class="col-md-12">
				<p>Resultados de búsqueda:</p>
			</div>
			
			<?php 
				if(isset($orden)):
					if($orden==='CompanyJobprofile.created DESC'):
						$addClassASC = 'active'; 
						$addClassDESC = ''; 
					else:
						if($orden==='CompanyJobprofile.created ASC'):
							$addClassASC = ''; 
							$addClassDESC = 'active';
						else:
							$addClassASC = ''; 
							$addClassDESC = ''; 
						endif;
					endif;
					
					if($orden==='CompanyJobContractType.salary ASC'):
						$addClassSalaryASC = 'active'; 
						$addClassSalaryDESC = ''; 
					else:
						if($orden==='CompanyJobContractType.salary DESC'):
							$addClassSalaryASC = ''; 
							$addClassSalaryDESC = 'active';
						else:
							$addClassSalaryASC = ''; 
							$addClassSalaryDESC = ''; 
						endif;
					endif;
					
				else:
					$addClassASC = ''; 
					$addClassDESC = ''; 
					$addClassSalaryASC = ''; 
					$addClassSalaryDESC = ''; 
				endif;
			?>

			<div class="col-md-3" style="margin-top: 7px;">
				<div class="btn-group" style="width: 100%;">
				  <button type="button" class="btn btn-default col-md-12" data-toggle="dropdown">Ordenar por sueldo &nbsp;<i></i><span class="caret"></span></button>
				  <ul class="dropdown-menu nav" role="menu" style="width: 100%">
					<li>
						<?= $this->Html->link('Más bajo al más alto', 
													['controller'=>'Students',
													'action'=>'specificSearchResults','?' => ['orden' => 'CompanyJobContractType.salary ASC',]],
													['class' => 'btn btn-default '.$addClassSalaryASC,'style' => 'border-color: transparent;','escape' => false]); ?>
					</li>
					<li>
					<?php echo $this->Html->link('Más alto al más bajo', 
													['controller'=>'Students',
													'action'=>'specificSearchResults','?' => ['orden' => 'CompanyJobContractType.salary DESC',]],
													['class' => 'btn btn-default ' . $addClassSalaryDESC,'style' => 'margin-top: 5px;border-color: transparent;','escape' => false]); ?>
					</li>
				  </ul>
				</div>
			</div>

			<div class="col-md-3">
				<?= $this->Form->create('Student', [
					'class' => 'form-horizontal', 
					'id' => 'sendPaginadoForm',
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
					'action' => '']); ?>

				<?php $options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200); ?>
				<?= $this->Form->input('limit', ['type'=>'select','options' => $options,'id'=> 'limit','class' => 'selectpicker show-tick form-control show-menu-arrow','selected' => $this->Session->read('limit'),'default'=>'0', 'empty' => 'Resultados por hoja','onchange' => 'sendPaginado()']); ?>

				<?= $this->Form->end(); ?>
			</div>

			<div class="col-md-12 scrollbar" id="style-2" style="margin-top: 30px">
				<?= $this->element('ofertas'); ?>
			</div>
	<?php 
		endif;
	endif; 
	?>

	<?= $this->Form->create('Student', [
								'class' => 'form-horizontal', 
								'id'=>'idFormGuardarBusqueda',
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
								'action' => 'studentSavedSearch']); ?>			
					
						<?= $this->Form->input('StudentSavedSearch.name', ['type' => 'hidden']);	?>
						<?= $this->Form->end(); ?>		

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
			<div style="display: none;">
			<?= $this->Form->input('busqueda_guardada', ['type'=>'select','options' => $busquedasGuardadas,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Búsquedas guardadas','onchange' => 'viewSearch()']); ?>
			</div>
			<?= $this->Form->end(); ?>	

	<?= $this->element('scriptBuscarOfertas'); ?>

