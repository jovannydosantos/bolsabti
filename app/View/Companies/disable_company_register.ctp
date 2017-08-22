	<?php 
		$this->layout = 'company'; 
	?>
	<script type="text/javascript">
		$(document).ready(function() {
			var helpText = [
							"Opciones para desactivatu registro.", 
							];
			
			$('.form-group').each(function(index, element) {
				$(this).find(".cambia").attr("id", index);
				$(this).find('#'+index).attr("data-original-title", helpText[index]);
			});
			
			init_contadorTa("CompanyAnswer2Answer","contadorTaComentario", 632);
			updateContadorTa("CompanyAnswer2Answer","contadorTaComentario", 632);
			desabilityOptions();
		});	


		//<![CDATA[	
			function init_contadorTa(idtextarea, idcontador,max)
			{
				$("#"+idtextarea).keyup(function()
						{
							updateContadorTa(idtextarea, idcontador,max);
						});
				
				$("#"+idtextarea).change(function()
				{
						updateContadorTa(idtextarea, idcontador,max);
				});
				
			}

			function updateContadorTa(idtextarea, idcontador,max)
			{
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
			//]]> 

		function validateEmpty(){
			if (confirm('¿Está seguro de eliminar su registro?')){
				return true;
			}
			else{
				return false;
			}
		
		}
		
		function desabilityOptions(){
			if($("#CompanyDisableS").is(':checked')) {  
				$('#encuestaId').show();
			} else {
				$('#encuestaId').hide();
			}
		}
	</script>
	<style>
	.form-horizontal .control-label {
	    margin-bottom: 0;
	    padding-top: 7px;
	    text-align: left;
	}
	</style>
	<?php echo $this->Session->flash(); ?>	
				
	<?php echo $this->Form->create('Company', array(
												'class' => 'form-horizontal', 
												'role' => 'form',
												'inputDefaults' => array(
														'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
														'div' => array('class' => 'form-group'),
														'class' => 'form-control',
														'label' => array('class' => 'col-xs-10 col-sm-10 col-md-6 control-label '),
														'before' => '<div class="col-xs-12 col-sm-11 col-md-11">',
														'between' => '<div class="col-xs-12 col-sm-10 col-md-6">',
														'after' => '</div></div>',
														'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
												),
										'onsubmit' =>'return validateEmpty();',
										'action' => 'disableCompanyRegister',
	)); ?>		
											

	<?php echo $this->Form->input('Company.id', array(					
											'label' => array(
												'class' => 'col-md-8 control-label col-md-offset-1',
												'text' => 'id',),
											'placeholder' => 'id',
	)); ?>	
							
	<div style="text-align: left; margin-top: 50px;" class="col-md-7 col-md-offset-3 ">
		<strong style=" font-size: 17px; color: #fff"><br><span style="color:red;">*</span>¿Está seguro que desea eliminar su registro? <br> </strong>
	</div>

	<?php 	
		$options = array('s' => 'Si','n' => 'No');
								echo $this->Form->input('Company.disable', array(
													'type' => 'radio',
													'style' => 'margin-left: -12px; margin-top: 0; top: 7px; width: 15px;',
													'default'=> 0,
													'legend' => false,
													'label' => array(
													'style' => 'padding-bottom: 10px;  font-size: 16px;margin-top: 5px;',
													'class' => 'col-md-8',
													'text' => '¿Está seguro que desea desactivar su registro?'),
													'before' => '<div class="col-md-7 col-md-offset-5"><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
													'after' => '</label></div></div>',
													'separator' => '</label></div><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
													'options' => $options,
													'onclick' => 'desabilityOptions()'
									));
	?>
							
	<div id="encuestaId" class="col-md-7 col-md-offset-3" style="display:none">
			<div style="text-align: left;margin-top: -40px;">
				 <strong style=" font-size: 17px; color: #fff"> <br> Encuesta <br> </strong>
			</div>
							<?php 
								$cont = 0;
								foreach($preguntas as $k => $pregunta): 
								$cont++;
							?>	
								<?php 
									echo $this->Form->input('CompanyAnswer.'.$cont.'.question_id', array(
															'type' => 'hidden',
															'label' => array(
																	'style' => 'padding-bottom: 20px;  margin-top: 15px;',
																	'class' => 'col-md-9 control-label',
																	'text' => '¿'.$pregunta['Question']['id'].'?'),
															'value' => $pregunta['Question']['id'],
															'placeholder' => 'Respuesta...'
								));	
									
										
									if($pregunta['Question']['question_type'] == 1):
										echo $this->Form->input('CompanyAnswer.'.$cont.'.answer', array(
															'class' => 'selectpicker show-tick form-control show-menu-arrow',
															'label' => array(
																	'style' => 'padding-bottom: 20px;  margin-top: 15px;',
																	'class' => 'col-md-9 control-label',
																	'text' => '¿'.$pregunta['Question']['question'].'?'),
															'maxlength' => '632',
															'placeholder' => 'Respuesta...'
										));	
									else:
										if($pregunta['Question']['question_type'] == 2):
											echo $this->Form->input('CompanyAnswer.'.$cont.'.answer', array(
																'style' => 'resize: vertical; min-height: 150px;  max-height: 320px; height: 150px;',
																'type' => 'textarea',
																'label' => array(
																		'style' => 'padding-bottom: 20px;  margin-top: 15px;',
																		'class' => 'col-md-9 control-label',
																		'text' => '2.- ¿'.$pregunta['Question']['question'].'?'),
																'maxlength' => '632',
																'placeholder' => 'Respuesta...'
											));	
										else:
											if($pregunta['Question']['question_type'] == 3):
												echo $this->Form->input('CompanyAnswer.'.$cont.'.answer', array(
																	'type' => 'select',
																	'class' => 'selectpicker show-tick form-control show-menu-arrow',
																	'label' => array(
																			'style' => 'padding-bottom: 20px;  margin-top: 15px;',
																			'class' => 'col-md-9 control-label',
																			'text' => '1.- ¿'.$pregunta['Question']['question'].'?'),
																	'options' => $MotivosCancelacion,'default'=>'0', 
																	'empty' => 'Motivo'
												));	
											endif;
										endif;
									endif;
								?>
									
							<?php  endforeach; ?>
							<div class="col-md-8" style="text-align: right; top: -15px; right: -55px;">
								<span id="contadorTaComentario">0/632</span><span> caracteres máx.</span>
							</div>
						<div class="col-md-12">
						<?php echo $this->Form->submit('Eliminar Registro', array(
											'div' => 'form-group',
											'class' => 'btn btnRed btn-default col-md-9',
											'style' =>'left: 6px;'
							));?>
							<?php echo $this->Form->end();  ?>
						</div>
					</div>
				