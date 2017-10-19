	<?php 
		$this->layout = 'administrator'; 
	?>
		<?= $this->element('contadorCaracteres'); ?>
	<script>
		function validateEmpty(){
			selectedIndex = document.getElementById("AdministratorCriterio").selectedIndex;
			
			if(document.getElementById('AdministratorBuscar').value == ''){
				jAlert('Ingrese la palabra a buscar', 'Mensaje');
				document.getElementById('AdministratorBuscar').focus();
				return false;
			} else 
			if(selectedIndex == 0){
				$( "#AdministratorCriterio" ).focus();
				jAlert('Seleccione el criterio de búsqueda', 'Mensaje');
				document.getElementById('AdministratorCriterio').focus();
				return false;
			}else {
				return true;
			}
		}

		function sendLimit(){
			 selectedIndex = document.getElementById("limit").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				document.getElementById('AdministratorLimite').value = document.getElementById('limit').value;
				// document.getElementById("sendPaginadoForm").submit();
			 }
		}
		
	</script>

	<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
        <p style="color: #588BAD">El sistema buscará por el siguiente criterio: número de cuenta, nombre(s), apellidos(s) o correo electrónico.</p>
    </blockquote>

    <?= $this->Form->create('Administrator', [
						'class' => 'form-horizontal', 
						'role' => 'form',
						'id' => 'sendPaginadoForm',
						'inputDefaults' => [
							'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
							'div' => ['class' => 'form-group'],
							'class' => 'form-control',
							'label' => ['class' => 'col-md-12 control-label', 'text'=>''],
							'between' => '<div class="col-md-12">',
							'after' => '</div>',
							'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
						],
						'action' => 'searchStudentOffer',
						'onsubmit' =>'return validateEmpty();']); ?>
	<fieldset>
		<div  class="col-md-3">
			<?php 	$options = array('11' =>'Número de cuenta', '12' => 'Nombre(s)', '13' => 'Apellidos(s)', '14' => 'Correo electrónico'); ?>
			<?= $this->Form->input('criterio', ['type'=>'select','options' => $options,'selected' => $this->Session->read('tipoBusqueda'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Criterio de búsqueda']); ?>
		</div>
		<div class="col-md-6">
			<?= $this->Form->input('Buscar', ['placeholder' => 'Nombre de la empresa / Puesto / Folio','value'	=> $this->Session->read('palabraBuscada')]); ?>
		</div>
		<?php echo $this->Form->input('limite', array('type'=>'hidden')); ?>
		<div class="col-md-2">
			<?= $this->Form->button('Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',['type'=>'submit','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px;']);?>
			<?= $this->Form->end(); ?>
		</div>
	</fieldset>
	
	<?php 
		$opcionElegida = $this->Session->read('optionSearchStudentOffer');
		if($opcionElegida == 1):
			$texto = 'Entrevistas telefónicas: ';
		else:
			if($opcionElegida == 2):
				$texto = 'Entrevistas presenciales: ';
			else:
				if($opcionElegida == 3):
					$texto = 'Contrataciones: ';
				else:
					if($opcionElegida == 4):
						$texto = 'Postulaciones: ';
					endif;
				endif;
			endif;
		endif;
	?>
	
	<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
        <p style="color: #588BAD"><?php echo $texto. $this->Session->read('totalStudents'); ?></p>
    </blockquote>
		
	<?php if(isset($candidatos)): 
			if(empty($candidatos)):
				echo '<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;"><p style="color: #588BAD">Sin ofertas.</p></blockquote>';
				echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> &nbsp;&nbsp; Regresar', 
										['controller'=>'Administrators',
										'action'=>$this->Session->read('volver')],
										['class' => 'btn btn-default ',
										'style' => 'margin-top: 5px; width: 145px;',
										'escape' => false]	);
				else:
	?>
			
					<div class="col-md-12">
					<div class="col-md-3" >
						<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 5px;">
					        <p style="color: #588BAD">Opciones:</p>
					    </blockquote>
				    </div>
					<div class="col-md-3" >
						<?= $this->Html->link('Descargar Excel  &nbsp;&nbsp;&nbsp; <i class="fa fa-file-excel-o" aria-hidden="true"></i>', 
																['controller'=>'Administrators',
																'action'=>'searchStudentOfferExcel'],
																['class' => 'btn btn-default btnBlue ',
																'style' => 'width: 226px; font-size: 14px; height: 33px; text-align: left',
																'escape' => false]);?>
					</div>
					
					<div class="col-md-4">
						<?= $this->Form->create('Administrator', [
									'class' => 'form-horizontal', 
									'role' => 'form',
									'inputDefaults' => [
										'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
										'div' => ['class' => 'form-group'],
										'class' => 'form-control',
										'label' => ['class' => 'col-md-12 control-label', 'text'=>''],
										'between' => '<div class="col-md-9" style="margin-top: -8px;">',
										'after' => '</div>',
										'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
									],
									'action' => 'searchStudent']); ?>
						<?php $options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200); ?>
						<?= $this->Form->input('limit', ['type'=>'select','id'=> 'limit','options' => $options,'selected' => $this->Session->read('limiteAdmin'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Resultados por hoja','onchange'=> 'sendLimit();']); ?>

						<?= $this->Form->end(); ?>

					</div>
				</div>

		<!-- <div class="col-md-10"  style="padding-left: 0px;">
			<div class="col-md-12" style="padding-left: 0px;">
				<p style=" margin-left: 15px">Resultados de Búsqueda</p>
			</div>
				<div class="col-md-3" >
						<?php 	echo $this->Html->link(
													'Descargar Excel  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon glyphicon-save"></i>', 
															array(
																	'controller'=>'Administrators',
																	'action'=>'searchStudentOfferExcel',
																),
																array(
																	'class' => 'btn btn-default btnBlue ',
																	'style' => 'width: 180px; font-size: 14px; height: 32px;',
																	'escape' => false,
																	)	
												); 
						?>
				</div>
				
				<div class="col-md-3" style="padding-left: 0px;  left: -25px;">
					<?php 	$options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200);
							echo $this->Form->input('limit', array(
																'onchange' => 'sendLimit()' ,
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width' => '180px',
																'style' => 'width: 180px; height: 32px;',
																'before' => '<div class="col-md-12 "',
																'selected' => $this->Session->read('limite'),
																'label' =>'',
																'options' => $options,'default'=>'0', 'empty' => 'Resultados por hoja'
					)); ?>
				</div>
				
		</div> -->
					<div class="col-md-12 scrollbar" id="style-2" style="margin-top: 30px">
						<?= $this->element('universitariosAdmin'); ?>
						<?= $this->element('paginacionStudentAdmin'); ?>
					</div>
			<?php 
				endif;
				endif; 
			?>
		</div>
		
		<div class="col-md-11">
		<?php 
		if(!empty($candidatos)):
		echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> &nbsp;&nbsp; Regresar', 
													['controller'=>'Administrators',
													'action'=>$this->Session->read('volver')],
													['class' => 'btn btn-default ',
													'style' => 'margin-top: 5px; width: 145px;',
													'escape' => false]	);

		endif; 
		?>
	</div>