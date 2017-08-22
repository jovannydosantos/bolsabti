<?php 
	$this->layout = 'student'; 
?>
	<script>
		function validateEmpty(){
			selectedIndex = document.getElementById("StudentCriterio").selectedIndex;
			if(document.getElementById('StudentBuscar').value == ''){
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
		
		function sendPaginado(){
			 selectedIndex = document.getElementById("limit").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				document.getElementById("sendPaginadoForm").submit();
			 }
		}
	</script>
		
	<?= $this->Form->create('Student', [
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
						'action' => 'searchOffer',
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
					echo '<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
					    <p style="color: #588BAD">Sin ofertas.</p>
					  </blockquote>';
				else:
		?>
					<div class="col-md-12">
						<label>Resultados de búsqueda:</label>
					</div>
					
					<div class="col-md-3" style="margin-top: 7px;">
						<?php 
							if($this->Session->read('orden') == 'ASC'):
								$addClassSalaryASC = 'active'; 
								$addClassSalaryDESC = ''; 
							else:
								if($this->Session->read('orden') == 'DESC'):
									$addClassSalaryASC = ''; 
									$addClassSalaryDESC = 'active';
								else:
									$addClassSalaryASC = ''; 
									$addClassSalaryDESC = ''; 
								endif;
							endif;
						?>
						
						<div class="btn-group" style="width: 100%;">
						  <button type="button" class="btn btn-default col-md-12" data-toggle="dropdown">Ordenar por sueldo &nbsp;<i></i><span class="caret"></span></button>
						  <ul class="dropdown-menu nav" role="menu">
							<li>
								<?= $this->Html->link('Más bajo al más alto', 
															['controller'=>'Students',
															'action'=>'searchOffer','?' => ['parametro' => $this->Session->read('palabraBuscada'),'orden' => 'ASC']],
															['class' => 'btn btn-default '.$addClassSalaryASC,'style' => 'border-color: transparent;','escape' => false]); ?>
							</li>
							<li>
							<?php echo $this->Html->link('Más alto al más bajo', 
															['controller'=>'Students',
															'action'=>'searchOffer','?' => ['parametro' => $this->Session->read('palabraBuscada'),'orden' => 'DESC']],
															['class' => 'btn btn-default ' . $addClassSalaryDESC,'style' => 'margin-top: 5px;border-color: transparent;','escape' => false]); ?>
							</li>
						  </ul>
						</div>
					</div>

					<div class="col-md-3">
						<?= $this->Form->create('Student', [
							'class' => 'form-horizontal', 
							'id' => 'sendPaginadoForm',
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
							'action' => 'searchOffer']); ?>

						<?php $options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200); ?>
						<?= $this->Form->input('limit', ['type'=>'select','options' => $options,'id'=> 'limit','class' => 'selectpicker show-tick form-control show-menu-arrow','selected' => $this->Session->read('limit'),'default'=>'0', 'empty' => 'Resultados por hoja','onchange' => 'sendPaginado()']); ?>

						<?= $this->Form->end(); ?>
					</div>
			
					<div class="col-md-12 scrollbar" id="style-2" style="margin-top: 30px">
						<?= $this->element('ofertas'); ?>
					</div>
		<?php 
				endif;
			endif; 
		?>

	
