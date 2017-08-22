<?php 
	$this->layout = 'administrator'; 
?>

<script>
	$(document).ready(function() {
		
		var helpText = [
						"Guarda y nombra las consultas de ofertas en carpetas para una mejor organización. Las carpetas creadas se ordenarán alfabéticamente.",
						"Guarda la búsqueda específica que ha realizado con el fin de ser utilizada para futuras búsquedas.",
                        "Búsquedas específicas que ha guardado. Le recordamos que puede guardar como máximo 10 búsquedas, en caso de exceder este número se irán borrando las primeras búsquedas específicas guardadas.",
                        "",
                        "",
                        "Nombre genérico del puesto en el mercado laboral.                                                                                     Ejemplos: Puesto equivalente en el mercado Analista de Mercados = Analista de Mercadotecnia Gerente de atracción de talento = Gerente de reclutamiento y selección",
                        "",
                        "",
                        "Remuneración monetaria que recibe periódicamente un empleado por parte de la empresa o institución a cambio de sus servicios profesionales.",
                        "Actividad principal que realiza la empresa o institución.                                                                                 Ejemplos: Automotriz                                                                    Farmacéutica",
                        "Área en la que desea enfocar su desarrollo profesional o ha desarrollado experiencia laboral.",
                        "Área específica en la que desea enfocar su desarrollo profesional o aplicar su experiencia laboral.",
                        "Al seleccionar Sí y tipo de discapacidad, le presentarán ofertas con programas de inclusión laboral.",
                        "",
                        "Son las carreras, especialidades, maestrías o doctorados  parecidos o relacionados con el nivel académico seleccionado y que el sistema tomará en cuenta en la búsqueda.                                                                              Ejemplo. Carrera: Administración = Carrera afín: Administración de empresas Maestría: Proyección de Mercados potenciales = Maestría afín: Mercadotecnia",
                        "",
                        "Grado de dominio sobre diversas habilidades lingüísticas.",
                        "Grado de dominio sobre diversas habilidades de computo."						
						];
		 
		$('.form-group').each(function(index, element) {
			$(this).find(".cambia").attr("id", index);
			$(this).find('#'+index).attr("data-original-title", helpText[index]);
		});

		changeAcademicLevel(0);
		desabilityOptions();
		
		var mensaje = "¿Seguro que desea eliminar este bloque?";
				$("body").on("click", ".eliminar", function(e) {
					var respuesta = confirm(mensaje);
					if (respuesta === true){
						$(this).parent('div').remove();
						$(this).parent('div').remove();
					}
					return false;
				});
				
		//Obtener áreas en base al giro Carga automática (specificSearch)
		if ($("#CompanyJobProfileDynamicGiro0Giro").length > 0){
			if($("#CompanyJobProfileDynamicGiro0Giro").val() != 0)
				{
				$('#loading').show();
				$.get('http://bolsa.trabajo.unam.mx.1.15/unam/app/webroot/php/derpAreas.php',{giro: $('#CompanyJobProfileDynamicGiro0Giro').val()},function(JSON)
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
		
		$("#estado").on('change',function (){
			if($("#estado").val() != 0)
				{	
					$('#loading').show();
					$.get('http://bolsa.trabajo.unam.mx.1.15/unam/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
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
		
	});  
	
	// Funcion de carga de áreas
	
	function cargaAreas(id){
			if($('#CompanyJobProfileDynamicGiro'+id+'Giro').val() != 0)
				{
				$('#loading').show();
				$.get('http://bolsa.trabajo.unam.mx.1.15/unam/app/webroot/php/derpAreas.php',{giro: $('#CompanyJobProfileDynamicGiro'+id+'Giro').val()},function(JSON)
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
	
	var cont = 1;
	var cont2 = 1;
	var cont3 = 1;
	var cont4 = 1;
	
	function disabilityValue(){
		if($("#StudentProfileDisabilityS").is(':checked')) {  
            var discapacidad = 's';  
        } else if($("#StudentProfileDisabilityN").is(':checked')) {  
            var discapacidad = 'n';   
        } else{
			var discapacidad = '';   
		}
		var emailValue = document.getElementById("StudentProfileSecondaryEmail").value;
		var emailConfirmValue = document.getElementById("StudentProfileSecondaryEmailConfirm").value;
		
		if(discapacidad==''){
			jAlert('Seleccione si tiene alguna discapacidad.');
			document.getElementById('StudentProfileDisabilityS').focus();
			return false;
		} else
		if(($("#StudentProfileDisabilityS").is(':checked')) && (document.getElementById('StudentProfileDisabilityType').value == '')) {  
			jAlert('Seleccione el tipo de discapacidad.');
			document.getElementById('StudentProfileDisabilityType').focus();
			return false;
		} else
		if(emailConfirmValue != emailValue){
			jAlert('El correo de confirmación no coincide, verifique porfavor');
			document.getElementById('StudentProfileSecondaryEmailConfirm').focus();
			return false;
		} else 
		if(($('#StudentProfileCellPhone').val()!='') && ($('#StudentProfileLadaCellPhone').val()=='')){
			jAlert('Ingrese la lada del número celular');
			document.getElementById('StudentProfileLadaCellPhone').focus();
			return false;
		}else {
			return true;
		}		
	}

	function desabilityOptions(){
		if($("#CompanyJobProfileDisabilityS").is(':checked')) {  
			$('#tipoDiscapacidadId1').show();
		} else {
			document.getElementById('CompanyJobProfileDisabilityType').options[0].selected = 'selected';
			$('#tipoDiscapacidadId1').hide();
		}
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
				'<div class="form-group">'+
				'<div class="col-md-12 ">'+
				'<button id="eliminarGiro" class="btn btn-danger maxGiros" onclick="eliminarClonGiro('+cont2+'); " type="button" style="margin-left: 5px; padding-left: 5px; padding-right: 5px; border-right-width: 0px; border-left-width: 0px;"><i class="glyphicon glyphicon-trash"></i>&nbsp;</button>'+
				'<label for="CompanyJobProfileGiro"></label>'+
				'<div class="col-md-11">'+
				'<select id="CompanyJobProfileDynamicGiro'+cont2+'Giro" onchange="cargaAreas('+cont2+')" class="form-control selectpicker show-tick show-menu-arrow clonGiroInteres'+cont2+' clonGiroReindexa" data-live-search="true" placeholder="Giro de interés" name="data[CompanyJobProfileDynamicGiro]['+cont2+'][giro]">'+
				
				'</select>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'<div class="form-group">'+
				'<div class="col-md-12 ">'+
				'<label for="CompanyJobProfileAreaInteres"></label>'+
				'<div class="col-md-11">'+
				'<select id="CompanyJobProfileDynamicArea'+cont2+'AreaInteres" class="form-control selectpicker show-tick show-menu-arrow clonAreaReindexa" data-live-search="true" placeholder="Áreas de interés" name="data[CompanyJobProfileDynamicArea]['+cont2+'][area_interes]">'+
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
				'<button id="eliminarIdioma" class="btn btn-danger maxFormaciones eliminar"  type="button" style="padding-left: 5px; padding-right: 5px; border-right-width: 0px; border-left-width: 0px; margin-left: 400px; position: absolute; z-index: 100;"><i class="glyphicon glyphicon-trash"></i>&nbsp;</button>'+
				'<div class="form-group">'+
				'<div class="col-md-12 ">'+
				
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
				'<div class="col-md-11">'+
				'<select id="CompanyJobRelatedAreaDynamicArea'+cont3+'AreaId" class="form-control selectpicker show-tick show-menu-arrow clonArea'+cont3+' clonAreaReindexa" data-live-search="true" name="data[CompanyJobRelatedAreaDynamicArea]['+cont3+'][area_id]">'+
				
				'</select>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'</div>'+
				
				'<div class="form-group">'+
				'<div class="col-md-12 ">'+
				'<label for="CompanyCandidateProfileAcademicSituation"></label>'+
				'<div class="col-md-11">'+
				'<select id="CompanyCandidateProfileDynamicSituacionAcademica'+cont3+'AcademicSituation" class="form-control selectpicker show-tick show-menu-arrow clonSituacionAcademica'+cont3+' clonSituacionAcademicaReindexa" data-live-search="true" name="data[CompanyCandidateProfileDynamicSituacionAcademica]['+cont3+'][academic_situation]">'+
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
			// $('#CompanyCandidateProfileDynamicBuscarAfines0BuscarAfines').find('option').clone().appendTo('.clonBuscarAfines'+cont3);
			// $('#CompanyCandidateProfileDynamicSituacionAcademica0AcademicSituation').find('option').clone().appendTo('.clonSituacionAcademica'+cont3);
			
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
				
			var newClass = 'clonFormcionAcademica' + key + ' clonFormcionAcademicaIndependiente form-control selectpicker show-tick show-menu-arrow';
			var newId = 'IdClonFormacionAcademica' + key;
				
			$( "#"+$(this).attr('id') ).removeClass( $(this).attr('class') ).addClass( newClass );
			$( "#"+$(this).attr('id')).attr("id", newId);
				
			$(this).find(".clonNivelAcademicoReindexa").attr("id", 'CompanyCandidateProfileDynamicNivelAcademico'+key+'AcademicLevel');
			$(this).find(".clonNivelAcademicoReindexa").attr("name", 'data[CompanyCandidateProfileDynamicNivelAcademico]['+key+'][academic_level]');
			$(this).find(".clonNivelAcademicoReindexa").attr("class", 'form-control selectpicker show-tick show-menu-arrow clonNivelAcademico'+key+' clonNivelAcademicoReindexa');
			$(this).find(".clonNivelAcademicoReindexa").attr("onchange", 'changeAcademicLevel('+key+')');
				
			$(this).find(".clonCarreraReindexa").attr("id", 'CompanyJobRelatedCareerDynamicCarrera'+key+'CareerId');
			$(this).find(".clonCarreraReindexa").attr("name", 'data[CompanyJobRelatedCareerDynamicCarrera]['+key+'][career_id]');
			$(this).find(".clonCarreraReindexa").attr("class", 'form-control selectpicker show-tick show-menu-arrow clonCarrera'+key+' clonCarreraReindexa');

			$(this).find(".clonAreaReindexa").attr("id", 'CompanyJobRelatedAreaDynamicArea'+key+'AreaId');
			$(this).find(".clonAreaReindexa").attr("name", 'data[CompanyJobRelatedAreaDynamicArea]['+key+'][area_id]');
			$(this).find(".clonAreaReindexa").attr("class", 'form-control selectpicker show-tick show-menu-arrow clonArea'+key+' clonAreaReindexa');
				
			$(this).find(".clonSituacionAcademicaReindexa").attr("id", 'CompanyCandidateProfileDynamicSituacionAcademica'+key+'AcademicSituation');
			$(this).find(".clonSituacionAcademicaReindexa").attr("name", 'data[CompanyCandidateProfileDynamicSituacionAcademica]['+key+'][academic_situation]');
			$(this).find(".clonSituacionAcademicaReindexa").attr("class", 'form-control selectpicker show-tick show-menu-arrow clonSituacionAcademica'+key+' clonSituacionAcademicaReindexa');
						
			$(this).find(".divCarreras").attr("id", 'divCarrerasId'+key);
			$(this).find(".divAreas").attr("id", 'divAreasId'+key);
			$(this).find(".maxFormaciones").attr("onclick", 'eliminarClonFormacionAcademica('+key+')');
			}
		);
		$('.selectpicker').selectpicker('refresh');
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
				'<div class="col-md-12">'+
					'<button id="eliminarIdioma" class="btn btn-danger maxIdiomas eliminar" type="button" style="margin-left: -23px; padding-left: 5px; padding-right: 5px; border-right-width: 0px; border-left-width: 0px; position: absolute; z-index:100"><i class="glyphicon glyphicon-trash"></i>&nbsp;</button>'+
					'<div class="col-md-6">'+
						'<div class="form-group">'+
							'<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;">'+
								'<label for="CompanyJobLanguageLanguageId"></label>'+
								'<div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">'+
									'<select id="CompanyJobLanguage'+cont+'LanguageId" class="form-control selectpicker show-tick show-menu-arrow selectClonLanguage'+cont+' clonLanguageReindexa" data-live-search="true" name="data[CompanyJobLanguage]['+cont+'][language_id]">'+
											
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
			cont++;
			$('.selectpicker').selectpicker('refresh');
		}
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
						'<div class="col-md-12">'+
							'<button id="eliminarComputo" class="btn btn-danger maxComputos eliminar"  type="button" style="margin-left: -23px; padding-left: 5px; padding-right: 5px; border-right-width: 0px; border-left-width: 0px; position: absolute; z-index:100"><i class="glyphicon glyphicon-trash"></i>&nbsp;</button>'+
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
						'</div>'+
					'</div>'
				);
				$('.selectClonComputoLevel').empty();
				
				$('#CompanyJobComputingSkill0Level').find('option').clone().appendTo('.selectClonComputoLevel'+cont4);
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

	function checkAlInputs(){
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
		
	function viewSearch(){
			 selectedIndex = document.getElementById("AdministratorBusquedaGuardada").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				document.getElementById("viewSearchId").submit();
			 }
		}
		
	function addName(){
			jPrompt('Ingrese el nombre de la búsqueda','','Guardar búsqueda', function(r){
					if( r ){
							document.getElementById("StudentSavedSearchName").value = r;
							var response = checkAlInputs();
							if(response){
								document.getElementById("requestForm").submit();
							} else {
								document.getElementById("StudentSavedSearchName").value = '';
							}
					} 
				});
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
		
</script>
	<div class="container col-md-12" style="margin-top: 30px;">
	
		<?php 
			echo $this->Session->flash();
		?>
			<?php 
				echo $this->Form->create('Student', array(
										'class' => 'form-horizontal', 
										'role' => 'form',
										'inputDefaults' => array(
												'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
												'div' => array('class' => 'form-group'),
												'class' => 'form-control',
												'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="left" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="<?php echo $this->webroot; ?>/unam/img/help.png">',
												'between' => ' <div class="col-md-1  col-md-offset-1">',
												'after' => '</div></div>',
												'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
										),
										'action' => '',
										'onsubmit' =>'addName(); return false;'
						)); ?>					
					
						<?php 
						echo $this->Form->input('Guardar Búsqueda', array(
													'type' => 'submit',
													'label' => '',
													'class' => 'btn btnBlue btn-default form-control',
													'escape' => true,
													'style' => 'margin-left: -50px; width: 264px;',
													'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="Guarde la búsqueda específica 
que ha realizado con el fin de 
ser utilizada para futuras búsquedas." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 155px">',
												)
						);
						echo $this->Form->end(); 
				?>
				
				
				<?php 
					echo $this->Form->create('Administrator', array(
											'class' => 'form-horizontal', 
											'id' => 'viewSearchId',
											'role' => 'form',
											'inputDefaults' => array(
													'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
													'div' => array('class' => 'form-group'),
													'class' => 'form-control',
													'before' => '<div class="col-md-6 "><img data-toggle="tooltip" id="" data-placement="left" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
													'between' => ' <div class="col-md-3" >',
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
																'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																'div' => array('class' => 'form-group'),
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'between' => ' <div class="col-md-3" style="margin-top: -50px;margin-left: 330px;",>',
																'before' => '<div class="col-md-12 "><img  style="position: absolute; margin-top: -50px; margin-left: 563px;" data-toggle="tooltip" id="" data-placement="top" title="Búsquedas específicas que ha guardado. 
Le recordamos que puede guardar como 
máximo 10 búsquedas, en caso de exceder 
este número se irán borrando las primeras 
búsquedas específicas guardadas." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 322px;margin-top: -97px;">',
																// 'between' => ' <div class="col-md-11">',
																// 'style' =>'margin-top: -50px;margin-left: 330px;',
																'after' => '</div></div>',
																'options' => $busquedasGuardadas,'default'=>'0', 'empty' => 'Búsquedas guardadas'
					)); 		
					echo $this->Form->end(); 
				?>	
				<div style="text-align: left;" class="col-md-offset-7">
						<p style="margin-left: -85px;margin-top: -50px;"> (máx. 10)</p>
				</div>
				
				<?php 
					echo $this->Form->create('Administrator', array(
									'class' => 'form-horizontal',
									'id' => 'requestForm',
									'role' => 'form',
									'inputDefaults' => array(
											'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
											'div' => array('class' => 'form-group'),
											'class' => 'form-control',
											'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="left" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
											'between' => ' <div class="col-md-11" >',
											'after' => '</div></div>',
											'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
									),
									'onsubmit' =>'return checkAlInputs();',
									'action' => 'specificSearchOfferResults',
					)); ?>

					<div class="col-md-12">	
					<fieldset>
					<div class="col-md-6">	
					<div style="text-align: left;">
						<p style="margin-left: 15px;"> Palabras clave</p>
					</div>

					
						<?php // name for save search ?>
						<?php 	echo $this->Form->input('StudentSavedSearch.name', array(
										'label' => '',
										'type' => 'hidden',
						));	?>
						
					<?php 	echo $this->Form->input('CompanyJobProfile.job_name', array(
									'label' => '',
									'placeholder' => 'Palabras clave',
									'before' => '<div class="col-md-12 ">',
					));	?>

					<?php 	$options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200);
							echo $this->Form->input('limit', array(
															'type'=>'select',
															'class' => 'selectpicker show-tick form-control show-menu-arrow',
															'data-width'=> '200px',
															'before' => '<div class="col-md-12 "',
															'between' => ' <div class="col-md-6" style="margin-top: -170px;margin-left: 560px;">',
															'selected' => $this->Session->read('limit'),
															'label' =>'',
															'options' => $options,'default'=>'0', 'empty' => 'Resultados por hoja'
							)); ?>

					<div style="text-align: left;">
						<p style="margin-left: 15px;"> Perfil de la oferta</p>
					</div>
					
					<div style="text-align: left;" class="col-md-offset-7">
						<p style="margin-top: -65px;"> 60 caracteres máx.</p>
				</div>
					<?php 	echo $this->Form->input('CompanyJobContractType.contract_type', array(
									'before' => '<div class="col-md-12 ">',
									'type'=>'select',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'label' => '',
									'required' => false,
									'options' => $TiposContratos,'default'=>'0', 'empty' => 'Tipo de contrato'
					));	?>
					<?php 	echo $this->Form->input('CompanyJobContractType.workday', array(
									'before' => '<div class="col-md-12 ">',
									'type'=>'select',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'label' => '',
									'required'=> 'no',
									'options' => $JornadasLaborales,'default'=>'0', 'empty' => 'Jornada laboral'
					));	?>
					<?php 	echo $this->Form->input('CompanyJobContractType.salary', array(
									'type'=>'select',
									'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="Remuneración monetaria que recibe periódicamente un empleado por parte de la empresa o institución a cambio de sus servicios profesionales." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'label' => '',
									'required'=> 'no',
									'options' => $Salarios,'default'=>'0', 'empty' => 'Sueldo'
					));	?>
					<div id="original" class="clonGiro">
					<?php 	echo $this->Form->input('CompanyJobProfileDynamicGiro.0.giro', array(
									'type'=>'select',
									'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="Actividad principal que realiza la empresa o institución.
Ejemplos: 
Automotriz 
Farmacéutica" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
									'label' => '',
									'class' => 'selectpicker show-tick form-control show-menu-arrow clonGiroReindexa',
									'data-live-search' => "true",
									'placeholder' => 'Giro de interés',
									'onchange' => 'cargaAreas(0)',
									'options' => $Giros,'default'=>'0', 'empty' => 'Giro de interés',
					));	?>
					<?php 	echo $this->Form->input('CompanyJobProfileDynamicArea.0.area_interes', array(
									'type'=>'select',
									'class' => 'form-control clonAreaReindexa selectpicker show-tick show-menu-arrow',
									'data-live-search' => "true",
									'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="Área en la que desea enfocar su desarrollo profesional o ha desarrollado experiencia laboral." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
									'label' => '',
									'placeholder' => 'Áreas de interés',
									// 'onchange' => 'cargaSubareas(0)',
									'default'=>'0', 'empty' => 'Área de interés',
					));	?>
					</div>
					<div class="contenedorClonesGiros">
					
					
					</div>
					<div class="col-md-offset-4">
						<p>Agregar otro giro y área (máx. 2)</p>
					</div>
									
					<div>
						 <img src="<?php echo $this->webroot; ?>/img/add.png" id="agregarGiro" onclick="clonarGiro();" style="background-color: transparent;width: 25px;margin-left: 10px;cursor:pointer"> 
					</div>
					
					<div style="text-align: left;">
					<br>
					<br>
						<p style="margin-left: 15px;">Oferta incluyente</p>
					</div>
					
					<?php 	$options = array('s' => 'Si', 'n' => 'No');
							echo $this->Form->input('CompanyJobProfile.disability', array(
																	'type' => 'radio',
																	'default'=> 0,
																	'legend' => false,
																	'before' => '<div class="col-xs-12 col-sm-7 col-md-7 col-md-offset-7" style="color: #fff;  margin-top: -35px;"><img data-toggle="tooltip" id="" data-placement="top" title="Al seleccionar Sí y tipo de discapacidad, le presentarán ofertas con programas de inclusión laboral." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 20px;"><div class="radio-inline col-xs-3 col-sm-3 col-md-3"><label>',
																	'after' => '</label></div></div>',
																	'separator' => '</label></div><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
																	'options' => $options,'default'=>'0', 
																	'onclick' => 'desabilityOptions()'
					)); ?>
					<div id="tipoDiscapacidadId1">
					<?php 	
							echo $this->Form->input('CompanyJobProfile.disability_type', array(
																	'before' => '<div class="col-md-12 ">',
																	'type'=>'select',
																	'class' => 'selectpicker show-tick form-control show-menu-arrow',
																	'label' => '',
																	'options' => $TiposDiscapacidad,
																	'empty' => 'Discapacidad'
					)); ?>
					</div>
					</div>
					<div class="col-md-6">
					<div style="text-align: left;">
						<p style="margin-left: 15px;"> Lugar de trabajo</p>
					</div>
					
					<?php 	echo $this->Form->input('CompanyJobContractType.state', array(
																	'before' => '<div class="col-md-12 ">',
																	'id'=>'estado',
																	'type' => 'select',
																	'class' => 'selectpicker show-tick form-control show-menu-arrow',
																	'data-live-search' => "true",
																	'label' => '',
																	'placeholder' => 'Entidad federativa / Estado',
																	'options' => $Estados,'default'=>'0', 'empty' => 'Estado / Entidad Federativa',
					));	?>
					<?php 	echo $this->Form->input('CompanyJobContractType.subdivision', array(
																	'id' => 'ciudad',
																	'type' => 'select',
																	'class' => 'selectpicker show-tick form-control show-menu-arrow',
																	'data-live-search' => "true",
																	'before' => '<div class="col-md-12 ">',
																	'label' => '',
																	'placeholder' => 'Delegación / Municipio',
																	'default'=>'0', 'empty' => 'Delegación / Municipio',
														
					));	?>
					<div style="text-align: left;">
						<p style="margin-left: 15px;">Disponibilidad para viajar</p>
					</div>
					<?php 	$options = array('s' => 'Si', 'n' => 'No');
									echo $this->Form->input('CompanyJobContractType.mobility', array(
																	'type' => 'radio',
																	'default'=> 0,
																	'legend' => false,
																	'before' => '<div class="col-xs-12 col-sm-7 col-md-7 col-md-offset-7" style="color: #fff;  margin-top: -40px;"><div class="radio-inline col-xs-3 col-sm-3 col-md-3"><label>',
																	'after' => '</label></div></div>',
																	'separator' => '</label></div><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
																	'options' => $options,'default'=>'0', 
					)); ?>
					
					<div style="text-align: left;">
						<p style="margin-left: 15px;"> Formación académica</p>
					</div>
					<div id="original" class="clon">
						<?php 
								echo $this->Form->input('CompanyCandidateProfileDynamicNivelAcademico.0.academic_level', array(
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
																		'options' => $SituacionesAcademicas,'default'=>'0', 'empty' => 'Situación académica'
						)); ?>
					</div>
					<div class="contenedorClonesFormacionAcademica">
					
					</div>
					

					<div class="col-md-offset-2">
						<p>Agregar otra formación académica (máx. 3)</p>
					</div>
									
					<div>
						 <img src="<?php echo $this->webroot; ?>/img/add.png" id="agregarFormacionAcademica" onclick="clonarFormacionAcademica();" style="background-color: transparent;width: 25px;margin-left: 10px;cursor:pointer"> 
					</div>
			
					<div style="text-align: left;">
						<p style="margin-left: 15px;"> Conocimientos y habilidades profesionales</p>
					</div>
					<div style="text-align: left;">
						<p style="margin-left: 15px;"> Idioma</p>
					</div>
					
						<div id="original" class="clon">
							<div class="col-md-12">
								<div class="col-md-6">
									<?php 	echo $this->Form->input('CompanyJobLanguage.0.language_id', array(
																			'before' => '<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;">',
																			'between' => ' <div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">',
																			'type'=>'select',
																			'class' => 'selectpicker show-tick form-control show-menu-arrow clonGiroReindexa',
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
																			'class' => 'selectpicker show-tick form-control show-menu-arrow clonGiroReindexa',
																			
																			'label' => '',
																			'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel'
									));?>
								</div>
							</div>
						</div>
						
					<div class="contenedorClonesLanguages">
					
					
					</div>
					
					<div class="col-md-offset-5">
						<p style="margin-left: -3px;">Agregar otro idioma (máx. 3)</p>
					</div>
									
					<div>
						 <img src="<?php echo $this->webroot; ?>/img/add.png" id="agregarIdioma" onclick="clonarLenguaje();" style="background-color: transparent;width: 25px;margin-left: 10px;cursor:pointer"> 
					</div>
			
					
					<div style="text-align: left;">
						<p style="margin-left: 15px;margin-top: 10px;">Cómputo</p>
					</div>
					
						<div id="originalComputo" class="clonComputo">
							<div class="col-md-12">
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
																			'class' => 'selectpicker show-tick form-control show-menu-arrow clonGiroReindexa',
																			'label' => '',
																			'options' => $NivelesSoftware,'default'=>'0', 'empty' => 'Nivel'
									));?>
								</div>
							</div>
						</div>
						
					<div class="contenedorClonesComputo">
					
					
					</div>
					
					<div class="col-md-offset-5">
						<p style="margin-left: -15px;">Agregar otro cómputo (máx. 3)</p>
					</div>
									
					<div>
						
						 <img src="<?php echo $this->webroot; ?>/img/add.png" id="agregarComputo" onclick="clonarComputo();" style="background-color: transparent;width: 25px;margin-left: 10px;cursor:pointer"> 
					</div>
	
					</fieldset>
				</div>
				</div>
					<?php 
					echo $this->Form->button(
										'Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>', 
											array(
												'type' => 'submit',
												'div' => 'form-group',
												'class' => 'btn btnBlue btn-default col-md-2',
												'style' => 'margin-top: 19px; margin-left: 751px;',
												'escape' => false,
											)
					);
	
					echo $this->Form->end(); 
					?>
	</div>