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
</script>
	
	<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
        <p style="color: #588BAD">Administrar ofertas guardadas.
        <?php if((isset($intoFolder)) and ($intoFolder<>'')): ?>
				<img class="estatica" src="<?php echo $this->webroot; ?>img/student/folder1.png" style="width: 25px; ">   <label><?php echo $foldersList[$intoFolder]; ?> </label>
		<?php endif?></p>
    </blockquote>

    <div class="col-md-12" ><div class="col-md-12" >
		<label>Buscar oferta dentro de carpeta(s):</label>
	</div></div>

	<div class="col-md-12" >
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
							'action' => 'offerAdmin',
							'onsubmit' =>'return validateEmpty();']); ?>
	
		<fieldset>
			<div class="col-md-3">
				<?php $options = array('1' => 'Nombre de la empresa', '2' => 'Puesto', '3' => 'Folio'); ?>
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
	</div>
	
	<div class="col-md-12"><div class="col-md-12">
		<label> Filtrar todas las ofertas guardadas por: </label>
	</div></div>


	<div class="col-md-12"><div class="col-md-12">
		<?php
			if($this->Session->read('tipoBusqueda')==10):
				$seleccionado10 = 'background-color: #e6e6e6; color: #333;';
				$seleccionado20 ='';
				$seleccionado30 = '';
			else:
				if($this->Session->read('tipoBusqueda')==20):
					$seleccionado10 = '';
					$seleccionado20 ='background-color: #e6e6e6; color: #333;';
					$seleccionado30 = '';
				else:
					if($this->Session->read('tipoBusqueda')==30):
						$seleccionado10 = '';
						$seleccionado20 ='';
						$seleccionado30 = 'background-color: #e6e6e6; color: #333;';
					else:
						$seleccionado10 = '';
						$seleccionado20 ='';
						$seleccionado30 = '';
					endif;
				endif;
			endif;
		?>		
		<div class="btn-group">				
			<?= $this->Html->link('Vistas', [ 'controller'=>'Students','action'=>'offerAdmin','?' => ['tipoBusqueda' => 10]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 130px;' . $seleccionado10]); ?> 
		</div>
		<div class="btn-group">				
			<?= $this->Html->link('No vistas', [ 'controller'=>'Students','action'=>'offerAdmin','?' => ['tipoBusqueda' => 20]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 130px;' . $seleccionado20]); ?> 
		</div>
		<div class="btn-group">				
			<?= $this->Html->link('Aplicó', [ 'controller'=>'Students','action'=>'offerAdmin','?' => ['tipoBusqueda' => 30]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 130px;' . $seleccionado30]); ?> 
		</div>
	</div></div>
				
	<?php if(isset($ofertas)): 
			if(empty($ofertas)):
				echo '<div class="col-md-12"><div class="col-md-12"><blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
				    <p style="color: #588BAD">Sin ofertas.</p>
				  </blockquote></div></div>';
			else:
	?>
				<div class="col-md-12 scrollbar" id="style-2" style="margin-top: 30px;">
					<?= $this->element('ofertas'); ?>
				</div>	
				
	<?php 
			endif;
		endif; 
	?>	
