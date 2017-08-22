	<?php	$this->layout = 'register'; ?>
	
	<div class="col-md-12">
		
		<?= $this->Form->create('Student', [
					'class' => 'form-horizontal', 
								'role' => 'form',
								'inputDefaults' => [
									'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
									'div' => ['class' => 'form-group'],
									'class' => ['form-control'],
									'label' => ['class' => 'col-md-4 control-label'],
									'before' => '<div class="col-md-6 col-md-offset-3 ">',
									'between' => '<div class="col-md-12">',
									'after' => '</div></div>',
									'error' => ['attributes' => ['wrap' => 'span', 'class' => 'help-inline']],
								],
					'action' => 'codeRecoveryPassword',
					
		]); ?>		

		<div style="margin-top: 130px; padding: 50px 0;" class="col-md-6 col-md-offset-3 centered fondoBti">
			
			<center><b style="font-size: 18px; color: #fff">Recuperar contraseña</b>
			
			<fieldset style="padding-top: 20px;">
				<?= $this->Form->input('email',['type'=>'email','label' => false,'placeholder' => 'Correo electrónico']); ?>
			</fieldset>
			</center>
		</div>

		<div class="col-md-2 col-md-offset-4 whiteText" style="margin-top: 2%;">
			<?=  $this->Html->link("Volver", array('controller' => 'students','action'=> 'logout'), array( 'class' => 'btn col-md-12' )) ?>
		</div>

		<div class="col-md-2 whiteText" style="margin-top: 2%;">
			<?= $this->Form->submit('Enviar', ['class' => 'btn col-md-12']); ?>
			<?= $this->Form->end(); ?>
		</div>

	</div>