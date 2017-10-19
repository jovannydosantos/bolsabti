	<?php 
		$this->layout = 'administrator'; 
	?>
	<?= $this->element('contadorCaracteres'); ?>
	<script type="text/javascript">
		function validateEmpty(){
			selectedIndex = document.getElementById("AdministratorCriterio").selectedIndex;
			
			if(document.getElementById('AdministratorBuscar').value == ''){
				$.alert({ title: '!Aviso!',type: 'red',content: 'Ingrese la palabra a buscar'});
				return false;
			} else 
			if(selectedIndex == 0){
				$( "#AdministratorCriterio" ).focus();
				$.alert({ title: '!Aviso!',type: 'red',content: 'Seleccione el criterio de búsqueda'});
				return false;
			}else {
				return true;
			}
		}
		
	</script>

	<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
        <p style="color: #588BAD">El sistema buscará por el siguiente criterio: número de cuenta, nombre(s), apellidos(s) o correo electrónico.</p>
    </blockquote>

	<div class="col-md-12">
		<?= $this->Form->create('Administrator', [
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
									'action' => 'searchStudent',
									'onsubmit' =>'return validateEmpty();']); ?>
		
		<fieldset>
			<div class="col-md-3">
				<?php $options = array('1' =>'Número de cuenta', '2' => 'Nombre(s)', '3' => 'Apellidos(s)', '4' => 'Correo electrónico'); ?>
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
	<br>
	<?php 
		if(isset($candidatos)): 
			if(empty($candidatos)):
				echo '<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 5px;">
				    <p style="color: #588BAD">Sin resultados.</p>
				  </blockquote>';
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
																'action'=>'searchStudentAdminExcel'],
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
						<?= $this->Form->input('limit', ['type'=>'select','id'=> 'limit','options' => $options,'selected' => $this->Session->read('limiteAdmin'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Resultados por hoja','onchange'=> 'sendPaginado();']); ?>

						<?= $this->Form->end(); ?>

					</div>
				</div>
									
				<div class="col-md-12 scrollbar" id="style-2" style="margin-top: 30px">
					<?= $this->element('universitariosAdmin'); ?>
					<?= $this->element('paginacionStudentAdmin'); ?>
				</div>
				
	<?php 
			endif;
		endif; 
	?>