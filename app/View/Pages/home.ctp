	<?php $this->layout = 'home'; ?>

<div class="col-md-12" style="margin-top: 5%;"> 
	<center>
		<?php echo $this->Html->image('logo.png', array('alt' => 'Background-image', 'style'=>'width: 15%;')); ?>
	</center>
</div>


<div class="col-md-5 col-md-offset-1">
	
	<div class="col-md-12 fondoBti whiteText" style="margin-bottom: 5px;">
		<h2>Universitarios</h2>
	</div>

	<div class="col-md-12 fondoBti">

			<?= $this->Form->create('Student', [
								'class' => 'form-horizontal', 
								'role' => 'form',
								'inputDefaults' => [
									'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
									'div' => ['class' => 'form-group'],
									'class' => ['form-control'],
									'label' => ['class' => 'col-md-2 control-label'],
									'between' => '<div class="col-md-12">',
									'after' => '</div>',
									'error' => ['attributes' => ['wrap' => 'span', 'class' => 'help-inline']],
								],
								'action' => 'login',
								'style' => 'margin-top: 5%;'
				]); ?>
				
				<div class="col-md-7 col-md-offset-1">
					<?= $this->Form->input('username',['label' => false,'placeholder'=> 'Número de cuenta']); ?>
            		<?=	$this->Form->input('password',['label' => false,'placeholder'=> 'Contraseña']); ?>
            	</div>

            	<div class="col-md-4 whiteText" style="margin-top: 4%;">
					<?= $this->Form->submit('INGRESAR', ['class' => 'btn col-md-12']); ?>
				</div>

				<?= $this->Form->end(); ?>
				
				<div class="col-md-12" style="padding: 15px;">
	    			<div class="col-md-6">
		    			<center class="whiteText" >
							<?= $this->Html->link('<span class="glyphicon glyphicon-user"></span>  Nuevo universitario',
											['controller' => 'Students',
											 'action' => 'register'],
											['escape' => false]
										); ?>
						</center>
					</div>
					<div class="col-md-6">
		    			<center class="whiteText" >
							<?= $this->Html->link('<span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Olvidé mi contraseña',
								   			['controller' => 'Students',
											'action' => 'codeRecoveryPassword'],
											['escape' => false]
										); ?>
						</center>
					</div>
				</div>
	</div>
</div>

<div class="col-md-5">

	<div class="col-md-12 fondoBti whiteText" style="margin-bottom: 5px;">
		<h2>Empresas</h2>
	</div>

	<div class="col-md-12 fondoBti">
		<?= $this->Form->create('Company', array(
							'class' => 'form-horizontal', 
							'role' => 'form',
							'inputDefaults' => array(
								'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
									'div' => ['class' => 'form-group'],
									'class' => ['form-control'],
									'label' => array('class' => 'col-md-2 control-label'),
									'between' => '<div class="col-md-12">',
									'after' => '</div>',
									'error' => ['attributes' => ['wrap' => 'span', 'class' => 'help-inline']],
							),
							'action' => 'login',
							'style' => 'margin-top: 5%;'
			)); ?>

			<div class="col-md-7 col-md-offset-1">
				<?= $this->Form->input('username',['label' => false,'placeholder'=> 'RFC']); ?>
            	<?=	$this->Form->input('password',['label' => false,'placeholder'=> 'Contraseña']); ?>
			</div>

			<div class="col-md-4 whiteText" style="margin-top: 4%;">
				<?= $this->Form->submit('INGRESAR', ['class' => 'btn col-md-12']); ?>
			</div>

			<?= $this->Form->end(); ?>
			
	    	<div class="col-md-12" style="padding: 15px;">
	    		<div class="col-md-6">
		    		<center class="whiteText" >
						<?= $this->Html->link('<span class="glyphicon glyphicon-home"></span>  Nueva empresa',
											['controller' => 'Companies',
											'action' => 'register'],
											['escape' => false]
										); ?>
					</center>
				</div>
				<div class="col-md-6">
		    		<center class="whiteText" >
						<?= $this->Html->link('<span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Olvidé mi contraseña',
											['controller' => 'Companies',
											'action' => 'codeRecoveryPassword'],
											['escape' => false]
										); ?>
					</center>
				</div>
			</div>

	</div>
</div>

<div class="col-md-10 col-md-offset-1" style="text-align: center; font-size: 16px; margin-top: 1%;">
	<a href="#" data-toggle="modal" data-target="#aviso">Leer Aviso de Privacidad</a></p>
</div>

