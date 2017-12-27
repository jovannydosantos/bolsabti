<?php 
	$this->layout = 'company'; 
?>
<script>
	$(document).ready(function() {
		var helpText = [
						"Seleccione otro idioma requerido para el perfil de la oferta, además de la lengua nativa, e indique el nivel para las tres habilidades: lectura, escritura y conversación.          Ejemplos:                                   Inglés                                                   Portugués", 
						"", 
						"",
						"",
						"",
						"Nombre del lenguaje de programación, software, sistema operativo o herramienta requerido por la oferta.",
					    "En el caso de no encontrar el nombre del lenguaje de programación, software, sistema operativo o herramienta deberá escribirlo en este campo.",
					    "",
                        "Descripción de entrenamientos y metodologías específicas, manejo de equipo especializado,entre otros.                                                                                                              Le recordamos que cuenta con 316 caracteres como máximo."
						];
		 
		$('.form-group').each(function(index, element) {
			$(this).find(".cambia").attr("id", index);
			$(this).find('#'+index).attr("data-original-title", helpText[index]);
		});
		
	init_contadorTa("CompanyJobProfileProfessionalSkill","contadorTaComentario", 316);
	updateContadorTa("CompanyJobProfileProfessionalSkill","contadorTaComentario", 316);
	
	
		$("#agregarIdioma").click(function(e) { 
			var numIdiomas = $(".divIdiomas");			
			var nivelesIdiomas = 0;
			
			if(numIdiomas.length > 0)
				{	
					jQuery('.idiomas').each(function() {
						var value = $( this ).val()
						if((value==0) || (value==null) || (value=='')){
							nivelesIdiomas=1;
						}else{
							nivelesIdiomas=0;
						}
					}); console.log("   niveles  : "+nivelesIdiomas);
				}
			if(nivelesIdiomas==1){
			$.alert({ title: '¡Aviso!',type: 'blue',content: 'Completa antes de agregar otro bloque'});
			return false;
		} else{ 
			var string = 
						'<div class=" divIdiomas">'+
						'<button type="button" class="btn btn-danger eliminar" style="float: right; margin-bottom: 10px; margin-top: 0px;"><i class="glyphicon glyphicon-trash"></i></button>'+
						
							'<div class="form-group row"><div class="col-md-12 "><label for="CompanyJobLanguage0LanguageId"></label>'+
							'<select name="data[CompanyJobLanguage]['+x+'][language_id]" class="selectpicker show-tick form-control idiomas idioma'+x+'" data-live-search="true" id="CompanyJobLanguage'+x+'LanguageId">'+
							
							'</select></div></div><div class="form-group row"><div class="col-md-12">'+
							'<select name="data[CompanyJobLanguage]['+x+'][reading_level]" class="selectpicker show-tick form-control idiomas readingLevel'+x+'" placeholder="Nivel de lectura" id="CompanyJobLanguage'+x+'ReadingLevel">'+
							
							'</select></div></div><div class="form-group row"><div class="col-md-12">'+
							'<select name="data[CompanyJobLanguage]['+x+'][writing_level]" class="selectpicker show-tick form-control idiomas writingLevel'+x+'" placeholder="Nivel de escritura" id="CompanyJobLanguage'+x+'WritingLevel">'+
							
							'</select></div></div><div class="form-group row"><div class="col-md-12">'+
							'<select name="data[CompanyJobLanguage]['+x+'][conversation_level]" class="selectpicker show-tick form-control idiomas conversationLevel'+x+'" placeholder="Nivel de conversación" id="CompanyJobLanguage'+x+'ConversationLevel">'+
							
							'</select></div></div>'+						
							
						'</div>	';	

			$("#contenedorIdiomas").append(string); 
			$('#CompanyJobLanguage0LanguageId').find('option').clone().appendTo('.idioma'+x);
			$('#CompanyJobLanguage0ReadingLevel').find('option').clone().appendTo('.readingLevel'+x);
			$('#CompanyJobLanguage0WritingLevel').find('option').clone().appendTo('.writingLevel'+x);
			$('#CompanyJobLanguage0ConversationLevel').find('option').clone().appendTo('.conversationLevel'+x);
			document.getElementById('CompanyJobLanguage'+x+'LanguageId').options[0].selected = 'selected';
			document.getElementById('CompanyJobLanguage'+x+'ReadingLevel').options[0].selected = 'selected';
			document.getElementById('CompanyJobLanguage'+x+'WritingLevel').options[0].selected = 'selected';
			document.getElementById('CompanyJobLanguage'+x+'ConversationLevel').options[0].selected = 'selected';
			x++;
			$('.selectpicker').selectpicker('refresh');
			return false;
			
		}
		});
		
		
		$("#agregarComputo").click(function(e) {
			var numComputos = $(".divComputo");			
			var nivelesComputos = 0;
				
			if(numComputos.length > 0)
				{	
					jQuery('.computos').each(function() {
						var value = $( this ).val()
						if((value==0) || (value==null) || (value=='')){
							nivelesComputos=1;
						}else{
							nivelesComputos=0;
						}
					}); console.log("   niveles  : "+nivelesComputos);
				}
						
			if(nivelesComputos==1){
				$.alert({ title: '¡Aviso!',type: 'blue',content: 'Completa antes de agregar otro bloque'});
				return false;
			} else{
				
			
			var string = 
						'<div class="divComputo">'+		
							'<button type="button" class="btn btn-danger eliminar" style="float: right; margin-bottom: 10px; margin-top: 0px;"><i class="glyphicon glyphicon-trash"></i></button>'+
							
							
							'<div class="form-group row"><div class="col-md-12 ">'+
							
							'<select name="data[CompanyJobComputingSkill]['+xComputo+'][category_id]"   class="selectpicker show-tick  form-control computos categoriId'+xComputo+'"  id="CompanyJobComputingSkill'+xComputo+'CategoryId">'+
							
							'</select></div></div><div id="contentName'+xComputo+'"><div class="form-group row"><div class="col-md-12 ">'+
							
							'<select name="data[CompanyJobComputingSkill]['+xComputo+'][name]" class="selectpicker show-tick  form-control computos name'+xComputo+'" data-live-search="true" onchange="hideOther('+xComputo+')" placeholder="Nombre" type="text" id="CompanyJobComputingSkill'+xComputo+'Name"/></select></div></div></div><div id="contentOther'+xComputo+'"><div class="form-group row"><div class="col-md-12 ">'+
							
							'<input name="data[CompanyJobComputingSkill]['+xComputo+'][other]" class="selectpicker show-tick  form-control computos other'+xComputo+'" onblur="restart('+xComputo+')"  placeholder="Otro" type="text" id="CompanyJobComputingSkill'+xComputo+'Other"/></div></div></div><div class="form-group row"><div class="col-md-12 ">'+
							
							'<select name="data[CompanyJobComputingSkill]['+xComputo+'][level]" class="selectpicker show-tick  form-control computos level'+xComputo+'" placeholder="Nivel" id="CompanyJobComputingSkill'+xComputo+'Level">'+

							'</select></div></div>'+			
							
						'</div>';
						
			$("#contenedorComputo").append(string); 
			$('#CompanyJobComputingSkill0CategoryId').find('option').clone().appendTo('.categoriId'+xComputo);
			$('#CompanyJobComputingSkill0Name').find('option').clone().appendTo('.name'+xComputo);
			$('#CompanyJobComputingSkill0Level').find('option').clone().appendTo('.level'+xComputo);
			document.getElementById('CompanyJobComputingSkill'+xComputo+'CategoryId').options[0].selected = 'selected';
			document.getElementById('CompanyJobComputingSkill'+xComputo+'Name').options[0].selected = 'selected';
			document.getElementById('CompanyJobComputingSkill'+xComputo+'Level').options[0].selected = 'selected';
			
			xComputo++;
			$('.selectpicker').selectpicker('refresh');
			return false;
				
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
		
		<?php if(empty($this->request->data['CompanyJobLanguage'])): ?>
			$.alert({ title: '!Aviso!',type: 'blue',content: 'Para que cada bloque de idiomas y cómputo se guarde debe de completar cada uno de sus campos'});
				
		<?php endif; ?>
	});	
	function restart(index){
		var textBox = document.getElementById('CompanyJobComputingSkill'+index+'Other');
		var textLength = textBox.value.length;
		if(textLength > 0)
		{
			$("#contentName"+index).hide();
			document.getElementById('CompanyJobComputingSkill'+index+'Name').options[0].selected = 'selected';
		} else {
			$("#contentName"+index).show();
		}
	}
	function hideOther(index){
		
		var disabilityValue = $('#CompanyJobComputingSkill'+index+'Name').val();
		
		if (disabilityValue != ''){
			$("#contentOther"+index).hide();
			$('#CompanyJobComputingSkill'+index+'Name').val() == '';
		} else {
			$("#contentOther"+index).show();
		}
	}
	function validateInputs(){
		var numIdiomas = $(".divIdiomas");			
		var nivelesIdiomas = 0;
			
		if(numIdiomas.length > 0)
			{	
				jQuery('.idiomas').each(function() {
					var value = $( this ).val()
					if((value==0) || (value==null) || (value=='')){
						nivelesIdiomas=1;
					}else{
						nivelesIdiomas=0;
					}
				}); console.log("   niveles  : "+nivelesIdiomas);
			}

		var numComputos = $(".divComputo");			
		var nivelesComputos = 0;
			
		if(numComputos.length > 0)
			{	
				jQuery('.computos').each(function() {
					var value = $( this ).val()
					if((value==0) || (value==null) || (value=='')){
						nivelesComputos=1;
					}else{
						nivelesComputos=0;
					}
				}); console.log("   niveles  : "+nivelesComputos);
			}
					
		if((nivelesComputos==1)|| (nivelesIdiomas==1)){
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
									'action' => 'companyJobKnowledge',
									'onsubmit' =>'return validateInputs();']); ?>
	<fieldset>
		<div class="col-md-6">
			<div class="col-md-12">	
				<div id="contenedorIdiomas">
					<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
						<p style="color:#588BAD">Idiomas</p>
					</blockquote>
					<?php 	echo $this->Form->input('CompanyJobLanguage.0.language_id',['type'=>'select','data-live-search' => "true",'style' => ' margin-top: 15px;','class' => 'selectpicker show-tick form-control idiomas','label' => '','options' => $Lenguages,'default'=>'0', 'empty' => 'Idioma'
					]);?>			
					<?php 	echo $this->Form->input('CompanyJobLanguage.0.reading_level',['type'=>'select','class' => 'selectpicker show-tick form-control idiomas','label' => '','options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Lectura'
					]);?>
					<?php 	echo $this->Form->input('CompanyJobLanguage.0.writing_level',['type'=>'select','class' => 'selectpicker show-tick form-control idiomas','label' => '','options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Escritura'
					]);?>
					<?php 	echo $this->Form->input('CompanyJobLanguage.0.conversation_level',['type'=>'select','class' => 'selectpicker show-tick form-control idiomas','label' => '','options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Conversación'
					]);?>
	
					<script languaje="javascript">
						var x = 1;
					</script> 
					<?php 
						$cont = 0;
						if(!empty($this->request->data['CompanyJobLanguage'])):
							foreach($this->request->data['CompanyJobLanguage'] as $k => $idioma): 
								if($cont > 0):
					?>
					<div id="divIdiomas"> 	
						<button type="button" class="btn btn-danger eliminar" style="margin-bottom: 10px; margin-top: 0px; float: right;" ><i class="glyphicon glyphicon-trash"></i></button>
						<?php 	echo $this->Form->input('CompanyJobLanguage.'.$cont.'.language_id',['type'=>'select','data-live-search' => "true",'class' => 'selectpicker show-tick form-control idiomas','label' => '','options' => $Lenguages,'default'=>'0', 'empty' => 'Idioma'
						]);?>
						<?php 	echo $this->Form->input('CompanyJobLanguage.'.$cont.'.reading_level',['type'=>'select','class' => 'selectpicker show-tick form-control idiomas','label' => '','options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Lectura'
						]);?>
						<?php 	echo $this->Form->input('CompanyJobLanguage.'.$cont.'.writing_level',['type'=>'select','class' => 'selectpicker show-tick form-control idiomas','label' => '','options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Escritura'
						]);?>
						<?php 	echo $this->Form->input('CompanyJobLanguage.'.$cont.'.conversation_level',['type'=>'select','class' => 'selectpicker show-tick form-control idiomas','label' => '','options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Conversación'
						]);?>
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
				<button type="button" class="btn btn-primary btn-sm" id="agregarIdioma" style="float: right"><span class="glyphicon glyphicon-plus"></span></button>	
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-12">	
				<div id="contenedorComputo"> 	
					<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
						<p style="color:#588BAD">Computo</p>
					</blockquote>
					<?php 	echo $this->Form->input('CompanyJobComputingSkill.0.category_id',['type'=>'select','class' => 'selectpicker show-tick form-control computos','style' => ' margin-top: 15px;','label' => '','options' => $Tecnologias,'default'=>'0', 'empty' => 'Categoría'
					]);?>
					<div id="contentName0">
						<?php 	echo $this->Form->input('CompanyJobComputingSkill.0.name',['type'=>'select','data-live-search' => "true",'class' => 'selectpicker show-tick form-control computos','onchange' => 'hideOther(0)','label' => '','options' => $Programas,'placeholder' => 'Nombre','default'=>'0', 'empty' => 'Nombre'
							]);?>
					</div>
					<div id="contentOther0">
						<?php 	echo $this->Form->input('CompanyJobComputingSkill.0.other',['class' => 'selectpicker show-tick form-control computos','label' => '','placeholder' => 'Otro', 'empty' => 'Otro',	'onblur' => 'restart(0)'
						]);?>
					</div>
					<?php 	echo $this->Form->input('CompanyJobComputingSkill.0.level',['type'=>'select','class' => 'selectpicker show-tick form-control computos','onchange' => 'hideOther(0)','label' => '','options' => $NivelesSoftware,'placeholder' => 'Nivel','default'=>'0', 'empty' => 'Nivel'
					]);?>
					<script languaje="javascript">
							var xComputo = 1;
					</script> 
					<?php 
						$cont = 0;
						if(!empty($this->request->data['CompanyJobComputingSkill'])):
							foreach($this->request->data['CompanyJobComputingSkill'] as $k => $computo): 
								if($cont > 0):
					?>
					<div id="divComputo"> 
						<button type="button" class="btn btn-danger eliminar" style="margin-bottom: 10px; margin-top: 0px; float: right;" ><i class="glyphicon glyphicon-trash"></i></button>
						<?php 	echo $this->Form->input('CompanyJobComputingSkill.'.$cont.'.category_id',['type'=>'select','class' => 'selectpicker show-tick form-control computos','label' => '','options' => $Tecnologias,'default'=>'0', 'empty' => 'Categoría'
								]);?>
						<div id="contentName<?php echo $cont; ?>">
							<?php 	echo $this->Form->input('CompanyJobComputingSkill.'.$cont.'.name',['type'=>'select','data-live-search' => "true",'class' => 'selectpicker show-tick form-control computos','onchange' => 'hideOther('.$cont.')','label' => '','options' => $Programas,'placeholder' => 'Nombre','default'=>'0', 'empty' => 'Nombre'
								]);?>
						</div>
						<div id="contentOther<?php echo $cont; ?>">
							<?php 	echo $this->Form->input('CompanyJobComputingSkill.'.$cont.'.other',['class' => 'selectpicker show-tick form-control computos','label' => '','placeholder' => 'Otro', 'empty' => 'Otro','onblur' => 'restart('.$cont.')'
								]);?>
						</div>
						<?php 	echo $this->Form->input('CompanyJobComputingSkill.'.$cont.'.level',['type'=>'select','class' => 'selectpicker show-tick form-control computos','label' => '','options' => $NivelesSoftware,'placeholder' => 'Nivel','default'=>'0', 'empty' => 'Nivel'
						]);?>
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
				<button type="button" class="btn btn-primary btn-sm" id="agregarComputo" style="float: right"><span class="glyphicon glyphicon-plus"></span></button>	
			</div>
			<div class="col-md-12">
				<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 5px;">
					<p style="color:#588BAD">Conocimientos y habilidades profesionales</p>
				</blockquote>       
				<?php echo $this->Form->input('CompanyJobProfile.id'); ?>
				<?= $this->Form->input('CompanyJobProfile.professional_skill',
				['placeholder' => 'Conocimientos y habilidades profesionales','style' => ' margin-top: 15px;','maxlength' => '316']); ?>
				<div class="col-md-12" style="text-align: right;">
					<span id="contadorTaComentario">0/316</span><span> caracteres máx.</span>
				</div>
			
			</div>	
		</div>
	</fieldset>
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