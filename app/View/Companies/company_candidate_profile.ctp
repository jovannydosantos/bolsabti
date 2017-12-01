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
				
				var numNiveles = $(".divNiveles");			
				var nivelesVacios = 0;
			
				if ((document.getElementById("CompanyCandidateProfile0AcademicLevelId").value.length === 0) ||
				(document.getElementById("CompanyCandidateProfile0AcademicSituationId").value.length === 0) ||
				(document.getElementById("CompanyCandidateProfileCarreras0Carreras").value.length === 0))
				{ 
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese valores antes de agregar otro bloque'});
					return false;
				}else{
						if(numNiveles.length > 0)
						{	
							jQuery('.nivel').each(function() {
							//	var currentElement = $(this);
							//	var value = currentElement.val();
								var value = $( this ).val()
								if((value==0) || (value==null) || (value=='')){
									//	$.alert({ title: '!Aviso!',type: 'blue',content: 'Hay niveles sin completar'});
									nivelesVacios=1;
								}else{
									nivelesVacios=0;
								}
							}); console.log("   niveles  : "+nivelesVacios);
						}
					}	

				if(nivelesVacios==0){
							var string = 
						'<div class="divNiveles">'+
					
							'<button type="button" class="btn btn-danger eliminar" style="float: right; margin-bottom: 10px; margin-top: 0px;"><i class="glyphicon glyphicon-trash"></i></button>'
					
							+
							'<input id="CompanyCandidateProfile'+x+'Index" class="form-control" name="data[CompanyCandidateProfile]['+x+'][index]" value="'+x+'" type="hidden">'+

							'<div class="form-group row">'+
							'<div class="col-md-12"><select id="CompanyCandidateProfile'+x+'AcademicLevelId" class="selectpicker show-tick form-control nivel show-menu-arrow nivelPerfil'+x+' nivelClase nivel" onchange="cargaCarreras('+x+',0);" name="data[CompanyCandidateProfile]['+x+'][academic_level_id]">'+
							
							'</select></div></div>'+
							
							'<div class="form-group row">'+
							'<div class="col-md-12"><select id="CompanyCandidateProfile'+x+'AcademicSituationId" class="selectpicker show-tick form-control nivel show-menu-arrow situacionPerfil'+x+' situacionClase" name="data[CompanyCandidateProfile]['+x+'][academic_situation_id]" onchange="academicSituation('+x+')">'+
								'<option value="">Selecciona una opción</option>'+
							'</select></div></div>'+
							
							'<div id="divSemestre'+x+'" style="display: none;">'+
								'<div class="form-group row">'+
								'<div class="col-md-12"><select id="CompanyCandidateProfile'+x+'Semester" class="selectpicker show-tick form-control nivel show-menu-arrow semestrePerfil'+x+' semestresClase" name="data[CompanyCandidateProfile]['+x+'][semester]" onchange="academicSituation('+x+')">'+
								
								'</select></div></div>'+
							'</div>'+
							
							'<div class="form-group row">'+
							'<div class="col-md-12"><select id="CompanyCandidateProfileCarreras'+x+'Carreras" class="selectpicker show-tick form-control show-menu-arrow nivel carrerasClase" name="data[CompanyCandidateProfileCarreras]['+x+'][carreras][]" multiple="multiple" data-live-search="true" data-selected-text-format="count > 0" title="Seleccione las Carreras / Áreas" data-actions-box="true" placeholder="Seleccione las Carreras / Áreas" >'+
							
							'</select></div></div>'+
							
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
						$(this).attr("src","http://localhost/bolsabti/app/webroot/img/help_yellow.png");
							}, function() {
						$(this).attr("src","http://localhost/bolsabti/app/webroot/img/help.png");
					});
					return false;
							
				}
						
				if(nivelesVacios==1){
					$.alert({ title: '¡Aviso!',type: 'blue',content: 'Ingrese valores antes de agregar otro bloque'});
					return false;
				} else{
					return true;
				}	
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
			//	console.log(index);
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
	        	$.alert({ title: '!Aviso!',type: 'blue',content: 'Le recordamos que tiene un número limitado de opciones.'});
				$("."+indexClass).prop('checked', false);
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
			var numNiveles = $(".divNiveles");			
			var nivelesVacios = 0;
			
			if ((document.getElementById("CompanyCandidateProfile0AcademicLevelId").value.length === 0) ||
			(document.getElementById("CompanyCandidateProfile0AcademicSituationId").value.length === 0) ||
			(document.getElementById("CompanyCandidateProfileCarreras0Carreras").value.length === 0))
			{ 
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Hay niveles sin completar'});
				return false;
			}else{
					if(numNiveles.length > 0)
					{	
						jQuery('.nivel').each(function() {
						//	var currentElement = $(this);
						//	var value = currentElement.val();
							var value = $( this ).val()
							if((value==0) || (value==null) || (value=='')){
								//	$.alert({ title: '!Aviso!',type: 'blue',content: 'Hay niveles sin completar'});
								nivelesVacios=1;
							}else{
								nivelesVacios=0;
							}
						}); console.log("   niveles  : "+nivelesVacios);
					}
				}

			if(nivelesVacios==0){
				var $marcados =$("#competenciasContentId input:checked");
					if ($marcados.length < 7){
						$.alert({ title: '¡Aviso!',type: 'blue',content: 'Seleccione 7 competencias para continuar.'});
						return false;} 
					else{
						return true;
						}
			}
						
			if(nivelesVacios==1){
				$.alert({ title: '¡Aviso!',type: 'blue',content: 'Hay niveles sin completar'});
				return false;
			} else{
				return true;
			}	
		}
	</script>

