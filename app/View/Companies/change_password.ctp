<?php 
	$this->layout = 'company'; 
?>
<script>
	$(window).load(function() {
		var helpText = [
						"Clave con la que ingresa al sistema.",
						"Nueva clave de 6 caracteres mínimo y 10 caracteres máxima, la cual debe contener caracteres alfanuméricos, letras y signos.",						
						];
		 
		$('.form-group').each(function(index, element) {
			$(this).find(".cambia").attr("id", index);
			$(this).find('#'+index).attr("data-original-title", helpText[index]);
		});
		
	});
</script>

	<div class="col-md-12" style="margin-top: 30px;">	
		<?php echo $this->Session->flash(); ?>	
		
		<?php 
		
			echo $this->Form->create('Company', array(
							'class' => 'form-horizontal', 
							'role' => 'form',
							'inputDefaults' => array(
								'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
								'div' => array('class' => 'form-group'),
								'class' => 'form-control',
								'label' => array('class' => 'col-xs-4 col-sm-4 col-md-2 col-md-4 control-label '),
								'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
								'between' => '<div class="col-xs-12 col-sm-6 col-md-5 ">',
								'after' => '</div></div>',
								'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
							),
							'action' => 'changePassword'
			)); ?>
			
		  <div class="col-md-12 margin-top: 60px;" >
			<center style="margin-top: 120px;"><b style="font-size: 20px;">Modificar Contraseña</b></center>
			
			<div style="background-color: #835B06; margin-bottom: 15px; margin-top: 20px; padding: 50px 0;" class="col-xs-12 col-sm-10 col-md-7 col-sm-offset-1 col-md-offset-1 col-centered ">
		
				<fieldset>
			
					<?php echo $this->Form->input('id', array(					
									'label' => array(
										'class' => 'col-xs-12 col-sm-4 col-md-5 control-label ',
										'text' => 'id de usuario',
										),
									'placeholder' => 'id de usuario',
									'type' => 'hidden',
					)); ?>
					<?php echo $this->Form->input('username', array(					
									'label' => array(
										'class' => 'col-xs-12 col-sm-4 col-md-5 control-label ',
										'text' => 'username',
										),
									'placeholder' => 'username',
									'type' => 'hidden',
					)); ?>
					<?php echo $this->Form->input('password', array(	
									'type' => 'hidden',
									'label' => array(
										'class' => 'col-xs-12 col-sm-4 col-md-5 control-label ',
										'text' => ''),
									'placeholder' => ''
					)); ?>
					<?php echo $this->Form->input('old_password', array(
									'type' => 'password',				
									'label' => array(
										'class' => 'col-xs-12 col-sm-4 col-md-5 control-label ',
										'text' => 'Contraseña actual'),
									'placeholder' => 'Contraseña actual'
					)); ?>
					<?php echo $this->Form->input('new_password', array(
									'type' => 'password',
									'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="Nueva clave de 6 caracteres mínimo y 
									10 caracteres máxima, la cual debe contener caracteres alfanuméricos, letras y signos." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',				
									'label' => array(
										'class' => 'col-xs-5 control-label',
										'text' => 'Escribir nueva contraseña'),
									'placeholder' => 'Escribir nueva contraseña'
					)); ?>
					<?php echo $this->Form->input('new_password_confirm', array(
									'type' => 'password',
									'before' => '<div class="col-md-12 ">',
									'label' => array(
										'class' => 'col-xs-5 control-label',
										'text' => 'Confirmar contraseña'),
									'placeholder' => 'Confirmar contraseña'
					)); ?>	
					<?php echo $this->Form->input('email', array(	
							'type' => 'hidden',
							'before' => '<div class="col-md-12 ">',
							'label' => array(
								'class' => 'col-xs-5 control-label',
								'text'=>'Confirmar correo electrónico de registro'),
							'placeholder' => 'Confirmar correo electrónico de registro',					
					)); ?>
					<?php echo $this->Form->input('email_confirm', array(	
							'type' => 'email',
							'before' => '<div class="col-md-12 ">',
							'label' => array(
								'class' => 'col-xs-5 control-label',
								'text'=>'Confirmar correo electrónico principal'),
							'placeholder' => 'Confirmar correo electrónico de registro',					
					)); ?>
			</div>
					<?php echo $this->Form->button('<i class=" glyphicon glyphicon-floppy-save"></i>&nbsp; Guardar',array(
							'type' => 'submit',
							'div' => 'form-group',
							'class' => 'btn btnBlue btn-default col-xs-offset-7 col-md-offset-9',
							'style'=> 'width: 156px;left: -9px;',
					));
					echo $this->Form->end(); 
					?>
					
				</fieldset>
	</div>	
</div>	
		
		