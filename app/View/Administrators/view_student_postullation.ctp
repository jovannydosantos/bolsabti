	<?php 
		$this->layout = 'administrator'; 
	?>
	<script type="text/javascript">
		function validateEmpty(){
			selectedIndex = document.getElementById("AdministratorCriterio").selectedIndex;
			if(document.getElementById('AdministratorBuscar').value == ''){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese el nombre de la empresa, puesto ó folio a buscar'});
				return false;
			} else 
			if(selectedIndex == 0){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione el criterio de búsqueda'});
				return false;
			}else {
				return true;
			}
		}
	</script>

	<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
        <p style="color: #588BAD">El sistema buscará por el siguiente criterio: nombre de la empresa, puesto o folio dentro de las ofertas postuladas.</p>
    </blockquote>
	
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
						'action' => 'viewStudentPostullation',
						'onsubmit' =>'return validateEmpty();']); ?>
	<fieldset>
		<div  class="col-md-3">
			<?php 	$options = array('1' => 'Nombre de la empresa', '2' => 'Puesto', '3' => 'Folio'); ?>
			<?= $this->Form->input('criterio', ['type'=>'select','options' => $options,'selected' => $this->Session->read('tipoBusqueda'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Criterio de búsqueda']); ?>
		</div>
		<div class="col-md-6">
			<?= $this->Form->input('Buscar', ['placeholder' => 'Nombre de la empresa / Puesto / Folio','value'	=> $this->Session->read('palabraBuscada')]); ?>
		</div>
		<div class="col-md-2">
			<?= $this->Form->button('Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',['type'=>'submit','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px;']);?>
			<?= $this->Form->end(); ?>
		</div>
	</fieldset>

	<?php if(isset($ofertas)): 
			if(empty($ofertas)):
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
					<label>Resultados de búsqueda:</label>
				</div>

				<div class="col-md-12 scrollbar" id="style-2" style="margin-top: 30px">
					<?= $this->element('ofertasPostuladasAdmin'); ?>
				</div>
	<?php 
			endif;
		   endif; 
	?>
	
	<div class="col-md-11">
		<?php 
		if(!empty($ofertas)):
		echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> &nbsp;&nbsp; Regresar', 
													['controller'=>'Administrators',
													'action'=>$this->Session->read('volver')],
													['class' => 'btn btn-default ',
													'style' => 'margin-top: 5px; width: 145px;',
													'escape' => false]	);

		endif; 
		?>
	</div>