<div class="col-md-12" style="margin-top:15px">
	<?= $this->Form->create('Company', [
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
									'action' => 'CompanyCandidateProfile',
								'onsubmit' =>'return validateInputs();']); ?>
	<fieldset>
		<div class="col-md-6 col-md-offset-3">
			<div id="contenedorNiveles">
				<?php echo $this->Form->input('CompanyCandidateProfile.0.index', array('type' => 'hidden','value' => 0,));?>
				<?php 	echo $this->Form->input('CompanyCandidateProfile.0.academic_level_id',['type'=>'select','onchange' => "cargaCarreras('0','0');",'class' => 'selectpicker nivel show-tick form-control ','label' => '','options' => $NivelesAcademicos,'default'=>'0', 'empty' => 'Nivel academico', 'requered'=>true]);?>
				<?php 	echo $this->Form->input('CompanyCandidateProfile.0.academic_situation_id',['type'=>'select','label' => '','class' => 'selectpicker show-tick form-control nivel show-menu-arrow situacionClase','title' => 'Situación academica','onchange' => 'academicSituation("0")','options' => $SituacionesAcademicas,'default'=>'0', 'empty' => 'Situación académica'
				]);?>
				<div id="divSemestre0">
				<?php 	echo $this->Form->input('CompanyCandidateProfile.0.semester',[
									'type'=>'select','onchange' =>'academicSituation("0")',
									'class' => 'selectpicker show-tick form-control',
									'label' => '',
									'options' => $Semestres,'default'=>'0', 
									'empty' => 'Semestre'
				]);?>
				</div>
				<?= $this->Form->input('CompanyCandidateProfileCarreras.0.carreras', ['type'=>'select','multiple' => 'multiple','data-selected-text-format' => 'count > 3','data-live-search' => "true",'data-actions-box' => 'true','placeholder' => 'Seleccione las Carreras / Áreas','title' => 'Seleccione las Carreras / Áreas','class' => 'selectpicker show-tick form-control nivel show-menu-arrow']); ?>
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
					<div class="col-md-offset-0">
						<button type="button" class="btn btn-danger eliminar" style="margin-bottom: 10px; margin-top: 0px; float: right;" ><i class="glyphicon glyphicon-trash"></i></button>
						<?php 	echo $this->Form->input('CompanyCandidateProfile.'.$cont.'.index', array('type' => 'hidden','value' => $cont,));
						?>
						<?php 	echo $this->Form->input('CompanyCandidateProfile.'.$cont.'.academic_level_id',[	'type'=>'select','onchange' =>"cargaCarreras('".$cont."','0')",	'class' => 'selectpicker nivel show-tick form-control','label' => '','options' => $NivelesAcademicos,'default'=>'0', 'empty' => 'Nivel academico'
						]);?>
						<?php 	echo $this->Form->input('CompanyCandidateProfile.'.$cont.'.academic_situation_id',['type'=>'select','label' => '','class' => 'selectpicker show-tick form-control nivel show-menu-arrow situacionClase','title' => 'Situación academica','onchange' => 'academicSituation("'.$cont.'")','options' => $SituacionesAcademicas,'default'=>'0', 'empty' => 'Situación académica'
						]);?>
						<div id="divSemestre<?php echo $cont; ?>">
					   <?php 	echo $this->Form->input('CompanyCandidateProfile.'.$cont.'.semester',['type'=>'select','onchange' =>'academicSituation("'.$cont.'")','class' => 'selectpicker show-tick form-control','label' => '','options' => $Semestres,'default'=>'0','empty' => 'Semestre'
						]);?>
						</div>
						<?php 	echo $this->Form->input('CompanyCandidateProfileCarreras.'.$cont.'.carreras',['type'=>'select','multiple' => 'multiple','data-selected-text-format' => 'count > 3',	'data-actions-box' => 'true','placeholder' => 'Seleccione las Carreras / Áreas','label' => '','class' => 'selectpicker nivel show-tick form-control','data-live-search' => "true",'title' => 'Seleccione las Carreras / Áreas','class' => 'selectpicker show-tick form-control show-menu-arrow'
						]);?>
					</div>
				</div> <!-- niveles-->
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
			<button type="button" class="btn btn-primary btn-sm" id="agregarNivel" style="float: right"><span class="glyphicon glyphicon-plus"></span></button>	
		</div>
	</fieldset>
