	<?php 
		$this->layout = 'administrator'; 
	?>
	<?= $this->element('contadorCaracteres'); ?>
	<script>
		function validateEmpty(){
			selectedIndex = document.getElementById("AdministratorCriterio").selectedIndex;
			
			if(document.getElementById('AdministratorBuscar').value == ''){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese la palabra a buscar'});
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
        <p style="color: #588BAD">El sistema buscará por el siguiente criterio: RFC, nombre de la empresa o institución o razón social.</p>
    </blockquote>

	<div class="col-md-12">
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
								'action' => 'searchCompany',
								'onsubmit' =>'return validateEmpty();']); ?>
	
		<fieldset>
			<div class="col-md-3">
				<?php $options = array('1' =>'RFC', '2' => 'Nombre de la empresa o insitución', '8'=> 'Nombre contacto', '9' => 'Correo electrónico institucional'); ?>
				<?= $this->Form->input('criterio', ['type'=>'select','options' => $options,'selected' => $this->Session->read('tipoBusquedaAdmin'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Criterio de búsqueda']); ?>
			</div>

			<div class="col-md-6" id="idDivBuscar">
				<?= $this->Form->input('Buscar', ['placeholder' => 'Buscar...','value'	=> $this->Session->read('palabraBuscadaAdmin'),]); ?>
			</div>

			<?= $this->Form->input('limite', ['type'=>'hidden']); ?>

			<div class="col-md-2 text-center" style="margin-top: 6px;">
				<?= $this->Form->button('Buscar <i class="glyphicon glyphicon-search"></i>',['type'=>'submit','class' => 'btn btn-primary col-md-12','escape' => false]);?>
				<?= $this->Form->end(); ?>
			</div>	

		</fieldset>
	</div>
	
	<div class="col-md-12">
		<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 5px;">
	        <p style="color: #588BAD">Filtrar todas las empresas por:</p>
	    </blockquote>
		<div class="col-md-12">
			<?php
				if($this->Session->read('tipoBusquedaAdmin')==4):
					$seleccionado10 = 'background-color: #e6e6e6; color: #333;';
					$seleccionado20 ='';
					$seleccionado30 = '';
					$seleccionado40 = '';
				else:
					if($this->Session->read('tipoBusquedaAdmin')==5):
						$seleccionado10 = '';
						$seleccionado20 = 'background-color: #e6e6e6; color: #333;';
						$seleccionado30 = '';
						$seleccionado40 = '';
					else:
						if($this->Session->read('tipoBusquedaAdmin')==6):
							$seleccionado10 = '';
							$seleccionado20 = '';
							$seleccionado30 = 'background-color: #e6e6e6; color: #333;';
							$seleccionado40 = '';
						else:
							if($this->Session->read('tipoBusquedaAdmin')==7):
								$seleccionado10 = '';
								$seleccionado20 = '';
								$seleccionado30 = '';
								$seleccionado40 = 'background-color: #e6e6e6; color: #333;';
							else:
								$seleccionado10 = '';
								$seleccionado20 = '';
								$seleccionado30 = '';
								$seleccionado40 = '';
							endif;
						endif;
					endif;
				endif;
			?>		
			<div class="btn-group">				
				<?= $this->Html->link('Activas', [ 'controller'=>'Administrators','action'=>'searchCompany','?' => ['tipoBusquedaAdmin' => 4]],
												['class' => 'btn btn-info ','style' => 'width: 130px;' . $seleccionado10]); ?> 
			</div>
			<div class="btn-group">				
				<?= $this->Html->link('Pendientes ('. $pendientes .')', [ 'controller'=>'Administrators','action'=>'searchCompany','?' => ['tipoBusquedaAdmin' => 5]],
												['class' => 'btn btn-info ','style' => 'width: 130px;' . $seleccionado20]); ?> 
			</div>
			<div class="btn-group">				
				<?= $this->Html->link('Por expirar', [ 'controller'=>'Administrators','action'=>'searchCompany','?' => ['tipoBusquedaAdmin' => 6]],
												['class' => 'btn btn-info ','style' => 'width: 130px;' . $seleccionado30]); ?> 
			</div>
			<div class="btn-group">				
				<?= $this->Html->link('Expiradas', [ 'controller'=>'Administrators','action'=>'searchCompany','?' => ['tipoBusquedaAdmin' => 7]],
												['class' => 'btn btn-info ','style' => 'width: 130px;' . $seleccionado40]); ?> 
			</div>
		</div>
	</div>
			
	<?php if(isset($empresas)): 
			if(empty($empresas)):
				echo '<div class="col-md-12"><div class="col-md-12"><blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;"><p style="color: #588BAD">Sin resultados.</p></blockquote></div></div>';
			else:
	?>
				<div class="col-md-12" style="margin-top: 15px">
					<div class="col-md-2" >
						<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 5px;">
					        <p style="color: #588BAD">Opciones:</p>
					    </blockquote>
				    </div>
					<div class="col-md-2" >
						<?= $this->Html->link('Descargar Excel  &nbsp;&nbsp;&nbsp; <i class="fa fa-file-excel-o" aria-hidden="true"></i>', 
																['controller'=>'Administrators',
																'action'=>'searchCompanyAdminExcel'],
																['class' => 'btn btn-default btnBlue ',
																'style' => 'font-size: 14px; height: 33px; text-align: left',
																'escape' => false]);?>
					</div>
					
					<div class="col-md-3">
						<?= $this->Form->create('Administrator', [
									'class' => 'form-horizontal', 
									'role' => 'form',
									'id' => 'sendPaginadoForm',
									'inputDefaults' => [
										'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
										'div' => ['class' => 'form-group'],
										'class' => 'form-control',
										'label' => ['class' => 'col-md-12 control-label', 'text'=>''],
										'between' => '<div class="col-md-9" style="margin-top: -8px;">',
										'after' => '</div>',
										'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
									],
									'action' => 'searchCompany']); ?>
						<?php $options = array('5' => 5,'25' => 25, '50' => 50, '100' => 100, '200' => 200); ?>
						<?= $this->Form->input('limit', ['type'=>'select','id'=> 'limit','options' => $options,'selected' => $this->Session->read('limiteAdmin'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Resultados por hoja','onchange'=> 'sendPaginado();']); ?>

						<?= $this->Form->end(); ?>

					</div>
				</div>

				<div class="col-md-12 scrollbar" id="style-2" style="margin-top: 30px">
					<?= $this->element('empresasAdmin'); ?>
					<?= $this->element('paginacionStudentAdmin'); ?>
				</div>
	<?php 
			endif;
		endif; 
	?>