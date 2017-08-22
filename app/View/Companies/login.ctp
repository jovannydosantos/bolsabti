<?php
	$this->layout = 'home'; 

	echo $this->Form->create('Company', array(
					'class' => 'form-horizontal', 
					'role' => 'form',
					'inputDefaults' => array(
						'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
						'div' => array('class' => 'form-group'),
						'class' => array('form-control'),
						'label' => array('class' => 'col-lg-2 control-label'),
						'between' => '<div class="col-lg-4">',
						'after' => '</div>',
						'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
					),
					'action' => 'login'
	)); ?>
<br>	
<legend class="col-md-offset-2" style="border-width: 0;" >Iniciar Sesión</legend>
<fieldset>
    <?php echo $this->Form->input('Company.username', array(
					'label' => array(
						'class' => 'col-lg-2 control-label',
						'text' => 'Usuario'),
					'placeholder' => 'Usuario'
	)); ?>
    <?php echo $this->Form->input('Company.password', array(
					'label' => array(
						'class' => 'col-lg-2 control-label',
						'text' => 'Contraseña'),
					'placeholder' => 'Contraseña'
	)); ?>
	<?php echo $this->Form->submit('Iniciar sesión', array(
			'div' => 'form-group',
			'class' => 'btn btn-default  col-md-offset-2'
		)); ?>
	<?php
		echo $this->Html->link( "¿Olvidaste tu contraseña?",  
			array(
				'controller' => 'Company', 
				'action' => 'codeRecoveryPassword'),
			array(
				'class'=>'col-md-offset-2',
				'style' =>'color: #044c89 ',
				'escape' => false)	
				
				); 
		?>
</fieldset><br><br>
