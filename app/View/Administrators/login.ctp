<?php $this->layout = 'home'; ?>

<div class="col-md-12" style="margin-top: 5%;"> 
	<center>
		<?php echo $this->Html->image('logo.png', array('alt' => 'Background-image', 'style'=>'width: 15%;')); ?>
	</center>
</div>

<div class="col-md-6 col-md-offset-3">
	
	<div class="col-md-12 fondoBti whiteText" style="margin-bottom: 5px;">
		<h2>Administrador</h2>
	</div>

	<div class="col-md-12 fondoBti">
		<?= $this->Form->create('Administrator', [
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
											'action' => 'login',
											'style' => 'margin-top: 6%;margin-bottom: 25%;']); ?>

		<div class="col-md-7 col-md-offset-1">
			<?= $this->Form->input('Administrator.username',['label' => false,'placeholder'=> 'Usuario']); ?>
    		<?=	$this->Form->input('Administrator.password',['label' => false,'placeholder'=> 'Contraseña']); ?>
    	</div>

    	<div class="col-md-4 whiteText" style="margin-top: 4%;">
			<?= $this->Form->submit('INGRESAR', ['class' => 'btn col-md-12']); ?>
		</div>

		<?= $this->Form->end(); ?>
	</div>

</div>

<div class="col-md-10 col-md-offset-1" style="text-align: center; font-size: 16px; margin-top: 1%;margin-bottom: 3%;">
	<a href="#" data-toggle="modal" data-target="#aviso">Leer Aviso de Privacidad</a></p>
</div>
