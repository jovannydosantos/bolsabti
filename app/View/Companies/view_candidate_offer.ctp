<?php 
	$this->layout = 'company'; 
?>
<script>
	$(document).ready(function() {
		init_contadorTa("taComentario","contadorTaComentario", 316);
		updateContadorTa("taComentario","contadorTaComentario", 316);
		
		init_contadorTa("messageIdEmail","contadorTaComentario2", 632);
		updateContadorTa("messageIdEmail","contadorTaComentario2", 632);
		
		 $('#StudentNotificationCompanyInterviewDateYear').prepend('<option value="" selected>AAAA</option>');
		 $('#StudentNotificationCompanyInterviewDateMonth').prepend('<option value="" selected>MM</option>');
		 $('#StudentNotificationCompanyInterviewDateDay').prepend('<option value="" selected>DD</option>');
		 
		 $('#StudentPersonalNotificationCompanyInterviewDateYear').prepend('<option value="" selected>AAAA</option>');
		 $('#StudentPersonalNotificationCompanyInterviewDateMonth').prepend('<option value="" selected>MM</option>');
		 $('#StudentPersonalNotificationCompanyInterviewDateDay').prepend('<option value="" selected>DD</option>');
		 
		 $('#StudentReportarContratacionFechaContratacionYear').prepend('<option value="" selected>AAAA</option>');
		 $('#StudentReportarContratacionFechaContratacionMonth').prepend('<option value="" selected>MM</option>');
		 $('#StudentReportarContratacionFechaContratacionDay').prepend('<option value="" selected>DD</option>');
		 
		 typeSearch();
	});
	//Contador de caracteres para las notificaciones telefónicas 
	function sendLimit(){
		 selectedIndex = document.getElementById("limit").selectedIndex;
		 if(selectedIndex == 0){
			return false;
		 } else {
			document.getElementById('CompanyLimite').value = document.getElementById('limit').value;
			document.getElementById("CompanyViewCandidateOfferForm").submit();
		 }
	}
	function typeSearch(){
		selectedIndexTypeSearch = document.getElementById("CompanyCriterio").selectedIndex;
		
		if(selectedIndexTypeSearch==1){
			$("#CompanyBuscar").attr("placeholder", "Ingrese el nombre del candidato");
		}
		else
			if(selectedIndexTypeSearch==2){
				$("#CompanyBuscar").attr("placeholder", "Ingrese el correo electrónico");
			}
			else
				if(selectedIndexTypeSearch==3){
					$("#CompanyBuscar").attr("placeholder", "Ingrese el folio");
				}
				else{
					$("#CompanyBuscar").attr("placeholder", "Nombre candidato / Correo electrónico / Folio ");
				}
	}
</script>

<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
        <p style="color: #588BAD;">Ver candidatos dentro de ofertas.</p>
</blockquote>

