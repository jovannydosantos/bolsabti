<?php 
	$this->layout = 'usuario'; 
?>
    <div id="page-wrapper" >
        <div id="page-inner">  
		<?php	
			$this->layout = 'usuario'; 
		 
			echo $this->Form->create('Student', array(
							'class' => 'form-horizontal', 
							'role' => 'form',
							'inputDefaults' => array(
								'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
								'div' => array('class' => 'form-group'),
								'class' => 'form-control',
								'label' => array('class' => 'col-lg-2 control-label '),
								'between' => '<div class="col-lg-4 ">',
								'after' => '</div>',
								'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
							),
							'action' => 'edit'
			)); ?>		

		<fieldset>
			<p class="lead col-lg-6 col-md-offset-3" >Datos de registro:</p>
			
			<?php 
					echo $this->Form->hidden('id', array('value' => $this->data['Student']['id']));
					echo $this->Form->input('StudentProfile.name', array(					
							'label' => array(
								'class' => 'col-lg-2 control-label col-md-offset-2',
								'text' => 'Nombre(s)',),
							'placeholder' => 'Nombre(s)',
							'onKeyDown' => 'return validar(event)'
			)); ?>
			<?php echo $this->Form->input('StudentProfile.last_name', array(					
							'label' => array(
								'class' => 'col-lg-2 control-label col-md-offset-2',
								'text' => 'Apellido paterno',),
							'placeholder' => 'Apellido paterno',
			)); ?>
			<?php echo $this->Form->input('StudentProfile.second_last_name', array(					
							'label' => array(
								'class' => 'col-lg-2 control-label col-md-offset-2',
								'text' => 'Apellido materno',),
							'placeholder' => 'Apellido materno',
			)); ?>
			<?php echo $this->Form->input('Student.email', array(				
							'label' => array(
								'class' => 'col-lg-2 control-label col-md-offset-2 ',
								'text'=>'Correo electrónico'),
							'placeholder' => 'Correo electrónico',					
			)); ?>
			<?php echo $this->Form->input('Student.username', array(					
							'label' => array(
								'class' => 'col-lg-2 control-label col-md-offset-2',
								'text' => 'Usuario: calve única UNAM',),
							'placeholder' => 'Usuario: clave única UNAM',
			)); ?>
			
			<p class="lead col-lg-6 col-md-offset-3" >Dirección:</p>
			
			<?php echo $this->Form->input('StudentProfile.street', array(					
							'label' => array(
								'class' => 'col-lg-2 control-label col-md-offset-2',
								'text' => 'Dirección calle y número',),
							'placeholder' => 'Dirección calle y número',
			)); ?>
			<?php echo $this->Form->input('StudentProfile.subdivision', array(					
							'label' => array(
								'class' => 'col-lg-2 control-label col-md-offset-2',
								'text' => 'Colonia',),
							'placeholder' => 'Colonia',
			)); ?>
			<?php echo $this->Form->input('StudentProfile.city', array(					
							'label' => array(
								'class' => 'col-lg-2 control-label col-md-offset-2',
								'text' => 'Delegación',),
							'placeholder' => 'Delegación',
			)); ?>
			<?php echo $this->Form->input('StudentProfile.state', array(					
							'label' => array(
								'class' => 'col-lg-2 control-label col-md-offset-2',
								'text' => 'Entidad Federativa / Estado',),
							'placeholder' => 'Entidad Federativa / Estado',
			)); ?>
			<?php echo $this->Form->input('StudentProfile.zip', array(					
							'label' => array(
								'class' => 'col-lg-2 control-label col-md-offset-2',
								'text' => 'Código Postal',),
							'placeholder' => 'Código Postal',
			)); ?>
			
			<p class="lead col-lg-6 col-md-offset-3" >Contacto:</p>
				
			<?php echo $this->Form->input('StudentProfile.cell_phone', array(					
							'label' => array(
								'class' => 'col-lg-2 control-label col-md-offset-2',
								'text' => 'Teléfono celular',),
							'placeholder' => 'Teléfono celular',
			)); ?>
			<?php echo $this->Form->input('StudentProfile.telephone_contact', array(					
							'label' => array(
								'class' => 'col-lg-2 control-label col-md-offset-2',
								'text' => 'Teléfono de casa',),
							'placeholder' => 'Teléfono de casa',
			)); ?>
			<?php echo $this->Form->input('StudentProfile.date_of_birth', array(					
					'label' => array(
						'class' => 'col-lg-2 control-label col-md-offset-2',
						'text' => 'Fecha de nacimiento',),
					'dateFormat' => 'YMD',
					'separator' => '',
					'minYear' => date('Y') - 100,
					'maxYear' => date('Y') - 0,
			)); ?>
			<?php 	$options = array('m' => 'Masculino', 'f' => 'Femenino');
					echo $this->Form->input('StudentProfile.sex', array(
							'type'=>'select',
							'label' => array(
								'class' => 'col-lg-2 control-label col-md-offset-2',
								'text' => 'Sexo',),
							'options' => $options,'default'=>'0', 'empty' => 'Selecciona tu sexo'));
		   ?>
		   <?php 	$options = array('s' => 'Soltero(a)', 'c' => 'Casado(a)');
					echo $this->Form->input('StudentProfile.marital_status', array(
							'type'=>'select',
							'label' => array(
								'class' => 'col-lg-2 control-label col-md-offset-2',
								'text' => 'Estado civil',),
							'options' => $options,'default'=>'0', 'empty' => 'Selecciona tu estado civil'));
		   ?>
			<center>
				<?php echo $this->Form->submit('Guardar', array(
								'div' => 'form-group',
								'class' => 'btn btn-success btn-lg'
				));?>
			</center>
		</fieldset>
	</div>
	</div>

