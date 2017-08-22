<?php 
	$this->layout = 'student'; 
?>
	<script>
		$(document).ready(function() {
			$('#ReportFechaContratacionDay').prepend('<option value="">DD</option>');
			$('#ReportFechaContratacionMonth').prepend('<option value="">MM</option>');
			$('#ReportFechaContratacionYear').prepend('<option value="">AAAA</option>');
			$("select#ReportFechaContratacionDay").val('');
			$("select#ReportFechaContratacionMonth").val('');
			$("select#ReportFechaContratacionYear").val('');
		}); 

		function validateEmpty(){
			selectedIndex = document.getElementById("StudentCriterio").selectedIndex;
			if(document.getElementById('StudentBuscar').value == ''){
				$.alert({ title: '!Aviso!',type: 'red',content: 'Ingrese el nombre de la empresa, puesto ó folio a buscar'});
				return false;
			} else 
			if(selectedIndex == 0){
				$.alert({ title: '!Aviso!',type: 'red',content: 'Seleccione el criterio de búsqueda'});
				return false;
			}else {
				return true;
			}
		}
		
		function openModalReporte(id){
			document.getElementById('ReportCompanyJobProfileId').value = id;
			$('#openModal').modal('show');
		}
	</script>

	<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
        <p style="color: #588BAD">Buscar oferta dentro de carpetas u ofertas postuladas:</p>
    </blockquote>

	<div class="col-md-12">

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
							'action' => 'report',
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
						    <p style="color: #588BAD">Sin ofertas postuladas o guardadas.</p>
						  </blockquote>';
				else: ?>

					<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
				        <p style="color: #588BAD">Ofertas guardadas o postuladas:</p>
				    </blockquote>

					<div class="col-md-12 scrollbar" id="style-2" >
						<?= $this->element('reportarOferta'); ?>
					</div>
				
			<?php 
					endif;
				endif; 
			?>	
	</div>

	