<div class="col-md-12" >
	<div class="col-md-12" >
		<label>Buscar candidatos dentro de oferta:</label>
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
						'action' => 'viewCandidateOffer',
						'onsubmit' =>'return validateEmpty();']); ?>
	<fieldset>
		<div class="col-md-3">
			<?php $options = array('1' => 'Nombre candidato', '2' => 'Correo electrónico', '3' => 'Folio'); ?>
			<?= $this->Form->input('criterio', ['type'=>'select','options' => $options,'selected' => $this->Session->read('tipoBusqueda'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Criterio de búsqueda']); ?>
		</div>
		<div class="col-md-6">
			<?= $this->Form->input('Buscar', ['placeholder' => 'Nombre candidato / Correo electrónico / Folio ','value'	=> $this->Session->read('palabraBuscada')]); ?>
		</div>
		<div class="col-md-2">
			<?= $this->Form->button('Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',['type'=>'submit','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px;']);?>
			<?= $this->Form->end(); ?>
		</div>
	</fieldset>
</div>

<div class="col-md-12" >
	<div class="col-md-12" >
		<label>Mostrar perfiles dentro de oferta:</label>
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
			$seleccionado50 = '';
			$seleccionado60 = '';
		else:
			if($this->Session->read('tipoBusqueda')==5):
				$seleccionado10 = '';
				$seleccionado20 = 'background-color: #e6e6e6; color: #333;';
				$seleccionado30 = '';
				$seleccionado40 = '';
				$seleccionado50 = '';
				$seleccionado60 = '';
			else:
				if($this->Session->read('tipoBusqueda')==6):
					$seleccionado10 = '';
					$seleccionado20 = '';
					$seleccionado30 = 'background-color: #e6e6e6; color: #333;';
					$seleccionado40 = '';
					$seleccionado50 = '';
					$seleccionado60 = '';
				else:
					if($this->Session->read('tipoBusqueda')==7):
						$seleccionado10 = '';
						$seleccionado20 = '';
						$seleccionado30 = '';
						$seleccionado40 = 'background-color: #e6e6e6; color: #333;';
						$seleccionado50 = '';
						$seleccionado60 = '';
					else:
						if($this->Session->read('tipoBusqueda')==8):
							$seleccionado10 = '';
							$seleccionado20 = '';
							$seleccionado30 = '';
							$seleccionado40 = '';
							$seleccionado50 = 'background-color: #e6e6e6; color: #333;';
							$seleccionado60 = '';
						else:
							if($this->Session->read('tipoBusqueda')==9):
								$seleccionado10 = '';
								$seleccionado20 = '';
								$seleccionado30 = '';
								$seleccionado40 = '';
								$seleccionado50 = '';
								$seleccionado60 = 'background-color: #e6e6e6; color: #333;';
							else:
								$seleccionado10 = '';
								$seleccionado20 = '';
								$seleccionado30 = '';
								$seleccionado40 = '';
								$seleccionado50 = '';
								$seleccionado60 = '';
							endif;
						endif;
					endif;
				endif;
			endif;
		endif;
	?>		
		<div class="btn-group">				
			<?= $this->Html->link('Postulados', [ 'controller'=>'Companies','action'=>'viewCandidateOffer','?' => ['tipoBusqueda' => 4]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 130px;' . $seleccionado10]); ?> 
		</div>
		<div class="btn-group">				
			<?= $this->Html->link('Recomendados', [ 'controller'=>'Companies','action'=>'viewCandidateOffer','?' => ['tipoBusqueda' => 5]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 130px;' . $seleccionado20]); ?> 
		</div>
	</div>
</div>
				
<div class="col-md-12" >
	<div class="col-md-12" >
		<label>Filtrar candidatos por:</label>
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-12">
		<div class="btn-group">				
			<?= $this->Html->link('Todos', [ 'controller'=>'Companies','action'=>'viewCandidateOffer','?' => ['tipoBusqueda' => 6]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 163px;' . $seleccionado30]); ?> 
		</div>
		<div class="btn-group">				
			<?= $this->Html->link('Entrevista Telefónicas', [ 'controller'=>'Companies','action'=>'viewCandidateOffer','?' => ['tipoBusqueda' => 7]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 163px;' . $seleccionado40]); ?> 
		</div>
		<div class="btn-group">				
			<?= $this->Html->link('Entrevista Presenciales', [ 'controller'=>'Companies','action'=>'viewCandidateOffer','?' => ['tipoBusqueda' => 8]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 163px;' . $seleccionado50]); ?> 
		</div>
		<div class="btn-group">				
			<?= $this->Html->link('Contratados', [ 'controller'=>'Companies','action'=>'viewCandidateOffer','?' => ['tipoBusqueda' => 9]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 163px;' . $seleccionado60]); ?> 
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

<?php if(isset($candidatos)): 
		if(empty($candidatos)):
			echo '<div class="col-md-12" style="margin-top: 15px;"> <p style="font-size: 22px;margin-left: -20px;">Sin candidatos</p></div>';
		else:
?>
					
<div class="col-md-12 scrollbar" id="style-2" style="margin-top: 30px">
	<?= $this->element('candidatos'); ?>
	<?= $this->element('paginacionStudentAdmin'); ?>
</div>					

<?php 
		endif;
	endif; 
?>	