<?php 
	$this->layout = 'company'; 
?>
	
	<script>
	
		$(document).ready(function(){

			<?php if(isset($this->request->data['CompanyJobOfferCompetency']) and (!empty($this->request->data['CompanyJobOfferCompetency']))): ?> 
				<?php 
					foreach($this->request->data['CompanyJobOfferCompetency'] as $k => $Competencia):	
				?>;	
				$( "#CompanyJobOfferCompetency"+<?php echo $Competencia['competency_id'] ?>+"CompetencyId" ).prop( "checked", true );
				<?php 
					endforeach;
				?>;
			<?php endif; ?>
			
			$("#agregarNivel").click(function(e) {
				
				var string = 
						'<div class="divNiveles">'+
							
							'<button type="button" class="btn btn-danger eliminar" style="z-index: 100; margin-left: 725px;"><i class="glyphicon glyphicon-trash"></i></button>'+
							'<input id="CompanyCandidateProfile'+x+'Index" class="form-control" name="data[CompanyCandidateProfile]['+x+'][index]" value="'+x+'" type="hidden">'+
							'<div class="form-group row"><div class="col-md-10 "><img id="" class="img-circle cambia" data-toggle="tooltip" data-placement="top" title="" alt="help.png" src="/unam/img/help.png" data-original-title="Grado de estudios que debe tener el candidato para cumplir con el perfil de la oferta."><label class="col-md-4 control-label " for="CompanyCandidateProfile'+x+'AcademicLevelId"><span style="color:red;">*</span>Nivel académico:</label>'+
							'<div class="col-md-6"><select id="CompanyCandidateProfile'+x+'AcademicLevelId" class="selectpicker show-tick form-control show-menu-arrow nivelPerfil'+x+' nivelClase" onchange="cargaCarreras('+x+',0);" name="data[CompanyCandidateProfile]['+x+'][academic_level_id]" >'+
							
							'</select></div></div></div>'+
							
							'<div class="form-group row"><div class="col-md-10 "><img id="" class="img-circle cambia" data-toggle="tooltip" data-placement="top" title="" alt="help.png" src="/unam/img/help.png" data-original-title="Situación académica requerida para cumplir con el perfil de la oferta."><label class="col-md-4 control-label " for="CompanyCandidateProfile'+x+'AcademicSituationId"><span style="color:red;">*</span>Situación académica:</label>'+
							'<div class="col-md-6"><select id="CompanyCandidateProfile'+x+'AcademicSituationId" class="selectpicker show-tick form-control show-menu-arrow situacionPerfil'+x+' situacionClase" name="data[CompanyCandidateProfile]['+x+'][academic_situation_id]" onchange="academicSituation('+x+')">'+
								'<option value="">Selecciona una opción</option>'+
							'</select></div></div></div>'+
							
							'<div id="divSemestre'+x+'" style="display: none;">'+
								'<div class="form-group row"><div class="col-md-10 "><label class="col-md-4 control-label " for="CompanyCandidateProfile0Semester"><span style="color:red;">*</span>Semestre:</label>'+
								'<div class="col-md-6"><select id="CompanyCandidateProfile'+x+'Semester" class="selectpicker show-tick form-control show-menu-arrow semestrePerfil'+x+' semestresClase" name="data[CompanyCandidateProfile]['+x+'][semester]" onchange="academicSituation('+x+')">'+
								
								'</select></div></div></div>'+
							'</div>'+
							
							'<div class="form-group row" style="margin-top: 0px;"><div class="col-md-10 "><label class="col-md-4 control-label " for="CompanyCandidateProfileCarreras0Carreras"><span style="color:red;">*</span>Carreras / Áreas:</label>'+
							'<div class="col-md-6"><select id="CompanyCandidateProfileCarreras'+x+'Carreras" class="selectpicker show-tick form-control show-menu-arrow carrerasClase" name="data[CompanyCandidateProfileCarreras]['+x+'][carreras][]" multiple="multiple" data-live-search="true" data-selected-text-format="count > 0" title="Seleccione las Carreras / Áreas" data-actions-box="true" placeholder="Prestaciones y apoyos" >'+
							
							'</select></div></div></div>'+
							
						'</div>	';	

				$("#contenedorNiveles").append(string); 
				$('#CompanyCandidateProfile0AcademicLevelId').find('option').clone().appendTo('.nivelPerfil'+x);
				document.getElementById('CompanyCandidateProfile'+x+'AcademicLevelId').options[0].selected = 'selected';
				$('#CompanyCandidateProfile0Semester').find('option').clone().appendTo('.semestrePerfil'+x);
				document.getElementById('CompanyCandidateProfile'+x+'Semester').options[0].selected = 'selected';
				
				$('.selectpicker').selectpicker('refresh');
				
				x++;
				$('[data-toggle="tooltip"]').tooltip();
				$(".img-circle").hover(function() {
					$(this).attr("src","http://bolsa.trabajo.unam.mx/unam/app/webroot/img/help_yellow.png");
						}, function() {
					$(this).attr("src","http://bolsa.trabajo.unam.mx/unam/app/webroot/img/help.png");
				});
				return false;
			});
			
			var mensaje = "\u00BFSeguro que desea eliminar este bloque?";
			$("body").on("click", ".eliminar", function(e) {
				var respuesta = confirm(mensaje);
				if (respuesta === true){
					$(this).parent('div').remove();
					$(this).parent('div').remove();
				}
				return false;
			});
		
			checkCompetencies();
			academicSituation('0');
			cargaCarreras('0','1')
			
		});
		
		// Obtener las Escuelas/Facultades dependiendo del nivel
		function cargaCarreras(index, request){

			if($("#CompanyCandidateProfile"+index+"AcademicLevelId").val() != 0)
				{
				$('#loading').show();
				
				$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpCarreras.php',{escuela: '', level: $("#CompanyCandidateProfile"+index+"AcademicLevelId").find(":selected").index() },function(JSON){
					
					$('#CompanyCandidateProfileCarreras'+index+'Carreras').empty();
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});
					
					$.each(JSON, function(key, val){
						$('#CompanyCandidateProfileCarreras'+index+'Carreras').append('<option value="' + val.id + '">' + val.carrera + '</option>');
						
							if (--waitCount == 0) {
								
								if(request==1){
									// Selecciona las Carreras/Áreas correspondientes
									<?php if(isset($this->request->data['CompanyCandidateProfile']) and (!empty($this->request->data['CompanyCandidateProfile']))){ ?>
										var totalNiveles = <?php echo count($this->request->data['CompanyCandidateProfile']); ?>;
									<?php } else { ?> 
										var totalNiveles = 0;
									<?php } ?> 
										
									if(totalNiveles>0){
										var selecciones = new Array();
										var cont = 0;
										<?php 
											foreach($this->request->data['CompanyCandidateProfile'] as $k => $Perfiles): 
										?>	
											if(cont == index){ //Recorre el arreglo pero solo ingresará en el de la posción de l index
												
												var indexArray = 0;
											
												<?php 
													foreach($Perfiles['CompanyJobRelatedCareer'] as $k => $carrerasPerfil): 
												?>	
														selecciones[indexArray] = <?php echo $carrerasPerfil['career_id'] ?>;
														indexArray++;
												<?php 
													endforeach;
												?>
													// Selecciona las Carreras/Áreas para el nivel
													$("#CompanyCandidateProfileCarreras"+index+"Carreras option").each(function () {
													
														for( c = 0; c < indexArray; c++ ){
															if($(this).val() == selecciones[c]){
																$('#CompanyCandidateProfileCarreras'+index+'Carreras option[value='+$(this).val()+']').attr('selected','selected');
															}
														}
													});
											}
											cont++;
										<?php 		
											endforeach;
										?>
										remove(index);
									}
								}else{	
									$('#CompanyCandidateProfile'+index+'AcademicSituationId option').remove();
									$('#CompanyCandidateProfile'+index+'AcademicSituationId').append(new Option('Seleccione una opción', ''));
									$('#CompanyCandidateProfile'+index+'AcademicSituationId').append(new Option('Estudiante', '1'));
									$('#CompanyCandidateProfile'+index+'AcademicSituationId').append(new Option('Egresado', '2'));
									$('#CompanyCandidateProfile'+index+'AcademicSituationId').append(new Option('Titulado', '3'));
									$('#CompanyCandidateProfile'+index+'AcademicSituationId').append(new Option('Con diploma', '4'));
									$('#CompanyCandidateProfile'+index+'AcademicSituationId').append(new Option('Con grado', '5'));
									remove(index);
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
					remove(index);
					academicSituation(index);
					$('#CompanyCandidateProfileCarreras'+index+'Carreras').empty();
					$('#CompanyCandidateProfileCarreras'+index+'Carreras').append('<option value="">Seleccione las Carreras / Áreas</option>');
					$('.selectpicker').selectpicker('refresh');
				}
		}
			
		function remove(index){
			var academicLevelSelectedIndex = document.getElementById("CompanyCandidateProfile"+index+"AcademicLevelId").selectedIndex;

			if (academicLevelSelectedIndex==0){
				$('#CompanyCandidateProfile'+index+'AcademicSituationId option').remove();
				$('#CompanyCandidateProfile'+index+'AcademicSituationId').append(new Option('Seleccione una opción', ''));
			}else if (academicLevelSelectedIndex==1){
				$("#CompanyCandidateProfile"+index+"AcademicSituationId option[value='4']").remove();
				$("#CompanyCandidateProfile"+index+"AcademicSituationId option[value='5']").remove();
			}else if (academicLevelSelectedIndex==2){
				$("#CompanyCandidateProfile"+index+"AcademicSituationId option[value='3']").remove();
				$("#CompanyCandidateProfile"+index+"AcademicSituationId option[value='5']").remove();
			} else if((academicLevelSelectedIndex==3) || (academicLevelSelectedIndex==4)){
				$("#CompanyCandidateProfile"+index+"AcademicSituationId option[value='3']").remove();
				$("#CompanyCandidateProfile"+index+"AcademicSituationId option[value='4']").remove();
			}
			$('.selectpicker').selectpicker('refresh');
		}
		
		function checkCompetencies(indexClass){
			var $marcados =$("#competenciasContentId input:checked");
		
			if ($marcados.length > 7){
				jAlert('Le recordamos que tiene un número limitado de opciones.', 'Mensaje');
				$("."+indexClass).attr('checked', false);
			} else{
				$( ".numeroCompetencias" ).empty();
				$( ".numeroCompetencias" ).append( $marcados.length);
			}
		}
		
		function competencias(){
			$('#myModal').modal('show');
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
		
		function validateInputs(){
			var nivelIncompleto = 0;
			var situacionIncompleto = 0;
			var carrerasIncompleto = 0;
			var semestresIncompleto = 0;
			
			// Niveles académicos
			var values = new Object(); // creates a new instance of an object
			$('.nivelClase').each(function() {		
				if($(this).attr('id')!=undefined){
					values[$(this).attr('id')] = $(this).val();
				}
			});
			
			for (property in values) {
				if( values[property] == ''){
					nivelIncompleto = 1;
				}
			}
			
			//Situaciones académicas
			var cont = 0;
			var bloquesSemestres = new Object();
			var values = new Object(); // creates a new instance of an object
			$('.situacionClase').each(function() {		
				if($(this).attr('id')!=undefined){
					values[$(this).attr('id')] = $(this).val();
					if($(this).val()==1){
						contSemestres = 1; 	// Indicamos que existen semestres por seleccionar
						bloquesSemestres[cont] = 1;
					}else{
						bloquesSemestres[cont] = 0;
					}
					cont++;
				}
			});
			
			for (property in values) {
				if( values[property] == ''){
					situacionIncompleto = 1;
				}
			}
			
			// Carreras/Áreas
			var values = new Object(); // creates a new instance of an object
			$('.carrerasClase').each(function() {		
				if($(this).attr('id')!=undefined){
					values[$(this).attr('id')] = $(this).attr('id');
				}
			});
			
			for (property in values) {
				var carrerasSeleccionadas = $('#'+values[property]+' > option:selected');
				if( carrerasSeleccionadas.length == 0){
					carrerasIncompleto = 1;
				}
			}
			
			if(contSemestres>0){
				// Semestres
				var cont = 0;
				var values = new Object(); // creates a new instance of an object
				$('.semestresClase').each(function() {		
					if($(this).attr('id')!=undefined){
						values[$(this).attr('id')] = $(this).val();
					}
				});
				console.log(bloquesSemestres);
				for (property in values) {
					if(bloquesSemestres[cont]==1){
						if( values[property] == ''){
							semestresIncompleto = 1;
						}
					}
					cont++;
				}
			}
			
			if(nivelIncompleto==1){
				jAlert('Existen niveles académicos vacios, verifique.');
				return false;
			}else if(situacionIncompleto==1){
				jAlert('Existen situaciones académicas vacias, verifique.');
				return false;
			}else if(carrerasIncompleto==1){
				jAlert('Existen Carreras/Áreas vacias, verifique.');
				return false;
			}else if(semestresIncompleto==1){
				jAlert('Existen semestres vacios, verifique.');
				return false;
			}else{
				return true;
			}

		}
		
	</script>
	
	<style> 

		.titulos{
			color: #fff; 
			margin-left: 15px;
			margin-right: 20px;
		}
		
		.checkbox label {
			color: #fff;
		}

		p {
			font-size: 14px;
		}
	
	</style>
	
	
	<?php echo $this->Session->flash(); ?>	
		
	<?php 
		echo $this->Html->link(	'<i class="glyphicon glyphicon-arrow-left"></i> &nbsp; Regresar',
												array(
														'controller'=>'Companies',
														'action'=>'companyJobContractType',
														),
												array(
														'class' => 'btn btn-default btnBlue ',
														'style' => 'width: 120px; border-bottom-width: 0px; margin-bottom: 15px;',
														'escape' => false,
														)	
							); 
	?>	
	
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
								'action' => 'CompanyCandidateProfile',
								'onsubmit' =>'return validateInputs();'
		)); 
	?>

	<fieldset>
	<div id="contenedorNiveles">
		
		<?php 		echo $this->Form->input('CompanyCandidateProfile.0.index', array(
													'type' => 'hidden',
													'value' => 0,
											));
		?>

		<?php  
				echo $this->Form->input('CompanyCandidateProfile.0.academic_level_id', array(
						'type'=>'select',
						'before' => '<div class="col-md-10 "><img data-toggle="tooltip" id="" data-placement="top" title="Grado de estudios que debe tener el candidato para cumplir con el perfil de la oferta." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
						'class' => 'selectpicker show-tick form-control show-menu-arrow nivelClase',
						'onchange' => "cargaCarreras('0','0');",
						'label' => array(
							'class' => 'col-md-4 control-label ',
							'text' => '<span style="color:red;">*</span>Nivel académico:',),
						'options' => $NivelesAcademicos,'default'=>'0', 'empty' => 'Selecciona una opción',
						));
	   ?>
		
		<?php 
				echo $this->Form->input('CompanyCandidateProfile.0.academic_situation_id', array(
						'type'=>'select',
						'before' => '<div class="col-md-10 "><img data-toggle="tooltip" id="" data-placement="top" title="Situación académica requerida para cumplir con el perfil de la oferta." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
						'class' => 'selectpicker show-tick form-control show-menu-arrow situacionClase',
						'label' => array(
							'class' => 'col-md-4 control-label ',
							'text' => '<span style="color:red;">*</span>Situación académica:',),
						'onchange' => 'academicSituation("0")',
						'options' => $SituacionesAcademicas,'default'=>'0', 'empty' => 'Selecciona una opción'
				));
	   ?>
	   
	   <div id="divSemestre0">
			<?php 	
				echo $this->Form->input('CompanyCandidateProfile.0.semester', array(
						'type'=>'select',
						'before' => '<div class="col-md-10 ">',
						'class' => 'selectpicker show-tick form-control show-menu-arrow semestresClase',
						'label' => array(
									'class' => 'col-md-4 control-label ',
									'text' => '<span style="color:red;">*</span>Semestre:',),
						'onchange' => 'academicSituation("0")',
						'options' => $Semestres,'default'=>'0', 'empty' => 'Selecciona una opción'
				));	
			?>
		</div>
		
		<?php 	
				echo $this->Form->input('CompanyCandidateProfileCarreras.0.carreras', array(	
						'before' => '<div class="col-md-10 ">',
						'type'=>'select',
						'multiple' => 'multiple',
						'class' => 'selectpicker show-tick form-control show-menu-arrow carrerasClase',
						'data-live-search' => "true",
						'data-selected-text-format' => 'count > 0',
						'title' => 'Seleccione las Carreras / Áreas',
						'data-actions-box' => 'true',
						'label' => array(
									'class' => 'col-md-4 control-label ',
									'text' => '<span style="color:red;">*</span>Carreras / Áreas:',),
						'placeholder' => 'Prestaciones y apoyos',
						'default'=>'', 'empty' => 'Selecciona las Carreras / Áreas',
				)); 
		?>	
		
		
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
						<button type="button" class="btn btn-danger eliminar"  style="z-index: 100; margin-left: 725px;"><i class="glyphicon glyphicon-trash"></i></button>
						
						<?php 	echo $this->Form->input('CompanyCandidateProfile.'.$cont.'.index', array(
														'type' => 'hidden',
														'value' => $cont,
														));
						?>
		
						<?php  
								echo $this->Form->input('CompanyCandidateProfile.'.$cont.'.academic_level_id', array(
										'type'=>'select',
										'before' => '<div class="col-md-10 "><img data-toggle="tooltip" id="" data-placement="top" title="Grado de estudios que debe tener el candidato para cumplir con el perfil de la oferta." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
										'class' => 'selectpicker show-tick form-control show-menu-arrow nivelClase',
										'onchange' => "cargaCarreras('".$cont."','0')",
										'label' => array(
											'class' => 'col-md-4 control-label ',
											'text' => '<span style="color:red;">*</span>Nivel académico:',),
										'options' => $NivelesAcademicos,'default'=>'0', 'empty' => 'Selecciona una opción',
										));
					   ?>
						
						<?php 
								echo $this->Form->input('CompanyCandidateProfile.'.$cont.'.academic_situation_id', array(
										'type'=>'select',
										'before' => '<div class="col-md-10 "><img data-toggle="tooltip" id="" data-placement="top" title="Situación académica requerida para cumplir con el perfil de la oferta." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
										'class' => 'selectpicker show-tick form-control show-menu-arrow situacionClase',
										'label' => array(
											'class' => 'col-md-4 control-label ',
											'text' => '<span style="color:red;">*</span>Situación académica:',),
										'onchange' => 'academicSituation("'.$cont.'")',
										'options' => $SituacionesAcademicas,'default'=>'0', 'empty' => 'Selecciona una opción'
								));
					   ?>
					   
					   <div id="divSemestre<?php echo $cont; ?>">
							<?php 	
								echo $this->Form->input('CompanyCandidateProfile.'.$cont.'.semester', array(
										'type'=>'select',
										'before' => '<div class="col-md-10 ">',
										'class' => 'selectpicker show-tick form-control show-menu-arrow semestresClase',
										'label' => array(
													'class' => 'col-md-4 control-label ',
													'text' => '<span style="color:red;">*</span>Semestre:',),
										'onchange' => 'academicSituation("'.$cont.'")',
										'options' => $Semestres,'default'=>'0', 'empty' => 'Selecciona una opción'
								));	
							?>
						</div>
						
						<?php 	
								echo $this->Form->input('CompanyCandidateProfileCarreras.'.$cont.'.carreras', array(	
										'before' => '<div class="col-md-10 ">',
										'type'=>'select',
										'multiple' => 'multiple',
										'class' => 'selectpicker show-tick form-control show-menu-arrow carrerasClase',
										'data-live-search' => "true",
										'data-selected-text-format' => 'count > 0',
										'title' => 'Seleccione las Carreras / Áreas',
										'data-actions-box' => 'true',
										'label' => array(
													'class' => 'col-md-4 control-label ',
													'text' => '<span style="color:red;">*</span>Carreras / Áreas:',),
										'placeholder' => 'Prestaciones y apoyos',
										'default'=>'', 'empty' => 'Selecciona las Carreras / Áreas',
								)); 
						?>
						</div>
			
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
	</div>
		
		<div class="col-md-offset-6">
			<p style="margin-left: 35px;">
				Agregar otro nivel
				<img id="agregarNivel" src="/unam//img/add.png" alt="add.png" style="background-color: transparent; width: 25px;cursor:pointer;margin-top: -5px;">
			</p>
		</div>
		
		<div class="col-md-11 col-md-offset-1" style="padding-left: 0px;">	
			<p style="position: absolute;margin-left: -5px;"><span style="color:red;">*</span><p>Competencias requeridas para el puesto:</p>
				<div id="competenciasContentId" style="overflow-y: scroll; height:200px" >
					<div class="col-md-6">	
						<?php 
							$resultado = count($Competencias);
							$division = intval($resultado / 2);
							$cont = 1;
						?>	
						
						<?php 
							foreach($Competencias as $k => $competencia): 
						?>	
								<?php
									if($cont == $division):
										echo '</div><div class="col-md-6">';
									endif;
								?>
								
								<?php echo $this->Form->checkbox('CompanyJobOfferCompetency.'.$cont.'.competency_id', array(
									'value' => $competencia['Competency']['id'],
									'label' => '',
									'style' => 'display: inline',
									'class' => 'competencyClass'.$cont,
									'onClick' => 'checkCompetencies("competencyClass'.$cont.'");',
								));?><span class="titulos"><?php echo $competencia['Competency']['description']; ?></span>
								<br>
						<?php 
							$cont++;
							endforeach; 
						?>
				</div>
		</div>
		
		<div  class="col-md-12" style="margin-top: -20px; padding-right: 15px; left: 35px; top: 0px; height: 0px;" >
			<img data-toggle="tooltip" id="" data-placement="top" title="Competencias Profesionales Conjunto de conocimientos, habilidades, comportamientos y motivaciones que tiene una correlación con el desempeño sobresaliente de las personas en un puesto determinado." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="float: right;">
		</div>
		
		<div  class="col-md-12 col-md-offset-0" style="padding-left: 0px; padding-right: 0px; margin-top: 15px;" >
			<div class="col-md-8" >
				<p style="margin-left: -20px;"><span style="color:red;">*</span>Competencias Seleccionadas(7): <span class="numeroCompetencias"> </span></p>
			</div>	
			<div class="col-md-3" style="right: -108px; padding-left: 0px; padding-right: 0px; margin-left: 2px;">
				<p style="float: right; margin-left: 0px; border-left-width: 0px; margin-right: 10px;"><a onclick="competencias();" type="button"  style="margin-bottom: 12px; text-decoration: underline; cursor:pointer">Diccionario de competencias</a><img data-toggle="tooltip" id="" data-placement="top" title="Liga que permite conocer la definición de cada una de las competencias mostradas" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style ="margin-left: 4px;"></p>
			</div>
		</div>
	
	</fieldset>

	
	<div class="col-md-12" style="margin-top: 30px;">
		<?php if(($this->Session->check('CompanyCandidateProfile.id') == true) and (!empty($this->request->data))): ?>
			<div class="col-md-3 col-md-offset-3">
		<?php else:?>
			<div class="col-md-3 col-md-offset-4">
		<?php endif; ?>
		
		<?php echo $this->Form->button('<i class=" glyphicon glyphicon-floppy-save"></i>&nbsp; Guardar',array(
								'type' => 'submit', 
								'div' => 'form-group',
								'class' => 'btn btnBlue btn-default col-md-9',
								'escape' => false,
					));
		echo $this->Form->end(); 
		?>
			</div>
			
		<?php if(($this->Session->check('CompanyCandidateProfile.id') == true) and (!empty($this->request->data))): ?>
		<div class="col-md-6">
			<div class="btn-group">
					<?php 
							echo $this->Html->link('Continuar &nbsp; <i class="glyphicon glyphicon-arrow-right"></i>',
														array(
															'controller'=>'Companies',
															'action'=>'companyJobKnowledge',
														),
														array(
															'class' => 'btn btn-default btnBlue ',
															'style' => 'width: 130px;',
															'escape' => false,
															)	
						); 	?> 
			</div>
		</div>
		
		<?php endif; ?>
	</div>
							
							
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="width: 50%;  height: 90%;">
			<div class="modal-content backgroundUNAM" style="height: 100%;">
				<div class="modal-header" style="height: 10%;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Diccionario de competencias</h4>
				</div>
				<div class="modal-body" style="height: 80%;">
				  <table class="table table-bordered table-condensed table-responsive" style="margin-top: 15px; margin-bottom: 15px;">
					<thead>
					  <tr>
						<th>Competencia</th>
						<th>Definición</th>
					  </tr>
					</thead>
					<tbody>
					<?php	
						foreach($Competencias as $competencia):
							echo '<tr><td>'.$competencia['Competency']['description'].'</td><td>'.$competencia['Competency']['meaning'].'</td></tr>';
						endforeach;
					?>	 
					</tbody>
				  </table>

				</div>
				<div class="modal-footer" style="height: 10%;">
				</div>
			</div>
		</div>
	</div> 