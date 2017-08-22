	<?php 
		$this->layout = 'student'; 
	?>
	<?= $this->element('contadorCaracteres'); ?>
	<script type="text/javascript">
		function desabilityOptions(){
			if($("#StudentDisable").val()=='s') {  
				$('#encuestaId').show();
			} else {
				$('#encuestaId').hide();
			}
		}
	</script>
		
	<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
        <p style="color: #588BAD;">Eliminar registro.</p>
    </blockquote>
		
	<div class="col-md-8 col-md-offset-2">
			<?= $this->Form->create('Student', [
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
											'action' => 'disableStudentRegister']); ?>
	
		<?= $this->Form->input('Student.id'); ?>

		<div class="asterisk">*</div>
		<?php $options = array('s' => 'Si', 'n' => 'No');
			echo $this->Form->input('Student.disable', ['type' => 'select','default'=> 0,'empty' => '¿Está seguro que desea eliminar su registro?','options' => $options,'onchange' => 'desabilityOptions()','class' => 'selectpicker show-tick form-control show-menu-arrow']);
		?>

		<div id="encuestaId" style="display:none">
			
			<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
		        <p style="color: #588BAD;">Encuesta.</p>
		    </blockquote>
		
			<?php 
				$cont = 0;
				foreach($preguntas as $k => $pregunta): 
				$cont++;
			?>	

				<?= $this->Form->input('StudentAnswer.'.$cont.'.question_id', ['type' => 'hidden','value' => $pregunta['Question']['id'],'placeholder' => 'Respuesta...']); ?>

				<?php
					if($pregunta['Question']['question_type'] == 1):

						echo $this->Form->input('StudentAnswer.'.$cont.'.answer', ['type' => 'textarea','placeholder' => 'Comentario','text' => '¿'.$pregunta['Question']['question'].'?','maxlength' => '632','onkeypress'=> 'caracteresCont("StudentAnswer1Answer", "contadorTaComentario",632)']);

					else:
						if($pregunta['Question']['question_type'] == 2):

							echo $this->Form->input('StudentAnswer.'.$cont.'.answer', ['type' => 'textarea','placeholder' => 'Comentario','text' => '2.- '.$pregunta['Question']['question'],'maxlength' => '632','onkeypress'=> 'caracteresCont("StudentAnswer2Answer", "contadorTaComentario",632)']);

						else:
							if($pregunta['Question']['question_type'] == 3):

									echo $this->Form->input('StudentAnswer.'.$cont.'.answer', ['type' => 'select','options' => $MotivosCancelacion,'default'=>'0', 'empty' => 'Motivo','text' => '1.- '.$pregunta['Question']['question'],'class' => 'selectpicker show-tick form-control show-menu-arrow',]);

							endif;
						endif;
					endif;
				?>
									
					<?php  endforeach; ?>
					
		
			<div style="text-align: right;">
				<span id="contadorTaComentario">0/632</span><span> caracteres máx.</span>
			</div>

			<div class="col-md-12 text-center">
				<div style="display: none">
					<?= $this->Form->button('Eliminar &nbsp; <i class="glyphicon glyphicon-remove-sign"></i>',['type'=>'submit','class' => 'btn btn-danger','escape' => false,'id'=>'eliminarRegistro']);?>
					<?= $this->Form->end(); ?>
				</div>	
				<?= $this->Html->link('<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar', '#',[
										'onclick' =>"return confirma('Registro');",
										'class' => 'btn btn-danger btn-sm',
										'escape'=> false]); ?>

			</div>			
		</div>
	</div>
