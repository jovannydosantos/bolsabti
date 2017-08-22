<script type="text/javascript">
	
	function clonarGiro(){
		var numGiros = $(".maxGiros");
		if(numGiros.length >= 2){		
			$.alert({ title: '!Aviso!',type: 'blue',content: 'Sólo puedes agregar hasta 2 giros'});	
			return false;
		} else if (	(document.getElementById("CompanyJobProfileDynamicGiro0Giro").value.length === 0) && (document.getElementById("CompanyJobProfileDynamicArea0AreaInteres").value.length === 0)){
			$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese al menos un valor antes de agregar otro giro'});	
			return false;
		} else {
			$(".contenedorClonesGiros").append(
				'<div id="IdClonGiro'+cont2+'" class="clonGiro'+cont2+' clonGiroIndependiente">'+
				'<div class="form-group"><label for="CompanyJobProfileDynamicGiro'+cont2+'Giro" class="col-md-12 control-label"></label><div class="col-md-12"><select name="data[CompanyJobProfileDynamicGiro]['+cont2+'][giro]" class="form-control clonGiroInteres'+cont2+' clonGiroReindexa selectpicker show-tick show-menu-arrow" data-live-search="true" onchange="cargaAreas('+cont2+')" id="CompanyJobProfileDynamicGiro'+cont2+'Giro">'+
				'</select></div></div><div class="form-group"><label for="CompanyJobProfileDynamicArea'+cont2+'AreaInteres" class="col-md-12 control-label"></label><div class="col-md-12"><select name="data[CompanyJobProfileDynamicArea]['+cont2+'][area_interes]" class="form-control clonAreaReindexa selectpicker show-tick show-menu-arrow" data-live-search="true" id="CompanyJobProfileDynamicArea'+cont2+'AreaInteres">'+
				'<option value="">Áreas de interés</option></select></div></div>'+
				'<button class="btn btn-danger btn-sm maxGiros" onclick="eliminarClonGiro('+cont2+');" type="button"><i class="glyphicon glyphicon-trash"></i></button></div>');
			
			$('.clonGiroInteres').empty();
			$('#CompanyJobProfileDynamicGiro0Giro').find('option').clone().appendTo('.clonGiroInteres'+cont2);
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
			$.alert({ title: '!Aviso!',type: 'blue',content: 'Sólo puedes agregar hasta 3 formaciones académicas'});
			return false;
		} else if (	(document.getElementById("CompanyCandidateProfileDynamicNivelAcademico0AcademicLevel").value.length === 0) && 
					(document.getElementById("CompanyJobRelatedCareerDynamicCarrera0CareerId").value.length === 0) && 
					(document.getElementById("CompanyCandidateProfileDynamicSituacionAcademica0AcademicSituation").value.length === 0)){
			$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese al menos un valor antes de agregar otra formación académica'});
			return false;
		} else {
			$(".contenedorClonesFormacionAcademica").append(
				'<div id="IdClonFormacionAcademica'+cont3+'" class="clonFormcionAcademica'+cont3+' clonFormcionAcademicaIndependiente">'+
				'<div class="form-group"><label for="CompanyCandidateProfileDynamicNivelAcademico'+cont3+'AcademicLevel" class="col-md-12 control-label"></label><div class="col-md-12">'+
				'<select name="data[CompanyCandidateProfileDynamicNivelAcademico]['+cont3+'][academic_level]" class="selectpicker show-tick form-control show-menu-arrow clonNivelAcademico'+cont3+' clonNivelAcademicoReindexa" data-live-search="true" onchange="changeAcademicLevel('+cont3+');" id="CompanyCandidateProfileDynamicNivelAcademico'+cont3+'AcademicLevel">'+
				'</select></div></div>'+

				'<div id="divCarrerasId'+cont3+'" style="display: none">'+
				'<div class="form-group"><label for="CompanyJobRelatedCareerDynamicCarrera'+cont3+'CareerId" class="col-md-12 control-label"></label><div class="col-md-12">'+
				'<select id="CompanyJobRelatedCareerDynamicCarrera'+cont3+'CareerId" name="data[CompanyJobRelatedCareerDynamicCarrera]['+cont3+'][career_id]" class="selectpicker show-tick form-control show-menu-arrow clonCarrera'+cont3+' clonCarreraReindexa" data-live-search="true">'+
				'</select></div></div></div>'+

				'<div id="divAreasId'+cont3+'" style="display: none">'+
				'<div class="form-group"><label for="CompanyJobRelatedAreaDynamicArea'+cont3+'AreaId" class="col-md-12 control-label"></label><div class="col-md-12">'+
				'<select id="CompanyJobRelatedAreaDynamicArea'+cont3+'AreaId" name="data[CompanyJobRelatedAreaDynamicArea]['+cont3+'][area_id]" class="selectpicker show-tick form-control show-menu-arrow clonArea'+cont3+' clonAreaReindexa" data-live-search="true">'+
				'</select></div></div></div>'+
				
				'<div class="form-group"><label for="CompanyCandidateProfileDynamicSituacionAcademica'+cont3+'AcademicSituation" class="col-md-12 control-label"></label><div class="col-md-12">'+
				'<select id="CompanyCandidateProfileDynamicSituacionAcademica'+cont3+'AcademicSituation" name="data[CompanyCandidateProfileDynamicSituacionAcademica]['+cont3+'][academic_situation]" class="selectpicker show-tick form-control show-menu-arrow clonSituacionAcademica'+cont3+' clonSituacionAcademicaReindexa" data-live-search="true">'+
				'<option value="">Situación académica</option>'+
				'</select></div>'+
			'</div>'+
			'<button class="btn btn-danger btn-sm maxFormaciones" onclick="eliminarClonFormacionAcademica('+cont3+'); " type="button"><i class="glyphicon glyphicon-trash"></i></button>'
			);

			$('#CompanyCandidateProfileDynamicNivelAcademico0AcademicLevel').find('option').clone().appendTo('.clonNivelAcademico'+cont3);
			$('#CompanyJobRelatedCareerDynamicCarrera0CareerId').find('option').clone().appendTo('.clonCarrera'+cont3);
			$('#CompanyJobRelatedAreaDynamicArea0AreaId').find('option').clone().appendTo('.clonArea'+cont3);
			document.getElementById('CompanyCandidateProfileDynamicNivelAcademico'+cont3+'AcademicLevel').options[0].selected = 'selected';	
			$('.selectpicker').selectpicker('refresh');
			cont3++;
		}
	}
	
	function eliminarClonFormacionAcademica(num){
		$( '.clonFormcionAcademica'+num ).remove();
	}

	function clonarLenguaje(){
		var numIdiomas = $(".maxIdiomas");
		if(numIdiomas.length >= 3){	
			$.alert({ title: '!Aviso!',type: 'blue',content: 'Sólo puedes agregar hasta 3 idiomas'});		
			return false;
		} else if (document.getElementById("CompanyJobLanguage0LanguageId").value.length === 0){
			$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione un valor para idioma antes de agregar otro'});
			return false;
		} else {
			$(".contenedorClonesLanguages").append(
			'<div id="IdClonLanguage'+cont+'" class="clonLanguage'+cont+' clonLanguageIndependiente">'+
			'<div class="form-group"><label for="CompanyJobLanguage'+cont+'LanguageId" class="col-md-12 control-label"></label><div class="col-md-12">'+
			'<select name="data[CompanyJobLanguage]['+cont+'][language_id]" class="selectpicker show-tick form-control show-menu-arrow selectClonLanguage'+cont+' clonLanguageReindexa" data-live-search="true" id="CompanyJobLanguage'+cont+'LanguageId"></select>'+
			'</div></div><div class="form-group"><label for="CompanyJobLanguage'+cont+'Level" class="col-md-12 control-label"></label><div class="col-md-12">'+
			'<select name="data[CompanyJobLanguage]['+cont+'][level]" class="selectpicker show-tick form-control show-menu-arrow selectClonLevelLanguage'+cont+' clonLevelLanguageReindexa" data-live-search="true" id="CompanyJobLanguage'+cont+'Level"></select></div>'+	
			'</div></div>'+
			'<button class="btn btn-danger btn-sm maxIdiomas" onclick="eliminarClonLanguage('+cont+'); " type="button"><i class="glyphicon glyphicon-trash"></i></button>'
			);
			$('.selectClonLanguage').empty();
			$('.selectClonLevelLanguage').empty();
			
			$('#CompanyJobLanguage0LanguageId').find('option').clone().appendTo('.selectClonLanguage'+cont);
			$('#CompanyJobLanguage0Level').find('option').clone().appendTo('.selectClonLevelLanguage'+cont);
			$('.selectpicker').selectpicker('refresh');
			cont++;
		}
	}
	
	function eliminarClonLanguage(num){
		$( '.clonLanguage'+num ).remove();
	}
	
	function clonarComputo(){
			var numComputos = $(".maxComputos");
			if(numComputos.length >= 3){	
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Sólo puedes agregar hasta 3 conocimientos de cómputo'});		
				return false;
			} else if (document.getElementById("CompanyJobComputingSkill0Name").value.length === 0){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese un valor para cómputo antes de agregar otro'});
				return false;
			} else {
				$(".contenedorClonesComputo").append(
					'<div id="IdClonComputo'+cont4+'" class="clonComputo'+cont4+' clonComputoIndependiente">'+
					'<div class="form-group"><label for="CompanyJobComputingSkill'+cont4+'Name" class="col-md-12 control-label"></label><div class="col-md-12">'+
					'<input name="data[CompanyJobComputingSkill]['+cont4+'][name]" class="form-control" placeholder="Cómputo" maxlength="64" type="text" id="CompanyJobComputingSkill'+cont4+'Name"/></div></div>'+
					'<div class="form-group"><label for="CompanyJobComputingSkill'+cont4+'Level" class="col-md-12 control-label"></label><div class="col-md-12">'+
					'<select name="data[CompanyJobComputingSkill]['+cont4+'][level]" class="selectpicker show-tick form-control show-menu-arrow selectClonComputoLevel'+cont4+'" data-live-search="true" id="CompanyJobComputingSkill'+cont4+'Level">'+
					'</select></div></div>'+
					'<button class="btn btn-danger btn-sm maxComputos" onclick="eliminarClonComputo('+cont4+'); " type="button"><i class="glyphicon glyphicon-trash"></i></button>'
				);
				$('.selectClonComputoLevel').empty();
				
				$('#CompanyJobComputingSkill0Level').find('option').clone().appendTo('.selectClonComputoLevel'+cont4);
				$('.selectpicker').selectpicker('refresh');
				cont4++;
			}
	}
	
	function eliminarClonComputo(num){
		$( '.clonComputo'+num ).remove();
	}

	function viewSearch(){
		 selectedIndex = document.getElementById("StudentBusquedaGuardada").selectedIndex;
		 if(selectedIndex == 0){
			return false;
		 } else {
			document.getElementById("viewSearchId").submit();
		 }
	}

	function viewSearchResults(val){
		$("#StudentBusquedaGuardada").find('option:selected').attr('selected', false);
		$("#StudentBusquedaGuardada option:contains(" + val + ")").attr('selected', 'selected');
		 selectedIndex = document.getElementById("StudentBusquedaGuardada").selectedIndex;
		 if(selectedIndex == 0){
			return false;
		 } else {
			document.getElementById("viewSearchId").submit();
		 }
	}

	function changeAcademicLevel(index)	{
			academicLevelSelectedIndex = $("#CompanyCandidateProfileDynamicNivelAcademico"+index+"AcademicLevel").val();
			$('#CompanyCandidateProfileDynamicSituacionAcademica'+index+'AcademicSituation option').remove();
			$('#CompanyCandidateProfileDynamicSituacionAcademica'+index+'AcademicSituation').append(new Option('Situación académica', ''));
			$('#CompanyCandidateProfileDynamicSituacionAcademica'+index+'AcademicSituation').append(new Option('Estudiante', '1'));
			$('#CompanyCandidateProfileDynamicSituacionAcademica'+index+'AcademicSituation').append(new Option('Egresado', '2'));
			
			if (academicLevelSelectedIndex==''){
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
				if ( $('#CompanyJobRelatedAreaDynamicArea'+index+'AreaId').length ) {
					document.getElementById('CompanyJobRelatedAreaDynamicArea'+index+'AreaId').options[0].selected = 'selected';}		
				$('#divAreasId'+index).hide();
			} else
				if (academicLevelSelectedIndex==''){
					if ( $('#CompanyJobRelatedCareerDynamicCarrera'+index+'CareerId').length ) {
						document.getElementById('CompanyJobRelatedCareerDynamicCarrera'+index+'CareerId').options[0].selected = 'selected';}
					if ( $('#CompanyJobRelatedAreaDynamicArea'+index+'AreaId').length ) {
						document.getElementById('CompanyJobRelatedAreaDynamicArea'+index+'AreaId').options[0].selected = 'selected';}		

					$('#divCarrerasId'+index).hide();
					$('#divAreasId'+index).hide();
				} else {
					
					if ( $('#CompanyJobRelatedCareerDynamicCarrera'+index+'CareerId').length ) {
						document.getElementById('CompanyJobRelatedCareerDynamicCarrera'+index+'CareerId').options[0].selected = 'selected';}
					if ( $('#CompanyJobRelatedAreaDynamicArea'+index+'AreaId').length ) {
						document.getElementById('CompanyJobRelatedAreaDynamicArea'+index+'AreaId').options[0].selected = 'selected';}							
					
					$('#divCarrerasId'+index).hide();
					$('#divAreasId'+index).show();
				}
			$('.selectpicker').selectpicker('refresh');	 
	}

	function addNameSearch(){
		$.confirm({
			    title: 'Búsquedas!',
			    theme: 'supervan',
			    content: '' +
			    '<form action="" class="formName">' +
			    '<div class="form-group">' +
			    '<label>Guardar búsqueda</label>' +
			    '<input type="text" placeholder="Nombre de la búsqueda" class="nameBusqueda form-control" required />' +
			    '</div>' +
			    '</form>',
			    buttons: {
			        formSubmit: {
			            text: 'Guardar',
			            btnClass: 'btn-blue',
			            action: function () {
			                var name = this.$content.find('.nameBusqueda').val();
			                if(!name){
			                    $.alert('Ingrese nombre a la búsqueda');
			                    return false;
			                }else{
								var response = checkAlInputs();
								if(response){
									document.getElementById("StudentSavedSearchName").value = name;
									document.getElementById("requestForm").submit();
								} else {
									document.getElementById("StudentSavedSearchName").value = '';
								}
			                }
			            }
			        },
			        cancel: function () {
			            text: 'Cancelar'
			        },
			    },
			    onContentReady: function () {
			        // bind to events
			        var jc = this;
			        this.$content.find('form').on('submit', function (e) {
			            e.preventDefault();
			            jc.$$formSubmit.trigger('click'); // reference the button and click it
			        });
			    }
			});
	}

	function addName(){
		$.confirm({
			    title: 'Búsquedas!',
			    theme: 'supervan',
			    content: '' +
			    '<form action="" class="formName">' +
			    '<div class="form-group">' +
			    '<label>Guardar búsqueda</label>' +
			    '<input type="text" placeholder="Nombre de la búsqueda" class="nameBusqueda form-control" required />' +
			    '</div>' +
			    '</form>',
			    buttons: {
			        formSubmit: {
			            text: 'Guardar',
			            btnClass: 'btn-blue',
			            action: function () {
			                var name = this.$content.find('.nameBusqueda').val();
			                if(!name){
			                    $.alert('Ingrese nombre a la búsqueda');
			                    return false;
			                }else{
								var response = checkAlInputs();
								if(response){
									document.getElementById("StudentSavedSearchName").value = name;
									document.getElementById("idFormGuardarBusqueda").submit();
								} else {
									document.getElementById("StudentSavedSearchName").value = '';
									return false;
								}
			                }
			            }
			        },
			        cancel: {
			        	 text: 'Cancelar'
			            //close
			        },
			    },
			    onContentReady: function () {
			        // bind to events
			        var jc = this;
			        this.$content.find('form').on('submit', function (e) {
			            e.preventDefault();
			            jc.$$formSubmit.trigger('click'); // reference the button and click it
			        });
			    }
			});
	}

	function checkAlInputs(){
		var palabrasClave = document.getElementById("CompanyJobProfileJobName").value;
		textoAreaDividido = palabrasClave.split(" ");
		numeroPalabras = textoAreaDividido.length;
					
		if((document.getElementById("CompanyJobProfileJobName").value != '') && (numeroPalabras>4)){
			$.alert({ title: '!Aviso!',type: 'red',content: 'Sólo puede ingresar 4 palabras clave separadas por un espacio'});
			return false;
		} else {
			return true;
		}
	}

</script>