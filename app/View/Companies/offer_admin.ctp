<?php 
	$this->layout = 'company'; 
?>
<script>
	function validateEmpty(){
		selectedIndex = document.getElementById("CompanyCriterio").selectedIndex;
		var palabraBuscar = document.getElementById('CompanyBuscar').value ;
		var sueldo = document.getElementById("CompanyBuscarSalary").selectedIndex;

		if(selectedIndex == 0){
			jAlert('Seleccione el criterio de búsqueda', 'Mensaje');
			document.getElementById('CompanyCriterio').focus();
			return false;
		}else 
		if((palabraBuscar == '') && (sueldo == '')){
			
			if(selectedIndex == 1){
				jAlert('Ingrese el puesto', 'Mensaje');
				document.getElementById('CompanyBuscar').focus();
			} else
			if(selectedIndex == 2){
				jAlert('Seleccione el rango de sueldo', 'Mensaje');
				document.getElementById('CompanyBuscarSalary').focus();
			}else{
					jAlert('Ingrese el folio', 'Mensaje');
					document.getElementById('CompanyBuscar').focus();
			}
			
			return false;
		}else {
			return true;
		}
	}
</script>
	
<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
        <p style="color: #588BAD">Administrar ofertas guardadas.
        <?php if((isset($intoFolder)) and ($intoFolder<>'')): ?>
				<img class="estatica" src="<?php echo $this->webroot; ?>img/student/folder1.png" style="width: 25px; ">   
				<label><?php echo $foldersList[$intoFolder]; ?> </label>
		<?php endif?></p>
</blockquote>

<div class="col-md-12" >
	<div class="col-md-12" >
		<label>Buscar oferta dentro de carpeta(s):</label>
	</div>
</div>

<div class="col-md-12" >
	<?= $this->Form->create('Company', [
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
			<?php $options = array('1' => 'Puesto', '2' => 'Sueldo', '3' => 'Folio'); ?>
			<?= $this->Form->input('criterio', ['type'=>'select','options' => $options,'selected' => $this->Session->read('tipoBusqueda'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Criterio de búsqueda']); ?>
		</div>
		<div class="col-md-6">
			<?= $this->Form->input('Buscar', ['placeholder' => 'Puesto / Sueldo / Folio ','value'	=> $this->Session->read('palabraBuscada')]); ?>
		</div>
		<div class="col-md-2">
			<?= $this->Form->button('Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',['type'=>'submit','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px;']);?>
			<?= $this->Form->end(); ?>
		</div>
	</fieldset>
</div>
	
<div class="col-md-12">
	<div class="col-md-12">
		<label> Filtrar todas las ofertas guardadas por: </label>
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-12">
	<?php
					if($this->Session->read('tipoBusqueda')==4):
						$seleccionado10 = 'background-color: #e6e6e6; color: #333;';
						$seleccionado20 ='';
						$seleccionado30 = '';
						$seleccionado40 = '';
					else:
						if($this->Session->read('tipoBusqueda')==5):
							$seleccionado10 = '';
							$seleccionado20 = 'background-color: #e6e6e6; color: #333;';
							$seleccionado30 = '';
							$seleccionado40 = '';
						else:
							if($this->Session->read('tipoBusqueda')==6):
								$seleccionado10 = '';
								$seleccionado20 = '';
								$seleccionado30 = 'background-color: #e6e6e6; color: #333;';
								$seleccionado40 = '';
							else:
								if($this->Session->read('tipoBusqueda')==7):
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
			<?= $this->Html->link('Activas', [ 'controller'=>'Companies','action'=>'offerAdmin','?' => ['tipoBusqueda' => 4]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 130px;' . $seleccionado10]); ?> 
		</div>
		<div class="btn-group">				
			<?= $this->Html->link('No vistas', [ 'controller'=>'Companies','action'=>'offerAdmin','?' => ['tipoBusqueda' => 5]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 130px;' . $seleccionado20]); ?> 
		</div>
		<div class="btn-group">				
			<?= $this->Html->link('Aplicó', [ 'controller'=>'Companies','action'=>'offerAdmin','?' => ['tipoBusqueda' => 6]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 130px;' . $seleccionado30]); ?> 
		</div>
		<div class="btn-group">				
		<?= $this->Html->link('Inactivas', [ 'controller'=>'Companies','action'=>'offerAdmin','?' => ['tipoBusqueda' => 7]],
										['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 130px;' . $seleccionado40]); ?> 
		</div>
	</div>
</div>
		
<div class="col-md-12">
	<div class="col-md-12">
		<label> Resultados de busqueda</label>
	</div>
</div>

<div class="col-md-3">
		<?php $options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200); ?>
						<?= $this->Form->input('limit', ['type'=>'select','options' => $options,'id'=> 'limit','class' => 'selectpicker show-tick form-control show-menu-arrow','selected' => $this->Session->read('limit'),'default'=>'0', 'empty' => 'Resultados por hoja','onchange' => 'sendLimit()']); ?>	
</div>

<div class="col-md-9">
	<div class="col-md-4">
	 <?php 	echo $this->Html->link(
									'Descargar Excel &nbsp; <i class="glyphicon glyphicon glyphicon-save"></i>', 
											array(
													'controller'=>'Companies',
													'action'=>'offerAdminExcel',
												),
												array(
													'class' => 'btn btn-primary',
													'style'=>'margin-top: 7px;',
													'escape' => false,
													)	
								); 
		?>
	</div>
</div>

<?php if(isset($ofertas)): 
		if(empty($ofertas)):
			echo '<div class="col-md-12" style="margin-top: 15px;"> <p style="font-size: 22px;margin-left: -20px;">Sin ofertas</p></div>';
		else:
?>
	
				
<div class="col-md-12 scrollbar" id="style-2" style="margin-top: 30px">
	<?= $this->element('ofertasCompanies'); ?>
</div>					

<?php 
		endif;
	endif; 
?>	
