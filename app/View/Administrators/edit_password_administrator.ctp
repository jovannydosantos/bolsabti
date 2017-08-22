	<?php 
		$this->layout = 'administrator'; 
	?>
	<script>
		$(document).ready(function() {
			$( "#AdministratorPassword" ).val('');
			$( "#AdministratorPasswordConfirm" ).val('');
		});
		
	</script>
	
	<?php echo $this->Session->flash(); ?>
		
		<?php	echo $this->Form->create('Administrator', array(
						'type' => 'file',
						'class' => 'form-horizontal', 
						'role' => 'form',
						'inputDefaults' => array(
							'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
							'div' => array('class' => 'form-group'),
							'class' => 'form-control',
							'before' => '<div class="col-md-11 col-md-offset-1">',
							'between' => '<div class="col-md-11">',
							'after' => '</div></div>',
							'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style'=>'padding-left: 5px; padding-right: 5px;'))
						),
						'action' => 'editPasswordAdministrator',
		)); ?>		
		
		<fieldset style="margin-top: 70px; ">
		
		<div style="background-color: #835B06; margin-bottom: 15px; padding: 15px 0 0; " class="col-md-7 col-md-offset-2" >
			<div class="col-md-10 col-md-offset-1">
			
				<div style="text-align: center; font-weight: bold;" >
				   <p> Editar acceso al sistema</p>
				</div>

			</div>
			
			<div class="col-md-12"  style="margin-top: 30px;" >
				<?php echo $this->Form->input('Administrator.id', array(
								'before' => '<div class="col-md-11" ><img data-toggle="tooltip" id="" data-placement="right" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" style="margin-top: 8px;" src="/unam/img/help.png">',
								'between' => '<div class="col-md-6 ">',
								'label' => array(
											'class' => 'col-md-5 control-label',
											'text' => 'Usuario:',
											),
								)); 
				?>
				 <?php echo $this->Form->input('Administrator.username', array(
								'before' => '<div class="col-md-11" ><img data-toggle="tooltip" id="" data-placement="right" title="Aisgne un nombre al usuario que desea crear" alt="help.png" class="img-circle cambia" style="margin-top: 8px;" src="/unam/img/help.png">',
								'between' => '<div class="col-md-6 ">',
								'label' => array(
											'class' => 'col-md-5 control-label',
											'text' => 'Usuario:',
											),
								)); 
				?>
				 <?php echo $this->Form->input('Administrator.password', array(
								'before' => '<div class="col-md-11 " ><img data-toggle="tooltip" id="" data-placement="right" title="Clave de 6 caracteres mínimo y 10 caracteres máximo, la cual debe contener caracteres alfanuméricos, letras y signos." class="img-circle cambia" alt="help.png" style="margin-top: 8px;" src="/unam/img/help.png">',
								'between' => '<div class="col-md-6 ">',
								'label' => array(
											'class' => 'col-md-5 control-label',
											'text' => 'Contraseña:',
											),
								)); 
				?>
				<div style="margin-bottom: 50px;">
				 <?php echo $this->Form->input('Administrator.password_confirm', array(
								'type' => 'password',
								'before' => '<div class="col-md-11" >',
								'between' => '<div class="col-md-6 ">',
								'label' => array(
											'class' => 'col-md-5 control-label',
											'text' => 'Confirmar contraseña:',
											),
								)); 
				?>
				</div>
			
			</div>

		</div>
		</fieldset>
		
			<div style="margin-top: 20px;" class="col-md-7 col-md-offset-2">
					<?php 
						echo $this->Form->button('<i class=" glyphicon glyphicon-floppy-save"></i>&nbsp; Guardar', array(
											'type' => 'submit', 
											'div' => 'form-group',
											'class' => 'btn btnRed btn-default col-md-offset-5',
											'escape' => false,
						));
						
						echo $this->Form->end(); 
					?>
			</div>
