 <?php 
	$this->layout = 'company';
?>
	<style> 
	.checkbox label {
		color: #fff;
	}
	.titulos{
		color: #fff; 
		margin-left: 15px;
		margin-right: 20px;
	}
	p {
		font-size: 14px;
	}
	</style>
	
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
			if($("#estado").val() != ''){	
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
								if(val.mun == '<?php echo (isset($this->request->data['CompanyJobContractType']['subdivision']) and ($this->request->data['CompanyJobContractType']['subdivision'] <> '')) ? $this->request->data['CompanyJobContractType']['subdivision']: ''; ?>'){
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
			else{
				$('#ciudad').empty();
				$('#ciudad').append('<option value="">Delegación / Municipio</option>');
				$('.selectpicker').selectpicker('refresh');
				}
			
			<?php if(isset($this->request->data['CompanyCandidateProfile']) and (!empty($this->request->data['CompanyCandidateProfile']))): ?> 
				
				<?php if($this->request->data['CompanyCandidateProfile']['academic_situation'] == 1): ?> 
					$( "#StudentProfessionalProfile0AcademicSituation" ).prop( "checked", true );	
				<?php endif; ?>
				
				<?php if($this->request->data['CompanyCandidateProfile']['academic_situation'] == 2): ?> 
					$( "#StudentProfessionalProfile1AcademicSituation" ).prop( "checked", true );	
				<?php endif; ?>
				
				<?php if($this->request->data['CompanyCandidateProfile']['academic_situation'] == 3): ?> 
					$( "#StudentProfessionalProfile2AcademicSituation" ).prop( "checked", true );
				<?php endif; ?>
				
				<?php if($this->request->data['CompanyCandidateProfile']['academic_situation'] == 4): ?> 
					$( "#StudentProfessionalProfile3AcademicSituation" ).prop( "checked", true );
				<?php endif; ?>
				
				<?php if($this->request->data['CompanyCandidateProfile']['academic_situation'] == 5): ?> 
					$( "#StudentProfessionalProfile4AcademicSituation" ).prop( "checked", true );
				<?php endif; ?>
				
			<?php endif; ?>
			
			
			<?php if(isset($this->request->data['CompanyJobOfferCompetency']) and (!empty($this->request->data['CompanyJobOfferCompetency']))): ?> 
				var totalCompetencias = <?php echo count($this->request->data['CompanyJobOfferCompetency']); ?>;
				
				var arrayCompetencias = new Array();
				var indexArray = 0;
				<?php 
					foreach($this->request->data['CompanyJobOfferCompetency'] as $k => $Competencia):	
				?>;	
				var indexCompetencia = <?php echo $Competencia['competency_id'] ?>;
				$( "#CompanyJobOfferCompetency"+indexCompetencia+"CompetencyId" ).prop( "checked", true );
				<?php 
					endforeach;
				?>;
			<?php endif; ?>
			
			actualizaCarreras();
			semestre();
			academicSituation();
			desabilityMobility();
			desabilityMobility1();
			desabilityMobility2();	
			mobilityCityOption();
			mobilityCityOption2();
			cargaAreas('0');
			
			init_contadorTa("StudentJobSkillName","contadorTaComentario", 316);
			updateContadorTa("StudentJobSkillName","contadorTaComentario", 316);
			
			$("#agregarIdioma").click(function(e) { 
				var numIdiomas = $(".divIdiomas");
				if(numIdiomas.length >= 3){			
					jAlert ("S\u00f3lo puedes agregar hasta 3 idiomas");
					return false;
				} else if (	(document.getElementById("StudentLenguage0LanguageId").value.length === 0) && 
							(document.getElementById("StudentLenguage0ReadingLevel").value.length === 0) &&
							(document.getElementById("StudentLenguage0WritingLevel").value.length === 0) &&
							(document.getElementById("StudentLenguage0ConversationLevel").value.length === 0)
							){
					jAlert ("Ingrese al menos un valor antes de agregar otro idioma");
					return false;
				} else {	
					var string = 
								'<div class=" divIdiomas">'+
									'<button type="button" class="btn btn-danger eliminar"style="margin-right: -45px; float: right; margin-bottom: -58px; margin-top: 1px; padding-left: 10px;"><i class="glyphicon glyphicon-trash"></i></button>'+
									'<div class="col-md-4 col-md-offset-1">'+
										'<p>Idioma</p>'+
									'</div>'+
									'<div class="form-group row"><div class="col-md-12 "><label for="StudentLenguage0LanguageId"></label><div class="col-md-11 col-md-offset-1">'+
									
									'<select name="data[StudentLenguage]['+x+'][language_id]" class="form-control selectpicker show-tick show-menu-arrow idioma'+x+'" data-live-search="true" id="StudentLenguage'+x+'LanguageId">'+
									
									'</select></div></div></div><div class="form-group row"><div class="col-md-12 col-md-offset-1" ><label for="StudentLenguage'+x+'ReadingLevel" class="col-md-4 control-label">Lectura</label> <div class="col-md-7" style="margin-left: -3px;">'+
									'<select name="data[StudentLenguage]['+x+'][reading_level]" class="form-control selectpicker show-tick show-menu-arrow readingLevel'+x+'" placeholder="Nivel de lectura" id="StudentLenguage'+x+'ReadingLevel">'+
									
									'</select></div></div></div><div class="form-group row"><div class="col-md-12 col-md-offset-1"><label for="StudentLenguage'+x+'WritingLevel" class="col-md-4 control-label">Escritura</label> <div class="col-md-7" style="margin-left: -3px;">'+
									'<select name="data[StudentLenguage]['+x+'][writing_level]" class="form-control selectpicker show-tick show-menu-arrow writingLevel'+x+'" placeholder="Nivel de escritura" id="StudentLenguage'+x+'WritingLevel">'+
									
									'</select></div></div></div><div class="form-group row"><div class="col-md-12 col-md-offset-1"><label for="StudentLenguage'+x+'ConversationLevel" class="col-md-4 control-label">Conversación</label> <div class="col-md-7" style="margin-left: -3px;">'+
									'<select name="data[StudentLenguage]['+x+'][conversation_level]" class="form-control selectpicker show-tick show-menu-arrow conversationLevel'+x+'" placeholder="Nivel de conversación" id="StudentLenguage'+x+'ConversationLevel">'+
									
									'</select></div></div></div>'+						
									
								'</div>	';	

					$("#contenedorIdiomas").append(string); 
					$('#StudentLenguage0LanguageId').find('option').clone().appendTo('.idioma'+x);
					$('#StudentLenguage0ReadingLevel').find('option').clone().appendTo('.readingLevel'+x);
					$('#StudentLenguage0WritingLevel').find('option').clone().appendTo('.writingLevel'+x);
					$('#StudentLenguage0ConversationLevel').find('option').clone().appendTo('.conversationLevel'+x);
					document.getElementById('StudentLenguage'+x+'LanguageId').options[0].selected = 'selected';
					document.getElementById('StudentLenguage'+x+'ReadingLevel').options[0].selected = 'selected';
					document.getElementById('StudentLenguage'+x+'WritingLevel').options[0].selected = 'selected';
					document.getElementById('StudentLenguage'+x+'ConversationLevel').options[0].selected = 'selected';
					x++;
					 $('.selectpicker').selectpicker('refresh');
					return false;
				}
					
				});
				
				
			$("#agregarComputo").click(function(e) { 
				var numComputo = $(".divComputo");
				if(numComputo.length >= 3){			
					jAlert ("S\u00f3lo puedes agregar hasta 3 cómputos");
					return false;
				} else if (	(document.getElementById("StudentTechnologicalKnowledge0TecnologyId").value.length === 0) && 
							(document.getElementById("StudentTechnologicalKnowledge0Name").value.length === 0) &&
							(document.getElementById("StudentTechnologicalKnowledge0Other").value.length === 0) &&
							(document.getElementById("StudentTechnologicalKnowledge0Level").value.length === 0)
							){
					jAlert ("Ingrese al menos un valor antes de agregar otro cómputo");
					return false;
				} else {	
					var string = 
								'<div class="divComputo">'+		
									'<button type="button" class="btn btn-danger eliminar" style="margin-right: 15px; float: right; margin-bottom: -30px; margin-top: 0px;"><i class="glyphicon glyphicon-trash"></i></button>'+
									'<div class="col-md-4">'+
										'<p>Cómputo</p>'+
									'</div>'+
									
									'<div class="form-group row"><div class="col-md-12 "><div class="col-md-10">'+
									
									'<select name="data[StudentTechnologicalKnowledge]['+xComputo+'][tecnology_id]" class="form-control selectpicker show-tick show-menu-arrow categoriId'+xComputo+'"  id="StudentTechnologicalKnowledge'+xComputo+'tecnology_id">'+
									
									'</select></div></div></div><div id="contentName'+xComputo+'"><div class="form-group row"><div class="col-md-12 "><div class="col-md-10">'+
									
									'<select name="data[StudentTechnologicalKnowledge]['+xComputo+'][name]" class="form-control selectpicker show-tick show-menu-arrow name'+xComputo+'" data-live-search="true" onchange="hideOther('+xComputo+')" placeholder="Nombre" type="text" id="StudentTechnologicalKnowledge'+xComputo+'Name"/></select></div></div></div></div><div id="contentOther'+xComputo+'"><div class="form-group row"><div class="col-md-12 "><div class="col-md-10">'+
									
									'<input name="data[StudentTechnologicalKnowledge]['+xComputo+'][other]" class="form-control other'+xComputo+'" onblur="restart('+xComputo+')"  placeholder="Otro" type="text" id="StudentTechnologicalKnowledge'+xComputo+'Other"/></div></div></div></div><div class="form-group row"><div class="col-md-12 "><div class="col-md-10">'+
									
									'<select name="data[StudentTechnologicalKnowledge]['+xComputo+'][level]" class="form-control selectpicker show-tick show-menu-arrow level'+xComputo+'" placeholder="Nivel" id="StudentTechnologicalKnowledge'+xComputo+'Level">'+

									'</select></div></div></div>'+			
									
								'</div>';
								
					$("#contenedorComputo").append(string); 
					$('#StudentTechnologicalKnowledge0TecnologyId').find('option').clone().appendTo('.categoriId'+xComputo);
					$('#StudentTechnologicalKnowledge0Name').find('option').clone().appendTo('.name'+xComputo);
					$('#StudentTechnologicalKnowledge0Level').find('option').clone().appendTo('.level'+xComputo);
					document.getElementById('StudentTechnologicalKnowledge'+xComputo+'tecnology_id').options[0].selected = 'selected';
					document.getElementById('StudentTechnologicalKnowledge'+xComputo+'Name').options[0].selected = 'selected';
					document.getElementById('StudentTechnologicalKnowledge'+xComputo+'Level').options[0].selected = 'selected';	
					xComputo++;
					 $('.selectpicker').selectpicker('refresh');
					return false;
				}
			});
				
				var mensaje = "¿Seguro que desea eliminar este bloque?";
				$("body").on("click", ".eliminar", function(e) {
					var respuesta = confirm(mensaje);
					if (respuesta === true){
						$(this).parent('div').remove();
						$(this).parent('div').remove();
					}
					return false;
				});
		});

		//Obtener áreas en base al giro Carga automática (specificSearch)
		if ($("#CompanyJobProfileDynamicGiro0Giro").length > 0){
			if($("#CompanyJobProfileDynamicGiro0Giro").val() != 0)
				{
				$('#loading').show();
				$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpAreas.php',{giro: $('#CompanyJobProfileDynamicGiro0Giro').val()},function(JSON)
					{
					
					$('#CompanyJobProfileDynamicArea0AreaInteres').empty();
					$('#CompanyJobProfileDynamicArea0AreaInteres').append('<option value="">Área de interés</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});

					$.each(JSON, function(key, val){
						$('#CompanyJobProfileDynamicArea0AreaInteres').append('<option value="' + val.id + '">' + val.area + '</option>');
						
						if (--waitCount == 0) {
							$('#loading').hide();
							$('.selectpicker').selectpicker('refresh');
						}

					});
					});
				}
				else
				{
					$('#CompanyJobProfileDynamicArea0AreaInteres').empty();
					$('#CompanyJobProfileDynamicArea0AreaInteres').append('<option value="">Área de interés</option>');
					$('.selectpicker').selectpicker('refresh');
				}
			}
	
		// Funcion de carga de áreas
		function cargaAreas(id){
			if($('#CompanyJobProfileDynamicGiro'+id+'Giro').val() != 0)
				{
				$('#loading').show();
				$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpAreas.php',{giro: $('#CompanyJobProfileDynamicGiro'+id+'Giro').val()},function(JSON)
					{
							
					$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').empty();
					$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').append('<option value="">Área de interés</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});

					$.each(JSON, function(key, val){
						$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').append('<option value="' + val.id + '">' + val.area + '</option>');
						
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
					$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').append('<option value="">Área de interés</option>');
					$('.selectpicker').selectpicker('refresh');
				}
		}
	
	// Usadas para elementos dinámicos
	var cont = 1;
	var cont2 = 1;
	var cont3 = 1;
	var cont4 = 1;

	function clonarGiro(){
		var numGiros = $(".maxGiros");
		if(numGiros.length >= 3){			
			jAlert ("S\u00f3lo puedes agregar hasta 3 giros");
			return false;
		} else if (	(document.getElementById("CompanyJobProfileDynamicGiro0Giro").value.length === 0) && 
					(document.getElementById("CompanyJobProfileDynamicArea0AreaInteres").value.length === 0)){
			jAlert ("Ingrese al menos un valor antes de agregar otro giro");
			return false;
		} else {
			$(".contenedorClonesGiros").append(
				'<div id="IdClonGiro'+cont2+'" class="clonGiro'+cont2+' clonGiroIndependiente">'+
				'<div class="form-group">'+
				'<div class="col-md-12 " style="margin-top: -20px;">'+
				'<label for="CompanyJobProfileGiro"></label>'+
				'<div class="col-md-11">'+
				'<button id="eliminarGiro" class="btn btn-danger maxGiros" onclick="eliminarClonGiro('+cont2+'); " type="button" style="margin-left: 5px; padding-left: 6px; padding-right: 5px;margin-bottom: -50px; margin-right: 10px; margin-left: -40px;width: 38px;"><i class="glyphicon glyphicon-trash"></i>&nbsp;</button>'+
				'<select id="CompanyJobProfileDynamicGiro'+cont2+'Giro" onchange="cargaAreas('+cont2+')" class="form-control selectpicker show-tick show-menu-arrow clonGiroInteres'+cont2+' clonGiroReindexa" data-live-search="true" data-width="385px" placeholder="Giro de interés" name="data[CompanyJobProfileDynamicGiro]['+cont2+'][giro]" style="width: 385px;margin-left: 5px;">'+

				
				'</select>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'<div class="form-group">'+
				'<div class="col-md-12 ">'+
				'<label for="CompanyJobProfileAreaInteres"></label>'+
				'<div class="col-md-11">'+
				'<select id="CompanyJobProfileDynamicArea'+cont2+'AreaInteres" class="form-control selectpicker show-tick show-menu-arrow clonAreaReindexa" data-live-search="true" data-width="385px" placeholder="Áreas de interés" name="data[CompanyJobProfileDynamicArea]['+cont2+'][area_interes]" style="width: 385px;margin-left: 5px;">'+
				'<option value="">Área de interés</option>'+

				'</select>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'</div>'
			);
			$('.clonGiroInteres').empty();

			$('#CompanyJobProfileDynamicGiro0Giro').find('option').clone().appendTo('.clonGiroInteres'+cont2);
			cont2++;
			$('.selectpicker').selectpicker('refresh');
		}
	}
	
	function eliminarClonGiro(num){
		$( '.clonGiro'+num ).remove();
	}
	
	function clonarFormacionAcademica(){
		var numFormaciones = $(".maxFormaciones");
		if(numFormaciones.length >= 3){			
			jAlert ("S\u00f3lo puedes agregar hasta 3 formaciones acad\u00e9micas");
			return false;
		} else if (	(document.getElementById("CompanyCandidateProfileDynamicNivelAcademico0AcademicLevel").value.length === 0) && 
					(document.getElementById("CompanyJobRelatedCareerDynamicCarrera0CareerId").value.length === 0) && 
					(document.getElementById("CompanyCandidateProfileDynamicSituacionAcademica0AcademicSituation").value.length === 0)){
			jAlert ("Ingrese al menos un valor antes de agregar otra formación académica");
			return false;
		} else {
			$(".contenedorClonesFormacionAcademica").append(
				'<div id="IdClonFormacionAcademica'+cont3+'" class="clonFormcionAcademica'+cont3+' clonFormcionAcademicaIndependiente">'+
				'<div class="form-group">'+
				'<div class="col-md-12 ">'+
				'<button id="eliminarIdioma" class="btn btn-danger maxFormaciones" onclick="eliminarClonFormacionAcademica('+cont3+'); " type="button" style="margin-left: 5px; padding-left: 5px; padding-right: 5px; border-right-width: 0px; border-left-width: 0px;"><i class="glyphicon glyphicon-trash"></i>&nbsp;</button>'+
				'<label for="CompanyCandidateProfileAcademicLevel"></label>'+
				'<div class="col-md-11">'+
				'<select id="CompanyCandidateProfileDynamicNivelAcademico'+cont3+'AcademicLevel" onchange = "changeAcademicLevel('+cont3+');" class="form-control selectpicker show-tick show-menu-arrow clonNivelAcademico'+cont3+' clonNivelAcademicoReindexa" data-width="385px" name="data[CompanyCandidateProfileDynamicNivelAcademico]['+cont3+'][academic_level]">'+
				
				'</select>'+
				'</div>'+
				'</div>'+
				'</div>'+
				
				'<div id="divCarrerasId'+cont3+'" class="divCarreras"  style="display: none;">'+
				'<div class="form-group">'+
				'<div class="col-md-12 ">'+
				'<label for="CompanyJobRelatedCareerDynamicCarrera'+cont3+'CareerId"></label>'+
				'<div class="col-md-11">'+
				'<select id="CompanyJobRelatedCareerDynamicCarrera'+cont3+'CareerId" class="form-control selectpicker show-tick show-menu-arrow clonCarrera'+cont3+' clonCarreraReindexa" data-width="385px" name="data[CompanyJobRelatedCareerDynamicCarrera]['+cont3+'][career_id]">'+
				
				'</select>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'</div>'+
				
				'<div id="divAreasId'+cont3+'" class="divAreas" style="display: none;">'+
				'<div class="form-group">'+
				'<div class="col-md-12 ">'+
				'<label for="CompanyJobRelatedAreaDynamicArea'+cont3+'AreaId"></label>'+
				'<div class="col-md-11">'+
				'<select id="CompanyJobRelatedAreaDynamicArea'+cont3+'AreaId" class="form-control selectpicker show-tick show-menu-arrow clonArea'+cont3+' clonAreaReindexa" data-width="385px" name="data[CompanyJobRelatedAreaDynamicArea]['+cont3+'][area_id]">'+
				
				'</select>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'</div>'+
				
				'<div style="text-align: left;">'+
				'<p style="margin-left: 15px;">Buscar afines:</p>'+
				'</div>'+
				'<div class="form-group">'+
				'<div class="col-md-offset-8" style="color: #fff; margin-top: -40px;">'+
				'<div class="radio-inline col-md-3">'+
				'<label>'+
				'<input id="CompanyCandidateProfileDynamicBuscarAfines'+cont3+'BuscarAfinesS" class="form-control BuscarAfinesSReindexa" type="radio" value="s" style="margin-left: -18px; margin-top: 0; top: 1px; width: 15px;" name="data[CompanyCandidateProfileDynamicBuscarAfines]['+cont3+'][buscar_afines]">'+
				'<label for="CompanyCandidateProfileDynamicBuscarAfines'+cont3+'BuscarAfinesS">Si</label>'+
				'</label>'+
				'</div>'+
				'<div class="radio-inline col-md-2">'+
				'<label>'+
				'<input id="CompanyCandidateProfileDynamicBuscarAfines'+cont3+'BuscarAfinesN" class="form-control BuscarAfinesNReindexa" type="radio" value="n" style="margin-left: -18px; margin-top: 0; top: 1px; width: 15px;" name="data[CompanyCandidateProfileDynamicBuscarAfines]['+cont3+'][buscar_afines]">'+
				'<label for="CompanyCandidateProfileDynamicBuscarAfines0BuscarAfinesN">No</label>'+
				'</label>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'<div class="form-group">'+
				'<div class="col-md-12 ">'+
				'<label for="CompanyCandidateProfileAcademicSituation"></label>'+
				'<div class="col-md-11">'+
				'<select id="CompanyCandidateProfileDynamicSituacionAcademica'+cont3+'AcademicSituation" class="form-control selectpicker show-tick show-menu-arrow clonSituacionAcademica'+cont3+' clonSituacionAcademicaReindexa" data-width="385px" name="data[CompanyCandidateProfileDynamicSituacionAcademica]['+cont3+'][academic_situation]">'+
				
				'</select>'+
				'</div>'+
				'</div>'+
				'</div>'+
			'</div>'
			);
			
			$('#CompanyCandidateProfileDynamicNivelAcademico0AcademicLevel').find('option').clone().appendTo('.clonNivelAcademico'+cont3);
			$('#CompanyJobRelatedCareerDynamicCarrera0CareerId').find('option').clone().appendTo('.clonCarrera'+cont3);
			$('#CompanyJobRelatedAreaDynamicArea0AreaId').find('option').clone().appendTo('.clonArea'+cont3);
			$('#CompanyCandidateProfileDynamicBuscarAfines0BuscarAfines').find('option').clone().appendTo('.clonBuscarAfines'+cont3);
			$('#CompanyCandidateProfileDynamicSituacionAcademica0AcademicSituation').find('option').clone().appendTo('.clonSituacionAcademica'+cont3);
			
			cont3++;
			$('.selectpicker').selectpicker('refresh');
		}
	}
	
	function eliminarClonFormacionAcademica(num){
		$( '.clonFormcionAcademica'+num ).remove();
	}
		
		function licenciaturaCheck(){
				document.getElementById("estudianteId").style.display="initial"; 
				document.getElementById("egresadoId").style.display="initial"; 
				document.getElementById("tituladoId").style.display="initial"; 
				document.getElementById("diplomaId").style.display="none"; 
				document.getElementById("gradoId").style.display="none"; 
			}
		
		function especialidadCheck(){
				document.getElementById("estudianteId").style.display="initial"; 
				document.getElementById("egresadoId").style.display="initial"; 
				document.getElementById("tituladoId").style.display="none"; 
				document.getElementById("diplomaId").style.display="initial"; 
				document.getElementById("gradoId").style.display="none"; 
			}
			
		function maestriaCheck(){
				document.getElementById("estudianteId").style.display="initial"; 
				document.getElementById("egresadoId").style.display="initial"; 
				document.getElementById("tituladoId").style.display="none"; 
				document.getElementById("diplomaId").style.display="none"; 
				document.getElementById("gradoId").style.display="initial"; 
		}
		
		function doctoradoCheck(){
				document.getElementById("estudianteId").style.display="initial"; 
				document.getElementById("egresadoId").style.display="initial"; 
				document.getElementById("tituladoId").style.display="none"; 
				document.getElementById("diplomaId").style.display="none"; 
				document.getElementById("gradoId").style.display="initial";
		}
		
		function initial(){
				document.getElementById("estudianteId").style.display="initial"; 
				document.getElementById("egresadoId").style.display="initial"; 
				document.getElementById("tituladoId").style.display="initial"; 
				document.getElementById("diplomaId").style.display="initial"; 
				document.getElementById("gradoId").style.display="initial"; 
			}
		
		function unCheck(){
			$("#situacionesId input[type=checkbox]").prop('checked', false);
				
			if ($('#StudentProfessionalProfile0AcademicSituation').is(':checked')) {
				document.getElementById("avanceId").style.display= 'initial'; 
			} else {
				document.getElementById("avanceId").style.display= 'none'; 
				document.getElementById('StudentProfessionalProfileSemester').options[0].selected = 'selected';
			}	
			$('.selectpicker').selectpicker('refresh');
		}
		
		function unCheck2(){
			$("#nivelesId input[type=checkbox]").prop('checked', false);
		}
	
		function updateAcademicSituationList(valor){
			switch (valor) {
				case '1':
					document.getElementById("StudentProfessionalProfile1AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile2AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile3AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile4AcademicSituation").checked=false;
					break;StudentProfessionalProfile0AcademicSituation
				case '2':
					document.getElementById('StudentProfessionalProfileSemester').options[0].selected = 'selected';
					document.getElementById("StudentProfessionalProfile0AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile2AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile3AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile4AcademicSituation").checked=false;
					break;
				case '3':
					document.getElementById('StudentProfessionalProfileSemester').options[0].selected = 'selected';
					document.getElementById("StudentProfessionalProfile0AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile1AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile3AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile4AcademicSituation").checked=false;
					break;
				case '4':
					document.getElementById('StudentProfessionalProfileSemester').options[0].selected = 'selected';
					document.getElementById("StudentProfessionalProfile0AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile1AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile2AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile4AcademicSituation").checked=false;
					break;
				case '5':
					document.getElementById('StudentProfessionalProfileSemester').options[0].selected = 'selected';
					document.getElementById("StudentProfessionalProfile0AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile1AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile2AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile3AcademicSituation").checked=false;
					break;
			}
			
				if ($('#StudentProfessionalProfile0AcademicSituation').is(':checked')) {
					document.getElementById("avanceId").style.display= 'initial'; 
				} else {
					document.getElementById("avanceId").style.display= 'none'; 
					document.getElementById('StudentProfessionalProfileSemester').options[0].selected = 'selected';
				}	
			$('.selectpicker').selectpicker('refresh');
		}
		
		function desabilityMobility(){
			if($("#StudentProfileDisabilityS").is(':checked')) {  
	            var disabilityValue = 's';  
	        } else if($("#StudentProfileDisabilityN").is(':checked')) {  
	            var disabilityValue = 'n';   
	        } else{
				var disabilityValue = '';   
			}
					
			if(disabilityValue == "s"){
				$("#bloque2").show();
			} else {		
				$("#bloque2").hide();
			}
		}
		
		function desabilityMobility1(){
			<?php if(($this->Session->check('StudentProspect.can_travel') == false) and (empty($this->request->data))): ?>
				$( "#StudentProspectCanTravelOption1" ).prop( "checked", false );
				$( "#StudentProspectCanTravelOption2" ).prop( "checked", false );
			<?php endif; ?>
				
			if($("#StudentProspectCanTravelS").is(':checked')) {  
	            var disabilityValue = 's';  
	        } else if($("#StudentProspectCanTravelN").is(':checked')) {  
	            var disabilityValue = 'n';   
	        } else{
				var disabilityValue = '';   
			}

			if(disabilityValue == "s"){
				$("#bloque1").show();
			} else {		
				$("#bloque1").hide();
			}
		}
		
		function desabilityMobility2(){
			<?php if(($this->Session->check('StudentProspect.change_residence') == false) and (empty($this->request->data))): ?>
				$( "#StudentProspectChangeResidenceOption1" ).prop( "checked", false );
				$( "#StudentProspectChangeResidenceOption2" ).prop( "checked", false );
			<?php endif; ?>

			if($("#StudentProspectChangeResidenceS").is(':checked')) {  
	            var disabilityValue = 's';  
	        } else if($("#StudentProspectChangeResidenceN").is(':checked')) {  
	            var disabilityValue = 'n';   
	        } else{
				var disabilityValue = '';   
			}

			if(disabilityValue == "s"){
				$("#bloque3").show();
			} else {		
				$("#bloque3").hide();
			}
		}

	function init_contadorTa(idtextarea, idcontador,max){
			$("#"+idtextarea).keyup(function()
					{
						updateContadorTa(idtextarea, idcontador,max);
					});
			
			$("#"+idtextarea).change(function()
			{
					updateContadorTa(idtextarea, idcontador,max);
			});
			
	}

	function updateContadorTa(idtextarea, idcontador,max){
			var contador = $("#"+idcontador);
			var ta =     $("#"+idtextarea);
			contador.html("0/"+max);
			
			contador.html(ta.val().length+"/"+max);
			if(parseInt(ta.val().length)>max)
			{
				ta.val(ta.val().substring(0,max-1));
				contador.html(max+"/"+max);
			}
	}
	
	function restart(index){
		var textBox = document.getElementById('StudentTechnologicalKnowledge'+index+'Other');
		var textLength = textBox.value.length;
		if(textLength > 0)
		{
			$("#contentName"+index).hide();
			document.getElementById('StudentTechnologicalKnowledge'+index+'Name').options[0].selected = 'selected';
		} else {
			$("#contentName"+index).show();
		}
		$('.selectpicker').selectpicker('refresh');
	}
	
	function hideOther(index){	
		var disabilityValue = $('#StudentTechnologicalKnowledge'+index+'Name').val();
		
		if (disabilityValue != ''){
			$("#contentOther"+index).hide();
			$('#StudentTechnologicalKnowledge'+index+'Other').val('');
		} else {
			$("#contentOther"+index).show();
		}
	}

	function mobilityCityOption(){
		if($("#CompanyJobContractTypeMobilityOption1").is(':checked')) {  
            var valor = '1';  
        } else if($("#CompanyJobContractTypeMobilityOption2").is(':checked')) {  
            var valor = '2';   
        } else{
			var valor = '';   
		}

		if(valor == "1"){
			$('#loading').show();
			$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derp.php',function(JSON)
		   	{
				$('#CompanyJobContractTypeMobilityCity1').empty();
				$('#CompanyJobContractTypeMobilityCity1').append('<option value="">Estado / Entidad Federativa</option>');
				
				var waitCount = 0;
				$.each(JSON, function(key, val){
					waitCount++;
				});

				$.each(JSON, function(key, val){
					if(val.estado == '<?php echo (isset($this->request->data['CompanyJobContractType']['mobility_city']) and ($this->request->data['CompanyJobContractType']['mobility_city'] <> '')) ? $this->request->data['CompanyJobContractType']['mobility_city']: ''; ?>'){
						$('#CompanyJobContractTypeMobilityCity1').append('<option value="' + val.estado + '" selected>' + val.estado + '</option>');
					}else{
						$('#CompanyJobContractTypeMobilityCity1').append('<option value="' + val.estado + '">' + val.estado + '</option>');
					}
					
					if (--waitCount == 0) {
						$('#loading').hide();
						$('.selectpicker').selectpicker('refresh');
						$("#divMobilityCityOption1").show();
					}
				});
		   	});
			
			
		} else 
		if(valor == "2"){
			$('#loading').show();
			$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpPaises.php',function(JSON)
		   	{
				$('#CompanyJobContractTypeMobilityCity1').empty();
				$('#CompanyJobContractTypeMobilityCity1').append('<option value="">País</option>');
				
				var waitCount = 0;
				$.each(JSON, function(key, val){
					waitCount++;
				});
				
				$.each(JSON, function(key, val){
					if(val.pais == '<?php echo (isset($this->request->data['CompanyJobContractType']['mobility_city']) and ($this->request->data['CompanyJobContractType']['mobility_city'] <> '')) ? $this->request->data['CompanyJobContractType']['mobility_city']: ''; ?>'){
						$('#CompanyJobContractTypeMobilityCity1').append('<option value="' + val.pais + '" selected>' + val.pais + '</option>');
					}else{
						$('#CompanyJobContractTypeMobilityCity1').append('<option value="' + val.pais + '">' + val.pais + '</option>');
					}
					
					if (--waitCount == 0) {
						$('#loading').hide();
						$('.selectpicker').selectpicker('refresh');
						$("#divMobilityCityOption1").show();
					}
					
				});
		   	});	

		} else {
			$("#divMobilityCityOption1").hide();
		}

	}
	
	function mobilityCityOption2(){
		if($("#CompanyJobContractTypeChangeResidenceOption1").is(':checked')) {  
            var valor = '1';  
        } else if($("#CompanyJobContractTypeChangeResidenceOption2").is(':checked')) {  
            var valor = '2';   
        } else{
			var valor = '';   
		}

		if(valor == "1"){
			$('#loading').show();
			$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derp.php',function(JSON)
		   {
				$('#CompanyJobContractTypeChangeResidenceState').empty();
				$('#CompanyJobContractTypeChangeResidenceState').append('<option value="">Estado / Entidad Federativa</option>');
				
				var waitCount = 0;
				$.each(JSON, function(key, val){
					waitCount++;
				});

				$.each(JSON, function(key, val){
					if(val.estado == '<?php echo (isset($this->request->data['CompanyJobContractType']['change_residence_state']) and ($this->request->data['CompanyJobContractType']['change_residence_state'] <> '')) ? $this->request->data['CompanyJobContractType']['change_residence_state']: ''; ?>'){
						$('#CompanyJobContractTypeChangeResidenceState').append('<option value="' + val.estado + '" selected>' + val.estado + '</option>');
					}else{
						$('#CompanyJobContractTypeChangeResidenceState').append('<option value="' + val.estado + '">' + val.estado + '</option>');
					}
					
					if (--waitCount == 0) {
						$('#loading').hide();
						$('.selectpicker').selectpicker('refresh');
						$("#divMobilityCityOption2").show();
					}
				});
		   	});	
		} else 
		if(valor == "2"){
			$('#loading').show();
			$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpPaises.php',function(JSON)
		   	{
				$('#CompanyJobContractTypeChangeResidenceState').empty();
				$('#CompanyJobContractTypeChangeResidenceState').append('<option value="">País</option>');
				
				var waitCount = 0;
				$.each(JSON, function(key, val){
					waitCount++;
				});
				
				$.each(JSON, function(key, val){
					if(val.pais == '<?php echo (isset($this->request->data['CompanyJobContractType']['change_residence_state']) and ($this->request->data['CompanyJobContractType']['change_residence_state'] <> '')) ? $this->request->data['CompanyJobContractType']['change_residence_state']: ''; ?>'){
						$('#CompanyJobContractTypeChangeResidenceState').append('<option value="' + val.pais + '" selected>' + val.pais + '</option>');
					}else{
						$('#CompanyJobContractTypeChangeResidenceState').append('<option value="' + val.pais + '">' + val.pais + '</option>');
					}
					
					if (--waitCount == 0) {
						$('#loading').hide();
						$('.selectpicker').selectpicker('refresh');
						$("#divMobilityCityOption2").show();
					}
				});
		   	});	

		} else {
			$("#divMobilityCityOption2").hide();
		}

	}
		
		function ordenarSelect(idSelect){
			  var selectToSort = jQuery('#' + idSelect);
			  var optionActual = selectToSort.val();
			  selectToSort.html(selectToSort.children('option').sort(function (a, b) {
				return a.text === b.text ? 0 : a.text < b.text ? -1 : 1;
			  })).val(optionActual);
		}
	
		function pasaCarreras(){
			// Selecciona las carreras y las pasa al contenedor destino
			var arrayCarreras = new Array();
			var indexArray = 0;
				
			<?php if(isset($this->request->data['CompanyJobRelatedCareer']) and (!empty($this->request->data['CompanyJobRelatedCareer']))){ ?>
				var totalCarreras = <?php echo count($this->request->data['CompanyJobRelatedCareer']); ?>;
				<?php foreach($this->request->data['CompanyJobRelatedCareer'] as $k => $Carrera): ?>
				arrayCarreras[indexArray] = <?php echo $Carrera['career_id']; ?>;
				indexArray++;
				<?php endforeach; ?>
			<?php } else { ?> 
				var totalCarreras = 0;
			<?php } ?> 
			
			if(totalCarreras>0){
				$("#origen option").each(function () {
					for( c = 0; c < totalCarreras; c++ ){
						if($(this).val() == arrayCarreras[c]){
							$('#origen option[value='+$(this).val()+']').attr('selected','selected');
						}
					}
					$('#origen option:selected').remove().appendTo('#destino'); 
				});
			}
			ordenarSelect('origen'); 
			ordenarSelect('destino');
		}
	
		$().ready(function(){
			$('.pasar').click(function() { return !$('#origen option:selected').remove().appendTo('#destino'); });  
			$('.quitar').click(function() { return !$('#destino option:selected').remove().appendTo('#origen');  });
			$('.pasartodos').click(function() { $('#origen option').each(function() { $(this).remove().appendTo('#destino'); }); });
			$('.quitartodos').click(function() { $('#destino option').each(function() { $(this).remove().appendTo('#origen'); }); });
			$('.submit').click(function() { $('#destino option').prop('selected', 'selected'); });
		});
		
		function semestre(valor){
				if (valor==1) {
					document.getElementById("StudentProfessionalProfile1AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile2AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile3AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile4AcademicSituation").checked=false;
				} else
					if (valor==2) {
					document.getElementById("StudentProfessionalProfile0AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile2AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile3AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile4AcademicSituation").checked=false;
				} else
					if (valor==3) {
					document.getElementById("StudentProfessionalProfile0AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile1AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile3AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile4AcademicSituation").checked=false;
				} else
					if (valor==4) {
					document.getElementById("StudentProfessionalProfile0AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile1AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile2AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile4AcademicSituation").checked=false;
				} else
					if (valor==5) {
					document.getElementById("StudentProfessionalProfile0AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile1AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile2AcademicSituation").checked=false;
					document.getElementById("StudentProfessionalProfile3AcademicSituation").checked=false;
				}

				if ($('#StudentProfessionalProfile0AcademicSituation').is(':checked')) {
					document.getElementById("avanceId").style.display= 'initial'; 
				} else {
					document.getElementById("avanceId").style.display= 'none'; 
					document.getElementById('StudentProfessionalProfileSemester').options[0].selected = 'selected';
				}	

		}
		
		function academicSituation(){
			var licenciatura = 0;
			var especialidad = 0;
			var maestria = 0;
			var doctorado = 0;
				
			if ($('#StudentProfessionalProfileLicenciatura').is(':checked')) { licenciatura = 1; }
			if ($('#StudentProfessionalProfileEspecialidad').is(':checked')) { especialidad = 1; }
			if ($('#StudentProfessionalProfileMaestria').is(':checked')) { maestria = 1; }
			if ($('#StudentProfessionalProfileDoctorado').is(':checked')) { doctorado = 1; }	
			
			if ((licenciatura == 1) && ((especialidad == 0)  || (maestria == 0) || (doctorado == 0))){ licenciaturaCheck(); }
			if ((especialidad == 1)  && ((maestria == 0) || (doctorado == 0))){ especialidadCheck(); }
			if ((maestria == 1) && (doctorado == 0)){ maestriaCheck(); }
			if (doctorado == 1){ doctoradoCheck(); }
			
		}

		function actualizaCarreras(){
			$('#origen').empty();
			$('#destino').empty();
			
			var liceciatura = $('#StudentProfessionalProfileLicenciatura').is(':checked'); 
			var especialidad = $('#StudentProfessionalProfileEspecialidad').is(':checked'); 
			var maestria = $('#StudentProfessionalProfileMaestria').is(':checked'); 
			var doctorado = $('#StudentProfessionalProfileDoctorado').is(':checked'); 

			if((especialidad) || (maestria) || (doctorado)){	
					$('#loading').show();
					$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpCarreras.php',{escuela: '', level: 2 },function(JSON){
						
						var waitCount = 0;
						$.each(JSON, function(key, val){
							waitCount++;
						});

						$.each(JSON, function(key, val){
							$('#origen').append('<option title="' + val.carrera + '" value="' + val.id + '">' + val.carrera + '</option>');	
							
							if (--waitCount == 0) {
								$('#loading').hide();
								ordenarSelect('origen');
								ordenarSelect('destino');
								pasaCarreras();
								$('.selectpicker').selectpicker('refresh');
							}
						});
						
					});	
			}
			
			if(liceciatura){	
					$('#loading').show();
					$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpCarreras.php',{escuela: '', level: 1 },function(JSON){
						
						var waitCount = 0;
						$.each(JSON, function(key, val){
							waitCount++;
						});
						
						$.each(JSON, function(key, val){
							$('#origen').append('<option title="' + val.carrera + '"  value="' + val.id + '">' + val.carrera + '</option>');	
							
							if (--waitCount == 0) {
								$('#loading').hide();
								ordenarSelect('origen');
								ordenarSelect('destino');
								pasaCarreras();
								$('.selectpicker').selectpicker('refresh');
							}
							
						});
						$('#loading').hide();
						ordenarSelect('origen');
						ordenarSelect('destino');
						pasaCarreras();
					});	
			}
			academicSituation();
		}
		
		function addName(){
			jPrompt('Ingrese el nombre de la búsqueda','','Guardar búsqueda', function(r){
					if( r ){
							document.getElementById("CompanySavedSearchName").value = r;
							document.getElementById("requestForm").submit();
					} 
				});
		}

		function viewSearch(){
			 selectedIndex = document.getElementById("CompanyBusquedaGuardada").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				document.getElementById("viewSearchId").submit();
			 }
		}
		
		function contarPalabras(){
			var palabrasClave = document.getElementById("CompanyJobProfileJobName").value;
			textoAreaDividido = palabrasClave.split(" ");
			numeroPalabras = textoAreaDividido.length;
			
			if((document.getElementById("CompanyJobProfileJobName").value != '') && (numeroPalabras>4)){
				jAlert('Sólo puede ingresar 4 palabras clave y separadas por un espacio');
				return false;
			} else {
				return true;
			}
		}
		
		function promedio(){
			var promedio = $('#StudentProfessionalProfileAverageId').val();
			if(promedio == 1){
				document.getElementById('StudentProfessionalProfileDecimalAverageId').options[10].selected = 'selected';
				$('.selectpicker').selectpicker('refresh');
			}
		}
	</script>

	<div class="col-md-12">
	<?php echo $this->Session->flash(); ?>	
	</div>
	
	<div class="col-md-12" style="margin-top: 15px; margin-left: 20px; font-size: 12px;">
		
	<div class="col-md-3" style="padding-left: 0px;">
		<?php echo $this->Session->flash(); ?>	

			<?php
				echo $this->Form->create('Company', array(
												'class' => 'form-horizontal', 
												'role' => 'form',
												'inputDefaults' => array(
														'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
														'div' => array('class' => 'form-group row'),
														'class' => 'form-control',
														'before' => '<div class="col-md-12"><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
														'between' => ' <div class="col-md-6">',
														'after' => '</div></div>',
														'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
												),
										'action' => '',
										'onsubmit' =>'addName(); return false;'
				)); 
			?>
			<?php 
				echo $this->Form->input('Guardar Búsqueda', array(
													'type' => 'submit',
													'label' => '',
													'class' => 'btn btnBlue btn-default form-control',
													'escape' => true,
													'style' => 'width: 250px;margin-left: 10px;',
													'before' => '<div class="col-md-4 "><img data-toggle="tooltip" id="" data-placement="left" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-bottom: -10px;">',
												)
				);
				echo $this->Form->end(); 
			?>
	</div>
	<div class="col-md-3 col-md-offset-1">
			<?php 
				echo $this->Form->create('Company', array(
											'class' => 'form-horizontal', 
											'id' => 'viewSearchId',
											'role' => 'form',
											'inputDefaults' => array(
													'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
													'div' => array('class' => 'form-group'),
													'class' => 'form-control',
													'before' => '<div class="col-md-6 "><img data-toggle="tooltip" id="" data-placement="left" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
													'between' => ' <div class="col-md-12">',
													'after' => '</div></div>',
													'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
											),
											'action' => 'specificSearchCandidateResults',
							));	
							
				echo $this->Form->input('busqueda_guardada', array(
																	'type'=>'select',
																	'label' => '',
																	'onchange' => 'viewSearch()' ,
																	'class' => 'form-horizontal', 
																	'role' => 'form',
																	'class' => 'form-control selectpicker show-tick show-menu-arrow',
																	'before' => '<div class="col-md-12" style="padding-right: 0px; padding-left: 0px;">',
																	'between' => ' <div class="col-md-12" >',
																	// 'style' =>'margin-top: -49px; margin-left: 295px;',
																	'after' => '</div></div>',
																	'options' => $busquedasGuardadas,'default'=>'0', 'empty' => 'Búsquedas guardadas'
						)); 
				echo $this->Form->end();
			?>
	</div>
	
	<div class="col-md-2 col-md-offset-5" style="text-align: left; margin-top: -15px; border-left-width: 0px; left: 70px;">
		<p> (máx. 10)</p>
	</div>
			
			<?php 
					echo $this->Form->create('Company', array(
									'class' => 'form-horizontal',
									'id' => 'requestForm',
									'role' => 'form',
									'inputDefaults' => array(
											'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
											'div' => array('class' => 'form-group'),
											'class' => 'form-control',
											'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="left" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
											'between' => ' <div class="col-md-11">',
											'after' => '</div></div>',
											'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
									),
									'onsubmit' =>'return contarPalabras();',
									'action' => 'specificSearchCandidateResults',
					)); 
			?>
					
			<?php 	$options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200);
								echo $this->Form->input('Student.limit', array(
																'type'=>'select',
																'class' => 'form-control selectpicker show-tick show-menu-arrow',
																'data-width'=>"200px",
																'between' => ' <div class="col-md-3" style="width: 200px; margin-left: 590px; margin-top: -70px;">',
																'before' => '<div class="col-md-12 "',
																'selected' => $this->Session->read('limit'),
																'label' =>'',
																'options' => $options,'default'=>'0', 'empty' => 'Resultados por hoja'
			)); ?>


			<div class="col-md-12" style="margin-left: -16px;">	
					<div class="col-md-12" style="padding-left: 15px; padding-right: 10px;">	
						<div style="text-align: left;">
							<p style="margin-left: 15px;"> Palabras clave</p>
						</div>
			
						<?php // name for save search 
						echo $this->Form->input('CompanySavedSearch.name', array(
										'label' => '',
										'type' => 'hidden',
						));	?>
							
						<?php 	echo $this->Form->input('CompanyJobProfile.job_name', array(
									'label' => '',
									'placeholder' => 'Palabras clave',
									'maxlength' => 60,
									'before' => '<div class="col-md-6 ">',
						));	?>
						</div>

						<div style="text-align: left;" class="col-md-offset-4">
						<p style="margin-top: -15px;margin-left: -23px;"> 60 caracteres máx.</p>
				</div>						
			</div>

			<div class="col-md-12">	
				<div class="col-md-6" style="margin-left: -16px;">	
					<div style="text-align: left;">
						<p style="margin-left: 15px;"> Perfil de candidatos</p>
					</div>
					
					<div class="col-md-12">
						<?php echo $this->Form->input('StudentProfile.sex', array(
																			'type'=>'select',
																			'before' => '<div class="col-md-12" style="margin-left: 5px;>',
																			'label' => '',
																			'class' => 'form-control selectpicker show-tick show-menu-arrow',
																			'between' => ' <div class="col-md-12" style="margin-left: -21px;">',
																			'options' => $Sexo,'default'=>'0', 'empty' => 'Sexo'
								)); ?>
					</div>
					
						<div class="col-md-12">
							<div class="col-md-6">
							<?php 	
								for($i=14; $i<=99; $i++):
									$option[$i] = $i;
								endfor;
											echo $this->Form->input('Student.fecha_minima', array(
																			'type'=>'select',
																			'before' => '<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;">',
																			'between' => ' <div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">',
																			'label' => '',
																			'class' => 'form-control selectpicker show-tick show-menu-arrow',
																			'placeholder'=>'Edad max', 
																			'options' => $option,'default'=>'', 'empty' => 'Edad mínima'
																			
										));?>
							</div>			
							<div class="col-md-6">
										<?php 	echo $this->Form->input('Student.fecha_maxima', array(
																			'type'=>'select',
																			'before' => '<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;">',
																			'between' => ' <div class="col-md-10" style="padding-left: 0px; padding-right: 0px;margin-left: 2px;">',
																			'label' => '',
																			'class' => 'form-control selectpicker show-tick show-menu-arrow',
																			'placeholder'=>'Edad min',
																			'options' => $option,'default'=>'', 'empty' => 'Edad máxima'
																			
										));?>
							</div>	
					</div>

					<div class="col-md-12" >
								<?php 	
										$options = array('s' => 'Si', 'n' => 'No');
										echo $this->Form->input('StudentProfile.disability', array(
															'type' => 'radio',
															'style' => 'margin-left: -18px; margin-top: 0; top: 7px; width: 15px;height:15px',
															'default'=> 0,
															'legend' => false,
															'before' => '<div class="col-xs-12 col-sm-12 col-md-9" style="color: #fff;"><div class="radio-inline col-xs-2 col-sm-2 col-md-2" style="margin-left: 260px;"><label>',
															'after' => '</label></div></div>',
															'separator' => '</label></div><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
															'options' => $options,
															'onclick' => 'desabilityMobility()'
										));
								?>

								<p style="position: absolute; margin-top: -46px;">Discapacidad</p>
								<div class="col-md-offset-11" style="top: -45px;">
									<img style=" float: right; margin-top: -45px; position: absolute; right: 15px;" data-toggle="tooltip"  data-placement="top" title="Es un programa que ofrece u oferta vacantes a candidatos con discapacidad con todas las prerrogativas de la ley y cuentan con las condiciones necesarias para el desarrollo de las actividades dentro de sus procesos de trabajo." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">
								</div>

								<div id="bloque2" style="display:none">
									<?php 	echo $this->Form->input('StudentProfile.disability_type', array(
																	'type'=>'select',
																	'before' => '<div class="col-md-12" style="margin-left: 5px;>',
																	'label' => '',
																	'class' => 'form-control selectpicker show-tick show-menu-arrow',
																	'between' => ' <div class="col-md-12" style="margin-left: -21px;">',
																	'options' => $TiposDiscapacidad,'default'=>'0', 'empty' => 'Tipo de discapacidad'
									)); ?>
								</div>
							</div>

					<p style="margin-left: 15px;">Lugar de trabajo</p>
							
							<?php 	
								echo $this->Form->input('StudentProfile.state', array(	
															'type' => 'select',
															'id' =>'estado',
															'between' => ' <div class="col-md-12" style="margin-left: 8px; margin-top: -17px; padding-left: 6px;">',
															'before' => '<div class="col-md-11">',
															'class' => 'form-control selectpicker show-tick show-menu-arrow',
															'data-live-search' => 'true',
															'label' => '',
															'required' => false,
															'options' => $estadosMexico,'default'=>'0', 'empty' => 'Estado / Entidad Federativa',
							)); ?>	
							
							<?php 
								echo $this->Form->input('StudentProfile.city', array(	
															'type' => 'select',
															'id' => 'ciudad',
															'class' => 'form-control selectpicker show-tick show-menu-arrow',
															'data-live-search' => 'true',
															'between' => ' <div class="col-md-12" style="margin-left: 8px; margin-top: -17px; padding-left: 6px;">',
															'before' => '<div class="col-md-11">',
															'label' => '',
															'required' => false,
															'default'=>'0', 'empty' => 'Delegación / Municipio',
							)); ?>

			<fieldset class='col-md-offset-0 col-md-10' style="min-width: 850px;">
				
				<p style="margin-bottom: 0px;margin-left:-2px;"><span style="color:red;"></span>Nivel académico<img data-toggle="tooltip" id="" data-placement="right" title="Grado de estudios que debe tener el candidato para cumplir con el perfil de la oferta." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 5px; margin-top: -5px;"></p>
					<div id="nivelesId" class="col-md-12" style="padding-left: 0px; margin-bottom: 10px;">
						<div class="col-md-2" style="padding-left: 0px; padding-right: 0px; margin-right: 15px;">	
							<?php echo $this->Form->checkbox('StudentProfessionalProfile.licenciatura', array(
											'value' => '1',
											'label' => '',
											'style' => 'display: inline',
											'onClick' => 'actualizaCarreras("1");',
							));?><span class="titulos">Licenciatura</span>
						</div>
						<div class="col-md-2" style="padding-left: 0px; padding-right: 0px;">	
							<?php echo $this->Form->checkbox('StudentProfessionalProfile.especialidad', array(
											'value' => '1',
											'label' => '',
											'style' => 'display: inline',
											'onClick' => 'actualizaCarreras("2");',
							));?><span class="titulos">Especialidad</span>
						</div>
						<div class="col-md-2" style="padding-left: 0px; padding-right: 0px;">	
							<?php echo $this->Form->checkbox('StudentProfessionalProfile.maestria', array(
											'value' => '1',
											'label' => '',
											'style' => 'display: inline',
											'onClick' => 'actualizaCarreras("3");',
							));?><span class="titulos">Maestría</span>
						</div>
						<div class="col-md-2" style="padding-left: 0px; padding-right: 0px;">	
							<?php echo $this->Form->checkbox('StudentProfessionalProfile.doctorado', array(
											'value' => '1',
											'label' => '',
											'style' => 'display: inline',
											'onClick' => 'actualizaCarreras("4");',
							));?><span class="titulos">Doctorado</span>
						</div>
					</div>
							
				<p style="margin-bottom: 0px;margin-left:-2px;"><span style="color:red;"></span>Situación académica del último nivel de estudios seleccionado<img data-toggle="tooltip" id="" data-placement="top" title="Situación académica requerida para cumplir con el perfil de la oferta" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 5px; margin-top: -5px;"></p>
					<div id="situacionesId"  class="col-md-12" style="padding-left: 0px; padding-right: 0px; margin-bottom: 20px;">
						
						<div id="estudianteId" class="col-md-2"  style="padding-left: 0px; padding-right: 0px; margin-right: 15px;" >
							<?php echo $this->Form->checkbox('StudentProfessionalProfile.0.academic_situation', array(
											'value' => '1',
											'label' => '',
											'style' => 'display: inline',
											'onClick' => 'semestre("1");',
							));?><span class="titulos" style="margin-right: 0px;">Estudiante</span>
						</div>
						<div id="egresadoId" class="col-md-2"   style="padding-left: 0px; padding-right: 0px; margin-right: -5px;">
							<?php echo $this->Form->checkbox('StudentProfessionalProfile.1.academic_situation', array(
											'value' => '2',
											'label' => '',
											'style' => 'display: inline',
											'onClick' => 'semestre("2");',
							));?><span class="titulos" style="margin-right: 0px;">Egresado</span>
						</div>
						<div id="tituladoId" class="col-md-2"   style="padding-left: 0px; padding-right: 0px; margin-right: 0px;">
							<?php echo $this->Form->checkbox('StudentProfessionalProfile.2.academic_situation', array(
											'value' => '3',
											'label' => '',
											'style' => 'display: inline',
											'onClick' => 'semestre("3");',
							));?><span class="titulos" style="margin-right: 0px;">Titulado</span>
						</div>
						<div id="diplomaId" class="col-md-2"  style="padding-left: 0px; padding-right: 0px; margin-right: 15px;">
							<?php echo $this->Form->checkbox('StudentProfessionalProfile.3.academic_situation', array(
											'value' => '4',
											'label' => '',
											'style' => 'display: inline',
											'onClick' => 'semestre("4");',
							));?><span class="titulos" style="margin-left: 15px; margin-right: 0px;">Con diploma</span>
						</div>
						<div id="gradoId" class="col-md-2"  style="padding-left: 0px; padding-right: 0px; margin-right: 15px;">
							<?php echo $this->Form->checkbox('StudentProfessionalProfile.4.academic_situation', array(
											'value' => '5',
											'label' => '',
											'style' => 'display: inline',
											'onClick' => 'semestre("5");',
							));?><span class="titulos" style="margin-right: 0px;">Con grado</span>
						</div>
					</div>
					<div class="col-md-12" style="padding-left: 0px;">	
						<div id="avanceId" style="display: none">
							<p style="margin-left:-5px;">Avance académico:</p>
								<?php 	echo $this->Form->input('StudentProfessionalProfile.semester', array(										
												'type' =>'select',
												'class' => 'form-control selectpicker show-tick show-menu-arrow',
												'data-width' => '385px',
												'label' => '',
												'before' => '<div class="col-md-12" style="padding-left: 0px;">',
												'options' => $Semestres,'default'=>'0', 'empty' => 'Avance académico',
								)); ?>	
						</div>
					</div>	
					
					<p style="margin-left: 0px;">Promedio</p>
					
					<div class="col-md-6" style="padding-left: 5px; padding-right: 0px;">	
						<div class="col-md-6" style="padding-left: 8px; padding-right: 19px;">
									<?php echo $this->Form->input('StudentProfessionalProfile.average_id', array(
																'type'=>'select',
																			'before' => '<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;">',
																			'between' => ' <div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">',
																			'label' => '',
																			'class' => 'form-control selectpicker show-tick show-menu-arrow',
																			'placeholder'=>'Promedio', 
																'options' => $Promedios,'default'=>'0', 'empty' => 'Promedio',
																'onchange' => 'promedio()',
									)); ?>
						</div>
						<div class="col-md-6">
									<?php echo $this->Form->input('StudentProfessionalProfile.decimal_average_id', array(
																'type'=>'select',
																			'before' => '<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;">',
																			'between' => ' <div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">',
																			'label' => '',
																			'class' => 'form-control selectpicker show-tick show-menu-arrow',
																'placeholder' => 'Decimal',
																'options' => $Decimales,'default'=>'0', 'empty' => 'Decimas',
																'onchange' => 'promedio()',
									)); ?>
						</div>
					</div>
						
					<div class="col-md-12" style="padding-left: 0px;">	
						<p style="margin-left: -2px;">
						<span style="color:red;"></span>
						Carreras / Áreas
						</p>
					</div>
						
					<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">	
						<div class="col-md-6" style="padding-left: 0px; padding-right: 0px;">
							<?php 	echo $this->Form->input('CompanyCandidateProfile.origen', array(
												'type'=>'select',
												'label' => '',
												'before' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 25px;">',
												'between' => ' <div class="col-md-12" >',
												'name' => 'origen[]',
												'multiple'=>'multiple',
												'id' => 'origen',
												'size' => '8',
												'style' => 'max-height: 150px;',
												'options' => $careers,
												'options' => ''
								)); ?>
						</div>	
						
						<div class="col-md-1" style="padding-left: 0px;margin-left: -10px;">
								<button type="button" id="pasarDerechaId" class="pasar izq btn btnBlue btn-default" style=" margin-bottom: 10px;" >
								<span class="glyphicon glyphicon-chevron-right"></span>
								</button>
								<button type="button" class="quitar der btn btnBlue btn-default">
								<span class="glyphicon glyphicon-chevron-left"></span>
								</button>
								<!--input type="button" class="pasartodos izq" value="Todos »"><input type="button" class="quitartodos der" value="« Todos"-->
						</div>
						
						<div class="col-md-5" style="padding-left: 0px; padding-right: 0px;">
							<div class="form-group required">
								<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
								<img style=" float: right; margin-top: 130px; position: absolute; left: 375px;" data-toggle="tooltip"  data-placement="left" title="Seleccionar las carreras http://www.oferta.unam.mx/ y/o programas de posgrado http://www.posgrado.unam.mx/ofertas-de-posgrado-0  que son los adecuados o afines para cubrir el puesto. Puede agregar o eliminar opciones." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">
									<div class="col-md-12" style="padding-left: 0px; padding-right: 0px; color: rgb(85, 85, 85); font-size: 14px;">
										<select name="destino[]" id="destino" multiple="multiple" size="10" style="width: 100%;height: 150px;"></select>

									</div>
								</div>
							</div>
						</div>
					</div>
					
					
