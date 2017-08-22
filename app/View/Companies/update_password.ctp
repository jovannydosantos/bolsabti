<?php
	$this->layout = 'register'; 
?>
	<script>
	$(window).load(function() {
		var helpText = [
						"Nueva contraseña",
						"Confirma la contraseña"						
						];
		 
		$('.form-group').each(function(index, element) {
			$(this).find(".cambia").attr("id", index);
			$(this).find('#'+index).attr("data-original-title", helpText[index]);
		});
	});
	</script>
	
	<div class="container" style="margin-bottom: 130px; margin-top: 70px;">
	
	<?php	
	echo $this->Form->create('Company', array(
					'class' => 'form-horizontal', 
					'role' => 'form',
					'inputDefaults' => array(
						'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
						'div' => array('class' => 'form-group'),
						'class' => 'form-control',
						'label' => array('class' => 'col-xs-4 col-sm-4 col-md-2 col-md-4control-label '),
						'before' => '<div class="col-md-12 ">',
						'between' => '<div class="col-md-5 ">',
						'after' => '</div></div>',
						'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
					),
					'action' => 'updatePassword'
	)); ?>
	<br>
	
	<div style="background-color: #835B06; margin-bottom: 15px; margin-top: 70px; padding: 50px 0;" class="col-md-7 col-md-offset-3 col-centered ">
		<?php echo $this->Session->flash(); ?>
		<center style="margin-top: 15px; margin-bottom: 25px;">
			<b style=" font-size: 20px; color: #231F20">Modificar contraseña Empresa / Institución</b>
		</center>
		
		<fieldset style="padding-top: 20px;">
		<?php echo $this->Form->input('cod', array(					
						'label' => array(
							'class' => 'col-xs-12 col-sm-4 col-md-5 control-label ',
							'text' => 'código de verificación',
							),
						'placeholder' => 'código de verificación',
						'default' => $this->request->query('cod'),
						'type' => 'hidden',
		)); ?>
		<?php echo $this->Form->input('id', array(					
						'label' => array(
							'class' => 'col-xs-12 col-sm-4 col-md-5 control-label ',
							'text' => 'id de usuario',
							),
						'placeholder' => 'id de usuario',
						'default' => $this->request->query('id'),
						'type' => 'hidden',
		)); ?>
		<?php echo $this->Form->input('password', array(				
						'label' => array(
							'class' => 'col-xs-12 col-sm-4 col-md-5 control-label ',
							'text' => 'Nueva contraseña'),
						'placeholder' => 'Nueva Contraseña'
		)); ?>
		<?php echo $this->Form->input('password_confirm', array(
						'type' => 'password',
						'label' => array(
							'class' => 'col-xs-12 col-sm-4 col-md-5 control-label ',
							'text' => 'Confirma tu nueva contraseña'),
						'placeholder' => 'Confirma tu nueva contraseña'
		)); ?>	
		<div  class="col-md-3 col-md-offset-6" style="left: 25px;">
		<?php echo $this->Form->submit('Enviar', array(
				'div' => 'form-group',
						'class' => 'btn btnBlue btn-default',
						'style'=> 'background-color: #283274; width: 100px;'
			)); ?>
		</div>
		</fieldset>
	</div>
</div>