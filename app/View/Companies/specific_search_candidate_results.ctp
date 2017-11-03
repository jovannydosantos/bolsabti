<?php 
	$this->layout = 'company'; 
?>

	<style> 
	.checkbox label {
		color: write;
	}
	.titulos{
		color: write; 
		margin-left: 15px;
		margin-right: 20px;
	}
	p {
		font-size: 14px;
	}
	.panel {
			box-shadow: 0 0 0 rgba(0, 0, 0, 0.8);
		}
	</style>
	
	<script>
		$(document).ready(function() {
			
			$("#estado").on('change',function (){
				if($("#estado").val() != 0)
					{	
						$('#loading').show();
						$.get('http://localhost/23octubre/bolsabti/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
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
					$.get('http://localhost/23octubre/bolsabti/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
						{	
							$('#ciudad').empty();
							$('#ciudad').append('<option value="">Delegación / Municipio</option>');
							
							var waitCount = 0;
								$.each(JSON, function(key, val){
									waitCount++;
								});	
								
							$.each(JSON, function(key, val){
								if(val.mun == '<?php echo (isset($this->request->data['StudentProfile']['city']) and ($this->request->data['StudentProfile']['city'] <> '')) ? $this->request->data['StudentProfile']['city']: ''; ?>'){
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
				}
			
			<?php if(isset($this->request->data['StudentProfessionalProfile']) and (!empty($this->request->data['StudentProfessionalProfile']))): ?> 
				
				<?php if($this->request->data['StudentProfessionalProfile'][0]['academic_situation'] == 1): ?> 
					$( "#StudentProfessionalProfile0AcademicSituation" ).prop( "checked", true );	
				<?php endif; ?>
				
				<?php if($this->request->data['StudentProfessionalProfile'][1]['academic_situation'] == 2): ?> 
					$( "#StudentProfessionalProfile1AcademicSituation" ).prop( "checked", true );	
				<?php endif; ?>
				
				<?php if($this->request->data['StudentProfessionalProfile'][2]['academic_situation'] == 3): ?> 
					$( "#StudentProfessionalProfile2AcademicSituation" ).prop( "checked", true );
				<?php endif; ?>
				
				<?php if($this->request->data['StudentProfessionalProfile'][3]['academic_situation'] == 4): ?> 
					$( "#StudentProfessionalProfile3AcademicSituation" ).prop( "checked", true );
				<?php endif; ?>
				
				<?php if($this->request->data['StudentProfessionalProfile'][4]['academic_situation'] == 5): ?> 
					$( "#StudentProfessionalProfile4AcademicSituation" ).prop( "checked", true );
				<?php endif; ?>
				
			<?php endif; ?>
			
			actualizaCarreras();
			semestre();
			academicSituation();
			desabilityMobility();
			desabilityMobility1();
			desabilityMobility2();	
			mobilityCityOption();
			mobilityCityOption2();
			$('#CompanySavedSearchName').val('');
			
			<?php if($this->request->data['CompanyJobProfileDynamicArea'][0]['area_interes'] <> ''): ?> 
				cargaAreas(0,<?php echo $this->request->data['CompanyJobProfileDynamicArea'][0]['area_interes']; ?>);
			<?php else: ?>
				cargaAreas(0,0);
			<?php endif; ?>			
			
			init_contadorTa("StudentJobSkillName","contadorTaComentario", 316);
			updateContadorTa("StudentJobSkillName","contadorTaComentario", 316);
			
			$("#agregarIdioma").click(function(e) { 
					var string = 
								'<div class=" divIdiomas">'+
									'<button type="button" class="btn btn-danger eliminar" style="margin-right: -65px; float: right; margin-bottom: -45px; margin-top: 0px;"><i class="glyphicon glyphicon-trash"></i></button>'+
									'<div class="col-md-4 col-md-offset-1">'+
										'<p>Idioma</p>'+
									'</div>'+
									'<div class="form-group row"><div class="col-md-12 "><label for="StudentLenguage0LanguageId"></label><div class="col-md-11 col-md-offset-1">'+
									'<select name="data[StudentLenguage]['+x+'][language_id]" class="form-control idioma'+x+' selectpicker show-tick show-menu-arrow" data-live-search="true" id="StudentLenguage'+x+'LanguageId">'+
									
									'</select></div></div></div><div class="form-group row"><div class="col-md-12 col-md-offset-1"><label for="StudentLenguage'+x+'ReadingLevel" class="col-md-4 control-label">Lectura</label> <div class="col-md-7">'+
									'<select name="data[StudentLenguage]['+x+'][reading_level]" class="form-control readingLevel'+x+' selectpicker show-tick show-menu-arrow" placeholder="Nivel de lectura" id="StudentLenguage'+x+'ReadingLevel">'+
									
									'</select></div></div></div><div class="form-group row"><div class="col-md-12 col-md-offset-1"><label for="StudentLenguage'+x+'WritingLevel" class="col-md-4 control-label">Escritura</label> <div class="col-md-7">'+
									'<select name="data[StudentLenguage]['+x+'][writing_level]" class="form-control writingLevel'+x+' selectpicker show-tick show-menu-arrow" placeholder="Nivel de escritura" id="StudentLenguage'+x+'WritingLevel">'+
									
									'</select></div></div></div><div class="form-group row"><div class="col-md-12 col-md-offset-1"><label for="StudentLenguage'+x+'ConversationLevel" class="col-md-4 control-label">Conversación</label> <div class="col-md-7">'+
									'<select name="data[StudentLenguage]['+x+'][conversation_level]" class="form-control conversationLevel'+x+' selectpicker show-tick show-menu-arrow" placeholder="Nivel de conversación" id="StudentLenguage'+x+'ConversationLevel">'+
									
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
				});
				
				
			$("#agregarComputo").click(function(e) { 
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
				$.get('http://localhost/23octubre/bolsabti/app/webroot/php/derpAreas.php',{giro: $('#CompanyJobProfileDynamicGiro0Giro').val()},function(JSON)
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
		function cargaAreas(id, index){
			if($('#CompanyJobProfileDynamicGiro'+id+'Giro').val() != 0)
				{
				$('#loading').show();
				$.get('http://localhost/23octubre/bolsabti/app/webroot/php/derpAreas.php',{giro: $('#CompanyJobProfileDynamicGiro'+id+'Giro').val()},function(JSON)
					{
							
					$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').empty();
					$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').append('<option value="">Área de interés</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});

					$.each(JSON, function(key, val){
						if(val.id == index){
							$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').append('<option value="' + val.id + '" selected>' + val.area + '</option>');
						}else{
							$('#CompanyJobProfileDynamicArea'+id+'AreaInteres').append('<option value="' + val.id + '" >' + val.area + '</option>');
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
		if(numGiros.length >= 4){			
			jAlert ("S\u00f3lo puedes agregar hasta 4 giros");
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
				'<select id="CompanyJobProfileDynamicGiro'+cont2+'Giro" onchange="cargaAreas('+cont2+')" data-live-search="true" class="form-control selectpicker show-tick show-menu-arrow clonGiroInteres'+cont2+' clonGiroReindexa" placeholder="Giro de interés" name="data[CompanyJobProfileDynamicGiro]['+cont2+'][giro]" style="width: 385px;margin-left: 5px;">'+

				
				'</select>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'<div class="form-group">'+
				'<div class="col-md-12 ">'+
				'<label for="CompanyJobProfileAreaInteres"></label>'+
				'<div class="col-md-11">'+
				'<select id="CompanyJobProfileDynamicArea'+cont2+'AreaInteres" data-live-search="true" class="form-control selectpicker show-tick show-menu-arrow clonAreaReindexa" placeholder="Áreas de interés" name="data[CompanyJobProfileDynamicArea]['+cont2+'][area_interes]" style="width: 385px;margin-left: 5px;">'+
				'<option value="">Área de interés</option>'+

				'</select>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'</div>'
			);
			$('.clonGiroInteres').empty();

			$('#CompanyJobProfileDynamicGiro0Giro').find('option').clone().appendTo('.clonGiroInteres'+cont2);
			document.getElementById('CompanyJobProfileDynamicGiro'+cont2+'Giro').options[0].selected = 'selected';
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
				'<select id="CompanyCandidateProfileDynamicNivelAcademico'+cont3+'AcademicLevel" onchange = "changeAcademicLevel('+cont3+');" class="form-control selectpicker show-tick show-menu-arrow clonNivelAcademico'+cont3+' clonNivelAcademicoReindexa" name="data[CompanyCandidateProfileDynamicNivelAcademico]['+cont3+'][academic_level]">'+
				
				'</select>'+
				'</div>'+
				'</div>'+
				'</div>'+
				
				'<div id="divCarrerasId'+cont3+'" class="divCarreras"  style="display: none;">'+
				'<div class="form-group">'+
				'<div class="col-md-12 ">'+
				'<label for="CompanyJobRelatedCareerDynamicCarrera'+cont3+'CareerId"></label>'+
				'<div class="col-md-11">'+
				'<select id="CompanyJobRelatedCareerDynamicCarrera'+cont3+'CareerId" class="form-control selectpicker show-tick show-menu-arrow clonCarrera'+cont3+' clonCarreraReindexa" name="data[CompanyJobRelatedCareerDynamicCarrera]['+cont3+'][career_id]">'+
				
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
				'<select id="CompanyJobRelatedAreaDynamicArea'+cont3+'AreaId" class="form-control selectpicker show-tick show-menu-arrow clonArea'+cont3+' clonAreaReindexa" name="data[CompanyJobRelatedAreaDynamicArea]['+cont3+'][area_id]">'+
				
				'</select>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'</div>'+
				
				'<div style="text-align: left;">'+
				'<p style="margin-left: 15px;">Buscar afines:</p>'+
				'</div>'+
				'<div class="form-group">'+
				'<div class="col-md-offset-8" style="color: write; margin-top: -40px;">'+
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
				'<select id="CompanyCandidateProfileDynamicSituacionAcademica'+cont3+'AcademicSituation" class="form-control selectpicker show-tick show-menu-arrow clonSituacionAcademica'+cont3+' clonSituacionAcademicaReindexa" name="data[CompanyCandidateProfileDynamicSituacionAcademica]['+cont3+'][academic_situation]">'+
				
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
				$( "#StudentProspectCanTravelOption1" ).prop( "checked", false );
				$( "#StudentProspectCanTravelOption2" ).prop( "checked", false );
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
				$( "#StudentProspectChangeResidenceOption1" ).prop( "checked", false );
				$( "#StudentProspectChangeResidenceOption2" ).prop( "checked", false );
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
			$.get('http://localhost/23octubre/bolsabti/app/webroot/php/derp.php',function(JSON)
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
			$.get('http://localhost/23octubre/bolsabti/app/webroot/php/derpPaises.php',function(JSON)
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
			$.get('http://localhost/23octubre/bolsabti/app/webroot/php/derp.php',function(JSON)
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
			$.get('http://localhost/23octubre/bolsabti/app/webroot/php/derpPaises.php',function(JSON)
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
						$("#divMobilityCityOption2").show();
						$('#loading').hide();
						$('.selectpicker').selectpicker('refresh');
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
				
			<?php if(isset($this->request->data['destino']) and (!empty($this->request->data['destino']))){ ?>
				var totalCarreras = <?php echo count($this->request->data['destino']); ?>;
				<?php foreach($this->request->data['destino'] as $k => $Carrera): ?>
				arrayCarreras[indexArray] = <?php echo $Carrera; ?>;
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
					$.get('http://localhost/23octubre/bolsabti/app/webroot/php/derpCarreras.php',{escuela: '', level: 2 },function(JSON){
						
						var waitCount = 0;
						$.each(JSON, function(key, val){
							waitCount++;
						});
						
						$.each(JSON, function(key, val){
							$('#origen').append('<option title="' + val.carrera + '" value="' + val.id + '">' + val.carrera + '</option>');	
							
							if (--waitCount == 0) {
								$('.selectpicker').selectpicker('refresh');
								$('#loading').hide();
								ordenarSelect('origen');
								ordenarSelect('destino');
								pasaCarreras();
							}

						});
					});	
			}
			
			if(liceciatura){	
					$('#loading').show();
					$.get('http://localhost/23octubre/bolsabti/app/webroot/php/derpCarreras.php',{escuela: '', level: 1 },function(JSON){
						
						var waitCount = 0;
						$.each(JSON, function(key, val){
							waitCount++;
						});
						
						$.each(JSON, function(key, val){
							$('#origen').append('<option title="' + val.carrera + '"  value="' + val.id + '">' + val.carrera + '</option>');	
							
							if (--waitCount == 0) {
								$('.selectpicker').selectpicker('refresh');
								$('#loading').hide();
								ordenarSelect('origen');
								ordenarSelect('destino');
								pasaCarreras();
							}
						});
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
		
		function sendLimit(){
			 selectedIndex = document.getElementById("StudentLimit").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				document.getElementById('StudentLimit').value = document.getElementById('limit').value;
				document.getElementById("requestForm").submit();
				return false;
			 }
		}
		
		function openCollapse(id){
				var dotCounter = 0;
					(function addDot() {
					  setTimeout(function() {
						dotCounter++;
						if (dotCounter == 1) {
							$('.panel-collapse.in').collapse('hide');
						}else
						if (dotCounter == 2) {
							$("#collapse"+id).collapse('toggle');				
						}
						addDot();
					  }, 100);
					})();
				
				
				
				$( "#idButtonCollapse1" ).removeClass( "active" );
				$( "#idButtonCollapse2" ).removeClass( "active" );
				$( "#idButtonCollapse3" ).removeClass( "active" );
				$( "#idButtonCollapse4" ).removeClass( "active" );
				
				$( "#idButtonCollapse"+id ).addClass( "active" );		
		}
			
		function closeCollapse(id){
			$("#collapse"+id).collapse('toggle');
		}
		
		function submitSearch(){
			var palabrasClave = document.getElementById("CompanyJobProfileJobName").value;
			textoAreaDividido = palabrasClave.split(" ");
			numeroPalabras = textoAreaDividido.length;
			
			if((document.getElementById("CompanyJobProfileJobName").value != '') && (numeroPalabras>4)){
				jAlert('Sólo puede ingresar 4 palabras clave y separadas por un espacio');
				return false;
			} else {
				document.getElementById("requestForm").submit();
			}
		}
		
		function validateInputs(){
			$('#destino option').prop('selected', true);
			return true;		
		}
	
	
		//Contador de caracteres para las notificaciones telefónicas 
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
		
			function saveTelephoneNotification(StudentId){
				document.getElementById('StudentTelephoneNotificationId').value = StudentId;
				$('#myModalnotificationTelefonica').modal('show');
			}
			
			function savePersonalNotification(StudentId){
				document.getElementById('StudentPersonalNotificationId').value = StudentId;
				$('#myModalnotificationPersonal').modal('show');
			}
			
			function saveEmailNotification(email){
				document.getElementById('StudentEmailTo').value = email;
				$('#myModalMail').modal('show');
			}
			
			function saveReportarContratacion(StudentId){
				document.getElementById('StudentReportarContratacionStudentId').value = StudentId;
				$('#myModalReportarContratacion').modal('show');
			}
			
			function nuevaFechaEntrevista(id, company_job_profile_id){
				document.getElementById('StudentPropuestaId').value = id;
				document.getElementById('StudentPropuestaCompsnyaJobProfileId').value = company_job_profile_id;
				$('#myModalnotification').modal('show');
				return false;
			}
			
			function saveOffer(StudentId){
				document.getElementById('CompanySavedStudentStudentId').value = StudentId;
				$('#myModal1').modal('show');
			}
			
			function validaFormSaveStudent(){
				var valor = document.getElementById("CompanySavedStudentCompanyFolderId").value;
				if (valor == ''){
					jAlert('Seleccione la carpeta donde se guardará el perfil','Mensaje');
					document.getElementById("CompanySavedStudentCompanyFolderId").focus;
					return false;
				} else {
					return true;
				}
			}
			
			function cambiarContenido(){
				var archivo = document.getElementById('StudentFile').value;
				extensiones_permitidas = new Array(".jpg",".pdf");
				mierror = "";

				if (!archivo) {
						jAlert('No se ha adjuntado ningún archivo', 'Mensaje');
						document.getElementById('StudentFile').scrollIntoView();
						return false;
				}else{
						extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
						permitida = false;
						for (var i = 0; i < extensiones_permitidas.length; i++) {
							 if (extensiones_permitidas[i] == extension) {
							 permitida = true;
							 break;
							 }
						}
						  
						if (!permitida) {
							jAlert("Compruebe la extensión de su archivo. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(), 'Mensaje');
							document.getElementById('StudentFile').scrollIntoView();
							deleteText();
							return false;
						}else{
							document.getElementById("textFile").innerHTML = document.getElementById('StudentFile').value + '<button id="deleteTextId" onclick="deleteText();" class="btnBlue" style="margin-left: 10px;" >x</button>';
							return false;
						}
				   }
			}
			
			function deleteText(){
				document.getElementById("textFile").innerHTML = '';
				document.getElementById('StudentFile').value = '';  
				return false;
			}
				
		function validarFecha(fecha){
				 //Funcion validarFecha 
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
			
		function validateTelephoneNotificationForm(){
				var f = new Date();
				var fechaInicial = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
				var fechaFinal = document.getElementById('StudentTelephoneNotificationDateDay').value	+ "/" +
										document.getElementById('StudentTelephoneNotificationDateMonth').value	+ "/" +
										document.getElementById('StudentTelephoneNotificationDateYear').value;
				
				
				selectedIndexDay = document.getElementById("StudentTelephoneNotificationDateDay").selectedIndex;
				selectedIndexMonth = document.getElementById("StudentTelephoneNotificationDateMonth").selectedIndex;
				selectedIndexYear = document.getElementById("StudentTelephoneNotificationDateYear").selectedIndex;
				
				responseValidateDate = validarFecha(fechaFinal);
				
				if(document.getElementById('StudentTelephoneNotificationMessage').value == ''){
					jAlert('AIngrese el mensaje para la notificación telefónica', 'Mensaje');
					document.getElementById('StudentTelephoneNotificationMessage').focus();
					return false;
				} else
				if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
					jAlert('Seleccione la fecha completa para el día de la entrevista telefónica', 'Mensaje');
					document.getElementById('StudentTelephoneNotificationDateDay').focus();
					return false;
				}else 
				 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
					jAlert('La fecha de la entrevista telefónica no debe ser menor a la actual', 'Mensaje');
					document.getElementById('StudentTelephoneNotificationDateDay').focus();
					return false;
				}else 
				if(responseValidateDate == false){
					jAlert('La fecha de la entrevista telefónica no es válida', 'Mensaje');
					document.getElementById('StudentTelephoneNotificationDateDay').focus();
					return false;
				}else{
					document.getElementById("FormTelephoneNotification").submit();
				 }
			}
		
		function validatePersonalNotificationForm(){
			var f = new Date();
			var fechaInicial = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
			var fechaFinal = document.getElementById('StudentPersonalNotificationDateDay').value	+ "/" +
									document.getElementById('StudentPersonalNotificationDateMonth').value	+ "/" +
									document.getElementById('StudentPersonalNotificationDateYear').value	;
			

			selectedIndexDay = document.getElementById("StudentPersonalNotificationDateDay").selectedIndex;
			selectedIndexMonth = document.getElementById("StudentPersonalNotificationDateMonth").selectedIndex;
			selectedIndexYear = document.getElementById("StudentPersonalNotificationDateYear").selectedIndex;
			
			responseValidateDate = validarFecha(fechaFinal);
			
			if(document.getElementById('StudentPersonalNotificationMessage').value == ''){
				jAlert('Ingrese el mensaje para la notificación personal', 'Mensaje');
				document.getElementById('StudentPersonalNotificationMessage').focus();
				return false;
			} else
			if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
				jAlert('Seleccione la fecha completa para el día de la entrevista personal', 'Mensaje');
				document.getElementById('StudentPersonalNotificationDateDay').focus();
				return false;
			}else 
			 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
				jAlert('La fecha de la entrevista personal no debe ser menor a la actual', 'Mensaje');
				document.getElementById('StudentPersonalNotificationDateDay').focus();
				return false;
			}else 
			if(responseValidateDate == false){
				jAlert('La fecha de la entrevista personal no es válida', 'Mensaje');
				document.getElementById('StudentPersonalNotificationDateDay').focus();
				return false;
			}else{
				document.getElementById("FormPersonalNotification").submit();
			 }
			
		}
		
		function validateNotificationFormPropuesta(){
				
				var f = new Date();
				var fechaInicial = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
				var fechaFinal = document.getElementById('StudentPropuestaFechaDay').value	+ "/" +
										document.getElementById('StudentPropuestaFechaMonth').value	+ "/" +
										document.getElementById('StudentPropuestaFechaYear').value;
				
				
				selectedIndexDay = document.getElementById("StudentPropuestaFechaDay").selectedIndex;
				selectedIndexMonth = document.getElementById("StudentPropuestaFechaMonth").selectedIndex;
				selectedIndexYear = document.getElementById("StudentPropuestaFechaYear").selectedIndex;
				
				responseValidateDate = validarFecha(fechaFinal);
				
				if(document.getElementById('taComentarioPropuesta').value == ''){
					jAlert('Ingrese el mensaje para la nueva propuesta', 'Mensaje');
					document.getElementById('taComentarioPropuesta').focus();
					return false;
				} else
				if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
					jAlert('Seleccione la fecha completa para el día de la entrevista', 'Mensaje');
					document.getElementById('StudentPropuestaFechaDay').focus();
					return false;
				}else 
				 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
					jAlert('La fecha de la entrevista no debe ser menor a la actual', 'Mensaje');
					document.getElementById('StudentPropuestaFechaDay').focus();
					return false;
				}else 
				if(responseValidateDate == false){
					jAlert('La fecha de la entrevista no es válida', 'Mensaje');
					document.getElementById('StudentPropuestaFechaDay').focus();
					return false;
				}else{
					document.getElementById("formNotificacionPropuesta").submit();
				 }
			}
		
		function validarReportarContratacionForm(){
				var fechaFinal = document.getElementById('StudentReportarContratacionFechaContratacionDay').value	+ "/" +
										document.getElementById('StudentReportarContratacionFechaContratacionMonth').value	+ "/" +
										document.getElementById('StudentReportarContratacionFechaContratacionYear').value	;
				
				selectedIndexDay = document.getElementById("StudentReportarContratacionFechaContratacionDay").selectedIndex;
				selectedIndexMonth = document.getElementById("StudentReportarContratacionFechaContratacionMonth").selectedIndex;
				selectedIndexYear = document.getElementById("StudentReportarContratacionFechaContratacionYear").selectedIndex;
			 
				responseValidateDate = validarFecha(fechaFinal);
				
				if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
					jAlert ('Seleccione la fecha completa para reportar la contratación','Mensaje');
					document.getElementById('StudentReportarContratacionFechaContratacionDay').focus();
					return false;
				}else  
				if(responseValidateDate == false){
					jAlert ('La fecha para reportar contratación no es válida', 'Mensaje');
					document.getElementById('StudentReportarContratacionFechaContratacionDay').focus();
					return false;
				}else {
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
			<li class="whiteTextMenu" id='idButtonCollapse1'><a href="#collapse1" data-toggle="collapse" onClick="openCollapse(1);">Palabras Clave</a></li>
			<li class="whiteTextMenu" id='idButtonCollapse2'><a href="#collapse2" data-toggle="collapse" onClick="openCollapse(2);">Nivel Académico</a></li>
			<li class="whiteTextMenu" id='idButtonCollapse3'><a href="#collapse3" data-toggle="collapse" onClick="openCollapse(3);">Modalidad de Contratación</a></li>
			<li class="whiteTextMenu" id='idButtonCollapse4'><a href="#collapse4" data-toggle="collapse" onClick="openCollapse(4);">Conocimientos y Habilidades Profesionales</a></li>
			<li class="whiteTextMenu"><a href="#" onClick="addName(); return false;">Guardar Búsqueda Realizada</a></li>
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

	<?= $this->Form->create('Company', [
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
						'action' => 'specificSearchCandidateResults',
						'onsubmit' =>'return validateInputs();' ]); ?>
		
	<fieldset>
		<div id="collapse1" class="panel-collapse collapse">
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
					<?= $this->Form->button('Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',['type'=>'button','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px; ','onClick' => 'return submitSearch();']);?>
				</div>
			</div>
		</div>	
		
		<div id="collapse2" class="collapse">
			<div class="col-md-6 col-md-offset-3 ">
				<div class="col-md-12">
				<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
			        <p style="color: #588BAD">Nivel Académico</p>
			    </blockquote>
			    </div>
                <!--		
				<?= $this->Form->input('CompanyCandidateProfile.0.cademic_level_id', ['type'=>'select','options' => $NivelesAcademicos,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Nivel Académico','onchange' => "cargaCarreras('0','0');",]); ?>

				<div id="contenedorNiveles">
					<?= $this->Form->input('CompanyCandidateProfile.0.academic_situation_id', ['type'=>'select','options' => $SituacionesAcademicas,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Situación Académica','onchange' => 'academicSituation("0")']); ?>

					<div id="divSemestre0">
						<?= $this->Form->input('CompanyCandidateProfile.0.semester', ['type'=>'select','options' => $Semestres,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Semestre','onchange' => 'academicSituation("0")']); ?>
					</div>
					
					<?= $this->Form->input('CompanyCandidateProfile.0.carreras', ['type'=>'select','multiple' => 'multiple','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Selecciona las Carreras / Áreas','onchange' => 'academicSituation("0")']); ?>
					
				</div>
			    --> 

			    <div id="contenedorNiveles">
				<!--
				<?= $this->Form->input('CompanyCandidateProfile.0.academic_level_id',['type'=>'select','class' => 'selectpicker show-tick form-control show-menu-arrow nivelClase','onchange' => "cargaCarreras('0','0');",'options' => $NivelesAcademicos,'default'=>'0', 'empty' => 'Nivel Académico',]);?>
				
				<?= $this->Form->input('CompanyCandidateProfile.0.academic_situation_id', ['type'=>'select','class' => 'selectpicker show-tick form-control show-menu-arrow situacionClase','onchange' => 'academicSituation("0")','options' => $SituacionesAcademicas,'default'=>'0', 'empty' => 'Situación Académica']);?>
			    </div>
				<div id="divSemestre0">
				<?=$this->Form->input('CompanyCandidateProfile.0.semester', ['type'=>'select','class' => 'selectpicker show-tick form-control show-menu-arrow semestresClase','onchange' => 'academicSituation("0")','options' => $Semestres,'default'=>'0', 'empty' => 'Semestre']);?>
				</div>-->
				<?=$this->Form->input('CompanyCandidateProfileCarreras.0.carreras', ['type'=>'select','multiple' => 'multiple','class' => 'selectpicker show-tick form-control show-menu-arrow carrerasClase','data-live-search' => "true",'data-selected-text-format' => 'count > 0','title' => 'Seleccione las Carreras / Áreas','data-actions-box' => 'true','default'=>'', 'empty' => 'Selecciona las Carreras / Áreas',]);?>	
				
				<script languaje="javascript">
					var x = 1;
				</script> 

				<?php 
					$cont = 0;
					if(!empty($this->request->data['CompanyCandidateProfile'])):
						foreach($this->request->data['CompanyCandidateProfile'] as $k => $nivel): 
							if($cont > 0):
								?>
								<div class="divNiveles"></div>
								<button type="button" class="btn btn-danger eliminar"  style="z-index: 100; margin-left: 725px;"><i class="glyphicon glyphicon-trash"></i></button>
								<?= $this->Form->input('CompanyCandidateProfile.'.$cont.'.index', ['type' => 'hidden','value' => $cont,]);?>
								<?= $this->Form->input('CompanyCandidateProfile.'.$cont.'.academic_level_id', ['type'=>'select','before' => '<div class="col-md-12 "></div>','class' => 'selectpicker show-tick form-control show-menu-arrow nivelClase','onchange' => "cargaCarreras('".$cont."','0')",'options' => $NivelesAcademicos,'default'=>'0', 'empty' => 'Nivel Académico',]); ?>
								<?=$this->Form->input('CompanyCandidateProfile.'.$cont.'.academic_situation_id', ['type'=>'select','before' => '<div class="col-md-12"></div>','class' => 'selectpicker show-tick form-control show-menu-arrow situacionClase','onchange' => 'academicSituation("'.$cont.'")','options' => $SituacionesAcademicas,'default'=>'0', 'empty' => 'Situación Académica']);?>
							   
								<div id="divSemestre<?php echo $cont; ?>"></div>
									<?=$this->Form->input('CompanyCandidateProfile.'.$cont.'.semester', ['type'=>'select','before' => '<div class="col-md-12"></div>','class' => 'selectpicker show-tick form-control show-menu-arrow semestresClase','onchange' => 'academicSituation("'.$cont.'")','options' => $Semestres,'default'=>'0', 'empty' => 'Semestre']);?>
								
								<?=$this->Form->input('CompanyCandidateProfileCarreras.'.$cont.'.carreras', ['before' => '<div class="col-md-12"></div>','type'=>'select','multiple' => 'multiple','class' => 'selectpicker show-tick form-control show-menu-arrow carrerasClase','data-live-search' => "true",'data-selected-text-format' => 'count > 0','title' => 'Seleccione las Carreras / Áreas','data-actions-box' => 'true','placeholder' => 'Prestaciones y apoyos','default'=>'', 'empty' => 'Selecciona las Carreras / Áreas',]);?>
							
					
								<script languaje="javascript">
									var index = <?php echo $cont; ?>;
									academicSituation(index);
									cargaCarreras(index,1);
									x++;
								</script> 
					<?php
								endif;
								$cont++;
							endforeach; 
						endif;
					?>
				
				
					<div style="text-align: right;">
						<span>Agregar otro Nivel (máx. 3)</span>
						<button type="button" class="btn btn-default btn-sm" id="agregarNivel">
						  <span class="glyphicon glyphicon-plus-sign"></span>
						</button>
					</div>	
			</div>
		</div>	
		
		<div id="collapse3" class="collapse">
		    <div class="col-md-6 col-md-offset-3 ">
			        <div class="col-md-12">
						<button type="button" class="btn btnRed btn-default col-md-offset-11" onClick="closeCollapse(3);">
						   <i class="glyphicon glyphicon-remove-sign"></i>
						</button>

						<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
							<p style="color: #588BAD">Modalidad de contratación</p>
						</blockquote>
					</div>	
	                    <?= $this->Form->input('StudentWorkArea.job_name', ['required' => false,'placeholder' => 'Puesto',]);	?> 				
						<?= $this->Form->input('StudentProspect.economic_pretension', ['type' => 'select','class' => 'form-control selectpicker show-tick show-menu-arrow','data-live-search' => 'true','label' => ['class' => 'col-md-0 control-label','text' => ''],'placeholder' => '','options' => $Salarios,'default'=>'0', 'empty' => 'Pretensiones económicas']);	?>
					<div id="original" class="clonGiro">
						<?=$this->Form->input('StudentJobProfileDynamicGiro.0.giro', ['type'=>'select','class' => 'form-control clonGiroReindexa selectpicker show-tick show-menu-arrow','data-live-search' => "true",'label' => '','placeholder' => 'Giro','onchange' => 'cargaAreas(0)','options' => $Giros,'default'=>'0', 'empty' => 'Giro de interés']);	?>
						<?= $this->Form->input('StudentJobProfileDynamicArea.0.area_interes', ['type'=>'select','class' => 'form-control clonAreaReindexa selectpicker show-tick show-menu-arrow','data-live-search' => "true",'label' => '','placeholder' => 'Áreas de interés','default'=>'0', 'empty' => 'Área de interés']);	?>
					</div>
					<div class="contenedorClonesGiros"></div>
					
					<div style="text-align: right;">
						<span>Agregar otro giro y área (máx. 3)</span>
						<button type="button" class="btn btn-default btn-sm" onclick="clonarGiro();">
						  <span class="glyphicon glyphicon-plus-sign"></span>
						</button>
					</div>	
						
			</div>		
	    </div>
		
						<div id="collapse4" class="collapse">
							<div class="col-md-6 col-md-offset-3 ">
							
										<div id="contenedorIdiomas">	
											<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
											   <p style="color: #588BAD">Conocimientos y habilidades profesionales.</p>
											</blockquote>
											<div class="col-md-12">
												<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
												  <p style="color: #588BAD">Idiomas.</p>
												</blockquote>
											</div>
											
											<div id="original" class="clon">
											   <?= $this->Form->input('StudentLenguage.0.language_id', ['type'=>'select','options' => $Lenguages,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Idioma']); ?>
											   <?= $this->Form->input('StudentLenguage.0.reading_level', ['type'=>'select','options' => $NivelesIdioma,'class' => 'form-control selectpicker show-tick show-menu-arrow','required' => false,'label' => ['class' => 'col-md-2 control-label','text' => ''],'placeholder' => 'Nivel de lectura','default'=>'0', 'empty' => 'Nivel de lectura']);	?>
											   <?= $this->Form->input('StudentLenguage.0.writing_level',['type'=>'select','required' => false,'class' => 'form-control selectpicker show-tick show-menu-arrow','label' => ['class' => 'col-md-2 control-label','text' => ''],'placeholder' => 'Nivel de Escritura','options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel de Escritura']); ?>
											   <?= $this->Form->input('StudentLenguage.0.conversation_level',['type'=>'select','required' => false,'class' => 'form-control selectpicker show-tick show-menu-arrow','label' => ['class' => 'col-md-2 control-label','text' => ''],'placeholder' => 'Nivel de Conversación','options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel de Conversación']); ?>
											</div>		
											
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
												<?= $this->Form->input('StudentLenguage.'.$cont.'.language_id', ['type'=>'select','required' => false,'class' => 'form-control selectpicker show-tick show-menu-arrow','data-live-search' => 'true','label' => '','options' => $Lenguages,'default'=>'0', 'empty' => 'Idiomccscsa']);?>
												<?= $this->Form->input('StudentLenguage.'.$cont.'.reading_level', ['type'=>'select','required' => false,'style' => 'margin-left: -3px;','class' => 'form-control selectpicker show-tick show-menu-arrow','label' => ['text' => ''],'placeholder' => 'Nivel de Lectura','options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel de Lectura']);?>
												<?= $this->Form->input('StudentLenguage.'.$cont.'.writing_level', [ 'type'=>'select','style' => 'margin-right: 3px; margin-left: 36px;','required' => false,'class' => 'form-control selectpicker show-tick show-menu-arrow','label' => ['text' => ''],'placeholder' => 'Nivel de Ecritura','options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel de Ecritura']);?>
												<?= $this->Form->input('StudentLenguage.'.$cont.'.conversation_level', ['type'=>'select','style' => 'margin-right: 3px; margin-left: 36px;','required' => false,'class' => 'form-control','label' => ['style' => 'margin-left: 0px; padding-left: 52px;','text' => ''],'placeholder' => 'Nivel de Conversación','options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel de Conversación']);?>
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
										
										<div style="text-align: right;">
											<span>Agregar otro idioma (máx. 3)</span>
											<button type="button" class="btn btn-default btn-sm" id="agregarIdioma">
											  <span class="glyphicon glyphicon-plus-sign"></span>
											</button>
										</div>
										
										<div class="col-md-12">
											 <blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
											   <p style="color: #588BAD">Cómputos.</p>
											 </blockquote>
										</div>
										
										<div id="contenedorComputo"> 
											<?=$this->Form->input('StudentTechnologicalKnowledge.0.tecnology_id',['type'=>'select','options' => $Tecnologias,'required' => false,'class' => 'form-control selectpicker show-tick show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Categoría']);?>
											<div id="contentName0"> 
												<?= $this->Form->input('StudentTechnologicalKnowledge.0.name', ['type'=>'select','options' => $Programas,'class' => 'form-control selectpicker show-tick show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Nombre','onchange' => 'hideOther(0)','required' => false]);	?>
											</div>
											<div id="contentOther0">
												<?= $this->Form->input('StudentTechnologicalKnowledge.0.other',['placeholder' => 'Otro','onblur' => 'restart(0)','required' => false]);	?>
											</div>
											<?= $this->Form->input('StudentTechnologicalKnowledge.0.level', ['type'=>'select','options' => $NivelesSoftware,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Nivel','required' => false]); ?>
												
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
													<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
													   <p style="color: #588BAD">Cómputo</p>
													</blockquote>
												</div>
													<?= $this->Form->input('StudentTechnologicalKnowledge.'.$cont.'.category_id',['type'=>'select','options' => $Tecnologias,'required' => false,'class' => 'form-control selectpicker show-tick show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Categoría']);?>
											
												<div id="contentName<?php echo $cont; ?>">
													<?= $this->Form->input('StudentTechnologicalKnowledge.'.$cont.'.name', ['type'=>'select','options' => $Programas,'class' => 'form-control selectpicker show-tick show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Nombre','onchange' => 'hideOther('.$cont.')','required' => false]);	?>
												</div>
												<div id="contentOther<?php echo $cont; ?>">
													<?= $this->Form->input('StudentTechnologicalKnowledge.'.$cont.'.other', ['placeholder' => 'Otro','onblur' => 'restart('.$cont.')','required' => false]);	?>
											
												</div>
													<?= $this->Form->input('StudentTechnologicalKnowledge.'.$cont.'.level', ['type'=>'select','options' => $NivelesSoftware,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Nivel','required' => false]); ?>
													
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
										 
										<div class="contenedorClonesComputo"></div>
										<div style="text-align: right;">
										   <span>Agregar otro cómputo (máx. 3)</span>
										   <button type="button" class="btn btn-default btn-sm" id="agregarComputo">
										   <span class="glyphicon glyphicon-plus-sign"></span>
										   </button>
										</div>
                                        <div class="col-md-12 text-center">
											<?= $this->Form->button('Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',['type' => 'submit','class' => 'btn btn-primary btn-default','escape' => false,'style' => 'width:130px;',]); ?>
											<?= $this->Form->end(); ?>
										</div>
							</div>
						
	</fieldset>				
		
	
	
		<div class="col-md-12">
			<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
				<p style="color: #588BAD;">Candidatos mas vistos por empresas</p>
			</blockquote>
			
			<div class="col-md-12" >
				<?= $this->Form->create('Student', [
								'class' => 'form-horizontal',
								'id' => 'limitRequest',
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
								'action' => 'profile',]); ?>
				<fieldset>
				<?php echo $this->Form->input('limite', array('type'=>'hidden')); ?>

									<div class="col-md-1" style="padding-left: 0px; padding-right: 0px;">
										<?php 
										echo $this->Form->end(); 
										?>
									</div>
				</fieldset>
			</div>
			
			<div class="col-md-12">
				<div class="col-md-12">
					<label> Resultados de Búsqueda</label>
				</div>
			</div>
			
			
			<div class="col-md-4">
				<?php 	echo $this->Html->link(
												'Descargar Excel &nbsp; <i class="glyphicon glyphicon glyphicon-save"></i>', 
														array(
																'controller'=>'Companies',
																'action'=>'specificSearchCandidateResultsExcel',
															),
															array(
																'class' => 'btn btn-primary',
																'style'=>'margin-top: 7px;',
																'escape' => false,
																)	
											); 
				?>
			</div>
			
			<div class="col-md-3">
				<?php $options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200); ?>
				<?= $this->Form->input('limit', ['type'=>'select','options' => $options,'id'=> 'limit','class' => 'selectpicker show-tick form-control         show-menu-arrow','selected' => $this->Session->read('limite'),'default'=>'0', 'empty' => 'Resultados por hoja','onchange' => 'sendLimit()']);
				?>	
			</div>
			
			<div class="col-md-5">
				<?php 
						if($this->Session->read('orden') == 'DESC'):
							$addClassSalaryASC = 'active'; 
							$addClassSalaryDESC = ''; 
						else:
							if($this->Session->read('orden') == 'ASC'):
								$addClassSalaryASC = ''; 
								$addClassSalaryDESC = 'active';
							else:
								$addClassSalaryASC = ''; 
								$addClassSalaryDESC = ''; 
							endif;
						endif;
				?>
				<div class="btn-group">
					<button type="button" class="btn btn-default col-md-12" data-toggle="dropdown">Ordenar por fecha &nbsp;<i class="glyphicon glyphicon-level-up"></i><span class="caret"></span></button>
					<ul class="dropdown-menu nav" role="menu">
						<li>
							<?= $this->Html->link(' Más reciente a más antigua', 
											['controller'=>'Companies',
											'action'=>'specificSearchCandidateResults','?' => ['orden' => 'DESC']],
											['class' => 'selectpicker show-tick form-control show-menu-arrow'.$addClassSalaryASC,'style' => 'border-color: transparent;','escape' => false]); ?>
							
						</li>
						<li>
							<?php echo $this->Html->link(' Más antigua a más reciente ', 
											['controller'=>'Companies',
											'action'=>'specificSearchCandidateResults','?' => ['orden' => 'ASC']],
											['class' => 'selectpicker show-tick form-control show-menu-arrow' . $addClassSalaryDESC,'style' => 'margin-top: 5px;border-color: transparent;','escape' => false]); ?>
		
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-12"  style="padding-left: 0px;">
				<?php if(isset($candidatos)): 
						if(empty($candidatos)):
							echo '<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
							<p style="color: #588BAD">Sin resultados</p>
						  </blockquote>';	
						else:
				?>
				<div class="col-md-12 scrollbar" id="style-2" style="margin-top: 30px">
					<?= $this->element('candidatos'); ?>
				</div>	
				
				<?php 
						endif;
					endif; 
				?>
			   
			</div>
		</div>   
		
	
    <div class="col-md-12" style="margin-top: 30px">
	
		<div class="col-md-12">
			<center>
				<?php 
					if(!empty($candidatos)):
				?>
				<div class="pagination" style="margin-top: 5px;margin-bottom: 15px;">
						<p style="margin-bottom: 0px;">
							<?=$this->Paginator->counter(array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}')); ?>
						</p>
						<ul class="pagination pagination-sm" style="margin-top: 5px;margin-bottom: 5px;"> 
							
							<?=$this->Paginator->first('<<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
							<?=$this->Paginator->prev ('<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
							<?=$this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1)); ?>
							<?=$this->Paginator->next ('>', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
							<?=$this->Paginator->last ('>>', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
						</ul>
				</div>
				<?php endif; ?>
			</center>
		</div>	
	</div>
		
		
		
	<!--Form para Agendar entrevista telefónica-->
		<div class="modal fade" id="myModalnotificationTelefonica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 630px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Seleccione el día y la hora para la entrevista telefónica</h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 350;">
									
					
								<?php 
									echo $this->Form->create('Company', array(
																		'class' => 'form-horizontal',
																		'id' => 'FormTelephoneNotification',
																		'role' => 'form',
																		'inputDefaults' => array(
																				'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																												'div' => array('class' => 'form-group'),
																												'class' => 'form-control',
																												'before' => '<div class="col-md-12 ">',
																												'between' => ' <div class="col-md-11" style="padding-right: 5px;">',
																												'after' => '</div></div>',
																												'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
																		),
																		'action' => 'companyTelephoneNotification',
																		'onsubmit' =>'return validateTelephoneNotificationForm();'
									)); 
								?>	
						
										<div class="col-md-12 col-md-offset-0" style=" margin-top: 40px;  padding-right: 0px;">	
												<fieldset>
													<?php 	echo $this->Form->input('StudentNotification.student_id', array(
																												'type'=>'hidden',
																												'id'=>'StudentTelephoneNotificationId'
													)); ?>
													<?php 	echo $this->Form->input('CompanyInterviewMessage.id', array(
																												'type'=>'hidden',
																												'value'=>$company['CompanyInterviewMessage']['id'],
													)); ?>
													<?php 	echo $this->Form->input('StudentNotification.company_interview_message', array(
																										'id' => 'StudentTelephoneNotificationMessage',
																										'before' => '<div class="col-md-12 ">',
																										'style' => 'resize: vertical; min-height: 75px;  max-height: 120px; height: 75px;',
																										'maxlength' => '316',
																										'type' => 'textarea',
																										'value'=>$company['CompanyInterviewMessage']['telehone_interview_message'],
																										// 'id' => 'taComentario',
																										'label' => array(
																													'class' => 'col-md-0 control-label',
																													'text' => ''),
																													'placeholder' => 'Mensaje ',
													));	?>
													<div class="col-md-11 form-group row" style="text-align: right; top: -10px; margin-left: 7px; margin-bottom: 0px;">
														<span id="contadorTaComentario" style="color: white">0/316</span><span style="color: white"> caracteres máx.</span>
													</div>
													
													<div class="col-xs-6 col-md-offset-6" style="height: 0;">
														<p style="margin-left: -52%;margin-top: 5px;">Fecha</p>
														<p style="margin-left: -8%;margin-top: 30px;">Hora</p>
														<label class="col-md-6 control-label"  style="margin-left: 131px; top: -37px;"></label>
													</div>
														<?php 	echo $this->Form->input('StudentNotification.company_interview_date', array(
																										'id' => 'StudentTelephoneNotificationDate',
																										'type' => 'date',
																										'before' => '<div class="col-md-12">',
																										'between' => ' <div class="col-md-8" style="left: 28%;">',
																										'style' => 'width: 98px;    margin-left: -10px; margin-right: 18px;padding:0px',
																										'div' => array('class' => 'form-inline'),
																										'label' => array(
																											'class' => 'col-sm-0 col-md-0 col-xs-offset-1 control-label ',
																											'text' => '',),
																										'dateFormat' => 'YMD',
																										'separator' => '',
																										'minYear' => date('Y') - -2,
																										'maxYear' => date('Y') - 0,	
																
														));	?>
												
														<?php 	echo $this->Form->input('StudentNotification.company_interview_hour', array(
																										'id' => 'StudentTelephoneNotificationHour',
																										'type' => 'time',
																										'timeFormat' => '24',
																										'interval' => 15,
																										'before' => '<div class="col-md-12" style="left: -15px; margin-top: 15px;">',
																										'between' => ' <div class="col-md-6 col-md-offset-6" style="padding-left: 46px;">',
																										'style' => 'width: 98px; margin-left: 4px; border-left-width: 0; padding-left: 0;  padding-left: 0px; padding-right: 0px;',
																										'div' => array('class' => 'form-inline'),
																										'label' => array(
																														'class' => 'col-md-2 control-label',
																														'text' => ''),
														));?>

													<div class="form-group required">
														<div class="col-md-12" style="padding-right: 0px;">
															<label for="StudentAcademicSituationId"></label>
															<div class="col-md-11 "  style="margin-top: 15px;">
																<select  id="StudentAcademicSituationId" class="form-control" required="required" name="data[StudentNotification][company_job_profile_id]" >
																	<option value="">Seleccione el puesto interesado en el perfil</option>
																	<?php 
																		foreach($company['CompanyJobProfile'] as $k => $companyJobProfileId):

																			$caracteres = strlen($companyJobProfileId['id']);
																			$faltantes = 5 - $caracteres;	
																			if($faltantes > 0):
																				$ceros = '';
																				for($cont=0; $cont<=$faltantes;$cont++):
																					$ceros .= '0';
																				endfor;
																				$folio = $ceros.$companyJobProfileId['id'];
																			else:
																				$folio = strlen($companyJobProfileId['id']);
																			endif;
																			
																			if(!empty($companyJobProfileId['CompanyJobContractType']) and ($companyJobProfileId['CompanyJobContractType']['salary']<>'')):
																				$salario = $Salarios[$companyJobProfileId['CompanyJobContractType']['salary']];
																			else:
																				$salario = '';
																			endif
																	?>
																			<option value=<?php echo $companyJobProfileId['id']; ?> > <?php echo $folio.' '.$companyJobProfileId['job_name'].' '.$salario; ?></option>
																	<?php 
																		endforeach;
																	?>
																	
																</select>
															</div>
														</div>
													</div>
													
												</fieldset>	
										</div>
				
				

								</div>
								<div class="modal-footer">
									<?php 	echo $this->Form->button('Enviar',array(
																			'type' => 'submit', 
																			'div' => 'form-group',
																			'escape' => false,
																			'class' => 'btn btnRed btn-default col-md-3 col-md-offset-8'
																));
											echo $this->Form->end(); 
									?>
								</div>
							</div>
						</div>
					</div>
	
	<!--Form para Agendar entrevista personal-->
		<div class="modal fade" id="myModalnotificationPersonal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 670px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Indique los datos para la entrevista personal</h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 500px;">
									
								<?php 
									echo $this->Form->create('Company', array(
																		'id' => 'FormPersonalNotification',
																		'class' => 'form-horizontal', 
																		'role' => 'form',
																		'inputDefaults' => array(
																				'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																												'div' => array('class' => 'form-group'),
																												'class' => 'form-control',
																												'before' => '<div class="col-md-12 ">',
																												'between' => ' <div class="col-md-11" style="padding-right: 0px;">',
																												'after' => '</div></div>',
																												'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
																		),
																		'action' => 'companyPersonalNotification',
																		'onsubmit' =>'return validatePersonalNotificationForm();'
									)); 
								?>	
						
										<div class="col-md-12 col-md-offset-0" style=" margin-top: 5px;  padding-right: 0px;">	
												<fieldset>
													<?php 	echo $this->Form->input('StudentNotification.student_id', array(
																												'id'=>'StudentPersonalNotificationId',
																												'type'=>'hidden', 
																												'class'=>'StudentNotificationStudentId'
													)); ?>
													<?php 	echo $this->Form->input('CompanyInterviewMessage.id', array(
																												'type'=>'hidden',
																												'value'=>$company['CompanyInterviewMessage']['id'],
													)); ?>
													<?php 	echo $this->Form->input('StudentNotification.company_interview_message', array(
																										'id' => 'StudentPersonalNotificationMessage',
																										'before' => '<div class="col-md-12 ">',
																										'style' => 'resize: vertical; min-height: 75px;  max-height: 120px; height: 75px;',
																										'maxlength' => '316',
																										'type' => 'textarea',
																										'value'=>$company['CompanyInterviewMessage']['personal_interview_message'],
																										// 'id' => 'taComentario2',
																										'label' => array(
																													'class' => 'col-md-0 control-label',
																													'text' => ''),
																													'placeholder' => 'Mensaje ',
													));	?>
													
													<div class="col-xs-6 col-md-offset-6" style="height: 0;">
														<p style="margin-left: -41%;margin-top: 12px;">Fecha</p>
														<p style="margin-left: 1%;margin-top: 27px;">Hora</p>
														<label class="col-md-6 control-label"  style="margin-left: 131px; top: -37px;"></label>
													</div>

														<?php 	echo $this->Form->input('StudentPersonalNotification.company_interview_date', array(
																										'id' => 'StudentPersonalNotificationDate',
																										'type' => 'date',
																										'before' => '<div class="col-md-11" style="margin-left: 62px;"">',
																										'between' => ' <div class="col-md-8 col-md-offset-4">',
																										'style' => 'width: 98px; margin-left: -10px; margin-right: 18px; padding:0px',
																										'div' => array('class' => 'form-inline'),
																										'label' => array(
																											'class' => 'col-xs-offset-3 control-label ',
																											'text' => '',),
																										'dateFormat' => 'YMD',
																										'separator' => '',
																										'minYear' => date('Y') - -2,
																										'maxYear' => date('Y') - 0,	
																
														));	?>
														
												
														<?php 	echo $this->Form->input('StudentPersonalNotification.company_interview_hour', array(
																										'type' => 'time',
																										'timeFormat' => '24',
																										'interval' => 15,
																										'before' => '<div class="col-md-11" style="left: 58px; margin-top: 10px;">',
																										'between' => ' <div class="col-md-6 col-md-offset-6" style="padding-left: 20px;">',
																										'style' => 'width: 98px; margin-left: 4px; border-left-width: 0; padding-left: 0;  padding-left: 0px; padding-right: 0px;',
																										'div' => array('class' => 'form-inline'),
																										'label' => array(
																														'class' => 'col-md-1 col-md-offset-5 control-label',
																														'text' => ''),
														));?>
														
														<?php 	echo $this->Form->input('StudentNotification.company_interview_direction', array(
																										'before' => '<div class="col-md-12 ">',
																										'between' => ' <div class="col-md-11" style="margin-top: 20px; padding-right: 0px;">',
																										'label' => array(
																													'class' => 'col-md-0 control-label',
																													'text' => ''),
																										'placeholder' => 'Dirección ',
														));	?>
														<?php 	echo $this->Form->input('StudentNotification.company_contact_name', array(
																										'before' => '<div class="col-md-12 ">',
																										'between' => ' <div class="col-md-11" style="padding-right: 0px;">',
																										'label' => array(
																													'class' => 'col-md-0 control-label',
																													'text' => ''),
																										'placeholder' => 'Nombre del entrevistador ',
														));	?>
														<?php 	echo $this->Form->input('StudentNotification.company_contact', array(
																										'before' => '<div class="col-md-12 ">',
																										'between' => ' <div class="col-md-11" style="padding-right: 0px;">',
																										'label' => array(
																													'class' => 'col-md-0 control-label',
																													'text' => ''),
																										'placeholder' => 'Contacto entrevistador',
														));	?>
														<?php 	echo $this->Form->input('StudentNotification.company_interview_document', array(
// 																										'before' => '<div class="col-md-12"><img data-toggle="tooltip" id="" data-placement="left" title="Documentación requerida para la entrevista presencial.
// Ejemplo:
// IFE, Currículum impreso, etcétera." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: 6px;margin-left: 6px;">',
																										'between' => ' <div class="col-md-11" style="padding-right: 0px;">',
																										'label' => array(
																													'class' => 'col-md-0 control-label',
																													'text' => ''),
																										'placeholder' => 'Documentos',
														));	?>

														<div class="form-group required">
														<div class="col-md-12" style="padding-right: 0px;">
															<label for="StudentAcademicSituationId"></label>
															<div class="col-md-11 " >
																<select  id="StudentAcademicSituationId" class="form-control" required="required" name="data[StudentNotification][company_job_profile_id]" >
																	<option value="">Seleccione el puesto interesado en el perfil</option>
																	<?php 
																		foreach($company['CompanyJobProfile'] as $k => $companyJobProfileId):

																			$caracteres = strlen($companyJobProfileId['id']);
																			$faltantes = 5 - $caracteres;	
																			if($faltantes > 0):
																				$ceros = '';
																				for($cont=0; $cont<=$faltantes;$cont++):
																					$ceros .= '0';
																				endfor;
																				$folio = $ceros.$companyJobProfileId['id'];
																			else:
																				$folio = strlen($companyJobProfileId['id']);
																			endif;
																			
																			if(!empty($companyJobProfileId['CompanyJobContractType']) and ($companyJobProfileId['CompanyJobContractType']['salary']<>'')):
																				$salario = $Salarios[$companyJobProfileId['CompanyJobContractType']['salary']];
																			else:
																				$salario = '';
																			endif
																	?>
																			<option value=<?php echo $companyJobProfileId['id']; ?> > <?php echo $folio.' '.$companyJobProfileId['job_name'].' '.$salario; ?></option>
																	<?php 
																		endforeach;
																	?>
																	
																</select>
															</div>
														</div>
													</div>

												</fieldset>	
										</div>
				
				

								</div>
								<div class="modal-footer">
									<?php 	echo $this->Form->button('Enviar',array(
																			'type' => 'submit', 
																			'div' => 'form-group',
																			'escape' => false,
																			'class' => 'btn btnRed btn-default col-md-3 col-md-offset-8'
																));
											echo $this->Form->end(); 
									?>
								</div>
							</div>
						</div>
					</div>

	<!--Form para envio de correo -->
		<div class="modal fade" id="myModalMail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 650px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Envio de correo electrónico a perfil de candidato</h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 440px;">
									<?php
										echo $this->Form->create('Company', array(
														'type' => 'file',
														'class' => 'form-horizontal', 
														'role' => 'form',
														'inputDefaults' => array(
															'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
															'div' => array('class' => 'form-group'),
															'class' => 'form-control',
															'label' => array('class' => 'col-xs-4 col-sm-4 col-md-2 col-md-4 control-label '),
															'before' => '<div class="col-md-12 ">',
															'between' => '<div class="col-xs-11 col-sm-10 col-md-10 " >',
															'after' => '</div></div>',
															'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
														),
														'action' => 'companyEmailNotification'
									)); ?>
										

										<style type="text/css">
											.upload {
												width: 154px;
												height: 35px;
												background: url("<?php echo $this->webroot; ?>/img/adjuntarboton.png");
												overflow: hidden;
												background-repeat-x: no-repeat;
												background-repeat:no-repeat;
												margin-left: 35px;
												margin-top: -28px;
											}
										</style>

										<fieldset style="margin-top: 30px;">
											
											<?php echo $this->Form->input('Student.emailTo', array(
																					'readonly' => 'readonly',
																					'before' => '<div class="col-md-9 ">',	
																					'between' => '<div class="col-xs-11 col-sm-10 col-md-10 " style="padding-left: 5px; padding-right: 5px;">',
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'style' => 'left: 6px;',
																									'text' => '',
																								),
																					'placeholder' => 'Correo',
											)); ?>
											<?php echo $this->Form->input('Student.CC', array(	
																					'type' => 'hidden',
																					'before' => '<div class="col-md-12 ">',	
																					'style'	=> 'margin-left: -15px;',		
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'text' => 'CC:',
																									'style' => 'margin-left: 15px;',
																								),
																					'placeholder' => 'CC',
											)); ?>
											<?php echo $this->Form->input('Student.CCO', array(	
																					'type' => 'hidden',
																					'before' => '<div class="col-md-12 ">',	
																					'style' => 'margin-left: -15px;',			
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'text' => 'CCO:',
																									'style' => 'margin-left: 15px;',
																								),
																					'placeholder' => 'CCO',
											)); ?>
											<?php echo $this->Form->input('Student.title', array(
																					'before' => '<div class="col-md-9 ">',
																					'between' => '<div class="col-xs-11 col-sm-10 col-md-10 " style="padding-left: 5px; padding-right: 5px;">',
																					'style' => 'margin-left: -5px;',				
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'text' => '',
																									'style' => 'margin-left: 5px;',
																									),
																					'placeholder' => 'Título',
											)); ?>
											
											<?php echo $this->Form->input('Student.file', array(
																					'type' => 'file',
																					'before' => '<div class="col-md-12 ">',
																					'between' => '<div class="col-xs-11 col-sm-9 col-md-8 upload">',
																					'style' => 'display: block !important;
																														width: 157px !important;
																														height: 57px !important;
																														opacity: 0 !important;
																														overflow: hidden !important;
																														background-repeat-y: no-repeat;
																														cursor: pointer;',
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-6 col-md-3 control-label',
																									'text' => 'máx. 200kb'
																									),
																					'onchange' => 'cambiarContenido()'
																					
											)); ?>
											<div class="col-md-12" >
												<p id="textFile" style="border-top-width: 0px; margin-left: 18px; "></p>
											</div>
											<?php echo $this->Form->input('Student.message', array(	
																						'type' => 'textarea',
																						'rows' => '5',
																						'cols' => '5',
																						'maxlength' => '632',
																						'id' => 'messageIdEmail',
																						'before' => '<div class="col-md-12 ">',
																						'style' => 'margin-left: -25px; resize: vertical; min-height: 75px;  max-height: 150px; height: 130px;',
																						'label' => array(
																										'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																										'text' => '',
																										'style' => 'margin-top: -5px;left: -7px;',
																						),
																						'placeholder' => 'Cuerpo del correo'
											)); ?>
											<div class="col-md-11 form-group row" style="text-align: right; top: -10px; margin-left: 7px; margin-bottom: 0px;padding-right: 22px;">
												<span id="contadorTaComentario2" style="color: white">0/632</span><span style="color: white"> caracteres máx.</span>
											</div>
													
											<?php echo $this->Form->input('Student.sign', array(	
																					'before' => '<div class="col-md-6 ">',
																					'style' => 'margin-left: -10px;',
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'text' => '',
																									'style' => 'margin-left: 10px;',
																									),
																					'placeholder' => 'Firma',
																					'between' => '<div class="col-xs-11 col-sm-8 col-md-4 ">',

											)); ?>
										</fieldset>

								</div>
								<div class="modal-footer">
									<?php 	echo $this->Form->button('Enviar',array(
																			'type' => 'submit', 
																			'div' => 'form-group',
																			'escape' => false,
																			'class' => 'btn btnRed btn-default col-md-3 col-md-offset-8'
																));
											echo $this->Form->end(); 
									?>
								</div>
							</div>
						</div>
					</div>
	
	<!--Form para reportar contratación-->
		<div class="modal fade" id="myModalReportarContratacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 630px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Reportar contratación</h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 215px;">
								<?php 
									echo $this->Form->create('Company', array(
																		'class' => 'form-horizontal', 
																		'role' => 'form',
																		'inputDefaults' => array(
																				'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																												'div' => array('class' => 'form-group'),
																												'class' => 'form-control',
																												'before' => '<div class="col-md-12 ">',
																												'between' => ' <div class="col-md-11" style="padding-right: 5px;">',
																												'after' => '</div></div>',
																												'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
																		),
																		'action' => 'reportarContratacion',
																		'onsubmit' =>'return validarReportarContratacionForm();'
									)); 
								?>	
						
										<div class="col-md-12 col-md-offset-0" style=" margin-top: 40px;  padding-right: 0px;">	
												<fieldset>
													<?php 	echo $this->Form->input('StudentReportarContratacion.student_id', array('type'=>'hidden')); ?>

													
													<div class="col-xs-6 col-md-offset-6" style="height: 0;">
														<p style="margin-left: -52%;margin-top: 5px;">Fecha</p>
														<label class="col-md-6 control-label"  style="margin-left: 131px; top: -37px;"></label>
													</div>
														<?php 	echo $this->Form->input('StudentReportarContratacion.fecha_contratacion', array(
																										'type' => 'date',
																										'before' => '<div class="col-md-12">',
																										'between' => ' <div class="col-md-8" style="left: 28%;">',
																										'style' => 'width: 98px;    margin-left: -10px; margin-right: 18px;padding:0px',
																										'div' => array('class' => 'form-inline'),
																										'label' => array(
																											'class' => 'col-sm-0 col-md-0 col-xs-offset-1 control-label ',
																											'text' => '',),
																										'dateFormat' => 'YMD',
																										'separator' => '',
																										'minYear' => date('Y') - 20,
																										'maxYear' => date('Y') - 0,	
																
														));	?>

													<div class="form-group required">
														<div class="col-md-12" style="padding-right: 0px;">
															<label for="StudentAcademicSituationId"></label>
															<div class="col-md-11 "  style="margin-top: 15px;">
																<select  id="StudentAcademicSituationId" class="form-control" required="required" name="data[StudentReportarContratacion][company_job_profile_id]" >
																	<option value="">Seleccione el puesto que cubrió el candidato</option>
																	<?php 
																		foreach($company['CompanyJobProfile'] as $k => $companyJobProfileId):

																			$caracteres = strlen($companyJobProfileId['id']);
																			$faltantes = 5 - $caracteres;	
																			if($faltantes > 0):
																				$ceros = '';
																				for($cont=0; $cont<=$faltantes;$cont++):
																					$ceros .= '0';
																				endfor;
																				$folio = $ceros.$companyJobProfileId['id'];
																			else:
																				$folio = strlen($companyJobProfileId['id']);
																			endif;
																			
																			if(!empty($companyJobProfileId['CompanyJobContractType']) and ($companyJobProfileId['CompanyJobContractType']['salary']<>'')):
																				$salario = $Salarios[$companyJobProfileId['CompanyJobContractType']['salary']];
																			else:
																				$salario = '';
																			endif
																	?>
																			<option value=<?php echo $companyJobProfileId['id']; ?> > <?php echo $folio.' '.$companyJobProfileId['job_name'].' '.$salario; ?></option>
																	<?php 
																		endforeach;
																	?>
																	
																</select>
															</div>
														</div>
													</div>
													
												</fieldset>	
										</div>
				
				

								</div>
								<div class="modal-footer">
									<?php 	echo $this->Form->button('Reportar contratación',array(
																			'type' => 'submit', 
																			'div' => 'form-group',
																			'escape' => false,
																			'class' => 'btn btnRed btn-default col-md-4 col-md-offset-7'
																));
											echo $this->Form->end(); 
									?>
								</div>
							</div>
						</div>
					</div>			