<?php 
	$this->layout = 'home'; 
?>
	<style>
	.row {
		margin-left: -15px;
		margin-right: -15px;
	</style>
	<div class="container" style="min-width: 1170px; padding-left: 0px; padding-right: 0px;">

		<div class="col-md-12">
			<div class="col-md-2 col-md-offset-2" >
				<img src="/unam/img/home/bienvenido.jpg" alt="Bienvenido.jpg" style="margin-top: -15px;">
			</div>
		 </div>
		 
		 <div class="col-md-12" >
			
		 </div>
		 
		 <div class="col-md-12"  style="margin-bottom: 140px; margin-top: 140px;">
			<?php echo $this->Session->flash(); ?>
			<div class="col-md-6 col-md-offset-3" style="background-image: url('/unam/img/administrator/login.png'); background-repeat: no-repeat; height: 361px; width: 550px; padding-top: 200px; margin-right: 30px;";>
				<?php
					echo $this->Form->create('Administrator', array(
									'class' => 'form-horizontal', 
									'role' => 'form',
									'inputDefaults' => array(
										'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
										'div' => array('class' => 'form-group'),
										'class' => array('form-control'),
										'style' => 'width: 200px;',
										'label' => array('class' => 'col-xs-2 control-label'),
										'between' => '<div class="col-xs-4">',
										'after' => '</div>',
										'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
									),
									'action' => 'login'
					)); ?>
					<?php echo $this->Form->input('Administrator.username', array(
									'div' => array('class' => 'form-group',  'style'=>'margin-top: 60px;  margin-bottom: 15px;'),
									'label' => array(
										'class' => 'col-md-3 control-label',
										'text' => 'Usuario',
										'style'=>'height: 0px;'),
									'placeholder' => 'Usuario'
					)); ?>
					<?php echo $this->Form->input('Administrator.password', array(
									'label' => array(
										'class' => 'col-xs-3 control-label',
										'text' => 'Contraseña'),
									'placeholder' => 'Contraseña'
					)); ?>
					<?php echo $this->Form->submit('Ingresar', array(
							'div' => 'form-group',
							'style' => 'background-color: #9f0f00; border-width:0; margin: -135px 0 0 370px; width: 150px;',
							'class' => 'btn btnRed col-xs-offset-2'
						)); ?>
					<?php echo $this->Form->end(); ?>
					
			</div>
		 </div>
		 <div class="col-md-12" style="padding-left: 0px; padding-right: 0px; height: 80px;">
			<hr style="border-color: red; color: red; border-width: 4px 0 0;  margin-top: 0px;" size=1>
		</div>
	</div>
