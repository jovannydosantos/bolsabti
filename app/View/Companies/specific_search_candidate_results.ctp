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
		function cargaAreas(id, index){
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
					$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpCarreras.php',{escuela: '', level: 2 },function(JSON){
						
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
					$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpCarreras.php',{escuela: '', level: 1 },function(JSON){
						
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
	
	<div class="col-md-12">
		<?php echo $this->Session->flash(); ?>
	</div>
		
	<div class="col-md-12">
		
		<div class="col-md-4">
				<?php
				echo $this->Form->button('Palabras clave', array(
														'type' => 'button',
														'id' => 'idButtonCollapse1',
														'class' => 'btn btnBlue btn-default col-md-12',
														'onClick' => 'openCollapse(1);',
													)
										);
				?>
			</div>
			<div class="col-md-4">
				<?php
				echo $this->Form->button('Perfil del candidato', array(
														'type' => 'button',
														'id' => 'idButtonCollapse2',
														'class' => 'btn btnBlue btn-default col-md-12',
														'onClick' => 'openCollapse(2);',
													)
										);
				?>
			</div>
			<div class="col-md-4">
				<?php 
				echo $this->Form->create('Student', array(
										'class' => 'form-horizontal', 
										'role' => 'form',
										'inputDefaults' => array(
												'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
												'div' => array('class' => 'form-group'),
												'class' => 'form-control',
												'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
												'between' => ' <div class="col-md-6">',
												'after' => '</div></div>',
												'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
										),
										'onsubmit' =>'addName(); return false;',
										'action' => 'studentSavedSearch',
						)); ?>					
						
						<?php 
						echo $this->Form->input('Guardar Búsqueda Realizada', array(
													'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="Guarde la búsqueda específica 
que ha realizado con el fin de 
ser utilizada para futuras búsquedas." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
													'type' => 'submit',
													'label' => '',
													'between' => ' <div class="col-md-11">',
													'class' => 'btn btnBlue btn-default form-control',
													'escape' => true,
												)
						);
					echo $this->Form->end(); 		
				?>
			</div>	
		</div>
		
		<div class="col-md-12">
			<div class="col-md-4">
				<?php
				echo $this->Form->button('Modalidad de contratación', array(
														'type' => 'button',
														'id' => 'idButtonCollapse3',
														'class' => 'btn btnBlue btn-default col-md-12',
														'onClick' => 'openCollapse(3);',
													)
										);
				?>
			</div>
			
			<div class="col-md-4">
				<?php
				echo $this->Form->button('Conocimientos y habilidades profesionales', array(
														'type' => 'button',
														'id' => 'idButtonCollapse4',
														'style'=> 'padding-right: 0px; padding-left: 0px;',
														'class' => 'btn btnBlue btn-default col-md-12',
														'onClick' => 'openCollapse(4);',
													)
										);
				?>
			</div>
			
			<div class="col-md-4">
				<?php 
					echo $this->Form->create('Company', array(
											'class' => 'form-horizontal', 
											'id' => 'viewSearchId',
											'role' => 'form',
											'inputDefaults' => array(
													'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
													'div' => array('class' => 'form-group'),
													'class' => 'form-control',
													'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
													'between' => ' <div class="col-md-6">',
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
																'selected' => $this->Session->read('serialized_form.Administrator.busqueda_guardada'),
																'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																'div' => array('class' => 'form-group'),
																'class' => 'form-control selectpicker show-tick show-menu-arrow',
																'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="Búsquedas específicas que ha guardado. 
Le recordamos que puede guardar como máximo 10 búsquedas, en caso de exceder este número se irán borrando las primeras búsquedas específicas guardadas." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
																'between' => ' <div class="col-md-11">',
																'after' => '</div></div>',
																'options' => $busquedasGuardadas,'default'=>'0', 'empty' => 'Búsquedas guardadas'
					)); 
				?>
				<?php 		
					echo $this->Form->end(); 
				?>	
				<div style="text-align: left;" class="col-md-offset-4">
						<p style="margin-top: -14px; margin-left: 93px;"> (máx. 10)</p>
				</div>
			</div>
		</div>
		
			<?php 	echo $this->Form->create('Company', array(
									'class' => 'form-horizontal', 
									'role' => 'form',
									'id' => 'requestForm',
									'inputDefaults' => array(
											'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
											'div' => array('class' => 'form-group'),
											'class' => 'form-control',
											'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
											'between' => ' <div class="col-md-6 col-md-offset-3">',
											'after' => '</div></div>',
											'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
									),
									'action' => 'specificSearchCandidateResults',
									'onsubmit' =>'return validateInputs();'
			)); ?>	
		
			<div class="panel panel-default">
				<div id="collapse1" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="col-md-12">
							<button type="button" class="btn btnRed btn-default col-md-offset-11" onClick="closeCollapse(1);">
							  <i class="glyphicon glyphicon-remove-sign"></i>
							</button>
						</div>
						
						<div style="text-align: left;" class="col-md-offset-3">
							<p style="margin-left: 30px;"> Palabras clave</p>
						</div>
					
						<?php // name for save search 
						echo $this->Form->input('CompanySavedSearch.name', array(
										'label' => '',
										'type' => 'hidden',
						));	?>
						<?php 	echo $this->Form->input('CompanyJobProfile.job_name', array(
										'label' => '',
										'maxlength' => 60,
										'class' => 'form-control',
										'before' => '<div class="col-md-12 ">',
										'placeholder' => 'Palabras clave',
						));	?>

						<div class="col-md-2 col-md-offset-5">
						<?php	
						echo $this->Form->button(
										'Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',
																	array( 
																	'type' => 'submit',
																	'class' => 'btn btnBlue btn-default  col-md-12',
																	'onClick' => 'return submitSearch();',
																)
														);
						
						?>
						
						</div>
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div id="collapse2" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="col-md-12">
							<button type="button" class="btn btnRed btn-default col-md-offset-11" onClick="closeCollapse(2);">
								<i class="glyphicon glyphicon-remove-sign"></i>
							</button>
						</div>
					
						<div class="col-md-6 " style="margin-left: -16px;">	
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
																					'class' => 'selectpicker show-tick form-control show-menu-arrow',
																					'before' => '<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;">',
																					'between' => ' <div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">',
																					'label' => '',
																					'placeholder'=>'Edad max', 
																					'options' => $option,'default'=>'', 'empty' => 'Edad mínima'
																					
												));?>
									</div>			
									<div class="col-md-6">
												<?php 	echo $this->Form->input('Student.fecha_maxima', array(
																					'type'=>'select',
																					'class' => 'selectpicker show-tick form-control show-menu-arrow',
																					'before' => '<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;">',
																					'between' => ' <div class="col-md-10" style="padding-left: 0px; padding-right: 0px;margin-left: 3px;">',
																					'label' => '',
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
																			'class' => 'selectpicker show-tick form-control show-menu-arrow',
																			'before' => '<div class="col-md-12" style="margin-left: 5px;>',
																			'label' => '',
																			'between' => ' <div class="col-md-12" style="margin-left: -21px;">',
																			'options' => $TiposDiscapacidad,'default'=>'0', 'empty' => 'Tipo de discapacidad'
											)); ?>
										</div>
									</div>

							<p style="margin-left: 15px;">Lugar de trabajo</p>
									
									<?php 	
										echo $this->Form->input('StudentProfile.state', array(	
																	'type' => 'select',
																	'class' => 'selectpicker show-tick form-control show-menu-arrow',
																	'data-live-search' => 'true',
																	'id' =>'estado',
																	'between' => ' <div class="col-md-12" style="margin-left: 8px; margin-top: -17px; padding-left: 6px;">',
																	'before' => '<div class="col-md-11">',
																	'label' => '',
																	'required' => false,
																	'options' => $estadosMexico,'default'=>'0', 'empty' => 'Estado / Entidad Federativa',
									)); ?>	
									
									<?php 
										echo $this->Form->input('StudentProfile.city', array(	
																	'type' => 'select',
																	'class' => 'selectpicker show-tick form-control show-menu-arrow',
																	'data-live-search' => 'true',
																	'id' => 'ciudad',
																	'between' => ' <div class="col-md-12" style="margin-left: 8px; margin-top: -17px; padding-left: 6px;">',
																	'before' => '<div class="col-md-11">',
																	'label' => '',
																	'required' => false,
																	'default'=>'0', 'empty' => 'Delegación / Municipio',
									)); ?>
						</div>
			
						<fieldset class='col-md-offset-0 col-md-10' style="min-width: 850px;">
							<p style="margin-bottom: 0px;margin-left:-5px;"><span style="color:red;"></span>Nivel académico<img data-toggle="tooltip" id="" data-placement="right" title="Grado de estudios que debe tener el candidato para cumplir con el perfil de la oferta." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 5px; margin-top: -5px;"></p>
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
							
							<p style="margin-bottom: 0px;margin-left:-5px;"><span style="color:red;"></span>Situación académica del último nivel de estudios seleccionado<img data-toggle="tooltip" id="" data-placement="top" title="Situación académica requerida para cumplir con el perfil de la oferta" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 5px; margin-top: -5px;"></p>
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
														'class' => 'selectpicker show-tick form-control show-menu-arrow',
														'data-width' => '385px',
														'label' => '',
														'between' => ' <div class="col-md-6">',
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
																			'between' => ' <div class="col-md-11" style="padding-left: 0px; padding-right: 0px;">',
																			'label' => '',
																			'class' => 'form-control selectpicker show-tick show-menu-arrow',
																'placeholder' => 'Decimal',
																'options' => $Decimales,'default'=>'0', 'empty' => 'Decimas',
																'onchange' => 'promedio()',
									)); ?>
						</div>
					</div>
					
					<div class="col-md-12" style="padding-left: 0px;">	
						<p style="margin-left: -5px;">
						<span style="color:red;"></span>
						Carreras / Áreas
						</p>
					</div>
	
					<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">	
						<div class="col-md-6" style="padding-left: 0px; padding-right: 0px;">
							<?php 	echo $this->Form->input('CompanyCandidateProfile.origen', array(
												'type'=>'select',
												'label' => '',
												'before' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 15px;">',
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
						
						<div class="col-md-1" style="padding-left: 0px;">
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
					
					<div class="col-md-2 col-md-offset-5" style="left: 15px;">
						<?php echo $this->Form->button(
												'Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',
																			array( 
																			'type' => 'submit',
																			'class' => 'btn btnBlue btn-default  col-md-12',
																			'onClick' => 'return submitSearch();',
																		)
															);
								?>
					</div>
					</fieldset>
					</div>
				</div>
			</div>
			
		<div class="panel panel-default">
		
			<div id="collapse3" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="col-md-12">
						<button type="button" class="btn btnRed btn-default col-md-offset-11" onClick="closeCollapse(3);">
						   <i class="glyphicon glyphicon-remove-sign"></i>
						</button>
					</div>
		
					<div class="col-md-10 col-md-offset-1">
						<div class="col-md-12">
							<div class="col-md-12">
								<div style="text-align: left;" class="col-md-offset-3 col-md-9">
									<p>Modalidad de contratación</p>
								</div>

								<div class="col-md-11" style="padding-left: 5px;">	
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

								<div class="col-md-11">	
									<?php 	echo $this->Form->input('StudentProspect.economic_pretension', array(
																			'type' => 'select',
																			'class' => 'selectpicker show-tick form-control show-menu-arrow',
																			'data-width' => '385px',
																			'before' => '<div class="col-md-12 ">',
																			'style' => 'margin-left: 6px;width: 385px;',
																			'label' => array(
																					'class' => 'col-md-0 control-label',
																					'text' => ''),
																			'placeholder' => '',
																			'options' => $Salarios,'default'=>'0', 'empty' => 'Pretensiones económicas'
									));	?>
								</div>
					
								<div class="col-md-11">	

									<div id="original" class="clonGiro">
										<?php 	echo $this->Form->input('CompanyJobProfileDynamicGiro.0.giro', array(
														'type'=>'select',
														'before' => '<div class="col-md-12 ">',
														'label' => '',
														'class' => 'form-control clonGiroReindexa selectpicker show-tick show-menu-arrow',
														'data-live-search' => "true",
														'data-width' => '385px',
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

								<script languaje="javascript">
									var cont2 = 1;
								</script> 
							
							<div class="contenedorClonesGiros col-md-offset-3"  style="margin-right: 20px;">
							<?php 
								$cont = 0;
								$index = 0;
								if(!empty($this->request->data['CompanyJobProfileDynamicGiro'])):
									foreach($this->request->data['CompanyJobProfileDynamicGiro'] as $k => $giro): 
										if($cont > 0):
							?>
										<div id="IdClonGiro<?php echo $cont; ?>" class="clonGiro<?php echo $cont; ?> clonGiroIndependiente">
										<div class="form-group" style="margin-left: -30px; margin-bottom: 0px;">
										<div class="col-md-12 " style="">
										<label for="CompanyJobProfileGiro"></label>
										<div class="col-md-11">
											
												<button id="eliminarGiro" class="btn btn-danger maxGiros" style="margin-left: 5px; padding-left: 6px; padding-right: 5px;margin-bottom: -50px; margin-right: 10px; margin-left: -25px;width: 38px; position: absolute; z-index: 10" type="button" onclick="eliminarClonGiro(<?php echo $cont; ?>); ">
													<i class="glyphicon glyphicon-trash"></i>
												</button>
												<?php 	echo $this->Form->input('CompanyJobProfileDynamicGiro.'.$cont.'.giro', array(
																'type'=>'select',
																'before' => '<div class="col-md-12 ">',
																'between' => ' <div class="col-md-6 col-md-offset-0">',
																'label' => '',
																'class' => 'form-control clonGiroReindexa selectpicker show-tick show-menu-arrow',
																'data-live-search' => "true",
																'data-width' => '385px',
																'placeholder' => 'Giro',
																'style' => 'width: 385px;margin-left: 5px;',
																'onchange' => 'cargaAreas('.$cont.')',
																'options' => $Giros,'default'=>'0', 'empty' => 'Giro de interés',
												));	?>
												<?php 	echo $this->Form->input('CompanyJobProfileDynamicArea.'.$cont.'.area_interes', array(
																'type'=>'select',
																'class' => 'form-control clonAreaReindexa selectpicker show-tick show-menu-arrow',
																'data-live-search' => "true",
																'data-width' => '385px',
																'before' => '<div class="col-md-12 ">',
																'between' => ' <div class="col-md-6 col-md-offset-0">',
																'label' => '',
																'style' => 'width: 385px;margin-left: 5px;',
																'placeholder' => 'Áreas de interés',
																'default'=>'0', 'empty' => 'Área de interés',
												));	?>
										</div>
										</div>
										</div>
										</div>

											<script languaje="javascript">
												cont2++;
												cargaAreas(<?php echo $cont.','.$this->request->data['CompanyJobProfileDynamicArea'][$cont]['area_interes']; ?>);
											</script> 
							<?php
										endif;
										$cont++;
										$index++;
									endforeach; 
								endif;
							?>
							
								</div>
						
								</div>
								
								<div style="text-align: left; padding-right: 15px; margin-right: 0px; left: 22px;" class="col-md-offset-5 col-md-5">
									<p>Agregar otro giro y área (máx. 4) <img src="<?php echo $this->webroot; ?>/img/add.png" id="agregarGiro" onclick="clonarGiro();" style='background-color: transparent; width: 25px;cursor:pointer;margin-top: -5px;'> </p>
								</div>
								
								<div class="col-md-8 col-md-offset-3">
										<?php 	
												$options = array('s' => 'Si', 'n' => 'No');
												echo $this->Form->input('StudentProspect.can_travel', array(
																	'type' => 'radio',
																	'style' => 'margin-left: -18px; margin-top: 0; top: 7px; width: 15px;height:15px',
																	'default'=> 0,
																	'legend' => false,
																	'before' => '<div class="col-md-5 col-md-offset-7" style="color: #fff;"><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
																	'after' => '</label></div></div>',
																	'separator' => '</label></div><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
																	'options' => $options,
																	'onclick' => 'desabilityMobility1()'
												));
										?>
									<p style="position: absolute; margin-top: -46px;"><span style="color:red;"></span>Disponibilidad para viajar</p>
								</div>

								<div id="bloque1" style="display:none">
										<div class="col-md-7 col-md-offset-3"  style="left: -25px;" >
											<?php 	
												$options = array('1' => 'Dentro del país', '2' => 'Fuera del país');
												echo $this->Form->input('StudentProspect.can_travel_option', array(
																	'type' => 'radio',
																	'style' => 'margin-left: -18px; margin-top: 0; top: 7px; width: 15px;height:15px',
																	'default'=> 0,
																	'legend' => false,
																	'before' => '<div class="col-xs-12 col-sm-12 col-md-12" style="color: #fff;margin-left:95px"><div class="radio-inline col-xs-5 col-sm-5 col-md-5"><label>',
																	'after' => '</label></div></div>',
																	'separator' => '</label></div><div class="radio-inline col-xs-5 col-sm-5 col-md-5"><label>',
																	'options' => $options,
												));
												
											?>
										</div>
								</div>
									
								<div class="col-md-9 col-md-offset-2">
										<?php 	
												$options = array('s' => 'Si', 'n' => 'No');
												echo $this->Form->input('StudentProspect.change_residence', array(
																	'type' => 'radio',
																	'style' => 'margin-left: -18px; margin-top: 0; top: 7px; width: 15px;height:15px',
																	'default'=> 0,
																	'legend' => false,
																	'before' => '<div class="col-md-5 col-md-offset-7" style="color: #fff; left: 25px;"><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
																	'after' => '</label></div></div>',
																	'separator' => '</label></div><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
																	'options' => $options,
																	'onclick' => 'desabilityMobility2()'
												));
										?>

										<p style="position: absolute; margin-top: -50px; margin-left: 0px; left: 77px;"><span style="color:red;"></span>Disponibilidad para cambiar de residencia</p>
								</div>
									
								<div id="bloque3" style="display:none">
										<div class="col-md-7 col-md-offset-3" style="left: -25px;" >
											<?php 	
													$options = array('1' => 'Dentro del país', '2' => 'Fuera del país');
													echo $this->Form->input('StudentProspect.change_residence_option', array(
																		'type' => 'radio',
																		'style' => 'margin-left: -18px; margin-top: 0; top: 7px; width: 15px;height:15px',
																		'default'=> 0,
																		'legend' => false,
																		'before' => '<div class="col-xs-12 col-sm-12 col-md-12" style="color: #fff;margin-left:87px;margin-top: -5px;  right: -10px;"><div class="radio-inline col-xs-5 col-sm-5 col-md-5"><label>',
																		'after' => '</label></div></div>',
																		'separator' => '</label></div><div class="radio-inline col-xs-5 col-sm-5 col-md-5"><label>',
																		'options' => $options,
													));
											?>
										</div>
								</div>
								
								
								<div class="col-md-3 col-md-offset-5">
									<?php echo $this->Form->button(
													'Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',
																				array( 
																				'type' => 'submit',
																				'class' => 'btn btnBlue btn-default col-md-9',
																				'onClick' => 'return submitSearch();',
																			)
																);
									?>
								</div>
					
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			
			<div class="panel panel-default">
				<div id="collapse4" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="col-md-12">
						
							<button type="button" class="btn btnRed btn-default col-md-offset-11" onClick="closeCollapse(4);">
							   <i class="glyphicon glyphicon-remove-sign"></i>
							</button>
						</div>
						
						<div class="col-md-6 col-md-offset-3">
							<div style="margin-right: 8px; margin-left: -10px;width: 415px;margin-top: 2px;">		
								<div id="contenedorIdiomas" style="width: 412px;">	
									<div class="col-md-12 col-md-offset-1">
										<p>Conocimientos y habilidades profesionales</p>
										<p>Idioma</p>
									</div>
									<?php 	echo $this->Form->input('StudentLenguage.0.language_id', array(
													'type'=>'select',
													'required' => false,
													'before' => '<div class="col-md-12 ">',
													'between' => ' <div class="col-md-11 col-md-offset-1">',
													'class' => 'form-control selectpicker show-tick show-menu-arrow',
													'label' => '',
													'options' => $Lenguages,'default'=>'0', 'empty' => 'Idioma'
									));?>
									<?php 	echo $this->Form->input('StudentLenguage.0.reading_level', array(
													'type'=>'select',
													'required' => false,
													'before' => '<div class="col-md-12 col-md-offset-1">',
													'between' => ' <div class="col-md-7">',
													'class' => 'form-control selectpicker show-tick show-menu-arrow',
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
													'between' => ' <div class="col-md-7">',
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
													'between' => ' <div class="col-md-7">',
													'class' => 'form-control selectpicker show-tick show-menu-arrow',
													'label' => array(
															'class' => 'col-md-4 control-label',
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
																		'options' => $Lenguages,'default'=>'0', 'empty' => 'Idioma'
														));?>
														<?php 	echo $this->Form->input('StudentLenguage.'.$cont.'.reading_level', array(
																		'type'=>'select',
																		'before' => '<div class="col-md-12 col-md-offset-1">',
																		'required' => false,
																		'between' => ' <div class="col-md-7">',
																		'class' => 'form-control selectpicker show-tick show-menu-arrow',
																		'label' => array(
																				'class' => 'col-md-4 control-label',
																				'text' => 'Lectura'),
																		'placeholder' => 'Nivel',
																		'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel'
														));	?>
														<?php 	echo $this->Form->input('StudentLenguage.'.$cont.'.writing_level', array(
																		'type'=>'select',
																		'before' => '<div class="col-md-12 col-md-offset-1">',
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
																		'before' => '<div class="col-md-12 col-md-offset-1">',
																		'required' => false,
																		'between' => ' <div class="col-md-7">',
																		'class' => 'form-control selectpicker show-tick show-menu-arrow',
																		'label' => array(
																				'class' => 'col-md-4 control-label',
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
								<div>
									<p style="margin-left: 188px;">Agregar otro idioma (máx 4)<img  id="agregarIdioma" src="<?php echo $this->webroot; ?>/img/add.png" ALT="add.png" style='background-color: transparent; width: 25px; cursor: pointer; margin-top: -2px; margin-left: 5px;'></p>
								</div>
							</div>

							<div id="contenedorComputo" style="margin-left: 25px; margin-right: -130px; width: 450px;"> 	
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
												'class' => 'form-control',
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
																		'class' => 'form-control',
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
																		'class' => 'form-control selectpicker show-tick show-menu-arrow',
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
							
							<div class="col-md-offset-4 col-md-7 ">
								<p>Agregar otro cómputo (máx 4) <img  id="agregarComputo" src="<?php echo $this->webroot; ?>/img/add.png" ALT="add.png" style='background-color: transparent; width: 25px; cursor:pointer;margin-top: -5px;'></p>
							</div>
				
				
			<div class="col-md-10" >
				<?php 	echo $this->Form->input('StudentJobSkill.name', array(
													'before' => '<div style="margin-left: 31px;">',
													'between' => '<div>',
													'maxlength' => '316',
													'type' => 'textarea',
													'required' => false,
													'label' => '',
													'style' => 'resize: vertical; min-height: 120px;  max-height: 120px; height: 120px;margin-left: 5px;',
													'placeholder' => 'Certificaciones',
				));	?>
				<div class="col-md-6" style="text-align: right; right; top: -10px;margin-left: 225px;">
					<span id="contadorTaComentario">0/316</span><span> caracteres máx.</span>
				</div>
			</div>		
				
			</div>
		</div>
						<div class="col-md-2 col-md-offset-5">
							<?php
							echo $this->Form->button(
										'Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',
																	array( 
																	'type' => 'submit',
																	'class' => 'btn btnBlue btn-default  col-md-12',
																	'onClick' => 'return submitSearch();',
																)
													);
							echo $this->Form->end(); 
							?>
							
						</div>
					
					</div>
				</div>
			</div>
	
		<div class="col-md-12">
		<?php if(isset($candidatos)):
				if(empty($candidatos)):
						echo '<p style="font-size: 22px; text-align: left;  margin-left: 35px;">Sin resultados</p>';
				else:
		?>
			
		<p style="margin-left: 15px;">Resultados de Búsqueda</p>
		
		<div class="col-md-9" style="padding-left: 0px;">
				<div class="col-md-3"style="margin-right: 15px;" >
						<?php 	echo $this->Html->link(
													'Descargar Excel  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon glyphicon-save"></i>', 
															array(
																	'controller'=>'Companies',
																	'action'=>'specificSearchCandidateResultsExcel',
																),
																array(
																	'class' => 'btn btn-default btnBlue ',
																	'style' => 'width: 180px; font-size: 14px; height: 32px;',
																	'escape' => false,
																	)	
												); 
						?>
				</div>
						
				<div class="col-md-4" style="margin-right: 25px;">
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
					  <button type="button" class="btn btnBlue btn-default dropdown-toggle" data-toggle="dropdown">Ordenar por fecha de actualización &nbsp;<i class="glyphicon glyphicon-chevron-down"></i><span class="caret"></span></button>
					  <ul class="dropdown-menu" role="menu">
						<li>
						<?php 
							echo $this->Html->link(
													' Más reciente a más antigua', 
														array(
															'controller'=>'Companies',
															'action'=>'specificSearchCandidateResults',
															'?' => array(
																	  'orden' => 'DESC',
															),
														),
														array(
															'class' => 'btn btn-default '.$addClassSalaryASC,
															'style' => 'margin-top: 5px;',
															'escape' => false)	
						); 	?>
						</li>
						<li>
						<?php echo $this->Html->link(
													' Más antigua a más reciente ', 
														array(
															'controller'=>'Companies',
															'action'=>'specificSearchCandidateResults',
															'?' => array(
																	  'orden' => 'ASC',
															),
														),
														array(
															'class' => 'btn btn-default ' . $addClassSalaryDESC,
															'style' => 'margin-top: 5px;',
															'escape' => false)	
						); 	?>
						</li>
					  </ul>
					</div>
				</div>
				
				<div class="col-md-3">
					<?php 
					echo $this->Form->create('Student', array(
									'class' => 'form-horizontal',
									'id' => 'limitRequest',
									'role' => 'form',
									'inputDefaults' => array(
															'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
															'div' => array('class' => 'form-group'),
															'class' => 'form-control',
															'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
															'between' => ' <div class="col-md-11">',
															'after' => '</div></div>',
															'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
									),
									'action' => 'profile',
					)); ?>
					<?php 	$options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200);
							echo $this->Form->input('limit', array(
																'onchange' => 'sendLimit()' ,
																'id' => 'limit',
																'type'=>'select',
																'style' => 'width: 180px; height: 32px;',
																'before' => '<div class="col-md-12 "',
																'selected' => $this->Session->read('limite'),
																'label' =>'',
																'options' => $options,'default'=>'0', 'empty' => 'Resultados por hoja'
					)); ?>
					<?php 		
						echo $this->Form->end(); 
					?>	
				</div>
		
		</div>
				
			<div class="col-md-10" style="max-height: 760px; witdh:720px; overflow-y: auto; padding-left: 0px; padding-right: 0px; margin-top: 10px;">
					
					<?php 
						foreach($candidatos as $k => $candidato):
					?>
						<div class="col-md-11" style="background: #fff none repeat scroll 0 0; min-height: 135px; margin-top: 15px; padding-left: 0px; padding-right: 0px; margin-left: 0px; right: -25px;">    
						
							<div class="col-md-2" style="text-align: center; margin-top: 20px; padding-left: 0px; padding-right: 0px;">
								<?php
											if (isset($candidato)):
												if(isset($candidato['Student']['filename'])):
													$url = WWW_ROOT.'img/uploads/student/filename/'.$candidato['Student']['filename'];
													if(!file_exists( $url )):
														echo $this->Html->image('student/imagenNoEncontrada.png',
																	array(
																		'alt' => 'Profile Photo',
																		'style' => 'width:80px; height: 80px; '
																	));
													else:
														if($candidato['Student']['filename'] <> ''):
															echo $this->Html->image('uploads/student/filename/'.$candidato['Student']['filename'],
																		array(
																			'alt' => 'Profile Photo',
																			'style' => 'width:80px; height: 80px; '
																		));
														else:
															echo $this->Html->image('student/imagenNoDisponible.png',
																		array(
																			'alt' => 'Profile Photo',
																			'style' => 'width:80px; height: 80px; '
																		));
														endif;
													endif;
												else:
													echo $this->Html->image('student/imagenNoDisponible.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '80px',
																		'height' => '80px',	
																	));
												endif;
											else:
												echo $this->Html->image('student/imagenNoDisponible.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '80px',
																		'height' => '80px',
																	));
											endif;
									?>
									
								<p class="blackText" style="margin-top: 5px;">
									<?php echo $candidato['StudentProfile']['name'].' '.$candidato['StudentProfile']['last_name'].' '.$candidato['StudentProfile']['second_last_name']; ?>
								</p>
							</div>
						
							<div class="col-xs-6" style="margin-top: 10px; text-align: left;">
								<?php
									$caracteres = strlen($candidato['Student']['id']);
									$faltantes = 5 - $caracteres;	
									if($faltantes > 0):
										$ceros = '';
										for($cont=0; $cont<=$faltantes;$cont++):
											$ceros .= '0';
										endfor;
										$folio = $ceros.$candidato['Student']['id'];
									else:
										$folio = strlen($candidato['Student']['id']);
									endif;
									
									// Cálculo de edad
									$fecha1 = explode("-",$candidato['StudentProfile']['date_of_birth']); // fecha nacimiento
									$fecha2 = explode("-",date("Y-m-d")); // fecha actual

									$Edad = $fecha2[0]-$fecha1[0];
									if($fecha2[1]<=$fecha1[1] and $fecha2[2]<=$fecha1[2]){
									$Edad = $Edad - 1;
									}
									
									if($candidato['StudentProfile']['date_of_birth'] == '0000-00-00'):
										$Edad = 'Sin especificar';
									endif;


									// Obtiene información de idioma
									if(!empty($candidato['StudentLenguage'])):
										$numeroIdiomas = count($candidato['StudentLenguage']);
										
										if((isset($candidato['StudentLenguage'][0]['Lenguage']['lenguage'])) and (!empty($candidato['StudentLenguage'][0]['Lenguage']['lenguage']))):
											$primerIdioma = $candidato['StudentLenguage'][0]['Lenguage']['lenguage'] ;
										else:
											$primerIdioma = 'Sin especificar';
										endif;
									else:
										$numeroIdiomas = 0;
										$primerIdioma = 'Sin especificar';
									endif;
									
									// Obtiene información de áreas de interés
									if(!empty($candidato['StudentInterestJob'])):
										$numeroAreas = count($candidato['StudentInterestJob']);
										
										if((isset($candidato['StudentInterestJob'][0]['InterestArea']['interest_area'])) and (!empty($candidato['StudentInterestJob'][0]['InterestArea']['interest_area']))):
											$primerArea = $candidato['StudentInterestJob'][0]['InterestArea']['interest_area'] ;
										else:
											$primerArea = 'Sin especificar';
										endif;
									else:
										$numeroAreas = 0;
										$primerArea = 'Sin especificar';
									endif;
									

									
								?>
								<p class="blackText">Folio: <?php echo $folio; ?></p>
								<p class="blackText">Nivel académico: <span style="font-weight: normal;"><?php  echo $candidato['AcademicLevel']['academic_level']; ?> </span></p>
								<p class="blackText">Situación académica: <span style="font-weight: normal;"><?php  echo $candidato['AcademicSituation']['academic_situation']; ?> </span></p>
								<p class="blackText">Sexo: <span style="font-weight: normal;"><?php  echo ($candidato['StudentProfile']['sex'] == 1) ? 'Femenino' : 'Masculino'; ?> </span></p>
								<p class="blackText">Edad: <span style="font-weight: normal;"><?php  echo $Edad; ?> </span></p>
								<p class="blackText">Idioma y nivel: <span style="font-weight: normal;"><?php  echo ($numeroIdiomas > 1) ? '<strong>('.$numeroIdiomas.'):</strong> '. $primerIdioma : $primerIdioma; ?> </span></p>
								<p class="blackText">Área de interés: <span style="font-weight: normal;"><?php  echo ($numeroAreas > 1) ? '<strong>('.$numeroAreas.'):</strong> '. $primerArea : $primerArea; ?> </span></p>
								<p class="blackText">Residencia: <span style="font-weight: normal;"><?php  echo (($candidato['StudentProfile']['state'] <> '') and ($candidato['StudentProfile']['subdivision'] <> '')) ? $candidato['StudentProfile']['state'] . ', ' . $candidato['StudentProfile']['subdivision'] : 'Sin especificar' ; ?> </span></p>
							</div>
						

						<div class="col-md-4" style="background: #58595B; float: right; height: 30px;">
							<div style="margin-top: 3px; margin-left: 5px;" class="grises2">
							
								<?php 
									$var = 0;
									$vista = 0;
									foreach($candidato['CompanyViewedStudent'] as $k => $viewed):
										if($viewed['company_id'] == ($this->Session->read('company_id'))):
											$vista = 1;
											 break;
										endif;
									endforeach;
					
									if($vista == 0):
										echo $this->Html->image('student/visto.png',
											array(
												'title' => 'Perfil no visto',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;'
										)); 
										
									else:
									
										echo $this->Html->image('student/noVisto.png',
											array(
												'title' => 'Perfil visto',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;'
										)); 
									endif;
								
								?>
								
								<?php 
									$guardado = 0;
									$cont = -1;
									foreach($candidato['CompanySavedStudent'] as $k => $saveOffer):
									$cont++;
										if($saveOffer['company_id'] == ($this->Session->read('company_id'))):
											$guardado = 1;
											 break;
										endif;
									endforeach;
									
									if($cont > -1):
										foreach($folders as $folder):
											if($folder['CompanyFolder']['id'] == $candidato['CompanySavedStudent'][$cont]['company_folder_id']):
												$nombreFolder = $folder['CompanyFolder']['name'];
												break;
											else:
												$nombreFolder = 'Sin especificar';
											endif;
										endforeach;
									endif;
					
									if($guardado == 0):
										echo $this->Html->image('student/guardado.png',
											array(
												'title' => 'Guardar perfil',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'saveOffer('.$candidato['Student']['id'].');',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;'
											));
										
									else:
										echo $this->Html->image('student/noGuardado.png',
											array(
												'title' => 'Perfil guardado en '.$nombreFolder,
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;'
											));
									endif;
								?>
								
								<?php 
										echo $this->Html->image('student/phone.png',
											array(
												'title' => 'Agendar entrevista telefónica',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'saveTelephoneNotification('.$candidato['Student']['id'].');',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;'
										)); 
								?>
								
								<?php 
								echo $this->Html->image('student/personal.png',
											array(
												'title' => 'Agendar entrevista presencial',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'savePersonalNotification('.$candidato['Student']['id'].');',
												'style' => 'width: 17px; height: 20px; margin-right: 10px; cursor:pointer;'
											)
								); 
								?>
								
								<?php 
										echo $this->Html->image('student/contratado.png',
											array(
												'title' => 'Reportar contratación ',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;',
												'onclick' => 'saveReportarContratacion('.$candidato['Student']['id'].');',
												)
										);
								?>
								
								<?php 
									echo $this->Html->image('student/arroba.png',
												array(
													'title' => 'Enviar correo',
													'class' => 'class="img-responsive center-block"',
													'onclick' => 'saveEmailNotification("'.$candidato['Student']['email'].'");',
													'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;'
													)
									);	
								?>
								
								<?php
									$cvCompleto = '';
									if(($candidato['StudentProfile']['sex']<>'') and (!empty($candidato['StudentProfessionalProfile'])) and (!empty($candidato['StudentJobProspect'])) and ($candidato['StudentJobProspect']['id']<>null) and (!empty($candidato['StudentProspect']))  and ($candidato['StudentProspect']['id']<>null)):
										$cvCompleto = 'Si';
									else:
										$cvCompleto = 'No';
									endif;
								?>
							
								<?php 
								 // Descargar cv del estudiante
								 if($cvCompleto == 'Si'):
									if($company['CompanyOfferOption']['max_cv_download'] <> null):
										if($totalDescargas>=$company['CompanyOfferOption']['max_cv_download']):
											echo $this->Html->image('student/descargado.png',
																		array(
																			'title' => 'Descargar CV en PDF',
																			'class' => 'class="img-responsive center-block"',
																			'onclick' => 'mensajeLimiteDescargas();',
																			'style' => 'width: 17px; height: 20px; cursor: help; '
																			)
																	);	
										else:
											echo $this->Html->link(
														$this->Html->image('student/descargado.png', array('escape' => false,'style' => 'width: 17px; height: 20px; cursor: pointer; ')),
														array(
															'controller' => 'Companies', 
															'action' => 'viewCvPdf',$candidato['Student']['id'] 
															), 
														array('target' => '_blank','escape' => false,'title' => 'Descargar CV en PDF',)
											);
										endif;
									else:
										echo $this->Html->image('student/descargado.png',
																		array(
																			'title' => 'Descargar CV en PDF',
																			'class' => 'class="img-responsive center-block"',
																			'onclick' => 'mensajeSinConfigurar();',
																			'style' => 'width: 17px; height: 20px; cursor: help; '
																			)
																	);	
									endif;
								else:
									echo $this->Html->image('student/descargado.png',
											array(
												'title' => 'Descargar CV en PDF',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'cvIncompleto();',
												'style' => 'width: 17px; height: 20px;  cursor: help; '
												)
												);	
								endif;
								?>
							</div>
						</div>
						
							<div class="col-xs-4" style="margin-top: 10px; text-align: left; padding-right: 0px; padding-left: 0px;">
								<p class="blackText">Correo: <span style="font-weight: normal;"><?php  echo $candidato['Student']['email']; ?> </span></p>
								<p class="blackText">Teléfono casa: <span style="font-weight: normal;"><?php  echo ($candidato['StudentProfile']['telephone_contact'] <> '') ? $candidato['StudentProfile']['lada_telephone_contact'].$candidato['StudentProfile']['telephone_contact'] : 'Sin especificar';  ?> </span></p>
								<p class="blackText">Celular: <span style="font-weight: normal;"><?php  echo ($candidato['StudentProfile']['cell_phone'] <> '') ? $candidato['StudentProfile']['lada_cell_phone'].$candidato['StudentProfile']['cell_phone'] : 'Sin especificar'; ?> </span></p>
								
								<?php echo $this->Html->link(
														' Ver perfil completo ', 
														array(
															'controller'=>'Companies',
															'action'=>'viewCvOnline', $candidato['Student']['id']),
														array(
															'class' => 'btn btnRed col-md-8',
															'style' => 'margin-top: 5px;margin-left: 70px;',
															'escape' => false)	
								); 	?>
							
							</div>
						
						</div>
					<?php endforeach; ?>
				
			<?php 
				endif;
				endif; 
			?>
		</div>
	
		<div class="col-md-11" style="margin-left:17px;">
		<?php 
		if(!empty($candidatos)):
		?>
		<p>
		<?php echo $this->Paginator->counter(
		array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}')
		); ?>
		</p>
		
		<div class="pagin" style="">
		<?php echo $this->Paginator->first('<< primero');?>
		<?php echo $this->Paginator->prev('< anterior', array(), null, array('class' => 'prev disabled')); ?>
		<?php echo $this->Paginator->numbers(array('separator'=>'')); ?>
		<?php echo $this->Paginator->next('siguiente >', array(), null, array('class' => 'next disabled'));?>
		<?php echo $this->Paginator->last('último >>');?>
		</div>	
		
		<?php endif; ?>
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
																												'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" >',
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
																										'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="left" title="Crear un mensaje genérico con el fin de programar una entrevista telefónica." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: 50px;">',
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
																										'before' => '<div class="col-md-12" style="left: -15px; margin-top: 15px;"><img data-toggle="tooltip" id="" data-placement="left" title="Podrá seleccionar dos opciones de día y hora para programar la entrevista telefónica." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="left: 95%; position: absolute; z-index: 10;margin-top: 15px;">',
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
																												'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="left" title="Documentación requerida para la entrevista presencial.Ejemplo:IFE, Currículum impreso, etcétera" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 6px;margin-top: 6px;" >',
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
																										'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="left" title="Crear un mensaje genérico con el fin de programar una entrevista presencial." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: 52px;margin-left: 5px;">',
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
															'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="left" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
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
																					'before' => '<div class="col-md-9 "><img data-toggle="tooltip" id="" data-placement="top" title="Ingresar asunto del mensaje, breve y conciso." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: 8px;">',
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
												<img data-toggle="tooltip" id="" data-placement="left" title="Mensaje que le será enviado al candidato" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: -55px;">
											</div>
													
											<?php echo $this->Form->input('Student.sign', array(	
																					'before' => '<div class="col-md-6 "><img data-toggle="tooltip" id="" data-placement="top" title="Texto de identificación que será presentado en todos los correos que envíe.Se sugiere los siguientes datos: nombre, cargo y empresa, teléfono de contacto, redes sociales." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: -5px;margin-top: 8px;">',
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
																												'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" >',
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