<?php 
	$this->layout = 'company'; 
?>

	<script type="text/javascript">
		$(document).ready(function() {
			
			$("#estado").on('change',function (){
				if($("#estado").val() != 0)
					{	
						$('#loading').show();
						$.get('http://localhost/bolsabti/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
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
					$.get('http://localhost/bolsabti/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
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
			
			// actualizaCarreras(); 
			// semestre(); //Temporal dehabilitado
			academicSituation('0');
			desabilityMobility();
			desabilityMobility1();
			desabilityMobility2();	
			mobilityCityOption();
			mobilityCityOption2();
			//cargaAreas('0');
			cargaCarreras('0','1')
			
			// init_contadorTa("StudentJobSkillName","contadorTaComentario", 316);
			// updateContadorTa("StudentJobSkillName","contadorTaComentario", 316);
			
			$("#agregarIdioma").click(function(e) { 
				var numIdiomas = $(".divIdiomas");
				if(numIdiomas.length >= 3){			
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Sólo puedes agregar hasta 3 idiomas'});
				} else if (	(document.getElementById("StudentLenguage0LanguageId").value.length === 0) && 
							(document.getElementById("StudentLenguage0ReadingLevel").value.length === 0) &&
							(document.getElementById("StudentLenguage0WritingLevel").value.length === 0) &&
							(document.getElementById("StudentLenguage0ConversationLevel").value.length === 0)
							){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese al menos un valor antes de agregar otro idioma'});
					return false;
				} else {	
				var string = '<div class=" divIdiomas">'+
					                '<div class="form-group row"><div class="col-md-12"><div class="col-md-12">'+
									'<label for="StudentLenguage0LanguageId'+x+'LanguageId"></label>'+
									'<select name="data[StudentLenguage]['+x+'][language_id]" class="form-control selectpicker show-tick show-menu-arrow idioma'+x+'" data-live-search="true" id="StudentLenguage'+x+'LanguageId">'+
									'</select></div></div></div><div class="form-group row"><label for="StudentLenguage'+x+'ReadingLevel"></label><div class="col-md-12"><div class="col-md-12">'+
									'<select name="data[StudentLenguage]['+x+'][reading_level]" class="form-control selectpicker show-tick show-menu-arrow readingLevel'+x+'" placeholder="Nivel de lectura" id="StudentLenguage'+x+'ReadingLevel">'+
									'</select></div></div></div><div class="form-group row"><label for="StudentLenguage'+x+'WritingLevel"></label><div class="col-md-12"><div class="col-md-12">'+
									'<select name="data[StudentLenguage]['+x+'][writing_level]" class="form-control selectpicker show-tick show-menu-arrow writingLevel'+x+'" placeholder="Nivel de escritura" id="StudentLenguage'+x+'WritingLevel">'+
									'</select></div></div></div><div class="form-group row"><label for="StudentLenguage'+x+'ConversationLevel"></label><div class="col-md-12"><div class="col-md-12">'+
									'<select name="data[StudentLenguage]['+x+'][conversation_level]" class="form-control selectpicker show-tick show-menu-arrow conversationLevel'+x+'" placeholder="Nivel de conversación" id="StudentLenguage'+x+'ConversationLevel">'+
									'</select></div></div></div>'+
									 '<button class="btn btn-danger btn-sm eliminar1" style="margin-bottom: 10px;" type="button"><i class="glyphicon glyphicon-trash"></i></button><div class="col-md-11 "></div>'+
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
			    
			var mensaje = "¿Seguro que desea eliminar este bloque?";
			$("body").on("click", ".eliminar1", function(e) {
				var respuesta = confirm(mensaje);
				if (respuesta === true){
					$(this).parent('div').remove();
					$(this).parent('div').remove();
				}
				return false;
			})
			
			$("#agregarComputo").click(function(e) {
				var numComputo = $(".divComputo");      
				if(numComputo.length >= 3){			
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Sólo puedes agregar hasta 3 cómputos'});
					return false;
				} else if (	(document.getElementById("StudentTechnologicalKnowledge0TecnologyId").value.length === 0) && 
							(document.getElementById("StudentTechnologicalKnowledge0Name").value.length === 0) &&
							(document.getElementById("StudentTechnologicalKnowledge0Other").value.length === 0) &&
							(document.getElementById("StudentTechnologicalKnowledge0Level").value.length === 0)
							){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese al menos un valor antes de agregar otro cómputo'});
					return false;
				} else {
					var string = '<div class="divComputo">'+
									'<div class="form-group row"><div class="col-md-12 "><div class="col-md-12">'+
									'<select name="data[StudentTechnologicalKnowledge]['+xComputo+'][tecnology_id]" class="form-control selectpicker show-tick show-menu-arrow categoriId'+xComputo+'"  id="StudentTechnologicalKnowledge'+xComputo+'tecnology_id">'+
									'</select></div></div></div><div id="contentName'+xComputo+'"><div class="form-group row"><div class="col-md-12 "><div class="col-md-12 ">'+
									'<select name="data[StudentTechnologicalKnowledge]['+xComputo+'][name]" class="form-control selectpicker show-tick show-menu-arrow name'+xComputo+'" data-live-search="true" onchange="hideOther('+xComputo+')" placeholder="Nombre" type="text" id="StudentTechnologicalKnowledge'+xComputo+'Name"/></select></div></div></div></div><div id="contentOther'+xComputo+'"><div class="form-group row"><div class="col-md-12 "><div class="col-md-12 ">'+
									'<input name="data[StudentTechnologicalKnowledge]['+xComputo+'][other]" class="form-control other'+xComputo+'" onblur="restart('+xComputo+')"  placeholder="Otro" type="text" id="StudentTechnologicalKnowledge'+xComputo+'Other"/></div></div></div></div><div class="form-group row"><div class="col-md-12 "><div class="col-md-12 ">'+
									'<select name="data[StudentTechnologicalKnowledge]['+xComputo+'][level]" class="form-control selectpicker show-tick show-menu-arrow level'+xComputo+'" placeholder="Nivel" id="StudentTechnologicalKnowledge'+xComputo+'Level">'+
                                    '</select></div></div></div>'+
									'<button class="btn btn-danger btn-sm eliminar" onclick="eliminarClonComputo('+xComputo+'); " type="button" style="margin-bottom: 10px;" ><i class="glyphicon glyphicon-trash"></i></button><div class="col-md-11 "></div> '+
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
			})
			
			$("#agregarNivel").click(function(e) {
				var numNivel = $(".divNiveles");
                if(numNivel.length >= 3){			
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Sólo puedes agregar hasta 3 Niveles'});
					return false;				
                } else if (	(document.getElementById("CompanyCandidateProfile0AcademicLevelId").value.length === 0) && 
							(document.getElementById("CompanyCandidateProfile0Semester").value.length === 0) 
							){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese al menos un valor antes de agregar otro Nivel'});
					return false;
				} else {
				var string = '<div class="divNiveles">'+
							'<input id="CompanyCandidateProfile'+x+'Index" class="form-control" name="data[CompanyCandidateProfile]['+x+'][index]" value="'+x+'" type="hidden">'+
							'<div class="form-group row"><label for="CompanyCandidateProfile'+x+'AcademicLevelId"></label>'+
							'<div class="col-md-12"><div class="col-md-12"><select id="CompanyCandidateProfile'+x+'AcademicLevelId" class="selectpicker show-tick form-control show-menu-arrow nivelPerfil'+x+' nivelClase" onchange="cargaCarreras('+x+',0);" name="data[CompanyCandidateProfile]['+x+'][academic_level_id]" >'+
							
							'</select></div></div></div>'+
							
							'<div class="form-group row"><label for="CompanyCandidateProfile'+x+'AcademicSituationId"></label>'+
							'<div class="col-md-12"><div class="col-md-12"><select id="CompanyCandidateProfile'+x+'AcademicSituationId" class="selectpicker show-tick form-control show-menu-arrow situacionPerfil'+x+' situacionClase" name="data[CompanyCandidateProfile]['+x+'][academic_situation_id]" onchange="academicSituation('+x+')">'+
								'<option value="">Situacion Académica</option>'+
							'</select></div></div></div>'+
							
							'<div id="divSemestre'+x+'" style="display: none;">'+
								'<div class="form-group row"><label for="CompanyCandidateProfile0Semester"></label>'+
								'<div class="col-md-12"><div class="col-md-12"><select id="CompanyCandidateProfile'+x+'Semester" class="selectpicker show-tick form-control show-menu-arrow semestrePerfil'+x+' semestresClase" name="data[CompanyCandidateProfile]['+x+'][semester]" onchange="academicSituation('+x+')">'+
								
								'</select></div></div></div>'+
							'</div>'+
							
							'<div class="form-group row"><label for="CompanyCandidateProfileCarreras0Carreras"></label>'+
							'<div class="col-md-12"><div class="col-md-12"><select id="CompanyCandidateProfileCarreras'+x+'Carreras" class="selectpicker show-tick form-control show-menu-arrow carrerasClase" name="data[CompanyCandidateProfileCarreras]['+x+'][carreras][]" multiple="multiple" data-live-search="true" data-selected-text-format="count > 0" title="Seleccione las Carreras / Áreas" data-actions-box="true" placeholder="Prestaciones y apoyos" >'+
							
							'</select></div></div></div>'+
							'<button class="btn btn-danger btn-sm eliminar"type="button" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-trash"></i></button><div class="col-md-11 "></div>'+
						'</div>	';	

				$("#contenedorNiveles").append(string); 
				$('#CompanyCandidateProfile0AcademicLevelId').find('option').clone().appendTo('.nivelPerfil'+x);
				// document.getElementById('CompanyCandidateProfile'+x+'AcademicLevelId').options[0].selected = 'selected';
				$('#CompanyCandidateProfile0Semester').find('option').clone().appendTo('.semestrePerfil'+x);
				// document.getElementById('CompanyCandidateProfile'+x+'Semester').options[0].selected = 'selected';
				
				$('.selectpicker').selectpicker('refresh');
				
				x++;
				$('[data-toggle="tooltip"]').tooltip();
				// $(".img-circle").hover(function() {
					// $(this).attr("src","http://bolsa.trabajo.unam.mx/unam/app/webroot/img/help_yellow.png");
						// }, function() {
					// $(this).attr("src","http://bolsa.trabajo.unam.mx/unam/app/webroot/img/help.png");
				// });
				return false;
			}
		});
			
	});

			
		//Obtener áreas en base al giro Carga automática (specificSearch)
		if ($("#StudentJobProfileDynamicGiro0Giro").length > 0){
			if($("#StudentJobProfileDynamicGiro0Giro").val() != 0)
				{
				$('#loading').show();
				$.get('http://localhost/bolsabti/app/webroot/php/derpAreas.php',{giro: $('#StudentJobProfileDynamicGiro0Giro').val()},function(JSON)
					{
					
					$('#StudentJobProfileDynamicArea0AreaInteres').empty();
					$('#StudentJobProfileDynamicArea0AreaInteres').append('<option value="">Área de interés</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});

					$.each(JSON, function(key, val){
						$('#StudentJobProfileDynamicArea0AreaInteres').append('<option value="' + val.id + '">' + val.area + '</option>');
						
						if (--waitCount == 0) {
							$('#loading').hide();
							$('.selectpicker').selectpicker('refresh');
						}

					});
					});
				}
				else
				{
					$('#StudentJobProfileDynamicArea0AreaInteres').empty();
					$('#StudentJobProfileDynamicArea0AreaInteres').append('<option value="">Área de interés</option>');
					$('.selectpicker').selectpicker('refresh');
				}
			}
		// Funcion de carga de áreas
		function cargaAreas(id){
			if($('#StudentJobProfileDynamicGiro'+id+'Giro').val() != 0)
				{
				$('#loading').show();
				$.get('http://localhost/bolsabti/app/webroot/php/derpAreas.php',{giro: $('#StudentJobProfileDynamicGiro'+id+'Giro').val()},function(JSON)
					{
							
					$('#StudentJobProfileDynamicArea'+id+'AreaInteres').empty();
					$('#StudentJobProfileDynamicArea'+id+'AreaInteres').append('<option value="">Área de interés</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});

					$.each(JSON, function(key, val){
						$('#StudentJobProfileDynamicArea'+id+'AreaInteres').append('<option value="' + val.id + '">' + val.area + '</option>');
						
						if (--waitCount == 0) {
							$('#loading').hide();
							$('.selectpicker').selectpicker('refresh');
						}

					});
					});
				}
				else
				{
					$('#StudentJobProfileDynamicArea'+id+'AreaInteres').empty();
					$('#StudentJobProfileDynamicArea'+id+'AreaInteres').append('<option value="">Área de interés</option>');
					$('.selectpicker').selectpicker('refresh');
				}
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
		
	// Usadas para elementos dinámicos
	var cont = 1;
	var cont2 = 1;
	var cont3 = 1;
	var cont4 = 1;

	function clonarGiro(){
		var numGiros = $(".maxGiros");
		if(numGiros.length >= 3){	
			$.alert({ title: '!Aviso!',type: 'blue',content: 'Sólo puedes agregar hasta 3 giros'});
			return false;
		} else if (	(document.getElementById("StudentJobProfileDynamicGiro0Giro").value.length === 0) && 
					(document.getElementById("StudentJobProfileDynamicArea0AreaInteres").value.length === 0)){
			$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese al menos un valor antes de agregar otro giros'});
		    return false;
		} else {
			
			$(".contenedorClonesGiros").append(
			'<div id="IdClonGiro'+cont2+'" class="clonGiro'+cont2+' clonGiroIndependiente">'+
				'<div class="form-group"><label for="StudentJobProfileGiro'+cont2+'Giro" class="col-md-12 control-label"></label><div class="col-md-12"><div class="col-md-12"><select name="data[StudentJobProfileDynamicGiro]['+cont2+'][giro]" class="form-control clonGiroInteres'+cont2+' clonGiroReindexa selectpicker show-tick show-menu-arrow" data-live-search="true" onchange="cargaAreas('+cont2+')" id="StudentJobProfileDynamicGiro'+cont2+'Giro">'+
				'</select></div></div></div><div class="form-group"><label for="StudentJobProfileDynamicArea'+cont2+'AreaInteres" class="col-md-12 control-label"></label><div class="col-md-12"><div class="col-md-12"><select name="data[StudentJobProfileDynamicArea]['+cont2+'][area_interes]" class="form-control clonAreaReindexa selectpicker show-tick show-menu-arrow" data-live-search="true" id="StudentJobProfileDynamicArea'+cont2+'AreaInteres">'+
				'<option value="">Áreas de interés</option></select></div></div></div>'+
				'<div class="col-md-12 "><button id="eliminarGiro" class="btn btn-danger btn-sm maxGiros" onclick="eliminarClonGiro('+cont2+');" type="button" style="float: right; margin-bottom: 10px;"><i class="glyphicon glyphicon-trash"></i></button><div class="col-md-12 "></div></div>');
				
			$('.clonGiroInteres').empty();

			$('#StudentJobProfileDynamicGiro0Giro').find('option').clone().appendTo('.clonGiroInteres'+cont2);
			
			$('.selectpicker').selectpicker('refresh');
			cont2++;
		}
	}
	
	function eliminarClonGiro(num){
		$( '.clonGiro'+num ).remove();
	}
	
	
	function clonarFormacionAcademica(){
		var numFormaciones = $(".maxFormaciones");
		if(numFormaciones.length >= 3){			
		$.alert({ title: '!Aviso!',type: 'blue',content: 'Sólo puedes agregar hasta 3 formaciones academicas'});
			return false;
		} else if (	(document.getElementById("StudentCandidateProfileDynamicNivelAcademico0AcademicLevel").value.length === 0) && 
					(document.getElementById("StudentJobRelatedCareerDynamicCarrera0CareerId").value.length === 0) && 
					(document.getElementById("StudentCandidateProfileDynamicSituacionAcademica0AcademicSituation").value.length === 0)){
		$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese al menos un valor antes de agregar otra formación académica'});
					return false;
		} else {
			$(".contenedorClonesFormacionAcademica").append(
				'<div id="IdClonFormacionAcademica'+cont3+'" class="clonFormcionAcademica'+cont3+' clonFormcionAcademicaIndependiente">'+
				'<div class="form-group">'+
				'<div class="col-md-12 ">'+
				'<button id="eliminarIdioma" class="btn btn-danger maxFormaciones" onclick="eliminarClonFormacionAcademica('+cont3+'); " type="button" style="margin-left: 5px; padding-left: 5px; padding-right: 5px; border-right-width: 0px; border-left-width: 0px;"><i class="glyphicon glyphicon-trash"></i>&nbsp;</button>'+
				'<label for="StudentCandidateProfileAcademicLevel"></label>'+
				'<div class="col-md-11">'+
				'<select id="StudentCandidateProfileDynamicNivelAcademico'+cont3+'AcademicLevel" onchange = "changeAcademicLevel('+cont3+');" class="form-control selectpicker show-tick show-menu-arrow clonNivelAcademico'+cont3+' clonNivelAcademicoReindexa" data-width="385px" name="data[StudentCandidateProfileDynamicNivelAcademico]['+cont3+'][academic_level]">'+
				
				'</select>'+
				'</div>'+
				'</div>'+
				'</div>'+
				
				'<div id="divCarrerasId'+cont3+'" class="divCarreras"  style="display: none;">'+
				'<div class="form-group">'+
				'<div class="col-md-12 ">'+
				'<label for="StudentJobRelatedCareerDynamicCarrera'+cont3+'CareerId"></label>'+
				'<div class="col-md-11">'+
				'<select id="StudentJobRelatedCareerDynamicCarrera'+cont3+'CareerId" class="form-control selectpicker show-tick show-menu-arrow clonCarrera'+cont3+' clonCarreraReindexa" data-width="385px" name="data[StudentJobRelatedCareerDynamicCarrera]['+cont3+'][career_id]">'+
				
				'</select>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'</div>'+
				
				'<div id="divAreasId'+cont3+'" class="divAreas" style="display: none;">'+
				'<div class="form-group">'+
				'<div class="col-md-12 ">'+
				'<label for="StudentJobRelatedAreaDynamicArea'+cont3+'AreaId"></label>'+
				'<div class="col-md-11">'+
				'<select id="StudentJobRelatedAreaDynamicArea'+cont3+'AreaId" class="form-control selectpicker show-tick show-menu-arrow clonArea'+cont3+' clonAreaReindexa" data-width="385px" name="data[StudentJobRelatedAreaDynamicArea]['+cont3+'][area_id]">'+
				
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
				'<input id="StudentCandidateProfileDynamicBuscarAfines'+cont3+'BuscarAfinesS" class="form-control BuscarAfinesSReindexa" type="radio" value="s" style="margin-left: -18px; margin-top: 0; top: 1px; width: 15px;" name="data[StudentCandidateProfileDynamicBuscarAfines]['+cont3+'][buscar_afines]">'+
				'<label for="StudentCandidateProfileDynamicBuscarAfines'+cont3+'BuscarAfinesS">Si</label>'+
				'</label>'+
				'</div>'+
				'<div class="radio-inline col-md-2">'+
				'<label>'+
				'<input id="StudentCandidateProfileDynamicBuscarAfines'+cont3+'BuscarAfinesN" class="form-control BuscarAfinesNReindexa" type="radio" value="n" style="margin-left: -18px; margin-top: 0; top: 1px; width: 15px;" name="data[StudentCandidateProfileDynamicBuscarAfines]['+cont3+'][buscar_afines]">'+
				'<label for="StudentCandidateProfileDynamicBuscarAfines0BuscarAfinesN">No</label>'+
				'</label>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'<div class="form-group">'+
				'<div class="col-md-12 ">'+
				'<label for="StudentCandidateProfileAcademicSituation"></label>'+
				'<div class="col-md-11">'+
				'<select id="StudentCandidateProfileDynamicSituacionAcademica'+cont3+'AcademicSituation" class="form-control selectpicker show-tick show-menu-arrow clonSituacionAcademica'+cont3+' clonSituacionAcademicaReindexa" data-width="385px" name="data[StudentCandidateProfileDynamicSituacionAcademica]['+cont3+'][academic_situation]">'+
				
				'</select>'+
				'</div>'+
				'</div>'+
				'</div>'+
			'</div>'
			);
			
			$('#StudentCandidateProfileDynamicNivelAcademico0AcademicLevel').find('option').clone().appendTo('.clonNivelAcademico'+cont3);
			$('#StudentJobRelatedCareerDynamicCarrera0CareerId').find('option').clone().appendTo('.clonCarrera'+cont3);
			$('#StudentJobRelatedAreaDynamicArea0AreaId').find('option').clone().appendTo('.clonArea'+cont3);
			$('#StudentCandidateProfileDynamicBuscarAfines0BuscarAfines').find('option').clone().appendTo('.clonBuscarAfines'+cont3);
			$('#StudentCandidateProfileDynamicSituacionAcademica0AcademicSituation').find('option').clone().appendTo('.clonSituacionAcademica'+cont3);
			
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
			if(document.getElementById("StudentProfileDisability").value == 's') {  
				$('#bloque2').show();
			} else {
				$('#bloque2').hide();
			}
		}
			
		function desabilityMobility1(){
			<?php if(($this->Session->check('StudentProspect.can_travel') == false) and (empty($this->request->data))): ?>
				$( "#StudentProspectCanTravelOption1" ).prop( "checked", false );
				$( "#StudentProspectCanTravelOption2" ).prop( "checked", false );
			<?php endif; ?>
			
			if(document.getElementById("StudentProspectCanTravel").value == 's') {  
				  var disabilityValue = 's';
			} else if(document.getElementById("StudentProspectCanTravel").value == 'n'){
				 var disabilityValue = 'n';   
			}else{
				var disabilityValue = '';  
			}
			
			if(disabilityValue == "s"){
				$("#bloque1").show();
			} else {		
				$("#bloque1").hide();
			}
			$('.selectpicker').selectpicker('refresh');
		}
		
		function desabilityMobility2(){
			<?php if(($this->Session->check('StudentProspect.can_travel') == false) and (empty($this->request->data))): ?>
			$( "#CompanyJobContractTypeChangeResidenceOption1" ).prop( "checked", false );
			$( "#CompanyJobContractTypeChangeResidenceOption2" ).prop( "checked", false );
			document.getElementById('CompanyJobContractTypeChangeResidenceState').options[0].selected = 'selected';
		<?php endif; ?>
		
		if(document.getElementById("CompanyJobContractTypeChangeResidence").value == 's') {  
				  var disabilityValue = 's';  
			} else if(document.getElementById("CompanyJobContractTypeChangeResidence").value == 'n'){
				var disabilityValue = 'n';   
			}else{
				var disabilityValue = '';  
			}

		if(disabilityValue == "s"){
			$("#bloque3").show();
		} else {		
			$("#bloque3").hide();
		}
		$('.selectpicker').selectpicker('refresh');
	}
	// function init_contadorTa(idtextarea, idcontador,max){
			// $("#"+idtextarea).keyup(function()
					// {
						// updateContadorTa(idtextarea, idcontador,max);
					// });
			
			// $("#"+idtextarea).change(function()
			// {
					// updateContadorTa(idtextarea, idcontador,max);
			// });
			
	// }

	// function updateContadorTa(idtextarea, idcontador,max){
			// var contador = $("#"+idcontador);
			// var ta =     $("#"+idtextarea);
			// contador.html("0/"+max);
			
			// contador.html(ta.val().length+"/"+max);
			// if(parseInt(ta.val().length)>max)
			// {
				// ta.val(ta.val().substring(0,max-1));
				// contador.html(max+"/"+max);
			// } Temporal
	// }
	
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
			$.get('http://localhost/bolsabti/app/webroot/php/derp.php',function(JSON)
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
			$.get('http://localhost/bolsabti/app/webroot/php/derpPaises.php',function(JSON)
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
			$.get('http://localhost/bolsabti/app/webroot/php/derp.php',function(JSON)
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
			$.get('http://localhost/bolsabti/app/webroot/php/derpPaises.php',function(JSON)
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
	
		// $().ready(function(){
			// $('.pasar').click(function() { return !$('#origen option:selected').remove().appendTo('#destino'); });  
			// $('.quitar').click(function() { return !$('#destino option:selected').remove().appendTo('#origen');  });
			// $('.pasartodos').click(function() { $('#origen option').each(function() { $(this).remove().appendTo('#destino'); }); });
			// $('.quitartodos').click(function() { $('#destino option').each(function() { $(this).remove().appendTo('#origen'); }); });
			// $('.submit').click(function() { $('#destino option').prop('selected', 'selected'); });
		// });
		
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
		
		function academicSituation(index){
			var disabilityValue = $('#CompanyCandidateProfile'+index+'AcademicSituationId').val();

			if (disabilityValue != 1){
				$("#divSemestre"+index).hide();
				document.getElementById('CompanyCandidateProfile'+index+'Semester').options[0].selected = 'selected';
			} else {
				$("#divSemestre"+index).show();
			}
			
			$('.selectpicker').selectpicker('refresh');
		}

		// function actualizaCarreras(){
			// $('#origen').empty();
			// $('#destino').empty();
			
			// var liceciatura = $('#StudentProfessionalProfileLicenciatura').is(':checked'); 
			// var especialidad = $('#StudentProfessionalProfileEspecialidad').is(':checked'); 
			// var maestria = $('#StudentProfessionalProfileMaestria').is(':checked'); 
			// var doctorado = $('#StudentProfessionalProfileDoctorado').is(':checked'); 

			// if((especialidad) || (maestria) || (doctorado)){	
					// $('#loading').show();
					// $.get('http://localhost/bolsabti/app/webroot/php/derpCarreras.php',{escuela: '', level: 2 },function(JSON){
						
						// var waitCount = 0;
						// $.each(JSON, function(key, val){
							// waitCount++;
						// });

						// $.each(JSON, function(key, val){
							// $('#origen').append('<option title="' + val.carrera + '" value="' + val.id + '">' + val.carrera + '</option>');	
							
							// if (--waitCount == 0) {
								// $('#loading').hide();
								// ordenarSelect('origen');
								// ordenarSelect('destino');
								// pasaCarreras();
								// $('.selectpicker').selectpicker('refresh');
							// }
						// });
						
					// });	
			// }
			
			// if(liceciatura){	
					// $('#loading').show();
					// $.get('http://localhost/bolsabti/app/webroot/php/derpCarreras.php',{escuela: '', level: 1 },function(JSON){
						
						// var waitCount = 0;
						// $.each(JSON, function(key, val){
							// waitCount++;
						// });
						
						// $.each(JSON, function(key, val){
							// $('#origen').append('<option title="' + val.carrera + '"  value="' + val.id + '">' + val.carrera + '</option>');	
							
							// if (--waitCount == 0) {
								// $('#loading').hide();
								// ordenarSelect('origen');
								// ordenarSelect('destino');
								// pasaCarreras();
								// $('.selectpicker').selectpicker('refresh');
							// }
							
						// });
						// $('#loading').hide();
						// ordenarSelect('origen');
						// ordenarSelect('destino');
						// pasaCarreras();
					// });	
			// }
			// academicSituation();
		// }

		function addName(){
			$.confirm({
				    title: 'Búsquedas!',
				    theme: 'light',
					content: '' +
				    '<form action="" class="formName">' +
				    '<div class="form-group">' +
				    '<label>Guardar búsqueda</label>' +
				    '<input type="text" placeholder="Nombre de búsqueda" class="name form-control" required />' +
				    '</div>' +
				    '</form>',
				    buttons: {
				        formSubmit: {
				            text: 'Guardar',
				            btnClass: 'btn-blue ',
				            action: function () { 
				                var name = this.$content.find('.name').val();
				                if(!name){
				                    $.alert('Ingrese el nombre de la búsqueda');
				                    return false;
				                }
				                // $.alert('Your name is ' + name);
								document.getElementById("CompanySavedSearchName").value = name;
								document.getElementById("requestForm").submit();
				            }
				        },
				        cancel: function () {
				            //close
				        },
				    },
				    onContentReady: function () {
				        // bind to events
				        var jc = this;
				        this.$content.find('form').on('submit', function (e) {
				            // if the user submits the form by pressing enter in the field.
				            e.preventDefault();
				            jc.$$formSubmit.trigger('click'); // reference the button and click it
				        });
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
				$.alert({title:'AVISO',type: 'red',content : 'Sólo puede ingresar 4 palabras clave y separadas por un espacio',});	
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
		
		// Obtener las Escuelas/Facultades dependiendo del nivel
			function cargaCarreras(index, request){

			if($("#CompanyCandidateProfile"+index+"AcademicLevelId").val() != 0)
				{
				$('#loading').show();
				
				$.get('http://localhost/bolsabti/app/webroot/php/derpCarreras.php',{escuela: '', level: $("#CompanyCandidateProfile"+index+"AcademicLevelId").find(":selected").index() },function(JSON){
					
					$('#CompanyCandidateProfileCarreras'+index+'Carreras').empty();
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});
					
					$.each(JSON, function(key, val){
						$('#CompanyCandidateProfileCarreras'+index+'Carreras').append('<option value="' + val.id + '">' + val.carrera + '</option>');
						
							if (--waitCount == 0) {
								
								if(request==1){
									
								}else{	
									$('#CompanyCandidateProfile'+index+'AcademicSituationId option').remove();
									$('#CompanyCandidateProfile'+index+'AcademicSituationId').append(new Option('Seleccione una opción', ''));
									$('#CompanyCandidateProfile'+index+'AcademicSituationId').append(new Option('Estudiante', '1'));
									$('#CompanyCandidateProfile'+index+'AcademicSituationId').append(new Option('Egresado', '2'));
									$('#CompanyCandidateProfile'+index+'AcademicSituationId').append(new Option('Titulado', '3'));
									$('#CompanyCandidateProfile'+index+'AcademicSituationId').append(new Option('Con diploma', '4'));
									$('#CompanyCandidateProfile'+index+'AcademicSituationId').append(new Option('Con grado', '5'));
									//remove(index);
								}
								
								academicSituation(index);
								$('#loading').hide();
								$('.selectpicker').selectpicker('refresh');
							}
						});
					});
				}
				else
				{
					//remove(index);
					academicSituation(index);
					$('#CompanyCandidateProfileCarreras'+index+'Carreras').empty();
					$('#CompanyCandidateProfileCarreras'+index+'Carreras').append('<option value="">Seleccione las Carreras / Áreas</option>');
					$('.selectpicker').selectpicker('refresh');
				}
		}
		//Contador de caracteres para las notificaciones telefónicas 
		// function init_contadorTa(idtextarea, idcontador,max){
			// $("#"+idtextarea).keyup(function()
					// {
						// updateContadorTa(idtextarea, idcontador,max);
					// });
			
			// $("#"+idtextarea).change(function()
			// {
					// updateContadorTa(idtextarea, idcontador,max);
			// });
			
		// }

		// function updateContadorTa(idtextarea, idcontador,max){
			// var contador = $("#"+idcontador);
			// var ta =     $("#"+idtextarea);
			// contador.html("0/"+max);
			
			// contador.html(ta.val().length+"/"+max);
			// if(parseInt(ta.val().length)>max)
			// {
				// ta.val(ta.val().substring(0,max-1));
				// contador.html(max+"/"+max);
			// }

		// }
	
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
					alert('Seleccione la carpeta donde se guardará el perfil','Mensaje');
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
						alert('No se ha adjuntado ningún archivo', 'Mensaje');
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
							alert("Compruebe la extensión de su archivo. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(), 'Mensaje');
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
					$.alert({ title: 'Aviso',type: 'blue',content: 'Ingrese el mensaje para la notificación telefónica'});
					document.getElementById('StudentTelephoneNotificationMessage').focus();
					return false;
				} else
				if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
					$.alert({ title: 'Aviso',type: 'blue',content: 'Seleccione la fecha completa para el día de la entrevista telefónica'});
					document.getElementById('StudentTelephoneNotificationDateDay').focus();
					return false;
				}else 
				 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
					$.alert({ title: 'Aviso',type: 'blue',content: 'La fecha de la entrevista telefónica no debe ser menor a la actual'});
					document.getElementById('StudentTelephoneNotificationDateDay').focus();
					return false;
				}else 
				if(responseValidateDate == false){
					$.alert({ title: 'Aviso',type: 'blue',content: 'La fecha de la entrevista telefónica no es valida'});
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
				$.alert({ title: 'Aviso',type: 'blue',content: 'Ingrese el mensaje para la notificación personal'});
			    document.getElementById('StudentPersonalNotificationMessage').focus();
				return false;
			} else
			if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
				$.alert({ title: 'Aviso',type: 'blue',content: 'Seleccione la fecha completa para el día de la entrevista personal'});
				document.getElementById('StudentPersonalNotificationDateDay').focus();
				return false;
			}else 
			 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
				$.alert({ title: 'Aviso',type: 'blue',content: 'La fecha de la entrevista personal no debe ser menor a la actual'});
				document.getElementById('StudentPersonalNotificationDateDay').focus();
				return false;
			}else 
			if(responseValidateDate == false){
				$.alert({ title: 'Aviso',type: 'blue',content: 'La fecha de la entrevista personal no es válida'});
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
					alert('Ingrese el mensaje para la nueva propuesta', 'Mensaje');
					document.getElementById('taComentarioPropuesta').focus();
					return false;
				} else
				if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
					alert('Seleccione la fecha completa para el día de la entrevista', 'Mensaje');
					document.getElementById('StudentPropuestaFechaDay').focus();
					return false;
				}else 
				 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
					alert('La fecha de la entrevista no debe ser menor a la actual', 'Mensaje');
					document.getElementById('StudentPropuestaFechaDay').focus();
					return false;
				}else 
				if(responseValidateDate == false){
					alert('La fecha de la entrevista no es válida', 'Mensaje');
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
					alert('Seleccione la fecha completa para reportar la contratación','Mensaje');
					document.getElementById('StudentReportarContratacionFechaContratacionDay').focus();
					return false;
				}else  
				if(responseValidateDate == false){
					alert('La fecha para reportar contratación no es válida', 'Mensaje');
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
		
		function sendLimit(){
			 selectedIndex = document.getElementById("limit").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				document.getElementById('CompanyLimite').value = document.getElementById('limit').value;
				document.getElementById("CompanyCompanyViewedStudentForm").submit();
			 }
		}
		
		function openCollapse(id){
			// Cierra todos los collaps
			$(".collapse").collapse('hide');
			// Abre el contenedos indicado con el id
			$("#collapse"+id).collapse('toggle');	
			// Quita las pestañas como activas
			$( "#idButtonCollapse1" ).removeClass( "active" );
			$( "#idButtonCollapse2" ).removeClass( "active" );
			$( "#idButtonCollapse3" ).removeClass( "active" );
			$( "#idButtonCollapse4" ).removeClass( "active" );
			// Pone la pestaña como activa
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
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Sólo puede ingresar 4 palabras clave y separadas por un espacio'});
				return false;
			} else {
				document.getElementById("requestForm").submit();
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
			<li class="whiteTextMenu" id='idButtonCollapse2'><a href="#collapse2" data-toggle="collapse" onClick="openCollapse(2);">Modalidad de Contratación</a></li>
			<li class="whiteTextMenu" id='idButtonCollapse3'><a href="#collapse3" data-toggle="collapse" onClick="openCollapse(3);">Perfil de candidatos</a></li>
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
	<?= $this->Form->create('Company', ['class' => 'form-horizontal', 
											'id' => 'viewSearchId',
											'role' => 'form',
											'inputDefaults' =>[
													'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
													'div' => ['class' => 'form-group'],
													'class' => 'form-control',
													'before' => '<div class="col-md-12 ">',
													'between' => ' <div class="col-md-12">',
													'after' => '</div></div>',
													'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
											],
											'action' => 'specificSearchCandidateResults',
											
							]);?>
   		
			<?= $this->Form->create('busqueda_Guardada', [
								'type'=>'select',
								'label' => '',
								'onchange' => 'viewSearch()' ,
								'class' => 'form-horizontal', 
								'role' => 'form',
								'selected' => $this->Session->read('serialized_form.Administrator.busqueda_guardada'),
								'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
								'div' => ['class' => 'form-group'],
								'class' => 'form-control',
								'before' => '<div class="col-md-12 ">',
								'between' => '<div class="col-md-12">',
								'after' => '</div>',
								'options' => $busquedasGuardadas,'default'=>'0', 'empty' => 'Búsquedas guardadas'
								]);?>
				<?= $this->Form->end(); ?>
	
	<?= $this->Form->create('Company', [
						'class' => 'form-horizontal', 
						'id' => 'requestForm',
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
				<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
			        <p style="color: #588BAD">Palabras clave.</p>
			    </blockquote>
				<?= $this->Form->input('CompanyJobProfile.job_name', ['placeholder' => 'Palabras clave (60 caracteres máx.)']); ?>
					
			    <div class="col-md-12 text-center">
                	<?= $this->Form->button('Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',['type'=>'button','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px; ','onClick' => 'return submitSearch();']);?>
				</div>
			</div>
		</div>	
		
		<div id="collapse2" class="collapse">
			<div class="col-md-6 col-md-offset-3 ">
			    <div class="col-md-12">
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
				
				<div class="col-md-12" style="text-align: right;">
					<span>Agregar otro giro y área (máx. 3)</span>
					<button type="button" class="btn btn-primary btn-default btn-sm" onclick="clonarGiro();">
					  <span class="glyphicon glyphicon-plus-sign"></span>
					</button>
				</div>
					
				<?php $options = array('s' => 'Si', 'n' => 'No');
					echo $this->Form->input('StudentProspect.can_travel',['type' => 'select','default'=> 0,'empty' => 'Disponibilidad para viajar','options' => $options,'onchange' => 'desabilityMobility1()','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true']);
				?>	
				
				<div id="bloque1" style="display:none">
					<?php $options = array('1' => 'Dentro del país', '2' => 'Fuera del país');
					   echo $this->Form->input('StudentProspect.can_travel_option', ['type' => 'select','default'=> 0,'empty' => 'Donde','options' => $options,'onchange' => 'mobilityCityOption()','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true',]); 
					?>
					
					<div id="divMobilityCityOption1" >
						<?php 
							echo $this->Form->input('StudentProspect.can_travel_option', ['type' => 'select','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => "true",'id' => 'CompanyJobContractTypeMobilityCity1','label' => '','default'=>'0','empty' => 'Sin opciones']);
						?>
					</div>
				</div>
         
				<?php $options = array('s' => 'Si', 'n' => 'No');
					echo $this->Form->input('CompanyJobContractType.change_residence', ['type' => 'select','default'=> 0,'empty' => 'Disponibilidad para cambiar de residencia','options' => $options,'onchange' => 'desabilityMobility2()','data-live-search' => 'true',]);
				?>
				
				<div id="bloque3" style="display:none">													
					<?php $options = array('1' => 'Dentro del país', '2' => 'Fuera del país'); 
						echo $this->Form->input('CompanyJobContractType.change_residence_option', ['type' => 'select','default'=> 0,'empty' => 'Donde','options' => $options,'onchange' => 'mobilityCityOption2()','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true',]);	
					?>
					<div id="divMobilityCityOption2" >
						<?= $this->Form->input('CompanyJobContractType.change_residence_state', ['type' => 'select','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => "true",'placeholder' => 'País','label' => '','default'=>'0','empty' => 'Sin opciones']); ?>
					</div>
				</div>
				<div class="col-md-12 text-center">
                	<?= $this->Form->button('Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',['type'=>'button','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px; ','onClick' => 'return submitSearch();']);?>
				</div>
            </div>
		</div>				
						
		<div id="collapse3" class="collapse">
		    <div class="col-md-6 col-md-offset-3 ">
				<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
					<p style="color: #588BAD">Perfil de candidatos</p>
				</blockquote>
				<?= $this->Form->input('StudentProfile.sex', ['type'=>'select','options' => $Sexo,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Sexo']); ?>
				<?php for($i=14; $i<=99; $i++): $option[$i] = $i;endfor; ?>
				<?= $this->Form->input('Student.fecha_minima', ['type'=>'select','options' => $option,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','placeholder'=>'Edad max', 'default'=>'0', 'empty' => 'Edad mínima']); ?>
				<?= $this->Form->input('Student.fecha_maxima', ['type'=>'select','options' => $option,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','placeholder'=>'Edad min','default'=>'0', 'empty' => 'Edad máxima']); ?>

				<?php $options = array('s' => 'Si', 'n' => 'No');
					echo $this->Form->input('StudentProfile.disability', ['type' => 'select','default'=> 0,'empty' => 'Discapacidad','options' => $options,'onchange' => 'desabilityMobility()','class' => 'selectpicker show-tick form-control show-menu-arrow']);
				?>
				<div id="bloque2" style="display:none">
					<?= $this->Form->input('StudentProfile.disability_type', ['type'=>'select','options' => $TiposDiscapacidad,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Tipo de discapacidad']); ?>
				</div>
				<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
					<p style="color: #588BAD">Lugar de trabajo</p>
				</blockquote>
				<?= $this->Form->input('StudentProfile.state', ['type'=>'select','id'=>'estado','options' => $estadosMexico,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Estado / Entidad federativa']); ?>	
				<?= $this->Form->input('StudentProfile.city', ['type'=>'select','id' => 'ciudad','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Delegación / Municipio']); ?>	
				
				<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
					<p style="color: #588BAD"> Nivel académico </p>
				</blockquote>

				<?= $this->Form->input('CompanyCandidateProfile.0.academic_level_id',['type'=>'select','options' => $NivelesAcademicos,'class' => 'selectpicker show-tick form-control show-menu-arrow nivelClase','onchange' => "cargaCarreras('0','0');",'options' => $NivelesAcademicos,'default'=>'0', 'empty' => 'Nivel Académico',]);?>
				<div id="contenedorNiveles">
					<?=$this->Form->input('CompanyCandidateProfile.0.academic_situation_id', ['type'=>'select','class' => 'selectpicker show-tick form-control show-menu-arrow situacionClase','onchange' => 'academicSituation("0")','options' => $SituacionesAcademicas,'default'=>'0', 'empty' => 'Situación Académica']);?>
			   
					<div id="divSemestre0">
						<?=$this->Form->input('CompanyCandidateProfile.0.semester', ['type'=>'select','class' => 'selectpicker show-tick form-control show-menu-arrow semestresClase','onchange' => 'academicSituation("0")','options' => $Semestres,'default'=>'0', 'empty' => 'Semestre']);?>
					</div>
					<?=$this->Form->input('CompanyCandidateProfileCarreras.0.carreras', ['type'=>'select','multiple' => 'multiple','class' => 'selectpicker show-tick form-control show-menu-arrow carrerasClase','data-live-search' => "true",'data-selected-text-format' => 'count > 0','title' => 'Seleccione las Carreras / Áreas','data-actions-box' => 'true','default'=>'', 'empty' => 'Selecciona las Carreras / Áreas',]);?>	
				</div>
				
				<script languaje="javascript">
					var x = 1;
				</script> 

				<?php 
					$cont = 0;
					if(!empty($this->request->data['CompanyCandidateProfile'])):
						foreach($this->request->data['CompanyCandidateProfile'] as $k => $nivel): 
							if($cont > 0):
				?>
								<div class="divNiveles">
									<button type="button" class="btn btn-danger eliminar"  style="z-index: 100; margin-left: 725px;  "><i class="glyphicon glyphicon-trash"></i></button>
									<?= $this->Form->input('CompanyCandidateProfile.'.$cont.'.index', ['type' => 'hidden','value' => $cont,]);?>
									<?= $this->Form->input('CompanyCandidateProfile.'.$cont.'.academic_level_id', ['type'=>'select','class' => 'selectpicker show-tick form-control show-menu-arrow nivelClase','onchange' => "cargaCarreras('".$cont."','0')",'options' => $NivelesAcademicos,'default'=>'0', 'empty' => 'Nivel Académico',]); ?>
									<?=$this->Form->input('CompanyCandidateProfile.'.$cont.'.academic_situation_id', ['type'=>'select','class' => 'selectpicker show-tick form-control show-menu-arrow situacionClase','onchange' => 'academicSituation("'.$cont.'")','options' => $SituacionesAcademicas,'default'=>'0', 'empty' => 'Situación Académica']);?>
								   
									<div id="divSemestre<?php echo $cont; ?>"></div>
									<?=$this->Form->input('CompanyCandidateProfile.'.$cont.'.semester', ['type'=>'select','class' => 'selectpicker show-tick form-control show-menu-arrow semestresClase','onchange' => 'academicSituation("'.$cont.'")','options' => $Semestres,'default'=>'0', 'empty' => 'Semestre']);?>
								</div>
								<?=$this->Form->input('CompanyCandidateProfileCarreras.'.$cont.'.carreras', ['type'=>'select','multiple' => 'multiple','class' => 'selectpicker show-tick form-control show-menu-arrow carrerasClase','data-live-search' => "true",'data-selected-text-format' => 'count > 0','title' => 'Seleccione las Carreras / Áreas','data-actions-box' => 'true','default'=>'', 'empty' => 'Selecciona las Carreras / Áreas',]);?>

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

				
				<div class="col-md-12" style="text-align: right;">
					<span>Agregar otro Nivel (máx. 3)</span>
					<button type="button" class="btn btn-primary btn-default btn-sm" id="agregarNivel">
					  <span class="glyphicon glyphicon-plus-sign"></span>
					</button>
				</div>	
				
				<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
				   <p style="color: #588BAD">Promedio</p>
				</blockquote>
				
				<?= $this->Form->input('StudentProfessionalProfile.average_id', ['type'=>'select','options' => $Promedios,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Promedio']); ?>
				<?= $this->Form->input('StudentProfessionalProfile.decimal_average_id', ['type'=>'select','options' => $Decimales,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Decimas']); ?>
                <div class="col-md-12 text-center">
                	<?= $this->Form->button('Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',['type'=>'button','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px; ','onClick' => 'return submitSearch();']);?>
				</div>
			</div>		
	    </div>
		
		<div id="collapse4" class="collapse">
			<div class="col-md-6 col-md-offset-3 ">
				<div id="contenedorIdiomas">	
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
						   <?= $this->Form->input('StudentLenguage.0.language_id', ['type'=>'select','options' => $Lenguages,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Idioma']); ?>
						   <?= $this->Form->input('StudentLenguage.0.reading_level', ['type'=>'select','options' => $NivelesIdioma,'class' => 'form-control selectpicker show-tick show-menu-arrow','required' => false,'label' => ['class' => 'col-md-2 control-label','text' => ''],'default'=>'0', 'empty' => 'Lectura']);	?>
						   <?= $this->Form->input('StudentLenguage.0.writing_level',['type'=>'select','required' => false,'class' => 'form-control selectpicker show-tick show-menu-arrow','label' => ['class' => 'col-md-2 control-label','text' => ''],'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Escritura']); ?>
						   <?= $this->Form->input('StudentLenguage.0.conversation_level',['type'=>'select','required' => false,'class' => 'form-control selectpicker show-tick show-menu-arrow','label' => ['class' => 'col-md-2 control-label','text' => ''],'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Conversación']); ?>
						</div>		
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
						<?= $this->Form->input('StudentLenguage.'.$cont.'.language_id', ['type'=>'select','required' => false,'class' => 'form-control selectpicker show-tick show-menu-arrow','data-live-search' => 'true','label' => '','options' => $Lenguages,'default'=>'0', 'empty' => 'Idioma']);?>
						<?= $this->Form->input('StudentLenguage.'.$cont.'.reading_level', ['type'=>'select','required' => false,'style' => 'margin-left: -3px;','class' => 'form-control selectpicker show-tick show-menu-arrow','label' => ['text' => ''],'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Lectura']);?>
						<?= $this->Form->input('StudentLenguage.'.$cont.'.writing_level', [ 'type'=>'select','style' => 'margin-right: 3px; margin-left: 36px;','required' => false,'class' => 'form-control selectpicker show-tick show-menu-arrow','label' => ['text' => ''],'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Ecritura']);?>
						<?= $this->Form->input('StudentLenguage.'.$cont.'.conversation_level', ['type'=>'select','style' => 'margin-right: 3px; margin-left: 36px;','required' => false,'class' => 'form-control','label' => ['style' => 'margin-left: 0px; padding-left: 52px;','text' => ''],'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Conversación']);?>
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
					
				<div class="col-md-12" style="text-align: right; ">
					<span>Agregar otro idioma (máx. 3)</span>
					<button type="button" class="btn btn-primary btn-default btn-sm" id="agregarIdioma">
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
					
						<button type="button" class="btn btn-danger eliminar" style="text-align: right;"><i class="glyphicon glyphicon-trash"></i></button>
					
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
				<div class="col-md-12" style="text-align: right; margin-bottom:30px;">
				   <span>Agregar otro cómputo (máx. 3)</span>
				   <button type="button" class="btn btn-primary btn-default btn-sm" id="agregarComputo">
				   <span class="glyphicon glyphicon-plus-sign"></span>
				   </button>
				</div>

				<?=$this->Form->input('StudentJobSkill.name', ['maxlength' => '316','type' => 'textarea','required' => false,'label' => '','style' => 'resize: vertical; min-height: 120px;  max-height: 120px; height: 120px;margin-left: 4px;','placeholder' => 'Certificaciones',]);?>
				
				<div class="col-md-12" style="text-align: right;padding-right: 0px;">
					<span id="contadorTaComentario">0/316</span><span> caracteres máx.</span>
				
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
		
		
		<div class="col-md-2">
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
		
		<div class="col-md-5" style="margin-top: 5px;">
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
							