<div class="col-md-12">
	<div class="col-md-6">
		<div class="col-md-12" style="margin-left: -45px;">
				<div class="col-md-9" style="margin-left: -50px;">
					<div style="text-align: left;" class="col-md-offset-1 col-md-12">
						<p>Modalidad de contratación</p>
					</div>

					<div class="col-md-11">	
									<?php 	echo $this->Form->input('StudentWorkArea.job_name', array(
													'before' => '<div class="col-md-12 ">',
													'style' => 'width: 385px;margin-left: 6px;',
													'required' => false,
													'label' => array(
															'class' => 'col-md-0 control-label',
															'text' => ''),
															'placeholder' => 'Puesto',
									));	?> 	
					</div>

					<div class="col-md-11" style="margin-left: 5px;">	

					<?php 	echo $this->Form->input('StudentProspect.economic_pretension', array(
															'type' => 'select',
															'class' => 'form-control selectpicker show-tick show-menu-arrow',
															'data-width' => '385px',
															'before' => '<div class="col-md-12 ">',
															'label' => array(
																	'class' => 'col-md-0 control-label',
																	'text' => ''),
															'placeholder' => '',
															'options' => $Salarios,'default'=>'0', 'empty' => 'Pretensiones económicas'
					));	?>
					</div>
				
					<div class="col-md-11" style="margin-left: 5px;">	

					<div id="original" class="clonGiro">
					<?php 	echo $this->Form->input('CompanyJobProfileDynamicGiro.0.giro', array(
									'type'=>'select',
									'class' => 'form-control clonGiroReindexa selectpicker show-tick show-menu-arrow',
									'data-live-search' => "true",
									'data-width' => '385px',
									'before' => '<div class="col-md-12 ">',
									'label' => '',
									'placeholder' => 'Giro',
									'style' => 'width: 385px;margin-left: 5px;',
									'onchange' => 'cargaAreas(0)',
									'options' => $Giros,'default'=>'0', 'empty' => 'Giro de interés',
					));	?>
					<?php 	echo $this->Form->input('CompanyJobProfileDynamicArea.0.area_interes', array(
									'type'=>'select',
									'class' => 'form-control clonAreaReindexa selectpicker show-tick show-menu-arrow',
									'data-live-search' => "true",
									'data-width' => '385px',
									'before' => '<div class="col-md-12 ">',
									'label' => '',
									'style' => 'width: 385px;margin-left: 5px;',
									'placeholder' => 'Áreas de interés',
									'default'=>'0', 'empty' => 'Área de interés',
					));	?>
					</div>
					
					<div class="contenedorClonesGiros">
					
					
					</div>

					</div>
				</div>
			</div>

			<div class="col-md-12" style="margin-left: 28%;">
				<p>Agregar otro giro y área (máx. 3) <img src="<?php echo $this->webroot; ?>/img/add.png" id="agregarGiro" onclick="clonarGiro();" style='background-color: transparent; width: 25px;cursor:pointer;margin-top: -5px;'> </p>
			</div>

					<div class="col-md-12" style="margin-left: -50px;">
								<?php 	
										$options = array('s' => 'Si', 'n' => 'No');
										echo $this->Form->input('StudentProspect.can_travel', array(
															'type' => 'radio',
															'style' => 'margin-left: -18px; margin-top: 0; top: 7px; width: 15px;height:15px',
															'default'=> 0,
															'legend' => false,
															'before' => '<div class="col-xs-12 col-sm-12 col-md-9" style="color: #fff;margin-left: 285px;"><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
															'after' => '</label></div></div>',
															'separator' => '</label></div><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
															'options' => $options,
															'onclick' => 'desabilityMobility1()'
										));
								?>

							<p style="position: absolute; margin-top: -46px;"><span style="color:red;"></span>Disponibilidad para viajar</p>
						</div>

						<div id="bloque1" style="display:none">
								<div class="col-md-12" >
									<?php 	
										$options = array('1' => 'Dentro del país', '2' => 'Fuera del país');
										echo $this->Form->input('StudentProspect.can_travel_option', array(
															'type' => 'radio',
															'style' => 'margin-left: -18px; margin-top: 0; top: 7px; width: 15px;height:15px',
															'default'=> 0,
															'legend' => false,
															'before' => '<div class="col-xs-12 col-sm-12 col-md-12" style="color: #fff;margin-left:87px"><div class="radio-inline col-xs-5 col-sm-5 col-md-5"><label>',
															'after' => '</label></div></div>',
															'separator' => '</label></div><div class="radio-inline col-xs-5 col-sm-5 col-md-5"><label>',
															'options' => $options,
										));
										
									?>
							</div>
						</div>
							
							<div class="col-md-12" style="margin-left: -50px;">
								<?php 	
										$options = array('s' => 'Si', 'n' => 'No');
										echo $this->Form->input('StudentProspect.change_residence', array(
															'type' => 'radio',
															'style' => 'margin-left: -18px; margin-top: 0; top: 7px; width: 15px;height:15px',
															'default'=> 0,
															'legend' => false,
															'before' => '<div class="col-xs-12 col-sm-12 col-md-9" style="color: #fff;margin-left: 285px;"><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
															'after' => '</label></div></div>',
															'separator' => '</label></div><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
															'options' => $options,
															'onclick' => 'desabilityMobility2()'
										));
								?>

								<p style="position: absolute; margin-top: -46px;  width: 210px;"><span style="color:red;"></span>Disponibilidad para cambiar de residencia</p>
							</div>
							<div id="bloque3" style="display:none">
								<div class="col-md-12" >
								<?php 	
										$options = array('1' => 'Dentro del país', '2' => 'Fuera del país');
										echo $this->Form->input('StudentProspect.change_residence_option', array(
															'type' => 'radio',
															'style' => 'margin-left: -18px; margin-top: 0; top: 7px; width: 15px;height:15px',
															'default'=> 0,
															'legend' => false,
															'before' => '<div class="col-xs-12 col-sm-12 col-md-12" style="color: #fff;margin-left:87px;margin-top: -5px;"><div class="radio-inline col-xs-5 col-sm-5 col-md-5"><label>',
															'after' => '</label></div></div>',
															'separator' => '</label></div><div class="radio-inline col-xs-5 col-sm-5 col-md-5"><label>',
															'options' => $options,
										));
								?>
								</div>
							

							</div>
		</div>
	<div class="col-md-6">
		<div>
			<div style="margin-right: 8px; margin-left: -21px;width: 450px;margin-top: 2px;">	
				<div id="contenedorIdiomas" style="width: 436px;">	
						<div class="col-md-12 col-md-offset-1">
							<p>Conocimientos y habilidades profesionales</p>
							<p>Idioma</p>
						</div>
						<?php 	echo $this->Form->input('StudentLenguage.0.language_id', array(
										'type'=>'select',
										'required' => false,
										'class' => 'form-control selectpicker show-tick show-menu-arrow',
										'data-live-search' => 'true',
									    'before' => '<div class="col-md-12 ">',
										'between' => ' <div class="col-md-11 col-md-offset-1">',
										'label' => '',
										'options' => $Lenguages,'default'=>'0', 'empty' => 'Idioma'
						));?>
						<?php 	echo $this->Form->input('StudentLenguage.0.reading_level', array(
										'type'=>'select',
										'class' => 'form-control selectpicker show-tick show-menu-arrow',
										'required' => false,
										'before' => '<div class="col-md-12 col-md-offset-1" >',
										'between' => ' <div class="col-md-7" style="margin-left: -3px;">',
										'label' => array(
												'class' => 'col-md-4 control-label',
												'text' => 'Lectura'),
										'placeholder' => 'Nivel',
										'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel'
						));	?>
						<?php 	echo $this->Form->input('StudentLenguage.0.writing_level', array(
										'type'=>'select',
										'required' => false,
										'before' => '<div class="col-md-12 col-md-offset-1">',
										'between' => ' <div class="col-md-7" style="margin-left: -3px;">',
										'class' => 'form-control selectpicker show-tick show-menu-arrow',
										'label' => array(
												'class' => 'col-md-4 control-label',
												'text' => 'Escritura'),
										'placeholder' => 'Nivel',
										'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel'
						));	?>
						<?php 	echo $this->Form->input('StudentLenguage.0.conversation_level', array(
										'type'=>'select',
										'required' => false,
										'before' => '<div class="col-md-12 col-md-offset-1">',
										'between' => ' <div class="col-md-7" style="margin-left: -3px;">',
										'class' => 'form-control selectpicker show-tick show-menu-arrow',
										'label' => array(
												'class' => 'col-md-4 control-label',
												'style' => 'margin-left: 0px; padding-left: 52px;',
												'text' => 'Conversación'),
										'placeholder' => 'Nivel',
										'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel'
						));	?>
						
						<script languaje="javascript">
							var x = 1;
						</script> 
					
						<?php 
							$cont = 0;
							if(!empty($this->request->data['StudentLenguage'])):
								foreach($this->request->data['StudentLenguage'] as $k => $idioma): 
									if($cont > 0):
						?>
										<div id="divIdiomas"> 	
											<button type="button" class="btn btn-danger eliminar"  style="float: right; margin-bottom: -30px; margin-top: -5px; margin-right: -18px;"><i class="glyphicon glyphicon-trash"></i></button>
											<div class="col-md-4 col-md-offset-1">
												<p>Idioma</p>
											</div>
											<?php 	echo $this->Form->input('StudentLenguage.'.$cont.'.language_id', array(
															'type'=>'select',
															'before' => '<div class="col-md-12 ">',
															'required' => false,
															'between' => ' <div class="col-md-11 col-md-offset-1">',
															'class' => 'form-control selectpicker show-tick show-menu-arrow',
															'data-live-search' => 'true',
															'label' => '',
															'options' => $Lenguages,'default'=>'0', 'empty' => 'Idiomccscsa'
											));?>
											<?php 	echo $this->Form->input('StudentLenguage.'.$cont.'.reading_level', array(
															'type'=>'select',
															'before' => '<div class="col-md-12">',
															'required' => false,
															'between' => ' <div class="col-md-7">',
															'style' => 'margin-left: -3px;',
															'class' => 'form-control selectpicker show-tick show-menu-arrow',
															'label' => array(
																	'class' => 'col-md-4 control-label',
																	'text' => 'Lectura'),
															'placeholder' => 'Nivel',
															'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel'
											));	?>
											<?php 	echo $this->Form->input('StudentLenguage.'.$cont.'.writing_level', array(
															'type'=>'select',
															'before' => '<div class="col-md-12">',
															'style' => 'margin-right: 3px; margin-left: 36px;',
															'required' => false,
															'between' => ' <div class="col-md-7">',
															'class' => 'form-control selectpicker show-tick show-menu-arrow',
															'label' => array(
																	'class' => 'col-md-4 control-label',
																	'text' => 'Escritura'),
															'placeholder' => 'Nivel',
															'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel'
											));	?>
											<?php 	echo $this->Form->input('StudentLenguage.'.$cont.'.conversation_level', array(
															'type'=>'select',
															'before' => '<div class="col-md-12">',
															'style' => 'margin-right: 3px; margin-left: 36px;',
															'required' => false,
															'between' => ' <div class="col-md-7">',
															'class' => 'form-control',
															'label' => array(
																	'class' => 'col-md-4 control-label',
																	'style' => 'margin-left: 0px; padding-left: 52px;',
																	'text' => 'Conversación'),
															'placeholder' => 'Nivel',
															'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel'
											));	?>
										</div>
							
									<script languaje="javascript">
										x++;
									</script> 
						<?php
									endif;
									$cont++;
								endforeach; 
							endif;
						?>
						
				</div>
					<p style="margin-left: 215px;">Agregar otro idioma (máx 3)<img  id="agregarIdioma" src="<?php echo $this->webroot; ?>/img/add.png" ALT="add.png" style='background-color: transparent; width: 25px;cursor:pointer;margin-top: -5px; margin-left: 5px;'></p>
				</div>

				<div id="contenedorComputo" style="margin-left: 15px; margin-right: -130px; width: 477px;"> 	
					<div class="col-md-12" >
						<p>Cómputo</p>
					</div>
					<?php 	echo $this->Form->input('StudentTechnologicalKnowledge.0.tecnology_id', array(
									'type'=>'select',
									'required' => false,
									'before' => '<div class="col-md-11">',
									'between' => ' <div class="col-md-11">',
									'class' => 'form-control selectpicker show-tick show-menu-arrow',
									'label' => '',
									'options' => $Tecnologias,'default'=>'0', 'empty' => 'Categoría'
					));?>
					<div id="contentName0">
					<?php 	echo $this->Form->input('StudentTechnologicalKnowledge.0.name', array(
									'type'=>'select',
									'required' => false,
									'class' => 'form-control selectpicker show-tick show-menu-arrow',
									'data-live-search' => 'true',
									'before' => '<div class="col-md-11 "><img data-toggle="tooltip" id="" data-placement="top" title="Nombre del lenguaje de programación, software, sistema operativo o herramienta requerido por la oferta." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
									'between' => ' <div class="col-md-11">',
									'label' => '',
									'placeholder' => 'Nombre',
									'onchange' => 'hideOther(0)',
									'options' => $Programas,'default'=>'0', 'empty' => 'Nombre'
					));	?>
					</div>
					<div id="contentOther0">
					<?php	echo $this->Form->input('StudentTechnologicalKnowledge.0.other', array(
									'class' => 'form-control selectpicker show-tick show-menu-arrow',
									'required' => false,
									'before' => '<div class="col-md-11 "><img data-toggle="tooltip" id="" data-placement="top" title="En el caso de no encontrar el nombre del lenguaje de programación, software, sistema operativo o herramienta deberá escribirlo en este campo." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
									'between' => ' <div class="col-md-11">',
									'label' => '',
									'placeholder' => 'Otro',
									'onblur' => 'restart(0)'
					));	?>
					</div>
					<?php 	echo $this->Form->input('StudentTechnologicalKnowledge.0.level', array(
									'type'=>'select',
									'required' => false,
									'before' => '<div class="col-md-11">',
									'between' => ' <div class="col-md-11">',
									'class' => 'form-control selectpicker show-tick show-menu-arrow',
									'label' => '',
									'placeholder' => 'Nivel',
									'options' => $NivelesSoftware,'default'=>'0', 'empty' => 'Nivel'
					));	?>
				
				
					<script languaje="javascript">
						var xComputo = 1;
					</script> 
					
						<?php 
							$cont = 0;
							if(!empty($this->request->data['StudentTechnologicalKnowledge'])):
								foreach($this->request->data['StudentTechnologicalKnowledge'] as $k => $computo): 
									if($cont > 0):
						?>
										<div id="divComputo"> 	
											<button type="button" class="btn btn-danger eliminar" style="margin-right: 15px; float: right; margin-bottom: -30px; margin-top: 0px;"><i class="glyphicon glyphicon-trash"></i></button>
											<div class="col-md-4">
												<p>Cómputo</p>
											</div>
											<?php 	echo $this->Form->input('StudentTechnologicalKnowledge.'.$cont.'.category_id', array(
															'type'=>'select',
															'required' => false,
															'before' => '<div class="col-md-11">',
															'between' => ' <div class="col-md-11">',
															'class' => 'form-control selectpicker show-tick show-menu-arrow',
															'label' => '',
															'options' => $Tecnologias,'default'=>'0', 'empty' => 'Categoría'
											));?>
											<div id="contentName<?php echo $cont; ?>">
											<?php 	echo $this->Form->input('StudentTechnologicalKnowledge.'.$cont.'.name', array(
															'type'=>'select',
															'required' => false,
															'class' => 'form-control selectpicker show-tick show-menu-arrow',
															'data-live-search' => 'true',
															'before' => '<div class="col-md-11 ">',
															'between' => ' <div class="col-md-11">',
															'label' => '',
															'placeholder' => 'Nombre',
															'onchange' => 'hideOther('.$cont.')',
															'options' => $Programas,'default'=>'0', 'empty' => 'Nombre'
											));	?>
											</div>
											<div id="contentOther<?php echo $cont; ?>">
											<?php	echo $this->Form->input('StudentTechnologicalKnowledge.'.$cont.'.other', array(
															'class' => 'form-control  selectpicker show-tick show-menu-arrow',
															'required' => false,
															'before' => '<div class="col-md-11 "><img data-toggle="tooltip" id="" data-placement="top" title="En el caso de no encontrar el nombre del lenguaje de programación, software, sistema operativo o herramienta deberá escribirlo en este campo." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
															'between' => ' <div class="col-md-11">',
															'label' => '',
															'placeholder' => 'Otro',
															'onblur' => 'restart('.$cont.')'
											));	?>
											</div>
											<?php 	echo $this->Form->input('StudentTechnologicalKnowledge.'.$cont.'.level', array(
															'type'=>'select',
															'required' => false,
															'before' => '<div class="col-md-11">',
															'between' => ' <div class="col-md-11">',
															'class' => 'form-control',
															'label' => '',
															'placeholder' => 'Nivel',
															'options' => $NivelesSoftware,'default'=>'0', 'empty' => 'Nivel'
											));	?>
										</div>
									<script languaje="javascript">
											xComputo++;
									</script> 
							<?php   endif; ?>
									
									<script languaje="javascript">
											// xComputo++;
											<?php if($computo['name'] <> ''): ?>
												hideOther(<?php echo "'".$cont."'"; ?>);
											<?php else: 
													if($computo['other'] <> ''):
											?>
														restart(<?php echo "'".$cont."'"; ?>);
											<?php 	endif;
												endif; 
											?>
									</script> 
						<?php
									$cont++;
								endforeach; 
							endif;
						?>
						
				</div>
				<div class="col-md-12" style="margin-left: 46%;" >
					<p>Agregar otro cómputo (máx 3) <img  id="agregarComputo" src="<?php echo $this->webroot; ?>/img/add.png" ALT="add.png" style='background-color: transparent; width: 25px; cursor:pointer;margin-top: -5px;'></p>
				</div>
			</div>
						
				<?php 	echo $this->Form->input('StudentJobSkill.name', array(
													'before' => '<div style="margin-left:42px;width: 367px;>',
													'between' => '<div>',
													'maxlength' => '316',
													'type' => 'textarea',
													'required' => false,
													'label' => '',
													'style' => 'resize: vertical; min-height: 120px;  max-height: 120px; height: 120px;margin-left: 4px;',
													'placeholder' => 'Certificaciones',
				));	?>
				<div class="col-md-6" style="text-align: right; right; top: -10px;margin-left: 232px;">
					<span id="contadorTaComentario">0/316</span><span> caracteres máx.</span>
				</div>
				

				<div class="col-md-offset-8" style="padding-left: 25px;">

				<?php 
							echo $this->Form->button(
													'Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>', 
													array(
														'type' => 'submit',
														'div' => 'form-group',
														'action' => 'specificSearchCandidateResults',
														'class' => 'btn btnBlue btn-default',
														'style' => 'width: 130px;',
														'escape' => false,
													)
							);

							echo $this->Form->end(); 
							?>
				</div>
			</div>
	</div>
</div>
	
	
	