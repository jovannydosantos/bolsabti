<?php 
	$this->layout = 'administrator'; 
?>
	<style>
		.panel {
			box-shadow: 0 0 0 rgba(0, 0, 0, 0.8);
		}
	</style>
	
	<script>
	
		$(document).ready(function() {
			
			var helpText = [
							"Guarda y nombra las consultas de ofertas en carpetas para una mejor organización. Las carpetas creadas se ordenarán alfabéticamente.",				
							"Guarda las modificaciones de las búsquedas específicas que ha realizado.",
							"Búsquedas específicas que ha guardado. Le recordamos que puede guardar como máximo 10 búsquedas, en caso de exceder este número se irán borrando las primeras búsquedas específicas guardadas.",
							"",
							"",
							"",
							"",
							"Son las carreras, especialidades, maestrías o doctorados  parecidos o relacionados con el nivel académico seleccionado y que el sistema tomará en cuenta en la búsqueda.                                                                              Ejemplo. Carrera: Administración = Carrera afín: Administración de empresas Maestría: Proyección de Mercados potenciales = Maestría afín: Mercadotecnia",
							"",
							"",
							"",
							"Remuneración monetaria que recibe periódicamente un empleado por parte de la empresa o institución a cambio de sus servicios profesionales.",
							"Actividad principal que realiza la empresa o institución.                                                                                 Ejemplos: Automotriz                                                                    Farmacéutica",
							"Área en la que desea enfocar su desarrollo profesional o ha desarrollado experiencia laboral.",
							"Área específica en la que desea enfocar su desarrollo profesional o aplicar su experiencia laboral.",
							"Grado de dominio sobre diversas habilidades lingüísticas.",
							"Grado de dominio sobre diversas habilidades de computo.",
							];
			 
			$('.form-group').each(function(index, element) {
				$(this).find(".cambia").attr("id", index);
				$(this).find('#'+index).attr("data-original-title", helpText[index]);
			});
			
			$('#StudentSavedSearchName').val('');
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

		// Funcion de carga de áreas
		var cont = 1;
		var cont = 1;
		var cont2 = 1;
		var cont3 = 1;
		var cont4 = 1;
		
		function cargaAreas(id, idArea){
				if($('#CompanyJobProfileDynamicGiro'+id+'Giro').val() != 0)
					{
					$('#loading').show();
					$.get('http://bolsa.trabajo.unam.mx.1.15/unam/app/webroot/php/derpAreas.php',{giro: $('#CompanyJobProfileDynamicGiro'+id+'Giro').val()},function(JSON)
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

		function clonarLenguaje(){
			var numIdiomas = $(".maxIdiomas");
			if(numIdiomas.length >= 3){			
				jAlert ("Sólo puedes agregar hasta 3 idiomas");
				return false;
			} else if (document.getElementById("CompanyJobLanguage0LanguageId").value.length === 0){
				jAlert ("Seleccione un valor para idioma antes de agregar otro");
				return false;
			} else {
				$(".contenedorClonesLanguages").append(
				'<div id="IdClonLanguage'+cont+'" class="clonLanguage'+cont+' clonLanguageIndependiente">'+
					
					'<div class="col-md-6 col-md-offset-3">'+
					'<button id="eliminarIdioma" class="btn btn-danger maxIdiomas eliminar" type="button" style="padding-left: 5px; padding-right: 5px; border-right-width: 0px; border-left-width: 0px; z-index: 100; position: absolute; right: 340px; margin-left: 5px; left: 442px;"><i class="glyphicon glyphicon-trash"></i>&nbsp;</button>'+
						'<div class="col-md-6">'+
							'<div class="form-group">'+
								'<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;">'+
									'<label for="CompanyJobLanguageLanguageId"></label>'+
									'<div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">'+
										'<select id="CompanyJobLanguage'+cont+'LanguageId" class="form-control selectpicker show-tick show-menu-arrow selectClonLanguage'+cont+' clonLanguageReindexa" name="data[CompanyJobLanguage]['+cont+'][language_id]">'+
												
										'</select>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="col-md-6" >'+
							'<div class="form-group">'+
								'<div class="col-md-12 "  style="padding-left: 0px; padding-right: 0px;">'+
									
									'<label for="CompanyJobLanguageLevel"></label>'+
									'<div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">'+
										'<select id="CompanyJobLanguage'+cont+'Level" class="form-control selectpicker show-tick show-menu-arrow selectClonLevelLanguage'+cont+' clonLevelLanguageReindexa" name="data[CompanyJobLanguage]['+cont+'][level]">'+
												
										'</select>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'
				);
				$('.selectClonLanguage').empty();
				$('.selectClonLevelLanguage').empty();
				
				$('#CompanyJobLanguage0LanguageId').find('option').clone().appendTo('.selectClonLanguage'+cont);
				$('#CompanyJobLanguage0Level').find('option').clone().appendTo('.selectClonLevelLanguage'+cont);
				
				document.getElementById('CompanyJobLanguage'+cont+'LanguageId').options[0].selected = 'selected';
				document.getElementById('CompanyJobLanguage'+cont+'Level').options[0].selected = 'selected';
				cont++;
			}
			$('.selectpicker').selectpicker('refresh');
		}
		
		function eliminarClonLanguage(num){
			cont--;
			var key = 0;
			
			$( '.clonLanguage'+num ).remove();
			
			$(".clonLanguageIndependiente").each(function(index, value) { 
				key++;
					
				var newClass = 'clonLanguage'+key+' clonLanguageIndependiente';
				var newId = 'IdClonLanguage' + key;
					
				$( "#"+$(this).attr('id') ).removeClass( $(this).attr('class') ).addClass( newClass );
				$( "#"+$(this).attr('id')).attr("id", newId);
					

				$(this).find(".clonLanguageReindexa").attr("id", 'CompanyJobLanguage'+key+'LanguageId');
				$(this).find(".clonLanguageReindexa").attr("name", 'data[CompanyJobLanguage]['+key+'][language_id]');
				$(this).find(".clonLanguageReindexa").attr("class", 'form-control selectClonLanguage'+key+' clonLanguageReindexa');
				
				$(this).find(".clonLevelLanguageReindexa").attr("id", 'CompanyJobLanguage'+key+'Level');
				$(this).find(".clonLevelLanguageReindexa").attr("name", 'data[CompanyJobLanguage]['+key+'][level]');
				$(this).find(".clonLevelLanguageReindexa").attr("class", 'form-control selectClonLevelLanguage'+key+' clonLevelLanguageReindexa');
				
				$(this).find(".maxIdiomas").attr("onclick", 'eliminarClonLanguage('+key+')');
				}
			);
		}
		
		function clonarGiro(){
			var numGiros = $(".maxGiros");
			if(numGiros.length >= 2){			
				jAlert ("S\u00f3lo puedes agregar hasta 2 giros");
				return false;
			} else if (	(document.getElementById("CompanyJobProfileDynamicGiro0Giro").value.length === 0) && 
						(document.getElementById("CompanyJobProfileDynamicArea0AreaInteres").value.length === 0)){
				jAlert ("Ingrese al menos un valor antes de agregar otro giro");
				return false;
			} else {
				$(".contenedorClonesGiros").append(
					'<div id="IdClonGiro'+cont2+'" class="clonGiro'+cont2+' clonGiroIndependiente">'+
					'<button id="eliminarGiro" class="btn btn-danger maxGiros eliminar" type="button" style="border-left-width: 0px; border-right-width: 0px; padding-left: 5px; padding-right: 5px; margin-left: -15px; z-index: 100; position: absolute; right: 262px;"><i class="glyphicon glyphicon-trash"></i>&nbsp;</button>'+
					'<div class="form-group">'+
					'<div class="col-md-12 ">'+
					
					'<label for="CompanyJobProfileGiro"></label>'+
					'<div class="col-md-6  col-md-offset-3">'+
					'<select id="CompanyJobProfileDynamicGiro'+cont2+'Giro" onchange="cargaAreas('+cont2+')" class="form-control selectpicker show-tick show-menu-arrow clonGiroInteres'+cont2+' clonGiroReindexa" placeholder="Giro de interés" data-live-search="true" name="data[CompanyJobProfileDynamicGiro]['+cont2+'][giro]">'+
					
					'</select>'+
					'</div>'+
					'</div>'+
					'</div>'+
					'<div class="form-group">'+
					'<div class="col-md-12 ">'+
					'<label for="CompanyJobProfileAreaInteres"></label>'+
					'<div class="col-md-6  col-md-offset-3">'+
					'<select id="CompanyJobProfileDynamicArea'+cont2+'AreaInteres"  class="form-control selectpicker show-tick show-menu-arrow clonAreaReindexa" data-live-search="true" placeholder="Áreas de interés" name="data[CompanyJobProfileDynamicArea]['+cont2+'][area_interes]">'+
					'<option value="">Área de experiencia</option>'+

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
			cont2--;
			var key = 0;
			
			$( '.clonGiro'+num ).remove();
			
			$(".clonGiroIndependiente").each(function(index, value) { 
				key++;
				
				var newClass = 'clonGiro'+key+' clonGiroIndependiente';
				var newId = 'IdClonGiro' + key;
				
				$( "#"+$(this).attr('id') ).removeClass( $(this).attr('class') ).addClass( newClass );
				$( "#"+$(this).attr('id')).attr("id", newId);

				$(this).find(".clonGiroReindexa").attr("id", 'CompanyJobProfileDynamicGiro'+key+'Giro');
				$(this).find(".clonGiroReindexa").attr("name", 'data[CompanyJobProfileDynamicGiro]['+key+'][giro]');
				$(this).find(".clonGiroReindexa").attr("onchange", 'cargaAreas('+key+')');
					
				$(this).find(".clonAreaReindexa").attr("id", 'CompanyJobProfileDynamicArea'+key+'AreaInteres');
				$(this).find(".clonAreaReindexa").attr("name", 'data[CompanyJobProfileDynamicArea]['+key+'][area_interes]');

				$(this).find(".maxGiros").attr("onclick", 'eliminarClonGiro('+key+')');
				
				}
			);
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
					'<button id="eliminarIdioma" class="btn btn-danger maxFormaciones eliminar" type="button" style="margin-left: 5px; padding-left: 5px; padding-right: 5px; border-right-width: 0px; border-left-width: 0px; position: absolute; right: 270px; z-index: 100"><i class="glyphicon glyphicon-trash"></i>&nbsp;</button>'+
					'<div class="form-group">'+
					'<div class="col-md-12 ">'+
					
					'<label for="CompanyCandidateProfileAcademicLevel"></label>'+
					'<div class="col-md-6  col-md-offset-3">'+
					'<select id="CompanyCandidateProfileDynamicNivelAcademico'+cont3+'AcademicLevel" onchange = "changeAcademicLevel('+cont3+');" class="form-control selectpicker show-tick show-menu-arrow clonNivelAcademico'+cont3+' clonNivelAcademicoReindexa"  name="data[CompanyCandidateProfileDynamicNivelAcademico]['+cont3+'][academic_level]">'+
					
					'</select>'+
					'</div>'+
					'</div>'+
					'</div>'+
					
					'<div id="divCarrerasId'+cont3+'" class="divCarreras"  style="display: none;">'+
					'<div class="form-group">'+
					'<div class="col-md-12 ">'+
					'<label for="CompanyJobRelatedCareerDynamicCarrera'+cont3+'CareerId"></label>'+
					'<div class="col-md-6  col-md-offset-3">'+
					'<select id="CompanyJobRelatedCareerDynamicCarrera'+cont3+'CareerId" class="form-control selectpicker show-tick show-menu-arrow clonCarrera'+cont3+' clonCarreraReindexa" data-live-search="true" name="data[CompanyJobRelatedCareerDynamicCarrera]['+cont3+'][career_id]">'+
					
					'</select>'+
					'</div>'+
					'</div>'+
					'</div>'+
					'</div>'+
					
					'<div id="divAreasId'+cont3+'" class="divAreas" style="display: none;">'+
					'<div class="form-group">'+
					'<div class="col-md-12 ">'+
					'<label for="CompanyJobRelatedAreaDynamicArea'+cont3+'AreaId"></label>'+
					'<div class="col-md-6  col-md-offset-3">'+
					'<select id="CompanyJobRelatedAreaDynamicArea'+cont3+'AreaId" class="form-control selectpicker show-tick show-menu-arrow clonArea'+cont3+' clonAreaReindexa" data-live-search="true" name="data[CompanyJobRelatedAreaDynamicArea]['+cont3+'][area_id]">'+
					
					'</select>'+
					'</div>'+
					'</div>'+
					'</div>'+
					'</div>'+
					
					'<div class="form-group">'+
					'<div class="col-md-12 ">'+
					'<label for="CompanyCandidateProfileAcademicSituation"></label>'+
					'<div class="col-md-6  col-md-offset-3">'+
					'<select id="CompanyCandidateProfileDynamicSituacionAcademica'+cont3+'AcademicSituation" class="form-control selectpicker show-tick show-menu-arrow clonSituacionAcademica'+cont3+' clonSituacionAcademicaReindexa" name="data[CompanyCandidateProfileDynamicSituacionAcademica]['+cont3+'][academic_situation]">'+
					'<option value="">Situación académica</option>'+
					'</select>'+
					'</div>'+
					'</div>'+
					'</div>'+
				'</div>'
				);
				
				$('#CompanyCandidateProfileDynamicNivelAcademico0AcademicLevel').find('option').clone().appendTo('.clonNivelAcademico'+cont3);
				$('#CompanyJobRelatedCareerDynamicCarrera0CareerId').find('option').clone().appendTo('.clonCarrera'+cont3);
				$('#CompanyJobRelatedAreaDynamicArea0AreaId').find('option').clone().appendTo('.clonArea'+cont3);
				// $('#CompanyCandidateProfileDynamicSituacionAcademica0AcademicSituation').find('option').clone().appendTo('.clonSituacionAcademica'+cont3);
				
				document.getElementById('CompanyCandidateProfileDynamicNivelAcademico'+cont3+'AcademicLevel').options[0].selected = 'selected';
				// document.getElementById('CompanyCandidateProfileDynamicSituacionAcademica'+cont3+'AcademicSituation').options[0].selected = 'selected';	
				cont3++;
				$('.selectpicker').selectpicker('refresh');
			}
		}
		
		function eliminarClonFormacionAcademica(num){
			cont3--;
			var key = 0;
			
			$( '.clonFormcionAcademica'+num ).remove();
			
			$(".clonFormcionAcademicaIndependiente").each(function(index, value) { 
				key++;
					
				var newClass = 'clonFormcionAcademica' + key + ' clonFormcionAcademicaIndependiente';
				var newId = 'IdClonFormacionAcademica' + key;
					
				$( "#"+$(this).attr('id') ).removeClass( $(this).attr('class') ).addClass( newClass );
				$( "#"+$(this).attr('id')).attr("id", newId);
					
				$(this).find(".clonNivelAcademicoReindexa").attr("id", 'CompanyCandidateProfileDynamicNivelAcademico'+key+'AcademicLevel');
				$(this).find(".clonNivelAcademicoReindexa").attr("name", 'data[CompanyCandidateProfileDynamicNivelAcademico]['+key+'][academic_level]');
				$(this).find(".clonNivelAcademicoReindexa").attr("class", 'form-control clonNivelAcademico'+key+' clonNivelAcademicoReindexa');
				$(this).find(".clonNivelAcademicoReindexa").attr("onchange", 'changeAcademicLevel('+key+')');
					
				$(this).find(".clonCarreraReindexa").attr("id", 'CompanyJobRelatedCareerDynamicCarrera'+key+'CareerId');
				$(this).find(".clonCarreraReindexa").attr("name", 'data[CompanyJobRelatedCareerDynamicCarrera]['+key+'][career_id]');
				$(this).find(".clonCarreraReindexa").attr("class", 'form-control clonCarrera'+key+' clonCarreraReindexa');

				$(this).find(".clonAreaReindexa").attr("id", 'CompanyJobRelatedAreaDynamicArea'+key+'AreaId');
				$(this).find(".clonAreaReindexa").attr("name", 'data[CompanyJobRelatedAreaDynamicArea]['+key+'][area_id]');
				$(this).find(".clonAreaReindexa").attr("class", 'form-control clonArea'+key+' clonAreaReindexa');
					
				$(this).find(".clonSituacionAcademicaReindexa").attr("id", 'CompanyCandidateProfileDynamicSituacionAcademica'+key+'AcademicSituation');
				$(this).find(".clonSituacionAcademicaReindexa").attr("name", 'data[CompanyCandidateProfileDynamicSituacionAcademica]['+key+'][academic_situation]');
				$(this).find(".clonSituacionAcademicaReindexa").attr("class", 'form-control clonSituacionAcademica'+key+' clonSituacionAcademicaReindexa');
							
				$(this).find(".divCarreras").attr("id", 'divCarrerasId'+key);
				$(this).find(".divAreas").attr("id", 'divAreasId'+key);
				$(this).find(".maxFormaciones").attr("onclick", 'eliminarClonFormacionAcademica('+key+')');
			}
			);
		}
		
		function changeAcademicLevel(index)	{
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
			
				if (academicLevelSelectedIndex==1){
					$('#divCarrerasId'+index).show();
					document.getElementById('CompanyJobRelatedAreaDynamicArea'+index+'AreaId').options[0].selected = 'selected';
					$('#divAreasId'+index).hide();
				} else
					if (academicLevelSelectedIndex==0){
						document.getElementById('CompanyJobRelatedCareerDynamicCarrera'+index+'CareerId').options[0].selected = 'selected';
						$('#divCarrerasId'+index).hide();
						document.getElementById('CompanyJobRelatedAreaDynamicArea'+index+'AreaId').options[0].selected = 'selected';
						$('#divAreasId'+index).hide();
					} else {							
							document.getElementById('CompanyJobRelatedCareerDynamicCarrera'+index+'CareerId').options[0].selected = 'selected';
							$('#divCarrerasId'+index).hide();
							$('#divAreasId'+index).show();
						}
				 
		}
		
		function situacionesAcademicasUpdate(index, seleccionado)	{
				// jAlert(seleccionado);
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
		
		function clonarComputo(){
				var numComputos = $(".maxComputos");
				if(numComputos.length >= 3){			
					jAlert ("Sólo puedes agregar hasta 3 conocimientos de cómputo");
					return false;
				} else if (document.getElementById("CompanyJobComputingSkill0Name").value.length === 0){
					jAlert ("Ingrese un valor para cómputo antes de agregar otro");
					return false;
				} else {
					$(".contenedorClonesComputo").append(
						'<div id="IdClonComputo'+cont4+'" class="clonComputo'+cont4+' clonComputoIndependiente">'+
							'<div class="col-md-6 col-md-offset-3">'+
								'<button id="eliminarComputo" class="btn btn-danger maxComputos eliminar" type="button" style="padding-left: 5px; padding-right: 5px; border-right-width: 0px; border-left-width: 0px; z-index: 100; position: absolute; right: 340px; margin-left: 5px; left: 442px;"><i class="glyphicon glyphicon-trash"></i>&nbsp;</button>'+
						// '<div class="col-md-6">'+
								'<div class="col-md-6">'+
									'<div class="form-group">'+
										'<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;">'+
											'<label for="CompanyJobComputingSkillId"></label>'+
											'<div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">'+
												'<input id="CompanyJobComputingSkill'+cont4+'Name" class="form-control clonComputoNameReindexa" type="text" placeholder="Cómputo" name="data[CompanyJobComputingSkill]['+cont4+'][name]">'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>'+
								'<div class="col-md-6">'+
									'<div class="form-group">'+
										'<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;">'+
											'<label for="CompanyJobComputingSkillId"></label>'+
											'<div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">'+
												'<select id="CompanyJobComputingSkill'+cont4+'Level" class="form-control selectpicker show-tick show-menu-arrow selectClonComputoLevel'+cont4+' clonComputoLevelReindexa" name="data[CompanyJobComputingSkill]['+cont4+'][level]">'+
												
												'</select>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>'+
							// '</div>'+
						'</div>'
					);
					$('.selectClonComputoLevel').empty();
					
					$('#CompanyJobComputingSkill0Level').find('option').clone().appendTo('.selectClonComputoLevel'+cont4);
					document.getElementById('CompanyJobComputingSkill'+cont4+'Level').options[0].selected = 'selected';
					cont4++;
					$('.selectpicker').selectpicker('refresh');
				}
		}
				
		function eliminarClonComputo(num){
			cont4--;
			var key = 0;
			
			$( '.clonComputo'+num ).remove();
			
			$(".clonComputoIndependiente").each(function(index, value) { 
				key++;

				var newClass = 'clonComputo'+key+' clonComputoIndependiente';
				var newId = 'IdClonComputo' + key;
					
				$( "#"+$(this).attr('id') ).removeClass( $(this).attr('class') ).addClass( newClass );
				$( "#"+$(this).attr('id')).attr("id", newId);
				
				console.log($(this).attr('id'));
				console.log($(this).attr('class'));
				
				$(this).find(".clonComputoNameReindexa").attr("id", 'CompanyJobComputingSkill'+key+'Name');
				$(this).find(".clonComputoNameReindexa").attr("name", 'data[CompanyJobComputingSkill]['+key+'][name]');
				$(this).find(".clonComputoNameReindexa").attr("class", 'form-control clonComputoNameReindexa');
				
				$(this).find(".clonComputoLevelReindexa").attr("id", 'CompanyJobComputingSkill'+key+'Level');
				$(this).find(".clonComputoLevelReindexa").attr("name", 'data[CompanyJobComputingSkill]['+key+'][level]');
				$(this).find(".clonComputoLevelReindexa").attr("class", 'form-control selectClonComputoLevel'+key+' clonComputoLevelReindexa');
				
				$(this).find(".maxComputos").attr("onclick", 'eliminarClonComputo('+key+')');
				}
			);
		}
			
		function addName(){
				jPrompt('Ingrese el nombre de la búsqueda','','Guardar búsqueda realizada', function(r){
					if( r ){
							document.getElementById("StudentSavedSearchName").value = r;
							document.getElementById("formSpecificSearchId").submit();
					} else {
						return false;			
					}
				});
		}
			
		function viewSearch(){
				 selectedIndex = document.getElementById("AdministratorBusquedaGuardada").selectedIndex;
				 if(selectedIndex == 0){
					return false;
				 } else {
					document.getElementById("viewSearchId").submit();
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
					  }, 50);
					})();
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
				document.getElementById("formSpecificSearchId").submit();
			}
		}
	
		function changeAcademicLevel(index)	{
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
			
			
			if (academicLevelSelectedIndex==1){
				$('#divCarrerasId'+index).show();
				document.getElementById('CompanyJobRelatedAreaDynamicArea'+index+'AreaId').options[0].selected = 'selected';
				$('#divAreasId'+index).hide();
			} else
				if (academicLevelSelectedIndex==0){
					document.getElementById('CompanyJobRelatedCareerDynamicCarrera'+index+'CareerId').options[0].selected = 'selected';
					$('#divCarrerasId'+index).hide();
					document.getElementById('CompanyJobRelatedAreaDynamicArea'+index+'AreaId').options[0].selected = 'selected';
					$('#divAreasId'+index).hide();
				} else {							
						document.getElementById('CompanyJobRelatedCareerDynamicCarrera'+index+'CareerId').options[0].selected = 'selected';
						$('#divCarrerasId'+index).hide();
						$('#divAreasId'+index).show();
				}
			 $('.selectpicker').selectpicker('refresh');
		}
		
		function fechaMax(fecha, fechaCreacion){
			<?php if(($this->Session->read('Auth.User.role')=='administrator') OR ($this->Session->read('Auth.User.role')=='subadministrator')): ?>
				var hoy = new Date();
				var dd = hoy.getDate();
				var mm = hoy.getMonth()+1; //hoy es 0!
				var yyyy = hoy.getFullYear();
				hoy = yyyy+'-'+mm+'-'+dd;
				var fechaCreacion = hoy;
			<?php else: ?>
				var fechaCreacion = fechaCreacion;
			<?php endif; ?>
		
				var fechaArrCreacion = fechaCreacion.split('-');
				var aho2 = fechaArrCreacion[0];
				var mes2 = fechaArrCreacion[1];
				var dia2 = fechaArrCreacion[2];
				var fechaCreacionOferta = new Date(aho2,mes2,dia2);

				var fechaArr = fecha.split('/');
				var aho = fechaArr[2];
				var mes = fechaArr[1];
				var dia = fechaArr[0];
				var fechaPropuesta = new Date(aho, mes-1, dia); 

				if(fechaPropuesta > fechaCreacionOferta){
					return false;
				} else{
					return true;
				}
		}
		
		function saveVigencia(idJobProfile,fecha, fechaCreacion){
			var fechaArr = fecha.split('-');
			var aho = fechaArr[0];
			var mes = fechaArr[1];
			var dia = fechaArr[2];
			
			$("#CompanyJobProfileExpirationYear option[value='"+aho+"']").prop('selected', true);
			$("#CompanyJobProfileExpirationMonth option[value='"+mes+"']").prop('selected', true);
			$("#CompanyJobProfileExpirationDay option[value='"+dia+"']").prop('selected', true);
			
			var fechaArr = fechaCreacion.split('-');
			var aho = fechaArr[0];
			var mes = fechaArr[1];
			var dia = fechaArr[2];
			
			$("#CompanyJobProfileCreatedYear option[value='"+aho+"']").prop('selected', true);
			$("#CompanyJobProfileCreatedMonth option[value='"+mes+"']").prop('selected', true);
			$("#CompanyJobProfileCreatedDay option[value='"+dia+"']").prop('selected', true);
		
			document.getElementById('CompanyJobProfileId').value = idJobProfile;
			$('#myModalVigencia').modal('show');
		}
		
		function validateVigenciaForm(){
				
				var f = new Date();
				var fechaInicial = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
				
				var fechaFinal = document.getElementById('CompanyJobProfileExpirationDay').value	+ "/" +
										document.getElementById('CompanyJobProfileExpirationMonth').value	+ "/" +
										document.getElementById('CompanyJobProfileExpirationYear').value	;
				
				var fechaCreacion = document.getElementById('CompanyJobProfileCreatedYear').value	+ "-" +
										document.getElementById('CompanyJobProfileCreatedMonth').value	+ "-" +
										document.getElementById('CompanyJobProfileCreatedDay').value;
										
				selectedIndexDay = document.getElementById("CompanyJobProfileExpirationDay").selectedIndex;
				selectedIndexMonth = document.getElementById("CompanyJobProfileExpirationMonth").selectedIndex;
				selectedIndexYear = document.getElementById("CompanyJobProfileExpirationYear").selectedIndex;
				
				responseValidateDate = validarFecha(fechaFinal);
				fechaMaxima = fechaMax(fechaFinal,fechaCreacion);
				
				if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
					jAlert('Seleccione la fecha completa para la vigencia', 'Mensaje');
					document.getElementById('CompanyJobProfileExpirationYear').focus();
					return false;
				}else 
				 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
					jAlert('La fecha de vigencia no debe ser menor a la actual', 'Mensaje');
					document.getElementById('CompanyJobProfileExpirationYear').focus();
					return false;
				}else 
				if(responseValidateDate == false){
					jAlert('La fecha de vigencia es incorrecta', 'Mensaje');
					document.getElementById('CompanyJobProfileExpirationDay').focus();
					return false;
				}else
				if(fechaMaxima == false){
					<?php if(($this->Session->read('Auth.User.role')=='administrator') OR ($this->Session->read('Auth.User.role')=='subadministrator')): ?>
						jAlert('La fecha de vigencia es de máximo 1 mes respecto a la fecha actual', 'Mensaje');
					<?php else: ?>
						jAlert('La fecha de vigencia es de máximo 1 mes respecto a la fecha de creación de la oferta', 'Mensaje');
					<?php endif; ?>		
					document.getElementById('CompanyJobProfileExpirationDay').focus();
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
	</script>
	
	<div>
		
		<?php echo $this->Session->flash(); ?>
		
		<div class="col-md-12">
			<div class="col-md-4">
				<?php
				echo $this->Form->button('Palabras clave', array(
														'type' => 'button',
														'class' => 'btn btnBlue btn-default col-md-12',
														'onClick' => 'openCollapse(1);',
													)
										);
				?>
			</div>
			<div class="col-md-4">
				<?php
				echo $this->Form->button('Formación académica', array(
														'type' => 'button',
														'class' => 'btn btnBlue btn-default  col-md-12',
														'onClick' => 'openCollapse(2);',
													)
										);
				?>
			</div>
			<div class="col-md-4">
				<?php 
				echo $this->Form->create('Administrator', array(
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
										'action' => 'specificSearchOfferResults',
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
				echo $this->Form->button('Perfil de la oferta', array(
														'type' => 'button',
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
														'style'=> 'padding-right: 0px; padding-left: 0px;',
														'class' => 'btn btnBlue btn-default  col-md-12',
														'onClick' => 'openCollapse(4);',
													)
										);
				?>
			</div>
			
			<div class="col-md-4">
				<?php 
					echo $this->Form->create('Administrator', array(
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
											'action' => 'specificSearchOfferResults',
											
							));	
							
					echo $this->Form->input('busqueda_guardada', array(
																'type'=>'select',
																'label' => '',
																
																'onchange' => 'viewSearch()' ,
																'class' => 'form-horizontal', 
																'role' => 'form',
																'selected' => $this->Session->read('idBusquedaGuardada'),
																'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																'div' => array('class' => 'form-group'),
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
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
						<p style="margin-left: 80px;margin-top: -10px;"> (máx. 10)</p>
				</div>
			</div>
		</div>
		
			<?php 	echo $this->Form->create('Administrator', array(
									'class' => 'form-horizontal', 
									'role' => 'form',
									'id' => 'formSpecificSearchId',
									'inputDefaults' => array(
											'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
											'div' => array('class' => 'form-group'),
											'class' => 'form-control',
											'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
											'between' => ' <div class="col-md-6  col-md-offset-3">',
											'after' => '</div></div>',
											'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
									),
									'action' => 'specificSearchOfferResults',
			)); ?>	
			
			<div class="panel panel-default">
				<div id="collapse1" class="panel-collapse collapse">
					<div class="panel-body">
					<div class="col-md-12">
						<button type="button" class="btn btnBlue btn-default" onClick="closeCollapse(1);">
						  <i class="glyphicon glyphicon-remove-sign"></i>
						</button>
					</div>
						
						<div style="text-align: left;" class="col-md-offset-3">
							<p style="margin-left: 30px;"> Palabras clave</p>
						</div>
						<?php 	echo $this->Form->input('StudentSavedSearch.name', array(
										'label' => '',
										'type' => 'hidden',
						));	?>
						
						<?php 	echo $this->Form->input('CompanyJobProfile.job_name', array(
														'label' => '',
														'class' => 'form-control',
															'before' => '<div class="col-md-12 ">',
														'placeholder' => 'Palabras clave',
						));	?>
						<?php 	echo $this->Form->input('CompanyJobProfile.disability_type', array(
														'type'=>'hidden',
														'label' => '',
														'options' => $TiposDiscapacidad,'default'=>'0', 'empty' => 'Tipo de discapacidad'
						)); ?>
						<?php 	echo $this->Form->input('CompanyJobContractType.state', array(
														'type'=>'hidden',
														'label' => '',
														'placeholder' => 'Entidad federativa / Estado',
						));	?>
						<?php 	echo $this->Form->input('CompanyJobContractType.subdivision', array(
														'type'=>'hidden',
														'label' => '',
														'placeholder' => 'Delegación / Municipio',
						));	?>

						<div class="col-md-2 col-md-offset-5">
						<?php	
						echo $this->Form->button(
										'Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',
																	array( 
																	'type' => 'submit',
																	'class' => 'btn btnBlue btn-default  col-md-12',
																	'onClick' => 'submitSearch();',
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
					<button type="button" class="btn btnBlue btn-default" onClick="closeCollapse(2);">
					 <i class="glyphicon glyphicon-remove-sign"></i>
					</button>
					</div>
					
					<div style="text-align: left;" class="col-md-6 col-md-offset-3">
						<p style="margin-left: 30px;"> Formación académica</p>
					</div>
					<div id="original" class="clon">
						<?php 	echo $this->Form->input('CompanyCandidateProfileDynamicNivelAcademico.0.academic_level', array(
																		'before' => '<div class="col-md-12 ">',
																		'type'=>'select',
																		'class' => 'selectpicker show-tick form-control show-menu-arrow',
																		'label' => '',
																		'options' => $NivelesAcademicos,'default'=>'0', 'empty' => 'Nivel académico',
																		'onchange' => 'changeAcademicLevel(0);'
						)); ?>
						<div id="divCarrerasId0" >
						<?php 	echo $this->Form->input('CompanyJobRelatedCareerDynamicCarrera.0.career_id', array(
																		'before' => '<div class="col-md-12 ">',
																		'type'=>'select',
																		'class' => 'selectpicker show-tick form-control show-menu-arrow',
																		'data-live-search' => "true",
																		'label' => '',
																		'options' => $careers,'default'=>'0', 'empty' => 'Carrera'
						)); ?>
						</div>
						<div id="divAreasId0">
						<?php 	echo $this->Form->input('CompanyJobRelatedAreaDynamicArea.0.area_id', array(
																		'before' => '<div class="col-md-12 ">',
																		'type'=>'select',
																		'class' => 'selectpicker show-tick form-control show-menu-arrow',
																		'data-live-search' => "true",
																		'label' => '',
																		'options' => $AreasPosgrado,'default'=>'0', 'empty' => 'Área'
						)); ?>
						</div>
						<?php 	
							echo $this->Form->input('CompanyCandidateProfileDynamicSituacionAcademica.0.academic_situation', array(
																		'before' => '<div class="col-md-12 ">',
																		'type'=>'select',
																		'class' => 'selectpicker show-tick form-control show-menu-arrow',
																		'label' => '',
																		'options' => 'Situación académica'
						)); ?>
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
					<div class="contenedorClonesFormacionAcademica">
						<?php 
							$cont = 0;
							if(!empty($this->request->data['CompanyCandidateProfileDynamicNivelAcademico'])):
							foreach($this->request->data['CompanyCandidateProfileDynamicNivelAcademico'] as $k => $formacionAcademica): 
							if($cont > 0):
						?>
							<div id="IdClonFormcionAcademica<?php echo $cont ?>" class="clonFormcionAcademica<?php echo $cont ?> clonFormcionAcademicaIndependiente">
							<?php echo $this->Form->input('CompanyCandidateProfileDynamicNivelAcademico.'.$cont.'.academic_level', array(
																			'before' => '<div class="col-md-12"><button id="IdClonFormacionAcademica'.$cont.'" class="btn btn-danger maxFormaciones" onclick="eliminarClonFormacionAcademica('.$cont.'); " style="margin-left: 5px; padding-left: 5px; padding-right: 5px; border-right-width: 0px; border-left-width: 0px;" type="button"><i class="glyphicon glyphicon-trash"></i>&nbsp;</button>',
																			'type'=>'select',
																			'class'=>'selectpicker show-tick form-control show-menu-arrow clonNivelAcademico'.$cont.' clonNivelAcademicoReindexa',
																			'label' => '',
																			'options' => $NivelesAcademicos,'default'=>'0', 'empty' => 'Nivel académico',
																			'onchange' => 'changeAcademicLevel('.$cont.');'
							)); ?>
							<div id="divCarrerasId<?php echo $cont; ?>" class="divCarreras" >
							<?php 	echo $this->Form->input('CompanyJobRelatedCareerDynamicCarrera.'.$cont.'.career_id', array(
																			'before' => '<div class="col-md-12 ">',
																			'type'=>'select',
																			'class'=>'selectpicker show-tick form-control show-menu-arrow clonCarrera'.$cont.' clonCarreraReindexa',
																			'data-live-search' => "true",
																			'label' => '',
																			'options' => $careers,'default'=>'0', 'empty' => 'Carrera'
							)); ?>
							</div>
							<div id="divAreasId<?php echo $cont; ?>" class="divAreas">
							<?php 	echo $this->Form->input('CompanyJobRelatedAreaDynamicArea.'.$cont.'.area_id', array(
																			'before' => '<div class="col-md-12 ">',
																			'type'=>'select',
																			'class'=>'selectpicker show-tick form-control show-menu-arrow clonArea'.$cont.' clonAreaReindexa',
																			'data-live-search' => "true",
																			'label' => '',
																			'options' => $AreasPosgrado,'default'=>'0', 'empty' => 'Área'
							)); ?>
							</div>
							<?php 	echo $this->Form->input('CompanyCandidateProfileDynamicSituacionAcademica.'.$cont.'.academic_situation', array(
																		'type'=>'select',
																		'class'=>'selectpicker show-tick form-control show-menu-arrow clonSituacionAcademica'.$cont.' clonSituacionAcademicaReindexa',
																		'label' => '',
																		'before' => '<div class="col-md-12 ">',
							)); ?>
								
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
					</div>
					
					<div style="margin-left: 55%;">
						<p>Agregar otra(máx. 3)</p>
					</div>

					<div>
						 <img src="<?php echo $this->webroot; ?>/img/add.png" id="agregarFormacionAcademica" onclick="clonarFormacionAcademica();" style="background-color: transparent;width: 25px;margin-left: 71%;margin-top: -70px;cursor:pointer"> 
					</div>
					
					<div class="col-md-2 col-md-offset-5">
						<?php echo $this->Form->button(
										'Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',
																	array( 
																	'type' => 'submit',
																	'class' => 'btn btnBlue btn-default  col-md-12',
																	'onClick' => 'submitSearch();',
																)
													);
						?>
					</div>

					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div id="collapse3" class="panel-collapse collapse">
					<div class="panel-body">
					<div class="col-md-12">
						<button type="button" class="btn btnBlue btn-default" onClick="closeCollapse(3);">
						   <i class="glyphicon glyphicon-remove-sign"></i>
						</button>
					</div>
						<div style="text-align: left;" class="col-md-offset-3">
						<p style="margin-left: 30px;"> Perfil de la oferta</p>
					</div>
					<?php 	echo $this->Form->input('CompanyJobContractType.contract_type', array(
									'type'=>'select',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'before' => '<div class="col-md-12 ">',
									'label' => '',
									'options' => $TiposContratos,'default'=>'0', 'empty' => 'Tipo de contrato'
					));	?>
					<?php 	echo $this->Form->input('CompanyJobContractType.workday', array(
									'type'=>'select',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'label' => '',
									'before' => '<div class="col-md-12 ">',
									'options' => $JornadasLaborales,'default'=>'0', 'empty' => 'Jornada laboral'
					));	?>
					<?php 	echo $this->Form->input('CompanyJobContractType.salary', array(
									'type'=>'select',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="Remuneración monetaria que recibe periódicamente 
un empleado por parte de la empresa o institución 
a cambio de sus servicios profesionales." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
									'label' => '',
									'options' => $Salarios,'default'=>'0', 'empty' => 'Sueldo'
					));	?>
					<div id="original" class="clonGiro">
					<?php 	echo $this->Form->input('CompanyJobProfileDynamicGiro.0.giro', array(
									'type'=>'select',
									'class' => 'selectpicker show-tick form-control show-menu-arrow clonGiroReindexa',
									'data-live-search' => "true",
									'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="Actividad principal que realiza la empresa o institución.
Ejemplos:
Automotriz 
Farmacéutica" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
									'label' => '',
									'placeholder' => 'Giro de interés',
									'options' => $Giros,'default'=>'0', 'empty' => 'Giro de interés',
									'onchange' => 'cargaAreas(0)',
					));	?>
					<?php 	echo $this->Form->input('CompanyJobProfileDynamicArea.0.area_interes', array(
									'type'=>'select',
									'class' => 'selectpicker show-tick form-control show-menu-arrow clonAreaReindexa',
									'data-live-search' => "true",
									'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="Área en la que desea enfocar su desarrollo 
profesional o ha desarrollado experiencia laboral." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
									'label' => '',
									'placeholder' => 'Áreas de interés',
									'options' => $AreasExperiencia,'default'=>'0', 'empty' => 'Áreas de interés'
					));	?>
					</div>
					
					<div class="contenedorClonesGiros">
						<?php 
							$cont = 0;
							if(!empty($this->request->data['CompanyJobProfileDynamicGiro'])):
							foreach($this->request->data['CompanyJobProfileDynamicGiro'] as $k => $giros): 
								if($cont > 0):
						?>
								<div id="IdClonGiro<?php echo $cont ?>" class="clonGiro<?php echo $cont ?> clonGiroIndependiente">
									<?php 	echo $this->Form->input('CompanyJobProfileDynamicGiro.'.$cont.'.giro', array(
													'type'=>'select',
													'class' => 'selectpicker show-tick form-control show-menu-arrow clonGiroReindexa',
													'data-live-search' => "true",
													'label' => '',
													'before' => '<div class="col-md-12"><button id="eliminarGiro" class="btn btn-danger maxGiros" onclick="eliminarClonGiro('.$cont.'); " type="button" style="margin-left: 5px; padding-left: 5px; padding-right: 5px; border-right-width: 0px; border-left-width: 0px;"><i class="glyphicon glyphicon-trash"></i>&nbsp;</button>',
													'placeholder' => 'Giro de interés',
													'onchange' => 'cargaAreas('.$cont.')',
													'options' => $Giros,'default'=>'0', 'empty' => 'Giro de interés',
									));	?>
									<?php 	echo $this->Form->input('CompanyJobProfileDynamicArea.'.$cont.'.area_interes', array(
													'type'=>'select',
													'label' => '',
													'class' => 'selectpicker show-tick form-control show-menu-arrow clonAreaReindexa',
													'data-live-search' => "true",
													'before' => '<div class="col-md-12 ">',
													'placeholder' => 'Áreas de interés',
													'default'=>'0', 'empty' => 'Área de interés',
									));	?>
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
					</div>
					
					<div class="col-md-offset-6">
						<p>Agregar otro giro y área(máx. 2)</p>
					</div>

					<div>
						 <img src="<?php echo $this->webroot; ?>/img/add.png" id="agregarGiro" onclick="clonarGiro();" style="background-color: transparent;width: 25px;margin-left: 10px;cursor:pointer"> 
					</div>
					
						<div class="col-md-2 col-md-offset-5">
							<?php
							echo $this->Form->button(
										'Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',
																	array( 
																	'type' => 'submit',
																	'class' => 'btn btnBlue btn-default  col-md-12',
																	'onClick' => 'submitSearch();',
																)
													);
							?>
						</div>
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div id="collapse4" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="col-md-12">
						<button type="button" class="btn btnBlue btn-default" onClick="closeCollapse(4);">
						   <i class="glyphicon glyphicon-remove-sign"></i>
						</button>
						</div>
						<div style="text-align: left;" class="col-md-9 col-md-offset-3">
							<p style="margin-left: 30px;"> Conocimientos y habilidades profesionales</p>
						</div>
					
					
						<div id="original" class="clon">
						<div style="text-align: left;" class="col-md-9 col-md-offset-3">
							<p style="margin-left: 30px;"> Idioma</p>
						</div>
							<div class="col-md-6 col-md-offset-3">
								<div class="col-md-6">
									<?php 	echo $this->Form->input('CompanyJobLanguage.0.language_id', array(
																			'before' => '<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;">',
																			'between' => ' <div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">',
																			'type'=>'select',
																			'class' => 'selectpicker show-tick form-control show-menu-arrow',
																			'data-live-search' => "true",
																			'label' => '',
																			'options' => $Lenguages,'default'=>'0', 'empty' => 'Idioma'
									));?>
								</div>
								<div class="col-md-6">
									<?php 	echo $this->Form->input('CompanyJobLanguage.0.level', array(
																			'before' => '<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;"><img data-toggle="tooltip" id="" data-placement="top" title="Grado de dominio sobre diversas habilidades lingüísticas." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 12px;">',
																			'between' => ' <div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">',
																			'type'=>'select',
																			'class' => 'selectpicker show-tick form-control show-menu-arrow',
																			'label' => '',
																			'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel'
									));?>
								</div>
							</div>
						</div>
						
						<div class="contenedorClonesLanguages">
							<?php 
								$cont = 0;
								if(!empty($this->request->data['CompanyJobLanguage'])):
								foreach($this->request->data['CompanyJobLanguage'] as $k => $idiomas): 
								if($cont > 0):
							?>
								<div id="IdClonLanguage<?php echo $cont ?>" class="clonLanguage<?php echo $cont ?> clonLanguageIndependiente">
									<div class="col-md-6 col-md-offset-3">
										<div class="col-md-6">
											<?php 	echo $this->Form->input('CompanyJobLanguage.'.$cont.'.language_id', array(
																					'before' => '<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;">',
																					'between' => ' <div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">',
																					'type'=>'select',
																					'data-live-search' => "true",
																					'class'=>'selectpicker show-tick form-control show-menu-arrow selectClonLanguage'.$cont.' clonLanguageReindexa',
																					'label' => '',
																					'options' => $Lenguages,'default'=>'0', 'empty' => 'Idioma'
											));?>
										</div>
										<div class="col-md-6">
											<?php 	echo $this->Form->input('CompanyJobLanguage.'.$cont.'.level', array(
																					'before' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;"><button id="eliminarComputo" class="btn btn-danger maxIdiomas" onclick="eliminarClonLanguage('.$cont.'); " type="button" style="margin-left: 5px; padding-left: 5px; padding-right: 5px; border-right-width: 0px; border-left-width: 0px;"><i class="glyphicon glyphicon-trash"></i>&nbsp;</button>',
																					'between' => ' <div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">',
																					'type'=>'select',
																					'class'=>'selectpicker show-tick form-control show-menu-arrow selectClonLevelLanguage'.$cont.' clonLevelLanguageReindexa',
																					'label' => '',
																					'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel'
											));?>
										</div>
									</div>
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
							</div>
						
						<div class="col-md-6 col-md-offset-6">
							<p>Agregar otro (máx. 3) <img src="<?php echo $this->webroot; ?>/img/add.png" id="agregarIdioma" onclick="clonarLenguaje();" style="background-color: transparent;width: 25px;margin-left: 10px;cursor:pointer"> </p> 
						</div>

						
						<div style="text-align: left;" class="col-md-offset-3">
							<p style="margin-left: 30px;"> Cómputo</p>
						</div>
					
						<div id="originalComputo" class="clonComputo">
							<div class="col-md-6 col-md-offset-3">
								<div class="col-md-6">
									<?php 	echo $this->Form->input('CompanyJobComputingSkill.0.name', array(
																			'label' => '',
																			'placeholder' => 'Cómputo',
																			'before' => '<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;">',
																			'between' => ' <div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">',
									));?>
								</div>
								<div class="col-md-6">
									<?php 	echo $this->Form->input('CompanyJobComputingSkill.0.level', array(
																			'before' => '<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;"><img data-toggle="tooltip" id="" data-placement="top" title="Grado de dominio sobre diversas habilidades de computo." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 12px;">',
																			'between' => ' <div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">',
																			'type'=>'select',
																			'class' => 'selectpicker show-tick form-control show-menu-arrow',
																			'label' => '',
																			'options' => $NivelesSoftware,'default'=>'0', 'empty' => 'Nivel'
									));?>
								</div>
							</div>
						</div>
						
					<div class="contenedorClonesComputo">
					
						<?php 
							$cont = 0;
							if(!empty($this->request->data['CompanyJobComputingSkill'])):
							foreach($this->request->data['CompanyJobComputingSkill'] as $k => $computos): 
							if($cont > 0):
						?>
							<div id="IdClonComputo<?php echo $cont; ?>" class="clonComputo<?php echo $cont; ?> clonComputoIndependiente">
								<div class="col-md-6 col-md-offset-3">
									<div class="col-md-6">
										<?php 	echo $this->Form->input('CompanyJobComputingSkill.'.$cont.'.name', array(
																				'label' => '',
																				'placeholder' => 'Cómputo',
																				'class'=>'form-control clonComputoNameReindexa',
																				'before' => '<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;">',
																				'between' => ' <div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">',
										));?>
									</div>
									<div class="col-md-6">
										<?php 	echo $this->Form->input('CompanyJobComputingSkill.'.$cont.'.level', array(
																				'before' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;"><button id="eliminarComputo" class="btn btn-danger maxComputos" onclick="eliminarClonComputo('.$cont.'); " type="button" style="margin-left: 5px; padding-left: 5px; padding-right: 5px; border-right-width: 0px; border-left-width: 0px;"><i class="glyphicon glyphicon-trash"></i>&nbsp;</button>',
																				'between' => ' <div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">',
																				'type'=>'select',
																				'class'=>'selectpicker show-tick form-control show-menu-arrow selectClonComputoLevel'.$cont.' clonComputoLevelReindexa',
																				'label' => '',
																				'options' => $NivelesSoftware,'default'=>'0', 'empty' => 'Nivel'
										));?>
									</div>
								</div>
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
					
					</div>
					
					<div class="col-md-6 col-md-offset-6">
						<p>Agregar otro (máx. 3) <img src="<?php echo $this->webroot; ?>/img/add.png" id="agregarComputo" onclick="clonarComputo();" style="background-color: transparent;width: 25px;margin-left: 10px;cursor:pointer">  </p>
					</div>

						<div class="col-md-2 col-md-offset-5">
							<?php
							echo $this->Form->button(
										'Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',
																	array( 
																	'type' => 'submit',
																	'class' => 'btn btnBlue btn-default  col-md-12',
																	'onClick' => 'submitSearch();',
																)
													);
							echo $this->Form->end(); 
							?>
							
						</div>
					
					</div>
				</div>
			</div>
		 
		<div class="col-md-12">
			<?php 
				if(isset($ofertas)):
					if(empty($ofertas)):
						echo '<p style="font-size: 22px; text-align: left ">Sin resultados</p>';
					else:
			?>
					<p style="margin-left: 15px;">Resultados de Búsqueda</p>
			
					<div class="col-md-9">
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
								
						<div class="btn-group">
							<button type="button" class="btn btnRed btn-default dropdown-toggle" data-toggle="dropdown">Ordenar por fecha de publicación  &nbsp;<i class="glyphicon glyphicon-chevron-down"></i><span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu">
								<li>
								<?php 
									echo $this->Html->link(
															' Más antiguas a más recientes', 
																array(
																	'controller'=>'Administrators',
																	'action'=>'specificSearchOfferResults',
																	'?' => array(
																			  'orden' => 'CompanyJobprofile.created DESC',
																	),
																),
																array(
																	'class' => 'btn btn-default '.$addClassASC,
																	'style' => 'margin-top: 5px;',
																	'escape' => false)	
								); 	?>
							</li>
								<li>
								<?php echo $this->Html->link(
															' Más recintes a más antiguas', 
																array(
																	'controller'=>'Administrators',
																	'action'=>'specificSearchOfferResults',
																	'?' => array(
																			  'orden' => 'CompanyJobprofile.created ASC',
																	),
																),
																array(
																	'class' => 'btn btn-default ' . $addClassDESC,
																	'style' => 'margin-top: 5px;',
																	'escape' => false)	
								); 	?>
							</li>
							</ul>
						  
						</div>
											
						<div class="btn-group">
						  <button type="button" class="btn btnRed btn-default dropdown-toggle" data-toggle="dropdown">Ordenar por sueldo &nbsp;<i class="glyphicon glyphicon-chevron-down"></i><span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu">
								<li>
									<?php 
										echo $this->Html->link(
																' Más bajo al más alto', 
																	array(
																		'controller'=>'Administrators',
																		'action'=>'specificSearchOfferResults',
																		'?' => array(
																				  'orden' => 'CompanyJobContractType.salary ASC',
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
																' Más alto al más bajo ', 
																	array(
																		'controller'=>'Administrators',
																		'action'=>'specificSearchOfferResults',
																		'?' => array(
																				  'orden' => 'CompanyJobContractType.salary DESC',
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
						
						<div class="btn-group">
							<?php 	$options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200);
									echo $this->Form->input('limit', array(
																			'type'=>'select',
																			'selected' => $this->Session->read('limit'),
																			'class' => 'selectpicker show-tick form-control show-menu-arrow',
																			'data-width'=> '200px',
																			'onchange' => 'submitSearch()' ,
																			'label' =>'',
																			'style' => 'margin-bottom: -30px;',
																			'before' => '<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px; left: -10px;">',
																			'between' => ' <div class="col-md-12">',
																			'options' => $options,'default'=>'0', 'empty' => 'Resultados por hoja'
											)); ?>
						</div>	
						
						<?php echo $this->Form->end(); ?>
					</div>
					
					<div class="col-md-10" style="max-height: 680px; witdh:720px; overflow-y: auto; padding-left: 0px; padding-right: 0px; margin-top: 30px;">
						
						<?php 
							foreach($ofertas as $k => $oferta):
						?>
							<div class="col-md-11" style="background: #fff none repeat scroll 0 0; min-height: 180px; margin-top: 15px; padding-left: 0px; padding-right: 0px;  right: -25px;">    
							
								<div class="col-md-2" style="text-align: center; margin-top: 25px; padding-left: 0px; padding-right: 0px;">
									<?php
											if($oferta['CompanyJobOffer']['confidential_job_offer'] == 's'):
												echo $this->Html->image('company/imagenNoDisponible.png',
																		array(
																			'alt' => 'Profile Photo',
																			'width' => '95px',
																			'height' => '80px',
																		));
											else:
												if (isset($oferta)):
													if(isset($oferta['Company']['filename'])):
													$url = WWW_ROOT.'img/uploads/company/filename/'.$oferta['Company']['filename'];
														if(!file_exists( $url )):
															echo $this->Html->image('company/imagenNoEncontrada.png',
																		array(
																			'alt' => 'Profile Photo',
																			'width' => '95px',
																			'height' => '80px',
																		));
														else:
															if($oferta['Company']['filename'] <> ''):
																echo $this->Html->image('uploads/company/filename/'.$oferta['Company']['filename'],
																			array(
																				'alt' => 'Profile Photo',
																				'width' => '95px',
																				'height' => '80px',
																			));
															else:
																echo $this->Html->image('company/imagenNoDisponible.png',
																			array(
																				'alt' => 'Profile Photo',
																				'width' => '95px',
																				'height' => '80px',
																			));
															endif;
														endif;
													else:
														echo $this->Html->image('company/imagenNoDisponible.png',
																		array(
																			'alt' => 'Profile Photo',
																			'width' => '95px',
																			'height' => '80px',	
																		));
													endif;
												else:
													echo $this->Html->image('company/imagenNoDisponible.png',
																		array(
																			'alt' => 'Profile Photo',
																			'width' => '95px',
																			'height' => '80px',
																		));
												endif;
											endif;
									?>
										
									<p class="blackText" style="margin-top: 10px; font-size: 12px; color: #000">
										<?php 
											echo '<span>';
											if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 's') AND ($oferta['CompanyJobOffer']['company_name']<>'')):
												echo $oferta['CompanyJobOffer']['company_name']; 
											else:
												if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 's') AND ($oferta['CompanyJobOffer']['company_name']=='')):
													echo 'Confidencial';
												else:
													if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 'n') AND ($oferta['CompanyJobOffer']['company_name']<>'')):
														echo $oferta['CompanyJobOffer']['company_name']; 
													else:
														if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 'n') AND ($oferta['CompanyJobOffer']['company_name']=='')):
															echo $oferta['Company']['CompanyProfile']['company_name'];
														else:
															echo 'Sin especificar';
														endif;
													endif;
												endif;
											endif;
											echo '</span><br>';
										?>
									</p>
									
									<p class="blackText" style="font-size: 12px; color: #000">
										<?php echo '<span>'.$oferta['Company']['CompanyProfile']['rfc'].'</span>'; ?>
									</p>
									
								</div>
							
								<div class="col-xs-6" style="margin-top: 10px; text-align: left;">
									<?php
										$caracteres = strlen($oferta['CompanyJobProfile']['id']);
										$faltantes = 5 - $caracteres;	
										if($faltantes > 0):
											$ceros = '';
											for($cont=0; $cont<=$faltantes;$cont++):
												$ceros .= '0';
											endfor;
											$folio = $ceros.$oferta['CompanyJobProfile']['id'];
										else:
											$folio = strlen($oferta['CompanyJobProfile']['id']);
										endif;
									?>
									<p class="blackText">folio:<?php echo $folio; ?></p>
									<p class="blackText">Puesto: 
										<span style="font-weight: normal;">
											<?php  
												$texto = str_ireplace ( $this->Session->read('palabraBuscada'), '<strong style="font-size: 14px;">'.$this->Session->read('palabraBuscada').'</strong>', $oferta['CompanyJobProfile']['job_name']); 
												echo $texto;
											?> 
										</span>
									</p>
									<p class="blackText">Número de vacantes: <span style="font-weight: normal;"><?php echo $oferta['CompanyJobProfile']['vacancy_number']; ?></span></p>
									<?php
										if(!empty($oferta['CompanyLastUpdate']['Administrator'])):
											$administrador = ' / '.$oferta['CompanyLastUpdate']['Administrator']['AdministratorProfile']['contact_name'].' '.$oferta['CompanyLastUpdate']['Administrator']['AdministratorProfile']['contact_last_name'];
										else:
											$administrador = '';
										endif;
									?>
									<p class="blackText">Fecha publicación: <span style="font-weight: normal;"><?php  echo ' ' . date("d/m/Y",strtotime($oferta['CompanyJobProfile']['created']));   ?> </span></p>
									<p class="blackText">Fecha de actualización: <span style="font-weight: normal;"><?php  echo ' ' . date("d/m/Y",strtotime($oferta['CompanyLastUpdate']['modified']));  echo $administrador; ?> </span></p>
									<p class="blackText">Vigencia: <span style="font-weight: normal;"><?php  echo ' ' . date("d/m/Y",strtotime($oferta['CompanyJobProfile']['expiration'])); ?> </span></p>
									<p class="blackText">Responsable de la oferta:</p>
									
									 <?php 
										if($oferta['CompanyJobOffer']['same_contact']=='n'):
											echo '<p class="blackText"> -Nombre:<span style="font-weight: normal;">' . $oferta['CompanyJobOffer']['responsible_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_last_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_second_last_name'].'</span></p>';
											
											echo '<p class="blackText"> -Tel.:<span style="font-weight: normal;"> (' . $oferta['CompanyJobOffer']['responsible_long_distance_cod'] .') '. $oferta['CompanyJobOffer']['responsible_telephone'] . ' ';
											if($oferta['CompanyJobOffer']['responsible_phone_extension']<>''):
												echo ' - ext. '.$oferta['CompanyJobOffer']['responsible_phone_extension'];
											endif;
											echo '</span></p>';
											if($oferta['CompanyJobOffer']['responsible_long_distance_cod_cell_phone']<>''):
												echo '<p class="blackText"> -Cel.: <span style="font-weight: normal;">('.$oferta['CompanyJobOffer']['responsible_long_distance_cod_cell_phone']. ') ' .$oferta['CompanyJobOffer']['responsible_cell_phone'].'</span></p>';
											endif;	
										else:
											echo '<p class="blackText"> -Nombre:<span style="font-weight: normal;">' . $oferta['Company']['CompanyContact']['name']. ' ' .  $oferta['Company']['CompanyContact']['last_name']. ' ' .  $oferta['Company']['CompanyContact']['second_last_name'].'</span></p>';
											
											echo '<p class="blackText"> -Tel.:<span style="font-weight: normal;"> (' . $oferta['Company']['CompanyContact']['long_distance_cod'] .') '. $oferta['Company']['CompanyContact']['telephone_number'];
											if($oferta['Company']['CompanyContact']['phone_extension']<>''):
												echo '- ext. </span> '.$oferta['Company']['CompanyContact']['phone_extension'];
											endif;
											echo '</span></p>';
											if(($oferta['Company']['CompanyContact']['long_distance_cod_cell_phone']<>'') and ($oferta['Company']['CompanyContact']['cell_phone']<>'')):
												echo '<p class="blackText"> -Cel.: ('.$oferta['Company']['CompanyContact']['long_distance_cod_cell_phone']. ') ' .$oferta['Company']['CompanyContact']['cell_phone'].'</span></p>';
											endif;
										endif;
										?>		
								</div>
							
								<div class="col-xs-4" style="background: #58595B; float: right; height: 30px; padding-left: 5px;  padding-right: 0px;">

									<div style="margin-top: 3px" class="grises2">
										<?php 
											$var = 0;
											$vista = 0;
											foreach($oferta['Company']['CompanyViewedOffer'] as $k => $viewed):
												if($viewed['company_job_profile_id'] == $oferta['CompanyJobProfile']['id']):
													$vista = 1;
													 break;
												endif;
											endforeach;
							
											if($vista == 0):
												echo $this->Html->image('student/visto.png',
													array(
														'title' => 'Oferta no vista',
														'class' => 'class="img-responsive center-block"',
														'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:default;'
												)); 
												
											else:
											
												echo $this->Html->image('student/noVisto.png',
													array(
														'title' => 'Oferta vista',
														'class' => 'class="img-responsive center-block"',
														'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:default;'
												)); 
											endif;
										
										?>
									
										<?php 
										 // Ver perfiles dentro de la oferta
											echo $this->Html->image('student/lista.png',
													array(
														'title' => 'Ver candidatos dentro de oferta',
														'class' => 'class="img-responsive center-block"',
														'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
														'url' => array(
																		'controller'=>'Companies',
																		'action'=>'viewCandidateOffer',
																		'?'=> array(
																					'company_id' => $oferta['Company']['id'],
																					'editingAdmin' => 'yes',
																					'id' => $oferta['CompanyJobProfile']['id'],
																					'editar' => 1,
																					'nuevaBusqueda' => 'nuevaBusqueda',
																					)
																		),
													));
										?>

										<?php 
										 // Editar oferta
											echo $this->Html->image('student/lapiz.png',
													array(
														'title' => 'Editar oferta',
														'class' => 'class="img-responsive center-block"',
														'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
														'url' => array(
																		'controller'=>'Companies',
																		'action'=>'companyJobOffer',
																		'?'=> array(
																					'company_id' => $oferta['Company']['id'],
																					'editingAdmin' => 'yes',
																					'id' => $oferta['CompanyJobProfile']['id'],
																					'editar' => 1,
																					)
																		),
														));
										?>
									
										<?php 
											// Cambiar vigencia de la oferta
											echo $this->Html->image('student/visible.png',
													array(
														'title' => 'Cambiar vigencia de oferta',
														'class' => 'class="img-responsive center-block"',
														'onclick' => 'saveVigencia('.$oferta['CompanyJobProfile']['id'].',"'.$oferta['CompanyJobProfile']['expiration'].'","'.$oferta['CompanyJobProfile']['created'].'");',
														'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
														)
													);
										?>
									
										<?php 
											 // Reportar contratación
											echo $this->Html->image('student/contratado.png',
													array(
														'title' => 'Reportar contratación ',
														'class' => 'class="img-responsive center-block"',
														'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
														'url' => array(
																		'controller'=>'Companies',
																		'action'=>'studentReport', 
																		'?' => array(
																					'company_id' => $oferta['Company']['id'],
																					'id' => $oferta['CompanyJobProfile']['id'],
																					'editingAdmin' => 'yes',
																					// 'nuevaBusqueda' => 'nuevaBusqueda',
																					)
																		),
														)
												);
										?>
									
										<?php 
											echo $this->Html->link(
																$this->Html->image('student/descargado.png', array('escape' => false,'style' => 'width: 17px; height: 20px; margin-right: 6px; cursor: pointer; ')),
																array(
																	'controller' => 'Companies', 
																	'action' => 'viewOnlyOfferPdf',
																	'?' => array(
																					'editingAdmin' => 'yes',
																					'id' => $oferta['CompanyJobProfile']['id'],
																				)
																	), 
																array('target' => '_blank','escape' => false,'title' => 'Descargar oferta en PDF',)
													);
										?>
									
										<?php 
										 // Descativar oferta
											if($oferta['CompanyJobContractType']['status'] == null):
												echo $this->Html->image('student/noActiva.png',
														array(
															'title' => 'Oferta incompleta',
															'class' => 'class="img-responsive center-block"',
															'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: help;',
															'onclick' => 'ofertaIncompleta();',
															)
														);	
											else:	
												if(strtotime($oferta['CompanyJobProfile']['expiration']) < strtotime(date('Y-m-d'))):
													echo $this->Html->image('student/noActiva.png',
															array(
																'title' => 'Oferta expirada',
																'class' => 'class="img-responsive center-block"',
																'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: help;',
																'onclick' => 'ofertaExpirada();',
																)
															);	
												else:		
													if($oferta['CompanyJobContractType']['status'] == 0):
														echo $this->Html->image('student/noActiva.png',
															array(
																'title' => 'Oferta inactiva',
																'class' => 'class="img-responsive center-block"',
																'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
																'url' => array(
																				'controller'=>'Administrators',
																				'action'=>'enableDisableOffer',
																				'?' => array(
																							'id' => $oferta['CompanyJobContractType']['id'],
																							'estatus' => $oferta['CompanyJobContractType']['status'],
																						)
																				),
																)
														);
													else:
														echo $this->Html->image('student/activa.png',
															array(
																'title' => 'Oferta activa',
																'class' => 'class="img-responsive center-block"',
																'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
																'url' => array(
																				'controller'=>'Administrators',
																				'action'=>'enableDisableOffer',
																				'?' => array(
																							'id' => $oferta['CompanyJobContractType']['id'],
																							'estatus' => $oferta['CompanyJobContractType']['status'],
																						)
																				),
															));
													endif;
												endif;
											endif;
										?>
									
										<?php 
										 // Eliminar oferta
										 echo $this->Html->image('student/eliminar.png',
													array(
														'title' => 'Eliminar oferta',
														'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
														'class' => 'class="img-responsive center-block"',
														'id' => 'focusOfferId'.$oferta['CompanyJobProfile']['id'],
														'onclick' => 'deleteOffer('.$oferta['CompanyJobProfile']['id'].');'
														)
												);
												
										 echo $this->Form->postLink(
																$this->Html->image('student/eliminar.png',
																array('alt' => 'Delete', 'title' =>'Eliminar oferta', 'style' => 'width: 20px; height: 20px; display: none','id'=>'deleteOfferId'.$oferta['CompanyJobProfile']['id'] )), 
																array('action' => 'deleteOffer',$oferta['CompanyJobProfile']['id']), 
																array('escape' => false) 
																);
										?>
									</div>
								</div>
						
								<div class="col-md-4" style="margin-top: 10px; text-align: left; padding-right: 35px;" >
									<?php 
										$totalTelefonicasOferta = 0;
										foreach($oferta['StudentNotification'] as $k => $telefonicasOferta):
											if($telefonicasOferta['interview_type'] == 1):
												$totalTelefonicasOferta++;
											endif;
										endforeach;
									?>
									
									<?php 
										if($totalTelefonicasOferta >0):
											echo $this->Html->link(
																	'Entrevistas telefónicas: '.$totalTelefonicasOferta, 
																	array(
																		'controller'=>'Administrators',
																		'action'=>'searchStudentOffer',
																								'?' => array(
																										'companyJobProfileId' => $oferta['CompanyJobProfile']['id'],
																										'option' => 1,
																										'totalStudents' => $totalTelefonicasOferta,
																										'newSearch' => 'nuevaBusqueda',
																										'historyCompanyId' => $oferta['Company']['id'],
																										'volver' => 'specificSearchOfferResults',
																										
																								)
																		),
																	array(
																		'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
																		'escape' => false)	
											); 	
										else: 
											echo $this->Html->link('Entrevistas telefónicas: '.$totalTelefonicasOferta, 
																					'',
																					array(
																						'onclick' => 'return SinCandidatos();',
																						'id' => 'filtroBotonId1',
																						'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
																						)	
											); 	
										endif;
									?> 
																	
									<?php 
										$totalPresencialesOferta = 0;
										foreach($oferta['StudentNotification'] as $k => $presencialesOferta):
											if($presencialesOferta['interview_type'] == 2):
												$totalPresencialesOferta++;
											endif;
										endforeach;
									?>
									
									<?php
										if($totalPresencialesOferta > 0):
											echo $this->Html->link(
																	'Entrevistas presenciales: '.$totalPresencialesOferta, 
																	array(
																		'controller'=>'Administrators',
																		'action'=>'searchStudentOffer',
																								'?' => array(
																										'companyJobProfileId' => $oferta['CompanyJobProfile']['id'],
																										'option' => 2,
																										'totalStudents' => $totalPresencialesOferta,
																										'newSearch' => 'nuevaBusqueda',
																										'historyCompanyId' => $oferta['Company']['id'],
																										'volver' => 'specificSearchOfferResults',
																								)
																		),
																	array(
																		'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
																		'escape' => false)	
											); 	
										else: 
											echo $this->Html->link('Entrevistas presenciales: '.$totalPresencialesOferta, 
																					'',
																					array(
																						'onclick' => 'return SinCandidatos();',
																						'id' => 'filtroBotonId1',
																						'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
																						)	
											); 	
										endif;
									?> 
									
									<?php
										$totalContratados = 0;
										foreach($oferta['Report'] as $k => $contratadosOferta):
											if($contratadosOferta['registered_by']=='company'):
												$totalContratados++;
											endif;
										endforeach;
									?>
					
									<?php 
										if($totalContratados > 0):
											echo $this->Html->link(
																	'Contrataciones: '.$totalContratados, 
																	array(
																		'controller'=>'Administrators',
																		'action'=>'searchStudentOffer',
																								'?' => array(
																										'companyJobProfileId' => $oferta['CompanyJobProfile']['id'],
																										'option' => 3,
																										'totalStudents' => $totalContratados,
																										'newSearch' => 'nuevaBusqueda',
																										'historyCompanyId' => $oferta['Company']['id'],
																										'volver' => 'specificSearchOfferResults',
																								)),
																	array(
																		'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
																		'escape' => false)	
											); 	
										else: 
											echo $this->Html->link('Contrataciones: '.$totalContratados, 
																					'',
																					array(
																						'onclick' => 'return SinCandidatos();',
																						'id' => 'filtroBotonId1',
																						'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
																						)	
											); 	
										endif;
									?> 
									
									<?php 
										if(count($oferta['Application']) > 0):
											echo $this->Html->link(
																	'Postulaciones: '.count($oferta['Application']), 
																	array(
																		'controller'=>'Administrators',
																		'action'=>'searchStudentOffer',
																								'?' => array(
																										'companyJobProfileId' => $oferta['CompanyJobProfile']['id'],
																										'option' => 4,
																										'totalStudents' => count($oferta['Application']),
																										'newSearch' => 'nuevaBusqueda',
																										'volver' => 'specificSearchOfferResults',
																								)),
																	array(
																		'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
																		'escape' => false)	
																); 	
										else: 
											echo $this->Html->link('Postulaciones: '.count($oferta['Application']), 
																					'',
																					array(
																						'onclick' => 'return SinCandidatos();',
																						'id' => 'filtroBotonId1',
																						'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
																						)	
											); 	
										endif;
									?> 
									
									<?php 
										echo $this->Html->link(
															' Ver oferta completa ', 
															array(
																'controller'=>'Companies',
																'action'=>'viewOfferOnline', 
																	'?'=> array(
																				'company_id' => $oferta['Company']['id'],
																				'editingAdmin' => 'yes',
																				'id' => $oferta['CompanyJobProfile']['id']
																				)
																),
															array(
																'class' => 'btn btnRed col-md-10',
																'style' => 'margin-top: 10px;',
																'escape' => false)	
										); 	
									?>
									
								</div>

							</div>
						<?php 
							endforeach; 
						?>
					</div>	
				<?php 
					endif;
				endif;
				?>	
		</div>
	
	<div class="col-md-11 col-md-offset-1" style="left: -59px;">
		<?php 
		if(!empty($ofertas)):
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
	
	
	<!--Form para cambiar vigencia de la oferta-->
		<div class="modal fade" id="myModalVigencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 600px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Seleccione la fecha de vigencia para la oferta</h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 200px;">
									
					
								<?php 
									echo $this->Form->create('Administrator', array(
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
																		'onsubmit' =>'return validateVigenciaForm();',
																		'action' => 'updateCompanyJobProfileExpiration',
									)); 
								?>	
						
										<div class="col-md-11 col-md-offset-1" style=" margin-top: 30px;  padding-right: 0px;">	
												<fieldset>
													<?php 	echo $this->Form->input('CompanyJobProfile.id', array('type'=>'hidden')); ?>
													<p style="margin-left: 15px;">Vigencia de la oferta</p>
							
														<?php echo $this->Form->input('CompanyJobProfile.expiration', array(
																						'before' => '<div class="col-xs-12 col-sm-12 col-md-12">',
																						'between' => '<div class="col-md-12 ">',
																						'label' => array(
																									'class' => 'col-md-0 col-md-offset-0 control-label',
																									'text' => '',),
																						'style' => 'width: 120px;  margin-left: -10px; margin-right: 18px;  padding-left: 0px; padding-right: 0px;',
																						'div' => array('class' => 'form-inline'),
																						'label' => array(
																							'class' => 'col-sm-0 col-md-0 control-label',
																							'text' => '',),
																						'dateFormat' => 'YMD',
																						'separator' => '',
																						'minYear' => date('Y') - -15,
																						'maxYear' => date('Y') - 0,
																						'placeholder' => 'Vigencia que aparecerá en la oferta',
																						'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
														)); ?>
														<div style="display: none;">
														<?php echo $this->Form->input('CompanyJobProfile.created', array(
																						// 'type' => 'hidden',
																						'before' => '<div class="col-xs-12 col-sm-12 col-md-12">',
																						'between' => '<div class="col-md-12 ">',
																						'label' => array(
																									'class' => 'col-md-0 col-md-offset-0 control-label',
																									'text' => '',),
																						'style' => 'width: 120px;  margin-left: -10px; margin-right: 18px;  padding-left: 0px; padding-right: 0px;',
																						'div' => array('class' => 'form-inline'),
																						'label' => array(
																							'class' => 'col-sm-0 col-md-0 control-label',
																							'text' => '',),
																						'dateFormat' => 'YMD',
																						'separator' => '',
																						'minYear' => date('Y') - -15,
																						'maxYear' => date('Y') - 0,
																						'placeholder' => 'Vigencia que aparecerá en la oferta',
																						'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
														)); ?>
														</div>
														<div class="col-md-12" style="top: -45px;">
															<span style="color:red; position: absolute; margin-top: 9px; left: 5px;">*</span>
														</div>
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
				</div>
	
		<!--Form para envio de correo -->
		<div class="modal fade" id="myModalMail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 650px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Envio de correo electrónico </h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 440px;">
									<?php
										echo $this->Form->create('Administrator', array(
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
														'action' => 'sendEmailStudent'
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

		<!--Form para actualizar password -->
		<div class="modal fade" id="myModalUpdatePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 650px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Modificar contraseña del Empresa/Institucón</h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 270px;">
									<?php 
										echo $this->Form->create('Administrator', array(
														'class' => 'form-horizontal', 
														'role' => 'form',
														'inputDefaults' => array(
															'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
															'div' => array('class' => 'form-group'),
															'class' => 'form-control',
															'label' => array('class' => 'col-xs-4 col-sm-4 col-md-2 col-md-4 control-label '),
															'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
															'between' => '<div class="col-md-7">',
															'after' => '</div></div>',
															'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
														),
														'action' => 'updateCompanyPassword'
										)); ?>
										<fieldset style="margin-top: 30px;">
												<?php echo $this->Form->input('company_id', array(					
																'label' => array(
																	'class' => 'col-xs-12 col-sm-4 col-md-5 control-label ',
																	'text' => 'id de usuario',
																	),
																'placeholder' => 'id de usuario',
																'type' => 'hidden',
												)); ?>
												<?php echo $this->Form->input('password', array(
													'before' => '<div class="col-md-12 ">',
																'type' => 'password',
																'readonly' => 'readonly',
																'value' => $this->Session->read('randomPass'),
																'label' => array(
																	'class' => 'col-xs-5 control-label',
																	'text' => 'Contraseña generada automaticamente:'),
																'placeholder' => 'Escribir nueva contraseña'
												)); ?>	
												<?php echo $this->Form->input('company_email', array(	
													'before' => '<div class="col-md-12 ">',
														'readonly' => 'readonly',
														'type' => 'text',
														'label' => array(
															'class' => 'col-xs-5 control-label',
															'text'=>'Envio de notificación al correo:'),
														'placeholder' => 'Envio de notificación al correo',					
												)); ?>
												<?php echo $this->Form->input('company_email_alternativo', array(
														'before' => '<div class="col-md-12 ">',	
														'type' => 'text',
														'label' => array(
															'class' => 'col-xs-5 control-label',
															'text'=>'Correo alternativo:'),
														'placeholder' => 'Correo alternativo',					
												)); ?>
											<p style="font-size: 12px;">Si necesita agregar más de un correo alternativo estos deberan estar separados por un punto y coma ';'</p>
										</fieldset>
								</div>
								<div class="modal-footer">
									<?php 	echo $this->Form->button('Modificar&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-lock"></i>',array(
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