</div>

<div class="col-md-12">
	<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 15px;">
		<p style="color: #588BAD">Competencias requeridas para el puesto:</p>
	</blockquote>	
</div>

<div class="col-md-12" style="margin-top: 15px color: #717171;" id="competenciasContentId">
	<?php 
		$cont = 1; 
		foreach($Competencias as $k => $competencia): 
	?>		
	<div class="col-md-4">
		<?php echo $this->Form->checkbox('CompanyJobOfferCompetency.'.$cont.'.competency_id', array(
			'value' => $competencia['Competency']['id'],
			'label' => '',
			'style' => 'display: inline',
			'class' => 'competencyClass'.$cont,
			'onClick' => 'checkCompetencies("competencyClass'.$cont.'");',
		));?>
		<span class="titulos"><?php echo $competencia['Competency']['description']; ?></span>
	</div>
	<?php 
		$cont++;
		endforeach; 
	?>
	<div class="col-md-8" style="margin-top: 15px">
		<p><span style="color:red;">*</span>Competencias Seleccionadas(7): <span class="numeroCompetencias"> </span></p>
	</div>	
	<div class="col-md-3" style="margin-top: 15px">
		<p><a onclick="competencias();" type="button"  style="margin-bottom: 12px; text-decoration: underline; cursor:pointer">Diccionario de competencias</a></p>
	</div>
</div>	
	
<div class="col-md-12  text-center" style="margin-top: 30px;">
	<?php echo $this->Form->button('<i class=" glyphicon glyphicon-floppy-disk"></i>&nbsp; Guardar',array(
		'type' => 'submit', 
		'div' => 'form-group',
		'class' => 'btn btn-primary',
		'escape' => false,
		));
	echo $this->Form->end(); 				
	?>
</div>

<div class="modal fade" tabindex="-1" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
		<div class="modal-dialog"  >
			<div class="modal-content fondoBti whiteText" >
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Diccionario de competencias</h4>
				</div>
				<div class="modal-body scrollbar" id="style-2">
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
				<div class="modal-footer">
					<button type="button" class="btn btn-default btnBlue" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
</div>
