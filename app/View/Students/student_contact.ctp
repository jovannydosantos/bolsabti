<?php 
	$this->layout = 'student'; 
?>
	<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
        <p style="color: #588BAD;">Sección para enviar su currículum generado por el sistema automáticamente a quien usted desee.</p>
    </blockquote>

	<div class="col-md-10 col-md-offset-1 fondoBti" style="margin-bottom: 15px; margin-top: 15px; padding: 20px 0px 0px;" >
		
		<div class="col-md-12">
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
											'action' => 'studentContact']); ?>

			<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
		        <p style="color: #000; font-weight: bold;">Si necesita agregar más de un correo estos deberan estar separados por un punto y coma ';'.</p>
		    </blockquote>

			<fieldset>
				
				<?= $this->Form->input('email',['type' => 'hidden','value' => $student['Student']['email']]); ?>

				<?= $this->Form->input('emailTo', ['placeholder' => 'Para']); ?>

				<?= $this->Form->input('CC', ['placeholder' => 'CC']); ?>

				<?= $this->Form->input('CCO', ['placeholder' => 'CCO']); ?>

				<?= $this->Form->input('title', ['placeholder' => 'Título']); ?>

				<?php if($cvExiste == true): ?>
					<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
				        <p style="color: #fff; font-weight: bold;"><i class="glyphicon glyphicon-ok"></i> Su currículum ha sido cargado. </i></p>
				    </blockquote>
				<?php else: ?>
					<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
				       <p style="color: #8A0808;font-weight: bold;"><i class="glyphicon glyphicon-remove"></i> Lo sentimos su currículum no ha podido cargarse, intente visualizar su CV en vista previa impresión.</p>
				   		<center>
					    <?= $this->Html->link('Ver CV vista previa &nbsp; <i class="glyphicon glyphicon-file"></i>', 
																['controller'=>'Students',
																'action'=>'usuario'],
																['class' => 'btn btn-info ',
																'escape' => false]); ?> 
						</center>
					</blockquote>
				<?php endif; ?>
				
				<?= $this->Form->input('message', ['placeholder' => 'Mensaje','type'=>'textarea','rows' => '5','cols' => '5','class' => 'form-control responsabilidadesClass','style' => 'resize: vertical; min-height: 75px;  max-height: 150px; height: 130px;','maxlength' => '210', 'onkeypress'=> 'caracteresCont("StudentResponsability0Responsability", "contadorResponsabilidades0",210)']); ?>

				<?= $this->Form->input('sign', ['placeholder' => 'Firma']); ?>

				
				</fieldset>
			</div>
		</div>
	</div>

	<?php if($cvExiste == true): ?>
		<div class="col-md-12 text-center">
			<?= $this->Form->button('Enviar &nbsp; <i class="glyphicon glyphicon-send"></i>',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
			<?= $this->Form->end(); ?>
		</div>	
	<?php endif; ?>