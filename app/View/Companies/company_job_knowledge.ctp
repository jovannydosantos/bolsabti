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
			var string = 
						'<div class=" divIdiomas">'+
							'<button type="button" class="btn btn-danger eliminar" style="margin-right: -15px; float: right; margin-bottom: -30px; margin-top: 0px;"><i class="glyphicon glyphicon-trash"></i></button>'+
							'<div class="col-md-4 col-md-offset-1">'+
						
								'<p style="color:#588BAD">Idioma:</p>'+
							'</div>'+
							'<div class="form-group row"><div class="col-md-12 "><label for="CompanyJobLanguage0LanguageId"></label><div class="col-md-10 col-md-offset-1">'+
							'<select name="data[CompanyJobLanguage]['+x+'][language_id]" class="selectpicker show-tick form-control idioma'+x+'" data-live-search="true" id="CompanyJobLanguage'+x+'LanguageId">'+
							
							'</select></div></div></div><div class="form-group row"><div class="col-md-12 col-md-offset-1"><label for="CompanyJobLanguage'+x+'ReadingLevel" class="col-md-4 control-label">Lectura</label> <div class="col-md-6">'+
							'<select name="data[CompanyJobLanguage]['+x+'][reading_level]" class="selectpicker show-tick form-control readingLevel'+x+'" placeholder="Nivel de lectura" id="CompanyJobLanguage'+x+'ReadingLevel">'+
							
							'</select></div></div></div><div class="form-group row"><div class="col-md-12 col-md-offset-1"><label for="CompanyJobLanguage'+x+'WritingLevel" class="col-md-4 control-label">Escritura</label> <div class="col-md-6">'+
							'<select name="data[CompanyJobLanguage]['+x+'][writing_level]" class="selectpicker show-tick form-control writingLevel'+x+'" placeholder="Nivel de escritura" id="CompanyJobLanguage'+x+'WritingLevel">'+
							
							'</select></div></div></div><div class="form-group row"><div class="col-md-12 col-md-offset-1"><label for="CompanyJobLanguage'+x+'ConversationLevel" class="col-md-4 control-label">Conversación</label> <div class="col-md-6">'+
							'<select name="data[CompanyJobLanguage]['+x+'][conversation_level]" class="selectpicker show-tick form-control conversationLevel'+x+'" placeholder="Nivel de conversación" id="CompanyJobLanguage'+x+'ConversationLevel">'+
							
							'</select></div></div></div>'+						
							
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
		});
		
		
		$("#agregarComputo").click(function(e) { 
			var string = 
						'<div class="divComputo">'+		
							'<button type="button" class="btn btn-danger eliminar" style="margin-right: 15px; float: right; margin-bottom: -30px; margin-top: 0px;"><i class="glyphicon glyphicon-trash"></i></button>'+
							'<div class="col-md-4">'+
								'<p>Cómputo</p>'+
							'</div>'+
							
							'<div class="form-group row"><div class="col-md-12 "><div class="col-md-10">'+
							
							'<select name="data[CompanyJobComputingSkill]['+xComputo+'][category_id]"   class="selectpicker show-tick  form-control categoriId'+xComputo+'"  id="CompanyJobComputingSkill'+xComputo+'CategoryId">'+
							
							'</select></div></div></div><div id="contentName'+xComputo+'"><div class="form-group row"><div class="col-md-12 "><div class="col-md-10">'+
							
							'<select name="data[CompanyJobComputingSkill]['+xComputo+'][name]" class="selectpicker show-tick  form-control name'+xComputo+'" data-live-search="true" onchange="hideOther('+xComputo+')" placeholder="Nombre" type="text" id="CompanyJobComputingSkill'+xComputo+'Name"/></select></div></div></div></div><div id="contentOther'+xComputo+'"><div class="form-group row"><div class="col-md-12 "><div class="col-md-10">'+
							
							'<input name="data[CompanyJobComputingSkill]['+xComputo+'][other]" class="selectpicker show-tick  form-control other'+xComputo+'" onblur="restart('+xComputo+')"  placeholder="Otro" type="text" id="CompanyJobComputingSkill'+xComputo+'Other"/></div></div></div></div><div class="form-group row"><div class="col-md-12 "><div class="col-md-10">'+
							
							'<select name="data[CompanyJobComputingSkill]['+xComputo+'][level]" class="selectpicker show-tick  form-control level'+xComputo+'" placeholder="Nivel" id="CompanyJobComputingSkill'+xComputo+'Level">'+

							'</select></div></div></div>'+			
							
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
	
</script>
	<div class="col-md-12" style="margin-top: 15px;">
		<?php 
			echo $this->Form->create('Company', array(
									'class' => 'form-horizontal' , 
									'role' => 'form',
									'id'=> 'idForm',
									'inputDefaults' => array(
									'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
									'div' => array('class' => 'form-group row'),
									'class' => 'form-control',
									'before' => '<div class="col-md-12 ">',
									'between' => ' <div class="col-md-6">',
									'after' => '</div></div>',
									'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
											),
									'action' => 'companyJobKnowledge',
		)); ?>	
				
		<div class="col-md-6">
			<div class="col-md-12">	
				<div id="contenedorIdiomas">	
					<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
						<p style="color:#588BAD">Idiomas</p>
					</blockquote>
					<?php 	echo $this->Form->input('CompanyJobLanguage.0.language_id', array(
									'type'=>'select',
									'before' => '<div class="col-md-12 ">',
									'between' => ' <div class="col-md-10 col-md-offset-1">',
									'class' => 'selectpicker show-tick form-control',
									'data-live-search' => "true",
									'label' => '',
									'options' => $Lenguages,'default'=>'0', 'empty' => 'Idioma'
					));?>
					<?php 	echo $this->Form->input('CompanyJobLanguage.0.reading_level', array(
									'type'=>'select',
									'before' => '<div class="col-md-12 col-md-offset-1">',
									'class' => 'selectpicker show-tick form-control',
									'label' => array(
											'class' => 'col-md-4 control-label',
											'text' => 'Lectura'),
									'placeholder' => 'Nivel',
									'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel'
					));	?>
					<?php 	echo $this->Form->input('CompanyJobLanguage.0.writing_level', array(
									'type'=>'select',
									'before' => '<div class="col-md-12 col-md-offset-1">',
									'class' => 'selectpicker show-tick form-control',
									'label' => array(
											'class' => 'col-md-4 control-label',
											'text' => 'Escritura'),
									'placeholder' => 'Nivel',
									'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel'
					));	?>
					<?php 	echo $this->Form->input('CompanyJobLanguage.0.conversation_level', array(
									'type'=>'select',
									'before' => '<div class="col-md-12 col-md-offset-1">',
									'class' => 'selectpicker show-tick form-control',
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
						if(!empty($this->request->data['CompanyJobLanguage'])):
							foreach($this->request->data['CompanyJobLanguage'] as $k => $idioma): 
								if($cont > 0):
					?>
						<div id="divIdiomas"> 	
							<button type="button" class="btn btn-danger eliminar"  style="float: right; margin-bottom: -30px; margin-top: -5px; margin-right: -18px;"><i class="glyphicon glyphicon-trash"></i></button>
							<div class="col-md-4 col-md-offset-1">
								<p>Idioma</p>
							</div>
							<?php 	echo $this->Form->input('CompanyJobLanguage.'.$cont.'.language_id', array(
											'type'=>'select',
											'before' => '<div class="col-md-12 ">',
											'between' => ' <div class="col-md-10 col-md-offset-1">',
											'class' => 'selectpicker show-tick form-control',
											'data-live-search' => "true",
											'label' => '',
											'options' => $Lenguages,'default'=>'0', 'empty' => 'Idioma'
							));?>
							<?php 	echo $this->Form->input('CompanyJobLanguage.'.$cont.'.reading_level', array(
											'type'=>'select',
											'before' => '<div class="col-md-12 col-md-offset-1">',
											'class' => 'selectpicker show-tick form-control',
											'label' => array(
													'class' => 'col-md-4 control-label',
													'text' => 'Lectura'),
											'placeholder' => 'Nivel',
											'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel'
							));	?>
							<?php 	echo $this->Form->input('CompanyJobLanguage.'.$cont.'.writing_level', array(
											'type'=>'select',
											'before' => '<div class="col-md-12 col-md-offset-1">',
											'class' => 'selectpicker show-tick form-control',
											'label' => array(
													'class' => 'col-md-4 control-label',
													'text' => 'Escritura'),
											'placeholder' => 'Nivel',
											'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel'
							));	?>
							<?php 	echo $this->Form->input('CompanyJobLanguage.'.$cont.'.conversation_level', array(
								'type'=>'select',
								'before' => '<div class="col-md-12 col-md-offset-1">',
								'class' => 'selectpicker show-tick form-control',
								'label' => array(
								'class' => 'col-md-4 control-label',
								'text' => 'Conversación'),
								'placeholder' => 'Nivel',
								'options' => $NivelesIdioma,'default'=>'0', 'empty' => 'Nivel'
								));	
							?>
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
				<div class="col-md-offset-7">
					<span>Agregar otro nivel</span>
					<button type="button" class="btn btn-primary btn-sm" id="agregarIdioma">
						<span class="glyphicon glyphicon-plus"></span>
					</button>	
				</div>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="col-md-12">	
				<div id="contenedorComputo"> 	
					<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
						<p style="color:#588BAD">Computo</p>
					</blockquote>
					<?php 	echo $this->Form->input('CompanyJobComputingSkill.0.category_id', array(
									'type'=>'select',
									'before' => '<div class="col-md-11">',
									'between' => ' <div class="col-md-11">',
									'class' => 'selectpicker show-tick form-control',
									'label' => '',
									'options' => $Tecnologias,'default'=>'0', 'empty' => 'Categoría'
					));?>
					<div id="contentName0">
					<?php 	echo $this->Form->input('CompanyJobComputingSkill.0.name', array(
									'type'=>'select',
									'class' => 'selectpicker show-tick form-control',
									'data-live-search' => "true",
									'before' => '<div class="col-md-11 ">',
									'between' => ' <div class="col-md-11">',
									'label' => '',
									'placeholder' => 'Nombre',
									'onchange' => 'hideOther(0)',
									'options' => $Programas,'default'=>'0', 'empty' => 'Nombre'
					));	?>
					</div>
					<div id="contentOther0">
					<?php	echo $this->Form->input('CompanyJobComputingSkill.0.other', array(
									'class' => 'form-control',
									'before' => '<div class="col-md-11 ">',
									'between' => ' <div class="col-md-11">',
									'label' => '',
									'placeholder' => 'Otro',
									'onblur' => 'restart(0)'
					));	?>
					</div>
					<?php 	echo $this->Form->input('CompanyJobComputingSkill.0.level', array(
									'type'=>'select',
									'before' => '<div class="col-md-11">',
									'between' => ' <div class="col-md-11">',
									'class' => 'selectpicker show-tick form-control',
									'label' => '',
									'placeholder' => 'Nivel',
									'options' => $NivelesSoftware,'default'=>'0', 'empty' => 'Nivel'
					));	?>
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
						<button type="button" class="btn btn-danger eliminar" style="margin-right: 15px; float: right; margin-bottom: -30px; margin-top: 0px;"><i class="glyphicon glyphicon-trash"></i>
						</button>
						<div class="col-md-4">
							<p>Cómputo</p>
						</div>
							<?php 	echo $this->Form->input('CompanyJobComputingSkill.'.$cont.'.category_id', array(
											'type'=>'select',
											'before' => '<div class="col-md-11">',
											'between' => ' <div class="col-md-11">',
											'class' => 'selectpicker show-tick form-control',
											'label' => '',
											'options' => $Tecnologias,'default'=>'0', 'empty' => 'Categoría'
							));?>
							<div id="contentName<?php echo $cont; ?>">
							<?php 	echo $this->Form->input('CompanyJobComputingSkill.'.$cont.'.name', array(
											'type'=>'select',
											'class' => 'selectpicker show-tick form-control',
											'data-live-search' => "true",
											'before' => '<div class="col-md-11 ">',
											'between' => ' <div class="col-md-11">',
											'label' => '',
											'placeholder' => 'Nombre',
											'onchange' => 'hideOther('.$cont.')',
											'options' => $Programas,'default'=>'0', 'empty' => 'Nombre'
							));	?>
							</div>
							<div id="contentOther<?php echo $cont; ?>">
							<?php	echo $this->Form->input('CompanyJobComputingSkill.'.$cont.'.other', array(
											'before' => '<div class="col-md-11 ">',
											'between' => ' <div class="col-md-11">',
											'label' => '',
											'placeholder' => 'Otro',
											'onblur' => 'restart('.$cont.')'
							));	?>
							</div>
							<?php 	echo $this->Form->input('CompanyJobComputingSkill.'.$cont.'.level', array(
											'type'=>'select',
											'before' => '<div class="col-md-11">',
											'between' => ' <div class="col-md-11">',
											'class' => 'selectpicker show-tick form-control',
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
				<div class="col-md-offset-6">
					<span>Agregar otro cómputo </span>
						<button type="button" class="btn btn-primary btn-sm" id="agregarComputo"><span class="glyphicon glyphicon-plus"></span>
						</button>	
				</div>
			</div>
			<div class="col-md-12">
				<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
					<p style="color:#588BAD">Conocimientos y habilidades profesionales</p>
				</blockquote>
				<?php echo $this->Form->input('CompanyJobProfile.id'); ?>
				<?php 	echo $this->Form->input('CompanyJobProfile.professional_skill', array(
													'before' => '<div class="col-md-11 ">',
													'between' => ' <div class="col-md-10">',
													'maxlength' => '316',
													'label' => '',
													'style' => 'margin-left: 20px;resize: vertical; min-height: 120px;  max-height: 120px; height: 120px;',
													'placeholder' => 'Conocimientos y habilidades profesionales',
				));	?>
				<div class="col-md-11" style="text-align: right; right; top: -10px;margin-left: -50px;">
					<span id="contadorTaComentario">0/316</span><span> caracteres máx.</span>
				</div>
				<div class="col-md-12" style="margin-top: 30px;">
					<div class="col-md-6 col-md-offset-0">
						<?php echo $this->Form->button('<i class=" glyphicon glyphicon-floppy-disk"></i>&nbsp; Guardar',array(
												'type' => 'submit', 
												'div' => 'form-group',
												'escape' => false,
												'class' => 'btn btn-primary btn-bti',
												'escape' => false,
									));
						echo $this->Form->end(); 
						?>
					</div>
					<?php if($this->Session->check('CompanyCandidateProfile.id') == true): ?>
					<div class="col-md-6">
						<div class="btn-group">
								<?php 
									echo $this->Html->link('Continuar &nbsp; <i class="glyphicon glyphicon-arrow-right"></i>',
																array(
																	'controller'=>'Companies',
																	'action'=>'viewOfferOnline',$this->Session->read('CompanyJobProfile.id'),
																),
																array(
																	'class' => 'btn btn-primary btn-bti',
																	'style' => 'width: 130px;',
																	'escape' => false,
																	)	
								); 	?> 
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>